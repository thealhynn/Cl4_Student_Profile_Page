<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — CI4 RBAC</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body { background: #f4f6f9; }
        .login-wrapper { min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-card { width: 100%; max-width: 400px; }
    </style>
</head>
<body>
<div class="login-wrapper">
    <div class="login-card">
        <div class="card shadow border-0">
            <div class="card-header bg-primary text-white text-center py-4">
                <h4 class="fw-bold mb-0"><i class="bi bi-shield-lock me-2"></i>CI4 RBAC</h4>
                <p class="small mb-0 mt-1 opacity-75">Sign in to continue</p>
            </div>
            <div class="card-body p-4">

                <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger py-2 small">
                    <i class="bi bi-exclamation-triangle me-1"></i>
                    <?= esc(session()->getFlashdata('error')) ?>
                </div>
                <?php endif; ?>

                <form action="<?= base_url('/login') ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" class="form-control"
                                   placeholder="Enter email" value="<?= old('email') ?>" required autofocus>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password" class="form-control"
                                   placeholder="Enter password" required>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary fw-semibold">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Sign In
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-footer bg-light text-center small text-muted py-3">
                <strong>Demo accounts</strong> — password: <code>Password1</code><br>
                admin@school.edu &nbsp;|&nbsp; teacher@school.edu &nbsp;|&nbsp; student@school.edu
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
