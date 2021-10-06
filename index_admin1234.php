<?php

//Page appelée par défaut. Le client pourra se connecter et consulter le catalogue en static.
include_once ("autoload.php");

if(isset($_SESSION["typeConnexion"]))
{
    $typeConnexion =$_SESSION["typeConnexion"];
}
else
{
    $typeConnexion ="visiteur";
}
switch($typeConnexion)
{
    case "visiteur" :
        Controleur_visiteur_admin();
        break;
    case "administrateur" :
        if(isset($_REQUEST["action"]))
        {
            $action = $_REQUEST["action"];
            switch($action)
            {
                case "Gerer_CommandeClient":
                case "Gerer_Commande":
                    Controleur_Gerer_Commande();
                    break;
                case "Gerer_entreprisesPartenaires":
                    Controleur_Gerer_entreprisesPartenaires();
                    break;
                case "Gerer_utilisateur":
                    Controleur_Gerer_utilisateur();
                    break;
                case "Gerer_catalogue":
                    Controleur_Gerer_catalogue();
                    break;
                case "Gerer_monCompte":
                    Controleur_Gerer_monCompte();
                    break;

            }
        }
        echo $action;
        break;
}
echo "<br>".$typeConnexion;

/*
Vue_Structure_Entete();
Vue_Connexion_Formulaire_connexion_entreprise();
Vue_Structure_BasDePage();*/