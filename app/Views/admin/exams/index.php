<?= $this->include('layouts/admin_header') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-journal-text"></i> Manage Exams</h2>
    <a href="<?= base_url('/admin/exams/create') ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add New Exam
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Exam Name</th>
                        <th>Description</th>
                        <th>Subjects</th>
                        <th>Questions</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($exams)): ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted">No exams found. <a href="<?= base_url('/admin/exams/create') ?>">Create one</a></td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($exams as $exam): ?>
                            <tr>
                                <td><?= esc($exam['id']) ?></td>
                                <td><strong><?= esc($exam['exam_name']) ?></strong></td>
                                <td><?= esc($exam['description'] ?? '-') ?></td>
                                <td><span class="badge bg-info"><?= $exam['subjects_count'] ?? 0 ?></span></td>
                                <td><span class="badge bg-success"><?= $exam['questions_count'] ?? 0 ?></span></td>
                                <td>
                                    <span class="badge bg-<?= $exam['status'] === 'active' ? 'success' : 'secondary' ?>">
                                        <?= esc($exam['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= base_url('/admin/exams/edit/' . $exam['id']) ?>" class="btn btn-outline-primary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="<?= base_url('/admin/exams/toggle-status/' . $exam['id']) ?>" class="btn btn-outline-warning" title="Toggle Status">
                                            <i class="bi bi-toggle-<?= $exam['status'] === 'active' ? 'on' : 'off' ?>"></i>
                                        </a>
                                        <a href="<?= base_url('/admin/exams/delete/' . $exam['id']) ?>" class="btn btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this exam?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->include('layouts/admin_footer') ?>
