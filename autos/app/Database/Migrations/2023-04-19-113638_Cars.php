<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cars extends Migration
{
    public function up()
    {
        $this->db->query("
        CREATE TABLE `cars`.`cars` (`id` INT(11) NOT NULL AUTO_INCREMENT , `car_brand` VARCHAR(255) NOT NULL , `car_name` VARCHAR(255) NOT NULL , `color_hex` VARCHAR(6) NOT NULL , `comments` TEXT NOT NULL , `car_type_id` INT(11) NOT NULL , `created_at` DATETIME NOT NULL , `updated_at` DATETIME NOT NULL , `deleted_at` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
        ");
    }

    public function down()
    {
        //
    }
}
