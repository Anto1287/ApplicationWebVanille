<?php
include_once("../util/class.pdoVanille.inc.php");

function getCategorie()
{
    $monpdo = PdoVanille::getPdoVanille();
    $categorie = $monpdo->getLesCategories();
    sendJSON($categorie);	
}

function getProduitsByCategorie()
{
    $monpdo = PdoVanille::getPdoVanille();
    $produit = $monpdo->getLesProduitsDeCategorie($idCategorie);
    sendJSON($produit);    
	
}

function deleteProduit($id)
{
    $monpdo = PdoVanille::getPdoVanille();
    $panier = $monpdo->LesIdProduitsDuPanier();
    /*if(array($unIdProduit != $panier)){
        $delete = PdoVanille::$monpdo->supprimerProduit();
        print_r($delete);
    }*/      
}

function ajouterUnProduit()
{
    $monpdo = PdoVanille::getPdoVanille();
    $ajouter = $monpdo->ajoutProduit();
    sendJSON($ajouter);
}

function modifierUnProduit()
{
    $monpdo = PdoVanille::getPdoVanille();
    $modifier = $monPdo->modifierProduit();
    sendJSON($modifier);
}


function sendJSON($infos){
    header("Access-Control-Allow-Origin : *");
    header("Content-Type : application/json");
    echo json_encode($infos,JSON_UNESCAPED_UNICODE);
}


?>