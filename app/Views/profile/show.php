<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <h3 class="fw-bold mb-0 page-title">
        <i class="bi bi-person-circle me-2 text-primary"></i>My Profile
    </h3>
    <a href="<?= base_url('/profile/edit') ?>" class="btn btn-outline-primary btn-sm">
        <i class="bi bi-pencil me-1"></i>Edit Profile
    </a>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm text-center">
            <div class="card-body py-4">
                <?php if (! empty($user['profile_image'])): ?>
                    <img src="<?= base_url('uploads/profiles/' . esc($user['profile_image'])) ?>"
                         class="rounded-circle border border-4 border-primary mb-3"
                         style="width:110px;height:110px;object-fit:cover;" alt="Avatar">
                <?php else: ?>
                    <div class="rounded-circle bg-primary bg-opacity-10 border border-4 border-primary
                                d-inline-flex align-items-center justify-content-center mb-3"
                         style="width:110px;height:110px;">
                        <i class="bi bi-person-fill text-primary" style="font-size:3rem;"></i>
                    </div>
                <?php endif; ?>
                <h5 class="fw-bold mb-1"><?= esc($user['fullname']) ?></h5>
                <p class="text-muted small mb-0"><?= esc($user['username']) ?></p>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-id-card me-2 text-primary"></i>Profile Details</h6>
            </div>
            <div class="card-body p-4">
                <div class="row g-3">
                    <?php foreach ([
                        ['bi-hash',        'Student ID',  $user['student_id'] ?? null],
                        ['bi-mortarboard', 'Course',      $user['course'] ?? null],
                        ['bi-layers',      'Year & Section', trim(($user['year_level'] ? 'Year '.$user['year_level'] : '') . ' ' . ($user['section'] ?? '')) ?: null],
                        ['bi-telephone',   'Phone',       $user['phone'] ?? null],
                        ['bi-geo-alt',     'Address',     $user['address'] ?? null],
                    ] as [$icon, $label, $val]): ?>
                    <div class="col-sm-6">
                        <p class="text-muted small mb-1"><i class="bi <?= $icon ?> me-1"></i><?= $label ?></p>
                        <p class="fw-semibold mb-0">
                            <?= $val ? esc($val) : '<span class="text-muted fst-italic small">Not set</span>' ?>
                        </p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
