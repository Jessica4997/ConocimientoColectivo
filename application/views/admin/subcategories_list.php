<div class="container">

             <div class="card color-primary ">
              <div class="card-body-big color-dark">
                <h2 class="color-primary">Buscar</h2>
                <div class="form-group label-floating">
                  <label class="control-label" for="addon2">Search in page...</label>
                  <input type="text" id="addon2" class="form-control"> </div>
                <a href="" class="btn btn-primary btn-raised btn-block">
                  <i class="zmdi zmdi-search"></i> Search</a>
              </div>
            </div>
    <table class="table">
  <thead>
    <tr>
      <th>Código</th>
      <th>Nombre</th>
      <th>Estado</th>
      <th>Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($lista_sc as $rows){?>
    <tr>

      <th><?php echo $rows['id']?></th>
      <td><?php echo $rows['sub_name']?></td>
      <td><?php echo $rows['removed']?></td>
      <td><a href="<?php echo site_url('admin/show_edit_subcategory/' .$rows['id'])?>" class="btn btn-primary">Editar</a></td>
    </tr>
    <?php }?>

    <tr>
      <th>Acción</th>
      <th>Campo</th>
    </tr>
     <form method="post" action="<?php echo site_url('admin/save_subcategory/' .$rows['categories_id'])?>" class="form-horizontal">
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
</div>