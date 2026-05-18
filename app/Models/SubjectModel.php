<?php

namespace App\Models;

use CodeIgniter\Model;

class SubjectModel extends Model
{
    protected $table            = 'subjects';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['subject_name', 'exam_id', 'status'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'subject_name' => 'required|min_length[2]|max_length[255]',
        'exam_id'      => 'required|integer|is_not_unique[exams.id]',
        'status'       => 'required|in_list[active,inactive]',
    ];

    protected $validationMessages = [
        'subject_name' => [
            'required'   => 'Subject name is required',
            'min_length' => 'Subject name must be at least 2 characters',
            'max_length' => 'Subject name cannot exceed 255 characters',
        ],
        'exam_id' => [
            'required'        => 'Exam is required',
            'integer'         => 'Invalid exam selection',
            'is_not_unique'   => 'Selected exam does not exist',
        ],
        'status' => [
            'required' => 'Status is required',
            'in_list'  => 'Status must be either active or inactive',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;

    /**
     * Get subjects by exam ID
     */
    public function getSubjectsByExam($examId)
    {
        return $this->where('exam_id', $examId)
            ->where('status', 'active')
            ->findAll();
    }

    /**
     * Get subject with exam details
     */
    public function getSubjectWithExam($subjectId)
    {
        return $this->select('subjects.*, exams.exam_name')
            ->join('exams', 'exams.id = subjects.exam_id')
            ->where('subjects.id', $subjectId)
            ->first();
    }

    /**
     * Get all subjects with exam names
     */
    public function getAllWithExams()
    {
        return $this->select('subjects.*, exams.exam_name')
            ->join('exams', 'exams.id = subjects.exam_id')
            ->orderBy('exams.exam_name', 'ASC')
            ->orderBy('subjects.subject_name', 'ASC')
            ->findAll();
    }
}
