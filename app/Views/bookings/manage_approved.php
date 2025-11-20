<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto px-4 mt-8">
    <h2 class="mb-6 text-2xl font-bold text-green-600">Approved Bookings</h2>

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

    <?php if (!empty($bookings)): ?>
        <div class="overflow-x-auto shadow-md rounded-lg">
            <table class="min-w-full bg-white border border-gray-300">
                <thead class="bg-green-100">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border-b">#</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border-b">Booking ID</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border-b">User</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border-b">Room</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border-b">Date</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border-b">Time</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border-b">Remarks</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border-b">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php $no = 1; foreach ($bookings as $booking): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm text-gray-900"><?= $no++ ?></td>
                            <td class="px-4 py-3 text-sm text-gray-900"><?= esc($booking['bookingId']) ?></td>
                            <td class="px-4 py-3 text-sm text-gray-900"><?= esc($booking['username'] ?? 'N/A') ?></td>
                            <td class="px-4 py-3 text-sm text-gray-900"><?= esc($booking['roomName'] ?? 'N/A') ?></td>
                            <td class="px-4 py-3 text-sm text-gray-900"><?= esc($booking['date']) ?></td>
                            <td class="px-4 py-3 text-sm text-gray-900"><?= esc($booking['time_slot']) ?></td>
                            <td class="px-4 py-3 text-sm text-gray-900"><?= esc($booking['remarks'] ?? '-') ?></td>
                            <td class="px-4 py-3 text-sm">
                                <a href="<?= base_url('admin/bookings/approved/view/' . $booking['bookingId']) ?>" 
                                   class="inline-block bg-green-600 hover:bg-green-700 text-white py-1 px-3 rounded text-sm">
                                    View
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded">
            No approved bookings found.
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>