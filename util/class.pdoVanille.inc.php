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
 */				
	private function __construct()
	{
    		PdoVanille::$monPdo = new PDO('mysql:host=127.0.0.1;dbname=vanille', 'root', ''); 
			PdoVanille::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
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
		if(PdoVanille::$monPdoVanille == null)
		{
			PdoVanille::$monPdoVanille= new PdoVanille();
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
	    $req="select * from produit where idCategorie = '$idCategorie'";
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
		$lesProduits=array();
		if($nbProduits != 0)
		{
			foreach($desIdProduit as $unIdProduit)
			{
				$req = "select * from produit where PDT_id = '$unIdProduit'";
				$res = PdoVanille::$monPdo->query($req);
				$unProduit = $res->fetch();
				$lesProduits[] = $unProduit;
			}
		}
		return $lesProduits;
	}
/**
 * Création d'une commande 
 *
 * Crée une commande à partir des arguments validés passés en paramètre, l'identifiant est
 * construit à partir du maximum existant ; crée les lignes de commandes dans la table contenir à partir du
 * tableau d'idProduit passé en paramètre
 * @param $nom 
 * @param $rue
 * @param $cp
 * @param $ville
 * @param $mail
 * @param $lesIdProduit
 
*/
	public function creerCommande($nom,$rue,$cp,$ville,$mail, $lesIdProduit )
	{
		$req = "select max(CDE_id) as maxi from commande";
		$res = PdoVanille::$monPdo->query($req);
		$laLigne = $res->fetch();
		$maxi = $laLigne['maxi'] ;
		$maxi++;
		$idCommande = $maxi;
		echo $idCommande."<br>";
		$date = date('Y/m/d');
		$req = "insert into commande values ('$idCommande','$date','$nom','$rue','$cp','$ville','$mail')";
		echo $req."<br>";
		$res = PdoVanille::$monPdo->exec($req);
		/** A RAJOUTER  INSERTION DANS LA TABLE CONTENIR 
		 balayage du tableau des produits
		*/	
		
		$lesIdProduit = getLesIdProduitsDuPanier();
		foreach($lesIdProduit as $unIdProduit)
		{
			$req = "insert into contenir values ('$idCommande', '$unIdProduit')";
			$res = PdoVanille::$monPdo->exec($req);
		}
	}

	public function connexionAdmin($nom, $mdp)
	{
		$sql5 = "SELECT ADM_id FROM administrateur WHERE nom = '$nom' AND mdp = '$mdp'";

		$etat5 = PdoVanille::$monPdo->query($sql5);
		$row = $etat5->fetch();
		if ($row){
			$lesCategories = PdoVanille::getLesCategories();
			include ('vues/v_categories.php');
		}
		else {
			$msgErreurs[] = "L'identifiant ou le mot de passe est incorrect";
			include ('vues/v_erreurs.php');
			include ('vues/v_connexion.php');
		}
	}

	public function modifierProduit(){
		$id = $_SESSION['id'];
		$prix = $_SESSION['prix'];
		$description = $_POST['description'];
		$req = "UPDATE description, prix FROM produit WHERE PDT_id=$id;";
		$res = PdoVanille::$monPdo->exec($req);
	}

	public function supprimerProduit($idProduit){
		$id = $_SESSION['id'];
		$req = "DELETE FROM produit WHERE PDT_id=$id;";
		$res = PdoVanille::$monPdo->exec($req);
	}

	public function ajoutProduit($idP, $desP, $prixP, $imgP, $catP){
		$req = "INSERT INTO produit VALUES ($idP, $desP, $prixP, $imgP, $catP);";
		$res = PdoVanille::$monPdo->exec($req);
	}
}
?>