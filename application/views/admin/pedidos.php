		<?php $this->load->view('admin/header')?>

		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-striped table-hover " id="tableList">
						<thead>
							<tr>
								<th>Id</th>
								<th>Usuario</th>
								<th>Total</th>
								<th>Fecha</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($invoices as $invoice ) : ?>
							<tr>
								<td><?=  $invoice->id  ?></td>
								<td><?= $invoice->usuario ?></td>
								<td>$ <?= $this->cart->format_number($invoice->total )  ?></td>
								<td><?=  $invoice->due_date  ?></td>
								<td><?php 
									switch ( $invoice->status ) {
										case 'paid':
											echo "Pagado";
											break;
										case 'unpaid':
											echo "Pago pendiente";
											break;
										case 'canceled':
											echo "Cancelado";
											break;
										default:
											break;
									}
								?></td>
								<?php if($invoice->status == 'confirmed'):?>
									<td>
									<a href="<?= base_url( 'admin/pedidos/detalle/'.$invoice->id ) ?>" class="btn btn-success btn-xs">Detalle</a>
								<?php else:?>
									<td>
									<a href="<?= base_url( 'admin/pedidos/detalle/'.$invoice->id ) ?>" class="btn btn-primary btn-xs">Detalle</a>
								<?php endif;?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<?php $this->load->view('admin/footer')?>