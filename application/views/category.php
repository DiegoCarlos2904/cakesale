<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Cake Sale</title>

	<!-- Bootstrap Core CSS -->
	<link href="<?php echo base_url('/assets/css/bootstrap.min.css');?>" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="<?php echo base_url('/assets/css/modern-business.css');?>" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="<?php echo base_url('/assets/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>

	<!-- Navigation Top_Menu -->
	<?php $this->load->view('layout/navigation')?>
	<!-- Header Carousel -->
	<header id="myCarousel" class="carousel slide" data-ride="carousel" style="display: none;">
		<!-- Indicators -->
		<!-- Wrapper for slides -->
		<div class="carousel-inner" >
			<div class="carousel-item active">
				<img class="d-block w-100" src="http://placehold.it/1900x1080&text=Slide 1" alt="Slide 1">
				<div class="carousel-caption d-none d-md-block">
					<h2>Caption 1</h2>
				</div>
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="http://placehold.it/1900x1080&text=Slide 2" alt="Slide 2">
				<div class="carousel-caption d-none d-md-block">
					<h2>Caption 2</h2>
				</div>
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="http://placehold.it/1900x1080&text=Slide 3" alt="Slide 3">
				<div class="carousel-caption d-none d-md-block">
					<h2>Caption 3</h2>
				</div>
			</div>
		</div>
		<a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Anterior</span>
		</a>
		<a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Siguiente</span>
		</a>
	</header>
	<!-- Page Content -->
	<div class="container py-4">
		<!-- Product Menu -->
		<?php //$this->load->view('layout/product_menu')?>
		<!-- /.row -->
		<h1><?= $category->name ?></h1>
		<div class="row">
			<?php foreach ($products as $product ) : ?>
			 <div class="col-md-3">
				<div class="card h-100">
					<a href="#">
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
							<a href="#"><?=	$product->pro_title	?></a>
						</h4>
						<h5>S/ <?=	$product->pro_price	?></h5>
						<?=	anchor('home/add_to_cart/'.$product->pro_id,'Comprar',['class'=>'btn btn-success	btn-xs','role'=>'button']) ?>
					</div>
				</div>
				<!--<div class="panel-body" width="100px">
					 <?php	if($this->session->userdata('group')	!=	'1'	and $this->session->userdata('group')	!=	'2' ): ?>
					<?=	anchor('home/add_to_cart/'.$product->pro_id,'Add To Cart || Buy',['class'=>'btn btn-success	btn-xs','role'=>'button']) ?>
					
					<?php else:?>
					<?=	anchor('admin/products/edit/'.$product->pro_id,'Edit',['class'=>'btn btn-success btn-xs']) ?>
					<?php	if($this->session->userdata('group')	==	'1' ): ?>
					<?=	anchor('admin/products/delete/'.$product->pro_id,'Delete',['class'=>'btn btn-danger btn-xs',
						'onclick'=>'return confirm(\'Are You Sure ? \')'
					]) ?>
					<?php else:?>
					<?=	anchor('admin/products/delete/','Delete',['class'=>'btn btn-danger btn-xs ','data-toggle'=>'button',
						'onclick'=>'return confirm(\'Sorry You Cant Delete it , Should Be Admin ! \')'
					]) ?>
					<?php endif;?>
					<?php endif;?>
				</div>-->
			</div>	
			<?php endforeach; ?>
		</div>

				
		
		<!-- /.row -->

		<!-- Features Section -->

		<!-- /.row -->

		<hr>

		<!-- Footer -->
		<?php $this->load->view('layout/footer')?>

	</div>
	<!-- /.container -->

	<!-- jQuery -->
	<script src="<?php echo base_url('/assets/js/jquery.js');?>"></script>
	
	<!-- Bootstrap Core JavaScript -->
	<script src="<?php echo base_url('/assets/js/bootstrap.min.js');?>"></script>

	<!-- Script to Activate the Carousel -->
	<script>
	$('.carousel').carousel({
		interval: 5000 //changes the speed
	})
	</script>

</body>

</html>
