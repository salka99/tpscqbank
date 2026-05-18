<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run()
    {
        // Get IDs
        $exams = $this->db->table('exams')->get()->getResultArray();
        $subjects = $this->db->table('subjects')->get()->getResultArray();
        $topics = $this->db->table('topics')->get()->getResultArray();

        $examMap = [];
        foreach ($exams as $exam) {
            $examMap[$exam['exam_name']] = $exam['id'];
        }

        $subjectMap = [];
        foreach ($subjects as $subject) {
            $key = $subject['exam_id'] . '_' . $subject['subject_name'];
            $subjectMap[$key] = $subject['id'];
        }

        $topicMap = [];
        foreach ($topics as $topic) {
            $topicMap[$topic['subject_id'] . '_' . $topic['topic_name']] = $topic['id'];
        }

        $data = [
            [
                'exam_id' => $examMap['UPSC Civil Services'] ?? 1,
                'subject_id' => $subjectMap['1_General Studies'] ?? 1,
                'topic_id' => $topicMap[($subjectMap['1_General Studies'] ?? 1) . '_Indian Polity'] ?? 1,
                'question_text' => 'Who is known as the Father of the Indian Constitution?',
                'answer_text' => 'Dr. B.R. Ambedkar',
                'explanation' => 'Dr. B.R. Ambedkar was the chairman of the Drafting Committee of the Constituent Assembly and is widely regarded as the Father of the Indian Constitution.',
                'year' => 2023,
                'difficulty_level' => 'Easy',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'exam_id' => $examMap['UPSC Civil Services'] ?? 1,
                'subject_id' => $subjectMap['1_General Studies'] ?? 1,
                'topic_id' => $topicMap[($subjectMap['1_General Studies'] ?? 1) . '_Indian Economy'] ?? 2,
                'question_text' => 'What is the full form of GDP?',
                'answer_text' => 'Gross Domestic Product',
                'explanation' => 'GDP stands for Gross Domestic Product, which is the total monetary value of all finished goods and services produced within a country\'s borders in a specific time period.',
                'year' => 2023,
                'difficulty_level' => 'Easy',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'exam_id' => $examMap['SSC CGL'] ?? 2,
                'subject_id' => $subjectMap['2_Quantitative Aptitude'] ?? 4,
                'topic_id' => $topicMap[($subjectMap['2_Quantitative Aptitude'] ?? 4) . '_Percentage'] ?? 8,
                'question_text' => 'If 20% of a number is 50, what is 40% of that number?',
                'answer_text' => '100',
                'explanation' => 'Let the number be x. Then 20% of x = 50, so x = 250. Therefore, 40% of 250 = 100.',
                'year' => 2023,
                'difficulty_level' => 'Medium',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'exam_id' => $examMap['SSC CGL'] ?? 2,
                'subject_id' => $subjectMap['2_Quantitative Aptitude'] ?? 4,
                'topic_id' => $topicMap[($subjectMap['2_Quantitative Aptitude'] ?? 4) . '_Profit & Loss'] ?? 9,
                'question_text' => 'A shopkeeper sells an article for Rs. 1200 and makes a profit of 20%. What was the cost price of the article?',
                'answer_text' => 'Rs. 1000',
                'explanation' => 'Selling Price = Rs. 1200, Profit = 20%. Cost Price = (100/120) × 1200 = Rs. 1000.',
                'year' => 2022,
                'difficulty_level' => 'Medium',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'exam_id' => $examMap['Banking PO'] ?? 3,
                'subject_id' => $subjectMap['3_Reasoning'] ?? 7,
                'topic_id' => $topicMap[($subjectMap['3_Reasoning'] ?? 7) . '_Blood Relations'] ?? 10,
                'question_text' => 'Pointing to a man, a woman said, "His mother is the only daughter of my mother." How is the woman related to the man?',
                'answer_text' => 'Mother',
                'explanation' => 'The only daughter of the woman\'s mother is the woman herself. So, the woman is the man\'s mother.',
                'year' => 2023,
                'difficulty_level' => 'Hard',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'exam_id' => $examMap['Banking PO'] ?? 3,
                'subject_id' => $subjectMap['3_Reasoning'] ?? 7,
                'topic_id' => $topicMap[($subjectMap['3_Reasoning'] ?? 7) . '_Syllogism'] ?? 11,
                'question_text' => 'All roses are flowers. Some flowers are red. Which of the following conclusions can be drawn?',
                'answer_text' => 'Some roses may be red',
                'explanation' => 'Since all roses are flowers and some flowers are red, it is possible that some roses are red, but it is not necessarily true. The conclusion "Some roses may be red" is the most appropriate.',
                'year' => 2022,
                'difficulty_level' => 'Hard',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'exam_id' => $examMap['UPSC Civil Services'] ?? 1,
                'subject_id' => $subjectMap['1_History'] ?? 2,
                'topic_id' => $topicMap[($subjectMap['1_History'] ?? 2) . '_Modern History'] ?? 6,
                'question_text' => 'In which year did the Quit India Movement start?',
                'answer_text' => '1942',
                'explanation' => 'The Quit India Movement, also known as the August Movement, was launched by Mahatma Gandhi on 8 August 1942 during World War II.',
                'year' => 2023,
                'difficulty_level' => 'Easy',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'exam_id' => $examMap['SSC CGL'] ?? 2,
                'subject_id' => $subjectMap['2_English'] ?? 5,
                'topic_id' => $topicMap[($subjectMap['2_English'] ?? 5) . '_Grammar'] ?? null,
                'question_text' => 'Choose the correct form: "Neither the students nor the teacher _____ present."',
                'answer_text' => 'was',
                'explanation' => 'When using "neither...nor", the verb agrees with the subject closest to it. Since "teacher" is singular, we use "was".',
                'year' => 2023,
                'difficulty_level' => 'Medium',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Filter out entries with null topic_id
        $data = array_filter($data, function($item) {
            return $item['topic_id'] !== null;
        });

        $this->db->table('questions')->insertBatch($data);
    }
}
