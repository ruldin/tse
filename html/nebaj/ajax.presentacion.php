<?php
session_start();
include_once '../../include_nebaj/config.php';
include_once '../../include_nebaj/class.inputfilter_clean.php';
include_once '../../include_nebaj/clsTabla.php'; 
include_once '../../include_nebaj/clsGrafica.php';

$xss = new InputFilter();
$_REQUEST = $xss->process($_REQUEST);

$tabla = new clsTabla(MAX_PARTIDOS,PROCESO);
$grafica = new clsGrafica(TOTAL_PARTIDOS,MAX_PARTIDOS,DEPARTAMENTO,MUNICIPIO,TIPO_ELECCION,PROCESO,"SELECT * FROM tresultado WHERE DEP=".DEPARTAMENTO." and MUN=".MUNICIPIO." and TIPOELECCION=".TIPO_ELECCION." and PROCESO=".PROCESO);
//$graficaAvance = new clsGrafica(TOTAL_PARTIDOS,MAX_PARTIDOS,DEPARTAMENTO,MUNICIPIO,TIPO_ELECCION,PROCESO,"SELECT mesaspro, cntmesas-mesaspro FROM tresultado WHERE DEP=".DEPARTAMENTO." and MUN=".MUNICIPIO." and TIPOELECCION=".TIPO_ELECCION." and PROCESO=".PROCESO);

		/*
		$ip=$_SERVER['REMOTE_ADDR']; //A la variable ip le asignamos la ip remota
		//Aquí le preguntamos por los navegadores más conocidos
         if (ereg("Netscape", $_SERVER["HTTP_USER_AGENT"]))
               $navegador = "Netscape";
           elseif(ereg("Firefox", $_SERVER["HTTP_USER_AGENT"])) 
              $navegador = "FireFox";
           elseif(ereg("MSIE", $_SERVER["HTTP_USER_AGENT"]))
               $navegador = "Microsoft IE"; 
           elseif(ereg("Opera", $_SERVER["HTTP_USER_AGENT"])) 
               $navegador = "Opera";
           elseif(ereg("Konqueror", $_SERVER["HTTP_USER_AGENT"])) 
                $navegador = "Konqueror";
           elseif(ereg("Chrome", $_SERVER["HTTP_USER_AGENT"])) 
                $navegador = "Chrome";
           elseif(ereg("Safari", $_SERVER["HTTP_USER_AGENT"])) 
                $navegador = "Safari";
           else $navegador = "Otros";

			echo "Tú ip real es: ".$ip;
			echo "<br>Y tu navegador es: ".$navegador;
			
			$country = '';
			if (!empty($ip)) {
				$country = file_get_contents('http://api.hostip.info/country.php?ip='.$ip);
				echo 'Y tu pais es: '.$country;
			}
		*/
function titulo($pTitulo) {
		$html='	<div id="title">
						<div id="dtitulo">';
		date_default_timezone_set('America/Guatemala');
		$html.='<table><tr><td class="t1">'.$pTitulo.'</td></tr>';
		$html.='<tr><td class="t2"><b>Departamento:</b> Quich&eacute; <b>Municipio:</b> Nebaj</td></tr>';
		$html.='<tr><td class="t3">Resultados preliminares&nbsp;&nbsp;&nbsp;&nbsp;'.date("d/m/Y").'&nbsp;&nbsp;&nbsp;'.date("H:i:s").'</td></tr></table>';
		$html.='		</div>
				</div>';
		return $html;
}

