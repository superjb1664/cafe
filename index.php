<?php

//Page appelée par défaut. Le client pourra se connecter et consulter le catalogue en static.
include_once("autoload.php");


//Puis pour faire une nouvelle entrée au niveau d'index.php !
//$logger->info('Chargement d\'une page',[$_SERVER['REMOTE_ADDR'] ] );

$logger = Singleton_Logger::getInstance();
$logger->info('Chargement d\'une page',[$_SERVER['REMOTE_ADDR'] ] );

Singleton_Logger::getInstance()->info('Chargement d\'une page',[$_SERVER['REMOTE_ADDR'] ] );

CSRF_Renouveler();

if(isset($_REQUEST["token"]))
{

//    var_dump($_REQUEST["token"]);
    $connexion = Creer_Connexion();
    $token = Token_Select_byValeur($connexion, $_REQUEST["token"]);
    if ($token == false) {
        die("On se moque!!!");
    }
    if(isset($_REQUEST["mdp1"]) && isset($_REQUEST["mdp2"]))
    {
        if($_REQUEST["mdp1"] != $_REQUEST["mdp2"])
        {
            die ("trop con");
        }
        switch ($token["action"]) {
            case "Reset Entreprise":
                Entreprise_Modifier_motDePasse($connexion, $token["idUtilisateur"], $_REQUEST["mdp1"]);

                break;
            case "Reset Salarie":
                $logger->notice("Changement de mot de passe pour l'utilsiateur $token" ,[$_SERVER['REMOTE_ADDR']]);
                Salarie_Modifier_motDePasse($connexion, $token["idUtilisateur"], $_REQUEST["mdp1"]);
                break;
        }
        Token_Invalider_byId($connexion, $token["id"]);

        die("Mot de passe changé !");
    }
    else {
        //  echo $_REQUEST["token"];
         //   var_dump($token);
        if (date_diff(new DateTime('now'), new DateTime($token["dateTime"]))->format("%i") > 15) {
            die ("trop !");
        } else { //on est arrivé là, tout va bien !
            switch ($token["action"]) {
                case "Reset Entreprise":
                    Singleton_Logger::getInstance()->info('reset MDP entreprise',[$_SERVER['REMOTE_ADDR'] ] );

                    Vue_Structure_Entete();
                    Vue_Mail_ChoisirNouveauMdp($_REQUEST["token"]);
                    Vue_Structure_BasDePage();
                    break;
                case "Reset Salarie":
                    Singleton_Logger::getInstance()->info('reset MDP salarié',[$_SERVER['REMOTE_ADDR'] ] );

                    Vue_Structure_Entete();
                    Vue_Mail_ChoisirNouveauMdp($_REQUEST["token"]);
                    Vue_Structure_BasDePage();
                    break;
            }

        }
    }

    die();
}

if (isset($_SESSION["typeConnexionBack"])) {
    $typeConnexion = $_SESSION["typeConnexionBack"];
} else {
    $typeConnexion = "visiteur";
}
switch ($typeConnexion) {
    case "visiteur" :
        Controleur_visiteur();
        break;
    case "entreprise" :
        if (isset($_REQUEST["action"])) {
            $action = $_REQUEST["action"];

        } else
            $action = "Gerer_Entreprise";
        switch ($action) {
            default:
            case "Gerer_Entreprise" :
                Controleur_Gerer_Entreprise();
                break;
        }
        break;
    case "entreprise_utilisateur" :
        if (isset($_REQUEST["action"])) {
            $action = $_REQUEST["action"];
        } else
            $action = "Catalogue_client";
        switch ($action) {
            case "Catalogue_client":
                Controleur_Catalogue_client();
                break;
            case "Gerer_CommandeClient":
                Controleur_Gerer_CommandeClient();
                break;
            case "Gerer_Panier":
                Controleur_Gerer_Panier();
                break;
            case "Gerer_catalogue":
                Controleur_Catalogue_client();
                break;
            case "Gerer_MonCompte_Salarie":
                Controleur_Gerer_MonCompte_Salarie();
                break;
            case "ConsentementRGPD":
                Controleur_ConcentementRGPD();
                break;
            default:
                $logger->warning("Tentative accès impossible" ,[$_SERVER['REMOTE_ADDR']]);

                break;
        }
}/*
echo "<br>typeConnexion : $typeConnexion<br>";
echo "action : $action";


Vue_Structure_Entete();
Vue_Connexion_Formulaire_connexion_entreprise();
Vue_Structure_BasDePage();*/