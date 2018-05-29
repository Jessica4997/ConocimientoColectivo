<div class="container">
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

    <tr>
      <td><?php echo $listaa['name']?> <?php echo $listaa['last_name']?></td>
      <td><?php echo $listaa['description']?></td>
      <td><?php echo $listaa['email']?></td>
      <td><?php echo $listaa['cell_phone']?></td>
      <td></td>
      <td><a href="<?php echo site_url('')?>" class="btn btn-primary">Calificar</a></td>
    </tr>

  </tbody>
</table>
</div>