<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2 class="mb-4 text-primary">Admin Dashboard</h2>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center border-success">
                <div class="card-body">
                    <h5 class="card-title text-success">Available Rooms</h5>
                    <h3><?= esc($data['countAvailable']) ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center border-danger">
                <div class="card-body">
                    <h5 class="card-title text-danger">Hidden Rooms</h5>
                    <h3><?= esc($data['countHidden']) ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center border-info">
                <div class="card-body">
                    <h5 class="card-title text-info">Total Users</h5>
                    <h3><?= count($data['users']) ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center border-warning">
                <div class="card-body">
                    <h5 class="card-title text-warning">Total Bookings</h5>
                    <h3><?= count($data['bookings']) ?></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- System Messages -->
    <?php if (!empty($data['message'])): ?>
        <?php foreach ($data['message'] as $msg): ?>
            <div class="alert alert-info"><?= esc($msg) ?></div>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Announcements -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">📢 Announcements</div>
        <div class="card-body">
            <?php if (!empty($data['announcements'])): ?>
                <ul class="list-group">
                    <?php foreach ($data['announcements'] as $a): ?>
                        <li class="list-group-item">
                            <strong><?= esc($a['title']) ?></strong><br>
                            <?= esc($a['content']) ?><br>
                            <small class="text-muted">Posted <?= esc(date('d M Y', strtotime($a['created_at']))) ?></small>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-muted">No announcements yet.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Hidden Rooms -->
    <div class="card">
        <div class="card-header bg-danger text-white">🚪 Hidden Rooms</div>
        <div class="card-body">
            <?php if (!empty($data['hidden'])): ?>
                <table class="table table-bordered table-striped">
                    <thead class="table-danger">
                        <tr>
                            <th>#</th>
                            <th>Room Name</th>
                            <th>Type</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($data['hidden'] as $room): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($room['roomName']) ?></td>
                                <td><?= esc($room['type'] ?? '-') ?></td>
                                <td><span class="badge bg-danger"><?= esc($room['status']) ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-muted">No hidden rooms found.</p>
            <?php endif; ?>
        </div>
    </div>

</div>

<?= $this->endSection() ?>
