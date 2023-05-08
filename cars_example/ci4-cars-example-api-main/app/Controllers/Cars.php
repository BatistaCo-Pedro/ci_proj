<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;


class Cars extends ResourceController
{
    protected $modelName = 'App\Models\Cars';
    protected $format = 'json';

    protected $config = null;

    function __construct() {
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        $this->config = config('Cars');
    }

    /**
     * Get all cars
     *
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function index() {

        $all_data = $this->model->findAll();
        if (!empty($all_data) && is_array($all_data)) {
            foreach($all_data as $id => $data) {
                $prepared_data = $this->_prepare_data($data);
                $all_data[$id] = $prepared_data;
            }
        }
        return $this->respond($all_data);
    }



    /**
     * Get single car with specific ID
     *
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function show($id = null) {

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

            // Add car type as text
            if (!empty($data['car_type_id']) && !empty($this->config->car_types[$data['car_type_id']])) {
                $data['car_type'] = $this->config->car_types[$data['car_type_id']];
            }
            
        }
        header('Content-type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Methods: GET, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        return $data;
    }



    /**
     * POST / Create new entry
     *
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function create() {
        
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
