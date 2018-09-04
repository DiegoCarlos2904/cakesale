		<?php $this->load->view('admin/header')?>
		<div class="row">
			<div class="col-md-12">
				<h4><a class="btn btn-primary" href="<?= base_url('admin/usuarios/registrar') ?>">Agregar</a></h4>
				<div class="table-responsive">
					<table class="table table-striped table-hover" id="tableList">
						<thead>
							<tr>
								<th>#</th>
								<th>Correo</th>
								<th>Nombre</th>
								<th>Dirección</th>
								<th>Teléfono</th>
								<th width="190">Acciones</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($list as $user ) : ?>
							<tr>
								<td><?=  $user->usr_id  ?></td>
								<td><?=  $user->usr_name  ?></td>
								<td><?=  $user->full_name  ?></td>
								<td><?=  $user->direccion  ?></td>
								<td><?=  $user->telephone  ?></td>
								<td>
									<a class="btn btn-primary btn-xs" href="<?= base_url('admin/usuarios/editar/'.$user->usr_id) ?>">Editar</a>
									<?php if ( !(  $user->usr_id == $this->session->userdata['usr_id'] ) ): ?>
										<a onclick="return confirm('¿Seguro que quiere eliminar este usuario?')" class="btn btn-danger btn-xs" href="<?= base_url('admin/usuarios/delete/'.$user->usr_id) ?>">Eliminar</a> 
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