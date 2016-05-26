-- MySQL dump 10.13  Distrib 5.6.30, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: kuang
-- ------------------------------------------------------
-- Server version	5.6.30-0ubuntu0.14.04.1

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
-- Table structure for table `kuang_account`
--

DROP TABLE IF EXISTS `kuang_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kuang_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ore_total` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kuang_account_user_id_uindex` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kuang_account`
--

LOCK TABLES `kuang_account` WRITE;
/*!40000 ALTER TABLE `kuang_account` DISABLE KEYS */;
INSERT INTO `kuang_account` VALUES (1,8,175),(2,9,230),(3,10,110);
/*!40000 ALTER TABLE `kuang_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kuang_admin`
--

DROP TABLE IF EXISTS `kuang_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kuang_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(24) NOT NULL,
  `password` varchar(128) NOT NULL,
  `gathering_img` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kuang_admin`
--

LOCK TABLES `kuang_admin` WRITE;
/*!40000 ALTER TABLE `kuang_admin` DISABLE KEYS */;
INSERT INTO `kuang_admin` VALUES (1,'lixiang','e10adc3949ba59abbe56e057f20f883e','/u/m/20160519/573d80ce18f59.png');
/*!40000 ALTER TABLE `kuang_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kuang_cash`
--

DROP TABLE IF EXISTS `kuang_cash`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kuang_cash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `cash_ore` int(11) NOT NULL,
  `status` int(11) DEFAULT '1',
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kuang_cash`
--

LOCK TABLES `kuang_cash` WRITE;
/*!40000 ALTER TABLE `kuang_cash` DISABLE KEYS */;
INSERT INTO `kuang_cash` VALUES (1,8,720,1,NULL),(2,8,170,1,1464161607);
/*!40000 ALTER TABLE `kuang_cash` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kuang_friend`
--

DROP TABLE IF EXISTS `kuang_friend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kuang_friend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kuang_friend`
--

LOCK TABLES `kuang_friend` WRITE;
/*!40000 ALTER TABLE `kuang_friend` DISABLE KEYS */;
INSERT INTO `kuang_friend` VALUES (1,8,9,1464099753),(2,8,10,1464180569);
/*!40000 ALTER TABLE `kuang_friend` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kuang_invite_code`
--

DROP TABLE IF EXISTS `kuang_invite_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kuang_invite_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0',
  `invite_code` varchar(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kuang_invite_code`
--

LOCK TABLES `kuang_invite_code` WRITE;
/*!40000 ALTER TABLE `kuang_invite_code` DISABLE KEYS */;
INSERT INTO `kuang_invite_code` VALUES (1,0,'ddd222'),(5,8,'1c3Sw'),(6,9,'h9nLQ'),(7,10,'4ASLd');
/*!40000 ALTER TABLE `kuang_invite_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kuang_notice`
--

DROP TABLE IF EXISTS `kuang_notice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kuang_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kuang_notice`
--

LOCK TABLES `kuang_notice` WRITE;
/*!40000 ALTER TABLE `kuang_notice` DISABLE KEYS */;
INSERT INTO `kuang_notice` VALUES (2,'哈哈就开了我 ','就考虑为UI融危机快乐你们的飞洒加快了',1464151110);
/*!40000 ALTER TABLE `kuang_notice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kuang_order`
--

DROP TABLE IF EXISTS `kuang_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kuang_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `wechat_nickname` varchar(128) NOT NULL,
  `oremachine_num` int(11) NOT NULL,
  `payment_money` float NOT NULL,
  `status` tinyint(3) DEFAULT '1',
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kuang_order`
--

LOCK TABLES `kuang_order` WRITE;
/*!40000 ALTER TABLE `kuang_order` DISABLE KEYS */;
INSERT INTO `kuang_order` VALUES (2,8,'来了的境况',10,3498,2,NULL),(3,8,'古德里安',2,699,1,1464158871),(4,10,'古德里安',2,692,2,1464180636);
/*!40000 ALTER TABLE `kuang_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kuang_oremachine_manager`
--

DROP TABLE IF EXISTS `kuang_oremachine_manager`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kuang_oremachine_manager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ore_yield` int(11) NOT NULL DEFAULT '60',
  `create_time` int(11) DEFAULT NULL,
  `effective_time` int(11) DEFAULT NULL,
  `status` tinyint(3) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kuang_oremachine_manager`
--

LOCK TABLES `kuang_oremachine_manager` WRITE;
/*!40000 ALTER TABLE `kuang_oremachine_manager` DISABLE KEYS */;
INSERT INTO `kuang_oremachine_manager` VALUES (1,60,1463567048,1463587200,1),(2,55,1464187089,1464192000,1);
/*!40000 ALTER TABLE `kuang_oremachine_manager` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kuang_user`
--

DROP TABLE IF EXISTS `kuang_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kuang_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(24) NOT NULL,
  `password` varchar(128) NOT NULL,
  `money_img` varchar(256) DEFAULT NULL,
  `status` tinyint(3) DEFAULT '1',
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kuang_user_user_name_uindex` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kuang_user`
--

LOCK TABLES `kuang_user` WRITE;
/*!40000 ALTER TABLE `kuang_user` DISABLE KEYS */;
INSERT INTO `kuang_user` VALUES (8,'zhang1','c33367701511b4f6020ec61ded352059','/u/m/20160525/574545c72e14c.png',1,1463554296),(9,'zhang2','e10adc3949ba59abbe56e057f20f883e',NULL,1,1464099753),(10,'lixiang123','57b9c490fb827b8c09c374772516d1ef',NULL,1,1464180569);
/*!40000 ALTER TABLE `kuang_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kuang_user_oremachine`
--

DROP TABLE IF EXISTS `kuang_user_oremachine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kuang_user_oremachine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `residual_yield` int(11) NOT NULL,
  `effective_time` int(11) NOT NULL,
  `lately_make_time` int(11) DEFAULT NULL,
  `status` tinyint(3) DEFAULT '1',
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kuang_user_oremachine`
--

LOCK TABLES `kuang_user_oremachine` WRITE;
/*!40000 ALTER TABLE `kuang_user_oremachine` DISABLE KEYS */;
INSERT INTO `kuang_user_oremachine` VALUES (1,8,7085,1463673600,1464194521,1,1463662476),(2,8,7085,1463673600,1464194521,1,1463662476),(3,8,7085,1463673600,1464194521,1,1463662476),(4,9,7085,1463673600,1464194526,1,1464099779),(5,9,7085,1463673600,1464194526,1,1464099779),(6,10,7145,1464192000,1464194531,1,1464180866),(7,10,7145,1464192000,1464194531,1,1464180866);
/*!40000 ALTER TABLE `kuang_user_oremachine` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-26  9:13:04
