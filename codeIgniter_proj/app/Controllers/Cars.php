<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Cars extends BaseController
{


    protected $modelName = 'App\Models\Cars';
    protected $format = 'json';

    protected $config = array();


    /**
     * Constructor
     */
    public function __construct(){

        // Load custom config: Cars
        $this->config = config('Cars');
        
    }

    /**
     * Index
     * 
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function index()
    {
        $all_data = $this->model->findAll();
        if (!empty($all_data) && is_array($all_data)) {
            foreach($all_data as $id => $data) {
                $all_data[$id] = $this->_prepare_view_data($data);
            }
        }

        return $this->respond($all_data);
    }

    public function create() {

        // Get & prepare data
        $data = $this->request->getJSON(true);

        if(!empty($data)) {

            // Add meta data
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');

            //Tr to insert & check validation
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
}
