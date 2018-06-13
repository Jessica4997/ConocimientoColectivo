      <div class="ms-hero-page-override ms-hero-img-airplane ms-bg-fixed ms-hero-bg-dark-light">
        <div class="container">
          <div class="text-center">
            <h1 class="no-m ms-site-title color-white center-block ms-site-title-lg mt-2 animated zoomInDown animation-delay-5">Editar Datos</h1>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="card card-primary card-hero animated fadeInUp animation-delay-7">
          <div class="card-body">
            <form method="post" action="<?php echo site_url('admin/edit_student_rate/' .$iu_id['iu_id'])?>" class="form-horizontal">
              <fieldset>

                <div class="row form-group">
                  <label for="inputName" class="col-md-2 control-label">Calificación del Alumno</label>
                  <div class="col-md-9">
                    <input type="number" class="form-control" name="puntaje_alumno" placeholder="Calificación del alumno" min="1" max="5" value="<?php echo $iu_id['iu_student_rating']?>" required> </div>
                </div>
           
                    <input type="submit" value="Guardar Cambios" class="btn btn-raised btn-primary btn-block">

              </fieldset>
            </form>

            <?php if(!is_null($iu_id['iu_student_rating'])){ ?>
            <a href="<?php echo site_url('admin/delete_rate_student/' .$iu_id['iu_id'])?>" class="btn btn-raised btn-primary btn-block">Eliminar</a>
            <?php } ?>

          </div>
        </div>
      </div>