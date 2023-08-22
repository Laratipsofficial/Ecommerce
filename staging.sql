CREATE DATABASE  IF NOT EXISTS `gouden_draak` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `gouden_draak`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: gouden_draak
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.37-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `gebruiker`
--

DROP TABLE IF EXISTS `gebruiker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gebruiker` (
                             `id` int(11) NOT NULL,
                             `wachtwoord` varchar(45) NOT NULL,
                             `isAdmin` tinyint(4) NOT NULL,
                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gebruiker`
--

LOCK TABLES `gebruiker` WRITE;
/*!40000 ALTER TABLE `gebruiker` DISABLE KEYS */;
INSERT INTO `gebruiker` VALUES (1,'test',1);
/*!40000 ALTER TABLE `gebruiker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `menunummer` int(11) DEFAULT NULL,
                        `menu_toevoeging` tinytext,
                        `naam` longtext NOT NULL,
                        `price` float DEFAULT NULL,
                        `soortgerecht` varchar(45) DEFAULT NULL,
                        `beschrijving` mediumtext,
                        PRIMARY KEY (`id`),
                        UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=176 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,1,NULL,'Soep Ling Fa',3.8,'SOEP',NULL),(2,2,NULL,'Kippensoep',2.9,'SOEP',''),(3,3,NULL,'Tomatensoep',2.9,'SOEP',NULL),(4,4,NULL,'Haaienvinnensoep',3.1,'SOEP',NULL),(5,5,NULL,'Champignonsoep',3.3,'SOEP',NULL),(6,6,NULL,'Pekingsoep',3.8,'SOEP',NULL),(7,7,NULL,'Wan Tan Soep',4.3,'SOEP',NULL),(8,8,NULL,'Chinese Champignonsoep',4.1,'SOEP',NULL),(9,10,NULL,'Loempia Ling Fa',6.2,'VOORGERECHT','met atjar, ananas en pindasaus'),(10,11,NULL,'Loempia Compleet',6.2,'VOORGERECHT','met gesmoord rundvlees en pikante saus'),(11,12,NULL,'Loempia met Kip',3.9,'VOORGERECHT',NULL),(12,13,NULL,'Loempia',3.8,'VOORGERECHT',NULL),(13,14,NULL,'Chinese mini loempia',4.9,'VOORGERECHT','4 st.'),(14,14,'A','Vegetarische mini loempia',4.9,'VOORGERECHT','12 st.'),(15,15,NULL,'Kroepoek',2.5,'VOORGERECHT',NULL),(16,15,'A','Casave Kroepoek',2.7,'VOORGERECHT',NULL),(17,16,NULL,'Pangsit Goreng',3.9,'VOORGERECHT','7 st.'),(18,17,NULL,'Pisang Goreng',3.4,'VOORGERECHT','5 st.'),(19,18,NULL,'Chinese Dim Sum',5.4,'VOORGERECHT','mini loempia, kerry ko, pangsit goreng, garnalenpasteitje'),(20,19,NULL,'Sat&eacute; Babi',5.4,'VOORGERECHT','4 st.'),(21,20,NULL,'Sat&eacute; Ajam',5.4,'VOORGERECHT','4 st.'),(22,20,'A','Sat&eacute; Garnalen',9.9,'VOORGERECHT','3 st.'),(23,21,NULL,'Fong Mei Ha',8.1,'VOORGERECHT','krokant gepaneerd garnalen. 4 st.'),(24,22,NULL,'Patat',2.3,'VOORGERECHT',NULL),(25,23,NULL,'Tsa Siu Mai',3.5,'VOORGERECHT','gebakken vleespasteitje. 4 st.'),(26,24,NULL,'Atjar',3,'VOORGERECHT',NULL),(27,25,NULL,'Witte Rijst',3,'VOORGERECHT',NULL),(28,26,NULL,'Grote pindasaus',3.9,'VOORGERECHT',NULL),(29,27,NULL,'Kleine pindasaus',2.3,'VOORGERECHT',NULL),(30,28,NULL,'Kippenpootje',2.3,'VOORGERECHT',NULL),(31,29,NULL,'Halve kip',6,'VOORGERECHT',NULL),(32,29,'H','Kroket',1.4,'VOORGERECHT',NULL),(33,29,'G','Frikandel',1.4,'VOORGERECHT',NULL),(34,180,'H','Kleine Sambal',2.5,'VOORGERECHT',NULL),(35,30,NULL,'Bami of Nasi Goreng Ling Fa',14.3,'BAMI EN NASI GERECHTEN','Foe Yong Hai, Babi Pangang, sat&eacute; en kippenpootje'),(36,31,NULL,'Bami of Nasi Goreng met ei',5,'BAMI EN NASI GERECHTEN',NULL),(37,32,NULL,'Bami of Nasi Goreng speciaal',8.5,'BAMI EN NASI GERECHTEN',NULL),(38,33,NULL,'Bami of Nasi Goreng met sat&eacute;',8.5,'BAMI EN NASI GERECHTEN','3 st.'),(39,34,NULL,'Nasi Yeung Chow',10.9,'BAMI EN NASI GERECHTEN',NULL),(40,34,'A','Nasi Yeung Chow',13,'BAMI EN NASI GERECHTEN','met garnaaltjes en Cha Sieuw-vlees'),(41,35,NULL,'Bami of Nasi Malay',9.3,'BAMI EN NASI GERECHTEN',NULL),(42,36,NULL,'Bami of Nasi met kipfilet',9.3,'BAMI EN NASI GERECHTEN',NULL),(43,37,NULL,'Bami of Nasi met varkensvlees',9.3,'BAMI EN NASI GERECHTEN',NULL),(44,38,NULL,'Bami of Nasi met garnalen',14.3,'BAMI EN NASI GERECHTEN',NULL),(45,39,NULL,'Bami of Nasi met ossenhaas',15.3,'BAMI EN NASI GERECHTEN',NULL),(46,40,NULL,'Babi Pangang, Foe Yong Hani en sat&eacute;',15.8,'COMBINATIE GERECHTEN (met witte rijst)',NULL),(47,41,NULL,'Babi Pangang, Tjap Tjoy en sat&eacute;',15.8,'COMBINATIE GERECHTEN (met witte rijst)',NULL),(48,42,NULL,'Babi Pangang, Koe Loe Yuk en sat&eacute;',15.8,'COMBINATIE GERECHTEN (met witte rijst)',NULL),(49,43,NULL,'Babi Pangang, Tau Sie Kai en sat&eacute;',16.5,'COMBINATIE GERECHTEN (met witte rijst)',NULL),(50,44,NULL,'Koe Loe Yuk, Foe Yong Hai en sat&eacute;',15.8,'COMBINATIE GERECHTEN (met witte rijst)',NULL),(51,45,NULL,'Koe Loe Yuk, Tjap Tjoy en sat&eacute;',15.8,'COMBINATIE GERECHTEN (met witte rijst)',NULL),(52,46,NULL,'Foe Yong Hai, Tjap Tjoy en sat&eacute;',15.8,'COMBINATIE GERECHTEN (met witte rijst)',NULL),(53,47,NULL,'Foe Yong Hai, Kip Kerrie en Sat&eacute;',16.5,'COMBINATIE GERECHTEN (met witte rijst)',NULL),(54,50,NULL,'Mihoen Ling Fa',16.4,'MIHOEN GERECHTEN','Foe Yong Hai, Babi Pangang, sat&eacute; en kippenpootje'),(55,51,NULL,'Mihoen met varkensvlees',9.3,'MIHOEN GERECHTEN',NULL),(56,52,NULL,'Mihoen met kipfilet',10.4,'MIHOEN GERECHTEN',NULL),(57,53,NULL,'Mihoen met ossenhaas',16.4,'MIHOEN GERECHTEN',NULL),(58,54,NULL,'Mihoen met garnalen',15.3,'MIHOEN GERECHTEN',NULL),(59,55,NULL,'Mihoen Singapore-style',11.9,'MIHOEN GERECHTEN','met kleine garnaaltjes en Cha Sieuw-vlees en kerrie poeder'),(60,56,NULL,'Mihoen met Cha Sieuw vlees',11.2,'MIHOEN GERECHTEN',NULL),(61,57,NULL,'Chinese Bami Ling Fa',16.9,'CHINESE BAMI GERECHTEN','Foe Yong Hai, Babi Pangang, sat&eacute; en kippenpootje'),(62,58,NULL,'Chinese Bami met varkensvlees',10.1,'CHINESE BAMI GERECHTEN',NULL),(63,58,'A','Chinese Bami met kipfilet',11.2,'CHINESE BAMI GERECHTEN',NULL),(64,58,'B','Chinese Bami met Cha Sieuw-vlees',12.2,'CHINESE BAMI GERECHTEN',NULL),(65,58,'C','Chinese Bami met garnalen',15.8,'CHINESE BAMI GERECHTEN',NULL),(66,58,'D','Chinese Bami met ossenhaas',17.4,'CHINESE BAMI GERECHTEN',NULL),(67,NULL,'M1','Bami of Nasi Rames Ling Fa',15.3,'INDISCHE GERECHTEN','Babi Pangan, Foe Yong Hai, Daging Roedjak, Atjar en kippootje'),(68,NULL,'M2','Bami of Nasi Rames',8.8,'INDISCHE GERECHTEN',NULL),(69,NULL,'M3','Bami of Nasi Rames speciaal',10.8,'INDISCHE GERECHTEN',NULL),(70,NULL,'M4','Gado Gado',7.6,'INDISCHE GERECHTEN','met witte rijst'),(71,NULL,'M5','Daging Smoor',13.3,'INDISCHE GERECHTEN','met witte rijst'),(72,NULL,'M6','Daging Roedjak',13.3,'INDISCHE GERECHTEN','met witte rijst'),(73,59,NULL,'Foe Yong Hai Ling Fa',16.4,'EIERGERECHTEN (met witte rijst)','ossenhaas, garnalen en kipfilet'),(74,60,NULL,'Foe Yong Hai met varkensvlees',8.8,'EIERGERECHTEN (met witte rijst)',NULL),(75,61,NULL,'Foe Yong Hai met kipfilet',9.2,'EIERGERECHTEN (met witte rijst)',NULL),(76,62,NULL,'Foe Yong Hai met garnalen',15.3,'EIERGERECHTEN (met witte rijst)',NULL),(77,63,NULL,'Foe Yong Hai met krab',15.3,'EIERGERECHTEN (met witte rijst)',NULL),(78,63,'A','Foe Yong Hai met Cha Sieuw Vlees',11.2,'EIERGERECHTEN (met witte rijst)',NULL),(79,63,'B','Foe Yong Hai met ossenhaas',16.4,'EIERGERECHTEN (met witte rijst)',NULL),(80,64,NULL,'Tjap Tjoy Ling Fa',16.4,'GROENTEN GERECHTEN (met witte rijst)','ossenhaas, garnalen en kipfilet'),(81,65,NULL,'Tjap Tjoy met varkensvlees',8.8,'GROENTEN GERECHTEN (met witte rijst)',NULL),(82,66,NULL,'Tjap Tjoy met kipfilet',9.2,'GROENTEN GERECHTEN (met witte rijst)',NULL),(83,67,NULL,'Tjap Tjoy met ossenhaas',16.4,'GROENTEN GERECHTEN (met witte rijst)',NULL),(84,68,NULL,'Tjap Tjoy met garnalen',15.3,'GROENTEN GERECHTEN (met witte rijst)',NULL),(85,70,NULL,'Babi Pangang',12.2,'VLEES GERECHTEN (met witte rijst)',NULL),(86,71,NULL,'Babi Pangang in ketjapsaus',12.3,'VLEES GERECHTEN (met witte rijst)',NULL),(87,72,NULL,'Cha Sieuw',13.3,'VLEES GERECHTEN (met witte rijst)','rood geroosterd varkensvlees'),(88,73,NULL,'Cha Sieuw in pikante saus',13.8,'VLEES GERECHTEN (met witte rijst)',NULL),(89,74,NULL,'Geroosterde speenvarken',13.8,'VLEES GERECHTEN (met witte rijst)',NULL),(90,75,NULL,'Koe Loe Yuk',11.9,'VLEES GERECHTEN (met witte rijst)','bolletjes vlees met zoetzure saus'),(91,76,NULL,'Varkenshaas met kerriesaus',11.9,'VLEES GERECHTEN (met witte rijst)',NULL),(92,77,NULL,'Varkenshaas met ketjapsaus',11.9,'VLEES GERECHTEN (met witte rijst)',NULL),(93,78,NULL,'Varkenshaas met tomatensaus',11.9,'VLEES GERECHTEN (met witte rijst)',NULL),(94,78,'A','Varkenshaas met champignons in knoflooksaus',11.9,'VLEES GERECHTEN (met witte rijst)',NULL),(95,78,'B','Varkenshaas met Chinese champignons',12.2,'VLEES GERECHTEN (met witte rijst)',NULL),(96,79,NULL,'Varkenshaas met zwarte bonensaus',12.2,'VLEES GERECHTEN (met witte rijst)',NULL),(97,79,'A','Varkenshaas met verse ananas in zoetzure saus',13.3,'VLEES GERECHTEN (met witte rijst)',NULL),(98,79,'B','Yu Sian Yuk',13.3,'VLEES GERECHTEN (met witte rijst)','varkenshaas met licht zoet pikante kruiden saus'),(99,79,'C','SzeChuan Yuk',13.3,'VLEES GERECHTEN (met witte rijst)','varkenshaas met pittige kruiden saus'),(100,80,NULL,'Ajam Pangang',13,'KIP GERECHTEN (met witte rijst)',NULL),(101,81,NULL,'Ajam Pangang in ketjapsaus',13,'KIP GERECHTEN (met witte rijst)',NULL),(102,82,NULL,'Koe Loe Kai',13,'KIP GERECHTEN (met witte rijst)','bolletjes kip met zoetzure saus'),(103,83,NULL,'Kipfilet met kerriesaus',13,'KIP GERECHTEN (met witte rijst)',NULL),(104,84,NULL,'Kipfilet met champignons in knoflooksaus',13,'KIP GERECHTEN (met witte rijst)',NULL),(105,85,NULL,'Kipfilet met tomatensaus',13,'KIP GERECHTEN (met witte rijst)',NULL),(106,86,NULL,'Kipfilet met ketjapsaus',13,'KIP GERECHTEN (met witte rijst)',NULL),(107,87,NULL,'Kipfilet met broccoli in knoflooksaus',13.3,'KIP GERECHTEN (met witte rijst)',NULL),(108,88,NULL,'Kipfilet met Chinese champignons',13.3,'KIP GERECHTEN (met witte rijst)',NULL),(109,89,NULL,'Kipfilet met zwarte pepersaus',13.3,'KIP GERECHTEN (met witte rijst)',NULL),(110,90,NULL,'Kipfilet met verse ananas in zoetzure saus',13.3,'KIP GERECHTEN (met witte rijst)',NULL),(111,91,NULL,'Kipfilet met zwarte pepersaus',13.3,'KIP GERECHTEN (met witte rijst)',NULL),(112,92,NULL,'Tjieuw Yem Kai',13.3,'KIP GERECHTEN (met witte rijst)','licht gebraden kipfilet met zout en peper'),(113,93,NULL,'Yao Koe Kai',13.3,'KIP GERECHTEN (met witte rijst)','kipfilet met cashewnoten in licht pikante saus'),(114,94,NULL,'Lychee Kai',13.8,'KIP GERECHTEN (met witte rijst)','licht gebraden kipfilet met lychee in zoetzure saus'),(115,95,NULL,'Yu Sian Kai',13.3,'KIP GERECHTEN (met witte rijst)','kipfilet met licht zoet pikante kruidensaus'),(116,96,NULL,'Sze Chuan Kai',13.8,'KIP GERECHTEN (met witte rijst)','kipfilet met pittige kruidensaus'),(117,97,NULL,'Kung Bao Kai',13.8,'KIP GERECHTEN (met witte rijst)','kipfilet met cashewnoten in pittige saus'),(118,98,NULL,'Garnalen met champignons in knoflooksaus',15.9,'GARNALEN GERECHTEN (met witte rijst)',NULL),(119,99,NULL,'Garnalen met tomatensaus',15.9,'GARNALEN GERECHTEN (met witte rijst)',NULL),(120,100,NULL,'Garnalen met ketjapsaus',15.9,'GARNALEN GERECHTEN (met witte rijst)',NULL),(121,101,NULL,'Garnalen met broccoli',16.1,'GARNALEN GERECHTEN (met witte rijst)',NULL),(122,102,NULL,'Garnalen met Chinese champignons',16.1,'GARNALEN GERECHTEN (met witte rijst)',NULL),(123,103,NULL,'Garnalen met kerriesaus',16.1,'GARNALEN GERECHTEN (met witte rijst)',NULL),(124,104,NULL,'Garnalen met zwarte bonensaus',16.1,'GARNALEN GERECHTEN (met witte rijst)',NULL),(125,105,NULL,'Garnalen met zwarte pepersaus',16.1,'GARNALEN GERECHTEN (met witte rijst)',NULL),(126,106,NULL,'Garnalen met chilisaus',16.1,'GARNALEN GERECHTEN (met witte rijst)',NULL),(127,107,NULL,'Yu Sian Haa',16.1,'GARNALEN GERECHTEN (met witte rijst)','garnalen met licht zoet pikante kruidensaus'),(128,108,NULL,'Tjieuw Yem Haa',16.1,'GARNALEN GERECHTEN (met witte rijst)','licht gebraden garnalen met zout en peper'),(129,109,NULL,'Tja Tai Haa',16.1,'GARNALEN GERECHTEN (met witte rijst)','krokant gebakken garnalen'),(130,110,NULL,'Sze Chuan Haa',16.4,'GARNALEN GERECHTEN (met witte rijst)',NULL),(131,111,NULL,'Ossenhaas met chanpignons in knoflooksaus',16.9,'OSSENHAAS GERECHTEN (met witte rijst)',NULL),(132,112,NULL,'Ossenhaas met tomatensaus',16.9,'OSSENHAAS GERECHTEN (met witte rijst)',NULL),(133,113,NULL,'Ossenhaas met ketjapsaus',16.9,'OSSENHAAS GERECHTEN (met witte rijst)',NULL),(134,114,NULL,'Ossenhaas met broccoli',17.1,'OSSENHAAS GERECHTEN (met witte rijst)',NULL),(135,115,NULL,'Ossenhaas met Chinese champignons',17.1,'OSSENHAAS GERECHTEN (met witte rijst)',NULL),(136,116,NULL,'Ossenhaas met kerriesaus',17.1,'OSSENHAAS GERECHTEN (met witte rijst)',NULL),(137,117,NULL,'Ossenhaas met zwarte bonensaus',17.1,'OSSENHAAS GERECHTEN (met witte rijst)',NULL),(138,118,NULL,'Ossenhaas met zwarte pepersaus',17.1,'OSSENHAAS GERECHTEN (met witte rijst)',NULL),(139,119,NULL,'Yu Sian Ngau Yuk',17.1,'OSSENHAAS GERECHTEN (met witte rijst)','ossenhaas met licht zoet pikante kruidensaus'),(140,120,NULL,'Sze Chuan Ngau Yuk',17.4,'OSSENHAAS GERECHTEN (met witte rijst)','ossenhaas met pittige kruidensaus'),(141,121,NULL,'Visfilet met kerriesaus',14.5,'VISSEN GERECHTEN (met witte rijst)',NULL),(142,122,NULL,'Visfilet met oestersaus',14.5,'VISSEN GERECHTEN (met witte rijst)',NULL),(143,123,NULL,'Visfilet met zoetzure saus',14.5,'VISSEN GERECHTEN (met witte rijst)','licht gebraden visfilet in zoete pikante saus'),(144,124,NULL,'Hong Shau Yu',14.5,'VISSEN GERECHTEN (met witte rijst)','licht gebraden visfilet in zoete pikante saus'),(145,125,NULL,'Tjeuw Yem Yu',15,'VISSEN GERECHTEN (met witte rijst)','licht gebraden visfilet met zout en peper'),(146,126,NULL,'San Sching Po',16.1,'VISSEN GERECHTEN (met witte rijst)','visfilet, garnalen, krab en groenten in knoflooksaus'),(147,NULL,'P1','Geroosterde Peking Eend',16.6,'PEKING EEND GERECHTEN (met witte rijst)',NULL),(148,NULL,'P2','Peking Eend met verse ananas in zoetzure saus',17.1,'PEKING EEND GERECHTEN (met witte rijst)',NULL),(149,NULL,'P3','Peking Eend met Chinese champignons in oestersaus',17.1,'PEKING EEND GERECHTEN (met witte rijst)',NULL),(150,NULL,'P4','Yu Sian Ya',17.1,'PEKING EEND GERECHTEN (met witte rijst)','peking eend met licht zoet pikante kruidensaus'),(151,NULL,'T1','Tiepan Ling Fa',17.9,'TIEPAN SPECIALITEITEN (met witte rijst)','garnalen, kipfilet, ossenhaas en groenten in zwarte pepersaus'),(152,NULL,'T2','Tiepan Kai',15.3,'TIEPAN SPECIALITEITEN (met witte rijst)','licht gebraden kipfilet en groenten met zoet pikante saus'),(153,NULL,'T3','Tiepan San Yuk',17.1,'TIEPAN SPECIALITEITEN (met witte rijst)','lichtgrbaden varkenshaas, kipfilet, ossenhaas en groenten met zoet pikante saus'),(154,NULL,'T4','Tiepan Haa',17.4,'TIEPAN SPECIALITEITEN (met witte rijst)','garnalen en groenten met zoet pikante saus'),(155,NULL,'T5','Tiepan Ngau Yuk',19.5,'TIEPAN SPECIALITEITEN (met witte rijst)','5st. ossenhaas en groenten met zoet pikante saus'),(156,NULL,'V4','Tau Fu Po',15.3,'TIEPAN SPECIALITEITEN (met witte rijst)','sojakaas, cha sieuw garnalen en chinese paddenstoelen'),(157,NULL,'V1','Vegetarische Tjap Tjoy',8.3,'VEGETARISCHE GERECHTEN (met witte rijst)',NULL),(158,NULL,'V2','Lo Han Zhai',11.2,'VEGETARISCHE GERECHTEN (met witte rijst)','sojakaas, Chinese paddenstoelen en groenten in knoflooksaus'),(159,NULL,'V3','Vegetarische Foe Yong Hai',8.3,'VEGETARISCHE GERECHTEN (met witte rijst)',NULL),(160,NULL,'K1','Frites, sat&eacute; (2st.) en ei',6.5,'KINDERMENUS',NULL),(161,NULL,'K2','Frites, kippootje en ei',6.5,'KINDERMENUS',NULL),(162,NULL,'K3','Frites, mini loempia (2st.) en ei',6.5,'KINDERMENUS',NULL),(163,NULL,'K4','Kinder Bami of Nasi met sat&eacute; (2st.) en ei',6.5,'KINDERMENUS',NULL),(164,NULL,'R1','Indische rijsttafel (voor 1 persoon)',16.4,'RIJSTTAFELS','Gado gado, Foe Yong Hai, sat&eacute;, Daging Roedjak, Daging Smoor, Ajam Ketjap, Atjar, Pisang Goreng, Pindas en Cocos'),(165,NULL,'R2','Indische rijsttafel<br>Vanaf 2 personen... Per persoon',15,'RIJSTTAFELS','Ajam Ketjap, Gado Gado, Daging Smoor, Kroepoek, Daging Roedjak, Foe Yong Hai, Sat&eacute;, Sambal Goreng Boontjes, Sambal Goreng Kering, Atjar, Pisang Goreng, Pinda en Cocos'),(167,NULL,'R3','Chinese Indische Rijsttafel<br>Vanaf 4 personen... per persoon',16.5,'RIJSTTAFELS','Foe Yong Hai, Babi Pangang, Tjap Tjoy, Koe Loe Yuk, Ajam Ketjap, Daging Smoor, Daging Roedjak, Sat&eacute;, Ei, Kroepoek, Sambal Goeren boontjes, Atjar, Pisang Goreng, Pinda en Cocos'),(168,NULL,'R4','Chinese Rijsttafel<br>Vanaf 2 personen... per persoon',17,'RIJSTTAFELS','Kippen- of Tomatensoep, Tjap Tjoy met kipfilet, Koe Loe Yuk, Gebakken garnalen, Babi Pangang, Foe Yong Hai, sat&eacute;, kroepoek'),(169,NULL,'R5','Kantones Rijsttafel<br>Vanaf 2 personen... per persoon',23,'RIJSTTAFELS','Wan Tan soep, Chinese Dim Sum (mini loempia, kerrie ko, pangsit goreng, garnalen, pasteitje), Geroosterde Peking Eend, Lychee Kai (licht gebraden kipfilet met lychee in zoetzure saus), Tau Sie Haa (garnalen met zwarte bonensaus)'),(170,NULL,'R6','Sze Chuan Rijsttafel<br>Vanaf 2 personen... per persoon',23,'RIJSTTAFELS','Peking Soep (pittige lichtzure soep), Chinese Dim Sum (mini loempia, kerrie ko, pangsit goreng, garnalen, pastei(tje), Tjieuw Yem Kai (licht gebakken kipfilet met zout en peper), Lychee Yuk (licht gebraden varkensvlees met lychee in zoetzure saus), Yu Sian Ngau Yuk (ossenhaas met licht zoet pikante kruiden saus)'),(171,NULL,NULL,'Buffet Menu A, per persoon',12.8,'BUFFET','Mini Loempia\'s, Pisang Goreng, Babi Pangang, Koe Loe Yuk, Foe Yong Hai, Kipfilet met zwarte bonensaus, Tjap Tjoy met kipfilet, sat&eacute; Ajam'),(172,NULL,NULL,'Buffet Menu B, per persoon',15,'BUFFET','Mini Loempia\'s, Pisang Goreng, Babi Pangang, Foe Yong Hai, Kung Bao Kai, Hong Shau Yu, sat&eacute; Ajam, Ossenhaas met zwarte bonensaus, Kipfilet met kerriesaus'),(173,NULL,NULL,'Bami of Nasi Goreng ipv rijst',0.9,'DIVERSEN',NULL),(174,NULL,NULL,'Mihoen Goreng ipv rijst',2.5,'DIVERSEN',NULL),(175,NULL,NULL,'Chinese Bami ipv rijst',2.5,'DIVERSEN',NULL);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_pdf`
--

DROP TABLE IF EXISTS `menu_pdf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_pdf` (
                            `id` int(11) NOT NULL,
                            `menu_pdf` longblob,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_pdf`
