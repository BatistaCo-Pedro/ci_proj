<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;


class PrivateTodos extends ResourceController
{
    protected $modelName = 'App\Models\Todo';
    protected $format = 'json';

    protected $config = null;



    /**
     * Constructor
     */
    public function __construct() {

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

    public function index() {
        // Get filter (from helper)
        $filter = prepare_filter();

        $request = request();
        
        log_api_request($request, get_api_auth_from_request($request));

        // Get filtered data
        $all_data = $this->model->get_private_Filtered($filter);
        

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

}
