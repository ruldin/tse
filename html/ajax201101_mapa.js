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

function ajx_mapa() {
	var tmpColor='';
	$(function() {
		$('.map').maphilight();
		$('area').mouseover(function(e) {
		e.preventDefault();
		var data = $(this).data('maphilight') || {};
		tmpColor=data.fillColor;
		data.strokeColor='D3D3D3';
		data.strokeWidth=3;
		data.fillColor='5695DD';
		$(this).data('maphilight', data).trigger('alwaysOn.maphilight');});
		$('area').mouseout(function(e) {
		e.preventDefault();
		var data = $(this).data('maphilight') || {};
		data.strokeColor='034693';
		data.strokeWidth=1;
		data.fillColor=tmpColor;
		$(this).data('maphilight', data).trigger('alwaysOn.maphilight');});			
	});
}

function pedirDatos(te,depto,muni){
	//donde se mostrará el formulario con los datos
	divFormulario = document.getElementById('formulario');
	
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//uso del medotod GET
	ajax.open("POST", "int_marcotres.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 ) {
			//mostrar resultados en esta capa
			divFormulario.innerHTML = ajax.responseText
			Cargar_grafica(tf);
			Mostrar_radio();
			//mostrar el formulario
			divFormulario.style.display="block";
		}
	}
	//como hacemos uso del metodo GET
	//colocamos null
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("tele="+te+"&tdepto="+depto+"&tmuni="+muni);
    //Cargar_grafica(tf);
}

function Cargar_grafica(tf){
    // para grafica	
	//instanciamos el objetoAjax
	
	gajax=objetoAjax();
	//uso del medotod GET
//	gajax.open("POST", "davalores2.php");
	gajax.open("POST", "int_marcodos.php");
	gajax.onreadystatechange=function() {
		if (gajax.readyState==4 ) {
//			traer datos de figura 1
           asignaTexto(gajax.responseText);
		   load_1();
//            data =eval('(' + gajax.responseText + ')');
		}
	}
	//como hacemos uso del metodo GET
	//colocamos null
	gajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	gajax.send("tfig="+tf);
}

function Mostrar_radio(){
    // para radio boton

    //donde se mostrará el formulario con los datos
	divRadio = document.getElementById('dradio');
	
	//instanciamos el objetoAjax
	hajax=objetoAjax();
	//uso del medotod GET
	hajax.open("POST", "int_mradio.php");
	hajax.onreadystatechange=function() {
		if (hajax.readyState==4 ) {
			//mostrar resultados en esta capa
			divRadio.innerHTML = hajax.responseText
			//mostrar el formulario
			divRadio.style.display="block";
		}
	}
	//como hacemos uso del metodo GET
	//colocamos null
	hajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	hajax.send();
}

function Cargar_selectD(Idlugar){
if ( (Idlugar==0) && (divMmuni.style.display == 'block')) {
			//ocultar el combo municipio
			divMmuni.style.display="none";

	//instanciamos el objetoAjax
	dajax=objetoAjax();
	//uso del medotod GET
	dajax.open("POST", "int_menunac.php");
	dajax.onreadystatechange=function() {
		if (dajax.readyState==4 ) {
			//mostrar resultados en esta capa
			Hacer_tabla();
			Mostrar_titulo();
			Cargar_mapa();
			Cargar_grafica(tf);
			Mostrar_radio();
			ajx_mapa();
			//mostrar el formulario
		}
	}
	//como hacemos uso del metodo GET
	//colocamos null
	dajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	dajax.send("tdepto="+Idlugar);
}
else {
	document.formulario.dep.selectedIndex=Idlugar;
    //donde se mostrará los datos
	divMmuni = document.getElementById('mmuni');
	document.getElementById('mmuni').innerHTML='<img src="img/ajax-loader_min.gif" width="16" height="16" style="position: relative; top: 5px; left: 25px;">';
	
	//instanciamos el objetoAjax
	dajax=objetoAjax();
	//uso del medotod GET
	dajax.open("POST", "int_menumuni.php");
	dajax.onreadystatechange=function() {
		if (dajax.readyState==4 ) {
			//mostrar resultados en esta capa
			divMmuni.innerHTML = dajax.responseText
			Hacer_tabla();
            Mostrar_titulo();
            Cargar_mapa();
			Cargar_grafica(tf);
			Mostrar_radio();
			//mostrar el formulario
			divMmuni.style.display="block";
		}
	}
	//como hacemos uso del metodo GET
	//colocamos null
	dajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	dajax.send("tdepto="+Idlugar+"&ttitulo="+document.formulario.dep.options[document.formulario.dep.selectedIndex].text);
}
}

