<?php

function Liste_Commande_Toute($connexionPDO)
{
    $requetePreparee = $connexionPDO->prepare('
    select commande.id, commande.dateCreation, sum(commande_avoir_article.prixHT * commande_avoir_article.quantite) as prixTotalHT, sum(commande_avoir_article.prixHT * (1+commande_avoir_article.tauxTVA) * commande_avoir_article.quantite) as prixTotalTTC, sum(commande_avoir_article.quantite) as nbProduit, etat_commande.libelle as libEtat, denomination
    from commande
        inner join commande_avoir_article
            on commande.id = commande_avoir_article.idCommande
        inner join produit p 
            on commande_avoir_article.idProduit = p.idProduit 
        inner join etat_commande
            on idEtatCommande = commande.etat
       inner join entreprise
            on entreprise.idEntreprise = commande.idEntreprise
    group by commande.id, commande.dateCreation, etat_commande.libelle');
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    $tableauReponse = $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    //  var_dump($tableauReponse);
    //  var_dump($idEntreprise);
    return $tableauReponse;
}

function Liste_Commande_Etat($connexionPDO, $idEtatCommande)
{
    $requetePreparee = $connexionPDO->prepare('
    select commande.id, commande.dateCreation, sum(commande_avoir_article.prixHT * commande_avoir_article.quantite) as prixTotalHT, sum(commande_avoir_article.prixHT * (1+commande_avoir_article.tauxTVA) * commande_avoir_article.quantite) as prixTotalTTC, sum(commande_avoir_article.quantite) as nbProduit, etat_commande.libelle as libEtat, denomination
    from commande
        inner join commande_avoir_article
            on commande.id = commande_avoir_article.idCommande
        inner join produit p 
            on commande_avoir_article.idProduit = p.idProduit 
        inner join etat_commande
            on idEtatCommande = commande.etat
        inner join entreprise
            on entreprise.idEntreprise = commande.idEntreprise
    
        where  idEtatCommande = :idEtatCommande
    group by commande.id, commande.dateCreation, etat_commande.libelle');
    $requetePreparee->bindValue('idEtatCommande', $idEtatCommande);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    $tableauReponse = $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    //  var_dump($tableauReponse);
    //  var_dump($idEntreprise);
    return $tableauReponse;
}

function Liste_Commande_Entreprise($connexionPDO, $idEntreprise)
{
    $requetePreparee = $connexionPDO->prepare('
    select commande.id, commande.dateCreation, sum(commande_avoir_article.prixHT * commande_avoir_article.quantite) as prixTotalHT, sum(commande_avoir_article.prixHT * (1+commande_avoir_article.tauxTVA) * commande_avoir_article.quantite) as prixTotalTTC, sum(commande_avoir_article.quantite) as nbProduit, etat_commande.libelle as libEtat
    from commande
        inner join commande_avoir_article
            on commande.id = commande_avoir_article.idCommande
        inner join produit p 
            on commande_avoir_article.idProduit = p.idProduit
        inner join historique_etat_commande hec 
            on commande.etat = hec.etat and commande_avoir_article.idCommande = commande.id
        inner join etat_commande
            on idEtatCommande = commande.etat
        where idEntreprise = :idEntreprise
    and commande.etat != 1
    group by commande.id, commande.dateCreation, etat_commande.libelle');
    $requetePreparee->bindValue('idEntreprise', $idEntreprise);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    $tableauReponse = $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    //  var_dump($tableauReponse);
    //  var_dump($idEntreprise);
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

function Rechercher_Historique_Commande($connexionPDO, $idCommande)
{
    $requetePreparee = $connexionPDO->prepare('
    select EC.*, HEC.*
    from historique_etat_commande HEC
        inner join etat_commande EC on HEC.etat = EC.idEtatCommande 
    where HEC.idCommande = :idCommande
order by HEC.dateHeure desc
    
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

function Rechercher_Commande($connexionPDO, $idCommande)
{
    $requetePreparee = $connexionPDO->prepare('
    select commande.*
    from commande
    where id = :idCommande
    
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

function Rechercher_Liste_Article_Commande($connexionPDO, $idCommande)
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
            'INSERT INTO cafe.commande ( dateCreation, idEntreprise, etat) 
         VALUES ( :date, :idEntreprise, 1);');


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
        $listeProduits = Rechercher_Liste_Article_Commande($connexionPDO, $panier["id"]);

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
        $listeProduits = Rechercher_Liste_Article_Commande($connexionPDO, $panier["id"]);

        $cnt = 0;
        foreach($listeProduits as $produit)
        {
            $cnt += $produit["quantite"];
        }
        return $cnt;
    }
}

function HistoriqueEtatCommande_Inserer($connexionPDO, $idCommande, $etat, $infoComplementaire = "")
{
    $requetePreparee = $connexionPDO->prepare(
        'insert into `historique_etat_commande` (idCommande, etat, dateHeure, infoComplementaire)  
        values (:idCommande, :etat, :dateHeure, :infoComplementaire) ');
    $requetePreparee->bindParam('idCommande', $idCommande);
    $date = date("Y-m-d H:i:s");
    $requetePreparee->bindParam('etat', $etat);
    $requetePreparee->bindParam('dateHeure', $date);
    $requetePreparee->bindParam('infoComplementaire', $infoComplementaire);

    $reponse = $requetePreparee->execute();
}

function Commande_Valider_Caddie($connexionPDO, $idCommande, $idSalarie)
{
    $requetePreparee = $connexionPDO->prepare(
        'UPDATE `commande`
         set etat = 2
         where `id` = :idCommande
         ');

    $salarie = Salarie_Select_byId($connexionPDO, $idSalarie);
    HistoriqueEtatCommande_Inserer($connexionPDO,$idCommande, 2, "Commande passée par $salarie[nom] $salarie[prenom]");
    $requetePreparee->bindParam('idCommande', $idCommande );

    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    //echo $reponse;
}

Function EtatCommande_Liste($connexionPDO){
    $requetePreparee = $connexionPDO->prepare('
    select etat_commande.*
    from etat_commande  
    ');
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    $tableauReponse = $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    /*   var_dump($idProduit, $idCommande);
       var_dump($tableauReponse);*/
    if(count($tableauReponse) >= 1)
        return $tableauReponse;
    return false;
}