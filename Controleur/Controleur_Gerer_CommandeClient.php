<?php
function Controleur_Gerer_CommandeClient()
{


    $connexion = Creer_Connexion();


    if (isset($_SESSION["idEntreprise"])) {

        Vue_Structure_Entete();
        $quantiteMenu = Panier_Quantite($connexion, $_SESSION["idEntreprise"]);
        Vue_Entreprise_Salarie_Menu($quantiteMenu);
        //Vue_Entreprise_Client_Menu();

        if (isset($_REQUEST["VoirDetailCommande"])) {
            $listeArticleCommande = Rechercher_Liste_Article_Commande($connexion, $_REQUEST["idCommande"]);
            $infoCommande = Rechercher_Commande($connexion, $_REQUEST["idCommande"]);
            $histoEtatCommande = Rechercher_Historique_Commande($connexion, $_REQUEST["idCommande"]);
            Vue_Affiche_Panier_Client($listeArticleCommande, false);
            Vue_Afficher_InfoCommande($infoCommande);
            Vue_Afficher_HistoCommande($histoEtatCommande);
        } else {
            $listeCommande = Liste_Commande_Entreprise($connexion, $_SESSION["idEntreprise"]);
            Vue_Afficher_Commande_Entreprise($listeCommande, false);
        }
    } else {

    }
}