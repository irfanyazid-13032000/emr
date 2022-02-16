<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EMR PKU Muhammadiyah Yogyakarta</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= site_url() ?>assets/css/bootstrap.css">
  <link rel="stylesheet" href="<?= site_url() ?>assets/vendors/bootstrap-icons/bootstrap-icons.css">
  <link rel="stylesheet" href="<?= site_url() ?>assets/css/app.css">
  <link rel="stylesheet" href="<?= site_url() ?>assets/css/pages/auth.css">
</head>

<body>
  <div id="auth">

    <div class="row h-100">
      <div class="col-lg-5 col-12">
        <div id="auth-left">
          <div class="auth-logo">
            <a href="#!"><img src="<?= site_url() ?>assets/images/logo/emr.png" alt="Logo"></a>
          </div>

          <form action="<?php echo site_url() ?>auth/login" method="post">
            <?= csrf_field(); ?>
            <?php if (session()->get('failed')) : ?>
              <div class="alert alert-danger">
                <p><?php echo session()->getFlashdata('failed') ?></p>
              </div>

            <?php endif; ?>
            <div class="form-group position-relative has-icon-left mb-4">
              <input type="text" class="form-control form-control-xl" placeholder="Username" name="username">
              <div class="form-control-icon">
                <i class="bi bi-person"></i>
              </div>
            </div>
            <div class="form-group position-relative has-icon-left mb-4">
              <input type="password" class="form-control form-control-xl" placeholder="Password" name="password">
              <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
              </div>
            </div>
            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" type="submit">Log in</button>
          </form>
          <div class="text-center mt-5 text-lg fs-4">
          </div>
        </div>
      </div>
      <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right">

        </div>
      </div>
    </div>

  </div>
</body>

</html>