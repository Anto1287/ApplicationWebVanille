<!-- Controleur pour consulter et commander Vanille -->
<?php
initPanier();

$action = $_REQUEST['action'];

switch ($action) {
    case 'formulaire': {
            // affichage sans traitement du formulaire pour informations client

            // création de variable voir ref case 'validation'
            $nomPrenomClient = "";
            $mailClient = "";
            $adresseRueClient = "";
            $cpClient = "";
            $villeClient = "";

            include('vues/v_formulaire.php');
            break;
        }
    case 'validation': {
            // envoi des informations pour le check et/ou enregistrement

            // on créer des variables qui seront transmise au formulaire pour garder les values écrite si erreurs
            $nomPrenomClient =  $_POST['nomPrenomClient'];
            $mailClient =  $_POST['mailClient'];
            $adresseRueClient =  $_POST['adresseRueClient'];
            $cpClient =  $_POST['cpClient'];
            $villeClient =  $_POST['villeClient'];

            if (isset($_POST['nomPrenomClient']) && isset($_POST['mailClient']) && isset($_POST['adresseRueClient']) && isset($_POST['cpClient']) && isset($_POST['villeClient'])) {
                // si toutes les informations ont été renseigné,
                $msgErreurs = getErreursSaisieCommande($cpClient);


                // ■■■■■■■■■■■■■
                // POSSIBLE D'ENLEVER L'ERREUR EN METTANT $msgErreurs[] mais je ne sais pas si ça marche 
                // ■■■■■■■■■■■■■


                if (count($msgErreurs) == 0) {
                    // si le code postal est dans le bon format
                    if (testMAIL($_POST['mailClient'])) {
                        $pdo->creationCommande($nomPrenomClient, $mailClient, $adresseRueClient, $cpClient, $villeClient);
                        $message = "Commande enregistré !";
                        include("vues/v_message.php");
                    } else {
                        // erreur mail pas dans le bon format
                        $msgErreurs[] = "Le mail n'est pas dans le bon format";
                        include("vues/v_erreurs.php");
                        // réaffichage du formulaire
                        include('vues/v_formulaire.php');
                    }
                } else {
                    // erreur code postal pas dans le bon format
                    include("vues/v_erreurs.php");
                    // réaffichage du formulaire
                    include('vues/v_formulaire.php');
                }
            }

            break;
        }
}
