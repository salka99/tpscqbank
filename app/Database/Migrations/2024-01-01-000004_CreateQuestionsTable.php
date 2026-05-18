<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateQuestionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'exam_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'subject_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'topic_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'question_text' => [
                'type' => 'TEXT',
            ],
            'answer_text' => [
                'type' => 'TEXT',
            ],
            'explanation' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'year' => [
                'type'       => 'INT',
                'constraint' => 4,
            ],
            'difficulty_level' => [
                'type'       => 'ENUM',
                'constraint' => ['Easy', 'Medium', 'Hard'],
                'default'    => 'Medium',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('exam_id');
        $this->forge->addKey('subject_id');
        $this->forge->addKey('topic_id');
        $this->forge->addKey('year');
        $this->forge->addForeignKey('exam_id', 'exams', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('subject_id', 'subjects', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('topic_id', 'topics', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('questions');
    }

    public function down()
    {
        $this->forge->dropTable('questions');
    }
}
