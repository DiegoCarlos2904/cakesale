<?php 
	$usr_id 				= $user->usr_id;
	if( $this->input->post('is_submitted') ) {
		$usr_name			= set_value('usr_name');
		$telephone	= set_value('telephone');
		$first_name			= set_value('first_name');
		$last_name			= set_value('last_name');
		$usr_password			= set_value('usr_password');
		$direccion			= set_value('direccion');
		$usr_group			= set_value('usr_group');
	} else {
		$usr_name			= $user->usr_name;
		$telephone			= $user->telephone;
		$first_name			= $user->first_name;
		$last_name			= $user->last_name;
		$direccion			= $user->direccion;
		$usr_group			= $user->usr_group;
		$usr_password		= '';
	}
?>
		<?php $this->load->view('admin/header')?>
		<div class="form-signin">
			<h1 class="h3 mb-3 font-weight-normal">Editar usuario</h1>
			<?php if( isset($errors) ): ?>
				<div class="alert alert-danger text-left">
					<?php print_r($errors); ?>
				</div>
			<?php endif ?>
			<?= form_open('', ['data-toggle'=>"validator"] ) ?>
				<div class="form-group">
					<label for="first_name">Nombres</label>
					<input type="text" class="form-control" data-required-error="CAMBIAR TEXTO" required="" name="first_name" value="<?= $first_name ?>">
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group">
					<label for="last_name">Apellidos</label>
					<input type="text" class="form-control" data-required-error="CAMBIAR TEXTO" required="" name="last_name" value="<?= $last_name ?>">
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group">
					<label for="usr_group">Rol</label>
					<select class="form-control" data-required-error="CAMBIAR TEXTO" required="" name="usr_group">
						<option <?= $usr_group == "1" ? "selected" : "" ?> value="1">Admin</option>
						<option <?= $usr_group == "1" ? "selected" : "" ?> value="3">Simple</option>
					</select>
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group">
					<label for="telephone">Teléfono</label>
					<input type="text" data-minlength="7" data-minlength-error="CAMBIAR TEXTO" class="form-control onlyNumbers" data-required-error="CAMBIAR TEXTO" required="" name="telephone" value="<?= $telephone ?>">
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group">
					<label for="direccion">Dirección</label>
					<input type="text" class="form-control" data-required-error="CAMBIAR TEXTO" required="" name="direccion" value="<?= $direccion ?>">
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group">
					<label for="usr_name">Correo</label>
					<input type="email" data-pattern-error="CAMBIAR TEXTO" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control" data-required-error="CAMBIAR TEXTO" required="" name="usr_name" value="<?= $usr_name ?>">
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group">
					<label for="usr_password">Contraseña</label>
					<input type="password" class="form-control" data-minlength="7" data-minlength-error="CAMBIAR TEXTO" name="usr_password" value="<?= $usr_password ?>" >
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group">
					<input type="hidden" name="is_submitted" value="1">
					<button type="submit" class="btn btn-primary">Actualizar</button>
					<a class="btn" href="<?= base_url('admin/usuarios') ?>">Cancelar</a>
				</div>
			<?= form_close() ?>
		</div>
		<?php $this->load->view('admin/footer')?>