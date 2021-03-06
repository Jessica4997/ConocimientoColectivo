<div class="container">
    <div class="row">
        <div class="col-lg-4">

                  <?php if($error){?>
                  <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="zmdi zmdi-close"></i>
                  </button>
                  <?php echo $error;?>
                  </div>
                  <?php }?>



            <div class="row">
                <div class="col-lg-12 col-md-6 order-md-1">
                    <div class="card">
                        <div class="ms-hero-bg-primary ms-hero-img-coffee">
                            <h3 class="color-white index-1 text-center no-m pt-4">
                                <?php echo $user_data['name']?>
                                <?php echo $user_data['last_name']?>
                            </h3>
                            <div class="color-medium index-1 text-center np-m">
                                <?php echo $user_data['email']?>
                            </div>
                             <img src="/uploads/<?php echo $profile_photo_name?>" alt="" class="img-avatar-circle"> </div>
                        <div class="card-body pt-4 text-center">
                            <h3 class="color-primary" style="font-weight: bold;">Biografía</h3>
                            <p>
                                <?php echo $user_data['description']?>

                            <?php if($this->session->userdata('s_urole') != 'Admin'){ ?>
                                <br>
                                <h4 class="color-primary" align="center" style="font-weight: bold;">Calificaciones</h4>
                                <label style="color: olive">Como Estudiante: </label> <i class="fa fa-star" style="color: goldenrod; font-size: 20px;" id="s_rating"><?php echo $user_data['student_rating']?></i>
                                <br>
                                <label style="color: olive">Como Profesor: </label> <i class="fa fa-star" style="color: goldenrod; font-size: 20px;" id="t_rating"><?php echo $user_data['tutor_rating']?></i>
                            <?php }?>
                            </p>

                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 order-md-3 order-lg-2">
                    <form enctype="multipart/form-data" action="<?php echo site_url('profile_page/upload_profile_photo')?>" method="POST">
                        <input type="file" name="profile_photo">
                        <input type="submit" value="Subir archivo" class="btn btn-info btn-raised btn-block">
                    </form>
                </div>

                <div class="col-lg-12 col-md-12 order-md-3 order-lg-2">
                    <a href="<?php echo site_url('profile_page/show_edit_profile')?>" class="btn btn-success btn-raised btn-block">
                        <i class="zmdi zmdi-edit"></i>Editar Perfil</a>
                </div>

                <div class="col-lg-12 col-md-12 order-md-3 order-lg-2">
                    <a href="<?php echo site_url('profile_page/show_edit_password')?>" class="btn btn-royal btn-raised btn-block">
                        <i class="zmdi zmdi-edit"></i>Cambiar contraseña</a>
                </div>
            </div>
        </div>


        <div class="col-lg-8">
            <?php if($this->session->userdata('s_urole') != 'Admin'){ ?>
            <div class="row">
                <div class="col-sm-4">
                    <div class="card card-info card-body text-center">
                        <h2 class="color-info"><?php echo $total_workshops?></h2>
                        <i class="fa fa-4x fa-file-text color-info"></i>
                        <p class="mt-2 no-mb lead small-caps color-info">Mis Talleres Creados</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card card-success card-body text-center">
                        <h2 class="color-success"><?php echo $total_inscriptions?></h2>
                        <i class="fa fa-4x fa-briefcase color-success"></i>
                        <p class="mt-2 no-mb lead small-caps color-success">Talleres Matriculados</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card card-royal card-body text-center">
                        <h2 class="color-royal"><?php echo $total_proposed_workshops?></h2>
                        <i class="fa fa-4x fa-comments-o color-royal"></i>
                        <p class="mt-2 no-mb lead small-caps color-royal">Talleres Solicitados</p>
                    </div>
                </div>
            </div>
            <?php }?>
            
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="zmdi zmdi-account-circle"></i>INFORMACIÓN DE PERFIL</h3>
                </div>
                <div style="overflow-x:auto;">
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
</div>