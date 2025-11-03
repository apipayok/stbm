<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2 class="mb-4">Room List</h2>

    <!-- Flash message -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <a href="<?= base_url('admin/rooms/create') ?>" class="btn btn-primary mb-3">Add New Room</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Room ID</th>
                <th>Room Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($rooms)): ?>
                <?php foreach ($rooms as $index => $room): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= esc($room['roomId']) ?></td>
                        <td><?= esc($room['roomName']) ?></td>
                        <td>
                            <span class="badge bg-<?= $room['status'] === 'available' ? 'success' : 'secondary' ?>">
                                <?= esc($room['status']) ?>
                            </span>
                        </td>
                        <td>
                            <a href="<?= base_url('admin/rooms/edit/' . $room['roomId']) ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="<?= base_url('admin/rooms/delete/' . $room['roomId']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this room?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No rooms found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
