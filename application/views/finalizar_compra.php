
		<?php $this->load->view('header')?>
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-striped table-hover" id="tableList">
						<thead>
							<tr>
								<th>ID</th>
								<th>Producto</th>
								<th>Cantidad</th>
								<th>Precio</th>
								<th>Sub total</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							foreach ($this->cart->contents() as $items): ?>
							<tr>
								<td><?=  $items['id']  ?></td>
								<td>
									<?= $items['name'] ?>
									<?php if ( isset( $items['options'] ) ): ?>
										<?php if ( isset( $items['options']['porciones'] ) && $items['options']['porciones'] ): ?>
											<br><b>Porciones</b>: <?= $items['options']['porciones'] ?>
										<?php endif ?>
										<?php if ( isset( $items['options']['mensaje'] ) && $items['options']['mensaje'] ): ?>
											<br><b>Mensaje</b>: <?= $items['options']['mensaje'] ?>
										<?php endif ?>
									<?php endif ?>
								</td>
								<td><?= $items['qty'] ?></td>
								<td><?php echo $this->cart->format_number( $items['price'] );?></td>
								<td><?php echo $this->cart->format_number( $items['subtotal'] );?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
						<tfoot>
							<tr>
								<th></th>
								<th></th>
								<th></th>
								<th>Total</th>
								<th><?php echo $this->cart->format_number( $this->cart->total() ); ?></th>
							</tr>
							<tr>
								<th></th>
								<th></th>
								<th></th>
								<th colspan="2">
									<a href="<?php echo base_url('tienda/setpaypal'); ?>"><img src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif"></a>
								</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
		<?php $this->load->view('footer')?>