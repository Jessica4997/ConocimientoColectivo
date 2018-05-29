<div class="container">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card animated zoomInDown animation-delay-5">
            <div class="card-body">
                <h2 align="center">
                    <?php echo $description['title']?>
                </h2>

                <div class="row" align="center">
                    <li class="list-unstyled ml-2"> Creado por:
                        <?php echo $description['user_name']?>
                        <?php echo $description['user_last_name']?>

                    </li>
                </div>

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

                    <li> Nivel:
                        <?php echo $description['level_name']?>
                    </li>

                    <li> Fecha de Inicio:
                        <?php echo $description['start_date']?>
                    </li>

                    <li> Horario:
                        <?php echo date("H:i", strtotime($description['start_time']))?> - <?php echo date("H:i", strtotime($description['end_time']))?>
                    </li>

                    <li> Cantidad de Votos:
                        <?php echo $description['votes_quantity']?>
                    </li>
                </ul>
                <div align="center" >
                <?php if($description['pw_user_id'] != $this->session->userdata('s_iduser')){ ?>

                <a href="<?php echo site_url('proposed_workshop/open_request/' .$description['id'])?>" class="btn btn-primary btn-raised">Aperturar Solicitud</a>

                <?php } ?>

                <?php if($description['pw_user_id'] != $this->session->userdata('s_iduser')){ ?>

                <a href="<?php echo site_url('proposed_workshop/vote/' .$description['id'])?>" class="btn btn-primary btn-raised">
                    <i class="fa fa-thumbs-up"></i>Votar (<?php echo $description['votes_quantity']?>)</a>

                <?php } ?>
                
                </div>

            </div>
        </div>
    </div>
</div>