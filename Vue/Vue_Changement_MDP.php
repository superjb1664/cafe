<?php
    function Vue_Affiche_Formulaire_Changement_MDP(){
        echo "
<table style='display: inline-block'> 
    <form method='post'>
        <h1>Changement Mot de passe</h1>
        <tr>
            <td>
                <label>Veuillez saisir votre ancien mot de passe : </label>
            </td>
            <td>
                <input type=\"password\" placeholder=\"mot de passe\" name=\"AncienPassword\" required>
            </td>
        </tr>
        <tr>
        
            <td>
                <label>Veuillez saisir votre nouveau mot de passe : </label>
            </td>
            <td>
    
                <input type=\"password\" placeholder=\"mot de passe\" name=\"NouveauPassword\" required>
            </td>
        </tr>
        <tr>
            <td>
                <label>Veuillez confirmer votre nouveau mot de passe : </label>
            </td>
            <td><input type=\"password\" placeholder=\"mot de passe\" name=\"ConfirmPassword\" required>
            </td>
        </tr>
        <tr>
            <td>
                <input type=\"submit\" id='submitModifMDP' name='submitModifMDP' value='Modifier son mot de passe' >
            </td>
     </tr>
</form>";

    }
