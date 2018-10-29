jQuery( document ).ready( function ( $ ) {

	$(".onlyDecimal").keydown(function (event) {
		if (event.shiftKey == true) {
			event.preventDefault();
		}
		if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {
		} else {
			event.preventDefault();
		}
		if($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
			event.preventDefault();
	});

	$('.onlyNumbers').on('keydown', function(e){-1!==$.inArray(e.keyCode,[46,8,9,27,13,110])||(/65|67|86|88/.test(e.keyCode)&&(e.ctrlKey===true||e.metaKey===true))&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});

	$('.form-signin').validator();
	$('form').validator();

	
	$('.input-daterange').datepicker({
		format: "yyyy-mm-dd",
		language: "es",
		autoclose: true,
	});

	
	$('#tableList').DataTable( {
		"language": {
			"sProcessing":		"Procesando...",
			"sLengthMenu":		"Mostrar _MENU_ registros",
			"sZeroRecords":		"No se encontraron resultados",
			"sEmptyTable":		"Ningún dato disponible en esta tabla",
			"sInfo":			"Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty":		"Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":	"(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":		"",
			"sSearch":			"Buscar:",
			"sUrl":				"",
			"sInfoThousands":	",",
			"sLoadingRecords":	"Cargando...",
			"oPaginate":	{
				"sFirst":		"Primero",
				"sLast":		"Último",
				"sNext":		"Siguiente",
				"sPrevious":	"Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		}
	} );
} );