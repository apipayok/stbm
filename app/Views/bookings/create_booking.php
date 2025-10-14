<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<div class="container">
    <h2 class="mb-4">Create a New Booking</h2>

    <form action="<?= site_url('bookings/store') ?>" method="post">
        <div class="mb-3">
            <label for="roomId" class="form-label">Room ID</label>
            <input type="text" name="roomId" id="roomId" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="roomName" class="form-label">Room Name</label>
            <input type="text" name="roomName" id="roomName" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="booking_start" class="form-label">Start Time</label>
            <input type="time" name="booking_start" id="booking_start" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="booking_end" class="form-label">End Time</label>
            <input type="time" name="booking_end" id="booking_end" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Submit Booking</button>
        <a href="<?= site_url('bookings') ?>" class="btn btn-secondary">Back</a>
    </form>
</div>

</body>
</html>
