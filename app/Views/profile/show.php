<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">My Profile</h3>
            </div>
            <div class="card-body">
                <div class="text-center mb-4">
                    <?php if (!empty($user['profile_image'])): ?>
                        <img src="<?= base_url('uploads/profiles/' . esc($user['profile_image'])) ?>" alt="Profile" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                    <?php else: ?>
                        <i class="bi bi-person-circle" style="font-size: 150px;"></i>
                    <?php endif; ?>
                </div>

                <dl class="row">
                    <dt class="col-sm-4">Full Name</dt>
                    <dd class="col-sm-8"><?= esc($user['fullname'] ?? 'N/A') ?></dd>

                    <dt class="col-sm-4">Email</dt>
                    <dd class="col-sm-8"><?= esc($user['username'] ?? 'N/A') ?></dd>

                    <dt class="col-sm-4">Student ID</dt>
                    <dd class="col-sm-8"><?= esc($user['student_id'] ?? 'N/A') ?></dd>

                    <dt class="col-sm-4">Course</dt>
                    <dd class="col-sm-8"><?= esc($user['course'] ?? 'N/A') ?></dd>

                    <dt class="col-sm-4">Year Level</dt>
                    <dd class="col-sm-8"><?= esc($user['year_level'] ?? 'N/A') ?></dd>

                    <dt class="col-sm-4">Section</dt>
                    <dd class="col-sm-8"><?= esc($user['section'] ?? 'N/A') ?></dd>

                    <dt class="col-sm-4">Phone</dt>
                    <dd class="col-sm-8"><?= esc($user['phone'] ?? 'N/A') ?></dd>

                    <dt class="col-sm-4">Address</dt>
                    <dd class="col-sm-8"><?= esc($user['address'] ?? 'N/A') ?></dd>

                    <dt class="col-sm-4">Account Created</dt>
                    <dd class="col-sm-8"><?= esc($user['created_at'] ?? 'N/A') ?></dd>

                    <dt class="col-sm-4">Last Updated</dt>
                    <dd class="col-sm-8"><?= esc($user['updated_at'] ?? 'N/A') ?></dd>
                </dl>

                <div class="text-center mt-4">
                    <a href="<?= base_url('profile/edit') ?>" class="btn btn-primary">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
