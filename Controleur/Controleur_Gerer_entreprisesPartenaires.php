<?php
use PHPMailer\PHPMailer\PHPMailer; //Obligatoire pour avoir l’objet phpmailer qui marche

/**
 * Ce contrôleur est dédié à la gestion des entreprises partenaires.
 * Toutes les pages de cette user story renvoie sur ce contrôleur.
 * Le tri entre les actions est fait sur l'existence des boutons submit. Deux boutons ne doivent pas avoir le même nom ! ;)
 */
function Controleur_Gerer_entreprisesPartenaires()
{
    Vue_Structure_Entete();

    if (isset($_SESSION["idUtilisateur"])) {
        Vue_Administration_Menu();

        $connexion = Creer_Connexion();

        if (isset($_REQUEST["Modifer"])) {
            //Modifier dans le formulaire de mise à jour
            $entreprise = Entreprise_Select_ParId($connexion, $_REQUEST["idEntreprise"]);
            Vue_Gestion_Entreprise_Formulaire(false, $entreprise["idEntreprise"], $entreprise["denomination"], $entreprise["rueAdresse"], $entreprise["complementAdresse"], $entreprise["codePostal"]
                , $entreprise["ville"], $entreprise["pays"], $entreprise["numCompte"], $entreprise["mailContact"], $entreprise["siret"]);

        } elseif (isset($_REQUEST["mettreAJour"])) {
            //Mettre à jour dans la liste des entreprises
            Entreprise_Modifier($connexion, $_REQUEST["idEntreprise"], $_REQUEST["denomination"], $_REQUEST["rueAdresse"], $_REQUEST["complementAdresse"], $_REQUEST["codePostal"]
                , $_REQUEST["ville"], $_REQUEST["pays"], $_REQUEST["mailContact"], $_REQUEST["siret"]);
            $listeEntreprise = Entreprise_Select($connexion);
            $Utilisateur = Utilisateur_Select_ParId($connexion, $_SESSION["idUtilisateur"]);
            Vue_Gestion_Entreprise_Liste($listeEntreprise, $Utilisateur["niveauAutorisation"]);

        } elseif (isset($_REQUEST["réinitialiserMDP"])) {
            //Réinitialiser MDP sur la fiche de l'entreprise
            $entreprise = Entreprise_Select_ParId($connexion, $_REQUEST["idEntreprise"]);

            $motDePasse = GenereMDP(10);
            Entreprise_Modifier_motDePasse($connexion, $_REQUEST["idEntreprise"], $motDePasse); //$entreprise["numCompte"]

            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = '127.0.0.1';
            $mail->CharSet = "UTF-8";
            $mail->Port = 1025; //Port non crypté
            $mail->SMTPAuth = false; //Pas d’authentification
            $mail->SMTPAutoTLS = false; //Pas de certificat TLS
            $mail->setFrom('contact@labruleriecomtoise.fr', 'contact');
            $mail->addAddress($entreprise["mailContact"], $entreprise["denomination"]);
            if ($mail->addReplyTo('test@labruleriecomtoise.fr', 'admin')) {
                $mail->Subject = 'Objet : MDP !';
                $mail->isHTML(false);
                $mail->Body = "MDP $motDePasse";

                if (!$mail->send()) {
                    $msg = 'Désolé, quelque chose a mal tourné. Veuillez réessayer plus tard.';
                } else {
                    $msg = 'Message envoyé ! Merci de nous avoir contactés.';
                }
            } else {
                $msg = 'Il doit manquer qqc !';
            }
        //    echo $msg;
            $listeEntreprise = Entreprise_Select($connexion);
            $Utilisateur = Utilisateur_Select_ParId($connexion, $_SESSION["idUtilisateur"]);
            Vue_Gestion_Entreprise_Liste($listeEntreprise, $Utilisateur["niveauAutorisation"]);

        } elseif (isset($_REQUEST["nouveau"])) {
            //Nouveau sur la liste des entreprises
            Vue_Gestion_Entreprise_Formulaire(true);

        } elseif (isset($_REQUEST["buttonCreer"])) {
            //Créer sur la fiche de création d'une entreprise
            Entreprise_Creer($connexion, $_REQUEST["denomination"], $_REQUEST["rueAdresse"], $_REQUEST["complementAdresse"], $_REQUEST["codePostal"]
                , $_REQUEST["ville"], $_REQUEST["pays"], $_REQUEST["mailContact"], $_REQUEST["siret"]);
            $listeEntreprise = Entreprise_Select($connexion);
            $Utilisateur = Utilisateur_Select_ParId($connexion, $_SESSION["idUtilisateur"]);
            Vue_Gestion_Entreprise_Liste($listeEntreprise, $Utilisateur["niveauAutorisation"]);

        } elseif (isset($_REQUEST["DesactiverEntreprise"]) or isset($_REQUEST["ActiverEntreprise"])) {
            //Désactiver utilisateur ou réactiver utilisateur
            $Entreprise = Entreprise_Select_ParId($connexion, $_REQUEST["idEntreprise"]);
            // champ desactiver valeur 0 : personne activée sur le site
            if ($Entreprise["desactiver"] == 0) {
                $Entreprise["desactiver"] = 1;
                Entreprise_Modifier_Desactivation($connexion, $_REQUEST["idEntreprise"], $Entreprise["desactiver"]);

            } // champ desactiver valeur 1 : personne désactivée sur le site
            elseif ($Entreprise["desactiver"] == 1) {
                $Entreprise["desactiver"] = 0;
                Entreprise_Modifier_Desactivation($connexion, $_REQUEST["idEntreprise"], $Entreprise["desactiver"]);
            }
            $listeEntreprise = Entreprise_Select($connexion);
            $Utilisateur = Utilisateur_Select_ParId($connexion, $_SESSION["idUtilisateur"]);
            Vue_Gestion_Entreprise_Liste($listeEntreprise, $Utilisateur["niveauAutorisation"]);
        } else {
            //situation par défaut :
            $listeEntreprise = Entreprise_Select($connexion);
            $Utilisateur = Utilisateur_Select_ParId($connexion, $_SESSION["idUtilisateur"]);
            Vue_Gestion_Entreprise_Liste($listeEntreprise, $Utilisateur["niveauAutorisation"]);

        }
    }
    Vue_Structure_BasDePage();
}