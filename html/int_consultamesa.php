<?php
echo '<div id="dinput">No. mesa:<br/><input class="input" type="text" size="5" maxlength="5" name="nmesa" onkeypress="return Valida(event,\'num\')"; onChange="return CompruebaCampo(this)";>&nbsp;<input type="button" class="button" name="bmesa" maxlength="13" value="Ver Resultados" onClick="if (document.formesa.nmesa.value!=\'\') {Cargar_mesa(document.formesa.nmesa.value,this);} else {alert(\'Debe ingresar n&uacute;mero de mesa.\'); document.formesa.nmesa.focus(); return false;};";> <input type="button" class="button" style="width:40px;margin-left:10px;" name="mesa_anterior" id="mesa_anterior" value="&laquo;&laquo;" onClick="if (document.formesa.nmesa.value > 1){Cargar_mesa(document.formesa.nmesa.value-1,this);document.formesa.nmesa.value=document.formesa.nmesa.value-1};"/> <input type="button" class="button" style="width:40px;margin-left:10px;" name="mesa_siguiente" id="mesa_siguiente" value="&raquo;&raquo;" onClick="if (parseInt(document.formesa.nmesa.value) < 16668){Cargar_mesa((parseInt(document.formesa.nmesa.value)+1),this);document.formesa.nmesa.value=(parseInt(document.formesa.nmesa.value)+1)};"/></div>';
?>