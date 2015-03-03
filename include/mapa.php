<?php
define ('PP0','5695DD');
define ('PP1','034693');
define ('LIDER0','D3D3D3');
define ('LIDER1','000000');
 
class mapa
{
var $data;
var $file_root_name='dpto_';
var $png_location='mapas/';
var $php_location='../include/mapas/';

function colores($departamento)
{
for ($i=1; $i<=35; $i++)
{
$this->data[$i][0]=PP0;
$this->data[$i][1]=PP1;
}
/*$this->data[1][0]=LIDER0;
$this->data[1][1]=LIDER1;

$this->data[2][0]=PP0;
$this->data[2][1]=PP1;*/
}

function show($departamento,$te)
{
	$this->colores($departamento);
	if ($te==4)
	$this->file_root_name.='4';

	if ($departamento==0)
	echo '<img class="map" src="'.$this->png_location.$this->file_root_name.$departamento.'.png" width=400 height=423 border=0 usemap="#'.$this->file_root_name.$departamento.'_Map">';
	else
	echo '<img class="map" src="'.$this->png_location.$this->file_root_name.$departamento.'.png" width=400 height=334 border=0 usemap="#'.$this->file_root_name.$departamento.'_Map">';
	include_once $this->php_location.$this->file_root_name.$departamento.'.php';    
}
}
?>
