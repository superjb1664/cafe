-- MariaDB dump 10.17  Distrib 10.4.14-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: cafe
-- ------------------------------------------------------
-- Server version	10.4.14-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorie` (
  `idCategorie` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` text NOT NULL,
  `description` text NOT NULL,
  `desactiverCategorie` tinyint(1) NOT NULL,
  PRIMARY KEY (`idCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorie`
--

LOCK TABLES `categorie` WRITE;
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` VALUES (10,'Infusion','',0),(11,'Infusion triangle','',0),(12,'Infusion vrac','',0),(15,'Th├® triangle','',0),(16,'Th├® vrac','',0),(17,'Capsule','',0),(18,'Grain','',0),(19,'Moulu','',0),(20,'Rooibos','',0),(21,'Accompagnements','',0),(22,'AZEFF','AZEFAZEF',0);
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commande`
--

DROP TABLE IF EXISTS `commande`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateCreation` datetime DEFAULT NULL,
  `idEntreprise` int(11) NOT NULL,
  `etat` int(11) DEFAULT NULL COMMENT '1 : Caddie\r\n2 : Commande confirm├®e, en attente de virement\r\n3 : Commande pay├®e, virement re├ºu\r\n4 : Commande en pr├®paration\r\n5 : Commande en attente approvisionnement\r\n6 : Commande exp├®di├®e\r\n7 : Commande re├ºue par le client\r\n8 : Commande avec incident livraison\r\n9 : Commande avec r├®exp├®dition entraine une autre commande\r\n10 : Commande en attente de retour\r\n11 : Commande retourn├®e re├ºue, en attente de remboursement\r\n12 : Commande retourn├®e rembours├®e\r\n13 : Commande rembours├®e sans retour client',
  PRIMARY KEY (`id`),
  CONSTRAINT `idUtilisateur` FOREIGN KEY (`id`) REFERENCES `entreprise` (`idEntreprise`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commande`
--

LOCK TABLES `commande` WRITE;
/*!40000 ALTER TABLE `commande` DISABLE KEYS */;
INSERT INTO `commande` VALUES (1,'2021-09-22 21:20:18',20,2),(2,'2021-10-07 00:59:58',20,2),(3,'2021-10-07 01:03:28',20,2),(4,'2021-10-07 01:05:53',20,2);
/*!40000 ALTER TABLE `commande` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commande_avoir_article`
--

DROP TABLE IF EXISTS `commande_avoir_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commande_avoir_article` (
  `idCommande` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prixHT` float NOT NULL,
  `tauxTVA` float NOT NULL,
  PRIMARY KEY (`idCommande`,`idProduit`),
  KEY `commande_avoir_article_produit_idProduit_fk` (`idProduit`),
  CONSTRAINT `commande_avoir_article_commande_id_fk` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`id`),
  CONSTRAINT `commande_avoir_article_produit_idProduit_fk` FOREIGN KEY (`idProduit`) REFERENCES `produit` (`idProduit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commande_avoir_article`
--

LOCK TABLES `commande_avoir_article` WRITE;
/*!40000 ALTER TABLE `commande_avoir_article` DISABLE KEYS */;
INSERT INTO `commande_avoir_article` VALUES (1,151,17,7,0.1),(1,152,1,7,0.1),(1,155,1,8,0.1),(1,197,4,25,0.1),(2,128,3,6,0.1),(2,129,3,6,0.1),(2,131,3,6,0.1),(2,150,3,7,0.1),(2,151,2,7,0.1),(3,229,1,6,0.1),(4,249,2,150,0.2),(4,250,1,123,0.1);
/*!40000 ALTER TABLE `commande_avoir_article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entreprise`
--

DROP TABLE IF EXISTS `entreprise`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entreprise` (
  `idEntreprise` int(11) NOT NULL AUTO_INCREMENT,
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
  `desactiver` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idEntreprise`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entreprise`
--

LOCK TABLES `entreprise` WRITE;
/*!40000 ALTER TABLE `entreprise` DISABLE KEYS */;
INSERT INTO `entreprise` VALUES (1,'Flipstorm','713 Fieldstone Avenue','','41015 CEDEX','Blois','France','Flipstor_1','contact@flipstorm.com','455 256 510 00013','$2y$10$uCugRM3Ml9V9v2ktHmZMC.50qAELmYIhxS.5gkESmI5LOhyZnCbom',0),(2,'Skimia','08 Hansons Hill','','59073 CEDEX 1','Roubaix','France','Skimia_2','contact@skimia.com','826 537 170 00001','$2y$10$BT7I7kict54PEqcTFxBI0Oexhm.uSb2V.eUcVPVNbORLKY/jRlGC6',0),(3,'Oozz','54 Morningstar Crossing','','85164 CEDEX','Saint-Jean-de-Monts','France','Oozz_3','contact@oozz.com','742 092 550 00034','$2y$10$.WEl0wqb8L1QrW.cf8fZDudsmyMtl5xK1/s8F8Sh7muryWnSmxnUS',0),(4,'Browsecat','974 Erie Place','','63019 CEDEX 2','Clermont-Ferrand','France','Browseca_4','contact@browsecat.com','670 813 160 00033','$2y$10$r2Z4vnAU5nf27vCWC6oUwOYVPAy2W0DIohz82HFGEU4m/3PECkFzS',0),(5,'Realbridge','7563 Marcy Circle','','76069 CEDEX','Le Havre','France','Realbrid_5','contact@realbridge.com','587 508 140 00023','$2y$10$WmZkp5QazUR55zcdq.atLeT/1dMojItuomPTNz5iDKk8PbpLArrE6',0),(6,'Gabcube','6 Anzinger Pass','','44815 CEDEX','Saint-Herblain','France','Gabcube_6','contact@gabcube.com','881 364 150 00022','$2y$10$uiS8/jWHX6KT0GC9FSMK8OQmI1GlkyyN8.W7gJ/fizyhwQ7oeBLbW',0),(7,'Edgeblab','32 rue de la Mairie','','57954 CEDEX','Montigny-l├¿s-Arsures','France','Edgeblab_7','contact@edgeblab.com','89481970000331','$2y$10$uMQxDrMEgfVsKgeEazE57u0Pnqe3k8xYmRH8v9JflmSfsboPAUFFC',0),(8,'Twimm','92878 Coolidge Street','','16015 CEDEX','Angoul├¬me','France','Twimm_8','contact@twimm.com','890 567 220 00011','$2y$10$1UkE68Js5Uot2M66H7FDWeCC45nVX7OhE5PX2b2CMLZr1gk0zQiNG',0),(9,'Jetwire','1907 Westridge Point','','92715 CEDEX','Colombes','France','Jetwire_9','contact@jetwire.com','902 078 750 00012','$2y$10$kIgaANjGPRQLADFfRI00V.ktVBWZ7EIWPK93.joHepWSvUBt6rbyu',0),(10,'Topiclounge','8 Randy Pass','','94174 CEDEX','Le Perreux-sur-Marne','France','Topiclou_10','contact@topiclounge.com','335 164 270 00001','$2y$10$401B4ex8kMjy.1yomfnEnONkI9FjkYm9CbMONdhcIdxRJqpbcjJxS',0),(11,'Kazio','26478 Glendale Way','','64109 CEDEX','Bayonne','France','Kazio_11','contact@kazio.com','529 846 650 00024','$2y$10$p2tzuX.sZDf1qUgn9rJjR.lMkPxTMKlUsxf83tj1CYW0wegKWwxZu',0),(12,'Devbug','34 Brentwood Alley','','51086 CEDEX','Reims','France','Devbug_12','contact@devbug.com','064 955 660 00002','$2y$10$IHrXuY.YBkZ3OiiPGe2unOzhSwJUa6Qhb8dd5ci4krDF6X1GKEiJO',0),(13,'Oyondu','38328 Union Alley','','91893 CEDEX','Orsay','France','Oyondu_13','contact@oyondu.com','575 599 890 00002','$2y$10$HfOEY4iDB66G9tUuL14al.DuNtm3gbCYw8i5FilAOxT5iskdhGd86',0),(14,'Bubblebox','4 Glacier Hill Center','','47304 CEDEX','Villeneuve-sur-Lot','France','Bubblebo_14','contact@bubblebox.com','705 327 830 00034','$2y$10$04DAtrGJ07mUJAirqgsz7eYQ8D82a7GfgeJZda9u04.mMiUHctxXy',0),(15,'Voonder','069 South Road','','06306 CEDEX 4','Nice','France','Voonder_15','contact@voonder.com','652 956 570 00012','$2y$10$KcHZvab6tyBytqV7qWcqbee0bMQFr3heeoc9CamPNpq4irHtkhKvO',0),(16,'Oozz','99977 Anderson Crossing','','92174 CEDEX','Vanves','France','Oozz_16','contact@oozz.com','733 160 800 00013','$2y$10$GEbzMYu78XfIozv4mu04Me1hrXvArd8dfm1TGQeBROCl89qfQrQOm',0),(17,'Edgeblab','2463 Crownhardt Circle','','76124 CEDEX','Le Grand-Quevilly','France','Edgeblab_17','contact@edgeblab.com','133 696 800 00001','$2y$10$GfG4lG4IR5ttnWQRemnJBey5GihJsqx9ZaREGh8NUwfC1M8SUWx/G',0),(18,'Brainverse','0 Hazelcrest Parkway','','75220 CEDEX 16','Paris 16','France','Brainver_18','contact@brainverse.com','603 037 210 00011','$2y$10$81MqCV6NcfRQ14LhiH4B2OaY2aYxe8/HHl0kSkKhpuZLlyDQ678G.',0),(19,'Twimbo','8359 Troy Court','','33709 CEDEX','M├®rignac','France','Twimbo_19','contact@twimbo.com','675 241 060 00002','$2y$10$cyuFe6wN5/E2Nj3A92Ey9ORbbf6nFuxvP5ZghE/Ya1X4W9nKTjCti',0),(20,'Zoombox','0 Oxford Lane','','47211 CEDEX','Marmande','France','Zoombox_20','contact@zoombox.com','477 672 940 00012','$2y$10$jSv7dLqEh6sUPY3GG.cDD.e0VBZYKIfmLNDzIcbQeUGDCciby6ND6',0),(21,'Edgeify','27 Farragut Lane','','88109 CEDEX','Saint-Di├®-des-Vosges','France','Edgeify_21','contact@edgeify.com','897 596 980 00002','$2y$10$sp7/gnczz6j3diUHStFMxOWW1Le7pq9/CLRaDZz6oRQTQr8GPoJ52',0),(22,'Jazzy','30647 Vidon Plaza','','92855 CEDEX','Rueil-Malmaison','France','Jazzy_22','contact@jazzy.com','130 796 000 00011','$2y$10$oZsrkbpzxFmzCvykEuHZ3uwXmYmu35s9hREuykQjiIYU4gxiLbQpy',0),(23,'Jazzy','22 Iowa Road','','88504 CEDEX','Mirecourt','France','Jazzy_23','contact@jazzy.com','287 966 040 00001','$2y$10$5qFd/Vimt5Lf6dB7Oj2qbuhDM43KBFtFoRBR05K2cWk1ytnrcnfN.',0),(24,'Tagpad','31 Upham Trail','','72004 CEDEX 1','Le Mans','France','Tagpad_24','contact@tagpad.com','821 738 200 00012','$2y$10$D1A9ogtEj1t3kc4OKltIbexIClYGUjbakWfWRPrUK0Zl0xhXoqEKS',0),(25,'Blogtags','8431 South Court','','83164 CEDEX','La Valette-du-Var','France','Blogtags_25','contact@blogtags.com','88481276000012','$2y$10$kZnQLA6Qr3mjF4sUZAzihO3gRaT3ZjgJaQXCThWudtOQ.4d8sq342',0),(28,'Lyc├®e Louis Pergaud','91-93 bvd l├®on blum',' ','25000','besancon','France','Lyc├®e L_28','contact@lyceep.fr','12345678901234','',NULL),(29,'Lyc├®e Louis Pergaud','91-93 bvd l├®on blum',' ','25000','besancon','France','Lyc├®e L_29','contact@lyceep.fr','12345678901234','$2y$10$zBGiL1fjqvo/Sf6oqqYT5u5pIkzRR/UszjI/IWE/qLnomhXQHFEd.',NULL);
/*!40000 ALTER TABLE `entreprise` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `etat_commande`
--

DROP TABLE IF EXISTS `etat_commande`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `etat_commande` (
  `idEtatCommande` int(11) NOT NULL,
  `libelle` text NOT NULL,
  PRIMARY KEY (`idEtatCommande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etat_commande`
--

LOCK TABLES `etat_commande` WRITE;
/*!40000 ALTER TABLE `etat_commande` DISABLE KEYS */;
INSERT INTO `etat_commande` VALUES (1,'Caddie'),(2,'Commande confirmée, en attente de virement'),(3,'Commande payée, virement reçu'),(4,'Commande en préparation'),(5,'Commande en attente approvisionnement'),(6,'Commande expédiée'),(7,'Commande réceptionnée (client)'),(8,'Commande avec incident livraison'),(9,'Commande avec réexpédition entraine une autre commande'),(10,'Commande en attente de retour'),(11,'Commande retournée, en attente de remboursement'),(12,'Commande retournée remboursée'),(13,'Commande remboursée sans retour client');
/*!40000 ALTER TABLE `etat_commande` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historique_etat_commande`
--

DROP TABLE IF EXISTS `historique_etat_commande`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historique_etat_commande` (
  `idHistorique` int(11) NOT NULL AUTO_INCREMENT,
  `idCommande` int(11) NOT NULL,
  `etat` int(11) NOT NULL,
  `dateHeure` datetime NOT NULL,
  `infoComplementaire` text NOT NULL,
  PRIMARY KEY (`idHistorique`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historique_etat_commande`
--

LOCK TABLES `historique_etat_commande` WRITE;
/*!40000 ALTER TABLE `historique_etat_commande` DISABLE KEYS */;
INSERT INTO `historique_etat_commande` VALUES (1,2,2,'2021-10-07 01:02:59',''),(2,3,2,'2021-10-07 01:05:38',''),(3,4,2,'2021-10-07 01:16:28','Commande passée par test2 testaerbv');
/*!40000 ALTER TABLE `historique_etat_commande` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `niveau_autorisation`
--

DROP TABLE IF EXISTS `niveau_autorisation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `niveau_autorisation` (
  `idNiveauAutorisation` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` text NOT NULL,
  PRIMARY KEY (`idNiveauAutorisation`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `niveau_autorisation`
--

LOCK TABLES `niveau_autorisation` WRITE;
/*!40000 ALTER TABLE `niveau_autorisation` DISABLE KEYS */;
INSERT INTO `niveau_autorisation` VALUES (1,'administrateur'),(2,'rédacteur'),(3,'commercial');
/*!40000 ALTER TABLE `niveau_autorisation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produit`
--

DROP TABLE IF EXISTS `produit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produit` (
  `idProduit` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  `description` text NOT NULL,
  `resume` text NOT NULL,
  `fichierImage` text NOT NULL,
  `prixVenteHT` decimal(10,0) NOT NULL,
  `idCategorie` int(11) NOT NULL,
  `idTVA` decimal(10,0) NOT NULL,
  `desactiverProduit` tinyint(1) NOT NULL,
  `reference` text DEFAULT NULL,
  PRIMARY KEY (`idProduit`),
  KEY `FK_produit` (`idCategorie`),
  CONSTRAINT `FK_produit` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`idCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=254 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produit`
--

LOCK TABLES `produit` WRITE;
/*!40000 ALTER TABLE `produit` DISABLE KEYS */;
INSERT INTO `produit` VALUES (128,'Symphonie ','Raisin de Corynthe, Cynorrhodon, Hibiscus, Orange, Ananas, Papaye, ar├┤mes ','Raisin de Corynthe, Cynorrhodon, Hibiscus, Orange, Ananas, Papaye, ar├┤mes ','vign_infu_symphonie_800px.jpg ',6,11,3,0,NULL),(129,'Cerise sauvage ','Pomme, Cynorrhodon, Hibiscus, Cerise sauvage (3%), ar├┤mes ','Pomme, Cynorrhodon, Hibiscus, Cerise sauvage (3%), ar├┤mes ','vign_infu_cerise_sauvage_800px.jpg ',6,11,3,0,NULL),(130,'Digestive ','Menthe Poivr├®e BIO plante, M├®lisse BIO plante, Ang├®lique BIO fruit, Anis Vert BIO fruit, Fenouil BIO fruit ','Menthe Poivr├®e BIO plante, M├®lisse BIO plante, Ang├®lique BIO fruit, Anis Vert BIO fruit, Fenouil BIO fruit ','vign_infu_digestive_800px.jpg ',6,11,3,0,NULL),(131,'Infusion Au clair de la Lune ','Oranger Doux feuille, Passiflore des Indes, M├®lisse, Verveine Odorante, Asp├®rule Odorante ','Oranger Doux feuille, Passiflore des Indes, M├®lisse, Verveine Odorante, Asp├®rule Odorante ','vign_infu_au_clair_lune_800px.jpg ',6,11,3,0,NULL),(132,'Infusion Camomille bio ','Camomille Bio ','Camomille Bio ','vign_infu_camomille_800px.jpg ',6,11,3,0,NULL),(133,'Infusion Tilleul ','Tilleul ','Tilleul ','vign_infu_tilleul_800px.jpg ',6,11,3,0,NULL),(134,'Infusion Verveine Bio ','Verveine Bio ','Verveine Bio ','vign_infu_verveine_800px.jpg ',6,11,3,0,NULL),(135,'La d├®licieuse ','Verveine, Menthe Poivr├®e, M├®lisse, R├®glisse ','Verveine, Menthe Poivr├®e, M├®lisse, R├®glisse ','vign_infu_la_delicieuse_800px.jpg ',6,11,3,0,NULL),(147,'Tisane de No├½l ','Cannelle, Orange Douce, Badiane, Hibiscus, Orange Am├¿re, Cardamome  ','Cannelle, Orange Douce, Badiane, Hibiscus, Orange Am├¿re, Cardamome  ','vign_infu_tisane_de_noel_800px.jpg ',6,11,3,0,NULL),(148,'Transit ','Anis Vert, Menthe Douce, Citronnelle ','Anis Vert, Menthe Douce, Citronnelle ','vign_infu_transit_800px.jpg ',6,11,3,0,NULL),(149,'Zen ','Oranger Doux p├®tale, Passiflore des Indes, Camomille Matricaire, M├®lisse, Coquelicot ','Oranger Doux p├®tale, Passiflore des Indes, Camomille Matricaire, M├®lisse, Coquelicot ',' ',6,11,3,0,NULL),(150,'Infusion Camomille Bio 50g ',' ',' ','vign_infu_camomille_800px.jpg ',7,12,3,0,NULL),(151,'Infusion Cassis ',' ',' ','vign_infu_cassis_800px.jpg ',7,12,3,0,NULL),(152,'Infusion Mangue ',' ',' ','vign_infu_mangue_800px.jpg ',7,12,3,0,NULL),(153,'Infusion Menthe Poivr├®e Bio 50g ',' ',' ','vign_infu_menthe_800px.jpg ',7,12,3,0,NULL),(154,'Th├® noir caramel beurre sal├® ',' ',' ','vign_the_noir_caram_beur_sal_800px.jpg ',7,16,3,0,NULL),(155,'Darjeeling First Flush. Leaf Blend  ',' ',' ','vign_darjeeling_first_flush_800px.jpg ',8,16,3,0,NULL),(156,'English Breakfast ',' ',' ','vign_english_breakfast_800px.jpg ',7,16,3,0,NULL),(165,'Roiboos bergamote ',' ',' ','vign_infu_rooibos_bergamote_800px.jpg ',8,20,3,0,NULL),(166,'Rooibos Aloe verra melon ',' ',' ','vign_infu_rooibos_aloe_vera_melon_800px.jpg ',8,20,3,0,NULL),(167,'Rooibos Cranberry vanille ',' ',' ','vign_infu_rooibos_cranberry_vanille_800px.jpg ',8,20,3,0,NULL),(168,'Rooibos Rhubarbe framboise ',' ',' ','vign_infu_rooibos_rhubarbe_framb_800px.jpg ',8,20,3,0,NULL),(169,'Th├® blanc chine (50g) ',' ',' ','vign_the_blanc_chine_800px.jpg ',6,16,3,0,NULL),(170,'Th├® noir Ceylan ',' ',' ','vign_the_noir_ceylan_800px.jpg ',11,16,3,0,NULL),(171,'Th├® noir Chine ',' ',' ','vign_the_noir_chine_800px.jpg ',7,16,3,0,NULL),(172,'Th├® noir fruits rouges ',' ',' ','vign_the_noir_fruits_rouges_800px.jpg ',7,16,3,0,NULL),(173,'Th├® noir Inde ',' ',' ','vign_the_noir_inde_800px.jpg ',7,16,3,0,NULL),(174,'Th├® noir Mangue ',' ',' ','vign_the_noir_mangue_800px.jpg ',7,16,3,0,NULL),(175,'Th├® noir orange ',' ',' ','vign_the_noir_orange_800px.jpg ',7,16,3,0,NULL),(176,'Th├® noir p├®che ',' ',' ','vign_the_noir_peche_800px.jpg ',7,16,3,0,NULL),(177,'Th├® vert citron jasmin ',' ',' ','vign_the_vert_jasmin_800px.jpg ',7,16,3,0,NULL),(178,'Th├® vert fraise leetchi ',' ',' ','vign_the_vert_fraise_litchi_800px.jpg ',7,16,3,0,NULL),(179,'Th├® vert Inde ',' ',' ','vign_the_vert_inde_800px.jpg ',9,16,3,0,NULL),(180,'Th├® vert Japon (50g) ',' ',' ','vign_the_vert_japon_800px.jpg ',6,16,3,0,NULL),(181,'Th├® vert jasmin ',' ',' ','vign_the_vert_jasmin_800px.jpg ',7,16,3,0,NULL),(182,'Th├® vert mangue ananas ',' ',' ','vign_the_vert_mangue_ananas_800px.jpg ',7,16,3,0,NULL),(183,'Th├® vert poire ',' ',' ','vign_the_vert_poire_800px.jpg ',7,16,3,0,NULL),(184,'Th├® vert Vanille jasmin ',' ',' ','vign_the_vert_vanille_jasmin_800px.jpg ',7,16,3,0,NULL),(185,'Th├® vert vietnam ',' ',' ','vign_the_vert_vietnam_800px.jpg ',7,16,3,0,NULL),(196,'Colombie ','Issu d\'un microlot de Colombie, ce caf├® vous ravira par ses notes subtiles et suaves ','Issu d\'un microlot de Colombie, ce caf├® vous ravira par ses notes subtiles et suaves<br>Ar├┤mes : Amandes, Chocolat, Fruits secs, Citron<br>Altitude : 1800m<br>Localisation : Huila<br>Vari├®t├®s : Castillo, Typica <br>Process : Lav├® ','capsule_colombie_800.jpg ',25,17,3,0,NULL),(197,'Br├®sil ','Premier pays producteur de caf├®, ce cru du Br├®sil de chez Daterra vous surprendra par ses notes sucr├®es et fruit├®es. ','Premier pays producteur de caf├®, ce cru du Br├®sil de chez Daterra vous surprendra par ses notes sucr├®es et fruit├®es.<br>Ar├┤mes : Noix de p├®can, m├╗re, baies, chocolat<br>Altitude : 1300-1800m<br>Localisation : Cerrado Miineiro<br>Vari├®t├®s : Caturra/Moka<br>Process : Natural ','capsule_bresil_800.jpg ',25,17,3,0,NULL),(198,'Ethiopie Yrgacheffe ','Issu de la c├®l├¿bre r├®gion d\'Ethiopie Yrgacheffe, ce caf├® est r├®colt├® ├á pleine maturit├®, puis laiss├® fermenter sous eau de 24 ├á 36 heures afin de d├®velopper ses ar├┤mes d\'une rare d├®licatesse ','Issu de la c├®l├¿bre r├®gion d\'Ethiopie Yrgacheffe, ce caf├® est r├®colt├® ├á pleine maturit├®, puis laiss├® fermenter sous eau de 24 ├á 36 heures afin de d├®velopper ses ar├┤mes d\'une rare d├®licatesse<br>Ar├┤mes : Floral, agrumes, bergamote<br>Altitude : 1750-2000m<br>Localisation : Chelbessa Woreda, Gedeb District<br>Vari├®t├®s : Vari├®t├®s sauvages locales<br>Process : Lav├® ','capsule_ethiopie_800.jpg ',25,17,3,0,NULL),(201,'Mexique D├®caf├®in├® ','Un d├®caf├®in├® mexicain issu d\'un process naturel ├á l\'eau et cr├®dit├® du label biologiqueLabel : Bio ','Un d├®caf├®in├® mexicain issu d\'un process naturel ├á l\'eau et cr├®dit├® du label biologiqueLabel : Bio<br>Ar├┤mes : Cannelle, caramel clair, ├®pices, vanille <br>Altitude : 1100-1700m<br>Localisation : Altos de chiapas <br>Vari├®t├®s : Bourbon, Mundo Novo, Pacas, Typica <br>Process : Swisswater ','capsule_mexique_800.jpg ',25,17,3,0,NULL),(202,'P├®rou El Palto ','L\'association JUMARP qui g├¿re cette coop├®rative a pour objectifs d\'aider fianci├¿rement les producteurs et d\'am├®liorer leurs conditions de travail mais aussi en finan├ºant  la construction d\'├®cole Label : Bio ','L\'association JUMARP qui g├¿re cette coop├®rative a pour objectifs d\'aider fianci├¿rement les producteurs et d\'am├®liorer leurs conditions de travail mais aussi en finan├ºant  la construction d\'├®cole Label : Bio<br>Ar├┤mes : Chocolat au lait, orange, acidit├® d├®licate<br>Altitude : 1300-1800m<br>Localisation : Yamon district / D├®partement Amazonie<br>Vari├®t├®s : Caturra/Typica/Catimor<br>Process : Lav├® ','capsule_perou_800.jpg ',25,17,3,0,NULL),(203,'Blend de la Br├╗lerie ','Un caf├® rond et subtil 100% arabica avec ses notes de chocolat et de fruits secs ','Un caf├® rond et subtil 100% arabica avec ses notes de chocolat et de fruits secs<br>Vari├®t├®s : Arabica ','capsule_blend_brulerie_800.jpg ',25,17,3,0,NULL),(204,'M├®lange italien ','Un caf├® cors├® comme dans la tradition italienne avec ses notes de cacao et animal ','Un caf├® cors├® comme dans la tradition italienne avec ses notes de cacao et animal<br>Vari├®t├®s : Arabica et Robusta ','capsule_melange_italien_800.jpg ',25,17,3,0,NULL),(206,'Colombie ','Issu d\'un microlot de Colombie, ce caf├® vous ravira par ses notes subtiles et suaves ','Issu d\'un microlot de Colombie, ce caf├® vous ravira par ses notes subtiles et suaves<br>Ar├┤mes : Amandes, Chocolat, Fruits secs, Citron<br>Altitude : 1800m<br>Localisation : Huila<br>Vari├®t├®s : Castillo, Typica <br>Process : Lav├® ','colombie_800_cafe_grain.jpg ',25,18,3,0,NULL),(207,'Br├®sil ','Premier pays producteur de caf├®, ce cru du Br├®sil de chez Daterra vous surprendra par ses notes sucr├®es et fruit├®es. ','Premier pays producteur de caf├®, ce cru du Br├®sil de chez Daterra vous surprendra par ses notes sucr├®es et fruit├®es.<br>Ar├┤mes : Noix de p├®can, m├╗re, baies, chocolat<br>Altitude : 1300-1800m<br>Localisation : Cerrado Miineiro<br>Vari├®t├®s : Caturra/Moka<br>Process : Natural ','bresil_800_cafe_grain.jpg ',25,18,3,0,NULL),(208,'Ethiopie Yrgacheffe ','Issu de la c├®l├¿bre r├®gion d\'Ethiopie Yrgacheffe, ce caf├® est r├®colt├® ├á pleine maturit├®, puis laiss├® fermenter sous eau de 24 ├á 36 heures afin de d├®velopper ses ar├┤mes d\'une rare d├®licatesse ','Issu de la c├®l├¿bre r├®gion d\'Ethiopie Yrgacheffe, ce caf├® est r├®colt├® ├á pleine maturit├®, puis laiss├® fermenter sous eau de 24 ├á 36 heures afin de d├®velopper ses ar├┤mes d\'une rare d├®licatesse<br>Ar├┤mes : Floral, agrumes, bergamote<br>Altitude : 1750-2000m<br>Localisation : Chelbessa Woreda, Gedeb District<br>Vari├®t├®s : Vari├®t├®s sauvages locales<br>Process : Lav├® ','ethiopie_800_cafe_grain.jpg ',25,18,3,0,NULL),(210,'Guji Ethiopie naturel ','Berceau du caf├®, ce cru produit dans la r├®gion de Guji est s├®ch├® naturellement au soleil pour transf├®rer les sucres pr├®sent dans la chair du fruit au grain de caf├® ','Berceau du caf├®, ce cru produit dans la r├®gion de Guji est s├®ch├® naturellement au soleil pour transf├®rer les sucres pr├®sent dans la chair du fruit au grain de caf├®<br>Ar├┤mes : Chocolat noir, cerise, fraise<br>Altitude : 1900-2000m<br>Localisation : Guji<br>Vari├®t├®s : Heirloom<br>Process : Naturel ','ethiopie_800_cafe_grain.jpg ',25,18,3,0,NULL),(211,'Mexique D├®caf├®in├® ','Un d├®caf├®in├® mexicain issu d\'un process naturel ├á l\'eau et cr├®dit├® du label biologiqueLabel : Bio ','Un d├®caf├®in├® mexicain issu d\'un process naturel ├á l\'eau et cr├®dit├® du label biologiqueLabel : Bio<br>Ar├┤mes : Cannelle, caramel clair, ├®pices, vanille <br>Altitude : 1100-1700m<br>Localisation : Altos de chiapas <br>Vari├®t├®s : Bourbon, Mundo Novo, Pacas, Typica <br>Process : Swisswater ','mexique_800_cafe_grain.jpg ',25,18,3,0,NULL),(212,'P├®rou El Palto ','L\'association JUMARP qui g├¿re cette coop├®rative a pour objectifs d\'aider fianci├¿rement les producteurs et d\'am├®liorer leurs conditions de travail mais aussi en finan├ºant  la construction d\'├®cole Label : Bio ','L\'association JUMARP qui g├¿re cette coop├®rative a pour objectifs d\'aider fianci├¿rement les producteurs et d\'am├®liorer leurs conditions de travail mais aussi en finan├ºant  la construction d\'├®cole Label : Bio<br>Ar├┤mes : Chocolat au lait, orange, acidit├® d├®licate<br>Altitude : 1300-1800m<br>Localisation : Yamon district / D├®partement Amazonie<br>Vari├®t├®s : Caturra/Typica/Catimor<br>Process : Lav├® ','perou_800_cafe_grain.jpg ',25,18,3,0,NULL),(213,'Blend de la Br├╗lerie ','Un caf├® rond et subtil 100% arabica avec ses notes de chocolat et de fruits secs ','Un caf├® rond et subtil 100% arabica avec ses notes de chocolat et de fruits secs<br>Vari├®t├®s : Arabica ','blend_brulerie_800_cafe_grain.jpg ',25,18,3,0,NULL),(214,'M├®lange italien ','Un caf├® cors├® comme dans la tradition italienne avec ses notes de cacao et animal ','Un caf├® cors├® comme dans la tradition italienne avec ses notes de cacao et animal<br>Vari├®t├®s : Arabica et Robusta ','melange_italien_800_cafe_grain.jpg ',25,18,3,0,NULL),(216,'Colombie ','Issu d\'un microlot de Colombie, ce caf├® vous ravira par ses notes subtiles et suaves ','Issu d\'un microlot de Colombie, ce caf├® vous ravira par ses notes subtiles et suaves<br>Ar├┤mes : Amandes, Chocolat, Fruits secs, Citron<br>Altitude : 1800m<br>Localisation : Huila<br>Vari├®t├®s : Castillo, Typica <br>Process : Lav├® ','colombie_800_cafe_grain.jpg ',25,19,3,0,NULL),(217,'Br├®sil ','Premier pays producteur de caf├®, ce cru du Br├®sil de chez Daterra vous surprendra par ses notes sucr├®es et fruit├®es. ','Premier pays producteur de caf├®, ce cru du Br├®sil de chez Daterra vous surprendra par ses notes sucr├®es et fruit├®es.<br>Ar├┤mes : Noix de p├®can, m├╗re, baies, chocolat<br>Altitude : 1300-1800m<br>Localisation : Cerrado Miineiro<br>Vari├®t├®s : Caturra/Moka<br>Process : Natural ','bresil_800_cafe_grain.jpg ',25,19,3,0,NULL),(218,'Ethiopie Yrgacheffe ','Issu de la c├®l├¿bre r├®gion d\'Ethiopie Yrgacheffe, ce caf├® est r├®colt├® ├á pleine maturit├®, puis laiss├® fermenter sous eau de 24 ├á 36 heures afin de d├®velopper ses ar├┤mes d\'une rare d├®licatesse ','Issu de la c├®l├¿bre r├®gion d\'Ethiopie Yrgacheffe, ce caf├® est r├®colt├® ├á pleine maturit├®, puis laiss├® fermenter sous eau de 24 ├á 36 heures afin de d├®velopper ses ar├┤mes d\'une rare d├®licatesse<br>Ar├┤mes : Floral, agrumes, bergamote<br>Altitude : 1750-2000m<br>Localisation : Chelbessa Woreda, Gedeb District<br>Vari├®t├®s : Vari├®t├®s sauvages locales<br>Process : Lav├® ','ethiopie_800_cafe_grain.jpg ',25,19,3,0,NULL),(220,'Guji Ethiopie naturel ','Berceau du caf├®, ce cru produit dans la r├®gion de Guji est s├®ch├® naturellement au soleil pour transf├®rer les sucres pr├®sent dans la chair du fruit au grain de caf├® ','Berceau du caf├®, ce cru produit dans la r├®gion de Guji est s├®ch├® naturellement au soleil pour transf├®rer les sucres pr├®sent dans la chair du fruit au grain de caf├®<br>Ar├┤mes : Chocolat noir, cerise, fraise<br>Altitude : 1900-2000m<br>Localisation : Guji<br>Vari├®t├®s : Heirloom<br>Process : Naturel ','ethiopie_800_cafe_grain.jpg ',25,19,3,0,NULL),(221,'Mexique D├®caf├®in├® ','Un d├®caf├®in├® mexicain issu d\'un process naturel ├á l\'eau et cr├®dit├® du label biologiqueLabel : Bio ','Un d├®caf├®in├® mexicain issu d\'un process naturel ├á l\'eau et cr├®dit├® du label biologiqueLabel : Bio<br>Ar├┤mes : Cannelle, caramel clair, ├®pices, vanille <br>Altitude : 1100-1700m<br>Localisation : Altos de chiapas <br>Vari├®t├®s : Bourbon, Mundo Novo, Pacas, Typica <br>Process : Swisswater ','mexique_800_cafe_grain.jpg ',25,19,3,0,NULL),(222,'P├®rou El Palto ','L\'association JUMARP qui g├¿re cette coop├®rative a pour objectifs d\'aider fianci├¿rement les producteurs et d\'am├®liorer leurs conditions de travail mais aussi en finan├ºant  la construction d\'├®cole Label : Bio ','L\'association JUMARP qui g├¿re cette coop├®rative a pour objectifs d\'aider fianci├¿rement les producteurs et d\'am├®liorer leurs conditions de travail mais aussi en finan├ºant  la construction d\'├®cole Label : Bio<br>Ar├┤mes : Chocolat au lait, orange, acidit├® d├®licate<br>Altitude : 1300-1800m<br>Localisation : Yamon district / D├®partement Amazonie<br>Vari├®t├®s : Caturra/Typica/Catimor<br>Process : Lav├® ','perou_800_cafe_grain.jpg ',25,19,3,0,NULL),(223,'Blend de la Br├╗lerie ','Un caf├® rond et subtil 100% arabica avec ses notes de chocolat et de fruits secs ','Un caf├® rond et subtil 100% arabica avec ses notes de chocolat et de fruits secs<br>Vari├®t├®s : Arabica ','blend_brulerie_800_cafe_grain.jpg ',25,19,3,0,NULL),(224,'M├®lange italien ','Un caf├® cors├® comme dans la tradition italienne avec ses notes de cacao et animal ','Un caf├® cors├® comme dans la tradition italienne avec ses notes de cacao et animal<br>Vari├®t├®s : Arabica et Robusta ','melange_italien_800_cafe_grain.jpg ',25,19,3,0,NULL),(225,'Infusion Noix de coco alo├® vera ',' ',' ','vign_infu_noix_coco_aloe_vera_800px.jpg ',7,12,3,0,NULL),(226,'Infusion Pina Colada ',' ',' ','vign_infu_pina_colada_800px.jpg ',7,12,3,0,NULL),(227,'Infusion Poire cannelle ',' ',' ','vign_infu_poire_canelle_800px.jpg ',7,12,3,0,NULL),(228,'Infusion Tilleul Bio 50g ',' ',' ','vign_infu_tilleul_800px.jpg ',7,12,3,0,NULL),(229,'Th├® blanc Bai Mu Dan ','Th├® blanc de Chine ','Th├® blanc de Chine ','vign_the_blanc_bai_mu_dan_800px.jpg ',6,15,3,0,NULL),(230,'Th├® Earl Grey ','Th├® noir romatis├® ├á la bergamote ','Th├® noir romatis├® ├á la bergamote ','vign_earl_grey_800px.jpg ',6,15,3,0,NULL),(231,'Th├® noir Lendemain de f├¬te ','Th├® Noir, Badiane, Tilleul Aubier, Gingembre, R├®glisse ','Th├® Noir, Badiane, Tilleul Aubier, Gingembre, R├®glisse ','vign_lendemain_de_fete_800px.jpg ',6,15,3,0,NULL),(232,'Th├® noir m├®lange anglais ','Th├® noir ','Th├® noir ','vign_the_noir_anglais_800px.jpg ',6,15,3,0,NULL),(233,'Secret d\'Antan ','Th├® noir, flocons de sucre, Pomme, Amande, ar├┤mes, p├®tale de Rose ','Th├® noir, flocons de sucre, Pomme, Amande, ar├┤mes, p├®tale de Rose ','vign_secret_d_antan_800px.jpg ',6,15,3,0,NULL),(234,'Peps ','Mat├®, Cynorrhodon, Eleuth├®rocoque, Gingembre, Sarriette, Hibiscus  ','Mat├®, Cynorrhodon, Eleuth├®rocoque, Gingembre, Sarriette, Hibiscus  ','vign_infu_peps_800px.jpg ',6,15,3,0,NULL),(235,'Sencha douce saveur ','Th├® vert Sencha (70%), Raisin de Corinthe, P├®tale de rose, ar├┤mes,  Ananas, Papaye, Fraise, Framboise ','Th├® vert Sencha (70%), Raisin de Corinthe, P├®tale de rose, ar├┤mes,  Ananas, Papaye, Fraise, Framboise ','vign_sencha_douce_saveur_800px.jpg ',6,15,3,0,NULL),(236,'Th├® vert bio ','Th├® vert Bio ','Th├® vert Bio ','vign_the_vert_bio_800px.jpg ',6,15,3,0,NULL),(237,'Th├® vert citron ','Th├® vert (90%), Citron ├®corce (10%) ','Th├® vert (90%), Citron ├®corce (10%) ','vign_the_vert_citron_800px.jpg ',6,15,3,0,NULL),(238,'Detox Automne hiver ','Th├® vert feuille, Chicor├®e feuille, Citron ├®corce, Chiendent Officinal racine ','Th├® vert feuille, Chicor├®e feuille, Citron ├®corce, Chiendent Officinal racine ','vign_detox_automne_hiver_800px.jpg ',6,15,3,0,NULL),(239,'Th├® vert menthe ','Th├® vert (60%), Menthe Douce (40%) ','Th├® vert (60%), Menthe Douce (40%) ','vign_the_vert_menthe_800px.jpg ',6,15,3,0,NULL),(240,'Th├® vert p├¬che ',' ',' ','vign_the_vert_peche_800px.jpg ',7,16,3,0,NULL),(241,'Th├® vert Mirabelle  ',' ',' ','vign_the_vert_mirabelle_800px.jpg ',7,16,3,0,NULL),(242,'Th├® vert figue baies ',' ',' ','vign_the_vert_figues_baie_roug_800px.jpg ',7,16,3,0,NULL),(243,'Th├® vert Gingembre pomme ',' ',' ','vign_the_vert_pomme_gingembre_800px.jpg ',7,16,3,0,NULL),(244,'Th├® vert cerise  ',' ',' ','vign_the_vert_cerise_800px.jpg ',7,16,3,0,NULL),(245,'Th├® Oolong Vietnam (50g) ',' ',' ','vign_the_vert_oolong_800px.jpg ',6,16,3,0,NULL),(246,'Honduras ','Ce Cru du Honduras vous fera voyager dans ce pays embl├®matique de la production de caf├® ','Ce Cru du Honduras vous fera voyager dans ce pays embl├®matique de la production de caf├®<br>Ar├┤mes : Caramel, Chocolat lait, Fleur Blanche<br>Altitude : 1650m<br>Localisation : Copan<br>Vari├®t├®s : Catuai<br>Process : Lav├®/Fermentation ana├®robique ','capsule_honduras_800.jpg ',25,17,3,0,NULL),(247,'Honduras ','Ce Cru du Honduras vous fera voyager dans ce pays embl├®matique de la production de caf├® ','Ce Cru du Honduras vous fera voyager dans ce pays embl├®matique de la production de caf├®<br>Ar├┤mes : Caramel, Chocolat lait, Fleur Blanche<br>Altitude : 1650m<br>Localisation : Copan<br>Vari├®t├®s : Catuai<br>Process : Lav├®/Fermentation ana├®robique ','honduras_800_cafe_grain.jpg ',25,18,3,0,NULL),(248,'Honduras ','Ce Cru du Honduras vous fera voyager dans ce pays embl├®matique de la production de caf├® ','Ce Cru du Honduras vous fera voyager dans ce pays embl├®matique de la production de caf├®<br>Ar├┤mes : Caramel, Chocolat lait, Fleur Blanche<br>Altitude : 1650m<br>Localisation : Copan<br>Vari├®t├®s : Catuai<br>Process : Lav├®/Fermentation ana├®robique ','honduras_800_cafe_grain.jpg ',25,19,3,0,NULL),(249,'a','a','a','',150,10,4,0,'INF_A_249'),(250,'feaz','azef','azef','',123,10,3,0,'INF_FEA_250'),(251,'feaz','azef','azef','',123,10,3,0,'INF_FEA_251'),(252,'AZEFAZEF','AZEFAZEF','AZEFAZEF','',123,10,3,0,'INF_AZE_252'),(253,'AZEFAZEF','azefazef','azefazef','',123,22,3,0,'AZE_AZE_253');
/*!40000 ALTER TABLE `produit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salarie`
--

DROP TABLE IF EXISTS `salarie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salarie` (
  `idSalarie` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `mail` text NOT NULL,
  `idEntreprise` int(11) NOT NULL,
  `roleEntreprise` text NOT NULL,
  `password` text DEFAULT NULL,
  `actif` bit(1) DEFAULT NULL,
  PRIMARY KEY (`idSalarie`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salarie`
--

LOCK TABLES `salarie` WRITE;
/*!40000 ALTER TABLE `salarie` DISABLE KEYS */;
INSERT INTO `salarie` VALUES (10,'test2','testaerbv','contact@lyceep.fr',20,'test','$2y$10$UI.w13KAI/Nidcuj3CSeduyI3hrMYcCljgXAsnc/VLjhcvsfmpM.G','');
/*!40000 ALTER TABLE `salarie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tva`
--

DROP TABLE IF EXISTS `tva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tva` (
  `idTVA` int(11) NOT NULL AUTO_INCREMENT,
  `pourcentageTVA` float NOT NULL,
  PRIMARY KEY (`idTVA`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tva`
--

LOCK TABLES `tva` WRITE;
/*!40000 ALTER TABLE `tva` DISABLE KEYS */;
INSERT INTO `tva` VALUES (3,0.1),(4,0.2);
/*!40000 ALTER TABLE `tva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utilisateur` (
  `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `login` text NOT NULL,
  `motDePasse` text NOT NULL,
  `niveauAutorisation` int(11) NOT NULL,
  `desactiver` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateur`
--

LOCK TABLES `utilisateur` WRITE;
/*!40000 ALTER TABLE `utilisateur` DISABLE KEYS */;
INSERT INTO `utilisateur` VALUES (1,'root','$2y$10$Sd2B1bNXYey7UjBdMg2ybuFxYh.XIM1NhYirQ.4OtwxP1GAL2aN5i',1,0),(4,'Uti1','$2y$10$FfXXyrzWoEHwoMYi3wFDq.rSu7hnjTVhUytiI/KgcwNBZdo2LDYia',2,0),(5,'Uti2','$2y$10$NiW3OAvIBFG3.xGVVsq0ZusFmM7AJO4B/bxfjNOyKiY9C.Uc6uR.K',2,0),(13,'Uti3','$2y$10$gJwjBO01HkF5XdKNdOHtiOWUu3zrgpLdHtseX09s2B.Ta6WEdY8Wy',3,0),(14,'Clinassss','$2y$10$3UEkiJWBLXQO7WwD1og4jOswXpA81obYGh.JXLZE4bcp.bcIuXv2C',2,0),(15,'ereqrh','$2y$10$SDg.Hwwq1Su6DxF/AXnPfOdFhDDv1ziH/LGi3hL44rS/Bza9UyvNe',3,0);
/*!40000 ALTER TABLE `utilisateur` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-10-07  1:54:54
