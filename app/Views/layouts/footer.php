        </div>
    </main>

    <footer class="bg-light py-4 mt-auto">
        <div class="container text-center">
            <p class="mb-0 text-muted">
                &copy; <?= date('Y') ?> Question Bank Platform. All rights reserved.
            </p>
        </div>
    </footer>

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
    </script>
</body>
</html>
