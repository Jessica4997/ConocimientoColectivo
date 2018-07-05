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

                <h1 class="color-primary text-center">Crear Nuevo Taller</h1>
                <label class="ml-2" style="color:red">Nota: Debes crear un taller por lo menos con una semana de anticipación</label>
                <form method="post" action="<?php echo site_url('workshop/save')?>"  class="form-horizontal">
                  <fieldset>

                  <div class="row form-group">
                      <label for="" class="col-md-2 control-label">Título (obligatorio)</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" placeholder="Título" name="titulo" onkeypress="return only_letters(event)" onpaste="return false" required> </div>
                    </div>

                    <div class="row form-group">
                      <label for="" class="col-md-2 control-label">Sub-categoría (obligatorio)</label>
                      <div class="col-md-9">
                        <select name="subcategoria" class="form-control selectpicker">
                          <?php foreach($list_sc as $rowsc){?>
                          <option value="<?php echo $rowsc['id']?>"><?php echo $rowsc['sub_name']?></option>
                          <?php }?>

                        </select>
                      </div>
                    </div>

                    <div class="row form-group">
                      <label for="" class="col-md-2 control-label">Nivel (obligatorio)</label>
                      <div class="col-md-9">
                        <select name="nivel" class="form-control selectpicker">
                          <?php foreach($level_list as $rowi){?>
                          <option value="<?php echo $rowi['id']?>" ><?php echo $rowi['level']?></option>
                          <?php }?>
                        </select>
                      </div>
                    </div>

                    <div class="row form-group">
                      
                      <?php
                      ini_set('date.timezone','America/Lima'); 
                      $fechaActual = date('Y-m-d\TH:i');
                      ?>

                      <label class="col-md-2 control-label">Fecha (obligatorio)</label>
                      <div class="col-md-9">
                        <input class="mydatepicker" type="text" name="fecha" placeholder="mes/día/año" required> </div>
                    </div>


                    <div class="row form-group">
                      <label for="inputDate" class="col-md-2 control-label">Hora de Inicio (obligatorio)</label>
                      <div class="col-md-9">
                        <input class="timepicker" type="text" name="hora_inicio" placeholder="   -- : -- --" value="" required> </div>
                    </div>

                    <div class="row form-group">
                      <label for="inputDate" class="col-md-2 control-label">Hora de Fin (obligatorio)</label>
                      <div class="col-md-9">
                        <input class="timepicker" type="text" name="hora_fin" placeholder="   -- : -- --" required> </div>
                    </div>

                    <div class="row form-group">
                      <label for="" class="col-md-2 control-label">Cantidad de Vacantes (obligatorio)</label>
                      <div class="col-md-9">
                        <input type="number" name="vacantes" class="form-control" placeholder="Cantidad de Vacantes" onkeypress="return only_numbers(event)" onpaste="return false" required> </div>
                    </div>

                    <div class="row form-group">
                      <label for="" class="col-md-2 control-label">Monto (obligatorio)</label>
                      <div class="col-md-9">
                        <input type="number" name="monto" min="1" onkeypress="return only_numbers(event)" onpaste="return false" class="form-control" id="" placeholder="Monto" required> </div>
                    </div>

 <div class="form-group row justify-content-end">
            <label for="" class="col-lg-2 control-label">Descripción</label>

            <div class="col-lg-10">
                <textarea class="form-control" rows="3" name="descripcion" onkeypress="return only_letters(event)" onpaste="return false"></textarea>
                <span class="help-block">Escriba una breve descripción </span>
            </div>
        </div>


                    <div class="row mt-2">
                      <div class="col">
                        <button id="create_workshop_buttton" class="btn btn-raised btn-primary btn-block">Crear Taller</button>
                      </div>
                    </div>
                  </fieldset>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>