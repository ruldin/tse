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
	//document.formulario.dep.selectedIndex=Idlugar;
	
    //donde se mostrará los datos
	divMmuni = document.getElementById('mmuni');
	document.getElementById('mmuni').innerHTML='<img src="img/ajax-loader_min.gif" width="16" height="16" style="position: relative; top: 5px; left: 25px;">';

	//instanciamos el objetoAjax
	dajax=objetoAjax();
	//uso del medotod GET
	dajax.open("POST", "int_menumuni.php");
	//como hacemos uso del metodo GET
	//colocamos null
	dajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	dajax.send("tdepto="+Idlugar+"&ttitulo="+document.formulario.dep.options[document.formulario.dep.selectedIndex].text);
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
var deptos=new Array();
deptos[1]=["Nacional|0", "Guatemala|1", "Sacatepequez|2", "Chimaltenango|3", "El Progreso|4",
"Escuintla|5", "Santa Rosa|6", "Solola|7",  "Totonicapan|8", "Quetzaltenango|9", "Suchitepequez|10",
"Retalhuleu|11", "San Marcos|12", "Huehuetenango|13", "Quiche|14", "Baja Verapaz|15", 
"Alta Verapaz|16", "Peten|17", "Izabal|18", "Zacapa|19", "Chiquimula|20", "Jalapa|21", "Jutiapa|22"];
deptos[4]=["Santa Rosa|6", "Huehuetenango|13", "Quiche|14", "Peten|17", "Izabal|18"];
	
	//instanciamos el objetoAjax
	tajax=objetoAjax();
	//uso del medotod GET
	tajax.open("POST", "int_menutipo.php");
	tajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	if (Idtipo==1)
	tajax.send("te="+Idtipo);
	else
	tajax.send("te="+Idtipo+"&dep=6&mun=13");
	tajax.onreadystatechange=function() {
		if (tajax.readyState==4 ) {
			//mostrar resultados en esta capa

			//actualizar combo departamentos
			var comboDeptos=document.formulario.dep;
			comboDeptos.options.length=0;
			for (i=0; i<deptos[Idtipo].length; i++)
			comboDeptos.options[comboDeptos.options.length]=new Option(deptos[Idtipo][i].split("|")[0], deptos[Idtipo][i].split("|")[1]);		
			//actualizar combo departamentos				
					
			Hacer_tabla();
			Mostrar_titulo();
			Cargar_grafica(tf);
			Mostrar_radio();

			divMmuni = document.getElementById('mmuni');
			divMmuni.style.display="none";
		}
	}
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
