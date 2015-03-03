<?php
include_once 'conexion.php';
include_once 'php-ofc-library/open-flash-chart.php';

class cfigura {
// Clase para  despliegue de gráficas
    private $f_tp;
	private $f_mp;
	private $f_dep;
	private $f_mun;
	private $f_te;
	private $ofigura;
        private $proceso;
    private $ors;	
	
    function __construct($tp,$mp,$dep,$mun,$te) {
       $this->f_tp=$tp;
       $this->f_mp=$mp;
       if($dep==1 and $mun==1) { $this->f_dep=0; } else $this->f_dep=$dep;
       $this->f_mun=$mun;
       $this->f_te=$te;
       $this->proceso=$_SESSION['PROCESO'];

	   $this->conectarDB();
	}
    function valida() { 
	     if(is_numeric($this->f_dep) && ($this->f_dep >-1 and $this->f_dep<23))
		    if(is_numeric($this->f_mun) && ($this->f_mun >-1 and $this->f_mun<33))
	   		    if(is_numeric($this->f_te) && ($this->f_te >0 and $this->f_te<6)) return true;
		return false;		
	}
	
    function ceiling($number, $significance = 1)
    {  if($number<10) return ( is_numeric($number) && is_numeric(10) ) ? (ceil($number/10)*10) : false;
       return ( is_numeric($number) && is_numeric($significance) ) ? (ceil($number/$significance)*$significance) : false;
    }
	
	function conectarDB() {
	   if (!($this->valida())) die; //probablemente sql injected
       $cdb = new cbase;
       $cdb->conectaDB();
	   	
		$deptoProceso = $this->f_dep;
		$munProceso = $this->f_mun;
		$teProceso = $this->f_te;
		/* incio de filtro consulta */
		// filtros php
		$poner = array('','','','','','','');
		$quitar1 = array('+','union','all','%','?',' ','=');
		$quitar2 = array('-','_','a','e','i','o','u');
		// pasamos 2 filtros a las variables
		$deptoProceso = str_replace($quitar1,$poner,$deptoProceso);
		$deptoProceso = str_replace($quitar2,$poner,$deptoProceso);

		$munProceso = str_replace($quitar1,$poner,$munProceso);
		$munProceso = str_replace($quitar2,$poner,$munProceso);
		
		$teProceso = str_replace($quitar1,$poner,$teProceso);
		$teProceso = str_replace($quitar2,$poner,$teProceso);
		
		// consultamos si cada dato es numerico
		if (is_numeric($deptoProceso) && is_numeric($munProceso) && is_numeric($teProceso)){
			// realizamos el segundo filtro, cortar las variables
			$deptoProceso = substr($deptoProceso,0,2);
			$munProceso = substr($munProceso,0,2);
			$teProceso = substr($teProceso,0,2);
		} else {
			$deptoProceso = substr($deptoProceso,0,2);
			$munProceso = substr($munProceso,0,2);
			$teProceso = substr($teProceso,0,2);
		} 		
		/* fin de filtro consulta */
       $this->ors=$cdb->consulta("SELECT * FROM tresultado WHERE DEP=".$deptoProceso." and MUN=".$munProceso." and TIPOELECCION=".$teProceso." and PROCESO=".$this->proceso);
	}

