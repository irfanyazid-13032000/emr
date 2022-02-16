<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Backend Administrator</title>
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
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo $this->theme_url; ?>assets/dist/css/skins/_all-skins.min.css">
  <!-- Pace style -->
  <link rel="stylesheet" href="<?php echo $this->theme_url; ?>assets/plugins/pace/pace.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- jQuery 2.2.3 -->
  <script src="<?php echo $this->theme_url; ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="<?php echo $this->theme_url; ?>assets/bootstrap/js/bootstrap.min.js"></script>

</head>
<body class="hold-transition skin-green sidebar-mini fixed">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo $this->theme_url; ?>assets/index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>PKU</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>PKU Yogyakarta</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
         
          <li>
            <a href="<?php echo site_url('backend/logout') ?>"><i class="fa fa-sign-out"></i> LOGOUT</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $this->theme_url; ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo ucfirst($this->dx_auth->get_username()); ?></p>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>

        <li>
          <a href="<?php echo site_url('admin/dashboard'); ?>">
            <i class="fa fa-home"></i> <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="<?php echo site_url('content/admin/page'); ?>">
            <i class="fa fa-clone"></i> <span>Halaman</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-newspaper-o"></i> <span>Artikel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo site_url('content/admin/blog');?>"><i class="fa fa-circle-o"></i> Data Artikel</a></li>
            <li><a href="<?php echo site_url('content/admin/category');?>"><i class="fa fa-circle-o"></i> Kategori</a></li>
          </ul>
        </li>
        <li>
          <a href="<?php echo site_url('content/admin/layanan'); ?>">
            <i class="fa fa-book"></i> <span>Layanan</span>
          </a>
        </li>
        <li>
          <a href="<?php echo site_url('media/admin/award'); ?>">
            <i class="fa fa-star-o"></i> <span>Award</span>
          </a>
        </li>
        <li>
          <a href="<?php echo site_url('media/admin/sertifikasi'); ?>">
            <i class="fa fa-bookmark-o"></i> <span>Sertifikasi</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-stethoscope"></i> <span>Dokter</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo site_url('dokter/admin/master_dokter'); ?>"><i class="fa fa-users"></i> Data Dokter</a></li>
            <li><a href="<?php echo site_url('dokter/admin/master_dokter/jadwal');?>"><i class="fa fa-calendar-o"></i> Jadwal Dokter</a></li>
            <li><a href="<?php echo site_url('dokter/admin/master_poliklinik'); ?>"><i class="fa fa-heartbeat"></i>Master Poli</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-picture-o"></i> <span>Media</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo site_url('media/admin/slideshow'); ?>"><i class="fa fa-image"></i> Slideshow</a></li>
            <li><a href="<?php echo site_url('media/admin/banner'); ?>"><i class="fa fa-sticky-note"></i> Banner</a></li>
          </ul>
        </li>

        <li>
          <a href="<?php echo site_url('testimonial/admin/testimonial'); ?>">
            <i class="fa fa-map-o"></i> <span>Testimonial</span>
          </a>
        </li>
        <li>
          <a href="<?php echo site_url('settings/admin/menu'); ?>">
            <i class="fa fa-list"></i> <span>Menu manager</span>
          </a>
        </li>
        <li>
          <a href="<?php echo site_url('settings/admin/general_settings'); ?>">
            <i class="fa fa-cog"></i> <span>Konfigurasi</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">

      <?php include_once( $page_content . ".php" ); ?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.11
    </div>
    <strong>Copyright &copy; 2017 All rights reserved.</strong>
  </footer>


</div>
<!-- ./wrapper -->


<!-- PACE -->
<script src="<?php echo $this->theme_url; ?>assets/plugins/pace/pace.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo $this->theme_url; ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo $this->theme_url; ?>assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $this->theme_url; ?>assets/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo $this->theme_url; ?>assets/dist/js/demo.js"></script>
<!-- page script -->
<script type="text/javascript">
	// To make Pace works on Ajax calls
	$(document).ajaxStart(function() { Pace.restart(); });
    $('.ajax').click(function(){
        $.ajax({url: '#', success: function(result){
            $('.ajax-content').html('<hr>Ajax Request Completed !');
        }});
    });
</script>
</body>
</html>
