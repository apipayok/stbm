<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">

<div class="container">
    <h2 class="mb-4">Bookings List</h2>
    <a href="<?= site_url('bookings/create') ?>" class="btn btn-primary mb-3">+ New Booking</a>
    <a href="<?= site_url('dashboard') ?>" class="btn btn-secondary btn-lg mt-3 d-block mx-auto" style="width:200px;">
    ← Back to Main Page
    </a>

    <?php if (!empty($bookings) && is_array($bookings)): ?>
        <table class="table table-bordered table-hover shadow-sm bg-white">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Room ID</th>
                    <th>Room Name</th>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?= esc($booking['id']) ?></td>
                        <td><?= esc($booking['roomId']) ?></td>
                        <td><?= esc($booking['roomName']) ?></td>
                        <td><?= esc($booking['date']) ?></td>
                        <td><?= esc($booking['booking_start']) ?></td>
                        <td><?= esc($booking['booking_end']) ?></td>
                        <td><?= esc($booking['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">No bookings found.</div>
    <?php endif; ?>
</div>

</body>
</html>
