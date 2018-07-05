<label>Cantidad de Solicitudes:</label> <?php echo $psc_number; ?>

    <div class="card">
      <div style="overflow-x:auto;">
        <table class="table table-no-border table-striped">
          <thead>
            <tr class="color-white">
              <th style="background: #c0ca33">Subcategoría Propuesta</th>
              <th style="background: #c0ca33">Categoría Principal</th>
              <th style="background: #c0ca33">Creado por</th>
              <th style="background: #c0ca33">Cantidad de Votos</th>
              <th style="background: #c0ca33">Estado de la Solicitud</th>
            </tr>
          </thead>

          <tbody>
            <?php foreach($psc_month as $rows){?>
            <tr>
              <td><?php echo $rows['name']?></td>
              <td><?php echo $rows['c_name']?></td>
              <td><?php echo $rows['u_name']?> <?php echo $rows['u_last_name']?></td>
              <td><?php echo $rows['votes_quantity']?></td>
              <td><?php echo $rows['psc_status']?></td>
            </tr>
            <?php }?> 
          </tbody>
        </table>
      </div>
    </div>