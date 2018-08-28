		<?php $this->load->view('header')?>
		<div class="form-signin">
			<h1 class="h3 mb-3 font-weight-normal">Iniciar sesión</h1>
			<?php if( isset($errors) ): ?>
				<div class="alert alert-danger text-left">
					<?php print_r($errors); ?>
				</div>
			<?php endif ?>
			<?= form_open('login') ?>
				<div class="form-group">
					<label for="username">Correo</label> 
					<input id="username" name="username" type="email" class="form-control">
				</div>
				<div class="form-group">
					<label for="password">Contraseña</label> 
					<input id="password" name="password" type="password" class="form-control">
				</div> 
				<div class="form-group">
					<button name="submit" type="submit" class="btn btn-primary">Ingresar</button>
					<?=	anchor(base_url(),'Cancelar',['class'=>'btn']) ?>
					<?=  anchor('Register','Registrarse',['class'=>'btn  btn-default']) ?>
				</div>
			<?= form_close() ?>
		</div>
		<?php $this->load->view('footer')?>