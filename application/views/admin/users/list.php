<div class="container">

  <h1 align="center">
    <strong style="color:olive">Lista de Usuarios</strong>
  </h1>

      <p align="center">
        <a class="btn btn-primary btn-raised text-right" href="<?php echo site_url('admin/show_create_user')?>"><i class="fa fa-plus"></i> Crear Usuario</a>
      </p>  

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
          <th style="background: #c0ca33">Nombres</th>
          <th style="background: #c0ca33">Correo Electrónico</th>
          <th style="background: #c0ca33">Celular</th>
          <th style="background: #c0ca33">Estado</th>
          <th style="background: #c0ca33">Opciones</th>
        </tr>
      </thead>

      <tbody>
        <?php $count = 0;?>
          <?php foreach($lista_u as $rows){?>
            <tr>
                <td><?php echo ++$count ?></td>
                <td><?php echo $rows['name']?> <?php echo $rows['last_name']?></td>
                <td><?php echo $rows['email']?></td>
                <td><?php echo $rows['cell_phone']?></td>
                <td><?php echo $rows['removed']?></td>
                <td><a href="<?php echo site_url('admin/show_profile/' .$rows['id'])?>" class="btn btn-primary">Ver más</a></td>
            </tr>
          <?php }?> 
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