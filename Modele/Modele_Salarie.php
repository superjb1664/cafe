<?php
function Salarie_Select_Entreprise($connexionPDO, $idEntreprise)
{
    $requetePreparee = $connexionPDO->prepare('
        select * 
        from `salarie` 
        where idEntreprise = :idEntreprise
         order by salarie.nom, salarie.prenom');
    $requetePreparee->bindParam('idEntreprise', $idEntreprise);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête

    $tableauReponse = $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    return $tableauReponse;
}

function Salarie_Select_byId($connexionPDO, $idSalarie)
{
    $requetePreparee = $connexionPDO->prepare('
        select * 
        from `salarie`
        where idSalarie = :idSalarie');
    $requetePreparee->bindParam('idSalarie', $idSalarie);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête

    $tableauReponse = $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    return $tableauReponse;
}

function Salarie_Ajouter($connexionPDO,  $nom, $prenom, $roleEntreprise, $mail, $password, $actif, $idEntreprise)
{
    $requetePreparee = $connexionPDO->prepare('
        insert into `salarie` ( nom, prenom, roleEntreprise, mail, password, actif, idEntreprise) 
        VALUE ( :nom, :prenom, :roleEntreprise, :mail, :password, :actif, :idEntreprise)');
    $requetePreparee->bindParam('nom', $nom);
    $requetePreparee->bindParam('prenom', $prenom);
    $requetePreparee->bindParam('roleEntreprise', $roleEntreprise);
    $requetePreparee->bindParam('mail', $mail);
    $requetePreparee->bindParam('password', $password);
    $requetePreparee->bindParam('actif', $actif);
    $requetePreparee->bindParam('idEntreprise', $idEntreprise);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête

    return $reponse;
}

function Salarie_Desactiver($connexionPDO, $idSalarie)
{
    $requetePreparee = $connexionPDO->prepare('
        update salarie
        set actif = 0 
        where id = :idSalarie');
    $requetePreparee->bindParam('idSalarie', $idSalarie);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
}
function Salarie_Activer($connexionPDO, $idSalarie)
{
    $requetePreparee = $connexionPDO->prepare('
        update salarie
        set actif = 1
        where id = :idSalarie');
    $requetePreparee->bindParam('idSalarie', $idSalarie);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
}