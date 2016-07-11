CREATE DATABASE  IF NOT EXISTS `gapp` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `gapp`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: gapp
-- ------------------------------------------------------
-- Server version	5.5.15

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
-- Table structure for table `challenge`
--

DROP TABLE IF EXISTS `challenge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `challenge` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='Holds user answers to secret questions for authentication';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `challenge`
--

LOCK TABLES `challenge` WRITE;
/*!40000 ALTER TABLE `challenge` DISABLE KEYS */;
INSERT INTO `challenge` VALUES (1,'What is your mother\'s maiden name?'),(2,'What was your childhood phone number?'),(3,'What was the name the street you lived on as a child?'),(4,'What city were you born in?');
/*!40000 ALTER TABLE `challenge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `games`
--

DROP TABLE IF EXISTS `games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `games` (
  `id` int(10) unsigned NOT NULL,
  `Name` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games`
--

LOCK TABLES `games` WRITE;
/*!40000 ALTER TABLE `games` DISABLE KEYS */;
INSERT INTO `games` VALUES (1,'Word Shuffle');
/*!40000 ALTER TABLE `games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instructions`
--

DROP TABLE IF EXISTS `instructions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instructions` (
  `id` int(10) unsigned NOT NULL,
  `idGame` int(10) unsigned NOT NULL,
  `title` varchar(60) NOT NULL,
  `picture` varchar(200) NOT NULL COMMENT 'fully qualified path to picture',
  PRIMARY KEY (`id`),
  KEY `fkInstructions2Games` (`idGame`),
  CONSTRAINT `fkInstructions2Games` FOREIGN KEY (`idGame`) REFERENCES `games` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instructions`
--

LOCK TABLES `instructions` WRITE;
/*!40000 ALTER TABLE `instructions` DISABLE KEYS */;
INSERT INTO `instructions` VALUES (1,1,'How do I play?','/app/assets/wordshuffle/instructions/title-pic.png');
/*!40000 ALTER TABLE `instructions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `idInstructions` int(10) unsigned NOT NULL,
  `body` varchar(200) NOT NULL COMMENT 'fully qualified name from the webroot to the html file that contains the body of the page',
  `sequence` int(10) unsigned NOT NULL COMMENT 'order of page',
  PRIMARY KEY (`id`),
  KEY `fkPages2Instructions` (`idInstructions`),
  CONSTRAINT `fkPages2Instructions` FOREIGN KEY (`idInstructions`) REFERENCES `instructions` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page`
--

LOCK TABLES `page` WRITE;
/*!40000 ALTER TABLE `page` DISABLE KEYS */;
INSERT INTO `page` VALUES (1,1,'/app/assets/wordshuffle/instructions/page01.html',1),(2,1,'/app/assets/wordshuffle/instructions/page02.html',2),(3,1,'/app/assets/wordshuffle/instructions/page03.html',3);
/*!40000 ALTER TABLE `page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `player`
--

DROP TABLE IF EXISTS `player`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `player` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `idChallenge` int(10) unsigned NOT NULL,
  `secret` varchar(200) DEFAULT NULL,
  `createDate` datetime NOT NULL,
  `modifyDate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `fkPlayer2Challenge` (`idChallenge`),
  CONSTRAINT `fkPlayer2Challenge` FOREIGN KEY (`idChallenge`) REFERENCES `challenge` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `player`
--

LOCK TABLES `player` WRITE;
/*!40000 ALTER TABLE `player` DISABLE KEYS */;
INSERT INTO `player` VALUES (1,'Forrest',4,'New','2016-07-10 02:14:36','2016-07-10 02:14:35');
/*!40000 ALTER TABLE `player` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wordlist`
--

DROP TABLE IF EXISTS `wordlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wordlist` (
  `Word` varchar(60) DEFAULT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='LOAD DATA LOCAL INFILE ''/temp/CROSSWD.TXT'' INTO TABLE WordList LINES TERMINATED BY ''\\r\\n'';\nLOAD DATA LOCAL INFILE ''/temp/CRSWD-D.TXT'' INTO TABLE WordList LINES TERMINATED BY ''\\r\\n'';';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wordlist`
--

LOCK TABLES `wordlist` WRITE;
/*!40000 ALTER TABLE `wordlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `wordlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wsgame`
--

DROP TABLE IF EXISTS `wsgame`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wsgame` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idPlayer` int(10) unsigned NOT NULL,
  `roundsPerGame` int(11) NOT NULL,
  `secondsPerRound` int(11) NOT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `points` int(10) unsigned DEFAULT NULL,
  `roundAvg` int(10) unsigned DEFAULT NULL,
  `status` enum('New','NewRound','InProgress','Completed','Abandoned') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fkGame2Player` (`idPlayer`),
  CONSTRAINT `fkGame2Player` FOREIGN KEY (`idPlayer`) REFERENCES `player` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wsgame`
--

LOCK TABLES `wsgame` WRITE;
/*!40000 ALTER TABLE `wsgame` DISABLE KEYS */;
INSERT INTO `wsgame` VALUES (1,1,4,180,'2015-03-15 00:00:00','2015-03-15 00:00:00',56,23,'Completed'),(2,1,3,120,'2015-03-10 00:00:00','2015-03-10 00:00:00',78,12,'Completed'),(3,1,3,120,'2016-07-10 01:58:11',NULL,0,0,'Abandoned'),(4,1,3,120,'2016-07-10 02:14:36',NULL,3,0,'Abandoned');
/*!40000 ALTER TABLE `wsgame` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wsround`
--

DROP TABLE IF EXISTS `wsround`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wsround` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idWSGame` int(10) unsigned NOT NULL,
  `time` int(10) unsigned NOT NULL COMMENT 'Time for that Round',
  `points` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Points achieved during round',
  `wordCount` int(10) unsigned NOT NULL DEFAULT '0',
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `index` int(10) unsigned NOT NULL COMMENT 'index position of round',
  PRIMARY KEY (`id`),
  KEY `fkRound2Game` (`idWSGame`),
  CONSTRAINT `fkRound2Game` FOREIGN KEY (`idWSGame`) REFERENCES `wsgame` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wsround`
--

LOCK TABLES `wsround` WRITE;
/*!40000 ALTER TABLE `wsround` DISABLE KEYS */;
INSERT INTO `wsround` VALUES (1,3,120,0,0,'2016-07-10 01:58:11','2016-07-10 02:00:11',0),(2,3,120,0,0,'2016-07-10 02:00:12','2016-07-10 02:02:12',1),(3,3,120,0,0,NULL,NULL,2),(4,4,120,3,1,'2016-07-10 02:14:36','2016-07-10 02:16:36',0),(5,4,120,0,0,NULL,NULL,1),(6,4,120,0,0,NULL,NULL,2);
/*!40000 ALTER TABLE `wsround` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'gapp'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-07-10  2:52:40
