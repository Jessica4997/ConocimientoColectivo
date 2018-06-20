<label>Cantidad de Solicitudes:</label> <?php echo $psc_number; ?>
<table class="table">
  <thead>
    <tr>
      <th>Subcategoría Propuesta</th>
      <th>Categoría Principal</th>
      <th>Creado por</th>
      <th>Cantidad de Votos</th>
      <th>Estado de la Solicitud</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($psc_month as $rows){?>
    <tr>
      <td><?php echo $rows['name']?></td>
      <td><?php echo $rows['c_name']?></td>
      <td><?php echo $rows['u_name']?> <?php echo $rows['u_last_name']?></td>
      <td><?php echo $rows['votes_quantity']?></td>
      <td><?php echo $rows['status']?></td>
    </tr>
    <?php }?> 
  </tbody>
</table>