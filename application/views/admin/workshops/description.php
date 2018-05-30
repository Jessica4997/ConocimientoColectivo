<div class="container">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card animated zoomInDown animation-delay-5">
              <div class="card-body">
                <h2 align="center"><?php echo $description['title']?></h2>
                
                  <div class="row" align="center">
                    <li class="list-unstyled"> Creado por: <?php echo $description['user_name']?> <?php echo $description['user_last_name']?>

                    </li>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                      
                        <i class="zmdi zmdi-hc-lg zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-hc-lg zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-hc-lg zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-hc-lg zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-hc-lg zmdi-star"></i>
                   
                      </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" align="center">
                      <h2 class="color-success text-normal">S/. <?php echo $description['amount']?></h2>
                    </div>
                  
                <p class="lead" align="center"><?php echo $description['description']?></p>
                <ul class="list-unstyled">
                  <li>Categoría: <?php echo $description['category_name']?></li>

                  <li> Sub-Categoría: <?php echo $description['subcategory_name']?></li>

                  <li> Fecha: <?php echo $description['start_date']?></li>

                  <li> Horario: <?php echo date("H:i", strtotime($description['start_time']))?> - <?php echo date("H:i", strtotime($description['end_time']))?></li>
 
                  <li> Nivel: <?php echo $description['level_name']?></li>

                  <li> Vacantes: <?php echo $description['vacancy']?> </li>

                  <li> Estado: <?php echo $description['w_removed']?> </li>



                </ul>
                <div align="center">
                <a href="<?php echo site_url('admin/workshop_show_edit/'.$description['id'])?>" class="btn btn-primary btn-raised">Editar</a>

                <?php if($description['w_removed'] == 'Activo') { ?>
                <a href="<?php echo site_url('admin/workshop_delete/'.$description['id'])?>" class="btn btn-primary btn-raised">Eliminar</a>
                <?php } ?>

                <?php if($description['w_removed'] == 'Eliminado') { ?>
                <a href="<?php echo site_url('admin/workshop_cancel_delete/'.$description['id'])?>" class="btn btn-primary btn-raised">Agregar</a>
                <?php } ?>

                </div>
              </div>
            </div>
          </div>
      </div>