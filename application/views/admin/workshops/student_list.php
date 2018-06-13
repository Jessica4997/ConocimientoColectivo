<div class="container">
  <h3>Lista de Alumnos</h3>
  <table class="table">
    <thead>
      <tr>
      <th>Nombres</th>
      <th>Calificación</th>
      <th>Calificación del Taller</th>
      <th>Calificación al Docente</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($list as $rows){?>
    <tr>
      <td><?php echo $rows['name']?> <?php echo $rows['last_name']?></td>
      <td><?php echo $rows['student_rating']?></td>
      <td><?php echo $rows['iu_student_rating']?></td>
      <td><?php echo $rows['iu_tutor_rating']?></td>
      <td><a href="<?php echo site_url('admin/show_edit_student_rate/' .$rows['iu_w_id'].'/'.$rows['iu_user_id'])?>" class="btn btn-primary">Editar Puntaje del Taller</a></td>
      <td><a href="<?php echo site_url('admin/show_edit_teacher_rate/' .$rows['iu_w_id'].'/'.$rows['iu_user_id'])?>" class="btn btn-primary">Editar Puntaje al Docente</a></td>
    </tr>
    <?php }?> 
  </tbody>
</table>


<h3>Docente</h3>
<table class="table">
    <thead>
      <tr>
      <th>Nombres</th>
      <th>Calificación</th>
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