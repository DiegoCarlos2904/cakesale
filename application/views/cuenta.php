		<?php $this->load->view('header')?>
		<?php 
			$usr_id 				= $user->usr_id;
			if( $this->input->post('is_submitted') ) {
				$usr_name			= set_value('usr_name');
				$telephone			= set_value('telephone');
				$first_name			= set_value('first_name');
				$last_name			= set_value('last_name');
				$usr_password		= set_value('usr_password');
				$direccion			= set_value('direccion');
			} else {
				$usr_name			= $user->usr_name;
				$telephone			= $user->telephone;
				$first_name			= $user->first_name;
				$last_name			= $user->last_name;
				$usr_password		= '';
				$direccion			= $user->direccion;
			}
		?>
		<div class="" style="max-width: 680px; margin: 0; width: 100%; ">
			<?php if( isset($errors) ): ?>
				<div class="alert alert-danger text-left">
					<?php print_r($errors); ?>
				</div>
			<?php endif ?>
			<?= form_open( '' ) ?>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="first_name">Nombres</label>
							<input type="text" class="form-control" required="" name="first_name" value="<?= $first_name ?>">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="last_name">Apellidos</label>
							<input type="text" class="form-control" required="" name="last_name" value="<?= $last_name ?>">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="telephone">Teléfono</label>
							<input type="text" class="onlyNumbers form-control" required="" name="telephone" value="<?= $telephone ?>">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="direccion">Dirección</label>
							<input type="text" class="form-control" required="" name="direccion" value="<?= $direccion ?>">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="usr_name">Correo</label>
							<input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"  class="form-control" required="" name="usr_name" value="<?= $usr_name ?>">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="usr_password">Contraseña</label>
							<input type="password" class="form-control" name="usr_password" value="<?= $usr_password ?>" >
						</div>
					</div>
				</div>
				<div class="form-group">
					<input type="hidden" name="is_submitted" value="1">
					<button type="submit" class="btn btn-primary">Actualizar</button>
				</div>
			<?= form_close() ?>
		</div>
		<?php $this->load->view('footer')?>