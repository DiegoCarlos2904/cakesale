<?php 
	$pro_id 				= $product->pro_id;
	if( $this->input->post('is_submitted') ) {
		$pro_title			= set_value('pro_title');
		$pro_description	= set_value('pro_description');
		$pro_price			= set_value('pro_price');
		$pro_stock			= set_value('pro_stock');
		$cat_id				= set_value('cat_id');
		$stuts				= set_value('stuts');
	} else {
		$pro_title			= $product->pro_title;
		$pro_description	= $product->pro_description;
		$pro_price			= $product->pro_price;
		$pro_stock			= $product->pro_stock;
		$cat_id				= $product->cat_id;
		$stuts				= $product->stuts;
	}
?>
		<?php $this->load->view('admin/header')?>
		<div class="form-signin">
			<h3 class="h3 mb-3  font-weight-normal">Editar producto </h3>
			<?php if( isset($errors) ): ?>
				<div class="alert alert-danger text-left">
					<?php print_r($errors); ?>
				</div>
			<?php endif ?>
			<?=	form_open_multipart('',['data-toggle'=>"validator", 'class'=>'']) ?>
				<div class="form-group">
					<label for="pro_title">Título</label> 
					<input value="<?= $pro_title ?>" id="pro_title" name="pro_title" type="text" class="form-control" data-required-error="Ingrese un titulo" required="required">
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group">
					<label for="pro_description">Descripción</label> 
					<textarea id="pro_description" name="pro_description" cols="40" rows="5" class="form-control" data-required-error="Ingrese Descripción" required="required"><?= $pro_description ?></textarea>
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group">
					<label for="pro_title">Categoría</label>
					<select class="form-control" data-required-error=" " required="required" name="cat_id" id="cat_id">
						<?php foreach ($categories as $key => $categoria): ?>
							<option <?= $cat_id == $categoria->cat_id ? "selected = 'selected'" : "" ;?> value="<?= $categoria->cat_id ?>"><?= $categoria->name ?></option>
						<?php endforeach ?>
					</select>
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<input type="file" class="form-control-file" name="userfile">
					</div>
				</div>
				<div class="row">
					<div class="col-xl-6">
						<div class="form-group">
							<label for="pro_price">Precio</label> 
							<div class="input-group">
								<div class="input-group-addon">$</div> 
								<input value="<?= $pro_price ?>" id="pro_price" name="pro_price" type="text" class="onlyDecimal form-control" data-required-error="Ingrese Precio" required="required">
							</div> 
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="col-xl-6">
						<div class="form-group">
							<label for="pro_stock">Stock</label>
							<input value="<?= $pro_stock ?>" id="pro_stock" name="pro_stock" type="number" data-required-error="Ingrese Stock" required="required" class="form-control">
							<div class="help-block with-errors"></div>
						</div> 
					</div>
				</div>
				<div class="form-group">
					<label for="stuts">Estado</label>
					<select class="form-control" data-required-error="CAMBIAR TEXTO" required="required" name="stuts" id="stuts">
						<option <?= $stuts == 'publish' ? "selected = 'selected'" : "" ;?> value="publish">Visible</option>
						<option <?= $stuts == 'hidden' ? "selected = 'selected'" : "" ;?> value="hidden">Invisible</option>
					</select>
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group">
					<input type="hidden" name="is_submitted" value="1">
					<button type="submit" class="btn btn-primary">Editar</button>
					<a href="<?= base_url( 'admin/productos' ) ?>" class="btn btn-danger">Cancelar</a>
				</div>
			<?= form_close() ?>
		</div>
		<?php $this->load->view('admin/footer')?>