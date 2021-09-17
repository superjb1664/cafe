<?php
include("autoload.php");

if(isset($_SESSION["idEntreprise"])) {
    //Si l'utilisateur est connecté
    $connexion = Creer_Connexion();
    Vue_Structure_Entete();
    //Vue_Entreprise_Client_Menu();
    //Vue_Entreprise_Gerer_Compte();
    if(isset($_REQUEST["ChangerMDPEntreprise"]))
    {
        Vue_Structure_Entete();
        Vue_Entreprise_Client_Menu();


        if (isset($_REQUEST["submitModifMDP"])){
            //il faut récuperer le mdp en BDD et vérifier qu'ils sont identiques
            $entreprise_connectee = Entreprise_Select_ParId($connexion, $_SESSION["idEntreprise"]);
            if (password_verify($_REQUEST["AncienPassword"], $entreprise_connectee["motDePasse"])) {
                //on vérifie si le mot de passe de la BDD est le même que celui rentré
                if ($_REQUEST["NouveauPassword"] == $_REQUEST["ConfirmPassword"]){
                    //Utilisateur_Modifier_motDePasse($connexion, $_SESSION["idEntreprise"], $_REQUEST["NouveauPassword"] );
                    Vue_Entreprise_Client_Menu();
                    Vue_Entreprise_Gerer_Compte();
                    // Dans ce cas les mots de passe sont bons, il est donc modifier
                    echo "<label><b>Votre mot de passe a bien été modifié</b></label>";
                }
                else{
                    Vue_Affiche_Formulaire_Changement_MDP();
                    echo "<label><b>Les nouveaux mots de passe ne sont pas identiques</b></label>";
                }
            }
            else{
                Vue_Affiche_Formulaire_Changement_MDP();
                echo "<label><b>Vous n'avez pas saisi le bon mot de passe</b></label>";
            }
        }
        else{
            Vue_Affiche_Formulaire_Changement_MDP();
        }
    }
    elseif(isset($_REQUEST["deconnexionEntreprise"]))
    {
        //L'utilisateur a cliqué sur "se déconnecter"
        session_destroy( );
        unset($_SESSION["idEntreprise"]);
        Vue_Structure_Entete();
        Vue_Connexion_Formulaire_connexion_entreprise();
    }
    else {
        //Cas par défaut: affichage du menu des actions.
        Vue_Structure_Entete();
        Vue_Entreprise_Client_Menu();
        Vue_Entreprise_Gerer_Compte();
    }
}
else
{
    //On renvoie l'utilisateur à la page de connexion. Il n'aurait jamais du arriver ici !
    Vue_Structure_Entete();
    Vue_Connexion_Formulaire_connexion_entreprise();
}
Vue_Structure_BasDePage();
