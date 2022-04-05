create table categorie
(
	idCategorie int auto_increment
		primary key,
	libelle text not null,
	description text not null,
	desactiverCategorie tinyint(1) not null
);

create table entreprise
(
	idEntreprise int auto_increment
		primary key,
	denomination text not null,
	rueAdresse text not null,
	complementAdresse text not null,
	codePostal text not null,
	ville text not null,
	pays text not null,
	numCompte text null,
	mailContact text not null,
	siret text null,
	motDePasse text not null,
	desactiver tinyint(1) null,
	forceRenew bit not null,
	dateRenewMdp datetime null
);

create table commande
(
	id int auto_increment
		primary key,
	dateCreation datetime null,
	idEntreprise int not null,
	etat int null comment '1 : Caddie
2 : Commande confirm├®e, en attente de virement
3 : Commande pay├®e, virement re├ºu
4 : Commande en pr├®paration
5 : Commande en attente approvisionnement
6 : Commande exp├®di├®e
7 : Commande re├ºue par le client
8 : Commande avec incident livraison
9 : Commande avec r├®exp├®dition entraine une autre commande
10 : Commande en attente de retour
11 : Commande retourn├®e re├ºue, en attente de remboursement
12 : Commande retourn├®e rembours├®e
13 : Commande rembours├®e sans retour client',
	constraint idUtilisateur
		foreign key (id) references entreprise (idEntreprise)
);

create table etat_commande
(
	idEtatCommande int not null
		primary key,
	libelle text not null
);

create table historique_etat_commande
(
	idHistorique int auto_increment
		primary key,
	idCommande int not null,
	etat int not null,
	dateHeure datetime not null,
	infoComplementaire text not null,
	idSalarie int null,
	idUtilisateur int null
);

create table niveau_autorisation
(
	idNiveauAutorisation int auto_increment
		primary key,
	libelle text not null
);

create table produit
(
	idProduit int auto_increment
		primary key,
	nom text not null,
	description text not null,
	resume text not null,
	fichierImage text not null,
	prixVenteHT decimal not null,
	idCategorie int not null,
	idTVA decimal not null,
	desactiverProduit tinyint(1) not null,
	reference text null,
	constraint FK_produit
		foreign key (idCategorie) references categorie (idCategorie)
);

create table commande_avoir_article
(
	idCommande int not null,
	idProduit int not null,
	quantite int not null,
	prixHT float not null,
	tauxTVA float not null,
	primary key (idCommande, idProduit),
	constraint commande_avoir_article_commande_id_fk
		foreign key (idCommande) references commande (id),
	constraint commande_avoir_article_produit_idProduit_fk
		foreign key (idProduit) references produit (idProduit)
);

create table salarie
(
	idSalarie int auto_increment
		primary key,
	nom text not null,
	prenom text not null,
	mail text not null,
	idEntreprise int not null,
	roleEntreprise text not null,
	password text null,
	actif bit null,
	bRGPD tinyint(1) not null,
	dateRGPD datetime null
);

create table token
(
	id int auto_increment
		primary key,
	valeur text not null,
	dateTime datetime default current_timestamp() not null,
	idUtilisateur int not null,
	action text not null,
	valide tinyint(1) default 1 not null
);

create table tva
(
	idTVA int auto_increment
		primary key,
	pourcentageTVA float not null
);

create table utilisateur
(
	idUtilisateur int auto_increment
		primary key,
	login text not null,
	motDePasse text not null,
	niveauAutorisation int not null,
	desactiver tinyint(1) null
);


