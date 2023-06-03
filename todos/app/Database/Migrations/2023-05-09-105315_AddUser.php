<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Shield\Entities\User;

class AddUser extends Migration
{
    public function up()
    {

        // Load settings
        helper('setting');

        // Get the User Provider (UserModel by default)
        $users = auth()->getProvider();
        
        // Add user
        $user = new User([
            'username' => 'pedrocas',
            'email'    => 'pedrocas@gmail.com',
            'password' => 'secret',
        ]);
        $users->save($user);

        // Get latest user id
        $user_id = $users->getInsertID();

        // To get the complete user object with ID, we need to get from the database
        $user = $users->findById($user_id);
        
        // Add to default group
        $users->addToDefaultGroup($user);
    }

    public function down()
    {
        //
    }
}
