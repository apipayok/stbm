<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto px-4 py-8 no-scrollbar">
    <!-- Header Section -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-2">Pengurusan Pengguna</h2>
        <p class="text-gray-600">Urus pentadbir dan pengguna sistem</p>
    </div>

    <!-- Admins Section -->
    <div class="mb-8">
        <div class="flex items-center mb-4">
            <div class="bg-green-100 p-2 rounded-lg mr-3">
                <svg class="w-6 h-6 text-green-700" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Pentadbir Sistem</h3>
                <p class="text-sm text-gray-500"><?= count($data['admins']) ?> pentadbir berdaftar</p>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-green-700 to-green-800">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                No. Staff
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Nama Pengguna
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Bahagian
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">
                                Tindakan
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (empty($data['admins'])): ?>
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                        </svg>
                                        Tiada pentadbir dijumpai
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($data['admins'] as $user): ?>
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-green-100 rounded-full flex items-center justify-center">
                                                <span class="text-green-700 font-semibold text-sm">
                                                    <?= strtoupper(substr(esc($user['username']), 0, 2)) ?>
                                                </span>
                                            </div>
                                            <div class="ml-3">
                                                <span class="text-sm font-medium text-gray-900"><?= esc($user['staffno']) ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900"><?= esc($user['username']) ?></div>
                                        <div class="flex items-center text-xs text-green-600 mt-1">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                            Pentadbir
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900"><?= esc($user['department_name'] ?? '-') ?></div>
                                        <?php if (!empty($user['parent_department_name'])): ?>
                                            <div class="text-xs text-gray-500 mt-1">
                                                <?= esc($user['parent_department_name']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center space-x-2">
                                            <a href="<?= site_url('admin/users/toggle-admin/' . $user['staffno']) ?>"
                                                class="inline-flex items-center px-3 py-2 border border-yellow-600 rounded-lg text-sm font-medium text-yellow-700 bg-yellow-50 hover:bg-yellow-100 transition duration-150">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                                </svg>
                                                Turun Taraf
                                            </a>
                                            <a href="<?= site_url('admin/users/delete/' . $user['staffno']) ?>"
                                                onclick="return confirm('Adakah anda pasti untuk memadam pentadbir ini?');"
                                                class="inline-flex items-center px-3 py-2 border border-red-600 rounded-lg text-sm font-medium text-red-700 bg-red-50 hover:bg-red-100 transition duration-150">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Padam
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Users Section -->
    <div class="mb-8">
        <div class="flex items-center mb-4">
            <div class="bg-blue-100 p-2 rounded-lg mr-3">
                <svg class="w-6 h-6 text-blue-700" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-800">Pengguna Biasa</h3>
                <p class="text-sm text-gray-500"><?= count($data['users']) ?> pengguna berdaftar</p>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-blue-700 to-blue-800">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                No. Staff
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Nama Pengguna
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Bahagian
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">
                                Tindakan
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (empty($data['users'])): ?>
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                        </svg>
                                        Tiada pengguna dijumpai
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($data['users'] as $user): ?>
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                                <span class="text-blue-700 font-semibold text-sm">
                                                    <?= strtoupper(substr(esc($user['username']), 0, 2)) ?>
                                                </span>
                                            </div>
                                            <div class="ml-3">
                                                <span class="text-sm font-medium text-gray-900"><?= esc($user['staffno']) ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900"><?= esc($user['username']) ?></div>
                                        <div class="text-xs text-gray-500 mt-1">Pengguna Biasa</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900"><?= esc($user['department_name'] ?? '-') ?></div>
                                        <?php if (!empty($user['parent_department_name'])): ?>
                                            <div class="text-xs text-gray-500 mt-1">
                                                <?= esc($user['parent_department_name']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center space-x-2">
                                            <a href="<?= site_url('admin/users/toggle-admin/' . $user['staffno']) ?>"
                                                class="inline-flex items-center px-3 py-2 border border-yellow-600 rounded-lg text-sm font-medium text-yellow-700 bg-yellow-50 hover:bg-yellow-100 transition duration-150">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
                                                </svg>
                                                Naik Taraf
                                            </a>
                                            <a href="<?= site_url('admin/users/delete/' . $user['staffno']) ?>"
                                                onclick="return confirm('Adakah anda pasti untuk memadam pengguna ini?');"
                                                class="inline-flex items-center px-3 py-2 border border-red-600 rounded-lg text-sm font-medium text-red-700 bg-red-50 hover:bg-red-100 transition duration-150">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Padam
                                            </a>
                                            <button
                                                data-popup-url="<?= base_url('admin/profile_view/' . $user['staffno'] . '?popup=1') ?>"
                                                class="inline-flex items-center px-3 py-2 border border-blue-600 rounded-lg text-sm font-medium text-blue-700 bg-blue-50 hover:bg-blue-100 transition duration-150">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                Lihat / Edit
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <?php if (!empty($data['pagerUser'])): ?>
        <div class="mt-6 flex justify-center">
            <div class="bg-white rounded-lg shadow px-4 py-3">
                <?= $data['pagerUser']->links('users', 'icons') ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>