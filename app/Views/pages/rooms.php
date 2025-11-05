<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container py-5">
    <h2 class="mb-4 text-center">Available Rooms</h2>
    <div class="row">
        <?php if (!empty($rooms)): ?>
            <?php foreach ($rooms as $room): ?>
                <?php
                    $isHidden = $room['status'] === 'hidden';
                    $cardClass = $isHidden ? 'bg-light text-muted' : 'bg-white';
                    $cardStyle = $isHidden
                        ? 'cursor: not-allowed; opacity: 0.6; pointer-events: none;'
                        : 'cursor: pointer; transition: transform 0.2s;';
                ?>

                <div class="col-md-4 mb-4">
                    <?php if (!$isHidden): ?>
                        <!-- Clickable card for available room -->
                        <a href="<?= site_url('rooms/' . $room['roomId']) ?>" class="text-decoration-none text-dark">
                            <div class="card shadow-sm h-100 <?= $cardClass ?>" style="<?= $cardStyle ?>"
                                 onmouseover="this.style.transform='scale(1.02)';"
                                 onmouseout="this.style.transform='scale(1)';">
                                <div class="card-body text-center d-flex flex-column justify-content-center">
                                    <h5 class="card-title mb-2"><?= esc($room['roomName']) ?></h5>
                                    <p class="card-text mb-0">Room ID: <?= esc($room['roomId']) ?></p>
                                </div>
                            </div>
                        </a>
                    <?php else: ?>
                        <!-- Greyed-out, unclickable card -->
                        <div class="card shadow-sm h-100 <?= $cardClass ?>" style="<?= $cardStyle ?>">
                            <div class="card-body text-center d-flex flex-column justify-content-center">
                                <h5 class="card-title mb-2"><?= esc($room['roomName']) ?></h5>
                                <p class="card-text mb-0">Room ID: <?= esc($room['roomId']) ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">No rooms found.</p>
        <?php endif; ?>
    </div>

    <div class="text-center mt-4">
        <a href="<?= site_url('/dashboard') ?>" class="btn btn-outline-secondary">Back to Main Page</a>
    </div>
</div>

<?= $this->endSection() ?>