function Cargar_selectM(Idlugar){

    document.formulario.mun.selectedIndex=Idlugar;
	//instanciamos el objetoAjax
	majax=objetoAjax();
	//uso del medotod GET
	majax.open("POST", "int_menulugar.php");
	majax.onreadystatechange=function() {
		if (majax.readyState==4 ) {
			//mostrar resultados en esta capa
			Hacer_tabla();
			Mostrar_titulo();
			Cargar_grafica(tf);
			Mostrar_radio();
			//mostrar el formulario
		}
	}
	//como hacemos uso del metodo GET
	//colocamos null
	majax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	majax.send("tmuni="+Idlugar+"&ttitulo="+document.formulario.mun.options[document.formulario.mun.selectedIndex].text);
}


function Hacer_tabla(){
	//donde se mostrará el formulario con los datos
	divFormulario = document.getElementById('ftabla');
	document.getElementById('ftabla').innerHTML='<img src="img/ajax-loader_max.gif" width="66" height="66">';
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//uso del medotod GET
	ajax.open("POST", "int_marco_tres.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 ) {
			//mostrar resultados en esta capa
			divFormulario.innerHTML = ajax.responseText
			//mostrar el formulario
			divFormulario.style.display="block";
		}
	}
	//como hacemos uso del metodo GET
	//colocamos null
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send();
    //Cargar_grafica(tf);
}

function Cargar_tipo(Idtipo){
	
	//instanciamos el objetoAjax
	tajax=objetoAjax();
	//uso del medotod GET
	tajax.open("POST", "int_menutipo.php");
	tajax.onreadystatechange=function() {
		if (tajax.readyState==4 ) {
			//mostrar resultados en esta capa
			Hacer_tabla();
			Mostrar_titulo();
			Cargar_grafica(tf);
			Mostrar_radio();
			//mostrar el formulario
		}
	}
	//como hacemos uso del metodo GET
	//colocamos null
	tajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	tajax.send("te="+Idtipo);
}

function Cargar_selectN(){
	//donde se mostrará el formulario con los datos
	divMdepto = document.getElementById('mdepto');
	document.getElementById('mdepto').innerHTML='<img src="img/ajax-loader_min.gif" width="16" height="16" style="position: relative; top: 5px; left: 25px;">';
	//instanciamos el objetoAjax
	najax=objetoAjax();
	//uso del medotod GET
	najax.open("POST", "int_menunac.php"); ///////////////
	najax.onreadystatechange=function() {
		if (najax.readyState==4 ) {
			//mostrar resultados en esta capa
			divMdepto.innerHTML = najax.responseText
			Hacer_tabla();
			Mostrar_titulo();
			Cargar_grafica(tf);
			Mostrar_radio();
			//mostrar el formulario
			divMdepto.style.display="block";
			divMmuni.style.display="none";
		}
	}
	//como hacemos uso del metodo GET
	//colocamos null
	najax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	najax.send();
}

function Cargar_mapa(){
	//donde se mostrará el formulario con los datos
	divMmapa = document.getElementById('dmapa');
	document.getElementById('dmapa').innerHTML='<img src="img/ajax-loader_max.gif" width="66" height="66">';
	
	//instanciamos el objetoAjax
	majax=objetoAjax();
	//uso del medotod GET
	majax.open("POST", "int_marco_uno.php"); ///////////////
	majax.onreadystatechange=function() {
		if (majax.readyState==4 ) {
			//mostrar resultados en esta capa
			divMmapa.innerHTML = majax.responseText
			ajx_mapa();
//			Hacer_tabla();
	//		Cargar_grafica(tf);
		//	Mostrar_radio();
			//mostrar el formulario
			divMmapa.style.display="block";
		}
	}
	//como hacemos uso del metodo GET
	//colocamos null
	majax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	majax.send();
}


function Mostrar_titulo(){
	//donde se mostrará el formulario con los datos
	divTitulo = document.getElementById('dtitulo');
	//document.getElementById('dtitulo').innerHTML='<img src="img/ajax-loader_max.gif" width="66" height="66">';
	//instanciamos el objetoAjax
	bajax=objetoAjax();
	//uso del medotod GET
	bajax.open("POST", "int_mtitulo.php");
	bajax.onreadystatechange=function() {
		if (bajax.readyState==4 ) {
			//mostrar resultados en esta capa
			divTitulo.innerHTML = bajax.responseText
			//mostrar el formulario
			divTitulo.style.display="block";
		}
	}
	//como hacemos uso del metodo GET
	//colocamos null
	bajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	bajax.send();
    //Cargar_grafica(tf);
}
