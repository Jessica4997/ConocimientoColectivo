<div class="container">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card card-primary">
            <div class="card-body">
                
                  <?php if($error){?>
                  <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="zmdi zmdi-close"></i>
                  </button>
                  <?php echo $error;?>
                  </div>
                  <?php }?>

                <h2 class="color-primary" align="center">
                   <strong><?php echo $description['title']?></strong>
                </h2>

                <div class="row" align="center">
                    <li class="list-unstyled ml-2"> Creado por:
                        <?php echo $description['user_name']?>
                        <?php echo $description['user_last_name']?>
                        <i class="fa fa-star" style="color: goldenrod; font-size: 20px;" id="s_rating"><?php echo $description['user_student_rating']?></i>

                    </li>
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

                <p class="lead" align="center">
                    <?php echo $description['description']?>
                </p>

                <ul class="list-unstyled">
                    <li>Categoría:
                        <?php echo $description['category_name']?>
                    </li>

                    <li> Sub-Categoría:
                        <?php echo $description['subcategory_name']?>
                    </li>

                    <li style="color: <?php echo $color?>"> Nivel:
                        <?php echo $description['level_name']?>
                    </li>

                    <li> Fecha de Inicio:
                        <?php echo $description['start_date']?>
                    </li>

                    <li> Horario:
                        <?php echo date("H:i", strtotime($description['start_time']))?> - <?php echo date("H:i", strtotime($description['end_time']))?>
                    </li>


                    <?php if(($description['votes_quantity']) != null){
                        $quantity_votes = $description['votes_quantity'];

                    }else{
                        $quantity_votes = 0;
                    }
                    ?>

                    <li> Cantidad de Votos:
                        <?php echo $quantity_votes?>
                    </li>
                </ul>
                <div align="center" >
                <?php if($description['pw_user_id'] != $this->session->userdata('s_iduser')){ ?>

                <a href="<?php echo site_url('proposed_workshop/open_request/' .$description['id'])?>" class="btn btn-primary btn-raised">Aperturar Solicitud</a>

                <?php } ?>

                <?php if($description['pw_user_id'] != $this->session->userdata('s_iduser')){ ?>

                <a href="<?php echo site_url('proposed_workshop/vote/' .$description['id'])?>" class="btn btn-primary btn-raised">
                    <i class="fa fa-thumbs-up"></i>Votar (<?php echo $quantity_votes?>)</a>

                <?php } ?>
                
                </div>

            </div>
        </div>
    </div>
</div>