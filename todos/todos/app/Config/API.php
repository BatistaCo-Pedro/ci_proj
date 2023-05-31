<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class API extends BaseConfig
{

    public $defaults = [
        'default_limit' => 5,
        'max_limit' => 10
    ];

    public $check_api_key = true;

    public $allowed_api_keys = [
        'fegy7yGwLogfhPFDzce4wuY5gbawEf' => 'Pedro'
    ];


    public $check_ip_address = TRUE;

    public $allowed_ip_addresses = [
        '::1' => 'localhost (ipv6)',
        '127.0.0.1' => 'localhost (ipv4)',
    ];
}
