<div class="ms-hero-page-override ms-hero-img-city ms-hero-bg-dark-light">
    <div class="container">
        <div class="text-center">
            <span class="ms-logo ms-logo-lg ms-logo-white center-block mb-2 mt-2">CC</span>
            <h1 class="ms-site-title color-white center-block ms-site-title-lg mt-2">Conocimiento
                <strong>&nbsp;&nbsp;Colectivo</strong>
            </h1>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-lg-6">
            <div class="card card-hero card-primary">
                <div class="card-body">

                    <h1 class="color-primary text-center">Recuperar contraseña</h1>
                    <form method="post" action="<?php echo site_url('login/update_new_password')?>" class="form-horizontal">
                        <input type="hidden" name="idusuario" value="<?php echo $id_user?>">
                        <fieldset>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-md-3 control-label">Nueva contraseña</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="contrasena" id="inputEmail" placeholder="Nueva contraseña" required> </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-md-3 control-label">Confirmar nueva contraseña</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="recontrasena" id="inputPassword" placeholder="Repetir contraseña" required> </div>
                            </div>
                        </fieldset>
                        <div align="center">
                            <input type="submit" class="btn btn-raised btn-primary" value="Cambiar contraseña">

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>