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
                        <h4 class="no-mt">Categorías</h4>

                        <fieldset>
                            <?php foreach($lis as $rowc){
                                $isselect = (isset($category[$rowc['id']]))? 'checked':'';  ?>
                                <div class="no-mt">

                            <div class="checkbox">
                                <label>
                                    <input name="category[<?php echo $rowc['id']?>]" value="<?php echo $rowc['id']?>" type="checkbox"<?php echo $isselect;?>>
                                    <?php echo $rowc['name']?> </label>
                            </div>
                            <?php }?>
                    </fieldset>
                
                <h2 class="color-primary">Buscar</h2>
                <div class="form-group">
                    <input type="text" name="q" class="form-control" value="<?php echo $q?>"> </div>
                    <button type="submit" class="btn btn-primary btn-raised btn-block">
                        <i class="zmdi zmdi-search"></i>Buscar</button>
                    </form>

                </div>
            </div>

            </div>
            <div class="col-lg-9">
                <h1 align="center">
                    <strong>Solicitudes de Talleres</strong>
                </h1>

                <p class="text-center">
                    <a href="<?php echo site_url('proposed_workshop/create')?>" class="btn btn-primary btn-raised text-right" role="button">
                        <i class="fa fa-plus"></i>Crear Solicitud</a>
                </p>

                <div class="row" id="Container">

                    <?php foreach($lists as $row){?>
                    <div class="col-xl-4 col-md-6 mix ">
                        <div class="card ms-feature">
                            <div class="card-body text-center">
                                <h4 class="text-normal text-center">
                                    <?php echo $row['title']?> <?php echo $row['pw_id']?>
                                </h4>
                                <p>
                                    <li>Categoría:
                                        <?php echo $row['name']?>
                                    </li>
                                    <li>Sub-categoría: <?php echo $row['sub_name']?></li>
                                    <li>Nivel:
                                        <?php echo $row['level']?>
                                    </li>
                                    <li>Fecha de inicio:
                                        <?php echo $row['start_date']?>
                                    </li>
                                    <li>Descripción:
                                        <?php echo $row['description']?>
                                    </li>
                                </p>

                                <div align="center">
                                    <a href="<?php echo site_url ('proposed_workshop/description/'.$row['pw_id'])?>" class="btn btn-primary btn-sm btn-raised no-mb">
                                        <i class="fa fa-search"></i>Ver Detalles</a>
                                </div>

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