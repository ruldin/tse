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
$_SESSION['TITULO']='Actas por Municipio';
$_SESSION['DEPARTAMENTO']=0;
$_SESSION['MUNICIPIO']=0;
$_SESSION['ELECCION']=1;
$_SESSION['DETALLE']=1;

$_SESSION['TOTPARTIDO']=4;
$_SESSION['MAXPARTIDO']=20;
$_SESSION['PROCESO']=PROCESO;
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
$otit = new ctitulo($te,$tit,'');
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
</head>
<?php flush(); ?>
<body style="margin:0; padding:0;">
<div style="z-index: 9999; border-bottom: 1px solid #CCC; margin: 0px; padding: 5px; color: rgb(79, 77, 59); background-color: #FFFFFF; font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; margin-bottom:20px; text-align:right;">
	<span style="text-align: left;"><a href="http://resultados2011.tse.org.gt/nebaj" style="color:#0061C1; text-decoration:none;">Resultados Elecciones Nebaj<span style="font-size:125%;">&raquo;</span></a><span>
	<a href="primeravuelta/index_mesa.php" style="color: #06246f; text-decoration:none;">Ver resultados preliminares por Mesa de la Primera Vuelta<span style="font-size:125%;">&raquo;</span></a>
</div>
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
	<div id="header">
		<table>
			<tr>
				<td class="c1">
				<img id="lheader" src="img/header.png"/>
				</td>	<!-- title -->
				<td class="c2"><img id="lelecciones" src="img/logo.gif"/></td>	<!-- logo -->
			</tr>
		</table>
	</div>

	<div id="body">
		<!-- tabs -->
		<ul class="css-tabs">
			<li><a href="#">Resultados por Mesa</a></li>
			<li><a href="#" onclick="window.location.href='index.php';">Resultados por Departamento y Municipio</a></li>
		</ul>
		 
		<!-- panes -->
		<div class="css-panes">

			<!-- pane1 -->
			<div>
				<div id="menu">
					<form name="formesa">
					<table>
					<tr>
					<td><div id="mdetalle"><?php $odetalle = new ctipodetalle(3);  echo $odetalle->datostipo(); ?></div></td>
					<td><div id="mtipo"><?php $otipo = new ctipoeleccion(4);  echo $otipo->datostipo(); ?></div></td>
					<td><div id="mdepto" style="display:none;"></div></td>
					<td><div id="mmuni" style="display:none;"></div></td>
					</tr>
					</form>
					</table>
					<div id="clear"></div>
				</div>

				<div id="title">
					<div id="dtitulo">
						<?php 
						date_default_timezone_set('America/Guatemala');
						$html='<table><tr><td class="t1">'.$_SESSION['TITULO'].'</td></tr>';
						$html.='<tr><td class="t2"></td></tr>';
						$html.='<tr><td class="t3"></td></tr></table>';
						echo $html;					
						?>
					</div>
				</div>
				
				<div id="main">
					<div id="fresultado"></div>
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
								
				<div id="footer">
                	<div style="float:right;padding-top:2px;padding-right:5px;"><img alt="Web Movil" width="100" src="img/movil.png"/></div>
					<label>Tribunal Supremo Electoral<br/>
					Guatemala Centroam&eacute;rica<br/>
					&copy; 2011</label>
					<div id="clear"></div>
				</div>
			</div>
			<!-- pane1 -->

			<!-- pane2 -->
			<div>
			</div> 
			<!-- pane2 -->

		</div>
	</div>
</div>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery.tools.min.js"></script>
<script type="text/javascript" src="js/jquery.metadata.min.js"></script>
<script type="text/javascript" src="js/jquery.maphilight.min.js"></script>
<script type="text/javascript" src="js/ajax201102_mesa.js"></script>
<script type="text/javascript" src="js/json2.js"></script>
<script type="text/javascript" src="js/swfobject.js"></script>
<script type="text/javascript">
swfobject.embedSWF("open-flash-chart.swf", "fgrafica", "100%", "300", "9.0.0");
</script>
<script type="text/javascript">
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
</script> 
<script>$(function() {$(".css-tabs:first").tabs(".css-panes:first > div");});</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-21711399-3']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body> 
</html>
