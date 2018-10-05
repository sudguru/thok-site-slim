# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.7.17)
# Database: thoksaman
# Generation Time: 2018-10-05 09:43:25 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table cart
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cart`;

CREATE TABLE `cart` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(50) NOT NULL DEFAULT '',
  `description` text,
  `banner` varchar(50) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;

INSERT INTO `categories` (`id`, `category`, `description`, `banner`, `parent_id`)
VALUES
	(1,'Vegetables','Potatoes, Tomatoes',NULL,0),
	(2,'Vegetables','Potatoes, Tomatoes',NULL,0),
	(3,'Vegetables','Potatoes, Tomatoes',NULL,4),
	(4,'Vegetables','Potatoes, Tomatoes',NULL,0),
	(5,'Vegetables','Potatoes, Tomatoes',NULL,4);

/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table payment_methods
# ------------------------------------------------------------

DROP TABLE IF EXISTS `payment_methods`;

CREATE TABLE `payment_methods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `payment_method` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `payment_methods` WRITE;
/*!40000 ALTER TABLE `payment_methods` DISABLE KEYS */;

INSERT INTO `payment_methods` (`id`, `payment_method`)
VALUES
	(1,'ESewa'),
	(2,'Cash On Delevery'),
	(3,'Bank Deposit');

/*!40000 ALTER TABLE `payment_methods` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_images
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_images`;

CREATE TABLE `product_images` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `pic_path` varchar(50) NOT NULL DEFAULT '',
  `caption` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table product_price
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_price`;

CREATE TABLE `product_price` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `attributes` varchar(300) NOT NULL DEFAULT '',
  `regular` double(15,2) NOT NULL,
  `discounted` double(15,2) NOT NULL DEFAULT '0.00',
  `discount_valid_unitl` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `name` int(11) NOT NULL,
  `SKU` varchar(20) DEFAULT NULL,
  `description` text,
  `user_id` int(10) unsigned NOT NULL,
  `available` tinyint(4) NOT NULL DEFAULT '0',
  `qty_per_unit` int(11) DEFAULT NULL,
  `unit` varchar(15) DEFAULT NULL,
  `min_order_unit` int(11) DEFAULT NULL,
  `max_order_unit` int(11) DEFAULT NULL,
  `orank` int(11) DEFAULT NULL,
  `vrank` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `is_admin` tinyint(4) NOT NULL DEFAULT '0',
  `is_super` tinyint(4) NOT NULL DEFAULT '0',
  `is_customer` tinyint(4) NOT NULL DEFAULT '0',
  `is_vendor` tinyint(4) NOT NULL DEFAULT '0',
  `email` varchar(30) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `company_name` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `state` varchar(30) DEFAULT NULL,
  `postal_code` int(11) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `fax` varchar(30) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `payment_methods` varchar(100) DEFAULT NULL,
  `bank_info` varchar(200) DEFAULT NULL,
  `notes` varchar(200) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `is_admin`, `is_super`, `is_customer`, `is_vendor`, `email`, `password`, `company_name`, `address`, `city`, `state`, `postal_code`, `country`, `phone`, `fax`, `url`, `logo`, `payment_methods`, `bank_info`, `notes`, `description`)
VALUES
	(1,1,1,0,0,'sg@gmail.com','gurung123',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(2,1,0,0,1,'bk@gmail.com','gurung1238','Thok Saman Pvt. Ltd','Baneswore','Kathmandu','3',5443,'Nepal','9876545432',NULL,'www.thoksaman.com',NULL,'[1,2,3]','Himalayan Bank, A/C 012309009487',NULL,NULL);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table wishlist
# ------------------------------------------------------------

DROP TABLE IF EXISTS `wishlist`;

CREATE TABLE `wishlist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
