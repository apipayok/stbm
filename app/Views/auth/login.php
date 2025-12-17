<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Masuk - Room Booking System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-screen flex overflow-hidden">

    <!-- Left Side - Form Section -->
    <div class="w-full lg:w-2/5 bg-gradient-to-br from-green-800 via-green-700 to-green-900 flex flex-col justify-center items-center p-6 relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-48 h-48 bg-green-600 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
        <div class="absolute bottom-0 right-0 w-48 h-48 bg-green-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse" style="animation-delay: 2s;"></div>
        
        <!-- Title Section -->
        <div class="text-center mb-6 relative z-10">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl mb-3 shadow-2xl">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <h1 class="text-white text-2xl font-bold drop-shadow-lg">TEMPAHAN BILIK MESYUARAT</h1>
            <p class="text-green-100 text-sm mt-1 drop-shadow">Sistem Pengurusan Tempahan</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white shadow-2xl rounded-2xl p-6 w-full max-w-md relative z-10">
            <!-- Card Header -->
            <div class="text-center mb-4">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-br from-green-600 to-green-700 rounded-xl mb-2 shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800">Log Masuk</h3>
                <p class="text-sm text-gray-600">Sila masukkan butiran anda</p>
            </div>

            <!-- Flash Messages -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-3 mb-4 flex items-start">
                    <svg class="w-4 h-4 text-red-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-red-800 font-medium text-xs"><?= session()->getFlashdata('error') ?></p>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('message')): ?>
                <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-3 mb-4 flex items-start">
                    <svg class="w-4 h-4 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-green-800 font-medium text-xs"><?= session()->getFlashdata('message') ?></p>
                </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form action="<?= base_url('/login') ?>" method="post" class="space-y-4">
                <?= csrf_field() ?>

                <!-- Staff Number -->
                <div>
                    <label for="staffno" class="block mb-1 text-xs font-semibold text-gray-700">
                        No. Staff <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <input type="text" 
                               id="staffno" 
                               name="staffno" 
                               required
                               placeholder="Masukkan nombor staff"
                               class="w-full pl-9 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200">
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block mb-1 text-xs font-semibold text-gray-700">
                        Kata Laluan <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               required
                               placeholder="Masukkan kata laluan"
                               class="w-full pl-9 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200">
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                        class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold py-2.5 rounded-lg transition duration-200 shadow-lg hover:shadow-xl transform hover:scale-[1.02] flex items-center justify-center text-sm mt-6">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    Log Masuk
                </button>
            </form>

            <!-- Register Link -->
            <div class="mt-4 pt-4 border-t border-gray-200 text-center">
                <p class="text-gray-600 text-xs">
                    Belum berdaftar? 
                    <a href="<?= base_url('/register') ?>" 
                       class="text-green-600 font-semibold hover:text-green-700 hover:underline transition duration-200">
                        Daftar Sekarang
                    </a>
                </p>
            </div>
        </div>
    </div>

    <!-- Right Side - Image Section -->
    <div class="hidden lg:block lg:w-3/5 relative overflow-hidden">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-gradient-to-br from-green-900/80 via-green-800/60 to-green-700/40 z-10"></div>
        
        <!-- Image -->
        <img src='/images/bangunan_maim.jpg' 
             class="w-full h-full object-cover" 
             alt="Building Image">
        
        <!-- Content Overlay -->
        <div class="absolute inset-0 z-20 flex flex-col justify-center items-center text-white px-8">
            <div class="max-w-lg text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl mb-4 shadow-2xl">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h1 class="text-4xl font-bold mb-3 drop-shadow-lg">Selamat Kembali!</h1>
                <p class="text-lg text-green-100 mb-6 drop-shadow">Log masuk untuk mengurus tempahan bilik mesyuarat anda</p>
                
                <!-- Features -->
                <div class="grid grid-cols-1 gap-3 text-left">
                    <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-lg p-3">
                        <div class="bg-green-500 p-2 rounded-lg mr-3 flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold">Tempah Dalam Beberapa Saat</h3>
                            <p class="text-green-100 text-sm">Proses tempahan yang mudah dan cepat</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-lg p-3">
                        <div class="bg-green-500 p-2 rounded-lg mr-3 flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold">Jejak Tempahan Anda</h3>
                            <p class="text-green-100 text-sm">Lihat dan urus semua tempahan</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-lg p-3">
                        <div class="bg-green-500 p-2 rounded-lg mr-3 flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold">Pemberitahuan Segera</h3>
                            <p class="text-green-100 text-sm">Terima update status tempahan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>