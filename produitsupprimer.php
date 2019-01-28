<?php
include 'utils.php';
$pref = $_GET["pref"];
$table = "produit";
$afterWhere = "référence=$pref";
// supprimer le produit de l'indexe
fDelete($table,$afterWhere);
echo "<script language=\"javascript\"> window.location='vendeur.php';</script>";
?>
