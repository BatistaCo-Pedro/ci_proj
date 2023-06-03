<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Categories extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'cat_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            "created_at" => [
                "type" => "DATETIME"
            ],
            "updated_at" => [
                "type" => "DATETIME"
            ],
            "deleted_at" => [
                "type" => "DATETIME"
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('categories');

        $this->db->query('ALTER TABLE `todos` ADD CONSTRAINT todos.categoryId FOREIGN KEY(`categoryId`) REFERENCES categories(`id`) ON DELETE CASCADE ON UPDATE CASCADE;');

    }

    public function down()
    {

    }
}
