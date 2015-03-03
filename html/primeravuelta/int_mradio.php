<?php 
session_start();
$check_barra='';
$check_pastel='';
if($_SESSION['GRAFICA']==1) $check_barra='checked';
else  $check_barra='checked';

echo '<form name=fradio>';
echo '  <input type="Radio" name="sradio" onClick="Cargar_grafica(1)" '.$check_barra.'>Barras&nbsp;';
echo '  <input type="Radio" name="sradio" onClick="Cargar_grafica(2)" '.$check_pastel.'>Pastel';
echo '</form>';

?>
