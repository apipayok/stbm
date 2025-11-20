<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto px-4 mt-8">
    <h2 class="text-2xl font-bold mb-6">Room List</h2>

    <!-- Flash message -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <a href="<?= base_url('admin/rooms/create') ?>" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded mb-6">
        Add New Room
    </a>

    <div class="overflow-x-auto shadow-md rounded-lg">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Bil.</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Room ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Room Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php if (!empty($rooms)): ?>
                    <?php foreach ($rooms as $index => $room): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $index + 1 ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= esc($room['roomId']) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= esc($room['roomName']) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full <?= $room['status'] === 'available' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' ?>">
                                    <?= esc($room['status']) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <a href="<?= base_url('admin/rooms/edit/' . $room['roomId']) ?>" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded">Edit</a>
                                <a href="<?= base_url('admin/rooms/delete/' . $room['roomId']) ?>" class="inline-block bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded" onclick="return confirm('Delete this room?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No rooms found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>