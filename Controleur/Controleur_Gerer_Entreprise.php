<?php

function Controleur_Gerer_Entreprise()
{
    $connexion = Creer_Connexion();


    if (isset($_SESSION["idEntreprise"])) {


        if(isset($_REQUEST["infoEntreprise"]))
        {
            Vue_Structure_Entete();
            Vue_Entreprise_Client_Menu();

            $entreprise = Entreprise_Select_ParId($connexion, $_SESSION["idEntreprise"]);
            Vue_Gestion_Entreprise_Information( $entreprise["idEntreprise"], $entreprise["denomination"], $entreprise["rueAdresse"], $entreprise["complementAdresse"], $entreprise["codePostal"]
                , $entreprise["ville"], $entreprise["pays"], $entreprise["numCompte"], $entreprise["mailContact"], $entreprise["siret"]);


            Vue_Structure_BasDePage();
        }
        elseif(isset($_REQUEST["salariesHabitites"]))
        {
            Vue_Structure_Entete();
            Vue_Entreprise_Client_Menu();

            $listeSalarie = Salarie_Select_Entreprise($connexion, $_SESSION["idEntreprise"]);
            Vue_Salarie_Liste($listeSalarie);
            Vue_Structure_BasDePage();
        }
        elseif(isset($_REQUEST["ajouterSalarie"]))
        {
            Vue_Structure_Entete();
            Vue_Entreprise_Client_Menu();
            Vue_Salarie_Editer();
            Vue_Structure_BasDePage();
        }
        elseif(isset($_REQUEST["buttonCreerSalarie"]))
        {
            Vue_Structure_Entete();
            Vue_Entreprise_Client_Menu();
            Salarie_Ajouter($connexion,$_REQUEST["nom"],$_REQUEST["prenom"],$_REQUEST["role"],$_REQUEST["mailContact"],"secret",1,$_SESSION["idEntreprise"]);
            $listeSalarie = Salarie_Select_Entreprise($connexion, $_SESSION["idEntreprise"]);
            Vue_Salarie_Liste($listeSalarie);
            Vue_Structure_BasDePage();
        }
        elseif(isset($_REQUEST["ModiferSalarie"]))
        {
            Vue_Structure_Entete();
            Vue_Entreprise_Client_Menu();
            $salarie = Salarie_Select_byId($connexion, $_REQUEST["idSalarie"]);
            Vue_Salarie_Editer(false, $salarie["idSalarie"], $salarie["nom"], $salarie["prenom"], $salarie["roleEntreprise"], $salarie["mail"]);
            Vue_Structure_BasDePage();
        }
        elseif(isset($_REQUEST["ModiferSalarieValider"]))
        {
            Vue_Structure_Entete();
            Vue_Entreprise_Client_Menu();

            Salarie_MAJ($connexion,$_REQUEST["nom"],$_REQUEST["prenom"],$_REQUEST["role"],$_REQUEST["mailContact"],$_REQUEST["idSalarie"]);
            $listeSalarie = Salarie_Select_Entreprise($connexion, $_SESSION["idEntreprise"]);
            Vue_Salarie_Liste($listeSalarie, "<br>Salarié modifié");
            Vue_Structure_BasDePage();
        }
        elseif(isset($_REQUEST["DesactiverSalarie"]))
        {
            Vue_Structure_Entete();
            Vue_Entreprise_Client_Menu();

            Salarie_Activer($connexion,$_REQUEST["idSalarie"]);
            $listeSalarie = Salarie_Select_Entreprise($connexion, $_SESSION["idEntreprise"]);
            Vue_Salarie_Liste($listeSalarie, "<br>Salarié modifié");
            Vue_Structure_BasDePage();
        }
        elseif(isset($_REQUEST["ActiverSalarie"]))
        {
            Vue_Structure_Entete();
            Vue_Entreprise_Client_Menu();

            Salarie_Desactiver($connexion,$_REQUEST["idSalarie"]);
            $listeSalarie = Salarie_Select_Entreprise($connexion, $_SESSION["idEntreprise"]);
            Vue_Salarie_Liste($listeSalarie, "<br>Salarié modifié");
            Vue_Structure_BasDePage();
        }
        elseif (isset($_REQUEST["submitModifMDP"])) {
            Vue_Structure_Entete();
            Vue_Entreprise_Client_Menu();
            //il faut récuperer le mdp en BDD et vérifier qu'ils sont identiques
            $entreprise_connectee = Entreprise_Select_ParId($connexion, $_SESSION["idEntreprise"]);
            if (password_verify($_REQUEST["AncienPassword"], $entreprise_connectee["motDePasse"])) {
                //on vérifie si le mot de passe de la BDD est le même que celui rentré
                if ($_REQUEST["NouveauPassword"] == $_REQUEST["ConfirmPassword"]) {
                    Entreprise_Modifier_motDePasse($connexion, $_SESSION["idEntreprise"], $_REQUEST["NouveauPassword"]);
                    Vue_Entreprise_Gerer_Compte("<label><b>Votre mot de passe a bien été modifié</b></label>");
                    // Dans ce cas les mots de passe sont bons, il est donc modifié

                } else {
                    Vue_Affiche_Formulaire_Changement_MDP("<label><b>Les nouveaux mots de passe ne sont pas identiques</b></label>");

                }
            } else {
                Vue_Affiche_Formulaire_Changement_MDP("<label><b>Vous n'avez pas saisi le bon mot de passe</b></label>");

            }
        }
        elseif(isset($_REQUEST["ChangerMDPEntreprise"]))
        {
            Vue_Structure_Entete();
            Vue_Entreprise_Client_Menu();
            Vue_Affiche_Formulaire_Changement_MDP();
            Vue_Structure_BasDePage();
        }
        elseif(isset($_REQUEST["deconnexionEntreprise"]))
        {
            session_destroy();
            unset($_SESSION["idEntreprise"]);
            Vue_Structure_Entete();
            Vue_Connexion_Formulaire_connexion_entreprise();
            Vue_Structure_BasDePage();
        }
        else
        {
            Vue_Structure_Entete();
            Vue_Entreprise_Client_Menu();
            Vue_Entreprise_Gerer_Compte();
            Vue_Structure_BasDePage();

        }


    }
}

