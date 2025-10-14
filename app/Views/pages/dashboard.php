<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-body text-center">
            <h3 class="mb-3">Welcome, <?= esc($username) ?>!</h3>
            <p><strong>Staff No:</strong> <?= esc($staffno) ?></p>

            <hr>

            <a href="<?= site_url('admin/rooms') ?>" class="btn btn-primary btn-lg">
                Book a Room
            </a>

            <a href="<?= site_url('logout') ?>" class="btn btn-outline-danger btn-lg ms-3">
                Logout
            </a>
        </div>
    </div>
</div>

</body>
</html>
