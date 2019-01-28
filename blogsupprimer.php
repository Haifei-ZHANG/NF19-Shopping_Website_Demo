<?php
include 'utils.php';
$blogid = $_GET["id"];
$table = "articleBlog";
$afterWhere = "id=$blogid";
//Supprimer le blog 
if(fDelete($table,$afterWhere)){
	echo "<script language=\"javascript\"> window.location='administrateur.php';</script>";
}
?>
