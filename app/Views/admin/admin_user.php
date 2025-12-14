<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto px-4 py-6 no-scrollbar">
    <h2 class="mb-6 text-3xl font-semibold text-green-800">PENGGUNA</h2>

    <!-- Admins Table -->
    <div class="mb-8 bg-white rounded w-3/5 shadow overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Staff No</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Username</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['admins'] as $user): ?>
                    <tr class="hover:bg-gray-50 border-b">
                        <td class="px-6 py-4"><?= esc($user['staffno']) ?></td>
                        <td class="px-6 py-4"><?= esc($user['username']) ?></td>
                        <td class="px-6 py-4 text-center space-x-2">
                            <a href="<?= site_url('admin/users/toggle-admin/' . $user['staffno']) ?>"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded">
                                Demote
                            </a>
                            <a href="<?= site_url('admin/users/delete/' . $user['staffno']) ?>"
                               onclick="return confirm('Delete this admin?');"
                               class="bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded">
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded shadow w-3/5 overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Staff No</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Username</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold">Actions</th>
                    <th class="px-6 py-3 text-right">
                        <?= $data['pagerUser']->links('users', 'icons') ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['users'] as $user): ?>
                    <tr class="hover:bg-gray-50 border-b">
                        <td class="px-6 py-4"><?= esc($user['staffno']) ?></td>
                        <td class="px-6 py-4"><?= esc($user['username']) ?></td>
                        <td class="px-6 py-4 text-center space-x-2">
                            <a href="<?= site_url('admin/users/toggle-admin/' . $user['staffno']) ?>"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded">
                                Promote
                            </a>
                            <a href="<?= site_url('admin/users/delete/' . $user['staffno']) ?>"
                               onclick="return confirm('Delete this admin?');"
                               class="bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded">
                                Delete
                            </a>
                        </td>
                        <td></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
