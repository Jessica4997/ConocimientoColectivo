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
                    <input type="text" name="q" placeholder="Buscar ...." class="form-control" onkeypress="return only_letters(event)" onpaste="return false" value="<?php echo $q?>"> </div>
                    <button type="submit" class="btn btn-primary btn-raised btn-block">
                        <i class="zmdi zmdi-search"></i>Buscar</button>
                    </form>

                </div>
            </div>

            </div>
            <div class="col-lg-9">
                <h1 align="center">
                    <strong style="color:olive">Lista de Solicitudes de Nuevos Temas</strong>
                </h1>

                <div class="row" id="Container">

                    <?php foreach($lists as $row){?>
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="card card card-primary ms-feature">
                            <div class="card-body text-center">
                                <h4 class="text-normal text-center color-primary">
                                    <strong><?php echo $row['psc_name']?></strong> 
                                </h4>
                                <p>
                                    <?php echo $row['description']?>
                                    <ul class="list-unstyled">
                                        <li>Creado por:
                                            <?php echo $row['u_name']?> <?php echo $row['u_last_name']?>
                                        </li>
                                        <li>Categoría:
                                            <?php echo $row['c_name']?>
                                        </li>

                                        <li id="psc_votes_id">Cantidad de Votos:
                                            <?php echo $row['votes_quantity']?>
                                        </li>
                                    </ul>                      
                                </p>

                                <div align="center">
                                    <a href="<?php echo site_url ('admin/proposed_subcategories_description/'.$row['psc_id'])?>" class="btn btn-primary btn-sm btn-raised no-mb">
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