<?php
function Vue_Entreprise_Client_Menu( $quantiteMenu = 0)
{

    echo "
<nav id='menu'>
  <ul id='menu-closed'>  
    <li><a href='Catalogue_client.php'>Catalogue</a></li> 
    <li><a href='Gerer_compteClient.php'>Mon compte</a></li> 
    <li><a href='Gerer_Panier.php'>Panier";
    if($quantiteMenu > 0)
    {
        echo " ($quantiteMenu) ";
    }
    echo "</a></li>
    <li><a href='Gerer_CommandeClient.php'>Mes commandes</a></li> 
  </ul>
</nav> ";
}
function Vue_Entreprise_Gerer_Compte(){
    echo " 
    <H1>Gérer mon compte</H1>
    <table style='display: inline-block'>
        <tr>
            <td>
                <form style='display: contents'>
                    <input type='submit' name='infoEntreprise' value='Les informations de l&apos;entreprise'>
                    <!--<button type='submit' name='changerMDP'>Changer mot de passe </button>-->
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <form style='display: contents'>
                    <input type='submit' name='ChangerMDPEntreprise' value='Changer mot de passe'>
                    <!--<button type='submit' name='changerMDP'>Changer mot de passe </button>-->
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <form style='display: contents'>
                    <input type='submit' name='deconnexionEntreprise' value='Se déconnecter'>
                    <!--<button type='submit' name='SeDeconnecter'>Se déconnecter </button>-->
                </form>
            </td>
        </tr>
    </table>
    
    ";
}
