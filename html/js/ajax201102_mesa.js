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

function limpiar() {
	divMdepto = document.getElementById('mdepto');
	divMmuni = document.getElementById('mmuni');
	divResultado = document.getElementById('fresultado');
	divMdepto.style.display='none';
	divMmuni.style.display='none';
	divResultado.style.display='none';
}

function cargar_detalle(Iddet) {
	limpiar();
	document.formesa.tipo.selectedIndex=0;
	ajax=objetoAjax();
	ajax.open('POST','int_actualiza_mesa.php'); //int_consultadepto.php
	ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	ajax.send('objeto=0&td='+Iddet);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 ) {
			cargar_objeto(5,0);
		}
	}
}

function cargar_tipo(Idtipo) {
	limpiar();
	ajax=objetoAjax();
	ajax.open('POST','int_actualiza_mesa.php'); //int_desplegarte.php
	ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	ajax.send('objeto=1&te='+Idtipo);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 ) {
			if (Idtipo>0)
			{
				if (document.formesa.detalle.selectedIndex==2) { //resultados por mesa
					divMdepto.style.display='inline';
					document.getElementById('mmuni').innerHTML='<img src="img/ajax-loader_min.gif" width="16" height="16" style="position: relative; top: 5px; left: 25px;">';
					divMdepto.innerHTML = '<div id="dinput">No. mesa:<br/><input class="input" type="text" size="5" maxlength="5" name="nmesa" onkeypress="return Valida(event,\'num\')"; onChange="return CompruebaCampo(this)";>&nbsp;<input type="button" class="button" name="bmesa" maxlength="13" value="Ver Resultados" onClick="if (document.formesa.nmesa.value!=\'\') {Cargar_mesa(document.formesa.nmesa.value,this);} else {alert(\'Debe ingresar n&uacute;mero de mesa.\'); document.formesa.nmesa.focus(); return false;};";> <input type="button" class="button" style="width:40px;margin-left:10px;" name="mesa_anterior" id="mesa_anterior" value="&laquo;&laquo;" onClick="if (document.formesa.nmesa.value > 1){Cargar_mesa(document.formesa.nmesa.value-1,this);document.formesa.nmesa.value=document.formesa.nmesa.value-1};"/> <input type="button" class="button" style="width:40px;margin-left:10px;" name="mesa_siguiente" id="mesa_siguiente" value="&raquo;&raquo;" onClick="if (parseInt(document.formesa.nmesa.value) < 16668){Cargar_mesa((parseInt(document.formesa.nmesa.value)+1),this);document.formesa.nmesa.value=(parseInt(document.formesa.nmesa.value)+1)};"/></div>';
					divMdepto.style.display='block';
				}
				else
				cargar_objeto(1,0);			
			}
		}
	}
	cargar_objeto(5,0);
}

function Cargar_detD(Idlugar){
	divResultado = document.getElementById('fresultado');
	divResultado.style.display='none';
	divMmuni = document.getElementById('mmuni');

	if (Idlugar==0)
	{
		divMmuni.style.display='none';
		cargar_objeto(5,0);		
	}
	else {
		document.getElementById('mmuni').innerHTML='<img src="img/ajax-loader_min.gif" width="16" height="16" style="position: relative; top: 5px; left: 25px;">';
		ajax=objetoAjax();
		ajax.open('POST','int_actualiza_mesa.php'); //int_consultamuni.php
		ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		ajax.send('objeto=2&tdepto='+Idlugar);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4 ) {
				cargar_objeto(2,0);
				}
			}
		if (document.formesa.tipo.selectedIndex==2) //tipo eleccion 4
		{
			cargar_objeto(3,0);
			cargar_objeto(6,0);
		}
		else
		cargar_objeto(5,0);
	}
}

function Cargar_detM(Idlugar){
	document.formesa.mun.selectedIndex=Idlugar;
	divResultado = document.getElementById('fresultado');
	if (Idlugar==0)
	{
		divResultado.style.display='none';
		cargar_objeto(5,0);
	}
	else {
		document.getElementById('fresultado').innerHTML='<img src="img/ajax-loader_max.gif" width="66" height="66">';
		ajax=objetoAjax();
		ajax.open('POST','int_actualiza_mesa.php'); //int_desplegar.php
		ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		ajax.send('objeto=3&tmuni='+Idlugar);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4 ) {
				cargar_objeto(3,0);
				cargar_objeto(6,0);
			}
		}
	}
}

function Cargar_mesa(Idmesa,e) {
	cargar_objeto(4,Idmesa);
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
		e.value='';
		e.focus();
		alert('N\xfamero de mesa inv\xe1lido.');
		tmp=false;
	}
	else {
		if (e.value>=1 && e.value<=16668) {tmp=true;}
		else {
			e.focus();
			alert('N\xfamero de mesa debe ser un valor entre 1 y 16,668.');
			tmp=false;			
		}
	}
	return tmp;
}

function cargar_objeto(objeto,Idmesa) {
var wait=0;
var param='';
var ajax=null;
var div=null;
var divObjeto=null;
	switch(objeto)
	{
		case 1: //tipoeleccion
			div='mdepto';
			param='objeto=1';
			wait=1;
			break;
		case 2: //departamento
			div='mmuni';
			param='objeto=2';
			wait=1;
			break;
		case 3: //municipio
			div='fresultado';
			param='objeto=3';
				wait=2;
			break;
		case 4: //mesa
			div='fresultado';
			param='objeto=4&tmesa='+Idmesa;
			wait=2;
			break;
		case 5: //titulo
			div='dtitulo';
			param='objeto=5';
			break;
		case 6: //titulo
			div='dtitulo';
			param='objeto=6';
			break;
	}
	divObjeto = document.getElementById(div);
	if (wait==1)
	document.getElementById(div).innerHTML='<img src="img/ajax-loader_min.gif" width="16" height="16">';
	else
	{
		if (wait==2)
		document.getElementById(div).innerHTML='<img src="img/ajax-loader_max.gif" width="66" height="66">';
	}
		
	divObjeto.style.display='inline';
	ajax=objetoAjax();
	ajax.open('POST','int_objeto_mesa.php');
	ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	ajax.send(param);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 ) {
			divObjeto.innerHTML=ajax.responseText;
			divObjeto.style.display='block';
		}
	}
}