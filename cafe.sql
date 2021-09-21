-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 20 sep. 2021 à 18:23
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cafe`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `idCategorie` int(11) NOT NULL,
  `libelle` text NOT NULL,
  `description` text NOT NULL,
  `desactiverCategorie` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`idCategorie`, `libelle`, `description`, `desactiverCategorie`) VALUES
(10, 'Infusion', '', 0),
(11, 'Infusion triangle', '', 0),
(12, 'Infusion vrac', '', 0),
(15, 'Thé triangle', '', 0),
(16, 'Thé vrac', '', 0),
(17, 'Capsule', '', 0),
(18, 'Grain', '', 0),
(19, 'Moulu', '', 0),
(20, 'Rooibos', '', 0),
(21, 'Accompagnements', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `idEntreprise` int(11) NOT NULL,
  `denomination` text NOT NULL,
  `rueAdresse` text NOT NULL,
  `complementAdresse` text NOT NULL,
  `codePostal` text NOT NULL,
  `ville` text NOT NULL,
  `pays` text NOT NULL,
  `numCompte` text DEFAULT NULL,
  `mailContact` text NOT NULL,
  `siret` text DEFAULT NULL,
  `motDePasse` text NOT NULL,
  `desactiver` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`idEntreprise`, `denomination`, `rueAdresse`, `complementAdresse`, `codePostal`, `ville`, `pays`, `numCompte`, `mailContact`, `siret`, `motDePasse`, `desactiver`) VALUES
(1, 'Flipstorm', '713 Fieldstone Avenue', '', '41015 CEDEX', 'Blois', 'France', 'Flipstor_1', 'contact@flipstorm.com', '455 256 510 00013', '$2y$10$uCugRM3Ml9V9v2ktHmZMC.50qAELmYIhxS.5gkESmI5LOhyZnCbom', 0),
(2, 'Skimia', '08 Hansons Hill', '', '59073 CEDEX 1', 'Roubaix', 'France', 'Skimia_2', 'contact@skimia.com', '826 537 170 00001', '$2y$10$BT7I7kict54PEqcTFxBI0Oexhm.uSb2V.eUcVPVNbORLKY/jRlGC6', 0),
(3, 'Oozz', '54 Morningstar Crossing', '', '85164 CEDEX', 'Saint-Jean-de-Monts', 'France', 'Oozz_3', 'contact@oozz.com', '742 092 550 00034', '$2y$10$.WEl0wqb8L1QrW.cf8fZDudsmyMtl5xK1/s8F8Sh7muryWnSmxnUS', 0),
(4, 'Browsecat', '974 Erie Place', '', '63019 CEDEX 2', 'Clermont-Ferrand', 'France', 'Browseca_4', 'contact@browsecat.com', '670 813 160 00033', '$2y$10$r2Z4vnAU5nf27vCWC6oUwOYVPAy2W0DIohz82HFGEU4m/3PECkFzS', 0),
(5, 'Realbridge', '7563 Marcy Circle', '', '76069 CEDEX', 'Le Havre', 'France', 'Realbrid_5', 'contact@realbridge.com', '587 508 140 00023', '$2y$10$WmZkp5QazUR55zcdq.atLeT/1dMojItuomPTNz5iDKk8PbpLArrE6', 0),
(6, 'Gabcube', '6 Anzinger Pass', '', '44815 CEDEX', 'Saint-Herblain', 'France', 'Gabcube_6', 'contact@gabcube.com', '881 364 150 00022', '$2y$10$uiS8/jWHX6KT0GC9FSMK8OQmI1GlkyyN8.W7gJ/fizyhwQ7oeBLbW', 0),
(7, 'Edgeblab', '32 rue de la Mairie', '', '57954 CEDEX', 'Montigny-lès-Arsures', 'France', 'Edgeblab_7', 'contact@edgeblab.com', '89481970000331', '$2y$10$uMQxDrMEgfVsKgeEazE57u0Pnqe3k8xYmRH8v9JflmSfsboPAUFFC', 0),
(8, 'Twimm', '92878 Coolidge Street', '', '16015 CEDEX', 'Angoulême', 'France', 'Twimm_8', 'contact@twimm.com', '890 567 220 00011', '$2y$10$1UkE68Js5Uot2M66H7FDWeCC45nVX7OhE5PX2b2CMLZr1gk0zQiNG', 0),
(9, 'Jetwire', '1907 Westridge Point', '', '92715 CEDEX', 'Colombes', 'France', 'Jetwire_9', 'contact@jetwire.com', '902 078 750 00012', '$2y$10$kIgaANjGPRQLADFfRI00V.ktVBWZ7EIWPK93.joHepWSvUBt6rbyu', 0),
(10, 'Topiclounge', '8 Randy Pass', '', '94174 CEDEX', 'Le Perreux-sur-Marne', 'France', 'Topiclou_10', 'contact@topiclounge.com', '335 164 270 00001', '$2y$10$401B4ex8kMjy.1yomfnEnONkI9FjkYm9CbMONdhcIdxRJqpbcjJxS', 0),
(11, 'Kazio', '26478 Glendale Way', '', '64109 CEDEX', 'Bayonne', 'France', 'Kazio_11', 'contact@kazio.com', '529 846 650 00024', '$2y$10$p2tzuX.sZDf1qUgn9rJjR.lMkPxTMKlUsxf83tj1CYW0wegKWwxZu', 0),
(12, 'Devbug', '34 Brentwood Alley', '', '51086 CEDEX', 'Reims', 'France', 'Devbug_12', 'contact@devbug.com', '064 955 660 00002', '$2y$10$IHrXuY.YBkZ3OiiPGe2unOzhSwJUa6Qhb8dd5ci4krDF6X1GKEiJO', 0),
(13, 'Oyondu', '38328 Union Alley', '', '91893 CEDEX', 'Orsay', 'France', 'Oyondu_13', 'contact@oyondu.com', '575 599 890 00002', '$2y$10$HfOEY4iDB66G9tUuL14al.DuNtm3gbCYw8i5FilAOxT5iskdhGd86', 0),
(14, 'Bubblebox', '4 Glacier Hill Center', '', '47304 CEDEX', 'Villeneuve-sur-Lot', 'France', 'Bubblebo_14', 'contact@bubblebox.com', '705 327 830 00034', '$2y$10$04DAtrGJ07mUJAirqgsz7eYQ8D82a7GfgeJZda9u04.mMiUHctxXy', 0),
(15, 'Voonder', '069 South Road', '', '06306 CEDEX 4', 'Nice', 'France', 'Voonder_15', 'contact@voonder.com', '652 956 570 00012', '$2y$10$KcHZvab6tyBytqV7qWcqbee0bMQFr3heeoc9CamPNpq4irHtkhKvO', 0),
(16, 'Oozz', '99977 Anderson Crossing', '', '92174 CEDEX', 'Vanves', 'France', 'Oozz_16', 'contact@oozz.com', '733 160 800 00013', '$2y$10$GEbzMYu78XfIozv4mu04Me1hrXvArd8dfm1TGQeBROCl89qfQrQOm', 0),
(17, 'Edgeblab', '2463 Crownhardt Circle', '', '76124 CEDEX', 'Le Grand-Quevilly', 'France', 'Edgeblab_17', 'contact@edgeblab.com', '133 696 800 00001', '$2y$10$GfG4lG4IR5ttnWQRemnJBey5GihJsqx9ZaREGh8NUwfC1M8SUWx/G', 0),
(18, 'Brainverse', '0 Hazelcrest Parkway', '', '75220 CEDEX 16', 'Paris 16', 'France', 'Brainver_18', 'contact@brainverse.com', '603 037 210 00011', '$2y$10$81MqCV6NcfRQ14LhiH4B2OaY2aYxe8/HHl0kSkKhpuZLlyDQ678G.', 0),
(19, 'Twimbo', '8359 Troy Court', '', '33709 CEDEX', 'Mérignac', 'France', 'Twimbo_19', 'contact@twimbo.com', '675 241 060 00002', '$2y$10$cyuFe6wN5/E2Nj3A92Ey9ORbbf6nFuxvP5ZghE/Ya1X4W9nKTjCti', 0),
(20, 'Zoombox', '0 Oxford Lane', '', '47211 CEDEX', 'Marmande', 'France', 'Zoombox_20', 'contact@zoombox.com', '477 672 940 00012', '$2y$10$jSv7dLqEh6sUPY3GG.cDD.e0VBZYKIfmLNDzIcbQeUGDCciby6ND6', 0),
(21, 'Edgeify', '27 Farragut Lane', '', '88109 CEDEX', 'Saint-Dié-des-Vosges', 'France', 'Edgeify_21', 'contact@edgeify.com', '897 596 980 00002', '$2y$10$sp7/gnczz6j3diUHStFMxOWW1Le7pq9/CLRaDZz6oRQTQr8GPoJ52', 0),
(22, 'Jazzy', '30647 Vidon Plaza', '', '92855 CEDEX', 'Rueil-Malmaison', 'France', 'Jazzy_22', 'contact@jazzy.com', '130 796 000 00011', '$2y$10$oZsrkbpzxFmzCvykEuHZ3uwXmYmu35s9hREuykQjiIYU4gxiLbQpy', 0),
(23, 'Jazzy', '22 Iowa Road', '', '88504 CEDEX', 'Mirecourt', 'France', 'Jazzy_23', 'contact@jazzy.com', '287 966 040 00001', '$2y$10$5qFd/Vimt5Lf6dB7Oj2qbuhDM43KBFtFoRBR05K2cWk1ytnrcnfN.', 0),
(24, 'Tagpad', '31 Upham Trail', '', '72004 CEDEX 1', 'Le Mans', 'France', 'Tagpad_24', 'contact@tagpad.com', '821 738 200 00012', '$2y$10$D1A9ogtEj1t3kc4OKltIbexIClYGUjbakWfWRPrUK0Zl0xhXoqEKS', 0),
(25, 'Blogtags', '8431 South Court', '', '83164 CEDEX', 'La Valette-du-Var', 'France', 'Blogtags_25', 'contact@blogtags.com', '88481276000012', '$2y$10$kZnQLA6Qr3mjF4sUZAzihO3gRaT3ZjgJaQXCThWudtOQ.4d8sq342', 0),
(28, 'Lycée Louis Pergaud', '91-93 bvd léon blum', ' ', '25000', 'besancon', 'France', 'Lycée L_28', 'contact@lyceep.fr', '12345678901234', '', NULL),
(29, 'Lycée Louis Pergaud', '91-93 bvd léon blum', ' ', '25000', 'besancon', 'France', 'Lycée L_29', 'contact@lyceep.fr', '12345678901234', '$2y$10$zBGiL1fjqvo/Sf6oqqYT5u5pIkzRR/UszjI/IWE/qLnomhXQHFEd.', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `idProduit` int(11) NOT NULL,
  `nom` text NOT NULL,
  `description` text NOT NULL,
  `resume` text NOT NULL,
  `fichierImage` text NOT NULL,
  `prixVenteHT` decimal(10,0) NOT NULL,
  `idCategorie` int(11) NOT NULL,
  `idTVA` decimal(10,0) NOT NULL,
  `desactiverProduit` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`idProduit`, `nom`, `description`, `resume`, `fichierImage`, `prixVenteHT`, `idCategorie`, `idTVA`, `desactiverProduit`) VALUES
(128, 'Symphonie ', 'Raisin de Corynthe, Cynorrhodon, Hibiscus, Orange, Ananas, Papaye, arômes ', 'Raisin de Corynthe, Cynorrhodon, Hibiscus, Orange, Ananas, Papaye, arômes ', 'vign_infu_symphonie_800px.jpg ', '6', 11, '3', 0),
(129, 'Cerise sauvage ', 'Pomme, Cynorrhodon, Hibiscus, Cerise sauvage (3%), arômes ', 'Pomme, Cynorrhodon, Hibiscus, Cerise sauvage (3%), arômes ', 'vign_infu_cerise_sauvage_800px.jpg ', '6', 11, '3', 0),
(130, 'Digestive ', 'Menthe Poivrée BIO plante, Mélisse BIO plante, Angélique BIO fruit, Anis Vert BIO fruit, Fenouil BIO fruit ', 'Menthe Poivrée BIO plante, Mélisse BIO plante, Angélique BIO fruit, Anis Vert BIO fruit, Fenouil BIO fruit ', 'vign_infu_digestive_800px.jpg ', '6', 11, '3', 0),
(131, 'Infusion Au clair de la Lune ', 'Oranger Doux feuille, Passiflore des Indes, Mélisse, Verveine Odorante, Aspérule Odorante ', 'Oranger Doux feuille, Passiflore des Indes, Mélisse, Verveine Odorante, Aspérule Odorante ', 'vign_infu_au_clair_lune_800px.jpg ', '6', 11, '3', 0),
(132, 'Infusion Camomille bio ', 'Camomille Bio ', 'Camomille Bio ', 'vign_infu_camomille_800px.jpg ', '6', 11, '3', 0),
(133, 'Infusion Tilleul ', 'Tilleul ', 'Tilleul ', 'vign_infu_tilleul_800px.jpg ', '6', 11, '3', 0),
(134, 'Infusion Verveine Bio ', 'Verveine Bio ', 'Verveine Bio ', 'vign_infu_verveine_800px.jpg ', '6', 11, '3', 0),
(135, 'La délicieuse ', 'Verveine, Menthe Poivrée, Mélisse, Réglisse ', 'Verveine, Menthe Poivrée, Mélisse, Réglisse ', 'vign_infu_la_delicieuse_800px.jpg ', '6', 11, '3', 0),
(147, 'Tisane de Noël ', 'Cannelle, Orange Douce, Badiane, Hibiscus, Orange Amère, Cardamome  ', 'Cannelle, Orange Douce, Badiane, Hibiscus, Orange Amère, Cardamome  ', 'vign_infu_tisane_de_noel_800px.jpg ', '6', 11, '3', 0),
(148, 'Transit ', 'Anis Vert, Menthe Douce, Citronnelle ', 'Anis Vert, Menthe Douce, Citronnelle ', 'vign_infu_transit_800px.jpg ', '6', 11, '3', 0),
(149, 'Zen ', 'Oranger Doux pétale, Passiflore des Indes, Camomille Matricaire, Mélisse, Coquelicot ', 'Oranger Doux pétale, Passiflore des Indes, Camomille Matricaire, Mélisse, Coquelicot ', ' ', '6', 11, '3', 0),
(150, 'Infusion Camomille Bio 50g ', ' ', ' ', 'vign_infu_camomille_800px.jpg ', '7', 12, '3', 0),
(151, 'Infusion Cassis ', ' ', ' ', 'vign_infu_cassis_800px.jpg ', '7', 12, '3', 0),
(152, 'Infusion Mangue ', ' ', ' ', 'vign_infu_mangue_800px.jpg ', '7', 12, '3', 0),
(153, 'Infusion Menthe Poivrée Bio 50g ', ' ', ' ', 'vign_infu_menthe_800px.jpg ', '7', 12, '3', 0),
(154, 'Thé noir caramel beurre salé ', ' ', ' ', 'vign_the_noir_caram_beur_sal_800px.jpg ', '7', 16, '3', 0),
(155, 'Darjeeling First Flush. Leaf Blend  ', ' ', ' ', 'vign_darjeeling_first_flush_800px.jpg ', '8', 16, '3', 0),
(156, 'English Breakfast ', ' ', ' ', 'vign_english_breakfast_800px.jpg ', '7', 16, '3', 0),
(165, 'Roiboos bergamote ', ' ', ' ', 'vign_infu_rooibos_bergamote_800px.jpg ', '8', 20, '3', 0),
(166, 'Rooibos Aloe verra melon ', ' ', ' ', 'vign_infu_rooibos_aloe_vera_melon_800px.jpg ', '8', 20, '3', 0),
(167, 'Rooibos Cranberry vanille ', ' ', ' ', 'vign_infu_rooibos_cranberry_vanille_800px.jpg ', '8', 20, '3', 0),
(168, 'Rooibos Rhubarbe framboise ', ' ', ' ', 'vign_infu_rooibos_rhubarbe_framb_800px.jpg ', '8', 20, '3', 0),
(169, 'Thé blanc chine (50g) ', ' ', ' ', 'vign_the_blanc_chine_800px.jpg ', '6', 16, '3', 0),
(170, 'Thé noir Ceylan ', ' ', ' ', 'vign_the_noir_ceylan_800px.jpg ', '11', 16, '3', 0),
(171, 'Thé noir Chine ', ' ', ' ', 'vign_the_noir_chine_800px.jpg ', '7', 16, '3', 0),
(172, 'Thé noir fruits rouges ', ' ', ' ', 'vign_the_noir_fruits_rouges_800px.jpg ', '7', 16, '3', 0),
(173, 'Thé noir Inde ', ' ', ' ', 'vign_the_noir_inde_800px.jpg ', '7', 16, '3', 0),
(174, 'Thé noir Mangue ', ' ', ' ', 'vign_the_noir_mangue_800px.jpg ', '7', 16, '3', 0),
(175, 'Thé noir orange ', ' ', ' ', 'vign_the_noir_orange_800px.jpg ', '7', 16, '3', 0),
(176, 'Thé noir péche ', ' ', ' ', 'vign_the_noir_peche_800px.jpg ', '7', 16, '3', 0),
(177, 'Thé vert citron jasmin ', ' ', ' ', 'vign_the_vert_jasmin_800px.jpg ', '7', 16, '3', 0),
(178, 'Thé vert fraise leetchi ', ' ', ' ', 'vign_the_vert_fraise_litchi_800px.jpg ', '7', 16, '3', 0),
(179, 'Thé vert Inde ', ' ', ' ', 'vign_the_vert_inde_800px.jpg ', '9', 16, '3', 0),
(180, 'Thé vert Japon (50g) ', ' ', ' ', 'vign_the_vert_japon_800px.jpg ', '6', 16, '3', 0),
(181, 'Thé vert jasmin ', ' ', ' ', 'vign_the_vert_jasmin_800px.jpg ', '7', 16, '3', 0),
(182, 'Thé vert mangue ananas ', ' ', ' ', 'vign_the_vert_mangue_ananas_800px.jpg ', '7', 16, '3', 0),
(183, 'Thé vert poire ', ' ', ' ', 'vign_the_vert_poire_800px.jpg ', '7', 16, '3', 0),
(184, 'Thé vert Vanille jasmin ', ' ', ' ', 'vign_the_vert_vanille_jasmin_800px.jpg ', '7', 16, '3', 0),
(185, 'Thé vert vietnam ', ' ', ' ', 'vign_the_vert_vietnam_800px.jpg ', '7', 16, '3', 0),
(196, 'Colombie ', 'Issu d\'un microlot de Colombie, ce café vous ravira par ses notes subtiles et suaves ', 'Issu d\'un microlot de Colombie, ce café vous ravira par ses notes subtiles et suaves<br>Arômes : Amandes, Chocolat, Fruits secs, Citron<br>Altitude : 1800m<br>Localisation : Huila<br>Variétés : Castillo, Typica <br>Process : Lavé ', 'capsule_colombie_800.jpg ', '25', 17, '3', 0),
(197, 'Brésil ', 'Premier pays producteur de café, ce cru du Brésil de chez Daterra vous surprendra par ses notes sucrées et fruitées. ', 'Premier pays producteur de café, ce cru du Brésil de chez Daterra vous surprendra par ses notes sucrées et fruitées.<br>Arômes : Noix de pécan, mûre, baies, chocolat<br>Altitude : 1300-1800m<br>Localisation : Cerrado Miineiro<br>Variétés : Caturra/Moka<br>Process : Natural ', 'capsule_bresil_800.jpg ', '25', 17, '3', 0),
(198, 'Ethiopie Yrgacheffe ', 'Issu de la célèbre région d\'Ethiopie Yrgacheffe, ce café est récolté à pleine maturité, puis laissé fermenter sous eau de 24 à 36 heures afin de développer ses arômes d\'une rare délicatesse ', 'Issu de la célèbre région d\'Ethiopie Yrgacheffe, ce café est récolté à pleine maturité, puis laissé fermenter sous eau de 24 à 36 heures afin de développer ses arômes d\'une rare délicatesse<br>Arômes : Floral, agrumes, bergamote<br>Altitude : 1750-2000m<br>Localisation : Chelbessa Woreda, Gedeb District<br>Variétés : Variétés sauvages locales<br>Process : Lavé ', 'capsule_ethiopie_800.jpg ', '25', 17, '3', 0),
(201, 'Mexique Décaféiné ', 'Un décaféiné mexicain issu d\'un process naturel à l\'eau et crédité du label biologiqueLabel : Bio ', 'Un décaféiné mexicain issu d\'un process naturel à l\'eau et crédité du label biologiqueLabel : Bio<br>Arômes : Cannelle, caramel clair, épices, vanille <br>Altitude : 1100-1700m<br>Localisation : Altos de chiapas <br>Variétés : Bourbon, Mundo Novo, Pacas, Typica <br>Process : Swisswater ', 'capsule_mexique_800.jpg ', '25', 17, '3', 0),
(202, 'Pérou El Palto ', 'L\'association JUMARP qui gère cette coopérative a pour objectifs d\'aider fiancièrement les producteurs et d\'améliorer leurs conditions de travail mais aussi en finançant  la construction d\'école Label : Bio ', 'L\'association JUMARP qui gère cette coopérative a pour objectifs d\'aider fiancièrement les producteurs et d\'améliorer leurs conditions de travail mais aussi en finançant  la construction d\'école Label : Bio<br>Arômes : Chocolat au lait, orange, acidité délicate<br>Altitude : 1300-1800m<br>Localisation : Yamon district / Département Amazonie<br>Variétés : Caturra/Typica/Catimor<br>Process : Lavé ', 'capsule_perou_800.jpg ', '25', 17, '3', 0),
(203, 'Blend de la Brûlerie ', 'Un café rond et subtil 100% arabica avec ses notes de chocolat et de fruits secs ', 'Un café rond et subtil 100% arabica avec ses notes de chocolat et de fruits secs<br>Variétés : Arabica ', 'capsule_blend_brulerie_800.jpg ', '25', 17, '3', 0),
(204, 'Mélange italien ', 'Un café corsé comme dans la tradition italienne avec ses notes de cacao et animal ', 'Un café corsé comme dans la tradition italienne avec ses notes de cacao et animal<br>Variétés : Arabica et Robusta ', 'capsule_melange_italien_800.jpg ', '25', 17, '3', 0),
(206, 'Colombie ', 'Issu d\'un microlot de Colombie, ce café vous ravira par ses notes subtiles et suaves ', 'Issu d\'un microlot de Colombie, ce café vous ravira par ses notes subtiles et suaves<br>Arômes : Amandes, Chocolat, Fruits secs, Citron<br>Altitude : 1800m<br>Localisation : Huila<br>Variétés : Castillo, Typica <br>Process : Lavé ', 'colombie_800_cafe_grain.jpg ', '25', 18, '3', 0),
(207, 'Brésil ', 'Premier pays producteur de café, ce cru du Brésil de chez Daterra vous surprendra par ses notes sucrées et fruitées. ', 'Premier pays producteur de café, ce cru du Brésil de chez Daterra vous surprendra par ses notes sucrées et fruitées.<br>Arômes : Noix de pécan, mûre, baies, chocolat<br>Altitude : 1300-1800m<br>Localisation : Cerrado Miineiro<br>Variétés : Caturra/Moka<br>Process : Natural ', 'bresil_800_cafe_grain.jpg ', '25', 18, '3', 0),
(208, 'Ethiopie Yrgacheffe ', 'Issu de la célèbre région d\'Ethiopie Yrgacheffe, ce café est récolté à pleine maturité, puis laissé fermenter sous eau de 24 à 36 heures afin de développer ses arômes d\'une rare délicatesse ', 'Issu de la célèbre région d\'Ethiopie Yrgacheffe, ce café est récolté à pleine maturité, puis laissé fermenter sous eau de 24 à 36 heures afin de développer ses arômes d\'une rare délicatesse<br>Arômes : Floral, agrumes, bergamote<br>Altitude : 1750-2000m<br>Localisation : Chelbessa Woreda, Gedeb District<br>Variétés : Variétés sauvages locales<br>Process : Lavé ', 'ethiopie_800_cafe_grain.jpg ', '25', 18, '3', 0),
(210, 'Guji Ethiopie naturel ', 'Berceau du café, ce cru produit dans la région de Guji est séché naturellement au soleil pour transférer les sucres présent dans la chair du fruit au grain de café ', 'Berceau du café, ce cru produit dans la région de Guji est séché naturellement au soleil pour transférer les sucres présent dans la chair du fruit au grain de café<br>Arômes : Chocolat noir, cerise, fraise<br>Altitude : 1900-2000m<br>Localisation : Guji<br>Variétés : Heirloom<br>Process : Naturel ', 'ethiopie_800_cafe_grain.jpg ', '25', 18, '3', 0),
(211, 'Mexique Décaféiné ', 'Un décaféiné mexicain issu d\'un process naturel à l\'eau et crédité du label biologiqueLabel : Bio ', 'Un décaféiné mexicain issu d\'un process naturel à l\'eau et crédité du label biologiqueLabel : Bio<br>Arômes : Cannelle, caramel clair, épices, vanille <br>Altitude : 1100-1700m<br>Localisation : Altos de chiapas <br>Variétés : Bourbon, Mundo Novo, Pacas, Typica <br>Process : Swisswater ', 'mexique_800_cafe_grain.jpg ', '25', 18, '3', 0),
(212, 'Pérou El Palto ', 'L\'association JUMARP qui gère cette coopérative a pour objectifs d\'aider fiancièrement les producteurs et d\'améliorer leurs conditions de travail mais aussi en finançant  la construction d\'école Label : Bio ', 'L\'association JUMARP qui gère cette coopérative a pour objectifs d\'aider fiancièrement les producteurs et d\'améliorer leurs conditions de travail mais aussi en finançant  la construction d\'école Label : Bio<br>Arômes : Chocolat au lait, orange, acidité délicate<br>Altitude : 1300-1800m<br>Localisation : Yamon district / Département Amazonie<br>Variétés : Caturra/Typica/Catimor<br>Process : Lavé ', 'perou_800_cafe_grain.jpg ', '25', 18, '3', 0),
(213, 'Blend de la Brûlerie ', 'Un café rond et subtil 100% arabica avec ses notes de chocolat et de fruits secs ', 'Un café rond et subtil 100% arabica avec ses notes de chocolat et de fruits secs<br>Variétés : Arabica ', 'blend_brulerie_800_cafe_grain.jpg ', '25', 18, '3', 0),
(214, 'Mélange italien ', 'Un café corsé comme dans la tradition italienne avec ses notes de cacao et animal ', 'Un café corsé comme dans la tradition italienne avec ses notes de cacao et animal<br>Variétés : Arabica et Robusta ', 'melange_italien_800_cafe_grain.jpg ', '25', 18, '3', 0),
(216, 'Colombie ', 'Issu d\'un microlot de Colombie, ce café vous ravira par ses notes subtiles et suaves ', 'Issu d\'un microlot de Colombie, ce café vous ravira par ses notes subtiles et suaves<br>Arômes : Amandes, Chocolat, Fruits secs, Citron<br>Altitude : 1800m<br>Localisation : Huila<br>Variétés : Castillo, Typica <br>Process : Lavé ', 'colombie_800_cafe_grain.jpg ', '25', 19, '3', 0),
(217, 'Brésil ', 'Premier pays producteur de café, ce cru du Brésil de chez Daterra vous surprendra par ses notes sucrées et fruitées. ', 'Premier pays producteur de café, ce cru du Brésil de chez Daterra vous surprendra par ses notes sucrées et fruitées.<br>Arômes : Noix de pécan, mûre, baies, chocolat<br>Altitude : 1300-1800m<br>Localisation : Cerrado Miineiro<br>Variétés : Caturra/Moka<br>Process : Natural ', 'bresil_800_cafe_grain.jpg ', '25', 19, '3', 0),
(218, 'Ethiopie Yrgacheffe ', 'Issu de la célèbre région d\'Ethiopie Yrgacheffe, ce café est récolté à pleine maturité, puis laissé fermenter sous eau de 24 à 36 heures afin de développer ses arômes d\'une rare délicatesse ', 'Issu de la célèbre région d\'Ethiopie Yrgacheffe, ce café est récolté à pleine maturité, puis laissé fermenter sous eau de 24 à 36 heures afin de développer ses arômes d\'une rare délicatesse<br>Arômes : Floral, agrumes, bergamote<br>Altitude : 1750-2000m<br>Localisation : Chelbessa Woreda, Gedeb District<br>Variétés : Variétés sauvages locales<br>Process : Lavé ', 'ethiopie_800_cafe_grain.jpg ', '25', 19, '3', 0),
(220, 'Guji Ethiopie naturel ', 'Berceau du café, ce cru produit dans la région de Guji est séché naturellement au soleil pour transférer les sucres présent dans la chair du fruit au grain de café ', 'Berceau du café, ce cru produit dans la région de Guji est séché naturellement au soleil pour transférer les sucres présent dans la chair du fruit au grain de café<br>Arômes : Chocolat noir, cerise, fraise<br>Altitude : 1900-2000m<br>Localisation : Guji<br>Variétés : Heirloom<br>Process : Naturel ', 'ethiopie_800_cafe_grain.jpg ', '25', 19, '3', 0),
(221, 'Mexique Décaféiné ', 'Un décaféiné mexicain issu d\'un process naturel à l\'eau et crédité du label biologiqueLabel : Bio ', 'Un décaféiné mexicain issu d\'un process naturel à l\'eau et crédité du label biologiqueLabel : Bio<br>Arômes : Cannelle, caramel clair, épices, vanille <br>Altitude : 1100-1700m<br>Localisation : Altos de chiapas <br>Variétés : Bourbon, Mundo Novo, Pacas, Typica <br>Process : Swisswater ', 'mexique_800_cafe_grain.jpg ', '25', 19, '3', 0),
(222, 'Pérou El Palto ', 'L\'association JUMARP qui gère cette coopérative a pour objectifs d\'aider fiancièrement les producteurs et d\'améliorer leurs conditions de travail mais aussi en finançant  la construction d\'école Label : Bio ', 'L\'association JUMARP qui gère cette coopérative a pour objectifs d\'aider fiancièrement les producteurs et d\'améliorer leurs conditions de travail mais aussi en finançant  la construction d\'école Label : Bio<br>Arômes : Chocolat au lait, orange, acidité délicate<br>Altitude : 1300-1800m<br>Localisation : Yamon district / Département Amazonie<br>Variétés : Caturra/Typica/Catimor<br>Process : Lavé ', 'perou_800_cafe_grain.jpg ', '25', 19, '3', 0),
(223, 'Blend de la Brûlerie ', 'Un café rond et subtil 100% arabica avec ses notes de chocolat et de fruits secs ', 'Un café rond et subtil 100% arabica avec ses notes de chocolat et de fruits secs<br>Variétés : Arabica ', 'blend_brulerie_800_cafe_grain.jpg ', '25', 19, '3', 0),
(224, 'Mélange italien ', 'Un café corsé comme dans la tradition italienne avec ses notes de cacao et animal ', 'Un café corsé comme dans la tradition italienne avec ses notes de cacao et animal<br>Variétés : Arabica et Robusta ', 'melange_italien_800_cafe_grain.jpg ', '25', 19, '3', 0),
(225, 'Infusion Noix de coco aloé vera ', ' ', ' ', 'vign_infu_noix_coco_aloe_vera_800px.jpg ', '7', 12, '3', 0),
(226, 'Infusion Pina Colada ', ' ', ' ', 'vign_infu_pina_colada_800px.jpg ', '7', 12, '3', 0),
(227, 'Infusion Poire cannelle ', ' ', ' ', 'vign_infu_poire_canelle_800px.jpg ', '7', 12, '3', 0),
(228, 'Infusion Tilleul Bio 50g ', ' ', ' ', 'vign_infu_tilleul_800px.jpg ', '7', 12, '3', 0),
(229, 'Thé blanc Bai Mu Dan ', 'Thé blanc de Chine ', 'Thé blanc de Chine ', 'vign_the_blanc_bai_mu_dan_800px.jpg ', '6', 15, '3', 0),
(230, 'Thé Earl Grey ', 'Thé noir romatisé à la bergamote ', 'Thé noir romatisé à la bergamote ', 'vign_earl_grey_800px.jpg ', '6', 15, '3', 0),
(231, 'Thé noir Lendemain de fête ', 'Thé Noir, Badiane, Tilleul Aubier, Gingembre, Réglisse ', 'Thé Noir, Badiane, Tilleul Aubier, Gingembre, Réglisse ', 'vign_lendemain_de_fete_800px.jpg ', '6', 15, '3', 0),
(232, 'Thé noir mélange anglais ', 'Thé noir ', 'Thé noir ', 'vign_the_noir_anglais_800px.jpg ', '6', 15, '3', 0),
(233, 'Secret d\'Antan ', 'Thé noir, flocons de sucre, Pomme, Amande, arômes, pétale de Rose ', 'Thé noir, flocons de sucre, Pomme, Amande, arômes, pétale de Rose ', 'vign_secret_d_antan_800px.jpg ', '6', 15, '3', 0),
(234, 'Peps ', 'Maté, Cynorrhodon, Eleuthérocoque, Gingembre, Sarriette, Hibiscus  ', 'Maté, Cynorrhodon, Eleuthérocoque, Gingembre, Sarriette, Hibiscus  ', 'vign_infu_peps_800px.jpg ', '6', 15, '3', 0),
(235, 'Sencha douce saveur ', 'Thé vert Sencha (70%), Raisin de Corinthe, Pétale de rose, arômes,  Ananas, Papaye, Fraise, Framboise ', 'Thé vert Sencha (70%), Raisin de Corinthe, Pétale de rose, arômes,  Ananas, Papaye, Fraise, Framboise ', 'vign_sencha_douce_saveur_800px.jpg ', '6', 15, '3', 0),
(236, 'Thé vert bio ', 'Thé vert Bio ', 'Thé vert Bio ', 'vign_the_vert_bio_800px.jpg ', '6', 15, '3', 0),
(237, 'Thé vert citron ', 'Thé vert (90%), Citron écorce (10%) ', 'Thé vert (90%), Citron écorce (10%) ', 'vign_the_vert_citron_800px.jpg ', '6', 15, '3', 0),
(238, 'Detox Automne hiver ', 'Thé vert feuille, Chicorée feuille, Citron écorce, Chiendent Officinal racine ', 'Thé vert feuille, Chicorée feuille, Citron écorce, Chiendent Officinal racine ', 'vign_detox_automne_hiver_800px.jpg ', '6', 15, '3', 0),
(239, 'Thé vert menthe ', 'Thé vert (60%), Menthe Douce (40%) ', 'Thé vert (60%), Menthe Douce (40%) ', 'vign_the_vert_menthe_800px.jpg ', '6', 15, '3', 0),
(240, 'Thé vert pêche ', ' ', ' ', 'vign_the_vert_peche_800px.jpg ', '7', 16, '3', 0),
(241, 'Thé vert Mirabelle  ', ' ', ' ', 'vign_the_vert_mirabelle_800px.jpg ', '7', 16, '3', 0),
(242, 'Thé vert figue baies ', ' ', ' ', 'vign_the_vert_figues_baie_roug_800px.jpg ', '7', 16, '3', 0),
(243, 'Thé vert Gingembre pomme ', ' ', ' ', 'vign_the_vert_pomme_gingembre_800px.jpg ', '7', 16, '3', 0),
(244, 'Thé vert cerise  ', ' ', ' ', 'vign_the_vert_cerise_800px.jpg ', '7', 16, '3', 0),
(245, 'Thé Oolong Vietnam (50g) ', ' ', ' ', 'vign_the_vert_oolong_800px.jpg ', '6', 16, '3', 0),
(246, 'Honduras ', 'Ce Cru du Honduras vous fera voyager dans ce pays emblématique de la production de café ', 'Ce Cru du Honduras vous fera voyager dans ce pays emblématique de la production de café<br>Arômes : Caramel, Chocolat lait, Fleur Blanche<br>Altitude : 1650m<br>Localisation : Copan<br>Variétés : Catuai<br>Process : Lavé/Fermentation anaérobique ', 'capsule_honduras_800.jpg ', '25', 17, '3', 0),
(247, 'Honduras ', 'Ce Cru du Honduras vous fera voyager dans ce pays emblématique de la production de café ', 'Ce Cru du Honduras vous fera voyager dans ce pays emblématique de la production de café<br>Arômes : Caramel, Chocolat lait, Fleur Blanche<br>Altitude : 1650m<br>Localisation : Copan<br>Variétés : Catuai<br>Process : Lavé/Fermentation anaérobique ', 'honduras_800_cafe_grain.jpg ', '25', 18, '3', 0),
(248, 'Honduras ', 'Ce Cru du Honduras vous fera voyager dans ce pays emblématique de la production de café ', 'Ce Cru du Honduras vous fera voyager dans ce pays emblématique de la production de café<br>Arômes : Caramel, Chocolat lait, Fleur Blanche<br>Altitude : 1650m<br>Localisation : Copan<br>Variétés : Catuai<br>Process : Lavé/Fermentation anaérobique ', 'honduras_800_cafe_grain.jpg ', '25', 19, '3', 0);

-- --------------------------------------------------------

--
-- Structure de la table `tva`
--

CREATE TABLE `tva` (
  `idTVA` int(11) NOT NULL,
  `pourcentageTVA` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tva`
