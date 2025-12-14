<div class="space-y-4">

    <h2 class="text-2xl font-bold mb-2">Booking Summary</h2>

    <?php if (empty($data['mergedSlots'])): ?>
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded-lg">
            No bookings found for this filter.
        </div>

    <?php else: ?>
        <div class="border rounded-lg p-4 bg-gray-50 shadow-sm">

            <h3 class="text-lg font-semibold text-gray-800">
                Booking Summary
            </h3>

            <div class="mt-2 text-gray-700 space-y-1">
                <p><strong>Room:</strong> <?= esc($data['bookings'][0]['roomName'] ?? 'Unknown Room') ?></p>
                <p><strong>User:</strong> <?= esc($data['username']) ?></p>
                <p><strong>Date:</strong> <?= esc($data['date']) ?></p>
                <p><strong>Reason:</strong> <?= esc($data['reason'] ?? '-') ?></p>

                <p><strong>Time:</strong>
                    <?= implode(', ', $data['mergedSlots']) ?>
                </p>

                <?php
                    $statuses = array_unique(array_column($data['bookings'], 'status'));
                    $status = count($statuses) === 1 ? $statuses[0] : 'multiple';
                    $badge = [
                        'pending'   => 'bg-yellow-100 text-yellow-700',
                        'approved'  => 'bg-green-100 text-green-700',
                        'rejected'  => 'bg-red-100 text-red-700',
                    ][$status] ?? 'bg-blue-100 text-blue-700';
                ?>

                <p><strong>Status:</strong>
                    <span class="px-2 py-1 rounded-md text-sm font-medium <?= $badge ?>">
                        <?= ucfirst($status) ?>
                    </span>
                </p>
            </div>

        </div>
    <?php endif; ?>

</div>
