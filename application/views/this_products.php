	   <?php $this->load->view('layout/header')?>
		<div class="row">
		  	<?php $send = 'add';?>
			<?php foreach ($comes as $product ) : ?>
				<div class="col-md-3">
					<div class="card h-100">
						<a href="<?= base_url( 'tienda/'.$product->pro_slug ) ?>">
							<?php
								$product_image =[
									'src'	=>$product->pro_image,
									'class'=>'card-img-top img-fluid img-responsive img-hover',
								];
								echo img($product_image);
							?>
						</a>
						<div class="card-body">
							<h4 class="card-title">
								<a href="<?= base_url( 'tienda/'.$product->pro_slug ) ?>"><?=	$product->pro_title	?></a>
							</h4>
							<h5>S/ <?=	$product->pro_price	?></h5>
							<?=	anchor('tienda/add_to_cart/'.$product->pro_id,'Comprar',['class'=>'btn btn-success	btn-xs','role'=>'button']) ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<hr>
		<?php $this->load->view('layout/footer')?>