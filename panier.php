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
	echo "
	<div class=\"agileits_header\">
		<div class=\"container\">
			<div class=\"w31_offers\">
			<div class=\"agile-login\">
				<ul>
					<li><a href=\"singhup.html\"> Créer un compte   </a></li>
					<li><a href=\"login.html\">Login</a></li>

				</ul>
			</div>
			</div>
			<div class=\"clearfix\"> </div>
		</div>
	</div>
	";
}
else{
	echo "
	<div class=\"agileits_header\">
		<div class=\"container\">
			<div class=\"w60_offers\">
			<div class=\"agile-login\">
				<ul>
					<li><a href=\"profilmodif.php\">Profil</a></li>
					<li><a href=\"listeenvie.php\">Ma Liste D'Envie</a></li>
					<li><a href=\"panier.php\">Mon Panier</a></li>
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

	<div class="logo_products">
		<div class="container">

			<div class="w3ls_logo_products_left">
				<h1><a href="index.php">Marketplace</a></h1>
			</div>
		<div class="w3l_search">
			<form action="index.php" method="post">
				<input type="search" name="requete" placeholder="Chercher un produit..." required="">
				<button type="submit" name="chercher" class="btn btn-default search" aria-label="Left Align">
					<i class="fa fa-search" aria-hidden="true"> </i>
				</button>
				<div class="clearfix"></div>
			</form>
		</div>

			<div class="clearfix"> </div>
		</div>
	</div>
<!-- //header -->
<!-- navigation -->
	<div class="navigation-agileits">
		<div class="container">
			<nav class="navbar navbar-default">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header nav_2">
								<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div>
							<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
								<ul class="nav navbar-nav">
									<li class="active"><a href="index.php" class="act">Promotions</a></li>
									<!-- Mega Menu -->
<?php
$vSql="select distinct sc.catégorie, dsc.nom as tag from sousCatégorie sc, deuxsousCatégorie dsc where sc.nom=dsc.souscatégorie order by sc.catégorie;";
$categories=fSelect($vSql);
$categoriePre = "Promotions";
$i=0;
while($i<count($categories)){
	if($categories[$i]["catégorie"]!=$categoriePre){
		if($i!=0){echo "						</ul>
												</div>
											</div>
										</ul>
									</li>";}
		$categoriePre=$categories[$i]["catégorie"];
		echo "
									<li class=\"dropdown\">
										<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">".$categories[$i]["catégorie"]."<b class=\"caret\"></b></a>
										<ul class=\"dropdown-menu multi-column columns-3\">
											<div class=\"row\">
												<div class=\"multi-gd-img\">
													<ul class=\"multi-column-dropdown\">
													<li><a href=\"categories.php?categorie=".$categories[$i]["tag"]."\">".$categories[$i]["tag"]."</a></li>
		";
	}
	else{
			echo "<li><a href=\"categories.php?categorie=".$categories[$i]["tag"]."\">".$categories[$i]["tag"]."</a></li>";
	}
	$i++;
}
?>
													</ul>
												</div>
											</div>
										</ul>
									</li>
								</ul>
							</div>
					</nav>
			</div>
		</div>
<!-- //navigation -->
<div class="checkout">
	<div class="container">
		<h2>Votre panier</h2>
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


$vSql="SELECT p.référence,p.nom, pr.quantité,(p.prix*pr.quantité) AS prixtotal FROM produitDansPanier pr
INNER JOIN panier pa ON pa.id = pr.panier
INNER JOIN produit p ON p.référence = pr.produit
WHERE pa.soldé='f' AND pa.acheteur = '$userEmail'";

$coutpanier = 0;
$produits=fSelect($vSql);

if(count($produits) == 0){
		echo "Vous n'avez pas ajouté de produit dans votre panier!";
}
else{
	echo "
			<div class=\"checkout-right\">
				<table class=\"timetable_sub\">
					<thead style=\"background: #FF8C00\">
						<tr>
						<td>Produit</td>
						<td>Quantité</td>
						<td>Prix total (€)</td>
						<td>supprimer</td>
						</tr>
					</thead>";
	foreach($produits as $produit){
		$keys = array_keys($produit);
		echo "<tr>";
                foreach($keys as $key){
                	if($key=="référence"){
                		continue;
                	}
                	else{
                		echo "<td class=\"invert\">".$produit[$key]."</td>";
                	}
                }
        $produitref = $produit['référence'];
        $coutpanier = $coutpanier + $produit["prixtotal"];
// on ajoute bouton qui permet de supprimer le produit
		echo "<td><a href='produitdanspaniersupprimer.php?pref=$produitref' class=\"fa fa-times\"></td>
				</tr>";
	}
echo "		<tr><td></td><td></td><td><h5>Coût total du panier : $coutpanier €</h5></td><td><button onclick=\"window.location.href='solder.php'\"></span>Solder</button></td></tr>
			</table>
			</div>";
}
?>

		</div>
	</div>

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
