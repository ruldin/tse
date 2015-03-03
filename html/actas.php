<?php 
if (isset($_POST['PROCESO'])){ $_SESSION['PROCESO'] = $_POST['PROCESO'];} else { $_SESSION['PROCESO'] = 201102;}
if (isset($_POST['depto'])){ $depto = $_POST['depto'];} else { $depto = 0;}
if (isset($_POST['muni'])){ $muni = $_POST['muni'];} else { $muni = 0;}
if (isset($_POST['te'])){ $te = $_POST['te'];} else { $te = 1;}
include_once '../include/figuraacta.php';
$fig = new cfiguraacta($depto,$muni,$te);
?>
<script type="text/javascript">
var data = <?php echo $fig->darcadena(1);  ?>;
swfobject.embedSWF("open-flash-chart.swf", "actagrafica", "100%", "350", "9.0.0");
</script>
<div id="actagrafica"></div>