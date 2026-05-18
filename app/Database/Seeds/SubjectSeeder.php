<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run()
    {
        // Get exam IDs
        $exams = $this->db->table('exams')->get()->getResultArray();
        $examMap = [];
        foreach ($exams as $exam) {
            $examMap[$exam['exam_name']] = $exam['id'];
        }

        $data = [
            // UPSC Subjects
            [
                'subject_name' => 'General Studies',
                'exam_id' => $examMap['UPSC Civil Services'] ?? 1,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'subject_name' => 'History',
                'exam_id' => $examMap['UPSC Civil Services'] ?? 1,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'subject_name' => 'Geography',
                'exam_id' => $examMap['UPSC Civil Services'] ?? 1,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            // SSC CGL Subjects
            [
                'subject_name' => 'Quantitative Aptitude',
                'exam_id' => $examMap['SSC CGL'] ?? 2,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'subject_name' => 'English',
                'exam_id' => $examMap['SSC CGL'] ?? 2,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'subject_name' => 'General Knowledge',
                'exam_id' => $examMap['SSC CGL'] ?? 2,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            // Banking PO Subjects
            [
                'subject_name' => 'Reasoning',
                'exam_id' => $examMap['Banking PO'] ?? 3,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'subject_name' => 'Quantitative Aptitude',
                'exam_id' => $examMap['Banking PO'] ?? 3,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'subject_name' => 'English Language',
                'exam_id' => $examMap['Banking PO'] ?? 3,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('subjects')->insertBatch($data);
    }
}
