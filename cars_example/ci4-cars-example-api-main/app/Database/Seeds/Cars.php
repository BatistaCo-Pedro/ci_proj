<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Cars extends Seeder
{
    public function run()
    {

        $example_data = [
            [
                'car_brand'     => 'VW',
                'car_name'      => 'Polo',
                'color_hex'     => 'ffffff',
                'comments'      => '',
                'car_type_id'   => 10,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'car_brand'     => 'Audi',
                'car_name'      => 'TT',
                'color_hex'     => '0000ff',
                'comments'      => '',
                'car_type_id'   => 10,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'car_brand'     => 'Tesla',
                'car_name'      => 'Roadster',
                'color_hex'     => 'ff00ff',
                'comments'      => '',
                'car_type_id'   => 20,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'car_brand'     => 'VW',
                'car_name'      => 'Bus',
                'color_hex'     => 'afi33kasdfasdfs',
                'comments'      => '',
                'car_type_id'   => 30,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ]
        ];
        
        // Init car model
        $CarModel = new \App\Models\Cars();

        // Insert & validate data
        foreach($example_data as $entry_id => $data) {

            if ($CarModel->insert($data) === false) {
                echo "Errors on entry_id ${entry_id}:\n";
                print_r($CarModel->errors());
            }
            
        }
    }
}
