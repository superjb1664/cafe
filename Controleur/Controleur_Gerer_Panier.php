<?php

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

function Controleur_Gerer_Panier()
{
    $connexion = Creer_Connexion();

    if (isset($_SESSION["idEntreprise"])) {

        if (!isset($_REQUEST["validerPanier"])) {
            Vue_Structure_Entete();
            $quantiteMenu = Panier_Quantite($connexion, $_SESSION["idEntreprise"]);
            Vue_Entreprise_Salarie_Menu($quantiteMenu);


            //Vue_Entreprise_Client_Menu();
            $listeCategorie = Categorie_Select_Tous($connexion);
            Vue_Affiche_Categories($listeCategorie, false);
        }

        if (isset($_REQUEST["diminuerQTT"])) {
            Panier_DiminuerQTT_Article($connexion, $_SESSION["idEntreprise"], $_REQUEST["idProduit"]);
            $listeArticlePanier = Panier_ListeArticle($connexion, $_SESSION["idEntreprise"]);
            Vue_Affiche_Panier_Client($listeArticlePanier);
        } elseif (isset($_REQUEST["augmenterQTT"])) {
            Panier_AugmenterQTT_Article($connexion, $_SESSION["idEntreprise"], $_REQUEST["idProduit"]);
            $listeArticlePanier = Panier_ListeArticle($connexion, $_SESSION["idEntreprise"]);
            Vue_Affiche_Panier_Client($listeArticlePanier);
        } elseif (isset($_REQUEST["validerPanier"])) {
            ob_start();
            $listeArticlePanier = Panier_ListeArticle($connexion, $_SESSION["idEntreprise"]);
            $infoCommande = Rechercher_Caddie_Entreprise($connexion, $_SESSION["idEntreprise"]);
            $infoEntreprise = Entreprise_Select_ParId($connexion, $_SESSION["idEntreprise"]);
            Facture_EnteteBrulerie($infoCommande, $infoEntreprise);
            Vue_Affiche_Panier_Client($listeArticlePanier, true);
            Facture_BasPageBrulerie($infoCommande, $infoEntreprise);
            Commande_Valider_Caddie($connexion, $infoCommande["id"], $_SESSION["idSalarie"]);
            $content = ob_get_clean();
            $html2pdf = new Html2Pdf('L', 'A4', 'fr');
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->writeHTML($content);
            $html2pdf->output('facture.pdf');

            /*$html2pdf = new Html2Pdf();
            $html2pdf->writeHTML('<h1>HelloWorld</h1>This is my first test');
            $html2pdf->output();*/
        } else {
            $listeArticlePanier = Panier_ListeArticle($connexion, $_SESSION["idEntreprise"]);
            Vue_Affiche_Panier_Client($listeArticlePanier);
        }


    } else {
        //l'utilisateur n'est pas connecté, il n'aurait jamais du arriver ici !
        Vue_Connexion_Formulaire_connexion_administration();
    }
    Vue_Structure_BasDePage();
}