<?php


function Salarie_Modifier_motDePasse($connexionPDO, $idSalarie, $motDePasseClair)

{
    $parammotDePasseHache = password_hash($motDePasseClair, PASSWORD_DEFAULT);

    $requetePreparee = $connexionPDO->prepare(
        'UPDATE `salarie` 
SET password = :parammotDePasseHache
WHERE idSalarie = :paramidUtilisateur');
    $requetePreparee->bindParam('parammotDePasseHache', $parammotDePasseHache);
    $requetePreparee->bindParam('paramidUtilisateur', $idSalarie);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    return $reponse;
}

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
    if(count($tableauReponse) > 0)
        return $tableauReponse[0];
    else
        return false;
}

function Salarie_Select_byMail($connexionPDO, $mail)
{
    $requetePreparee = $connexionPDO->prepare('
        select * 
        from `salarie`
        where mail = :mail');
    $requetePreparee->bindParam('mail', $mail);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête

    $tableauReponse = $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    if(count($tableauReponse) > 0)
        return $tableauReponse[0];
    else
        return false;
}

function Salarie_Ajouter($connexionPDO,  $nom, $prenom, $roleEntreprise, $mail, $password, $actif, $idEntreprise)
{
    $passwordCrypte = password_hash($password, PASSWORD_DEFAULT);
    $requetePreparee = $connexionPDO->prepare(' 
        insert into `salarie` ( nom, prenom, roleEntreprise, mail, password, actif, idEntreprise) 
        VALUE ( :nom, :prenom, :roleEntreprise, :mail, \''.$passwordCrypte.'\', :actif, :idEntreprise)');
    $requetePreparee->bindParam('nom', $nom);
    $requetePreparee->bindParam('prenom', $prenom);
    $requetePreparee->bindParam('roleEntreprise', $roleEntreprise);
    $requetePreparee->bindParam('mail', $mail);
    $requetePreparee->bindParam('actif', $actif);
    $requetePreparee->bindParam('idEntreprise', $idEntreprise);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête

    return $reponse;
}


function Salarie_MAJ($connexionPDO,  $nom, $prenom, $roleEntreprise, $mail, $idSalarie)
{
    $requetePreparee = $connexionPDO->prepare(
        'UPDATE `salarie` 
        SET `nom`= :nom,
            `prenom`= :prenom,
            `roleEntreprise`= :roleEntreprise,
            `mail`= :mail
        WHERE idSalarie = :idSalarie');
    $requetePreparee->bindParam('nom', $nom);
    $requetePreparee->bindParam('prenom', $prenom);
    $requetePreparee->bindParam('roleEntreprise', $roleEntreprise);
    $requetePreparee->bindParam('mail', $mail);
    $requetePreparee->bindParam('idSalarie', $idSalarie);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    return $reponse;


}

function Salarie_Desactiver($connexionPDO, $idSalarie)
{
    $requetePreparee = $connexionPDO->prepare('
        update salarie
        set actif = 0 
        where idSalarie = :idSalarie');
    $requetePreparee->bindParam('idSalarie', $idSalarie);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
}
function Salarie_Activer($connexionPDO, $idSalarie)
{
    $requetePreparee = $connexionPDO->prepare('
        update salarie
        set actif = 1
        where idSalarie = :idSalarie');
    $requetePreparee->bindParam('idSalarie', $idSalarie);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
}

function Salarie_AccepterRGPD($connexionPDO, $idSalarie){
    $requetePreparee = $connexionPDO->prepare('
        update salarie
        set bRGPD = 1,
            dateRGPD = :dateAct
        where idSalarie = :idSalarie');
    $requetePreparee->bindParam('idSalarie', $idSalarie);
    $dateAct = date("Y-m-d H:i:s");
    $requetePreparee->bindParam('dateAct', $dateAct);
    $reponse = $requetePreparee->execute();
}