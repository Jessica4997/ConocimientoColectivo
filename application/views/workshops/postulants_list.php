<div class="container">
  <h3 align="center">Alumnos Postulantes</h3>
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