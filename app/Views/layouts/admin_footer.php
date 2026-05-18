            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery (for AJAX requests) -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    <script>
        // CSRF Token setup for AJAX
        $.ajaxSetup({
            beforeSend: function(xhr, settings) {
                if (settings.type === 'POST' || settings.type === 'PUT' || settings.type === 'DELETE') {
                    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                    xhr.setRequestHeader('<?= csrf_header() ?>', '<?= csrf_hash() ?>');
                }
            }
        });

        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);

        // Initialize CKEditor for textarea with class 'ckeditor'
        document.querySelectorAll('textarea.ckeditor').forEach(function(textarea) {
            ClassicEditor
                .create(textarea)
                .catch(error => {
                    console.error('CKEditor initialization error:', error);
                });
        });
    </script>
</body>
</html>
