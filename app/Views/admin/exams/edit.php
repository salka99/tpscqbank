<?= $this->include('layouts/admin_header') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-pencil"></i> Edit Exam</h2>
    <a href="<?= base_url('/admin/exams') ?>" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>
<?php $errors = session()->getFlashdata('errors') ?? []; ?>

<div class="card">
    <div class="card-body">
        <form action="<?= base_url('/admin/exams/update/' . $exam['id']) ?>" method="POST">
            <?= csrf_field() ?>
            
            <div class="mb-3">
                <label for="exam_name" class="form-label">Exam Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control <?= isset($errors['exam_name']) ? 'is-invalid' : '' ?>" 
                       id="exam_name" name="exam_name" value="<?= old('exam_name', $exam['exam_name']) ?>" required>
                <?php if (isset($errors['exam_name'])): ?>
                    <div class="invalid-feedback"><?= $errors['exam_name'] ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?= old('description', $exam['description'] ?? '') ?></textarea>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                <select class="form-select" id="status" name="status" required>
                    <option value="active" <?= old('status', $exam['status']) === 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="inactive" <?= old('status', $exam['status']) === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                </select>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="<?= base_url('/admin/exams') ?>" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Update Exam
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->include('layouts/admin_footer') ?>
