<?php

function Vue_Affiche_Etat_Commande($listeEtatCommande)
{
    $i = 0;
    echo "<nav id='etatCommande'>
                <ul id='menu-closed'>
                ";
    /*else {
        echo "<form style='display: contents'>
            <li><input type='submit' name='ToutLeCatalogue' value='Catalogue'> </li>
            </form>";
    }*/

    echo "
                <form style='display: contents'> 
                    <input type='hidden' name='action' value='Gerer_Commande'>
                    <li><input type='submit' name='Toute' value='Toutes'> </li>
                </form>";

    while ($i < count($listeEtatCommande)) {
        $iemeEtatCommande = $listeEtatCommande[$i];

            echo "
                   <li>
                        <form style='display: contents'> 
                            <input type='hidden' name='action' value='Gerer_Commande'>
                            <input type='hidden' name='idEtatCommande' value='$iemeEtatCommande[idEtatCommande]'>
                            <input type=\"submit\" name='boutonCategorie' value=\"$iemeEtatCommande[libelle]\">
                        </form>
                   </li> 
                   ";

        $i++;
    }
    echo "
                <form style='display: contents'> 
                    <input type='hidden' name='action' value='Gerer_Commande'>
                    <li><input type='text' name='recherche' placeholder='Rechercher'> </li>
                    <li><input type='submit' name='okRechercher' value='OK'> </li>
                </form>";
    echo "
            </ul>
            </nav>";
}

function Vue_Afficher_Commande_Entreprise($listeCommande)
{
    echo " 
            <h1>Commandes</h1>
                 ";

    //print_r($listeProduits);
    if(count($listeCommande) >= 1) {
        echo " <table style='padding: 20px; margin-bottom: 50px;   display: inline-block;   border: 1px solid #f1f1f1; box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24); background: #fff; ' >             
 <thead>
                    <tr>
                        <th>Reference Commande</th>
                        <th>Date commande</th>
                        <th>Client</th>
                        <th >Nb d'articles</th>
                        <th >Total HT</th>
                        <th >Montant TVA</th>
                        <th >Total TTC</th>
                        
                        <th>Etat</th>
                    
                    </tr>
                
                </thead>

 
             ";

        //var_dump($listeCommande);
        foreach ($listeCommande as $item) {

            $montantTVA = $item["prixTotalTTC"] -$item["prixTotalHT"] ;
            echo"
            <tr style='text-align: center;font-size: '>
                        <td>$item[id]</td>
                        <td >$item[dateCreation]</td>
                        
                        <td >$item[nbProduit]</td>
                        <td >".number_format($item["prixTotalHT"],2)." €</td>
                        <td >".number_format($montantTVA,2)." €</td>
                        <td >".number_format($item["prixTotalTTC"],2)." €</td>
                        <td >$item[libEtat]</td>
                        <td >
                            <form style='display: contents'>
                                <input type='hidden' name='idCommande' value='$item[id]'/>
                                <input type='submit' name='VoirDetailCommande' value='Voir'/>
                            
                            </form>
                        </td>
                    </tr>
            ";

        }


    }
}