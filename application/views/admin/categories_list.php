<div class="container">
    <table class="table">
  <thead>
    <tr>
      <th>Código</th>
      <th>Nombre</th>
      <th>Ver Subcategorías</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($lista_c as $rows){?>
    <tr>

      <th><?php echo $rows['id']?></th>
      <td><?php echo $rows['name']?></td>
      <td><a href="<?php echo site_url('admin/subcategories_list/' .$rows['id'])?>" class="btn btn-primary">Ver más</a></td>
    </tr>
    <?php }?> 
  </tbody>
</table>
</div>