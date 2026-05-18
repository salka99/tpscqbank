<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TopicSeeder extends Seeder
{
    public function run()
    {
        // Get subject IDs
        $subjects = $this->db->table('subjects')->get()->getResultArray();
        $subjectMap = [];
        foreach ($subjects as $subject) {
            $key = $subject['exam_id'] . '_' . $subject['subject_name'];
            $subjectMap[$key] = $subject['id'];
        }

        $data = [
            // General Studies Topics
            [
                'topic_name' => 'Indian Polity',
                'subject_id' => $subjectMap['1_General Studies'] ?? 1,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'topic_name' => 'Indian Economy',
                'subject_id' => $subjectMap['1_General Studies'] ?? 1,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'topic_name' => 'Science & Technology',
                'subject_id' => $subjectMap['1_General Studies'] ?? 1,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            // History Topics
            [
                'topic_name' => 'Ancient History',
                'subject_id' => $subjectMap['1_History'] ?? 2,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'topic_name' => 'Medieval History',
                'subject_id' => $subjectMap['1_History'] ?? 2,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'topic_name' => 'Modern History',
                'subject_id' => $subjectMap['1_History'] ?? 2,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            // Quantitative Aptitude Topics
            [
                'topic_name' => 'Number System',
                'subject_id' => $subjectMap['2_Quantitative Aptitude'] ?? 4,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'topic_name' => 'Percentage',
                'subject_id' => $subjectMap['2_Quantitative Aptitude'] ?? 4,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'topic_name' => 'Profit & Loss',
                'subject_id' => $subjectMap['2_Quantitative Aptitude'] ?? 4,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            // Reasoning Topics
            [
                'topic_name' => 'Blood Relations',
                'subject_id' => $subjectMap['3_Reasoning'] ?? 7,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'topic_name' => 'Syllogism',
                'subject_id' => $subjectMap['3_Reasoning'] ?? 7,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'topic_name' => 'Coding-Decoding',
                'subject_id' => $subjectMap['3_Reasoning'] ?? 7,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('topics')->insertBatch($data);
    }
}
