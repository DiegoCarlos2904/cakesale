		<?php $this->load->view('header')?>
		<div class="form-signin">
			<h1 class="h3 mb-3 font-weight-normal">Registrarse</h1>
			<?php if( isset($errors) ): ?>
				<div class="alert alert-danger text-left">
					<?php print_r($errors); ?>
				</div>
			<?php endif ?>
			<?= form_open('', ['data-toggle'=>"validator"]) ?>
				<div class="form-group">
					<label for="username">Correo</label>
					<input type="email" data-pattern-error="" data-required-error="Ingrese correo" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control" required="" name="rusername" value="<?= set_value('rusername') ?>">
					<div class="help-block with-errors"></div>

			</div>
				<div class="form-group">
					<label for="password">Contraseña</label>
					<input type="password" data-minlength="7" data-minlength-error=" " class="form-control" data-required-error="Ingrese una contraseña" required="" id="rpassword" name="rpassword" value="<?= set_value('rpassword') ?>" >
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group">
					<label for="password">Repetir contraseña</label>
					<input type="password" data-match="#rpassword" data-match-error="No coinciden" data-minlength="7" data-minlength-error=" Deben tener minimo 7 digitos" class="form-control" data-required-error="Ingrese este campo" required="" name="repassword" value="<?= set_value('repassword') ?>" >
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Registrar</button>
					<a class="btn" href="<?= base_url() ?>">Cancelar</a>
					<a class="btn btn-default" href="<?= base_url('login') ?>">Iniciar sesión</a>
				</div>
				<div class="form-group">
					<a class="btn btn-default" href="<?= base_url('cuenta/restablecer') ?>">¿Olvidaste tu contraseña?</a>
				</div>
			<?= form_close() ?>
		</div>
		<?php $this->load->view('footer')?>