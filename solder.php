<?php
header("Content-Type: text/html;charset=utf-8");
include "utils.php";
session_start();
if(!isset($_SESSION['userEmail'])){
  echo '<script language="JavaScript"> if(confirm( "Vous n\'être pas connecté. Veuillez vous connecter?"))  location.href="login.html";else location.href="index.php"; </script>';
}
else{
  $userEmail = $_SESSION['userEmail'];
  $vSql = "select id from panier where acheteur='$userEmail' AND soldé='f';";
  $paniers = fSelect($vSql);
  if(count($paniers)==0){
    echo '<script language="JavaScript">;alert("Vous avez soldé tous vos paniers. Merci!");location.href="index.php";</script>;';
  }
  else{
 	$table = "panier";
	$afterSet = "soldé='t'";
	$afterWhere = "acheteur='$userEmail' AND soldé='f'";
	if(fUpdate($table,$afterSet,$afterWhere)){
    echo '<script language="JavaScript">;alert("Vous avez soldé avec succès votre panier!");location.href="index.php";</script>;';
    }
  	else{
   	 echo '<script language="JavaScript">;alert("Erreur");location.href="index.php";</script>';
  	}
  }
}

?>
