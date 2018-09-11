		<?php $this->load->view('header')?>
		<?php $total = 0; ?>
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-striped table-hover " id="tableList">
						<thead>
							<tr>
								<th>Producto ID</th>
								<th>Nombre</th>
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
								<td>
									<?=  $order->product_title  ?>
									<?php if ( isset( $order->options ) && $options = unserialize( $order->options ) ): ?>
										<br><b>Porciones</b>: <?=  $options['porciones']  ?>
										<br><b>Mensaje</b>: <?=  $options['mensaje']  ?>
										</td><td><?=  $options['especificaciones']  ?>
									<?php else: ?>
										</td><td>
									<?php endif ?>
								</td>
								<td width="100"><?=  $order->qty  ?></td>
								<td width="100">$ <?=  $order->price  ?></td>
								<td width="100">$ <?php $subtotal = $order->qty * $order->price; $total += $subtotal;echo $this->cart->format_number($subtotal); ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
						<thead>
							<tr>
								<th colspan="3"></th>
								<th>Total</th>
								<th colspan="2">$ <?= $this->cart->format_number($total) ?></th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
		<?php $this->load->view('footer')?>