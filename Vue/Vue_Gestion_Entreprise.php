<?php

/**
 * Affiche la liste des entreprises
 * @param $listeEntreprise
 */
function Vue_Gestion_Entreprise_Liste($listeEntreprise, $niveauAutorisation)
{
    echo '
<H1>Liste des entreprises partenaires</H1>

    <table style="    display: inline-block;">
         <tr>
            <td colspan="5" style="text-align: center">
                <form style=\'display: contents\'>
                    <input type="hidden" name="action" value="Gerer_entreprisesPartenaires">
 
                        <button type=\'submit\' onmouseover=\"this.style.background=\'#FFFF99\';this.style.color=\'#FF0000\';\"
                     onmouseout=\"this.style.background=\'\';this.style.color=\'\';\" name=\'nouveau\'> Nouvelle entreprise ? </button>
                </form>
            </td>
 
        </tr>
        <tr>
            <th>Num compte</th>
            <th>Dénomination</th>
            <th>Ville</th>
        </tr>';

    $i = 0;
    while ($i < count($listeEntreprise)) {
        $iemeEntreprise = $listeEntreprise[$i];

        echo "
           
            
        <tr >
            <td>$iemeEntreprise[numCompte]</td>
            <td>$iemeEntreprise[denomination]</td>
            <td>$iemeEntreprise[codePostal] - $iemeEntreprise[ville]</td>
            ";
        //Seuls les utilisateurs de niveau d'autorisation 1 et 2 peuvent gérer les entreprises
        if ($_SESSION['niveauAutorisation'] < 3) {

            echo "
                <td>
                    <form style='display: contents'>
                        <input type='hidden' name='action' value='Gerer_entreprisesPartenaires'>
                            <input type='hidden' value='$iemeEntreprise[idEntreprise]' name='idEntreprise'>
                            <button type='submit' onmouseover=\"this.style.background='#FFFF99';this.style.color='#FF0000';\"
                         onmouseout=\"this.style.background='';this.style.color='';\" name='Modifer'> Modifier </button>
                    </form>
                </td>
                <!-- Création du bouton Désactiver ou Activer-->
                ";
            switch ($iemeEntreprise["desactiver"]) {
                case 0:
                    echo "
                <td>
                    <form style='display: contents'>
                        <input type='hidden' name='action' value='Gerer_entreprisesPartenaires'>
                            <input type='hidden' value='$iemeEntreprise[idEntreprise]' name='idEntreprise'>
                            <button type='submit' onmouseover=\"this.style.background= '#FFFF99';this.style.color= '#FF0000';\"
                         onmouseout=\"this.style.background = '';this.style.color='';\"name='DesactiverEntreprise'> Désactiver </button>
                    </form>
                </td>
            </tr>
            
             ";
                    break;
                case 1:
                    echo "
                <td>
                    <form style='display: contents'>
                            <input type='hidden' name='action' value='Gerer_entreprisesPartenaires'>
                            <input type='hidden' value='$iemeEntreprise[idEntreprise]' name='idEntreprise'>
                            <button type='submit' onmouseover=\"this.style.background ='#FFFF99';this.style.color= '#FF0000';\"
                         onmouseout=\"this.style.background='';this.style.color='';\"name='ActiverEntreprise'> Activer </button>
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

/**
 * Affiche le formulaire de création/mise à jour d'une entreprise. Les valeurs proposées seront celles données aux values des différents input.
 * @param bool $modeCreation A true si le formulaire est utiliser pour créer une entreprise, False : en mise à jour, tous les attributs doivent être paramétrés
 * @param string $idEntreprise
 * @param string $denomination
 * @param string $rueAdresse
 * @param string $complementAdresse
 * @param string $codePostal
 * @param string $ville
 * @param string $pays
 * @param string $numCompte
 * @param string $mailContact
 * @param string $siret
 */
function Vue_Gestion_Entreprise_Formulaire($modeCreation = true, $idEntreprise = "", $denomination = "", $rueAdresse = "", $complementAdresse = "", $codePostal = "", $ville = "", $pays = "France", $numCompte = "", $mailContact = "", $siret = "")
{
    // vous trouverez des explications sur les paramètres HTML5 des balises INPUT sur ce site :
    // https://darchevillepatrick.info/html/html_form.htm
    if ($modeCreation)
        echo "<H1>Création d'un nouveau client Entreprise</H1>";
    else
        echo "<H1>Edition d'une entreprise</H1>";

    echo "
<table style='display: inline-block'> 
    <form>
        <input type='hidden' name='action' value='Gerer_entreprisesPartenaires'>
        <input type='hidden' name='idEntreprise' value='$idEntreprise'>
        <tr>
            <td>
                <label>Numéro de compte : </label>
            </td>
            <td>
                $numCompte
            </td>
        </tr>
        <tr>
        
            <td>
                <label>Dénomination (en lettres majuscules) : </label>
            </td>
            <td>
    
                <input type='text' required name='denomination'
                       pattern='[A-z\ ]{0,30}' placeholder='lettres et espace' autofocus value='$denomination'>
            </td>
        </tr>
        <tr>
            <td>
                <label>Rue : </label>
            </td>
            <td><input type='text' required
                       placeholder='Rue' name='rueAdresse' value='$rueAdresse'>
            </td>
        </tr>
        <tr>
            <td>
                <label>Rue (complément)  : </label>
            </td>
            <td><input type='text' optional placeholder='Complément' name='complementAdresse' value='$complementAdresse'>
        </tr>
        <tr>
            <td>
                <label>Code postal : </label>
            </td>
            <td><input type='text' required
                         placeholder='Code postal/cedex' maxlength='10' name='codePostal' value='$codePostal'>
            </td>
        </tr>
        <tr>
            <td>
                <label>Ville : </label>
            </td>
            <td>
    
                <input type='text' required
                       pattern='[A-z\ ]{2,30}' placeholder='ville' autofocus name='ville' value='$ville'>
            </td>
        </tr>
        
        <tr>
            <td>
                <label>Pays : </label>
            </td>
            <td>
    
                <input type='text' required
                       pattern='[A-z\ ]{2,30}' placeholder='pays' autofocus value='$pays' name='pays'>
            </td>
        </tr>
        
         
        
        <!--tr>
            <td>
                <label>Téléphone : </label>
            </td>
            <td><input type='tel' required
                       pattern='[0-9]{10}' placeholder='dix chiffres' maxlength='10' value=''>
            </td>
        </tr-->
        <tr>
            <td>
                <label>Couriel : </label>
            </td>
            <td><input type='email' required value='$mailContact' name='mailContact'
                       placeholder='____@___ .___'>
            </td>
        </tr>
        <tr>
            <td>
                <label>Siret (14 chiffres) </label>
            </td>
            <td><input type='text' pattern='[0-9]{14}' name='siret' value='$siret' required>
            </td>
        </tr>
        <tr>";
    if ($modeCreation) {
        echo " 
                
            <td colspan='2' style='text-align: center'>
                <button type='submit' name='buttonCreer'>Créer ce client</button>";
    } else {
        echo "<td>
                <button type='submit' name='réinitialiserMDP'>Réinitialiser le mot de passe</button>
            </td>
            <td>
                <button type='submit' name='mettreAJour'>Mettre à jour</button>";
    }

    echo "</td>
        </tr>

    </form>
</table>

";
}

