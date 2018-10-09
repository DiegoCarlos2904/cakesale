		<?php $this->load->view('header_single')?>
		<h2 align="center">Resumen de compra</h2>
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
		<table class="table">
			<tr>
				<td>
					<p><strong>Información de compra</strong></p>
					<p>
						<?php
						echo $cart['first_name'] . ' ' . $cart['last_name'] . '<br />' .
							$cart['email'] . '<br />'.
							$cart['phone_number'] . '<br />';
						?>
					</p>
				</td>
			</tr>
			<tr>
				<td><strong> Total</strong></td>
				<td> $<?php echo number_format($cart['shopping_cart']['subtotal'],2); ?></td>
			</tr>
		</table>
		<?php $this->load->view('footer_single')?>