<div class="container">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card animated zoomInDown animation-delay-5">
              <div class="card-body">
                <h2 align="center"><?php echo $description['title']?></h2>
                
                  <div class="row" align="center">
                    <li class="list-unstyled ml-1"> Creado por: <?php echo $description['user_name']?> <?php echo $description['user_last_name']?>
                      
                      <i class="fa fa-star" style="color: goldenrod"><?php echo $description['user_tutor_rating']?></i>
                    </li>

                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" align="center">
                      <h2 class="color-success text-normal">S/. <?php echo $description['amount']?></h2>
                    </div>
                  
                <p class="lead" align="center"><?php echo $description['description']?></p>
                <ul class="list-unstyled">
                  <li>Categoría: <?php echo $description['category_name']?></li>

                  <li> Sub-Categoría: <?php echo $description['sub_name']?></li>

                  <li> Nivel: <?php echo $description['level_name']?></li>

                  <li> Fecha: <?php echo $description['start_date']?></li>

                  <li> Horario: <?php echo date("H:i", strtotime($description['start_time']))?> - <?php echo date("H:i", strtotime($description['end_time']))?></li>

                  <li> Vacantes: <?php echo $description['vacancy']?> </li>
                </ul>

                <?php

                //var_dump($w_historial);

                if ($description['workshop_creator'] != $this->session->userdata('s_iduser') || $w_historial['dificult'] >= $description['dificult']){

                  ?>
                <a href="<?php echo site_url('workshop/save_inscribed_user/'.$description['id'])?>" class="btn btn-primary btn-block btn-raised">Postular</a>
                <?php }?>


              </div>
            </div>
          </div>
      </div>