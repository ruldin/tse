<?php

class carreglodetalle {
    function __construct() {
	}
    function nombredetalle() {
//         return array ( 0 => 'Seleccionar',1 => 'Actas por Municipio', 2 => 'Escrutinio Municipal', 
//                        3 => 'Resultados por Mesa');
         return array ( 1 => 'Actas por Municipio', 2 => 'Escrutinio Municipal', 
                        3 => 'Resultados por Mesa');
    }
    function __destruct() {
	}
}

class ctipodetalle {
private $adetalle;
private $aresultado;
   
	function __construct($forma) {
		if ($forma==3) { $this->aresultado=$this->combodetalle(); };
	} 
   
	function combodetalle() {
		$tipo = new carreglodetalle(); 
		$this->adetalle = $tipo->nombredetalle();
		$lista='Tipo de proceso:<br><select name="detalle" onChange="cargar_detalle(document.formesa.detalle.options[document.formesa.detalle.selectedIndex].value)">';
		while (list($i,$valor)=each($this->adetalle))
		$lista.='<option value="'.$i.'">'.$valor.'</option>';
		$lista.='</select>';
		return $lista;
	}

	function datostipo() {
		return $this->aresultado;
	}
}
?>