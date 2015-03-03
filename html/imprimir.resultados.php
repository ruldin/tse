<?php
session_start();
// validaciones
/* inicio de limpiar variables numericas */
function limpiarNumero($numero){
	// limpiar numero
	$numero = strip_tags($numero);
	$numero = stripslashes($numero);
	$numero = htmlspecialchars($numero);
	$numero = htmlentities($numero);
	$numero = trim($numero);
	$poner = array('','','','','','','','','','','','','','','','','','','','','','','','','','','','');
	$quitarSim = array(' ','-','_',',','.',';','@','#','"','=','$','!','%','&','/','(',')','?','¡','[',']','*','+','´','¨','<','>','|');
	$quitarMay = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','Ñ','O','P','Q','R','S','T','U','V','W','X','Y','Z','°');
	$quitarMin = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','ñ','o','p','q','r','s','t','u','v','w','x','y','z','^');
	$numero = str_replace($quitarSim,$poner,$numero);
	$numero = str_replace($quitarMay,$poner,$numero);
	$numero = str_replace($quitarMin,$poner,$numero);
	// retornar numero
	return $numero;
}
/* fin limpiar variables numericas */
/* inicio de aplicar validaciones a todos los valores SESSION */
foreach ($_REQUEST as $key => $value) {
	if ($key != 'TITULO'){
		$value = limpiarNumero($value);
		if (preg_match("/^[0-9]+$/",$value)){ $_SESSION[$key] = $value;} else { $_SESSION[$key] = 0;}
	} else {
		$_SESSION[$key] = $value;
	}
}
/* fin de aplicar validaciones a todos los valores SESSION */
/* inicio de definicion de variables a utilizar */
$depto = $_SESSION['DEPARTAMENTO'];
$muni = $_SESSION['MUNICIPIO'];
$te = $_SESSION['ELECCION'];
$tit = $_SESSION['TITULO'];
$subtitulo = strip_tags($tit);
$quitar = array('&nbsp;','&ntilde;','&aacute;','&eacute;','&iacute;','&oacute;','&uacute;','  ');
$poner = array(' ','ñ','á','é','í','ó','ú',' ');
$subtitulo = str_replace($quitar,$poner,$subtitulo);
if (empty($depto)){ $depto = 0;}; if (empty($muni)){ $muni = 0;}; if (empty($te)){ $te=1;};
switch ($te){
	case 1:
		$titulo = "SEGUNDA ELECCIÓN PRESIDENCIAL";
	break;
	case 2:
		$titulo = "DIPUTADOS POR LISTA NACIONAL";
	break;
	case 3:
		$titulo = "DIPUTADOS POR DISTRITO";
	break;
	case 4:
		$titulo = "ELECCIÓN CORPORACIÓN MUNICIPAL";
	break;
	case 5:
		$titulo = "DIPUTADOS AL PARLAMENTO CENTROAMERICANO";
	break;
}
if ($te == 4 && $depto == 13){
		$titulo = "ELECCIÓN ALCALDE Y SINDICOS";
}
date_default_timezone_set('America/Guatemala');
$textofecha = "Resultados preliminares al " . date('d/m/Y - H:i:s') . ' horas.';
/* fin de definicion de variables a utilizar */

/* variables de base de datos */
require('../include/conexion.php');
function valida($a,$b,$c) {
	 if(is_numeric($a) && ($a >-1 and $a<23))
		if(is_numeric($b) && ($b >-1 and $b<33))
			if(is_numeric($c) && ($c >0 and $c<6)) return true;
	return false;
}
function conectarDB($a,$b,$c) {
	if (!(valida($a,$b,$c))) die;
	$cdb = new cbase;
	$cdb->conectaDB();
	if ($a == 1 && $b == 1){ $a = 0;}
	$ors = $cdb->consulta("SELECT * FROM tresultado WHERE DEP=".$a." and MUN=".$b." and TIPOELECCION=".$c);
	return $ors;
}
$datos = conectarDB($depto,$muni,$te);
/* creacion de documento pdf */
define('FPDF_FONTPATH','../include/fpdf/font/');
require('../include/phplot/phplot.php');
require('../include/fpdf/mem_image.php');

