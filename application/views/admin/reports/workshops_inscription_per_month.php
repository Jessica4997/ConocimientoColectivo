<label>Cantidad de Inscripciones:</label> <?php echo $inscription_number; ?>

    <div class="card">
      <div style="overflow-x:auto;">
        <table class="table table-no-border table-striped">
          <thead>
            <tr class="color-white">
              <th style="background: #c0ca33">Estado</th>
              <th style="background: #c0ca33">Nombres</th>
              <th style="background: #c0ca33">Taller</th>
              <th style="background: #c0ca33">Categoría</th>
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
      </div>
    </div>