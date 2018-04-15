<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="#333">
    <title>Conocimiento Colectivo</title>
    <meta name="description" content="Material Style Theme">
    <link rel="shortcut icon" href="/assets/img/logo/principal_logo.png?">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="/assets/css/preload.min.css">
    <link rel="stylesheet" href="/assets/css/plugins.min.css">
    <link rel="stylesheet" href="/assets/css/style.lime-600.min.css">
    <!--[if lt IE 9]>
        <script src="assets/js/html5shiv.min.js"></script>
        <script src="assets/js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <!--<div id="ms-preload" class="ms-preload">
      <div id="status">
        <div class="spinner">
          <div class="dot1"></div>
          <div class="dot2"></div>
        </div>
      </div>
    </div>-->
    <div class="ms-site-container">
      <?php $this->load->view('template/header')?>
        <?php $this->load->view($page)?>
      <!-- container -->
      <?php $this->load->view('template/footer')?>
    </div>
    <script src="/assets/js/plugins.min.js"></script>
    <script src="/assets/js/app.min.js"></script>
    <script src="/assets/js/configurator.min.js"></script>
    <script src="/assets/js/ecommerce.js"></script>

  </body>
</html>