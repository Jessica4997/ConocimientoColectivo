      <div class="ms-hero-page-override ms-hero-img-airplane ms-bg-fixed ms-hero-bg-dark-light">
        <div class="container">
          <div class="text-center">
            <h1 class="no-m ms-site-title color-white center-block ms-site-title-lg mt-2 animated zoomInDown animation-delay-5">Crear Subcategoría</h1>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="card card-primary card-hero animated fadeInUp animation-delay-7">
          <div class="card-body">

            <form method="post" action="<?php echo site_url('admin/save_subcategory/' .$c_id['id'])?>" class="form-horizontal">

              <fieldset>
                <div class="row form-group">
                  <label class="col-md-2 control-label">Subcategoría</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" name="subcategory_name" placeholder="Subcategoría" onkeypress="return only_letters(event)" required> </div>
                </div>           
                    <input type="submit" value="Guardar" class="btn btn-raised btn-primary btn-block">

              </fieldset>
            </form>

          </div>
        </div>
      </div>