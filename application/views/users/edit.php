      <div class="ms-hero-page-override ms-hero-img-airplane ms-bg-fixed ms-hero-bg-dark-light">
        <div class="container">
          <div class="text-center">
            <h1 class="no-m ms-site-title color-white center-block ms-site-title-lg mt-2 animated zoomInDown animation-delay-5">Editar Datos</h1>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="card card-primary card-hero animated fadeInUp animation-delay-7">
          <div class="card-body">
            <form method="post" action="<?php echo site_url('profile_page/save_edit_profile_data')?>" class="form-horizontal">
              <fieldset>

                <!--<div class="row form-group">
                  <label for="inputPassword" class="col-md-2 control-label">Contraseña</label>
                  <div class="col-md-9">
                    <input type="password" class="form-control" name="contrasena" placeholder="Contraseña" required> </div>
                </div>-->

                <div class="row form-group">
                  <label for="inputName" class="col-md-2 control-label">Nombres</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" name="nombres" placeholder="Nombres" value="<?php echo $user_d['name']?>" required> </div>
                </div>

                <div class="row form-group">
                  <label for="inputLast" class="col-md-2 control-label">Apellidos</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" name="apellidos" placeholder="Apellidos" value="<?php echo $user_d['last_name']?>"  required> </div>
                </div>

                <div class="row form-group">
                  <label for="inputCel" class="col-md-2 control-label">Celular</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" name="celular" placeholder="Celular" value="<?php echo $user_d['cell_phone']?>" > </div>
                </div>

                <div class="row form-group">
                  <?php
                  $datetime = new DateTime($user_d['date_birth']);
                  ?>
                  <label for="inputDate" class="col-md-2 control-label">Fecha de Nacimiento</label>
                  <div class="col-md-9">
                    <input type="date" name="fecha_nacimiento" value="<?php echo $datetime->format('Y-m-d')?>"> </div>
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
