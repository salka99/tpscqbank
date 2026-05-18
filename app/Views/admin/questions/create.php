<?= $this->include('layouts/admin_header') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-plus-circle"></i> Add New Question</h2>
    <a href="<?= base_url('/admin/questions') ?>" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?= base_url('/admin/questions/store') ?>" method="POST">
            <?= csrf_field() ?>
            
            <div class="row">
                <div class="col-md-4 mb-3">
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

                <div class="col-md-4 mb-3">
                    <label for="subject_id" class="form-label">Subject <span class="text-danger">*</span></label>
                    <select class="form-select" id="subject_id" name="subject_id" required>
                        <option value="">Select Subject (Choose Exam First)</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="topic_id" class="form-label">Topic <span class="text-danger">*</span></label>
                    <select class="form-select" id="topic_id" name="topic_id" required>
                        <option value="">Select Topic (Choose Subject First)</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="year" class="form-label">Year <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="year" name="year" 
                           value="<?= old('year', date('Y') - 1) ?>" 
                           min="1900" max="<?= date('Y') ?>" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="difficulty_level" class="form-label">Difficulty Level <span class="text-danger">*</span></label>
                    <select class="form-select" id="difficulty_level" name="difficulty_level" required>
                        <option value="Easy" <?= old('difficulty_level') === 'Easy' ? 'selected' : '' ?>>Easy</option>
                        <option value="Medium" <?= old('difficulty_level') === 'Medium' || !old('difficulty_level') ? 'selected' : '' ?>>Medium</option>
                        <option value="Hard" <?= old('difficulty_level') === 'Hard' ? 'selected' : '' ?>>Hard</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="question_text" class="form-label">Question Text <span class="text-danger">*</span></label>
                <textarea class="form-control ckeditor" id="question_text" name="question_text" rows="5" ><?= old('question_text') ?></textarea>
            </div>

            <div class="mb-3">
                <label for="answer_text" class="form-label">Answer Text <span class="text-danger">*</span></label>
                <textarea class="form-control ckeditor" id="answer_text" name="answer_text" rows="5" ><?= old('answer_text') ?></textarea>
            </div>

            <div class="mb-3">
                <label for="explanation" class="form-label">Explanation</label>
                <textarea class="form-control ckeditor" id="explanation" name="explanation" rows="4"><?= old('explanation') ?></textarea>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="<?= base_url('/admin/questions') ?>" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Create Question
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->include('layouts/admin_footer') ?>

<script>
$(document).ready(function() {
    // Load subjects when exam is selected
    $('#exam_id').on('change', function() {
        var examId = $(this).val();
        var subjectSelect = $('#subject_id');
        var topicSelect = $('#topic_id');
        
        subjectSelect.html('<option value="">Loading...</option>');
        topicSelect.html('<option value="">Select Topic (Choose Subject First)</option>');
        
        if (examId) {
            $.get('<?= base_url('/admin/subjects/get-by-exam') ?>', { exam_id: examId }, function(data) {
                subjectSelect.html('<option value="">Select Subject</option>');
                $.each(data, function(key, value) {
                    subjectSelect.append('<option value="' + value.id + '">' + value.subject_name + '</option>');
                });
            });
        } else {
            subjectSelect.html('<option value="">Select Subject (Choose Exam First)</option>');
        }
    });

    // Load topics when subject is selected
    $('#subject_id').on('change', function() {
        var subjectId = $(this).val();
        var topicSelect = $('#topic_id');
        
        topicSelect.html('<option value="">Loading...</option>');
        
        if (subjectId) {
            $.get('<?= base_url('/admin/topics/get-by-subject') ?>', { subject_id: subjectId }, function(data) {
                topicSelect.html('<option value="">Select Topic</option>');
                $.each(data, function(key, value) {
                    topicSelect.append('<option value="' + value.id + '">' + value.topic_name + '</option>');
                });
            });
        } else {
            topicSelect.html('<option value="">Select Topic (Choose Subject First)</option>');
        }
    });
});
</script>

