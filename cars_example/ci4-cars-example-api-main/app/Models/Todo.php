<?php

namespace App\Models;

use CodeIgniter\Model;

class Todo extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'todos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["todo_name", "todo_description", "categoryId", "todo_priorityNr"];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        "todo_name" => "required|alpha_numeric_space|min_length[3]",
        "todo_description" => "required|alpha_numeric_space|min_length[15]",
        "categoryId" => "required|numeric",
        "todo_priorityNr" => "required|numeric",

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

    public function getFiltered($filter) {

        // Prepare return
        $return = array();

        // Set query with builder
        $builder = $this->db->table($this->table);

        // Set limit & offset
        if (!empty($filter['limit'])) {

            if (!empty($filter['offset'])) {
                $builder->limit($filter['limit'], $filter['offset']);
            }
            else {
                $builder->limit($filter['limit']);
            }

        }

        
        // Set order by
        if (!empty($filter['order'])) {
            $builder->orderBy($filter['order']);
        }


        // Check specific: car_type_id
        if (!empty($filter['car_type_id'])) {
            $builder->where('car_type_id', $filter['car_type_id']);
        }


        // Get data
        $query = $builder->get();

        // Get count all
       
        // Prepare data
        $return['total'] = $builder->countAll();
        $return['data'] = array();
        foreach ($query->getResultArray() as $row) {
            $return['data'][$row[$this->primaryKey]] = $row;
        }
        
        // Return data
        return $return;

    }

}


