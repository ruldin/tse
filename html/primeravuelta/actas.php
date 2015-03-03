<?php 
session_start();
//header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

include_once '../../include_primeravuelta/figuraacta.php';
include_once '../../include_primeravuelta/titulo.php';

$_SESSION['DEPARTAMENTO']=0;
$_SESSION['MUNICIPIO']=0;
$_SESSION['ELECCION']=1;
$_SESSION['PROCESO']=201101;
$_SESSION['TITULO']='NIVEL NACIONAL';

$depto=$_SESSION['DEPARTAMENTO'];
$muni=$_SESSION['MUNICIPIO'];
$te=$_SESSION['ELECCION']; 
$tit=$_SESSION['TITULO']; 
$fig = new cfiguraacta($depto,$muni,$te);
?>
<html>
<head>
<title>Tribunal Supremo Electoral</title>
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
<link rel="stylesheet" type="text/css" media="screen" href="css/tabs.css" />
<link rel="stylesheet" type="text/css" media="print"  href="css/printer.css" />
<script type="text/javascript" src="js/json2.js"></script>
<script type="text/javascript" src="js/swfobject.js"></script>
<script type="text/javascript">
swfobject.embedSWF("open-flash-chart.swf", "fgrafica", "100%", "350", "9.0.0");
</script>
<script type="text/javascript">
function ofc_ready() {
 // alert('ofc ');
}

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


var tf = 1;
var data = <?php echo $fig->darcadena(1);  ?>;
</script>
</head>

<body topmargin="0" leftmargin="0" bottomMargin="0" rightMargin="0" bgColor="#f6f4f4">
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

<table width="100%">
	<tr>
      <td><div id="title">
          <table width="100%" >
            <tr><td width="100%"><?php $fec=''; $otit = new ctitulo($te,$tit,$fec); echo $otit->datitulo(); ?></td></tr>
            <tr><td width="100%"><div id="fgrafica"></div></td></tr>
          </table></div>
      </td>
      
   </tr>
</table>
</body>
</html>
