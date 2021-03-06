<?php
function Vue_Affiche_Categories($listeCategorie, $utilisateur = true)
{
    $i = 0;
    echo "<nav id='categorie'>
                <ul id='menu-closed'>
                ";
    if ($utilisateur) {
        echo "<form style='display: contents'> 
                <li>
                    <input type='hidden' name='action' value='Gerer_catalogue'>
                    <input type='submit' name='AjouterCategorie' value='+'> </li>
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
                            <input type='hidden' name='action' value='Gerer_catalogue'>
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

    echo "
            </ul>
            </nav>";
}

function Vue_Affiche_Tous_Les_Produits($listeProduits, $idCategorie = -1)
{
    echo "<table style='margin: auto'>
                <form style='display: contents; '>
                    <td colspan=\"4\">
                        <input type='hidden' name='action' value='Gerer_catalogue'>
                        <input type='hidden' name='idCategorie' value='$idCategorie'>
                        <input class='btnRadius' type='submit' name='nouveauProduit' value='Nouveau produit ?'>
                    </td>
                 </form>   
                </table>";
    if (isset($listeProduits) and is_array($listeProduits) and (count($listeProduits) > 0)) {
        foreach ($listeProduits as $produit) {
            $nArticle = "";
            $nReference = "";
            $nCategorie = "";
            $nPrixHT = "";
            $nResume = "";
            $nDescription = "";
            $nImage = "";
            $nproduit = "";
            $desactivation = "";

            foreach ($produit as $champ_produit => $valeur_produit) {
                if ($champ_produit == 'idProduit') {
                    $nproduit = $valeur_produit;
                }
                if ($champ_produit == 'nom') {
                    $nArticle = $valeur_produit;
                }
                if ($champ_produit == 'reference') {
                    $nReference = $valeur_produit;
                }
                if ($champ_produit == 'libelle') {
                    $nCategorie = $valeur_produit;
                }
                if ($champ_produit == 'prixVenteHT') {
                    $nPrixHT = $valeur_produit;
                }
                if ($champ_produit == 'resume') {
                    $nResume = $valeur_produit;
                }
                if ($champ_produit == 'description') {
                    $nDescription = $valeur_produit;
                }
                if ($champ_produit == 'fichierImage') {
                    $nImage = $valeur_produit;
                    $path = "public/image/" . $nImage;
                }
                if ($champ_produit == 'desactiverProduit') {
                    if ($valeur_produit == 0) {
                        // le produit est activ??
                        $desactivation = false;
                    } else {
                        // Le produit est d??sactiv??e
                        $desactivation = true;
                    }
                }
            }
            echo "
            <form id='form-id-$nproduit' class='form_produit'>
            <input type='hidden' value='$nproduit' name='idProduit'>
            <input type='hidden' name='ModifierProduit' value='Modifier'>
            <input type='hidden' name='action' value='Gerer_catalogue'>
            <button onclick='document.getElementById('form-id-" . $nproduit . "').submit();'>
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
                            <b>Code r??f??rence : </b>
                            $nReference<br>
                        </td>
                    </tr>
                    <tr>
                        <td style='vertical-align: top;width : 400px'><b>Prix : </b>$nPrixHT ??? HT</td>
                    </tr>
                    <tr>
                        <td><div class='resume'> <b>R??sum?? :</b> $nResume</div></td>
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
                    echo "<input class='btnRadius' type='submit' name='DesactiverProduit' value='D??sactiver'>";
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
    } else {
        echo "<h3>Aucun produit n'est disponible pour le moment</h3>";
    }
}

function Vue_Gestion_Catalogue_Formulaire($listeCategorie, $listeTVA, $modeCreation = true, $modeCategorieProduit = false, $idProduit = "", $nom = "", $description = "", $resume = "", $fichierImage = "", $prixVenteHT = "", $idCategorie = "", $idTVA = "", $desactiver = "")

{
    if ($modeCreation)
        echo "<H1>Cr??ation d'un nouveau produit</H1>";
    else
        echo "<H1>Edition du produit</H1>";

    echo "
<table style='display: inline-block'> 
    <form method='post' enctype='multipart/form-data'>
        <input type='hidden' name='idProduit' value='$idProduit'>
        <input type='hidden' name='action' value='Gerer_catalogue'>";
    if ($modeCreation == false) {
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
                <label>R??sum??  : </label>
            </td>
            <td> <textarea placeholder='R??sum??' name='resume' rows='5' cols='33'>$resume</textarea></td>
        </tr>
        <tr>
            <td>
                <label>Fichier Image : </label>
            </td>
            <td>
            <!--<input type='text' placeholder='Lien fichier image' maxlength='1000' name='fichierImage' value='$fichierImage'>-->
            <input type='file' name='image_utilisateur' accept='.png, .jpg, .jpeg'></td>
        </tr>";
    if ($modeCreation == false) {
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
                <label>Cat??gorie : </label>
            </td>
            <td>";
    if ($modeCategorieProduit == false) {
        echo "<select name='idCategorie'>";
        foreach ($listeCategorie as $categorie) {
            if ($idCategorie == $categorie[idCategorie])
                echo "<option value='$categorie[idCategorie]' selected>$categorie[libelle]</option>";
            else
                echo "<option value='$categorie[idCategorie]'>$categorie[libelle]</option>";
        }
        echo "</select>";
        //<input type='submit' name='CreationCategorieAvecProduit' value='+'>

    }

    if ($modeCreation and $modeCategorieProduit == false) {
        echo "<button type='submit' name='CreationCategorieAvecProduit'>+</button>";
    }

    if ($modeCategorieProduit == true) {
        echo "<input type='text' name='CategorieAvecProduit' placeholder='Nouvelle Cat??gorie'>
                    <input type='text' name='DescriptionCategorieAvecProduit' placeholder='Description Cat??gorie'>";
    }
    echo "
            </td>
        </tr> 
        <tr>
            <td>
                <label> TVA : </label>
            </td>
            <td> <select name='idTVA'>";

    foreach ($listeTVA as $tva) {
        if ($idTVA == $tva["idTVA"])
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
            <td><label>D??sactiver : </label></td>
            <td>
                <input type='radio' name='DesactiverProduit' value='1' " . ($desactiver == 1 ? 'checked' : "") . "> Oui
                <input type='radio' name='DesactiverProduit' value='0' " . ($desactiver == 0 ? 'checked' : "") . "> Non
            </td>
        </tr>
        <tr>";
    if ($modeCreation) {
        echo " 
                
            <td colspan='2' style='text-align: center'>
                <button type='submit' name='CreationProduit'>Cr??er ce produit</button>";
    } else {
        echo "
            <td>
                <button type='submit' name='mettreAJourProduit'>Mettre ?? jour</button>";
    }

    echo "</td>
        </tr>

    </form>
</table>

";
}

/*function Vue_Demande_Approbation_Suppression ($idProduit){

    echo " <table style='margin: auto'>
            <h3> Etes-vous s??r(e) de vouloir supprimer ce produit ? </h3>
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
            <h3>Le produit a ??t?? supprim??</h3>
            <a href='Controleur_Gerer_catalogue.php'>Retourner sur le catalogue</a>
        </table>
        ";
    }
    else {
        echo "
        <table>
            <h3>Nous avons rencontr?? un probl??me, le produit n'a pas pu ??tre supprim??</h3>
        </table>
        ";
    }
}*/

function Vue_Liste_Categorie($listeCategorie)
{
    echo "
    <h1>Liste des Cat??gories de produit</h1> <br>
    <table style=\"    display: inline-block;\">
        <form>
            <td colspan=\"4\">
            <input class='btnRadius'  type='submit' name='nouvelleCategorie' value='Nouvelle Cat??gorie ?'>
            <input type='hidden' name='action' value='Gerer_catalogue'>
            </td> 
        </form>
            <tr>
                <th>ID Cat??gorie</th>
                <th>Cat??gorie</th>
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
                    <input type='hidden' name='action' value='Gerer_catalogue'>
                        <input type='hidden' value='$iemeCategorie[idCategorie]' name='idCategorie'>
                         <!--<button type='submit' onmouseover=\"this.style.background='#FFFF99';this.style.color='#FF0000';\"
                     onmouseout=\"this.style.background='';this.style.color='';\" name='ModifierCategorie'> Modifier </button>-->
                     <input class='btnRadius'  type='submit' name='ModifierCategorie' value='Modifier'>
                </form> 
            ";
        if ($iemeCategorie["desactiverCategorie"] == 0) {
            echo "<td>
                <form style='display: contents'>
                    <input type='hidden' name='action' value='Gerer_catalogue'>
                            <input type='hidden' value='$iemeCategorie[idCategorie]' name='idCategorie'>
                             <!--<button type='submit' onmouseover=\"this.style.background='#FFFF99';this.style.color='#FF0000';\"
                            onmouseout=\"this.style.background='';this.style.color='';\" name='DesactiverCategorie'> D??sactiver </button>-->
                            <input class='btnRadius'  type='submit' name='DesactiverCategorie' value='D??sactiver'>
                       </form>
                  </td>";
        } elseif ($iemeCategorie["desactiverCategorie"] == 1) {
            echo "<td>
                        <form style='display: contents'>
                            <input type='hidden' name='action' value='Gerer_catalogue'>
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
function Vue_Formulaire_Creation_Modification_Categorie($modeCreation = true, $idCategorie = "", $libelle = "", $description = "")
{
    if ($modeCreation)
        echo "<H1>Cr??ation d'une nouvelle cat??gorie</H1>";
    else
        echo "<H1>Edition d'une cat??gorie</H1>";

    echo "
<table style='display: inline-block'> 
    <form>
        <input type='hidden' name='idCategorie' value='$idCategorie'>
        <input type='hidden' name='action' value='Gerer_catalogue'>
        <tr>
            <td>
                <label>ID Cat??gorie : </label>
            </td>
            <td>
                $idCategorie
            </td>
        </tr>
        <tr>
        
            <td>
                <label>Libell?? Cat??gorie: </label>
            </td>
            <td>
    
                <input type='text' required name='libelle' pattern='[A-z\ ]{0,30}' placeholder='libelle' autofocus value='$libelle'>
            </td>
        </tr>
        <tr>
            <td>
                <label>Description de la Cat??gorie : </label>
            </td>
            <td><input type='text' placeholder='Description' name='description' value='$description'>
            </td>
        </tr>
        ";
    if ($modeCreation) {
        //if ($modeCategorieProduit == false) {
        echo " 
                    
                <td colspan='2' style='text-align: center'>
                    <button type='submit' name='CreerCategorie'>Cr??er cette cat??gorie</button>";
        /* }
         else {
             echo "
                 <td colspan='2' style='text-align: center'>
                     <button type='submit' name='CreerCategProduit'>Cr??er cette cat??gorie</button>";
         }*/
    } else {
        echo "
            <td>
                <button type='submit' name='mettreAJourCategorie'>Mettre ?? jour</button>";
    }

    echo "</td>
        </tr>

    </form>
</table>

";
}

function Vue_Affiche_Cr??ation($reponse, $categorie = true, $produit = true)
{
    if ($reponse) {
        echo "
        <table> 
            <h3>";
        if ($categorie) {
            echo "La cat??gorie a ??t?? cr????e </h3>";
        }
        if ($produit) {
            echo "Le produit a ??t?? cr????</h3>";
        }
        echo "<a href='?action=Gerer_catalogue'>Retourner sur le catalogue</a>
        </table>
        ";
    } else {
        echo "
        <table> ";
        if ($categorie) {
            echo "<h3>Nous avons rencontr?? un probl??me, la cat??gorie n'a pas pu ??tre cr????e</h3>";
        }
        if ($produit) {
            echo "<h3>Nous avons rencontr?? un probl??me, le produit n'a pas pu ??tre cr????</h3>";
        }
        echo "</table>";
    }
}

function Vue_Demande_Approbation_Desactivation($idCategorie)
{

    echo " <table style='margin: auto'>
            <h3> Etes-vous s??r(e) de vouloir d??sactiver cette cat??gorie ?
             <br> Si oui, les produits se trouvant ?? l'int??rieur de celle-ci ne seront plus visibles sur le catalogue client.</h3>
            <form style='display: contents; align-content: center'>
                <input type='hidden' value='$idCategorie' name='idCategorie'>
                <input type='hidden' name='action' value='Gerer_catalogue'>
                <td style=\"width: 100px; height: 100px;\"><input type='submit' name='OuiDesactivation' value='Oui'></td>
                <td style=\"width: 100px; height: 100px;\"><input type='submit' name='AnnulerDesactivation' value='Annuler'></td>
            </form>
            </table>
 ";
}

