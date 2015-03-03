<?php
class vec_tipoeleccion {
	function __construct() {
	}
    function nombreeleccion() {
         return array ( 1 => 'Presidente y Vicepresidente', 4 => 'Corporaci&oacute;n Municipal' );
    }
    function __destruct() {
	}
}

class cls_tipoeleccion {
   
	function __construct() {
		echo $this->combo();
	} 
    
	function combo() {
       $tmp = new vec_tipoeleccion(); 
	   $vec = $tmp->nombreeleccion();
	   $html='Tipo Elecci&oacute;n:<br/><select name="cmb_tipoeleccion" onChange="ajx_tipoeleccion(document.formulario.cmb_tipoeleccion.options[document.formulario.cmb_tipoeleccion.selectedIndex].value)">';
	   while (list($i,$valor)=each($vec))
       $html.='<option value="'.$i.'">'.$valor.'</option>';
	   $html.='</select>';
	   return $html;
	}  
}
?>