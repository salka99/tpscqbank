<?= $this->include('layouts/admin_header') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-book"></i> Manage Subjects</h2>
    <a href="<?= base_url('/admin/subjects/create') ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add New Subject
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Subject Name</th>
                        <th>Exam</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sl=1; if (empty($subjects)): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">No subjects found. <a href="<?= base_url('/admin/subjects/create') ?>">Create one</a></td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($subjects as $subject): ?>
                            <tr>
                                <td><?= $sl++ ?></td>
                                <td><strong><?= esc($subject['subject_name']) ?></strong></td>
                                <td><?= esc($subject['exam_name']) ?></td>
                                <td>
                                    <span class="badge bg-<?= $subject['status'] === 'active' ? 'success' : 'secondary' ?>">
                                        <?= esc($subject['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= base_url('/admin/subjects/edit/' . $subject['id']) ?>" class="btn btn-outline-primary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="<?= base_url('/admin/subjects/delete/' . $subject['id']) ?>" class="btn btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this subject?')">
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
