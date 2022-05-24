<?php




if (isset($_SESSION["adminID"])) {
    $adminID = $_SESSION["adminID"];
} else {
    $adminID = "logout";
}


if (isset($_REQUEST["etatGestion"])) {
    $etat = $_REQUEST["etatGestion"];
} else {
    $etat = "categories";
}



// VOIR SI LA PERSONNE EST CONNECTEE OU NON
if ($adminID === "logout") {
    // si la personne n'est pas connectée


    if (isset($_REQUEST["etatLog"])) {
        $proced = $_REQUEST["etatLog"];
    } else {
        $proced = "connexion";
    }

    switch ($proced) {
        case "connexion" /* affichage par default */:
            include('./vues/v_connexion.php');
            break;
        case "process":
            $pdo->connecterUser();
            break;
    }
} else {
    // si elle est connecté

    // affichage du bouton de deconnexion
    include('vues/admin/v_deconnexion.php');

    switch ($etat) {
        case "categories" /* affichage par default */:
            // affiche les cartégories

            $lesCategories = $pdo->getLesCategories();
            include("vues/admin/v_categories.php");
            break;

        case "voirProduits":
            $idCat = $_REQUEST['cat'];
            $lesProduits = $pdo->getLesProduitsDeCategorie($idCat);
            include("vues/admin/v_produits.php");


            break;
        case "modifierProduit":
            $id = $_REQUEST['idProduit'];
            $produitInfo = $pdo->getProduitInformByID($id);
            include('./vues/admin/v_modifierProduit.php');
            break;
        case "modification":
            $description = $_POST['description'];
            $prix = $_POST['prix'];
            $idCat = $_POST['idCat'];
            $idCat = $_POST['idCat'];
            $id = $_REQUEST['id'];
            $produitInfo = $pdo->modifierProduit($description, $prix, $idCat, $id);

            $messages = "Produit modifié !";
            include("vues/v_message.php");

            $lesCategories = $pdo->getLesCategories();
            include("vues/admin/v_categories.php");
            break;
        case "deconnexion":
            unset($_SESSION['adminID']);
            include('./vues/v_connexion.php');
            break;
    }
}
