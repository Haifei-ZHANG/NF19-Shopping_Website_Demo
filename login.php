<?php
//etablissement de la session
session_start();
include 'utils.php';

$userEmail = $_POST["email"];
$motDePass = $_POST["motDePass"];
//verifier les identifiants et connexion
$identity = array('administrateur','acheteur','vendeur');
for($i=0;$i<3;$i++){
	$vSql = "select * from $identity[$i] where email='$userEmail' and mdp='$motDePass'";
	$selection = fSelect($vSql);
	$connectionreussie = 0; // 1 si vrai
	if(count($selection)!=0){
		$_SESSION['userEmail'] = $userEmail;
		$_SESSION['motDePass'] = $motDePass;
		$_SESSION['userType'] = $identity[$i];
		$_SESSION['userLName'] = $selection[0]['nom'];
		$_SESSION['userFName'] = $selection[0]['prénom'];
		$_SESSION['userTel'] = $selection[0]['numerotel'];
		$_SESSION['userBirthday'] = $selection[0]['datedenaissance'];
		$connectionreussie = 1;
		if($_SESSION['userType'] == "acheteur")
		echo "<script language=\"javascript\"> window.location='index.php';</script>"; // Redirection vers index.php
		if($_SESSION['userType'] == "administrateur")
		echo "<script language=\"javascript\"> window.location='administrateur.php';</script>"; // Redirection vers administrateur.php
		if($_SESSION['userType'] == "vendeur")
		echo "<script language=\"javascript\"> window.location='vendeur.php';</script>"; // Redirection vers vendeur.php

	}
}

if ($connectionreussie == 0)
	{
		$message = "Email ou mot de passe incorrect";
		echo "<script type='text/javascript'>alert('$message');</script>";
		echo "<script language=\"javascript\"> window.location='login.html';</script>";
	}


?>
