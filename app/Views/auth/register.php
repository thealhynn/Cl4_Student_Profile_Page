<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <h3 class="fw-bold mb-0"><i class="bi bi-person-plus-fill me-2 text-danger"></i>Register New User</h3>
    <a href="<?= base_url('/admin/users') ?>" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Back to Users
    </a>
</div>

<div class="card border-0 shadow-sm" style="max-width:560px;">
    <div class="card-body p-4">

        <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger small">
            <?php foreach (session()->getFlashdata('errors') as $e): ?>
                <div><?= esc($e) ?></div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <form action="<?= base_url('/admin/register') ?>" method="POST">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label fw-semibold">Full Name</label>
                <input type="text" name="fullname" class="form-control"
                       value="<?= old('fullname') ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Email (Username)</label>
                <input type="email" name="username" class="form-control"
                       value="<?= old('username') ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" name="password" class="form-control"
                       placeholder="Min. 8 characters" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Role</label>
                <select name="role" class="form-select" required>
                    <option value="">— Select Role —</option>
                    <?php foreach ($roles as $id => $label): ?>
                        <option value="<?= $id ?>" <?= old('role') == $id ? 'selected' : '' ?>>
                            <?= esc($label) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-danger fw-semibold">
                    <i class="bi bi-person-check me-1"></i>Create Account
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
