<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="card card-primary">
                <div class="card-body">
                    <h1 class="color-primary text-center">Editar Taller</h1>


                    <?php if($error){?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="zmdi zmdi-close"></i>
                        </button>
                        <?php echo $error;?>
                    </div>
                    <?php }?>


                    <form method="post" action="<?php echo site_url('admin/workshop_save_edit/' .$w_by_id['id'])?>" class="form-horizontal">
                        <fieldset>

                            <div class="row form-group">
                                <label for="" class="col-md-2 control-label">Título</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Título" name="titulo" value="<?php echo $w_by_id['title']?>" onkeypress="return only_letters(event)" required> </div>
                            </div>

                            <div class="row form-group">
                                <label for="" class="col-md-2 control-label">Categoría</label>
                                <div class="col-md-9">
                                    <?php echo $w_by_id['category_name']?>
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
                                <label for="" class="col-md-2 control-label">Sub-categoría</label>
                                <div class="col-md-9">
                                    <?php echo $w_by_id['subcategory_name']?>
                                    <select name="subcategoria" class="form-control selectpicker">
                                        <?php foreach($subcat as $rowsc){?>
                                        <option value="<?php echo $rowsc['id']?>"><?php echo $rowsc['sub_name']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="" class="col-md-2 control-label">Nivel</label>
                                <div class="col-md-9">
                                    <?php echo $w_by_id['level_name']?>
                                    <select name="nivel" class="form-control selectpicker">
                                        <?php foreach($level_list as $rowl){ ?>
                                        <option value="<?php echo $rowl['id']?>" ><?php echo $rowl['level']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="inputDate" class="col-md-2 control-label">Fecha de Inicio</label>
                                <div class="col-md-9">
                                    <?php
                                    $datetime1 = new DateTime($w_by_id['start_date']);
                                    ?>
                                    <input type="text" class="mydatepicker" name="fecha_inicio" placeholder="mes/día/año" value="<?php echo $datetime1->format('d-m-Y')?>" required> </div>
                            </div>

                            <div class="row form-group">
                                <label for="inputDate" class="col-md-2 control-label">Hora de Inicio</label>
                                <div class="col-md-9">
                                    <input class="timepicker" type="text" name="hora_inicio" placeholder="   -- : -- --" value="<?php echo $w_by_id['start_time']?>" required> </div>
                            </div>

                            <div class="row form-group">
                                <label for="inputDate" class="col-md-2 control-label">Hora de Fin</label>
                                <div class="col-md-9">
                                    <input class="timepicker" type="text" name="hora_fin" placeholder="   -- : -- --" value="<?php echo $w_by_id['end_time']?>" required> </div>
                            </div>


                            <div class="form-group row justify-content-end">
                                <label for="" class="col-lg-2 control-label">Descripción</label>

                                <div class="col-lg-10">
                                    
                                    <textarea class="form-control" rows="3" name="descripcion"><?php echo $w_by_id['description']?></textarea>
                                    <span class="help-block">Escriba una breve descripción </span>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col">
                                    <button class="btn btn-raised btn-primary btn-block">Guardar Cambios</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>