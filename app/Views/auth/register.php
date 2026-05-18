<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --brand: #030303; /* Modern Indigo */
            --brand-dark: #4f46e5;
            --bg-canvas: #fafafa;
            --text-heading: #111827;
            --text-body: #4b5563;
            --input-bg: #ffffff;
            --input-border: #e5e7eb;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }

        body {
            margin: 0;
            background-color: var(--bg-canvas);
            font-family: 'Inter', -apple-system, system-ui, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        /* The "SaaS" Card Container */
        .registration-card {
            background: white;
            width: 100%;
            max-width: 420px;
            padding: 48px;
            border-radius: 20px;
            box-shadow: var(--shadow-md);
            border: 1px solid rgba(0, 0, 0, 0.03);
        }

        .header {
            margin-bottom: 32px;
            text-align: center;
        }

        .logo-mark {
            /* width: 40px;
            height: 40px; */
            background: var(--brand);
            border-radius: 10px;
            margin: 0 auto 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 20px;
        }

        h1 {
            color: var(--text-heading);
            font-size: 24px;
            font-weight: 700;
            margin: 0 0 8px;
            letter-spacing: -0.025em;
        }

        p {
            color: var(--text-body);
            font-size: 14px;
            margin: 0;
        }

        /* Input Styling */
        .form-field {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-heading);
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            background: var(--input-bg);
            border: 1px solid var(--input-border);
            border-radius: 10px;
            font-size: 15px;
            color: var(--text-heading);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            box-sizing: border-box;
            box-shadow: var(--shadow-sm);
        }

        input::placeholder {
            color: #9ca3af;
        }

        input:focus {
            outline: none;
            border-color: var(--brand);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.12);
        }

        /* Premium Button Animation */
        button {
            width: 100%;
            padding: 12px;
            background: var(--brand);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 8px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        button:hover {
            background: var(--brand-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        button:active {
            transform: translateY(0);
        }

        .divider {
            margin: 24px 0;
            text-align: center;
            font-size: 12px;
            color: #9ca3af;
            position: relative;
        }

        .footer-note {
            font-size: 13px;
            color: var(--text-body);
            text-align: center;
            margin-top: 24px;
        }

        .footer-note a {
            color: var(--brand);
            text-decoration: none;
            font-weight: 600;
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

<div class="registration-card">

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

    <div class="header">
        <div class="logo-mark">TPSCQBank</div>
        <h1>Create an account</h1>
    </div>

    <form method="post">
        <div class="form-field">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" placeholder="John Doe" required>
        </div>

        <div class="form-field">
            <label for="email">Work Email</label>
            <input type="email" id="email" name="email" placeholder="john@company.com" required>
        </div>

        <div class="form-field">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="At least 8 characters" required>
        </div>

        <button type="submit">Get started</button>
    </form>

    <div class="footer-note">
        Already have an account? <a href="<?=base_url('login')?>">Sign in</a>
    </div>
</div>

</body>
</html>