/* creacion de PDF */
$pdf = new PDF_MemImage('P','mm','Letter');
	$pdf->AddPage();
	$pdf->Image('./img/encabezado.pdf.jpg',0.001,4,0,26.16);
	$pdf->ln(23);	
	$pdf->SetFont('Arial','B',16);
	/* formato linea */ $pdf->SetTextColor(50);$pdf->SetFillColor(200);$pdf->SetDrawColor(200); /* formato linea */
	$pdf->Cell(195,8,utf8_decode($titulo),'LTR',1,'C',true);
	$pdf->SetFont('Arial','B',14);
	/* formato linea */ $pdf->SetTextColor(50);$pdf->SetFillColor(220); /* formato linea */
	$pdf->Cell(195,7,utf8_decode($subtitulo),'LR',1,'C',true);
	$pdf->SetFont('Arial','',10);
	/* formato linea */ $pdf->SetTextColor(50);$pdf->SetFillColor(240); /* formato linea */
	$pdf->Cell(195,5,$textofecha,'LBR',1,'R',true);
	$pdf->SetFont('Arial','B',12);
	$pdf->ln(2);
/* inicio de contenido del PDF */
// creacion de variables limpias
	foreach($datos as $id => $dato){
		if (is_integer($id)){} else {
			$info[$id] = $dato;
		}
	}
	// si no estan vacias las variables principales
	if (!empty($info['S1']) && !empty($info['V1'])){
		
	/* formato linea */ $pdf->SetTextColor(50);$pdf->SetFillColor(200); /* formato linea */
	$pdf->Cell(195,6,utf8_decode('VOTOS VÁLIDOS POR ORGANIZACIÓN POLÍTICA'),1,1,'C',true);
	$pdf->SetFont('Arial','B',12);
	/* formato linea */ $pdf->SetTextColor(50);$pdf->SetFillColor(220); /* formato linea */
	$pdf->Cell(65,6,utf8_decode('ORGANIZACIÓN POLÍTICA'),1,0,'C',true);
	$pdf->Cell(65,6,'VOTOS',1,0,'C',true);
	$pdf->Cell(65,6,'PORCENTAJE DE VOTOS',1,1,'C',true);
	$pdf->SetFont('Arial','',12);
	/* inicio de contenido para grafica */
		$font = FPDF_FONTPATH . "VERDANA.TTF";
		$graph = new PHPlot(500,300);
		$graph->SetDefaultTTFont($font);
		$graph->SetFontTTF('title', $font, 12, 5);
		$graph->SetFontTTF('legend', $font, 7, 3);
		$graph->SetDataType('text-data');
		$data = array();
		$colores = array();
		$partidos = array();
		// ciclo para datos de grafica y lineas de partidos
		$contadorPartidos = 0;
		$posY = 76;
	for ($i = 1; $i <= 20; $i++) {
		if (!empty($info['S' . $i])){
			//declaracion de datos
			$data[] = array($info['O' . $i],'S' . $i,'V' . $i,'P' . $i, 'C' . $i);
			$contadorPartidos++;
			$posY = $posY + 6;
		}
	}
//	sort($data);
	foreach ($data as $datoVoto) {
		$pdf->Cell(65,6,$info[$datoVoto[1]],1,0,'L',false);
		$pdf->Cell(65,6,number_format($info[$datoVoto[2]],0,'.',',') . '                    ',1,0,'R',false);
		$pdf->Cell(65,6,number_format($info[$datoVoto[3]],2,'.',',') . '%                     ',1,1,'R',false);
		//declaracion de datos
		$datoVotos[] = array($info[$datoVoto[1]], $info[$datoVoto[2]]);
		$partidos[] = $info[$datoVoto[1]];
		$colores[] = '#' . $info[$datoVoto[4]];
	}
	/* formato linea */ $pdf->SetTextColor(50);$pdf->SetFillColor(240); /* formato linea */
		$pdf->Cell(65,6,utf8_decode('TOTAL DE VOTOS VÁLIDOS'),1,0,'L',true);
		$pdf->Cell(65,6,number_format($info['VOTOSVALIDOS'],0,'.',',') . '                    ',1,0,'R',true);
		$pdf->Cell(65,6,number_format(100,2,'.',',') . '%                     ',1,1,'R',true);
	$data = $datoVotos; 
		//se ingresan las variables para operarse
		$graph->SetDataColors($colores);
		$graph->SetDataValues($data);
		$graph->SetPlotType('bars');
		$graph->SetDataColors($colores,'#DEDEDE',70);
		$graph->SetLegend($partidos);
		$graph->SetTitle('votos válidos por organización política');
		$graph->SetXLabel('');
		//variables para plotear la grafica
		//deshabilito la imagen automatica para que no genere el archivo jpg
		$graph->SetPrintImage(false);
		$anchoX = 320/$contadorPartidos;
		$graph->SetLineWidths($anchoX);
		$graph->SetXDataLabelPos('plotdown');
		//$graph->SetXDataLabelAngle(75);
		$graph->SetYDataLabelPos('plotin');
		//$graph->SetYDataLabelAngle(40);
		$graph->SetPrecisionY(0);
		$graph->SetPlotAreaWorld(NULL, 0);
		$graph->SetXTickPos('none');
		$graph->SetYTickPos('none');
		$graph->SetLegendPosition(0, 0, 'image', 0, 0, 420, 48);
		$graph->SetMarginsPixels(NULL,90,NULL,NULL);
		//dibujo la grafica
		$graph->DrawGraph();
	/* fin de contenido para grafica */
		if ($contadorPartidos > 12){
			$pdf->Text(186,265,utf8_decode('Página ') . $pdf->PageNo());			
			$pdf->AddPage();
			$pdf->Text(186,265,utf8_decode('Página ') . $pdf->PageNo());			
			$pdf->Image('./img/encabezado.pdf.jpg',0.001,4,0,26.16);
			$pdf->ln(23);	
			$pdf->SetFont('Arial','B',16);
			/* formato linea */ $pdf->SetTextColor(50);$pdf->SetFillColor(200);$pdf->SetDrawColor(200); /* formato linea */
			$pdf->Cell(195,8,utf8_decode($titulo),'LTR',1,'C',true);
			$pdf->SetFont('Arial','B',14);
			/* formato linea */ $pdf->SetTextColor(50);$pdf->SetFillColor(220); /* formato linea */
			$pdf->Cell(195,7,utf8_decode($subtitulo),'LR',1,'C',true);
			$pdf->SetFont('Arial','',10);
			/* formato linea */ $pdf->SetTextColor(50);$pdf->SetFillColor(240); /* formato linea */
			$pdf->Cell(195,5,$textofecha,'LBR',1,'R',true);
			$pdf->SetFont('Arial','B',12);
			$pdf->ln(2);
			$posY=61;
			$pdf->ln(100);
		}
		// insertamos la imagen	
		$pdf->GDImage($graph->img,26,$posY,160);
		
		/* fin de contenido del PDF */
		switch($contadorPartidos){
			case 1: $pdf->ln($posY+26); break; case 2: $pdf->ln($posY+20); break;
			case 3: $pdf->ln($posY+14); break; case 4: $pdf->ln($posY+8); break;
			case 5: $pdf->ln($posY+2); break; case 6: $pdf->ln($posY-4); break;
			case 7: $pdf->ln($posY-10); break;
		}
		if ($contadorPartidos > 7 && $contadorPartidos < 13){
			$pdf->Text(186,265,utf8_decode('Página ') . $pdf->PageNo());			
			$pdf->AddPage();
			$pdf->Text(186,265,utf8_decode('Página ') . $pdf->PageNo());			
			$pdf->Image('./img/encabezado.pdf.jpg',0.001,4,0,26.16);
			$pdf->ln(23);	
			$pdf->SetFont('Arial','B',16);
			/* formato linea */ $pdf->SetTextColor(50);$pdf->SetFillColor(200);$pdf->SetDrawColor(200); /* formato linea */
			$pdf->Cell(195,8,utf8_decode($titulo),'LTR',1,'C',true);
			$pdf->SetFont('Arial','B',14);
			/* formato linea */ $pdf->SetTextColor(50);$pdf->SetFillColor(220); /* formato linea */
			$pdf->Cell(195,7,utf8_decode($subtitulo),'LR',1,'C',true);
			$pdf->SetFont('Arial','',10);
			/* formato linea */ $pdf->SetTextColor(50);$pdf->SetFillColor(240); /* formato linea */
			$pdf->Cell(195,5,$textofecha,'LBR',1,'R',true);
			$pdf->SetFont('Arial','B',12);
			$pdf->ln(2);
		}
	// imprimir lineas
	$pdf->SetFont('Arial','B',14);
	/* formato linea */ $pdf->SetTextColor(50);$pdf->SetFillColor(200); /* formato linea */
	$pdf->Cell(195,6,'TOTALES',1,1,'C',true);
	$pdf->ln(2);
	$pdf->SetFont('Arial','B',12);
	/* formato linea */ $pdf->SetTextColor(50);$pdf->SetFillColor(220); /* formato linea */
	$pdf->Cell(45,5,utf8_decode('VOTOS VÁLIDOS'),1,0,'C',true);
	$pdf->Cell(45,5,'VOTOS NULOS',1,0,'C',true);
	$pdf->Cell(45,5,'VOTOS BLANCOS',1,0,'C',true);
	$pdf->Cell(60,5,'VOTOS EMITIDOS',1,1,'C',true);
	/* formato linea */ $pdf->SetTextColor(50);$pdf->SetFillColor(240); /* formato linea */
	$pdf->Cell(45,6,number_format($info['VOTOSVALIDOS'],0,'.',',') . ' (' . number_format(($info['VOTOSVALIDOS']*100)/$info['TOTALVOTOS'],2,'.',',') . '%)',1,0,'C',true);
	$pdf->Cell(45,6,number_format($info['NULOS'],0,'.',',') . ' (' . number_format($info['PNULOS'],2,'.',',') . '%)',1,0,'C',true);
	$pdf->Cell(45,6,number_format($info['BLANCOS'],0,'.',',') . ' (' . number_format($info['PBLANCOS'],2,'.',',') . '%)',1,0,'C',true);
	$pdf->Cell(60,6,number_format($info['TOTALVOTOS'],0,'.',',') . ' (' . number_format(100,2,'.',',') . '%)',1,1,'C',true);
	$pdf->ln(2);
	/* formato linea */ $pdf->SetTextColor(50);$pdf->SetFillColor(220); /* formato linea */
	$pdf->Cell(65,6,utf8_decode('PARTICIPACIÓN'),1,0,'C',true);
	$pdf->Cell(65,6,'ABSTENCIONISMO',1,0,'C',true);
	$pdf->Cell(65,5,'VOTANTES INSCRITOS',1,1,'C',true);
	/* formato linea */ $pdf->SetTextColor(50);$pdf->SetFillColor(240); /* formato linea */
	$pdf->Cell(65,6,number_format(($info['CNTVOTANTES']-$info['ABSTENCIONISMO']),0,'.',',') . ' (' . number_format((($info['CNTVOTANTES']-$info['ABSTENCIONISMO'])*100)/$info['CNTVOTANTES'],2,'.',',') . '%)',1,0,'C',true);
	$pdf->Cell(65,6,number_format($info['ABSTENCIONISMO'],0,'.',',') . ' (' . number_format(($info['ABSTENCIONISMO']*100)/$info['CNTVOTANTES'],2,'.',',') . '%)',1,0,'C',true);
	$pdf->Cell(65,6,number_format($info['CNTVOTANTES'],0,'.',',') . ' (100.00%)',1,1,'C',true);
	$pdf->ln(2);
	/* formato linea */ $pdf->SetTextColor(50);$pdf->SetFillColor(220); /* formato linea */
	$pdf->Cell(98,5,'JRV TOTALIZADAS',1,0,'C',true);
	$pdf->Cell(97,5,'TOTAL JRV',1,1,'C',true);
	/* formato linea */ $pdf->SetTextColor(50);$pdf->SetFillColor(240); /* formato linea */
	$pdf->Cell(98,6,number_format($info['MESASPRO'],0,'.',',') . ' (' . number_format($info['PMESASPRO'],2,'.',',') . '%)',1,0,'C',true);
	$pdf->Cell(97,6,number_format($info['CNTMESAS'],0,'.',','),1,1,'C',true);
	$pdf->ln(6);	
	
	}
/* inicio define nombre de documento */
$subtitulo = strtolower($subtitulo);
$quitar1 = array('Á','É','Í','Ó','Ú','Ñ','á','é','í','ó','ú','ñ',' ','_',':');
$poner1 = array('a','e','i','o','u','ny','a','e','i','o','u','ny','-','-','-');
$quitar2 = array('----','---','--');
$poner2 = array('-','-','-');
$subtitulo = str_replace($quitar1, $poner1,$subtitulo);
$subtitulo = str_replace($quitar2, $poner2,$subtitulo);
$subtitulo = $subtitulo . '.pdf';
/* fin define nombre de documento */
/* salida de documento pdf */
$pdf->Output($subtitulo,'D');
//$pdf->Output($subtitulo,'I');
?>
