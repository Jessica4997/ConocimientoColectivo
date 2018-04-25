<li class="nav-item dropdown">
  <a href="<?php echo site_url('')?>" class="nav-link animated fadeIn animation-delay-9" role="button" aria-haspopup="true" aria-expanded="false" data-name="inicio">Inicio</a>

</li>
<li class="nav-item dropdown">
  <a href="#" class="nav-link dropdown-toggle animated fadeIn animation-delay-9" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false" data-name="ecommerce">
    Talleres
    <i class="zmdi zmdi-chevron-down"></i>
  </a>
  <ul class="dropdown-menu">
    <li>
      <a class="dropdown-item" href="<?php echo site_url('workshop')?>">Lista de Talleres</a>
    </li>
    <li>
      <a class="dropdown-item" href="<?php echo site_url('my_created_workshops')?>">Mis Talleres</a>
    </li>
    <li>
      <a class="dropdown-item" href="#">Mis Talleres Dictados</a>
    </li>

  </ul>
</li>

<li class="nav-item dropdown">
  <a href="#" class="nav-link dropdown-toggle animated fadeIn animation-delay-9" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false" data-name="ecommerce">
    Solicitud de Talleres
    <i class="zmdi zmdi-chevron-down"></i>
  </a>
  <ul class="dropdown-menu">
    <li>
      <a class="dropdown-item" href="<?php echo site_url('proposed_workshop')?>">Lista de Solicitudes</a>
    </li>
    <li>
      <a class="dropdown-item" href="">Mis Solicitudes</a>
    </li>