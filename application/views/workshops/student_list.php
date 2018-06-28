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
<div style="overflow-x:auto;">
    <table class="table">
  <thead>
    <tr>
      <th>Nombres</th>
      <th>Descripción</th>
      <th>Correo Electrónico</th>
      <th>Celular</th>
      <th>Calificación</th>
      <th>Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($listaa as $rows){?>
    <tr>
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