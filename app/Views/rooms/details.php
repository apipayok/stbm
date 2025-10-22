<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container py-2">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3><?= esc($room['roomName']) ?></h3>
            <p><strong>Room ID:</strong> <?= esc($room['roomId']) ?></p>
            <hr>

            <!-- 🟢 Date selector -->
            <form method="get" class="mb-4">
                <label for="date" class="me-2"><strong>Select Date:</strong></label>
                <input 
                    type="date" 
                    id="date" 
                    name="date" 
                    value="<?= esc($selectedDate ?? date('d-m-Y')) ?>" 
                    required
                >
                <button type="submit" class="btn btn-primary btn-sm">Apply</button>
            </form>

            <h5>Time Slots for <?= esc($selectedDate ?? date('d-m-Y')) ?>:</h5>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php elseif (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <?php if (!empty($timeSlots)): ?>
                <ul class="list-group mb-3">
                    <?php foreach ($timeSlots as $slot): ?>
                        <?php
                            $status = $slot['status'];
                            $badgeClass = match ($status) {
                                'approved' => 'status-approved',
                                'pending' => 'status-pending',
                                default => 'status-available',
                            };
                        ?>
                        <li class="list-group-item slot-item d-flex justify-content-between align-items-center">
                            <span><?= esc($slot['slot']) ?></span>

                            <?php if ($status === 'available'): ?>
                                <!-- 🟢 Pass selected date in the booking link -->
                                <a href="<?= base_url('booking/check/' . $room['roomId'] . '/' . urlencode($slot['slot'])) ?>?date=<?= esc($selectedDate ?? date('d-m-Y')) ?>"
                                   class="btn btn-sm btn-success">
                                    Book
                                </a>
                            <?php else: ?>
                                <span class="badge status-badge <?= $badgeClass ?>">
                                    <?= ucfirst($status) ?>
                                </span>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-danger">No available slots for this date.</p>
            <?php endif; ?>

            <a href="<?= site_url('/rooms') ?>" class="btn btn-secondary">← Back to Rooms</a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
