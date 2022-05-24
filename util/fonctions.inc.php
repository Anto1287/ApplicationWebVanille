<?php

/**
 * Initialise le panier de commande Vanille
 * Crée une variable de type session dans le cas
 * où elle n'existe pas 
 */
function initPanier()
{
	if (!isset($_SESSION['produits']) && !isset($_SESSION['produits'])) {
		$_SESSION['produits'] = array();
		$_SESSION['quantite'] = array();
	} else if (!isset($_SESSION['produits'])) {
		$_SESSION['produits'] = array();
	} else if (!isset($_SESSION['quantite'])) {
		$_SESSION['quantite'] = array();
	}
}

/**
 * Ajoute un produit au panier
 *
 * Teste si l'identifiant du produit est déjà dans la variable session 
 * ajoute l'identifiant à la variable de type session dans le cas où
 * où l'identifiant du produit n'a pas été trouvé
 * @param $idProduit : identifiant de produit
 * @return vrai si le produit n'était pas dans la variable, faux sinon 
 */
function ajouterAuPanier($idProduit)
{

	$ok = true;
	if (in_array($idProduit, $_SESSION['produits'])) {
		$ok = false;
	} else {
		$_SESSION['produits'][] = $idProduit;
		$_SESSION['quantite'][] = 1;
	}
	return $ok;
}


/**
 * Retourne les produits du panier Vanille
 *
 * Retourne le tableau des identifiants de produit
 * @return : le tableau
 */
function getLesIdProduitsDuPanier()
{
	return $_SESSION['produits'];
}
/**
 * Retourne le nombre de produits du panier
 *
 * Teste si la variable de session existe
 * et retourne le nombre d'éléments de la variable session
 * @return : le nombre 
 */
function nbProduitsDuPanier()
{
	$n = 0;
	if (isset($_SESSION['produits'])) {
		$n = count($_SESSION['produits']);
	}
	return $n;
}


function supprimerPanier()
{
	session_destroy();
	// session_unset();
}



function deleteOneItem($itemNum)
{
	$array = $_SESSION['produits'];

	// $key = array_search($itemNum, $array);

	// echo "key: ";
	// echo $key;
	// echo "<br>";
	// echo ($qte[$key]);
	// echo "<br>";

	unset($array[$itemNum]);
	$_SESSION['produits'] = $array;
}


function estEntier($valeur)
{
	return preg_match("/[^0-9]/", $valeur) == 0;
}

/**
 * teste si une chaîne a un format de code postal
 * Teste le nombre de caractères de la chaîne et le type entier (composé de chiffres)
 * @param $codePostal : la chaîne testée
 * @return : vrai ou faux
 */

function estUnCp($codePostal)
{
	return strlen($codePostal) == 5 && estEntier($codePostal);
}
/** Retourne un tableau d'erreurs de saisie pour une commande
 *
 * Ici uniquement pour le code postal mais pourrait etre utile
 * si autres contrôles plus specifiques
 * @param $cp : chaîne
 * @return : un tableau de chaînes d'erreurs
 */
function getErreursSaisieCommande($cp)
{
	$lesErreurs = array();
	if (!estUnCp($cp)) {
		$lesErreurs[] = "erreur de code postal";
	}
	return $lesErreurs;
}



function testMAIL($email)
{
	$good = false;
	if (strpos($email, "@") !== false)
		$good = true;

	return $good;
}
