		<?php $this->load->view('admin/header')?>
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-striped table-hover" id="tableList">
						<thead>
							<tr>
								<th>#</th>
								<th>Imagen</th>
								<th>Nombre</th>
								<th>Mensaje</th>
								<th>Especificaciones</th>
								<th>Usuario</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($list as $product ) : ?>
							<tr>
								<td><?=  $product->pro_id  ?></td>
								<td>
									<?php
										$product_image =[
											'width'	=>'50',
											'src'	=>$product->pro_image,
											'class'=>'img-responsive img-portfolio img-hover',
										];
										echo img($product_image);
									?>
								</td>
								<td><?=  $product->pro_title  ?></td>
								<td><?=  $product->mensaje  ?></td>
								<td><?=  $product->especificaciones  ?></td>
								<td><?=  $product->full_name  ?></td>
								<td>
									<a href="<?= base_url( 'admin/disena_producto/editar/'.$product->pro_id ) ?>" class="btn btn-primary btn-xs">Ver</a>
									<a onclick="return confirm('¿Seguro que quiere eliminar este producto?')" href="<?= base_url( 'admin/disena_producto/delete/'.$product->pro_id ) ?>" class="btn btn-danger btn-xs">Eliminar</a>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<?php $this->load->view('admin/footer')?>