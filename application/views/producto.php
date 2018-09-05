	   <?php $this->load->view('header')?>
		<div class="row">
			<div class="col-12 col-xl-6">
				<?php
					$product_image =[
						'src'	=> $product->pro_image,
						'class'	=>'card-img-top img-fluid img-thumbnail img-responsive img-hover',
					];
					echo img($product_image);
				?>
			</div>
			<div class="col-12 col-xl-6">
				<h2 class="mb-3 post-title"><?=	$product->pro_title	?></h2>
				<p>Categoría: <a href="<?= base_url( 'categoria/'. $product->cat_slug ) ?>"><?= $product->cat_name ?></a></p>
				<h4 class="btn btn-outline-primary">$ <?= number_format( $product->pro_price, 2 ); ?></h4>
				<div class="row align-items-center">
					<div class="col-md-8">
						<div class="card ">
							<div class="card-body">
								<?=	form_open('tienda/add_to_cart/'.$product->pro_slug.'/add',['class'=>'']) ?>
									<div class="form-group">
										<label for="porciones">Cantidad de porciones</label>
										<input value="" min="20" max="100" id="porciones" name="porciones" type="number" class="form-control" required="required">
									</div>
									<div class="form-group">
										<label for="mensaje">Mensaje en la torta</label>
										<textarea id="mensaje" name="mensaje" id="" cols="30" class="form-control" rows="3" required="required"></textarea>
									</div>
									<div class="form-group">
										<label for="especificaciones">Especificaciones adicionales (Opcional) </label>
										<textarea id="especificaciones" name="especificaciones" id="" cols="30" class="form-control" rows="3" ></textarea>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary">Agrega al carrito</button>
									</div>
								<?= form_close() ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view('footer')?>