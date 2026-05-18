<?= $this->include('layouts/admin_header') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-question-circle"></i> Manage Questions</h2>
    <a href="<?= base_url('/admin/questions/create') ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add New Question
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Question</th>
                        <th>Exam</th>
                        <th>Subject</th>
                        <th>Topic</th>
                        <th>Year</th>
                        <th>Difficulty</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($questions)): ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted">No questions found. <a href="<?= base_url('/admin/questions/create') ?>">Create one</a></td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($questions as $question): ?>
                            <tr>
                                <td><?= esc($question['id']) ?></td>
                                <td>
                                    <div style="max-width: 300px; overflow: hidden; text-overflow: ellipsis;">
                                        <?= esc(substr(strip_tags($question['question_text']), 0, 100)) ?>...
                                    </div>
                                </td>
                                <td><?= esc($question['exam_name']) ?></td>
                                <td><?= esc($question['subject_name']) ?></td>
                                <td><?= esc($question['topic_name']) ?></td>
                                <td><?= esc($question['year']) ?></td>
                                <td>
                                    <span class="badge bg-<?= $question['difficulty_level'] === 'Easy' ? 'success' : ($question['difficulty_level'] === 'Medium' ? 'warning' : 'danger') ?>">
                                        <?= esc($question['difficulty_level']) ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= base_url('/admin/questions/edit/' . $question['id']) ?>" class="btn btn-outline-primary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="<?= base_url('/admin/questions/delete/' . $question['id']) ?>" class="btn btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this question?')">
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