--

INSERT INTO `tva` (`idTVA`, `pourcentageTVA`) VALUES
(3, 0.1),
(4, 0.2);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idUtilisateur` int(11) NOT NULL,
  `login` text NOT NULL,
  `motDePasse` text NOT NULL,
  `niveauAutorisation` int(11) NOT NULL,
  `desactiver` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `login`, `motDePasse`, `niveauAutorisation`, `desactiver`) VALUES
(1, 'root', '$2y$10$FUGeFI8X1v5rI5Keq/vQNO/.Zu3cuXs5CYwhhI70YExR4TW50jgIG', 1, 0),
(4, 'Uti1', '$2y$10$FfXXyrzWoEHwoMYi3wFDq.rSu7hnjTVhUytiI/KgcwNBZdo2LDYia', 2, 0),
(5, 'Uti2', '$2y$10$8ejZqraFgDpGj7.o0kaYiO3o32eh..dpjnLbrNkbwy15XaZ9b9Dl2', 2, 0),
(13, 'Uti3', '$2y$10$gJwjBO01HkF5XdKNdOHtiOWUu3zrgpLdHtseX09s2B.Ta6WEdY8Wy', 3, 0),
(14, 'Clinass', '$2y$10$3UEkiJWBLXQO7WwD1og4jOswXpA81obYGh.JXLZE4bcp.bcIuXv2C', 2, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`idCategorie`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`idEntreprise`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`idProduit`),
  ADD KEY `FK_produit` (`idCategorie`);

--
-- Index pour la table `tva`
--
ALTER TABLE `tva`
  ADD PRIMARY KEY (`idTVA`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idUtilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `idCategorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `idEntreprise` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `idProduit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;

--
-- AUTO_INCREMENT pour la table `tva`
--
ALTER TABLE `tva`
  MODIFY `idTVA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_produit` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`idCategorie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
