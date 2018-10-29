<?php 
if( $this->input->post('is_submitted') ) {
	$type			= set_value('type');
	$date_from			= set_value('date_from');
	$date_to			= set_value('date_to');
	$formato			= set_value('formato');
} else {
	$type			= '';
	$date_from			= '';
	$date_to			= '';
	$formato			= '';
}
?><?php $this->load->view('admin/header')?>
<div class="form-signin">
	<h1 class="h3 mb-3 font-weight-normal">Registrar reporte</h1>
	<?php if( isset($errors) ): ?>
		<div class="alert alert-danger text-left">
			<?php print_r($errors); ?>
		</div>
	<?php endif ?>
	<?= form_open('',['data-toggle'=>"validator"] ) ?>
		<div class="form-group">
			<label for="type">Tipo</label> 
			<select id="type" data-required-error="Por favor selecciona un tipo" name="type" class="form-control" required="required">
				<option <?= $type == 'ventas_productos' ? "selected = 'selected'" : "" ;?> value="ventas_productos">Ventas de productos</option>
				<option <?= $type == 'ventas_categorias' ? "selected = 'selected'" : "" ;?> value="ventas_categorias">Ventas por categorías</option>
				<option <?= $type == 'pedidos' ? "selected = 'selected'" : "" ;?> value="pedidos">Pedidos por cliente</option>
				<option <?= $type == 'valoracion' ? "selected = 'selected'" : "" ;?> value="valoracion">Valoración de tortas</option>
			</select>
			<div class="help-block with-errors"	></div>
		</div>
		<div class="form-group">
			<label for="formato">Formato</label> 
			<select id="formato" data-required-error="Por favor selecciona un formato" name="formato" class="form-control" required="required">
				<option <?= $formato == 'pdf' ? "selected = 'selected'" : "" ;?> value="pdf">PDF</option>
				<option <?= $formato == 'xls' ? "selected = 'selected'" : "" ;?> value="xls">Excel</option>
			</select>
			<div class="help-block with-errors"	></div>
		</div>
		<div class="form-group">
			<label for="inputUserName">Fecha</label> 
			<div class="input-daterange input-group" id="datepicker">
				<input type="text" class="input-sm form-control" name="date_from" value="<?= $date_from ?>" />
				<span class="input-group-addon px-2">Hasta</span>
				<input type="text" class="input-sm form-control" name="date_to" value="<?= $date_to ?>" />
			</div>
			<div class="help-block with-errors"	></div>
		</div>
		<div class="form-group">
			<input type="hidden" name="is_submitted" value="1">
			<button type="submit" class="btn btn-primary">Generar</button>
			<a class="btn" href="<?= base_url('admin/reportes') ?>">Cancelar</a>
		</div>
	<?= form_close() ?>
</div>
<?php $this->load->view('admin/footer')?>