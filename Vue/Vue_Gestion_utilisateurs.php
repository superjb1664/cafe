<?php




function Vue_Gestion_Utilisateur_Liste($listeUtilisateur)
{
    echo '
<H1>Liste des utilisateurs</H1>

    <table style="    display: inline-block;">
         <tr>
            <td colspan="6" style="text-align: center"><form style=\'display: contents\'>
 
                        <button type=\'submit\' onmouseover=\"this.style.background=\'#FFFF99\';this.style.color=\'#FF0000\';\"
                     onmouseout=\"this.style.background=\'\';this.style.color=\'\';\" name=\'nouveau\'> Nouvel utilisateur ? </button>
                </form>
            </td>
 
        </tr>
        <tr>
            <th>Num utilisateur</th>
            <th>Login</th>
            <th>Niveau d\'autorisation </th>
        </tr>';

    $i = 0;
    while ($i < count($listeUtilisateur)) {
        $iemeUtilisateur = $listeUtilisateur[$i];

        echo "
           
            
        <tr >
            <td>$iemeUtilisateur[idUtilisateur]</td>
            <td>$iemeUtilisateur[login]</td>
            <td>$iemeUtilisateur[niveauAutorisation]</td> 
            <!-- Création du bouton Modifier -->
            <td>
            ";
        // seul un admin niveau d'autorisation à 1, peut gérer tout sur le site
        if ($_SESSION['niveauAutorisation'] == 1) {
            echo "
                <form style='display: contents'>
                        <input type='hidden' value='$iemeUtilisateur[idUtilisateur]' name='idUtilisateur'>
                        <button type='submit' onmouseover=\"this.style.background='#FFFF99';this.style.color='#FF0000';\"
                     onmouseout=\"this.style.background='';this.style.color='';\" name='ModifierUtilisateur'> Modifier </button>
                </form>
            </td>
            <!-- Création du bouton Désactiver -->
            ";
            switch ($iemeUtilisateur["desactiver"]) {
                case 0:
                    echo "
            <td>
                <form style='display: contents'>
                        <input type='hidden' value='$iemeUtilisateur[idUtilisateur]' name='idUtilisateur'>
                        <button type='submit' onmouseover=\"this.style.background='#FFFF99';this.style.color='#FF0000';\"
                     onmouseout=\"this.style.background='';this.style.color='';\"name='DesactiverUtilisateur'> Désactiver </button>
                </form>
            </td>
        </tr>
        
         ";
                    break;
                case 1:
                    echo "
            <td>
                <form style='display: contents'>
                        <input type='hidden' value='$iemeUtilisateur[idUtilisateur]' name='idUtilisateur'>
                        <button type='submit' onmouseover=\"this.style.background='#FFFF99';this.style.color='#FF0000';\"
                     onmouseout=\"this.style.background='';this.style.color='';\"name='ActiverUtilisateur'> Activer </button>
                </form>
            </td>
        </tr>
        
         ";
                    break;
            }
        }
        $i++;
    }
    echo "
</table>";

}


function Vue_Gestion_Utilisateur_Formulaire($modeCreation = true, $idUtilisateur = "", $login = "", $niveauAutorisation = "")
{
    // vous trouverez des explications sur les paramètres HTML5 des balises INPUT sur ce site :
    // https://darchevillepatrick.info/html/html_form.htm
    if ($modeCreation)
        echo "<H1>Création d'un nouvel utilisateur</H1>";
    else
        echo "<H1>Edition d'un utilisateur</H1>";

    echo "
<table style='display: inline-block'> 
    <form method='get'>
        <input type='hidden' name='idUtilisateur' value='$idUtilisateur'>
        <tr>
            <td>
                <label>Numéro d'utilisateur : </label>
            </td>
            <td>
                $idUtilisateur
            </td>
        </tr>
        <tr>
        
            <td>
                <label>Login : </label>
            </td>
            <td>
    
                <input type='text' required name='login'
                       pattern='[A-z\ ]{0,30}' placeholder='login' autofocus value='$login'>
            </td>
        </tr>
        <tr>
            <td>
                <label>Niveau d'autorisation : </label>
            </td>
            <td>
                <select name='niveauAutorisation'>
                    <option value='1' ".($niveauAutorisation == 1 ? "selected" : "") .">1</option>
                    <option value='2' ".($niveauAutorisation == 2 ? "selected" : "") .">2</option>
                    <option value='3' ".(($niveauAutorisation == 3 OR $niveauAutorisation == "") ? "selected" : "") .">3</option>
                </select>
            </td>
        </tr>
        ";
    if ($modeCreation) {
        echo " 
                
            <td colspan='2' style='text-align: center'>
                <button type='submit' name='buttonCreerUtilisateur'>Créer ce client</button>";
    } else {
        echo "<td>
                <button type='submit' name='réinitialiserMDPUtilisateur'>Réinitialiser le mot de passe</button>
            </td>
            <td>
                <button type='submit' name='mettreAJourUtilisateur'>Mettre à jour</button>";
    }

    echo "</td>
        </tr>

    </form>
</table>

";
}