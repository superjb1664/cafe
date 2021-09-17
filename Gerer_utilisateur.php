<?php
include("autoload.php");

Vue_Structure_Entete();

if(isset($_SESSION["idUtilisateur"])) {
    Vue_Administration_Menu();

    $connexion = Creer_Connexion();
    // Niveau d'autorisation 1 : SuperAdmin : peut tout faire.
    // Niveau d'autorisation 2 : Il peut modfier une entreprise et catalogue
    // Niveau d'autorisation 3 : Il peut juste gérer le catalogue

    if (isset($_REQUEST["ModifierUtilisateur"])) {
        //Modifier dans le formulaire de mise à jour
        $Utilisateur = Utilisateur_Select_ParId($connexion, $_REQUEST["idUtilisateur"]);
        Vue_Gestion_Utilisateur_Formulaire(false, $Utilisateur["idUtilisateur"], $Utilisateur["login"], $Utilisateur["niveauAutorisation"]);

    } elseif (isset($_REQUEST["mettreAJourUtilisateur"])) {
        //Mettre à jour dans la liste des entreprises
        Utilisateur_Modifier($connexion, $_REQUEST["idUtilisateur"], $_REQUEST["login"], $_REQUEST["niveauAutorisation"]);
        $Utilisateur = Utilisateur_Select_ParId($connexion, $_REQUEST["idUtilisateur"]);
        Redirect_Self_URL();
        /*$listeUtilisateur = Utilisateur_Select($connexion);
        Vue_Gestion_Utilisateur_Liste($listeUtilisateur);*/

    } elseif (isset($_REQUEST["réinitialiserMDPUtilisateur"])) {
        //Réinitialiser MDP sur la fiche de l'entreprise
        $Utilisateur = Utilisateur_Select_ParId($connexion, $_REQUEST["idUtilisateur"]);
        Utilisateur_Modifier_motDePasse($connexion, $_REQUEST["idUtilisateur"], "secret"); //$Utilisateur["idUtilisateur"]
        Redirect_Self_URL();
        /*$listeUtilisateur = Utilisateur_Select($connexion);
        Vue_Gestion_Utilisateur_Liste($listeUtilisateur);*/

    } elseif (isset($_REQUEST["nouveau"])) {
        //Nouveau sur la liste des utilisateurs
        Vue_Gestion_Utilisateur_Formulaire(true);

    } elseif (isset($_REQUEST["buttonCreerUtilisateur"])) {
        // On regarde si le login est disponible : il ne faut pas que deux personnes aient le même login !
        $login_nouveau = $_REQUEST["login"];
        $listeUtilisateur = Utilisateur_Select($connexion);
        $login_deja_attribue = false;
        for ($i = 0; $i < count($listeUtilisateur); $i++){
            $iemeUtilisateur = $listeUtilisateur[$i];
            if ($login_nouveau == $iemeUtilisateur["login"]){
                $login_deja_attribue = true;
            }
        }
        if ($login_deja_attribue == true){
            Vue_Gestion_Utilisateur_Formulaire(true);
            echo "<br><label><b>Erreur : Ce login est déjà attribué, veuillez saisir un autre login</b></label>";
        }else{
            //Créer sur la fiche de création d'une utilisateurs
            Utilisateur_Creer($connexion, $_REQUEST["login"], $_REQUEST["niveauAutorisation"]);
            Redirect_Self_URL();
            /*$listeUtilisateur = Utilisateur_Select($connexion);
            Vue_Gestion_Utilisateur_Liste($listeUtilisateur);*/
        }
    } elseif (isset($_REQUEST["DesactiverUtilisateur"]) OR isset($_REQUEST["ActiverUtilisateur"])){
        //Désactiver utilisateur ou réactiver utilisateur
        $Utilisateur = Utilisateur_Select_ParId($connexion, $_REQUEST["idUtilisateur"]);
        // champ desactiver valeur 0 : personne activée sur le site
        if ($Utilisateur["desactiver"] == 0){
            $Utilisateur["desactiver"] = 1;
            Utilisateur_Modifier_Desactivation($connexion, $_REQUEST["idUtilisateur"], $Utilisateur["desactiver"]);
        }
        // champ desactiver valeur 1 : personne désactivée sur le site
        elseif ($Utilisateur["desactiver"] == 1){
            $Utilisateur["desactiver"] = 0;
            Utilisateur_Modifier_Desactivation($connexion, $_REQUEST["idUtilisateur"], $Utilisateur["desactiver"]);
        }
        Redirect_Self_URL();
        /*$listeUtilisateur = Utilisateur_Select($connexion);
        Vue_Gestion_Utilisateur_Liste($listeUtilisateur);*/
    }
    else {
        //situation par défaut :
        $listeUtilisateur = Utilisateur_Select($connexion);
        Vue_Gestion_Utilisateur_Liste($listeUtilisateur);
    }
    /*echo '<pre>';
    print_r($_REQUEST);
    echo '</pre>';*/
}
else
{
    //l'utilisateur n'est pas connecté, il n'aurait jamais du arriver ici !
    Vue_Connexion_Formulaire_connexion_administration();
}
Vue_Structure_BasDePage();