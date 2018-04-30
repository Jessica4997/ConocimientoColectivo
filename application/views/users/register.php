      <div class="ms-hero-page-override ms-hero-img-airplane ms-bg-fixed ms-hero-bg-dark-light">
        <div class="container">
          <div class="text-center">
            <h1 class="no-m ms-site-title color-white center-block ms-site-title-lg mt-2 animated zoomInDown animation-delay-5">Registrarse</h1>
            <p class="lead lead-lg color-light text-center center-block mt-2 mw-800 text-uppercase fw-300 animated fadeInUp animation-delay-7">¡No esperes más y disfruta de los beneficios que te brinda Conocimiento <strong>Colectivo</strong>!
          </div>
        </div>
      </div>
      <div class="container">
        <div class="card card-primary card-hero animated fadeInUp animation-delay-7">
          <div class="card-body">
            <form method="post" action="<?php echo site_url('register_page/saveuser')?>" class="form-horizontal">
              <fieldset>

                <div class="row form-group">
                  <label for="inputEmail" class="col-md-2 control-label">Correo Electrónico</label>
                  <div class="col-md-9">
                    <input type="email" class="form-control" name="correo" placeholder="Correo Electrónico" required> </div>
                </div>
                <div class="row form-group">
                  <label for="inputPassword" class="col-md-2 control-label">Contraseña</label>
                  <div class="col-md-9">
                    <input type="password" class="form-control" name="contrasena" placeholder="Contraseña" required> </div>
                </div>

                <div class="row form-group">
                  <label for="inputName" class="col-md-2 control-label">Nombres</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" name="nombres" placeholder="Nombres" required> </div>
                </div>
                <div class="row form-group">
                  <label for="inputLast" class="col-md-2 control-label">Apellidos</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" name="apellidos" placeholder="Apellidos" required> </div>
                </div>

                <div class="row form-group">
                  <label for="inputCel" class="col-md-2 control-label">Celular</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" name="celular" placeholder="Celular"> </div>
                </div>

                <div class="row form-group">
                  <label for="inputCel" class="col-md-2 control-label">Teléfono</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" name="telefono" placeholder="Teléfono"> </div>
                </div>

                <div class="row form-group">
                  <label for="inputGen" class="col-md-2 control-label">Género</label>
                  <div class="col-md-9">
                    <select name="genero" class="form-control selectpicker">
                      
                      <option value="1">Femenino</option>
                      <option value="2">Masculino </option>
                    </select>
                  </div>
                </div>
                <div class="row form-group">
                  <label for="inputDate" class="col-md-2 control-label">Fecha de Nacimiento</label>
                  <div class="col-md-9">
                    <input type="date" name="fecha_nacimiento"> </div>
                </div>

                <div class="row form-group">
                  <label for="inputCel" class="col-md-2 control-label">Descripción</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" name="descripcion" placeholder="Descripción"> </div>
                </div>

                <div class="row mt-2">
                  <div class="offset-lg-2 col-lg-6">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox">
                        <span class="ml-2">Acepto las condiciones de uso.</span>
                      </label>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <button class="btn btn-raised btn-primary btn-block">Registrarse Ahora</button>
                  </div>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
      </div>