<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto px-4 py-8">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="<?= site_url('/rooms') ?>"
           class="inline-flex items-center text-gray-600 hover:text-gray-800 transition duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Senarai Bilik
        </a>
    </div>

    <div class="bg-white shadow-xl rounded-2xl overflow-hidden max-w-5xl mx-auto">
        <!-- Header -->
        <div class="bg-gradient-to-r from-green-600 to-green-700 px-8 py-6">
            <h3 class="text-2xl font-bold text-white mb-2"><?= esc($room['roomName']) ?></h3>
            <p class="text-green-100 text-sm">ID Bilik: <?= esc($room['roomId']) ?></p>
        </div>

        <div class="p-8">
            <!-- Date Selector -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-6 mb-6 border border-blue-100">
                <form method="get" class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
                    <div class="flex-1 w-full">
                        <label for="date" class="block text-sm font-medium text-gray-700 mb-2">Tarikh:</label>
                        <input type="date"
                               id="date"
                               name="date"
                               value="<?= esc($selectedDate ?? date('Y-m-d')) ?>"
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                    </div>
                    <button type="submit"
                            class="mt-6 sm:mt-0 inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-3 rounded-lg transition duration-200 shadow-md hover:shadow-lg">
                        Cari Slot
                    </button>
                </form>
            </div>

            <!-- Flash Messages -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4 mb-6">
                    <p class="text-green-800 font-medium"><?= session()->getFlashdata('success') ?></p>
                </div>
            <?php elseif (session()->getFlashdata('error')): ?>
                <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4 mb-6">
                    <p class="text-red-800 font-medium"><?= session()->getFlashdata('error') ?></p>
                </div>
            <?php endif; ?>

            <!-- Time Slots -->
            <h5 class="text-xl font-bold text-gray-800 mb-4">
                Slot Masa untuk <?= date('d M Y', strtotime($selectedDate ?? date('Y-m-d'))) ?>
            </h5>

            <?php if (!empty($timeSlots)): ?>
                <form method="post" action="<?= base_url('booking/create/' . $room['roomId']) ?>">
                    <input type="hidden" name="date" value="<?= esc($selectedDate ?? date('Y-m-d')) ?>">

                    <div class="bg-gray-50 rounded-xl p-6 mb-6 space-y-4">
                        <!-- Start Time -->
                        <div>
                            <label for="book_start" class="block font-medium text-gray-700 mb-2">Masa Mula</label>
                            <select id="book_start" name="book_start"
                                    class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-500">
                                <option value="">-- Pilih Masa Mula --</option>
                                <?php foreach ($timeSlots as $slot): ?>
                                    <?php if ($slot['status'] === 'available'): ?>
                                        <option value="<?= esc($slot['book_start']) ?>"><?= esc($slot['book_start']) ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- End Time -->
                        <div>
                            <label for="book_end" class="block font-medium text-gray-700 mb-2">Masa Tamat</label>
                            <select id="book_end" name="book_end"
                                    class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-500" disabled>
                                <option value="">-- Pilih Masa Tamat --</option>
                            </select>
                        </div>

                        <!-- Reason -->
                        <div>
                            <label for="reason" class="block font-medium text-gray-700 mb-2">Sebab Tempahan</label>
                            <textarea name="reason" id="reason" rows="3"
                                      class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-green-500"
                                      required></textarea>
                        </div>

                        <button type="submit"
                                class="w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white font-semibold px-8 py-3 rounded-lg transition duration-200 shadow-lg hover:shadow-xl">
                            Tempah
                        </button>
                    </div>
                </form>

                <script>
                    const timeSlots = <?= json_encode($timeSlots) ?>;
                    const startSelect = document.getElementById('book_start');
                    const endSelect = document.getElementById('book_end');

                    startSelect.addEventListener('change', () => {
                        const start = startSelect.value;
                        endSelect.innerHTML = '<option value="">-- Pilih Masa Tamat --</option>';

                        if (!start) {
                            endSelect.disabled = true;
                            return;
                        }

                        let startFound = false;
                        for (let i = 0; i < timeSlots.length; i++) {
                            const slot = timeSlots[i];
                            if (slot.status !== 'available') continue;

                            if (slot.book_start === start) startFound = true;

                            if (startFound) {
                                endSelect.appendChild(new Option(slot.book_start, slot.book_start));

                                if (timeSlots[i + 1] && timeSlots[i + 1].status !== 'available') break;
                            }
                        }

                        endSelect.disabled = false;
                    });
                </script>
            <?php else: ?>
                <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-6 text-center">
                    <p class="text-red-800 font-semibold text-lg">Tiada slot tersedia untuk tarikh ini</p>
                    <p class="text-red-600 text-sm mt-2">Sila pilih tarikh lain untuk melihat slot yang tersedia</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
