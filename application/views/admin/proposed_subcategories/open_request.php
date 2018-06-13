<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="card card-primary">
                <div class="card-body">
                    <h1 class="color-primary text-center">Editar Solicitud de Nuevo Tema</h1>
                    <form method="post" action="<?php echo site_url('admin/proposed_subcategories_save_edit/' .$psc_data['psc_id'])?>" class="form-horizontal">
                        <fieldset>

                            <div class="row form-group">
                                <label for="" class="col-md-2 control-label">Categoría</label>
                                <div class="col-md-9">
                                    <?php echo $psc_data['category_name']?>
                                    <select name="categoria" class="form-control selectpicker">
                                        <?php foreach($prueba as $rowp){?>
                                        <option value="<?php echo $rowp['id']?>">
                                            <?php echo $rowp['name']?>
                                        </option>
                                        <?php }?>
                                    </select>

                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="" class="col-md-2 control-label">Nombre</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="Título" name="nombre_subcategoria" onkeypress="return only_letters(event)" value="<?php echo $psc_data['psc_name']?>" required> </div>
                            </div>

                            <div class="form-group row justify-content-end">
                                <label for="" class="col-lg-2 control-label">Descripción</label>

                                <div class="col-lg-10">
                                    <textarea class="form-control" rows="2" name="descripcion"><?php echo $psc_data['psc_description']?></textarea>
                                    <span class="help-block">Escriba una breve descripción </span>
                                </div>
                            </div>


                            <div class="row mt-2">
                                <div class="col">
                                    <button class="btn btn-raised btn-primary btn-block">Aperturar Solicitud</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>