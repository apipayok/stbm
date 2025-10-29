<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container my-4">
    <h1 class="mb-4">Selamat Datang, Admin!</h1>

    <!-- ====== Summary Cards ====== -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="text-secondary">Total Users</h5>
                    <h2 class="fw-bold text-primary"><?= count($data['users'] ?? []) ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="text-secondary">Total Rooms</h5>
                    <h2 class="fw-bold text-success"><?= count($data['rooms'] ?? []) ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="text-secondary">Total Bookings</h5>
                    <h2 class="fw-bold text-warning"><?= count($data['bookings'] ?? []) ?></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- ====== Announcements Section ====== -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Announcements</h5>
            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addAnnouncementModal">
                + New Announcement
            </button>
        </div>
        <div class="card-body">
            <?php if (!empty($data['announcements'])): ?>
                <ul class="list-group list-group-flush">
                    <?php foreach ($data['announcements'] as $a): ?>
                        <li class="list-group-item">
                            <strong><?= esc($a['title'] ?? 'Untitled') ?></strong><br>
                            <span><?= esc($a['content']) ?></span>
                            <div class="text-muted small mt-1">
                                Posted <?= esc($a['created_at'] ?? '') ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-muted mb-0"><?= $data['message'] ?? 'No announcements found.' ?></p>
            <?php endif; ?>
        </div>
    </div>

    <!-- ====== Hidden Rooms Shortcut ====== -->
    <div class="card shadow-sm border-0">
        <div class="card-body text-center">
            <h5 class="card-title">Hidden Rooms</h5>
            <p class="text-muted">View rooms that are currently marked as hidden.</p>
            <a href="<?= base_url('admin/dashboard/viewRoom') ?>" class="btn btn-outline-primary">View Hidden Rooms</a>
        </div>
    </div>
</div>

<!-- ====== Modal: Add Announcement ====== -->
<div class="modal fade" id="addAnnouncementModal" tabindex="-1" aria-labelledby="addAnnouncementModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?= base_url('admin/dashboard/announcement') ?>" method="post" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addAnnouncementModalLabel">Create New Announcement</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Title</label>
          <input type="text" name="title" class="form-control" placeholder="Announcement title" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Content</label>
          <textarea name="content" class="form-control" rows="4" placeholder="Write your announcement..." required></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Post Announcement</button>
      </div>
    </form>
  </div>
</div>

<?= $this->endSection() ?>