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
  if(count($paniers)!=0){
    $panierId = $paniers[0]['id'];
  }

  $pref = $_GET["pref"];
  $userEmail = $_SESSION['userEmail'];
  $table = "produitDansPanier";
  $afterWhere = "panier=$panierId AND produit=$pref";
  if (fDelete($table,$afterWhere)) {
    echo '<script language="JavaScript">;alert("Vous avez supprimé avec succès ce produit de votre panier !");location.href="panier.php";</script>;';
    }
  else{
    echo '<script language="JavaScript">;alert("erreur de suppression!");location.href="panier.php";</script>';
  }
}
?>
