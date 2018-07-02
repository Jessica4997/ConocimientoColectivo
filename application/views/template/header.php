<header class="ms-header ms-header-white">

    <div class="container container-full">
        <div class="ms-title">
            <a href="/">

                <img src="/assets/img/logo/people.png" alt="">
                <h1 class="animated fadeInRight animation-delay-6">Conocimiento
                    <span>
                        <strong>&nbsp;&nbsp;&nbsp;
                            <strong>Colectivo</strong>
                    </span>
                </h1>
            </a>
        </div>
        <div class="header-right">
            <?php if($this->session->userdata('s_iduser') == false){?>
            <a href="<?php echo site_url('login')?>" class="btn-circle btn-circle-primary no-focus animated zoomInDown animation-delay-8">
                <i class="zmdi zmdi-account"></i>
            </a>
            <?php }?>
            <?php if($this->session->userdata('s_iduser')){?>
            <div class="btn-group">
                <button type="button" class="btn btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white">Mi Cuenta
                    <i class="zmdi zmdi-chevron-down right"></i>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="<?php echo site_url('profile_page')?>">Mi Perfil</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="<?php echo site_url('login/user_logout')?>">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
            <?php }?>

        </div>
    </div>
</header>

<nav class="navbar navbar-expand-md navbar-static ms-navbar ms-navbar-white">
    <div class="container container-full">
        <div class="navbar-header">

          <a href="javascript:void(0)" class="ms-toggle-left btn-navbar-menu">
            <i class="zmdi zmdi-menu"></i>
          </a>


            <a class="navbar-brand" href="">
                <img src="/assets/img/logo/people.png">
                <span class="ms-title">Conocimiento
                    <strong>Colectivo</strong>
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



    <div class="ms-slidebar sb-slidebar sb-left sb-style-overlay" id="ms-slidebar">
      <div class="sb-slidebar-container">
        <header class="ms-slidebar-header">
          <div class="ms-slidebar-login">

            <?php if($this->session->userdata('s_iduser') == false){?>
                <a href="<?php echo site_url('login')?>" class="withripple">
                  <i class="zmdi zmdi-account"></i>Iniciar Sesión</a>
                <a href="<?php echo site_url('register_page')?>" class="withripple">
                  <i class="zmdi zmdi-account-add"></i>Registrarse</a>
            <?php }?>

            <?php if($this->session->userdata('s_iduser')){?>
                <a href="<?php echo site_url('profile_page')?>" class="withripple">
                  <i class="zmdi zmdi-account"></i>Mi Perfil</a>
                <a href="<?php echo site_url('login/user_logout')?>" class="withripple">
                  <i class="zmdi zmdi-account"></i>Cerrar Sesión</a>
            <?php }?>


          </div>
          <div class="ms-slidebar-title">
            <form class="search-form">
              <input id="search-box-slidebar" type="text" class="search-input" placeholder="Search..." name="q" />
              <label for="search-box-slidebar">
                <i class="zmdi zmdi-search"></i>
              </label>
            </form>
            <div class="ms-slidebar-t">
              <span class="ms-logo ms-logo-sm">CC</span>
              <h3>Conoc.
                <span>Colectivo</span>
              </h3>
            </div>
          </div>
        </header>
        <ul class="ms-slidebar-menu" id="slidebar-menu" role="tablist" aria-multiselectable="true">

          <li>
            <a class="link" href="<?php echo site_url('')?>">Inicio</a>
          </li>

        <?php if($this->session->userdata('s_urole') != 'Admin'){ ?>


          <li class="card" role="tab" id="sch1">
            <a class="collapsed" role="button" data-toggle="collapse" href="#sc1" aria-expanded="false" aria-controls="sc1">Talleres</a>
            <ul id="sc1" class="card-collapse collapse" role="tabpanel" aria-labelledby="sch1" data-parent="#slidebar-menu">
              <li>
                <a href="<?php echo site_url('workshop')?>">Lista de Talleres</a>
              </li>
              <li>
                <a href="<?php echo site_url('my_created_workshops')?>">Mis Talleres Creados</a>
              </li>
              <li>
                <a href="<?php echo site_url('my_workshops')?>">Mis Postulaciones a Talleres</a>
              </li>
            </ul>
          </li>

          <li class="card" role="tab" id="sch2">
            <a class="collapsed" role="button" data-toggle="collapse" href="#sc2" aria-expanded="false" aria-controls="sc2">Solicitudes de Talleres</a>
            <ul id="sc2" class="card-collapse collapse" role="tabpanel" aria-labelledby="sch2" data-parent="#slidebar-menu">
              <li>
                <a href="<?php echo site_url('proposed_workshop')?>">Lista de Solicitudes</a>
              </li>
              <li>
                <a href="<?php echo site_url('proposed_workshop/show_my_requests')?>">Mis Solicitudes</a>
              </li>
            </ul>
          </li>

          <li class="card" role="tab" id="sch4">
            <a class="collapsed" role="button" data-toggle="collapse" href="#sc4" aria-expanded="false" aria-controls="sc4">Solicitudes de Nuevos Temas</a>
            <ul id="sc4" class="card-collapse collapse" role="tabpanel" aria-labelledby="sch4" data-parent="#slidebar-menu">
              <li>
                <a href="<?php echo site_url('proposed_subcategories')?>">Lista de Solicitudes de Nuevos Temas</a>
              </li>
              <li>
                <a href="<?php echo site_url('proposed_subcategories/show_my_requests')?>">Mis Solicitudes de Nuevos Temas</a>
              </li>
            </ul>
          </li>
        <?php }?>


        <?php if($this->session->userdata('s_urole') == 'Admin'){ ?>

              <li>
                <a class="link" href="<?php echo site_url('admin')?>">Usuarios</a>
              </li>

              <li>
                <a class="link" href="<?php echo site_url('admin/categories_list')?>">Categorías</a>
              </li>

              <li>
                <a class="link" href="<?php echo site_url('admin/workshop_list')?>">Talleres</a>
              </li>          

              <li>
                <a class="link" href="<?php echo site_url('admin/proposed_workshop_list')?>">Solicitudes de Talleres</a>
              </li>

              <li>
                <a class="link" href="<?php echo site_url('admin/proposed_subcategories_list')?>">Solicitudes de Nuevos Temas</a>
              </li>

              <li>
                <a class="link" href="<?php echo site_url('admin/show_reports')?>">Reportes</a>
              </li>

        <?php }?>

        </ul>
      </div>
    </div>
