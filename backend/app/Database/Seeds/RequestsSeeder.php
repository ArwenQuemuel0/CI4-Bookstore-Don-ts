<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RequestsSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $data = [
            [
                'requester_name' => 'Andrew Sam',
                'requested_data' => 'Can you please add more Japanese mythology books?',
                'status'         => 'pending',
                'message'        => 'I love folklore books!',
                'created_at'     => $now,
                'updated_at'     => $now,
            ]
        ];

        $this->db->table('requests')->insertBatch($data);
    }
}
