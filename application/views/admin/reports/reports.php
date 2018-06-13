<div class="container">

<form method="get" action="<?php echo site_url('admin/show_reports')?>">
    <label>Seleccionar Mes</label>
    <select name="mes">
        <option value="1">Enero</option>
        <option value="2">Febrero</option>
        <option value="3">Marzo</option>
        <option value="4">Abril</option>
        <option value="5">Mayo</option>
        <option value="6">Junio</option>
        <option value="7">Julio</option>
        <option value="8">Agosto</option>
        <option value="9">Setiembre</option>
        <option value="10">Octubre</option>
        <option value="11">Noviembre</option>
        <option value="12">Diciembre</option>
    </select>
    <button>Seleccionar</button>
</form>

<h3>Inscripciones a Talleres por Mes</h3>
<table class="table">
  <thead>
    <tr>
      <th>Estado</th>
      <th>Nombres</th>
      <th>Taller</th>
      <th>Categoría</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($inscriptions_month as $rows){?>
    <tr>
      <td><?php echo $rows['iu_status']?></td>
      <td><?php echo $rows['u_name']?> <?php echo $rows['u_last_name']?></td>
      <td><?php echo $rows['w_title']?></td>
      <td><?php echo $rows['c_name']?> - <?php echo $rows['sc_name']?></td>
    </tr>
    <?php }?> 
  </tbody>
</table>

<h3>Solicitudes de Talleres por Mes</h3>
<table class="table">
  <thead>
    <tr>
      <th>Taller</th>
      <th>Categoría</th>
      <th>Creado por</th>
      <th>Cantidad de Votos</th>
      <th>Estado del Taller</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($pw_month as $rows){?>
    <tr>
      <td><?php echo $rows['title']?></td>
      <td><?php echo $rows['c_name']?> - <?php echo $rows['sc_name']?></td>
      <td><?php echo $rows['u_name']?> <?php echo $rows['u_last_name']?></td>
      <td><?php echo $rows['votes_quantity']?></td>
      <td><?php echo $rows['pw_status']?></td>
    </tr>
    <?php }?> 
  </tbody>
</table>


</div>