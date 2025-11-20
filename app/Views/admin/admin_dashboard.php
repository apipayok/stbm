<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto px-4 py-6">
    <h2 class="mb-4 text-2xl font-bold text-blue-600">DASHBOARD ADMIN</h2>

    <!-- Summary Cards -->
    <div class="grid grid-cols-12 grid-rows-2 gap-8 py-3">

        <div class="bg-white rounded-lg shadow border-l-4 border-green-500 p-4 text-center col-start-1 row-span-2 col-span-2">
            <h5 class="text-green-600 font-medium">Available Rooms</h5>
            <h3 class="text-2xl font-bold"><?= esc($data['countAvailable']) ?></h3>
        </div>

        <div class="bg-white rounded-lg shadow border-l-4 border-red-500 p-4 text-center col-start-3 row-span-2 col-span-2">
            <h5 class="text-red-600 font-medium">Hidden Rooms</h5>
            <h3 class="text-2xl font-bold"><?= esc($data['countHidden']) ?></h3>
        </div>

        <div class="bg-white rounded-lg shadow border-l-4 border-blue-500 p-4 text-center col-start-5 row-span-2 col-span-2">
            <h5 class="text-blue-600 font-medium">Total Users</h5>
            <h3 class="text-2xl font-bold"><?= count($data['users']) ?></h3>
        </div>

        <div class="bg-white rounded-lg shadow border-l-4 border-amber-400 p-4 text-center col-start-7 row-span-2 col-span-2">
            <h5 class="text-amber-600 font-medium">Total Bookings</h5>
            <h3 class="text-2xl font-bold"><?= count($data['bookings']) ?></h3>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow mb-6 overflow-hidden">
            <div class="bg-blue-600 text-white font-bold px-4 py-3">Announcements</div>
            <div class="p-4">
                <?php if (!empty($data['announcements'])): ?>
                    <ul class="divide-y divide-gray-200">
                        <?php foreach ($data['announcements'] as $a): ?>
                            <li class="py-3">
                                <strong class="text-gray-900"><?= esc($a['title']) ?></strong><br>
                                <span class="text-gray-700"><?= esc($a['content']) ?></span><br>
                                <small class="text-gray-500">Posted <?= esc(date('d M Y', strtotime($a['created_at']))) ?></small>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-gray-500">No announcements yet.</p>
                <?php endif; ?>
            </div>
        </div>

    <!-- Hidden Rooms -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="bg-red-600 text-white font-bold px-4 py-3">Hidden Rooms</div>
        <div class="p-4">
            <?php if (!empty($data['hidden'])): ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300">
                        <thead class="bg-red-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">#</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Room Name</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php $no = 1;
                            foreach ($data['hidden'] as $room): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 text-sm text-gray-900"><?= $no++ ?></td>
                                    <td class="px-4 py-2 text-sm text-gray-900"><?= esc($room['roomName']) ?></td>
                                    <td class="px-4 py-2 text-sm">
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            <?= esc($room['status']) ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="text-gray-500">No hidden rooms found.</p>
            <?php endif; ?>
        </div>
    </div>
    
</div>

<?= $this->endSection() ?>