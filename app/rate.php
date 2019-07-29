<?php 
include('server.php'); 

if(isset($_GET['pivo'], $_GET['rating'])){
	$pivo = (int)$_GET['pivo'];
	$rating = (int)$_GET['rating'];

	$sql = "INSERT INTO pivo_hodnoceni (fk_pivo, rating) 
	VALUES ( $pivo, $rating)";
	mysqli_query($db, $sql);
	header('Location: Pivo.php');
}
if(isset($_GET['pivovar'], $_GET['rating'])){
	$pivovar = (int)$_GET['pivovar'];
	$rating = (int)$_GET['rating'];

	$sql = "INSERT INTO pivovar_hodnoceni (fk_pivovaru, rating) 
	VALUES ( $pivovar, $rating)";
	mysqli_query($db, $sql);
	header('Location: Pivovary.php');
}
?>