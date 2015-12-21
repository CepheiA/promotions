var startDate = "";
var endDate   = "";
var idPromotion = 0;
var DateRangePicker = null;
function validateFields(){
	if($("#name").val().trim() === ""){
		alertify.error("Debe ingresar un nombre a la promoción");
		return false;
	}

	if($("#type").val().trim() === ""){
		alertify.error("Debe selecionar un tipo");
		return false;
	}

	if($("#type").val().trim() === "SPECIES" && $("#description").val().trim() === ""){
		alertify.error("Debe ingresar una descripción");
		return false;
	}

	if(startDate === "" || endDate === ""){
		alertify.error("Debe selecionar un rango de fecha para la promoción");
		return false;
	}

	return true;
}
function loadTable(){
	$.ajax({
		url:"./cargar_tabla/",
		type:'POST',
		data: {
		},
		beforeSend: function(){

		},
		success: function(resp){
			$("#table").html(resp);
		}

	});
}
function upload(id,name,type,description,sDate,eDate){
	idPromotion = id;
	$("#name").val(name);
	$("#type").val(type);
	$("#description").val(description);
	startDate = sDate;
	endDate   = eDate;
	$('#rangeDate').val(sDate + " - " + eDate);
	$("#rangeDate" ).data('daterangepicker').startDate = moment(sDate, "DD-MM-YYYY" );
	$("#rangeDate" ).data('daterangepicker').endDate = moment(eDate, "DD-MM-YYYY" );
	$("#rangeDate" ).data('daterangepicker').updateView();
	$("#rangeDate" ).data('daterangepicker').updateCalendars();

}
function removePromotion(idP){
	alertify.confirm("¿Está seguro(a) de <b>eliminar</b> la promoción seleccionada?").setting("onok", function() {
		$.ajax({
			url:"./eliminar/",
			type:'POST',
			data: {
				id:idP
			},
			beforeSend: function(){

			},
			success: function(resp){
				if(resp.trim()=="ok"){
					alertify.success("Promoción eliminada con éxito");
				}else{
					if(resp.trim()=="error"){
						alertify.error("Ha ocurrio un error inesperado");
					}else{
						alertify.error("Ha ocurrido un error | detalle : " + resp);

					}
				}
				loadTable();
			}
		});
	});
}
function initRageDate(){
	DateRangePicker = $('#rangeDate').daterangepicker({
		"locale": {
			"format": "DD-MM-YYYY",
			"separator": " - ",
			"applyLabel": "Guardar",
			"cancelLabel": "Cancelar",
			"fromLabel": "Desde",
			"toLabel": "Hasta",
			"customRangeLabel": "Personalizar",
			"daysOfWeek": [
			"Dom",
			"Lun",
			"Mar",
			"Mie",
			"Jue",
			"Vie",
			"Sab"
			],
			"monthNames": [
			"Enero",
			"Febrero",
			"Marzo",
			"Abril",
			"Mayo",
			"Junio",
			"Julio",
			"Agosto",
			"Septiembre",
			"Octubre",
			"Noviembre",
			"Diciembre"
			],
			"firstDay": 1
		}
	}, function(start, end, label) {
		startDate = start.format('YYYY-MM-DD');
		endDate   = end.format('YYYY-MM-DD');
	});
}
$(document).ready(function(e) {
	$("#descriptionContainer").hide();
	loadTable();
	initRageDate();
	$("#type").change(function(event) {
		if($(this).val() === "SPECIES"){
			$("#descriptionContainer").show();
		}else{
			$("#descriptionContainer").hide();
		}
	});

	$("#btnGuardar").click(function(event) {
		if(validateFields()){
			var path = (idPromotion > 0)?"actualizar/":"ingresar/";
			$.ajax({
				url:"./"+path,
				type:'POST',
				data: {
					id:idPromotion,
					name: $("#name").val(),
					type: $("#type").val(),
					description : $("#description").val(),
					startDate: startDate,
					endDate: endDate
				},
				beforeSend: function(){

				},
				success: function(resp){
					if(resp.trim()=="ok"){
						alertify.success("Promoción guardada con éxito");
					}else{
						if(resp.trim()=="error"){
							alertify.error("Ha ocurrio un error inesperado");
						}else{
							alertify.error("Ha ocurrido un error | detalle : " + resp);

						}
					}
					loadTable();
				}

			});
		}

	});


	
});