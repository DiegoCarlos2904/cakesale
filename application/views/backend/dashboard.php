
		<?php $this->load->view('header')?>
		<!-- Navigation -->
		<?php //$this->load->view('layout/dash_navigation')?>
		<!-- Header- dash_menu -->
		<?php //$this->load->view('layout/dash_menu')?>
			<div class="row">
				<!-- body items -->
	
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4><i class="fa fa-fw fa-compass"></i> Products <?=  anchor('admin/products/create','Agregar',['class'=>'btn btn-primary btn-xs']) ?></h4>
							
						</div>
						<div class="panel-body">
							<table class="table table-striped table-hover" id="tableproducts">
								<thead>
									<tr>
										<th>#</th>
										<th>Nombre</th>
										<th>Descripción</th>
										<th>Precio</th>
										<th>Stoack</th>
										<th>Imágen</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>
								<!-- load products from table -->
								<?php foreach ($products as $product ) : ?>
									<tr>
										<td><?=  $product->pro_id  ?></td>
										<td><?=  $product->pro_title  ?></td>
										<td><textarea rows="4" disabled><?=  $product->pro_description  ?></textarea></td>
										<td><?=  $product->pro_price  ?></td>
										<td><?=  $product->pro_stock  ?></td>
										<td>
											<a href="">
												<style>#g {width:50px;height:50px;}</style>
												<?php
													
													$product_image =['src'	=>$product->pro_image,
													
													'class'=>'img-responsive img-portfolio img-hover',
													'id'=>'g'
													];
													echo img($product_image);
												?>
										</td>
										<td>
											<?=  anchor('admin/products/edit/'.$product->pro_id,'Editar',['class'=>'btn btn-primary btn-xs']) ?>
											<?php  if($this->session->userdata('usr_group')	==	'1' ): ?>
											<?=  anchor('admin/products/delete/'.$product->pro_id,'Eliminar',['class'=>'btn btn-danger btn-xs',
																											'onclick'=>'return confirm(\'¿Seguro que quiere eliminar este producto? \')'
																											]) ?>
											<?php else:?>
											<?=  anchor('admin/products/delete/','Delete',['class'=>'btn btn-danger btn-xs','data-toggle'=>'button',
												'onclick'=>'return confirm(\'Sorry You Cant Delete it you should be admin  ? \')'
											]) ?>
											<?php endif;?>
											
										</td>
									</tr>
									<?php endforeach; ?>
									
									
								</tbody>
							</table>
							<script>
								$(document).ready(function(){
									//$('#tableproducts').DataTable();
								});
							</script>
							
						</div>
					</div>
				</div> 
				
			</div>
			<hr>
			<?php $this->load->view('footer')?>