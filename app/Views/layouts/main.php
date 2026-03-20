<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CI4 RBAC</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body { background: #f4f6f9; }
        #sidebar {
            width: 250px; min-height: 100vh; background: #343a40;
            position: fixed; top: 0; left: 0; z-index: 100;
            display: flex; flex-direction: column;
        }
        #sidebar .brand {
            padding: 1rem 1.25rem;
            background: #23272b;
            color: #fff;
            font-weight: 700;
            font-size: 1.1rem;
            border-bottom: 1px solid #495057;
        }
        #sidebar .nav-link {
            color: #adb5bd; padding: .6rem 1.25rem;
            display: flex; align-items: center; gap: .6rem;
        }
        #sidebar .nav-link:hover, #sidebar .nav-link.active { color: #fff; background: #495057; }
        #sidebar .nav-link i { font-size: 1rem; }
        #main { margin-left: 250px; min-height: 100vh; display: flex; flex-direction: column; }
        #topbar {
            background: #fff; border-bottom: 1px solid #dee2e6;
            padding: .75rem 1.5rem;
            display: flex; align-items: center; justify-content: flex-end;
            position: sticky; top: 0; z-index: 99;
        }
        #content { padding: 1.5rem; flex: 1; }
    </style>
</head>
<body>

<!-- Sidebar -->
<div id="sidebar">
    <div class="brand"><i class="bi bi-shield-check me-2"></i>CI4 RBAC</div>
    <nav class="mt-2 flex-grow-1">
        <?php $role = session('user')['role'] ?? ''; ?>

        <?php if ($role === 'admin'): ?>
        <a href="<?= base_url('/dashboard') ?>" class="nav-link"><i class="bi bi-speedometer2"></i> Dashboard</a>
        <a href="<?= base_url('/students') ?>" class="nav-link"><i class="bi bi-people"></i> Students</a>
        <a href="<?= base_url('/admin/roles') ?>" class="nav-link"><i class="bi bi-shield-check"></i> Role Management</a>
        <a href="<?= base_url('/admin/users') ?>" class="nav-link"><i class="bi bi-person-gear"></i> Assign Roles</a>
        <a href="<?= base_url('/admin/register') ?>" class="nav-link"><i class="bi bi-person-plus"></i> Register User</a>

        <?php elseif ($role === 'teacher'): ?>
        <a href="<?= base_url('/dashboard') ?>" class="nav-link"><i class="bi bi-speedometer2"></i> Dashboard</a>
        <a href="<?= base_url('/students') ?>" class="nav-link"><i class="bi bi-people"></i> Students</a>

        <?php else: ?>
        <a href="<?= base_url('/student/dashboard') ?>" class="nav-link"><i class="bi bi-speedometer2"></i> My Dashboard</a>
        <a href="<?= base_url('/profile') ?>" class="nav-link"><i class="bi bi-person-circle"></i> My Profile</a>
        <?php endif; ?>
    </nav>
    <div class="p-3 border-top border-secondary">
        <a href="<?= base_url('/logout') ?>" class="nav-link text-danger">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>
</div>

<!-- Main -->
<div id="main">
    <!-- Topbar -->
    <div id="topbar">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-person-circle fs-5 text-secondary"></i>
            <span class="fw-semibold"><?= esc(session('user')['name'] ?? '') ?></span>
            <span class="badge bg-<?= match($role ?? '') {
                'admin'   => 'danger',
                'teacher' => 'success',
                'student' => 'primary',
                default   => 'secondary'
            } ?>">
                <?= esc(ucfirst(session('user')['role'] ?? '')) ?>
            </span>
        </div>
    </div>

    <!-- Flash messages -->
    <div id="content">
        <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= esc(session()->getFlashdata('success')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= esc(session()->getFlashdata('error')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
