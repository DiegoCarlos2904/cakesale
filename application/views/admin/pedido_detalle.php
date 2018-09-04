		<?php $this->load->view('admin/header')?>
		<?php $total = 0; ?>
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-striped table-hover " id="tableList">
						<thead>
							<tr>
								<th>Producto ID</th>
								<th>Nombre</th>
								<th>Cantidad de porciones</th>
								<th>Mensaje en la torta</th>
								<th>Especificaciones adicionales</th>
								<th>Cantidad</th>
								<th>Precio</th>
								<th>Sub Total</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($orders as $order ) : ?>
							<tr>
								<td><?=  $order->id  ?></td>
								<td><?=  $order->product_title  ?></td>
								<?php if ( isset( $order->options ) && $options = unserialize( $order->options ) ): ?>
									<td><?=  $options['porciones']  ?></td>
									<td><?=  $options['mensaje']  ?></td>
									<td><?=  $options['especificaciones']  ?></td>
								<?php else: ?>
									<td></td>
									<td></td>
									<td></td>
								<?php endif ?>
								<td width="100"><?=  $order->qty  ?></td>
								<td width="100">S/ <?=  $order->price  ?></td>
								<td width="100">S/ <?php $subtotal = $order->qty * $order->price; $total += $subtotal;echo $this->cart->format_number($subtotal); ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
						<thead>
							<tr>
								<th colspan="5"></th>
								<th>Total</th>
								<th colspan="2">S/ <?= $this->cart->format_number($total) ?></th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
		<?php $this->load->view('admin/footer')?>