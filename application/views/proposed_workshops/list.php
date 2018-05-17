<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Filtros</h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal">
                    <h4 class="no-mt">Categorías</h4>

                    <fieldset>
                        <?php foreach($lis as $rowc){?>
                        <div class="no-mt">

                            <div class="checkbox">
                                <label>
                                    <input value="<?php echo $rowc['id']?>" type="checkbox">
                                    <?php echo $rowc['name']?> </label>
                            </div>
                            <?php }?>
                    </fieldset>
                    <button class="btn btn-danger btn-block no-mb mt-2" id="Reset">
                        <i class="zmdi zmdi-delete"></i>Limpiar filtros</button>
                </form>

                <form method="get">
                <h2 class="color-primary">Buscar</h2>
                <div class="form-group">
                    <input type="text" class="form-control"> </div>
                    <a href="proposed_workshop/search_by_category" class="btn btn-primary btn-raised btn-block">
                        <i class="zmdi zmdi-search"></i>Buscar</a>
                    </form>
                <form class="form-horizontal">
                    <h4>Ordenar por</h4>
                    <select id="SortSelect" class="form-control selectpicker">
                        <option value="random">Populares</option>
                        <option value="date:asc">Fecha</option>
                    </select>
                </form>

                </div>
            </div>

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
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
                                    <?php echo $row['title']?>
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
                                    <a href="<?php echo site_url ('proposed_workshop/description/'.$row['id'])?>" class="btn btn-primary btn-sm btn-raised no-mb">
                                        <i class="fa fa-search"></i>Ver Detalles</a>

                                </div>

                            </div>
                        </div>
                    </div>
                    <?php }?>

                </div>
            </div>
        </div>
    </div>