<?php
/**
 * @param $connexionPDO : connexion à la base de données
 * @return mixed : le tableau des étudiants ou null (something went wrong...)
 */
function Utilisateur_Select($connexionPDO)
{
    $requetePreparee = $connexionPDO->prepare('select * from `utilisateur` order by login');
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    $tableauReponse = $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    return $tableauReponse;
}

/**
 * @param $connexionPDO
 * @param $idUtilisateur
 * @return mixed
 */
function Utilisateur_Select_ParId($connexionPDO, $idUtilisateur)
{
    $requetePreparee = $connexionPDO->prepare('select * from `utilisateur` where idUtilisateur = :paramId');
    $requetePreparee->bindParam('paramId', $idUtilisateur);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    $etudiant = $requetePreparee->fetch(PDO::FETCH_ASSOC);
    return $etudiant;
}

/**
 * @param $connexionPDO
 * @param $idUtilisateur
 * @return mixed
 */
function Utilisateur_Select_ParLogin($connexionPDO, $login)
{
    $requetePreparee = $connexionPDO->prepare('select * from `utilisateur` where login = :paramLogin');
    $requetePreparee->bindParam('paramLogin', $login);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    $etudiant = $requetePreparee->fetch(PDO::FETCH_ASSOC);
    return $etudiant;
}

/**
 * @param $connexionPDO
 * @param $login
 * @param $niveauAutorisation
 * @return mixed
 */
function Utilisateur_Creer($connexionPDO, $login, $niveauAutorisation)
{

    $requetePreparee = $connexionPDO->prepare(
        'INSERT INTO `utilisateur` (`idUtilisateur`, `login`, `niveauAutorisation`, `motDePasse`) 
         VALUES (NULL, :paramlogin, :paramniveauAutorisation, "");');

    $requetePreparee->bindParam('paramlogin', $login);
    $requetePreparee->bindParam('paramniveauAutorisation', $niveauAutorisation);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    $idUtilisateur = $connexionPDO->lastInsertId();
    $desactiver = 0;
    Utilisateur_Modifier_Desactivation($connexionPDO, $idUtilisateur, $desactiver);
    Utilisateur_Modifier_motDePasse($connexionPDO, $idUtilisateur, "secret");
    return $idUtilisateur;
}

/**
 * @param $connexionPDO
 * @param $idUtilisateur
 * @return mixed
 */
function Utilisateur_Supprimer($connexionPDO, $idUtilisateur)
{

    $requetePreparee = $connexionPDO->prepare('delete utilisateur.* from `utilisateur` where idUtilisateur = :paramId');
    $requetePreparee->bindParam('paramId', $idUtilisateur);
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
function Utilisateur_Modifier($connexionPDO, $idUtilisateur, $login, $niveauAutorisation)

{

    $requetePreparee = $connexionPDO->prepare(
        'UPDATE `utilisateur` 
SET `login`= :paramlogin,
`niveauAutorisation`= :paramniveauAutorisation
WHERE idUtilisateur = :paramidUtilisateur');
    $requetePreparee->bindParam('paramlogin', $login);
    $requetePreparee->bindParam('paramniveauAutorisation', $niveauAutorisation);
    $requetePreparee->bindParam('paramidUtilisateur', $idUtilisateur);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    return $reponse;
}

// fonction pour activer ou désactiver un utilisateur
function Utilisateur_Modifier_Desactivation($connexionPDO, $idUtilisateur, $desactiver)

{

    $requetePreparee = $connexionPDO->prepare(
        'UPDATE `utilisateur` 
SET `desactiver`= :paramdesactiver
WHERE idUtilisateur = :paramidUtilisateur');
    $requetePreparee->bindParam('paramdesactiver', $desactiver);
    $requetePreparee->bindParam('paramidUtilisateur', $idUtilisateur);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    return $reponse;
}


/**
 * @param $connexionPDO
 * @param $idUtilisateur
 * @param $motDePasseClair
 * @return mixed
 */
function Utilisateur_Modifier_motDePasse($connexionPDO, $idUtilisateur, $motDePasseClair)

{
    $parammotDePasseHache = password_hash($motDePasseClair, PASSWORD_DEFAULT);

    $requetePreparee = $connexionPDO->prepare(
        'UPDATE `utilisateur` 
SET motDePasse = :parammotDePasseHache
WHERE idUtilisateur = :paramidUtilisateur');
    $requetePreparee->bindParam('parammotDePasseHache', $parammotDePasseHache);
    $requetePreparee->bindParam('paramidUtilisateur', $idUtilisateur);
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête
    return $reponse;
}

