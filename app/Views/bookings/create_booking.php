<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-1">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3><?= esc($room['roomName']) ?></h3>
            <p><strong>Room ID:</strong> <?= esc($room['roomId']) ?></p>
            <hr>

            <!-- ✅ Date selector -->
            <form method="get" class="mb-4">
                <label for="date" class="me-2"><strong>Select Date:</strong></label>
                <input 
                    type="date" 
                    id="date" 
                    name="date" 
                    value="<?= esc($selectedDate ?? date('Y-m-d')) ?>" 
                    required
                >
                <button type="submit" class="btn btn-primary btn-sm">Apply</button>
            </form>

            <h5>Time Slots for <?= date('d-m-Y', strtotime($selectedDate ?? date('Y-m-d'))) ?>:</h5>

            <!-- Flash messages -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php elseif (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>
            
            <!-- Multiple slot selection form -->
            <?php if (!empty($timeSlots)): ?>
                <form method="post" action="<?= base_url('booking/create/' . $room['roomId']) ?>">
                    <input type="hidden" name="date" value="<?= esc($selectedDate ?? date('Y-m-d')) ?>">

                    <ul class="list-group mb-3">
                        <?php foreach ($timeSlots as $slot): ?>
                            <?php
                                $status = $slot['status'];
                                $isAvailable = $status === 'available';
                            ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><?= esc($slot['slot']) ?></span>

                                <?php if ($isAvailable): ?>
                                    <!-- Checkboxes for available slots -->
                                    <input 
                                        type="checkbox" 
                                        name="slots[]" 
                                        value="<?= esc($slot['slot']) ?>" 
                                        class="form-check-input"
                                    >
                                <?php else: ?>
                                    <span class="badge 
                                        <?= match ($status) {
                                            'booked' => 'status-approved',
                                            'pending' => 'status-pending',
                                            'unavailable' => 'status-unavailable',
                                            default => 'status-available'
                                        } ?>">
                                        <?= match ($status) {
                                            'booked' => 'Room Reserved',
                                            'pending' => 'Awaiting Approval',
                                            'unavailable' => 'Not Available',
                                            default => 'Available'
                                        } ?>
                                    </span>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <button type="submit" class="btn btn-success">Book Selected Slots</button>
                </form>
            <?php else: ?>
                <p class="text-danger">No available slots for this date.</p>
            <?php endif; ?>

            <a href="<?= site_url('/rooms') ?>" class="btn btn-secondary mt-3">← Back to Rooms</a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
