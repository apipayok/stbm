<div class="container mx-auto p-4 space-y-6 h-4/5">
    <!-- Header -->
    <div class="flex items-center">
        <div class="bg-blue-100 p-2 rounded-lg mr-3">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
            </svg>
        </div>
        <h2 class="text-2xl font-bold text-gray-800">Ringkasan Tempahan</h2>
    </div>

    <?php if (empty($data['mergedSlots'])): ?>
        <!-- Empty State -->
        <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-6 text-center">
            <div class="flex justify-center mb-3">
                <div class="bg-red-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-red-800 font-semibold text-lg">Tiada Tempahan Dijumpai</p>
            <p class="text-red-600 text-sm mt-1">Tiada data tempahan untuk penapis ini</p>
        </div>

    <?php else: ?>
        <!-- Summary Card -->
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-xl shadow-lg overflow-hidden border border-gray-200">

            <!-- Card Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                <h3 class="text-lg font-semibold text-white flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Butiran Tempahan
                </h3>
            </div>

            <!-- Card Content -->
            <div class="p-6 space-y-4">
                <!-- Room -->
                <div class="flex items-start">
                    <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Bilik</p>
                        <p class="text-base font-semibold text-gray-900 mt-1">
                            <?= esc($data['bookings'][0]['roomName'] ?? 'Bilik Tidak Diketahui') ?>
                        </p>
                    </div>
                </div>

                <!-- User -->
                <div class="flex items-start">
                    <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Pengguna</p>
                        <p class="text-base font-semibold text-gray-900 mt-1"><?= esc($data['username']) ?></p>
                    </div>
                </div>

                <!-- Date -->
                <div class="flex items-start">
                    <div class="flex-shrink-0 w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Tarikh</p>
                        <p class="text-base font-semibold text-gray-900 mt-1">
                            <?= date('d M Y', strtotime($data['date'])) ?>
                        </p>
                    </div>
                </div>

                <!-- Time Slots -->
                <div class="flex items-start">
                    <div class="flex-shrink-0 w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Masa</p>
                        <div class="flex flex-wrap gap-2">
                            <?php foreach ($data['mergedSlots'] as $slot): ?>
                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-medium bg-orange-100 text-orange-700 border border-orange-200">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <?= esc($slot) ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Reason -->
                <div class="flex items-start">
                    <div class="flex-shrink-0 w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Sebab</p>
                        <p class="text-base text-gray-700 mt-1 leading-relaxed"><?= esc($data['reason'] ?? '-') ?></p>
                    </div>
                </div>

                <!-- Status -->
                <div class="flex items-start">
                    <div class="flex-shrink-0 w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Status</p>
                        <?php
                        $statuses = array_unique(array_column($data['bookings'], 'status'));
                        $status = count($statuses) === 1 ? $statuses[0] : 'multiple';

                        $statusConfig = [
                            'pending' => [
                                'badge' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                                'icon'  => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                                'label' => 'Menunggu'
                            ],
                            'approved' => [
                                'badge' => 'bg-green-100 text-green-700 border-green-200',
                                'icon'  => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                                'label' => 'Diluluskan'
                            ],
                            'rejected' => [
                                'badge' => 'bg-red-100 text-red-700 border-red-200',
                                'icon'  => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z',
                                'label' => 'Ditolak'
                            ],
                            'multiple' => [
                                'badge' => 'bg-blue-100 text-blue-700 border-blue-200',
                                'icon'  => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                                'label' => 'Pelbagai'
                            ]
                        ];

                        $config = $statusConfig[$status] ?? $statusConfig['multiple'];
                        ?>

                        <span class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-semibold border <?= $config['badge'] ?>">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?= $config['icon'] ?>"/>
                            </svg>
                            <?= $config['label'] ?>
                        </span>
                    </div>
                </div>

            </div>

            <!-- Card Footer -->
            <div class="bg-gray-50 px-6 py-3 border-t border-gray-200">
                <p class="text-xs text-gray-500 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Maklumat tempahan untuk rujukan anda
                </p>
            </div>
        </div>
    <?php endif; ?>

</div>

