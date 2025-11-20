<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto px-4 py-8">

    <h2 class="mb-6 text-2xl font-bold text-center">Manage Bookings</h2>

    <!-- Flash messages -->
    <?php if(session()->getFlashdata('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php elseif(session()->getFlashdata('error')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border-b">#</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border-b">Room</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border-b">Date</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border-b">Time Slot</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border-b">Booked By</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border-b">Status</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border-b">Change Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php if (empty($bookings)): ?>
                            <tr>
                                <td colspan="7" class="px-4 py-4 text-center text-gray-500">No bookings found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($bookings as $index => $b): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm text-gray-900"><?= $index + 1 ?></td>
                                    <td class="px-4 py-3 text-sm text-gray-900"><?= esc($b['roomName'] ?? 'Unknown') ?></td>
                                    <td class="px-4 py-3 text-sm text-gray-900"><?= esc($b['date'] ?? '-') ?></td>
                                    <td class="px-4 py-3 text-sm text-gray-900"><?= esc($b['time_slot'] ?? '-') ?></td>
                                    <td class="px-4 py-3 text-sm text-gray-900"><?= esc($b['username'] ?? '-') ?></td>
                                    <td class="px-4 py-3 text-sm">
                                        <?php if($b['status'] == 'approved'): ?>
                                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Approved</span>
                                        <?php elseif($b['status'] == 'rejected'): ?>
                                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Rejected</span>
                                        <?php else: ?>
                                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Pending</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <form action="<?= site_url('admin/bookings/edit/' . $b['bookingId']) ?>" method="post" class="inline-block">
                                            <select name="status" class="border border-gray-300 rounded px-2 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="this.form.submit()">
                                                <option value="pending" <?= $b['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                                <option value="approved" <?= $b['status'] == 'approved' ? 'selected' : '' ?>>Approved</option>
                                                <option value="rejected" <?= $b['status'] == 'rejected' ? 'selected' : '' ?>>Rejected</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="text-center mt-6">
        <a href="<?= site_url('/dashboard') ?>" class="inline-block border border-gray-400 text-gray-700 hover:bg-gray-100 font-semibold py-2 px-6 rounded">
            Back to Main Page
        </a>
    </div>
</div>

<?= $this->endSection() ?>