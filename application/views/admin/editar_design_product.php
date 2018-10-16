<?php 
	$pro_id 				= $product->pro_id;
	if( $this->input->post('is_submitted') ) {
		$pro_title			= set_value('pro_title');
		$pro_description	= set_value('pro_description');
		$pro_price			= set_value('pro_price');
		$pro_stock			= set_value('pro_stock');
		$stuts				= set_value('stuts');
	} else {
		$pro_title			= $product->pro_title;
		$pro_description	= $product->mensaje;
		$pro_price			= '';
		$pro_stock			= '';
		$stuts				= 'hidden';
	}
?>
		<?php $this->load->view('admin/header')?>
		<?php if ( $product ): ?>
			<div class="form-signin">
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
						<img src="<?= $product->pro_image ?>" class="img-responsive img-fluid">
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
						<?php if ( !$product->product_id ): ?>
							<button type="submit" class="btn btn-primary">Generar producto</button>
						<?php endif ?>
						<a href="<?= base_url( 'admin/disena_producto' ) ?>" class="btn btn-danger">Cancelar</a>
					</div>
				<?= form_close() ?>
			</div>
		<?php endif ?>
		<?php $this->load->view('admin/footer')?>