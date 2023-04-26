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
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['car_brand', 'car_name', 'color_hex', 'comments', 'car_type_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'car_brand'     => 'required|alpha_numeric_space|min_length[2]',
        'car_name'      => 'required|alpha_numeric_space',
        'color_hex'     => 'permit_empty|exact_length[6]|hex',
        'comments'      => 'permit_empty|alpha_numeric_punct',
        'car_type_id'   => 'required|is_natural_no_zero'
    ];
    
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
