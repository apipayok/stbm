<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-2">Dashboard Pentadbir</h2>
        <p class="text-gray-600">Ringkasan sistem pengurusan tempahan bilik</p>
    </div>

    <!-- Summary Cards Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        
        <!-- Users Section -->
        <div class="bg-gradient-to-br from-blue-700 to-blue-800 rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:shadow-2xl">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-white">PENGGUNA</h3>
                    <div class="bg-blue-600 bg-opacity-50 p-3 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                        </svg>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-3">
                    <a href="<?= base_url('admin/users') ?>" class="group">
                        <div class="bg-white rounded-lg shadow-md p-4 text-center transform transition duration-200 hover:scale-105 hover:shadow-xl">
                            <div class="flex justify-center mb-2">
                                <div class="bg-blue-100 p-2 rounded-full">
                                    <svg class="w-5 h-5 text-blue-700" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                            <h5 class="text-sm text-gray-600 font-medium mb-1">Pengguna</h5>
                            <h3 class="text-3xl font-bold text-blue-700"><?= count($data['users']) ?></h3>
                        </div>
                    </a>
                    
                    <a href="<?= base_url('admin/users') ?>" class="group">
                        <div class="bg-white rounded-lg shadow-md p-4 text-center transform transition duration-200 hover:scale-105 hover:shadow-xl">
                            <div class="flex justify-center mb-2">
                                <div class="bg-green-100 p-2 rounded-full">
                                    <svg class="w-5 h-5 text-green-700" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                            <h5 class="text-sm text-gray-600 font-medium mb-1">Admin</h5>
                            <h3 class="text-3xl font-bold text-green-700"><?= esc($data['admin']) ?></h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Bookings Section -->
        <div class="bg-gradient-to-br from-purple-700 to-purple-800 rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:shadow-2xl">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-white">TEMPAHAN</h3>
                    <div class="bg-purple-600 bg-opacity-50 p-3 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-white rounded-lg shadow-md p-4 text-center transform transition duration-200 hover:scale-105 hover:shadow-xl">
                        <div class="flex justify-center mb-2">
                            <div class="bg-purple-100 p-2 rounded-full">
                                <svg class="w-5 h-5 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                        </div>
                        <h5 class="text-sm text-gray-600 font-medium mb-1">Jumlah</h5>
                        <h3 class="text-3xl font-bold text-purple-700"><?= count($data['bookings']) ?></h3>
                    </div>
                    
                    <a href="<?= base_url('admin/bookings/pending') ?>" class="group">
                        <div class="bg-white rounded-lg shadow-md p-4 text-center transform transition duration-200 hover:scale-105 hover:shadow-xl">
                            <div class="flex justify-center mb-2">
                                <div class="bg-yellow-100 p-2 rounded-full">
                                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <h5 class="text-sm text-gray-600 font-medium mb-1">Kelulusan</h5>
                            <h3 class="text-3xl font-bold text-yellow-600"><?= esc($data['pendingCount']) ?></h3>
                        </div>
                    </a>
                    
                    <a href="<?= base_url('admin/bookings/approved') ?>" class="group">
                        <div class="bg-white rounded-lg shadow-md p-4 text-center transform transition duration-200 hover:scale-105 hover:shadow-xl">
                            <div class="flex justify-center mb-2">
                                <div class="bg-green-100 p-2 rounded-full">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <h5 class="text-sm text-gray-600 font-medium mb-1">Diluluskan</h5>
                            <h3 class="text-3xl font-bold text-green-600"><?= esc($data['approvedCount']) ?></h3>
                        </div>
                    </a>
                    
                    <a href="<?= base_url('admin/bookings/rejected') ?>" class="group">
                        <div class="bg-white rounded-lg shadow-md p-4 text-center transform transition duration-200 hover:scale-105 hover:shadow-xl">
                            <div class="flex justify-center mb-2">
                                <div class="bg-red-100 p-2 rounded-full">
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <h5 class="text-sm text-gray-600 font-medium mb-1">Ditolak</h5>
                            <h3 class="text-3xl font-bold text-red-600"><?= esc($data['rejectedCount']) ?></h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Rooms Section -->
        <div class="bg-gradient-to-br from-green-700 to-green-800 rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:shadow-2xl">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-white">BILIK</h3>
                    <div class="bg-green-600 bg-opacity-50 p-3 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-3">
                    <a href="<?= base_url('admin/rooms/view') ?>" class="group col-span-2">
                        <div class="bg-white rounded-lg shadow-md p-4 text-center transform transition duration-200 hover:scale-105 hover:shadow-xl">
                            <div class="flex justify-center mb-2">
                                <div class="bg-green-100 p-2 rounded-full">
                                    <svg class="w-5 h-5 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                </div>
                            </div>
                            <h5 class="text-sm text-gray-600 font-medium mb-1">Bilangan Bilik</h5>
                            <h3 class="text-3xl font-bold text-green-700"><?= count($data['rooms']) ?></h3>
                        </div>
                    </a>
                    
                    <a href="<?= base_url('admin/rooms/view') ?>" class="group">
                        <div class="bg-white rounded-lg shadow-md p-4 text-center transform transition duration-200 hover:scale-105 hover:shadow-xl">
                            <div class="flex justify-center mb-2">
                                <div class="bg-blue-100 p-2 rounded-full">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            </div>
                            <h5 class="text-sm text-gray-600 font-medium mb-1">Buka</h5>
                            <h3 class="text-3xl font-bold text-blue-600"><?= esc($data['countAvailable']) ?></h3>
                        </div>
                    </a>
                    
                    <a href="<?= base_url('admin/rooms/view') ?>" class="group">
                        <div class="bg-white rounded-lg shadow-md p-4 text-center transform transition duration-200 hover:scale-105 hover:shadow-xl">
                            <div class="flex justify-center mb-2">
                                <div class="bg-gray-100 p-2 rounded-full">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                            </div>
                            <h5 class="text-sm text-gray-600 font-medium mb-1">Tutup</h5>
                            <h3 class="text-3xl font-bold text-gray-600"><?= esc($data['countHidden']) ?></h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Announcements Section -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden max-w-4xl">
        <div class="bg-gradient-to-r from-gray-800 to-gray-900 px-6 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <div class="bg-gray-700 p-2 rounded-lg mr-3">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                    </svg>
                </div>
                <span class="text-xl font-bold text-white">PENGUMUMAN</span>
            </div>
            
            <a href="<?= site_url('/admin/dashboard/announcement') ?>"
                class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-medium px-4 py-2 rounded-lg transition duration-200 shadow-md hover:shadow-lg">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Pengumuman Baru
            </a>
        </div>

        <div class="p-6">
            <?php if (!empty($data['announcements'])): ?>
                <div class="space-y-4">
                    <?php foreach ($data['announcements'] as $a): ?>
                        <div class="bg-gradient-to-r from-gray-50 to-white border-l-4 border-green-600 rounded-lg p-5 hover:shadow-md transition duration-200">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 bg-green-100 p-2 rounded-full mr-4">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-lg font-semibold text-gray-900 mb-2"><?= esc($a['title']) ?></h4>
                                    <p class="text-gray-700 mb-3 leading-relaxed"><?= esc($a['content']) ?></p>
                                    <div class="flex items-center text-sm text-gray-500">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        Disiarkan pada <?= esc(date('d M Y', strtotime($a['created_at']))) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-12">
                    <div class="flex justify-center mb-4">
                        <div class="bg-gray-100 p-4 rounded-full">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-gray-500 text-lg">Tiada pengumuman pada masa ini</p>
                    <p class="text-gray-400 text-sm mt-2">Pengumuman baru akan dipaparkan di sini</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>