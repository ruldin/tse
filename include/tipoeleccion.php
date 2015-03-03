<?php

class carreglotipo {
    function __construct() {
	}
    function nombreeleccion() {
         return array ( 1 => 'Presidente y Vicepresidente',  4 => 'Corporaci&oacute;n Municipal');
    }
    function __destruct() {
	}
}

class ctipoeleccion {
   private $alugar;
   private $aresultado;
   
   function __construct($forma) {
	  if($forma==1)  { $this->aresultado=$this->tablatipo(); }
	  elseif ($forma==2) { $this->aresultado=$this->listatipo(); }
	  elseif ($forma==3) { $this->aresultado=$this->combotipo(); }
	  elseif ($forma==4) { $this->aresultado=$this->combotipomesa(); };
   } 
   
   function tablatipo() {
       $tipo = new carreglotipo(); 
       $this->alugar = $tipo->nombreeleccion();
       $lista = '<table>';
	   $i=1;
       while($i <= count($this->alugar)) {
    	    $lista = $lista.'<tr><td>'.$this->alugar[$i].'</td></tr>';
	        $i++;
       }
	   $lista = $lista.'</table>';
	   return $lista;
   }
   
   function listatipo() {
       $tipo = new carreglotipo(); 
       $this->alugar = $tipo->nombreeleccion();
       $lista = '<table><tr><td>No.</td><td>Tipo elecci&oacute;n</td></tr>';
	   $i=1;
       while($i <= count($this->alugar)) {
    	    $lista = $lista.'<tr>';
            $lista=$lista .'<td>'.$i.'</td>';
            $lista=$lista .'<td><a style="text-decoration:underline;cursor:pointer;" onclick="cargar_tipo(\''.$i.');">'. $this->alugar[$i] .'</a></td>'; 
     	    $lista = $lista.'</tr>';
		  $i++;
       }
	   $lista = $lista.'</table>';
	   return $lista;
   }

   function combotipo() {
       $tipo = new carreglotipo(); 
	   $this->alugar = $tipo->nombreeleccion();
	   $lista='Tipo elecci&oacute;n:<br/><select name="tipo" onChange="cargar_tipo(document.formulario.tipo.options[document.formulario.tipo.selectedIndex].value)">';
       $lista=$lista .'<option value="1">'.$this->alugar[1].'</option>';
       $lista=$lista .'<option value="4">'.$this->alugar[4].'</option>';
	   $lista = $lista.'</select>';
	   return $lista;
   }

   function combotipomesa() {
       $tipo = new carreglotipo(); 
	   $this->alugar = $tipo->nombreeleccion();
	   $lista='Tipo elecci&oacute;n:<br/><select name="tipo" onChange="cargar_tipo(document.formesa.tipo.options[document.formesa.tipo.selectedIndex].value)">';
       $lista=$lista .'<option value="0">Seleccione</option>';
       $lista=$lista .'<option value="1">'.$this->alugar[1].'</option>';
       $lista=$lista .'<option value="4">'.$this->alugar[4].'</option>';
	   $lista=$lista.'</select>';
	   return $lista;
   }
   
   function datostipo() {
	   return $this->aresultado;
   }
}

?>