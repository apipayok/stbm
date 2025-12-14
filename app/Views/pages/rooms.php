<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto px-4 py-12">
    <h2 class="mb-4 text-3xl font-semibold text-green-800">BILIK TEMPAHAN</h2>
    <div class="grid grid-cols-3 gap-6">
        <?php if (!empty($rooms)): ?>
            <?php foreach ($rooms as $room): ?>
                <?php
                    $isHidden = $room['status'] === 'hidden';
                    $cardClass = $isHidden ? 'bg-gray-100 text-gray-400' : 'bg-white';
                    $cardStyle = $isHidden
                        ? 'cursor: not-allowed; opacity: 0.6; pointer-events: none;'
                        : 'cursor: pointer;';
                    $imageUrl = !empty($room['image']) ? base_url('uploads/rooms/' . $room['image']) : 'https://via.placeholder.com/400x200?text=No+Image';
                ?>

                <div>
                    <?php if (!$isHidden): ?>
                        <!-- Clickable card for available room -->
                        <a href="<?= site_url('rooms/' . $room['roomId']) ?>" class="block no-underline text-gray-900">
                            <div class="<?= $cardClass ?> shadow-md rounded-lg h-full transition-transform duration-200 hover:scale-105" style="<?= $cardStyle ?>">
                                <img src="<?= esc($imageUrl) ?>" alt="<?= esc($room['roomName']) ?>" class="w-full h-48 object-cover rounded-t-lg">
                                <div class="p-6 text-center flex flex-col justify-center h-full">
                                    <h5 class="text-xl font-semibold mb-2"><?= esc($room['roomName']) ?></h5>
                                </div>
                            </div>
                        </a>
                    <?php else: ?>
                        <!-- Greyed-out, unclickable card -->
                        <div class="<?= $cardClass ?> shadow-md rounded-lg h-full" style="<?= $cardStyle ?>">
                            <img src="<?= esc($imageUrl) ?>" alt="<?= esc($room['roomName']) ?>" class="w-full h-48 object-cover rounded-t-lg">
                            <div class="p-6 text-center flex flex-col justify-center h-full">
                                <h5 class="text-xl font-semibold mb-2"><?= esc($room['roomName']) ?></h5>
                                <p class="text-sm mb-0">Room ID: <?= esc($room['roomId']) ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center col-span-full text-gray-500">No rooms found.</p>
        <?php endif; ?>
    </div>

</div>

<?= $this->endSection() ?>
