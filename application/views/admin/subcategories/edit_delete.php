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
            <form method="post" action="<?php echo site_url('admin/edit_subcategory/' .$sc_id['id'])?>" class="form-horizontal">
              <fieldset>

                <div class="row form-group">
                  <label for="inputName" class="col-md-2 control-label">Subcategoría</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" name="subcategory_name" placeholder="Subcategoría" value="<?php echo $sc_id['sub_name']?>" required> </div>
                </div>
           
                    <input type="submit" value="Guardar Cambios" class="btn btn-raised btn-primary btn-block">

              </fieldset>
            </form>

            <?php if($sc_id['removed'] == 'Activo'){ ?>
            <a href="<?php echo site_url('admin/delete_subcategory/' .$sc_id['id'])?>" class="btn btn-raised btn-primary btn-block">Eliminar</a>
            <?php } ?>

            <?php if($sc_id['removed'] == 'Eliminado'){ ?>
            <a href="<?php echo site_url('admin/cancel_delete_subcategory/' .$sc_id['id'])?>" class="btn btn-raised btn-primary btn-block">Volver a Agregar</a>
            <?php } ?>

          </div>
        </div>
      </div>