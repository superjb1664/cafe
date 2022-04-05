<?php
use PHPMailer\PHPMailer\PHPMailer; //Obligatoire pour avoir l’objet phpmailer qui marche

function Controleur_visiteur()
{
    if(isset($_REQUEST["reinitmdpconfirm"]))
    {
        if(CSRF_Verifier())
        {         CSRF_Renouveler();      }
        else
        {         die("PAS BIEN !!!!");
            Singleton_Logger::getInstance()->warning('erreur CSRF',[$_SERVER['REMOTE_ADDR'] ] );


        }

        $connexion = Creer_Connexion();
        //Vérification du mot de passe
        $entreprise = Entreprise_Select_ParMail($connexion, $_REQUEST["email"]);
        echo "entreprise<br>";
        var_dump($entreprise);
        if($entreprise != null)
        {

            // le mail appartient à une entreprise
            // on va faire le mail pour cette entreprise !
           $jeton = Token_Ajouter($connexion, $entreprise["idEntreprise"],"Reset Entreprise");

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
                $mail->isHTML(true);
                $mail->Body = "<a href='http://127.0.0.1:63342/cafe/index.php?token=".urlencode($jeton)."'>
                                Lien reinitialisation mdp </a>";

                if (!$mail->send()) {
                    $msg = 'Désolé, quelque chose a mal tourné. Veuillez réessayer plus tard.';
                    Singleton_Logger::getInstance()->error('Erreur mail',[$_SERVER['REMOTE_ADDR'] ] );

                } else {
                    $msg = 'Message envoyé ! Merci de nous avoir contactés.';
                    Singleton_Logger::getInstance()->notice('mail OK',[$_SERVER['REMOTE_ADDR'] ] );

                }
            } else {
                $msg = 'Il doit manquer qqc !';
                Singleton_Logger::getInstance()->debug('mail incomplet',[$_SERVER['REMOTE_ADDR'] ] );

            }
        }
        else {
            $salarie = Salarie_Select_byMail($connexion, $_REQUEST["email"]);
            echo "salarie<br>";
            var_dump($salarie);
            if($salarie != null)
            {
                $jeton = Token_Ajouter($connexion, $salarie["idSalarie"],"Reset Salarie");
                $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->Host = '127.0.0.1';
                $mail->CharSet = "UTF-8";
                $mail->Port = 1025; //Port non crypté
                $mail->SMTPAuth = false; //Pas d’authentification
                $mail->SMTPAutoTLS = false; //Pas de certificat TLS
                $mail->setFrom('contact@labruleriecomtoise.fr', 'contact');
                $mail->addAddress($salarie["mail"], $salarie["nom"]." ".$salarie["prenom"]);
                if ($mail->addReplyTo('contact@labruleriecomtoise.fr', 'contact')) {
                    $mail->Subject = 'Objet : MDP !';
                    $mail->isHTML(true);
                    $mail->Body = "<a href='http://127.0.0.1:63342/cafe/index.php?token=".urlencode($jeton)."'>
                                Lien reinitialisation mdp </a>";

                    if (!$mail->send()) {
                        $msg = 'Désolé, quelque chose a mal tourné. Veuillez réessayer plus tard.';
                    } else {
                        $msg = 'Message envoyé ! Merci de nous avoir contactés.';
                    }
                } else {
                    $msg = 'Il doit manquer qqc !';
                }
            }
        }

        Vue_Structure_Entete();
        Vue_Mail_Confirme();
        Vue_Structure_BasDePage();
    }
    elseif(isset($_REQUEST["reinitmdp"]))
    {
        if(CSRF_Verifier())
        {         CSRF_Renouveler();      }
        else
        {        //Pas content !!!
            die("PAS BIEN !!!!");      }
        Vue_Structure_Entete();
        Vue_Mail_ReinitMdp();
        Vue_Structure_BasDePage();

    }
    elseif (isset($_REQUEST["compte"]) and isset($_REQUEST["password"]))
    {
        //Si tous les paramètres du formulaire sont bons


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
        }
        else {
            //On essaie de connecter un salarié

            $salarie = Salarie_Select_byMail($connexion, $_REQUEST["compte"]);
            // on regarde si l'entreprise existe, et si elle est activée
            if ($salarie != null and $salarie["actif"] == 1) {
                if (password_verify($_REQUEST["password"], $salarie["password"])) {//le mot de passe est associable à ce Hash
                    $_SESSION["idSalarie"] = $salarie["idSalarie"];
                    $_SESSION["idEntreprise"] = $salarie["idEntreprise"];
                    $_SESSION["typeConnexionBack"] = "entreprise_utilisateur";

                    if($salarie["bRGPD"] == 1)
                        {
                            Controleur_Catalogue_client();
                        }
                    else {
                        Controleur_ConcentementRGPD();
                    }

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