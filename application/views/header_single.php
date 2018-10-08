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