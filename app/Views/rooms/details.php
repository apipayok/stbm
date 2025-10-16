<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= esc($room['roomName']) ?> - Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3><?= esc($room['roomName']) ?></h3>
            <p><strong>Room ID:</strong> <?= esc($room['roomId']) ?></p>
            <hr>

            <h5>Available Time Slots for Today:</h5>
            <?php if (!empty($timeSlots)): ?>
                <ul class="list-group mb-3">
                    <?php foreach ($timeSlots as $slot): ?>
                        <li class="list-group-item"><?= esc($slot) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-danger">No available slots today.</p>
            <?php endif; ?>

            <a href="<?= site_url('/bookings') ?>" class="btn btn-secondary">Back to Rooms</a>
        </div>
    </div>
</div>

</body>
</html>
