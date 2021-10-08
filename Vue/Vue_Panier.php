<?php
function Vue_Action_Sur_Commande_Client($infoCommande)
{
    echo "<H1>Action(s) sur cette commande</H1>
    <form>
        <input type='hidden' name='action' value='Gerer_CommandeClient' >
        <input type='hidden' name='changementEtatCommande' >
        <input type='hidden' name='idCommande' value='$infoCommande[id]' >
";
    switch ($infoCommande["etat"]) {
        case 2:
            echo "
                  Nous attendons la réception du paiement.'
                ";
            break;
        case 3:
            echo "Nous avons reçu votre paiement. . Info sur le virement : $infoCommande[infoComplementaire]. 
            ";
            break;
        case 4:
            echo "La commande a été envoyée. Info sur le colis : $infoCommande[infoComplementaire]. ";
            break;

        case 5:
            echo "
                Nous avons un problème de stock. Info  : $infoCommande[infoComplementaire].               ";
            break;
        case 6:
            echo " 
 <input type='submit' name='Signalee_CommandeReceptionnee' value='Commande réceptionnée sans incident'><br>
 <input type='submit' name='Signalee_CommandeReceptionneeIncident' value='Commande réceptionnée avec incident'>
                  <br>
                  <label>Informations complémentaires</label>
                  <input type='text' placeholder='info sur la livraison' value='info' style='width: 400px;height: 80px'>";
            break;
        case 7 : echo "La commande a été indiquée comme reçue correctement. Nous vous remercions pour votre confiance.";
        case 8 : echo "La commande a été indiquée comme ayant eu un incident :$infoCommande[infoComplementaire]. Nous recherchons une solution. Nous vous remercions pour votre confiance.";


    }

    echo " </form > ";

}

function Vue_Action_Sur_Commande_Entreprise($infoCommande)
{
    echo "<H1>Action(s) sur cette commande</H1>
    <form>
        <input type='hidden' name='action' value='Gerer_CommandeClient' >
        <input type='hidden' name='changementEtatCommande' >
        <input type='hidden' name='idCommande' value='$infoCommande[id]' >
";
    switch ($infoCommande["etat"]) {
        case 2:
            echo "
                  <input type='submit' name='Signalee_CommandePayee' value='Commande payée, virement reçu'>
                  <br>
                  <label>Informations complémentaires</label>
                  <input type='text' placeholder='numéro transaction' value='info' style='width: 400px;height: 80px'>
                ";
            break;
        case 3:
            echo "
                <input type='submit' name='Signalee_CommandeEnPreparation' value='Commande en préparation (QTT OK)'>               <br>
                <br>
                <input type='submit' name='Signalee_CommandeProblemeStock' value='Commande en attente approvisionnement (QTT Pas OK)'>
                <br>
                  <label>Informations complémentaires</label>
                  <input type='text' placeholder='Estimation réassort' value='info' style='width: 400px;height: 80px'>
            ";
            break;
        case 4:
            echo "
                <input type='submit' name='Signalee_CommandeEnvoyée' value='Commande expédiée'>               
                <br>
                  <label>Informations complémentaires</label>
                  <input type='text' placeholder='Numero de colis' value='info' style='width: 400px;height: 80px'>";
            break;

        case 5:
            echo "
                <input type='submit' name='Signalee_CommandeEnPreparation' value='Réassort arrivé'>               ";
            break;
        case 6:
            echo "Commande expédiée, nous sommes en attente de la réponse du client";
            break;


    }

    echo " </form > ";

}

function Vue_Afficher_Button_Facture($idCommande)
{
    echo"<form style = 'display: contents' >
                        <input type = 'hidden' name = 'action' value = 'Gerer_CommandeClient' >
                        <input type = 'hidden' name = 'idCommande' value = '$idCommande' >
                        <input type = 'submit' name = 'AfficherCommandePDF' value = 'Voir facture'  style = 'width: auto' >
         </form >";
}
function Vue_Afficher_InfoCommande($infoCommande)
{

}

