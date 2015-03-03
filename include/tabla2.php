<?php
include_once 'conexion.php';
include_once 'config.php';
/* inicio de filtro consultas */
include 'filtro.php';

class ctabla {
// Clase para  despliegue de gráfica de Barras

	private $maxPartidos;
	private $proceso;
	private $ors;
	private $sigla;
	
    function __construct() { 
       $this->maxPartidos=$_SESSION['MAXPARTIDO'];
  	   $this->proceso=$_SESSION['PROCESO'];
	}

   function construyeTabla($dep,$mun,$tipoeleccion,$titulo) {
       $cdb = new cbase;
       $cdb->conectaDB();
      
	   //Distrito Central
	   if($dep==1 and $mun==1)  $dep=0;
	if(version_compare(phpversion(),"4.3.0", ">")){
		$dep=mysql_escape_string($dep);
                $mun=mysql_escape_string($mun);
                $tipoeleccion=mysql_escape_string($tipoeleccion);
                $this->proceso=mysql_escape_string($this->proceso);

	}else{
		$dep=mysql_real_escape_string($dep);
                $mun=mysql_real_escape_string($mun);
                $tipoeleccion=mysql_real_escape_string($tipoeleccion);
                $this->proceso=mysql_real_escape_string($this->proceso);
	}
	
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
		
		$this->proceso = str_replace($quitar1,$poner,$this->proceso);
		$this->proceso = str_replace($quitar2,$poner,$this->proceso);
		
		// consultamos si cada dato es numerico
		if (is_numeric($dep) && is_numeric($mun) && is_numeric($tipoeleccion) && is_numeric($this->proceso)){
			// realizamos el segundo filtro, cortar las variables
			$dep = substr($dep,0,2);
			$mun = substr($mun,0,2);
			$tipoeleccion = substr($tipoeleccion,0,2);
			$this->proceso = substr($this->proceso,0,6);
		} else {
			$dep = substr($dep,0,2);
			$mun = substr($mun,0,2);
			$tipoeleccion = substr($tipoeleccion,0,2);
			$this->proceso = substr($this->proceso,0,6);
		}
		/* fin de filtro consulta */	
       $this->ors= $cdb->consulta("SELECT * FROM tresultado WHERE DEP=".$dep." and MUN=" .$mun." and TIPOELECCION=".$tipoeleccion." and PROCESO=".$this->proceso);
	   echo '<table class="tabla">';
	   $i=0;
	   echo '<thead><tr><th class="header1">Partido</th><th class="header2">Votos</th><th class="header3">%</th></tr></thead><tbody>';
       $_SESSION['HD']=0;
	  
	   while ( $i< $this->maxPartidos && $this->ors[11 +($i*5)]<>'' ) {
			if ($this->ors[13+($i*5)]>0) $_SESSION['HD']=1; 
	       if(($i/2-round($i/2,0))==0) $tclass='';
		   else $tclass ='class="odd"';
     	   echo "<tr ".$tclass."><td>".$this->ors[11+($i*5)]."</td><td>".number_format($this->ors[13+($i*5)],0)."</td><td>".number_format($this->ors[14+($i*5)],2)."</td></tr>";
		   $i++;
       }
	   echo "</tbody></table><br/>";

       // COLUMNAS DE TABLA PARA TOTALES
	   echo "<table class=\"tabla2\"><caption>Totales</caption><tbody>";
	   echo "<tr class=\"totpar\"><td class=\"c1\">Votos Nulos:</td><td class=\"c2\">".number_format($this->ors['NULOS'],0)."</td><td class=\"c3\">".number_format($this->ors['PNULOS'],2)."</td></tr>" ;
	   echo "<tr class=\"totimpar\"><td class=\"c1\">Votos Blancos:</td><td class=\"c2\">".number_format($this->ors['BLANCOS'],0)."</td><td class=\"c3\">".number_format($this->ors['PBLANCOS'],2)."</td></tr>" ;
	   echo "<tr class=\"totpar\"><td class=\"c1\">Votos V&aacute;lidos:</td><td class=\"c2\">".number_format($this->ors['VOTOSVALIDOS'],0)."</td><td class=\"c3\"></td></tr>" ;
           $pemitidos=$this->ors['NULOS']+$this->ors['BLANCOS']+$this->ors['VOTOSVALIDOS'];
           $pemitidos=$pemitidos*100;
           $pemitidos=$pemitidos/$this->ors['CNTVOTANTES'];
	   echo "<tr class=\"totimpar\"><td class=\"c1\">Votos Emitidos:</td><td class=\"c2\">".number_format($this->ors['NULOS']+$this->ors['BLANCOS']+$this->ors['VOTOSVALIDOS'])."</td><td class=\"c3\">".number_format($pemitidos,2)."</td></tr>" ;
	   echo "<tr class=\"totpar\"><td class=\"c1\">Votantes Inscritos:</td><td class=\"c2\">".number_format($this->ors['CNTVOTANTES'],0)."</td><td class=\"c3\"></td></tr>" ;
	   echo "<tr class=\"totimpar\"><td class=\"c1\" title=\"Juntas Receptoras de Votos Totalizadas\">JRV Totalizadas:</td><td class=\"c2\">".number_format($this->ors['MESASPRO'],0)."</td><td class=\"c3\">".number_format($this->ors['PMESASPRO'],2)."</td></tr>" ;
	   echo "<tr class=\"totpar\"><td class=\"c1\" title=\"Total Juntas Receptoras de Votos\">Total JRV:</td><td class=\"c2\">".number_format($this->ors['CNTMESAS'],0)."</td><td class=\"c3\"></td></tr>" ;
	   echo "</tbody></table>";
   }

   
   function construyeListado($dep,$mun,$tipoeleccion,$titulo) {
       $cdb = new cbase;
       $cdb->conectaDB();

	   //Distrito Central
	   if($dep==1 and $mun==1)  $dep=0;

       if(($tipoeleccion==1)||($tipoeleccion ==2)||($tipoeleccion ==5)) {
	if(version_compare(phpversion(),"4.3.0", ">")){
                $tipoeleccion=mysql_escape_string($tipoeleccion);
                $this->proceso=mysql_escape_string($this->proceso);

	}else{
                $tipoeleccion=mysql_real_escape_string($tipoeleccion);
                $this->proceso=mysql_real_escape_string($this->proceso);
	}

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
			$this->proceso = str_replace($quitar2,$poner,$this->proceso);
	
			$this->proceso = str_replace($quitar1,$poner,$this->proceso);
			$tipoeleccion = str_replace($quitar2,$poner,$tipoeleccion);
			// consultamos si cada dato es numerico
			if (is_numeric($tipoeleccion) && is_numeric($this->proceso) && is_numeric($dep) && is_numeric($mun)){
				// realizamos el segundo filtro, cortar las variables
				$dep = substr($dep,0,2);
				$mun = substr($mun,0,2);
				$tipoeleccion = substr($tipoeleccion,0,2);
				$this->proceso = substr($this->proceso,0,6);
			} else {
				$dep = substr($dep,0,2);
				$mun = substr($mun,0,2);
				$tipoeleccion = substr($tipoeleccion,0,2);
				$this->proceso = substr($this->proceso,0,6);
			}
			/* fin de filtro consulta */		
  	         $this->ors= $cdb->consulta("SELECT SIGLAS FROM trefpartido WHERE DEP=0 and MUN=0 and TIPOELECCION=".$tipoeleccion." and PROCESO=".$this->proceso. " ORDER BY ORDEN");
	   }
       if($tipoeleccion==3) {
  	         $this->ors= $cdb->consulta("SELECT SIGLAS FROM trefpartido WHERE DEP=".$dep." and TIPOELECCION=".$tipoeleccion." and PROCESO=".$this->proceso. " ORDER BY ORDEN");
	   }
       if($tipoeleccion==4) {
  	         $this->ors= $cdb->consulta("SELECT SIGLAS FROM trefpartido WHERE DEP=".$dep." and MUN=".$mun." and TIPOELECCION=".$tipoeleccion." and PROCESO=".$this->proceso. " ORDER BY ORDEN");
	   }


 	   //Encabezado tabla por Mesa"
		$html='<div id="dtactmun"><table class="tabla"><thead><tr><th>NRO MESA</th>';
		$j=0;
		do  {
		$html.='<th>'.$this->ors['SIGLAS'].'</th>';
		$j++;
       } while ($this->ors=$cdb->siguiente());
	   $html.='<th>NULOS</th><th>BLANCOS</th><th>EMITIDOS</th><th>ESTADO</th></tr></thead><tbody>';
	if(version_compare(phpversion(),"4.3.0", ">")){
		$dep=mysql_escape_string($dep);
                $mun=mysql_escape_string($mun);
                $tipoeleccion=mysql_escape_string($tipoeleccion);
                $this->proceso=mysql_escape_string($this->proceso);

	}else{
		$dep=mysql_real_escape_string($dep);
                $mun=mysql_real_escape_string($mun);
                $tipoeleccion=mysql_real_escape_string($tipoeleccion);
                $this->proceso=mysql_real_escape_string($this->proceso);
	}
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
		
		$this->proceso = str_replace($quitar1,$poner,$this->proceso);
		$this->proceso = str_replace($quitar2,$poner,$this->proceso);
		
		// consultamos si cada dato es numerico
		if (is_numeric($dep) && is_numeric($mun) && is_numeric($tipoeleccion) && is_numeric($this->proceso)){
			// realizamos el segundo filtro, cortar las variables
			$dep = substr($dep,0,2);
			$mun = substr($mun,0,2);
			$tipoeleccion = substr($tipoeleccion,0,2);
			$this->proceso = substr($this->proceso,0,6);
		} else {
			$dep = substr($dep,0,2);
			$mun = substr($mun,0,2);
			$tipoeleccion = substr($tipoeleccion,0,2);
			$this->proceso = substr($this->proceso,0,6);
		}
		/* fin de filtro consulta */	
	   $this->ors= $cdb->consulta("SELECT * FROM tacta WHERE DEP=".$dep." and MUN=" .$mun." and TIPOELECCION=".$tipoeleccion." and PROCESO=".$this->proceso);
	   //Cuerpo de tabla      
       $k=0;
	   do {
	       if(($k/2-round($k/2,0))==0) $tclass='';
		   else $tclass ='class="odd"';
	   $html.='<tr '.$tclass.'><td><a href="" onClick="Cargar_mesa('.$this->ors['NROMESA'].','.$tipoeleccion.')" >'.$this->ors['NROMESA'].'</a></td>';
           /*while ($i<$this->maxPartidos && $this->ors[7+$i]<>'')  {
        	  $html.='<td>x'.$this->ors[7+$i].'</td>';
		      $i++;
           }*/
		   for ($i=0;$i<$j;$i++)
		   {
			$html.='<td>'.$this->ors[7+$i].'</td>';
		   }
  	       $html.='<td>'.$this->ors['NULOS'].'</td><td>'.$this->ors['BLANCOS'].'</td><td>'.$this->ors['TOTALACTA'].'</td><td>';
	       $html.=$this->ors['STACTA'].'</td></tr>';
		   $k++;
       } while ($this->ors=$cdb->siguiente());
	   $html.='</tbody></table></div>';
	   echo $html;
   }

