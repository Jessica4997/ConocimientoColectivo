<div class="container">
    <table class="table">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Correo Electrónico</th>
      <th>Celular</th>
      <th>Calificación</th>
      <th>Estado</th>
      <th>Detalles</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($lista_u as $rows){?>
    <tr>

      <th><?php echo $rows['name']?> <?php echo $rows['last_name']?></th>
      <td><?php echo $rows['email']?></td>
      <td><?php echo $rows['cell_phone']?></td>
      <td></td>
      <td><?php echo $rows['removed']?></td>
      <td><a href="<?php echo site_url('admin/show_profile/' .$rows['id'])?>" class="btn btn-primary">Ver más</a></td>
    </tr>
    <?php }?> 
  </tbody>
</table>
</div>