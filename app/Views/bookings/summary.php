<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto p-4">
    <div class="bg-white shadow-lg rounded-xl p-6">

        <h2 class="text-2xl font-bold mb-2">Booking Summary</h2>

        <?php if (empty($data['mergedSlots'])): ?>
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded-lg">
                No bookings found for this filter.
            </div>

        <?php else: ?>
            <div class="space-y-4">
                <div class="border rounded-lg p-4 bg-gray-50 shadow-sm hover:shadow-md transition duration-200">

                    <h3 class="text-lg font-semibold text-gray-800">
                        Booking Summary
                    </h3>

                    <div class="mt-2 text-gray-700 space-y-1">
                        <p><strong>Room:</strong> <?= esc($data['bookings'][0]['roomName'] ?? 'Unknown Room') ?></p>
                        <p><strong>User:</strong> <?= esc($data['username']) ?></p>
                        <p><strong>Date:</strong> <?= esc($data['date']) ?></p>
                        <p><strong>Reason:</strong> <?= esc($data['reason'] ?? '-') ?></p>

                        <!-- Show merged time slots as 1 -->
                        <p><strong>Time:</strong>
                            <?= implode(', ', $data['mergedSlots']) ?>
                        </p>

                        <!-- Status badges (merged all bookings into one) -->
                        <?php
                            // If all bookings have same status, use it; otherwise "Multiple"
                            $statuses = array_unique(array_column($data['bookings'], 'status'));
                            $status = count($statuses) === 1 ? $statuses[0] : 'multiple';
                            $badge = [
                                'pending'   => 'bg-yellow-100 text-yellow-700',
                                'approved'  => 'bg-green-100 text-green-700',
                                'rejected'  => 'bg-red-100 text-red-700',
                                'cancelled' => 'bg-gray-200 text-gray-700',
                                'multiple'  => 'bg-blue-100 text-blue-700'
                            ][$status] ?? 'bg-blue-100 text-blue-700';
                        ?>
                        <p><strong>Status:</strong>
                            <span class="px-2 py-1 rounded-md text-sm font-medium <?= $badge ?>">
                                <?= ucfirst($status) ?>
                            </span>
                        </p>
                    </div>

                </div>
            </div>
        <?php endif; ?>

        <a href="<?= site_url('admin/bookings/approved') ?>"
           class="inline-block mt-6 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            ← Back
        </a>

    </div>
</div>

<?= $this->endSection() ?>
