<?php
    function Vue_Affiche_Categories ($listeCategorie, $utilisateur = true){
        $i = 0;
        echo "<nav id='categorie'>
                <ul id='menu-closed'>
                ";
        if ($utilisateur){
            echo "<form style='display: contents'> 
                <li><input type='submit' name='AjouterCategorie' value='+'> </li>
                </form>";
        }
        /*else {
            echo "<form style='display: contents'> 
                <li><input type='submit' name='ToutLeCatalogue' value='Catalogue'> </li>
                </form>";
        }*/

        while ($i < count($listeCategorie)) {
            $iemeCategorie = $listeCategorie[$i];
            if ($iemeCategorie["desactiverCategorie"] == 0) {
                echo "
                   <li>
                        <form style='display: contents'> 
                            <input type='hidden' name='idCategorie' value='$iemeCategorie[idCategorie]'>
                            <input type=\"submit\" name='boutonCategorie' value=\"$iemeCategorie[libelle]\">
                        </form>
                   </li> 
                   ";
            }
            $i++;
        }
        echo "
                <form style='display: contents'> 
                    <li><input type='text' name='recherche' placeholder='Rechercher'> </li>
                    <li><input type='submit' name='okRechercher' value='OK'> </li>
                </form>";
        if ($utilisateur == false){
            echo "<form style='display: contents'> 
                <li><input type='submit' name='PanierClient' value='Panier'> </li>
                </form>";
        }
        echo "
            </ul>
            </nav>";
    }

    function Vue_Affiche_Tous_Les_Produit ($listeProduits){
        echo "<table style='margin: auto'>
                <form style='display: contents; '>
                    <td colspan=\"4\">
                        <input class='btnRadius' type='submit' name='nouveauProduit' value='Nouveau produit ?'>
                    </td>
                 </form>   
                </table>";
        if (isset($listeProduits) AND is_array($listeProduits) AND (count($listeProduits) > 0)){
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
                echo "
            <form id='form-id-$nproduit' class='form_produit'>
            <input type='hidden' value='$nproduit' name='idProduit'>
            <input type='hidden' name='ModifierProduit' value='Modifier'>
            <button onclick='document.getElementById('form-id-".$nproduit."').submit();'>
                 <table style='padding: 20px;    display: inline-block;     ' >
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
                        <td><div class='resume'> <b>Résumé :</b> $nResume</div></td>
                    </tr> 
                    <tr>
                        <td><div class='resume'><b>Description :</b> $nDescription</div></td>
                    </tr>
                    ";/*<tr>
                        <td colspan='2'>
                            <form>
                            <input type='hidden' value='$nproduit' name='idProduit'>
                            <input class='btnRadius' type='submit' name='ModifierProduit' value='Modifier'>
                            </form>
                        </td>
                    </tr>
                    <tr>

                        <td colspan='2'>
                            <form>
                            <input type='hidden' value='$nproduit' name='idProduit'>
                            ";
                if ($desactivation == false){
                    echo "<input class='btnRadius' type='submit' name='DesactiverProduit' value='Désactiver'>";
                }
                else {
                    echo "<input class='btnRadius' type='submit' name='ActiverProduit' value='Activer'>";
                }
                echo "
                            <!--<input type='submit' name='SupprimerProduit' value='Supprimer'>-->
                            </form>
                        </td>
                    </tr>

            ";*/
                echo "</table>
            </button>
            </form>";
            }
        }
        else {
            echo "<h3>Aucun produit n'est disponible pour le moment</h3>";
        }
    }

function Vue_Gestion_Catalogue_Formulaire ($listeCategorie, $listeTVA, $modeCreation = true, $modeCategorieProduit = false, $idProduit = "", $nom = "", $description = "", $resume = "", $fichierImage = "", $prixVenteHT = "", $idCategorie = "", $idTVA = "", $desactiver = "")

