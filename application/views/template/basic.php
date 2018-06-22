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
    <link rel="stylesheet" href="/assets/css/plugins.min.css">
    <link rel="stylesheet" href="/assets/css/style.lime-600.min.css">

    <link rel="stylesheet" href="/assets/css/jquery.timepicker.min.css">


    <style>
    .wrap.wrap-danger {
      background-color: #73791e;
    }
    </style>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
 <script src="/assets/js/plugins.min.js"></script>
    <script src="/assets/js/app.min.js"></script>
    <script src="/assets/js/configurator.min.js"></script>
    <script src="/assets/js/ecommerce.js"></script>

    <script src="/assets/js/jquery.timepicker.min.js"></script>
    <script src="/assets/js/bootstrap-datepicker.es.min.js"></script>

  </head>
  <body>

   

    <script>

      $( document ).ready(function() {
        $('#workshop_navigate_list ul li a').on('click',function(event){
            event.preventDefault();
            $('#workshop_form_page').val($(this).attr("href"));
            $('#workshop_form').submit();
        });
      });

      function only_numbers(e){

        key = e.keyCode || e.which;

        teclado = String.fromCharCode(key);
        numeros = "0123456789";
        especiales = "8-37-38-46"; //array
        teclado_especial = false;

        for(var i in especiales){
          if (key==especiales[i]){
            teclado_especial = true;
          }
        }

        if (numeros.indexOf(teclado)==-1 && !teclado_especial) {
          return false;
        }
      }

      function only_letters(e){

        key = e.keyCode || e.which;

        teclado = String.fromCharCode(key);
        letras = " abcdefghijklmnñopqrstuvwxyzáéíóúABCDEFGHIJKLMNLÑOPQRSTUVWXYZÁÉÍÓÚ.";
        especiales = "8-37-38-46-164"; //array
        teclado_especial = false;

        for(var i in especiales){
          if (key==especiales[i]){
            teclado_especial = true;
          }
        }

        if (letras.indexOf(teclado)==-1 && !teclado_especial) {
          return false;
        }
      }


      function only_for_ratings(e){

        key = e.keyCode || e.which;

        teclado = String.fromCharCode(key);
        numeros = "12345";
        especiales = "8-37-38-46"; //array
        teclado_especial = false;

        for(var i in especiales){
          if (key==especiales[i]){
            teclado_especial = true;
          }
        }

        if (numeros.indexOf(teclado)==-1 && !teclado_especial) {
          return false;
        }
      }


      $(function(){
        //var Date = moment.tz("America/Lima").format();
        $('input.mydatepicker').datepicker({
          format: 'dd-mm-yyyy',
          weekStart:1,
          language: 'es'
        });
      });
      
      $(function(){
        $('input.timepicker').timepicker({
          timeFormat: 'HH:mm',
          minTime: '8',
          maxTime: '10:00pm',
          interval:60
        });
      });

    </script>

    <div class="ms-site-container">
      <?php $this->load->view('template/header')?>

        <?php $this->load->view($page)?>
    
      <?php $this->load->view('template/footer')?>
    </div>
    


    <!--<script>$(document).ready(function() {
    $(".datePickercc").datepicker({
        orientation: "bottom left",
        autoclose: !0,
        todayHighlight: !0
    });
})</script>-->

  </body>
</html>