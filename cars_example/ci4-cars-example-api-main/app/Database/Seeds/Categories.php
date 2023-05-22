<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Categories extends Seeder
{
    public function run()
    {
        $example_data = [
            [
                'cat_name'     => 'Private',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),

            ],
            [
                'cat_name'     => 'School',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ];

        // Init  model
        $CatModel = new \App\Models\Category();

        // Insert & validate data
        foreach($example_data as $entry_id => $data) {

            if ($CatModel->insert($data) === false) {
                echo "Errors on entry_id ${entry_id}:\n";
                print_r($CatModel->errors());
            }
            
        }
    }
}
