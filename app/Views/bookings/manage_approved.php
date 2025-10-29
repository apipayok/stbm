<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2 class="mb-4 text-success">Approved Bookings</h2>

    <!-- Flash messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php elseif (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?php if (!empty($bookings)): ?>
        <table class="table table-bordered table-striped">
            <thead class="table-success">
                <tr>
                    <th>#</th>
                    <th>Booking ID</th>
                    <th>User</th>
                    <th>Room</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Remarks</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc($booking['bookingId']) ?></td>
                        <td><?= esc($booking['username'] ?? 'N/A') ?></td>
                        <td><?= esc($booking['roomName'] ?? 'N/A') ?></td>
                        <td><?= esc($booking['date']) ?></td>
                        <td><?= esc($booking['time_slot']) ?></td>
                        <td><?= esc($booking['remarks'] ?? '-') ?></td>
                        <td>
                            <a href="<?= base_url('admin/bookings/approved/view/' . $booking['bookingId']) ?>" 
                               class="btn btn-sm btn-success">
                                View
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">No approved bookings found.</div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
