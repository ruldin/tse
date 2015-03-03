<?php
include_once('conexion.php');

class clogo {
// Clase para  despliegue de gráfica de Barras
    private $ors;
	private $proceso;
	
    function __construct() { 
	  $this->proceso=$_SESSION['PROCESO'];
	}	
   function tablaLogos($dep,$mun,$tipoeleccion,$tp,$mp) {
       $cdb = new cbase;
       $cdb->conectaDB();
		$esteProceso = $this->proceso;
		/* incio de filtro consulta */
		// filtros php
		$poner = array('','','','','','','');
		$quitar1 = array('+','union','all','%','?',' ','=');
		$quitar2 = array('-','_','a','e','i','o','u');
		// pasamos 2 filtros a las variables
		$dep = str_replace($quitar1,$poner,$dep);
		$dep = str_replace($quitar2,$poner,$dep);

		$mun = str_replace($quitar1,$poner,$mun);
		$mun = str_replace($quitar2,$poner,$mun);
		
		$tipoeleccion = str_replace($quitar1,$poner,$tipoeleccion);
		$tipoeleccion = str_replace($quitar2,$poner,$tipoeleccion);
		
		$esteProceso = str_replace($quitar1,$poner,$esteProceso);
		$esteProceso = str_replace($quitar2,$poner,$esteProceso);
		
		// consultamos si cada dato es numerico
		if (is_numeric($dep) && is_numeric($mun) && is_numeric($tipoeleccion) && is_numeric($esteProceso)){
			// realizamos el segundo filtro, cortar las variables
			$dep = substr($dep,0,2);
			$mun = substr($mun,0,2);
			$tipoeleccion = substr($tipoeleccion,0,2);
			$esteProceso = substr($esteProceso,0,6);
		} else {
			$dep = substr($dep,0,2);
			$mun = substr($mun,0,2);
			$tipoeleccion = substr($tipoeleccion,0,2);
			$esteProceso = substr($esteProceso,0,6);
		}
		/* fin de filtro consulta */
	  $this->ors= $cdb->consulta("SELECT * FROM tresultado WHERE DEP=".$dep." and MUN=" .$mun." and TIPOELECCION=".$tipoeleccion." and PROCESO=".$esteProceso);
         echo '<table><tr>';
	  if($this->ors['VOTOSVALIDOS']>0 ) { 
	   $i=0;
       while ($i< $tp && $this->ors[11 +($i*5)]<>'' ) {
	        $logo = str_replace(' ','',$this->ors[11+($i*5)]);
                $logo = strtolower($logo);
	       if (file_exists("logos/".$logo.".png")){ 
/////        	   echo '<td><img src="logos/'.$logo.'.png" alt="Elecciones 2011" /></td>';
           }else{
     	        echo '<td>'. $logo .'</td>';
           } 
		  $i++;
	   }
/////	   if($i<$mp && $this->ors[11 +($i*5)]<>'') echo '<td><img src="logos/OTROS.png" /></td>';
	  }
	  else {echo "<td><p class='msgerror'>DE MOMENTO NO HAY DATOS INGRESADOS</P></td>";}
      echo "</tr></table></br>";
   }
}     
?>
