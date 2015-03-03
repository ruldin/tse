<?php 
session_start();
header("max-age=3600, cache-control: must-revalidate");
$offset = 60 * 60 * 24 * 10;
$ExpStr = "expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
header($ExpStr);

/*	INCLUDE */
include_once '../include/tabla.php';
include_once '../include/figura.php';
include_once '../include/titulo.php';
include_once '../include/logo.php';
include_once '../include/tipoeleccion.php';
include_once '../include/tipodetalle.php';
include_once '../include/mapa.php';
include_once '../include/config.php';

/* VARIABLES DE SESI�N*/
//if (!isset($_SESSION['TITULO']))
//{
	$_SESSION['TITULO']='NIVEL NACIONAL';
	    $_SESSION['DEPARTAMENTO']=0; 
	$_SESSION['MUNICIPIO']=0;
	$_SESSION['ELECCION']=1;
	$_SESSION['DETALLE']=1;
//}
$_SESSION['TOTPARTIDO']=10;
$_SESSION['MAXPARTIDO']=20;
$_SESSION['PROCESO']=201102;
$_SESSION['GRAFICA']=1;     // 1 BARRA 2 PASTEL
$_SESSION['FORMA']=3;      //  1 TABLA 2 LISTADO 3 COMBO

$tit=$_SESSION['TITULO'];
$depto=$_SESSION['DEPARTAMENTO'];
$muni=$_SESSION['MUNICIPIO'];
$te=$_SESSION['ELECCION'];
$tp=$_SESSION['TOTPARTIDO'];
$mp=$_SESSION['MAXPARTIDO'];

/*	OBJETOS	*/
$miMapa = new mapa();
$fig = new cfigura($_SESSION['TOTPARTIDO'],$_SESSION['MAXPARTIDO'],$depto,$muni,$te,'');
$otipo = new ctipoeleccion(3);
$ologo= new clogo();
$tab = new ctabla();

/*COMPRESI�N */
ini_set ('zlib.output_compression', 'On') ;
ini_set ('zlib.output_compression_level', '1') ;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Tribunal Supremo Electoral - Resultados Elecciones Generales y al Parlamento Centroamericano 2011</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
	<script language="JavaScript">
		var miloc = "http://resultados2011.tse.org.gt/m/index.php";
		if (screen.width<800){
			this.location.href=miloc;
		}
	</script>
<link rel="stylesheet" href="js/lightbox.css" type="text/css" />
<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	datoGrafica = <?php echo $fig->darcadena($_SESSION['GRAFICA']); ?>;
	datoDep = 6;
});
</script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.tools.min.js"></script>
<script type="text/javascript" src="js/jquery.metadata.min.js"></script>
<script type="text/javascript" src="js/jquery.maphilight.min.js"></script>
<script type="text/javascript" src="js/ajax201102.js"></script>
<script type="text/javascript" src="js/json2.js"></script>
<script type="text/javascript" src="js/swfobject.js"></script>
<script type="text/javascript" src="js/ajaxmesa.js"></script>
<script type="text/javascript">
swfobject.embedSWF("open-flash-chart.swf", "fgrafica", "100%", "300", "9.0.0");
</script>
<script type="text/javascript">
cargar_tipo(4);
  function open_flash_chart_data() {
return JSON.stringify(data);
}
function load_1(){
  tmp = findSWF("fgrafica");
  x = tmp.load( JSON.stringify(data) );
}
function findSWF(movieName) {
  if (navigator.appName.indexOf("Microsoft")!= -1) {
	return window[movieName];
  } else {
	return document[movieName];
  }
}
function asignaTexto(str){ 
	  data =eval('(' + str + ')') ;
}
var tf = 1;
var data = <?php echo $fig->darcadena($_SESSION['GRAFICA']); ?>;
</script>
<script type="text/javascript">
	var tmpColor=''; 
	$(function() {
		$('.map').maphilight();
		$('area').mouseover(function(e) {
		e.preventDefault();
		var data = $(this).data('maphilight') || {};
		tmpColor=data.fillColor;
		data.strokeColor='D3D3D3';
		data.strokeWidth=3;
		data.fillColor='5695DD';
		$(this).data('maphilight', data).trigger('alwaysOn.maphilight');});
		$('area').mouseout(function(e) {
		e.preventDefault();
		var data = $(this).data('maphilight') || {};
		data.strokeColor='034693';
		data.strokeWidth=1;
		data.fillColor=tmpColor;
		$(this).data('maphilight', data).trigger('alwaysOn.maphilight');});			
	});
	//var dataFotos = JSON.stringify(data['elements'][0]['values']);

