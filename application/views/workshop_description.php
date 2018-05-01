<div class="container">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card animated zoomInDown animation-delay-5">
              <div class="card-body">
                <h2 align="center"><?php echo $description['title']?></h2>
                
                  <div class="row" align="center">
                    <li class="list-unstyled"> Creado por: <?php echo $description['user_name']?> <?php echo $description['user_last_name']?>

                    </li>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                      
                        <i class="zmdi zmdi-hc-lg zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-hc-lg zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-hc-lg zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-hc-lg zmdi-star color-warning"></i>
                        <i class="zmdi zmdi-hc-lg zmdi-star"></i>
                   
                      </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" align="center">
                      <h2 class="color-success text-normal">S/. <?php echo $description['amount']?></h2>
                    </div>
                  
                <p class="lead" align="center"><?php echo $description['description']?></p>
                <ul class="list-unstyled">
                  <li>Categoría: <?php echo $description['category_name']?></li>

                  <li> Sub-Categoría: </li>

                  <li> Fecha de Inicio: <?php echo $description['start_date']?></li>
 
                  <li> Nivel: <?php echo $description['level']?></li>

                  <li> Fecha de Cierre: <?php echo $description['final_date']?></li>

                  <li> Vacantes: <?php echo $description['vacancy']?> </li>



                </ul>
                <a href="" class="btn btn-primary btn-block btn-raised">Postular</a>
              </div>
            </div>
          </div>
      </div>