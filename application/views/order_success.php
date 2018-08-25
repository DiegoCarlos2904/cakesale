    <?php $this->load->view('header')?>
        <div class="row">
             <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-body" >
						<div class="row">
							<div class="col-md-8">
							<blockquote><h3  ><mark>Gracias, Su pedido se está procesando</mark> </h3></blockquote>
							</div>
							<div class="col-md-2">
							<?=  anchor(base_url(),'Regresar a la página principal ',['class'=>'btn btn-default','role'=>'button']) ?>
							</div>
								
						</div>  
						<hr>
						<div class="col-md-4"></div>
						
						<div class="col-md-2"></div>
                    </div>
                </div>
            </div>  
			
        </div>
        <?php $this->load->view('footer')?>