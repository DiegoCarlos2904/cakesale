		<?php $this->load->view('header')?>
		<div class="col-6">
			<?=	form_open('tienda/add_diseno',['data-toggle'=>"validator", 'class'=>'']) ?>
				<div class="form-group">
					<label for="porciones">Cantidad de porciones</label>
					<input value="" min="20" max="100" id="porciones" name="porciones" type="number" class="form-control" data-required-error=" Ingrese Cantidad" required="required">
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