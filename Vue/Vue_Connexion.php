<?php
/**
 *
 */
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

            echo "</form>";
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
