        <?php $this->load->view('layout/header')?>
        <div class="row">
                        <!-- body items -->
            <!-- load products from table -->
             <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-body" >
						<div class="col-md-12">
							<?= validation_errors() ?>
							<div class="col-md-3"><?= $this->session->flashdata('error') ?></div>
							<div class="col-md-6">
							<?= form_open('login') ?>
								<div class="form-group">
									<label for="username">Nombre de usuario: </label>
									<input type="text" class="form-control" name="username" >
								</div>
								<div class="form-group">
									<label for="password">Contraseña: </label>
									<input type="password" class="form-control" name="password" >
								</div>
								<div class="form-group">
								<div class="col-md-2"></div>
								<div class="col-md-7">
									<button type="submit" class="btn btn-success">Login</button>
									<?=  anchor(base_url(),'Cancel',['class'=>'btn']) ?>
									
									</div>
								<div class="col-md-3">
									<?=  anchor('register','Register',['class'=>'btn btn-default']) ?>
								</div>
								</div>
							<?= form_close() ?>
							</div>
							<div class="col-md-3"></div>	
						</div>  
						
                    </div>
					
					
                </div>
            </div>  
			
        </div>

        <hr>

        <?php $this->load->view('layout/footer')?>