<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2 class="mb-4">Edit Room</h2>

    <form action="<?= base_url('admin/rooms/edit/' . $room['roomId']) ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="roomId" class="form-label">Room ID</label>
            <input type="text" name="roomId" id="roomId" class="form-control" value="<?= esc($room['roomId'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label for="roomName" class="form-label">Room Name</label>
            <input type="text" name="roomName" id="roomName" class="form-control" value="<?= esc($room['roomName'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="available" <?= (isset($room['status']) && $room['status'] === 'available') ? 'selected' : '' ?>>Available</option>
                <option value="hidden" <?= (isset($room['status']) && $room['status'] === 'hidden') ? 'selected' : '' ?>>Hidden</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
        <a href="<?= base_url('admin/rooms/view') ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?= $this->endSection() ?>
