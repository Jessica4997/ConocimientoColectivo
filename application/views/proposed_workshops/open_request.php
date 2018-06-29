<div class="container">
        <div class="row"> 
          <div class="col-xl-12">
            <div class="card card-primary">
              <div class="card-body">

                <h1 class="color-primary text-center">Crear Nuevo Taller</h1>

                <form method="post" action="<?php echo site_url('proposed_workshop/insert_to_workshop/' .$abc['pw_id'])?>"  class="form-horizontal">
                  <fieldset>

                  <input type="hidden" name="pw_id" value="<?php echo $abc['pw_id']?>">

                  <div class="row form-group">
                      <label for="" class="col-md-2 control-label">Título</label>
                        <?php echo $abc['pw_title']?> 
                    </div>

                  <div class="row form-group">
                      <label for="" class="col-md-2 control-label">Categoría</label>
                        <?php echo $abc['category_name']?> 
                    </div>

                  <div class="row form-group">
                      <label for="" class="col-md-2 control-label">Subcategoría</label>
                        <?php echo $abc['subcategory_name']?> 
                    </div>

                    <div class="row form-group">
                      <label for="" class="col-md-2 control-label">Nivel</label>
                        <?php echo $abc['level_name']?> 
                    </div>

                    <div class="row form-group">
                      <label for="" class="col-md-2 control-label">Fecha</label>
                        <?php echo $abc['start_date']?> 
                    </div>
 

                    <div class="row form-group">
                      <label for="" class="col-md-2 control-label">Cantidad de Vacantes</label>
                      <div class="col-md-9">
                        <input type="number" name="vacantes" min="1" max="10" class="form-control" id="" placeholder="Cantidad de Vacantes" onkeypress="return only_numbers(event)" onpaste="return false" required> </div>
                    </div>

                    <div class="row form-group">
                      <label for="" class="col-md-2 control-label">Monto</label>
                      <div class="col-md-9">
                        <input type="number" name="monto" min="1" class="form-control" id="" placeholder="Monto" onkeypress="return only_numbers(event)" onpaste="return false" required> </div>
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