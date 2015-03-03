<?php
include_once '../../../include_nebaj/conexion.php';

class cfiguramovil {
// Clase para  despliegue de gráficas
    private $f_tp;
	private $f_mp;
	private $f_dep;
	private $f_mun;
	private $f_te;
    private $ors;	
	
    function __construct($tp,$mp,$dep,$mun,$te) {
       $this->f_tp=$tp;
       $this->f_mp=$mp;
       $this->f_dep=$dep;
       $this->f_mun=$mun;
       $this->f_te=$te;
	   $this->conectarDB();
	}

    function valida() { 
	     if(is_numeric($this->f_dep) && ($this->f_dep >-1 and $this->f_dep<23))
		    if(is_numeric($this->f_mun) && ($this->f_mun >-1 and $this->f_mun<33))
	   		    if(is_numeric($this->f_te) && ($this->f_te >0 and $this->f_te<6)) return true;
		return false;		
	}
	
	function conectarDB() {
	   if (!($this->valida())) die; //probablemente sql injected
       $cdb = new cbase;
       $cdb->conectaDB();
	if(version_compare(phpversion(),"4.3.0", ">")){
		$this->f_dep=mysql_escape_string($this->f_dep);
        	$this->f_mun=mysql_escape_string($this->f_mun);
	        $this->f_te=mysql_escape_string($this->f_te);
	}else{
                $this->f_dep=mysql_real_escape_string($this->f_dep);
                $this->f_mun=mysql_real_escape_string($this->f_mun);
                $this->f_te=mysql_real_escape_string($this->f_te);
	}
	
		/* incio de filtro consulta */
		// filtros php
		$poner = array('','','','','','','');
		$quitar1 = array('+','union','all','%','?',' ','=');
		$quitar2 = array('-','_','a','e','i','o','u');
		// pasamos 2 filtros a las variables
		$this->f_dep = str_replace($quitar1,$poner,$this->f_dep);
		$this->f_dep = str_replace($quitar2,$poner,$this->f_dep);

		$this->f_mun = str_replace($quitar1,$poner,$this->f_mun);
		$this->f_mun = str_replace($quitar2,$poner,$this->f_mun);
		
		$this->f_te = str_replace($quitar1,$poner,$this->f_te);
		$this->f_te = str_replace($quitar2,$poner,$this->f_te);
		// consultamos si cada dato es numerico
		if (is_numeric($this->f_dep) && is_numeric($this->f_mun) && is_numeric($this->f_te)){
			// realizamos el segundo filtro, cortar las variables
			$this->f_dep = substr($this->f_dep,0,2);
			$this->f_mun = substr($this->f_mun,0,2);
			$this->f_te = substr($this->f_te,0,2);
		} else {
			$this->f_dep = substr($this->f_dep,0,2);
			$this->f_mun = substr($this->f_mun,0,2);
			$this->f_te = substr($this->f_te,0,2);
		}
		/* fin de filtro consulta */	
		$this->ors=$cdb->consulta("SELECT * FROM tresultado WHERE DEP=".$this->f_dep." and MUN=".$this->f_mun." and TIPOELECCION=".$this->f_te);
    }
    function barras() {
       $data = array();
       if ($this->ors > 0 ){
         	$i=0;
            while ( $i< $this->f_tp && $this->ors[11 +($i*5)]<>'' ) {
              $data[] = array( $this->ors[11+($i*5)],$this->ors[14+($i*5)],$this->ors[12+($i*5)]);
    		  $i++;
            }
			$otros=0;$haymas=0;
            while ($i<$this->f_mp && $this->ors[11+($i*5)]<>'' ) {
			  $otros= $otros+$this->ors[14+($i*5)];
			  $i++;
			  $haymas=1;
			}
			if( $haymas==1) {  //esto hay que corroborar para sumar bien
     		  $data[]  = array( "OTROS", $otros, "#1b93f0");
            }
       }
       $imagen='<table id="grafica">';
       foreach( $data as $ElemArray ) {
           $porcentaje = round($ElemArray[1],2);
           $imagen.='<tr>';
           $imagen.='<td width="15%"><strong>'.$ElemArray[0].'</strong></td>';
           $imagen.='<td width="10%">'.$porcentaje.'%</td>';
           $imagen.='<td width=75%>';
		   if ($porcentaje>0) {
			   $porcentaje = round($ElemArray[1],0);
			   $imagen.='  <table id="gmovil" width="'.$porcentaje.'%" bgcolor="'.$ElemArray[2].'">';
			   $imagen.='  <tr><td></td></tr>';
			   $imagen.='  </table>';
		   }
           $imagen.='</td>';
           $imagen.='</tr>';
       }
       $imagen.='</table>';
       return $imagen;
	}
	
	function darcadena() {
		return  $this->barras();
	}
}
?>
