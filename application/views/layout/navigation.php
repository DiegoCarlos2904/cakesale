<!-- Navigation Top_Menu -->


	<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark" role="navigation">
		<div class="container">
			<a class="navbar-brand" href="<?php echo base_url(); ?>"><?php foreach($get_sitename as $sitename):?><?=  $sitename->all_value_settings;?><?php endforeach;?></a>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="">Infatiles</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="">Baby shower</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="">Primera comunion</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="">Matrimonio</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="">Deportivas</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="">Despedidas</a>
					</li>
					<li class="dropdown">
						<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Años <b class="caret"> </b></a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="">15 años</a>
							<a class="dropdown-item" href="">18 años</a>
							<a class="dropdown-item" href="">50 años</a>
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
						
						<?php echo ('<a>'.'You Are : '.$this->session->userdata('username').'</a>'); ?>
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
						<ul class="dropdown-menu">
						
							<li class="nav-item">
								<?php
									$url_cart	 = 'Carrito ';
									$url_cart	.=$this->cart->total_items().' <i class="fa fa-shopping-cart"></i></a>';
								?>
								<?= anchor('home/cart',$url_cart); ?>
								
							</li>
							<li class="nav-item">
									<?php
									$url_order	 = 'Check Out';
									$url_order	.=' <i class="fa fa-cc-paypal"></i> '.' <i class="fa fa-credit-card"></i> '.' <i class="fa fa-cc-visa"></i></a> ';
									?>
									<?php if  ($this->cart->total_items()!=0):?>
									<?= anchor('order',$url_order); ?>
									<?php else:?>
									<?= anchor(base_url(),$url_order); ?>
									<?php endif ;?>
							</li>
						</ul>
					</li>
					<?php endif;?>
				</ul>
			</div>
		</div>
	</nav>
