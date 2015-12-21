jQuery.fn.extend({
	initTable: function(selector,boolFilters){
		var  visibilityColumnsExport = [];
		$(selector+" tr:first th").each(function(index,value){
			visibilityColumnsExport.push(index);			
		});

		/*elimino la última columna que representa el botón "acción"*/
		visibilityColumnsExport.pop();
		
		if(!$.fn.dataTable.isDataTable(selector)){
			var table=$(selector).dataTable({
				dom: 'Bfrtip',
				buttons: [
				{
					extend: 'pdfHtml5',
					orientation: 'landscape',
					pageSize: 'LEGAL',
					title: $(selector).attr("data-title"),
					exportOptions: {
						columns: visibilityColumnsExport
					}
				},
				{
					title:$(selector).attr("data-title"),
					extend: 'copyHtml5',
					exportOptions: {
						columns: visibilityColumnsExport
					}
				},
				{
					title:$(selector).attr("data-title"),
					extend: 'excelHtml5',
					exportOptions: {
						columns: visibilityColumnsExport
					}
				},
				{
					title:$(selector).attr("data-title"),
					extend: 'csvHtml5',
					exportOptions: {
						columns: visibilityColumnsExport
					}
				},
				{
					title:$(selector).attr("data-title"),
					text:'Imprimir',
					extend: 'print',
					exportOptions: {
						columns: visibilityColumnsExport
					}
				}
				],
				"bPaginate":boolFilters,
				"bFilter": boolFilters,
				"bSort": false,
				"bStateSave": false,
				"bAutoWidth": boolFilters,
				"lengthChange": boolFilters,
				"bInfo": boolFilters,
				"aLengthMenu": [[10,25,50,100,200, -1], [10,25,50,100,200, "All"]],
				"iDisplayLength": 50,			
				"language": {
					"url":$("#hdnDots").val() + "/components/dataTables/Spanish.json"
				}
			}); 		

$(selector).on( 'click', 'tr', function () {
	if ( $(this).hasClass('selected') ) {
		$(this).removeClass('selected');
	}
	else {
		table.$('tr.selected').removeClass('selected');
		$(this).addClass('selected');
	}
});

}		
},
previsualizarImagen: function(evt,selector) {
	var files = evt.target.files;

	for (var i = 0, f; f = files[i]; i++) {

		if (!f.type.match('image.*')) {
			continue;
		}
		var reader = new FileReader();
		reader.onload = (function(theFile) {
			return function(e) {
				$(selector).prop("src",e.target.result);
			};
		})(f);
		reader.readAsDataURL(f);
	}
},
validarRut: function(){
	var rut = $(this).val();
	var tmpstr = "";
	for (i = 0; i < rut.length; i++)
		if (rut.charAt(i) != ' ' && rut.charAt(i) != '.' && rut.charAt(i) != '-')
			tmpstr = tmpstr + rut.charAt(i);
		rut = tmpstr;
		largo = rut.length;
			// [VARM+]
			tmpstr = "";
			for (i = 0; rut.charAt(i) == '0'; i++);
				for (; i < rut.length; i++)
					tmpstr = tmpstr + rut.charAt(i);
				rut = tmpstr;
				largo = rut.length;
			// [VARM-]
			if (largo < 2) {
				//alert("Debe ingresar el rut completo.");

				return false;
			}
			for (i = 0; i < largo; i++) {
				if (rut.charAt(i) != "0" && rut.charAt(i) != "1" && rut.charAt(i) != "2" && rut.charAt(i) != "3" && rut.charAt(i) != "4" && rut.charAt(i) != "5" && rut.charAt(i) != "6" && rut.charAt(i) != "7" && rut.charAt(i) != "8" && rut.charAt(i) != "9" && rut.charAt(i) != "k" && rut.charAt(i) != "K") {
					//alert("El valor ingresado no corresponde a un R.U.T valido.");

					return false;
				}
			}
			var invertido = "";
			for (i = (largo - 1), j = 0; i >= 0; i--, j++)
				invertido = invertido + rut.charAt(i);
			var drut = "";
			drut = drut + invertido.charAt(0);
			drut = drut + '-';
			cnt = 0;
			for (i = 1, j = 2; i < largo; i++, j++) {
				if (cnt == 3) {
					drut = drut + '.';
					j++;
					drut = drut + invertido.charAt(i);
					cnt = 1;
				} else {
					drut = drut + invertido.charAt(i);
					cnt++;
				}
			}
			invertido = "";
			for (i = (drut.length - 1), j = 0; i >= 0; i--, j++)
				invertido = invertido + drut.charAt(i);
			//document.frm.rut_aux.value = invertido;
			if (this.checkDV(rut)){
				$(this).val(invertido);
				return true;
			}else{
				
				$(this).val('');
				$(this).focus();
				return false;
			}
		},
		checkDV: function(crut){
			largo = crut.length;
			if (largo < 2) {
        //alert("Debe ingresar el rut completo.");

        return false;
    }
    if (largo > 2)
    	rut = crut.substring(0, largo - 1);
    else
    	rut = crut.charAt(0);
    dv = crut.charAt(largo - 1);
    this.checkCDV(dv);
    if (rut == null || dv == null)
    	return 0;
    var dvr = '0';
    suma = 0;
    mul = 2;
    for (i = rut.length - 1; i >= 0; i--) {
    	suma = suma + rut.charAt(i) * mul;
    	if (mul == 7)
    		mul = 2;
    	else
    		mul++;
    }
    res = suma % 11;
    if (res == 1)
    	dvr = 'k';
    else if (res == 0)
    	dvr = '0';
    else {
    	dvi = 11 - res;
    	dvr = dvi + "";
    }
    if (dvr != dv.toLowerCase()) {
				//alert("EL rut es incorrecto.");

				return false;
			}
			return true;

			
		},
		checkCDV: function(dvr) {
			dv = dvr + "";
			if (dv != '0' && dv != '1' && dv != '2' && dv != '3' && dv != '4' && dv != '5' && dv != '6' && dv != '7' && dv != '8' && dv != '9' && dv != 'k' && dv != 'K') {
        // alert("Debe ingresar un digito verificador valido.");

        return false;
    }
    return true;
},
getUrlVars: function () {
	var vars = {};
	var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
		vars[key] = value;
	});
	return vars;
},
validarTexto: function (){
	var texto = $(this).val();
	var pattern = /^[-_\w\.\ \u00e1\u00e9\u00ed\u00f3\u00fa\u00c1\u00c9\u00cd\u00d3\u00da\u00f1\u00d1\u00FC\u00DC]+$/;

	if(pattern.test(texto)){
		return true;
	}else{			
		$(this).val('');
		$(this).focus();
		return false;	
	}

},
validarCorreo: function (){
	var correo = $(this).val();
	var pattern = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,10}/;
	if(!pattern.test(correo)){ 
		$(this).val("");
		$(this).focus();
		return false;
	}else{
		return true;  
	}
},
validarTelefono: function(){
	var numero = $(this).val();	
	var pattern= /[0-9]/;	
	if(pattern.test(numero) && $(this).val().length >= 8){
		return true;  
	}else{
		$(this).val("");
		$(this).focus();
		return false;
	}
},
validarNumeros: function(){
	var numero = $(this).val();	
	var pattern= /[^0-9]/;	
	if(!pattern.test(numero)){
		return true;  
	}else{
		$(this).val("");
		$(this).focus();
		return false;
	}
},
buscador: function(texto,lista){
	var pattern = new RegExp(texto.val(), "i");
	lista.each(function(index,element){
		if(!$(element).text().match(pattern)){
			$(element).hide();
		}else{
			$(element).show();
		}
	});
},
getCoockie: function (c_name) {
	var c_value = document.cookie;
	var c_start = c_value.indexOf(" " + c_name + "=");
	if (c_start == -1) {
		c_start = c_value.indexOf(c_name + "=");
	}
	if (c_start == -1) {
		c_value = null;
	} else {
		c_start = c_value.indexOf("=", c_start) + 1;
		var c_end = c_value.indexOf(";", c_start);
		if (c_end == -1) {
			c_end = c_value.length;
		}
		c_value = unescape(c_value.substring(c_start, c_end));
	}
	return c_value;
},
setCoockie: function (c_name, value, exdays) {
	var exdate = new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString());
	document.cookie = c_name + "=" + c_value;
	
},
checkCoockie: function (c_name) {
	var username = this.getCoockie(c_name);
	if (username != null && username != "") {
		return username;
	} else {
		return false;
	}
},
createXML: function(estructura){

	if (window.DOMParser)
	{
		parser=new DOMParser();
		xmlDoc=parser.parseFromString(estructura,"text/xml");
	}
		else // Internet Explorer
		{
			xmlDoc=new ActiveXObject("Microsoft.XMLDOM");
			xmlDoc.async=false;
			xmlDoc.loadXML(estructura);
		}
		return xmlDoc;
	},
	cambioColegio:	function(a,b){
		if(b==1){
			$.ajax({
				url:"ajax/cambiarColegio"	,
				data:"idColegio="+a,
				type:'POST',
				success: function(resp){
					if(resp=="ok"){
						document.location.reload();
					}else{
						
					}
				}
			});
		}
	},
	moverScroll: function(sumar,velocidad,selector){
		if(sumar == "undefinied"){
			sumar=0;	
		}
		if(velocidad == "undefinied"){
			velocidad=400;
		}
		if(selector == "undefinied"){
			selector = "body,html";
		}
		var st=$(this).offset().top + sumar;
		$(selector).animate({
			scrollTop: st
		},velocidad,function(){  }
		);	
	},
	preCargarImagen: function (evt,selector) {
		var files = evt.target.files; // Lista de archivos

		 // Recorre la lista de archivos y la asigna al selector.
		 for (var i = 0, f; f = files[i]; i++) {

			  // Verificamos que el archivo sea una imagen.
			  if (!f.type.match('image.*')) {
			  	continue;
			  }

			  var reader = new FileReader();

			  // agrega la ruta al atributo src del selector de la imagen.
			  reader.onload = (function(theFile) {
			  	return function(e) {
			  		$(selector).prop("src",e.target.result);
			  	};
			  })(f);

			  // carga la imagen desde la url.
			  reader.readAsDataURL(f);
			}
		},
		exportarTablaExcel: function (selectorIdTabla,nombreHojaExcel,selectorDivResultado,boolEliminarColumnas) {
			if(boolEliminarColumnas==true){
				var auxTabla = $(selectorDivResultado).html();
			//poner clase "ocultar" a las tr o td que se quieran ocultar
			$(".ocultar").remove();
		}
		
		$(selectorIdTabla+" span").each(function(index,val){
			$(this).text($(this).prop('title'));
		});
		
		var html = $(selectorIdTabla).html();
		if(boolEliminarColumnas==true){
			$(selectorDivResultado).html(auxTabla);
		}

		while (html.indexOf('á') != -1) html = html.replace('á', '&aacute;');
		while (html.indexOf('é') != -1) html = html.replace('é', '&eacute;');
		while (html.indexOf('í') != -1) html = html.replace('í', '&iacute;');
		while (html.indexOf('ó') != -1) html = html.replace('ó', '&oacute;');
		while (html.indexOf('ú') != -1) html = html.replace('ú', '&uacute;');
		while (html.indexOf('à') != -1) html = html.replace('à', '&aagrave;');
		while (html.indexOf('è') != -1) html = html.replace('è', '&eagrave;');
		while (html.indexOf('ì') != -1) html = html.replace('ì', '&iagrave;');
		while (html.indexOf('ò') != -1) html = html.replace('ò', '&oagrave;');
		while (html.indexOf('ù') != -1) html = html.replace('ù', '&uagrave;');


		while (html.indexOf('º') != -1) html = html.replace('º', '&ordm;');  
		while (html.indexOf('Ñ') != -1) html = html.replace('Ñ', '&Ntilde;');
		while (html.indexOf('ñ') != -1) html = html.replace('ñ', '&ntilde;');


		while (html.indexOf('Á') != -1) html = html.replace('Á', '&Aacute;');
		while (html.indexOf('À') != -1) html = html.replace('À', '&Agrave;');
		while (html.indexOf('É') != -1) html = html.replace('É', '&Eacute;');
		while (html.indexOf('È') != -1) html = html.replace('È', '&Egrave;');
		while (html.indexOf('Í') != -1) html = html.replace('Í', '&Iacute;');
		while (html.indexOf('Ì') != -1) html = html.replace('Ì', '&Igrave;');
		while (html.indexOf('Ó') != -1) html = html.replace('Ó', '&Oacute;');
		while (html.indexOf('Ò') != -1) html = html.replace('Ò', '&Ograve;');
		while (html.indexOf('Ú') != -1) html = html.replace('Ú', '&Uacute;');
		while (html.indexOf('Ù') != -1) html = html.replace('Ù', '&Ugrave;');
  //tableToExcel("exportarTabla","Alumnos",html);
//
var ctx = {worksheet: nombreHojaExcel || 'Worksheet', table: html}
var uri = 'data:application/vnd.ms-excel;base64,';
template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>';
base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }

