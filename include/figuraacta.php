<?php
include_once 'conexion.php';
include_once 'lugaracta.php';
include_once 'php-ofc-library/open-flash-chart.php';

class cfiguraacta {
// Clase para  despliegue de gráficas
	private $f_dep;
	private $f_mun;
	private $f_te;
	private $ofigura;
    private $ors;	
    private $proceso;	
	
    function __construct($dep,$mun,$te) {
       if($dep==1 and $mun==1) { $this->f_dep=0; } else $this->f_dep=$dep;
       $this->f_mun=$mun;
       $this->f_te=$te;
       $this->proceso = $_SESSION['PROCESO'];	   
	   $this->conectarDB();
	}
    function valida() { 
	     if(is_numeric($this->f_dep) && ($this->f_dep >-1 and $this->f_dep<23))
		    if(is_numeric($this->f_mun) && ($this->f_mun >-1 and $this->f_mun<33))
	   		    if(is_numeric($this->f_te) && ($this->f_te >0 and $this->f_te<6))
 	   		        if(is_numeric($this->proceso) && ($this->proceso==201101 or $this->proceso==201102)) return true;
		return false;		
	}
	
    function ceiling($number, $significance = 1)
    {  if($number<10) return ( is_numeric($number) && is_numeric(10) ) ? (ceil($number/10)*10) : false;
       return ( is_numeric($number) && is_numeric($significance) ) ? (ceil($number/$significance)*$significance) : false;
    }
	
	function conectarDB() {
	   if (!($this->valida())) die; //probablemente sql injected
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

		$this->proceso = str_replace($quitar1,$poner,$this->proceso);
		$this->proceso = str_replace($quitar2,$poner,$this->proceso);
		
		// consultamos si cada dato es numerico
	//	if (is_numeric($this->f_dep) && is_numeric($this->f_mun) && is_numeric($this->f_te)){
			// realizamos el segundo filtro, cortar las variables
			$this->f_dep = substr($this->f_dep,0,2);
			$this->f_mun = substr($this->f_mun,0,2);
			$this->f_te  = substr($this->f_te,0,2);
			$this->proceso = substr($this->proceso,0,6);
//		} else {
//			$this->f_dep = substr($this->f_dep,0,2);
//			$this->f_mun = substr($this->f_mun,0,2);
//			$this->f_te = substr($this->f_te,0,2);
//			$this->proceso = substr($this->proceso,0,6);
//		} 		
		/* fin de filtro consulta */
	   	
	}

    function barras() {
       $data = array();
       $dataN = array();
       $dataL = array();
       $eleccion = new celeccion(); 
       $cdb = new cbase;
       $cdb->conectaDB();

       if($this->f_dep==0 and $this->f_mun==0) {
               $this->ors=$cdb->consulta("SELECT proceso,tipoeleccion,dep,mun,cntmesas,mesaspro,pmesaspro FROM tresultado WHERE (( DEP>0 and MUN=0) or (DEP=0 and MUN=1)) and TIPOELECCION=".$this->f_te ." and PROCESO=".$this->proceso." ORDER BY DEP,MUN");
			   $dataN= $eleccion->nombredepartamento(); 
			   $dataN[0]= 'Distrito Central';
	   }
       else if($this->f_dep>0 and $this->f_mun==0) {
               $this->ors=$cdb->consulta("SELECT proceso,tipoeleccion,dep,mun,cntmesas,mesaspro,pmesaspro FROM tresultado WHERE (DEP=".$this->f_dep." and MUN>0) and TIPOELECCION=".$this->f_te ." and PROCESO=".$this->proceso." ORDER BY DEP,MUN");
			    $dataN=$eleccion->nombremunicipio($this->f_dep);
       }	
       $i=0;
			// incluye funcion de tags para labels
			$tags = new ofc_tags();
			$tags->font("Verdana", 8)->colour("#3c3c3c")->align_x_center()->text('#y#%');
       while ( $this->ors ) {
     		  $bar = new bar_value(number_format($this->ors['pmesaspro'],2));
              $bar->set_tooltip(number_format($this->ors['pmesaspro'],2).'%<br>de actas procesadas<br>'.$this->ors['mesaspro'].' de '.$this->ors['cntmesas']);
				$rgb1 = 0; 
				$rgb2 = rand(90, 130); 
				$rgb3 = rand(180, 220); 
				$hex = "#";
				$hex .= str_pad(dechex($rgb1), 2, "0", STR_PAD_LEFT);
				$hex .= str_pad(dechex($rgb2), 2, "0", STR_PAD_LEFT);
				$hex .= str_pad(dechex($rgb3), 2, "0", STR_PAD_LEFT);
              $bar->set_colour($hex);
     		  $data[]= $bar;
			  if ($this->f_dep > 0){
			  $tdi = $i+1;
				  $dataL[] = new x_axis_label( utf8_encode($dataN[$tdi]),'3c3c3c',12,315 );
			  } else {
				  $dataL[] = new x_axis_label( utf8_encode($dataN[$i]),'3c3c3c',12,315 );
			  }
				// publicacion de tags
				$tags->append_tag(new ofc_tag($i, $this->ors['pmesaspro']));				
			  $this->ors=$cdb->siguiente();
			  $i++;
       }
	   
       $title = new title( "Actas procesadas");
       $title->set_style( "{font-size: 20px; font-family: Times New Roman; font-weight: bold; color: #3c3c3c; text-align: center;}" );
	   
       $bar = new bar_3d();
       $bar->set_values( $data );
       $bar->set_alpha( 0.9 );
       $bar->colour = '#ffffff';

       $x_axis_l = new x_axis_labels();
       $x_axis_l-> set_labels($dataL);

       $x_axis = new x_axis();
       $x_axis->set_3d( 7 );
       $x_axis->colour = ('#d3d3d3');
       $x_axis->set_grid_colour ('#ffffff');
       $x_axis->set_labels($x_axis_l);

       $y_axis = new y_axis();
       $y_axis->set_range( 0, 120,20);
       $y_axis->set_grid_colour ('#dadbdc');
       $y_axis->colour = '#3c3c3c';

       $chart = new open_flash_chart();
       $chart->add_element( $bar );
	   // agregamos tags
	   $chart->add_element( $tags );
	   $chart->set_title( $title );
       $chart->set_x_axis( $x_axis );
       $chart->set_y_axis( $y_axis );
       $chart->set_bg_colour( '#F8F8F8' );
       $this->ofigura=$chart->toString();
	}
		
   function darcadena($opcion) 	{
       $this->barras();
       return   $this->ofigura;
   }
   
}

?>
