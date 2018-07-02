<div class="container text-center mb-6">
  <div class="container">

    <h1 class="no-m ms-site-title center-block ms-site-title-lg" style="color: olive"><strong>Mis Solicitudes de Nuevos Temas</strong></h1>

      <form id="workshop_form">
    <h2 class="color-primary">Buscar</h2>
    <div class="form-group">
      <input type="text" name="q" placeholder="Buscar ...." class="form-control" value="<?php echo $q?>"> </div>
      <input type="hidden" name="page" id="workshop_form_page" value="<?php echo $pagination?>"> 
      <button type="submit" class="btn btn-primary btn-raised btn-block">
        <i class="zmdi zmdi-search"></i>Buscar</button>
  </form>
</div>

  <div class="row mt-2">

    <?php foreach($request_list as $row){?>
    <div class="col-xl-6 col-lg-6 col-md-6">
      <div class="card card card-primary ms-feature">
        <div class="card-body text-center">
          <h4 class="text-normal text-center color-primary"> <?php echo $row['psc_name']?></h4>
          <p>
            <?php echo $row['description']?>
            <ul class="list-unstyled">
            <li>Categoría: <?php echo $row['c_name']?></li>

              <?php if(($row['votes_quantity']) != null){
                  $quantity_votes = $row['votes_quantity'];
              }else{
                  $quantity_votes = 0;
              }
              ?>

            <li>Cantidad de Votos: <?php echo $quantity_votes?></li>
            </ul>
            <h4 style="color:yellowgreen; font-weight: bold;">Estado: <?php echo $row['psc_status']?></h4>
          </p>
        
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
 