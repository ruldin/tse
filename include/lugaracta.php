<?php
class celeccion {
// Clase para  despliegue de grafica de Barras


    function __construct() {
	}

    function nombredepartamento() {
         return array ( 0 => 'Nacional',
		                1 => 'Guatemala', 2 => 'Sacatep�quez', 3 => 'Chimaltenango', 4 => 'El Progreso', 5 => 'Escuintla', 
	                    6 => 'Santa Rosa', 7 => 'Solol�', 8 => 'Totonicap�n',  9 => 'Quetzaltenango', 10 => 'Suchitep�quez', 
			 		   11 => 'Retalhuleu', 12 => 'San Marcos', 13 => 'Huehuetenango', 14 => 'Quich�', 15 => 'Baja Verapaz', 
					   16 => 'Alta Verapaz', 17 => 'Pet�n', 18 => 'Izabal', 19 => 'Zacapa', 20 => 'Chiquimula', 
     				   21 => 'Jalapa', 22 => 'Jutiapa' );
    }
   
    function nombremunicipio($depto) {
        $amuni = array ( 1 => array ( 0 => 'Departamental',
		                               1 => 'Santa Catarina Pinula', 2 => 'San Jos� Pinula', 
	                                  3 => 'San Jos� del Golfo', 4 => 'Palencia', 5 => 'Chinautla', 6 => 'San Pedro Ayampuc', 
									  7 => 'Mixco', 8 => 'San Pedro Sacatep�quez', 9 => 'San Juan Sacatep�quez', 
									 10 => 'San Raimundo', 11 => 'Chuarrancho', 12 => 'Fraijanes', 13 => 'Amatitl�n', 
									 14 => 'Villa Nueva', 15 => 'Villa Canales', 16 => 'Petapa'),
						 2 => array ( 0 => 'Departamental',
						              1 => 'Antigua Guatemala',2 => 'Jocotenango',3 => 'Pastores',4 => 'Sumpango',
						 			  5 => 'Santo Domingo Xenacoj',6 => 'Santiago Sacatep�quez', 7 => 'San Bartolom� Milpas Altas',
						   			  8 => 'San Lucas Sacatep�quez', 9 => 'Santa Luc�a Milpas Altas', 
									 10 => 'Magdalena Milpas Altas', 11 => 'Santa Mar�a de Jes�s', 12 => 'Ciudad Vieja', 
									 13 => 'San Miguel Due�as', 14 => 'Alotenango', 15 => 'San Antonio Aguas Calientes', 
									 16 => 'Santa Catarina Barahona'),
		 			     3 => array ( 0 => 'Departamental',
						              1 => 'Chimaltenango', 2 => 'San Jos� Poaquil', 3 => 'San Mart�n Jilotepeque', 4 => 'Comalapa',
						 			  5 => 'Santa Apolonia', 6 => 'Tecp�n Guatemala', 7 => 'Patz�n', 8 => 'Pochuta', 
						   			  9 => 'Patzic�a', 10 => 'Santa Cruz Balany�', 11 => 'Acatenango', 12 => 'Yepocapa', 
									 13 => 'San andr�s Itzapa', 14 => 'Parramos', 15 => 'Zaragoza', 16 => 'El Tejar'),
	                     4 => array ( 0 => 'Departamental',
						              1 => 'Guastatoya', 2 => 'Moraz�n', 3 => 'San Agust�n Acasaguastlan', 
						              4 => 'San Crist�bal Acasaguastlan', 5 => 'El J�caro', 6 => 'Sansare', 7 => 'Sanarate', 
						 			  8 => 'San Antonio La Paz'),
                         5 => array ( 0 => 'Departamental',
						              1 => 'Escuintla', 2 => 'Santa Luc�a Cotzumalguapa', 3 => 'La Democracia', 4 => 'Siquinal�', 
						              5 => 'Masagua', 6 => 'Tiquisate', 7 => 'La Gomera', 8 => 'Guanagazapa', 9 => 'San Jos�', 
									 10 => 'Iztapa', 11 => 'Palin', 12 => 'San Vicente Pacaya', 13 => 'Nueva Concepci�n'),
                         6 => array ( 0 => 'Departamental',
						              1 => 'Cuilapa', 2 => 'Barberena', 3 => 'Santa Rosa de Lima', 4 => 'Casillas', 
					                  5 => 'San Rafael Las Flores', 6 => 'Oratorio', 7 => 'San Juan Tecuaco', 8 => 'Chiquimulilla',
								      9 => 'Taxisco', 10 => 'Santa Mar�a Ixhuat�n', 11 => 'Guazacap�n', 12 => 'Santa Cruz Naranjo', 
									 13 => 'Pueblo Nuevo Vi�as', 14 => 'Nueva Santa Rosa'),
                         7 => array ( 0 => 'Departamental',
						              1 => 'Solol�', 2 => 'San Jos� Chacay�', 3 => 'Santa Mar�a Visitaci�n', 
						              4 => 'Santa Luc�a Utatl�n', 5 => 'Nahual�', 6 => 'Santa Catarina Ixtahuac�n', 
									  7 => 'Santa Clara La Laguna', 8 => 'Concepci�n', 9 => 'San Andr�s Semetabaj', 
									 10 => 'Panajachel', 11 => 'Santa Catarina Palop�', 12 => 'San Antonio Palopo', 
									 13 => 'San Lucas Tolim�n', 14 => 'Santa Cruz La Laguna', 15 => 'San Pablo La Laguna', 
									 16 => 'San Marcos La Laguna', 17 => 'San Juan La Laguna', 18 => 'San Pedro La Laguna', 
									 19 => 'Santiago Atitl�n'),
                         8 => array ( 0 => 'Departamental',
						              1 => 'Totonicap�n', 2 => 'San Crist�bal Totonicap�n', 3 => 'San Francisco El Alto', 
						              4 => 'San Andr�s Xecul', 5 => 'Momostenango', 6 => 'Santa Mar�a Chiquimula', 
									  7 => 'Santa Luc�a La Reforma', 8 => 'San Bartolo'),
					     9 => array ( 0 => 'Departamental',
						              1 => 'Quetzaltenango', 2 => 'Salcaj�', 3 => 'Olintepeque', 4 => 'San Carlos Sija', 
                                      5 => 'Sibilia', 6 => 'Cabric�n', 7 => 'Cajol�', 8 => 'San Miguel Sig�il�', 9 => 'Ostuncalco',
			                         10 => 'San Mateo', 11 => 'Concepcion Chiquirichapa', 12 => 'San Mart�n Sacatep�quez', 
									 13 => 'Almolonga', 14 => 'Cantel', 15 => 'Huit�n', 16 => 'Zunil', 17 => 'Colomba', 
									 18 => 'San Francisco La Uni�n', 19 => 'El Palmar', 20 => 'Coatepeque', 21 => 'G�nova', 
									 22 => 'Flores Costa Cuca', 23 => 'La Esperanza', 24 => 'Palestina de Los Altos'),
                        10 => array ( 0 => 'Departamental',
						              1 => 'Mazatenango', 2 => 'Cuyotenango', 3 => 'San Francisco Zapotitl�n', 
						              4 => 'San Bernardino', 5 => 'San Jos� el �dolo', 6 => 'Santo Domingo Suchitep�quez', 
								      7 => 'San Lorenzo', 8 => 'Samayac', 9 => 'San Pablo Jocopilas', 
									 10 => 'San Antonio Suchitep�quez', 11 => 'San Miguel Pan�n', 12 => 'San Gabriel', 
									 13 => 'Chicacao', 14 => 'Patulul', 15 => 'Santa B�rbara', 16 => 'San Juan Bautista', 
									 17 => 'Santo Tom�s La Uni�n', 18 => 'Zunilito', 19 => 'Pueblo Nuevo', 20 => 'R�o Bravo'),
                        11 => array ( 0 => 'Departamental',
						              1 => 'Retalhuleu', 2 => 'San Sebasti�n', 3 => 'Santa Cruz Mulu�', 
						              4 => 'San Mart�n Zapotitl�n', 5 => 'San Felipe', 6 => 'San Andr�s Villa Seca', 
									  7 => 'Champerico', 8 => 'Nuevo San Carlos', 9 => 'El Asintal'),
                        12 => array ( 0 => 'Departamental',
						              1 => 'San Marcos', 2 => 'San Pedro Sacatep�quez', 3 => 'San Antonio Sacatep�quez', 
						              4 => 'Comitancillo', 5 => 'San Miguel Ixtahuac�n', 6 => 'Concepci�n Tutuapa', 7 => 'Tacan�', 
									  8 => 'Sibinal', 9 => 'Tajumulco', 10 => 'Tejutla', 11 => 'San Rafael Pie de la Cuesta', 
									 12 => 'Nuevo Progreso', 13 => 'El Tumbador', 14 => 'El Rodeo', 15 => 'Malacat�n', 
									 16 => 'Catarina', 17 => 'Ayutla', 18 => 'Oc�s', 19 => 'San Pablo', 20 => 'El Quetzal', 
									 21 => 'La Reforma', 22 => 'Pajapita', 23 => 'Ixchiguan', 24 => 'San Jos� Ojetenam', 
									 25 => 'San Crist�bal Cucho', 26 => 'Sipacapa', 27 => 'Esquipulas Palo Gordo', 
									 28 => 'R�o Blanco', 29 => 'San Lorenzo'),
                        13 => array ( 0 => 'Departamental',
						              1 => 'Huehuetenango', 2 => 'Chiantla', 3 => 'Malacatancito', 4 => 'Cuilco', 5 => 'Nent�n', 
						              6 => 'San Pedro Necta', 7 => 'Jacaltenango', 8 => 'Solom�', 9 => 'Ixtahuac�n', 
									 10 => 'Santa B�rbara', 11 => 'La Libertad', 12 => 'La Democracia', 13 => 'San Miguel Acat�n',
                                     14 => 'San Rafael La Independencia', 15 => 'Todos Santos Cuchumat�n',16 => 'San Juan Atit�n',
                                     17 => 'Santa Eulalia', 18 => 'San Mateo Ixtat�n', 19 => 'Colotenango', 
									 20 => 'San Sebasti�n Huehuetenango', 21 => 'Tectit�n', 22 => 'Concepci�n Huista', 
									 23 => 'San Juan Ixcoy', 24 => 'San Antonio Huista', 25 => 'San Sebasti�n Coat�n', 
									 26 => 'Barillas', 27 => 'Aguacat�n', 28 => 'San Rafael Petzal', 29 => 'San Gaspar Ixchil', 
									 30 => 'Santiago Chimaltenango', 31 => 'Santa Ana Huista', 32 => 'Uni�n Cantinil'),
                         14 => array ( 0 => 'Departamental',
						               1 => 'Santa Cruz del Quich�', 2 => 'Chich�', 3 => 'Chinique', 4 => 'Zacualpa', 
						               5 => 'Chajul', 6 => 'Chichicastenango', 7 => 'Patzit�', 8 => 'San Antonio Ilotenango', 
								 	   9 => 'San Pedro Jocopilas', 10 => 'Cun�n', 11 => 'San Juan Cotzal', 12 => 'Joyabaj', 
									  13 => 'Nebaj', 14 => 'San Andr�s Sajcabaj�', 15 => 'Uspant�n', 16 => 'Sacapulas', 
									  17 => 'San Bartolom� Jocotenango', 18 => 'Canill�', 19 => 'Chicam�n', 20 => 'Ixc�n', 
									  21 => 'Pachalum'),
                          15 => array ( 0 => 'Departamental',
						                1 => 'Salam�', 2 => 'San Miguel Chicaj', 3 => 'Rabinal', 4 => 'Cubulco', 5 => 'Granados', 
						                6 => 'El Chol', 7 => 'San Jer�nimo', 8 => 'Purulh�'), 
                          16 => array ( 0 => 'Departamental',
						                1 => 'Cob�n', 2 => 'Santa Cruz Verapaz', 3 => 'San Crist�bal Verapaz', 4 => 'Tactic', 
						                5 => 'Tamah�', 6 => 'Tucur�', 7 => 'Panz�s', 8 => 'Senah�', 9 => 'San Pedro Carch�', 
										10 => 'San Juan Chamelco', 11 => 'Lanqu�n', 12 => 'Cahab�n', 13 => 'Chisec', 14 => 'Chahal', 15 => 'Fray bartolom� de las Casas', 16 => 'Santa Catalina la Tinta', 17 => 'Raxruh�'),
                          17 => array ( 0 => 'Departamental',
						                1 => 'Flores', 2 => 'San Jos�', 3 => 'San Benito', 4 => 'San Andr�s', 5 => 'La Libertad', 
						                6 => 'San Francisco', 7 => 'Santa Ana', 8 => 'Dolores', 9 => 'San Luis', 10 => 'Sayaxch�', 
										11 => 'Melchor de Mencos', 12 => 'Popt�n'),
                          18 => array ( 0 => 'Departamental',
						                1 => 'Puerto Barrios', 2 => 'Livingston', 3 => 'El Estor', 4 => 'Morales', 
						                5 => 'Los Amates'),
                          19 => array ( 0 => 'Departamental',
						                1 => 'Zacapa', 2 => 'Estanzuela', 3 => 'R�o Hondo', 4 => 'Gualan', 5 => 'Teculut�n', 
						                6 => 'Usumatl�n', 7 => 'Caba�as', 8 => 'San Diego', 9 => 'La Uni�n', 10 => 'Huit�'),
                          20 => array ( 0 => 'Departamental',
						                1 => 'Chiquimula', 2 => 'San Jos� La Arada', 3 => 'San Juan Ermita', 4 => 'Jocot�n', 
						                5 => 'Camot�n', 6 => 'Olopa', 7 => 'Esquipulas', 8 => 'Concepci�n Las Minas', 
										9 => 'Quezaltepeque', 10 => 'San Jacinto', 11 => 'Ipala'),
                          21 => array ( 0 => 'Departamental',
						                1 => 'Jalapa', 2 => 'San Pedro Pinula', 3 => 'San Luis Jilotepeque', 
						                4 => 'San Manuel Chaparr�n', 5 => 'San Carlos Alzatate', 6 => 'Monjas', 
										7 => 'Mataquescuintla'),
                         22 => array ( 0 => 'Departamental',
						               1 => 'Jutiapa', 2 => 'El Progreso', 3 => 'Santa Catarina Mita', 4 => 'Agua Blanca', 
						               5 => 'Asunci�n Mita', 6 => 'Yupiltepeque', 7 => 'Atescatempa', 8 => 'Jerez', 
   									   9 => 'El Adelanto', 10 => 'Zapotitl�n', 11 => 'Comapa', 12 => 'Jalpatagua', 13 => 'Conguaco',
									  14 => 'Moyuta', 15 => 'Pasaco', 16 => 'San Jos� Acatempa', 17 => 'Quesada')
                         );
		 return $amuni[$depto];
   }

