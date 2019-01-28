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
$pref = $_GET["pref"];

$vSql = "select nom from deuxsouscatégorie;";
$deuxsouscategories = fSelect($vSql);
// on selectionne le produit concerné
$vSql = "select * from produit where référence=$pref";
	$produit = fSelect($vSql);
	if(count($produit)!=0){
		$pnom = $produit[0]["nom"];
		$pdescription = $produit[0]["description"];
		$pprix = $produit[0]["prix"];
		$pstock = $produit[0]["stock"];
		$pprixpromo = $produit[0]["prixpromo"];
		$pdatedebut = $produit[0]["datedébut"];
		$pdatefin = $produit[0]["datefin"];
		$ppromotion = $produit[0]["promotion"];
		$pobjunique = $produit[0]["objetunique"];
		$pnouveau = $produit[0]["nouveau"];
		$pdeuxsc = $produit[0]["deuxsouscatégorie"];
// Edition du produit
		echo "
		<div class=\"register\">
		<div class=\"container\">
			<h2>Editez votre produit</h2>
			<div class=\"login-form-grids\">
			";
		echo "
		<form method='post' action='#'>
		<label>nom : </label>
		<input name='pnom' type='text' value='$pnom'><br>
		<label>description : </label>
		<input name='pdescription' type='text' value='$pdescription' size='50'><br>
		<label>prix : </label>
		<input name='pprix' type='text' value=$pprix><br>
		<label>stock : </label>
		<input name='pstock' type='text' value=$pstock><br>
		<label>prix promot : </label>
		<input name='pprixpromo' type='text' value=$pprixpromo><br>
		<label>date début : </label>
		<input name='pdatedebut' type='text' value=$pdatedebut><br>
		<label>date fin : </label>
		<input name='pdatefin' type='text' value=$pdatefin><br>";
		if($pprixpromo){
			echo "
			<label>promotion : </label>
			<input name='ppromotion' type='radio' value='t' checked>Oui
			<input name='ppromotion' type='radio' value='f'>Non<br>";
		}
		else{
			echo "
			 <label>promotion : </label>
			<input name='ppromotion' type='radio' value='t'>Oui
			<input name='ppromotion' type='radio' value='f' checked>Non<br>";
		}
		if($pobjunique){
			echo "
			<br><label>objet unique : </label>
			<input name='pobjunique' type='radio' value='t'checked>Oui
			<input name='pobjunique' type='radio' value='f'>Non<br>";
		}
		else{
			echo "
			<br><label>objet unique : </label>
			<input name='pobjunique' type='radio' value='t'>Oui
			<input name='pobjunique' type='radio' value='f'  checked>Non<br>
			";

		}
		if($pnouveau){
			echo "
			<br><label>nouveau : </label>
			<input name='pnouveau' type='radio' value='t'  checked>Oui
			<input name='pnouveau' type='radio' value='f'>Non<br>
			";

		}
		else{
			echo "
			<br><label>nouveau : </label>
			<input name='pnouveau' type='radio' value='t'>Oui
			<input name='pnouveau' type='radio' value='f'  checked>Non<br>
			";
		}
		echo "
		<br><label>catégorie : </label>
		<select name='pdeuxsc'>
		";
		foreach($deuxsouscategories as $categorie){
		echo "<option value ='".$categorie['nom']."'>".$categorie['nom']."</option>";
		}
		echo "<input name='pref' type='hidden' value=$pref></input><br><br><input type='submit' name='pediter'/>

		</form></div></div></div>";
	}

	//Récupérer les valeurs après modification et mettre à jour la table.

	if(isset($_POST["pediter"])&&$_POST["pediter"]){
		$pref = $_POST['pref'];
		$pnom = $_POST['pnom'];
		$pdescription = $_POST['pdescription'];
		$pprix = $_POST['pprix'];
		if ($_POST['pstock'] >= 0){ // On empêche la saisie d'un stock négatif.
			$pstock = $_POST['pstock'];
		}
		$ppromotion = $_POST['ppromotion'];
		$pprixpromo = $_POST['pprixpromo'];
		$pdatedebut = $_POST['pdatedebut'];
		$pdatefin = $_POST['pdatefin'];
		$pobjunique = $_POST['pobjunique'];
		$pnouveau = $_POST['pnouveau'];
		$pdeuxsc = $_POST['pdeuxsc'];
		$table = 'produit';
		if ($ppromotion == 'f'){ //On évite les erreurs de saisie concernant la promotion.
			$afterSet = "nom='$pnom', description='$pdescription', prix=$pprix, stock=$pstock, prixpromo=NULL, datedébut=NULL, datefin=NULL, promotion='$ppromotion', objetunique='$pobjunique', nouveau='$pnouveau', deuxsouscatégorie='$pdeuxsc'";
		}else {
			$afterSet = "nom='$pnom', description='$pdescription', prix=$pprix, stock=$pstock, prixpromo=$pprixpromo, datedébut='$pdatedebut', datefin='$pdatefin', promotion='$ppromotion', objetunique='$pobjunique', nouveau='$pnouveau', deuxsouscatégorie='$pdeuxsc'";
		}

		$afterWhere = "référence=$pref";
		if(fUpdate($table,$afterSet,$afterWhere)){
		echo "<script language=\"javascript\"> window.location='vendeur.php';</script>";
		}
		else{
		echo "Erreur. Veuillez réinsérer les données.";
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
