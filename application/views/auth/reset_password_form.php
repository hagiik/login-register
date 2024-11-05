<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                        <div class="brand-logo">
                            <img src="<?= base_url() ?>assets/images/gil.png" alt="logo">
                        </div>
                                <h4>Reset Password</h4>
                                <h6 class="fw-light">Login untuk melanjutkan.</h6>
                            <form action="<?= base_url('auth/save_new_password'); ?>" method="post">
                                <input type="hidden" name="token" value="<?= $token ?>">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control form-control-lg" name="password" placeholder="Password Baru">
                                    <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                    <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Ganti Password</button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>