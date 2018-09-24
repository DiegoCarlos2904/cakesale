<?php 
	if( $this->input->post('is_submitted') ) {
		$usr_name			= set_value('usr_name');
		$telephone			= set_value('telephone');
		$first_name			= set_value('first_name');
		$last_name			= set_value('last_name');
		$usr_password		= set_value('usr_password');
		$direccion			= set_value('direccion');
		$usr_group			= set_value('usr_group');
	} else {
		$usr_name			= '';
		$telephone			= '';
		$first_name			= '';
		$last_name			= '';
		$usr_password		= '';
		$direccion		= '';
		$usr_group		= '';
	}
?>
		<?php $this->load->view('admin/header')?>
		<div class="form-signin">
			<h1 class="h3 mb-3 font-weight-normal">Registrar usuario</h1>
			<?php if( isset($errors) ): ?>
				<div class="alert alert-danger text-left">
					<?php print_r($errors); ?>
				</div>
			<?php endif ?>
			<?= form_open('' ) ?>
				<div class="form-group">
					<label for="first_name">Nombres</label>
					<input type="text" class="form-control" required="" name="first_name" value="<?= $first_name ?>">
				</div>
				<div class="form-group">
					<label for="last_name">Apellidos</label>
					<input type="text" class="form-control" required="" name="last_name" value="<?= $last_name ?>">
				</div>
				<div class="form-group">
					<label for="usr_group">Rol</label>
					<select class="form-control" required="" name="usr_group">
						<option <?= $usr_group == "1" ? "selected" : "" ?> value="1">Admin</option>
						<option <?= $usr_group == "1" ? "selected" : "" ?> value="3">Simple</option>
					</select>
				</div>
				<div class="form-group">
					<label for="telephone">Teléfono</label>
					<input type="text" class=" onlyNumbers form-control" required="" name="telephone" value="<?= $telephone ?>">
				</div>
				<div class="form-group">
					<label for="direccion">Dirección</label>
					<input type="text" class="form-control" required="" name="direccion" value="<?= $direccion ?>">
				</div>
				<div class="form-group">
					<label for="usr_name">Correo</label>
					<input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"  class="form-control" required="" name="usr_name" value="<?= $usr_name ?>">
				</div>
				<div class="form-group">
					<label for="usr_password">Contraseña</label>
					<input type="password" class="form-control" required="" name="usr_password" value="<?= $usr_password ?>" >
				</div>
				<div class="form-group">
					<input type="hidden" name="is_submitted" value="1">
					<button type="submit" class="btn btn-primary">Registrar</button>
					<a class="btn" href="<?= base_url('admin/usuarios') ?>">Cancelar</a>
				</div>
			<?= form_close() ?>
		</div>
		<?php $this->load->view('admin/footer')?>