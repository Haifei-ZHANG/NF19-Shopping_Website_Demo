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
			<div class=\"w80_offers\">
			<div class=\"agile-login\">
				<ul>
					<li><a href=\"profilmodif.php\">Profil</a></li>
					<li><a href=\"administrateur.php\">Blogs</a></li>
					<li><a href=\"creercatégorie.php\">Créer une catégorie</a></li>
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
	<div class="top-brands">
		<div class="container">
<?php
//Etablissement de session
if(!isset($_SESSION['userType'])){
	die();
}
$userLName = $_SESSION['userLName'];
$userFName = $_SESSION['userFName'];
$motDePass = $_SESSION['motDePass'];
$userTel = $_SESSION['userTel'];
$userBirthday = $_SESSION['userBirthday'];
$userType = $_SESSION['userType'];
$userEmail = $_SESSION['userEmail'];

$vSql = "select * from $userType where email='$userEmail'";
	$userInfo = fSelect($vSql);
	if(count($userInfo)!=0){
	$userLName = $userInfo[0]['nom'];
	$userFName = $userInfo[0]['prénom'];
	$userEmail = $userInfo[0]['email'];
	$motDePass = $userInfo[0]['mdp'];
	$userTel = $userInfo[0]['numerotel'];
	$userBirthday = $userInfo[0]['datedenaissance'];
	echo "
	<div class=\"register\">
		<div class=\"container\">
			<h2>Modifiez vos informations</h2>
			<div class=\"login-form-grids\">
	";

	echo "
		<br>
		<form method='post' action='#'>
		<label for='nom'>Nom : </label><input type='text' id='nom' name='nom'  value=$userLName> <br>
		<label for='prenom'>Prenom : </label><input type='text' id='prenom' name='prenom' value=$userFName> <br>
		<label for='mdp' >Mot de passe : </label><input type='password' id='mdp' name='mdp' value=$motDePass> <br>
		<label for='tel' >Tel : </label><input type='text' id='tel' name='tel'  value=$userTel> <br>
		<label for='ddn'>Date de naissance : </label><input type='text' id='ddn' name='ddn'  value=$userBirthday><br>
		<input type='hidden' name='oldemail' value=$userEmail>
		<input type='hidden' name='oldmdp' value=$motDePass>
		<input type='submit' name='profilmodif' value='Modifier votre profil'/>
	</form>	</div>
		</div>
	</div>"	;
	}

if(isset($_POST["profilmodif"])&&$_POST["profilmodif"]){
	$userLName = $_POST['nom'];
	$userFName = $_POST['prenom'];
	$motDePass = $_POST['mdp'];
	$userTel = $_POST['tel'];
	$userBirthday = $_POST['ddn'];
	$userOldEmail = $_POST['oldemail'];
	$userOldMdp = $_POST['oldmdp'];
	$userType = $_SESSION['userType'];

	$table = $userType;
	$afterSet = "nom='$userLName',prénom='$userFName',email='$userEmail',mdp='$motDePass',numerotel='$userTel',datedenaissance='$userBirthday'";
	$afterWhere = "email='$userOldEmail'";
	if(fUpdate($table,$afterSet,$afterWhere)){
		if($userOldEmail!=$userEmail || $userOldMdp!=$motDePass){
			$_SESSION = array();
			session_destroy();
			echo "<script language=\"javascript\"> window.location='login.html';</script>";
		}
		else{
			$_SESSION['userLName'] = $userLName;
			$_SESSION['userFName'] = $userFName;
			$_SESSION['userTel'] = $userTel;
			$_SESSION['userBirthday'] = $userBirthday;
			echo "<script language=\"javascript\"> window.location='administrateur.php';</script>";
		}

	}
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
