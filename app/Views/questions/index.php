<?= $this->include('layouts/header') ?>

<div class="row mb-4">
    <div class="col-12">
        <h1 class="display-5 mb-3">
            <i class="bi bi-book"></i> Question Bank
        </h1>
        <p class="lead text-muted">Browse previous years' competitive exam questions</p>
    </div>
</div>

<!-- Filters Card -->
<div class="card mb-4">
    <div class="card-header bg-dark text-white">
        <i class="bi bi-funnel"></i> Filter Questions
    </div>
    <div class="card-body">
        <form method="GET" action="<?= base_url('/questions') ?>" id="filterForm">
            <div class="row g-3">
                <div class="col-md-3">
                    <label for="exam_id" class="form-label">Exam</label>
                    <select class="form-select" id="exam_id" name="exam_id">
                        <option value="">All Exams</option>
                        <?php foreach ($exams as $exam): ?>
                            <option value="<?= $exam['id'] ?>" <?= isset($filters['exam_id']) && $filters['exam_id'] == $exam['id'] ? 'selected' : '' ?>>
                                <?= esc($exam['exam_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="subject_id" class="form-label">Subject</label>
                    <select class="form-select" id="subject_id" name="subject_id">
                        <option value="">All Subjects</option>
                        <?php foreach ($subjects as $subject): ?>
                            <option value="<?= $subject['id'] ?>" <?= isset($filters['subject_id']) && $filters['subject_id'] == $subject['id'] ? 'selected' : '' ?>>
                                <?= esc($subject['subject_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="topic_id" class="form-label">Topic</label>
                    <select class="form-select" id="topic_id" name="topic_id">
                        <option value="">All Topics</option>
                        <?php foreach ($topics as $topic): ?>
                            <option value="<?= $topic['id'] ?>" <?= isset($filters['topic_id']) && $filters['topic_id'] == $topic['id'] ? 'selected' : '' ?>>
                                <?= esc($topic['topic_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="year" class="form-label">Year</label>
                    <input type="number" class="form-control" id="year" name="year" 
                           placeholder="e.g., 2023" 
                           value="<?= $filters['year'] ?? '' ?>"
                           min="1900" max="<?= date('Y') ?>">
                </div>

                <div class="col-md-3">
                    <label for="difficulty_level" class="form-label">Difficulty</label>
                    <select class="form-select" id="difficulty_level" name="difficulty_level">
                        <option value="">All Levels</option>
                        <option value="Easy" <?= isset($filters['difficulty_level']) && $filters['difficulty_level'] === 'Easy' ? 'selected' : '' ?>>Easy</option>
                        <option value="Medium" <?= isset($filters['difficulty_level']) && $filters['difficulty_level'] === 'Medium' ? 'selected' : '' ?>>Medium</option>
                        <option value="Hard" <?= isset($filters['difficulty_level']) && $filters['difficulty_level'] === 'Hard' ? 'selected' : '' ?>>Hard</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="search" class="form-label">Search</label>
                    <input type="text" class="form-control" id="search" name="search" 
                           placeholder="Search in questions and answers..." 
                           value="<?= $filters['search'] ?? '' ?>">
                </div>

                <div class="col-md-3">
                    <label for="sort_by" class="form-label">Sort By</label>
                    <select class="form-select" id="sort_by" name="sort_by">
                        <option value="year" <?= ($filters['sort_by'] ?? 'year') === 'year' ? 'selected' : '' ?>>Year</option>
                        <option value="id" <?= ($filters['sort_by'] ?? '') === 'id' ? 'selected' : '' ?>>ID</option>
                    </select>
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i> Apply Filters
                    </button>
                    <a href="<?= base_url('/questions') ?>" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Clear Filters
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Results Info -->
<?php if (!empty($questions) || !empty($filters)): ?>
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i> 
        Found <strong><?= $pagination['total_items'] ?? 0 ?></strong> question(s)
        <?php if (!empty($filters)): ?>
            matching your criteria
        <?php endif; ?>
    </div>
<?php endif; ?>

<!-- Questions List -->
<?php if (empty($questions)): ?>
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
            <p class="text-muted mt-3">No questions found. Try adjusting your filters.</p>
        </div>
    </div>
<?php else: ?>
    <?php foreach ($questions as $question): ?>
        <div class="card question-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <span class="badge bg-primary"><?= esc($question['exam_name']) ?></span>
                        <span class="badge bg-info"><?= esc($question['subject_name']) ?></span>
                        <span class="badge bg-secondary"><?= esc($question['topic_name']) ?></span>
                        <span class="badge bg-<?= $question['difficulty_level'] === 'Easy' ? 'success' : ($question['difficulty_level'] === 'Medium' ? 'warning' : 'danger') ?> badge-difficulty">
                            <?= esc($question['difficulty_level']) ?>
                        </span>
                    </div>
                    <span class="badge bg-light text-dark">Year: <?= esc($question['year']) ?></span>
                </div>

                <h5 class="card-title">
                    <i class="bi bi-question-circle"></i> Question
                </h5>
                <div class="card-text mb-3">
                    <?= $question['question_text'] ?>
                </div>

                <div class="accordion" id="accordion<?= $question['id'] ?>">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#answer<?= $question['id'] ?>">
                                <i class="bi bi-check-circle"> </i> &nbsp; View Answer
                            </button>
                        </h2>
                        <div id="answer<?= $question['id'] ?>" class="accordion-collapse collapse" data-bs-parent="#accordion<?= $question['id'] ?>">
                            <div class="accordion-body">
                                <strong>Answer:</strong>
                                <div class="mt-2"><?= $question['answer_text'] ?></div>
                                <?php if (!empty($question['explanation'])): ?>
                                    <div class="mt-3">
                                        <strong>Explanation:</strong>
                                        <div class="mt-2"><?= $question['explanation'] ?></div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- Pagination -->
    <?php if ($pagination['total_pages'] > 1): ?>
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php if ($pagination['current_page'] > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?<?= http_build_query(array_merge($filters, ['page' => $pagination['current_page'] - 1])) ?>">
                            <i class="bi bi-chevron-left"></i> Previous
                        </a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $pagination['total_pages']; $i++): ?>
                    <?php if ($i == 1 || $i == $pagination['total_pages'] || ($i >= $pagination['current_page'] - 2 && $i <= $pagination['current_page'] + 2)): ?>
                        <li class="page-item <?= $i == $pagination['current_page'] ? 'active' : '' ?>">
                            <a class="page-link" href="?<?= http_build_query(array_merge($filters, ['page' => $i])) ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php elseif ($i == $pagination['current_page'] - 3 || $i == $pagination['current_page'] + 3): ?>
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if ($pagination['current_page'] < $pagination['total_pages']): ?>
                    <li class="page-item">
                        <a class="page-link" href="?<?= http_build_query(array_merge($filters, ['page' => $pagination['current_page'] + 1])) ?>">
                            Next <i class="bi bi-chevron-right"></i>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    <?php endif; ?>
<?php endif; ?>

<?= $this->include('layouts/footer') ?>

<script>
$(document).ready(function() {
    // Load subjects when exam is selected
    $('#exam_id').on('change', function() {
        var examId = $(this).val();
        var subjectSelect = $('#subject_id');
        var topicSelect = $('#topic_id');
        
        subjectSelect.html('<option value="">All Subjects</option>');
        topicSelect.html('<option value="">All Topics</option>');
        
        if (examId) {
            $.get('<?= base_url('/admin/subjects/get-by-exam') ?>', { exam_id: examId }, function(data) {
                $.each(data, function(key, value) {
                    var selected = value.id == <?= isset($filters['subject_id']) ? $filters['subject_id'] : 'null' ?> ? 'selected' : '';
                    subjectSelect.append('<option value="' + value.id + '" ' + selected + '>' + value.subject_name + '</option>');
                });
            });
        }
    });

    // Load topics when subject is selected
    $('#subject_id').on('change', function() {
        var subjectId = $(this).val();
        var topicSelect = $('#topic_id');
        
        topicSelect.html('<option value="">All Topics</option>');
        
        if (subjectId) {
            $.get('<?= base_url('/admin/topics/get-by-subject') ?>', { subject_id: subjectId }, function(data) {
                $.each(data, function(key, value) {
                    var selected = value.id == <?= isset($filters['topic_id']) ? $filters['topic_id'] : 'null' ?> ? 'selected' : '';
                    topicSelect.append('<option value="' + value.id + '" ' + selected + '>' + value.topic_name + '</option>');
                });
            });
        }
    });
    
    // Trigger change if exam is already selected
    if ($('#exam_id').val()) {
        $('#exam_id').trigger('change');
    }
});
</script>
