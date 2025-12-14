<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto px-4 mt-8">

    <h2 class="mb-4 text-3xl font-semibold text-green-800">URUS BILIK</h2>

    <!-- Flash message -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <a href="<?= base_url('admin/rooms/create') ?>"
        class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded mb-6">
        Add New Room
    </a>

    <!-- Cards Grid -->
    <?php if (!empty($rooms)): ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

            <?php foreach ($rooms as $room): ?>
                <?php
                    $imageUrl = !empty($room['image'])
                        ? base_url('uploads/rooms/' . $room['image']) 
                        : 'https://via.placeholder.com/200x150?text=No+Image';
                ?>
                <div class="bg-white shadow rounded-lg p-5 border border-gray-200 hover:shadow-lg transition h-full">
                    <div class="grid grid-cols-3 gap-4">
                        <!-- Left: Room Info -->
                        <div class="col-span-2 flex flex-col justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-gray-800 mb-2"><?= esc($room['roomName']) ?></h3>
                                <p class="text-sm text-gray-600 mb-1"><strong>Room ID:</strong> <?= esc($room['roomId']) ?></p>
                                <div class="mb-3">
                                    <span class="px-3 py-1 inline-block text-xs font-semibold rounded-full
                                        <?= $room['status'] === 'available'
                                            ? 'bg-green-100 text-green-800'
                                            : 'bg-gray-200 text-gray-700' ?>">
                                        <?= esc($room['status']) ?>
                                    </span>
                                </div>
                            </div>

                            <div class="flex gap-2 mt-4">
                                <a href="<?= base_url('admin/rooms/edit/' . $room['roomId']) ?>"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm py-1 px-3 rounded">
                                    Edit
                                </a>

                                <a href="<?= base_url('admin/rooms/delete/' . $room['roomId']) ?>"
                                    class="bg-red-600 hover:bg-red-700 text-white text-sm py-1 px-3 rounded"
                                    onclick="return confirm('Delete this room?')">
                                    Delete
                                </a>
                            </div>
                        </div>

                        <!-- Right: Room Image -->
                        <div class="col-span-1 flex items-center justify-center">
                            <img src="<?= esc($imageUrl) ?>" alt="<?= esc($room['roomName']) ?>"
                                 class="w-full h-32 object-cover rounded-lg shadow-sm">
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

    <?php else: ?>
        <div class="text-center bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded">
            No rooms found.
        </div>
    <?php endif; ?>

</div>

<?= $this->endSection() ?>
