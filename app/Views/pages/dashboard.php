<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container my-5">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">
            <h2 class="mb-4 text-primary">Welcome, <?= esc($user['username']) ?>!</h2>

            <h4 class="mb-3">Your Bookings</h4>

            <?php if (!empty($bookings)): ?>
                <!-- Scrollable Table Wrapper -->
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark sticky-top">
                            <tr>
                                <th scope="col">Room</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time Slot</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($bookings as $booking): ?>
                            <tr>
                                <td><?= esc($booking['roomId']) ?></td>
                                <td><?= esc($booking['date']) ?></td>
                                <td><?= esc($booking['time_slot']) ?></td>
                                <td>
                                    <?php if ($booking['status'] === 'approved'): ?>
                                        <span class="badge bg-success">Approved</span>
                                    <?php elseif ($booking['status'] === 'pending'): ?>
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    <?php elseif ($booking['status'] === 'rejected'): ?>
                                        <span class="badge bg-danger">Rejected</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary"><?= esc($booking['status']) ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info mt-3">
                    You have no bookings yet.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
