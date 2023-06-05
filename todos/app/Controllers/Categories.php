<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Config\Services;
use CodeIgniter\RESTful\ResourceController;


class Categories extends ResourceController
{

    protected $modelName = 'App\Models\Category';
    protected $format = 'json';

    protected $config = null;



    /**
     * Constructor
     */
    public function __construct() {}

    /**
     * Get all Todos
     *
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function index() {


        // Get filter (from helper)
        $filter = prepare_filter();

        // Get filtered data
        $all_data = $this->model->getFiltered($filter);

        $request = request();
        
        log_api_request($request, get_api_key_from_request($request));

        // Check filtered data
        if ($filter !== FALSE && !empty($all_data)) {

            // Prepare data
            if (!empty($all_data['data']) && is_array($all_data['data'])) {
                foreach($all_data['data'] as $id => $data) {
                    $prepared_data = $this->_prepare_data($data);
                    $all_data['data'][$id] = $prepared_data;
                }
            }
            
            // Respond data
            return $this->respond($all_data);
        }

        // Show error
        return $this->failNotFound();

    }

    /**
     * Get single car with specific ID
     *
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function show($id = null) {

        $request = request();
        
        log_api_request($request, get_api_key_from_request($request));

        if (!empty($id)) {

            $data = $this->model->find($id);

            if (!empty($data)) {
                $prepared_data = $this->_prepare_data($data);
                return $this->respond($prepared_data);
            }
        }

        return $this->failNotFound();
    }

    /**
     * Prepare data to view
     *
     * @param array $data
     * @return array
     */
    private function _prepare_data($data = array()) {

        if (!empty($data) && is_array($data)) {

            // Remove internal field: deleted_at
            unset($data['deleted_at']);   
        }
        return $data;
    }

    /**
     * POST / Create new entry
     *
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function create() {
        
        $request = request();
        
        log_api_request($request, get_api_key_from_request($request));

        // Get & prepare data
        $data = $this->request->getJSON(true);

        if (!empty($data)) {

            // Add meta data
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');

            // Try to insert & check validation
            $new_id = $this->model->insert($data);

            if ($new_id === false) {
                return $this->failValidationErrors($this->model->errors());
            }
            else {
                log_message("info", "Category::Create - Created Category with: " . json_encode($data));
                return $this->respondCreated(['id' => $new_id] + $data);
            }
        }
        // Fail
        return $this->failServerError();
    }

    /**
     * PUT & PATCH / Update an entry
     *
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function update($id = null) {

        $request = request();
        
        log_api_request($request, get_api_key_from_request($request));

        if (!empty($id)) {

            $data_exists = $this->model->find($id);

            if (!empty($data_exists)) {

                // Get & prepare data
                $data = $this->request->getJSON(true);

                if (!empty($data)) {

                    // Add meta data
                    $data['updated_at'] = date('Y-m-d H:i:s');
        
                    // Try to update & check validation
                    if ($this->model->update($id, $data) === false) {
                        return $this->failValidationErrors($this->model->errors());
                    }
                    else {
                        log_message("info", "Category::Update - Updated Category with: " . json_encode($data));
                        return $this->respondUpdated(['id' => $id] + $data);
                    }
                }   
            }
        }
        return $this->failNotFound();
    }


    /**
     * Delete / Delete an entry
     *
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function delete($id = null) {

        $request = request();
        
        log_api_request($request, get_api_key_from_request($request));

        if($this->model->hasTodosAssociated($id)) {
            log_message("info", "There are todos associated with this category, cannot delete");
            return Services::response()->setJSON(
                [
                    "Cannot Delete" => "There are todos associated with this category!"
                ]
            )->setStatusCode(ResponseInterface::HTTP_IM_USED);
        }

        if (!empty($id)) {

            $data_exists = $this->model->find($id);

            if (!empty($data_exists)) {

                $delete_status = $this->model->delete($id);

                if ($delete_status === true) {
                    return $this->respondDeleted(['id' => $id]);
                }
            }

        }
        return $this->failNotFound();
    }
}
