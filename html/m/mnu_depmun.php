<?php
class vec_depmun {
// Clase para  despliegue de gráfica de Barras


    function __construct() {
	}

    function nombredepartamento() {
         return array ( 0 => 'Nacional',
		                1 => 'Guatemala', 2 => 'Sacatep&eacute;quez', 3 => 'Chimaltenango', 4 => 'El Progreso', 5 => 'Escuintla', 
	                    6 => 'Santa Rosa', 7 => 'Solol&aacute;', 8 => 'Totonicap&aacute;n',  9 => 'Quetzaltenango', 10 => 'Suchitep&eacute;quez', 
			 		   11 => 'Retalhuleu', 12 => 'San Marcos', 13 => 'Huehuetenango', 14 => 'Quich&eacute;', 15 => 'Baja Verapaz', 
					   16 => 'Alta Verapaz', 17 => 'Pet&eacute;n', 18 => 'Izabal', 19 => 'Zacapa', 20 => 'Chiquimula', 
     				   21 => 'Jalapa', 22 => 'Jutiapa' );
    }

    function nombredepartamentoAlcaldes() {
         return array (6 => 'Santa Rosa', 13 => 'Huehuetenango', 14 => 'Quich&eacute;', 17 => 'Pet&eacute;n', 18 => 'Izabal' );
    }
   
