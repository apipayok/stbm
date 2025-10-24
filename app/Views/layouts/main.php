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
        <nav class="bg-dark text-white p-3 vh-100" style="width: 220px;">
            <?php $uri = service('uri'); ?>
            <h4 class="mb-4">STBM</h4>
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="<?= site_url('dashboard') ?>">Main</a>
                </li>
                <!-- admin start -->
                <?php if (session()->get('is_admin') == 1): ?> 

                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="<?= site_url('admin/users') ?>">Manage Users</a>
                </li>

                <!-- dropdown setting -->
                <li class="nav-item mb-2">
                    <a class="nav-link text-white d-flex justify-content-between align-items-center <?= ($uri->getSegment(2) === 'bookings') ? 'active' : '' ?>" 
                        data-bs-toggle="collapse" 
                        href="#bookingDropdown" 
                        role="button" 
                        aria-expanded="<?= ($uri->getSegment(2) === 'bookings') ? 'true' : 'false' ?>" 
                        aria-controls="bookingDropdown">Manage Bookings
                    </a>
                    <div class="collapse ps-3 <?= ($uri->getSegment(2) === 'bookings') ? 'show' : '' ?>" id="bookingDropdown">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="<?= site_url('admin/bookings') ?>">Booking Schedule</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="<?= site_url('admin/bookings/pending') ?>">Pending</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="<?= site_url('admin/bookings/approved') ?>">Approved</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="<?= site_url('admin/bookings/rejected') ?>">Rejected</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- dropdown setting -->

                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="<?= site_url('admin/rooms') ?>">Manage Room</a>
                </li>
                <?php endif; ?> 
                <!-- admin end -->

                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="<?= site_url('/rooms') ?>">Show Room</a>
                </li>
                <li class="nav-item mt-3">
                    <a class="nav-link text-danger" href="<?= site_url('logout') ?>">Logout</a>
                </li>
                
            </ul>
        </nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<?= $this->renderSection('content') ?>

</body>
</html>