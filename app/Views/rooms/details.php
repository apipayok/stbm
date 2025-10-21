<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>


<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3><?= esc($room['roomName']) ?></h3>
            <p><strong>Room ID:</strong> <?= esc($room['roomId']) ?></p>
            <hr>

            <h5>Today's Time Slots:</h5>

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
                        <li class="list-group-item slot-item">
                            <span><?= esc($slot['slot']) ?></span>

                            <?php if ($status === 'available'): ?>
                                
                                <a href="<?= base_url('booking/check/' . $room['roomId'] . '/' . urlencode($slot['slot'])) ?>" 
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
                <p class="text-danger">No available slots today.</p>
            <?php endif; ?>

            <a href="<?= site_url('/rooms') ?>" class="btn btn-secondary">← Back to Rooms</a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>