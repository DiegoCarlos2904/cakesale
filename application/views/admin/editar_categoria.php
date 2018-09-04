<?php 
	$cat_id 				= $category->cat_id;
	if( $this->input->post('is_submitted') ) {
		$name			= set_value('name');
	} else {
		$name			= $category->name;
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
			<?=	form_open('admin/categorias/editar/'.$cat_id,['class'=>'']) ?>
				<div class="form-group">
					<label for="name">Nombre</label> 
					<input value="<?= $name ?>" id="name" name="name" type="text" class="form-control" required="required">
				</div>
				<div class="form-group">
					<input type="hidden" name="is_submitted" value="1">
					<button type="submit" class="btn btn-primary">Editar</button>
					<a href="<?= base_url( 'admin/categorias' ) ?>" class="btn btn-danger">Cancelar</a>
				</div>
			<?= form_close() ?>
		</div>
		<?php $this->load->view('admin/footer')?>