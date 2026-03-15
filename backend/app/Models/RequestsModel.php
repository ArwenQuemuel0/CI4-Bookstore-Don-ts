<?php

namespace App\Models;

use CodeIgniter\Model;

class RequestsModel extends Model
{
    protected $table            = 'requests';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = '\App\Entities\Request';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'requester_name',
        'requested_data',
        'status',
        'message',
        'created_at',
        'updated_at'
    ];
    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Timestamps
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    // Validation (optional)
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
}
