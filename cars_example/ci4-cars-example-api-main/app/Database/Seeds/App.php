<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class App extends Seeder
{
    public function run()
    {

        $this->call('Categories');
        $this->call('Todos');
        $this->call('APIKeys');
        
    }
}
