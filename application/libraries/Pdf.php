<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class pdf {
    
    function pdf()
    {
        $CI = & get_instance();
        log_message('Debug', 'mPDF class is loaded.');
    }
 
    function load($param=NULL)
    {
        include_once APPPATH.'/third_party/pdf2/mpdf.php';
         
        if ($params == NULL)
        {
            //modo,tamaño,default_font_size,default_font,mgleft,mgrigth,mgtop,mgbottom,mgh,mgf, orientation
            //'win-1252','A4','','',15,10,10,10,10,10);//A4 page in portrait for landscape add -L.
            //$param = '"en-GB-x","A4","","",10,10,10,10,6,3';
            $param = '"UTF-8","A4","","",15,10,2,10,0,2';
        }
         
        return new mPDF($param);
    }
}