<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2 class="mb-4 text-danger">Rejected Bookings</h2>

    <!-- Flash messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php elseif (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?php if (!empty($bookings)): ?>
        <table class="table table-bordered table-striped">
            <thead class="table-danger">
                <tr>
                    <th>#</th>
                    <th>Booking ID</th>
                    <th>User</th>
                    <th>Room</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Reason</th>
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
                        <td><?= esc($booking['reason'] ?? '-') ?></td>
                        <td>
                            <a href="<?= base_url('admin/bookings/rejected/delete/' . $booking['bookingId']) ?>" 
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Are you sure you want to delete this rejected booking?')">
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">No rejected bookings found.</div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
