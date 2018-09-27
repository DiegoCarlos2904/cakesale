		<?php $this->load->view('header')?>
		<div class="form-signin" >
			<h1 class="h3 mb-3 font-weight-normal">Iniciar sesión</h1>
			<?php if( isset($errors) ): ?>
				<div class="alert alert-danger text-left">
					<?php print_r($errors); ?>
				</div>
			<?php endif ?>
			<?= form_open('', ['data-toggle'=>"validator"]) ?>
				<div class="form-group">
					<label for="username">Correo</label> 
					<input id="username" data-pattern-error="Correo mal ingresado" data-required-error="Ingrese el Correo" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="username" required="" type="text" class="form-control">
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group">
					<label for="password">Contraseña</label> 
					<input id="password" data-minlength="4" data-minlength-error="" data-required-error="Introduce tu Contraseña" name="password" required="" type="password" class="form-control">
					<div class="help-block with-errors"></div>
				</div> 
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Ingresar</button>
					<a class="btn" href="<?= base_url() ?>">Cancelar</a>
					<a class="btn btn-default" href="<?= base_url('cuenta/register') ?>">Registrarse</a>
				</div>
			<?= form_close() ?>
		</div>
		<?php $this->load->view('footer')?>