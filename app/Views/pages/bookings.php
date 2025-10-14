<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Room Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<div class="container">
    <h2 class="mb-4">Available Rooms & Bookings</h2>
    <a href="<?= site_url('bookings/create') ?>" class="btn btn-primary mb-3">+ Create Booking</a>

    <div class="row">
        <?php foreach ($rooms as $room): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?= esc($room['roomName']) ?></h5>
                        <p><strong>ID:</strong> <?= esc($room['roomId']) ?></p>

                        <h6>Bookings:</h6>
                        <ul class="list-group list-group-flush">
                            <?php
                            $hasBooking = false;
                            foreach ($bookings as $booking):
                                if ($booking['roomId'] == $room['roomId']):
                                    $hasBooking = true;
                            ?>
                                <li class="list-group-item">
                                    <strong>Date:</strong> <?= esc($booking['date']) ?><br>
                                    <strong>From:</strong> <?= esc($booking['booking_start']) ?> -
                                    <strong>To:</strong> <?= esc($booking['booking_end']) ?>
                                </li>
                            <?php endif; endforeach; ?>

                            <?php if (!$hasBooking): ?>
                                <li class="list-group-item text-muted">No bookings yet</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
