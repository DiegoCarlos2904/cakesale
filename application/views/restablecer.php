		<?php $this->load->view('header')?>
		<div class="form-signin" >
			<h1 class="h3 mb-3 font-weight-normal">Restablecer contraseña</h1>
			<?php if( isset($errors) ): ?>
				<div class="alert alert-danger text-left">
					<?php print_r($errors); ?>
				</div>
			<?php endif ?>
			<?php $username = set_value( 'username' ); ?>
			<?= form_open('', ['data-toggle'=>"validator"]) ?>
				<div class="form-group">
					<label for="username">Correo</label> 
					<input value="<?= $username ?>" id="username" data-pattern-error="Correo mal ingresado" data-required-error="Ingrese el Correo" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="username" required="" type="text" class="form-control">
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Restablecer</button>
					<a class="btn" href="<?= base_url() ?>">Cancelar</a>
				</div>
			<?= form_close() ?>
		</div>
		<?php $this->load->view('footer')?>