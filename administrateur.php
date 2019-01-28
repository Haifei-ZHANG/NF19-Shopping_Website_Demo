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
<!--blogs -->
<div class="checkout">
	<div class="container">
		<h2>Les articles de blogs vous avez créé : </span></h2>
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
$vSql = "select * from articleBlog where auteur='$userEmail';";
$blogs = fSelect($vSql);

// s'il n'a pas encore creé de blogs
if(count($blogs) == 0){
		echo "Vous n'avez pas créé de blog !";
}
else{
	echo "
			<div class=\"checkout-right\">
				<table class=\"timetable_sub\">
					<thead>
						<tr>
							<th>Numéro</th>
							<th>Titre</th>
							<th>Auteur</th>
							<th>Contenu</th>
							<th>Date de publication</th>
							<th>Editer</th>
							<th>Supprimer</th>
						</tr>
					</thead>";
	foreach($blogs as $blog){
		$keys = array_keys($blog);
		echo "<tr>";
                foreach($keys as $key){
                         echo "<td class=\"invert\">".$blog[$key]."</td>";
                }
        $blogid = $blog['id'];
// on ajoute bouton qui permet de supprimer le blog
		echo "<td><a href='blogediter.php?id=$blogid' class=\"fa fa-pencil\"></td>";
// on ajoute bouton qui permet de modifier le blog
		echo "<td class=\"invert\">
				<a href='blogsupprimer.php?id=$blogid' class=\"fa fa-times\"></td>
				</tr>";
	}
echo "				</table>
			</div>";
			// on ajoute bouton qui permet de creer un nouveau blog
}
?>
			<div class="checkout-left">
				<div class="checkout-left-basket">
					<button onclick="window.location.href='blogajouter.php'">Créer un nouvel article</button></div>
				</div>
				<div class="clearfix"> </div>
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
