<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto p-4">
    <div class="bg-white shadow rounded-xl p-6">

        <h3 class="text-xl font-bold"><?= esc($data['room']['roomName']) ?></h3>
        <p class="text-gray-700 mt-1">
            <span class="font-semibold">Room ID:</span> <?= esc($data['room']['roomId']) ?>
        </p>

        <hr class="my-4 border-gray-300">

        <h5 class="text-lg font-semibold mb-3">
            Booking Summary for <?= date('d-m-Y', strtotime($data['date'])) ?>:
        </h5>

        <!-- Slots List -->
        <ul class="space-y-2 mb-4">
            <?php foreach ($data['slots'] as $slot): ?>
                <li class="flex justify-between items-center bg-gray-50 px-4 py-3 rounded-lg border">
                    <span class="text-gray-800"><?= esc($slot) ?></span>
                </li>
            <?php endforeach; ?>
        </ul>

        <!-- Reason Form -->
        <form method="post"
            action="<?= base_url('booking/create/' . $data['room']['roomId']) ?>"
            onsubmit="return confirmAction(this);">

            <input type="hidden" name="date" value="<?= esc($data['date']) ?>">

            <?php foreach ($data['slots'] as $slot): ?>
                <input type="hidden" name="slots[]" value="<?= esc($slot) ?>">
            <?php endforeach; ?>

            <label for="reason" class="font-semibold block mb-2">Reason for Booking:</label>
            <textarea
                id="reason"
                name="reason"
                required
                class="w-full border rounded-lg p-3 focus:ring focus:ring-blue-200 mb-4"
                placeholder="Enter the reason for booking..."></textarea>

            <button
                type="submit"
                class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                Confirm Booking
            </button>
        </form>

        <a
            href="<?= site_url('/rooms/' . $data['room']['roomId'] . '?date=' . $data['date']) ?>"
            class="inline-block mt-4 text-gray-700 hover:text-black">
            ← Back to Slot Selection
        </a>


    </div>
</div>




<?= $this->endSection() ?>