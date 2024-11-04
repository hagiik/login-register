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
              <h6 class="fw-light">Login untuk melanjutkan.</h6>
            <?php if ($this->session->flashdata('message')): ?>
                <div class="alert alert-info"><?= $this->session->flashdata('message'); ?></div>
            <?php endif; ?>
            <form action="<?= base_url('auth/login'); ?>" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control form-control-lg" name="username" value="<?= set_value('username'); ?>">
                    <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" class="form-control form-control-lg" name="password">
                    <!-- <i class="fas fa-eye toggle-password" onclick="togglePassword()"></i> -->
                    <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                </div>
<!--                 
                <div class="form-group">
                <div class="password-container">
                  <input type="password" class="form-control form-control-lg" id="password" placeholder="Masukkan password">
                  <i class="fas fa-eye toggle-password" onclick="togglePassword()"></i>
                  <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                </div>
                </div> -->


                <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Login</button>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="<?= base_url('auth/forgot_password'); ?>" class="auth-link text-black">Forgot password?</a>
                </div>  
                <div class="text-center mt-4 fw-light">
                  Belum Punya Akun? <a href="<?= base_url('auth/register'); ?>" class="text-primary">Buat disini</a>
                </div>
            </form>
        </div>
    </div>
</div>


