<div class="container text-center mb-6">
  <div class="container">
    <h1 class="no-m ms-site-title center-block ms-site-title-lg mb-6 animated zoomInDown animation-delay-5">Mis Talleres Matriculados</h1>

  <form id="workshop_form">
    <h2 class="color-primary">Buscar</h2>
    <div class="form-group">
      <input type="text" name="q" class="form-control" value="<?php echo $q?>"> </div>
      <input type="hidden" name="page" id="workshop_form_page" value="<?php echo $pagination?>"> 
      <button type="submit" class="btn btn-primary btn-raised btn-block">
        <i class="zmdi zmdi-search"></i>Buscar</button>
  </form>

</div>

  <div class="row mt-2">

    <?php foreach($lisss as $row){?>
    <div class="col-xl-6 col-lg-6 col-md-6 mix ">
      <div class="card ms-feature">
        <div class="card-body text-center">
          <h4 class="text-normal text-center"> <?php echo $row['title']?></h4>
          <p>
            <li>Categoría: <?php echo $row['category_name']?></li>
            <li>Sub-categoría: <?php echo $row['subcategory_name']?></li>
            <li>Nivel: <?php echo $row['level_name']?></li>
            <li>Fecha de inicio: <?php echo $row['start_date']?></li>
            <li>Fecha de fin: <?php echo $row['final_date']?></li>
            <li>Descripción: <?php echo $row['description']?></li>
          </p>

            <span class="ms-tag ms-tag-success">S/.<?php echo $row['amount']?></span>
        
          <a href="<?php echo site_url('my_workshops/show_teacher/' .$row['id'])?>" class="btn btn-primary btn-sm btn-block btn-raised mt-2 no-mb">
            <i class="fa fa-search"></i>Ver Docente</a>
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