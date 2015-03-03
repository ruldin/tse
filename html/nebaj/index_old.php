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
$_SESSION['TITULO']='<b>Departamento:</b> Quich&eacute; <b>Municipio:</b> Nebaj';
$_SESSION['DEPARTAMENTO']=14; //Quiché
$_SESSION['MUNICIPIO']=13;	//Nebaj: 13, Chinique: 3
$_SESSION['ELECCION']=4;
$_SESSION['PROCESO']=201301; //201102

$_SESSION['DETALLE']=1;		
$_SESSION['TOTPARTIDO']=20; //6
$_SESSION['MAXPARTIDO']=20; //20
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
		var miloc = "./m/index.php";
		if (screen.width<768){
			this.location.href=miloc;
		}
	</script>
<link rel="stylesheet" href="js/lightbox.css" type="text/css" />
<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	datoGrafica = <?php echo $fig->darcadena($_SESSION['GRAFICA']); ?>;
	tipoeleccion = jQuery('select[name="tipo"]').attr('selected',true).val();
	if (tipoeleccion == 1){
		p1 = datoGrafica['elements'][0]['values'][0]['tip'].substring(0,1);
		v1 = datoGrafica['elements'][0]['values'][0]['top'];
		p2 = datoGrafica['elements'][0]['values'][1]['tip'].substring(0,1);
		v2 = datoGrafica['elements'][0]['values'][1]['top'];
		if (p1 == 'P' && v1 >= v2){
			jQuery('#fotoPP').css('float','left');
			jQuery('#fotoLIDER').css('float','right');
		} else {
			jQuery('#fotoLIDER').css('float','left');
			jQuery('#fotoPP').css('float','right');
		}
		jQuery('#dfotos').slideDown('slow');
	} else {
		jQuery('#dfotos').slideUp('slow');
	}
	jQuery('area, select[name="tipo"], select[name="dep"], select[name="mun"]').live('hover',function(){
		jQuery('#davance').slideUp('slow').html('');
		jQuery('#incluyeavance').html('Mostrar Avances&raquo;');
		if (jQuery('select[name="mun"]').attr('selected',true).val() != 'undefined' && jQuery('select[name="mun"]').attr('selected',true).val() > 0 ){
			jQuery('#incluyeavance').html('');
		}
	});
	jQuery('area, select[name="tipo"], select[name="dep"], select[name="mun"]').live('click',function(){
		if (jQuery('select[name="mun"]').attr('selected',true).val() != 'undefined' && jQuery('select[name="mun"]').attr('selected',true).val() > 0 ){
			jQuery('#incluyeavance').html('');			
		}
		datoGrafica = <?php echo $fig->darcadena($_SESSION['GRAFICA']); ?>;
		tipoeleccion = jQuery('select[name="tipo"]').attr('selected',true).val();
		if (tipoeleccion == 1){
			p1 = datoGrafica['elements'][0]['values'][0]['tip'].substring(0,1);
			v1 = datoGrafica['elements'][0]['values'][0]['top'];
			p2 = datoGrafica['elements'][0]['values'][1]['tip'].substring(0,1);
			v2 = datoGrafica['elements'][0]['values'][1]['top'];
			if (p1 == 'P' && v1 >= v2){
				jQuery('#fotoPP').css('float','left');
				jQuery('#fotoLIDER').css('float','right');
			} else {
				jQuery('#fotoLIDER').css('float','left');
				jQuery('#fotoPP').css('float','right');
			}
			jQuery('#dfotos').slideDown('slow');
		} else {
			jQuery('#dfotos').slideUp('slow');
		}
	});
	jQuery('select[name="tipo"], select[name="dep"], select[name="mun"]').live('change',function(){
		datoGrafica = <?php echo $fig->darcadena($_SESSION['GRAFICA']); ?>;
		tipoeleccion = jQuery('select[name="tipo"]').attr('selected',true).val();
		if (tipoeleccion == 1){
			p1 = datoGrafica['elements'][0]['values'][0]['tip'].substring(0,1);
			v1 = datoGrafica['elements'][0]['values'][0]['top'];
			p2 = datoGrafica['elements'][0]['values'][1]['tip'].substring(0,1);
			v2 = datoGrafica['elements'][0]['values'][1]['top'];
			if (p1 == 'P' && v1 >= v2){
				jQuery('#fotoPP').css('float','left');
				jQuery('#fotoLIDER').css('float','right');
			} else {
				jQuery('#fotoLIDER').css('float','left');
				jQuery('#fotoPP').css('float','right');
			}
			jQuery('#dfotos').slideDown('slow');
		} else {
			jQuery('#dfotos').slideUp('slow');
		}
	});
	jQuery('#incluyeavance').live('click',function(){
		if (jQuery('#davance').is(':visible')){
			jQuery('#incluyeavance').html('Mostrar Avances&raquo;');
		} else {
			jQuery('#incluyeavance').html('&laquo;Ocultar Avances');
		}
		jQuery('#davance').slideToggle('slow');
		proceso = <?php echo $_SESSION['PROCESO']?>;
		te = jQuery('select[name="tipo"]').attr('selected',true).val();
		depto = jQuery('select[name="dep"]').attr('selected',true).val();
		muni = jQuery('select[name="mun"]').attr('selected',true).val();
		if (te == 'undefined'){ te = 1;}
		if (depto == 'undefined'){ depto = 0;}
		if (te == 1 && depto == 0){ muni = 0;}
		if (te == 4 && depto == 6){ muni = 13;}
		if (te == 4 && depto == 13){ muni = 21;}
		if (te == 4 && depto == 14){ muni = 3;}
		if (te == 4 && depto == 17){ muni = 2;}
		if (te == 4 && depto == 18){ muni = 3;}
		if (muni == 'undefined'){ muni = 0;}
		jQuery.post('actas.php',{proceso:proceso, depto:depto, muni:muni, te:te},function(data) {
			jQuery('#davance').html("<img src='img/ajax-loader_max.gif'/>").html(data);
		});
	});
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
</head>
<?php flush(); ?>
<body style="margin:0; padding:0;">
<div style="z-index: 9999; border-bottom: 1px solid #CCC; margin: 0px; padding: 5px; color: rgb(79, 77, 59); background-color: #FFFFFF; font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; margin-bottom:20px; text-align:right;">
	<a href="primeravuelta/index.php" style="color:#0061C1; text-decoration:none;">Ver resultados preliminares de la Primera Vuelta<span style="font-size:125%;">&raquo;</span></a>
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
			<li><a href="#">Resultados por Departamento y Municipio</a></li>
			<li><a href="#" onClick="window.location.href='index_mesa.php';">Resultados por Mesa</a></li>
		</ul>
		 
		<!-- panes -->
		<div class="css-panes">

			<!-- pane1 -->
			<div>
				<div id="menu">
					<form name="formulario">
					<table>
					<tr>
					<td><div id="mtipo"><?php /*echo $otipo->datostipo();*/ echo '&nbsp;Tipo elecci&oacute;n:<br/>&nbsp;Corporaci&oacute;n Municipal'; ?></div></td>
					<td><div id="mdepto"><?php echo 'Departamento:<br/>Quich&eacute;'; /*include_once('../include/consultamarco.php');*/ ?></div></td>
					<td><div id="mmuni"><?php echo 'Municipio:<br/>Nebaj'; ?></div></td>
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
							<td class="map">
                            	<div id="dmapa" style="background-color: red;">
									<?php //echo $miMapa->show($depto,$te);?>
									<img class="map" src="mapas/dpto_14.png" width=400 height=334 border=0 usemap="#dpto_414_Map">
									<MAP NAME="dpto_414_Map">
									<AREA SHAPE="poly" TITLE="NEBAJ" COORDS="132,104, 133,104, 134,104, 135,104, 136,104, 137,104, 138,104, 138,105, 138,106, 138,107, 138,108, 138,109, 138,110, 138,111, 138,112, 137,113, 136,114, 136,115, 136,116, 136,117, 137,118, 138,119, 139,120, 140,121, 140,122, 140,123, 139,124, 139,125, 140,126, 141,126,
									142,127, 143,127,
									144,128, 145,128, 146,129, 147,129, 148,130, 148,131, 147,132, 148,133, 147,133, 146,134, 145,135, 145,136, 144,137, 144,138, 144,139, 145,140, 146,141, 146,142, 147,143, 147,144, 147,145, 146,146, 145,147, 145,148, 146,149, 147,150, 148,150, 148,151, 147,151, 146,151, 145,151, 144,152, 143,152, 142,153, 143,154, 143,155,
									144,156, 145,156, 146,157, 147,157, 147,158, 148,159, 149,160, 149,161, 149,162, 149,163, 149,164, 150,165, 151,165, 151,166, 152,167, 153,168, 154,169, 154,170, 155,171, 155,172, 156,173, 157,174, 157,175, 157,176, 156,177, 155,177, 154,177, 153,176, 152,176, 151,176, 150,177, 149,177, 148,178, 147,178, 146,179, 146,180,
									146,181, 147,182, 147,183, 146,182, 145,182, 144,182, 143,181, 143,180, 142,179, 141,179, 140,179, 139,179, 138,179, 137,179, 136,179, 135,179, 134,179, 133,179, 132,178, 131,178, 130,178, 129,178, 128,177, 127,177, 126,177, 125,177, 124,178, 123,177, 122,177, 121,177, 120,177, 119,177, 118,177, 117,176, 116,175, 115,175,
									115,174, 114,173, 113,173, 112,173, 111,172, 110,173, 109,173, 108,173, 108,172, 107,171, 106,170, 105,170, 104,170, 103,170, 102,171, 102,170, 103,169, 104,169, 105,168, 106,168, 107,167, 107,166, 107,165, 106,164, 105,164, 104,164, 103,164, 102,164, 103,163, 102,162, 102,161, 101,160, 100,160, 100,159, 100,158, 100,157,
									100,156, 99,155, 99,154, 99,153, 100,152, 101,151, 102,150, 102,149, 103,148, 104,148, 105,147, 105,146, 105,145, 105,144, 105,143, 105,142, 105,141, 106,140, 107,139, 107,138, 107,137, 108,138, 109,139, 110,140, 111,140, 112,139, 112,138, 113,138, 114,138, 115,137, 115,136, 116,135, 116,134, 115,133, 116,133, 117,134,
									118,134,
									119,133, 119,132, 120,132, 121,132, 122,131, 123,130, 123,129, 124,128, 124,127, 125,126, 126,125, 127,124, 127,123, 127,122, 127,121, 128,120, 129,119, 130,119, 131,118, 132,117, 132,116, 133,115, 132,114, 131,113, 131,112, 130,111, 129,110, 130,110, 131,110, 132,110, 133,110, 134,109, 133,108, 134,107, 134,106, 133,105"
									HREF="#" class="{fillColor:'5695DD', strokeColor:'034693', alwaysOn:true, fillOpacity:1}">
									</MAP>
								</div>                                
                            </td>	<!--  map -->
							<td class="chart"> <!-- chart & table -->
								<table>
								<tr><td>
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
								</table>							
							</td>
							<!-- 
							<td class="chart">
								Actas Procesadas 2013
							</td>
							-->
							<td class="grid">
                            	<div id="ftabla"><?php $tab->construyeTabla($depto,$muni,$te,''); ?></div><br/>
                            	<form method="post" action="imprimir.resultados.php">
                                	<fieldset>
                                    	<legend style="text-align:center;">Imprimir Resultados<br/>Preliminares</legend>
                                		<input type="image" src="./img/imprimir.png"/>
                                    </fieldset>
                                </form>
                          </td>
						</tr>
					</table>
				</div>
				
				<div id="davance"></div>

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
			<!-- pane2 -->

		</div>
	</div>
</div>
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
