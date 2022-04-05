<?php

function Token_Invalider_byId($connexionPDO, $id)
{
    $requetePreparee = $connexionPDO->prepare('
        update `token`
        set valide = 0
        where id = :id');
    $requetePreparee->bindParam('id', $id);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête

}

function Token_Select_byValeur($connexionPDO, $valeur)
{
    $tab = explode("_",$valeur);
    $id = $tab[0];
    $valueClair = $tab[1];
    $requetePreparee = $connexionPDO->prepare('
        select * 
        from `token`
        where id = :id
        and valide = 1');
    $requetePreparee->bindParam('id', $id);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête

    $token = $requetePreparee->fetch(PDO::FETCH_ASSOC);
    if($token != null)
    {
        if(password_verify($valueClair, $token["valeur"]))
        {
            return $token;
        }
        else
            return false;
    }
        else
        { return false;}
}

function Token_Ajouter($connexionPDO,   $idUtilisateur, $action) : string
{
    $octetsAleatoires = openssl_random_pseudo_bytes (256) ;
    $jeton = sodium_bin2base64($octetsAleatoires, SODIUM_BASE64_VARIANT_ORIGINAL);

    $jetonHash=password_hash($jeton,PASSWORD_DEFAULT);
    $requetePreparee = $connexionPDO->prepare("
  INSERT INTO `token`( `valeur`, `idUtilisateur`, `action`) 
  VALUES (:valeur,:idUtilisateur,:action) ;");
    $requetePreparee->bindParam('valeur', $jetonHash);
    $requetePreparee->bindParam('idUtilisateur', $idUtilisateur);
    $requetePreparee->bindParam('action', $action);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête

    $id = $connexionPDO->lastInsertId();
    return $id."_".$jeton;
}


