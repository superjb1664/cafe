create table commande
(
    id           int auto_increment
        primary key,
    dateCreation datetime null,
    idEntreprise int      not null,
    etat         int      null comment '1 : Caddie
2 : Commande confirmée, en attente de virement
3 : Commande payée, virement reçu
4 : Commande en préparation
5 : Commande en attente approvisionnement
6 : Commande expédiée
7 : Commande reçue par le client
8 : Commande avec incident livraison
9 : Commande avec réexpédition entraine une autre commande
10 : Commande en attente de retour
11 : Commande retournée reçue, en attente de remboursement
12 : Commande retournée remboursée
13 : Commande remboursée sans retour client',
    constraint idUtilisateur
        foreign key (id) references entreprise (idEntreprise)
);


