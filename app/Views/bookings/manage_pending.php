<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center mb-2">
            <div class="bg-purple-100 p-2 rounded-lg mr-3">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
            </div>
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Urus Tempahan</h2>
                <p class="text-gray-600 text-sm">Semak dan tukar status tempahan</p>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4 mb-6 flex items-start">
            <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <div>
                <p class="text-green-800 font-medium"><?= session()->getFlashdata('success') ?></p>
            </div>
        </div>
    <?php elseif (session()->getFlashdata('error')): ?>
        <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4 mb-6 flex items-start">
            <svg class="w-5 h-5 text-red-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            <div>
                <p class="text-red-800 font-medium"><?= session()->getFlashdata('error') ?></p>
            </div>
        </div>
    <?php endif; ?>

    <!-- Bookings Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-purple-600 to-purple-700">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">#</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Bilik</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Tarikh</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Masa</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Ditempah Oleh</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Sebab</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">Tukar Status</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (empty($data['bookings'])): ?>
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="bg-gray-100 p-4 rounded-full mb-3">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                        </svg>
                                    </div>
                                    <p class="text-gray-500 font-medium">Tiada tempahan dijumpai</p>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($data['bookings'] as $index => $b): ?>
                            <tr class="hover:bg-purple-50 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center justify-center w-8 h-8 bg-purple-100 rounded-full">
                                        <span class="text-sm font-semibold text-purple-700">
                                            <?= ($data['pager']->getCurrentPage('bookings') - 1) * $data['pager']->getPerPage('bookings') + ($index + 1) ?>
                                        </span>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                        <span class="text-sm font-medium text-gray-900"><?= esc($b['roomName'] ?? 'Unknown') ?></span>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span class="text-sm text-gray-900">
                                            <?= $b['date'] ? date('d M Y', strtotime($b['date'])) : '-' ?>
                                        </span>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-sm text-gray-900">
                                            <?= esc($b['book_start'] ?? '-') . ' - ' . esc($b['book_end'] ?? '-') ?>
                                        </span>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8 bg-purple-100 rounded-full flex items-center justify-center">
                                            <span class="text-purple-700 font-semibold text-xs">
                                                <?= strtoupper(substr(esc($b['username'] ?? 'N'), 0, 2)) ?>
                                            </span>
                                        </div>
                                        <span class="ml-2 text-sm text-gray-900"><?= esc($b['username'] ?? '-') ?></span>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 max-w-xs truncate" title="<?= esc($b['reason'] ?? '-') ?>">
                                        <?= esc($b['reason'] ?? '-') ?>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <div class="flex flex-wrap gap-2 justify-center">
                                        <?php if ($b['status'] !== 'approved'): ?>
                                            <form action="<?= site_url('admin/bookings/edit/' . $b['bookingId']) ?>" method="post" class="inline"
                                                onsubmit="return confirmAction(this, 'Adakah anda pasti untuk meluluskan tempahan ini?', 'Tempahan diluluskan!')">
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-green-600 rounded-lg text-xs font-medium text-green-700 bg-green-50 hover:bg-green-100 transition duration-150">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                    </svg>
                                                    Lulus
                                                </button>
                                            </form>
                                        <?php endif; ?>

                                        <?php if ($b['status'] !== 'rejected'): ?>
                                            <form action="<?= site_url('admin/bookings/edit/' . $b['bookingId']) ?>" method="post" class="inline"
                                                onsubmit="return confirmAction(this, 'Adakah anda pasti untuk menolak tempahan ini?', 'Tempahan ditolak!')">
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-red-600 rounded-lg text-xs font-medium text-red-700 bg-red-50 hover:bg-red-100 transition duration-150">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                    Tolak
                                                </button>
                                            </form>
                                        <?php endif; ?>

                                        <?php if ($b['status'] !== 'pending'): ?>
                                            <form action="<?= site_url('admin/bookings/edit/' . $b['bookingId']) ?>" method="post" class="inline"
                                                onsubmit="return confirmAction(this, 'Adakah anda pasti untuk set tempahan ini kepada pending?', 'Tempahan set kepada pending!')">
                                                <input type="hidden" name="status" value="pending">
                                                <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-yellow-600 rounded-lg text-xs font-medium text-yellow-700 bg-yellow-50 hover:bg-yellow-100 transition duration-150">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    Pending
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <?php if (!empty($data['bookings'])): ?>
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                <?= $data['pager']->links('bookings', 'numbering') ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
