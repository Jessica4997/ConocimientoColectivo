      <div class="row">
          <div class="col-lg-3">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Filtros</h3>
              </div>
              <div class="card-body">
                <form class="form-horizontal" id="Filters">
                  <h4 class="mb-1 no-mt">Categorías</h4>
                  <fieldset>
                    <div class="form-group no-mt">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" value=".smartphone"> Bailes </label>
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" value=".tablet"> Deportes </label>
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" value=".laptop"> Música </label>
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" value=".accessory"> Pintura </label>
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" value=".teatro"> Teatro </label>
                      </div>
                    </div>
                  </fieldset>
                  <fieldset>
                    <h4 class="mb-1">Sub-categoría</h4>
                    <div class="form-group no-mt">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" value=".apple"> Apple </label>
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" value=".microsoft"> Microsoft </label>
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" value=".samsung"> Samsung </label>
                      </div>
                    </div>
                  </fieldset>
                  <button class="btn btn-danger btn-block no-mb mt-2" id="Reset">
                    <i class="zmdi zmdi-delete"></i>Limpiar filtros</button>
                </form>
                <form class="form-horizontal">
                  <h4>Ordenar por</h4>
                  <select id="SortSelect" class="form-control selectpicker">
                    <option value="random">Populares</option>
                    <option value="price:asc">Precio</option>
                    <option value="price:desc">Calificación</option>
                    <option value="date:asc">Fecha</option>
                  </select>
                </form>
              </div>
            </div>
          </div>
          <div class="col-lg-9">
            <h1 align="center"><strong>Lista de Talleres</strong></h1>

            <p class="text-left">
                <a href="javascript:void()" class="btn btn-primary btn-raised text-right" role="button">
                  <i class="zmdi zmdi-collection-image-o"></i>Crear Taller</a>
            </p>

            <div class="row" id="Container">

              <?php foreach($workshops as $ws){?>
              <div class="col-xl-4 col-md-6 mix laptop apple" data-price="<?php echo $ws['amount']?>" data-date="20160901">
                <div class="card ms-feature">
                  <div class="card-body text-center">
                    <a href="<?php echo site_url('workshop_detail/'.$ws['id'])?>">
                      <img src="/assets/img/demo/products/macbook.png" alt="" class="img-fluid center-block">
                    </a>
                    <h4 class="text-normal text-center"><?php echo $ws['title']?></h4>
                    <p>
                      <li>nn</li>
                    </p>
                    <div class="mt-2">
                      <span class="mr-2">
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star"></i>
                      </span>
                      <span class="ms-tag ms-tag-success">S/. <?php echo $ws['amount']?></span>
                    </div>
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm btn-block btn-raised mt-2 no-mb">
                      <i class="zmdi zmdi-shopping-cart-plus"></i>Ver</a>
                  </div>
                </div>
              </div>
              <?php }?>
              <div class="col-xl-4 col-md-6 mix tablet apple" data-price="999.99" data-date="20160705">
                <div class="card ms-feature">
                  <div class="card-body text-center">
                    <a href="ecommerce-item.html">
                      <img src="/assets/img/demo/products/ipad.png" alt="" class="img-fluid center-block">
                    </a>
                    <h4 class="text-normal text-center">Taller de Música</h4>
                    <p>
                      <li>Sub-categoría:Guitarra</li>
                      <li>Género:Rock</li>
                      <li>Nivel: Intermedio</li>
                      <li>Fecha de inicio: 30-04-18</li>
                      <li>Iniciaremos un taller de guitarra para 5 personas que esten interesadas en aprender a tocar canciones de rock.</li>
                    </p>
                    <div class="mt-2">
                      <span class="mr-2">
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                      </span>
                      <span class="ms-tag ms-tag-success">S/.40.00</span>
                    </div>
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm btn-block btn-raised mt-2 no-mb">
                      <i class="zmdi zmdi-shopping-cart-plus"></i>Ver</a>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-md-6 mix accessory samsung" data-price="459.89" data-date="20160815">
                <div class="card ms-feature">
                  <div class="card-body text-center">
                    <a href="ecommerce-item.html">
                      <img src="/assets/img/demo/products/gear.png" alt="" class="img-fluid center-block">
                    </a>
                    <h4 class="text-normal text-center">Taller de Baile</h4>
                    <p>
                      <li>Sub-categoría: Ballet</li>
                      <li>Nivel: Básico</li>
                      <li>Fecha de inicio: 30-04-18</li>
                      <li>Busco chicas que esten interesadas en aprender a bailar ballet</li>
                    </p>
                    <div class="mt-2">
                      <span class="mr-2">
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star"></i>
                        <i class="zmdi zmdi-star"></i>
                      </span>
                      <span class="ms-tag ms-tag-success">$50.00</span>
                    </div>
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm btn-block btn-raised mt-2 no-mb">
                      <i class="zmdi zmdi-shopping-cart-plus"></i>Ver</a>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-md-6 mix accessory apple" data-price="769.99" data-date="20151014">
                <div class="card ms-feature">
                  <div class="card-body text-center">
                    <a href="ecommerce-item.html">
                      <img src="/assets/img/demo/products/appleWatch.png" alt="" class="img-fluid center-block">
                    </a>
                    <h4 class="text-normal text-center">Apple Watch Serie 2</h4>
                    <p>Quibusdam aperiam tempora ut blanditiis cumque ab pariatur.</p>
                    <div class="mt-2">
                      <span class="mr-2">
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star"></i>
                        <i class="zmdi zmdi-star"></i>
                      </span>
                      <span class="ms-tag ms-tag-success">$ 769.99</span>
                    </div>
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm btn-block btn-raised mt-2 no-mb">
                      <i class="zmdi zmdi-shopping-cart-plus"></i> Add to Cart</a>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-md-6 mix smartphone samsung" data-price="569.99" data-date="20151201">
                <div class="card ms-feature">
                  <div class="card-body text-center">
                    <a href="ecommerce-item.html">
                      <img src="/assets/img/demo/products/s7.png" alt="" class="img-fluid center-block">
                    </a>
                    <h4 class="text-normal text-center">Samsung Galaxy S7</h4>
                    <p>Quibusdam aperiam tempora ut blanditiis cumque ab pariatur.</p>
                    <div class="mt-2">
                      <span class="mr-2">
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star"></i>
                      </span>
                      <span class="ms-tag ms-tag-success">$ 569.99</span>
                    </div>
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm btn-block btn-raised mt-2 no-mb">
                      <i class="zmdi zmdi-shopping-cart-plus"></i> Add to Cart</a>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-md-6 mix laptop microsoft" data-price="2499.25" data-date="20161205">
                <div class="card ms-feature">
                  <div class="card-body text-center">
                    <a href="ecommerce-item.html">
                      <img src="/assets/img/demo/products/surfaceBook.png" alt="" class="img-fluid center-block">
                    </a>
                    <h4 class="text-normal text-center">Microsoft Surface Book</h4>
                    <p>Quibusdam aperiam tempora ut blanditiis cumque ab pariatur.</p>
                    <div class="mt-2">
                      <span class="mr-2">
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star"></i>
                      </span>
                      <span class="ms-tag ms-tag-success">$ 2499.25</span>
                    </div>
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm btn-block btn-raised mt-2 no-mb">
                      <i class="zmdi zmdi-shopping-cart-plus"></i> Add to Cart</a>
                  </div>
                </div>
              </div>


            </div>
          </div>
        </div>
     