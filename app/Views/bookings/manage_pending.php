<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto px-4 py-8">

    <h2 class="mb-4 text-3xl font-semibold text-green-800">URUS TEMPAHAN</h2>

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
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border-b">Reason</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 border-b">Change Status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        <?php if (empty($data['bookings'])): ?>
                            <tr>
                                <td colspan="7" class="px-4 py-4 text-center text-gray-500">No bookings found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($data['bookings'] as $index => $b): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm text-gray-900">
                                        <?= ($data['pager']->getCurrentPage('bookings') - 1) * $data['pager']->getPerPage('bookings') + ($index + 1) ?>
                                    </td>

                                    <td class="px-4 py-3 text-sm text-gray-900"><?= esc($b['roomName'] ?? 'Unknown') ?></td>
                                    <td class="px-4 py-3 text-sm text-gray-900"><?= esc($b['date'] ?? '-') ?></td>
                                    <td class="px-4 py-3 text-sm text-gray-900"><?= esc($b['time_slot'] ?? '-') ?></td>
                                    <td class="px-4 py-3 text-sm text-gray-900"><?= esc($b['username'] ?? '-') ?></td>
                                    <td class="px-4 py-3 text-sm text-gray-900"><?= esc($b['reason'] ?? '-') ?></td>

                                    <!-- Change status dropdown -->
                                    <td class="px-4 py-3 text-sm">
                                        <form action="<?= site_url('admin/bookings/edit/' . $b['bookingId']) ?>" method="post">
                                            <select name="status" class="border border-gray-300 rounded px-2 py-1 text-sm"
                                                    onchange="this.form.submit()">
                                                <option value="pending"  <?= $b['status'] == 'pending'  ? 'selected' : '' ?>>Pending</option>
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

            <!-- PAGINATION LINKS -->
            <div class="mt-6">
                <?= $data['pager']->links('bookings', 'numbering') ?>
            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>
