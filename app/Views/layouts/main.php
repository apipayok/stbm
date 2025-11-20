<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>.:: STBM MAIM | Sistem Tempahan Bilik Mesyuarat MAIM ::.</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('/css/main.css') ?>">
</head>

<body class="bg-gray-100">
    <div class="flex">

        <!-- Sidebar -->
        <nav class="bg-green-950 text-white p-4 h-screen w-54 flex flex-col">
            <?php $uri = service('uri'); ?>

            <h4 class="text-xl font-bold mb-6">STBM</h4>
            <ul class="flex flex-col h-full space-y-2 ">

                <?php if (session()->get('is_admin') == 0): ?>
                    <li>
                        <a class="block text-white px-3 py-2 rounded hover:bg-green-900 transform transition duration-200 ease-in-out hover:scale-105"
                            href="<?= site_url('dashboard') ?>">
                            Utama
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (session()->get('is_admin') == 1): ?>

                    <li>
                        <a class="block text-white px-3 py-2 rounded hover:bg-green-900 transform transition duration-200 ease-in-out hover:scale-105"
                            href="<?= site_url('admin/dashboard') ?>">
                            Utama
                        </a>
                    </li>

                    <li>
                        <a class="block text-white px-3 py-2 rounded hover:bg-green-900 transform transition duration-200 ease-in-out hover:scale-105"
                            href="<?= site_url('admin/users') ?>">
                            Pengguna
                        </a>
                    </li>

                    <li>
                        <button
                            class="block text-white px-3 py-2 rounded hover:bg-green-900 transform transition duration-200 ease-in-out hover:scale-105"
                            onclick="document.getElementById('bookingMenu').classList.toggle('hidden')">
                            Tempahan
                            <span></span>
                        </button>

                        <div id="bookingMenu"
                            class="pl-4 mt-1 space-y-2 <?= ($uri->getSegment(2) === 'bookings') ? '' : 'hidden' ?>">

                            <a class="block text-white hover:bg-green-900 px-3 py-1 rounded"
                                href="<?= site_url('admin/bookings') ?>">Dashboard</a>
                            <a class="block text-white hover:bg-green-900 px-3 py-1 rounded"
                                href="<?= site_url('admin/bookings/pending') ?>">Kelulusan</a>

                            <a class="block text-white hover:bg-green-900 px-3 py-1 rounded"
                                href="<?= site_url('admin/bookings/approved') ?>">Dilulus</a>

                            <a class="block text-white hover:bg-green-900 px-3 py-1 rounded"
                                href="<?= site_url('admin/bookings/rejected') ?>">Ditolak</a>
                        </div>
                    </li>

                    <li>
                        <a class="block text-white px-3 py-2 rounded hover:bg-green-900 transform transition duration-200 ease-in-out hover:scale-105"
                            href="<?= site_url('admin/rooms/view') ?>">
                            Bilik Mesyuarat
                        </a>
                    </li>

                <?php endif; ?>

                <li>
                    <a class="block text-white px-3 py-2 rounded hover:bg-green-900 transform transition duration-200 ease-in-out hover:scale-105"
                        href="<?= site_url('/rooms') ?>">
                        Tempah Bilik
                    </a>
                </li>

                <div class="flex bg-grey-100">
                </div>

                <li class="mt-auto pt-4">
                    <a class="block bg-red-900 text-white px-3 py-2 rounded hover:bg-red-800 transform transition duration-200 ease-in-out hover:scale-105"
                        href="<?= site_url('logout') ?>">
                        Logout
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content Section -->
        <main class="flex-1 w-full overflow-y-auto">
            <div>
                <?= $this->renderSection('content') ?>
            </div>
        </main>

    </div>

</body>

</html>