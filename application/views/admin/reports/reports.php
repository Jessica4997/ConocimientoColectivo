<div class="container">
  <h2 align="center" class="color-primary" style="font-weight: bold" >Reportes</h2>
  <div align="center">
    <form method="post" action="<?php echo site_url('admin/to_pdf')?>">
    <label>Seleccionar Mes</label>
    <select name="mes_pdf">
        <option value="1">Enero</option>
        <option value="2">Febrero</option>
        <option value="3">Marzo</option>
        <option value="4">Abril</option>
        <option value="5">Mayo</option>
        <option value="6" >Junio</option>
        <option value="7">Julio</option>
        <option value="8">Agosto</option>
        <option value="9">Setiembre</option>
        <option value="10">Octubre</option>
        <option value="11">Noviembre</option>
        <option value="12">Diciembre</option>
    </select>
    <input class="btn btn-raised btn-primary" type="submit" value="Exportar a PDF">
</form>

  </div>

  <h3 align="center" class="color-primary" style="font-weight: bold" >Categoría más Solicitada</h3>

<canvas id="popular_category_chart" width="40" height="10"></canvas>
<h3 align="center" class="color-primary" style="font-weight: bold" >Inscripciones por Mes</h3>
<canvas id="workshop_inscriptions_per_month" width="40" height="10"></canvas>


<form method="get" action="<?php echo site_url('admin/show_reports')?>">
    <label>Seleccionar Mes</label>
    <select id="month_for_reports" name="mes">
        <option value="1">Enero</option>
        <option value="2">Febrero</option>
        <option value="3">Marzo</option>
        <option value="4">Abril</option>
        <option value="5">Mayo</option>
        <option value="6" >Junio</option>
        <option value="7">Julio</option>
        <option value="8">Agosto</option>
        <option value="9">Setiembre</option>
        <option value="10">Octubre</option>
        <option value="11">Noviembre</option>
        <option value="12">Diciembre</option>
    </select>
</form>


<h3 class="color-primary" style="font-weight: bold" >Inscripciones a Talleres por Mes  <button class="btn btn-primary" id="btn_w_insciption_per_month">Ver Detalles</button> <button class="btn btn-primary" id="btn_hide_inscriptions">Ocultar</button> </h3>
<div id="w_insciption_per_month">
  <label>Cantidad de Inscripciones:</label>

  <div class="card">
    <div style="overflow-x:auto;">
      <table class="table table-no-border table-striped">
        <thead>
          <tr class="color-white">
            <th style="background: #c0ca33">Estado</th>
            <th style="background: #c0ca33">Nombres</th>
            <th style="background: #c0ca33">Taller</th>
            <th style="background: #c0ca33">Categoría</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>


<h3 class="color-primary" style="font-weight: bold" >Solicitudes de Talleres por Mes <button class="btn btn-primary" id="btn_proposed_workshops_per_month">Ver Detalles</button> <button class="btn btn-primary" id="btn_hide_pw_per_month">Ocultar</button> </h3>
<div id="proposed_workshops_per_month">
  <label>Cantidad de Solicitudes:</label> 

  <div class="card">
    <div style="overflow-x:auto;">
      <table class="table table-no-border table-striped">
        <thead>
          <tr class="color-white">
            <th style="background: #c0ca33">Taller</th>
            <th style="background: #c0ca33">Categoría</th>
            <th style="background: #c0ca33">Creado por</th>
            <th style="background: #c0ca33">Cantidad de Votos</th>
            <th style="background: #c0ca33">Estado de la Solicitud</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

<h3 class="color-primary" style="font-weight: bold" >Solicitudes de Subcategorías por Mes <button class="btn btn-primary" id="btn_proposed_subcategories_per_month">Ver Detalles</button> <button class="btn btn-primary" id="btn_hide_psc_per_month">Ocultar</button></h3>
<div id="proposed_subcategories_per_month">
<label>Cantidad de Solicitudes:</label>

<div class="card">
  <div style="overflow-x:auto;">
    <table class="table table-no-border table-striped">
      <thead>
        <tr class="color-white">
          <th style="background: #c0ca33">Subcategoría Propuesta</th>
          <th style="background: #c0ca33">Categoría Principal</th>
          <th style="background: #c0ca33">Creado por</th>
          <th style="background: #c0ca33">Cantidad de Votos</th>
          <th style="background: #c0ca33">Estado de la Solicitud</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

