			</div>
		</main>
		<footer>
			<div class="container">
				<p class="mb-0 float-right">
					<a href="#">Subir</a>
				</p>
				<p class="mb-0">Cake Sale <?= date('Y') ?></p>
			</div>
		</footer>
	</div>
	<script src="<?php echo base_url('/assets/js/jquery.js');?>"></script>
	<script src="<?php echo base_url('/assets/js/bootstrap.min.js');?>"></script>
	<script src="<?php echo base_url('/assets/js/validator.min.js');?>"></script>
	<script src="<?php echo base_url('/assets/js/front.js');?>"></script>
	<script>
		$('.carousel').carousel({
			interval: 5000 //changes the speed
		});
	</script>
</body>
</html>
