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
        Controleur_visiteur();
        break;
    case "entreprise" :
        break;
    case "entreprise_utilisateur" :
        break;
}/*
Vue_Structure_Entete();
Vue_Connexion_Formulaire_connexion_entreprise();
Vue_Structure_BasDePage();*/