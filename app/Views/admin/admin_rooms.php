<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Rooms List</h2>

    <div class="d-flex justify-content-end mb-3">
        <a href="<?= site_url('admin/rooms/create') ?>" class="btn btn-primary">Add New Room</a>
    </div>

    <div class="row">
        <?php if (!empty($rooms) && is_array($rooms)): ?>
            <?php foreach ($rooms as $room): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title text-primary"><?= esc($room['roomName']) ?></h5>
                            <p class="card-text mb-3">
                                <strong>Room ID:</strong> <?= esc($room['roomId']) ?><br>

                                <?php if (!empty($room['info'])): ?>
                                    <strong>Info:</strong> <?= esc($room['info']) ?><br>
                                <?php endif; ?>
                            </p>

                            <div class="d-flex gap-2">
                                <a href="<?= site_url('admin/rooms/edit/'.$room['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="<?= site_url('admin/rooms/delete/'.$room['id']) ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Delete this room?')">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">No rooms found.</p>
        <?php endif; ?>
    </div>

    <div class="text-center mt-4">
        <a href="<?= site_url('/dashboard') ?>" class="btn btn-outline-secondary">Back to Main Page</a>
    </div>
</div>

<?= $this->endSection() ?>
