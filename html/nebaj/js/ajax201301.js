function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
  		}
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function open_flash_chart_data() {
	return JSON.stringify(data);
}

function findSWF(movieName) {
  if (navigator.appName.indexOf("Microsoft")!= -1) {
	return window[movieName];
  } else {
	return document[movieName];
  }
}

function limpiar() {
	divMdepto = document.getElementById('mdepto');
	divMdepto.style.display='none';
	divResultado = document.getElementById('fresultado');
	divResultado.style.display='none';
}

function Valida(elEvento, permitidos){
// Variables que definen los caracteres permitidos
  var numeros = "0123456789";
  var caracteres = " abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
  var numeros_caracteres = numeros + caracteres;
  var teclas_especiales = [8, 37, 39, 46];
  // 8 = BackSpace, 46 = Supr, 37 = flecha izquierda, 39 = flecha derecha
  
	permitidos = numeros;
 
  // Obtener la tecla pulsada 
  var evento = elEvento || window.event;
  var codigoCaracter = evento.charCode || evento.keyCode;
  var caracter = String.fromCharCode(codigoCaracter);
 
  // Comprobar si la tecla pulsada es alguna de las teclas especiales
  // (teclas de borrado y flechas horizontales)
  var tecla_especial = false;
  for(var i in teclas_especiales) {
    if(codigoCaracter == teclas_especiales[i]) {
      tecla_especial = true;
		return true;
		break;
    }
  } 
  // Comprobar si la tecla pulsada se encuentra en los caracteres permitidos
  // o si es una tecla especial  
  return permitidos.indexOf(caracter) != -1 || tecla_especial; 
}

function CompruebaCampo(pTipo) {
var tmp=true;
var lActaInicial=12259;
//var lActaFinal = 12261;
var lActaFinal = 12333;
var input = document.getElementById("inputMesa");
var val = input.value;
var msj = 'El n\xFAmero de mesa debe ser un valor entre ' + lActaInicial + ' y ' + lActaFinal + '.';

	switch(pTipo) {
		case 'ENTER': 
		{
			if (val>=lActaInicial && val<=lActaFinal) {
				cargar_objeto('3',val);
			}
			else {
				alert(msj);
				input.focus();
			}
			break;
		}
		case '-': 
		{
			val--;
			if (val>=lActaInicial && val<=lActaFinal) {
				document.getElementById("inputMesa").value=val;
				cargar_objeto('3',val);
			}
			else {
				alert(msj);
				input.focus();
			}
			break;
		}
		case '+': 
		{
			val++;
			if (val>=lActaInicial && val<=lActaFinal) {
				document.getElementById("inputMesa").value=val;
				cargar_objeto('3',val);
			}
			else {
				alert(msj);
				input.focus();				
			}
			break;
		}
	}
	return tmp;
}

function HTML(pClassId,pHtml){
	$(pClassId).html(pHtml);
}

function GET_HTML(pClassId,pPage){
	$.post(pPage,function (responseText)
	{$(pClassId).html(responseText);});
}

function cargar_objeto(pObjeto,pIdMesa) {
	HTML('#fresultado','<br><br><br><img src="img/ajax-loader_max.gif" width="66" height="66"><br><span style="font-size: small;">Procesando...</span>');
	switch(pObjeto)
	{
		case '0':	//0 - Dashboard
			GET_HTML('#idx','ajax.object.php?objeto='+pObjeto);
			break;
		case '3':	//Resultados por mesa, detalle=0
			GET_HTML('#idx','ajax.object.php?objeto='+pObjeto+'&tmesa='+pIdMesa);
			break;
		case '4':	//Resultados por mesa, detalle=1
			GET_HTML('#idx','ajax.object.php?objeto='+pObjeto+'&tmesa='+pIdMesa);
			break;
		default: // 1 - Actas por municipio, 2 - Escrutinio municipal
			GET_HTML('#idx','ajax.object.php?objeto='+pObjeto);
			break;
	}
}

function Cargar_mesa(pIdMesa) {
	cargar_objeto('4',pIdMesa);
}

function seleccionar_tipo_de_proceso(pTipoProceso) {
	switch(pTipoProceso)
	{
		case '0':
			HTML('#mdepto','');
			cargar_objeto(pTipoProceso,0);
			break;
		case '3': 
			var lActaInicial=12259;
			var lActaFinal = 12333;
			HTML('#mdepto','<div id="dinput">N&uacute;mero de Mesa: <input id="inputMesa" class="input" type="text" maxlength="5" name="nmesa" onkeypress="return Valida(event,\'num\')"; value="' + lActaInicial + '";> <input type="button" class="button" name="bmesa" maxlength="13" value="Aceptar" onClick="return CompruebaCampo(\'ENTER\');"> <input type="button" class="button" style="width:40px;margin-left:10px;" name="mesa_anterior" id="mesa_anterior" value="&laquo;&laquo;" onClick="return CompruebaCampo(\'-\');" /> <input type="button" class="button" style="width:40px;margin-left:10px;" name="mesa_siguiente" id="mesa_siguiente" value="&raquo;&raquo;" onClick="return CompruebaCampo(\'+\');" /></div>');
			cargar_objeto(pTipoProceso,document.formesa.nmesa.value); //Resultados por mesa
			break;
		default:
			HTML('#mdepto','');
			cargar_objeto(pTipoProceso,0);
			break;
	}
}
