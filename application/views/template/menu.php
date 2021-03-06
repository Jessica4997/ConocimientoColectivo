<li class="nav-item">
    <a href="<?php echo site_url('')?>" class="nav-link animated fadeIn animation-delay-9" role="button" aria-haspopup="true" aria-expanded="false" data-name="inicio">Inicio</a>
</li>

<?php if($this->session->userdata('s_urole') != 'Admin'){ ?>
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
            <a class="dropdown-item" href="<?php echo site_url('my_created_workshops')?>">Mis Talleres Creados</a>
        </li>
        <li>
            <a class="dropdown-item" href="<?php echo site_url('my_workshops')?>">Mis Postulaciones a Talleres</a>
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
            <a class="dropdown-item" href="<?php echo site_url('proposed_workshop/show_my_requests')?>">Mis Solicitudes</a>
        </li>
    </ul>
</li>


<li class="nav-item dropdown">
    <a href="#" class="nav-link dropdown-toggle animated fadeIn animation-delay-9" data-toggle="dropdown" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false" data-name="ecommerce">
        Solicitudes de Temas
        <i class="zmdi zmdi-chevron-down"></i>
    </a>
    <ul class="dropdown-menu">
        <li>
            <a class="dropdown-item" href="<?php echo site_url('proposed_subcategories')?>">Lista de Solicitudes de Temas</a>
        </li>
        <li>
            <a class="dropdown-item" href="<?php echo site_url('proposed_subcategories/show_my_requests')?>">Mis Solicitudes de Temas</a>
        </li>
    </ul>
</li>

<?php }?>

<?php if($this->session->userdata('s_urole') == 'Admin'){ ?>

<li class="nav-item">
    <a href="<?php echo site_url('admin')?>" class="nav-link animated fadeIn animation-delay-9" role="button" aria-haspopup="true" aria-expanded="false" data-name="inicio">Usuarios</a>
</li>

<li class="nav-item">
    <a href="<?php echo site_url('admin/categories_list')?>" class="nav-link animated fadeIn animation-delay-9" role="button" aria-haspopup="true" aria-expanded="false" data-name="inicio">Categorías</a>
</li>

<li class="nav-item">
    <a href="<?php echo site_url('admin/workshop_list')?>" class="nav-link animated fadeIn animation-delay-9" role="button" aria-haspopup="true" aria-expanded="false" data-name="inicio">Talleres</a>
</li>

<li class="nav-item">
    <a href="<?php echo site_url('admin/proposed_workshop_list')?>" class="nav-link animated fadeIn animation-delay-9" role="button" aria-haspopup="true" aria-expanded="false" data-name="inicio">Solicitudes de Talleres</a>
</li>

<li class="nav-item">
    <a href="<?php echo site_url('admin/proposed_subcategories_list')?>" class="nav-link animated fadeIn animation-delay-9" role="button" aria-haspopup="true" aria-expanded="false" data-name="inicio">Solicitudes de Temas</a>
</li>

<li class="nav-item">
    <a href="<?php echo site_url('admin/show_reports')?>" class="nav-link animated fadeIn animation-delay-9" role="button" aria-haspopup="true" aria-expanded="false" data-name="inicio">Reportes</a>
</li>

<?php }?>