function Vue_Afficher_HistoCommande($histoEtatCommande)
{

    if ($histoEtatCommande != false) {
        echo " 
            <h1 > Historique de la commande </h1 >
        ";
        echo "<table style = 'padding: 20px; margin-bottom: 50px;   display: inline-block;   border: 1px solid #f1f1f1; box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24); background: #fff; ' >             
                <thead >
                    <tr >
                        <th > Date</th >
                        <th > Opérateur</th >
                        <th > Libelle</th >
                        <th > Information</th >
                    </tr >
                </thead > ";


        foreach ($histoEtatCommande as $etat) {
            echo "
                <tr >
                        <td > $etat[dateHeure]</td >
                        <td>";
            if($etat["nom"] != null)
                echo "$etat[nom] $etat[prenom]";
            else
                echo "$etat[login]";
            echo "
                        </td>
                        <td > $etat[libelle]</td >
                        <td > $etat[infoComplementaire]</td >
                    </tr >
        ";

        }
        echo "</table > ";
    }
}

function Vue_Affiche_Panier_Client($listeProduits, $commandeFinalisee = false, $infoCommande = null)
{
    if ($commandeFinalisee == false)
        echo "<h1 > Panier</h1 > ";
    else
        echo "<h1 > Commande</h1 > ";

    if ($infoCommande != null) {
        echo "<br > Numéro $infoCommande[id], créée le $infoCommande[dateCreation] <br>";
    }
    //print_r($listeProduits);
    if (count($listeProduits) >= 1) {
        echo " <table style = 'padding: 20px; margin-bottom: 50px;   display: inline-block;   border: 1px solid #f1f1f1; box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24); background: #fff; ' >             
 <thead >
                    <tr >
                        <th colspan = 2 > Article</th >
                        <th > Categorie</th >
                        <th > Reference</th >
                        <th > Prix HT </th >
                        <th colspan = '3' > Quantité</th >
                        <th > Total HT </th >
                        <th > Taux TVA </th >
                        <th > Montant TVA </th >
                        <th > Total TTC </th >
                        
                    
                    </tr >
                
                </thead >


        ";


        $totalHT = 0;
        $totalTVA = 0;
        $totalTTC = 0;
        foreach ($listeProduits as $produit) {


            // Si le produit a été activé par l'utilisateur, alors il s'affiche sur le catalogue client


            $path = "public/image / " . $produit["fichierImage"];

            echo "
            
                <tr >
                    <td > ";
            if ($commandeFinalisee == false) echo "<img style = 'max-width: 50px; max-height: 50px; ' src = '$path' > ";
            echo "</td >
                    <td > $produit[nom]</td >
                    <td > $produit[libelleCat]</td >
                    <td > $produit[idProduit]</td >
                    <td > $produit[prixVenteHT] € </td > ";
            if ($commandeFinalisee == false) {
                echo "<td >
                    
                        <form style = 'display: contents' >
                            <input type = 'hidden' name = 'action' value = 'Gerer_Panier' >
                            <input type = 'hidden' name = 'idProduit' value = '$produit[idProduit]' />
                            <input type = 'submit' name = 'diminuerQTT' value = '-' style = 'width: auto' />
                    
                        </form > 
                    </td > 
                    <td style = 'text-align: center' >
            $produit[quantite]   
                     </td > 
                     <td >
                     <form style = 'display: contents' >
                        <input type = 'hidden' name = 'action' value = 'Gerer_Panier' >
                        <input type = 'hidden' name = 'idProduit' value = '$produit[idProduit]' >
                        <input type = 'submit' name = 'augmenterQTT' value = '+'  style = 'width: auto' >
                    </form >
                    </td > ";
            } else {
                echo "<td style = 'text-align: center' colspan = '3' >
            $produit[quantite]   
                     </td > ";
            }
            echo "<td > ";
            $coutLigneHT = $produit["prixVenteHT"] * $produit["quantite"];
            echo $coutLigneHT;
            $totalHT += $coutLigneHT;

            echo " € </td > ";
            echo "<td > ";

            echo $produit["pourcentageTVA"];
            echo " %
                    </td >
                    <td > ";
            $coutMontantTVA = $coutLigneHT * $produit["pourcentageTVA"];
            echo $coutMontantTVA;
            $totalTVA += $coutMontantTVA;

            echo " €
        </td >
                    <td > ";
            $coutTotalTTC = $coutMontantTVA + $coutLigneHT;
            echo $coutTotalTTC;
            $totalTTC += $coutTotalTTC;
            echo " €
        </td >
                </tr >


        ";

        }
        echo "
            <tr >
                <td colspan = '8' style = 'text-align: right' > <b > Total</b ></td >
                <td > $totalHT € </td >
                <td ></td >
                <td > $totalTVA € </td >
                <td > $totalTTC € </td >
            
            </tr > ";
        if ($commandeFinalisee == false)
            echo "
            <tr >
                <td colspan = '12' style = 'text-align: center' >
                    <form style = 'display: contents' >
                        <input type = 'hidden' name = 'action' value = 'Gerer_Panier' >
                        <input type = 'hidden' name = 'idProduit' value = '$produit[idProduit]' >
                        <input type = 'submit' name = 'validerPanier' value = 'VALIDER CETTE COMMANDE'  style = 'width: auto' >
                    </form >
                </td >
            </tr > ";
        echo "</table > ";

    } else {
        echo "<h3 > Panier vide !</h3 > ";
    }
}

