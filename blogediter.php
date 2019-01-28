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
	die();
}
else{
	echo "
	<div class=\"agileits_header\">
		<div class=\"container\">
			<div class=\"w80_offers\">
			<div class=\"agile-login\">
				<ul>
					<li><a href=\"profilmodif.php\">Profil</a></li>
					<li><a href=\"administrateur.php\">Blogs</a></li>
					<li><a href=\"creercategorie.php\">Créer une catégorie</a></li>
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
$id = $_GET["id"];

$vSql = "select nom from deuxsouscatégorie;";
$deuxsouscategories = fSelect($vSql);

$vSql = "select * from articleblog where id=$id";
	$article = fSelect($vSql);
	if(count($article)!=0){
		$titre = $article[0]["titre"];
		$auteur = $article[0]["auteur"];
		$contenu = $article[0]["contenu"];
		$datepublication = $article[0]["datepublication"];
//modification des valeurs
		echo "<div class=\"register\">
				<div class=\"container\">
					<h2>Editez votre article</h2>
				<div class=\"login-form-grids\">";
		echo "
		<form method='post' action='#'>
		<label>Titre : </label>
		<input name='titre' type='text' value='$titre' size='50'>
		<input name='auteur' type='hidden' value='$auteur' size='50'><br><br>
		<label>Contenu : </label><br>
		<textarea name='contenu' rows='8' cols='50'>$contenu</textarea><br><br>
		<label>Date de publication</label>
		<input name='datepublication' type='text' value=$datepublication><br><br>
		<input type='submit' name='articleblogediter'/>
		</form></div></div></div>";
	}
	//Récupérer les valeurs après modification et mettre à jour la table.
	if(isset($_POST["articleblogediter"])&&$_POST["articleblogediter"]){
		$titre =  $_POST["titre"];
		$auteur = $_POST["auteur"];
		$contenu = $_POST["contenu"];
		$datepublication = $_POST["datepublication"];
		$table = 'articleblog';
		$afterSet = "titre='$titre', auteur='$auteur', contenu='$contenu', datepublication='$datepublication' ";
		$afterWhere = "id=$id";
		if(fUpdate($table,$afterSet,$afterWhere)){
			echo "<script language=\"javascript\"> window.location='administrateur.php';</script>";
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
