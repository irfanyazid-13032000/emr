<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?? 'Dashboard' . ' | EMR PKU Muhammadiyah Yogyakarta' ?></title>

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= site_url() ?>assets/css/bootstrap.css">
  <link rel="stylesheet" href="<?= site_url() ?>assets/css/table.css">

  <link rel="stylesheet" href="<?= site_url() ?>assets/vendors/iconly/bold.css">

  <link rel="stylesheet" href="<?= site_url() ?>assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
  <link rel="stylesheet" href="<?= site_url() ?>assets/vendors/bootstrap-icons/bootstrap-icons.css">
  <link rel="stylesheet" href="<?= site_url() ?>assets/css/app.css">
  <link rel="shortcut icon" href="<?= site_url() ?>assets/images/favicon.svg" type="image/x-icon">
  <?= $this->renderSection('head') ?>
  <style>
    .table a.button-edit {
      font-size: 14px;
      margin: 0 1px;
      padding: 1px 4px 1px 19px;
      background-image: url(<?= site_url() ?>resource/themes/operator/img/edit-icon.png);
      background-position: 4px 2px;
      background-repeat: no-repeat;
      background-color: #fff;
      border: 1px solid #F9EBD7;
      color: #8D4F00;
      display: inline;
      text-align: center;
      text-decoration: none;
    }

    .navigation-button a {
      margin: 0 0 0 2px;
      padding: 3px 8px;
      color: #fff;
      font-size: 11px;
      text-align: center;
      display: block;
      border-bottom: 1px solid #000;
      background-color: #202020;
      background-image: url(<?= site_url() ?>resource/themes/operator/img/pagination-bg.png);
      background-repeat: repeat-x;
      text-decoration: none;
      -moz-border-radius: 4px;
      -webkit-border-radius: 4px;
      border-radius: 4px;
      text-decoration: none;
      /* cursor: pointer; */
      list-style: none;
      font-family: tahoma;
    }

    a:-webkit-any-link {
      cursor: pointer;
    }

    li {
      list-style: none;
    }

    .navigation-button a img {
      margin: 0 3px 0 0;
      padding: 0;
      height: 14px;
      vertical-align: right;
    }
  </style>
</head>

<body>
  <div id="app">
    <div id="sidebar" class="active">
      <div class="sidebar-wrapper active">
        <div class="sidebar-header">
          <div class="d-flex justify-content-between">
            <div class="logo">
              <a href="<?= site_url() ?>"><img src="<?= site_url() ?>assets/images/logo/emr.png" alt="Logo" srcset="" style="height:40px"></a>
            </div>
            <div class="toggler">
              <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
          </div>
        </div>
        <div class="sidebar-menu">


          <?= view_cell('\App\Libraries\Widget::sidebar'); ?>


        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
      </div>
    </div>
    <div id="main">
      <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
          <i class="bi bi-justify fs-3"></i>
        </a>
      </header>

      <div class="page-heading">
        <h3><?= $title ?? 'Dashboard' ?></h3>
      </div>
      <div class="page-content">
        <?= $this->renderSection('content') ?>
      </div>

      <br>

      <footer>
        <div class="footer clearfix mb-0 text-muted">
          <div class="float-start">
            <p>2021 &copy; PKU Muhammadiyah Yogyakarta</p>
          </div>
          <div class="float-end">

          </div>
        </div>
      </footer>
    </div>
  </div>
  <script src="<?= site_url() ?>assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
  <script src="<?= site_url() ?>assets/js/bootstrap.bundle.min.js"></script>

  <script src="<?= site_url() ?>assets/vendors/apexcharts/apexcharts.js"></script>

  <script src="<?= site_url() ?>assets/js/main.js"></script>
  <?= $this->renderSection('script') ?>
</body>

</html>