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
      break;
    }
  } 
  // Comprobar si la tecla pulsada se encuentra en los caracteres permitidos
  // o si es una tecla especial  
  return permitidos.indexOf(caracter) != -1 || tecla_especial; 
}

function CompruebaCampo(e) {
var tmp=true;
	if (!/^([0-9])*$/.test(e.value)) {
		//e.value='';
		e.focus();
		alert('N\xfamero de mesa inv\xe1lido.');
		tmp=false;
	}
//	else {
	//	var lActaInicial=12259;
		//var lActaFinal = 12333;
		//if (e.value>=lActaInicial && e.value<=lActaFinal) {tmp=true;}
		//else {
		//	e.focus();
		//	alert('N\xfamero de mesa debe ser un valor entre ' + lActaInicial + ' y ' + lActaFinal + '.');
		//	tmp=false;			
		//}
	//}
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
		case '3':	//Resultados por mesa, detalle=0
			GET_HTML('#idx','ajax.presentacion.php?objeto='+pObjeto+'&tmesa='+pIdMesa);
			break;
		case '4':	//Resultados por mesa, detalle=1
			GET_HTML('#idx','ajax.object.php?objeto='+pObjeto+'&tmesa='+pIdMesa);
			break;
		default: // 0 - Dashboard, 1 - Actas por municipio, 2 - Escrutinio municipal
			GET_HTML('#idx','ajax.object.php?objeto='+pObjeto);
			break;
	}
}

function Cargar_mesa(pIdMesa,e) {
	cargar_objeto('4',pIdMesa);
}

function seleccionar_tipo_de_proceso(pTipoProceso) {
	HTML('#mdepto','');
	GET_HTML('#idx','ajax.presentacion.php?objeto=0');
}
