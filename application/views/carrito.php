
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
			<?=  anchor('tienda/clear_cart','Limpiar carrito',['class'=>'btn btn-danger','role'=>'button']) ?>
			<?=  anchor(base_url(),'Continuar comprando',['class'=>'btn btn-primary','role'=>'button']) ?>
			<?php
				$url_check	='<button class="btn btn-success type="submit">';
				$url_check	 .= 'Pagar'.'</button>';
			?>
			<?php if  ($this->cart->total_items()!=0):?>
			<?=  anchor('order',' Pagar',['class'=>'btn btn-success','role'=>'button']) ?>
			<?php else:?>
			<?= anchor(base_url(),$url_check); ?>
			<?php endif ;?>
		</div>
		<div class="col-md-2"></div>
		<?php $this->load->view('footer')?>