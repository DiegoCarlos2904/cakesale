<!-- Navigation Top_Menu -->


	<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark" role="navigation">
		<div class="container">
			<a class="navbar-brand" href="<?php echo base_url(); ?>"><?php foreach($get_sitename as $sitename):?><?=  $sitename->all_value_settings;?><?php endforeach;?></a>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
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
					<?php echo anchor('admin/invoices','Invoices List');?>
					</li>
					<li class="nav-item">
						<?php echo anchor('admin/products/reports','Product Report');?>
					</li>
					<li class="nav-item">
						<?php echo anchor('admin/products','Dashboard');?>
						<?php endif;?>
					</li>
						<?php if ($this->session->userdata('group')=='3'): ?>
					<li class="nav-item">
						<?php echo anchor('customer/payment_confirmation','Payment Confirmation');?>
					</li>
					<li class="nav-item">
						<?php echo anchor('customer/shopping_history','History');?>
					</li>
						<?php endif;?>
						
					<?php if ($this->session->userdata('username')): ?>
					<li class="nav-item">
						
						<?php echo ('<a>'.'Hola : '.$this->session->userdata('username').'</a>'); ?>
					</li>
					
					<li class="nav-item">
						<?php echo anchor('logout','Logout');?>
						<?php else:?>
					</li>
					<li class="nav-item">
						<?php //echo anchor('login','Iniciar sesión / Crear cuenta');?>
						<?php endif;?>
					</li>							
					<?php  if($this->session->userdata('group')	!=	'1'  and $this->session->userdata('group')	!=	'2' ): ?>

					<li class="dropdown">
						<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"> Carrito <?= $this->cart->total_items(); ?> <i class="fa fa-shopping-cart"> </i> <b class="caret"> </b></a>
						<div class="dropdown-menu">
							<?php
								$url_cart	 = 'Carrito ';
								$url_cart	.=$this->cart->total_items().' <i class="fa fa-shopping-cart"></i></a>';
							?>
							<?= anchor('home/cart',$url_cart, array( 'class' => 'dropdown-item' )); ?>
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
					<?php endif;?>
				</ul>
			</div>
		</div>
	</nav>
