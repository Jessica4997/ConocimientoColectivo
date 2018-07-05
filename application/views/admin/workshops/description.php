<div class="container">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
              <div class="card-body">
                <h2 class="color-primary" align="center">
                  <strong><?php echo $description['title']?></strong>
                </h2>
                
                  <div class="row ml-1" align="center">
                    <li class="list-unstyled"> Creado por:
                      <?php echo $description['user_name']?>
                      <?php echo $description['user_last_name']?>
                      <i class="fa fa-star" style="color: goldenrod; font-size: 20px;" id="s_rating"><?php echo $description['user_student_rating']?></i>

                    </li>

                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" align="center">
                      <h2 class="color-success text-normal">S/. <?php echo $description['amount']?></h2>
                    </div>

                   <?php
                      if ($description['level_name'] == 'Básico') {
                        $color = "chartreuse";
                      }elseif ($description['level_name'] == 'Intermedio') {
                        $color = "gold";
                      }elseif ($description['level_name'] == 'Avanzado') {
                        $color = "red";
                      }
                    ?>    
                  
                <p class="lead" align="center"><?php echo $description['description']?></p>
                <ul class="list-unstyled">
                  <li>Categoría: <?php echo $description['category_name']?></li>

                  <li> Sub-Categoría: <?php echo $description['subcategory_name']?></li>

                  <li> Fecha: <?php echo $description['start_date']?></li>

                  <li> Horario: <?php echo date("H:i", strtotime($description['start_time']))?> - <?php echo date("H:i", strtotime($description['end_time']))?></li>
 
                  <li style="color: <?php echo $color?>"> Nivel: <?php echo $description['level_name']?></li>

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

                <a href="<?php echo site_url('admin/show_student_list/'.$description['id'])?>" class="btn btn-primary btn-raised">Calificaciones de Alumnos</a>

                </div>
              </div>
            </div>
          </div>
      </div>