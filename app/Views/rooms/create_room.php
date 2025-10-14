<!DOCTYPE html>
<html>
<head>
    <title>Create Room</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">Create a New Room</h2>

    <form action="<?= site_url('admin/rooms/store') ?>" method="post" class="card p-4 shadow-sm">
        <div class="mb-3">
            <label for="roomId" class="form-label">Room ID</label>
            <input type="text" name="roomId" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="roomName" class="form-label">Room Name</label>
            <input type="text" name="roomName" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="info" class="form-label">Note</label>
            <textarea name="info" class="form-control" rows="3"></textarea>
        </div>

        <div class="d-flex justify-content-between">
            <a href="<?= site_url('admin/rooms') ?>" class="btn btn-secondary">Back</a>
            <button type="submit" class="btn btn-success">Create Room</button>
        </div>
    </form>
</div>

</body>
</html>
