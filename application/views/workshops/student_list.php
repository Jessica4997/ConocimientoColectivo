<div class="container">
  <h3 align="center">Alumnos del Taller</h3>
    <table class="table">
  <thead>
    <tr>
      <th>Nombre</th>
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
      <td><?php echo $rows['user_name']?></td>
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