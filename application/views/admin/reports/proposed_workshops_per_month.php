<label>Cantidad de Solicitudes:</label> <?php echo $pw_number; ?>
<table class="table">
  <thead>
    <tr>
      <th>Taller</th>
      <th>Categoría</th>
      <th>Creado por</th>
      <th>Cantidad de Votos</th>
      <th>Estado de la Solicitud</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($pw_month as $rows){?>
    <tr>
      <td><?php echo $rows['title']?></td>
      <td><?php echo $rows['c_name']?> - <?php echo $rows['sc_name']?></td>
      <td><?php echo $rows['u_name']?> <?php echo $rows['u_last_name']?></td>
      <td><?php echo $rows['votes_quantity']?></td>
      <td><?php echo $rows['pw_status']?></td>
    </tr>
    <?php }?> 
  </tbody>
</table>