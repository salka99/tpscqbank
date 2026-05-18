<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= csrf_hash() ?>">
    <title><?= esc($title ?? 'Admin Panel') ?> - Question Bank</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- CKEditor 5 -->
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    
    <style>
        /* body {
            background-color: #f8f9fa;
        }
        .sidebar {
            min-height: calc(100vh - 56px);
            background-color: #343a40;
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.75);
            padding: 0.75rem 1rem;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .main-content {
            padding: 2rem 0;
        } */
            <style>
    :root {
        --sidebar-bg: #ffffff;
        --sidebar-color: #64748b;
        --sidebar-active: #4f46e5;
        --main-bg: #f1f5f9;
        --card-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
        --accent-color: #4f46e5;
    }

    body {
        background-color: var(--main-bg);
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        color: #1e293b;
    }

    /* Navbar Styling */
    .navbar {
        background-color: #ffffff !important;
        border-bottom: 1px solid #e2e8f0;
        z-index: 1030;
    }
    .navbar-brand, .navbar-brand i {
        color: var(--accent-color) !important;
        font-weight: 700;
    }

    /* Sidebar Styling */
    .sidebar {
        background-color: var(--sidebar-bg);
        border-right: 1px solid #e2e8f0;
        min-height: calc(100vh - 56px);
        padding: 1.5rem 0.75rem;
    }
    
    .sidebar .nav-link {
        color: var(--sidebar-color);
        font-weight: 500;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        margin-bottom: 4px;
        transition: all 0.2s;
    }

    .sidebar .nav-link i {
        margin-right: 10px;
        font-size: 1.1rem;
    }

    .sidebar .nav-link:hover {
        background-color: #f8fafc;
        color: var(--accent-color);
    }

    .sidebar .nav-link.active {
        background-color: #eef2ff;
        color: var(--sidebar-active);
    }

    /* Main Content */
    .main-content {
        padding: 2rem 2rem;
    }

    /* Card & Table Styling */
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: var(--card-shadow);
    }

    .table thead th {
        background-color: #f8fafc;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        color: #64748b;
        border-top: none;
        padding: 1rem;
    }

    .table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
    }

    /* Button & Badge Enhancements */
    .btn-primary {
        /* background-color: var(--accent-color); */
        border: none;
        padding: 0.5rem 1.25rem;
        border-radius: 8px;
        font-weight: 500;
    }

    .badge {
        padding: 0.5em 0.8em;
        border-radius: 6px;
        font-weight: 500;
    }

    .bg-info { background-color: #e0f2fe !important; color: #0369a1 !important; }
    .bg-success { background-color: #dcfce7 !important; color: #15803d !important; }
    .bg-secondary { background-color: #f1f5f9 !important; color: #475569 !important; }

    /* Action Buttons */
    .btn-group-sm > .btn {
        border-radius: 6px !important;
        margin: 0 2px;
        border: 1px solid #e2e8f0;
    }

    @media (max-width: 767.98px) {
        .main-content {
        padding: 1rem 1rem;
    }

    .sidebar {
        position: fixed;
        top: 0;
        left: -250px; /* This hides it completely */
        width: 250px;
        height: 100vh;
        z-index: 1050;
        transition: transform 0.3s ease-in-out;
        background-color: white !important;
        box-shadow: 5px 0 15px rgba(0,0,0,0.1);
    }

    /* When the 'show' class is added via JS */
    .sidebar.show {
        transform: translateX(250px); /* Slides it into view */
    }

    /* Darkens the background when menu is open */
    .sidebar-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.5);
        z-index: 1040;
    }

    .sidebar-overlay.show {
        display: block;
    }
}
</style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <!-- <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= base_url('/admin/exams') ?>">
                <i class="bi bi-shield-check"></i> Admin Panel
            </a>
            <a class="btn btn-outline-light btn-sm" href="<?= base_url('/questions') ?>">
                <i class="bi bi-arrow-left"></i> Back to Site
            </a>
        </div>
    </nav> -->

    <nav class="navbar navbar-light sticky-top">
    <div class="container-fluid">
        <div class="d-flex align-items-center">
          <button class="btn btn-link d-md-none me-2 p-0 text-dark" id="mobileMenuBtn">
                <i class="bi bi-list fs-2"></i>
            </button>
        <a class="navbar-brand" href="<?= base_url('/admin/exams') ?>">
            <i class="bi bi-shield-check"></i> ADMIN<span class="text-dark">CORE</span>
        </a>
        </div>
        <a class="btn btn-outline-secondary btn-sm m-2" href="<?= base_url('/questions') ?>">
            <i class="bi bi-box-arrow-right"></i> Exit to Site
        </a>

    
<li class="nav-item dropdown">
    <a class="nav-link position-relative" href="#" data-bs-toggle="dropdown">
        🔔
        <span id="notifCount" class="badge bg-danger position-absolute top-0 start-100 translate-middle">0</span>
    </a>

    <div class="dropdown-menu dropdown-menu-end p-2" style="width:320px;">
        <h6>Notifications</h6>
        <div id="notifList" style="max-height:300px;overflow:auto;"></div>
    </div>
</li>

        
    </div>
    <!-- <small class="text-uppercase text-muted fw-bold mb-2 ps-3" style="font-size: 0.65rem;">Management</small> -->
</nav>

<!-- <nav class="navbar navbar-light bg-white border-bottom sticky-top">
    <div class="container-fluid">
        <div class="d-flex align-items-center">
            <button class="btn btn-link d-md-none me-2 p-0 text-dark" id="mobileMenuBtn">
                <i class="bi bi-list fs-2"></i>
            </button>
            
            <a class="navbar-brand fw-bold text-primary" href="#">
                <i class="bi bi-shield-check"></i> AdminPanel
            </a>
        </div>
    </div>
</nav> -->

<div id="sidebarOverlay" class="sidebar-overlay"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar p-0" id="sidebarMenu">
    <div class="px-3 pb-2 mt-3">
        <small class="text-uppercase fw-bold text-muted" style="font-size: 0.7rem; letter-spacing: 0.05rem;">
            Main Menu
        </small>
    </div>
    
    <nav class="nav flex-column px-2">
        <a class="nav-link mb-1 <?= uri_string() == 'admin/exams' || strpos(uri_string(), 'admin/exams') !== false ? 'active' : '' ?>" 
           href="<?= base_url('/admin/exams') ?>">
            <i class="bi bi-journal-text me-2"></i> 
            <span>Exams</span>
        </a>

        <a class="nav-link mb-1 <?= uri_string() == 'admin/subjects' || strpos(uri_string(), 'admin/subjects') !== false ? 'active' : '' ?>" 
           href="<?= base_url('/admin/subjects') ?>">
            <i class="bi bi-book me-2"></i> 
            <span>Subjects</span>
        </a>

        <a class="nav-link mb-1 <?= uri_string() == 'admin/topics' || strpos(uri_string(), 'admin/topics') !== false ? 'active' : '' ?>" 
           href="<?= base_url('/admin/topics') ?>">
            <i class="bi bi-tags me-2"></i> 
            <span>Topics</span>
        </a>

        <a class="nav-link mb-1 <?= uri_string() == 'admin/questions' || strpos(uri_string(), 'admin/questions') !== false ? 'active' : '' ?>" 
           href="<?= base_url('/admin/questions') ?>">
            <i class="bi bi-question-circle me-2"></i> 
            <span>Questions</span>
        </a>
    </nav>

    <div class="px-3 pb-2 mt-4">
        <small class="text-uppercase fw-bold text-muted" style="font-size: 0.7rem; letter-spacing: 0.05rem;">
            System
        </small>
    </div>
    <nav class="nav flex-column px-2">
        <a class="nav-link mb-1 text-danger" href="<?= base_url('/logout') ?>">
            <i class="bi bi-box-arrow-left me-2"></i> 
            <span>Logout</span>
        </a>
    </nav>
</div>
            <div class="col-md-10 main-content">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i> <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle"></i> Please correct the following errors:
                        <ul class="mb-0 mt-2">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>


 <!-- Admin toogle script -->
<script>
    const menuBtn = document.getElementById('mobileMenuBtn');
    const sidebar = document.querySelector('.sidebar');
    const overlay = document.getElementById('sidebarOverlay');

    function toggleMenu() {
        sidebar.classList.toggle('show');
        overlay.classList.toggle('show');
        // Prevents the background from scrolling when menu is open
        document.body.style.overflow = sidebar.classList.contains('show') ? 'hidden' : 'auto';
    }

    menuBtn.addEventListener('click', toggleMenu);
    overlay.addEventListener('click', toggleMenu); // Close when clicking outside
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function loadNotifications() {
    fetch('/notifications/get')
    .then(res => res.json())
    .then(data => {

        let html = '';
        let count = 0;

        data.forEach(n => {

            if (!n.is_read) count++;

            html += `
                <div class="p-2 border-bottom notif ${!n.is_read ? 'bg-light' : ''}" data-id="${n.id}">
                    <strong>${n.title}</strong>
                    <div class="small text-muted">${n.message}</div>
                </div>
            `;

            // show popup once
            if (!n.is_seen) {
                Swal.fire({
                    toast:true,
                    position:'top-end',
                    icon:n.type,
                    title:n.title,
                    text:n.message,
                    timer:3000,
                    showConfirmButton:false
                });

                fetch('/notifications/seen/' + n.id);
            }
        });

        document.getElementById('notifList').innerHTML = html || 'No notifications';
        document.getElementById('notifCount').innerText = count;
    });
}

// click → mark read
document.addEventListener('click', function(e){
    let el = e.target.closest('.notif');
    if(el){
        let id = el.dataset.id;

        fetch('/notifications/read/' + id)
        .then(()=>{
            el.classList.remove('bg-light');
            loadNotifications();
        });
    }
});

// auto refresh
setInterval(loadNotifications, 5000);
loadNotifications();
</script>