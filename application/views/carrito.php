
		<?php $this->load->view('header')?>
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-striped table-hover " id="tableList">
						<thead>
							<tr>
								<th>#</th>
								<th>Producto</th>
								<th>Cantidad</th>
								<th>Precio</th>
								<th>Sub total</th>
							</tr>
						</thead>
						<tbody>
						<?php $i=0; foreach ($this->cart->contents() as $items ) : $i++; ?>
							<tr>
								<td><?= $i ?></td>
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
								<td width="80"><?= $items['qty'] ?></td>
								<td width="120">$ <?php echo $this->cart->format_number( $items['price'] );?></td>
								<td width="120">$ <?php echo $this->cart->format_number( $items['subtotal'] );?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
						<thead>
							<tr>
								<th colspan="3"></th>
								<th>Total</th>
								<th colspan="2">$ <?php echo $this->cart->format_number( $this->cart->total() ); ?></th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-4"></div>
		<div class="col-md-6">
			<a href="<?= base_url( 'tienda/clear_cart' ) ?>" class="btn btn-danger">Limpiar carrito</a>
			<a href="<?= base_url( '' ) ?>" class="btn btn-primary">Continuar comprando</a>
			<?php if  ($this->cart->total_items()!=0):?>
				<a href="<?= base_url( 'tienda/finalizar_compra' ) ?>" class="btn btn-success">Pagar</a>
			<?php endif ?>
		</div>
		<div class="col-md-2"></div>
		<?php $this->load->view('footer')?>