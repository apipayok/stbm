<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rooms & Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f5f6fa;
        }
        .room-card {
            transition: all 0.2s ease-in-out;
            cursor: pointer;
        }
        .room-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .bookings {
            background: #fff;
            border-radius: 8px;
            padding: 10px 15px;
            margin-top: 10px;
        }
        .booking-item {
            border-bottom: 1px solid #eee;
            padding: 5px 0;
        }
        .booking-item:last-child {
            border: none;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4 text-center">Available Rooms</h2>
    <div class="row g-4">
        <?php if (!empty($rooms)): ?>
            <?php foreach ($rooms as $room): ?>
                <div class="col-md-4">
                    <div class="card room-card p-3" onclick="toggleBookings(<?= $room['roomId'] ?>)">
                        <h5><?= esc($room['roomName']) ?></h5>
                        <p class="text-muted mb-0">
                            <?= !empty($room['bookings']) 
                                ? count($room['bookings']) . ' Bookings' 
                                : 'No bookings yet — all slots available' ?>
                        </p>

                        <!-- Hidden bookings section -->
                        <div id="bookings-<?= $room['roomId'] ?>" class="bookings mt-3" style="display:none;">
                            <?php if (!empty($room['bookings'])): ?>
                                <?php foreach ($room['bookings'] as $b): ?>
                                    <div class="booking-item">
                                        <strong><?= esc($b['date']) ?></strong><br>
                                        <?= esc($b['booking_start']) ?> - <?= esc($b['booking_end']) ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-secondary mb-0">No bookings for this room.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-secondary">No rooms available.</p>
        <?php endif; ?>
    </div>
</div>

<script>
function toggleBookings(id) {
    const section = document.getElementById('bookings-' + id);
    section.style.display = section.style.display === 'none' ? 'block' : 'none';
}
</script>
</body>
</html>
