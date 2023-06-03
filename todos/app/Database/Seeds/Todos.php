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
                'todo_description'  => "lorem ipsum do this and that",
                'categoryId'        => 2,
                'todo_priorityNr'   => 4,
                'private_todo'      => false,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'todo_name'         => 'Play Baseball',
                'todo_description'  => "baseball is a sport   duh",
                'categoryId'        => 1,
                'todo_priorityNr'   => 3,
                'private_todo'      => false,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'todo_name'         => 'Go catch some hands',
                'todo_description'  => "beat some guy on the front of some bar",
                'categoryId'        => 1,
                'todo_priorityNr'   => 2,
                'private_todo'      => false,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'todo_name'         => 'Kill someone',
                'todo_description'  => "this is a secret todo and thus its private",
                'categoryId'        => 1,
                'todo_priorityNr'   => 1,
                'private_todo'      => true,
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
