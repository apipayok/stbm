<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto px-4 py-12">
    <h2 class="text-2xl font-bold mb-8 text-center">Available Rooms</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if (!empty($rooms)): ?>
            <?php foreach ($rooms as $room): ?>
                <?php
                    $isHidden = $room['status'] === 'hidden';
                    $cardClass = $isHidden ? 'bg-gray-100 text-gray-400' : 'bg-white';
                    $cardStyle = $isHidden
                        ? 'cursor: not-allowed; opacity: 0.6; pointer-events: none;'
                        : 'cursor: pointer;';
                ?>

                <div>
                    <?php if (!$isHidden): ?>
                        <!-- Clickable card for available room -->
                        <a href="<?= site_url('rooms/' . $room['roomId']) ?>" class="block no-underline text-gray-900">
                            <div class="<?= $cardClass ?> shadow-md rounded-lg h-full transition-transform duration-200 hover:scale-105" style="<?= $cardStyle ?>">
                                <div class="p-6 text-center flex flex-col justify-center h-full">
                                    <h5 class="text-xl font-semibold mb-2"><?= esc($room['roomName']) ?></h5>
                                    <p class="text-sm text-gray-600 mb-0">Room ID: <?= esc($room['roomId']) ?></p>
                                </div>
                            </div>
                        </a>
                    <?php else: ?>
                        <!-- Greyed-out, unclickable card -->
                        <div class="<?= $cardClass ?> shadow-md rounded-lg h-full" style="<?= $cardStyle ?>">
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

    <div class="text-center mt-8">
        <a href="<?= site_url('/dashboard') ?>" class="inline-block border border-gray-400 text-gray-700 hover:bg-gray-100 font-semibold py-2 px-6 rounded">
            Back to Main Page
        </a>
    </div>
</div>

<?= $this->endSection() ?>