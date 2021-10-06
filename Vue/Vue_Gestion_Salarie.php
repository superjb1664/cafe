<?php
function Vue_Salarie_Editer($ajouter = true, $idSalarie = "", $nom="", $prenom = "", $role="", $mail="")
{
    echo '<H1>Ajout d\'un salarié habilité</H1>';

    echo "
<table style='display: inline-block'> 
    <form method='get'>
        <input type='hidden' name='action' value='Gerer_Entreprise'>
        <input type='hidden' name='idSalarie' value='$idSalarie'>
        <tr>
            <td>
                <label>Nom : </label>
            </td>
            <td>
                <input type='text' required name='nom'
                       pattern='[A-z\ ]{0,30}' placeholder='Nom' autofocus value='$nom'>
            </td>
        </tr>
        <tr>
            <td>
                <label>Prénom : </label>
            </td>
            <td>
                <input type='text' required name='prenom'
                       pattern='[A-z\ ]{0,30}' placeholder='Prénom' autofocus value='$prenom'>
            </td>
        </tr>
        <tr>
            <td>
                <label>Fonction : </label>
            </td>
            <td>
                <input type='text' required name='role'
                       pattern='[A-z\ ]{0,30}' placeholder='Fonction dans l\'entreprise' autofocus value='$role'>
            </td>
        </tr>
        <tr>
            <td>
                <label>Mail : </label>
            </td>
            <td>
                <input type='email' required value='$mail' name='mailContact' placeholder='____@___ .___'>
            </td>
        </tr>

        ";
    if ($ajouter) {
        echo " 
                
            <td colspan='2' style='text-align: center'>
                <button type='submit' name='buttonCreerSalarie'>Ajouter</button>";
    } else {
        echo "<td>
                <button type='submit' name='réinitialiserMDPSalarie'>Réinitialiser le mot de passe</button>
            </td>
            <td>
                <button type='submit' name='ModiferSalarieValider'>Mettre à jour</button>";
    }
    echo "</td>
        </tr>
    </form>
</table>

";
}

function Vue_Salarie_Liste($listeSalarie, $msg="")
{

    echo '
<H1>Liste des personnes habilitées à passer des commandes</H1>
<br>
Seuls les personnes habilitées peuvent passer des commandes au nom de votre entreprise. <br>
Ce compte d\'entreprise ne permet pas de passer des commandes.
<br>
Les salariés se connecteront avec leur e-mail<br>
    <table style="    display: inline-block;">
         <tr>
            <td colspan="5" style="text-align: center">
                <form style=\'display: contents\'>
                    <input type="hidden" name="action" value="Gerer_entrprise">
 
                        <button type=\'submit\' onmouseover=\"this.style.background=\'#FFFF99\';this.style.color=\'#FF0000\';\"
                     onmouseout=\"this.style.background=\'\';this.style.color=\'\';\" name=\'ajouterSalarie\'> Ajouter un salarié </button>
                </form>
            </td>
 
        </tr>';
    if (count($listeSalarie) <= 0) {
        echo '

         <tr>
            <td colspan="5" style="text-align: center">
                Il n\'y pas encore de salarié. Vous devez en ajouter un.
            </td>

        </tr>';

    } else
        echo '<tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Rôle</th>
         
         
        </tr>';

    foreach ($listeSalarie as $salarie) {
        echo "
           
            
        <tr >
            <td>$salarie[nom]</td>
            <td>$salarie[prenom]</td>
            <td>$salarie[roleEntreprise]</td>
            ";
       /* if ($salarie["actif"])
            echo "Oui";
        else
            echo "Non";
        echo "</td>";
*/

        echo "
                <td>
                    <form style='display: contents'>
                        <input type='hidden' name='action' value='Gerer_entreprisesPartenaires'>
                            <input type='hidden' value='$salarie[idSalarie]' name='idSalarie'>
                            <button type='submit' onmouseover=\"this.style.background='#FFFF99';this.style.color='#FF0000';\"
                         onmouseout=\"this.style.background='';this.style.color='';\" name='ModiferSalarie'> Modifier </button>
                    </form>
                </td>
                <!-- Création du bouton Désactiver ou Activer-->
                ";

        switch ($salarie["actif"]) {
            case 0:
                echo "
                <td>
                    <form style='display: contents'>
                        <input type='hidden' name='action' value='Gerer_Entreprise'>
                            <input type='hidden' value='$salarie[idSalarie]' name='idSalarie'>
                            <button type='submit' onmouseover=\"this.style.background= '#FFFF99';this.style.color= '#FF0000';\"
                         onmouseout=\"this.style.background = '';this.style.color='';\"name='DesactiverSalarie'> Désactiver </button>
                    </form>
                </td>";
                break;
            case 1:
                echo "
                <td>
                    <form style='display: contents'>
                            <input type='hidden' name='action' value='Gerer_Entreprise'>
                            <input type='hidden' value='$salarie[idSalarie]' name='idSalarie'>
                            <button type='submit' onmouseover=\"this.style.background ='#FFFF99';this.style.color= '#FF0000';\"
                         onmouseout=\"this.style.background='';this.style.color='';\"name='ActiverSalarie'> Activer </button>
                    </form>
                </td>";
                break;
        }
        echo "</tr>";

    }


    echo "</table>";
    echo $msg;
}