<?php
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
  else{
    $table = "panier";
    $columns="(acheteur)";
    $pValues = "'$userEmail'";
    if(fInsert($table,$pValues,$columns)){
      $vSql = "select id from panier where acheteur='$userEmail' AND soldé='f';";
      $paniers = fSelect($vSql);
      $panierId = $paniers[0]['id'];
    }
  }
  $table = 'produitDansPanier';
  $columns = "(panier,produit,quantité)";
  $produitref = $_POST["produitref"];
  $quantite = $_POST["quantite"];
  $pValues = "$panierId,'$produitref',$quantite";
  if (fInsert($table,$pValues,$columns)) {
    echo '<script language="JavaScript">;alert("Vous avez ajouté avec succès '.$quantite.' de ce produit dans votre panier!");location.href="index.php";</script>;';
    }
  else{
    echo '<script language="JavaScript">;alert("Vous avez déjà ajouté ce produit dans votre panier!");location.href="index.php";</script>';
  }
}
?>
