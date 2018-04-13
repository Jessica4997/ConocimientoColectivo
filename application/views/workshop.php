
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
                    <h4 class="mb-1">Brand</h4>
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
                    <i class="zmdi zmdi-delete"></i> Clear Filters</button>
                </form>
                <form class="form-horizontal">
                  <h4>Sort by</h4>
                  <select id="SortSelect" class="form-control selectpicker">
                    <option value="random">Popular</option>
                    <option value="price:asc">Price ASC</option>
                    <option value="price:desc">Price DESC</option>
                    <option value="date:asc">Release ASC</option>
                    <option value="date:desc">Release DESC</option>
                  </select>
                </form>
              </div>
            </div>
          </div>
          <div class="col-lg-9">
            <div class="row" id="Container">
              <div class="col-xl-4 col-md-6 mix laptop apple" data-price="1999.99" data-date="20160901">
                <div class="card ms-feature">
                  <div class="card-body text-center">
                    <a href="ecommerce-item.html">
                      <img src="/assets/img/demo/products/macbook.png" alt="" class="img-fluid center-block">
                    </a>
                    <h4 class="text-normal text-center">Macbook Pro 2015</h4>
                    <p>Quibusdam aperiam tempora ut blanditiis cumque ab pariatur.</p>
                    <div class="mt-2">
                      <span class="mr-2">
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star"></i>
                      </span>
                      <span class="ms-tag ms-tag-success">$ 1999.99</span>
                    </div>
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm btn-block btn-raised mt-2 no-mb">
                      <i class="zmdi zmdi-shopping-cart-plus"></i> Add to Cart</a>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-md-6 mix tablet apple" data-price="999.99" data-date="20160705">
                <div class="card ms-feature">
                  <div class="card-body text-center">
                    <a href="ecommerce-item.html">
                      <img src="/assets/img/demo/products/ipad.png" alt="" class="img-fluid center-block">
                    </a>
                    <h4 class="text-normal text-center">iPad Pro</h4>
                    <p>Quibusdam aperiam tempora ut blanditiis cumque ab pariatur.</p>
                    <div class="mt-2">
                      <span class="mr-2">
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                      </span>
                      <span class="ms-tag ms-tag-success">$ 999.99</span>
                    </div>
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm btn-block btn-raised mt-2 no-mb">
                      <i class="zmdi zmdi-shopping-cart-plus"></i> Add to Cart</a>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-md-6 mix accessory samsung" data-price="459.89" data-date="20160815">
                <div class="card ms-feature">
                  <div class="card-body text-center">
                    <a href="ecommerce-item.html">
                      <img src="/assets/img/demo/products/gear.png" alt="" class="img-fluid center-block">
                    </a>
                    <h4 class="text-normal text-center">Galaxy Gear S3</h4>
                    <p>Quibusdam aperiam tempora ut blanditiis cumque ab pariatur.</p>
                    <div class="mt-2">
                      <span class="mr-2">
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star"></i>
                        <i class="zmdi zmdi-star"></i>
                      </span>
                      <span class="ms-tag ms-tag-success">$ 459.89</span>
                    </div>
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm btn-block btn-raised mt-2 no-mb">
                      <i class="zmdi zmdi-shopping-cart-plus"></i> Add to Cart</a>
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
              <div class="col-xl-4 col-md-6 mix smartphone apple" data-price="769.00" data-date="20160907">
                <div class="card ms-feature">
                  <div class="card-body text-center">
                    <a href="ecommerce-item.html">
                      <img src="/assets/img/demo/products/iphone7.png" alt="" class="img-fluid center-block">
                    </a>
                    <h4 class="text-normal text-center">iPhone 7 Plus</h4>
                    <p>Quibusdam aperiam tempora ut blanditiis cumque ab pariatur.</p>
                    <div class="mt-2">
                      <span class="mr-2">
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star"></i>
                      </span>
                      <span class="ms-tag ms-tag-success">$ 769.00</span>
                    </div>
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm btn-block btn-raised mt-2 no-mb">
                      <i class="zmdi zmdi-shopping-cart-plus"></i> Add to Cart</a>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-md-6 mix accessory samsung" data-price="819.00" data-date="20160725">
                <div class="card ms-feature">
                  <div class="card-body text-center">
                    <a href="ecommerce-item.html">
                      <img src="/assets/img/demo/products/vr.png" alt="" class="img-fluid center-block">
                    </a>
                    <h4 class="text-normal text-center">Gear VR</h4>
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
              <div class="col-xl-4 col-md-6 mix tablet microsoft" data-price="799.80" data-date="20151015">
                <div class="card ms-feature">
                  <div class="card-body text-center">
                    <a href="ecommerce-item.html">
                      <img src="/assets/img/demo/products/surface.png" alt="" class="img-fluid center-block">
                    </a>
                    <h4 class="text-normal text-center">Surface Pro 4</h4>
                    <p>Quibusdam aperiam tempora ut blanditiis cumque ab pariatur.</p>
                    <div class="mt-2">
                      <span class="mr-2">
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star"></i>
                      </span>
                      <span class="ms-tag ms-tag-success">$ 799.80</span>
                    </div>
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm btn-block btn-raised mt-2 no-mb">
                      <i class="zmdi zmdi-shopping-cart-plus"></i> Add to Cart</a>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-md-6 mix accessory microsoft" data-price="79.95" data-date="20151015">
                <div class="card ms-feature">
                  <div class="card-body text-center">
                    <a href="ecommerce-item.html">
                      <img src="/assets/img/demo/products/xboxController.png" alt="" class="img-fluid center-block">
                    </a>
                    <h4 class="text-normal text-center">Xbox One Controller</h4>
                    <p>Quibusdam aperiam tempora ut blanditiis cumque ab pariatur.</p>
                    <div class="mt-2">
                      <span class="mr-2">
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star"></i>
                      </span>
                      <span class="ms-tag ms-tag-success">$ 79.95</span>
                    </div>
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm btn-block btn-raised mt-2 no-mb">
                      <i class="zmdi zmdi-shopping-cart-plus"></i> Add to Cart</a>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-md-6 mix smartphone microsoft" data-price="298.99" data-date="20141015">
                <div class="card ms-feature">
                  <div class="card-body text-center">
                    <a href="ecommerce-item.html">
                      <img src="/assets/img/demo/products/lumia.png" alt="" class="img-fluid center-block">
                    </a>
                    <h4 class="text-normal text-center">Lumia 950</h4>
                    <p>Quibusdam aperiam tempora ut blanditiis cumque ab pariatur.</p>
                    <div class="mt-2">
                      <span class="mr-2">
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star"></i>
                      </span>
                      <span class="ms-tag ms-tag-success">$ 298.99</span>
                    </div>
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm btn-block btn-raised mt-2 no-mb">
                      <i class="zmdi zmdi-shopping-cart-plus"></i> Add to Cart</a>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-md-6 mix tablet samsung" data-price="538.99" data-date="20151015">
                <div class="card ms-feature">
                  <div class="card-body text-center">
                    <a href="ecommerce-item.html">
                      <img src="/assets/img/demo/products/galaxyTab.png" alt="" class="img-fluid center-block">
                    </a>
                    <h4 class="text-normal text-center">Galaxy Tab S2</h4>
                    <p>Quibusdam aperiam tempora ut blanditiis cumque ab pariatur.</p>
                    <div class="mt-2">
                      <span class="mr-2">
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-star"></i>
                      </span>
                      <span class="ms-tag ms-tag-success">$ 538.99</span>
                    </div>
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm btn-block btn-raised mt-2 no-mb">
                      <i class="zmdi zmdi-shopping-cart-plus"></i> Add to Cart</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
     