<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto px-4 py-6">
    <h2 class="mb-4 text-3xl font-semibold text-green-800">DASHBOARD ADMIN</h2>

    <!-- Summary Cards -->
    <div class="grid grid-cols-3 gap-2 py-2">

        <!--div kiri user-->
        <div class="bg-gray-800 rounded-md grid col-start-1">
            <h1 class="text-l text-white px-4 py-2">PENGGUNA</h1>
            <div class="bg-gray-50 rounded-md grid grid-cols-2 grid-rows-2 gap-2 p-2">
                <a href="<?= base_url('admin/users') ?>">
                    <div class="bg-white rounded-md shadow p-4 text-center col-start-1 row-start-1 transform transition duration-200 ease-in-out hover:scale-105">
                        <h5 class="text-black font-medium">Pengguna</h5>
                        <h3 class="text-2xl font-bold"><?= count($data['users']) ?></h3>
                    </div>
                </a>
                <a href="<?= base_url('admin/users') ?>">
                    <div class="bg-white rounded-md shadow p-4 text-center col-start-2 row-start-1 transform transition duration-200 ease-in-out hover:scale-105">
                        <h5 class="text-black font-medium">Admin</h5>
                        <h3 class="text-2xl font-bold"><?= esc($data['admin']) ?></h3>
                    </div>
                </a>
            </div>
        </div>

        <!--div tengah booking-->
        <div class="bg-gray-800 rounded-md grid col-start-2">
            <h1 class="text-Xl text-white px-4 py-2">TEMPAHAN</h1>
            <div class="bg-gray-50 rounded-md grid grid-cols-2 grid-rows-2 gap-2 p-2">
                <div class="bg-white rounded-md shadow p-4 text-center col-start-1 row-start-1 transform transition duration-200 ease-in-out hover:scale-105">
                    <h5 class="text-black font-medium">Jumlah Tempahan</h5>
                    <h3 class="text-2xl font-bold"><?= count($data['bookings']) ?></h3>
                </div>
                <a href="<?= base_url('admin/bookings/pending') ?>">
                    <div class="bg-white rounded-md shadow p-4 text-center col-start-1 row-start-2 transform transition duration-200 ease-in-out hover:scale-105">
                        <h5 class="text-black font-medium">Kelulusan</h5>
                        <h3 class="text-2xl font-bold"><?= esc($data['pendingCount']) ?></h3>
                    </div>
                </a>
                <a href="<?= base_url('admin/bookings/approved') ?>">
                    <div class="bg-white rounded-md shadow p-4 text-center col-start-2 row-start-1 transform transition duration-200 ease-in-out hover:scale-105">
                        <h5 class="text-black font-medium">Diluluskan</h5>
                        <h3 class="text-2xl font-bold"><?= esc($data['approvedCount']) ?></h3>
                    </div>
                </a>
                <a href="<?= base_url('admin/bookings/rejected') ?>">
                    <div class="bg-white rounded-md shadow p-4 text-center col-start-2 row-start-2 transform transition duration-200 ease-in-out hover:scale-105">
                        <h5 class="text-black font-medium">Ditolak</h5>
                        <h3 class="text-2xl font-bold"><?= esc($data['rejectedCount']) ?></h3>
                    </div>
                </a>
            </div>
        </div>

        <!--div kanan rooms-->
        <div class="bg-gray-800 rounded-md grid col-start-3">
            <h1 class="text-Xl text-white px-4 py-2">BILIK</h1>
            <div class="bg-gray-50 rounded-md grid grid-cols-2 grid-rows-2 gap-2 p-2">
                <a href="<?= base_url('admin/rooms/view') ?>">
                    <div class="bg-white rounded-md shadow p-4 text-center col-start-1 row-start-1 transform transition duration-200 ease-in-out hover:scale-105">
                        <h5 class="text-black font-medium">Bilangan Bilik</h5>
                        <h3 class="text-2xl font-bold"><?= count($data['rooms']) ?></h3>
                    </div>
                </a>
                <a href="<?= base_url('admin/rooms/view') ?>">
                    <div class="bg-white rounded-md shadow p-4 text-center col-start-2 row-start-1 transform transition duration-200 ease-in-out hover:scale-105">
                        <h5 class="text-black font-medium">Bilik Buka</h5>
                        <h3 class="text-2xl font-bold"><?= esc($data['countAvailable']) ?></h3>
                    </div>
                </a>
                <a href="<?= base_url('admin/rooms/view') ?>">
                    <div class="bg-white rounded-md shadow p-4 text-center col-start-2 row-start-2 transform transition duration-200 ease-in-out hover:scale-105">
                        <h5 class="text-black font-medium">Bilik Tutup</h5>
                        <h3 class="text-2xl font-bold"><?= esc($data['countHidden']) ?></h3>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white w-3/5 rounded-md shadow mb-6 overflow-hidden">
        <div class="bg-gray-800 text-white px-4 py-3 flex justify-between items-center">
            <span class="text-lg font-semibold">PENGUMUMAN</span>

            <a href="<?= site_url('/admin/dashboard/announcement') ?>"
                class="bg-green-600 hover:bg-green-700 text-white text-sm px-4 py-1.5 rounded">
                Pengumuman Baru
            </a>
        </div>

        <div class="p-4">
            <?php if (!empty($data['announcements'])): ?>
                <ul class="divide-y divide-gray-200">
                    <?php foreach ($data['announcements'] as $a): ?>
                        <li class="py-3">
                            <strong class="text-gray-900"><?= esc($a['title']) ?></strong><br>
                            <span class="text-gray-700"><?= esc($a['content']) ?></span><br>
                            <small class="text-gray-500">
                                Posted <?= esc(date('d M Y', strtotime($a['created_at']))) ?>
                            </small>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-gray-500">No announcements yet.</p>
            <?php endif; ?>
        </div>
    </div>


</div>

<?= $this->endSection() ?>