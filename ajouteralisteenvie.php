<?php
header("Content-Type: text/html;charset=utf-8");
include "utils.php";
session_start();
if(!isset($_SESSION['userEmail'])){
  echo '<script language="JavaScript"> if(confirm( "Vous n\'être pas connecté. Veuillez vous connecter?"))  location.href="login.html";else location.href="index.php"; </script>';
}
else{
  $userEmail = $_SESSION['userEmail'];
  $table = 'listeEnvie';
  $columns = "(produit,acheteur)";
  $produitref = $_POST["produitref"];
  $pValues = "'$produitref','$userEmail'";
  if (fInsert($table,$pValues,$columns)) {
    echo '<script language="JavaScript">;alert("Vous avez ajouté avec succès ce produit dans votre liste d\'envie!");location.href="index.php";</script>;';
    }
  else{
    echo '<script language="JavaScript">;alert("Vous avez déjà ajouté ce produit dans votre liste d\'envie!");location.href="index.php";</script>';
  }
}
?>
