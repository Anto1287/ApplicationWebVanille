<meta charset="utf-8" />
<?php
//Controleur Principal du site Vanille 2018
session_start();
// RUDY: Plusieurs fonctions qui gèrent le panier
require_once("util/fonctions.inc.php");
// RUDY: Class d'accès aux données
require_once("util/class.pdoVanille.inc.php");
// RUDY: BANNIERE
include("vues/v_entete.php");
// RUDY: MENU
include("vues/v_bandeau.php");

if (!isset($_REQUEST['uc']))
	$uc = 'accueil';
else
	$uc = $_REQUEST['uc'];


/* Cr�ation d'une instance d'acc�s � la base de donn�es */
$pdo = PdoVanille::getPdoVanille();
switch ($uc) {
	case 'accueil': {
			include("vues/v_accueil.php");
			break;
		}
	case 'voirProduits': {
			include("controleurs/c_voirProduits.php");
			break;
		}
	case 'gererPanier': {
			include("controleurs/c_gestionPanier.php");
			break;
		}
	case 'passerCommande': {
			include("controleurs/c_passerCommande.php");
			break;
		}
	case 'gererProduits': {
			include("controleurs/c_gestionProduits.php");
			break;
		}
}
include("vues/v_pied.php");
?>