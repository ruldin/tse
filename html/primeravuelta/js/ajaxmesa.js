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

function Cargar_detalle(Iddet) {
  divMdepto = document.getElementById('mdepto');  
  divMmuni = document.getElementById('mmuni');
  divResultado = document.getElementById('fresultado');
  divMdepto.style.display="none";
  divMmuni.style.display="none";
  divResultado.style.display="none";
		
  if (Iddet==1 || Iddet==2) {
  //instanciamos el objetoAjax
	divMdepto.style.display="inline";
    document.getElementById('mdepto').innerHTML='<img src="img/ajax-loader_min.gif" width="16" height="16" style="position: relative; top: 5px; left: 25px;">';

	dajax=objetoAjax();
	//uso del medotod GET
	dajax.open("POST", "int_consultadepto.php");
	dajax.onreadystatechange=function() {
		if (dajax.readyState==4 ) {
			//mostrar resultados en esta capa
			divMdepto.innerHTML = dajax.responseText
			//mostrar el formulario
			divMdepto.style.display="block";
		}
	}
	//como hacemos uso del metodo GET
	//colocamos null
	dajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	dajax.send("td="+Iddet);
  }
  else {
     if (Iddet==3)	{
	divMdepto.style.display="inline";
    document.getElementById('mmuni').innerHTML='<img src="img/ajax-loader_min.gif" width="16" height="16" style="position: relative; top: 5px; left: 25px;">';
    //instanciamos el objetoAjax
	 dajax=objetoAjax();
	//uso del medotod GET
	dajax.open("POST", "int_consultamesa.php");
	dajax.onreadystatechange=function() {
		if (dajax.readyState==4 ) {
			//mostrar resultados en esta capa
			divMdepto.innerHTML = dajax.responseText
			//mostrar el formulario
			divMdepto.style.display="block";
		}
	}
	//como hacemos uso del metodo GET
	//colocamos null
	dajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	dajax.send();
    }
	else
	{
	  divMdepto.style.display="none";
	  divMmuni.style.display="none";
	  divResultado.style.display="none";
	}
  }
}

function Cargar_detD(Idlugar){
 divResultado = document.getElementById('fresultado');
 divResultado.style.display="none";
 divMmuni = document.getElementById('mmuni');

 if (Idlugar==0) {	
   divMmuni.style.display="none";
 }
 else {
 divResultado.style.display="none";
 document.getElementById('mmuni').innerHTML='<img src="img/ajax-loader_min.gif" width="16" height="16" style="position: relative; top: 5px; left: 25px;">';
 	dajax=objetoAjax();
		//uso del medotod GET
	dajax.open("POST", "int_consultamuni.php");
	dajax.onreadystatechange=function() {
		if (dajax.readyState==4 ) {
			//mostrar resultados en esta capa
			divMmuni.innerHTML = dajax.responseText
			//mostrar el formulario
			divMmuni.style.display="block";
		}
	}
	//como hacemos uso del metodo GET
	//colocamos null
	dajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	dajax.send("tdepto="+Idlugar);
 }
}

function Cargar_detM(Idlugar){

    document.formesa.mun.selectedIndex=Idlugar;
    //donde se mostrará los datos
	divResultado = document.getElementById('fresultado');

	if (Idlugar==0) {
		divResultado.style.display="none";
	}
	else {
	divResultado.style.display="inline";
    document.getElementById('fresultado').innerHTML='<img src="img/ajax-loader_max.gif" width="66" height="66">';
	//instanciamos el objetoAjax
	majax=objetoAjax();
	//uso del medotod GET
	majax.open("POST", "int_desplegar.php");
	majax.onreadystatechange=function() {
		if (majax.readyState==4 ) {
			//mostrar resultados en esta capa
         	divResultado.innerHTML = majax.responseText
 			//mostrar el formulario
			divResultado.style.display="block";
		}
	}
	//como hacemos uso del metodo GET
	//colocamos null
	majax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	majax.send("tmuni="+Idlugar);
	}
}

function Cargar_tipoMesa(Idtipo){
    divResultado = document.getElementById('fresultado');
	document.getElementById('fresultado').innerHTML='<img src="img/ajax-loader_max.gif" width="66" height="66">';
	//instanciamos el objetoAjax
	tajax=objetoAjax();
	//uso del medotod GET
	tajax.open("POST", "int_desplegarte.php");
	tajax.onreadystatechange=function() {
		if (tajax.readyState==4 ) {
			//mostrar resultados en esta capa
         	divResultado.innerHTML = tajax.responseText
 			//mostrar el formulario
			divResultado.style.display="block";
			//mostrar el formulario
		}
	}
	//como hacemos uso del metodo GET
	//colocamos null
	tajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	tajax.send("te="+Idtipo);
}

function Cargar_mesa(Idmesa,e) {

    //donde se mostrará los datos
	divResultado = document.getElementById('fresultado');
	divResultado.style.display="inline";
	document.getElementById('fresultado').innerHTML='<img src="img/ajax-loader_max.gif" width="66" height="66">';
	//instanciamos el objetoAjax
	
	zajax=objetoAjax();
	//uso del medotod GET
	zajax.open("POST", "int_desplegarmesa.php");
	zajax.onreadystatechange=function() {
		if (zajax.readyState==4 ) {
			//mostrar resultados en esta capa
         	divResultado.innerHTML = zajax.responseText
 			//mostrar el formulario
			divResultado.style.display="block";
		}
	}
	//como hacemos uso del metodo GET
	//colocamos null
	zajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	zajax.send("tmesa="+Idmesa);
	//f = document.getElementsByName('bmesa');
	//e.disabled=false;
	//f.disabled=false;
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
