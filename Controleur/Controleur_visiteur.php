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
                $_SESSION["typeConnexion"] = "entreprise";
                //redirection sur la première page du catalogue
                //Construction du lien vers lequel rediriger
                //Dans la vraie vie, se serait plus court, mais comme je ne connais les url sur vos postes, j'ai créé un lien qui
                //devrait marcher tout le temps (ou presque)
                if (isset($_SERVER['HTTPS']) &&
                    $_SERVER['HTTPS'] === 'on')
                    $link = "https";
                else
                    $link = "http";

                $link .= "://";

                $link .= $_SERVER['HTTP_HOST'];

                $link .= str_replace("connexion.php", "", $_SERVER['SCRIPT_NAME']);
                //$link .= "public/Catalogue/Cafe-Capsule.html";
                $link .= "Catalogue_client.php";

                header("Location: $link"); //Redirection HTTP, ordre 300, (vérifier 7.2)
                exit(); //La page s'arrête là, pour envoyer l'ordre de redirection au navigateur.
            } else {//mot de passe pas bon
                $msgError = "Mot de passe erroné";
                Vue_Structure_Entete();
                Vue_Connexion_Formulaire_connexion_entreprise($msgError);
            }
        } elseif ($entreprise != null and $entreprise["desactiver"] != 0) {
            $msgError = "Votre entreprise n'a pas l'autorisation nécessaire pour accéder au site";
            Vue_Structure_Entete();
            Vue_Connexion_Formulaire_connexion_entreprise($msgError);
        } else {

            // Ce n'est pas une entreprise, on va essayer un utilisateur normal
            $msgError = "Entreprise non trouvée";
            Vue_Structure_Entete();
            Vue_Connexion_Formulaire_connexion_entreprise($msgError);
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
    }

    Vue_Structure_BasDePage();
}