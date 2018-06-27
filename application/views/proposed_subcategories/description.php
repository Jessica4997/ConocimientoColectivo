<div class="container">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">


                    <?php if($error){?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="zmdi zmdi-close"></i>
                        </button>
                        <?php echo $error;?>
                    </div>
                    <?php }?>

                    
            <div class="card-body">
                <h2 align="center">
                    <?php echo $description['psc_name']?>
                </h2>

                <div class="row" align="center">

                </div>

                <p class="lead" align="center">
                    <?php echo $description['description']?>
                </p>

                <ul class="list-unstyled">
                    
                    <li> Creado por:
                        <?php echo $description['user_name']?>
                        <?php echo $description['user_last_name']?>

                    </li>

                    <li>Categoría:
                        <?php echo $description['category_name']?>
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

                <a href="<?php echo site_url('proposed_subcategories/vote/' . $description['psc_id'] )?>" class="btn btn-primary btn-raised">
                    <i class="fa fa-thumbs-up"></i>Votar (<?php echo $quantity_votes?>)</a>
                
                </div>

            </div>
        </div>
    </div>
</div>