   function __destruct() {
	}
}

class clugar {
   private $p_te; 
   private $p_depto;
   private $p_muni;
   private $p_forma;
   private $alugar;
   private $aresultado;
   
   function __construct($te,$depto,$muni,$forma,$nomfun,$inicio) {
      $this->p_te=$te;
      $this->p_depto=$depto;
	  $this->p_muni=$muni;
	  $this->p_forma=$forma;
	  $this->p_nomfun=$nomfun;
	  $this->p_inicio=$inicio;
	  if($forma==1)  { $this->aresultado=$this->tablalugar(); }
	  elseif ($forma==2) { $this->aresultado=$this->listalugar(); }
	  elseif ($forma==3) { $this->aresultado=$this->combolugar(); }
	  elseif ($forma==4) { $this->aresultado=$this->combolugarmesa(); };
   } 
   
   
   function tablalugar() {
       $eleccion = new celeccion(); 

       if($this->p_depto==0 && $this->p_muni==0)  $this->alugar = $eleccion->nombredepartamento();
	   else if($this->p_depto!=0 && $this->p_muni==0)  $this->alugar = $eleccion->nombremunicipio($this->p_depto);
       if ($this->p_inicio ==1) $this->alugar[0]='SELECCIONAR';

       $lista = '<table>';
	   $i=1;
       while($i <= count($this->alugar)) {
    	    $lista = $lista.'<tr>';
   			$j=0;
  	        while ($j<5  && $i<= count($this->alugar)) {
		          $lista=$lista .'<td>'.$this->alugar[$i].'</td>';
				  $i++;
				  $j++;
		    }
     	    $lista = $lista.'</tr>';
	   }
	   $lista = $lista.'</table>';
	   return $lista;
   }
   
