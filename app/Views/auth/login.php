<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Login</title>
    <style>
        :root {
            --primary: #0f172a; /* Deep Navy */
            --primary-hover: #1e293b;
            --border: #e2e8f0;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --bg: #f8fafc;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: var(--bg);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        .auth-card {
            background: #ffffff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            width: 100%;
            max-width: 400px;
        }

        .header {
            text-align: center;
            margin-bottom: 32px;
        }

        .header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            margin: 0 0 8px 0;
        }

        .header p {
            color: var(--text-muted);
            font-size: 0.875rem;
            margin: 0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-main);
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            box-sizing: border-box;
        }

        input:focus {
            outline: none;
            border-color: #94a3b8;
            box-shadow: 0 0 0 4px rgba(226, 232, 240, 0.5);
        }

        button[type="submit"] {
            width: 100%;
            background-color: var(--primary);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.1s ease, background 0.2s ease;
            margin-top: 10px;
        }

        button:hover {
            background-color: var(--primary-hover);
        }

        button:active {
            transform: scale(0.98);
        }

        .footer-link {
            text-align: center;
            margin-top: 24px;
            font-size: 0.875rem;
            color: var(--text-muted);
        }

        .footer-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        /* Container for Alerts to ensure spacing above the form */
.alert {
    position: relative;
    padding: 1rem 1.25rem;
    margin-bottom: 1.5rem;
    border: 1px solid transparent;
    border-radius: 12px;
    display: flex;
    align-items: flex-start;
    font-size: 14px;
    line-height: 1.5;
    animation: slideIn 0.3s ease-out;
}

/* Success Alert - Soft Emerald */
.alert-success {
    background-color: #ecfdf5;
    border-color: #a7f3d0;
    color: #065f46;
}
.alert-success i {
    color: #10b981;
    margin-right: 12px;
    font-size: 18px;
}

/* Error/Danger Alert - Soft Rose/Red */
.alert-danger {
    background-color: #fff1f2;
    border-color: #fecdd3;
    color: #9f1239;
}
.alert-danger i {
    color: #f43f5e;
    margin-right: 12px;
    font-size: 18px;
}

/* List styling inside validation errors */
.alert ul {
    padding-left: 20px;
    margin-top: 8px;
}

.alert ul li {
    margin-bottom: 4px;
}

/* Modern Close Button */
.btn-close {
    position: absolute;
    top: 0.75rem;
    right: 0.75rem;
    background: transparent url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath d='M.293.293a1 1 0 011.414 0L8 6.586 14.293.293a1 1 0 111.414 1.414L9.414 8l6.293 6.293a1 1 0 01-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 01-1.414-1.414L6.586 8 .293 1.707a1 1 0 010-1.414z'/%3e%3c/svg%3e") center/1em auto no-repeat;
    border: 0;
    opacity: 0.4;
    cursor: pointer;
    transition: opacity 0.2s;
    width: 1em;
    height: 1em;
}

.btn-close:hover {
    opacity: 0.8;
}

/* Animation to make it feel smooth */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
    </style>
</head>
<body>

<div class="auth-card">
    <div class="header">

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

        <h1>Sign in</h1>
        <p>Enter your details to access your account</p>
    </div>

    <form method="post">
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="name@company.com" required>
        </div>

        <div class="form-group">
            <div style="display: flex; justify-content: space-between;">
                <label for="password">Password</label>
                <a href="#" style="font-size: 0.75rem; color: var(--text-muted); text-decoration: none;">Forgot?</a>
            </div>
            <input type="password" id="password" name="password" placeholder="••••••••" required>
        </div>

        <button type="submit">Sign in to Dashboard</button>
    </form>

    <div class="footer-link">
        Don't have an account? <a href="<?=base_url('register')?>">Create one</a>
    </div>
</div>

</body>
</html>