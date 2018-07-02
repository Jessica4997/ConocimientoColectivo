      <div class="ms-hero-page-override ms-hero-img-airplane ms-bg-fixed ms-hero-bg-dark-light">
        <div class="container">
          <div class="text-center">
            <h1 class="no-m ms-site-title color-white center-block ms-site-title-lg mt-2">Editar Datos</h1>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="card card-primary card-hero">
          <div class="card-body">
            <form method="post" action="<?php echo site_url('admin/edit_category/' .$c_id['id'])?>" class="form-horizontal">
              <fieldset>

                <div class="row form-group">
                  <label for="inputName" class="col-md-2 control-label">Categoría</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" name="category_name" placeholder="Categoría" value="<?php echo $c_id['name']?>" required> </div>
                </div>
           
                    <input type="submit" value="Guardar Cambios" class="btn btn-raised btn-primary btn-block">

              </fieldset>
            </form>

            <?php if($c_id['removed'] == 'Activo'){ ?>
            <a href="<?php echo site_url('admin/remove_category/' .$c_id['id'])?>" class="btn btn-raised btn-primary btn-block">Eliminar</a>
            <?php } ?>

            <?php if($c_id['removed'] == 'Eliminado'){ ?>
            <a href="<?php echo site_url('admin/cancel_remove_category/' .$c_id['id'])?>" class="btn btn-raised btn-primary btn-block">Volver a Agregar</a>
            <?php } ?>

          </div>
        </div>
      </div>