<?= $this->include('layouts/admin_header') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-pencil"></i> Edit Topic</h2>
    <a href="<?= base_url('/admin/topics') ?>" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>
<?php $errors = session()->getFlashdata('errors') ?? []; ?>

<div class="card">
    <div class="card-body">
        <form action="<?= base_url('/admin/topics/update/' . $topic['id']) ?>" method="POST">
            <?= csrf_field() ?>
            
            <div class="mb-3">
                <label for="exam_id" class="form-label">Exam <span class="text-danger">*</span></label>
                <select class="form-select" id="exam_id" name="exam_id" required>
                    <option value="">Select Exam</option>
                    <?php foreach ($exams as $exam): ?>
                        <option value="<?= $exam['id'] ?>" <?= old('exam_id', $topic['exam_id']) == $exam['id'] ? 'selected' : '' ?>>
                            <?= esc($exam['exam_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="subject_id" class="form-label">Subject <span class="text-danger">*</span></label>
                <select class="form-select" id="subject_id" name="subject_id" required>
                    <option value="">Select Subject</option>
                    <?php foreach ($subjects as $subject): ?>
                        <option value="<?= $subject['id'] ?>" <?= old('subject_id', $topic['subject_id']) == $subject['id'] ? 'selected' : '' ?>>
                            <?= esc($subject['subject_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="topic_name" class="form-label">Topic Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control <?= isset($errors['topic_name']) ? 'is-invalid' : '' ?>" 
                       id="topic_name" name="topic_name" value="<?= old('topic_name', $topic['topic_name']) ?>" required>
                <?php if (isset($errors['topic_name'])): ?>
                    <div class="invalid-feedback"><?= $errors['topic_name'] ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                <select class="form-select" id="status" name="status" required>
                    <option value="active" <?= old('status', $topic['status']) === 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="inactive" <?= old('status', $topic['status']) === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                </select>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="<?= base_url('/admin/topics') ?>" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Update Topic
                </button>
            </div>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    // Load subjects when exam is selected
    $('#exam_id').on('change', function() {
        var examId = $(this).val();
        var subjectSelect = $('#subject_id');
        
        subjectSelect.html('<option value="">Loading...</option>');
        
        if (examId) {
            $.get('<?= base_url('/admin/subjects/get-by-exam') ?>', { exam_id: examId }, function(data) {
                subjectSelect.html('<option value="">Select Subject</option>');
                $.each(data, function(key, value) {
                    var selected = value.id == <?= $topic['subject_id'] ?> ? 'selected' : '';
                    subjectSelect.append('<option value="' + value.id + '" ' + selected + '>' + value.subject_name + '</option>');
                });
            });
        } else {
            subjectSelect.html('<option value="">Select Subject (Choose Exam First)</option>');
        }
    });
    
    // Trigger change if exam is already selected
    if ($('#exam_id').val()) {
        $('#exam_id').trigger('change');
    }
});
</script>

<?= $this->include('layouts/admin_footer') ?>
