<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2 class="mb-4">Create New Room</h2>

    <form action="<?= base_url('admin/rooms/create') ?>" method="post">
        <?= csrf_field() ?>
        
        <div class="mb-3">
            <label for="roomId" class="form-label">Room ID</label>
            <input type="text" name="roomId" id="roomId" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="roomName" class="form-label">Room Name</label>
            <input type="text" name="roomName" id="roomName" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="available">Available</option>
                <option value="hidden">Hidden</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Add Room</button>
        <a href="<?= base_url('admin/rooms/view') ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?= $this->endSection() ?>
