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

    /**
     * Show single car
     * 
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function show($id = null) {
        
        if(!empty($id)) {

            $data = $this->model->find($id);

            if(!empty($data)) {
                return $this->respond($this->_prepare_view_data($data));
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
    private function _prepare_view_data($data = array()) {

        if(!empty($data) && is_array($data)){

            // Remove internal field: deleted_at
            unset($data['deleted_at']);

            // Add car type as text
            if (!empty($data['car_type_id']) && !empty($this->config->car_types[$data['car_type_id']])) {
                $data['car_type'] = $this->config->car_types[$data['car_type_id']];
            }
        }

        return $data;
    }

}
