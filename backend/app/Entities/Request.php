<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Request extends Entity
{
    protected $datamap = [];

    // Fields automatically treated as datetime objects
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    // Optional casting for data types
    protected $casts = [
        'id'        => 'int',
        'user_id'   => 'int'
    ];
}
