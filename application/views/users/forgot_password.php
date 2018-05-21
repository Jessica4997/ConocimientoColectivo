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
            <div class="card card-hero card-primary animated fadeInUp animation-delay-5">
                <div class="card-body">

                    <h1 class="color-primary text-center">Olvide mi contraseña</h1>
                    <form method="post" action="<?php echo site_url('login/recovery_password')?>" class="form-horizontal">
                        <fieldset>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-md-3 control-label">Correo Electrónico</label>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" name="correo" id="inputEmail" placeholder="Correo Electrónico" required> </div>
                            </div>
                        </fieldset>
                        <div align="center">
                            <input type="submit" class="btn btn-raised btn-primary" value="Recuperar contraseña">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>