<div class="container text-center mb-6">
  <div class="container">

    <h1 class="no-m ms-site-title center-block ms-site-title-lg" style="color: olive"><strong>Mis Talleres Creados</strong></h1>

          <form id="workshop_form">
    <h2 class="color-primary">Buscar</h2>
    <div class="form-group">
      <input type="text" name="q" placeholder="Buscar ...." class="form-control" value="<?php echo $q?>"> </div>
      <input type="hidden" name="page" id="workshop_form_page" value="<?php echo $pagination?>"> 
      <button type="submit" class="btn btn-primary btn-raised btn-block">
        <i class="zmdi zmdi-search"></i>Buscar</button>
  </form>

</div>

  <div class="row">

    <?php foreach($hhh as $row){?>
    <div class="col-xl-6 col-lg-6 col-md-6">
      <div class="card ms-feature">
        <div class="card-body text-center">

          <?php
            if ($row['level_name'] == 'Básico') {
              $color = "chartreuse";
            }elseif ($row['level_name'] == 'Intermedio') {
              $color = "gold";
            }elseif ($row['level_name'] == 'Avanzado') {
              $color = "red";
            }
          ?>

          <h4 class="text-normal text-center color-primary"> <?php echo $row['title']?></h4>
          <p>
            <?php echo $row['description']?>
            <ul class="list-unstyled">
              <li>Categoría: <?php echo $row['category_name']?> - <?php echo $row['subcategory_name']?></li>
              <li style="color: <?php echo $color;?>">Nivel: <?php echo $row['level_name']?></li>
              <li>Fecha: <?php echo $row['start_date']?></li>
              <li>Horario: <?php echo date("H:i", strtotime($row['start_time']))?> - <?php echo date("H:i", strtotime($row['end_time']))?></li>
              <li>Vacantes: <?php echo $row['vacancy']?></li>
            </ul>
          </p>

            <span class="ms-tag ms-tag-success">S/.<?php echo $row['amount']?></span>
        
          <a href="<?php echo site_url('my_created_workshops/show_postulants_list/'.$row['w_id'])?>" class="btn btn-primary btn-sm btn-block btn-raised mt-2 no-mb">
            <i class="fa fa-search"></i>Ver Postulantes</a>

          <a href="<?php echo site_url('my_created_workshops/show_student_list/'.$row['w_id'])?>" class="btn btn-primary btn-sm btn-block btn-raised mt-2 no-mb">
            <i class="fa fa-search"></i>Ver Alumnos Matriculados</a>

        </div>
      </div>
    </div>
    <?php }?> 
  </div>
  
      <nav id="workshop_navigate_list" aria-label="Page navigation">
    <ul class="pagination pagination-plain">
      <?php for($page_i = 1;$page_i<=$num_pages && $num_pages>1;$page_i++){?>
      <li class="page-item <?php echo ($page_i==$pagination)? 'active':'';?>">
        <a class="page-link" href="<?php echo $page_i;?>"><?php echo $page_i;?></a>
      </li>
      <?php }?>
    </ul>
  </nav>
        
        </div>
    </div>
</div>