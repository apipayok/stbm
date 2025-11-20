<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto px-4 my-12">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6">
            <h3 class="mb-6 text-2xl font-bold text-blue-600">Manage Users</h3>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php elseif (session()->getFlashdata('error')): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <div class="overflow-y-auto" style="max-height: 450px;">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-800 text-white sticky top-0">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Staff No</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Username</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Role</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach ($users as $user): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-900"><?= esc($user['staffno']) ?></td>
                                <td class="px-6 py-4 text-sm text-gray-900"><?= esc($user['username']) ?></td>
                                <td class="px-6 py-4 text-sm">
                                    <?php if ($user['is_admin']): ?>
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Admin</span>
                                    <?php else: ?>
                                        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">User</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 text-center text-sm font-medium space-x-2">
                                    <a href="<?= site_url('admin/users/toggle-admin/' . $user['staffno']) ?>" 
                                       class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded">
                                        <?= $user['is_admin'] ? 'Demote' : 'Promote' ?>
                                    </a>
                                    <a href="<?= site_url('admin/users/delete/' . $user['staffno']) ?>" 
                                       class="inline-block bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded"
                                       onclick="return confirm('Are you sure you want to delete this user?');">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="text-center mt-6">
        <a href="<?= site_url('/dashboard') ?>" class="inline-block border border-gray-400 text-gray-700 hover:bg-gray-100 font-semibold py-2 px-6 rounded">
            Back to Main Page
        </a>
    </div>
</div>

<?= $this->endSection() ?>