function Facture_EnteteBrulerie($infoCommande, $infoentreprise)
{
    echo "

<table style = 'width: 100%' >
<tr >
<td  style = 'text-align: left; width: 50%' > 
   <H1 > La brulerie comtoise </H1 >
        15 grande rue <br>
    39100 DOLE <br>
    </td >
<td  style = 'text-align: right; width: 50%' > $infoCommande[dateCreation]    </td >
</tr >
<tr >
<td  style = 'text-align: left; width: 50%' > </td >
<td  style = 'text-align: right; width: 50%' >   
<h1 > $infoentreprise[denomination]</h1 >
        $infoentreprise[rueAdresse]<br >
        $infoentreprise[complementAdresse]<br >

        $infoentreprise[codePostal]   $infoentreprise[ville] <br>
  $infoentreprise[pays] <br>
  </td >
</tr >
</table >
    
    
    <h3 align = 'center' > Commande n°$infoCommande[id] </h3 >

        ";
}

function Facture_DonneRefVirementAttendu($infoCommande, $infoentreprise): string
{
    return "Brulerie_$infoentreprise[numCompte]_$infoCommande[id]";
}

function Facture_BasPageBrulerie($infoCommande, $infoentreprise)
{
    echo "
        <H3 align = 'right' > Nous vous remercions pour votre commande .</H3>
    <br >
    <br >
    <h4 align = 'center' > Votre commande sera validée à la reception de votre virement dans un délai de 30 jours . 
    <br > Référence de virement : " . Facture_DonneRefVirementAttendu($infoCommande, $infoentreprise) . " </h4 >

        ";
}

function Vue_Afficher_Commande_Entreprise($listeCommande)
{
    echo " 
            <h1 > Commandes</h1 >
        ";

    //print_r($listeProduits);
    if (count($listeCommande) >= 1) {
        echo " <table style = 'padding: 20px; margin-bottom: 50px;   display: inline-block;   border: 1px solid #f1f1f1; box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24); background: #fff; ' >             
 <thead >
                    <tr >
                        <th > Reference Commande </th >
                        <th > Date commande </th >
                        
                        <th > Nb d'articles</th>
                        <th >Total HT</th>
                        <th >Montant TVA</th>
                        <th >Total TTC</th>
                        
                        <th>Etat</th>
                    
                    </tr>
                
                </thead>

 
             ";

        //var_dump($listeCommande);
        foreach ($listeCommande as $item) {

            $montantTVA = $item["prixTotalTTC"] - $item["prixTotalHT"];
            echo "
            <tr style='text - align: center;font - size: '>
                        <td>$item[id]</td>
                        <td >$item[dateCreation]</td>
                        
                        <td >$item[nbProduit]</td>
                        <td >" . number_format($item["prixTotalHT"], 2) . " €</td>
                        <td >" . number_format($montantTVA, 2) . " €</td>
                        <td >" . number_format($item["prixTotalTTC"], 2) . " €</td>
                        <td >$item[libEtat]</td>
                        <td >
                            <form style='display: contents'>
                                <input type='hidden' name='action' value='Gerer_CommandeClient'>
                                <input type='hidden' name='idCommande' value='$item[id]'/>
                                <input type='submit' name='VoirDetailCommande' value='Voir'/>
                            
                            </form>
                        </td>
                    </tr>
            ";

        }


    } else
        echo "Vous n'avez pas encore passé de commande";
}