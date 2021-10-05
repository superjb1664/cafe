<?php
    function Controleur_Gerer_catalogue()
    {
        $connexion = Creer_Connexion();


        Vue_Structure_Entete();
        Vue_Administration_Menu();
        $listeCategorie = Categorie_Select_Tous($connexion);
        Vue_Affiche_Categories($listeCategorie, true);
        if (isset($_SESSION["idUtilisateur"])) {
            if (isset($_REQUEST["boutonCategorie"])) {
                $idCategorie = $_REQUEST["idCategorie"];
                $listeProduit = Select_Produit_ParIdCateg($connexion, $idCategorie);
                Vue_Affiche_Tous_Les_Produit($listeProduit);
                //Vue_Affiche_Liste_Produit_UneCategorie($listeProduit);
            } elseif (isset($_REQUEST["nouveauProduit"])) {
                $listeCategorie = Categorie_Select_Tous($connexion);
                $listeTVA = TVA_Select_Tous($connexion);
                $fichier_image = "";
                // Si l'utilisateur veut créer une nouvelle catégorie, tout en créant un nouveau produit
                if (isset($_REQUEST["CreationCategorieAvecProduit"])) {
                    $listeCategorie = Categorie_Select_Tous($connexion);
                    $listeTVA = TVA_Select_Tous($connexion);
                    if (isset($_FILES['image_utilisateur']) and $_FILES['image_utilisateur']['error'] == 0) {
                        echo "<label><b>Pour des raisons de sécurité, veuillez resélectionner votre image</b></label>";
                    }
                    Vue_Gestion_Catalogue_Formulaire($listeCategorie, $listeTVA, true, true, "", $_REQUEST["nom"], $_REQUEST["description"], $_REQUEST["resume"], $fichier_image, $_REQUEST["prixVenteHT"], $_REQUEST["idCategorie"], $_REQUEST["idTVA"], $_REQUEST["DesactiverProduit"]);
                } elseif (isset($_POST["CreationProduit"]) or isset($_REQUEST["CategorieAvecProduit"])) {
                    if (isset($_FILES['image_utilisateur']) and $_FILES['image_utilisateur']['error'] == 0) {
                        $fichier_image = basename($_FILES['image_utilisateur']['name']);
                        move_uploaded_file($_FILES['image_utilisateur']['tmp_name'], 'public/image/' . $fichier_image);
                    }
                    if (isset($_REQUEST["CategorieAvecProduit"])) {
                        $idCategorie = Categorie_Creer($connexion, $_REQUEST["CategorieAvecProduit"], $_REQUEST["DescriptionCategorieAvecProduit"], $desactiver);
                    } else {
                        $idCategorie = $_REQUEST["idCategorie"];
                    }
                    $idProduit = Produit_Creer($connexion, $_REQUEST["nom"], $_REQUEST["description"], $_REQUEST["resume"], $fichier_image, $_REQUEST["prixVenteHT"], $idCategorie, $_REQUEST["idTVA"], $_REQUEST["DesactiverProduit"]);
                    $produit = Produit_Select_ParId($connexion, $idProduit);
                    Update_Ref_Produit($connexion, $produit["libelle"], $produit["nom"], $idProduit);
                    // Une fois le produit crée, on lui affiche une page pour savoir si le produit a bien été crée ou non, ainsi qu'un lien pour revenir sur le catalogue
                    Vue_Affiche_Création($idProduit, false, true);
                } else {
                    Vue_Gestion_Catalogue_Formulaire($listeCategorie, $listeTVA, true);
                }
            } elseif (isset($_REQUEST["ModifierProduit"])) {
                $produit = Produit_Select_ParId($connexion, $_REQUEST["idProduit"]);
                $listeCategorie = Categorie_Select_Tous($connexion);
                $listeTVA = TVA_Select_Tous($connexion);
                if (isset($_REQUEST["mettreAJourProduit"])) {
                    if (isset($_FILES['image_utilisateur']) and $_FILES['image_utilisateur']['error'] == 0) {
                        $fichier_image = basename($_FILES['image_utilisateur']['name']);
                        move_uploaded_file($_FILES['image_utilisateur']['tmp_name'], 'public/image/' . $fichier_image);
                    } else {
                        $fichier_image = $_REQUEST["fichierImage"];
                    }
                    Produit_Modifier($connexion, $_REQUEST["idProduit"], $_REQUEST["nom"], $_REQUEST["description"], $_REQUEST["resume"], $fichier_image, $_REQUEST["prixVenteHT"], $_REQUEST["idCategorie"], $_REQUEST["idTVA"], $_REQUEST["DesactiverProduit"]);
                    // Une fois le produit modifié, on réaffiche tout le catalogue
                    $listeProduit = Produit_Select($connexion);
                    Vue_Affiche_Tous_Les_Produit($listeProduit);
                } else {
                    Vue_Gestion_Catalogue_Formulaire($listeCategorie, $listeTVA, false, false, $produit["idProduit"], $produit["nom"], $produit["description"],
                        $produit["resume"], $produit["fichierImage"], $produit["prixVenteHT"], $produit["idCategorie"], $produit["idTVA"], $produit["desactiverProduit"]);
                }
            } /*elseif (isset($_REQUEST["DesactiverProduit"]) OR isset($_REQUEST["ActiverProduit"])){
            $idProduit = $_REQUEST["idProduit"];
            $produit = Produit_Select_ParId($connexion, $_REQUEST["idProduit"]);
            if ($produit["desactiverProduit"] == 0){
                $produit["desactiverProduit"] = 1;
                Produit_Modifier_Desactivation($connexion, $idProduit, $produit["desactiverProduit"]);
            }
            elseif ($produit["desactiverProduit"] == 1){
                $produit["desactiverProduit"] = 0;
                Produit_Modifier_Desactivation($connexion, $idProduit, $produit["desactiverProduit"]);
            }
            //Une fois que l'utilisateur a clique sur désactiver/activer, le bouton s'actualise, et il revient sur le catalogue
            $listeProduit = Produit_Select($connexion);
            Vue_Affiche_Tous_Les_Produit($listeProduit);
        }*/
            elseif (isset($_REQUEST["AjouterCategorie"])) {
                $listeCategorie = Categorie_Select_Tous($connexion);
                Vue_Liste_Categorie($listeCategorie);

            } elseif (isset($_REQUEST["DesactiverCategorie"]) or isset($_REQUEST["ActiverCategorie"])) {
                // si l'utilisateur clique sur Désactiver/activer
                // On modifie la valeur dans la BDD
                // On affiche soit le bouton Activer soit le bouton Désactiver en fonction
                $idCategorie = $_REQUEST["idCategorie"];
                $categorie = Categorie_Select_ParID($connexion, $idCategorie);
                switch ($categorie["desactiverCategorie"]) {
                    case 0:
                        Vue_Demande_Approbation_Desactivation($idCategorie);
                        break;
                    case 1:
                        $categorie["desactiverCategorie"] = 0;
                        Categorie_Modifier_Desactivation($connexion, $idCategorie, $categorie["desactiverCategorie"]);
                        break;
                }
                $listeCategorie = Categorie_Select_Tous($connexion);
                Vue_Liste_Categorie($listeCategorie);
            } elseif (isset($_REQUEST["OuiDesactivation"])) {
                $idCategorie = $_REQUEST["idCategorie"];
                $categorie = Categorie_Select_ParID($connexion, $idCategorie);
                $categorie["desactiverCategorie"] = 1;
                Categorie_Modifier_Desactivation($connexion, $idCategorie, $categorie["desactiverCategorie"]);
                $listeCategorie = Categorie_Select_Tous($connexion);
                Vue_Liste_Categorie($listeCategorie);
            } elseif (isset($_REQUEST["ModifierCategorie"])) {
                // l'utilisateur clique sur "Modifier", on lui affiche le formulaire de modification
                $idCategorie = $_REQUEST["idCategorie"];
                $categorie = Categorie_Select_ParID($connexion, $idCategorie);
                Vue_Formulaire_Creation_Modification_Categorie(false, $categorie["idCategorie"], $categorie["libelle"], $categorie["description"]);
            } elseif (isset($_REQUEST["mettreAJourCategorie"])) {
                // l'utilsateur clique sur mettre à jour, pour valider sa modification
                $idCategorie = $_REQUEST["idCategorie"];
                Categorie_Modifier($connexion, $idCategorie, $_REQUEST["libelle"], $_REQUEST["description"]);
                $listeCategorie = Categorie_Select_Tous($connexion);
                Vue_Liste_Categorie($listeCategorie);
            } elseif (isset($_REQUEST["nouvelleCategorie"])) {
                // l'utilisateur veut ajouter une nouvelle catégorie, on lui affiche le formulaire de création
                Vue_Formulaire_Creation_Modification_Categorie(true, false);
            } elseif (isset($_REQUEST["CreerCategorie"])) {
                // L'utlisateur a cliquer sur Créer, afin d'ajouter sa nouvelle catégorie
                $categorie = Categorie_Select_Par_Libelle($connexion, $_REQUEST["libelle"]);
                if (is_array($categorie)) {
                    echo "<h3>Cette catégorie existe déjà, veuillez recommencer</h3>";
                    Vue_Formulaire_Creation_Modification_Categorie(true, false);
                } else {
                    $desactiver = 0;
                    $reponse = Categorie_Creer($connexion, $_REQUEST["libelle"], $_REQUEST["description"], $desactiver);
                    // Une fois la catégorie crée, on lui affiche une page pour savoir si la catégorie a bien été crée ou non, ainsi qu'un lien pour revenir sur le catalogue
                    Vue_Affiche_Création($reponse, true, false);
                    $listeCategorie = Categorie_Select_Tous($connexion);
                    $listeTVA = TVA_Select_Tous($connexion);
                    Vue_Gestion_Catalogue_Formulaire($listeCategorie, $listeTVA, true, "", "", "", "", "", "", "", $reponse);
                }
            } elseif (isset($_REQUEST["okRechercher"])) {
                $produits_recherche = Rechercher_Produit($connexion, $_REQUEST["recherche"]);
                Vue_Affiche_Tous_Les_Produit($produits_recherche);
            } else {
                $listeProduit = Produits_Select_Libelle_Categ($connexion);
                Vue_Affiche_Tous_Les_Produit($listeProduit);
            }
        } else {
            //l'utilisateur n'est pas connecté, il n'aurait jamais du arriver ici !
            //Vue_Connexion_Formulaire_connexion_administration();
        }
    }