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
    protected $allowedFields    = ["todo_name", "todo_description", "categoryId", "todo_priorityNr", "private_todo"];

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

    protected function setFilters($filter) {
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

        return $builder;
    }

    public function getFiltered($filter) {
        // Prepare return
        $return = array();

        $builder = $this->setFilters($filter);
        
        // Get data
        $query = $builder->getWhere(["private_todo" => false]);

        // Get count all
       
        // Prepare data
        $return['total'] = 0;
        $return['data'] = array();
        foreach ($query->getResultArray() as $row) {
            $return['total'] += 1;
            $return['data'][$row[$this->primaryKey]] = $row;
        }
        
        // Return data
        return $return;
    }

    public function get_private_Filtered($filter) {
        // Prepare return
        $return = array();
    
        $builder = $this->setFilters($filter);
    
        // Get data
        $query = $builder->getWhere(["private_todo" => true]);
    
        // Get count all
    
        // Prepare data
        $return['total'] = 0;
        $return['data'] = array();
        foreach ($query->getResultArray() as $row) {
            $return['total'] += 1;
            $return['data'][$row[$this->primaryKey]] = $row;
        }
    
        // Return data
        return $return;
    }
}