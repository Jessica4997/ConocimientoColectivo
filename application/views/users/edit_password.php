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
            <form method="post" action="<?php echo site_url('profile_page/save_edit_password_data')?>" class="form-horizontal">
              <fieldset>

                <div class="row form-group">
                  <label for="inputPassword" class="col-md-2 control-label">Contraseña</label>
                  <div class="col-md-9">
                    <input type="password" class="form-control" name="contrasena" placeholder="Contraseña" required> </div>
                </div>

                <div class="row form-group">
                  <label for="inputPassword" class="col-md-2 control-label">Reingresar Contraseña</label>
                  <div class="col-md-9">
                    <input type="password" class="form-control" name="recontrasena" placeholder="Reingresar Contraseña" required> </div>
                </div>

           
                  <div class="col-lg-3 mt-2" align="center">
                    <input type="submit" value="Guardar Cambios" class="btn btn-raised btn-primary btn-block">
                  </div>

              </fieldset>
            </form>
          </div>
        </div>
      </div>
