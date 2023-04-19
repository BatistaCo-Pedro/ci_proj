<?php

namespace App\Models;

use CodeIgniter\Model;

class Cars extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'cars';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['car_brand', 'car_name', 'color_hex', 'comments', 'car_type_id'];
    
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    
    // Validation
    protected $validationRules      = [
        'car_brand'     => 'required|alpha_numeric_space|'
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}
