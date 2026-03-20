<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('/profile') ?>">My Profile</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
</nav>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="mb-0 fw-bold"><i class="bi bi-pencil-square me-2"></i>Edit Profile</h5>
            </div>
            <div class="card-body p-4">
                <form action="<?= base_url('/profile/update') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <!-- Profile image -->
                    <div class="mb-3 text-center">
                        <?php if (! empty($user['profile_image'])): ?>
                            <img src="<?= base_url('uploads/profiles/' . esc($user['profile_image'])) ?>"
                                 class="rounded-circle border border-3 border-primary mb-2"
                                 style="width:90px;height:90px;object-fit:cover;" alt="Avatar">
                        <?php else: ?>
                            <div class="rounded-circle bg-primary bg-opacity-10 border border-3 border-primary
                                        d-inline-flex align-items-center justify-content-center mb-2"
                                 style="width:90px;height:90px;">
                                <i class="bi bi-person-fill text-primary" style="font-size:2.5rem;"></i>
                            </div>
                        <?php endif; ?>
                        <div>
                            <input type="file" name="profile_image" id="profile_image"
                                   class="form-control form-control-sm d-inline-block" style="max-width:260px;"
                                   accept="image/*">
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control"
                                   value="<?= old('name', esc($user['fullname'])) ?>" required>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-semibold">Student ID</label>
                            <input type="text" name="student_id" class="form-control"
                                   value="<?= old('student_id', esc($user['student_id'] ?? '')) ?>">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-semibold">Course</label>
                            <input type="text" name="course" class="form-control"
                                   value="<?= old('course', esc($user['course'] ?? '')) ?>">
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label fw-semibold">Year Level</label>
                            <select name="year_level" class="form-select">
                                <option value="">—</option>
                                <?php for ($y = 1; $y <= 5; $y++): ?>
                                <option value="<?= $y ?>" <?= ($user['year_level'] ?? '') == $y ? 'selected' : '' ?>>
                                    Year <?= $y ?>
                                </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label fw-semibold">Section</label>
                            <input type="text" name="section" class="form-control"
                                   value="<?= old('section', esc($user['section'] ?? '')) ?>">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-semibold">Phone</label>
                            <input type="text" name="phone" class="form-control"
                                   value="<?= old('phone', esc($user['phone'] ?? '')) ?>">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Address</label>
                            <textarea name="address" class="form-control" rows="2"><?= old('address', esc($user['address'] ?? '')) ?></textarea>
                        </div>
                    </div>

                    <div class="d-flex gap-2 justify-content-end mt-4">
                        <a href="<?= base_url('/profile') ?>" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle me-1"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary fw-semibold">
                            <i class="bi bi-save me-1"></i>Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
