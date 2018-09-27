<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Cake sale</title>
	<link href="<?php echo base_url('/assets/css/bootstrap.min.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('/assets/css/front.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('/assets/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">
	<script type="text/javascript" language="javascript" src="<?php echo base_url('/assets/js/jquery-1.10.2.min.js');?>"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url('/assets/js/jquery.dataTables.min.js');?>"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url('/assets/js/dataTables.bootstrap.js');?>"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/dataTables.bootstrap.css');?>">

</head>

<body>
	<header class="navbar navbar-expand-lg navbar-light flex-column flex-md-row bd-navbar bg-white">
		<div class="container">
			<a class="navbar-brand mr-0 mr-md-4 p-0" href="/" aria-label="Bootstrap">
				<img src="<?= base_url('assets/img/logo.jpg') ?>" style="width: 39px; ">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link <?= $this->uri->segment(2) == 'infantiles' ? 'active' : '' ?>" href="<?= base_url("/categoria/infantiles") ?>">Infatiles</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?= $this->uri->segment(2) == 'baby-shower' ? 'active' : '' ?>" href="<?= base_url("/categoria/baby-shower") ?>">Baby shower</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?= $this->uri->segment(2) == 'primeracomunion' ? 'active' : '' ?>" href="<?= base_url("/categoria/primera-comunion") ?>">Primera comunion</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?= $this->uri->segment(2) == 'matrimonio' ? 'active' : '' ?>" href="<?= base_url("categoria/matrimonio") ?>">Matrimonio</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?= $this->uri->segment(2) == 'desportivas' ? 'active' : '' ?>" href="<?= base_url("/categoria/desportivas") ?>">Deportivas</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?= $this->uri->segment(2) == 'despedidas' ? 'active' : '' ?>" href="<?= base_url("/categoria/despedidas") ?>">Despedidas</a>
					</li>
					<li class="dropdown">
						<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Años <b class="caret"> </b></a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="<?= base_url("/categoria/15-anos") ?>">15 años</a>
							<a class="dropdown-item" href="<?= base_url("/categoria/18-anos") ?>">18 años</a>
							<a class="dropdown-item" href="<?= base_url("/categoria/50-anos") ?>">50 años</a>
						</div>
					</li>
				</ul>
				<ul class="navbar-nav">
					<?php if ( $this->session && $this->session->userdata && ! empty( $this->session->userdata['usr_id'] ) ): ?>
						<?php	if($this->session->userdata['usr_group'] ==	'1'	or $this->session->userdata['usr_group']	==	'2' ): ?>
							<li class="nav-item">
								<a href="<?= base_url( 'admin') ?>" class="nav-link">Dashboard</a>
							</li>
						<?php endif ?>
					<?php else: ?>
						<li class="nav-item">
							<a href="<?= base_url( 'login') ?>" class="nav-link">Iniciar sesión</a>
						</li>
					<?php endif ?>
					<li class="dropdown">
						<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"> Carrito <?= $this->cart->total_items(); ?> <i class="fa fa-shopping-cart"></i></a>
						<div class="dropdown-menu">
							<a href="<?= base_url( 'tienda/carrito') ?>" class="dropdown-item">Carrito <?= $this->cart->total_items(); ?> <i class="fa fa-shopping-cart"></i></a>
							<?php if ( $this->session && $this->session->userdata && ! empty( $this->session->userdata['usr_id'] ) ): ?>
								<a href="<?= base_url( 'cuenta') ?>" class="dropdown-item">Mi cuenta</a>
								<a href="<?= base_url( 'cuenta/pedidos') ?>" class="dropdown-item">Mis pedidos</a>
							<?php endif ?>
							<?php if ( $this->cart->total_items() != 0 ) : ?>
								<a href="<?= base_url( 'tienda/finalizar_compra') ?>" class="dropdown-item">Pagar <i class="fa fa-cc-paypal"></i> <i class="fa fa-credit-card"></i> <i class="fa fa-cc-visa"></i></a>
							<?php else: ?>
								<a href="<?= base_url( '') ?>" class="dropdown-item">Pagar <i class="fa fa-cc-paypal"></i> <i class="fa fa-credit-card"></i> <i class="fa fa-cc-visa"></i></a>
							<?php endif ;?>
							<?php if ( $this->session && $this->session->userdata && ! empty( $this->session->userdata['usr_id'] ) ): ?>
								<a href="<?= base_url( 'logout') ?>" class="dropdown-item">Cerrar sesión</a>
							<?php endif ;?>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</header>
	<?php if ( !isset( $hide_slider ) || !$hide_slider ): ?>
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			</ol>
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img src="http://cakesale.pe/upload/50.png" class="d-block w-100 img-responsive">
				</div>

			</div>
			<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	<?php endif ?>
	<main class="main pb-5">
		<div class="container pt-4">
			<?php if ( isset( $title ) && $title ): ?>
				<h1><?= $title ?></h1>
				<hr>
			<?php endif ?>
			<?php if($this->session->flashdata('log_success')){?>
				<div class="alert alert-success">
					<?php echo $this->session->flashdata('log_success');?>
				</div>
			<?php }?>
			<?php if($this->session->flashdata('log_error')){?>
				<div class="alert alert-danger">
					<?php echo $this->session->flashdata('log_error');?>
				</div>
			<?php }?>