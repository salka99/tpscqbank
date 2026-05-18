<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TopicModel;
use App\Models\SubjectModel;
use App\Models\ExamModel;
use CodeIgniter\HTTP\ResponseInterface;

class TopicController extends BaseController
{
    protected $topicModel;
    protected $subjectModel;
    protected $examModel;

    public function __construct()
    {
        $this->topicModel = new TopicModel();
        $this->subjectModel = new SubjectModel();
        $this->examModel = new ExamModel();
    }

    /**
     * Display list of topics
     */
    public function index()
    {
        $data = [
            'title' => 'Manage Topics',
            'topics' => $this->topicModel->getAllWithHierarchy(),
        ];

        return view('admin/topics/index', $data);
    }

    /**
     * Show form to create new topic
     */
    public function create()
    {
        $data = [
            'title' => 'Add New Topic',
            'exams' => $this->examModel->getActiveExams(),
            'subjects' => [],
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/topics/create', $data);
    }

    /**
     * Store new topic
     */
    public function store()
    {
        $rules = [
            'topic_name' => 'required|min_length[2]|max_length[255]',
            'subject_id' => 'required|integer|is_not_unique[subjects.id]',
            'status' => 'required|in_list[active,inactive]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'topic_name' => $this->request->getPost('topic_name'),
            'subject_id' => $this->request->getPost('subject_id'),
            'status' => $this->request->getPost('status'),
        ];

        if ($this->topicModel->insert($data)) {
            return redirect()->to('/admin/topics')->with('success', 'Topic created successfully!');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to create topic. Please try again.');
    }

    /**
     * Show form to edit topic
     */
    public function edit($id)
    {
        $topic = $this->topicModel->getTopicWithDetails($id);

        if (!$topic) {
            return redirect()->to('/admin/topics')->with('error', 'Topic not found.');
        }

        $data = [
            'title' => 'Edit Topic',
            'topic' => $topic,
            'exams' => $this->examModel->getActiveExams(),
            'subjects' => $this->subjectModel->getSubjectsByExam($topic['exam_id']),
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/topics/edit', $data);
    }

    /**
     * Update topic
     */
    public function update($id)
    {
        $topic = $this->topicModel->find($id);

        if (!$topic) {
            return redirect()->to('/admin/topics')->with('error', 'Topic not found.');
        }

        $rules = [
            'topic_name' => 'required|min_length[2]|max_length[255]',
            'subject_id' => 'required|integer|is_not_unique[subjects.id]',
            'status' => 'required|in_list[active,inactive]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'topic_name' => $this->request->getPost('topic_name'),
            'subject_id' => $this->request->getPost('subject_id'),
            'status' => $this->request->getPost('status'),
        ];

        if ($this->topicModel->update($id, $data)) {
            return redirect()->to('/admin/topics')->with('success', 'Topic updated successfully!');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to update topic. Please try again.');
    }

    /**
     * Delete topic (soft delete)
     */
    public function delete($id)
    {
        $topic = $this->topicModel->find($id);

        if (!$topic) {
            return redirect()->to('/admin/topics')->with('error', 'Topic not found.');
        }

        if ($this->topicModel->delete($id)) {
            return redirect()->to('/admin/topics')->with('success', 'Topic deleted successfully!');
        }

        return redirect()->to('/admin/topics')->with('error', 'Failed to delete topic. Please try again.');
    }

    /**
     * Get topics by subject (AJAX endpoint for dependent dropdown)
     */
    public function getBySubject()
    {
        $subjectId = $this->request->getGet('subject_id');
        
        if (!$subjectId) {
            return $this->response->setJSON([]);
        }

        $topics = $this->topicModel->getTopicsBySubject($subjectId);
        return $this->response->setJSON($topics);
    }
}
