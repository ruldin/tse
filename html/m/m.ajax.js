function objetoAjax() {
var httpRequest;
	if (window.XMLHttpRequest) {
		httpRequest = new XMLHttpRequest();
	} 
	else if (window.ActiveXObject) {
		try {
			httpRequest = new ActiveXObject("MSXML2.XMLHTTP");
		} catch (e) {
			try {
				httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {}
		}
	}
	if (!httpRequest) {
	alert("No ha sido posible crear una instancia de XMLHttpRequest");
	}
	return httpRequest;
}

function ajx_tipoeleccion(vTmp) {
	var deptos=new Array();
	deptos[1]=["Nacional|0", "Guatemala|1", "Sacat\xe9pequez|2", "Chimaltenango|3", "El Progreso|4",
	"Escuintla|5", "Santa Rosa|6", "Solol\xe1|7",  "Totonicap\xe1n|8", "Quetzaltenango|9", "Suchitep\xe9quez|10",
	"Retalhuleu|11", "San Marcos|12", "Huehuetenango|13", "Quich\xe9|14", "Baja Verapaz|15", 
	"Alta Verapaz|16", "Pet\xe9n|17", "Izabal|18", "Zacapa|19", "Chiquimula|20", "Jalapa|21", "Jutiapa|22"];
	deptos[4]=["Santa Rosa|6", "Huehuetenango|13", "Quich\xe9|14", "Pet\xe9n|17", "Izabal|18"];
	tajax=objetoAjax();
	tajax.open("POST", "int_tipoeleccion.php");
	tajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	tajax.send("int_tipoeleccion="+vTmp);
	tajax.onreadystatechange=function() {
		if (tajax.readyState==4 ) {
			//actualizar combo departamentos
			var comboDeptos=document.formulario.cmb_dep;
			comboDeptos.options.length=0;
			for (i=0; i<deptos[vTmp].length; i++)
			comboDeptos.options[comboDeptos.options.length]=new Option(deptos[vTmp][i].split("|")[0], deptos[vTmp][i].split("|")[1]);							
			
			divMmuni = document.getElementById('mmuni');
			if (vTmp==1)
			//desaparece municipio
			divMmuni.style.display="none";
			else
			{
				divMmuni.innerHTML='Municipio:<br/><select name="cmb_mun"><option value="">Pueblo Nuevo Vi\xf1as</option></select>';
				divMmuni.style.display="block";
			}
			
			ajx_titulo();
			ajx_grafica();
			ajx_tabla();
		}
	}
}

function ajx_dep(vTmp) {
divMmuni = document.getElementById('mmuni');
if ( (vTmp==0) && (divMmuni.style.display == 'block')) {
	divMmuni.style.display="none";
	dajax=objetoAjax();
	dajax.open("POST", "int_nacional.php");
	dajax.onreadystatechange=function() {
		if (dajax.readyState==4 ) {
			ajx_titulo();
			ajx_grafica();
			ajx_tabla();
		}
	}
	dajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	dajax.send("int_dep="+vTmp);
}
else {
	divMmuni = document.getElementById('mmuni');
	document.getElementById('mmuni').innerHTML='<img src="ajax-loader_min.gif" width="16" height="16">';
	dajax=objetoAjax();
	dajax.open("POST", "int_dep.php");
	dajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	dajax.send("int_dep="+vTmp+"&int_titulo="+document.formulario.cmb_dep.options[document.formulario.cmb_dep.selectedIndex].text);
	dajax.onreadystatechange=function() {
		if (dajax.readyState==4 ) {
			divMmuni.innerHTML = dajax.responseText
			ajx_titulo();
			ajx_grafica();
			ajx_tabla();
			divMmuni.style.display="block";
		}
	}
}
}

function ajx_mun(vTmp) {
	document.formulario.cmb_mun.selectedIndex=vTmp;
	majax=objetoAjax();
	majax.open("POST", "int_mun.php");
	majax.onreadystatechange=function() {
		if (majax.readyState==4 ) {
			ajx_titulo();
			ajx_grafica();
			ajx_tabla();
		}
	}
	majax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	majax.send("int_mun="+vTmp+"&int_titulo="+document.formulario.cmb_mun.options[document.formulario.cmb_mun.selectedIndex].text);
}

function ajx_titulo() {
	divTitulo = document.getElementById('dtitulo');	
	bajax=objetoAjax();
	bajax.open("POST", "int_titulo.php");
	bajax.onreadystatechange=function() {
		if (bajax.readyState==4 ) {
			divTitulo.innerHTML = bajax.responseText
			divTitulo.style.display="block";
		}
	}
	bajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	bajax.send();
}

function ajx_tabla() {
	divFormulario = document.getElementById('ftabla');	
	document.getElementById('ftabla').innerHTML='<img src="ajax-loader_max.gif" width="66" height="66">';
	ajax=objetoAjax();
	ajax.open("POST", "int_tabla.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4 ) {
			divFormulario.innerHTML = ajax.responseText
			divFormulario.style.display="block";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send();
}

function ajx_grafica(){
	divGrafica = document.getElementById('fgrafica');	
	gajax=objetoAjax();
	gajax.open("POST", "int_grafica.php");
	gajax.onreadystatechange=function() {
		if (gajax.readyState==4 ) {
			divGrafica.innerHTML = gajax.responseText
			divGrafica.style.display="block";
		}
	}
	gajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	gajax.send();
}
