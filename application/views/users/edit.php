      <div class="ms-hero-page-override ms-hero-img-airplane ms-bg-fixed ms-hero-bg-dark-light">
        <div class="container">
          <div class="text-center">
            <h1 class="no-m ms-site-title color-white center-block ms-site-title-lg mt-2">Editar Datos</h1>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="card card-primary card-hero">
          <div class="card-body">

                  <?php if($error){?>
                  <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="zmdi zmdi-close"></i>
                  </button>
                  <?php echo $error;?>
                  </div>
                  <?php }?>
            
            <form method="post" action="<?php echo site_url('profile_page/save_edit_profile_data')?>" class="form-horizontal">
              <fieldset>

                <div class="row form-group">
                  <label for="inputName" class="col-md-2 control-label">Nombres (obligatorio)</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" name="nombres" placeholder="Nombres" value="<?php echo $user_d['name']?>" onkeypress="return only_letters(event)" required> </div>
                </div>

                <div class="row form-group">
                  <label for="inputLast" class="col-md-2 control-label">Apellidos (obligatorio)</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" name="apellidos" placeholder="Apellidos" value="<?php echo $user_d['last_name']?>" onkeypress="return only_letters(event)" required> </div>
                </div>

                <div class="row form-group">
                  <label for="inputCel" class="col-md-2 control-label">Celular</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" name="celular" placeholder="Celular" onkeypress="return only_numbers(event)" onpaste="return false" value="<?php echo $user_d['cell_phone']?>" > </div>
                </div>

                <div class="row form-group">
                  <?php
                  $datetime = new DateTime($user_d['date_birth']);
                  ?>
                  <label for="inputDate" class="col-md-2 control-label">Fecha de Nacimiento (obligatorio)</label>
                  <div class="col-md-9">
                    <input type="text" class="mydatepicker" name="fecha_nacimiento" value="<?php echo $datetime->format('d-m-Y')?>" required> </div>
                </div>

                <div class="form-group row justify-content-end">
                  <label for="" class="col-lg-2 control-label">Descripción</label>
                  <div class="col-lg-10">
                    <textarea class="form-control" rows="3" name="descripcion"><?php echo $user_d['description']?></textarea>
                    <span class="help-block">Escriba una breve descripción </span>
                  </div>
                </div>

           
                  <div class="col-lg-3 mt-2" align="center">
                    <input type="submit" value="Guardar Cambios" class="btn btn-raised btn-primary btn-block">
                  </div>

              </fieldset>
            </form>
          </div>
        </div>
      </div>