    function barras() {
       $mayor=0;
       $data = array();
       $dataL = array();
       if ($this->ors > 0 ){
           $i=0;
           $a_orden = array();
           while ( $i< $this->f_mp && $this->ors[11 +($i*5)]<>'' ) {
               if($this->f_te==1) $a_orden[]= $i;
               else $a_orden[]= $this->ors[10 +($i*5)];
               $i++; 
           }
           asort($a_orden);
           $i=0;
           $otros=0;$otrospor=0;$haymas=0;
		   
	   $x = 0;				
	   // incluye funcion de tags para labels
	   $tags = new ofc_tags();
	   $tags->font("Verdana", 9)->colour("#000000")->align_x_center()->text('#y#');
			
           foreach($a_orden as $key => $val) {
              if($i<$this->f_tp) {
	        $bar = new bar_value($this->ors[13+($key*5)]);
	        if($this->ors[13+($key*5)]>$mayor) $mayor=$this->ors[13+($key*5)];
	         $bar->set_tooltip($this->ors[11+($key*5)].'<br>#val#<br>'.number_format($this->ors[14+($key*5)],2).'%');
		 $bar->set_colour( $this->ors[12+($key*5)] );
		 $data[]  = $bar;
		 $dataL[] = new x_axis_label( $this->ors[11+($key*5)],$this->ors[12+($key*5)],10,315 );
		 // publicacion de tags
		 $tags->append_tag(new ofc_tag($i, $this->ors[13+($key*5)]));				
		 } 
              else {
                 $otros= $otros+$this->ors[13+($key*5)];
                 $otrospor=$otrospor+ number_format($this->ors[14+($key*5)],2);
                 $haymas=1;
              }
              $i++;
           }   
		   
           if( $haymas==1) {  //esto hay que corroborar para sumar bien
                   if($otros>$mayor) $mayor=$otros;
                   $bar = new bar_value($otros);
                   $bar->set_colour( "#24697d" ); //color otros
                   $bar->set_tooltip('OTROS<br>'.$otros. '<br>'.$otrospor.'%');
                   $data[]  = $bar;
                   $dataL[] =new x_axis_label( "OTROS","#24697d",10,315 );

           }
       }

       $bar = new bar_3d();
       $bar->set_values( $data );
       $bar->set_alpha( 0.9 );
       $bar->colour = '#ffffff';

       $x_axis_l = new x_axis_labels();
       $x_axis_l-> set_labels($dataL);

       $x_axis = new x_axis();
       $x_axis->set_3d( 7 );
       $x_axis->colour = '#7d7a7a';
       $x_axis->set_grid_colour ('#ffffff');
       $x_axis->set_labels($x_axis_l);

       $y_axis = new y_axis();
       $y_axis->set_range( 0, $this->ceiling($mayor,100)+round($this->ceiling($mayor,100)/10,-1) , round($this->ceiling($mayor,100)/10,-1) );
//       $y_axis->set_range( 0, 1500000, 100000 );
       $y_axis->set_grid_colour ('#dadbdc');
       $y_axis->colour = '#dadbdc';

       $chart = new open_flash_chart();
       $chart->add_element( $bar );
	   // agregamos tags   
	   $chart->add_element( $tags );
       $chart->set_x_axis( $x_axis );
       $chart->set_y_axis( $y_axis );
       $chart->set_bg_colour( '#ffffff' );
//         $this->ofigura=$chart->toPrettyString();
           $this->ofigura=$chart->toString();

	}
	
    function pastel() {
       $data = array();

       if ($this->ors > 0 ){
           $i=0;
           $a_orden = array();
           while ( $i< $this->f_mp && $this->ors[11 +($i*5)]<>'' ) {
                    $a_orden[]=  $this->ors[10 +($i*5)];
                    $i++;
           }
           asort($a_orden);
           $i=0;
           $otros=0;$otrospor=0;$haymas=0;
			// incluye funcion de tags para labels
			$tagp = new ofc_tags();
			$tagp->font("Verdana", 9)->colour("#000000")->align_x_center()->text('#y# votos');
			$x = 0;
           foreach($a_orden as $key => $val) {
              if($i<$this->f_tp) {
                   $tmp = new pie_value($this->ors[13+($key*5)]/1,$this->ors[11+($key*5)]);
                   $tmp->set_tooltip($this->ors[11+($key*5)].'<br>#val#<br>'.number_format($this->ors[14+($key*5)],2).'%');
                   $tmp->set_colour( $this->ors[12+($key*5)] );
                   $data[] = $tmp;
					// publicacion de tags
					$tagp->append_tag(new ofc_tag($x,$this->ors[13+($key*5)]));
					$x++;
              }
              else {
                   $otros= $otros+$this->ors[13+($key*5)];
                   $otrospor=$otrospor+ number_format($this->ors[14+($key*5)],2);
                   $haymas=1;
              }
              $i++;
           }
           if( $haymas==1) {  //esto hay que corroborar para sumar bien
               $tmp = new pie_value($otros/1,'OTROS');
               $tmp->set_tooltip('OTROS<br>#val#<br>'.number_format($otrospor,2).'%');
               $tmp->set_colour( "#24697d" );
               $data[] = $tmp;
           }
       }

       $pie = new pie();
       $pie->start_angle(35)
           ->add_animation( new pie_fade() )
           ->add_animation( new pie_bounce(10) )
//    ->gradient_fill()
           ->tooltip( '#val#<br>#percent#' ) //falta resolver como mostar los porcentajes y solo 5 como max
           ->radius(100)
        ;
        $pie->set_values( $data );
        $pie->set_alpha( 0.9 );

        $chart = new open_flash_chart();
        $chart->add_element( $pie );
        $chart->set_bg_colour( '#ffffff' );
//          $this->ofigura=$chart->toPrettyString();
            $this->ofigura=$chart->toString();
		
   }
   
   function darcadena($opcion) 	{
       if ($opcion==1)  $this->barras();
	   else $this->pastel();
       return   $this->ofigura;
   }
   
}
?>
