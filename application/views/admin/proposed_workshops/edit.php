<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="card card-primary animated fadeInUp animation-delay-7">
                <div class="card-body">
                    <h1 class="color-primary text-center">Editar Solicitud de Taller</h1>
                    <form method="post" action="<?php echo site_url('admin/proposed_workshop_edit_save/' .$pw_by_id['id'])?>" class="form-horizontal">
                        <fieldset>

                            <div class="row form-group">
                                <label for="" class="col-md-2 control-label">Título</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Título" name="titulo" value="<?php echo $pw_by_id['title']?>" required> </div>
                            </div>

                            <div class="row form-group">
                                <label for="" class="col-md-2 control-label">Categoría</label>
                                <div class="col-md-9">
                                    <?php echo $pw_by_id['category_name']?>
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
                                    <?php echo $pw_by_id['subcategory_name']?>
                                    <select name="sub_categoria" class="form-control selectpicker">
                                        <?php foreach($subcat as $rowsc){?>
                                        <option value="<?php echo $rowsc['id']?>"><?php echo $rowsc['sub_name']?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="" class="col-md-2 control-label">Nivel</label>
                                <div class="col-md-9">
                                    <?php echo $pw_by_id['level']?>
                                    <select name="nivel" class="form-control selectpicker">
                                        <option>Básico</option>
                                        <option>Intermedio</option>
                                        <option>Avanzado</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="inputDate" class="col-md-2 control-label">Fecha de Inicio</label>
                                <div class="col-md-9">
                                   <?php
                                   $datetime1 = new DateTime($pw_by_id['start_date']);
                                   ?>
                                    <input type="datetime-local" name="fecha_inicio" placeholder="mes/día/año" value="<?php echo $datetime1->format('Y-m-d\TH:i:s')?>" required> </div>
                            </div>

                            <div class="row form-group">
                                <label for="inputDate" class="col-md-2 control-label">Fecha de Cierre</label>
                                <div class="col-md-9">
                                   <?php
                                   $datetime2 = new DateTime($pw_by_id['final_date']);
                                   ?>
                                    <input type="datetime-local" name="fecha_fin" placeholder="mes/día/año" value="<?php echo $datetime2->format('Y-m-d\TH:i:s')?>" required> </div>
                            </div>

                            <div class="form-group row justify-content-end">
                                <label for="" class="col-lg-2 control-label">Descripción</label>
                                <div class="col-lg-10">   
                                    <textarea class="form-control" rows="3" name="descripcion"><?php echo $pw_by_id['description']?>
                                    </textarea>
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