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
    </tr>
  </thead>
  <tbody>
    <?php foreach($lista_u as $rows){?>
    <tr>

      <th scope="row"></th>
      <td><?php echo $rows['name']?></td>
      <td><?php echo $rows['description']?></td>
      <td><?php echo $rows['email']?></td>
      <td><?php echo $rows['cell_phone']?></td>
    </tr>
    <?php }?> 
  </tbody>
</table>
</div>