<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto p-4">
    <div class="bg-white shadow-lg rounded-xl p-6">

        <h2 class="text-2xl font-bold mb-4">Ringkasan Tempahan</h2>

        <?php if (empty($data['mergedSlots'])): ?>
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded-lg">
                Tiada tempahan ditemui untuk penapis ini.
            </div>

        <?php else: ?>
            <div class="space-y-4">
                <div class="border rounded-lg p-4 bg-gray-50 shadow-sm hover:shadow-md transition duration-200">

                    <h3 class="text-lg font-semibold text-gray-800">Maklumat Tempahan</h3>

                    <div class="mt-2 text-gray-700 space-y-1">
                        <p><strong>Bilik:</strong> <?= esc($data['bookings'][0]['roomName'] ?? 'Bilik Tidak Diketahui') ?></p>
                        <p><strong>Pengguna:</strong> <?= esc($data['username']) ?></p>
                        <p><strong>Tarikh:</strong> <?= esc($data['date']) ?></p>
                        <p><strong>Sebab:</strong> <?= esc($data['reason'] ?? '-') ?></p>

                        <!-- Merged time slots -->
                        <p><strong>Masa:</strong> <?= implode(', ', $data['mergedSlots']) ?></p>

                        <!-- Status badge -->
                        <?php
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

        <a href="<?= site_url('/dashboard?status=' . ($status ?? '')) ?>"
           class="inline-block mt-6 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            ← Kembali
        </a>

    </div>
</div>

<?= $this->endSection() ?>
