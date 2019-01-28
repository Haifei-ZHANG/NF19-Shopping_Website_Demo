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
									<li class="active"><a href="" class="act">Promotions</a></li>	
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
<!-- produit -->
	<div class="products">
		<div class="container">
			<div class="agileinfo_single">
				
<?php
$pref = $_GET["pref"];
$vSql = "select référence,nom,description,prix,prixpromo,stock from produit where référence=$pref";
$produitInfos = fSelect($vSql);
$vSql="select c.produit,c.contenu,c.datepublication,c.note,a.nom,a.prénom from commentaire c, acheteur a where c.acheteur=a.email and c.produit=$pref";
$commentaires = fSelect($vSql);
$noteMoyenne = 0;
if(count($commentaires)!=0){
	for($i=0;$i<count($commentaires);$i++){
	$noteMoyenne += $commentaires[$i]["note"];
}

	$noteMoyenne = $noteMoyenne/count($commentaires);	
}

echo "<div class=\"col-md-4 agileinfo_single_left\">";
if($produitInfos[0]['prixpromo']!=''){
	echo "<div class=\"agile_top_brand_left_grid_pos\">
			<img src=\"images/promo.png\" alt= \" \" class=\"img-responsive\" />
		  </div>
		  <img id=\"example\" src=\"images/".$produitInfos[0]['référence'].".png\" alt=\" \" class=\"img-responsive\">
				</div>";
}
else{
	echo "<img id=\"example\" src=\"images/".$produitInfos[0]['référence'].".png\" alt=\" \" class=\"img-responsive\">
		</div>";
}
echo "
				<div class=\"col-md-8 agileinfo_single_right\">
				<h2>".$produitInfos[0]['nom']."</h2>";
echo "			<div class=\"stars\">";
	
for($i=1;$i<=$noteMoyenne;$i++){
	echo "		<i class=\"fa fa-star blue-star\" aria-hidden=\"true\"></i>";
}
while($i<=5){
	echo "		<i class=\"fa fa-star gray-star\" aria-hidden=\"true\"></i>";
	$i++;
}
															

echo "			</div>
					<div class=\"w3agile_description\">
						<h4>Description :</h4>
						<p>".$produitInfos[0]['description']."</p>
					</div>";

echo "
					<div class=\"snipcart-item block\">
						<div class=\"snipcart-thumb agileinfo_single_right_snipcart\">";
if($produitInfos[0]['prixpromo']!=''){
		echo "			<h4 class=\"m-sing\">".$produitInfos[0]['prixpromo']."€<span>".$produitInfos[0]['prix']."€</span></h4>
						</div>";
	}
	else{
		echo "			<h4 class=\"m-sing\">".$produitInfos[0]['prix']."€</h4>
						</div>";
	}																		
echo "					<div class=\"snipcart-details agileinfo_single_right_details\">
								<form action=\"ajouteralisteenvie.php\" method=\"post\">
									<input type='hidden' name='produitref' value=".$produitInfos[0]['référence'].">
									<input type=\"submit\" name=\"envie\" value=\"Ajouter dans liste d'envie\" class=\"button\" />
								</form>
								<br>";
								if($produitInfos[0]["stock"]>0){
									echo "
								<form action=\"ajouteraupanier.php\" method=\"post\">
								<fieldset>
								Quantité : <select name='quantite'>";

									for ($j=1 ; $j <= $produitInfos[0]["stock"] ; $j++){
        								echo "<option value='$j'> $j </option>";
      								}

      								echo "</select>
									<input type='hidden' name='produitref' value=".$produitInfos[0]['référence'].">
									<input type=\"submit\" name=\"panier\" value=\"Ajouter au panier\" class=\"button\" />
										</fieldset>
									</form>";
									}
									else{
										echo "<br><h3><font color='red'>Épuisé</font></h3>";
									}

?>
					</div>
				</div>
				<div class="clearfix"> </div>
				</div>


<?php
echo "			<br>
				<div class=\"col-md-12 agileinfo_single_left\">
				<h2>Les commentaires</h2>";
$vSql = "select * from commentaire where produit=$pref;";
$commentaires = fSelect($vSql);
if(count($commentaires)>0){
	foreach ($commentaires as $commentaire) {
		$keys = array_keys($commentaire);
		$supposerEmail = $commentaire['acheteur'];
		$vSql = "select nom, prénom from acheteur where email='$supposerEmail';";
		$supposer = fSelect($vSql);
		$supposerName = $supposer[0]['nom']."&nbsp;&nbsp".$supposer[0]['prénom']."&nbsp;&nbsp";
		echo "<p>$supposerName".$commentaire['datepublication']."</p>";
		echo "			<div class=\"stars agileinfo_single_right_details\">";
		
	for($i=1;$i<=$commentaire['note'];$i++){
		echo "		<i class=\"fa fa-star blue-star\" aria-hidden=\"true\"></i>";
	}
	while($i<=5){
		echo "		<i class=\"fa fa-star gray-star\" aria-hidden=\"true\"></i>";
		$i++;
	}
																

	echo "			</div>
							<p>Commentaire : ".$commentaire['contenu']."</p><br>";

	}

}	


echo "<form action='commentaireajouter.php' method='post'>
		<lable>Ajoutez votre commentaire :</lable>
		<input type='text' name='commentaire'/><br><br>
		<lable>Note: <select name='note'>
		<option value='1'>1<option>
		<option value='2'>2<option>
		<option value='3'>3<option>
		<option value='4'>4<option>
		<option value='5'>5<option>
		</select>
		<input type='hidden' name='pref' value=$pref />
		<input type='hidden' name='acheteur' value=".$_SESSION['userEmail']." />
		<br><br><input type='submit' name='commenter' value='Conmmenter'/>
		</form>
		"
?>				<br>
			</div>
		</div>
	</div>

<!-- //produit -->


<!-- //footer -->
<div class="footer">
		<div class="footer-copy">
			<div class="container">
				<p>Créé par groupe1 Na18</p>
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
</body>
</html>