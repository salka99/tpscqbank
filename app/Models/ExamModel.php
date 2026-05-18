<?php

namespace App\Models;

use CodeIgniter\Model;

class ExamModel extends Model
{
    protected $table            = 'exams';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['exam_name', 'description', 'status'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'exam_name' => 'required|min_length[3]|max_length[255]',
        'status'    => 'required|in_list[active,inactive]',
    ];

    protected $validationMessages = [
        'exam_name' => [
            'required'   => 'Exam name is required',
            'min_length' => 'Exam name must be at least 3 characters',
            'max_length' => 'Exam name cannot exceed 255 characters',
        ],
        'status' => [
            'required'  => 'Status is required',
            'in_list'   => 'Status must be either active or inactive',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Get all active exams
     */
    public function getActiveExams()
    {
        return $this->where('status', 'active')->findAll();
    }

    /**
     * Get exam with subjects count
     */
    public function getExamWithCounts()
    {
        return $this->select('exams.*, COUNT(DISTINCT subjects.id) as subjects_count, COUNT(DISTINCT questions.id) as questions_count')
            ->join('subjects', 'subjects.exam_id = exams.id', 'left')
            ->join('questions', 'questions.exam_id = exams.id', 'left')
            ->groupBy('exams.id')
            ->findAll();
    }
}
