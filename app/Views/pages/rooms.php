<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto px-4 py-8 md:py-12">
    <!-- Header Section -->
    <div class="mb-8 md:mb-12">
        <div class="flex items-center gap-4 mb-3">
            <div class="bg-green-100 p-3 rounded-xl">
                <svg class="w-8 h-8 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Bilik Tempahan</h2>
        </div>
        <p class="text-gray-600 text-lg ml-16">Pilih bilik yang sesuai untuk aktiviti anda</p>
    </div>

    <!-- Rooms Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
        <?php if (!empty($rooms)): ?>
            <?php foreach ($rooms as $room): ?>
                <?php
                $isHidden = $room['status'] === 'hidden';
                $imageUrl = !empty($room['image']) 
                    ? base_url('uploads/rooms/' . $room['image']) 
                    : 'https://via.placeholder.com/400x300?text=Tiada+Gambar';
                ?>

                <div class="group">
                    <?php if (!$isHidden): ?>
                        <!-- Bilik Tersedia -->
                        <a href="<?= site_url('rooms/' . $room['roomId']) ?>" 
                           class="block no-underline">
                            <div class="bg-white shadow-lg rounded-2xl overflow-hidden h-full transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                                <!-- Gambar Bilik -->
                                <div class="relative overflow-hidden h-56">
                                    <img src="<?= esc($imageUrl) ?>" 
                                         alt="<?= esc($room['roomName']) ?>" 
                                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                    
                                    <!-- Status Badge -->
                                    <div class="absolute top-4 right-4">
                                        <span class="px-3 py-1.5 bg-green-500 text-white text-xs font-bold rounded-full shadow-lg">
                                            Tersedia
                                        </span>
                                    </div>
                                    
                                    <!-- Overlay Gradient -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </div>
                                
                                <!-- Maklumat Bilik -->
                                <div class="p-6">
                                    <h5 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-green-600 transition-colors">
                                        <?= esc($room['roomName']) ?>
                                    </h5>
                                    
                                    <div class="flex items-center justify-between mt-4">
                                        <span class="text-sm text-gray-500 flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                            Klik untuk butiran
                                        </span>
                                        
                                        <div class="bg-green-100 p-2 rounded-full group-hover:bg-green-600 transition-colors">
                                            <svg class="w-5 h-5 text-green-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php else: ?>
                        <!-- Bilik Tidak Tersedia -->
                        <div class="bg-gray-100 shadow-md rounded-2xl overflow-hidden h-full opacity-60 cursor-not-allowed">
                            <!-- Gambar Bilik (Greyscale) -->
                            <div class="relative overflow-hidden h-56">
                                <img src="<?= esc($imageUrl) ?>" 
                                     alt="<?= esc($room['roomName']) ?>" 
                                     class="w-full h-full object-cover grayscale">
                                
                                <!-- Status Badge -->
                                <div class="absolute top-4 right-4">
                                    <span class="px-3 py-1.5 bg-gray-500 text-white text-xs font-bold rounded-full shadow-lg">
                                        Tidak Tersedia
                                    </span>
                                </div>
                                
                                <!-- Lock Icon Overlay -->
                                <div class="absolute inset-0 flex items-center justify-center bg-black/30">
                                    <div class="bg-white/90 p-4 rounded-full">
                                        <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Maklumat Bilik -->
                            <div class="p-6">
                                <h5 class="text-xl font-bold text-gray-500 mb-2">
                                    <?= esc($room['roomName']) ?>
                                </h5>
                                
                                <p class="text-sm text-gray-400 mt-4">
                                    Bilik ini tidak tersedia buat masa ini
                                </p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Tiada Bilik -->
            <div class="col-span-full text-center py-16">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-6">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-600 mb-2">Tiada Bilik Dijumpai</h3>
                <p class="text-gray-500">Sila hubungi pentadbir untuk maklumat lanjut</p>
            </div>
        <?php endif; ?>
    </div>

</div>

<?= $this->endSection() ?>