<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
  <div class="container">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Filtros</h3>
    </div>
    <div class="card-body">
      <form class="form-horizontal">
        <h4 class="mb-1 no-mt">Categorías</h4>

        <fieldset>
          <?php foreach($lis as $rowc){?>
          <div class="form-group no-mt">
            <div class="checkbox">
              <label>
                <input name="category[]" value="<?php echo $rowc['id']?>" type="checkbox"> <?php echo $rowc['name']?> </label>
          </div>
         <?php }?>
        </fieldset>

          <h2 class="color-primary">Buscar</h2>
          <div class="form-group">
            <input type="text" name="q" class="form-control"> </div>
            <button type="submit" class="btn btn-primary btn-raised btn-block">
              <i class="zmdi zmdi-search"></i>Buscar</button>
            </form>
    </div>
  </div>

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
  <h1 align="center"><strong>Talleres</strong></h1>

  <div class="row" id="Container">

    <?php foreach($lists as $row){?>
    <div class="col-xl-6 col-lg-6 col-md-6 mix " data-price="<?php echo $row['amount']?>">
      <div class="card ms-feature">
        <div class="card-body text-center">
          <h4 class="text-normal text-center"><?php echo $row['title']?></h4>
          <p>
            <li>Creado por: <?php echo $row['u_name']?> <?php echo $row['u_last_name']?></li>
            <li>Categoría: <?php echo $row['name']?></li>
            <li>Sub-categoría: <?php echo $row['sub_name']?></li>
            <li>Nivel: <?php echo $row['level']?></li>
            <li>Fecha de inicio: <?php echo $row['start_date']?></li>
            <li>Fecha de cierre: <?php echo $row['final_date']?></li>
            <li>Descripción: <?php echo $row['description']?></li>
          </p>

            <span class="mr-2">
              <i class="zmdi zmdi-star color-warning"></i>
              <i class="zmdi zmdi-star color-warning"></i>
              <i class="zmdi zmdi-star color-warning"></i>
              <i class="zmdi zmdi-star color-warning"></i>
              <i class="zmdi zmdi-star"></i>
            </span>
            <span class="ms-tag ms-tag-success">S/. <?php echo $row['amount']?></span>
        
          <a href="<?php echo site_url ('admin/workshop_description/'.$row['w_id'])?>" class="btn btn-primary btn-sm btn-block btn-raised mt-2 no-mb">
            <i class="fa fa-search"></i>Ver Detalles</a>
        </div>
      </div>
    </div>
    <?php }?>

  </div>
</div>
</div>
</div>