var ctx = {worksheet: nombreHojaExcel || 'Worksheet', table: html}
window.location.href = uri + base64(format(template, ctx));


},

limpiarAcentos: function(text){
	
	while (text.indexOf('á') != -1) text = text.replace('á', '&aacute;');
	while (text.indexOf('é') != -1) text = text.replace('é', '&eacute;');
	while (text.indexOf('í') != -1) text = text.replace('í', '&iacute;');
	while (text.indexOf('ó') != -1) text = text.replace('ó', '&oacute;');
	while (text.indexOf('ú') != -1) text = text.replace('ú', '&uacute;');
	while (text.indexOf('à') != -1) text = text.replace('à', '&aagrave;');
	while (text.indexOf('è') != -1) text = text.replace('è', '&eagrave;');
	while (text.indexOf('ì') != -1) text = text.replace('ì', '&iagrave;');
	while (text.indexOf('ò') != -1) text = text.replace('ò', '&oagrave;');
	while (text.indexOf('ù') != -1) text = text.replace('ù', '&uagrave;');


	while (text.indexOf('º') != -1) text = text.replace('º', '&ordm;');  
	while (text.indexOf('Ñ') != -1) text = text.replace('Ñ', '&Ntilde;');
	while (text.indexOf('ñ') != -1) text = text.replace('ñ', '&ntilde;');


	while (text.indexOf('Á') != -1) text = text.replace('Á', '&Aacute;');
	while (text.indexOf('À') != -1) text = text.replace('À', '&Agrave;');
	while (text.indexOf('É') != -1) text = text.replace('É', '&Eacute;');
	while (text.indexOf('È') != -1) text = text.replace('È', '&Egrave;');
	while (text.indexOf('Í') != -1) text = text.replace('Í', '&Iacute;');
	while (text.indexOf('Ì') != -1) text = text.replace('Ì', '&Igrave;');
	while (text.indexOf('Ó') != -1) text = text.replace('Ó', '&Oacute;');
	while (text.indexOf('Ò') != -1) text = text.replace('Ò', '&Ograve;');
	while (text.indexOf('Ú') != -1) text = text.replace('Ú', '&Uacute;');
	while (text.indexOf('Ù') != -1) text = text.replace('Ù', '&Ugrave;');
	
	return text;
	
},
ponerAcentos: function(text){
	while (text.indexOf('&aacute;') != -1) text = text.replace('&aacute;', 'á');
	while (text.indexOf('&eacute;') != -1) text = text.replace('&eacute;', 'é');
	while (text.indexOf('&iacute;') != -1) text = text.replace('&iacute;', 'í');
	while (text.indexOf('&oacute;') != -1) text = text.replace('&oacute;', 'ó');
	while (text.indexOf('&uacute;') != -1) text = text.replace('&uacute;', 'ú');
	while (text.indexOf('&aagrave;') != -1) text = text.replace('&aagrave;', 'à');
	while (text.indexOf('&eagrave;') != -1) text = text.replace('&eagrave;', 'è');
	while (text.indexOf('&iagrave;') != -1) text = text.replace('&iagrave;', 'ì');
	while (text.indexOf('&oagrave;') != -1) text = text.replace('&oagrave;', 'ò');
	while (text.indexOf('&uagrave;') != -1) text = text.replace('&uagrave;', 'ù');


	while (text.indexOf('&ordm;') != -1) text = text.replace('&ordm;', 'º');
	while (text.indexOf('&Ntilde;') != -1) text = text.replace('&Ntilde;', 'Ñ');
	while (text.indexOf('&ntilde;') != -1) text = text.replace('&ntilde;', 'ñ');


	while (text.indexOf('&Aacute;') != -1) text = text.replace('&Aacute;', 'Á');
	while (text.indexOf('&Agrave;') != -1) text = text.replace('&Agrave;', 'À');
	while (text.indexOf('&Eacute;') != -1) text = text.replace('&Eacute;', 'É');
	while (text.indexOf('&Egrave;') != -1) text = text.replace('&Egrave;', 'È');
	while (text.indexOf('&Iacute;') != -1) text = text.replace('&Iacute;', 'Í');
	while (text.indexOf('&Igrave;') != -1) text = text.replace('&Igrave;', 'Ì');
	while (text.indexOf('&Oacute;') != -1) text = text.replace('&Oacute;', 'Ó');
	while (text.indexOf('&Ograve;') != -1) text = text.replace('&Ograve;', 'Ò');
	while (text.indexOf('&Uacute;') != -1) text = text.replace('&Uacute;', 'Ú');
	while (text.indexOf('&Ugrave;') != -1) text = text.replace('&Ugrave;', 'Ù');

	return text;

	
},
getA: function(){
	return "\u00e1";
},
getAg: function(){
	return "\u00c1";
},
getE: function(){
	return "\u00e9";
},
getEg: function(){
	return "\u00c9";
},
getI: function(){
	return "\u00ed";
},
getIg: function(){
	return "\u00cd";
},
getO: function(){
	return "\u00f3";
},
getOg: function(){
	return "\u00d3";
},
getU: function(){
	return "\u00fa";
},
getUg: function(){
	return "\u00da";
},
getN: function(){
	return "\u00f1";
},
getNg: function(){
	return "\u00d1";
}


});