</script>
<script>$(function() {$(".css-tabs:first").tabs(".css-panes:first > div");});</script>
<script type="text/javascript" src="js/jquery.timers.js"></script>
<script type="text/javascript">
var times = 1*10*100*1000;
$(document).everyTime(1000, function(i){
	var cr = $('#cuentaregresiva').text();
	if (cr < 2 ){
		if ($('select[name="tipo"]').val() == 4){
		      $('#mtipo select option[value=4]').attr('selected','');
		}
	      $('#mtipo select option[value=4]').attr('selected','selected');
	      datoDep = $('select[name="dep"]').attr('selected',true).val();
		      if (datoDep == 6){
			  //cargar_tipo(4);
			  $('#mdepto select option[value=6]').attr('selected','');
			  $('#mdepto select option[value=13]').attr('selected','selected');
			  Cargar_selectD(13);
		      };
		      if (datoDep == 13){
			  //cargar_tipo(4);
			  $('#mdepto select option[value=13]').attr('selected','');
			  $('#mdepto select option[value=14]').attr('selected','selected');
			  Cargar_selectD(14);
		      };
		      if (datoDep == 14){
			  //cargar_tipo(4);
			  $('#mdepto select option[value=14]').attr('selected','');
			  $('#mdepto select option[value=17]').attr('selected','selected');
			  Cargar_selectD(17);
		      };
		      if (datoDep == 17){
			  //cargar_tipo(4);
			  $('#mdepto select option[value=17]').attr('selected','');
			  $('#mdepto select option[value=18]').attr('selected','selected');
			  Cargar_selectD(18);
		      };
		      if (datoDep == 18){
			  //cargar_tipo(4);
			  $('#mdepto select option[value=18]').attr('selected','');
			  $('#mdepto select option[value=6]').attr('selected','selected');
			  Cargar_selectD(6);
		      };
		 cr = 45;
		 datoGrafica = <?php echo $fig->darcadena($_SESSION['GRAFICA']); ?>;
	} else {
		cr = cr - 1;
	}
	$('#cuentaregresiva').text(cr);
	if (cr < 6 ){
		$('#cuentaregresiva').css({color:'#990000'});	
	} else {
		$('#cuentaregresiva').css({color:'#0078C9'});	
	}
}, times);
</script>
</head>
<?php flush(); ?>
<body>
<!--<div style="z-index: 9999; border-bottom: 1px solid #CCC; margin: 0px; padding: 5px; color: rgb(79, 77, 59); background-color: #FFFFFF; font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; margin-bottom:20px; text-align:right;">
	<a href="primeravuelta/index.php" style="color:#0061C1; text-decoration:none;">Ver resultados preliminares de la Primera Vuelta<span style="font-size:125%;">&raquo;</span></a>
</div>-->
<!--[if lte IE 6]>
<div style="z-index: 9999; border-bottom: 1px solid rgb(223, 221, 203); margin: 0px; padding: 5px; color: rgb(79, 77, 59); background: none repeat scroll 0% 0% rgb(255, 252, 223); font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; margin-bottom:20px;" id="browser">
	<p>Usted está usando <strong>Internet Explorer 6</strong>, un navegador antiguo. Por favor actualice su navegador.
    </p>
    <p>Para que todas las funcionalidades de este sitio Web funcionen correctamente, usted debe tener una versi&oacute;n actualizada de su navegador.</p>
    <p><strong>&iquest;Cu&aacute;l navegador escoger?</strong></p>
    <table width="1020" align="center" style="font-size:11px;">
        <tr>
            <td width="200" valign="middle"><a href="http://www.mozilla.org/es-ES/download/?product=firefox-6.0.2&os=win&lang=es-ES" target="_blank" style="color: rgb(79, 77, 59);"><img src="firefox.jpg" border="0" width="30" style="vertical-align:middle" /> DESCARGA MOZILLA FIREFOX</a></td> 
            <td width="225" valign="middle"><a href="http://www.microsoft.com/windows/internet-explorer/default.aspx" target="_blank" style="color: rgb(79, 77, 59);"><img src="ie.jpg" width="30" border="0" style="vertical-align:middle" /> DESCARGA INTERNET EXPLORER 8</a></td> 
            <td width="195" valign="middle"><a href="http://www.google.com/chrome" target="_blank" style="color: rgb(79, 77, 59);"><img src="chrome.jpg" width="30" border="0" style="vertical-align:middle" /> DESCARGA GOOGLE CHROME</a></td>
            <td width="190" valign="middle"><a href="http://download.opera.com/" target="_blank" style="color: rgb(79, 77, 59);"><img src="opera.jpg" width="30" border="0" style="vertical-align:middle" /> DESCARGA OPERA BROWSER</a></td> 
            <td width="186" valign="middle"><a href="http://www.apple.com/safari/" target="_blank" style="color: rgb(79, 77, 59);"><img src="safari.jpg" width="30" border="0" style="vertical-align:middle" /> DESCARGA APPLE SAFARI</a></td> 
        </tr>
    </table>
