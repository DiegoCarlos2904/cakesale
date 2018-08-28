		<?php $this->load->view('header')?>
		<div class="form-signin">
			<h1 class="h3 mb-3 font-weight-normal">Registrarse</h1>
			<?php if( isset($errors) ): ?>
				<div class="alert alert-danger text-left">
					<?php print_r($errors); ?>
				</div>
			<?php endif ?>
			<?= form_open('register') ?>
				<div class="form-group">
					<label for="username">Correo</label>
					<input type="text" class="form-control" name="rusername" value="<?= set_value('rusername') ?>">
				</div>
				<div class="form-group">
					<label for="password">Contraseña</label>
					<input type="password" class="form-control" name="rpassword" value="<?= set_value('rpassword') ?>" >
				</div>
				<div class="form-group">
					<label for="password">Repetir contraseña</label>
					<input type="password" class="form-control" name="repassword" value="<?= set_value('repassword') ?>" >
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Registrar</button>
					<?=  anchor(base_url(),'Cancelar',['class'=>'btn']) ?>
					<?=  anchor('Login','Iniciar sesión',['class'=>'btn  btn-default']) ?>
				</div>
			<?= form_close() ?>
		</div>
		<?php $this->load->view('footer')?>