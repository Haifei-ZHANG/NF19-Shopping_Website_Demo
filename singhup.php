<?php
session_start();
include 'utils.php';


$userLName = $_POST['nom'];
$userFName = $_POST['prenom'];
$userEmail = $_POST['email'];
$motDePass = $_POST['mdp'];
$userTel = $_POST['tel'];
$userBirthday = $_POST['ddn'];
$userType = $_POST["userType"];

$pValues = "'$userLName','$userFName','$userEmail','$motDePass','$userTel','$userBirthday'";
if(fInsert($userType,$pValues,$columns='')){
	$_SESSION['userLName'] = $userLName;
	$_SESSION['userFName'] = $userFName;
	$_SESSION['userEmail'] = $userEmail;
	$_SESSION['motDePass'] = $motDePass;
	$_SESSION['userTel'] = $userTel;
	$_SESSION['userBirthday'] = $userBirthday;
	$_SESSION['userType'] = $userType;
	echo "<script language=\"javascript\"> window.location='index.php';</script>";
}
?>

</body>
</html>