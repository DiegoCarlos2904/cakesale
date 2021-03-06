		<?php $this->load->view('header')?>
		<h2 align="center">Finalizar compra - Resumen</h2>
		<p>El resumen de este pedido se te ha enviado por correo, y tambien la puedes ver en mis pedidos. </p>
		<p>Descar el <a target="_blank" href="<?= base_url( 'upload/invoice_'.$invoice_id.'.pdf' ) ?>" class="btn btn-primary btn-xs">PDF</a></p>
		<table class="table table-bordered">
			<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th class="center">Price</th>
				<th class="center">QTY</th>
				<th class="center">Total</th>
			</tr>
			</thead>
			<tbody>
			<?php
			foreach($cart['shopping_cart']['items'] as $cart_item) {
				?>
				<tr>
					<td><?php echo $cart_item['id']; ?></td>
					<td><?php echo $cart_item['name']; ?></td>
					<td class="center"> $<?php echo number_format($cart_item['price'],2); ?></td>
					<td class="center"><?php echo $cart_item['qty']; ?></td>
					<td class="center"> $<?php echo round($cart_item['qty'] * $cart_item['price'],2); ?></td>
				</tr>
				<?php
			}
			?>
			</tbody>
		</table>
		<div class="row clearfix">
			<div class="col-md-4 column">
				<p><strong>Información de compra</strong></p>
				<p>
					<?php
					echo $cart['first_name'] . ' ' . $cart['last_name'] . '<br />' .
						$cart['email'] . '<br />'.
						$cart['phone_number'] . '<br />';
					?>
				</p>
			</div>
			<div class="col-md-4 column">
			</div>
			<div class="col-md-4 column">
				<table class="table">
					<tbody>
					<tr>
						<td><strong> Total</strong></td>
						<td> $<?php echo number_format($cart['shopping_cart']['subtotal'],2); ?></td>
					</tr>
					</tbody>
				</table>
			</div>
		</div>
		<?php $this->load->view('footer')?>