<label>Cantidad de Inscripciones:</label> <?php echo $inscription_number; ?>
<table class="table">
  <thead>
    <tr>
      <th>Estado</th>
      <th>Nombres</th>
      <th>Taller</th>
      <th>Categoría</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($inscriptions_month as $rows){?>
    <tr>
      <td><?php echo $rows['iu_status']?></td>
      <td><?php echo $rows['u_name']?> <?php echo $rows['u_last_name']?></td>
      <td><?php echo $rows['w_title']?></td>
      <td><?php echo $rows['c_name']?> - <?php echo $rows['sc_name']?></td>
    </tr>
    <?php }?> 
  </tbody>
</table>