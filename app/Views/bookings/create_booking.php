<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto px-4 py-8">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="<?= site_url('/rooms') ?>" 
           class="inline-flex items-center text-gray-600 hover:text-gray-800 transition duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Senarai Bilik
        </a>
    </div>

    <div class="bg-white shadow-xl rounded-2xl overflow-hidden max-w-5xl mx-auto">
        <!-- Header Section with Gradient -->
        <div class="bg-gradient-to-r from-green-600 to-green-700 px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-2xl font-bold text-white mb-2"><?= esc($room['roomName']) ?></h3>
                    <div class="flex items-center text-green-100">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        <span class="text-sm font-medium">ID Bilik: <?= esc($room['roomId']) ?></span>
                    </div>
                </div>
                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-lg p-3">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="p-8">
            <!-- Date Selector Section -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-6 mb-6 border border-blue-100">
                <div class="flex items-center mb-4">
                    <div class="bg-blue-600 p-2 rounded-lg mr-3">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-800">Pilih Tarikh Tempahan</h4>
                </div>
                
                <form method="get" class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
                    <div class="flex-1 w-full">
                        <label for="date" class="block text-sm font-medium text-gray-700 mb-2">Tarikh:</label>
                        <div class="relative">
                            <input type="date" 
                                   id="date" 
                                   name="date"
                                   value="<?= esc($selectedDate ?? date('Y-m-d')) ?>"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                        </div>
                    </div>
                    
                    <button type="submit"
                            class="mt-6 sm:mt-0 inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-3 rounded-lg transition duration-200 shadow-md hover:shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Cari Slot
                    </button>
                </form>
            </div>

            <!-- Flash Messages -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4 mb-6 flex items-start">
                    <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <p class="text-green-800 font-medium"><?= session()->getFlashdata('success') ?></p>
                    </div>
                </div>
            <?php elseif (session()->getFlashdata('error')): ?>
                <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4 mb-6 flex items-start">
                    <svg class="w-5 h-5 text-red-500 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <p class="text-red-800 font-medium"><?= session()->getFlashdata('error') ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Time Slots Section -->
            <div class="mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h5 class="text-xl font-bold text-gray-800">
                        Slot Masa untuk <?= date('d M Y', strtotime($selectedDate ?? date('Y-m-d'))) ?>
                    </h5>
                    <div class="flex items-center space-x-4 text-sm">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                            <span class="text-gray-600">Tersedia</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></div>
                            <span class="text-gray-600">Menunggu</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-red-500 rounded-full mr-2"></div>
                            <span class="text-gray-600">Ditempah</span>
                        </div>
                    </div>
                </div>

                <?php if (!empty($timeSlots)): ?>
                    <form method="post" action="<?= base_url('booking/preview/' . $room['roomId']) ?>">
                        <input type="hidden" name="date" value="<?= esc($selectedDate ?? date('Y-m-d')) ?>">

                        <div class="bg-gray-50 rounded-xl p-4 mb-6">
                            <ul class="space-y-3">
                                <?php foreach ($timeSlots as $slot): ?>
                                    <?php
                                    $status = $slot['status'];
                                    $isAvailable = $status === 'available';
                                    
                                    $borderClass = match ($status) {
                                        'available' => 'border-green-200 hover:border-green-400 hover:bg-green-50',
                                        'booked' => 'border-red-200 bg-red-50',
                                        'pending' => 'border-yellow-200 bg-yellow-50',
                                        'unavailable' => 'border-gray-300 bg-gray-100',
                                        default => 'border-gray-200'
                                    };
                                    ?>

                                    <li class="flex justify-between items-center bg-white px-5 py-4 rounded-lg border-2 <?= $borderClass ?> transition duration-200">
                                        <div class="flex items-center">
                                            <div class="bg-gray-100 p-2 rounded-lg mr-3">
                                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            </div>
                                            <span class="font-semibold text-gray-800"><?= esc($slot['slot']) ?></span>
                                        </div>

                                        <?php if ($isAvailable): ?>
                                            <label class="flex items-center cursor-pointer group">
                                                <span class="mr-3 text-sm text-gray-600 group-hover:text-green-600 transition duration-200">Pilih slot ini</span>
                                                <input type="checkbox" 
                                                       name="slots[]" 
                                                       value="<?= esc($slot['slot']) ?>"
                                                       class="w-6 h-6 text-green-600 rounded focus:ring-2 focus:ring-green-500 cursor-pointer">
                                            </label>
                                        <?php else: ?>
                                            <?php
                                            $badgeClass = match ($status) {
                                                'booked' => 'bg-red-100 text-red-700 border-red-200',
                                                'pending' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                                                'unavailable' => 'bg-gray-200 text-gray-700 border-gray-300',
                                                default => 'bg-blue-100 text-blue-700 border-blue-200'
                                            };

                                            $badgeText = match ($status) {
                                                'booked' => 'Telah Ditempah',
                                                'pending' => 'Menunggu Kelulusan',
                                                'unavailable' => 'Tidak Tersedia',
                                                default => 'Tersedia'
                                            };
                                            
                                            $iconPath = match ($status) {
                                                'booked' => 'M5 13l4 4L19 7',
                                                'pending' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                                                'unavailable' => 'M6 18L18 6M6 6l12 12',
                                                default => 'M5 13l4 4L19 7'
                                            };
                                            ?>

                                            <span class="inline-flex items-center px-4 py-2 text-sm font-semibold rounded-lg border <?= $badgeClass ?>">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?= $iconPath ?>"/>
                                                </svg>
                                                <?= $badgeText ?>
                                            </span>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-3 justify-between items-center pt-4 border-t border-gray-200">
                            <p class="text-sm text-gray-600">
                                <span class="font-semibold">Nota:</span> Pilih satu atau lebih slot masa untuk meneruskan tempahan
                            </p>
                            <button type="submit"
                                    class="w-full sm:w-auto inline-flex items-center justify-center bg-green-600 hover:bg-green-700 text-white font-semibold px-8 py-3 rounded-lg transition duration-200 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                Tempah Slot Dipilih
                            </button>
                        </div>
                    </form>
                <?php else: ?>
                    <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-6 text-center">
                        <div class="flex justify-center mb-3">
                            <div class="bg-red-100 p-3 rounded-full">
                                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <p class="text-red-800 font-semibold text-lg">Tiada slot tersedia untuk tarikh ini</p>
                        <p class="text-red-600 text-sm mt-2">Sila pilih tarikh lain untuk melihat slot yang tersedia</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>