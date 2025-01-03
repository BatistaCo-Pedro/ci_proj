<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class API extends BaseConfig
{

    public $defaults = [
        'default_limit' => 20,
        'max_limit' => 100
    ];

    public $check_api_key = true;

    public $allowed_api_keys = [
        'uGoPBqThahdWrJpif61fVwxVQHXIe82vGKdp7t1IRpc' => 'Pedrocas',
        'uPklTz93JsfKpiSl09p48shBfiVWDpe01uZ76t1t2mr' => 'Antonio',
        'lo348sSadpSe02Sa9d893t2aF788FLLod2ap92nc34y' => 'Test'
    ];


    public $check_ip_address = TRUE;

    public $allowed_ip_addresses = [
        '::1' => 'localhost (ipv6)',
        '127.0.0.1' => 'localhost (ipv4)',
    ];
}
