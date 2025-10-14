<!DOCTYPE html>
<html>
<head>
    <title>Edit Room</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">Edit Room</h2>

    <form action="<?= site_url('admin/rooms/update/'.$rooms['id']) ?>" method="post" class="card p-4 shadow-sm">
        <div class="mb-3">
            <label for="roomId" class="form-label">Room ID</label>
            <input type="text" name="roomId" value="<?= esc($rooms['roomId']) ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="roomName" class="form-label">Room Name</label>
            <input type="text" name="roomName" value="<?= esc($rooms['roomName']) ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="note" class="form-label">Note</label>
            <textarea name="info" class="form-control" rows="3"><?= esc($rooms['info']) ?></textarea>
        </div>

        <div class="d-flex justify-content-between">
            <a href="<?= site_url('admin/rooms') ?>" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Update Room</button>
        </div>
    </form>
</div>

</body>
</html>
