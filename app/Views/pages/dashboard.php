<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto p-4 md:p-6 space-y-6 no-scrollbar">

    <!-- Header Selamat Datang -->
    <div class="bg-gradient-to-r from-green-600 to-green-700 shadow-xl rounded-2xl p-6 md:p-8">
        <h2 class="text-2xl md:text-3xl font-bold text-white">
            ✨ Selamat Datang, <?= esc($username) ?>!
        </h2>
        <p class="text-green-50 mt-2">Semoga hari anda menyenangkan</p>
    </div>

    <!-- Pengumuman -->
    <div class="bg-white shadow-xl rounded-2xl p-6 md:p-8 border border-gray-100">
        <div class="flex items-center gap-3 mb-6">
            <div class="bg-blue-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800">Pengumuman</h3>
        </div>

        <?php if (!empty($announcement)): ?>
            <div class="space-y-4">
                <?php foreach ($announcement as $a): ?>
                    <div class="border-l-4 border-green-500 bg-green-50 rounded-lg p-5 hover:shadow-md transition-shadow">
                        <h4 class="text-lg font-bold text-gray-800 mb-2"><?= esc($a['title']) ?></h4>
                        <p class="text-gray-600 leading-relaxed"><?= esc($a['content']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-8">
                <p class="text-gray-400 text-lg">Tiada pengumuman pada masa ini</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Tempahan Pengguna -->
    <div class="bg-white shadow-xl rounded-2xl p-6 md:p-8 border border-gray-100">
        <div class="flex items-center gap-3 mb-6">
            <div class="bg-purple-100 p-3 rounded-lg">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800">Tempahan Anda</h3>
        </div>

        <!-- Penapis Status -->
        <div class="flex flex-wrap gap-2 mb-6">
            <?php
            $statuses = [
                ''          => 'Semua',
                'approved'  => 'Diluluskan',
                'pending'   => 'Menunggu',
                'rejected'  => 'Ditolak'
            ];
            foreach ($statuses as $key => $label):
                $active = ($status === $key)
                    ? 'bg-green-600 text-white shadow-lg transform scale-105'
                    : 'bg-gray-100 text-gray-700 hover:bg-gray-200 hover:shadow-md';
            ?>
                <a href="<?= site_url('/dashboard?status=' . $key) ?>"
                   class="px-5 py-2.5 rounded-lg font-semibold transition-all duration-200 <?= $active ?>">
                    <?= $label ?>
                </a>
            <?php endforeach; ?>
        </div>

        <?php if (!empty($userBookings)): ?>
            <div class="overflow-x-auto rounded-xl border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-green-50 to-green-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-green-900 uppercase tracking-wider">Tarikh</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-green-900 uppercase tracking-wider">Bilik</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-green-900 uppercase tracking-wider">Masa</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-green-900 uppercase tracking-wider">Tujuan</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-green-900 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-green-900 uppercase tracking-wider">Tindakan</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($userBookings as $b): ?>
                            <tr class="hover:bg-green-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-gray-800 font-medium"><?= date('d-m-Y', strtotime($b['date'])) ?></span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-gray-800 font-medium"><?= esc($b['roomName'] ?? $b['room']) ?></span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                    <?= esc($b['book_start'] ?? '-') ?> - <?= esc($b['book_end'] ?? '-') ?>
                                </td>
                                <td class="px-6 py-4 text-gray-700">
                                    <div class="max-w-xs truncate"><?= esc($b['reason']) ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php
                                    $statusConfig = [
                                        'approved' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'label' => 'Diluluskan'],
                                        'pending'  => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'label' => 'Menunggu'],
                                        'rejected' => ['bg' => 'bg-red-100', 'text' => 'text-red-800', 'label' => 'Ditolak'],
                                    ];
                                    $config = $statusConfig[$b['status']] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-800', 'label' => ucfirst($b['status'])];
                                    ?>
                                    <span class="px-3 py-1.5 rounded-full text-xs font-bold <?= $config['bg'] ?> <?= $config['text'] ?>">
                                        <?= $config['label'] ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if (in_array($b['status'], ['approved', 'rejected'])): ?>
                                        <button type="button"
                                            data-popup-url="<?= base_url('/dashboard/view/' . $b['bookingId'])
                                                                . '?roomName=' . urlencode($b['roomName'])
                                                                . '&date=' . urlencode($b['date'])
                                                                . '&reason=' . urlencode($b['reason']) ?>"
                                            class="px-4 py-2 text-sm font-semibold bg-blue-600 text-white rounded-lg hover:bg-blue-700 hover:shadow-lg transition-all duration-200 transform hover:scale-105">
                                            Lihat
                                        </button>
                                    <?php else: ?>
                                        <span class="text-gray-400 text-sm font-medium">—</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                <?= $pager->links('userBookings', 'numbering') ?>
            </div>

        <?php else: ?>
            <div class="text-center py-12">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <p class="text-gray-500 text-lg">Tiada tempahan dijumpai</p>
                <p class="text-gray-400 text-sm mt-2">Anda belum membuat sebarang tempahan lagi</p>
            </div>
        <?php endif; ?>

    </div>

</div>

<?= $this->endSection() ?>