<?php

function Vue_Affiche_Produits_Clients ($listeProduits, $idCategorie = null, $recherche = null){
    echo "<table style='margin: auto'>
            <h1>Liste des produits</h1>
                </table>";
    if (isset($listeProduits) AND is_array($listeProduits) AND (count($listeProduits) > 0)){
        //print_r($listeProduits);
        foreach($listeProduits as $produit){
            $nArticle = "";
            $nReference = "";
            $nCategorie = "";
            $nPrixHT = "";
            $nResume = "";
            $nDescription = "";
            $nImage = "";
            $nproduit = "";
            $desactivation = "";

            foreach ($produit as $champ_produit => $valeur_produit)
            {
                if ($champ_produit == 'idProduit'){
                    $nproduit = $valeur_produit;
                }
                if($champ_produit == 'nom')
                {
                    $nArticle = $valeur_produit;
                }
                if($champ_produit == 'reference')
                {
                    $nReference = $valeur_produit;
                }
                if($champ_produit == 'libelle')
                {
                    $nCategorie = $valeur_produit;
                }
                if($champ_produit == 'prixVenteHT')
                {
                    $nPrixHT = $valeur_produit;
                }
                if($champ_produit == 'resume')
                {
                    $nResume = $valeur_produit;
                }
                if($champ_produit == 'description')
                {
                    $nDescription = $valeur_produit;
                }
                if ($champ_produit == 'fichierImage')
                {
                    $nImage = $valeur_produit;
                    $path = "public/image/".$nImage;
                }
                if ($champ_produit == 'desactiverProduit'){
                    if ($valeur_produit == 0){
                        // le produit est activé
                        $desactivation = false;
                    }
                    else{
                        // Le produit est désactivée
                        $desactivation = true;
                    }
                }
            }
            // Si le produit a été activé par l'utilisateur, alors il s'affiche sur le catalogue client
            if ($desactivation == false){
                echo "
             <table style='padding: 20px; margin-bottom: 50px;   display: inline-block; height: 300px; border: 1px solid #f1f1f1; box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24); background: #fff; ' >
                <tr>
                    <td style='vertical-align: top;width : 400px'>
                        <b>Article : </b>
                        $nArticle <br>
                    </td><td rowspan='6'>  <br><div style='height:220px; width: 220px; text-align: center'><img style='max-width: 220px; max-height: 220px; ' src='$path'></div></td>
                </tr>
                <tr>   
                    <td style='vertical-align: top;width : 400px'>
                        <b>Categorie : </b>
                        $nCategorie<br>
                    </td>
                </tr>
                <tr>   
                    <td style='vertical-align: top;width : 400px'>
                        <b>Code référence : </b>
                        $nReference<br>
                    </td>
                </tr>
                <tr>
                    <td style='vertical-align: top;width : 400px'><b>Prix : </b>$nPrixHT € HT</td>
                </tr>
                <tr>
                    <td> <div class='resume'> <b>Résumé :</b> $nResume</div></td>
                </tr>
                <tr>
                    <td><div class='resume'><b>Description :</b> $nDescription</div></td>
                </tr>
                
                <form>
                    <td colspan='2'>
                        <form>
                        <input type='hidden' value='$nproduit' name='idProduit'>
                        <input type='hidden' value='$idCategorie' name='idCategorie'>
                        <input type='hidden' value='$recherche' name='recherche'>
                        <input class='btnRadius'  type='submit' name='AjoutPanierClient' value='Ajouter au panier'>
                       </form>
                    </td>
                    </form>
                </tr>
            
        ";
                echo "</table>";
            }
        }
    }
    else {
        echo "<h3>Aucun produit n'est disponible pour le moment</h3>";
    }
}