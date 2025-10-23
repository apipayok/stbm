<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container my-5">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">
            <h3 class="mb-4 text-primary">Manage Users</h3>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php elseif (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark sticky-top">
                        <tr>
                            <th scope="col">Staff No</th>
                            <th scope="col">Username</th>
                            <th scope="col">Role</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= esc($user['staffno']) ?></td>
                                <td><?= esc($user['username']) ?></td>
                                <td>
                                    <?php if ($user['is_admin']): ?>
                                        <span class="badge bg-success">Admin</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">User</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?= site_url('admin/users/toggle-admin/' . $user['staffno']) ?>" 
                                       class="btn btn-sm btn-warning">
                                        <?= $user['is_admin'] ? 'Demote' : 'Promote' ?>
                                    </a>
                                    <a href="<?= site_url('admin/users/delete/' . $user['staffno']) ?>" 
                                       class="btn btn-sm btn-danger"
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
    <div class="text-center mt-4">
        <a href="<?= site_url('/dashboard') ?>" class="btn btn-outline-secondary">Back to Main Page</a>
    </div>
</div>

<?= $this->endSection() ?>
