<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Room Booking System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-screen flex overflow-hidden">

    <!-- Left Side - Form Section -->
    <div class="w-full lg:w-2/5 bg-gradient-to-br from-green-800 via-green-700 to-green-900 flex justify-center items-center p-6 relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-48 h-48 bg-green-600 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
        <div class="absolute bottom-0 right-0 w-48 h-48 bg-green-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse" style="animation-delay: 2s;"></div>

        <div class="bg-white shadow-2xl rounded-2xl p-6 w-full max-w-md relative z-10">
            <!-- Logo/Header Section -->
            <div class="text-center mb-4">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-br from-green-600 to-green-700 rounded-xl mb-2 shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800">Daftar Akaun</h3>
                <p class="text-sm text-gray-600">Cipta akaun baharu</p>
            </div>

            <!-- Flash Message -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-3 mb-4 flex items-start">
                    <svg class="w-4 h-4 text-red-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    <p class="text-red-800 font-medium text-xs"><?= session()->getFlashdata('error') ?></p>
                </div>
            <?php endif; ?>

            <!-- Registration Form -->
            <form action="<?= base_url('/register') ?>" method="post" class="space-y-3">
                <?= csrf_field() ?>

                <!-- Staff Number -->
                <div>
                    <label for="staffno" class="block mb-1 text-xs font-semibold text-gray-700">
                        No. Staff <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
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

                <!-- Username -->
                <div>
                    <label for="username" class="block mb-1 text-xs font-semibold text-gray-700">
                        Nama Pengguna <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text"
                            id="username"
                            name="username"
                            required
                            placeholder="Masukkan nama pengguna"
                            class="w-full pl-9 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200">
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block mb-1 text-xs font-semibold text-gray-700">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12H8m8 0l-8 0m12-4H4m16 8H4" />
                            </svg>
                        </div>
                        <input type="email"
                            id="email"
                            name="email"
                            value="<?= old('email') ?>"
                            required
                            placeholder="Masukkan email"
                            class="w-full pl-9 pr-3 py-2 text-sm border border-gray-300 rounded-lg
                      focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500
                      transition duration-200">
                    </div>
                </div>


                <!-- Department -->
                <div>
                    <label for="department" class="block mb-1 text-xs font-semibold text-gray-700">
                        Bahagian <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <select id="department"
                            name="department"
                            required
                            class="w-full pl-9 pr-8 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200 appearance-none bg-white">
                            <option value="" disabled selected>-- Pilih Bahagian --</option>
                            <option value="btm">Bahagian Teknologi Maklumat</option>
                            <option value="psm">Bahagian Pembangunan Sumber Manusia</option>
                            <option value="media">Bahagian Komunikasi Korporat, Promosi dan Penerbitan</option>
                            <option value="perolehan">Unit Perolehan</option>
                            <option value="lain">Lain</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
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
                    class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold py-2.5 rounded-lg transition duration-200 shadow-lg hover:shadow-xl transform hover:scale-[1.02] flex items-center justify-center text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    Daftar Sekarang
                </button>
            </form>

            <!-- Login Link -->
            <div class="mt-4 pt-4 border-t border-gray-200 text-center">
                <p class="text-gray-600 text-xs">
                    Sudah berdaftar?
                    <a href="<?= base_url('/login') ?>"
                        class="text-green-600 font-semibold hover:text-green-700 hover:underline transition duration-200">
                        Log Masuk
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <h1 class="text-4xl font-bold mb-3 drop-shadow-lg">Sistem Tempahan Bilik</h1>
                <p class="text-lg text-green-100 mb-6 drop-shadow">Pengurusan tempahan bilik mesyuarat yang cekap dan mudah</p>

                <!-- Features -->
                <div class="grid grid-cols-1 gap-3 text-left">
                    <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-lg p-3">
                        <div class="bg-green-500 p-2 rounded-lg mr-3 flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold">Tempahan Mudah</h3>
                            <p class="text-green-100 text-sm">Tempah bilik dengan pantas</p>
                        </div>
                    </div>

                    <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-lg p-3">
                        <div class="bg-green-500 p-2 rounded-lg mr-3 flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold">Pengurusan Real-Time</h3>
                            <p class="text-green-100 text-sm">Lihat ketersediaan secara langsung</p>
                        </div>
                    </div>

                    <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-lg p-3">
                        <div class="bg-green-500 p-2 rounded-lg mr-3 flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold">Notifikasi Automatik</h3>
                            <p class="text-green-100 text-sm">Terima pemberitahuan status</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>