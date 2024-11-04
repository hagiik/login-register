<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengguna</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <a href="<?= base_url('auth/logout') ?>" class="btn btn-danger float-right mb-3">Logout</a>

    <?php if ($this->session->flashdata('message')): ?>
        <div class="alert alert-info"><?= $this->session->flashdata('message') ?></div>
    <?php endif; ?>

    <!-- <table class="table table-striped">
        <thead>
            <tr>
                <th>Nama Lengkap</th>
                <th>Username</th>
                <th>Email</th>
                <th>Nomor Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user->fullname ?></td>
                    <td><?= $user->username ?></td>
                    <td><?= $user->email ?></td>
                    <td><?= $user->phone ?></td>
                    <td>
                        <a href="<?= base_url('dashboard/reset_password/' . $user->id) ?>" class="btn btn-warning btn-sm">Reset Password</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table> -->

    <h2>Welcome, <?= $user->fullname; ?></h2>
    <p>Username: <?= $user->username; ?></p>
    <p>Email: <?= $user->email; ?></p>
    <p>Nomor Telepon: <?= $user->phone; ?></p>
</div>

</body>
</html>
