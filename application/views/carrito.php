
		<?php $this->load->view('header')?>
		<div class="row">
			<div class="col-md-1">
			<h3>#</h3>
			</div>
			<div class="col-md-4">
			<h3>Producto</h3>
			</div>
			<div class="col-md-2">
			<h3>Cantidad</h3>
			</div>
			<div class="col-md-3">
			<h3>Precio</h3>
			</div>
			<div class="col-md-2">
			<h3>Sub total</h3>
			</div>
		</div>  
		<?php 
			$i=0;
			foreach ($this->cart->contents() as $items): 
			$i++;
		?>
		<hr>
		<div class="row">
			<div class="col-md-1">
				<?= $i ?>
			</div>
			<div class="col-md-4">
				<?= $items['name'] ?>
				<?php if ( isset( $items['options'] ) ): ?>
					<?php if ( isset( $items['options']['porciones'] ) && $items['options']['porciones'] ): ?>
						<br><b>Porciones</b>: <?= $items['options']['porciones'] ?>
					<?php endif ?>
					<?php if ( isset( $items['options']['mensaje'] ) && $items['options']['mensaje'] ): ?>
						<br><b>Mensaje</b>: <?= $items['options']['mensaje'] ?>
					<?php endif ?>
				<?php endif ?>
			</div>
			<div class="col-md-2">
				<?= $items['qty'] ?>
			</div>
			<div class="col-md-3">
				<?php echo $this->cart->format_number( $items['price'] );?>
			</div>
			<div class="col-md-2">
				<?php echo $this->cart->format_number( $items['subtotal'] );?>
			</div>
			<hr>
		</div> 
		<?php endforeach;?>
		<div class="row">
			<hr>
			<div class="col-md-9">
			<hr>
			</div>
			<div class="col-md-3">
				<h3>Total : <?php echo $this->cart->format_number( $this->cart->total() ); ?></h3>
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