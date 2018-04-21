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
   
    <link rel="stylesheet" href="/assets/css/plugins.min.css">
    <link rel="stylesheet" href="/assets/css/style.lime-600.min.css">

    <style>
    .wrap.wrap-danger {
      background-color: #73791e;
    }
    </style>



    

  </head>
  <body>

    <div class="ms-site-container">
      <?php $this->load->view('template/header')?>
        <?php $this->load->view($page)?>
    
      <?php $this->load->view('template/footer')?>
    </div>
    <script src="/assets/js/plugins.min.js"></script>
    <script src="/assets/js/app.min.js"></script>
    <script src="/assets/js/configurator.min.js"></script>
    <script src="/assets/js/ecommerce.js"></script>
    <script>$(document).ready(function() {
    
    $(".datePickercc").datepicker({
        orientation: "bottom left",
        autoclose: !0,
        todayHighlight: !0
    });


})</script>

  </body>
</html>