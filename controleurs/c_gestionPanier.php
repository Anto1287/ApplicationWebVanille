<?php
// Gestion du Panier du site  Vanille

$action = $_REQUEST['action'];
switch ($action) {
	case 'voirPanier': {
			$n = nbProduitsDuPanier();
			if ($n > 0) {
				$desIdProduit = getLesIdProduitsDuPanier();
				$lesProduitsDuPanier = $pdo->getLesProduitsDuTableau($desIdProduit);
				$message = "Voici votre Panier";
				include("vues/v_message.php");
				include("vues/v_panier.php");
			} else {
				$message = "panier vide !!";
				include("vues/v_message.php");
			}
			break;
		}
	case 'deletePanier': {
			supprimerPanier();
			$message = "panier supprimé !!";
			include("vues/v_message.php");

			break;
		}
	case 'deleteItem': {
			$itemNum = $_REQUEST['num'];
			deleteOneItem($itemNum);

			$qte = $_SESSION['quantite'];
			unset($qte[$itemNum]);
			$_SESSION['quantite'] = $qte;
			
			$desIdProduit = getLesIdProduitsDuPanier();
			$lesProduitsDuPanier = $pdo->getLesProduitsDuTableau($desIdProduit);
			$message = "L'article à bien été supprimé";
			include("vues/v_message.php");
			include("vues/v_panier.php");
			break;
		}
	case 'ajouterqte': {
			$posqte = $_REQUEST['pos'];
			$quantiteTotal = $_SESSION['quantite'];
			if (intval($quantiteTotal[$posqte]) >= 1) {
				$quantiteTotal[$posqte] = intval($quantiteTotal[$posqte]) + 1;
			}
			$_SESSION['quantite'] = $quantiteTotal;
			$desIdProduit = getLesIdProduitsDuPanier();
			$lesProduitsDuPanier = $pdo->getLesProduitsDuTableau($desIdProduit);
			// session_destroy();
			include("vues/v_panier.php");
			break;
		}
	case 'retirerqte': {
			$posqte = $_REQUEST['pos'];

			$quantiteTotal = $_SESSION['quantite'];
			if (intval($quantiteTotal[$posqte]) > 1) {
				$quantiteTotal[$posqte] = intval($quantiteTotal[$posqte]) - 1;
			} else {
			}
			$_SESSION['quantite'] = $quantiteTotal;
			$desIdProduit = getLesIdProduitsDuPanier();
			$lesProduitsDuPanier = $pdo->getLesProduitsDuTableau($desIdProduit);
			include("vues/v_panier.php");
			break;
		}
}
