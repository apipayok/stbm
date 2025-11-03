<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2 class="mb-4">Dashboard</h2>

    <!-- Overview Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <a href="<?= base_url('admin/bookings/pending') ?>" class="text-decoration-none text-dark">
                <div class="card text-center shadow-sm border-warning">
                    <div class="card-body">
                        <h6 class="text-warning">Kelulusan</h6>
                        <h3><?= $pendingCount ?></h3>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="<?= base_url('admin/bookings/approved') ?>" class="text-decoration-none text-dark">
                <div class="card text-center shadow-sm border-success">
                    <div class="card-body">
                        <h6 class="text-success">Diluluskan</h6>
                        <h3><?= $approvedCount ?></h3>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="<?= base_url('admin/bookings/rejected') ?>" class="text-decoration-none text-dark">
                <div class="card text-center shadow-sm border-danger">
                    <div class="card-body">
                        <h6 class="text-danger">Ditolak</h6>
                        <h3><?= $rejectedCount ?></h3>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-center shadow-sm border-secondary">
                <div class="card-body">
                    <h6 class="text-secondary">Total</h6>
                    <h3><?= $totalCount ?></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Bookings Table -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title mb-3">Recent Bookings</h5>

            <!-- Set max height and enable scroll -->
            <div class="table-responsive" style="max-height: 350px; overflow-y: auto;">
                <table class="table table-striped align-middle">
                    <thead class="table-light sticky-top">
                        <tr>
                            <th>Staff No.</th>
                            <th>User</th>
                            <th>Room</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($bookings)): ?>
                            <?php foreach (array_slice($bookings, 0, 10) as $booking): ?>
                                <tr>
                                    <td><?= esc($booking['staffno'] ?? '—') ?></td>
                                    <td><?= esc($booking['username'] ?? '—') ?></td>
                                    <td><?= esc($booking['roomName'] ?? '—') ?></td>
                                    <td><?= esc($booking['date'] ?? '—') ?></td>
                                    <td><?= esc($booking['time_slot'] ?? '—') ?></td>
                                    <td>
                                        <?php
                                            $status = strtolower($booking['status'] ?? '');
                                            $badgeColor = match($status) {
                                                'approved' => 'success',
                                                'pending' => 'warning',
                                                'rejected' => 'danger',
                                                default => 'secondary'
                                            };
                                        ?>
                                        <span class="badge bg-<?= $badgeColor ?>"><?= ucfirst($status) ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="6" class="text-center text-muted">No bookings found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>
