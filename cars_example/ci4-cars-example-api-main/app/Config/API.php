<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class API extends BaseConfig
{

    public $defaults = [
        'default_limit' => 100,
        'max_limit' => 100
    ];

    public $check_api_key = TRUE;

    public $allowed_api_keys = [
        'km9uyxeq8pEGPcixfa3teyDHcPoabM' => 'Emanuel',
        'P7Cy7yGwLo8RPFDzce4wuYqCGwWYmE' => 'Sarah'
    ];


    public $check_ip_address = TRUE;

    public $allowed_ip_addresses = [
        '::1' => 'localhost (ipv6)',
        '127.0.0.1' => 'localhost (ipv4)',
        '212.34.144.22' => 'Spezifische IP Adresse'
    ];
}
