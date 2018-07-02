<div class="container">
  <h3 align="center" class="color-primary" style="font-weight: bold">Docente del Taller </h3>

      <?php if($error){?>
      <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <i class="zmdi zmdi-close"></i>
      </button>
      <?php echo $error;?>
      </div>
      <?php }?>

<label style="color:red">Nota: Se podrá calificar a partir del día siguiente de finalizado el taller</label>
<br>
<ul>Fecha del Taller: <?php echo date("d-m-Y", strtotime($workshop_info['start_date']))?></ul>


<!-- Inside Card -->
  
<div class="card">
  <div style="overflow-x:auto;">
    <table class="table table-no-border table-striped">
      <thead>
        <tr class="color-white">
          <th style="background: #c0ca33">Nombres</th>
          <th style="background: #c0ca33">Descripción</th>
          <th style="background: #c0ca33">Correo Electrónico</th>
          <th style="background: #c0ca33">Celular</th>
          <th style="background: #c0ca33">Calificación</th>
          <th style="background: #c0ca33">Opciones</th>
        </tr>
      </thead>

      <tbody>
        
            <tr>
              <td><?php echo $listaa['name']?> <?php echo $listaa['last_name']?></td>
              <td><?php echo $listaa['description']?></td>
              <td><?php echo $listaa['email']?></td>
              <td><?php echo $listaa['cell_phone']?></td>
              <td><?php echo $listaa['u_tutor_rating']?></td>
              <td><a href="<?php echo site_url('my_workshops/show_rate_teacher/' .$listaa['w_user_id'].'/'.$listaa['w_id'])?>" class="btn btn-primary">Calificar</a></td>
            </tr>
        
      </tbody>
    </table>
  </div>
</div>

</div>