   function listalugar() {
       $eleccion = new celeccion(); 

       if($this->p_depto==0 && $this->p_muni==0)  $this->alugar = $eleccion->nombredepartamento();
	   else if($this->p_depto!=0 && $this->p_muni==0)  $this->alugar = $eleccion->nombremunicipio($this->p_depto);
       if ($this->p_inicio ==1) $this->alugar[0]='SELECCIONAR';

       $lista = '<table><tr><td>No.</td><td>Nombres</td></tr>';
	   $i=1;
       while($i <= count($this->alugar)) {
    	    $lista = $lista.'<tr>';
            $lista=$lista .'<td>'.$i.'</td>';
            $lista=$lista .'<td><a style="text-decoration:underline;cursor:pointer;" onclick="pedirDatos(\'';
			if( $this->p_depto==0 )  $lista= $lista .$this->p_te.'\',\''.$i. '\',\'0\');">'. $this->alugar[$i] .'</a></td>'; 
      		else $lista = $lista. $this->p_te.'\',\''.$this->p_depto .'\',\''. $i.'\');">'. $this->alugar[$i].'</a></td>'; 
     	    $lista = $lista.'</tr>';
		  $i++;
       }
	   $lista = $lista.'</table>';
	   return $lista;
   }

   function combolugar() {
       $eleccion = new celeccion();
   	   
       if($this->p_depto==0 && $this->p_muni==0) {
  	      $this->alugar = $eleccion->nombredepartamento();
		  $lista='Departamento:<br/><select name="dep" onChange="'.$this->p_nomfun.'(document.formulario.dep.options[document.formulario.dep.selectedIndex].value)">';
       }
	   else if($this->p_depto!=0 && $this->p_muni==0) {
	       $this->alugar = $eleccion->nombremunicipio($this->p_depto);
	  	   $lista='Municipio:<br/><select name="mun" onChange="'.$this->p_nomfun.'(document.formulario.mun.options[document.formulario.mun.selectedIndex].value)">';
	   }
       if ($this->p_inicio ==1) $this->alugar[0]='SELECCIONAR';
       $i=0;
       while($i < count($this->alugar)) {
            $lista=$lista .'<option value="'.$i.'">'.$this->alugar[$i].'</option>';
 		    $i++;
       }
	   $lista = $lista.'</select>';
	   return $lista;
   }

   function combolugarmesa() {
       $eleccion = new celeccion();
   	   
       if($this->p_depto==0 && $this->p_muni==0) {
  	      $this->alugar = $eleccion->nombredepartamento();
		  $lista='Departamento:<br/><select name="dep" onChange="'.$this->p_nomfun.'(document.formesa.dep.options[document.formesa.dep.selectedIndex].value)">';
       }
	   else if($this->p_depto!=0 && $this->p_muni==0) {
	       $this->alugar = $eleccion->nombremunicipio($this->p_depto);
	  	   $lista='Municipio:<br/><select name="mun" onChange="'.$this->p_nomfun.'(document.formesa.mun.options[document.formesa.mun.selectedIndex].value)">';
	   }
       if ($this->p_inicio ==1) $this->alugar[0]='SELECCIONAR';
       $i=0;
       while($i < count($this->alugar)) {
            $lista=$lista .'<option value="'.$i.'">'.$this->alugar[$i].'</option>';
 		    $i++;
       }
	   $lista = $lista.'</select>';
	   return $lista;
   }
   
   
   function datoslugar() {
	   return $this->aresultado;
   }
   
}

?>
