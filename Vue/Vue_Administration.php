<?php
function Vue_Administration_Menu( )
{

    echo "
 


<nav id='menu'>
  <ul id='menu-closed'> 
  <li><a href='Gerer_entreprisesPartenaires.php'>Entreprises partenaires</a></li>
  <li><a href='Gerer_utilisateur.php'>Utilisateurs</a></li>
  <li><a href='Gerer_catalogue.php'>Catalogue</a></li>   
   <li><a href='Gerer_monCompte.php'>Mon compte</a></li> 
   
   </ul>
</nav> ";
}

function Vue_Administration_Gerer_Compte(){
    echo " 
    <H1>Gérer mon compte</H1>
    <table style='display: inline-block'>
        <tr>
            <td>
                <form style='display: contents'>
                    <button type='submit' name='changerMDP'>Changer mot de passe </button>
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <form style='display: contents'>
                    <button type='submit' name='SeDeconnecter'>Se déconnecter </button>
                </form>
            </td>
        </tr>
    </table>
    
    ";
}