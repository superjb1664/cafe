<?php


function Vue_Affiche_Panier_Client ($listeProduits, $pdf=false){
    echo " 
            <h1>Panier</h1>
                 ";

        //print_r($listeProduits);
    if(count($listeProduits) >= 1) {
        echo " <table style='padding: 20px; margin-bottom: 50px;   display: inline-block;   border: 1px solid #f1f1f1; box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24); background: #fff; ' >             
 <thead>
                    <tr>
                        <th colspan=2>Article</th>
                        <th>Categorie</th>
                        <th>Reference</th>
                        <th>Prix HT</th>
                        <th colspan='3'>Quantité</th>
                        <th >Total HT</th>
                        <th >Taux TVA</th>
                        <th >Montant TVA</th>
                        <th >Total TTC</th>
                        
                    
                    </tr>
                
                </thead>

 
             ";


        $totalHT = 0;
        $totalTVA = 0;
        $totalTTC = 0;
        foreach ($listeProduits as $produit) {



            // Si le produit a été activé par l'utilisateur, alors il s'affiche sur le catalogue client


            $path = "public/image/" . $produit["fichierImage"];

            echo "
            
                <tr>
                    <td>";
            if($pdf==false) echo"<img style='max-width: 50px; max-height: 50px; ' src='$path'>";
                    echo"</td>
                    <td >$produit[nom]</td>
                    <td  >$produit[libelleCat]</td>
                    <td  >$produit[idProduit]</td>
                    <td  > $produit[prixVenteHT] €  </td>";
            if($pdf==false) {
                echo "<td  >
                    
                        <form style='display: contents'>
                            <input type='hidden' name='idProduit' value='$produit[idProduit]'/>
                            <input type='submit' name='diminuerQTT' value ='-' style='width: auto'/>
                    
                        </form> 
                    </td>";
            }
                echo "<td style='text-align: center'>
                     $produit[quantite]   
                     </td>";

            if($pdf==false) {
                echo "<td>
                     <form style='display: contents'>
                        <input type='hidden' name='idProduit' value='$produit[idProduit]'>
                        <input type='submit' name='augmenterQTT' value ='+'  style='width: auto'>
                    </form>
                    </td>";
            }
                    echo "<td>";
                    $coutLigneHT =$produit["prixVenteHT"]*  $produit["quantite"]   ;
                    echo $coutLigneHT;
            $totalHT += $coutLigneHT;

                    echo " €</td>";
                    echo "<td>";

                            echo $produit["pourcentageTVA"];
                            echo " %
                    </td>
                    <td>";
                        $coutMontantTVA = $coutLigneHT * $produit["pourcentageTVA"]  ;
                        echo $coutMontantTVA;
            $totalTVA += $coutMontantTVA;

                        echo " €
                    </td>
                    <td>";
                        $coutTotalTTC =$coutMontantTVA + $coutLigneHT    ;
                        echo $coutTotalTTC ;
            $totalTTC += $coutTotalTTC;
                        echo " €
                    </td>
                </tr>  
                
               
            
            
        ";

        }
        echo "
            <tr>
                <td colspan='8' style='text-align: right'> <b>Total</b></td>
                <td > $totalHT € </td>
                <td ></td>
                <td > $totalTVA €</td>
                <td > $totalTTC €</td>
            
            </tr>
            <tr>
                <td colspan='12' style='text-align: center'>
                    <form style='display: contents'>
                        <input type='hidden' name='idProduit' value='$produit[idProduit]'>
                        <input type='submit' name='validerPanier' value ='VALIDER CETTE COMMANDE'  style='width: auto'>
                    </form>
                </td>
            </tr>
        </table>";

    }
    else {
        echo "<h3>Panier vide !</h3>";
    }
}

function Facture_EnteteBrulerie($infoCommande,$infoentreprise)
{
    echo"

<table style='width: 100%'>
<tr>
<td  style='text-align: left; width: 50%'> 
   <H1>La brulerie comtoise</H1>
    15 grande rue<br>
    39100 DOLE<br>
    </td>
<td  style='text-align: right; width: 50%'> $infoCommande[dateCreation]    </td>
</tr>
<tr>
<td  style='text-align: left; width: 50%'> </td>
<td  style='text-align: right; width: 50%'>   
<h1>$infoentreprise[denomination]</h1>
  $infoentreprise[rueAdresse]<br> 
  $infoentreprise[complementAdresse]<br>
  
  $infoentreprise[codePostal]   $infoentreprise[ville]<br>
  $infoentreprise[pays]<br>
  </td>
</tr>
</table>
    
    
    <h3 align='center'>Commande n°$infoCommande[id]</h3>
    
    ";
}

function Facture_BasPageBrulerie($infoCommande,$infoentreprise)
{
    echo"
    <H3 align='right'>Nous vous remercions pour votre commande.</H3>
    <br>
    <br>
    <h4 align='center'>Votre commande sera validée à la reception de votre virement dans un délai de 30 jours. 
    <br>Référence de virement: Brulerie_$infoentreprise[numCompte]_$infoCommande[id]</h4>
    
    ";
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
                        <th colspan=2>Article</th>
                        <th>Categorie</th>
                        <th>Reference</th>
                        <th>Prix HT</th>
                        <th colspan='3'>Quantité</th>
                        <th >Total HT</th>
                        <th >Taux TVA</th>
                        <th >Montant TVA</th>
                        <th >Total TTC</th>
                        
                    
                    </tr>
                
                </thead>

 
             ";


        $totalHT = 0;
        $totalTVA = 0;
        $totalTTC = 0;
        foreach ($listeProduits as $produit) {


            // Si le produit a été activé par l'utilisateur, alors il s'affiche sur le catalogue client


            $path = "public/image/" . $produit["fichierImage"];

            echo "
            
                <tr>
                    <td>";
            if ($pdf == false) echo "<img style='max-width: 50px; max-height: 50px; ' src='$path'>";
            echo "</td>
                    <td >$produit[nom]</td>
                    <td  >$produit[libelleCat]</td>
                    <td  >$produit[idProduit]</td>
                    <td  > $produit[prixVenteHT] €  </td>";
            if ($pdf == false) {
                echo "<td  >
                    
                        <form style='display: contents'>
                            <input type='hidden' name='idProduit' value='$produit[idProduit]'/>
                            <input type='submit' name='diminuerQTT' value ='-' style='width: auto'/>
                    
                        </form> 
                    </td>";
            }
            echo "<td style='text-align: center'>
                     $produit[quantite]   
                     </td>";

            if ($pdf == false) {
                echo "<td>
                     <form style='display: contents'>
                        <input type='hidden' name='idProduit' value='$produit[idProduit]'>
                        <input type='submit' name='augmenterQTT' value ='+'  style='width: auto'>
                    </form>
                    </td>";
            }
            echo "<td>";
            $coutLigneHT = $produit["prixVenteHT"] * $produit["quantite"];
            echo $coutLigneHT;
            $totalHT += $coutLigneHT;

            echo " €</td>";
            echo "<td>";

            echo $produit["pourcentageTVA"];
            echo " %
                    </td>
                    <td>";
            $coutMontantTVA = $coutLigneHT * $produit["pourcentageTVA"];
            echo $coutMontantTVA;
            $totalTVA += $coutMontantTVA;

            echo " €
                    </td>
                    <td>";
            $coutTotalTTC = $coutMontantTVA + $coutLigneHT;
            echo $coutTotalTTC;
            $totalTTC += $coutTotalTTC;
            echo " €
                    </td>
                </tr>  
                
               
            
            
        ";
        }
}