    function nombremunicipio($depto) {
        $amuni = array ( 1 => array ( 0 => 'Departamental',
		                              1 => 'Guatemala', 2 => 'Santa Catarina Pinula', 3 => 'San Jos&eacute; Pinula', 
	                                  4 => 'San Jos&eacute; del Golfo', 5 => 'Palencia', 6 => 'Chinautla', 7 => 'San Pedro Ayampuc', 
									  8 => 'Mixco', 9 => 'San Pedro Sacatep&eacute;quez', 10 => 'San Juan Sacatep&eacute;quez', 
									 11 => 'San Raimundo', 12 => 'Chuarrancho', 13 => 'Fraijanes', 14 => 'Amatitl&aacute;n', 
									 15 => 'Villa Nueva', 16 => 'Villa Canales', 17 => 'Petapa'),
						 2 => array ( 0 => 'Departamental',
						              1 => 'Antigua Guatemala',2 => 'Jocotenango',3 => 'Pastores',4 => 'Sumpango',
						 			  5 => 'Santo Domingo Xenacoj',6 => 'Santiago Sacatep&eacute;quez', 7 => 'San Bartolom&eacute; Milpas Altas',
						   			  8 => 'San Lucas Sacatep&eacute;quez', 9 => 'Santa Luc&iacute;a Milpas Altas', 
									 10 => 'Magdalena Milpas Altas', 11 => 'Santa Mar&iacute;a de Jes&uacute;s', 12 => 'Ciudad Vieja', 
									 13 => 'San Miguel Due&ntilde;as', 14 => 'Alotenango', 15 => 'San Antonio Aguas Calientes', 
									 16 => 'Santa Catarina Barahona'),
		 			     3 => array ( 0 => 'Departamental',
						              1 => 'Chimaltenango', 2 => 'San Jos&eacute; Poaquil', 3 => 'San Mart&iacute;n Jilotepeque', 4 => 'Comalapa',
						 			  5 => 'Santa Apolonia', 6 => 'Tecp&aacute;n Guatemala', 7 => 'Patz&uacute;n', 8 => 'Pochuta', 
						   			  9 => 'Patzic&iacute;a', 10 => 'Santa Cruz Balany&aacute;', 11 => 'Acatenango', 12 => 'Yepocapa', 
									 13 => 'San andr&eacute;s Itzapa', 14 => 'Parramos', 15 => 'Zaragoza', 16 => 'El Tejar'),
	                     4 => array ( 0 => 'Departamental',
						              1 => 'Guastatoya', 2 => 'Moraz&aacute;n', 3 => 'San Agust&iacute;n Acasaguastl&aacute;n', 
						              4 => 'San Crist&oacute;bal Acasaguastl&aacute;n', 5 => 'El J&iacute;caro', 6 => 'Sansare', 7 => 'Sanarate', 
						 			  8 => 'San Antonio La Paz'),
                         5 => array ( 0 => 'Departamental',
						              1 => 'Escuintla', 2 => 'Santa Luc&iacute;a Cotzumalguapa', 3 => 'La Democracia', 4 => 'Siquinal&aacute;', 
						              5 => 'Masagua', 6 => 'Tiquisate', 7 => 'La Gomera', 8 => 'Guanagazapa', 9 => 'San Jos&eacute;', 
									 10 => 'Iztapa', 11 => 'Pal&iacute;n', 12 => 'San Vicente Pacaya', 13 => 'Nueva Concepci&oacute;n'),
                         6 => array ( 0 => 'Departamental',
						              1 => 'Cuilapa', 2 => 'Barberena', 3 => 'Santa Rosa de Lima', 4 => 'Casillas', 
					                  5 => 'San Rafael Las Flores', 6 => 'Oratorio', 7 => 'San Juan Tecuaco', 8 => 'Chiquimulilla',
								      9 => 'Taxisco', 10 => 'Santa Mar&iacute;a Ixhuat&aacute;n', 11 => 'Guazacap&aacute;n', 12 => 'Santa Cruz Naranjo', 
									 13 => 'Pueblo Nuevo Vi&ntilde;as', 14 => 'Nueva Santa Rosa'),
                         7 => array ( 0 => 'Departamental',
						              1 => 'Solol&aacute;', 2 => 'San Jos&eacute; Chacay&aacute;', 3 => 'Santa Mar&iacute;a Visitaci&oacute;n', 
						              4 => 'Santa Luc&iacute;a Utatl&aacute;n', 5 => 'Nahual&aacute;', 6 => 'Santa Catarina Ixtahuac&aacute;n', 
									  7 => 'Santa Clara La Laguna', 8 => 'Concepci&oacute;n', 9 => 'San Andr&eacute;s Semetabaj', 
									 10 => 'Panajachel', 11 => 'Santa Catarina Palop&oacute;', 12 => 'San Antonio Palop&oacute;', 
									 13 => 'San Lucas Tolim&aacute;n', 14 => 'Santa Cruz La Laguna', 15 => 'San Pablo La Laguna', 
									 16 => 'San Marcos La Laguna', 17 => 'San Juan La Laguna', 18 => 'San Pedro La Laguna', 
									 19 => 'Santiago atitl&aacute;n'),
                         8 => array ( 0 => 'Departamental',
						              1 => 'Totonicap&aacute;n', 2 => 'San Crist&oacute;bal Totonicap&aacute;n', 3 => 'San Francisco El Alto', 
						              4 => 'San Andr&eacute;s Xecul', 5 => 'Momostenango', 6 => 'Santa Mar&iacute;a Chiquimula', 
									  7 => 'Santa Luc&iacute;a La Reforma', 8 => 'San Bartolo'),
					     9 => array ( 0 => 'Departamental',
						              1 => 'Quetzaltenango', 2 => 'Salcaj&aacute;', 3 => 'Olintepeque', 4 => 'San Carlos Sija', 
                                      5 => 'Sibilia', 6 => 'Cabric&aacute;n', 7 => 'Cajol&aacute;', 8 => 'San Miguel Sig&uuml;il&aacute;', 9 => 'Ostuncalco',
			                         10 => 'San Mateo', 11 => 'Concepci&oacute;n Chiquirichapa', 12 => 'San Mart&iacute;n Sacatep&eacute;quez', 
									 13 => 'Almolonga', 14 => 'Cantel', 15 => 'Huit&aacute;n', 16 => 'Zunil', 17 => 'Colomba', 
									 18 => 'San Francisco La Uni&oacute;n', 19 => 'El Palmar', 20 => 'Coatepeque', 21 => 'G&eacute;nova', 
									 22 => 'Flores Costa Cuca', 23 => 'La Esperanza', 24 => 'Palestina de Los Altos'),
                        10 => array ( 0 => 'Departamental',
						              1 => 'Mazatenango', 2 => 'Cuyotenango', 3 => 'San Francisco Zapotitl&aacute;n', 
						              4 => 'San Bernardino', 5 => 'San Jos&eacute; el &Iacute;dolo', 6 => 'Santo Domingo Suchitep&eacute;quez', 
								      7 => 'San Lorenzo', 8 => 'Samayac', 9 => 'San Pablo Jocopilas', 
									 10 => 'San Antonio Suchitep&eacute;quez', 11 => 'San Miguel Pan&aacute;n', 12 => 'San Gabriel', 
									 13 => 'Chicacao', 14 => 'Patulul', 15 => 'Santa B&aacute;rbara', 16 => 'San Juan Bautista', 
									 17 => 'Santo Tom&aacute;s La Uni&oacute;n', 18 => 'Zunilito', 19 => 'Pueblo Nuevo', 20 => 'R&iacute;o Bravo'),
                        11 => array ( 0 => 'Departamental',
						              1 => 'Retalhuleu', 2 => 'San Sebasti&aacute;n', 3 => 'Santa Cruz Mulu&aacute;', 
						              4 => 'San Mart&iacute;n Zapotitl&aacute;n', 5 => 'San Felipe', 6 => 'San Andr&eacute;s Villa Seca', 
									  7 => 'Champerico', 8 => 'Nuevo San Carlos', 9 => 'El Asintal'),
                        12 => array ( 0 => 'Departamental',
						              1 => 'San Marcos', 2 => 'San Pedro Sacatep&eacute;quez', 3 => 'San Antonio Sacatep&eacute;quez', 
						              4 => 'Comitancillo', 5 => 'San Miguel Ixtahuac&aacute;n', 6 => 'Concepci&oacute;n Tutuapa', 7 => 'Tacan&aacute;', 
									  8 => 'Sibinal', 9 => 'Tajumulco', 10 => 'Tejutla', 11 => 'San Rafael Pie de la Cuesta', 
									 12 => 'Nuevo Progreso', 13 => 'El Tumbador', 14 => 'El Rodeo', 15 => 'Malacat&aacute;n', 
									 16 => 'Catarina', 17 => 'Ayutla', 18 => 'Oc&oacute;s', 19 => 'San Pablo', 20 => 'El Quetzal', 
									 21 => 'La Reforma', 22 => 'Pajapita', 23 => 'Ixchigu&aacute;n', 24 => 'San Jos&eacute; Ojetenam', 
									 25 => 'San Crist&oacute;bal Cucho', 26 => 'Sipacapa', 27 => 'Esquipulas Palo Gordo', 
									 28 => 'R&iacute;o Blanco', 29 => 'San Lorenzo'),
                        13 => array ( 0 => 'Departamental',
						              1 => 'Huehuetenango', 2 => 'Chiantla', 3 => 'Malacatancito', 4 => 'Cuilco', 5 => 'Nent&oacute;n', 
						              6 => 'San Pedro Necta', 7 => 'Jacaltenango', 8 => 'Solom&aacute;', 9 => 'Ixtahuac&aacute;n', 
									 10 => 'Santa B&aacute;rbara', 11 => 'La Libertad', 12 => 'La Democracia', 13 => 'San Miguel Acat&aacute;n',
                                     14 => 'San Rafael La Independencia', 15 => 'Todos Santos Cuchumat&aacute;n',16 => 'San Juan Atit&aacute;n',
                                     17 => 'Santa Eulalia', 18 => 'San Mateo Ixtat&aacute;n', 19 => 'Colotenango', 
									 20 => 'San Sebasti&aacute;n Huehuetenango', 21 => 'Tectit&aacute;n', 22 => 'Concepci&oacute;n Huista', 
									 23 => 'San Juan Ixcoy', 24 => 'San Antonio Huista', 25 => 'San Sebasti&aacute;n Coat&aacute;n', 
									 26 => 'Barillas', 27 => 'Aguacat&aacute;n', 28 => 'San Rafael Petzal', 29 => 'San Gaspar Ixchil', 
									 30 => 'Santiago Chimaltenango', 31 => 'Santa Ana Huista', 32 => 'Uni&oacute;n Cantinil'),
                         14 => array ( 0 => 'Departamental',
						               1 => 'Santa Cruz del Quich&eacute;', 2 => 'Chich&eacute;', 3 => 'Chinique', 4 => 'Zacualpa', 
						               5 => 'Chajul', 6 => 'Chichicastenango', 7 => 'Patzit&eacute;', 8 => 'San Antonio Ilotenango', 
								 	   9 => 'San Pedro Jocopilas', 10 => 'Cun&eacute;n', 11 => 'San Juan Cotzal', 12 => 'Joyabaj', 
									  13 => 'Nebaj', 14 => 'San Andr&eacute;s Sajcabaj&aacute;', 15 => 'Uspant&aacute;n', 16 => 'Sacapulas', 
									  17 => 'San Bartolom&eacute; Jocotenango', 18 => 'Canill&aacute;', 19 => 'Chicam&aacute;n', 20 => 'Ixc&aacute;n', 
									  21 => 'Pachalum'),
                          15 => array ( 0 => 'Departamental',
						                1 => 'Salam&aacute;', 2 => 'San Miguel Chicaj', 3 => 'Rabinal', 4 => 'Cubulco', 5 => 'Granados', 
						                6 => 'El Chol', 7 => 'San Jer&oacute;nimo', 8 => 'Purulh&aacute;'), 
                          16 => array ( 0 => 'Departamental',
						                1 => 'Cob&aacute;n', 2 => 'Santa Cruz Verapaz', 3 => 'San Crist&oacute;bal Verapaz', 4 => 'Tactic', 
						                5 => 'Tamah&uacute;', 6 => 'Tucur&uacute;', 7 => 'Panz&oacute;s', 8 => 'Senah&uacute;', 9 => 'San Pedro Carch&aacute;', 
										10 => 'San Juan Chamelco', 11 => 'Lanqu&iacute;n', 12 => 'Cahab&oacute;n', 13 => 'Chisec', 14 => 'Chahal', 15 => 'Fray bartolom&eacute; de las Casas', 16 => 'Santa Catalina la Tinta', 17 => 'Raxruh&aacute;'),
                          17 => array ( 0 => 'Departamental',
						                1 => 'Flores', 2 => 'San Jos&eacute;', 3 => 'San Benito', 4 => 'San Andr&eacute;s', 5 => 'La Libertad', 
						                6 => 'San Francisco', 7 => 'Santa Ana', 8 => 'Dolores', 9 => 'San Luis', 10 => 'Sayaxch&eacute;', 
										11 => 'Melchor de Mencos', 12 => 'Popt&uacute;n'),
                          18 => array ( 0 => 'Departamental',
						                1 => 'Puerto Barrios', 2 => 'Livingston', 3 => 'El Estor', 4 => 'Morales', 
						                5 => 'Los Amates'),
                          19 => array ( 0 => 'Departamental',
						                1 => 'Zacapa', 2 => 'Estanzuela', 3 => 'R&iacute;o Hondo', 4 => 'Gual&aacute;n', 5 => 'Teculut&aacute;n', 
						                6 => 'Usumatl&aacute;n', 7 => 'Caba&ntilde;as', 8 => 'San Diego', 9 => 'La Uni&oacute;n', 10 => 'Huit&eacute;'),
                          20 => array ( 0 => 'Departamental',
						                1 => 'Chiquimula', 2 => 'San Jos&eacute; La Arada', 3 => 'San Juan Ermita', 4 => 'Jocot&aacute;n', 
						                5 => 'Camot&aacute;n', 6 => 'Olopa', 7 => 'Esquipulas', 8 => 'Concepci&oacute;n Las Minas', 
										9 => 'Quezaltepeque', 10 => 'San Jacinto', 11 => 'Ipala'),
                          21 => array ( 0 => 'Departamental',
						                1 => 'Jalapa', 2 => 'San Pedro Pinula', 3 => 'San Luis Jilotepeque', 
						                4 => 'San Manuel Chaparr&oacute;n', 5 => 'San Carlos Alzatate', 6 => 'Monjas', 
										7 => 'Mataquescuintla'),
                         22 => array ( 0 => 'Departamental',
						               1 => 'Jutiapa', 2 => 'El Progreso', 3 => 'Santa Catarina Mita', 4 => 'Agua Blanca', 
						               5 => 'Asunci&oacute;n Mita', 6 => 'Yupiltepeque', 7 => 'Atescatempa', 8 => 'Jerez', 
   									   9 => 'El Adelanto', 10 => 'Zapotitl&aacute;n', 11 => 'Comapa', 12 => 'Jalpatagua', 13 => 'Conguaco',
									  14 => 'Moyuta', 15 => 'Pasaco', 16 => 'San Jos&eacute; Acatempa', 17 => 'Quesada')
                         );
		 return $amuni[$depto];
   }

