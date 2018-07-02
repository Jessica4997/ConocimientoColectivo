<div class="container col-xs-12">
  <h3 align="center" class="color-primary" style="font-weight: bold">Alumnos del Taller </h3>

  <?php if($error){?>
  <div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <i class="zmdi zmdi-close"></i>
    </button>
    <?php echo $error;?>
  </div>
  <?php }?>

<label style="color:red">Nota: Se podrá calificar a partir del día siguiente de finalizado el taller</label>
<br>
<ul>Fecha del Taller: <?php echo date("d-m-Y", strtotime($workshop_info['start_date']))?></ul>



<div class="card">
  <div style="overflow-x:auto;">
    <table class="table table-no-border table-striped">
      <thead>
        <tr class="color-white">
          <th style="background: #c0ca33">#</th>
          <th style="background: #c0ca33">Nombres</th>
          <th style="background: #c0ca33">Descripción</th>
          <th style="background: #c0ca33">Correo Electrónico</th>
          <th style="background: #c0ca33">Celular</th>
          <th style="background: #c0ca33">Calificación</th>
          <th style="background: #c0ca33">Opciones</th>
        </tr>
      </thead>

      <tbody>
        <?php $count = 0;?>
          <?php foreach($listaa as $rows){?>
          <tr>
            <td><?php echo ++$count ?></td>
            <td><?php echo $rows['user_name']?> <?php echo $rows['user_last_name']?></td>
            <td><?php echo $rows['user_description']?></td>
            <td><?php echo $rows['user_email']?></td>
            <td><?php echo $rows['user_cell_phone']?></td>
            <td><?php echo $rows['student_rating']?></td>
            <td><a href="<?php echo site_url('my_created_workshops/show_rate_students/' .$rows['user_id'].'/'.$rows['w_id'])?>" class="btn btn-primary">Calificar</a></td>
          </tr>
          <?php }?> 
      </tbody>
    </table>
  </div>
</div>

</div>