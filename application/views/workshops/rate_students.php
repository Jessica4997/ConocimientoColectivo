<div class="container">
    <div class="row">

        <div class="col-lg-12">
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
            
                <form method="post" action="<?php echo site_url('my_created_workshops/rate_student/' .$info['iu_id']) ?>" class="form-horizontal">
                    <fieldset>
                        <button class="btn btn-raised btn-primary">Calificar</button>
                        <input class="ml-5" type="number" name="puntaje" onkeypress="return only_numbers(event)" min="1" max="5" required>
                    </fieldset>
                </form>


            </div>



        </div>
    </div>
</div>