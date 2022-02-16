<?php
$form['username'] = array(
  'name'			=> 'username',
  'id'			=> 'username',
  'class' 		=> 'form-control',
  'placeholder' 	=> 'Username',
  'size'			=> 30,
  'value' 		=> set_value('username')
);

$form['password'] = array(
  'name'			=> 'password',
  'id'			=> 'password',
  'placeholder' 	=> 'Password',
  'class' 		=> 'form-control',
  'size'			=> 30
);

$form['remember'] = array(
  'name'			=> 'remember',
  'id'			=> 'remember',
  'value'			=> 1,
  'checked'		=> set_value('remember'),
  'style' 		=> 'margin:0;padding:0'
);

$form['captcha'] = array(
  'name'			=> 'captcha',
  'id'			=> 'captcha',
  'placeholder' 	=> 'Security Code',
  'maxlength'		=> 8
);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PKU Yogyakarta Administrator | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo $this->theme_url; ?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $this->theme_url; ?>assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo $this->theme_url; ?>assets/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo $this->theme_url; ?>assets/index2.html"><b>Administrator</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <?php if($notification || $this->dx_auth->get_auth_error()): ?>
      <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-ban"></i> Error!</h4>
          <?php 
          if( $notification )
          { 
            echo $notification; 
          } 
           
          if( $this->dx_auth->get_auth_error() )
          {
            echo $this->dx_auth->get_auth_error();
          } ?>
        </div>
    <?php endif; ?>
    
    <form action="<?php echo $this->uri->uri_string(); ?>" method="post">
      <div class="form-group has-feedback">
        <?php echo form_input($form['username'])?>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <?php echo form_password($form['password'])?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <?php if ($show_captcha): ?>
      <div class="row">
            <div class="col-xs-8 col-lg-6"><?php echo $this->dx_auth->get_captcha_image(); ?></div>
            <div class="col-xs-8 col-lg-6"><?php echo form_input($form['captcha'])?></div>
      </div>
      <?php endif; ?>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <?php echo form_checkbox($form['remember']);?> Remember me
            </label>
          </div>
        </div>        
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="login">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!-- /.social-auth-links -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo $this->theme_url; ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo $this->theme_url; ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo $this->theme_url; ?>assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
