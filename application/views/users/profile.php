<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <div class="row">
                <div class="col-lg-12 col-md-6 order-md-1">
                    <div class="card animated fadeInUp animation-delay-7">
                        <div class="ms-hero-bg-primary ms-hero-img-coffee">
                            <h3 class="color-white index-1 text-center no-m pt-4">
                                <?php echo $user_data['name']?>
                                <?php echo $user_data['last_name']?>
                            </h3>
                            <div class="color-medium index-1 text-center np-m">
                                <?php echo $user_data['email']?>
                            </div>
                            <img src="" class="img-avatar-circle"> </div>
                        <div class="card-body pt-4 text-center">
                            <h3 class="color-primary">Biografía</h3>
                            <p>
                                <?php echo $user_data['description']?>
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 order-md-3 order-lg-2">
                    <a href="<?php echo site_url('profile_page/show_edit_profile')?>" class="btn btn-warning btn-raised btn-block animated fadeInUp animation-delay-12">
                        <i class="zmdi zmdi-edit"></i>Editar Perfil</a>
                </div>

                <div class="col-lg-12 col-md-12 order-md-3 order-lg-2">
                    <a href="<?php echo site_url('profile_page/show_edit_password')?>" class="btn btn-success btn-raised btn-block animated fadeInUp animation-delay-12">
                        <i class="zmdi zmdi-edit"></i>Cambiar contraseña</a>
                </div>
            </div>
        </div>


        <div class="col-lg-8">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card card-info card-body text-center wow zoomInUp animation-delay-2">
                        <h2 class="color-info">5</h2>
                        <i class="fa fa-4x fa-file-text color-info"></i>
                        <p class="mt-2 no-mb lead small-caps color-info">Talleres Creados</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card card-success card-body text-center wow zoomInUp animation-delay-5">
                        <h2 class="color-success">2</h2>
                        <i class="fa fa-4x fa-briefcase color-success"></i>
                        <p class="mt-2 no-mb lead small-caps color-success">Talleres Matriculados</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card card-royal card-body text-center wow zoomInUp animation-delay-4">
                        <h2 class="color-royal">0</h2>
                        <i class="fa fa-4x fa-comments-o color-royal"></i>
                        <p class="mt-2 no-mb lead small-caps color-royal">Talleres Solicitados</p>
                    </div>
                </div>
            </div>

            <div class="card card-primary animated fadeInUp animation-delay-12">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="zmdi zmdi-account-circle"></i>INFORMACIÓN DE PERFIL</h3>
                </div>
                <table class="table table-no-border ">
                    <tr>
                        <th style="color: olive">NOMBRES</th>
                        <td>
                            <?php echo $user_data['name']?>
                        </td>
                    </tr>
                    <tr>
                        <th style="color: olive">APELLIDOS</th>
                        <td>
                            <?php echo $user_data['last_name']?>
                        </td>
                    </tr>
                    <tr>
                        <th style="color: olive">CORREO ELECTRÓNICO</th>
                        <td>
                            <?php echo $user_data['email']?>
                        </td>
                    </tr>
                    <tr>
                        <th style="color: olive">CELULAR</th>
                        <td>
                            <?php echo $user_data['cell_phone']?>
                        </td>
                    </tr>
                    <tr>
                        <th style="color: olive">GÉNERO</th>
                        <td>
                            <?php echo $user_data['gender']?>
                        </td>
                    </tr>
                    <tr>
                        <th style="color: olive">FECHA DE NACIMIENTO</th>
                        <td>
                            <?php echo $user_data['date_birth']?>
                        </td>
                    </tr>
                </table>
            </div>


        </div>
    </div>
</div>