$html='';
switch($_REQUEST['objeto'])
{
	case 0: //Dashboard
	{
		//$html.=titulo('Corporaci&oacute;n Municipal');
		
/*		
		$html.='<script type="text/javascript">
			var data ='.$graficaPartidos->darcadena(1).';
			swfobject.embedSWF("open-flash-chart.swf","graficaPartidos","100%","350","9.0.0");
		</script>
		';			
*/
		$html.='<script type="text/javascript">
					var data ='.$grafica->darcadena(1).';
					swfobject.embedSWF("open-flash-chart.swf","graficaPartidos","100%","300","9.0.0");
					//var data ='.$grafica->darcadena(1).';
					//swfobject.embedSWF("open-flash-chart.swf","graficaAvance","100%","150","9.0.0");
				</script>
				';			

		$html.= '<div id="main">
					<div id="fresultado">';
		$html.='
						<table>
						<tr>
							<td class="map">
                            	<div id="dmapa">									
									<img src="mapas/dpto_14y.png" width=219 height=318 border=0 usemap="#dpto_414_Map">
									<br><br><span style="font-size: medium; font-weight: bold;">Nebaj, Quich&eacute;</span>
								</div>                                
                            </td>	<!--  map -->
							<td class="chart"> <!-- chart & table -->
								<table>
								<tr><td>
                                	<div id="graficaPartidos"></div>
                                </td></tr>
								<tr>
									<td>
										<div id="dradio">
										</div>
									</td>
								</tr>
								</table>							
							</td>
							<!-- 
							<td class="chart">
								Actas Procesadas 2013
							</td>
							-->
							<td class="grid">
								<div class="imprimir">
											<span><a href="imprimir.resultados.php" class="linkImprimir">Imprimir Resultados</a><span>
											<span><a href="imprimir.resultados.php" class="linkImprimir"><img src="img/impresora.gif" title="Imprimir Resultados"></a></span>
								</div>
                            	<div id="ftabla">'.$tabla->construyeTabla(DEPARTAMENTO,MUNICIPIO,TIPO_ELECCION).'</div>
                          </td>
						</tr>
						<tr>
							<td colspan="2" class="help1">
									<br/>&nbsp;&nbsp;
									En el despliegue de resultados se entiende que:
									<ul>
									<li>Las cifras son de car&aacute;cter preliminar.
									<li><strong>Votos V&aacute;lidos</strong> es la suma de los votos obtenidos por los partidos, sin considerar <strong>Votos Blancos</strong> ni <strong>Votos Nulos</strong>.
									<li>La suma de <strong>Votos V&aacute;lidos</strong>, <strong>Votos Nulos</strong> y <strong>Votos Blancos</strong> es el total de <strong>Votos Emitidos</strong>.
									<li>El total de <strong>Votantes Inscritos</strong> se refiere al n&uacute;mero de votantes que se han inscrito en el Padr&oacute;n Electoral para todas las mesas.
									<li><strong>Total JRV</strong> es el n&uacute;mero de Juntas Receptoras de Votos que han funcionado.
									<li><strong>JRV totalizadas</strong> es el n&uacute;mero de actas de las Juntas Receptoras de Votos (mesas) que hasta el momento se han computado.
									</ul>
							</td>
							<td width="25%">
								<div id="graficaAvance"></div>
							</td>
						</tr>
					</table>
		';		
		break;
	}
	case 1: //Actas por municipio
	{
		$html.=titulo('Actas por Municipio');
		$html.='<div id="main">
					<div id="fresultado">';
		$html.=$tabla->construyeListado(DEPARTAMENTO,MUNICIPIO,TIPO_ELECCION,'');
		$html.='		</div>
				</div>	';
		break;
	}
	case 2: //Escrutinio municipal
	{
		$html.=titulo('Escrutinio Municipal');
		$html.='<div id="main">
					<div id="fresultado">';
		$html.=$tabla->construyeTabla(DEPARTAMENTO,MUNICIPIO,TIPO_ELECCION,''); 
		$html.='		</div>
				</div>	';
		break;
	}
	case 3: //Resultados por mesa, detalle=0
	{
		$html.=titulo('Resultados por Mesa');
		$html.='<div id="main">
					<div id="fresultado">';
		$html.=$tabla->construyeTablaMesa($_REQUEST['tmesa'],TIPO_ELECCION,0);
		$html.='		</div>
				</div>	';
		break;
	}
	case 4: //Resultados por mesa, detalle=1
	{
		$html.=titulo('Resultados por Mesa');
		$html.='	<div id="main">
					<div id="fresultado">';
		$html.=$tabla->construyeTablaMesa($_REQUEST['tmesa'],TIPO_ELECCION,1);
		$html.='		</div>
				</div>	';
		break;
	}
}
echo $html;
?>