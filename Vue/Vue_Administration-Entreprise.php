<?php

function Vue_Entreprise_Client_Menu()
{

    echo "
<nav id='menu'>
  <ul id='menu-closed'>  
    <li><a href='?action=Gerer_Entreprise'>Compte d'entreprise</a></li> 
    
  </ul>
</nav> ";
}

function Vue_Entreprise_Salarie_Menu( $quantiteMenu = 0)
{

    echo "
<nav id='menu'>
  <ul id='menu-closed'>  
    <li><a href='?action=Gerer_catalogue'>Catalogue</a></li> 
    <li><a href='?action=Gerer_MonCompte_Salarie'>Mon compte</a></li> 
    <li><a href='?action=Gerer_Panier'>Panier";
    if($quantiteMenu > 0)
    {
        echo " ($quantiteMenu) ";
    }
    echo "</a></li>
    <li><a href='?action=Gerer_CommandeClient'>Mes commandes</a></li> 
  </ul>
</nav> ";
}
function Vue_Entreprise_Gerer_Compte($msg=""){
    echo " 
    <H1>Gestion du compte</H1>
    <table style='display: inline-block'>
        <tr>
            <td>
                <form style='display: contents'>
                    <input type='hidden' name='action' value='Gerer_Entreprise'>
                    <input type='submit' name='infoEntreprise' value='Les informations de l&apos;entreprise'>
                    <!--<button type='submit' name='changerMDP'>Changer mot de passe </button>-->
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <form style='display: contents'>
                    <input type='hidden' name='action' value='Gerer_Entreprise'>     
                
                    <input type='submit' name='salariesHabitites' value='Personnes habilitées'>
                    <!--<button type='submit' name='changerMDP'>Changer mot de passe </button>-->
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <form style='display: contents'>
                    <input type='hidden' name='action' value='Gerer_monCompte'>
                    <input type='submit' name='ChangerMDPEntreprise' value='Changer mot de passe'>
                    <!--<button type='submit' name='changerMDP'>Changer mot de passe </button>-->
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <form style='display: contents'>
                    <input type='hidden' name='action' value='Gerer_monCompte'>    
                
                    <input type='submit' name='deconnexionEntreprise' value='Se déconnecter'>
                    <!--<button type='submit' name='SeDeconnecter'>Se déconnecter </button>-->
                </form>
            </td>
        </tr>
    </table>
    
    ";

    echo $msg;
}

function Vue_Gestion_Entreprise_Information( $idEntreprise = "", $denomination = "", $rueAdresse = "", $complementAdresse = "", $codePostal = "", $ville = "", $pays = "France", $numCompte = "", $mailContact = "", $siret = "")
{
    // vous trouverez des explications sur les paramètres HTML5 des balises INPUT sur ce site :
    // https://darchevillepatrick.info/html/html_form.htm

        echo "<H1>Les informations de mon entreprise</H1>";
echo "<i>Pour tout changement, veuillez nous contacter.</i><br>";

    echo "
<table style='display: inline-block'> 

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
$denomination
            </td>
        </tr>
        <tr>
            <td>
                <label>Rue : </label>
            </td>
            <td>$rueAdresse
            </td>
        </tr>
        <tr>
            <td>
                <label>Rue (complément)  : </label>
            </td>
            <td>$complementAdresse</td>
        </tr>
        <tr>
            <td>
                <label>Code postal : </label>
            </td>
            <td>$codePostal
            </td>
        </tr>
        <tr>
            <td>
                <label>Ville : </label>
            </td>
            <td>$ville
            </td>
        </tr>
        
        <tr>
            <td>
                <label>Pays : </label>
            </td>
            <td>$pays
            </td>
        </tr>
        <tr>
            <td>
                <label>Couriel : </label>
            </td>
            <td>$mailContact
            </td>
        </tr>
        <tr>
            <td>
                <label>Siret (14 chiffres) </label>
            </td>
            <td>$siret
            </td>
        </tr>


</table>

";
}