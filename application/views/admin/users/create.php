      <div class="ms-hero-page-override ms-hero-img-airplane ms-bg-fixed ms-hero-bg-dark-light">
        <div class="container">
          <div class="text-center">
            <h1 class="no-m ms-site-title color-white center-block ms-site-title-lg mt-2">Crear Usuario</h1>
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


            
            <form method="post" action="<?php echo site_url('admin/create_user')?>" class="form-horizontal">
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
                  <label for="inputPassword" class="col-md-2 control-label">Repetir Contraseña</label>
                  <div class="col-md-9">
                    <input type="password" class="form-control" name="recontrasena" placeholder="Contraseña" required> </div>
                </div>

                <div class="row form-group">
                  <label for="inputName" class="col-md-2 control-label">Nombres</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" name="nombres" placeholder="Nombres" onkeypress="return only_letters(event)" required> </div>
                </div>
                <div class="row form-group">
                  <label for="inputLast" class="col-md-2 control-label">Apellidos</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" name="apellidos" placeholder="Apellidos" onkeypress="return only_letters(event)" required> </div>
                </div>

                <div class="row form-group">
                  <label for="inputCel" class="col-md-2 control-label">Celular</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" name="celular" placeholder="Celular" onkeypress="return only_numbers(event)"> </div>
                </div>


                <div class="row form-group">
                  <label for="inputGen" class="col-md-2 control-label">Rol</label>
                  <div class="col-md-9">
                    <select name="rol" class="form-control selectpicker">
                      
                      <option value='Default'>Normal</option>
                      <option value='Admin'>Administrador</option>
                    </select>
                  </div>
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
                    <input class="mydatepicker" type="text" name="fecha_nacimiento" placeholder="dia/mes/año" required> </div>
                </div>

                <div class="row form-group">
                  <label for="inputCel" class="col-md-2 control-label">Descripción</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" name="descripcion" placeholder="Descripción"> </div>
                </div>

                  <div class="col-lg-3">
                    <button class="btn btn-raised btn-primary">Crear</button>
                  </div>
  
              </fieldset>
            </form>

          </div>
        </div>
      </div>
