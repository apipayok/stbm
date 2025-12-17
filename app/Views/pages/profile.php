<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-2">Profil</h2>
    </div>

    <!-- Profile Card -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden max-w-3xl">
        <!-- Header Accent -->
        <div class="h-2 bg-gradient-to-r from-green-600 to-green-700"></div>
        
        <!-- Profile Content -->
        <div class="p-8">
            <!-- Profile Icon -->
            <div class="flex items-center mb-8">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-10 h-10 text-green-700" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-6">
                    <h3 class="text-2xl font-semibold text-gray-800"><?= esc($username) ?></h3>
                    <p class="text-gray-500"><?= esc($staffno) ?></p>
                </div>
            </div>

            <!-- Information Grid -->
            <div class="space-y-6">
                <!-- Personal Information Section -->
                <div>
                    <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">Maklumat Peribadi</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-sm text-gray-500 mb-1">Nama Pengguna</p>
                            <p class="text-lg font-medium text-gray-800"><?= esc($username) ?></p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-sm text-gray-500 mb-1">No. Staff</p>
                            <p class="text-lg font-medium text-gray-800"><?= esc($staffno) ?></p>
                        </div>
                    </div>
                </div>

                <!-- Organization Information Section -->
                <div>
                    <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">Maklumat Organisasi</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-sm text-gray-500 mb-1">Bahagian</p>
                            <p class="text-lg font-medium text-gray-800"><?= esc($department_name ?? '-') ?></p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-sm text-gray-500 mb-1">Jabatan</p>
                            <p class="text-lg font-medium text-gray-800"><?= esc($parent_department_name ?? '-') ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <a href="<?= site_url('/profile/edit') ?>" 
                   class="inline-flex items-center bg-green-700 hover:bg-green-800 text-white font-medium px-6 py-3 rounded-lg transition duration-200 shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Profil
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>