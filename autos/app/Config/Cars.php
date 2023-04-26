<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Cars extends BaseConfig
{
    public $car_types = [
        10 => 'Limousine',
        15 => 'SUV',
        20 => 'Cabrio',
        30 => 'Bus'
    ];
    
}
