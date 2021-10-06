<?php
function Vue_Administration_Menu( )
{

    echo "
 


<nav id='menu'>
  <ul id='menu-closed'> 
  <li><a href='?action=Gerer_entreprisesPartenaires'>Entreprises partenaires</a></li>
  <li><a href='?action=Gerer_utilisateur'>Utilisateurs</a></li>
  <li><a href='?action=Gerer_catalogue'>Catalogue</a></li>   
  <li><a href='?action=Gerer_Commande'>Commandes</a></li>
  <li><a href='?action=Gerer_monCompte'>Mon compte</a></li> 
  
   
   </ul>
</nav> ";
}

function Vue_Administration_Gerer_Compte($msg="", $action="Gerer_monCompte"){
    echo " 
    <H1>Gérer mon compte</H1>
    <table style='display: inline-block'>
        <tr>
            <td>
                <form style='display: contents'>
                     <input type='hidden' name='action' value='$action'>
                    <button type='submit' name='changerMDP'>Changer mot de passe </button>
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <form style='display: contents'>
                    <input type='hidden' name='action' value='$action'>
                    <button type='submit' name='SeDeconnecter'>Se déconnecter </button>
                </form>
            </td>
        </tr>
    </table>
    
    ";
    echo $msg;
}