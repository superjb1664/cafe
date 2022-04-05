<?php

function Controleur_ConcentementRGPD()
{
    $connexion = Creer_Connexion();
    if(isset($_REQUEST["accordRGPD"]))
    {

        Vue_Structure_Entete();
        if(isset($_REQUEST["cbRGPD"]))
        {
            $GLOBALS["logger"]->warning("Tentative accès impossible" ,[$_SERVER['REMOTE_ADDR']]);
            Salarie_AccepterRGPD($connexion, $_SESSION["idSalarie"]);

            //On construit la page d'accueil du salarié
            $quantiteMenu = Panier_Quantite($connexion, $_SESSION["idEntreprise"]);
            Vue_Entreprise_Salarie_Menu($quantiteMenu);

            $listeProduit = Produits_Select_Libelle_Categ($connexion, "client");
            Vue_Affiche_Produits_Clients($listeProduit);
        }
        else
        {
            $msg = "Vous ne pouvez pas accéder au logiciel. \n";
            Vue_ConsentementAffichage($msg);

        }
        Vue_Structure_BasDePage();
    }
    else {
        Vue_Structure_Entete();
        Vue_ConsentementAffichage();
        Vue_Structure_BasDePage();
    }
}