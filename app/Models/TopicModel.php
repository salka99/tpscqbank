<?php

namespace App\Models;

use CodeIgniter\Model;

class TopicModel extends Model
{
    protected $table            = 'topics';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['topic_name', 'subject_id', 'status'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'topic_name' => 'required|min_length[2]|max_length[255]',
        'subject_id' => 'required|integer|is_not_unique[subjects.id]',
        'status'     => 'required|in_list[active,inactive]',
    ];

    protected $validationMessages = [
        'topic_name' => [
            'required'   => 'Topic name is required',
            'min_length' => 'Topic name must be at least 2 characters',
            'max_length' => 'Topic name cannot exceed 255 characters',
        ],
        'subject_id' => [
            'required'      => 'Subject is required',
            'integer'       => 'Invalid subject selection',
            'is_not_unique' => 'Selected subject does not exist',
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
     * Get topics by subject ID
     */
    public function getTopicsBySubject($subjectId)
    {
        return $this->where('subject_id', $subjectId)
            ->where('status', 'active')
            ->findAll();
    }

    /**
     * Get topic with subject and exam details
     */
    public function getTopicWithDetails($topicId)
    {
        return $this->select('topics.*, subjects.subject_name, subjects.exam_id, exams.exam_name')
            ->join('subjects', 'subjects.id = topics.subject_id')
            ->join('exams', 'exams.id = subjects.exam_id')
            ->where('topics.id', $topicId)
            ->first();
    }

    /**
     * Get all topics with full hierarchy
     */
    public function getAllWithHierarchy()
    {
        return $this->select('topics.*, subjects.subject_name, subjects.exam_id, exams.exam_name')
            ->join('subjects', 'subjects.id = topics.subject_id')
            ->join('exams', 'exams.id = subjects.exam_id')
            ->orderBy('exams.exam_name', 'ASC')
            ->orderBy('subjects.subject_name', 'ASC')
            ->orderBy('topics.topic_name', 'ASC')
            ->findAll();
    }
}
