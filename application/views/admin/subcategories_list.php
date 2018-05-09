<div class="container">
    <table class="table">
  <thead>
    <tr>
      <th>Código</th>
      <th>Nombre</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($lista_sc as $rows){?>
    <tr>

      <th><?php echo $rows['id']?></th>
      <td><?php echo $rows['sub_name']?></td>
    </tr>
    <?php }?> 
  </tbody>
</table>
</div>