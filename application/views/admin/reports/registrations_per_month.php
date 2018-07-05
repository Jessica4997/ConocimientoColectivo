<label>Cantidad de Registros:</label> <?php echo $users_number; ?>

    <div class="card">
      <div style="overflow-x:auto;">
        <table class="table table-no-border table-striped">
          <thead>
            <tr class="color-white">
              <th style="background: #c0ca33">Nombres</th>
              <th style="background: #c0ca33">Email</th>
              <th style="background: #c0ca33">Fecha de Nacimiento</th>
              <th style="background: #c0ca33">Género</th>
              <th style="background: #c0ca33">Calificación</th>
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
      </div>
    </div>