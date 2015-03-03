<?php
function filtroConsulta($varFiltro, $maxFiltro){
	// si la variable max esta vacia, definir un minimo
	if ($maxFiltro < 1){ $maxFiltro = 2;}
	$ponerFiltro = array('','','','','','','','','','','','','','','','','','','','','','','','','','','','');
	$quitarSim = array(' ','-','_',',','.',';','@','#','"','=','$','!','%','&','/','(',')','?','¡','[',']','*','+','´','¨','<','>','|');
	$quitarTag = array('applet', 'body', 'bgsound', 'base', 'basefont', 'embed', 'frame', 'frameset', 'head', 'html', 'id', 'iframe', 'ilayer', 'layer', 'link', 'meta', 'name', 'object', 'script', 'style', 'title', 'xml','action', 'background', 'codebase', 'dynsrc', 'lowsrc', 'union');
	$quitarMay = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','Ñ','O','P','Q','R','S','T','U','V','W','X','Y','Z','°');
	$quitarMin = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','ñ','o','p','q','r','s','t','u','v','w','x','y','z','^');
	// quitar simibolos
	$varFiltro = str_replace($quitarSim,$ponerFiltro,$varFiltro);
	// quitar etiquetas
	$varFiltro = str_replace($quitarTag,$ponerFiltro,$varFiltro);
	// quitar letras mayusculas
	$varFiltro = str_replace($quitarMay,$ponerFiltro,$varFiltro);
	// quitar letras minusculas
	$varFiltro = str_replace($quitarMin,$ponerFiltro,$varFiltro);
	// recortar la variable
	$varFiltro = substr($varFiltro,0,$maxFiltro);
	// si despues de los filtros la variable no es numerica entonces convertir la variable a cero
	if (preg_match("/^[0-9]+$/",$varFiltro)){ $varFiltrada = $varFiltro;} else { $varFiltrada = 0;}
	echo $varFiltrada;
}
?>