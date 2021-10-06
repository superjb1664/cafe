<?php
function Controleur_Gerer_MonCompte_Salarie()
{
    if (isset($_SESSION["idSalarie"])) {
        //Si l'utilisateur est connecté
        $connexion = Creer_Connexion();

        if (isset($_REQUEST["changerMDP"])) {
            //Il a cliqué sur changer Mot de passe. Cas pas fini
            Vue_Structure_Entete();
            $quantiteMenu = Panier_Quantite($connexion, $_SESSION["idEntreprise"]);
            Vue_Entreprise_Salarie_Menu($quantiteMenu);

            Vue_Affiche_Formulaire_Changement_MDP("","Gerer_MonCompte_Salarie");
        } elseif (isset($_REQUEST["submitModifMDP"])) {
            //il faut récuperer le mdp en BDD et vérifier qu'ils sont identiques
            $salarie = Salarie_Select_byId($connexion, $_SESSION["idSalarie"]);
            if (password_verify($_REQUEST["AncienPassword"], $salarie["password"])) {
                //on vérifie si le mot de passe de la BDD est le même que celui rentré
                if ($_REQUEST["NouveauPassword"] == $_REQUEST["ConfirmPassword"]) {
                    Vue_Structure_Entete();
                    $quantiteMenu = Panier_Quantite($connexion, $_SESSION["idEntreprise"]);
                    Vue_Entreprise_Salarie_Menu($quantiteMenu);


                    Salarie_Modifier_motDePasse($connexion, $_SESSION["idSalarie"], $_REQUEST["NouveauPassword"]);
                    Vue_Administration_Gerer_Compte("<br><label><b>Votre mot de passe a bien été modifié</b></label>", "Gerer_MonCompte_Salarie");
                    // Dans ce cas les mots de passe sont bons, il est donc modifier

                } else {
                    Vue_Structure_Entete();
                    $quantiteMenu = Panier_Quantite($connexion, $_SESSION["idEntreprise"]);
                    Vue_Entreprise_Salarie_Menu($quantiteMenu);

                    Vue_Affiche_Formulaire_Changement_MDP("<br><label><b>Les nouveaux mots de passe ne sont pas identiques</b></label>","Gerer_MonCompte_Salarie");
                }
            } else {
                Vue_Structure_Entete();
                $quantiteMenu = Panier_Quantite($connexion, $_SESSION["idEntreprise"]);
                Vue_Entreprise_Salarie_Menu($quantiteMenu);

                Vue_Affiche_Formulaire_Changement_MDP("<label><b>Vous n'avez pas saisi le bon mot de passe</b></label>","Gerer_MonCompte_Salarie");
            }
        } elseif (isset($_REQUEST["SeDeconnecter"])) {
            //L'utilisateur a cliqué sur "se déconnecter"
            session_destroy();
            unset($_SESSION);
            Vue_Structure_Entete();
            Vue_Connexion_Formulaire_connexion_administration();

        } else {
            //Cas par défaut: affichage du menu des actions.
            Vue_Structure_Entete();
            $quantiteMenu = Panier_Quantite($connexion, $_SESSION["idEntreprise"]);
            Vue_Entreprise_Salarie_Menu($quantiteMenu);

            Vue_Administration_Gerer_Compte("","Gerer_MonCompte_Salarie");
        }
    } else {
        //On renvoie l'utilisateur à la page de connexion. Il n'aurait jamais du arriver ici !
        Vue_Structure_Entete();
        Vue_Connexion_Formulaire_connexion_administration();
    }
    Vue_Structure_BasDePage();
}