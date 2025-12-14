<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto p-4">
    <div class="bg-white shadow rounded-xl p-6">

        <h3 class="text-xl font-bold"><?= esc($room['roomName']) ?></h3>
        <p class="text-gray-700 mt-1">
            <span class="font-semibold">Room ID:</span> <?= esc($room['roomId']) ?>
        </p>

        <hr class="my-4 border-gray-300">

        <!-- Date selector -->
        <form method="get" class="mb-4 flex items-center gap-3">
            <label for="date" class="font-semibold">Select Date:</label>

            <input
                type="date"
                id="date"
                name="date"
                value="<?= esc($selectedDate ?? date('Y-m-d')) ?>"
                required
                class="px-3 py-2 border rounded-lg focus:ring focus:ring-blue-200">

            <button
                type="submit"
                class="bg-blue-600 text-white px-3 py-2 rounded-lg hover:bg-blue-700">
                Apply
            </button>
        </form>

        <h5 class="text-lg font-semibold mb-3">
            Time Slots for <?= date('d-m-Y', strtotime($selectedDate ?? date('Y-m-d'))) ?>:
        </h5>

        <!-- Flash Messages -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php elseif (session()->getFlashdata('error')): ?>
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Time Slots -->
        <?php if (!empty($timeSlots)): ?>
            <form method="post" action="<?= base_url('booking/preview/' . $room['roomId']) ?>">
                <input type="hidden" name="date" value="<?= esc($selectedDate ?? date('Y-m-d')) ?>">

                <ul class="space-y-2 mb-4">
                    <?php foreach ($timeSlots as $slot): ?>
                        <?php
                        $status = $slot['status'];
                        $isAvailable = $status === 'available';
                        ?>

                        <li class="flex justify-between items-center bg-gray-50 px-4 py-3 rounded-lg border">
                            <span class="text-gray-800"><?= esc($slot['slot']) ?></span>

                            <?php if ($isAvailable): ?>
                                <!-- Checkbox -->
                                <input
                                    type="checkbox"
                                    name="slots[]"
                                    value="<?= esc($slot['slot']) ?>"
                                    class="w-5 h-5 text-blue-600 rounded focus:ring-blue-400">
                            <?php else: ?>
                                <!-- Status badge -->
                                <?php
                                $badgeClass = match ($status) {
                                    'booked' => 'bg-green-100 text-green-700',
                                    'pending' => 'bg-yellow-100 text-yellow-700',
                                    'unavailable' => 'bg-red-100 text-red-700',
                                    default => 'bg-blue-100 text-blue-700'
                                };

                                $badgeText = match ($status) {
                                    'booked' => 'Room Reserved',
                                    'pending' => 'Awaiting Approval',
                                    'unavailable' => 'Not Available',
                                    default => 'Available'
                                };
                                ?>

                                <span class="px-3 py-1 text-sm font-semibold rounded-lg <?= $badgeClass ?>">
                                    <?= $badgeText ?>
                                </span>
                            <?php endif; ?>
                        </li>

                    <?php endforeach; ?>
                </ul>

                <!-- Redirect to summary page on click -->
                <button
                    type="submit"
                    class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700">
                    Book Selected Slots
                </button>
            </form>
        <?php else: ?>
            <p class="text-red-600">No available slots for this date.</p>
        <?php endif; ?>


        <a
            href="<?= site_url('/rooms') ?>"
            class="inline-block mt-4 text-gray-700 hover:text-black">
            ← Back to Rooms
        </a>

    </div>
</div>

<?= $this->endSection() ?>