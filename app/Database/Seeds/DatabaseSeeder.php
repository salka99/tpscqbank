<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Run seeders in order
        $this->call('ExamSeeder');
        $this->call('SubjectSeeder');
        $this->call('TopicSeeder');
        $this->call('QuestionSeeder');
        
        echo "Database seeded successfully!\n";
    }
}
