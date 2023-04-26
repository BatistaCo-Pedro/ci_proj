<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Cars extends Seeder
{
    public function run()
    {
        $example_data = [
            [
                'car_brand' => 'Toyota',
                'car_name' => 'Corolla',
                'color_hex' => 'FFA500',
                'comments' => 'Great fuel economy!',
                'car_type_id' => 10,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'car_brand' => 'Honda',
                'car_name' => 'Civic',
                'color_hex' => '0000FF',
                'comments' => 'Sporty and fun to drive',
                'car_type_id' => 15,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'car_brand' => 'Mercedes',
                'car_name' => 'Viano',
                'color_hex' => 'FFFFFF',
                'comments' => '',
                'car_type_id' => 20,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'car_brand' => 'Ford',
                'car_name' => 'Ranger',
                'color_hex' => '000000',
                'comments' => '',
                'car_type_id' => 30,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];

        // Variant 1: Insert via model


        // Init car model
        $CarModel = new \App\Models\Cars();

        // Insert & validate data
        foreach($example_data as $entry_id => $data) {

            if($CarModel->insert($data) === false) {
                echo "Errors on entry_id ${entry_id}: \n";
                print_r($CarModel->errors());
            }
        }


        // Variant 2: Insert via DB Object

        // foreach($example_data as $entry_id => $data) {
        //     $this->db->table('cars') ->insert($data);
        // }
    }
}
