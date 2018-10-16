		<?php $this->load->view('header')?>
		<div class="col-6">
			<?php if( isset($errors) ): ?>
   				<div class="alert alert-danger text-left">
   					<?php print_r($errors); ?>
   				</div>
   			<?php endif ?>
			<?=	form_open_multipart('',['data-toggle'=>"validator", 'class'=>'']) ?>
				<div class="form-group">
					<label for="pro_title">Título</label> 
					<input value="" id="pro_title" name="pro_title" type="text" class="form-control" data-required-error="Ingrese titulo" required="required">
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<input type="file" required="" class="form-control-file" name="userfile">
					</div>
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group">
					<label for="mensaje">Mensaje en la torta</label>
					<textarea id="mensaje" name="mensaje" id="" cols="30" class="form-control" rows="3" data-required-error="Ingrese un mensaje" required="required"></textarea>
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group">
					<label for="especificaciones">Especificaciones adicionales (Opcional) </label>
					<textarea id="especificaciones" name="especificaciones" id="" cols="30" class="form-control" rows="3" ></textarea>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Solicitar diseño</button>
				</div>
			<?= form_close() ?>
		</div>
		<?php $this->load->view('footer')?>