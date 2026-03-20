<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h3 class="fw-bold mb-0 page-title">
            <i class="bi bi-speedometer2 me-2 text-primary"></i>Dashboard
        </h3>
        <p class="text-muted small mt-1 mb-0">
            Welcome, <strong><?= esc(session('user')['name']) ?></strong>
            <span class="badge bg-<?= session('user')['role'] === 'admin' ? 'danger' : 'success' ?> ms-1">
                <?= esc(ucfirst(session('user')['role'])) ?>
            </span>
        </p>
    </div>
</div>

<div class="row g-4">
    <div class="col-sm-4">
        <div class="card border-0 shadow-sm text-center py-4">
            <i class="bi bi-people-fill text-primary fs-1 mb-2"></i>
            <h2 class="fw-bold mb-0"><?= $totalUsers ?></h2>
            <p class="text-muted small mb-0">Total Users</p>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card border-0 shadow-sm text-center py-4">
            <i class="bi bi-mortarboard-fill text-success fs-1 mb-2"></i>
            <h2 class="fw-bold mb-0"><?= $students ?></h2>
            <p class="text-muted small mb-0">Students</p>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card border-0 shadow-sm text-center py-4">
            <i class="bi bi-shield-check text-danger fs-1 mb-2"></i>
            <h2 class="fw-bold mb-0"><?= $totalRoles ?></h2>
            <p class="text-muted small mb-0">Roles</p>
        </div>
    </div>
</div>

<div class="row g-4 mt-2">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="fw-bold mb-3"><i class="bi bi-people me-2 text-success"></i>Student Management</h6>
                <p class="text-muted small">View and browse all enrolled students.</p>
                <a href="<?= base_url('/students') ?>" class="btn btn-success btn-sm">
                    <i class="bi bi-arrow-right me-1"></i>Go to Students
                </a>
            </div>
        </div>
    </div>
    <?php if (session('user')['role'] === 'admin'): ?>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="fw-bold mb-3"><i class="bi bi-shield-check me-2 text-danger"></i>Role Management</h6>
                <p class="text-muted small">Create, edit, and delete roles. Assign roles to users.</p>
                <a href="<?= base_url('/admin/roles') ?>" class="btn btn-danger btn-sm me-2">
                    <i class="bi bi-shield-check me-1"></i>Manage Roles
                </a>
                <a href="<?= base_url('/admin/users') ?>" class="btn btn-outline-danger btn-sm">
                    <i class="bi bi-person-gear me-1"></i>Assign Roles
                </a>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
