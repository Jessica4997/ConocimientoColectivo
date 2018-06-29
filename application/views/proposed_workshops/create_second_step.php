<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="card card-primary">
                <div class="card-body">

                  <?php if($error){?>
                  <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="zmdi zmdi-close"></i>
                  </button>
                  <?php echo $error;?>
                  </div>
                  <?php }?>

                    <h1 class="color-primary text-center">Crear Solicitud de Taller</h1>
                    <label class="ml-2" style="color:red">Nota: Debes crear un solicitud de taller por lo menos con tres días de anticipación</label>
                    <form method="post" action="<?php echo site_url('proposed_workshop/save')?>" class="form-horizontal">
                        <fieldset>

                            <div class="row form-group">
                                <label for="" class="col-md-2 control-label">Título</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Título" name="titulo" onkeypress="return only_letters(event)" required> </div>
                            </div>


                            <div class="row form-group">
                                <label for="" class="col-md-2 control-label">Sub-categoría</label>
                                <div class="col-md-9">
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
                                    <select name="nivel" class="form-control selectpicker">
                                        <?php foreach($level_list as $rowl){?>
                                        <option value="<?php echo $rowl['id']?>" >
                                            <?php echo $rowl['level']?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="inputDate" class="col-md-2 control-label">Fecha</label>

                                <div class="col-md-9">
                                    <input class="mydatepicker" type="text" name="fecha_inicio" placeholder="mes/día/año" required> </div>
                            </div>

                            <div class="row form-group">
                                <label for="inputDate" class="col-md-2 control-label">Hora de Inicio</label>
                                <div class="col-md-9">
                                    <input class="timepicker" type="text" name="hora_inicio" placeholder="   -- : -- --" required> </div>
                            </div>

                                <div class="row form-group">
                                    <label for="inputDate" class="col-md-2 control-label">Hora de Fin</label>
                                    <div class="col-md-9">
                                        <input class="timepicker" type="text" name="hora_fin" placeholder="   -- : -- --" required> </div>
                                </div>


                            <div class="form-group row justify-content-end">
                                <label for="" class="col-lg-2 control-label">Descripción</label>

                                <div class="col-lg-10">
                                    <textarea class="form-control" rows="3" name="descripcion"></textarea>
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