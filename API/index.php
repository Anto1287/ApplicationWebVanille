<?php
include_once("api.php");

if (!empty($_GET['demande'])){
    $url = explode("/", filter_var($_GET['demande'],FILTER_SANITIZE_URL));
}
else{
    $message="Erreur";
}

try{
switch($url[0]){

    case"categories":
        if($_SERVER['REQUEST_METHOD']=== "GET")
            getCategorie();
        else
            http_response_code(405);
    break;

    case"ProduitByCat":
        if($_SERVER['REQUEST_METHOD']=== "GET")
            getProduitByCategorie($url[1]);
        else
            http_response_code(405);

    case"modifierUnProduit":
        if($_SERVER['REQUEST_METHOD']=== "PUT")
            getProduitByCategorie($url[1], $url[2], $url[3], $url[4]);
        else
            http_response_code(405);

    default:  throw new Exception ("La demande n'est pas valide, vérifiez l'URL"); 
}
}catch (Exception $e){
    echo 'Exeption reçue : ', $e->getMessage(), "\n";
}



?>