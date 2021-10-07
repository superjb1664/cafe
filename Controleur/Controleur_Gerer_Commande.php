<?php
function Controleur_Gerer_Commande()
{
    $connexion = Creer_Connexion();

    Vue_Structure_Entete();
    Vue_Administration_Menu();

    $listeEtatCommande = EtatCommande_Liste($connexion);
    Vue_Affiche_Etat_Commande($listeEtatCommande);

    if (isset($_REQUEST["boutonCategorie"])) {
        //On a demandé les commandes d'une catégorie
        $idEtatcommande = $_REQUEST["idEtatCommande"];
        $listeCommande = Liste_Commande_Etat($connexion, $idEtatcommande);
        Vue_Afficher_ListeDeCommandes($listeCommande);
    } elseif (isset($_REQUEST["Toute"])) {
        $listeCommande = Liste_Commande_Toute($connexion);
        Vue_Afficher_ListeDeCommandes($listeCommande);
    } elseif (isset($_REQUEST["VoirDetailCommande"])) {
        $listeArticleCommande = Rechercher_Liste_Article_Commande($connexion, $_REQUEST["idCommande"]);
        $infoCommande = Rechercher_Commande_ParId($connexion, $_REQUEST["idCommande"]);
        $histoEtatCommande = Rechercher_Historique_Commande($connexion, $_REQUEST["idCommande"]);
        Vue_Affiche_Panier_Client($listeArticleCommande, true, $infoCommande);
        Vue_Action_Sur_Commande_Entreprise($infoCommande);
        Vue_Afficher_InfoCommande($infoCommande);
        Vue_Afficher_HistoCommande($histoEtatCommande);
    } elseif (isset($_REQUEST["changementEtatCommande"])) {
        if (isset($_REQUEST["info"]))
            $infoComplementaire = $_REQUEST["info"];
        else
            $infoComplementaire = "";

        if (isset($_REQUEST["Signalee_CommandePayee"])) {
            HistoriqueEtatCommande_Inserer($connexion, $_REQUEST["idCommande"], 3, $infoComplementaire, -1, $_SESSION["idUtilisateur"]);
        } elseif (isset($_REQUEST["Signalee_CommandeEnPreparation"])) {
            HistoriqueEtatCommande_Inserer($connexion, $_REQUEST["idCommande"], 4, $infoComplementaire, -1, $_SESSION["idUtilisateur"]);
        } elseif (isset($_REQUEST["Signalee_CommandeProblemeStock"])) {
            HistoriqueEtatCommande_Inserer($connexion, $_REQUEST["idCommande"], 5, $infoComplementaire, -1, $_SESSION["idUtilisateur"]);
        } elseif (isset($_REQUEST["Signalee_CommandeEnvoyée"])) {
            HistoriqueEtatCommande_Inserer($connexion, $_REQUEST["idCommande"], 6, $infoComplementaire, -1, $_SESSION["idUtilisateur"]);
        }/*elseif(isset($_REQUEST[""]))
        {
            HistoriqueEtatCommande_Inserer($connexion, $_REQUEST["idCommande"], , $infoComplementaire,,$_SESSION["idUtilisateur"] );
        }*/

        $listeArticleCommande = Rechercher_Liste_Article_Commande($connexion, $_REQUEST["idCommande"]);
        $infoCommande = Rechercher_Commande_ParId($connexion, $_REQUEST["idCommande"]);
        $histoEtatCommande = Rechercher_Historique_Commande($connexion, $_REQUEST["idCommande"]);
        Vue_Affiche_Panier_Client($listeArticleCommande, true, $infoCommande);
        Vue_Action_Sur_Commande_Entreprise($infoCommande);
        Vue_Afficher_InfoCommande($infoCommande);
        Vue_Afficher_HistoCommande($histoEtatCommande);

    }
}