</div>
<![endif]-->
<div id="container">
	<div id="header" style="height:90px;">
		<table>
			<tr>
				<td class="c1">
				<img id="lheader" src="img/header.png"/>
				</td>	<!-- title -->
				<td class="c2"><img id="lelecciones" style="top:22px;right:22px;" src="img/logo.gif"/></td>	<!-- logo -->
			</tr>
		</table>
	</div>

	<div id="body">
		<!-- tabs -->
		<ul class="css-tabs" style="display:none;">
			<li><a href="#">Resultados por Departamento y Municipio</a></li>
			<li><a href="#" onClick="window.location.href='index_mesa.php';">Resultados por Mesa</a></li>
		</ul>
		 
		<!-- panes -->
		<div class="css-panes">

			<!-- pane1 -->
			<div>
				<div id="menu" style="display:none;">
					<form name="formulario">
					<table>
					<tr>
					<td><div id="mtipo"><?php echo $otipo->datostipo(); ?></div></td>
					<td><div id="mdepto"><?php include_once('../include/consultamarco.php');?></div></td>
					<td><div id="mmuni" style="display:none;"></div></td>
					</tr>
					</form>
					</table>
					<div id="clear"></div>
				</div>

				<div id="title">
					<div id="dtitulo"><?php $otit = new ctitulo($te,$tit,''); echo $otit->datitulo(); ?></div>
				</div>
				
				<div id="main">		
						<table id="maint">
						<tr>
							<td class="map" style="display:none">
                            	<div id="dmapa"><?php echo $miMapa->show($depto,$te);?></div><br/>
                                <p id="incluyeavance">Mostrar Avances&raquo;</p>
                                
                            </td>	<!--  map -->
							<td class="chart"> <!-- chart & table -->
								<table>
								<tr><td id="grafico">
                                	<div id="fgrafica"></div>
                                </td></tr>
								<tr><td><div id="dlogo" style="display:none"><?php  echo $ologo->tablaLogos($depto,$muni,$te,$tp,$mp); ?></div></td></tr>
								<tr>
                                	<td>
                                    <div id="dfotos" style="margin-left:10px;padding:0 10%;">
                                    	<img id="fotoPP" alt="Partido Patriota" width="40%" src="img/pp.jpg"/>
                                    	<img id="fotoLIDER" alt="Partido Patriota" width="40%" src="img/lider.jpg"/>
                                    </div>
                                    </td>
                                </tr>
								<tr><td><div id="dradio"><?php include_once('../include/radio.php'); ?></div></td></tr>
								<tr><td width="100%" align="center" style="color:#0078C9"><p><strong>Actualizaci&oacute;n autom&aacute;tica en <span id='cuentaregresiva'>45</span> segundos</strong></p></td></tr>
								</table>							
							</td>
							<td class="grid">
                            	<div id="ftabla"><?php $tab->construyeTabla($depto,$muni,$te,''); ?></div><br/>
                            	<form method="post" action="imprimir.resultados.php">
                                	<fieldset>
                                    	<legend style="text-align:center;">Ver en el m&oacute;vil</legend>
                                		<img alt="Web Movil" width="100" src="img/movil.png"/>
                                    </fieldset>
                                </form>
                            </td>
						</tr>
					</table>
				</div>
				<div id="dhelp">
				<br/>&nbsp;&nbsp;
				En el despliegue de resultados se entiende que:
				<ul>
				<li>Las cifras son de car&aacute;cter preliminar.
				<li><strong>Votos V&aacute;lidos</strong> es la suma de los votos obtenidos por los partidos, sin considerar <strong>Votos Blancos</strong> ni <strong>Votos Nulos</strong>.
				<li>La suma de <strong>Votos V&aacute;lidos</strong>, <strong>Votos Blancos</strong> y <strong>Votos Nulos</strong> es el total de <strong>Votos Emitidos</strong>.
				<li>El total de <strong>Votantes Inscritos</strong> se refiere al n&uacute;mero de votantes que se han inscrito en el Padr&oacute;n Electoral para todas las mesas.
				<li><strong>JRV totalizadas</strong> es el n&uacute;mero de actas de las Juntas Receptoras de Votos (mesas) que hasta el momento se han computado.
				<li><strong>Total JRV</strong> es el n&uacute;mero de Juntas Receptoras de Votos que han funcionado.
				</ul>
				</div>
			<!--
				<div id="footer">
                	<div style="float:right;padding-top:2px;padding-right:5px;"></div>
					<label>Tribunal Supremo Electoral<br/>
					Guatemala Centroam&eacute;rica<br/>
					&copy; 2011</label>
					<div id="clear"></div>
				</div>
			</div> -->
		</div>
	</div>
</div>
