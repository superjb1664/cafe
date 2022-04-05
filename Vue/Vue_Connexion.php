<?php
/**
 *
 */

function Vue_Mail_Confirme()
{
    echo "<H1>Un mail de réinitialisation de votre mot de passe vous a été adressé !</H1> ";
    echo CSRF_GenereChamp();
    echo "
</form>
    ";
}

function Vue_Mail_ChoisirNouveauMdp($token)
{
    echo "  <form action='index.php' method='post' style='    width: 50%;    display: block;    margin: auto;'>
                <h1>Choisissez votre nouveau mdp</h1>
                <input type='hidden' name='token' value='$token'>
                <label><b>Compte</b></label>
                <input type=\"password\" placeholder=\"nouveau mdp\" name=\"mdp1\" required>
                <input type=\"password\" placeholder=\"confirme nouveau mdp\" name=\"mdp2\" required>

                <input type=\"submit\" id='submit' name='choixmdp' value='Confirmer le mdp' >
            </form>
    ";
}

function Vue_Mail_ReinitMdp()
{
    echo "  <form action='index.php' method='post' style='    width: 50%;    display: block;    margin: auto;'>
                <h1>Mail à renouveler</h1>
                
                <label><b>Compte</b></label>
                <input type=\"email\" placeholder=\"mail du compte à renouveler le mdp\" name=\"email\" required>

                <input type=\"submit\" id='submit' name='reinitmdpconfirm' value='Renouveler mdp' >";

    echo CSRF_GenereChamp();
    echo "
</form>
    ";
}
function Vue_Connexion_Formulaire_connexion_entreprise($msgErreur = "")
{
    echo "  <form action='index.php' method='post' style='    width: 50%;    display: block;    margin: auto;'>
                <h1>Connexion</h1>
                
                <label><b>Compte</b></label>
                <input type=\"text\" placeholder=\"identifiant du compte\" name=\"compte\" required>

                <label><b>Mot de passe</b></label>
                <input type=\"password\" placeholder=\"mot de passe\" name=\"password\" required>

                <input type=\"submit\" id='submit' value='Se connecter' >";
    if($msgErreur != "")
    {
        echo " <label><b>Erreur : $msgErreur</b></label>";
    }
    echo CSRF_GenereChamp();
    echo "

</form>
<form>
<input type=\"submit\" id='submit' name='reinitmdp' value='Réinitialiser le mdp' >
";
    echo CSRF_GenereChamp();
    echo"
</form>
    ";



}

function Vue_Connexion_Formulaire_connexion_administration($msgErreur = "")
{
    echo "  <form  method='post' style='    width: 50%;    display: block;    margin: auto;'>
                <h1>Adminsitration : Connexion</h1>
                
                <label><b>Identifiant de connexion </b></label>
                <input type=\"text\" placeholder=\"login\" name=\"login\" required>

                <label><b>Mot de passe</b></label>
                <input type=\"password\" placeholder=\"mot de passe\" name=\"password\" required>

                <input type=\"submit\" id='submit' value='Se connecter' >";
    if($msgErreur != "")
    {
        echo " <label><b>Erreur : $msgErreur</b></label>";
    }

    echo "</form>";
}
