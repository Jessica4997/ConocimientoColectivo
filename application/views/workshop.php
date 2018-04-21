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
          
          <div class="form-group no-mt">
            <div class="checkbox">
              <label>
                <input type="checkbox"> Bailes </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox"> Deportes </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox"> Música </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox"> Pintura </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox"> Teatro </label>
            </div>
          </div>
        </fieldset>
        <button class="btn btn-danger btn-block no-mb mt-2" id="Reset">
          <i class="zmdi zmdi-delete"></i>Limpiar filtros</button>
      </form>
      <form class="form-horizontal">
        <h4>Ordenar por</h4>
        <select id="SortSelect" class="form-control selectpicker">
          <option value="random">Populares</option>
          <option value="price:asc">Precio</option>
          <option value="price:desc">Calificación</option>
          <option value="date:asc">Fecha</option>
        </select>
      </form>
    </div>
  </div>

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
  <h1 align="center"><strong>Lista de Talleres</strong></h1>

  <p class="text-center">
      <a href="<?php echo site_url('workshop/create')?>" class="btn btn-primary btn-raised text-right" role="button">
        <i class="fa fa-plus"></i>Crear Taller</a>
  </p>

  <div class="row" id="Container">

    <?php foreach($lists as $row){?>
    <div class="col-xl-4 col-md-6 mix " data-price="<?php echo $row['amount']?>">
      <div class="card ms-feature">
        <div class="card-body text-center">
          <h4 class="text-normal text-center"><?php echo $row['title']?></h4>
          <p>
            <li>Categoría: <?php echo $row['name']?></li>
            <li>Sub-categoría:</li>
            <li>Género:</li>
            <li>Nivel: <?php echo $row['level']?></li>
            <li>Fecha de inicio: <?php echo $row['start_date']?></li>
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
        
          <a href="<?php echo site_url ('workshop/description/'.$row['id'])?>" class="btn btn-primary btn-sm btn-block btn-raised mt-2 no-mb">
            <i class="fa fa-search"></i>Ver Detalles</a>
        </div>
      </div>
    </div>
    <?php }?>

  </div>
</div>
</div>
</div>
