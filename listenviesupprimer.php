<?php
include "utils.php";
session_start();
if(!isset($_SESSION['userEmail'])){
  echo '<script language="JavaScript"> if(confirm( "Vous n\'être pas connecté. Veuillez vous connecter?"))  location.href="login.html";else location.href="index.php"; </script>';
}
else{
  $pref = $_GET["pref"];
  $userEmail = $_SESSION['userEmail'];
  $table = "listeEnvie";
  $afterWhere = "produit=$pref AND acheteur='$userEmail'";
  if (fDelete($table,$afterWhere)) {
    echo '<script language="JavaScript">;alert("Vous avez supprimé avec succès ce produit dans votre liste d\'envie!");location.href="listeenvie.php";</script>;';
    }
  else{
    echo '<script language="JavaScript">;alert("erreur de suppression!");location.href="listeenvie.php";</script>';
  }
}
?>
