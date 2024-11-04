<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="<?= base_url('auth/save_new_password'); ?>" method="post">
    <h2>Reset Password Baru</h2>
    <input type="hidden" name="token" value="<?= $token ?>">
    <input type="password" name="password" placeholder="Password Baru" required>
    <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
    <input type="password" name="confirm_password" placeholder="Konfirmasi Password" required>
    <?= form_error('confirm_password', '<small class="text-danger">', '</small>'); ?>
    <button type="submit">Simpan Password</button>
</form>

</body>
</html>