<div class="container">

  <form id="workshop_form">
    <h2 class="color-primary">Buscar</h2>
    <div class="form-group">
      <input type="text" name="q" class="form-control" value="<?php echo $q?>"> </div>
      <input type="hidden" name="page" id="workshop_form_page" value="<?php echo $pagination?>"> 
      <button type="submit" class="btn btn-primary btn-raised btn-block">
        <i class="zmdi zmdi-search"></i>Buscar</button>
  </form>

    <table class="table">
  <thead>
    <tr>
      <th>Código</th>
      <th>Nombre</th>
      <th>Estado</th>
      <th>Opciones</th>
      <th>Agregar Subcategorías</th>
      <th>Ver Subcategorías</th>
    </tr>
  </thead>
  <tbody>

    <?php foreach($lista_c as $rows){?>
    <tr>

      <th><?php echo $rows['id']?></th>
      <td><?php echo $rows['name']?></td>
      <td><?php echo $rows['removed']?></td>
      <td><a href="<?php echo site_url('admin/show_edit_category/' .$rows['id'])?>" class="btn btn-primary">Editar</a></td>

      <td><a href="<?php echo site_url('admin/show_create_subcategory/' .$rows['id'])?>" class="btn btn-primary">Agregar Subcategoría</a></td>

      <td><a href="<?php echo site_url('admin/subcategories_list/' .$rows['id'])?>" class="btn btn-primary">Ver más</a></td>
    </tr>
    <?php }?>

    <tr>
      <th>Acción</th>
      <th>Campo</th>
    </tr>


     <form method="post" action="<?php echo site_url('admin/save_category/')?>" class="form-horizontal">
      <fieldset>
    <td>
      <button class="btn btn-raised btn-primary">Agregar</button>
    </td>

    <td>
      <input type="text" placeholder="Nombre" name="subcategory_name" required> 
    </td>
    </fieldset>
  </form>
  </tbody>
</table>

  <nav id="workshop_navigate_list" aria-label="Page navigation">
    <ul class="pagination pagination-plain">
      <?php for($page_i = 1;$page_i<=$num_pages && $num_pages>1;$page_i++){?>
      <li class="page-item <?php echo ($page_i==$pagination)? 'active':'';?>">
        <a class="page-link" href="<?php echo $page_i;?>"><?php echo $page_i;?></a>
      </li>
      <?php }?>
    </ul>
  </nav>
  
</div>