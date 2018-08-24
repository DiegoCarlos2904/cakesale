<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shop Online</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('/assets/css/bootstrap.min.css');?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('/assets/css/modern-business.css');?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url('/assets/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">

	<script type="text/javascript" language="javascript" src="<?php echo base_url('/assets/js/jquery-1.10.2.min.js');?>"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url('/assets/js/jquery.dataTables.min.js');?>"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url('/assets/js/dataTables.bootstrap.js');?>"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/dataTables.bootstrap.css');?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <!-- Navigation Top_Menu -->
	<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark" role="navigation">
		<div class="container">
			<a class="navbar-brand" href="<?php echo base_url(); ?>">Cake Sale</a>
			<div class="collapse navbar-collapse" id="">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link <?= $this->uri->segment(2) == 'infantiles' ? 'active' : '' ?>" href="<?= base_url("/categoria/infantiles") ?>">Infatiles</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?= $this->uri->segment(2) == 'babyshower' ? 'active' : '' ?>" href="<?= base_url("/categoria/babyshower") ?>">Baby shower</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?= $this->uri->segment(2) == 'primeracomunion' ? 'active' : '' ?>" href="<?= base_url("/categoria/primeracomunion") ?>">Primera comunion</a>
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
					<?php  if($this->session->userdata('group')	==	'1'  or $this->session->userdata('group')	==	'2' ): ?>
						<li class="nav-item">
							<?php echo anchor('admin/products','Dashboard', ['class' => 'nav-link'] );?>
						</li>
					<?php endif;?>
					<?php if ($this->session->userdata('username')): ?>
					<li class="nav-item">
						<?php echo anchor('logout','Cerrar sesión', ['class' => 'nav-link'] );?>
						<?php else:?>
					</li>
					<li class="nav-item">
						<?php echo anchor('login','Iniciar sesión', ['class' => 'nav-link']);?>
						<?php endif;?>
					</li>							
					<?php  if($this->session->userdata('group')	!=	'1'  and $this->session->userdata('group')	!=	'2' ): ?>

					<?php endif;?>
					<li class="dropdown">
						<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"> Carrito <?= $this->cart->total_items(); ?> <i class="fa fa-shopping-cart"> </i> <b class="caret"> </b></a>
						<div class="dropdown-menu">
							<?php
								$url_cart	 = 'Carrito ';
								$url_cart	.=$this->cart->total_items().' <i class="fa fa-shopping-cart"></i></a>';
							?>
							<?= anchor('tienda/cart/cuenta',$url_cart, array( 'class' => 'dropdown-item' )); ?>
							<?php
							$url_order	 = 'Pagar';
							$url_order	.=' <i class="fa fa-cc-paypal"></i> '.' <i class="fa fa-credit-card"></i> '.' <i class="fa fa-cc-visa"></i></a> ';
							?>
							<?php if  ($this->cart->total_items()!=0):?>
							<?= anchor('order',$url_order, array( 'class' => 'dropdown-item' )); ?>
							<?php else:?>
							<?= anchor(base_url(),$url_order, array( 'class' => 'dropdown-item' )); ?>
							<?php endif ;?>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container pt-5">
		<h1><?= isset( $title ) ? $title : '' ?></h1>
		<hr>