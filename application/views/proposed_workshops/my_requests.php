<div class="material-background"></div>
<div class="container text-center mb-6">
  <div class="container">
    <h1 class="no-m ms-site-title color-white center-block ms-site-title-lg mb-6 animated zoomInDown animation-delay-5">Mis Talleres Solicitados</h1>
</div>

  <div class="row">

    <?php foreach($request_list as $row){?>
    <div class="col-xl-6 col-lg-6 col-md-6 mix ">
      <div class="card ms-feature">
        <div class="card-body text-center">
          <h4 class="text-normal text-center"> <?php echo $row['title']?></h4>
          <p>
            <li>Categoría: <?php echo $row['category_name']?></li>
            <li>Sub-categoría: <?php echo $row['subcategory_name']?></li>
            <li>Nivel: <?php echo $row['level']?></li>
            <li>Fecha de inicio: <?php echo $row['start_date']?></li>
            <li>Fecha de fin: <?php echo $row['final_date']?></li>
            <li>Descripción: <?php echo $row['description']?></li>
          </p>
        
          <a href="" class="btn btn-primary btn-sm btn-block btn-raised mt-2 no-mb">
            <i class="fa fa-search"></i>FALTA</a>
        </div>
      </div>
    </div>
    <?php }?> 
  </div>
        
        </div>
    </div>
</div>