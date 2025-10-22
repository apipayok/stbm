<!-- app/Views/layouts/main.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sistem Tempahan Bilik Mesyuarat MAIM</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('/css/utils/main.css') ?>"> 
</head>

<body class="bg-light">
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="bg-dark text-white p-3 vh-100" style="width: 200px;">
            <h4 class="mb-4">STBM</h4>
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="<?= site_url('dashboard') ?>">Main</a>
                </li>

                <?php if (session()->get('is_admin') == 1): ?> <!-- admin start -->

                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="<?= site_url('admin/users') ?>">Manage Users</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="<?= site_url('admin/rooms') ?>">Manage Room</a>
                </li>
                <?php endif; ?> <!-- admin end -->

                <?php if (session()->get('is_admin') != 1): ?> <!-- user start -->
                    
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="<?= site_url('/rooms') ?>">Show Room</a>
                </li>
                <li class="nav-item mt-3">
                    <a class="nav-link text-danger" href="<?= site_url('logout') ?>">Logout</a>
                </li>
                <?php endif; ?> <!-- user end -->
            </ul>
        </nav>

 <?= $this->renderSection('content') ?>

</body>
</html>