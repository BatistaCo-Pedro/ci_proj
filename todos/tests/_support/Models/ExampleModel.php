<?php

namespace Tests\Support\Models;

use CodeIgniter\Model;

class ExampleModel extends Model
{
    protected $table            = 'todos';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = ["todo_name", "todo_description", "categoryId", "todo_priorityNr", "private_todo"];

    protected $useTimestamps = true;
    protected $validationRules = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
}
