<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SubjectModel;
use App\Models\ExamModel;
use CodeIgniter\HTTP\ResponseInterface;

class SubjectController extends BaseController
{
    protected $subjectModel;
    protected $examModel;

    public function __construct()
    {
        $this->subjectModel = new SubjectModel();
        $this->examModel = new ExamModel();
    }

    /**
     * Display list of subjects
     */
    public function index()
    {
        $data = [
            'title' => 'Manage Subjects',
            'subjects' => $this->subjectModel->getAllWithExams(),
        ];

        return view('admin/subjects/index', $data);
    }

    /**
     * Show form to create new subject
     */
    public function create()
    {
        $data = [
            'title' => 'Add New Subject',
            'exams' => $this->examModel->getActiveExams(),
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/subjects/create', $data);
    }

    /**
     * Store new subject
     */
    public function store()
    {
        $rules = [
            'subject_name' => 'required|min_length[2]|max_length[255]',
            'exam_id' => 'required|integer|is_not_unique[exams.id]',
            'status' => 'required|in_list[active,inactive]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'subject_name' => $this->request->getPost('subject_name'),
            'exam_id' => $this->request->getPost('exam_id'),
            'status' => $this->request->getPost('status'),
        ];

        if ($this->subjectModel->insert($data)) {
            return redirect()->to('/admin/subjects')->with('success', 'Subject created successfully!');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to create subject. Please try again.');
    }

    /**
     * Show form to edit subject
     */
    public function edit($id)
    {
        $subject = $this->subjectModel->find($id);

        if (!$subject) {
            return redirect()->to('/admin/subjects')->with('error', 'Subject not found.');
        }

        $data = [
            'title' => 'Edit Subject',
            'subject' => $subject,
            'exams' => $this->examModel->getActiveExams(),
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/subjects/edit', $data);
    }

    /**
     * Update subject
     */
    public function update($id)
    {
        $subject = $this->subjectModel->find($id);

        if (!$subject) {
            return redirect()->to('/admin/subjects')->with('error', 'Subject not found.');
        }

        $rules = [
            'subject_name' => 'required|min_length[2]|max_length[255]',
            'exam_id' => 'required|integer|is_not_unique[exams.id]',
            'status' => 'required|in_list[active,inactive]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'subject_name' => $this->request->getPost('subject_name'),
            'exam_id' => $this->request->getPost('exam_id'),
            'status' => $this->request->getPost('status'),
        ];

        if ($this->subjectModel->update($id, $data)) {
            return redirect()->to('/admin/subjects')->with('success', 'Subject updated successfully!');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to update subject. Please try again.');
    }

    /**
     * Delete subject (soft delete)
     */
    public function delete($id)
    {
        $subject = $this->subjectModel->find($id);

        if (!$subject) {
            return redirect()->to('/admin/subjects')->with('error', 'Subject not found.');
        }

        if ($this->subjectModel->delete($id)) {
            return redirect()->to('/admin/subjects')->with('success', 'Subject deleted successfully!');
        }

        return redirect()->to('/admin/subjects')->with('error', 'Failed to delete subject. Please try again.');
    }

    /**
     * Get subjects by exam (AJAX endpoint for dependent dropdown)
     */
    public function getByExam()
    {
        $examId = $this->request->getGet('exam_id');
        
        if (!$examId) {
            return $this->response->setJSON([]);
        }

        $subjects = $this->subjectModel->getSubjectsByExam($examId);
        return $this->response->setJSON($subjects);
    }
}
