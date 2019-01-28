<?php
//Se connecter à la BD
function dbConnect(){
	$vHost = 'tuxa.sme.utc';
	$vPort = '5432';
	$vData = 'dbna18a001';
	$vUser = 'na18a001';
	$vPass = 'mdaA1UvI';
	$vConn = new PDO("pgsql:host=$vHost;port=$vPort;dbname=$vData",$vUser,$vPass);
	return $vConn;
}

// Executer une commande SQL
function fSelect($vSql){
	$vConnect = dbConnect();
	$vResult = $vConnect->prepare($vSql);
	$vResult->execute();
	$vResultSet = array();
	$i = 0;
	while ($vRow = $vResult->fetch(PDO::FETCH_ASSOC)) {
		$vResultSet[$i] = $vRow;
		$i++;
	}
	$vConnect = null;
	return $vResultSet;
}

// Afficher une table
function fAfficher($selection){
	foreach($selection as $enregistrement){
		$keys = array_keys($enregistrement);
                foreach($keys as $key){
                         echo $enregistrement[$key];
                         echo ' ';
                }
                echo '<br>';
	}
}

//Inserer dans la table $table les valeurs $pValues dans les colonnes $columns
function fInsert($table,$pValues,$columns=''){
	$vConnect = dbConnect();
	$vSql = "INSERT INTO $table $columns VALUES ($pValues)";
	$vResult = $vConnect->prepare($vSql);
	if($vResult -> execute()){
			$vConnect = null;
		//echo "<p> Insertion réussie</p>";
		return 1;
	}
	else{
		$vConnect = null;
		//echo "<p> Insertion ratée.</p>";
		return 0;
	}
}

//Mettre à jour $table
function fUpdate($table,$afterSet,$afterWhere){
        $vConnect = dbConnect();
	$vSql = "UPDATE $table SET $afterSet WHERE $afterWhere";
        $vResult = $vConnect->prepare($vSql);
        if($vResult -> execute()){
                $vConnect = null;
                return 1;

        }
        else{
                $vConnect = null;
                return 0;
        }
}
//supprimer une table où la condition $afterWhere est vraie
function fDelete($table,$afterWhere){
        $vConnect = dbConnect();
		$vSql = "DELETE FROM $table WHERE $afterWhere";
        $vResult = $vConnect->prepare($vSql);
        if($vResult -> execute()){
                $vConnect = null;
                return 1;
        }
        else{
                $vConnect = null;
                return 0;
        }
}
?>
