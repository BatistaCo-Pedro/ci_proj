<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Todos extends Migration
{
    public function up()
    {
        $this->db->query("CREATE TABLE todos
            (
            id INT(11) UNSIGNED AUTO_INCREMENT,
            todo_name VARCHAR(255),
            todo_description VARCHAR(255),
            todo_priorityNr INT,
            categoryId INT,
            created_at DATETIME,
            updated_at DATETIME,
            deleted_at DATETIME,
            PRIMARY KEY (id)
            );
        ");
    }

    public function down()
    {
        //
    }
}