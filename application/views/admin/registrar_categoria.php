<?php 
	if( $this->input->post('is_submitted') ) {
		$name			= set_value('name');
	} else {
		$name			= '';
	}
?>
		<?php $this->load->view('admin/header')?>
		<div class="form-signin">
			<h3 class="h3 mb-3  font-weight-normal">Editar Categoría </h3>
			<?php if( isset($errors) ): ?>
				<div class="alert alert-danger text-left">
					<?php print_r($errors); ?>
				</div>
			<?php endif ?>
			<?=	form_open_multipart('',['data-toggle'=>"validator", 'class'=>'']) ?>
				<div class="form-group">
					<label for="name">Nombre</label> 
					<input value="<?= $name ?>" data-required-error="CAMBIAR TEXTO" id="name" name="name" type="text" class="form-control" required="required">
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group">
					<input type="hidden" name="is_submitted" value="1">
					<button type="submit" class="btn btn-primary">Editar</button>
					<a href="<?= base_url( 'admin/categorias' ) ?>" class="btn btn-danger">Cancelar</a>
				</div>
			<?= form_close() ?>
		</div>
		<?php $this->load->view('admin/footer')?>