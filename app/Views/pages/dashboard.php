<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto p-3 space-y-3 no-scrollbar">

    <!-- Welcome Header -->
    <div class="bg-white max-w-max shadow-lg rounded-xl p-6">
        <h2 class="text-2xl font-bold text-green-950 mb-1">Selamat Datang, <?= esc($username) ?>!</h2>
    </div>

    <!-- Announcements -->
    <div class="bg-white w-3/5 shadow-lg rounded-xl p-6">
        <h3 class="text-xl font-bold mb-4">PENGUNGUMAN</h3>

        <?php if (!empty($announcement)): ?>
            <ul class="space-y-2">
                <?php foreach ($announcement as $a): ?>
                    <li class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition">
                        <h4 class="text-xl font-bold text-gray-800"><?= esc($a['title']) ?></h4>
                        <p class="text-gray-500"><?= esc($a['content']) ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="text-gray-500">No announcements available.</p>
        <?php endif; ?>
    </div>

    <!-- Your Bookings -->
    <div class="bg-white shadow-lg rounded-xl p-6 space-y-4">
        <h3 class="text-xl font-semibold">TEMPAHAN ANDA</h3>

        <!-- Status Toggle -->
        <div class="flex space-x-2 mb-4">
            <?php
            $statuses = ['' => 'All', 'approved' => 'Approved', 'pending' => 'Pending', 'rejected' => 'Rejected'];
            foreach ($statuses as $key => $label):
                $active = ($status === $key) ? 'bg-green-700 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300';
            ?>
                <a href="<?= site_url('/dashboard?status=' . $key) ?>"
                    class="px-4 py-2 rounded-md font-medium transition <?= $active ?>">
                    <?= $label ?>
                </a>
            <?php endforeach; ?>
        </div>

        <?php if (!empty($userBookings)): ?>
            <div class="overflow-x-auto bg-white shadow rounded-xl">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-green-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-green-900 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-green-900 uppercase tracking-wider">Room</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-green-900 uppercase tracking-wider">Time</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-green-900 uppercase tracking-wider">Reason</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-green-900 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($userBookings as $b): ?>
                            <tr class="hover:bg-green-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-gray-700"><?= esc($b['date']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-700"><?= esc($b['roomName'] ?? $b['room']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-700"><?= esc($b['time_slot']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-700"><?= esc($b['reason']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php
                                    $statusColors = [
                                        'approved' => 'bg-green-100 text-green-800',
                                        'pending'  => 'bg-yellow-100 text-yellow-800',
                                        'rejected' => 'bg-red-100 text-red-800',
                                    ];
                                    $colorClass = $statusColors[$b['status']] ?? 'bg-gray-100 text-gray-800';
                                    ?>
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold <?= $colorClass ?>">
                                        <?= ucfirst($b['status']) ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                <?php
                // Preserve the status in pagination links
                echo $pager->links('userBookings', 'numbering');
                ?>
            </div>

        <?php else: ?>
            <p class="text-gray-500">You have no bookings yet.</p>
        <?php endif; ?>

    </div>

</div>

<?= $this->endSection() ?>
