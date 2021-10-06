<?php

function Controleur_visiteur()
{
    if (isset($_REQUEST["compte"]) and isset($_REQUEST["password"])) {//Si tous les paramètres du formulaire sont bons
        $connexion = Creer_Connexion();
        //Vérification du mot de passe
        $entreprise = Entreprise_Select_ParCompte($connexion, $_REQUEST["compte"]);
        // on regarde si l'entreprise existe, et si elle est activée
        if ($entreprise != null and $entreprise["desactiver"] == 0) {
            if (password_verify($_REQUEST["password"], $entreprise["motDePasse"])) {//le mot de passe est associable à ce Hash
                $_SESSION["idEntreprise"] = $entreprise["idEntreprise"];
                $_SESSION["typeConnexionBack"] = "entreprise";


                Controleur_Gerer_Entreprise();

            } else {//mot de passe pas bon
                $msgError = "Mot de passe erroné";
                Vue_Structure_Entete();
                Vue_Connexion_Formulaire_connexion_entreprise($msgError);
                Vue_Structure_BasDePage();
            }
        } elseif ($entreprise != null and $entreprise["desactiver"] != 0) {
            $msgError = "Votre entreprise n'a pas l'autorisation nécessaire pour accéder au site";
            Vue_Structure_Entete();
            Vue_Connexion_Formulaire_connexion_entreprise($msgError);
            Vue_Structure_BasDePage();
        } else {

            $salarie = Salarie_Select_byMail($connexion, $_REQUEST["compte"]);
            // on regarde si l'entreprise existe, et si elle est activée
            if ($salarie != null and $salarie["actif"] == 1) {
                if (password_verify($_REQUEST["password"], $salarie["password"])) {//le mot de passe est associable à ce Hash
                    $_SESSION["idSalarie"] = $salarie["idSalarie"];
                    $_SESSION["idEntreprise"] = $salarie["idEntreprise"];
                    $_SESSION["typeConnexionBack"] = "entreprise_utilisateur";


                    Controleur_Catalogue_client();

                } else {//mot de passe pas bon
                    $msgError = "Mot de passe erroné";
                    Vue_Structure_Entete();
                    Vue_Connexion_Formulaire_connexion_entreprise($msgError);
                    Vue_Structure_BasDePage();
                }
            }
            else{
                {
                    $msgError = "Identification invalide ou compte désactivé";
                    Vue_Structure_Entete();
                    Vue_Connexion_Formulaire_connexion_entreprise($msgError);
                    Vue_Structure_BasDePage();
                }
            }
        }
    }
    else
    {   //Il y a un raté quelque part !
        if (isset($_REQUEST["compte"]) or isset($_REQUEST["password"]))
            $msgError = "Vous devez saisir toutes les informations";
        else
            $msgError = "";
        Vue_Structure_Entete();
        Vue_Connexion_Formulaire_connexion_entreprise($msgError);
        Vue_Structure_BasDePage();
    }


}