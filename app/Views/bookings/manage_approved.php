<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto px-4 mt-8">
    <h2 class="mb-4 text-3xl font-semibold text-green-800">DILULUS</h2>

    <!-- Flash messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php elseif (session()->getFlashdata('error')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($data['bookings'])): ?>
        <div class="overflow-x-auto shadow-md rounded-lg">
            <table class="min-w-full bg-white border border-gray-300">
                <thead class="bg-green-100">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">User</th>
                        <th class="px-4 py-3">Room</th>
                        <th class="px-4 py-3">Date</th>
                        <th class="px-4 py-3">Time</th>
                        <th class="px-4 py-3">Reason</th>
                        <th class="px-4 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php $no = 1 + ($data['pager']->getCurrentPage('bookings') - 1) * 10; ?>
                    <?php foreach ($data['bookings'] as $booking): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3"><?= $no++ ?></td>
                            <td class="px-4 py-3"><?= esc($booking['username'] ?? 'N/A') ?></td>
                            <td class="px-4 py-3"><?= esc($booking['roomName'] ?? 'N/A') ?></td>
                            <td class="px-4 py-3"><?= esc($booking['date']) ?></td>
                            <td class="px-4 py-3"><?= esc($booking['time_slot']) ?></td>
                            <td class="px-4 py-3"><?= esc($booking['reason'] ?? '-') ?></td>
                            <td class="px-4 py-3">
                                <button
                                    data-popup-url="<?= base_url(
                                                        'admin/bookings/approved/summary/' . $booking['roomId']
                                                    )
                                                        . '?username=' . urlencode($booking['username'])
                                                        . '&date=' . urlencode($booking['date'])
                                                        . '&reason=' . urlencode($booking['reason'])
                                                        . '&popup=1' ?>"
                                    class="inline-block bg-green-600 hover:bg-green-700 text-white py-1 px-3 rounded text-sm">
                                    View
                                </button>


                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            <?= $data['pager']->links('bookings', 'numbering') ?>
        </div>
    <?php else: ?>
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded">
            No <?= $data['status'] ?> bookings found.
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>