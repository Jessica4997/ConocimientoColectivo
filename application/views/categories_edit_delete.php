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
          </div>
        </div>
      </div>