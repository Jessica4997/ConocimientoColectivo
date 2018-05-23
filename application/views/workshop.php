<div class="container">
	<div class="row">
		<div class="col-lg-3">

			<div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title">Filtros</h3>
				</div>
				<div class="card-body">
					<form class="form-horizontal" id="workshop_form">
            <input type="hidden" id="workshop_form_page" name="page" value="<?php echo $pagination;?>">
						<h4 class="mb-1 no-mt">Categorías</h4>

						<fieldset>
							<!--<?php var_dump($rowc) ?>-->
							<?php foreach($lis as $rowc){
								$isselect = (isset($category[$rowc['id']]))? 'checked':'';  ?>
							<div class="form-group no-mt">
								<div class="checkbox">
									<label>
										<input name="category[<?php echo $rowc['id']?>]" value="<?php echo $rowc['id']?>" type="checkbox" <?php echo $isselect;?>>
										<?php echo $rowc['name']?> </label>
								</div>
								<?php }?>
						</fieldset>
						<div class="form-group">
							<input type="text" name="q" class="form-control" value="<?php echo $q?>" placeholder="buscar" > </div>
						<button type="submit" class="btn btn-primary btn-raised btn-block">
							<i class="zmdi zmdi-search"></i>Buscar</button>
					</form>
					</div>
				</div>
			</div>

			<div class="col-lg-9">
				<h1 align="center">
					<strong>Talleres</strong>
				</h1>

				<p class="text-center">
					<a href="<?php echo site_url('workshop/create')?>" class="btn btn-primary btn-raised text-right" role="button">
						<i class="fa fa-plus"></i>Crear Taller</a>
				</p>

				<div class="row" id="Container">

					<?php foreach($lists as $row){?>
					<div class="col-xl-6 col-lg-6 col-md-6 mix " data-price="<?php echo $row['amount']?>">
						<div class="card ms-feature">
							<div class="card-body text-center">
								<h4 class="text-normal text-center">
									<?php echo $row['title']?>
								</h4>
								<p>
									<li>Categoría:
										<?php echo $row['name']?>
									</li>
									<li>Sub-categoría:
										<?php echo $row['sub_name']?>
									</li>
									<li>Nivel:
										<?php echo $row['level']?>
									</li>
									<li>Fecha de inicio:
										<?php echo $row['start_date']?>
									</li>
									<li>Fecha de fin:
										<?php echo $row['final_date']?>
									</li>
									<li>Descripción:
										<?php echo $row['description']?>
									</li>
								</p>

								<span class="mr-2">
									<i class="zmdi zmdi-star color-warning"></i>
									<i class="zmdi zmdi-star color-warning"></i>
									<i class="zmdi zmdi-star color-warning"></i>
									<i class="zmdi zmdi-star color-warning"></i>
									<i class="zmdi zmdi-star"></i>
								</span>
								<span class="ms-tag ms-tag-success">S/.
									<?php echo $row['amount']?>
								</span>

								<a href="<?php echo site_url ('workshop/description/'.$row['w_id'])?>" class="btn btn-primary btn-sm btn-block btn-raised mt-2 no-mb">
									<i class="fa fa-search"></i>Ver Detalles</a>
							</div>
						</div>
					</div>
					<?php }?>

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
		</div>
	</div>
</div>
