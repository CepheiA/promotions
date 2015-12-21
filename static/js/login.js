// JavaScript Document
$(document).ready(function(e) {
	alertify.confirm().setting('labels', {
		ok: 'Ok',
		cancel: 'Cancelar'
	});
	alertify.confirm().setting('title', 'Precaución');
	alertify.prompt().setting('title', 'Precaución');

	$("#password").keypress(function(e) {
		if(e.which == 13) {
			if($("#password").val().trim() !== "" && $("#rut").val().trim() !==""){
				$("#btnValidar").click();
			}
		}
	});
	$("#rut").keypress(function(e) {
		if(e.which == 13) {
			$("#btnValidar").click();
		}
	});

	$("#rut").blur(function(){
		if($(this).val().trim() !== ""){
			$(this).validarRut();
		}
	});
	$("#formLogin").submit(function(event) {
		event.preventDefault();
	});
	
	$("#btnValidar").click(function(e) {
		if($("#rut").validarRut()!== false){
			if($("#password").val().trim() !== ""){  				
				$.ajax({
					url:"./validar_usuario/",
					type:'POST',
					data: {
						rut: $("#rut").val(),
						passwd: $("#password").val()
					},
					beforeSend: function(){
						
					},
					success: function(resp){
						if(resp.trim()=="ok"){
							window.location = "../admin/inicio/";
						}else{
							if(resp.trim()=="error"){
								alertify.error("El usuario y/o clave no son correctos");
							}else{
								alertify.error("Ha ocurrido un error | detalle : " + resp);
								
							}
						}
					}

				});
				

			}else{
				alertify.error("Debe ingresar su clave",false,"top-right","warning",3000);   
				$("#password").val("");
				$("#password").focus();
			}
		}else{
			alertify.error("Debe ingresar un rut correcto",false,"top-right","warning",3000);   
			$("#rut").val("");
			$("#rut").focus();
		}

	});


});