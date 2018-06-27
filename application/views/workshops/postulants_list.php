<div class="container">
  <h3 align="center" class="color-primary" style="font-weight: bold" >Alumnos Postulantes</h3>

  <?php if($error){?>
  <div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <i class="zmdi zmdi-close"></i>
    </button>
    <?php echo $error;?>
  </div>
  <?php }?>

<label style="color:red">Nota: Solo podrás hacer la modificación hasta dos días antes del inicio del taller</label>
<br>
<ul>Fecha de Inicio del Taller: <?php echo date("d-m-Y", strtotime($workshop_info['start_date']))?></ul> 

    <table class="table">
  <thead>
    <tr>
      <th>Nombres</th>
      <th>Correo Electrónico</th>
      <th>Celular</th>
      <th>Calificación</th>
      <th>Estado</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($list as $rows){?>
    <tr>
      <td><?php echo $rows['user_name']?> <?php echo $rows['user_last_name']?></td>
      <td><?php echo $rows['user_email']?></td>
      <td><?php echo $rows['user_cell_phone']?></td>
      <td><?php echo $rows['student_rating']?></td>
      <td><?php echo $rows['iu_status']?></td>
      <td><a href="<?php echo site_url('my_created_workshops/validate_student/' .$rows['user_id'].'/'.$rows['w_id'])?>" class="btn btn-primary">Validar</a></td>
      <td><a href="<?php echo site_url('my_created_workshops/cancel_validate_student/' .$rows['user_id'].'/'.$rows['w_id'])?>" class="btn btn-primary">Cancelar</a></td>
    </tr>
    <?php }?> 
  </tbody>
</table>
</div>