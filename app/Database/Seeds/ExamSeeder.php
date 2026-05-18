<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ExamSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'exam_name' => 'UPSC Civil Services',
                'description' => 'Union Public Service Commission Civil Services Examination',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'exam_name' => 'SSC CGL',
                'description' => 'Staff Selection Commission Combined Graduate Level',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'exam_name' => 'Banking PO',
                'description' => 'Banking Probationary Officer Examination',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'exam_name' => 'Railway NTPC',
                'description' => 'Railway Non-Technical Popular Categories',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('exams')->insertBatch($data);
    }
}
