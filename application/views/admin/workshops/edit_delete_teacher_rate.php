      <div class="ms-hero-page-override ms-hero-img-airplane ms-bg-fixed ms-hero-bg-dark-light">
        <div class="container">
          <div class="text-center">
            <h1 class="no-m ms-site-title color-white center-block ms-site-title-lg mt-2">Editar Puntaje al Profesor</h1>
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

            <form method="post" action="<?php echo site_url('admin/edit_teacher_rate/' .$iu_id['iu_id'])?>" class="form-horizontal">
              <fieldset>

                <div class="row form-group">
                  <label for="inputName" class="col-md-2 control-label">Calificación al Docente</label>
                  <div class="col-md-9">
                    <input type="number" class="form-control" name="puntaje_docente" placeholder="Calificación al docente" value="<?php echo $iu_id['iu_tutor_rating']?>" onkeypress="return only_for_ratings(event)" required> </div>
                </div>
           
                    <input type="submit" value="Guardar Cambios" class="btn btn-raised btn-primary btn-block">

              </fieldset>
            </form>

            <?php if(!is_null($iu_id['iu_student_rating'])){ ?>
            <a href="<?php echo site_url('admin/delete_rate_teacher/' .$iu_id['iu_id'])?>" class="btn btn-raised btn-primary btn-block">Eliminar</a>
            <?php } ?>

          </div>
        </div>
      </div>