<?= $this->include('layouts/admin_header') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-tags"></i> Manage Topics</h2>
    <a href="<?= base_url('/admin/topics/create') ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add New Topic
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Topic Name</th>
                        <th>Subject</th>
                        <th>Exam</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($topics)): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">No topics found. <a href="<?= base_url('/admin/topics/create') ?>">Create one</a></td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($topics as $topic): ?>
                            <tr>
                                <td><?= esc($topic['id']) ?></td>
                                <td><strong><?= esc($topic['topic_name']) ?></strong></td>
                                <td><?= esc($topic['subject_name']) ?></td>
                                <td><?= esc($topic['exam_name']) ?></td>
                                <td>
                                    <span class="badge bg-<?= $topic['status'] === 'active' ? 'success' : 'secondary' ?>">
                                        <?= esc($topic['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= base_url('/admin/topics/edit/' . $topic['id']) ?>" class="btn btn-outline-primary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="<?= base_url('/admin/topics/delete/' . $topic['id']) ?>" class="btn btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this topic?')">
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
