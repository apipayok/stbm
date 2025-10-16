<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= esc($room['roomName']) ?> - Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .slot-item { display: flex; justify-content: space-between; align-items: center; }
        .status-badge { font-size: 0.9rem; }
        .status-available { background-color: #28a745; } /* Green */
        .status-pending { background-color: #ffc107; color: #000; } /* Yellow */
        .status-approved { background-color: #dc3545; } /* Red */
    </style>
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3><?= esc($room['roomName']) ?></h3>
            <p><strong>Room ID:</strong> <?= esc($room['roomId']) ?></p>
            <hr>

            <h5>Today's Time Slots:</h5>

            <?php if (!empty($timeSlots)): ?>
                <ul class="list-group mb-3">
                    <?php foreach ($timeSlots as $slot): ?>
                        <li class="list-group-item slot-item">
                            <span><?= esc($slot['slot']) ?></span>
                            <?php
                                $status = $slot['status'];
                                $badgeClass = match ($status) {
                                    'approved' => 'status-approved',
                                    'pending' => 'status-pending',
                                    default => 'status-available',
                                };
                            ?>
                            <span class="badge status-badge <?= $badgeClass ?>">
                                <?= ucfirst($status) ?>
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-danger">No available slots today.</p>
            <?php endif; ?>

            <a href="<?= site_url('/rooms') ?>" class="btn btn-secondary">← Back to Rooms</a>
        </div>
    </div>
</div>

</body>
</html>
