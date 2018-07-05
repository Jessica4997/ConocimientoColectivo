<div class="container">
  <h3 align="center" class="color-primary" style="font-weight: bold" >Lista de Alumnos</h3>

    <!-- Inside Card -->
  
    <div class="card">
      <div style="overflow-x:auto;">
        <table class="table table-no-border table-striped">
          <thead>
            <tr class="color-white">
              <th style="background: #c0ca33">#</th>
              <th style="background: #c0ca33">Nombres</th>
              <th style="background: #c0ca33">Calificación</th>
              <th style="background: #c0ca33">Cal. del Taller</th>
              <th style="background: #c0ca33">Cal. al Docente</th>
              <th style="background: #c0ca33">Editar Puntaje del Taller</th>
              <th style="background: #c0ca33">Editar Puntaje al Docente</th>
            </tr>
          </thead>

          <tbody>
            <?php $count = 0;?>
            <?php foreach($list as $rows){?>
            <tr>
              <td><?php echo ++$count ?></td>
              <td><?php echo $rows['name']?> <?php echo $rows['last_name']?></td>
              <td><?php echo $rows['student_rating']?></td>
              <td><?php echo $rows['iu_student_rating']?></td>
              <td><?php echo $rows['iu_tutor_rating']?></td>
              <td><a href="<?php echo site_url('admin/show_edit_student_rate/' .$rows['iu_w_id'].'/'.$rows['iu_user_id'])?>" class="btn btn-primary">Editar</a></td>
              <td><a href="<?php echo site_url('admin/show_edit_teacher_rate/' .$rows['iu_w_id'].'/'.$rows['iu_user_id'])?>" class="btn btn-primary">Editar</a></td>
            </tr>
            <?php }?>
          </tbody>
        </table>
      </div>
    </div>


<h3 align="center" class="color-primary" style="font-weight: bold" >Docente</h3>

    <div class="card">
      <div style="overflow-x:auto;">
        <table class="table table-no-border table-striped">
          <thead>
            <tr class="color-white">
              <th style="background: #c0ca33">Nombres</th>
              <th style="background: #c0ca33">Calificación</th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <td><?php echo $teacher['name']?> <?php echo $teacher['last_name']?></td>
              <td><?php echo $teacher['tutor_rating']?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

</div>

</div>