<div class="container">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card animated">
            <div class="card-body">

                    <?php if($error){?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="zmdi zmdi-close"></i>
                        </button>
                        <?php echo $error;?>
                    </div>
                    <?php }?>

                <h2 align="center">
                    <?php echo $description['psc_name']?>
                </h2>

                <div class="row" align="center">

                </div>

                <p class="lead" align="center">
                    <?php echo $description['psc_description']?>
                </p>

                <ul class="list-unstyled">
                    
                    <li> Creado por:
                        <?php echo $description['user_name']?>
                        <?php echo $description['user_last_name']?>

                    </li>

                    <li>Categoría:
                        <?php echo $description['category_name']?>
                    </li>

                    <li> Cantidad de Votos:
                        <?php echo $description['votes_quantity']?>
                    </li>

                    <li> Estado:
                        <?php echo $description['psc_removed']?>
                    </li>

                    <li> Aperturado:
                        <?php
                        if ($description['psc_status'] == 'Pendiente') {
                            $condition = 'No';
                        }else{
                            $condition = 'Si';
                        }
                        ?>
                        <?php echo $condition?>
                    </li>
                </ul>

                <label>Nota: Debe tener al menos 10 votos para ser aperturado</label>
                <div align="center" >
                <?php if($description['psc_removed'] == 'Activo' && $description['psc_status'] == 'Pendiente'){ ?>
                <a href="<?php echo site_url('admin/proposed_subcategories_open_request/' .$description['psc_id'])?>" class="btn btn-primary btn-raised">Aperturar</a>
                <?php }?>

                <a href="<?php echo site_url('admin/proposed_subcategories_edit/' .$description['psc_id'])?>" class="btn btn-primary btn-raised">Editar</a>

                <?php if($description['psc_removed'] == 'Activo'){ ?>
                <a href="<?php echo site_url('admin/proposed_subcategories_delete/' .$description['psc_id'])?>" class="btn btn-primary btn-raised">Eliminar</a>
                <?php }?>

                <?php if($description['psc_removed'] == 'Eliminado'){ ?>
                <a href="<?php echo site_url('admin/proposed_subcategories_cancel_delete/' .$description['psc_id'])?>" class="btn btn-primary btn-raised">Volver a Agregar</a>
                <?php }?>

                </div>
            </div>
        </div>
    </div>
</div>