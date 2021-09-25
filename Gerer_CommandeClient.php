<?php
include("autoload.php");
$connexion = Creer_Connexion();



if(isset($_SESSION["idEntreprise"])){

    Vue_Structure_Entete();
    $quantiteMenu = Panier_Quantite($connexion, $_SESSION["idEntreprise"]);
    Vue_Entreprise_Client_Menu($quantiteMenu);
    //Vue_Entreprise_Client_Menu();

    $listeCommande = Liste_Commande_Entreprise($connexion , $_SESSION["idEntreprise"]);
    Vue_Afficher_Commande_Entreprise($listeCategorie, false);
}
else
{

}