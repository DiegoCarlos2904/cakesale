		<?php $this->load->view('header')?>
		<div class="form-signin">
			<h1 class="h3 mb-3 font-weight-normal">Cambiar contraseña</h1>
			<?php if( isset($errors) ): ?>
				<div class="alert alert-danger text-left">
					<?php print_r($errors); ?>
				</div>
			<?php endif ?>
			<?= form_open('', ['data-toggle'=>"validator"]) ?>
				<div class="form-group">
					<label for="password">Contraseña</label>
					<input type="password" data-minlength="7" data-minlength-error="CAMBIAR TEXTO" class="form-control" data-required-error="CAMBIAR TEXTO" required="" id="rpassword" name="rpassword" value="<?= set_value('rpassword') ?>" >
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group">
					<label for="password">Repetir contraseña</label>
					<input type="password" data-match="#rpassword" data-match-error="CAMBIAR TEXTO" data-minlength="7" data-minlength-error="CAMBIAR TEXTO" class="form-control" data-required-error="CAMBIAR TEXTO" required="" name="repassword" value="<?= set_value('repassword') ?>" >
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Cambiar contraeña</button>
				</div>
			<?= form_close() ?>
		</div>
		<?php $this->load->view('footer')?>