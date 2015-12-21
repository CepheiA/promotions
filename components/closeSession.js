$(document).ready(function(e) {
	
	
	$("#btnEnviar").click(function(e) {
		if(idC !== 0){
			if($("#txfRut").validarRut() !== false){
				if($("#txfClave").val() !== ""){
					var data = {
						idColegio       :  idC,
						rut 			:  $("#txfRut").val(),
						clave 		 	:  $("#txfClave").val(),
						nombrecolegio   : 	nameC
						
					};
					$.ajax({
						url: './validar_alumno/',
						type: 'POST',
						data: data

					})
					.done(function(data) {
						data = $.trim(data);
						if(data === "ok"){
							$.fn.setCoockie("IDC",idC,300);
							$.fn.setCoockie("NC",nameC,300);
							window.location = "./home/";  

						}else{
							if(resp.trim()=="error"){
								alertify.error('Clave o Rut incorrectos').dismissOthers();
								$.fn.mostrarMensaje("Clave o Rut incorrectos",false,"top-right","warning",2000);
							}else{
								$.fn.mostrarMensaje("'Ha ocurrido un error inesperado'",false,"top-right","warning",2000);
								
							}
							
						}
					})
					.error(function(data) {
						alertify.error('Ha ocurrido un error inesperado').dismissOthers(); 
					});
				}else{
					$.fn.mostrarMensaje("Debe ingresar su clave",false,"top-right","warning",3000);   
					$("#txfClave").val("");
					$("#txfClave").focus();
				}
			}else{
				$.fn.mostrarMensaje("Debe ingresar un rut correcto",false,"top-right","warning",3000);   
				$("#txfRut").val("");
				$("#txfRut").focus();
			}
		}else{
			$.fn.mostrarMensaje("Debe seleccionar un colegio",false,"top-right","warning",3000);   
			$("#txfColegio").val("");
			$("#txfColegio").focus();
		}
	});

$("#txfRut").focus();
});