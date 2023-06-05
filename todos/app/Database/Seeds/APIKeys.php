<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class APIKeys extends Seeder
{
    public function run()
    {

        $api_keys_data = [
            [
                'api_key'       => 'uGoPBqThahdWrJpif+1fVwxVQHXIe82vGKdp7t1IRpc=',
                'comments'      => 'Pedrocas',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'api_key'       => 'uPklTz93JsfKpiSl09p48shBfiVWDpe01uZ76t1t2mr=',
                'comments'      => 'Antonio',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'api_key'       => 'lo348sSadpSe02Sa9d+93t2aF788FLLod2ap92nc34y=',
                'comments'      => 'Test',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ];
        
        // Init car model
        $APIKey_model = new \App\Models\APIKeys();

        // Insert & validate data
        foreach($api_keys_data as $index => $data) {

            if ($APIKey_model->insert($data) === false) {
                echo "Errors on api key on index ${index}:\n";
                print_r($APIKey_model->errors());
            }
            
        }
    }
}