{
    if ($modeCreation)
        echo "<H1>Création d'un nouveau produit</H1>";
    else
        echo "<H1>Edition du produit</H1>";

    echo "
<table style='display: inline-block'> 
    <form method='post' enctype='multipart/form-data'>
        <input type='hidden' name='idProduit' value='$idProduit'>";
    if($modeCreation == false){
        echo "<tr>
            <td>
                <label>Id du produit </label>
            </td>
            <td>
                $idProduit
            </td>
        </tr>";
    }
     echo "   
        <tr>
            <td>
                <label>Nom du produit : </label>
            </td>
            <td>
    
                <input type='text' required name='nom'
                       pattern='[A-z\ ]{0,30}' placeholder='lettres et espace' autofocus value='$nom'>
            </td>
        </tr>
        <tr>
            <td>
                <label>Description : </label>
            </td>
            <td><textarea placeholder='Description' name='description' rows='5' cols='33'>$description</textarea>
            </td>
        </tr>
        <tr>
            <td>
                <label>Résumé  : </label>
            </td>
            <td> <textarea placeholder='Résumé' name='resume' rows='5' cols='33'>$resume</textarea></td>
        </tr>
        <tr>
            <td>
                <label>Fichier Image : </label>
            </td>
            <td>
            <!--<input type='text' placeholder='Lien fichier image' maxlength='1000' name='fichierImage' value='$fichierImage'>-->
            <input type='file' name='image_utilisateur' accept='.png, .jpg, .jpeg'></td>
        </tr>";
    if ($modeCreation == false){
        echo "<tr>
            <td> <label> Ancienne image : </label> </td>
            <td>$fichierImage</td>
             <input type='hidden' value='$fichierImage' name='fichierImage'>
        </tr>";
    }
    echo "
        <tr>
            <td>
                <label>Prix de vente HT : </label>
            </td>
            <td>
    
                <input type='number' required
                       pattern='[A-z\ ]{2,30}' placeholder='prix vente HT' autofocus name='prixVenteHT' value='$prixVenteHT'>
            </td>
        </tr>
        
        <tr>
            <td>
                <label>Catégorie : </label>
            </td>
            <td>";
    if ($modeCategorieProduit == false){
        echo "<select name='idCategorie'>";
        foreach($listeCategorie as $categorie)
        {
            if($idCategorie == $categorie[idCategorie])
                echo "<option value='$categorie[idCategorie]' selected>$categorie[libelle]</option>";
            else
                echo "<option value='$categorie[idCategorie]'>$categorie[libelle]</option>";
        }
        echo "</select>";
                    //<input type='submit' name='CreationCategorieAvecProduit' value='+'>

    }
    if ($modeCreation AND $modeCategorieProduit == false){
        echo "<button type='submit' name='CreationCategorieAvecProduit'>+</button>";
    }

            if ($modeCategorieProduit == true){
                echo "<input type='text' name='CategorieAvecProduit' placeholder='Nouvelle Catégorie'>
                    <input type='text' name='DescriptionCategorieAvecProduit' placeholder='Description Catégorie'>";
            }
            echo "
            </td>
        </tr> 
        <tr>
            <td>
                <label> TVA : </label>
            </td>
            <td> <select name='idTVA'>";
                foreach ($listeTVA as $tva){
                    if($idTVA == $tva["idTVA"])
                        echo "<option value='$tva[idTVA]' selected>$tva[pourcentageTVA] %</option>";
                    else
                        echo "<option value='$tva[idTVA]'>$tva[pourcentageTVA] %</option>";
                }
                echo "
                        <input type='hidden' value='$idProduit' name='idProduit'>
            </select>
            </td>
        </tr>
        <tr>
            <td><label>Désactiver : </label></td>
            <td>
                <input type='radio' name='DesactiverProduit' value='1' ".($desactiver == 1 ? 'checked' : "")."> Oui
                <input type='radio' name='DesactiverProduit' value='0' ".($desactiver == 0 ? 'checked' : "")."> Non
            </td>
        </tr>
        <tr>";
    if ($modeCreation) {
        echo " 
                
            <td colspan='2' style='text-align: center'>
                <button type='submit' name='CreationProduit'>Créer ce produit</button>";
    } else {
        echo "
            <td>
                <button type='submit' name='mettreAJourProduit'>Mettre à jour</button>";
    }

    echo "</td>
        </tr>

    </form>
</table>

";
}
/*function Vue_Demande_Approbation_Suppression ($idProduit){

    echo " <table style='margin: auto'>
            <h3> Etes-vous sûr(e) de vouloir supprimer ce produit ? </h3>
            <form style='display: contents; align-content: center'>
                <input type='hidden' value='$idProduit' name='idProduit'>
                <td style=\"width: 100px; height: 100px;\"><input type='submit' name='OuiSuppression' value='Oui'></td>
                <td style=\"width: 100px; height: 100px;\"><input type='submit' name='AnnulerSuppression' value='Annuler'></td>
            </form>
            </table>
 ";
}*/
/*function Vue_supression_produit ($reponse){
    if ($reponse){
        echo "
        <table> 
            <h3>Le produit a été supprimé</h3>
            <a href='Controleur_Gerer_catalogue.php'>Retourner sur le catalogue</a>
        </table>
        ";
    }
    else {
        echo "
        <table>
            <h3>Nous avons rencontré un problème, le produit n'a pas pu être supprimé</h3>
        </table>
        ";
    }
}*/