<h3 class="color-primary" style="font-weight: bold" >Registro de Usuarios por Mes <button class="btn btn-primary" id="btn_registrations_per_month">Ver Detalles</button> <button class="btn btn-primary" id="btn_hide_registrations_per_month">Ocultar</button></h3>
<div id="registrations_per_month">
<label>Cantidad de Registros:</label>

<div class="card">
  <div style="overflow-x:auto;">
    <table class="table table-no-border table-striped">
      <thead>
        <tr class="color-white">
          <th style="background: #c0ca33">Nombres</th>
          <th style="background: #c0ca33">Email</th>
          <th style="background: #c0ca33">Fecha de Nacimiento</th>
          <th style="background: #c0ca33">Género</th>
          <th style="background: #c0ca33">Calificación</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

<h3 class="color-primary" style="font-weight: bold" >Categoría mas Popular</h3>

    <div class="card">
      <div style="overflow-x:auto;">
        <table class="table table-no-border table-striped">
          <thead>
            <tr class="color-white">
              <th style="background: #c0ca33">Categoría</th>
              <th style="background: #c0ca33">Cantidad de Inscritos</th>
            </tr>
          </thead>

          <tbody>
            <?php foreach($popular_categories as $rows){?>
            <tr>
              <td><?php echo $rows['c_name']?></td>
              <td><?php echo $rows['iu_quantity'] ?></td>
            </tr>
            <?php }?> 
          </tbody>
        </table>
      </div>
    </div>




</div>

<script>

  $( document ).ready(function() {
//MOSTRAR
        $('#btn_w_insciption_per_month').on('click',function(){
          mes = $('#month_for_reports').val();
          $.ajax({
            url: "<?php echo site_url('admin/workshop_inscriptions_per_month')?>?mes="+mes, 
            type : 'GET',
            success: function(result){
              $("#w_insciption_per_month").html(result);
            }});
        });
//OCULTAR
        $('#btn_hide_inscriptions').on('click',function(){
          $.ajax({
            url: "<?php echo site_url('admin/empty')?>",
            success: function(result){
              $("#w_insciption_per_month").html(result);
            }});
        });

//MOSTRAR
        $('#btn_proposed_workshops_per_month').on('click',function(){
          mes = $('#month_for_reports').val();
          $.ajax({
            url: "<?php echo site_url('admin/proposed_workshops_per_month')?>?mes="+mes, 
            type : 'GET',
            success: function(result){
              $("#proposed_workshops_per_month").html(result);
            }});
        });
//OCULTAR
        $('#btn_hide_pw_per_month').on('click',function(){
          $.ajax({
            url: "<?php echo site_url('admin/empty')?>",
            success: function(result){
              $("#proposed_workshops_per_month").html(result);
            }});
        });

//MOSTRAR
        $('#btn_proposed_subcategories_per_month').on('click',function(){
          mes = $('#month_for_reports').val();
          $.ajax({
            url: "<?php echo site_url('admin/proposed_subcategories_per_month')?>?mes="+mes, 
            type : 'GET',
            success: function(result){
              $("#proposed_subcategories_per_month").html(result);
            }});
        });
//OCULTAR
        $('#btn_hide_psc_per_month').on('click',function(){
          $.ajax({
            url: "<?php echo site_url('admin/empty')?>",
            success: function(result){
              $("#proposed_subcategories_per_month").html(result);
            }});
        });

//MOSTRAR
        $('#btn_registrations_per_month').on('click',function(){
          mes = $('#month_for_reports').val();
          $.ajax({
            url: "<?php echo site_url('admin/registrations_per_month')?>?mes="+mes, 
            type : 'GET',
            success: function(result){
              $("#registrations_per_month").html(result);
            }});
        });
//OCULTAR
        $('#btn_hide_registrations_per_month').on('click',function(){
          $.ajax({
            url: "<?php echo site_url('admin/empty')?>",
            success: function(result){
              $("#registrations_per_month").html(result);
            }});
        });

//GRAFICOS
        var ctx = document.getElementById("popular_category_chart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [<?php echo $draw['name']?>],
                datasets: [{
                    label: 'Número de Inscritos',
                    data: [<?php echo $draw['quantity']?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(255,99,132,1)',
                        'rgba(255,99,132,1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
          });

        var ctx = document.getElementById("workshop_inscriptions_per_month").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Mayo","Junio","Agosto","Setiembre","Octubre"],
                datasets: [{
                    label: 'Número de Inscritos',
                    data: [<?php echo $inscription_draw['quantity']?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(255,99,132,1)',
                        'rgba(255,99,132,1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
          });


      });

</script>

</div>
</div>
</div>
</div>