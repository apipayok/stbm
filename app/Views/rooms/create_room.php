<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Create Room</h2>

    <form action="<?= site_url('admin/rooms/store') ?>" method="post" class="card p-4 shadow-sm">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="roomId" class="form-label">Room ID</label>
            <input type="text" name="roomId" id="roomId" class="form-control" placeholder="e.g. R001" required>
        </div>

        <div class="mb-3">
            <label for="roomName" class="form-label">Room Name</label>
            <input type="text" name="roomName" id="roomName" class="form-control" placeholder="e.g. Meeting Room A" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="available" selected>Available</option>
                <option value="unavailable">Unavailable</option>
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <a href="<?= site_url('admin/rooms') ?>" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-success">Create Room</button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
