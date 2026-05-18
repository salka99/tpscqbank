<?= $this->include('layouts/admin_header') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-plus-circle"></i> Add New Subject</h2>
    <a href="<?= base_url('/admin/subjects') ?>" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>
<?php $errors = session()->getFlashdata('errors') ?? []; ?>

<div class="card">
    <div class="card-body">
        <form action="<?= base_url('/admin/subjects/store') ?>" method="POST">
            <?= csrf_field() ?>
            
            <div class="mb-3">
                <label for="exam_id" class="form-label">Exam <span class="text-danger">*</span></label>
                <select class="form-select" id="exam_id" name="exam_id" required>
                    <option value="">Select Exam</option>
                    <?php foreach ($exams as $exam): ?>
                        <option value="<?= $exam['id'] ?>" <?= old('exam_id') == $exam['id'] ? 'selected' : '' ?>>
                            <?= esc($exam['exam_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
    <label for="subject_name" class="form-label">
        Subject Name <span class="text-danger">*</span>
    </label>

    <input type="text"
           class="form-control <?= isset($errors['subject_name']) ? 'is-invalid' : '' ?>"
           id="subject_name"
           name="subject_name"
           value="<?= old('subject_name') ?>"
           required>

    <?php if (isset($errors['subject_name'])): ?>
        <div class="invalid-feedback">
            <?= esc($errors['subject_name']) ?>
        </div>
    <?php endif; ?>
</div>


            <div class="mb-3">
                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                <select class="form-select" id="status" name="status" required>
                    <option value="active" <?= old('status') === 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="inactive" <?= old('status') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                </select>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="<?= base_url('/admin/subjects') ?>" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Create Subject
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->include('layouts/admin_footer') ?>
