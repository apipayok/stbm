<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-4">

    <h2 class="mb-4 text-center">Manage Bookings</h2>

    <!-- Flash messages -->
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php elseif(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Room</th>
                        <th>Date</th>
                        <th>Time Slot</th>
                        <th>Booked By</th>
                        <th>Status</th>
                        <th>Change Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($bookings)): ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted">No bookings found.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($bookings as $index => $b): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= esc($b['roomName'] ?? 'Unknown') ?></td>
                                <td><?= esc($b['date'] ?? '-') ?></td>
                                <td><?= esc($b['time_slot'] ?? '-') ?></td>
                                <td><?= esc($b['username'] ?? '-') ?></td>
                                <td>
                                    <?php if($b['status'] == 'approved'): ?>
                                        <span class="badge bg-success">Approved</span>
                                    <?php elseif($b['status'] == 'rejected'): ?>
                                        <span class="badge bg-danger">Rejected</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Pending</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <form action="<?= site_url('admin/bookings/edit/' . $b['bookingId']) ?>" method="post" class="d-inline">
                                        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                            <option value="pending" <?= $b['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                            <option value="approved" <?= $b['status'] == 'approved' ? 'selected' : '' ?>>Approved</option>
                                            <option value="rejected" <?= $b['status'] == 'rejected' ? 'selected' : '' ?>>Rejected</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="text-center mt-4">
        <a href="<?= site_url('/dashboard') ?>" class="btn btn-outline-secondary">Back to Main Page</a>
    </div>
</div>

<?= $this->endSection() ?>
