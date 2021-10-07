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
            $infoCommande = Rechercher_Commande_ParId($connexion, $_REQUEST["idCommande"]);
            $histoEtatCommande = Rechercher_Historique_Commande($connexion, $_REQUEST["idCommande"]);
            Vue_Affiche_Panier_Client($listeArticleCommande, true, $infoCommande);
            Vue_Action_Sur_Commande_Client($infoCommande);
            Vue_Afficher_HistoCommande($histoEtatCommande);
        } elseif (isset($_REQUEST["changementEtatCommande"])) {
            if (isset($_REQUEST["info"]))
                $infoComplementaire = $_REQUEST["info"];
            else
                $infoComplementaire = "";

            if (isset($_REQUEST["Signalee_CommandeReceptionnee"])) {
                HistoriqueEtatCommande_Inserer($connexion, $_REQUEST["idCommande"], 7, $infoComplementaire, $_SESSION["idSalarie"]);
            } elseif (isset($_REQUEST["Signalee_CommandeReceptionneeIncident"])) {
                HistoriqueEtatCommande_Inserer($connexion, $_REQUEST["idCommande"], 8, $infoComplementaire, $_SESSION["idSalarie"]);
            }  /*elseif(isset($_REQUEST[""]))
        {
            HistoriqueEtatCommande_Inserer($connexion, $_REQUEST["idCommande"], , $infoComplementaire,,$_SESSION["idUtilisateur"] );
        }*/

            $listeArticleCommande = Rechercher_Liste_Article_Commande($connexion, $_REQUEST["idCommande"]);
            $infoCommande = Rechercher_Commande_ParId($connexion, $_REQUEST["idCommande"]);
            $histoEtatCommande = Rechercher_Historique_Commande($connexion, $_REQUEST["idCommande"]);
            Vue_Affiche_Panier_Client($listeArticleCommande, true, $infoCommande);
            Vue_Action_Sur_Commande_Client($infoCommande);
            Vue_Afficher_InfoCommande($infoCommande);
            Vue_Afficher_HistoCommande($histoEtatCommande);

        } else {
            $listeCommande = Liste_Commande_Entreprise($connexion, $_SESSION["idEntreprise"]);
            Vue_Afficher_Commande_Entreprise($listeCommande, false);
        }
    }
}