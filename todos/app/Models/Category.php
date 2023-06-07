<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\BaseResult;

class Category extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'categories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["cat_name"];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = ["cat_name" => "required|alpha_numeric_space|min_length[3]"];
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

    public function hasTodosAssociated($id) {
        $builder = $this->db->table("todos");

        $query = $builder->getWhere(["categoryId" => $id]);

        if(empty($query->getRow())) return false;
        log_message("debug", strval($query->getRow()->todo_name));
        
        return true;
    }

}
