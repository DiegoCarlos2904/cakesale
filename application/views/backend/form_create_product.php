		<?php $this->load->view('layout/header')?>
			<div class="row">
				<!-- body items -->
	
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4>
								<i class="fa fa-fw fa-compass"></i> Products <?=  anchor('admin/products/create','Add New Product',['class'=>'btn btn-primary btn-xs']) ?>
							</h4>
						</div><!-- /..panel-heading -->
						<div class="panel-body">
						<div><?= validation_errors()?></div>
						<?=  form_open_multipart('admin/products/create',['class'=>'form-group']) ?>
							<div class="col-sm-4">
								<div class="input-group">
									<div class="input-group-addon">Title</div>
									<input type="text" class="form-control" name="pro_title" placeholder="Enter Product Title" value="<?= set_value('pro_title') ?>">
								</div>
							</div>
						
							<div class="input-group-addon">Description</div>
							<div class="col-sm-4">
								<div class="input-group col-sm-12">
									<textarea rows="4" class="form-control" name="pro_description" placeholder="Enter Product Description , Example : Dell INSPIRON Ram:2GB , AVG : 1 , CPU : 3200 Intel Core i5"><?= set_value('pro_description') ?></textarea>
								</div>
							</div>
							<div class="col-sm-12"><hr></div>
							<div class="col-sm-3">
								<div class="input-group">
									<div class="input-group-addon">Price</div>
									<input type="text" class="form-control" name="pro_price" placeholder="Enter Product Price" value="<?= set_value('pro_price') ?>">
									<div class="input-group-addon">$</div>
								</div>
							</div>
							
							<div class="col-sm-3">
								<div class="input-group">
									<div class="input-group-addon">Available Stock</div>
									<input type="text" class="form-control" name="pro_stock" value="<?= set_value('pro_stock') ?>">
								</div>
							</div>
							
							<div class="col-sm-3">
								<div class="input-group">
									<input type="file" name="userfile">
								</div>
							</div>
							
							<div class="col-sm-1">
								<div class="input-group">
									<button type="submit" class="btn btn-primary">Create</button>
								</div>
							</div>
							<div class="col-sm-1">
								<div class="input-group">
									
									<?=  anchor('admin/products','Cancel',['class'=>'btn btn-danger']) ?>
								</div>
							</div>
							
						
						<?= form_close() ?>
						</div><!-- /..panel-body -->
					</div><!-- /..panel panel-default -->
				</div> 
				
			</div>
			<!-- /.row -->
			<hr>
			<!-- Footer -->
			<?php $this->load->view('layout/footer')?>