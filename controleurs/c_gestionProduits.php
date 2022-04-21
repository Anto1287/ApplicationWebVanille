<?php
$action = $_REQUEST['action'];
switch($action)
{
    case 'connexionAdmin':
	    {
			$nom=$_POST['nom'];
			$mdp=$_POST['mdp'];
			$var=$pdo->Connexion($nom, $mdp);
	    }
}
?>