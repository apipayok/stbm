<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Rooms List</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success text-center">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php elseif (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger text-center">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-end mb-3">
        <a href="<?= site_url('admin/rooms/create') ?>" class="btn btn-primary">Add New Room</a>
    </div>

    <div class="row">
        <?php if (!empty($rooms) && is_array($rooms)): ?>
            <?php foreach ($rooms as $room): ?>
                <?php
                    // Normalize and format status using match()
                    $status = strtolower($room['status'] ?? '');
                    $statusText = match($status) {
                        'available' => 'Available',
                        'maintenance' => 'Under Maintenance',
                        'unavailable' => 'Unavailable',
                        default => ucfirst($status ?: 'Unknown'),
                    };

                    $statusColor = match($status) {
                        'available' => 'success',
                        'maintenance' => 'warning',
                        'unavailable' => 'danger',
                        default => 'secondary',
                    };
                ?>

                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100 border-<?= $statusColor ?>">
                        <div class="card-body">
                            <h5 class="card-title text-primary"><?= esc($room['roomName']) ?></h5>
                            <p class="card-text mb-3">
                                <strong>Room ID:</strong> <?= esc($room['roomId']) ?><br>
                                <strong>Status:</strong>
                                <span class="badge bg-<?= $statusColor ?>"><?= esc($statusText) ?></span>
                            </p>

                            <div class="d-flex gap-2">
                                <a href="<?= site_url('admin/rooms/edit/' . $room['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="<?= site_url('admin/rooms/delete/' . $room['id']) ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Delete this room?')">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-muted">No rooms found.</p>
        <?php endif; ?>
    </div>

    <div class="text-center mt-4">
        <a href="<?= site_url('/dashboard') ?>" class="btn btn-outline-secondary">Back to Main Page</a>
    </div>
</div>

<?= $this->endSection() ?>
