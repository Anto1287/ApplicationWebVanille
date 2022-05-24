<?php

/** 
 * Classe d'accès aux données. 
 * Utilise les services de la classe PDO
 * pour l'application Vanille
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoVanille qui contiendra l'unique instance de la classe
 *
 * @package default
 * @author slam5
 * @version    1.0

 */

class PdoVanille
{
	private static $monPdo;
	private static $monPdoVanille = null;
	/**
	 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
	 * pour toutes les méthodes de la classe
	 **/
	private function __construct()
	{
		PdoVanille::$monPdo = new PDO('mysql:host=localhost;dbname=vanille', 'root', '');
		PdoVanille::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct()
	{
		PdoVanille::$monPdo = null;
	}
	/**
	 * Fonction statique qui crée l'unique instance de la classe
	 *
	 * Appel : $instancePdoVanille = PdoVanille::getPdoVanille();
	 * @return l'unique objet de la classe PdoVanille
	 */
	public  static function getPdoVanille()
	{
		if (PdoVanille::$monPdoVanille == null) {
			PdoVanille::$monPdoVanille = new PdoVanille();
		}
		return PdoVanille::$monPdoVanille;
	}
	/**
	 * Retourne toutes les catégories sous forme d'un tableau associatif
	 *
	 * @return le tableau associatif des catégories 
	 */
	public function getLesCategories()
	{
		$req = "select * from categorie";
		$res = PdoVanille::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}

	/**
	 * Retourne sous forme d'un tableau associatif tous les produits de la
	 * catégorie passée en argument
	 * 
	 * @param $idCategorie 
	 * @return un tableau associatif  
	 */

	public function getLesProduitsDeCategorie($idCategorie)
	{
		$req = "select * from produit where idCategorie = '$idCategorie'";
		$res = PdoVanille::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
	/**
	 * Retourne les produits concernés par le tableau des idProduits passés en argument
	 *
	 * @param $desIdProduit tableau d'idProduits
	 * @return un tableau associatif 
	 */
	public function getLesProduitsDuTableau($desIdProduit)
	{
		$nbProduits = count($desIdProduit);
		$lesProduits = array();
		if ($nbProduits != 0) {
			foreach ($desIdProduit as $unIdProduit) {
				$req = "select * from produit where PDT_id = '$unIdProduit'";
				$res = PdoVanille::$monPdo->query($req);
				$unProduit = $res->fetch();
				$lesProduits[] = $unProduit;
			}
		}
		return $lesProduits;
	}


	public function getProduitInformByID($id)
	{
		$req = "select * from produit where PDT_id = '$id'";
		$res = PdoVanille::$monPdo->query($req);
		$unProduit = $res->fetch();

		return $unProduit;
	}


	public function modifierProduit($description, $prix, $idCat, $id)
	{
		$req = "UPDATE produit SET description = $description, prix= $prix, idCategorie= $idCat WHERE PDT_id = '$id'";
		$res = PdoVanille::$monPdo->exec($req);

	}



	function creationCommande($nomPrenomClient, $mailClient, $adresseRueClient, $cpClient, $villeClient)
	{

		//PREPARATION 

		$req = PdoVanille::$monPdo->query("SELECT COUNT(*) as NbNews FROM commande");
		$donnees = $req->fetch();
		$req->closeCursor();
		$num = intval($donnees['NbNews']) + 1;


		// PREMIÈRE ETAPE: 'CREATION DE LA COMMANDE'
		$date = date("Y-m-j");
		$sql = "INSERT INTO commande VALUES ($num, '$date', '$nomPrenomClient', '$adresseRueClient', '$cpClient', '$villeClient', '$mailClient');";
		$etat =  PdoVanille::$monPdo->exec($sql);

		// SECONDE ÉTAPE: 'AJOUT DE TOUS LES PRODUITS DE LA COMMANDE'
		$idProduits = getLesIdProduitsDuPanier();

		$sessionquantite = $_SESSION['quantite'];
		for ($o = 0; $o < count($idProduits); $o++) {
			$sql2 = "INSERT INTO contenir VALUES($num, '$idProduits[$o]', '$sessionquantite[$o]');";
			$etat2 =  PdoVanille::$monPdo->exec($sql2);
		}

		// VIDER LE PANIER

		supprimerPanier();

		// PARTIE BONUS, GESTION DES STOCKS


		foreach ($idProduits as $IDproduit) {

			$getStocks = PdoVanille::$monPdo->query("SELECT qte as qte FROM produit WHERE PDT_id ='$IDproduit'");
			$donnees = $getStocks->fetch();
			$getStocks->closeCursor();
			$numStocks = intval($donnees['qte']) - 1;

			$sqlModifStock = "UPDATE produit SET qte = '$numStocks' WHERE PDT_id ='$IDproduit'";
			$execModifStock = PdoVanille::$monPdo->query($sqlModifStock);
		}
	}

	function connecterUser()
	{
		// echo "cac";
		$login = $_POST['username'];
		$password = $_POST['password'];
		$sql5 = "SELECT ADM_id FROM administrateur WHERE nom = '$login' AND mdp = '$password'";
		// echo $sql5;
		$etat5 =  PdoVanille::$monPdo->query($sql5);
		$row = $etat5->fetch();
		if ($row) {
			// S'il y a des résultat: 
			$_SESSION['adminID'] = $row['ADM_id'];

			$lesCategories = PdoVanille::getLesCategories();
			include("vues/admin/v_categories.php");
		} else {
			// si il n'y a aucun résultat:
			$msgErreurs[] = "L'identifiant ou le mot de passe est incorrect";
			include('./vues/v_erreurs.php');
			include('./vues/v_connexion.php');
		}
	}
}
