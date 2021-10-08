<?php

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

function Controleur_Gerer_CommandeClient()
{


    $connexion = Creer_Connexion();


    if (isset($_SESSION["idEntreprise"])) {

        if(isset($_REQUEST["AfficherCommandePDF"])){
            //Le pdf n'a pas besoin des entêtes HTML
            ob_start();
            $listeArticlePanier = Rechercher_Liste_Article_Commande($connexion, $_REQUEST["idCommande"]);
            $infoCommande = Rechercher_Commande_ParId($connexion, $_REQUEST["idCommande"]);
            $infoEntreprise = Entreprise_Select_ParId($connexion, $_SESSION["idEntreprise"]);
            Facture_EnteteBrulerie($infoCommande, $infoEntreprise);
            Vue_Affiche_Panier_Client($listeArticlePanier, true);
            Facture_BasPageBrulerie($infoCommande, $infoEntreprise);
            $content = ob_get_clean();
            $html2pdf = new Html2Pdf('L', 'A4', 'fr');
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->writeHTML($content);
            $html2pdf->output('facture.pdf');
            exit();
        } else {
            Vue_Structure_Entete();
            $quantiteMenu = Panier_Quantite($connexion, $_SESSION["idEntreprise"]);
            Vue_Entreprise_Salarie_Menu($quantiteMenu);
        }//Vue_Entreprise_Client_Menu();

        if (isset($_REQUEST["VoirDetailCommande"])) {
            $listeArticleCommande = Rechercher_Liste_Article_Commande($connexion, $_REQUEST["idCommande"]);
            $infoCommande = Rechercher_Commande_ParId($connexion, $_REQUEST["idCommande"]);
            $histoEtatCommande = Rechercher_Historique_Commande($connexion, $_REQUEST["idCommande"]);
            Vue_Affiche_Panier_Client($listeArticleCommande, true, $infoCommande);
            Vue_Afficher_Button_Facture($_REQUEST["idCommande"]);
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
            Vue_Afficher_Button_Facture($_REQUEST["idCommande"]);
            Vue_Afficher_HistoCommande($histoEtatCommande);

        } else
        {
            $listeCommande = Liste_Commande_Entreprise($connexion, $_SESSION["idEntreprise"]);
            Vue_Afficher_Commande_Entreprise($listeCommande, false);
        }
    }
}