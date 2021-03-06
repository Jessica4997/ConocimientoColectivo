<div class="container">

  <h1 align="center">
    <strong style="color:olive">Lista de Categorías</strong>
  </h1>

  <form id="workshop_form">
    <h2 class="color-primary">Buscar</h2>
    <div class="form-group">
      <input type="text" name="q" placeholder="Buscar ...." class="form-control" value="<?php echo $q?>"> </div>
      <input type="hidden" name="page" id="workshop_form_page" value="<?php echo $pagination?>"> 
      <button type="submit" class="btn btn-primary btn-raised btn-block">
        <i class="zmdi zmdi-search"></i>Buscar</button>
  </form>



<div class="card mt-4">
  <div style="overflow-x:auto;">
    <table class="table table-no-border table-striped">
      <thead>
        <tr class="color-white">
          <th style="background: #c0ca33">#</th>
          <th style="background: #c0ca33">Código</th>
          <th style="background: #c0ca33">Nombre</th>
          <th style="background: #c0ca33">Estado</th>
          <th style="background: #c0ca33">Agregar Subcategorías</th>
          <th style="background: #c0ca33">Ver Subcategorías</th>
        </tr>
      </thead>

      <tbody>

          <?php foreach($lista_c as $rows){?>
            <tr>
                <td><?php echo $rows['id']?></td>
                <td><?php echo $rows['name']?></td>
                <td><?php echo $rows['removed']?></td>
                <td><a href="<?php echo site_url('admin/show_edit_category/' .$rows['id'])?>" class="btn btn-primary">Editar</a></td>
                <td><a href="<?php echo site_url('admin/show_create_subcategory/' .$rows['id'])?>" class="btn btn-primary">Agregar Subcategoría</a></td>

                <td><a href="<?php echo site_url('admin/subcategories_list/' .$rows['id'])?>" class="btn btn-primary">Ver más</a></td>

            </tr>
          <?php }?> 
      </tbody>
    </table>
  </div>
</div>


<div class="card mt-4">
  <div style="overflow-x:auto;">
    <table class="table table-no-border table-striped">
      <thead>
        <tr class="color-white">
          <th style="background: #c0ca33">Nombre de Categoría</th>
          <th style="background: #c0ca33">Crear</th>
        </tr>
      </thead>

      <tbody>


            <tr>
            <form method="post" action="<?php echo site_url('admin/save_category/')?>" class="form-horizontal">
                  <fieldset>              
                      <td>
                        <input type="text" placeholder="Nombre" name="category_name" onkeypress="return only_letters(event)" required> 
                      </td>
                      <td>
                        <button class="btn btn-raised btn-primary">Agregar</button>
                      </td>
                </fieldset>
            </form>

            </tr>

      </tbody>
    </table>
  </div>
</div>



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