<?php
$_SESSION = array(); //Effacer la valeur SESSION.
if(isset($_COOKIE[session_name()])){  //Déterminer si le fichier de cookie du client existe. S'il existe, configurez-le pour qu'il expire.
	setcookie(session_name(),'',time()-1,'/');
}
session_destroy();  //Effacer le fichier de session du serveur

header("Location:index.php");

?>
