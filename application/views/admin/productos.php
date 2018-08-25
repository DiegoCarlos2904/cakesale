		<?php $this->load->view('admin/header')?>
		<div class="row">
			<div class="col-md-12">
				<h4><?=  anchor('admin/productos/registrar','Agregar',['class'=>'btn btn-primary']) ?></h4>
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
									<?=  anchor('admin/productos/editar/'.$product->pro_id,'Editar',['class'=>'btn btn-primary btn-xs']) ?>
									<?=  anchor('admin/productos/delete/'.$product->pro_id,'Eliminar',[
										'class'=>'btn btn-danger btn-xs',
										'onclick'=>'return confirm(\'¿Seguro que quiere eliminar este producto? \')'
									]) ?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
				<script>
					$(document).ready(function(){
						//$('#tableproducts').DataTable();
					});
				</script>
			</div>
		</div>
		<?php $this->load->view('admin/footer')?>