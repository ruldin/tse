<?php
session_start();
include '../include/tabla.php'; 
$mesa= $_POST['tmesa'];
$te= $_SESSION['ELECCION'];
$tab = new ctabla();
$tab->construyeTablaMesa($mesa,$te); 
?>
