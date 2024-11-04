<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="<?= base_url() ?>assets/images/gil.png" alt="logo">
              </div>
              <h4>Lupa Password</h4>
              <h6 class="fw-light">Masukan Email untuk mendapatkan aktivasi reset password.</h6>
              <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
    <?php endif; ?>
            <form action="<?= base_url('auth/forgot_password'); ?>" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control form-control-lg" name="email" value="<?= set_value('email'); ?>">
                    <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                </div>

                <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Reset Password</button>
                <div class="text-center mt-4 fw-light">
                  Kembali ke halaman <a href="<?= base_url('auth/login'); ?>" class="text-primary">Login</a>
                </div>  
              </div>  
                
            </form>
        </div>
    </div>
</div>


