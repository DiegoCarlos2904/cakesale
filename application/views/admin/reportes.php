		<?php $this->load->view('admin/header')?>
		<div class="row">
			<div class="col-md-12">
				<h4><a class="btn btn-primary" href="<?= base_url('admin/reportes/registrar') ?>">Generar</a></h4>
				<div class="table-responsive">
					<table class="table table-striped table-hover" id="tableList">
						<thead>
							<tr>
								<th>#</th>
								<th>Tipo</th>
								<th>Desde</th>
								<th>Hasta</th>
								<th width="190">Acciones</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($list as $key => $row ) : ?>
							<tr>
								<td><?=  $key + 1  ?></td>
								<td><?= $row->type ?></td>
								<td><?= $row->date_from ?></td>
								<td><?= $row->date_to ?></td>
								<td>
									<a onclick="return confirm('¿Seguro que quiere eliminar este reporte?')" class="btn btn-danger btn-xs" href="<?= base_url('admin/reportes/delete/'.$row->id) ?>">Eliminar</a> 
									<?php if ( $row->url ): ?>
									  | <a target="_blank" href="<?= $row->url ?>">Descargar</a>
									<?php endif ?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<?php $this->load->view('admin/footer')?>