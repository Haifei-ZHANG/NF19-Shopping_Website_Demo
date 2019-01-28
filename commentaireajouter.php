<?php
session_start();
include "utils.php";
date_default_timezone_set("Europe/Paris");
if(!isset($_SESSION['userType'])){
	echo '<script language="JavaScript"> if(confirm( "Vous n\'être pas connecté. Veuillez vous connecter?"))  location.href="login.html";else location.href="index.php"; </script>';
}

else{
	$pref = $_POST['pref'];
	$userEmail = $_POST['acheteur'];
	$commentaire = $_POST['commentaire'];
	$note = $_POST['note'];
	$date = date("Y-m-d");
	$table = "commentaire";
	$columns = "(produit,acheteur,contenu,datePublication,note)";
	$pValues = "$pref,'$userEmail','$commentaire','$date',$note";
	if(fInsert($table,$pValues,$columns)){
			echo '<script language="JavaScript">;alert("Vous avez ajouté avec succès un commentaire!");location.href="produit.php?pref='.$pref.'";</script>;';
	}
	else{
		echo '<script language="JavaScript">;alert("Vous avez déjà commenté ce produit!!");location.href="produit.php?pref='.$pref.'";</script>;';
	}

}

?>