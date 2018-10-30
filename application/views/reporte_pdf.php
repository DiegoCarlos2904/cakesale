		<?php $this->load->view('header_single')?>
		<h2 align="center">Reporte - 
			<?php 
				switch ( $data_post['type'] ) {
					case 'ventas_productos':
						echo "Ventas de productos";
						break;
					
					case 'ventas_categorias':
						echo "Ventas por categorías";
						break;
					
					case 'pedidos':
						echo "Pedidos por cliente";
						break;
					
					case 'valoracion':
						echo "Valoración de tortas";
						break;
					
					default:
						break;
				}
			?>
		</h2>
		<?php if ( $data_grafics && count( $data_grafics ) ): ?>
			<?php foreach ($data_grafics as $key => $grafi): ?>
				<table class="table table-borderless table-sm" style="page-break-after: always;">
					<tbody>
						<tr>
							<td class="text-center">
								<img width="350" class="mt-3" src="<?= $grafi['photo'] ?>" >
							</td>
						</tr>
						<tr>
							<td>
								<?php if ( $grafi['names'] ): ?>
									<table class="table table-sm">
										<thead>
											<tr>
												<td>#</td>
												<td>Nombre</td>
												<td>Valor</td>
											</tr>
										</thead>
										<?php foreach ($grafi['names'] as $key => $name): ?>
											<tr>
												<td><?= $key + 1 ?></td>
												<td><?= $name['nombre'] ?></td>
												<td><?= $name[ $grafi['campo']] ?></td>
											</tr>
										<?php endforeach ?>
									</table>
								<?php endif ?>
							</td>
						</tr>
					</tbody>
				</table>
			<?php endforeach ?>
		<?php endif ?>
		<?php $this->load->view('footer_single')?>