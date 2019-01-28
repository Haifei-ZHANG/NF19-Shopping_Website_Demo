<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet">
<!-- //font-awesome icons -->
<!-- js -->
<script src="js/jquery-1.11.1.min.js"></script>
<!-- //js -->
<link href='http://fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->
</head>

<body>
<!-- header -->
<?php
session_start();
include "utils.php";
if(!isset($_SESSION['userType'])){
	echo '<script language="JavaScript"> if(confirm( "Vous n\'être pas connecté. Veuillez vous connecter?"))  location.href="login.html";else location.href="index.php"; </script>';
}
else{
	echo "
	<div class=\"agileits_header\">
		<div class=\"container\">
			<div class=\"w60_offers\">
			<div class=\"agile-login\">
				<ul>
					<li><a href=\"profilmodif.php\">Profil</a></li>
					<li><a href=\"vendeur.php\">Boutiques</a></li>
					<li><a href=\"logout.php\">Déconnexion</a></li>
				</ul>
			</div>
			</div>
			<div class=\"clearfix\"> </div>
		</div>
	</div>
	";
}
?>
<!-- //header -->

<?php

	if(!isset($_SESSION['userType'])){
		die();
	}
	$userLName = $_SESSION['userLName'];
	$userFName = $_SESSION['userFName'];
	$userEmail = $_SESSION['userEmail'];
	$motDePass = $_SESSION['motDePass'];
	$userTel = $_SESSION['userTel'];
	$userBirthday = $_SESSION['userBirthday'];
	$userType = $_SESSION['userType'];
?>

<?php
//etablissement de la session

$proprietaire = $_SESSION["userEmail"];
$vSql = "select b.nom,b.adresseweb from boutique b where b.propriétaire='$proprietaire';";
//verifier si le vendeur possède déjà une boutique
$boutiques = fSelect($vSql);
//sinon
if(count($boutiques)== 0){
	echo "Vous n'avez pas créé de boutique. <a href='boutiqueajouter.php?email=$proprietaire'> Création d'une boutique.</a>";
}
//si oui
else
{
$vSql = "select nom from deuxsouscatégorie;";
$deuxsouscategories = fSelect($vSql);
//On renvoie vers le formulaire du produit
	echo "
		<div class=\"register\">
		<div class=\"container\">
			<h2>Ajoutez votre nouveau produit</h2>
			<div class=\"login-form-grids\">
		";
		echo"
		<form method='post' action='#'>
		<label>Nom du produit : </label>
		<input name='pnom' type='text'><br>
		<label>Description : </label>
		<input name='pdescription' type='text' ><br>
		<label>Prix : </label>
		<input name='pprix' type='text'><br>
		<label>Stock : </label>
		<input name='pstock' type='text'><br>
		<label>Produit en promotion ? </label>
		<input name='ppromotion' type='radio' value='t'>Oui
		<input name='ppromotion' type='radio' value='f'>Non
		<br><br><label>Prix en promotion : </label>
		<input name='pprixpromo' type='text'><br>
		<label>Date du début de la promotion : </label>
		<input name='pdatedebut' type='text'><br>
		<label>Date de fin de la promotion : </label>
		<input name='pdatefin' type='text'><br>
		<label>Objet unique ? </label>
		<input name='pobjunique' type='radio' value='t'>Oui
		<input name='pobjunique' type='radio' value='f'>Non
		<br><br><label>Le produit est une nouveauté dans cette boutique ? </label>
		<input name='pnouveau' type='radio' value='t'>Oui
		<input name='pnouveau' type='radio' value='f'>Non
		<br><br><label>Catégorie :</label>
		<select name='pdeuxsc'>";

		foreach($deuxsouscategories as $categorie){
		echo "<option value ='".$categorie['nom']."'>".$categorie['nom']."</option>";
		}
		echo "</select><br><br>
		<label>boutique : </label>
		<select name='pboutique'>";
		foreach($boutiques as $boutique){
		echo "<option value ='".$boutique['adresseweb']."'>".$boutique['nom']."</option>";
		}
		echo "</select><br><br>
		<input type='submit' name='pajouter'/>
		</form></div></div></div>"; // bouton pour ajouter le produit
?>


<?php
		if(isset($_POST["pajouter"])&&$_POST["pajouter"]){
			$pnom = $_POST['pnom'];
			$pdescription = $_POST['pdescription'];
			$pprix = $_POST['pprix'];
			$pstock = $_POST['pstock'];
			$pprixpromo = $_POST['pprixpromo'];
			$pdatedebut = $_POST['pdatedebut'];
			$pdatefin = $_POST['pdatefin'];
			$ppromotion = $_POST['ppromotion'];
			$pobjunique = $_POST['pobjunique'];
			$pnouveau = $_POST['pnouveau'];
			$pdeuxsc = $_POST['pdeuxsc'];
			$pboutique = $_POST['pboutique'];
			$table = 'produit';
			$columns= "(boutique, nom, description, prix, stock, prixpromo, datedébut, datefin, promotion, objetunique, nouveau, deuxsouscatégorie)";
			$pValues = "'$pboutique','$pnom', '$pdescription', $pprix, $pstock, NULL, NULL, NULL, 'f', 'f', 't', 'Le Ski'";


			if($pstock == 1){ // On évite ainsi les erreurs de saisie pour un objet unique
				$pnouveau = 't';
			}


		if($ppromotion == 't'){ // On évite ainsi les erreurs de saisie sur la promotion
			$pValues = "'$pboutique','$pnom', '$pdescription', $pprix, $pstock, $pprixpromo, '$pdatedebut', '$pdatefin', '$ppromotion', '$pobjunique', '$pnouveau', '$pdeuxsc'";
				}
		else{
			$pValues = "'$pboutique','$pnom', '$pdescription', $pprix, $pstock, NULL, NULL, NULL, '$ppromotion', '$pobjunique', '$pnouveau', '$pdeuxsc'";
				}

			if(fInsert($table,$pValues,$columns)){
				echo "<script language=\"javascript\"> window.location='vendeur.php';</script>";
			}
		}
}
?>

<!-- //footer -->
<div class="footer">
		<div class="footer-copy">
			<div class="container">
				<p>Créé par groupe1 Na18</p>
				<p>Template collected from cssmoban.com</p>
			</div>
		</div>
</div>
<!-- //footer -->
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- top-header and slider -->
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear'
				};
			*/

			$().UItoTop({ easingType: 'easeOutQuart' });

			});
	</script>
<!-- //here ends scrolling icon -->
<script src="js/minicart.min.js"></script>
<script>
	// Mini Cart
	paypal.minicart.render({
		action: '#'
	});

	if (~window.location.search.indexOf('reset=true')) {
		paypal.minicart.reset();
	}
</script>
<!-- main slider-banner -->
<script src="js/skdslider.min.js"></script>
<link href="css/skdslider.css" rel="stylesheet">
<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('#demo1').skdslider({'delay':5000, 'animationSpeed': 2000,'showNextPrev':true,'showPlayButton':true,'autoSlide':true,'animationType':'fading'});

			jQuery('#responsive').change(function(){
			  $('#responsive_wrapper').width(jQuery(this).val());
			});

		});
</script>
<!-- //main slider-banner -->
</body>
</html>
