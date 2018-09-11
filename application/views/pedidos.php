		<?php $this->load->view('header')?>
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-striped table-hover " id="tableList">
						<thead>
							<tr>
								<th>id</th>
								<th>Total</th>
								<th>Fecha</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
						<?php if ( $invoices ): ?>
							<?php foreach ($invoices as $invoice ) : ?>
							<tr>
								<td><?=  $invoice->id  ?></td>
								<td>$ <?= $this->cart->format_number($invoice->total )  ?></td>
								<td><?=  $invoice->due_date  ?></td>
								<td><?=  $invoice->status  ?></td>
								<?php if($invoice->status == 'confirmed'):?>
									<td>
									<a href="<?= base_url( 'cuenta/pedidos_detalle/'.$invoice->id ) ?>" class="btn btn-success btn-xs">Detalle</a>
								<?php else:?>
									<td>
									<a href="<?= base_url( 'cuenta/pedidos_detalle/'.$invoice->id ) ?>" class="btn btn-primary btn-xs">Detalle</a>
								<?php endif;?>
								</td>
							</tr>
							<?php endforeach; ?>
						<?php endif ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<?php $this->load->view('footer')?>