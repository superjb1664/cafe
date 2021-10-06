<?php


function Vue_Salarie_Liste($listeSalarie)
{

    echo '
<H1>Liste des salariés habilités à passer des commandes</H1>

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
            <th>Actif</th>
        </tr>';

    foreach ($listeSalarie as $salarie) {
        echo "
           
            
        <tr >
            <td>$salarie[nom]</td>
            <td>$salarie[prenom]</td>
            <td>$salarie[role]</td>
            <td>";
        if ($salarie["actif"])
            echo "Oui";
        else
            echo "Non";
        echo "</td>";


        echo "
                <td>
                    <form style='display: contents'>
                        <input type='hidden' name='action' value='Gerer_entreprisesPartenaires'>
                            <input type='hidden' value='$salarie[idSalarie]' name='idSalarie'>
                            <button type='submit' onmouseover=\"this.style.background='#FFFF99';this.style.color='#FF0000';\"
                         onmouseout=\"this.style.background='';this.style.color='';\" name='Modifer'> Modifier </button>
                    </form>
                </td>
                <!-- Création du bouton Désactiver ou Activer-->
                ";

        switch ($salarie["actif"]) {
            case 0:
                echo "
                <td>
                    <form style='display: contents'>
                        <input type='hidden' name='action' value='Gerer_entreprisesPartenaires'>
                            <input type='hidden' value='$salarie[idSalarie]' name='idSalarie'>
                            <button type='submit' onmouseover=\"this.style.background= '#FFFF99';this.style.color= '#FF0000';\"
                         onmouseout=\"this.style.background = '';this.style.color='';\"name='DesactiverEntreprise'> Désactiver </button>
                    </form>
                </td>";
                break;
            case 1:
                echo "
                <td>
                    <form style='display: contents'>
                            <input type='hidden' name='action' value='Gerer_entreprisesPartenaires'>
                            <input type='hidden' value='$salarie[idSalarie]' name='idSalarie'>
                            <button type='submit' onmouseover=\"this.style.background ='#FFFF99';this.style.color= '#FF0000';\"
                         onmouseout=\"this.style.background='';this.style.color='';\"name='ActiverEntreprise'> Activer </button>
                    </form>
                </td>";
                break;
        }
        echo "</tr>";

    }


    echo "</table>";

}