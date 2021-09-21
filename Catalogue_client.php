<?php
    include("autoload.php");
    $connexion = Creer_Connexion();


    Vue_Structure_Entete();
    Vue_Entreprise_Client_Menu();
    if(isset($_SESSION["idEntreprise"])){
        //Vue_Entreprise_Client_Menu();
        $listeCategorie = Categorie_Select_Tous($connexion);
        Vue_Affiche_Categories($listeCategorie, false);
        if (isset($_REQUEST["boutonCategorie"])) {
            $idCategorie = $_REQUEST["idCategorie"];
            $listeProduit = Select_Produit_ParIdCateg($connexion, $idCategorie, "client");
            Vue_Affiche_Produits_Clients($listeProduit);
        }
        elseif (isset($_REQUEST["okRechercher"])){
            $produits_recherche = Rechercher_Produit($connexion, $_REQUEST["recherche"], "client");
            Vue_Affiche_Produits_Clients($produits_recherche);
        }
        elseif(isset($_REQUEST["AjoutPanierClient"]))
        {
            $_SESSION["idEntreprise"]
        }
        else {
            $listeProduit = Produits_Select_Libelle_Categ($connexion, "client");
            Vue_Affiche_Produits_Clients($listeProduit);
        }
    }
    else
    {
        //l'utilisateur n'est pas connecté, il n'aurait jamais du arriver ici !
        Vue_Connexion_Formulaire_connexion_administration();
    }
    Vue_Structure_BasDePage();