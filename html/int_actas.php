<div>
<?php
session_start();
include '../include/figuraacta.php';
$depto=0;
$muni=0;
$te=1;
$fig = new cfiguraacta($depto,$muni,$te);
?>
<script type="text/javascript" src="js/json2.js"></script>
<script type="text/javascript" src="js/swfobject.js"></script>
<script type="text/javascript">
  swfobject.embedSWF("open-flash-chart.swf","graficaexterna", "100%", "350", "9.0.0");
</script>
<script type="text/javascript">
function ofc_ready() {
}
function open_flash_chart_data() {
  return JSON.stringify(data);
}
function load_1(){
        tmp = findSWF("graficaexterna");
        x = tmp.load(JSON.stringify(data));
}
function findSWF(movieName) {
  if (navigator.appName.indexOf("Microsoft")!= -1) {
    return window[movieName];
  } else {
    return document[movieName];
  }
}
tf = 1;
data = <?php echo $fig->darcadena(1);  ?>;
</script>
<style type="text/css">
table td.t1 {
	color:			#002D62;
	font-size:		x-large;
    font-weight:	bold;
	text-align:		center;	
}

table td.t2 {
	color:			#000;
	font-size:		medium;
    font-weight:	normal;
	text-align:		center;
}

table td.t3 {
	color:			#000;
	font-size:		small;
    font-weight:	normal;
	text-align:		center;
}
</style>
<?php
echo '<table align="center" cellpadding="0" cellspacing="0"><tr><td class="t1">Segunda Elecci&oacute;n Presidencial</td></tr>';
echo '<tr><td class="t3">Resultados preliminares&nbsp;&nbsp;&nbsp;&nbsp;'.date("d/m/Y").'&nbsp;&nbsp;&nbsp;'.date("H:i:s").'</td></tr></table>';
?>
<br /><br />
<div id="graficaexterna"></div>
</div>