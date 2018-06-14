<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="card card-primary">
                <div class="card-body">
                    <h1 class="color-primary text-center">Crear Solicitud de Nuevo Tema</h1>

                    <?php if($error){?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="zmdi zmdi-close"></i>
                        </button>
                        <?php echo $error;?>
                    </div>
                    <?php }?>

                    
                    <form method="post" action="<?php echo site_url('proposed_subcategories/save')?>" class="form-horizontal">
                        <fieldset>

                            <div class="row form-group">
                                <label for="" class="col-md-2 control-label">Categoría</label>
                                <div class="col-md-9">

                                    <select name="categoria" class="form-control selectpicker">
                                        <?php foreach($prueba as $rowp){?>
                                        <option value="<?php echo $rowp['id']?>">
                                            <?php echo $rowp['name']?>
                                        </option>
                                        <?php }?>
                                    </select>

                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="" class="col-md-2 control-label">Nombre</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Título" name="nombre_subcategoria" onkeypress="return only_letters(event)" required> </div>
                            </div>

                            <div class="form-group row justify-content-end">
                                <label for="" class="col-lg-2 control-label">Descripción</label>

                                <div class="col-lg-10">
                                    <textarea class="form-control" rows="2" name="descripcion"></textarea>
                                    <span class="help-block">Escriba una breve descripción </span>
                                </div>
                            </div>


                            <div class="row mt-2">
                                <div class="col">
                                    <button class="btn btn-raised btn-primary btn-block">Crear Solicitud</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>