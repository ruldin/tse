<html>
<head>
<title>Tribunal Supremo Electoral</title>
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
<link rel="stylesheet" type="text/css" media="screen" href="css/tabs.css" />
<link rel="stylesheet" type="text/css" media="print"  href="css/printer.css" />
<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="js/jquery.timers.js"></script>
<script type="text/javascript">
var times = 1*10*100*1000; 
$(document).everyTime(1000, function(i){
	var cr = $('#cuentaregresiva').text();
	if (cr < 1 ){
		$("#fgrafica iframe").attr('src','int_actas.php');		
		cr = 120;
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

<body topmargin="0" leftmargin="0" bottomMargin="0" rightMargin="0" bgColor="#f6f4f4">
	<div id="header" style="height:90px">
		<table>
			<tr>
				<td class="c1">
				<img id="lheader" src="img/header.png"/>
				</td>	<!-- title -->
				<td class="c2"><img id="lelecciones" style="top:22px;right:22px;" src="img/logo.gif"/></td>	<!-- logo -->
			</tr>
		</table>
	</div>

<table width="100%">
	<tr>
      <td><div id="title">
          <table width="100%">
            <tr><td width="100%"><?php //$fec=''; $otit = new ctitulo($te,$tit,$fec); echo $otit->datitulo(); ?></td></tr>
            <tr>
		<td width="100%">
			<div id="fgrafica">
				<iframe src="int_actas.php" width="100%" height="500" frameborder="0"></iframe>
			</div>
		</td></tr>
            <tr><td width="100%" align="center" style="color:#0078C9"><p><strong>Actualizaci&oacute;n autom&aacute;tica en <span id='cuentaregresiva'>120</span> segundos</strong></p></td></tr>
          </table></div>
      </td>
      
   </tr>
  <tr style="background-color:#FFFFFF;">
    <td><div style="float:right;padding-top:2px;padding-right:5px;"><img alt="Web Movil" width="100" src="img/movil.png"/></div></td>
  </tr>
</table>
</body>
</html>
