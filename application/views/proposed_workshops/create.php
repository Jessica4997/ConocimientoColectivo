<div class="container">
        <div class="row"> 
          <div class="col-xl-12">
            <div class="card card-primary animated fadeInUp animation-delay-7">
              <div class="card-body">
                <h1 class="color-primary text-center">Crear Nuevo Taller</h1>
                <form method="post" action="<?php echo site_url('workshop/save')?>"  class="form-horizontal">
                  <fieldset>

                  <div class="row form-group">
                      <label for="" class="col-md-2 control-label">Título</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" placeholder="Título" name="titulo" required> </div>
                    </div>
                
                  <div class="row form-group">
                      <label for="" class="col-md-2 control-label">Categoría</label>
                      <div class="col-md-9">

                        <select name="categoria" class="form-control selectpicker">
                          <?php foreach($prueba as $rowp){?>
                          <option value="<?php echo $rowp['id']?>"><?php echo $rowp['name']?></option>
                          <?php }?>

                        </select>
                        
                      </div>
                      
                    </div>

                    <div class="row form-group">
                      <label for="" class="col-md-2 control-label">Sub-categoría</label>
                      <div class="col-md-9">
                        <select name="sub_categoria" class="form-control selectpicker">
                          <option>...</option>
                          <option>...</option>
                          <option>...</option>
                          <option>...</option>
                          <option>...</option>
                          <option>...</option>
                        </select>
                      </div>
                    </div>

                    <div class="row form-group">
                      <label for="" class="col-md-2 control-label">Nivel</label>
                      <div class="col-md-9">
                        <select name="nivel" class="form-control selectpicker">
                          <?php foreach($intento as $rowi){?>
                          <option><?php echo $rowi['level']?></option>
                          <?php }?>
                        </select>
                      </div>
                    </div>

                    <div class="row form-group">
                      <label for="inputDate" class="col-md-2 control-label">Fecha de Inicio</label>
                      <div class="col-md-9">
                        <input  type="datetime-local" name="fecha_inicio" placeholder="mes/día/año" required> </div>
                    </div>

                    <div class="row form-group">
                      <label for="inputDate" class="col-md-2 control-label">Fecha de Cierre</label>
                      <div class="col-md-9">
                        <input  type="datetime-local" name="fecha_fin" placeholder="mes/día/año" required> </div>
                    </div>

                    <div class="row form-group">
                      <label for="" class="col-md-2 control-label">Cantidad de Vacantes</label>
                      <div class="col-md-9">
                        <input type="number" name="vacantes" min="1" max="10" class="form-control" id="" placeholder="Cantidad de Vacantes" required> </div>
                    </div>

                    <div class="row form-group">
                      <label for="" class="col-md-2 control-label">Monto</label>
                      <div class="col-md-9">
                        <input type="number" name="monto" min="1" class="form-control" id="" placeholder="Monto" required> </div>
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
                        <button class="btn btn-raised btn-primary btn-block">Crear Taller</button>
                      </div>
                    </div>
                  </fieldset>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>