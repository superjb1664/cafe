<?php
/**
 * @param $connexionPDO : connexion à la base de données
 * @return mixed : le tableau des Produit ou null (something went wrong...)
 */
function Produit_Select($connexionPDO)
{
    $requetePreparee = $connexionPDO->prepare('select * from `produit` order by idProduit');
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    $tableauReponse = $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    return $tableauReponse;
}
function Produits_Select_Libelle_Categ($connexionPDO, $type = "")
{
    $requetePreparee = $connexionPDO->prepare('select produit.*, libelle 
from `produit`, `categorie`
where categorie.idCategorie = produit.idCategorie '.($type == "client" ? "AND desactiverProduit = 0" : "").' 
order by idProduit');
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    $tableauReponse = $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    return $tableauReponse;
}

function Categorie_Select_Tous($connexionPDO)
{
    $requetePreparee = $connexionPDO->prepare('select categorie.*
from `categorie`
order by idCategorie');
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    $tableauReponse = $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    return $tableauReponse;
}

// pour sélectionner la liste de produit selon l'Id Categorie du bouton cliqué
function Select_Produit_ParIdCateg ($connexionPDO, $idCategorie, $type =""){
    $requetePreparee = $connexionPDO->prepare('
select produit.*, categorie.libelle
from `categorie` 
    inner join `produit` 
            on categorie.idCategorie = produit.idCategorie
where  categorie.idCategorie = :paramId '.($type == "client" ? "AND desactiverProduit = 0" : ""));
    $requetePreparee->bindParam('paramId', $idCategorie);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    $tableauReponse = $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    return $tableauReponse;
}

/**
 * @param $connexionPDO
 * @param $idProduit
 * @return mixed
 */
function Produit_Select_ParId($connexionPDO, $idProduit)
{
    $requetePreparee = $connexionPDO->prepare('select produit.*, libelle, tva.pourcentageTVA
    from `produit`, `categorie`, `tva`
    where categorie.idCategorie = produit.idCategorie
    and produit.idTVA = tva.idTVA
    and idProduit = :paramId');
    $requetePreparee->bindParam('paramId', $idProduit);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    $Produit = $requetePreparee->fetch(PDO::FETCH_ASSOC);
    return $Produit;
}

function Categorie_Select_ParID($connexionPDO, $idCategorie){
    $requetePreparee = $connexionPDO->prepare('select * from `categorie` where idCategorie = :paramId');
    $requetePreparee->bindParam('paramId', $idCategorie);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    $Categorie = $requetePreparee->fetch(PDO::FETCH_ASSOC);
    return $Categorie;
}
function Categorie_Select_Par_Libelle($connexionPDO, $libelle){
    $requetePreparee = $connexionPDO->prepare('select * from `categorie` where libelle = :paramlibelle');
    $requetePreparee->bindParam('paramlibelle', $libelle);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    $Categorie = $requetePreparee->fetch(PDO::FETCH_ASSOC);
    return $Categorie;
}
//fonction qui va récupérer les pourcentages dans la table TVA
function TVA_Select_Tous ($connexionPDO)
{
    $requetePreparee = $connexionPDO->prepare('select *
from `tva`  ');
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    $tableauReponse = $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    return $tableauReponse;
}

/**
 * @param $connexionPDO
 * @param $idProduit
 * @return mixed
 */
function Produit_Select_Par_Categorie($connexionPDO, $idCategorie)
{
    $requetePreparee = $connexionPDO->prepare('select COUNT(*) as nb_produit from `produit` where idCategorie = :paramidCategorie');
    $requetePreparee->bindParam('paramidCategorie', $idCategorie);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    $Produit = $requetePreparee->fetch(PDO::FETCH_ASSOC);
    return $Produit;
}

/**
 * @param $connexionPDO
 * @param $login
 * @param $niveauAutorisation
 * @return mixed
 */
function Produit_Creer($connexionPDO, $nom, $description, $resume, $fichierImage, $prixVenteHT, $idCategorie, $idTVA, $desactiver)
{

    $requetePreparee = $connexionPDO->prepare(
        'INSERT INTO `produit` (`idProduit`, `nom`, `description`, `resume`, `fichierImage`, `prixVenteHT`, `idCategorie`, `idTVA`, `desactiverProduit`) 
         VALUES (NULL, :paramnom, :paramdescription, :paramresume, :paramfichierImage, :paramprixVenteHT, :paramidCategorie, :paramidTVA, :paramdesactiverProduit);');

    $requetePreparee->bindParam('paramnom', $nom);
    $requetePreparee->bindParam('paramdescription', $description);
    $requetePreparee->bindParam('paramresume', $resume);
    $requetePreparee->bindParam('paramfichierImage', $fichierImage);
    $requetePreparee->bindParam('paramprixVenteHT', $prixVenteHT);
    $requetePreparee->bindParam('paramidCategorie', $idCategorie);
    $requetePreparee->bindParam('paramidTVA', $idTVA);
    $requetePreparee->bindParam('paramdesactiverProduit', $desactiver);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    //echo $reponse;
    $idProduit = $connexionPDO->lastInsertId();
    return $idProduit;
}

function Update_Ref_Produit($connexionPDO, $nom_categorie, $nom_produit, $idProduit){
    $reference = strtoupper(substr($nom_categorie, 0, 3))."_".strtoupper(substr($nom_produit, 0, 3))."_". $idProduit;
    $requetePreparee = $connexionPDO->prepare(
        'UPDATE `produit` 
        SET `reference`= :paramref
        WHERE idProduit = :paramidProduit');
    $requetePreparee->bindParam('paramref', $reference);
    $requetePreparee->bindParam('paramidProduit', $idProduit);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    return $reponse;
}

/**
 * @param $connexionPDO
 * @param $idUtilisateur
 * @return mixed
 */
function Produit_Supprimer($connexionPDO, $idProduit)
{

    $requetePreparee = $connexionPDO->prepare('delete produit.* from `produit` where idProduit = :paramId');
    $requetePreparee->bindParam('paramId', $idProduit);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    return $reponse;
}

/**
 * @param $connexionPDO
 * @param $idUtilisateur
 * @param $login
 * @param $niveauAutorisation
 * @return mixed
 */
// valeur du champ desactiverPrduit
// valeur 0 : c'est actif sur le catalogue
// valeur 1 : c'est désactivé sur le catalogue
function Produit_Modifier($connexionPDO, $idProduit, $nom, $description, $resume, $fichierImage, $prixVenteHT, $idCategorie, $idTVA, $desactiverProduit)
{
    $requetePreparee = $connexionPDO->prepare(
        'UPDATE `produit` 
SET `nom`= :paramnom,
`description`= :paramdescription,
`resume`= :paramresume,
`fichierImage`= :paramfichierImage,
`prixVenteHT`= :paramprixVenteHT,
`idCategorie`= :paramidCategorie,
`idTVA`= :paramidTVA,
`desactiverProduit`= :paramdesactiverProduit
WHERE idProduit = :paramidProduit');
    $requetePreparee->bindParam('paramnom', $nom);
    $requetePreparee->bindParam('paramdescription', $description);
    $requetePreparee->bindParam('paramresume', $resume);
    $requetePreparee->bindParam('paramfichierImage', $fichierImage);
    $requetePreparee->bindParam('paramprixVenteHT', $prixVenteHT);
    $requetePreparee->bindParam('paramidCategorie', $idCategorie);
    $requetePreparee->bindParam('paramidTVA', $idTVA);
    $requetePreparee->bindParam('paramdesactiverProduit', $desactiverProduit);
    $requetePreparee->bindParam('paramidProduit', $idProduit);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    return $reponse;
}



// fonction pour modifier la valeur du champ desactiverPrduit
// valeur 0 : c'est actif sur le catalogue
// valeur 1 : c'est désactivé sur le catalogue
function Categorie_Modifier_Desactivation($connexionPDO, $idCategorie, $desactiverCategorie)
{

    $requetePreparee = $connexionPDO->prepare(
        'UPDATE `categorie` 
SET `desactiverCategorie`= :paramdesactiverCategorie
WHERE idCategorie = :paramidCategorie');
    $requetePreparee->bindParam('paramdesactiverCategorie', $desactiverCategorie);
    $requetePreparee->bindParam('paramidCategorie', $idCategorie);
    $reponse1 = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    $requetePreparee = $connexionPDO->prepare(
        'UPDATE `produit` 
SET `desactiverProduit`= :paramdesactiverCategorie
WHERE idCategorie = :paramidCategorie');
    $requetePreparee->bindParam('paramdesactiverCategorie', $desactiverCategorie);
    $requetePreparee->bindParam('paramidCategorie', $idCategorie);
    $reponse2 = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    if ($reponse1 AND $reponse2){
        return true;
    }else{
        return false;
    }
}
//Modifier une catégorie
function Categorie_Modifier($connexionPDO, $idCategorie, $libelle, $description)

{

    $requetePreparee = $connexionPDO->prepare(
        'UPDATE `categorie` 
SET `libelle`= :paramlibelle,
`description`= :paramdescription
WHERE idCategorie = :paramidCategorie');
    $requetePreparee->bindParam('paramlibelle', $libelle);
    $requetePreparee->bindParam('paramdescription', $description);
    $requetePreparee->bindParam('paramidCategorie', $idCategorie);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    return $reponse;
}
function Categorie_Creer($connexionPDO, $libelle, $description, $desactiver)
{

    $requetePreparee = $connexionPDO->prepare(
        'INSERT INTO `categorie` (`idCategorie`, `libelle`, `description`, `desactiverCategorie`) 
         VALUES (NULL, :paramlibelle, :paramdescription, :paramdesactiverCategorie);');
    $requetePreparee->bindParam('paramlibelle', $libelle);
    $requetePreparee->bindParam('paramdescription', $description);
    $requetePreparee->bindParam('paramdesactiverCategorie', $desactiver);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    //echo $reponse;
    $idCategorie = $connexionPDO->lastInsertId();
    return $idCategorie;
}

function Rechercher_Produit($connexionPDO, $recherche, $type = ""){
    $requetePreparee = $connexionPDO->prepare('
    select produit.*, libelle
    from `produit`, `categorie`
    where categorie.idCategorie = produit.idCategorie
    and (produit.nom LIKE :paramrecherche
    or categorie.libelle LIKE :paramrecherche)  '.($type == "client" ? " AND desactiverProduit = 0 " : "").'  
     order by idProduit');
    $requetePreparee->bindValue('paramrecherche', "%".$recherche."%");
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    $tableauReponse = $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    return $tableauReponse;
}

function Rechercher_Caddie_Entreprise($connexionPDO, $idEntreprise)
{
    $requetePreparee = $connexionPDO->prepare('
    select commande.*
    from commande
    where idEntreprise = :idEntreprise
    and etat= 1');
    $requetePreparee->bindValue('idEntreprise', $idEntreprise);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    $tableauReponse = $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    if(count($tableauReponse) == 1)
        return $tableauReponse[0];
    return false;
}

function Rechercher_Liste_Article_Caddie($connexionPDO, $idCommande)
{
    $requetePreparee = $connexionPDO->prepare('
    select commande_avoir_article.*, produit.*, categorie.libelle as libelleCat, tva.*
    from commande_avoir_article  
        inner join produit
            on commande_avoir_article.idProduit  = produit.idProduit
        inner join categorie
            on produit.idCategorie  = categorie.idCategorie 
        inner join tva
            on tva.idTVA = produit.idTVA
    where commande_avoir_article.idCommande = :idCommande
    
    ');
    $requetePreparee->bindValue('idCommande', $idCommande);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    $tableauReponse = $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    /*   var_dump($idProduit, $idCommande);
       var_dump($tableauReponse);*/
    if(count($tableauReponse) >= 1)
        return $tableauReponse;
    return false;
}

function Rechercher_Article_Caddie($connexionPDO, $idCommande, $idProduit)
{
    $requetePreparee = $connexionPDO->prepare('
    select commande_avoir_article.*
    from commande_avoir_article  
    where commande_avoir_article.idCommande = :idCommande
    and commande_avoir_article.idProduit = :idProduit
    ');
    $requetePreparee->bindValue('idCommande', $idCommande);
    $requetePreparee->bindValue('idProduit', $idProduit);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    $tableauReponse = $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
 /*   var_dump($idProduit, $idCommande);
    var_dump($tableauReponse);*/
    if(count($tableauReponse) >= 1)
        return $tableauReponse[0];
    return false;
}

function CommandeAvoirArticle_SupprimerArticle($connexionPDO, $idCommande, $idProduit)
{
    $requetePreparee = $connexionPDO->prepare(
        'delete commande_avoir_article.* from `commande_avoir_article`
         where `idCommande` = :idCommande
         and  `idProduit` = :idProduit');
    $requetePreparee->bindParam('idCommande', $idCommande);
    $requetePreparee->bindParam('idProduit', $idProduit);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    //echo $reponse;
}

function CommandeAvoirArticle_ChangerQuantite($connexionPDO, $idCommande, $idProduit, $quantite)
{
    $requetePreparee = $connexionPDO->prepare(
        'UPDATE `commande_avoir_article`
         set quantite = :quantite
         where `idCommande` = :idCommande
         and  `idProduit` = :idProduit');
    $requetePreparee->bindParam('idCommande', $idCommande);
    $requetePreparee->bindParam('idProduit', $idProduit);
    $requetePreparee->bindParam('quantite', $quantite);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    //echo $reponse;
}

function CommandeAvoirArticle_Ajouter_Article($connexionPDO, $idCommande, $idProduit)
{
    $produit = Produit_Select_ParId($connexionPDO, $idProduit);

    $requetePreparee = $connexionPDO->prepare(
        'INSERT INTO `commande_avoir_article` (`idCommande`, `idProduit`, `quantite`, `prixHT`, `tauxTVA`) 
         VALUES ( :idCommande, :idProduit, 1, :prixVenteHT, :pourcentageTVA);');
    $requetePreparee->bindParam('idCommande', $idCommande);
    $requetePreparee->bindParam('idProduit', $idProduit);
    $requetePreparee->bindParam('prixVenteHT', $produit["prixVenteHT"]);
    $requetePreparee->bindParam('pourcentageTVA', $produit["pourcentageTVA"]);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
}

function Ajouter_Produit_Panier($connexionPDO, $idEntreprise, $idProduit)
{
    //On recherche si l'entreprise a un panier existant
    $panier = Rechercher_Caddie_Entreprise($connexionPDO, $idEntreprise);

    if($panier == false) {
        // On crée le panier
        $date = date("Y-m-d H:i:s");
        $requetePreparee = $connexionPDO->prepare(
            'INSERT INTO cafe.commande (id, dateCreation, idEntreprise, etat) 
         VALUES (1, :date, :idEntreprise, 1);');


        $requetePreparee->bindParam(':date', $date);
        $requetePreparee->bindParam(':idEntreprise', $idEntreprise);

        $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
        //echo $reponse;
        $idPanier = $connexionPDO->lastInsertId();
    }
    else
    {
        $idPanier = $panier["id"];
    }
    //on recherche si l'article est déjà dans le panier
    $article = Rechercher_Article_Caddie($connexionPDO, $idPanier, $idProduit);
    if($article == false)
    {
        // On ajoute l'article au panier
        CommandeAvoirArticle_Ajouter_Article($connexionPDO,$idPanier, $idProduit);
    }
    else
    {

        CommandeAvoirArticle_ChangerQuantite($connexionPDO,$idPanier, $idProduit, $article["quantite"] +1);

    }

}


function Panier_DiminuerQTT_Article($connexionPDO, $idEntreprise, $idProduit)
{
    $panier = Rechercher_Caddie_Entreprise($connexionPDO, $idEntreprise);


    $idPanier = $panier["id"];

    //on recherche si l'article est déjà dans le panier
    $article = Rechercher_Article_Caddie($connexionPDO, $idPanier, $idProduit);
    if($article != false) {
        if ($article["quantite"] - 1 <= 0) {
            CommandeAvoirArticle_SupprimerArticle($connexionPDO, $idPanier, $idProduit);
        } else {
            CommandeAvoirArticle_ChangerQuantite($connexionPDO, $idPanier, $idProduit, $article["quantite"] - 1);
        }
    }

}

function Panier_AugmenterQTT_Article($connexionPDO, $idEntreprise, $idProduit)
{
    $panier = Rechercher_Caddie_Entreprise($connexionPDO, $idEntreprise);


        $idPanier = $panier["id"];

    //on recherche si l'article est déjà dans le panier
    $article = Rechercher_Article_Caddie($connexionPDO, $idPanier, $idProduit);

    CommandeAvoirArticle_ChangerQuantite($connexionPDO,$idPanier, $idProduit, $article["quantite"] +1);

}

function Panier_ListeArticle($connexionPDO, $idEntreprise)
{
    $panier = Rechercher_Caddie_Entreprise($connexionPDO, $idEntreprise);
    if($panier == false) {
        return [];
    }
    else{
        $listeProduits = Rechercher_Liste_Article_Caddie($connexionPDO, $panier["id"]);

        return $listeProduits;
    }
}



function Panier_Quantite($connexionPDO, $idEntreprise)
{
    $panier = Rechercher_Caddie_Entreprise($connexionPDO, $idEntreprise);
    if($panier == false) {
        return 0;
    }
    else{
        $listeProduits = Rechercher_Liste_Article_Caddie($connexionPDO, $panier["id"]);

        $cnt = 0;
        foreach($listeProduits as $produit)
        {
            $cnt += $produit["quantite"];
        }
        return $cnt;
    }
}

function Commande_Valider_Caddie($connexionPDO, $idCommande)
{
    $requetePreparee = $connexionPDO->prepare(
        'UPDATE `commande`
         set etat = 2
         where `id` = :idCommande
         ');
    $requetePreparee->bindParam('idCommande', $idCommande);

    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    //echo $reponse;
}