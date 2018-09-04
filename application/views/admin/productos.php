		<?php $this->load->view('admin/header')?>
		<div class="row">
			<div class="col-md-12">
				<h4><a href="<?= base_url( 'admin/productos/registrar') ?>" class="btn btn-primary">Agregar</a></h4>
				<div class="table-responsive">
					<table class="table table-striped table-hover" id="tableList">
						<thead>
							<tr>
								<th>#</th>
								<th>Imagen</th>
								<th width="320">Nombre</th>
								<th width="320">Descripción</th>
								<th>Precio</th>
								<th>Stock</th>
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
								<td><textarea class="form-control" rows="4" disabled><?=  $product->pro_description  ?></textarea></td>
								<td><?=  $product->pro_price  ?></td>
								<td><?=  $product->pro_stock  ?></td>
								<td>
									<a href="<?= base_url( 'admin/productos/editar/'.$product->pro_id ) ?>" class="btn btn-primary btn-xs">Editar</a>
									<a onclick="return confirm('¿Seguro que quiere eliminar este producto?')" href="<?= base_url( 'admin/productos/delete/'.$product->pro_id ) ?>" class="btn btn-danger btn-xs">Eliminar</a>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<?php $this->load->view('admin/footer')?>