		<?php $this->load->view('admin/header')?>
		<div class="row">
			<div class="col-md-12">
				<h4><a class="btn btn-primary" href="<?= base_url('admin/categorias/registrar') ?>">Agregar</a></h4>
				<div class="table-responsive">
					<table class="table table-striped table-hover" id="tableList">
						<thead>
							<tr>
								<th>ID</th>
								<th>Nombre</th>
								<th>Slug</th>
								<th width="190">Acciones</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($list as $cat ) : ?>
							<tr>
								<td><?=  $cat->cat_id  ?></td>
								<td><?=  $cat->name  ?></td>
								<td><?=  $cat->slug  ?></td>
								<td>
									<a class="btn btn-primary btn-xs" href="<?= base_url('admin/categorias/editar/'.$cat->cat_id) ?>">Editar</a>
									<a onclick="return confirm('¿Seguro que quiere eliminar esta categoría?')" class="btn btn-danger btn-xs" href="<?= base_url('admin/categorias/delete/'.$cat->cat_id) ?>">Eliminar</a> 
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<?php $this->load->view('admin/footer')?>