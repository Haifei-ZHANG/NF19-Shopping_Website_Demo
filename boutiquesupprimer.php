<?php
include 'utils.php';
$addweb = $_GET["addweb"];
$table = "boutique";
$afterWhere = "adresseweb='$addweb'";
//Supprimer le blog
if(fDelete($table,$afterWhere)){
	$table = "produit";
	$afterWhere = "boutique='$addweb'";
	if(fDelete($table,$afterWhere)){
			header("Location:/~na18a001/V2/vendeur.php");
	}
}
?>