   function nombremunicipioAlcaldes($depto) {
	$amuni = array ( 
	6  => array ( 13 => 'Pueblo Nuevo Vi&ntilde;as' ),
	13 => array ( 21 => 'Tectit&aacute;n' ),
	14 => array ( 3 => 'Chinique' ),
	17 => array ( 2 => 'San Jos&eacute;' ),
	18 => array ( 3 => 'El Estor' )
	);
	return $amuni[$depto];
	}
	
   function __destruct() {
	}
}

class cls_depmun {
private $p_te; 
private $p_depto;
private $p_muni;
private $p_nomfun;
private $p_inicio;
   
	function __construct($te,$depto,$muni,$nomfun,$inicio) {
		$this->p_te=$te;
		$this->p_depto=$depto;
		$this->p_muni=$muni;
		$this->p_nomfun=$nomfun;
		$this->p_inicio=$inicio;
		echo $this->combo();	  
	} 
    
	function combo() {
		$tmp = new vec_depmun();
   	   
		if ($this->p_te==1)
		{
		   if($this->p_depto==0 && $this->p_muni==0) {
			  $vec = $tmp->nombredepartamento();
			  $html = 'Departamento:<br/><select name="cmb_dep" onChange="'.$this->p_nomfun.'(document.formulario.cmb_dep.options[document.formulario.cmb_dep.selectedIndex].value)">';
			}
			else if($this->p_depto!=0 && $this->p_muni==0) {
			   $vec = $tmp->nombremunicipio($this->p_depto);
			   $html = 'Municipio:<br/><select name="cmb_mun" onChange="'.$this->p_nomfun.'(document.formulario.cmb_mun.options[document.formulario.cmb_mun.selectedIndex].value)">';
			}
		}
		elseif ($this->p_te==4)
		{
		   if($this->p_depto==0 && $this->p_muni==0) {
			  $vec = $tmp->nombredepartamentoAlcaldes();
			  $html = 'Departamento:<br/><select name="cmb_dep" onChange="'.$this->p_nomfun.'(document.formulario.cmb_dep.options[document.formulario.cmb_dep.selectedIndex].value)">';
			}
			else if($this->p_depto!=0 && $this->p_muni==0) {
			   $vec = $tmp->nombremunicipioAlcaldes($this->p_depto);
			   $html = 'Municipio:<br/><select name="cmb_mun" onChange="'.$this->p_nomfun.'(document.formulario.cmb_mun.options[document.formulario.cmb_mun.selectedIndex].value)">';
			}
			else
			{
			   $vec = $tmp->nombremunicipioAlcaldes($this->p_depto);
			   $html = 'Municipio:<br/><select name="cmb_mun" onChange="'.$this->p_nomfun.'(document.formulario.cmb_mun.options[document.formulario.cmb_mun.selectedIndex].value)">';
			}
		}
		if ($this->p_inicio==1) $vec[0]='SELECCIONAR';
		/*$i=0;
		while($i < count($vec)) {
			$html.='<option value="'.$i.'">'.$vec[$i].'</option>';
			$i++;
		}*/
		while (list($i,$valor)=each($vec))
		$html.='<option value="'.$i.'">'.$valor.'</option>';		
		$html.='</select>';
		return $html;
	}   
}

?>