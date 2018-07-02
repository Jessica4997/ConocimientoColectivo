<div class="container">
    <div class="row">
    <div class="col-lg-3">

  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Filtros</h3>
    </div>
    <div class="card-body">

      <form class="form-horizontal" id="workshop_form">
        <input type="hidden" id="workshop_form_page" name="page" value="<?php echo $pagination;?>">

        <h4 class="mb-1 no-mt color-primary"><strong>Categorías</strong></h4>
        <fieldset>
          <?php foreach($lis as $rowc){
            $isselect = (isset($category[$rowc['id']]))? 'checked':'';
            ?>
          <div class="form-group no-mt">
            <div class="checkbox">
              <label>
                <input name="category[<?php echo $rowc['id']?>]" value="<?php echo $rowc['id']?>" type="checkbox" <?php echo $isselect;?> > <?php echo $rowc['name']?> </label>
          </div>
         <?php }?>
        </fieldset>

          <h2 class="color-primary">Buscar</h2>
          <div class="form-group">
            <input type="text" name="q" placeholder="Buscar ...." class="form-control" value="<?php echo $q?>"> </div>
            <button type="submit" class="btn btn-primary btn-raised btn-block">
              <i class="zmdi zmdi-search"></i>Buscar</button>
            </form>
    </div>
  </div>
</div>
<div class="col-lg-9">
  <h1 align="center"><strong style="color:olive">Lista de Talleres</strong></h1>


  <div class="row" id="Container">

    <?php foreach($lists as $row){?>
    <div class="col-xl-6 col-lg-6 col-md-6" data-price="<?php echo $row['amount']?>">
      <div class="card card card-primary ms-feature">
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

          <h4 class="text-normal text-center color-primary"><strong><?php echo $row['title']?></strong></h4>
          <p>
            <?php echo $row['description']?>
            <ul class="list-unstyled">
              <li>Creado por: <?php echo $row['w_user_name']?> <?php echo $row['w_user_lastname']?></li>
              <li>Categoría: <?php echo $row['name']?></li>
              <li>Sub-categoría: <?php echo $row['sub_name']?></li>
              <li style="color: <?php echo $color;?>">Nivel: <?php echo $row['level_name']?></li>
              <li>Fecha: <?php echo $row['start_date']?></li>
              <li>Horario: <?php echo date("H:i", strtotime($row['start_time']))?> - <?php echo date("H:i", strtotime($row['end_time']))?></li>
            </ul>
          </p>

            <span class="ms-tag ms-tag-success">S/. <?php echo $row['amount']?></span>
        
          <a href="<?php echo site_url ('admin/workshop_description/'.$row['w_id'])?>" class="btn btn-primary btn-sm btn-block btn-raised mt-2 no-mb">
            <i class="fa fa-search"></i>Ver Detalles</a>
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
</div>
