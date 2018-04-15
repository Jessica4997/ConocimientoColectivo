<div class="modal modal-primary" id="ms-account-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog animated zoomIn animated-3x" role="document">
          <div class="modal-content">
            <div class="modal-header d-block shadow-2dp no-pb">
              <button type="button" class="close d-inline pull-right mt-2" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                  <i class="zmdi zmdi-close"></i>
                </span>
              </button>
              <div class="modal-title text-center">
                <span class="ms-logo ms-logo-white ms-logo-sm mr-1">CC</span>
                <h3 class="no-m ms-site-title">Conocimiento
                  <span><strong>&nbsp;Colectivo</strong></span>
                </h3>
              </div>
              <div class="modal-header-tabs">
                <ul class="nav nav-tabs nav-tabs-full nav-tabs-3 nav-tabs-primary" role="tablist">
                  <li class="nav-item" role="presentation">
                    <a href="#ms-login-tab" aria-controls="ms-login-tab" role="tab" data-toggle="tab" class="nav-link active withoutripple">
                      <i class="zmdi zmdi-account"></i>Iniciar Sesión</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a href="#ms-register-tab" aria-controls="ms-register-tab" role="tab" data-toggle="tab" class="nav-link withoutripple">
                      <i class="zmdi zmdi-account-add"></i>Registrarse</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="modal-body">
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade active show" id="ms-login-tab">
                  <form autocomplete="off">
                    <fieldset>
                      <div class="form-group label-floating">
                        <div class="input-group">
                          <span class="input-group-addon">
                            <i class="zmdi zmdi-account"></i>
                          </span>
                          <label class="control-label" for="ms-form-user">Correo electrónico</label>
                          <input type="text" id="ms-form-user" class="form-control"> </div>
                      </div>
                      <div class="form-group label-floating">
                        <div class="input-group">
                          <span class="input-group-addon">
                            <i class="zmdi zmdi-lock"></i>
                          </span>
                          <label class="control-label" for="ms-form-pass">Contraseña</label>
                          <input type="password" id="ms-form-pass" class="form-control"> </div>
                      </div>
                      <div class="row mt-2">
                        <div class="col-md-6">
                          <div class="form-group no-mt">
                            <div class="checkbox">
                              <label>
                                <input type="checkbox">Recuerdame</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <button class="btn btn-raised btn-primary pull-right">Continuar</button>
                        </div>
                      </div>
                    </fieldset>
                  </form>

                </div>
                <div role="tabpanel" class="tab-pane fade" id="ms-register-tab">
                  <form>
                    <fieldset>
                      <div class="form-group label-floating">
                      </div> 

                      <button class="btn btn-raised btn-block btn-primary">Registrarse</button>
                    </fieldset>
                  </form>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="ms-recovery-tab">
                  <fieldset>
                    <div class="form-group label-floating">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="zmdi zmdi-account"></i>
                        </span>
                        <label class="control-label" for="ms-form-user-re">Username</label>
                        <input type="text" id="ms-form-user-re" class="form-control"> </div>
                    </div>
                    <div class="form-group label-floating">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="zmdi zmdi-email"></i>
                        </span>
                        <label class="control-label" for="ms-form-email-re">Correo electrónico</label>
                        <input type="email" id="ms-form-email-re" class="form-control"> </div>
                    </div>
                    <button class="btn btn-raised btn-block btn-primary">Enviar contraseña</button>
                  </fieldset>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <header class="ms-header ms-header-white">

        <div class="container container-full">
          <div class="ms-title">
            <a href="/">
              <!-- <img src="assets/img/demo/logo-header.png" alt=""> -->
              <img src="/assets/img/logo/people.png" alt="">
              <h1 class="animated fadeInRight animation-delay-6">Conocimiento
                <span><strong>&nbsp;&nbsp;&nbsp;<strong>Colectivo</strong></span>
              </h1>
            </a>
          </div>
          <div class="header-right">
            <a href="javascript:void(0)" class="btn-circle btn-circle-primary no-focus animated zoomInDown animation-delay-8" data-toggle="modal" data-target="#ms-account-modal">
              <i class="zmdi zmdi-account"></i>
            </a>
          </div>
        </div>
      </header>
      <nav class="navbar navbar-expand-md  navbar-static ms-navbar ms-navbar-white">
        <div class="container container-full">
          <div class="navbar-header">
            <a class="navbar-brand" href="/">
        <img src="/assets/img/logo/people.png" alt="">
        <span class="ms-title">Conocimiento 
          <strong>&nbsp;&nbsp;&nbsp;Colectivo</strong>
        </span>
      </a>
          </div>
          <div class="collapse navbar-collapse" id="ms-navbar">
            <ul class="navbar-nav">
              <?php $this->load->view('template/menu')?>
            </ul>
          </div>
        </div>
      </nav>