   function construyeTablaMesa($tmesa,$tipoeleccion) {
       $cdb = new cbase;
       $cdb->conectaDB();
	if(version_compare(phpversion(),"4.3.0", ">")){
		$tmesa=mysql_escape_string($tmesa);
                $tipoeleccion=mysql_escape_string($tipoeleccion);
                $this->proceso=mysql_escape_string($this->proceso);

	}else{
		$tmesa=mysql_real_escape_string($tmesa);
                $tipoeleccion=mysql_real_escape_string($tipoeleccion);
                $this->proceso=mysql_real_escape_string($this->proceso);
	}
		/* incio de filtro consulta */
		// filtros php
		$poner = array('','','','','','','');
		$quitar1 = array('+','union','all','%','?',' ','=');
		$quitar2 = array('-','_','a','e','i','o','u');
		// pasamos 2 filtros a las variables
		$tmesa = str_replace($quitar1,$poner,$tmesa);
		$tmesa = str_replace($quitar2,$poner,$tmesa);
		$tipoeleccion = str_replace($quitar1,$poner,$tipoeleccion);
		$tipoeleccion = str_replace($quitar2,$poner,$tipoeleccion);
		$this->proceso = str_replace($quitar1,$poner,$this->proceso);
		$this->proceso = str_replace($quitar2,$poner,$this->proceso);
		// consultamos si cada dato es numerico
		if (is_numeric($tmesa) && is_numeric($tipoeleccion) && is_numeric($this->proceso)){
			// realizamos el segundo filtro, cortar las variables
			$tmesa = substr($tmesa,0,6);
			$tipoeleccion = substr($tipoeleccion,0,2);
			$this->proceso = substr($this->proceso,0,6);
		} else {
			$tmesa = substr($tmesa,0,6);
			$tipoeleccion = substr($tipoeleccion,0,2);
			$this->proceso = substr($this->proceso,0,6);
		}
		/* fin de filtro consulta */	
	   $this->ors= $cdb->consulta("SELECT * FROM tacta WHERE NROMESA=".$tmesa." and TIPOELECCION=".$tipoeleccion." and PROCESO=".$this->proceso);
	   $dep=$this->ors['DEP'];
	   $mun=$this->ors['MUN'];

	   $html='<div id="diacta"><a href="'.DIRECTORIO_ACTAS.str_pad((int)$tmesa,5,"0",STR_PAD_LEFT).$tipoeleccion.'.'.EXTENSION_ACTAS.'" target="_blank"><img src="'.DIRECTORIO_ACTAS.str_pad((int)$tmesa,5,"0",STR_PAD_LEFT).$tipoeleccion.'.'.EXTENSION_ACTAS.'" /></a></div>';
	   $html.='<div id="dtacta"><table class="tabla">';
	   $html.='<thead><tr><th class="header1">Partido</th><th class="header2">Votos</th></tr></thead><tbody>';
       $tipoeleccion=mysql_real_escape_string($tipoeleccion);
	   $this->proceso=mysql_real_escape_string($this->proceso);
	   
       if(($tipoeleccion==1)||($tipoeleccion ==2)||($tipoeleccion ==5)) {
  	         $this->sigla= $cdb->consulta('SELECT SIGLAS FROM trefpartido WHERE DEP=0 and MUN=0 and TIPOELECCION='.$tipoeleccion.' and PROCESO='.$this->proceso. ' ORDER BY ORDEN');
	   }
       if($tipoeleccion==3) {
	   
  	         $this->sigla= $cdb->consulta("SELECT SIGLAS FROM trefpartido WHERE DEP=".$dep." and TIPOELECCION=".$tipoeleccion." and PROCESO=".$this->proceso. " ORDER BY ORDEN");
	   }
       if($tipoeleccion==4) {
  	         $this->sigla= $cdb->consulta("SELECT SIGLAS FROM trefpartido WHERE DEP=".$dep." and MUN=".$mun." and TIPOELECCION=".$tipoeleccion." and PROCESO=".$this->proceso. " ORDER BY ORDEN");
	   }
	   
	   
	   $i=0;
       do  {
	       if(($i/2-round($i/2,0))==0) $tclass='';
		   else $tclass ='class="odd"';
     	   $html.='<tr '.$tclass.'><td>'.$this->sigla['SIGLAS'].'</td><td>'.$this->ors[7+$i].'</td></tr>';
		   $i++;
       } while ($this->sigla=$cdb->siguiente());
	   $html.='</tbody></table><br/>';

       // COLUMNAS DE TABLA PARA TOTALES
	   $html.='<table class="tabla2"><caption>Totales</caption><tbody>';
	   $html.='<tr class="totpar"><td class="c1">Votos Nulos:</td><td class="c2">'.$this->ors['NULOS'].'</td><td class="c3\"></td></tr>';
	   $html.='<tr class="totimpar"><td class="c1">Votos Blancos:</td><td class="c2">'.$this->ors['BLANCOS'].'</td><td class="c3\"></td></tr>';
	   $html.='<tr class="totimpar"><td class="c1">Votos Emitidos:</td><td class="c2">'.($this->ors['TOTALACTA']).'</td><td class="c3"></td></tr>';
	   $html.='<tr class="totpar"><td class="c1">Votantes Inscritos:</td><td class="c2">'.$this->ors['CNTPAPELETAS'].'</td><td class="c3"></td></tr>';
	   $html.='</tbody></table></div>';
	   $html.='<div id="clear"></div>';
	   echo $html;
   }
}
?>
