			<?php if ( $products ): ?>
				<?php foreach ($products as $product ) : ?>
				<div class="col-md-3">
					<div class="card mb-4 shadow-sm">
						<a href="<?= base_url( 'tienda/ver/'.$product->pro_slug ) ?>">
							<?php
								$product_image =[
									'src'	=> $product->pro_image,
									'class'	=>'card-img-top img-fluid img-responsive img-hover',
								];
								echo img($product_image);
							?>
						</a>
						<div class="card-body">
							<h4 class="card-title">
								<a href="<?= base_url( 'tienda/ver/'.$product->pro_slug ) ?>"><?=	$product->pro_title	?></a>
							</h4>
							<div class="row align-items-center">
								<div class="col-md-6">
									<h4 class="mb-0">S/ <?= number_format( $product->pro_price, 2 );	?></h4>
								</div>
								<div class="col-md-6">
									<a class="btn btn-primary btn-xs" href="<?= base_url( 'tienda/ver/'.$product->pro_slug ) ?>">Ver</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			<?php else: ?>
				<div class="col-md-12">
					<p>No se han encontrado productos</p>
				</div>
			<?php endif ?>