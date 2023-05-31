<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Todos extends Seeder
{
    public function run()
    {
        $example_data = [
            [
                'todo_name'         => 'Do this',
                'todo_description'  => "balh blah blah blah blah blah",
                'categoryId'        => 1,
                'todo_priorityNr'   => 2,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'todo_name'         => 'Do that',
                'todo_description'  => "lorem ipsum is great lorem ipsum is great",
                'categoryId'        => 1,
                'todo_priorityNr'   => 1,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
        ];

        // Init  model
        $TodoModel = new \App\Models\Todo();

        // Insert & validate data
        foreach($example_data as $entry_id => $data) {

            if ($TodoModel->insert($data) === false) {
                echo "Errors on entry_id ${entry_id}:\n";
                print_r($TodoModel->errors());
            }
            
        }
    }
}
