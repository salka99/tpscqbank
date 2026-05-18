<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ExamModel;
use CodeIgniter\HTTP\ResponseInterface;

class ExamController extends BaseController
{
    protected $examModel;

    public function __construct()
    {
        $this->examModel = new ExamModel();
    }

    /**
     * Display list of exams
     */
    public function index()
    {
        $data = [
            'title' => 'Manage Exams',
            'exams' => $this->examModel->getExamWithCounts(),
        ];

        return view('admin/exams/index', $data);
    }

    /**
     * Show form to create new exam
     */
    public function create()
    {
        $data = [
            'title' => 'Add New Exam',
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/exams/create', $data);
    }

    /**
     * Store new exam
     */
    public function store()
    {
        $rules = [
            'exam_name' => 'required|min_length[3]|max_length[255]|is_unique[exams.exam_name]',
            'description' => 'permit_empty',
            'status' => 'required|in_list[active,inactive]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'exam_name' => $this->request->getPost('exam_name'),
            'description' => $this->request->getPost('description'),
            'status' => $this->request->getPost('status'),
        ];

        if ($this->examModel->insert($data)) {
            return redirect()->to('/admin/exams')->with('success', 'Exam created successfully!');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to create exam. Please try again.');
    }

    /**
     * Show form to edit exam
     */
    public function edit($id)
    {
        $exam = $this->examModel->find($id);

        if (!$exam) {
            return redirect()->to('/admin/exams')->with('error', 'Exam not found.');
        }

        $data = [
            'title' => 'Edit Exam',
            'exam' => $exam,
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/exams/edit', $data);
    }

    /**
     * Update exam
     */
    public function update($id)
    {
        $exam = $this->examModel->find($id);

        if (!$exam) {
            return redirect()->to('/admin/exams')->with('error', 'Exam not found.');
        }

        $rules = [
            'exam_name' => "required|min_length[3]|max_length[255]|is_unique[exams.exam_name,id,{$id}]",
            'description' => 'permit_empty',
            'status' => 'required|in_list[active,inactive]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'exam_name' => $this->request->getPost('exam_name'),
            'description' => $this->request->getPost('description'),
            'status' => $this->request->getPost('status'),
        ];

        if ($this->examModel->update($id, $data)) {
            return redirect()->to('/admin/exams')->with('success', 'Exam updated successfully!');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to update exam. Please try again.');
    }

    /**
     * Delete exam (soft delete)
     */
    public function delete($id)
    {
        $exam = $this->examModel->find($id);

        if (!$exam) {
            return redirect()->to('/admin/exams')->with('error', 'Exam not found.');
        }

        if ($this->examModel->delete($id)) {
            return redirect()->to('/admin/exams')->with('success', 'Exam deleted successfully!');
        }

        return redirect()->to('/admin/exams')->with('error', 'Failed to delete exam. Please try again.');
    }

    /**
     * Toggle exam status
     */
    public function toggleStatus($id)
    {
        $exam = $this->examModel->find($id);

        if (!$exam) {
            return redirect()->to('/admin/exams')->with('error', 'Exam not found.');
        }

        $newStatus = $exam['status'] === 'active' ? 'inactive' : 'active';
        
        if ($this->examModel->update($id, ['status' => $newStatus])) {
            return redirect()->to('/admin/exams')->with('success', 'Exam status updated successfully!');
        }

        return redirect()->to('/admin/exams')->with('error', 'Failed to update exam status.');
    }
}
