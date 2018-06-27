<div class="container">
    <div class="row">

        <div class="col-lg-12">
            <label style="color:red">La calificación total se mostrará cuando tengas dos calificaciones como mínimo</label> 
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">DATOS DEL ALUMNO</h3>
                </div>
                <table class="table table-no-border ">
                    <tr>
                        <th style="color: olive">NOMBRES</th>
                        <td>
                            <?php echo $info['name']?> <?php echo $info['last_name']?>
                        </td>
                    </tr>
                    <tr>
                        <th style="color: olive">CORREO ELECTRÓNICO</th>
                        <td>
                            <?php echo $info['email']?> <?php echo $info['iu_id']?>
                        </td>
                    </tr>
                    <tr>
                        <th style="color: olive">CELULAR</th>
                        <td>
                            <?php echo $info['cell_phone']?>
                        </td>
                    </tr>
                    <tr>
                        <th style="color: olive">CALIFICACIÓN TOTAL</th>
                        <td>
                            <?php echo $final ?>
                        </td>
                    </tr>

                    </tr>
                </table>
            </div>

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title" align="left">PUNTAJE DEL TALLER</h3>
                </div>
                <table class="table table-no-border">

                    <tr>
                        <th style="color: olive">PUNTAJE</th>
                        <?php
                        $score = (isset($info['iu_student_rating']))? $info['iu_student_rating']:"Aun no se ha calificado"; 
                        ?>
                        <td>
                            <?php echo $score ?>
                        </td>
                    </tr>

                </table>
            </div>

                <?php if($error){?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <i class="zmdi zmdi-close"></i>
                </button>
                <?php echo $error;?>
                </div>
                <?php }?>
            
                <form method="post" action="<?php echo site_url('my_created_workshops/rate_student/' .$info['iu_id']) ?>" class="form-horizontal">
                    <label style="color:red">Nota: La calificación es de 1 a 5</label>
                    <fieldset>
                        <button class="btn btn-raised btn-primary">Calificar</button>
                        <input class="ml-5" type="number" name="puntaje" onkeypress="return only_for_ratings(event)" required>
                    </fieldset>
                </form>


            </div>



        </div>
    </div>
</div>