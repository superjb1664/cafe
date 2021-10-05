<?php
function Niveau_Autorisation_Select($connexionPDO)
{
    $requetePreparee = $connexionPDO->prepare('
        select * 
        from `niveau_autorisation` 
        ');
    $reponse = $requetePreparee->execute(); //$reponse boolean sur l'état de la requête

    $tableauReponse = $requetePreparee->fetchAll(PDO::FETCH_ASSOC);
    return $tableauReponse;
}