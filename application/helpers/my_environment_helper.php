<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('isCloudServer'))
{
	function isCloudServer(){
		return (ENVIRONMENT=="production");
	}

}

if ( ! function_exists('getDotsFromRoot'))
{
	function getDotsFromRoot($totalSegments = 0){
		$dots = "";
		for($x=0,$length=$totalSegments;$x < $length; $x++){
			$dots.= "../";
		}
		return ($dots==="")?"./":$dots;
	}

}
if(!function_exists('sanear_string')){
	function sanear_string($string,$bool=true){

		$string = trim($string);

		$string = str_replace(
			array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
			array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
			$string
			);

		$string = str_replace(
			array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
			array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
			$string
			);

		$string = str_replace(
			array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
			array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
			$string
			);

		$string = str_replace(
			array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
			array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
			$string
			);

		$string = str_replace(
			array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
			array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
			$string
			);

		$string = str_replace(
			array('ñ', 'Ñ', 'ç', 'Ç'),
			array('n', 'N', 'c', 'C',),
			$string
			);
		if ($bool === true) {
	    	//Esta parte se encarga de eliminar cualquier caracter extraño
			$string = str_replace(
				array("\\", "¨", "º", "-", "~",
					"#", "@", "|", "!", "\"",
					"·", "$", "%", "&", "/",
					"(", ")", "?", "'", "¡",
					"¿", "[", "^", "`", "]",
					"+", "}", "{", "¨", "´",
					">", "< ", ";", ",", ":",
					".", " "),
				'',
				$string
				);
		}


		return $string;
	}
}
if(!function_exists('cerrarSesion')){
	function cerrarSesion(){
		$CI =& get_instance();
		//$CI->session->sess_destroy();
		$CI->session->set_userdata('logged_in',FALSE);
		redirect("../", 'refresh');
	}
}

if(!function_exists('redimensionarImagen')){
	function redimensionarImagen($ruta1,$ruta2,$ancho,$alto) 
	{ 
    # se obtene la dimension y tipo de imagen 
		$datos=getimagesize ($ruta1); 

    $ancho_orig = $datos[0]; # Anchura de la imagen original 
    $alto_orig = $datos[1];    # Altura de la imagen original 
    $tipo = $datos[2]; 

    if ($tipo==1){ # GIF 
    	if (function_exists("imagecreatefromgif")) 
    		$img = imagecreatefromgif($ruta1); 
    	else 
    		return false; 
    } 
    else if ($tipo==2){ # JPG 
    	if (function_exists("imagecreatefromjpeg")) 
    		$img = imagecreatefromjpeg($ruta1); 
    	else 
    		return false; 
    } 
    else if ($tipo==3){ # PNG 
    	if (function_exists("imagecreatefrompng")) 
    		$img = imagecreatefrompng($ruta1); 
    	else 
    		return false; 
    } 

    # Se calculan las nuevas dimensiones de la imagen 
    if ($ancho_orig>$alto_orig) 
    { 
    	$ancho_dest=$ancho; 
    	$alto_dest=($ancho_dest/$ancho_orig)*$alto_orig; 
    } 
    else 
    { 
    	$alto_dest=$alto; 
    	$ancho_dest=($alto_dest/$alto_orig)*$ancho_orig; 
    } 

    // imagecreatetruecolor, solo estan en G.D. 2.0.1 con PHP 4.0.6+ 
    $img2=@imagecreatetruecolor($ancho_dest,$alto_dest) or $img2=imagecreate($ancho_dest,$alto_dest); 

    // Redimensionar 
    // imagecopyresampled, solo estan en G.D. 2.0.1 con PHP 4.0.6+ 
    @imagecopyresampled($img2,$img,0,0,0,0,$ancho_dest,$alto_dest,$ancho_orig,$alto_orig) or imagecopyresized($img2,$img,0,0,0,0,$ancho_dest,$alto_dest,$ancho_orig,$alto_orig); 

    // Crear fichero nuevo, según extensión. 
    if ($tipo==1) // GIF 
    if (function_exists("imagegif")) 
    	imagegif($img2, $ruta2); 
    else 
    	return false; 

    if ($tipo==2) // JPG 
    if (function_exists("imagejpeg")) 
    	imagejpeg($img2, $ruta2); 
    else 
    	return false; 

    if ($tipo==3)  // PNG 
    if (function_exists("imagepng")) 
    	imagepng($img2, $ruta2); 
    else 
    	return false; 

    return true; 
}
}
