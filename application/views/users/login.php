<div class="ms-hero-page-override ms-hero-img-city ms-hero-bg-dark-light">
    <div class="container">
        <div class="text-center">
            <span class="ms-logo ms-logo-lg ms-logo-white center-block mb-2 mt-2 animated zoomInDown animation-delay-5">CC</span>
            <h1 class="no-m ms-site-title color-white center-block ms-site-title-lg mt-2 animated zoomInDown animation-delay-5">Conocimiento
                <strong>&nbsp;&nbsp;Colectivo</strong>
            </h1>
            <p class="lead lead-lg color-white text-center center-block mt-2 mw-800 text-uppercase fw-300 animated fadeInUp animation-delay-7">Inicia sesión para poder disfrutar de los beneficios que te brinda Conocimiento
                <strong>&nbsp;Colectivo</strong>
            </p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-lg-6">
            <div class="card card-hero card-primary animated fadeInUp animation-delay-7">
                <div class="card-body">
                    <?php if($error){?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="zmdi zmdi-close"></i>
                        </button>
                        <strong>
                            <i class="zmdi zmdi-close-circle"></¡Error!</strong>
                        <?php echo $error;?>
                    </div>
                    <?php }?>


                    <h1 class="color-primary text-center">Iniciar Sesión</h1>
                    <form method="post" action="<?php echo site_url('login/user_login')?>" class="form-horizontal">
                        <fieldset>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-md-3 control-label">Correo Electrónico</label>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" name="correo" id="inputEmail" placeholder="Correo Electrónico" required> </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-md-3 control-label">Contraseña</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="contrasena" id="inputPassword" placeholder="Contraseña" required> </div>
                            </div>
                        </fieldset>
                        <div align="center">
                            <input type="submit" class="btn btn-raised btn-primary" value="Continuar">

                        </div>
                    </form>

                    <div align="center">
                        <h3>¿No tienes cuenta? Regístrate</h3>
                        <a class="btn btn btn-primary" href="<?php echo site_url('register_page')?>">Registrarse
                            <i class=""></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>