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
	<link href="<?php echo base_url('/assets/css/bootstrap-datepicker3.min.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('/assets/css/back.css');?>" rel="stylesheet">
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
						<a class="nav-link <?= $this->uri->segment(2) == 'usuarios' ? 'active' : '' ?>" href="<?= base_url("/admin/usuarios") ?>">Usuarios</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?= $this->uri->segment(2) == 'productos' ? 'active' : '' ?>" href="<?= base_url("/admin/productos") ?>">Productos</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?= $this->uri->segment(2) == 'disena_producto' ? 'active' : '' ?>" href="<?= base_url("/admin/disena_producto") ?>">Diseños solicitados</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?= $this->uri->segment(2) == 'categorias' ? 'active' : '' ?>" href="<?= base_url("/admin/categorias") ?>">Categorías</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?= $this->uri->segment(2) == 'pedidos' ? 'active' : '' ?>" href="<?= base_url("/admin/pedidos") ?>">Pedidos</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?= $this->uri->segment(2) == 'reportes' ? 'active' : '' ?>" href="<?= base_url("/admin/reportes") ?>">Reportes</a>
					</li>
				</ul>
				<ul class="navbar-nav">
					<li class="nav-item">
						<a href="<?= base_url( '' ) ?>" class="nav-link">Tienda</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url( 'logout' ) ?>" class="nav-link">Cerrar sesión</a>
					</li>
				</ul>
			</div>
		</div>
	</header>
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