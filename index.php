<?php

//Page appelée par défaut. Le client pourra se connecter et consulter le catalogue en static.
include_once("autoload.php");

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

                break;
        }
}
echo "<br>typeConnexion : $typeConnexion<br>";
echo "action : $action";

/*
Vue_Structure_Entete();
Vue_Connexion_Formulaire_connexion_entreprise();
Vue_Structure_BasDePage();*/