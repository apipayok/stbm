<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>.:: STBM MAIM | Sistem Tempahan Bilik Mesyuarat MAIM ::.</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="/js/main.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('/css/main.css') ?>">
</head>

<body class="bg-gray-200">
    <div class="flex">

        <!-- Sidebar -->
        <nav class="bg-gradient-to-b from-green-900 to-green-950 text-white shadow-2xl h-screen w-64 flex flex-col fixed">
            <?php $uri = service('uri'); ?>

            <!-- Logo Section -->
            <div class="p-6 border-b border-green-800/50">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold tracking-wide">STBM</h4>
                        <p class="text-xs text-green-300">Sistem Tempahan</p>
                    </div>
                </div>
            </div>

            <!-- Navigation Menu -->
            <ul class="flex flex-col flex-1 px-3 py-4 space-y-1 overflow-y-auto">

                <?php if (session()->get('is_admin') == 0): ?>
                    <li>
                        <a class="sidebar-link flex items-center space-x-3 text-white px-4 py-3 rounded-lg hover:bg-green-800/50 transition-all duration-200"
                            href="<?= site_url('dashboard') ?>">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span class="font-medium">Utama</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (session()->get('is_admin') == 1): ?>

                    <li>
                        <a class="sidebar-link flex items-center space-x-3 text-white px-4 py-3 rounded-lg hover:bg-green-800/50 transition-all duration-200"
                            href="<?= site_url('admin/dashboard') ?>">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span class="font-medium">Utama</span>
                        </a>
                    </li>

                    <li>
                        <a class="sidebar-link flex items-center space-x-3 text-white px-4 py-3 rounded-lg hover:bg-green-800/50 transition-all duration-200"
                            href="<?= site_url('admin/users') ?>">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <span class="font-medium">Pengguna</span>
                        </a>
                    </li>

                    <li>
                        <button
                            class="sidebar-link w-full flex items-center justify-between text-white px-4 py-3 rounded-lg hover:bg-green-800/50 transition-all duration-200"
                            onclick="document.getElementById('bookingMenu').classList.toggle('hidden')">
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="font-medium">Tempahan</span>
                            </div>
                            <svg class="w-4 h-4 transition-transform" id="bookingIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div id="bookingMenu"
                            class="ml-4 mt-1 space-y-1 border-l-2 border-green-700 <?= ($uri->getSegment(2) === 'bookings') ? '' : 'hidden' ?>">

                            <a class="submenu-item flex items-center space-x-2 text-green-200 hover:text-white hover:bg-green-800/30 px-4 py-2 rounded-r-lg text-sm"
                                href="<?= site_url('admin/bookings/pending') ?>">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <circle cx="10" cy="10" r="3"></circle>
                                </svg>
                                <span>Kelulusan</span>
                            </a>

                            <a class="submenu-item flex items-center space-x-2 text-green-200 hover:text-white hover:bg-green-800/30 px-4 py-2 rounded-r-lg text-sm"
                                href="<?= site_url('admin/bookings/approved') ?>">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <circle cx="10" cy="10" r="3"></circle>
                                </svg>
                                <span>Dilulus</span>
                            </a>

                            <a class="submenu-item flex items-center space-x-2 text-green-200 hover:text-white hover:bg-green-800/30 px-4 py-2 rounded-r-lg text-sm"
                                href="<?= site_url('admin/bookings/rejected') ?>">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <circle cx="10" cy="10" r="3"></circle>
                                </svg>
                                <span>Ditolak</span>
                            </a>
                        </div>
                    </li>

                    <li>
                        <a class="sidebar-link flex items-center space-x-3 text-white px-4 py-3 rounded-lg hover:bg-green-800/50 transition-all duration-200"
                            href="<?= site_url('admin/rooms/view') ?>">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <span class="font-medium">Bilik Mesyuarat</span>
                        </a>
                    </li>

                <?php endif; ?>

                <li>
                    <a class="sidebar-link flex items-center space-x-3 text-white px-4 py-3 rounded-lg hover:bg-green-800/50 transition-all duration-200"
                        href="<?= site_url('/rooms') ?>">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span class="font-medium">Tempah Bilik</span>
                    </a>
                </li>

            </ul>

            <!-- Logout Section -->
            <div class="p-3 border-t border-green-800/50">
                <a class="flex items-center space-x-3 bg-red-600 hover:bg-red-700 text-white px-4 py-3 rounded-lg transition-all duration-200 shadow-lg"
                    href="<?= site_url('logout') ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span class="font-medium">Logout</span>
                </a>
            </div>
        </nav>

        <!-- Main Content Section -->
        <main class="flex-1 ml-64 overflow-y-auto">
            <div>
                <?= $this->renderSection('content') ?>
            </div>
        </main>

    </div>

    <div id="appPopup" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-xl p-6 relative" data-popup-box>
            <button
                class="absolute top-3 right-3 text-gray-500 hover:text-black"
                data-popup-close>
                ✕
            </button>
            <div id="appPopupContent"></div>
        </div>
    </div>

    <script>
        // Toggle icon rotation for dropdown
        document.querySelector('[onclick*="bookingMenu"]')?.addEventListener('click', function() {
            const icon = document.getElementById('bookingIcon');
            icon.style.transform = icon.style.transform === 'rotate(180deg)' ? 'rotate(0deg)' : 'rotate(180deg)';
        });
    </script>

</body>

</html>