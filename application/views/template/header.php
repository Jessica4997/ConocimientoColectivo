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
            <a href="<?php echo site_url('login')?>" class="btn-circle btn-circle-primary no-focus animated zoomInDown animation-delay-8">
                <i class="zmdi zmdi-account"></i>
            </a>
        </div>
    </div>
</header>

<nav class="navbar navbar-expand-md  navbar-static ms-navbar ms-navbar-white">
    <div class="container container-full">
          <div class="navbar-header">
            <a class="navbar-brand" href="">
              <img src="/assets/img/logo/people.png" alt="">
              <span class="ms-title">Conocimiento<strong>&nbsp;&nbsp;&nbsp;Colectivo</strong></span>
            </a>
          </div>

        <div class="collapse navbar-collapse" id="ms-navbar">
            <ul class="navbar-nav">
                <?php $this->load->view('template/menu')?>
            </ul>
        </div>
    </div>
</nav>