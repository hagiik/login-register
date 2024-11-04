<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="<?= base_url() ?>assets/images/gil.png" alt="logo">
              </div>
              <h4>Hallo! Selamat Datang</h4>
              <h6 class="fw-light">Registrasi untuk membuat akun.</h6>
            <?php if ($this->session->flashdata('message')): ?>
                <div class="alert alert-info"><?= $this->session->flashdata('message'); ?></div>
            <?php endif; ?>
            <form action="<?= base_url('auth/register'); ?>" method="post">
                <div class="form-group">
                    <label for="fullname">Nama Lengkap</label>
                    <input type="text" class="form-control form-control form-control-lg" name="fullname" value="<?= set_value('fullname'); ?>">
                    <?= form_error('fullname', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control form-control form-control-lg" name="username" value="<?= set_value('username'); ?>">
                    <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control form-control form-control-lg" name="email" value="<?= set_value('email'); ?>">
                    <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="phone">Nomor Telephone</label>
                    <input type="text" class="form-control form-control form-control-lg" name="phone" value="<?= set_value('phone'); ?>">
                    <?= form_error('phone', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control form-control form-control-lg" name="password">
                    <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Konfirmasi Password</label>
                    <input type="password" class="form-control form-control form-control-lg" name="confirm_password">
                    <?= form_error('confirm_password', '<small class="text-danger">', '</small>'); ?>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                <div class="text-center mt-3">
                    <a href="<?= base_url('auth/login'); ?>">Sudah punya akun? Login</a>
                </div>
            </form>
        </div>
    </div>
</div>

