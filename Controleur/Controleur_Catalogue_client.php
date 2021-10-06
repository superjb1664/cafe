<?php

function Controleur_Catalogue_client()
{
    $connexion = Creer_Connexion();


    if (isset($_SESSION["idEntreprise"])) {

        Vue_Structure_Entete();

        if (isset($_REQUEST["AjoutPanierClient"])) {
            //on met dans le panier avant de calculer le menu
            Ajouter_Produit_Panier($connexion, $_SESSION["idEntreprise"], $_REQUEST["idProduit"]);
        }

        $quantiteMenu = Panier_Quantite($connexion, $_SESSION["idEntreprise"]);

        Vue_Entreprise_Client_Menu($quantiteMenu);

        //Vue_Entreprise_Client_Menu();
        $listeCategorie = Categorie_Select_Tous($connexion);
        Vue_Affiche_Categories($listeCategorie, false);
        if (isset($_REQUEST["boutonCategorie"])) {
            $idCategorie = $_REQUEST["idCategorie"];
            $listeProduit = Select_Produit_ParIdCateg($connexion, $idCategorie, "client");
            Vue_Affiche_Produits_Clients($listeProduit, $idCategorie);
        } elseif (isset($_REQUEST["okRechercher"])) {
            $produits_recherche = Rechercher_Produit($connexion, $_REQUEST["recherche"], "client");
            Vue_Affiche_Produits_Clients($produits_recherche, null, $_REQUEST["recherche"]);
        } elseif (isset($_REQUEST["AjoutPanierClient"])) {
            //    Ajouter_Produit_Panier($connexion, $_SESSION["idEntreprise"],$_REQUEST["idProduit"] );
            //
            if ($_REQUEST["idCategorie"] != "") {
                $listeProduit = Select_Produit_ParIdCateg($connexion, $_REQUEST["idCategorie"], "client");
                $idCategorie = $_REQUEST["idCategorie"];
                $recherche = null;
            } elseif ($_REQUEST["recherche"] != "") {
                $listeProduit = Rechercher_Produit($connexion, $_REQUEST["recherche"], "client");
                $idCategorie = null;
                $recherche = $_REQUEST["recherche"];
            }
            Vue_Affiche_Produits_Clients($listeProduit, $idCategorie, $recherche);

            //$_SESSION["idEntreprise"]
        } else {
            $listeProduit = Produits_Select_Libelle_Categ($connexion, "client");
            Vue_Affiche_Produits_Clients($listeProduit);
        }
    } else {
        //l'utilisateur n'est pas connecté, il n'aurait jamais du arriver ici !
        Vue_Connexion_Formulaire_connexion_administration();
    }
    Vue_Structure_BasDePage();
}