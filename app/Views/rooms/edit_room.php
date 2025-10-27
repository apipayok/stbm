<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Edit Room</h2>

    <form action="<?= site_url('admin/rooms/update/' . $room['id']) ?>" method="post" class="card p-4 shadow-sm">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="roomId" class="form-label">Room ID</label>
            <input type="text" name="roomId" id="roomId" value="<?= esc($room['roomId']) ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="roomName" class="form-label">Room Name</label>
            <input type="text" name="roomName" id="roomName" value="<?= esc($room['roomName']) ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="available" <?= $room['status'] === 'available' ? 'selected' : '' ?>>Available</option>
                <option value="unavailable" <?= $room['status'] === 'unavailable' ? 'selected' : '' ?>>Unavailable</option>
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <a href="<?= site_url('admin/rooms') ?>" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Update Room</button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
