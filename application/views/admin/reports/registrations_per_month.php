<label>Cantidad de Registros:</label> <?php echo $users_number; ?>
<table class="table">
  <thead>
    <tr>
      <th>Nombres</th>
      <th>Email</th>
      <th>Fecha de Nacimiento</th>
      <th>Género</th>
      <th>Calificación</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($users_month as $rows){?>
    <tr>
      <td><?php echo $rows['name']?> <?php echo $rows['last_name']?></td>
      <td><?php echo $rows['email'] ?></td>
      <td><?php echo date("d-m-Y",strtotime($rows['date_birth']))?></td>
      <td><?php echo $rows['gender']?></td>
      <td><?php echo $rows['student_rating']?></td>
    </tr>
    <?php }?> 
  </tbody>
</table>