function Vue_Liste_Categorie ($listeCategorie){
    echo "
    <h1>Liste des Catégories de produit</h1> <br>
    <table style=\"    display: inline-block;\">
        <form>
            <td colspan=\"4\">
            <input class='btnRadius'  type='submit' name='nouvelleCategorie' value='Nouvelle Catégorie ?'>
            </td> 
        </form>
            <tr>
                <th>ID Catégorie</th>
                <th>Catégorie</th>
            </tr>";
    $i = 0;
    while ($i < count($listeCategorie)) {
        $iemeCategorie = $listeCategorie[$i];
        echo "
            <tr>
                <input type='hidden' name='idCategorie' value='$iemeCategorie[idCategorie]'>
                <td>$iemeCategorie[idCategorie]</td>
                <td>$iemeCategorie[libelle]</td>
                <form style='display: contents'><td>
                        <input type='hidden' value='$iemeCategorie[idCategorie]' name='idCategorie'>
                         <!--<button type='submit' onmouseover=\"this.style.background='#FFFF99';this.style.color='#FF0000';\"
                     onmouseout=\"this.style.background='';this.style.color='';\" name='ModifierCategorie'> Modifier </button>-->
                     <input class='btnRadius'  type='submit' name='ModifierCategorie' value='Modifier'>
                </form> 
            ";
        if ($iemeCategorie["desactiverCategorie"] == 0){
            echo "<td><form style='display: contents'>
                            <input type='hidden' value='$iemeCategorie[idCategorie]' name='idCategorie'>
                             <!--<button type='submit' onmouseover=\"this.style.background='#FFFF99';this.style.color='#FF0000';\"
                            onmouseout=\"this.style.background='';this.style.color='';\" name='DesactiverCategorie'> Désactiver </button>-->
                            <input class='btnRadius'  type='submit' name='DesactiverCategorie' value='Désactiver'>
                       </form>
                  </td>";
        }
        elseif ($iemeCategorie["desactiverCategorie"] == 1){
            echo "<td><form style='display: contents'>
                            <input type='hidden' value='$iemeCategorie[idCategorie]' name='idCategorie'>
                            <!--<button type='submit' onmouseover=\"this.style.background='#FFFF99';this.style.color='#FF0000';\"
                            onmouseout=\"this.style.background='';this.style.color='';\" name='ActiverCategorie'> Activer </button>-->
                            <input class='btnRadius'  type='submit' name='ActiverCategorie' value='Activer'>
                       </form>
                  </td>";
        }
            //echo "<input type='submit' name='ActiverCategorie' value='Activer'>";
        echo "</tr>";
        $i++;
    }
    echo "</table>";
}
//$modeCategorieProduit = false,
function Vue_Formulaire_Creation_Modification_Categorie ($modeCreation = true,   $idCategorie = "", $libelle = "", $description = ""){
    if ($modeCreation)
        echo "<H1>Création d'une nouvelle catégorie</H1>";
    else
        echo "<H1>Edition d'une catégorie</H1>";

    echo "
<table style='display: inline-block'> 
    <form>
        <input type='hidden' name='idCategorie' value='$idCategorie'>
        <tr>
            <td>
                <label>ID Catégorie : </label>
            </td>
            <td>
                $idCategorie
            </td>
        </tr>
        <tr>
        
            <td>
                <label>Libellé Catégorie: </label>
            </td>
            <td>
    
                <input type='text' required name='libelle' pattern='[A-z\ ]{0,30}' placeholder='libelle' autofocus value='$libelle'>
            </td>
        </tr>
        <tr>
            <td>
                <label>Description de la Catégorie : </label>
            </td>
            <td><input type='text' placeholder='Description' name='description' value='$description'>
            </td>
        </tr>
        ";
    if ($modeCreation) {
        //if ($modeCategorieProduit == false) {
            echo " 
                    
                <td colspan='2' style='text-align: center'>
                    <button type='submit' name='CreerCategorie'>Créer cette catégorie</button>";
       /* }
        else {
            echo "
                <td colspan='2' style='text-align: center'>
                    <button type='submit' name='CreerCategProduit'>Créer cette catégorie</button>";
        }*/
    } else {
        echo "
            <td>
                <button type='submit' name='mettreAJourCategorie'>Mettre à jour</button>";
    }

    echo "</td>
        </tr>

    </form>
</table>

";
}
function Vue_Affiche_Création($reponse, $categorie = true, $produit = true){
    if ($reponse){
        echo "
        <table> 
            <h3>";
        if ($categorie){
            echo "La catégorie a été créée </h3>";
        }
        if ($produit){
            echo "Le produit a été créé</h3>";
        }
         echo "<a href='Controleur_Gerer_catalogue.php'>Retourner sur le catalogue</a>
        </table>
        ";
    }
    else {
        echo "
        <table> ";
        if ($categorie){
            echo "<h3>Nous avons rencontré un problème, la catégorie n'a pas pu être créée</h3>";
        }
        if ($produit){
            echo "<h3>Nous avons rencontré un problème, le produit n'a pas pu être créé</h3>";
        }
        echo "</table>";
    }
}
function Vue_Demande_Approbation_Desactivation($idCategorie){

    echo " <table style='margin: auto'>
            <h3> Etes-vous sûr(e) de vouloir désactiver cette catégorie ?
             <br> Si oui, les produits se trouvant à l'intérieur de celle-ci ne seront plus visibles sur le catalogue client.</h3>
            <form style='display: contents; align-content: center'>
                <input type='hidden' value='$idCategorie' name='idCategorie'>
                <td style=\"width: 100px; height: 100px;\"><input type='submit' name='OuiDesactivation' value='Oui'></td>
                <td style=\"width: 100px; height: 100px;\"><input type='submit' name='AnnulerDesactivation' value='Annuler'></td>
            </form>
            </table>
 ";
}

