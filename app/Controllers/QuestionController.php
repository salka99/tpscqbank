<?php

namespace App\Controllers;

use App\Models\QuestionModel;
use App\Models\ExamModel;
use App\Models\SubjectModel;
use App\Models\TopicModel;

class QuestionController extends BaseController
{
    protected $questionModel;
    protected $examModel;
    protected $subjectModel;
    protected $topicModel;

    public function __construct()
    {
        $this->questionModel = new QuestionModel();
        $this->examModel = new ExamModel();
        $this->subjectModel = new SubjectModel();
        $this->topicModel = new TopicModel();
    }

    /**
     * Display questions with filters and pagination
     */
    public function index()
    {
        $perPage = 10;
        $page = $this->request->getGet('page') ?? 1;

        // Get filter parameters
        $filters = [
            'exam_id' => $this->request->getGet('exam_id'),
            'subject_id' => $this->request->getGet('subject_id'),
            'topic_id' => $this->request->getGet('topic_id'),
            'year' => $this->request->getGet('year'),
            'difficulty_level' => $this->request->getGet('difficulty_level'),
            'search' => $this->request->getGet('search'),
            'sort_by' => $this->request->getGet('sort_by') ?? 'year',
            'sort_order' => $this->request->getGet('sort_order') ?? 'DESC',
        ];

        // Remove empty filters
        $filters = array_filter($filters, function($value) {
            return $value !== null && $value !== '';
        });

        // Get filtered questions
        $result = $this->questionModel->getFilteredQuestions($filters, $perPage, $page);
        
        // Calculate pagination
        $totalPages = ceil($result['total'] / $perPage);

        // Get filter options
        $data = [
            'title' => 'Question Bank',
            'questions' => $result['questions'],
            'exams' => $this->examModel->getActiveExams(),
            'subjects' => !empty($filters['exam_id']) 
                ? $this->subjectModel->getSubjectsByExam($filters['exam_id']) 
                : [],
            'topics' => !empty($filters['subject_id']) 
                ? $this->topicModel->getTopicsBySubject($filters['subject_id']) 
                : [],
            'filters' => $filters,
            'pagination' => [
                'current_page' => $page,
                'total_pages' => $totalPages,
                'total_items' => $result['total'],
                'per_page' => $perPage,
            ],
        ];

        return view('questions/index', $data);
    }
}
