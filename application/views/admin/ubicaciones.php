		<?php $this->load->view('admin/header')?>

		<div class="row">
			<div class="col-md-12">
				<h4><a class="btn btn-primary" href="<?= base_url('admin/ubicaciones/registrar') ?>">Agregar</a></h4> 
				<div class="table-responsive">
					<table class="table table-striped table-hover " id="tableList">
						<thead>
							<tr>
								<th>Id</th>
								<th>Ubicación</th>
								<th>Descripción</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($list as $row ) : ?>
							<tr>
								<td><?=  $row->id  ?></td>
								<td><?= $row->name ?></td>
								<td><?=  $row->description  ?></td>
								<td>
									<a class="btn btn-primary btn-xs" href="<?= base_url('admin/ubicaciones/editar/'.$row->id) ?>">Editar</a>
									<a onclick="return confirm('¿Seguro que quiere eliminar esta ubicación?')" class="btn btn-danger btn-xs" href="<?= base_url('admin/ubicaciones/delete/'.$row->id) ?>">Eliminar</a> 
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<?php $this->load->view('admin/footer')?>