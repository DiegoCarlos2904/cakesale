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
				<nav class="navbar navbar-expand-lg p-0">
					<p class="clasificacion_single navbar-nav">
						<?php for ($i=1; $i < 6; $i++) : ?>
							<label for="" style="<?= (int) $product->avg_comment >= $i ? "color: orange" : ''; ?>">★</label>
						<?php endfor ?>
						<small>( <?= $product->total_cal ?> de calificaciones )</small>
					</p>
				</nav>
				<p><?= $product->pro_description ?></p>
				<h4 class="btn btn-outline-primary">$ <?= number_format( $product->pro_price, 2 ); ?></h4>
				<p><b><?= $product->pro_stock ?> disponibles</b></p>
				<?php if ( $product->pro_stock ): ?>
					<div class="row align-items-center">
						<div class="col-md-8">
							<div class="card ">
								<div class="card-body">
									<?=	form_open('tienda/add_to_cart/'.$product->pro_slug.'/add',['data-toggle'=>"validator", 'class'=>'']) ?>
										<div class="form-group">
											<label for="porciones">Cantidad de porciones</label>
											<input value="" min="20" max="100" id="porciones" name="porciones" type="number" class="form-control" data-required-error=" Ingrese Cantidad" required="required">
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group">
											<label for="mensaje">Mensaje en la torta</label>
											<textarea id="mensaje" name="mensaje" id="" cols="30" class="form-control" rows="3" data-required-error="Ingrese un mensaje" required="required"></textarea>
											<div class="help-block with-errors"></div>
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
				<?php endif ?>
			</div>
			<div class="col-12 mt-4">
				<h3>Comentarios</h3>
				<?php if ( $comments && is_array( $comments ) && count( $comments ) ): ?>
					<ul class="list-unstyled">
					<?php foreach ( $comments as $row ): ?>
						<li class="media">
							<div class="media-body">
								<?php $now = time(); ?>
								<p class="mt-0"><b><?=$row['full_name'];?></b> -
									hace <?= timespan(strtotime( $row['date_added'] ), $now) . ''; ?>
									<?php if ( $row['val'] ): ?>
										<nav class="navbar navbar-expand-lg p-0">
											<p class="clasificacion_single navbar-nav">
												<?php for ($i=1; $i < 6; $i++) : ?>
													<label for="" style="<?= $row['val'] >= $i ? "color: orange" : ''; ?>">★</label>
												<?php endfor ?>
											</p>
										</nav>
									<?php endif ?>
								</p>
		    					<p><?=$row['comment'];?></p>
								<hr>
							</div>
						</li>
					<?php endforeach ?>
					</ul>
				<?php else: ?>
					<p>No hay comentarios</p>
				<?php endif ?>
				<?php if ( $this->session->userdata('usr_id') ): ?>
					<form action="<?=  base_url()?>comments/add_comment/<?= $product->pro_slug ?>" method="post">
						<div class="form-group">
							<label>Valoración</label>
							<nav class="navbar navbar-expand-lg p-0">
								<p class="clasificacion navbar-nav">
									<input id="radio1" type="radio" name="estrellas" value="5">
									<label for="radio1">★</label>
									<input id="radio2" type="radio" name="estrellas" value="4">
									<label for="radio2">★</label>
									<input id="radio3" type="radio" name="estrellas" value="3">
									<label for="radio3">★</label>
									<input id="radio4" type="radio" name="estrellas" value="2">
									<label for="radio4">★</label>
									<input id="radio5" type="radio" name="estrellas" value="1">
									<label for="radio5">★</label>
								</p>
							</nav>
						</div>
						<div class="form-group">
							<label>Comentario</label>
							<textarea class="form-control" data-required-error="Ingresa un comentario" required="" rows="4" cols="100" name="comment" rows="3"></textarea>
							<div class="help-block with-errors"></div>
						</div>
						<button type="submit" class="btn btn-primary">Comentar</button>
					</form>
				<?php else: ?>
					<a href="<?=  base_url()?>/login">Inicia sesión para comentar.</a>
				<?php endif ?>
			</div>
		</div>
		<?php $this->load->view('footer')?>