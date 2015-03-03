<?php
session_start();
header("max-age=3600, cache-control: must-revalidate");
$offset = 60 * 60 * 24 * 10;
$ExpStr = "expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
header($ExpStr);

/*COMPRESION */
ini_set ('zlib.output_compression','On');
ini_set ('zlib.output_compression_level','1');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Tribunal Supremo Electoral - Repetici&oacute;n de la Elecci&oacute;n de Corporaci&oacute;n Municipal de Nebaj, Quich&eacute;</title>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		
		<?php //Refresh
			//if (isset($_REQUEST['refresh']) and $_REQUEST['refresh']>0)
			//echo '<meta http-equiv="refresh" content="'.$_REQUEST['refresh'].'">';
			//echo '<meta http-equiv="refresh" content="60">';
		?>
		
		<link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/ajax201301.js"></script>
		<script type="text/javascript" src="js/swfobject.js"></script>

		<script>
			//var id=setInterval('seleccionar_tipo_de_proceso(\'0\')',5000);
		</script>

		<?php //Versión Móvil
			if (!isset($_GET['w'])) {
				echo '	<script type="text/javascript">
							if (screen.width<1024) {
								location.href="http://resultados2011.tse.org.gt/nebaj/m";
							}
						</script>';
			}
		?>		
		
		<script>
			$(document).ready(function () {
				seleccionar_tipo_de_proceso('0');
			});
		</script>
</head>
<?php flush(); ?>
<body <?php /*Refresh*/ //echo "onLoad=\"setInterval('seleccionar_tipo_de_proceso(\'0\')',30000);\"";  ?> >
<!--
<div style="z-index: 9999; border-bottom: 1px solid #CCC; margin: 0px; padding: 5px; color: rgb(79, 77, 59); background-color: #FFFFFF; font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; margin-bottom:20px; text-align:right;">
	<a href="primeravuelta/index_mesa.php" style="color:#0061C1; text-decoration:none;">Ver resultados preliminares por Mesa de la Primera Vuelta<span style="font-size:125%;">&raquo;</span></a>
</div>
-->
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
					<img id="lheader" src="img/encabezado85.png"/>
				</td>	<!-- title -->
				<td class="c2"><img id="lelecciones" src="img/logo85.png"/></td>	<!-- logo -->	
			</tr>
		</table>
	</div>

	<div id="body">
		 
				<div id="menu">
					<form name="formesa">
					<table border="0" width="100%">
					<tr>
						<td width="35%">
							<div id="mdetalle">
								Proceso:
								<select name="detalle" onChange="seleccionar_tipo_de_proceso(document.formesa.detalle.options[document.formesa.detalle.selectedIndex].value)">		
								<option value="0">Corporaci&oacute;n Municipal</option>
								<option value="1">Actas por Municipio</option>
								<!-- <option value="2">Escrutinio Municipal</option> -->
								<option value="3">Resultados por Mesa</option>
								</select>
							</div>
						<td width="52%">
							<div id="mdepto"></div>
						</td>
						</td>
						<td width="13%" class="menuMovil"><a href="http://resultados2011.tse.org.gt/nebaj/m">[Sitio móvil]</a></td>
					</tr>
					</form>
					</table>					
				</div>
								
				<div id="idx" style="background-color: #fff;">
					<div id="title">
						<div id="dtitulo">
						</div>
					</div>
				
					<div id="main">
						<div id="fresultado">
						</div>
					</div>
					
				</div>

				<div id="dhelp">
					<br/>&nbsp;&nbsp;
					En el despliegue de resultados se entiende que:
					<ul>
					<li>Las cifras son de car&aacute;cter preliminar.
					<li><strong>Votos V&aacute;lidos</strong> es la suma de los votos obtenidos por los partidos, sin considerar <strong>Votos Blancos</strong> ni <strong>Votos Nulos</strong>.
					<li>La suma de <strong>Votos V&aacute;lidos</strong>, <strong>Votos Nulos</strong> y <strong>Votos Blancos</strong> es el total de <strong>Votos Emitidos</strong>.
					<li>El total de <strong>Votantes Inscritos</strong> se refiere al n&uacute;mero de votantes que se han inscrito en el Padr&oacute;n Electoral para todas las mesas.
					<li><strong>Total JRV</strong> es el n&uacute;mero de Juntas Receptoras de Votos habilitadas en el Municipio para &eacute;sta elecci&oacute;n.
					<li><strong>JRV totalizadas</strong> es el n&uacute;mero de actas de las Juntas Receptoras de Votos (mesas) que hasta el momento se han computado.
					</ul>
				</div>
				
				<div id="footer">
					<table width="100%" border="0">
						<tr>
							<td class="footerLeft">
								<label>Tribunal Supremo Electoral<br/>
								Guatemala Centroam&eacute;rica<br/>
								&copy; 2011 - 2014</label>
								<div id="clear"></div>
							</td>
							<td class="footerRight">
									<a href="http://resultados2011.tse.org.gt/primeravuelta" target="_blank">Elecciones Generales y al Parlamento Centroamericano 2011</a><br>
									<a href="http://resultados2011.tse.org.gt/index.php" target="_blank">Segunda Elección Presidencial 2011</a>
							</td>
						</tr>
					</table>
				</div>
		</div>		
</div>


</body> 
</html>
