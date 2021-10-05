<?php
function Controleur_Gerer_Commande()
{
    $connexion = Creer_Connexion();

    Vue_Structure_Entete();
    Vue_Administration_Menu();

    $listeEtatCommande = EtatCommande_Liste  ($connexion);
    Vue_Affiche_Etat_Commande($listeEtatCommande);

    if(isset($_REQUEST["boutonCategorie"]))
    {
        //On a demandé les commandes d'une catégorie
        $idEtatcommande = $_REQUEST["idEtatCommande"];
        $listeCommande = Liste_Commande_Etat($connexion, $idEtatcommande);
        Vue_Afficher_ListeDeCommandes($listeCommande);
    }
    elseif(isset($_REQUEST["Toute"]))
    {
        $listeCommande = Liste_Commande_Toute($connexion);
        Vue_Afficher_ListeDeCommandes($listeCommande);
    }
}