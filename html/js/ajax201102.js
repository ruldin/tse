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

function cargar_tipo(Idtipo){
	var deptos=new Array();
	deptos[1]=["Nacional|0", "Guatemala|1", "Sacat\xe9pequez|2", "Chimaltenango|3", "El Progreso|4",
	"Escuintla|5", "Santa Rosa|6", "Solol\xe1|7",  "Totonicap\xe1n|8", "Quetzaltenango|9", "Suchitep\xe9quez|10",
	"Retalhuleu|11", "San Marcos|12", "Huehuetenango|13", "Quich\xe9|14", "Baja Verapaz|15", 
	"Alta Verapaz|16", "Pet\xe9n|17", "Izabal|18", "Zacapa|19", "Chiquimula|20", "Jalapa|21", "Jutiapa|22"];
	deptos[4]=["Santa Rosa|6", "Huehuetenango|13", "Quich\xe9|14", "Pet\xe9n|17", "Izabal|18"];
	ajax=objetoAjax();
	ajax.open('POST','int_actualiza.php'); //int_menutipo.php
	ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	if (Idtipo==1)
	ajax.send('objeto=0&te='+Idtipo+'&dep=0&mun=0');
	else
	ajax.send('objeto=0&te='+Idtipo+'&dep=6&mun=13');
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 ) {
			//actualizar combo departamentos
			var comboDeptos=document.formulario.dep;
			comboDeptos.options.length=0;
			for (i=0; i<deptos[Idtipo].length; i++)
			comboDeptos.options[comboDeptos.options.length]=new Option(deptos[Idtipo][i].split("|")[0], deptos[Idtipo][i].split("|")[1]);							
			actualizar(1,tf);
			//desaparece municipio
			divMmuni = document.getElementById('mmuni');
			divMmuni.style.display="none";
		}
	}
}

function Cargar_selectD(Idlugar){
if ( (Idlugar==0) && (divMmuni.style.display == 'block')) {
	divMmuni.style.display='none';
	ajax=objetoAjax();
	ajax.open('POST','int_actualiza.php'); //int_menunac.php
	ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	ajax.send('objeto=1&te='+document.formulario.tipo.value+'&dep='+Idlugar);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 ) {
			actualizar(1,tf);
		}
	}
}
else {
	divMmuni = document.getElementById('mmuni');
	document.getElementById('mmuni').innerHTML='<img src="img/ajax-loader_min.gif" width="16" height="16" style="position: relative; top: 5px; left: 25px;">';
	ajax=objetoAjax();
	ajax.open('POST','int_actualiza.php'); //int_menumuni.php
	ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	ajax.send('objeto=2&te='+document.formulario.tipo.value+'&dep='+Idlugar+'&nomdep='+document.formulario.dep.options[document.formulario.dep.selectedIndex].text);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 ) {
			divMmuni.innerHTML = ajax.responseText
			actualizar(1,tf);
			if (document.formulario.tipo.selectedIndex==0)
			divMmuni.style.display='block';
		}
	}
	if (document.formulario.tipo.value==1)
	document.formulario.dep.selectedIndex=Idlugar;
}
}

function Cargar_selectM(Idlugar){
    document.formulario.mun.selectedIndex=Idlugar;
	ajax=objetoAjax();
	ajax.open('POST','int_actualiza.php'); //int_menulugar.php
	ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	ajax.send('objeto=3&mun='+Idlugar+'&nommun='+document.formulario.mun.options[document.formulario.mun.selectedIndex].text);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 ) {
			actualizar(0,tf);
		}
	}
}

function actualizar(mapa,tf) {
	cargar_objeto(1); //titulo
	if (mapa==1)
	cargar_objeto(2); //mapa
	cargar_grafica(tf,1); //grafica
	cargar_objeto(4); //tabla
}	

function cargar_grafica(tf,radio) {
var ajax=null;
var divObjeto=null;
	ajax=objetoAjax();
	ajax.open('POST','int_objeto.php');
	ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	ajax.send('objeto=5&tfig='+tf);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
           asignaTexto(ajax.responseText);
		   load_1();
		}
	}
	if (radio==1)
	cargar_objeto(3);
}

function cargar_objeto(objeto) {
var wait=1;
var param='';
var ajax=null;
var divObjeto=null;
	switch(objeto)
	{
		case 1: //titulo
			div='dtitulo';
			param='objeto=1';
			wait=0;
			break;
		case 2: //mapa
			div='dmapa';
			param='objeto=2';
			break;
		case 3: //radio
			div='dradio';
			param='objeto=3';
			break;
		case 4: //tabla
			div='ftabla';
			param='objeto=4';
			break;		
	}
	divObjeto = document.getElementById(div);
	if (wait==1)
	document.getElementById(div).innerHTML='<img src="img/ajax-loader_max.gif" width="66" height="66">';
		
	ajax=objetoAjax();
	ajax.open('POST','int_objeto.php');
	ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	ajax.send(param);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 ) {
			divObjeto.innerHTML=ajax.responseText;
			if (objeto==2)
			ajx_mapa();
			divObjeto.style.display="block";
		}
	}
}