--

LOCK TABLES `menu_pdf` WRITE;
/*!40000 ALTER TABLE `menu_pdf` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu_pdf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rijst_enzo`
--

DROP TABLE IF EXISTS `rijst_enzo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rijst_enzo` (
                              `id` int(11) NOT NULL AUTO_INCREMENT,
                              `beschrijving` varchar(45) DEFAULT NULL,
                              `extra_prijs` int(11) DEFAULT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rijst_enzo`
--

LOCK TABLES `rijst_enzo` WRITE;
/*!40000 ALTER TABLE `rijst_enzo` DISABLE KEYS */;
/*!40000 ALTER TABLE `rijst_enzo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales` (
                         `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                         `itemId` int(11) NOT NULL,
                         `amount` int(11) NOT NULL,
                         `saleDate` datetime(4) NOT NULL,
                         PRIMARY KEY (`id`),
                         UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` VALUES (1,9,1,'2020-04-11 12:19:38.0000'),(2,10,1,'2020-04-11 12:19:38.0000'),(3,9,1,'2020-04-11 12:21:12.0000'),(4,10,1,'2020-04-11 12:21:12.0000'),(5,1,1,'2020-04-11 12:23:18.0000'),(6,3,1,'2020-04-11 12:23:18.0000'),(7,7,1,'2020-04-11 12:23:18.0000'),(8,1,1,'2020-04-11 12:36:21.0000'),(9,2,1,'2020-04-11 12:36:21.0000'),(10,3,1,'2020-04-11 12:36:21.0000'),(11,1,1,'2020-04-11 12:37:00.0000'),(12,2,1,'2020-04-11 12:37:00.0000'),(13,3,1,'2020-04-11 12:37:00.0000'),(14,1,1,'2020-04-11 12:38:58.0000'),(15,2,1,'2020-04-11 12:38:58.0000'),(16,1,1,'2020-04-11 12:39:03.0000'),(17,2,1,'2020-04-11 12:39:03.0000'),(18,3,1,'2020-04-11 12:44:52.0000'),(19,6,1,'2020-04-11 12:44:52.0000'),(20,1,1,'2020-04-11 15:48:38.0000'),(21,3,1,'2020-04-11 15:48:38.0000'),(22,5,1,'2020-04-11 15:48:38.0000'),(23,3,1,'2020-04-12 15:28:31.0000'),(24,6,1,'2020-04-12 15:28:31.0000'),(25,1,1,'2020-04-12 15:37:41.0000'),(26,2,1,'2020-04-12 15:37:41.0000'),(27,1,1,'2020-04-12 17:28:52.0000'),(28,2,1,'2020-04-12 17:28:52.0000'),(29,9,2,'2020-04-12 19:55:50.0000'),(30,3,3,'2020-04-12 20:50:49.0000'),(31,1,1,'2020-04-13 11:19:10.0000'),(32,5,4,'2020-04-13 11:19:10.0000'),(33,67,2,'2020-04-13 12:00:00.0000'),(34,1,4,'2020-04-13 14:52:21.0000'),(35,2,1,'2020-04-13 14:52:21.0000');
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `specialiteiten`
--

DROP TABLE IF EXISTS `specialiteiten`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `specialiteiten` (
                                  `id` varchar(10) NOT NULL,
                                  `name` varchar(45) NOT NULL,
                                  `informatie` mediumtext NOT NULL,
                                  `prijs` decimal(10,0) NOT NULL,
                                  `rijst_keuze_etc` int(11) NOT NULL,
                                  PRIMARY KEY (`id`),
                                  UNIQUE KEY `id_UNIQUE` (`id`),
                                  KEY `id_idx` (`rijst_keuze_etc`),
                                  CONSTRAINT `id` FOREIGN KEY (`rijst_keuze_etc`) REFERENCES `rijst_enzo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `specialiteiten`
--

LOCK TABLES `specialiteiten` WRITE;
/*!40000 ALTER TABLE `specialiteiten` DISABLE KEYS */;
/*!40000 ALTER TABLE `specialiteiten` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-14  8:50:23
