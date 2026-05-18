<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= csrf_hash() ?>">
    <title><?= esc($title ?? 'Question Bank Platform') ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        /* body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .main-content {
            flex: 1;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            margin-bottom: 1.5rem;
        }
        .badge-difficulty {
            font-size: 0.75rem;
        }
        .question-card {
            transition: transform 0.2s;
        }
        .question-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        } */
/* --- RESET & FOUNDATION --- */
:root {
    --slate-50: #f8fafc;
    --slate-100: #f1f5f9;
    --slate-200: #e2e8f0;
    --slate-400: #94a3b8;
    --slate-600: #475569;
    --slate-800: #1e293b;
    --slate-900: #0f172a;
    --accent-line: #cbd5e1;
    --accent-hover: #475569;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    font-size: 13px; /* Smaller professional baseline */
    background-color: #fcfcfd;
    color: var(--slate-800);
    -webkit-font-smoothing: antialiased;
}

/* --- UI COMPONENTS (REMOVE BOOTSTRAP DEFAULTS) --- */

/* Navbar: Flat & Clean */
.navbar {
    background-color: #ffffff !important;
    border-bottom: 1px solid var(--slate-200);
    padding: 0.75rem 0;
}

.navbar-brand {
    font-size: 0.9rem;
    font-weight: 700;
    letter-spacing: -0.01em;
    color: var(--slate-900) !important;
    text-transform: uppercase;
}

.nav-link {
    font-size: 12px;
    font-weight: 500;
    color: var(--slate-600) !important;
    padding: 0.5rem 1rem !important;
}

/* Professional Card & The "Design Line" */
.card {
    border: 1px solid var(--slate-200) !important;
    border-radius: 2px !important; /* Sharp, professional edges */
    box-shadow: none !important;
    background: #ffffff;
    margin-bottom: 1rem;
}

.question-card {
    position: relative;
    border-left: 2px solid var(--accent-line) !important; /* The Signature Line */
    transition: all 0.2s ease-in-out;
}

.question-card:hover {
    border-left-color: var(--accent-hover) !important;
    background-color: #ffffff;
    box-shadow: 0 4px 12px rgba(0,0,0,0.03) !important;
}

/* Typography Scale */
h1, .display-5 {
    font-size: 1.25rem !important;
    font-weight: 600;
    color: var(--slate-900);
    letter-spacing: -0.02em;
}

.lead {
    font-size: 0.9rem !important;
    color: var(--slate-600);
}

/* Badges: Desaturated & Compact */
.badge {
    font-size: 10px !important;
    font-weight: 600 !important;
    padding: 4px 8px !important;
    border-radius: 2px !important;
    background-color: transparent !important;
    border: 1px solid var(--slate-200) !important;
    color: var(--slate-600) !important;
    text-transform: uppercase;
}

.badge-difficulty {
    border-left: 3px solid var(--slate-400) !important;
}

/* Forms: Dense & Minimal */
.form-label {
    font-size: 11px;
    font-weight: 600;
    color: var(--slate-400);
    text-transform: uppercase;
    margin-bottom: 0.4rem;
}

.form-control, .form-select {
    font-size: 13px !important;
    border: 1px solid var(--slate-200);
    border-radius: 2px !important;
    padding: 0.5rem 0.75rem;
    color: var(--slate-800);
    background-color: var(--slate-50);
}

.form-control:focus, .form-select:focus {
    background-color: #fff;
    border-color: var(--slate-400);
    box-shadow: none !important; /* Remove Bootstrap Glow */
}

/* Buttons: Solid Charcoal */
.btn-primary {
    background-color: var(--slate-900) !important;
    border: none !important;
    font-size: 12px !important;
    font-weight: 600;
    padding: 0.6rem 1.2rem !important;
    border-radius: 2px !important;
}

.btn-secondary {
    background-color: transparent !important;
    border: 1px solid var(--slate-200) !important;
    color: var(--slate-600) !important;
    font-size: 12px !important;
}

.btn-primary:hover {
    background-color: #000 !important;
}

/* Accordion: Minimal Overrides */
.accordion-item {
    border: none !important;
    background: transparent !important;
}

.accordion-button {
    font-size: 12px !important;
    font-weight: 600;
    color: var(--slate-800) !important;
    padding: 1rem 0 !important;
    background-color: transparent !important;
    box-shadow: none !important;
}

.accordion-button:not(.collapsed) {
    color: var(--slate-900) !important;
}

.accordion-body {
    padding: 1rem;
    background-color: var(--slate-50);
    border: 1px solid var(--slate-200);
    font-size: 13px;
    line-height: 1.6;
}

/* Pagination */
.page-link {
    font-size: 12px;
    border: 1px solid var(--slate-200) !important;
    color: var(--slate-600) !important;
    padding: 0.4rem 0.8rem;
}

.page-item.active .page-link {
    background-color: var(--slate-900) !important;
    border-color: var(--slate-900) !important;
    color: #fff !important;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .container {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    .question-card {
        padding: 1rem !important;
    }
}

      /* 1. Main Navbar Link Styling */
.navbar-nav .nav-link {
    color: #495057; /* Dark gray */
    font-weight: 500;
    padding: 0.5rem 1rem;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
}

/* 2. Hover & Active States */
.navbar-nav .nav-link:hover {
    color: #292929; /* Bootstrap Primary Blue */
    background-color: rgba(13, 110, 253, 0.05); /* Very light blue background */
    border-radius: 8px;
}

/* 3. Icon Spacing (Bootstrap Icons) */
.navbar-nav .nav-link i {
    margin-right: 8px;
    font-size: 1.1rem;
}

/* 4. Customizing the Mobile Toggle (Hamburger) */
.navbar-toggler {
    border: none;
    padding: 0;
}

.navbar-toggler:focus {
    box-shadow: none; /* Removes the blue outline on click */
}

/* Change color of the hamburger lines */
.navbar-toggler-icon {
    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgb(0, 0, 0)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E");
}

/* 5. Mobile Adjustments */
@media (max-width: 720px) {
    .navbar-collapse {
        /* margin-top: 1rem; */
        border-top: 1px solid #eee;
        /* padding-top: 1rem; */
    }
    
    .navbar-nav .nav-link {
        padding: 0.8rem;
    }
}      
    </style>
    
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('/') ?>">
                <i class="bi bi-bank"></i> TPSC-QBank
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/questions') ?>">
                            <i class="bi bi-search"></i> Browse Questions
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/admin/exams') ?>">
                            <i class="bi bi-gear"></i> Admin Panel
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="main-content">
        <div class="container my-4">
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
