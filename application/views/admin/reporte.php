<?php $this->load->view('admin/header')?>
<div class="row">
	<div class="col-md-12">
		<h2 align="center" class="mb-4">Reporte - 
		<?php 
			switch ( $data_post['type'] ) {
				case 'ventas_productos':
					echo "Ventas de productos";
					break;
				
				case 'ventas_categorias':
					echo "Ventas por categorías";
					break;
				
				case 'pedidos':
					echo "Pedidos por cliente";
					break;
				
				case 'valoracion':
					echo "Valoración de tortas";
					break;
				default:
					break;
			}
		?> </h2>
		<script>
			document.title += ': ' + '<?= $data_post['date_from'] ?>' + ' a ' + '<?= $data_post['date_to'] ?>';
		</script>
		<div class="text-center">
			<div id="wrapChart_2" class="mb-4">
				<canvas id="myChart2" ></canvas>
			</div>
			<p><a href="#" id="downloadPdf" class="btn btn-primary">Descargar</a></p>
		</div>
		<?php if ( $data_post['type'] == 'ventas_productos' ): ?>
			<script>
				jQuery( window ).ready( function () {
					var data = <?= json_encode( $data_graf ); ?>;
					var data_chart = {
						type: 'line',
						data: {
							labels: [],
							datasets: [{
								label: 'Ventas de productos por cantidad',
								fill: false,
								data: [],
								borderColor: [
									'rgba(255, 99, 132, 1)',
								],
								backgroundColor: [
									'rgba(255, 99, 132, 1)',
									'rgba(54, 162, 235, 1)',
									'rgba(255, 206, 86, 1)',
									'rgba(75, 192, 192, 1)',
									'rgba(153, 102, 255, 1)',
									'rgba(255, 159, 64, 1)',
									'rgba(255, 99, 132, 1)',
									'rgba(54, 162, 235, 1)',
									'rgba(255, 206, 86, 1)',
									'rgba(75, 192, 192, 1)',
									'rgba(153, 102, 255, 1)',
									'rgba(255, 159, 64, 1)'
								],
								lineTension: 0,
							}],
						},
						options: {
							responsive: true,
							legend: {
								display: false,
								position: 'top',
							},
							title: {
								display: true,
								text: 'Ventas de productos por cantidad'
							},
							animation: {
								animateScale: true,
								animateRotate: true
							},
							scales: {
								yAxes: [{
									display: true,
									ticks: {
										min: 0,
									}
								}]
							}
						}
					};
					if( data ) {
						for (var key in data) {
							if (!data.hasOwnProperty(key)) continue;

							var obj = data[key];
							data_chart.data.labels.push( obj.name.substring(0, 20) ); 
							data_chart.data.datasets[0].data.push( obj.total ); 
						}
					}
					var ctx = document.getElementById("myChart2");
					var myChart = new Chart(ctx, data_chart);

					$('#downloadPdf').click(function(event) {
						// get size of report page
						var reportPageHeight = $('#wrapChart_2').innerHeight();
						var reportPageWidth = $('#wrapChart_2').innerWidth();
						
						// create a new canvas object that we will populate with all other canvas objects
						var pdfCanvas = $('<canvas />').attr({
							id: "canvaspdf",
							width: reportPageWidth,
							height: reportPageHeight
						});
						
						// keep track canvas position
						var pdfctx = $(pdfCanvas)[0].getContext('2d');
						var pdfctxX = 0;
						var pdfctxY = 0;
						var buffer = 100;
						
						// for each chart.js chart
						$("canvas").each(function(index) {
							// get the chart height/width
							var canvasHeight = $(this).innerHeight();
							var canvasWidth = $(this).innerWidth();
							
							// draw the chart into the new canvas
							pdfctx.drawImage($(this)[0], pdfctxX, pdfctxY, canvasWidth, canvasHeight);
							pdfctxX += canvasWidth + buffer;
							
							// our report page is in a grid pattern so replicate that in the new canvas
							if (index % 2 === 1) {
								pdfctxX = 0;
								pdfctxY += canvasHeight + buffer;
							}
						});
						
						// create new pdf and add our new canvas as an image
						var pdf = new jsPDF('l', 'pt', [reportPageWidth, reportPageHeight]);
						pdf.addImage($(pdfCanvas)[0], 'PNG', 0, 0);
						
						// download the pdf
						pdf.save('reporte.pdf');
					});
				} );
			</script>
			<div class="table-responsive">
				<table class="table table-striped table-hover" id="tableList">
					<thead>
						<tr>
							<th>Producto</th>
							<th>Productos vendidos</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($list as $key => $row ) : ?>
						<tr>
							<td><?= $row['nombre'] ?></td>
							<td><?= $row['qty'] ?></td>
							<td><?= $row['total'] ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		<?php endif ?>

		<?php if ( $data_post['type'] == 'pedidos' ): ?>
			<script>
				jQuery( window ).ready( function () {
					var data = <?= json_encode( $data_graf ); ?>;
					var data_chart = {
						type: 'bar',
						data: {
							labels: [],
							datasets: [{
								label: 'Pedidos por cliente',
								data: [],
								backgroundColor: [
									'rgba(255, 99, 132, 1)',
									'rgba(54, 162, 235, 1)',
									'rgba(255, 206, 86, 1)',
									'rgba(75, 192, 192, 1)',
									'rgba(153, 102, 255, 1)',
									'rgba(255, 159, 64, 1)',
									'rgba(255, 99, 132, 1)',
									'rgba(54, 162, 235, 1)',
									'rgba(255, 206, 86, 1)',
									'rgba(75, 192, 192, 1)',
									'rgba(153, 102, 255, 1)',
									'rgba(255, 159, 64, 1)'
								],
								lineTension: 0,
							}],
						},
						options: {
							responsive: true,
							legend: {
								display: false,
								position: 'top',
							},
							title: {
								display: false,
								text: 'Chart.js Doughnut Chart'
							},
							animation: {
								animateScale: true,
								animateRotate: true
							},
							scales: {
								yAxes: [{
									display: true,
									ticks: {
										min: 0,
									}
								}]
							}
						}
					};
					if( data ) {
						for (var key in data) {
							if (!data.hasOwnProperty(key)) continue;

							var obj = data[key];
							console.log( obj );
							data_chart.data.labels.push( obj.name ); 
							data_chart.data.datasets[0].data.push( obj.total ); 
						}
					}
					var ctx = document.getElementById("myChart2");
					var myChart = new Chart(ctx, data_chart);

					$('#downloadPdf').click(function(event) {
						// get size of report page
						var reportPageHeight = $('#wrapChart_2').innerHeight();
						var reportPageWidth = $('#wrapChart_2').innerWidth();
						
						// create a new canvas object that we will populate with all other canvas objects
						var pdfCanvas = $('<canvas />').attr({
							id: "canvaspdf",
							width: reportPageWidth,
							height: reportPageHeight
						});
						
						// keep track canvas position
						var pdfctx = $(pdfCanvas)[0].getContext('2d');
						var pdfctxX = 0;
						var pdfctxY = 0;
						var buffer = 100;
						
						// for each chart.js chart
						$("canvas").each(function(index) {
							// get the chart height/width
							var canvasHeight = $(this).innerHeight();
							var canvasWidth = $(this).innerWidth();
							
							// draw the chart into the new canvas
							pdfctx.drawImage($(this)[0], pdfctxX, pdfctxY, canvasWidth, canvasHeight);
							pdfctxX += canvasWidth + buffer;
							
							// our report page is in a grid pattern so replicate that in the new canvas
							if (index % 2 === 1) {
								pdfctxX = 0;
								pdfctxY += canvasHeight + buffer;
							}
						});
						
						// create new pdf and add our new canvas as an image
						var pdf = new jsPDF('l', 'pt', [reportPageWidth, reportPageHeight]);
						pdf.addImage($(pdfCanvas)[0], 'PNG', 0, 0);
						
						// download the pdf
						pdf.save('reporte.pdf');
					});
				} );
			</script>
			<div class="table-responsive">
				<table class="table table-striped table-hover" id="tableList">
					<thead>
						<tr>
							<th>Usuario</th>
							<th>Productos comprados</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($list as $key => $row ) : ?>
						<tr>
							<td><?= $row['nombre'] ?></td>
							<td><?= $row['count'] ?></td>
							<td><?= $row['total'] ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		<?php endif ?>

		<?php if ( $data_post['type'] == 'ventas_categorias' ): ?>
			<script>
				jQuery( window ).ready( function () {
					var data = <?= json_encode( $data_graf ); ?>;
					var data_chart = {
						type: 'horizontalBar',
						data: {
							labels: [],
							datasets: [{
								label: 'Ventas por categorías',
								data: [],
								backgroundColor: [
									'rgba(255, 99, 132, 1)',
									'rgba(54, 162, 235, 1)',
									'rgba(255, 206, 86, 1)',
									'rgba(75, 192, 192, 1)',
									'rgba(153, 102, 255, 1)',
									'rgba(255, 159, 64, 1)',
									'rgba(255, 99, 132, 1)',
									'rgba(54, 162, 235, 1)',
									'rgba(255, 206, 86, 1)',
									'rgba(75, 192, 192, 1)',
									'rgba(153, 102, 255, 1)',
									'rgba(255, 159, 64, 1)'
								],
								lineTension: 0,
							}],
						},
						options: {
							responsive: true,
							legend: {
								display: false,
								position: 'top',
							},
							title: {
								display: false,
								text: 'Chart.js Doughnut Chart'
							},
							animation: {
								animateScale: true,
								animateRotate: true
							},
							scales: {
								xAxes: [{
									display: true,
									ticks: {
										min: 0,
									}
								}]
							}
						}
					};
					if( data ) {
						for (var key in data) {
							if (!data.hasOwnProperty(key)) continue;

							var obj = data[key];
							console.log( obj );
							data_chart.data.labels.push( obj.name ); 
							data_chart.data.datasets[0].data.push( obj.total ); 
						}
					}
					var ctx = document.getElementById("myChart2");
					var myChart = new Chart(ctx, data_chart);

					$('#downloadPdf').click(function(event) {
						// get size of report page
						var reportPageHeight = $('#wrapChart_2').innerHeight();
						var reportPageWidth = $('#wrapChart_2').innerWidth();
						
						// create a new canvas object that we will populate with all other canvas objects
						var pdfCanvas = $('<canvas />').attr({
							id: "canvaspdf",
							width: reportPageWidth,
							height: reportPageHeight
						});
						
						// keep track canvas position
						var pdfctx = $(pdfCanvas)[0].getContext('2d');
						var pdfctxX = 0;
						var pdfctxY = 0;
						var buffer = 100;
						
						// for each chart.js chart
						$("canvas").each(function(index) {
							// get the chart height/width
							var canvasHeight = $(this).innerHeight();
							var canvasWidth = $(this).innerWidth();
							
							// draw the chart into the new canvas
							pdfctx.drawImage($(this)[0], pdfctxX, pdfctxY, canvasWidth, canvasHeight);
							pdfctxX += canvasWidth + buffer;
							
							// our report page is in a grid pattern so replicate that in the new canvas
							if (index % 2 === 1) {
								pdfctxX = 0;
								pdfctxY += canvasHeight + buffer;
							}
						});
						
						// create new pdf and add our new canvas as an image
						var pdf = new jsPDF('l', 'pt', [reportPageWidth, reportPageHeight]);
						pdf.addImage($(pdfCanvas)[0], 'PNG', 0, 0);
						
						// download the pdf
						pdf.save('reporte.pdf');
					});
				} );
			</script>
			<div class="table-responsive">
				<table class="table table-striped table-hover" id="tableList">
					<thead>
						<tr>
							<th>Categoría</th>
							<th>Productos vendidos</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($list as $key => $row ) : ?>
						<tr>
							<td><?= $row['nombre'] ?></td>
							<td><?= $row['qty'] ?></td>
							<td><?= $row['total'] ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		<?php endif ?>

		<?php if ( $data_post['type'] == 'valoracion' ): ?>
			<script>
				jQuery( window ).ready( function () {
					var data = <?= json_encode( $data_graf ); ?>;
					var data_chart = {
						type: 'horizontalBar',
						data: {
							labels: [],
							datasets: [{
								label: 'Valoración de tortas',
								data: [],
								backgroundColor: [
									'rgba(255, 99, 132, 1)',
									'rgba(54, 162, 235, 1)',
									'rgba(255, 206, 86, 1)',
									'rgba(75, 192, 192, 1)',
									'rgba(153, 102, 255, 1)',
									'rgba(255, 159, 64, 1)',
									'rgba(255, 99, 132, 1)',
									'rgba(54, 162, 235, 1)',
									'rgba(255, 206, 86, 1)',
									'rgba(75, 192, 192, 1)',
									'rgba(153, 102, 255, 1)',
									'rgba(255, 159, 64, 1)'
								],
								lineTension: 0,
							}],
						},
						options: {
							responsive: true,
							legend: {
								display: false,
								position: 'top',
							},
							title: {
								display: false,
								text: 'Chart.js Doughnut Chart'
							},
							animation: {
								animateScale: true,
								animateRotate: true
							},
							scales: {
								xAxes: [{
									display: true,
									ticks: {
										min: 0,
									}
								}]
							}
						}
					};
					if( data ) {
						for (var key in data) {
							if (!data.hasOwnProperty(key)) continue;

							var obj = data[key];
							console.log( obj );
							data_chart.data.labels.push( obj.name ); 
							data_chart.data.datasets[0].data.push( obj.total ); 
						}
					}
					var ctx = document.getElementById("myChart2");
					var myChart = new Chart(ctx, data_chart);

					$('#downloadPdf').click(function(event) {
						// get size of report page
						var reportPageHeight = $('#wrapChart_2').innerHeight();
						var reportPageWidth = $('#wrapChart_2').innerWidth();
						
						// create a new canvas object that we will populate with all other canvas objects
						var pdfCanvas = $('<canvas />').attr({
							id: "canvaspdf",
							width: reportPageWidth,
							height: reportPageHeight
						});
						
						// keep track canvas position
						var pdfctx = $(pdfCanvas)[0].getContext('2d');
						var pdfctxX = 0;
						var pdfctxY = 0;
						var buffer = 100;
						
						// for each chart.js chart
						$("canvas").each(function(index) {
							// get the chart height/width
							var canvasHeight = $(this).innerHeight();
							var canvasWidth = $(this).innerWidth();
							
							// draw the chart into the new canvas
							pdfctx.drawImage($(this)[0], pdfctxX, pdfctxY, canvasWidth, canvasHeight);
							pdfctxX += canvasWidth + buffer;
							
							// our report page is in a grid pattern so replicate that in the new canvas
							if (index % 2 === 1) {
								pdfctxX = 0;
								pdfctxY += canvasHeight + buffer;
							}
						});
						
						// create new pdf and add our new canvas as an image
						var pdf = new jsPDF('l', 'pt', [reportPageWidth, reportPageHeight]);
						pdf.addImage($(pdfCanvas)[0], 'PNG', 0, 0);
						
						// download the pdf
						pdf.save('reporte.pdf');
					});
				} );
			</script>
			<div class="table-responsive">
				<table class="table table-striped table-hover" id="tableList">
					<thead>
						<tr>
							<th>Producto</th>
							<th>Puntuaciones</th>
							<th>Promedio</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($list as $key => $row ) : ?>
						<tr>
							<td><?= $row['nombre'] ?></td>
							<td><?= $row['total'] ?></td>
							<td><?= $row['avg_comment'] ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		<?php endif ?>
	</div>
</div>
<?php $this->load->view('admin/footer')?>