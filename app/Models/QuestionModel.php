<?php

namespace App\Models;

use CodeIgniter\Model;

class QuestionModel extends Model
{
    protected $table            = 'questions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'exam_id',
        'subject_id',
        'topic_id',
        'question_text',
        'answer_text',
        'explanation',
        'year',
        'difficulty_level',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'exam_id'         => 'required|integer|is_not_unique[exams.id]',
        'subject_id'      => 'required|integer|is_not_unique[subjects.id]',
        'topic_id'        => 'required|integer|is_not_unique[topics.id]',
        'question_text'   => 'required|min_length[10]',
        'answer_text'     => 'required|min_length[5]',
        'year'            => 'required|integer|validYear',
        'difficulty_level' => 'required|in_list[Easy,Medium,Hard]',
    ];

    protected $validationMessages = [
        'exam_id' => [
            'required'      => 'Exam is required',
            'integer'       => 'Invalid exam selection',
            'is_not_unique' => 'Selected exam does not exist',
        ],
        'subject_id' => [
            'required'      => 'Subject is required',
            'integer'       => 'Invalid subject selection',
            'is_not_unique' => 'Selected subject does not exist',
        ],
        'topic_id' => [
            'required'      => 'Topic is required',
            'integer'       => 'Invalid topic selection',
            'is_not_unique' => 'Selected topic does not exist',
        ],
        'question_text' => [
            'required'   => 'Question text is required',
            'min_length' => 'Question text must be at least 10 characters',
        ],
        'answer_text' => [
            'required'   => 'Answer text is required',
            'min_length' => 'Answer text must be at least 5 characters',
        ],
        'year' => [
            'required'              => 'Year is required',
            'integer'               => 'Year must be a valid number',
            'greater_than'          => 'Year must be greater than 1900',
            'less_than_equal_to'    => 'Year cannot be in the future',
        ],
        'difficulty_level' => [
            'required' => 'Difficulty level is required',
            'in_list'  => 'Difficulty level must be Easy, Medium, or Hard',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;

    /**
     * Get question with full details (exam, subject, topic)
     */
    public function getQuestionWithDetails($questionId)
    {
        return $this->select('questions.*, exams.exam_name, subjects.subject_name, topics.topic_name')
            ->join('exams', 'exams.id = questions.exam_id')
            ->join('subjects', 'subjects.id = questions.subject_id')
            ->join('topics', 'topics.id = questions.topic_id')
            ->where('questions.id', $questionId)
            ->first();
    }

    /**
     * Get filtered questions with pagination
     * 
     * @param array $filters Filter parameters
     * @param int $perPage Items per page
     * @param int $page Current page
     * @return array
     */
    public function getFilteredQuestions($filters = [], $perPage = 10, $page = 1)
    {
        $builder = $this->select('questions.*, exams.exam_name, subjects.subject_name, topics.topic_name')
            ->join('exams', 'exams.id = questions.exam_id')
            ->join('subjects', 'subjects.id = questions.subject_id')
            ->join('topics', 'topics.id = questions.topic_id');

        // Apply filters
        if (!empty($filters['exam_id'])) {
            $builder->where('questions.exam_id', $filters['exam_id']);
        }

        if (!empty($filters['subject_id'])) {
            $builder->where('questions.subject_id', $filters['subject_id']);
        }

        if (!empty($filters['topic_id'])) {
            $builder->where('questions.topic_id', $filters['topic_id']);
        }

        if (!empty($filters['year'])) {
            $builder->where('questions.year', $filters['year']);
        }

        if (!empty($filters['difficulty_level'])) {
            $builder->where('questions.difficulty_level', $filters['difficulty_level']);
        }

        // Search in question_text and answer_text
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $builder->groupStart()
                ->like('questions.question_text', $search)
                ->orLike('questions.answer_text', $search)
                ->groupEnd();
        }

        // Get total count before applying sorting and pagination
        $total = $builder->countAllResults(false);

        // Apply sorting
        $sortBy = $filters['sort_by'] ?? 'year';
        $sortOrder = $filters['sort_order'] ?? 'DESC';
        $builder->orderBy('questions.' . $sortBy, $sortOrder);

        // Apply pagination
        $offset = ($page - 1) * $perPage;
        $questions = $builder->limit($perPage, $offset)->findAll();

        return [
            'questions' => $questions,
            'total'     => $total,
            'per_page'  => $perPage,
            'page'      => $page,
        ];
    }

    /**
     * Get all questions with details
     */
    public function getAllWithDetails()
    {
        return $this->select('questions.*, exams.exam_name, subjects.subject_name, topics.topic_name')
            ->join('exams', 'exams.id = questions.exam_id')
            ->join('subjects', 'subjects.id = questions.subject_id')
            ->join('topics', 'topics.id = questions.topic_id')
            ->orderBy('questions.year', 'DESC')
            ->orderBy('questions.id', 'DESC')
            ->findAll();
    }
}
