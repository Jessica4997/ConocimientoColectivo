<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <div class="row">
                <div class="col-lg-12 col-md-12 order-md-3 order-lg-2">
                    <a href="<?php echo site_url('admin/show_edit_profile/' .$list['id'])?>" class="btn btn-warning btn-raised btn-block animated fadeInUp animation-delay-12">
                        <i class="zmdi zmdi-edit"></i>Editar Datos</a>
                </div>
                <div class="col-lg-12 col-md-12 order-md-3 order-lg-2">
                    <a href="<?php echo site_url('admin/show_edit_password/' .$list['id'])?>" class="btn btn-success btn-raised btn-block animated fadeInUp animation-delay-12">
                        <i class="zmdi zmdi-edit"></i>Editar Contraseña</a>
                </div>
                <div class="col-lg-12 col-md-12 order-md-3 order-lg-2">
                    <a href="<?php echo site_url('admin/remove_users/' .$list['id'])?>" class="btn btn-danger btn-raised btn-block animated fadeInUp animation-delay-12">
                        <i class="zmdi zmdi-delete"></i>Eliminar</a>
                </div>
            </div>
        </div>


        <div class="col-lg-8">


            <div class="card card-primary animated fadeInUp animation-delay-12">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="zmdi zmdi-account-circle"></i>INFORMACIÓN DE PERFIL</h3>
                </div>
                <table class="table table-no-border ">
                    <tr>
                        <th style="color: olive">NOMBRES</th>
                        <td>
                            <?php echo $list['name']?>
                        </td>
                    </tr>
                    <tr>
                        <th style="color: olive">APELLIDOS</th>
                        <td>
                            <?php echo $list['last_name']?>
                        </td>
                    </tr>
                    <tr>
                        <th style="color: olive">CORREO ELECTRÓNICO</th>
                        <td>
                            <?php echo $list['email']?>
                        </td>
                    </tr>
                    <tr>
                        <th style="color: olive">CONTRASEÑA</th>
                        <td>
                            <?php echo $list['password']?>
                        </td>
                    </tr>
                    <tr>
                        <th style="color: olive">CELULAR</th>
                        <td>
                            <?php echo $list['cell_phone']?>
                        </td>
                    </tr>
                    <tr>
                        <th style="color: olive">GÉNERO</th>
                        <td>
                            <?php echo $list['gender']?>
                        </td>
                    </tr>
                    <tr>
                        <th style="color: olive">FECHA DE NACIMIENTO</th>
                        <td>
                            <?php echo $list['date_birth']?>
                        </td>
                    </tr>
                    <tr>
                        <th style="color: olive">ESTADO</th>
                        <td>
                            <?php echo $list['removed']?>
                        </td>
                    </tr>
                </table>
            </div>

        </div>
    </div>
</div>