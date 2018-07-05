<label>Cantidad de Solicitudes:</label> <?php echo $pw_number; ?>

    <div class="card">
      <div style="overflow-x:auto;">
        <table class="table table-no-border table-striped">
          <thead>
            <tr class="color-white">
              <th style="background: #c0ca33">Taller</th>
              <th style="background: #c0ca33">Categoría</th>
              <th style="background: #c0ca33">Creado por</th>
              <th style="background: #c0ca33">Cantidad de Votos</th>
              <th style="background: #c0ca33">Estado de la Solicitud</th>
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
      </div>
    </div>