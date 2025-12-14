<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto px-4 mt-8">
    <h2 class="mb-6 text-2xl font-bold">Dashboard</h2>

    <!-- Overview Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <a href="<?= base_url('admin/bookings/pending') ?>" class="block no-underline text-gray-900">
            <div class="bg-white text-center shadow-md rounded-lg border-l-4 border-yellow-500 hover:shadow-lg transition-shadow">
                <div class="p-6">
                    <h6 class="text-yellow-600 font-semibold mb-2">Kelulusan</h6>
                    <h3 class="text-3xl font-bold"><?= $pendingCount ?></h3>
                </div>
            </div>
        </a>

        <a href="<?= base_url('admin/bookings/approved') ?>" class="block no-underline text-gray-900">
            <div class="bg-white text-center shadow-md rounded-lg border-l-4 border-green-500 hover:shadow-lg transition-shadow">
                <div class="p-6">
                    <h6 class="text-green-600 font-semibold mb-2">Diluluskan</h6>
                    <h3 class="text-3xl font-bold"><?= $approvedCount ?></h3>
                </div>
            </div>
        </a>

        <a href="<?= base_url('admin/bookings/rejected') ?>" class="block no-underline text-gray-900">
            <div class="bg-white text-center shadow-md rounded-lg border-l-4 border-red-500 hover:shadow-lg transition-shadow">
                <div class="p-6">
                    <h6 class="text-red-600 font-semibold mb-2">Ditolak</h6>
                    <h3 class="text-3xl font-bold"><?= $rejectedCount ?></h3>
                </div>
            </div>
        </a>

        <div class="bg-white text-center shadow-md rounded-lg border-l-4 border-gray-500">
            <div class="p-6">
                <h6 class="text-gray-600 font-semibold mb-2">Total</h6>
                <h3 class="text-3xl font-bold"><?= $totalCount ?></h3>
            </div>
        </div>
    </div>

    <!-- Recent Bookings Table -->
    <div class="bg-white shadow-md rounded-lg mb-8">
        <div class="p-6">
            <h5 class="text-xl font-bold mb-4">Tempahan Terbaru</h5>

            <!-- Set max height and enable scroll -->
            <div class="overflow-y-auto" style="max-height: 350px;">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-100 sticky top-0">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Staff No.</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">User</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Room</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Date</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Time</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php if (!empty($bookings)): ?>
                            <?php foreach (array_slice($bookings, 0, 10) as $booking): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm text-gray-900"><?= esc($booking['staffno'] ?? '—') ?></td>
                                    <td class="px-4 py-3 text-sm text-gray-900"><?= esc($booking['username'] ?? '—') ?></td>
                                    <td class="px-4 py-3 text-sm text-gray-900"><?= esc($booking['roomName'] ?? '—') ?></td>
                                    <td class="px-4 py-3 text-sm text-gray-900"><?= esc($booking['date'] ?? '—') ?></td>
                                    <td class="px-4 py-3 text-sm text-gray-900"><?= esc($booking['time_slot'] ?? '—') ?></td>
                                    <td class="px-4 py-3 text-sm">
                                        <?php
                                            $status = strtolower($booking['status'] ?? '');
                                            $badgeColor = match($status) {
                                                'approved' => 'bg-green-100 text-green-800',
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                'rejected' => 'bg-red-100 text-red-800',
                                                default => 'bg-gray-100 text-gray-800'
                                            };
                                        ?>
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full <?= $badgeColor ?>"><?= ucfirst($status) ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="6" class="px-4 py-3 text-center text-gray-500">No bookings found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>