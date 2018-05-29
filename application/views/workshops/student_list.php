<div class="container">
    <table class="table">
  <thead>
    <tr>
      <th>#</th>
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

      <th scope="row"></th>
      <td><?php echo $rows['user_name']?></td>
      <td><?php echo $rows['user_description']?></td>
      <td><?php echo $rows['user_email']?></td>
      <td><?php echo $rows['user_cell_phone']?></td>
      <td></td>
      <td><a href="<?php echo site_url('')?>" class="btn btn-primary">Calificar</a></td>
    </tr>
    </tr>
    <?php }?> 
  </tbody>
</table>
</div>