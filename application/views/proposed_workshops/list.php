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
                        <h4 class="no-mt color-primary"><strong>Categorías</strong></h4>

                        <fieldset>
                            <?php foreach($lis as $rowc){
                                $isselect = (isset($category[$rowc['id']]))? 'checked':'';  
                                //var_dump($category);
                                ?>
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
                    <input type="text" name="q" placeholder="Buscar ...." class="form-control" value="<?php echo $q?>"> </div>
                    <button type="submit" class="btn btn-primary btn-raised btn-block">
                        <i class="zmdi zmdi-search"></i>Buscar</button>
                    </form>

                </div>
            </div>

            </div>
            <div class="col-lg-9">
                <h1 align="center">
                    <strong style="color:olive">Solicitudes de Talleres</strong>
                </h1>


                <p class="text-center">
                <button type="button" class="btn btn-primary btn-raised text-right" data-toggle="modal" data-target="#myModalPW"><i class="fa fa-plus"></i>Crear Solicitud</button>
                </p>
                <!-- Modal -->
                <div class="modal" id="myModalPW" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog animated zoomIn animated-3x" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title color-primary">Seleccionar Categoría</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                            </div>
                        <div class="modal-body">

                            <form method="POST" action="<?php echo site_url('proposed_workshop/create_second_step')?>">
                                <div class="row form-group">
                                    <label for="" class="col-md-2 control-label">Categoría</label>
                                    <div class="col-md-9">

                                        <select name="categoria_pw_first_step" class="form-control selectpicker">
                                            <?php foreach($lis as $rowc){?>
                                            <option value="<?php echo $rowc['id']?>"><?php echo $rowc['name']?></option>
                                            <?php }?>

                                        </select>
                                    </div>
                                </div>                              
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-raised btn-primary btn-block">Continuar</button>
                        </div>

                        </form>
                        </div>
                    </div>
                </div>



                <div class="row" id="Container">

                    <?php foreach($lists as $row){?>
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="card card card-primary ms-feature">
                            <div class="card-body text-center card-primary">

                                  <?php
                                    if ($row['level_name'] == 'Básico') {
                                      $color = "chartreuse";
                                    }elseif ($row['level_name'] == 'Intermedio') {
                                      $color = "gold";
                                    }elseif ($row['level_name'] == 'Avanzado') {
                                      $color = "red";
                                    }
                                  ?>                                
                                <h4 class="text-normal text-center color-primary">
                                    <?php echo $row['title']?>
                                </h4>
                                <p>
                                    <?php echo $row['description']?>
                                    <ul class="list-unstyled">
                                        <li>Categoría:
                                            <?php echo $row['name']?> - <?php echo $row['sub_name']?>
                                        </li>
                                        <li style="color: <?php echo $color?>">Nivel:
                                            <?php echo $row['level_name']?>
                                        </li>
                                        <li>Fecha:
                                            <?php echo $row['start_date']?>
                                        </li>
                                        <li>Horario:
                                            <?php echo date("H:i", strtotime($row['start_time']))?> - <?php echo date("H:i", strtotime($row['end_time']))?>
                                        </li>
                                    </ul>
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