create table commande_avoir_article
(
    idCommande int   not null,
    idProduit  int   not null,
    quantite   int   not null,
    prixHT     float not null,
    tauxTVA    float not null,
    primary key (idCommande, idProduit),
    constraint commande_avoir_article_commande_id_fk
        foreign key (idCommande) references commande (id),
    constraint commande_avoir_article_produit_idProduit_fk
        foreign key (idProduit) references produit (idProduit)
);


