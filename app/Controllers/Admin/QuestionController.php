<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\QuestionModel;
use App\Models\ExamModel;
use App\Models\SubjectModel;
use App\Models\TopicModel;
use CodeIgniter\HTTP\ResponseInterface;

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
     * Display list of questions
     */
    public function index()
    {
        $perPage = 20;
        $page = $this->request->getGet('page') ?? 1;

        $data = [
            'title' => 'Manage Questions',
            'questions' => $this->questionModel->getAllWithDetails(),
            'pager' => $this->questionModel->pager,
        ];

        return view('admin/questions/index', $data);
    }

    /**
     * Show form to create new question
     */
    public function create()
    {
        $data = [
            'title' => 'Add New Question',
            'exams' => $this->examModel->getActiveExams(),
            'subjects' => [],
            'topics' => [],
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/questions/create', $data);
    }

    /**
     * Store new question
     */
    public function store()
    {
        $rules = [
            'exam_id' => 'required|integer|is_not_unique[exams.id]',
            'subject_id' => 'required|integer|is_not_unique[subjects.id]',
            'topic_id' => 'required|integer|is_not_unique[topics.id]',
            'question_text' => 'required|min_length[10]',
            'answer_text' => 'required|min_length[5]',
            'explanation' => 'permit_empty',
            'year' => 'required|integer|greater_than[1900]|less_than_equal_to[' . date('Y') . ']',
            'difficulty_level' => 'required|in_list[Easy,Medium,Hard]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'exam_id' => $this->request->getPost('exam_id'),
            'subject_id' => $this->request->getPost('subject_id'),
            'topic_id' => $this->request->getPost('topic_id'),
            'question_text' => $this->request->getPost('question_text'),
            'answer_text' => $this->request->getPost('answer_text'),
            'explanation' => $this->request->getPost('explanation'),
            'year' => $this->request->getPost('year'),
            'difficulty_level' => $this->request->getPost('difficulty_level'),
        ];

        if ($this->questionModel->insert($data)) {
            return redirect()->to('/admin/questions')->with('success', 'Question created successfully!');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to create question. Please try again.');
    }

    /**
     * Show form to edit question
     */
    public function edit($id)
    {
        $question = $this->questionModel->getQuestionWithDetails($id);

        if (!$question) {
            return redirect()->to('/admin/questions')->with('error', 'Question not found.');
        }

        $data = [
            'title' => 'Edit Question',
            'question' => $question,
            'exams' => $this->examModel->getActiveExams(),
            'subjects' => $this->subjectModel->getSubjectsByExam($question['exam_id']),
            'topics' => $this->topicModel->getTopicsBySubject($question['subject_id']),
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/questions/edit', $data);
    }

    /**
     * Update question
     */
    public function update($id)
    {
        $question = $this->questionModel->find($id);

        if (!$question) {
            return redirect()->to('/admin/questions')->with('error', 'Question not found.');
        }

        $rules = [
            'exam_id' => 'required|integer|is_not_unique[exams.id]',
            'subject_id' => 'required|integer|is_not_unique[subjects.id]',
            'topic_id' => 'required|integer|is_not_unique[topics.id]',
            'question_text' => 'required|min_length[10]',
            'answer_text' => 'required|min_length[5]',
            'explanation' => 'permit_empty',
            'year' => 'required|integer|greater_than[1900]|less_than_equal_to[' . date('Y') . ']',
            'difficulty_level' => 'required|in_list[Easy,Medium,Hard]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'exam_id' => $this->request->getPost('exam_id'),
            'subject_id' => $this->request->getPost('subject_id'),
            'topic_id' => $this->request->getPost('topic_id'),
            'question_text' => $this->request->getPost('question_text'),
            'answer_text' => $this->request->getPost('answer_text'),
            'explanation' => $this->request->getPost('explanation'),
            'year' => $this->request->getPost('year'),
            'difficulty_level' => $this->request->getPost('difficulty_level'),
        ];

        if ($this->questionModel->update($id, $data)) {
            return redirect()->to('/admin/questions')->with('success', 'Question updated successfully!');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to update question. Please try again.');
    }

    /**
     * Delete question (soft delete)
     */
    public function delete($id)
    {
        $question = $this->questionModel->find($id);

        if (!$question) {
            return redirect()->to('/admin/questions')->with('error', 'Question not found.');
        }

        if ($this->questionModel->delete($id)) {
            return redirect()->to('/admin/questions')->with('success', 'Question deleted successfully!');
        }

        return redirect()->to('/admin/questions')->with('error', 'Failed to delete question. Please try again.');
    }
}
