# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.7.17)
# Database: thoksaman
# Generation Time: 2018-10-09 14:01:11 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table banners
# ------------------------------------------------------------

DROP TABLE IF EXISTS `banners`;

CREATE TABLE `banners` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `display_order` int(11) NOT NULL DEFAULT '0',
  `position` varchar(30) NOT NULL DEFAULT '',
  `banner` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;

INSERT INTO `banners` (`id`, `display_order`, `position`, `banner`)
VALUES
	(1,2,'Home Main','image_slider1.jpg'),
	(2,3,'Home Main','image_slider2.jpg'),
	(3,1,'Home Main','image_slider3.jpg'),
	(4,1,'Home Sub Main','image_slider4.jpg'),
	(5,2,'Home Sub Main','image_slider5.jpg'),
	(6,3,'Home Sub Main','image_slider7.jpg'),
	(7,4,'Home Sub Main','image_slider8.jpg'),
	(9,5,'Home Sub Main','image_slider9.jpg');

/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;


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
	(1,'Vegetables','Potatoes, Tomatoes','video-cover-bg1.jpg',0),
	(6,'Fruits','',NULL,0),
	(7,'Grain','',NULL,0),
	(8,'Meat','',NULL,0),
	(9,'Dairy','',NULL,0),
	(10,'Oils','',NULL,0),
	(11,'Ayurvedic','',NULL,0),
	(12,'Food Supplement','',NULL,0),
	(13,'Breads','',NULL,0),
	(14,'White Potato','','UTC-logo.jpg',1),
	(15,'Mango','',NULL,6);

/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table contents
# ------------------------------------------------------------

DROP TABLE IF EXISTS `contents`;

CREATE TABLE `contents` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` tinytext NOT NULL,
  `slug` tinytext NOT NULL,
  `content` mediumtext NOT NULL,
  `content_type` varchar(30) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `contents` WRITE;
/*!40000 ALTER TABLE `contents` DISABLE KEYS */;

INSERT INTO `contents` (`id`, `title`, `slug`, `content`, `content_type`)
VALUES
	(2,'About Us','about-us','&lt;p&gt;asdf asdf asdf asdfasdfasdf alsdjflasdfdfasdf fasfasdfdfasf sda fsda f llkjl lkjl&lt;/p&gt;&lt;p&gt;kjhk kjhkjh kh k&lt;/p&gt;&lt;iframe class=&quot;ql-video&quot; frameborder=&quot;0&quot; allowfullscreen=&quot;true&quot; src=&quot;https://www.youtube.com/embed/euM9O6Qaog8?showinfo=0&quot;&gt;&lt;/iframe&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;','Info'),
	(3,'How it Works ?','how-it-works','&lt;p&gt;Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatum nisi, quaerat sit esse aliquam eos vero minus sed. Est culpa reiciendis optio eveniet at explicabo harum tempore ut dicta et. Sem, gravida phasellus et etiam.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;Lacus. Adipiscing tempor nunc fermentum pede montes fames eleifend justo rutrum ornare. Sollicitudin interdum interdum et condimentum. Posuere dapibus. Massa consequat. Mi sagittis.Sagittis fusce fermentum dictumst pharetra parturient scelerisque pellentesque justo lobortis sit primis nisl integer cursus Ipsum lobortis. Non cras ut hymenaeos class.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;Tellus ante phasellus orci vivamus fames eu metus eget tincidunt tellus rhoncus.Ridiculus donec vehicula. Sit conubia velit fringilla lacus et laoreet integer. Dignissim aliquam sagittis cum etiam. Inceptos viverra consequat a parturient tempor netus metus, quam sem erat torquent convallis. Volutpat fermentum curae; Aptent nulla. Ornare nunc quisque hymenaeos.&lt;/p&gt;','Info'),
	(4,'Contact Us','contact-us','&lt;p&gt;Sem, gravida phasellus et etiam. Lacus. Adipiscing tempor nunc fermentum pede montes fames eleifend justo rutrum ornare. Sollicitudin interdum interdum et condimentum. Posuere dapibus. Massa consequat.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;Mi sagittis.Sagittis fusce fermentum dictumst pharetra parturient scelerisque pellentesque justo lobortis sit primis nisl integer cursus Ipsum lobortis. Non cras ut hymenaeos class. Tellus ante phasellus orci vivamus fames eu metus eget tincidunt tellus rhoncus.Ridiculus donec vehicula. Sit conubia velit fringilla lacus et laoreet integer. Dignissim aliquam sagittis cum etiam.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;Inceptos viverra consequat a parturient tempor netus metus, quam sem erat torquent convallis. Volutpat fermentum curae; Aptent nulla. Ornare nunc quisque hymenaeos.&lt;/p&gt;','Info'),
	(5,'FAQ','faq','&lt;p&gt;Sem, gravida phasellus et etiam. Lacus. Adipiscing tempor nunc fermentum pede montes fames eleifend justo rutrum ornare. Sollicitudin interdum interdum et condimentum. Posuere dapibus. Massa consequat.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;Mi sagittis.Sagittis fusce fermentum dictumst pharetra parturient scelerisque pellentesque justo lobortis sit primis nisl integer cursus Ipsum lobortis. Non cras ut hymenaeos class. Tellus ante phasellus orci vivamus fames eu metus eget tincidunt tellus rhoncus.Ridiculus donec vehicula.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;Sit conubia velit fringilla lacus et laoreet integer. Dignissim aliquam sagittis cum etiam. Inceptos viverra consequat a parturient tempor netus metus, quam sem erat torquent convallis. Volutpat fermentum curae; Aptent nulla. Ornare nunc quisque hymenaeos.&lt;/p&gt;','Info'),
	(6,'Terms & Conditions','terms-conditions','&lt;p&gt;Sem, gravida phasellus et etiam. Lacus. Adipiscing tempor nunc fermentum pede montes fames eleifend justo rutrum ornare.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;Sollicitudin interdum interdum et condimentum. Posuere dapibus. Massa consequat. Mi sagittis.Sagittis fusce fermentum dictumst pharetra parturient scelerisque pellentesque justo lobortis sit primis nisl integer cursus Ipsum lobortis. Non cras ut hymenaeos class. Tellus ante phasellus orci vivamus fames eu metus eget tincidunt tellus rhoncus.Ridiculus donec vehicula. Sit conubia velit fringilla lacus et laoreet integer. Dignissim aliquam sagittis cum etiam.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;Inceptos viverra consequat a parturient tempor netus metus, quam sem erat torquent convallis. Volutpat fermentum curae; Aptent nulla. Ornare nunc quisque hymenaeos.&lt;/p&gt;','Info'),
	(7,'Privacy Policy','privacy-policy','&lt;p&gt;Sem, gravida phasellus et etiam. Lacus. Adipiscing tempor nunc fermentum pede montes fames eleifend justo rutrum ornare. Sollicitudin interdum interdum et condimentum. Posuere dapibus. Massa consequat.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;Mi sagittis.Sagittis fusce fermentum dictumst pharetra parturient scelerisque pellentesque justo lobortis sit primis nisl integer cursus Ipsum lobortis. Non cras ut hymenaeos class. Tellus ante phasellus orci vivamus fames eu metus eget tincidunt tellus rhoncus.Ridiculus donec vehicula.&lt;/p&gt;&lt;p&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;Sit conubia velit fringilla lacus et laoreet integer. Dignissim aliquam sagittis cum etiam. Inceptos viverra consequat a parturient tempor netus metus, quam sem erat torquent convallis. Volutpat fermentum curae; Aptent nulla. Ornare nunc quisque hymenaeos.&lt;/p&gt;','Info'),
	(8,'This is a blog','this-is-a-blog','&lt;p&gt;Yeah blog!!!!&lt;/p&gt;','Blog');

/*!40000 ALTER TABLE `contents` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table outlets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `outlets`;

CREATE TABLE `outlets` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `outlet` varchar(100) NOT NULL DEFAULT '',
  `description` mediumtext,
  `contact_person` varchar(100) NOT NULL DEFAULT '',
  `address` text,
  `phone` text,
  `email` text,
  `viber` varchar(30) DEFAULT '',
  `whatsapp` varchar(30) DEFAULT '',
  `skype` varchar(30) DEFAULT '',
  `lat` decimal(15,12) DEFAULT NULL,
  `lng` decimal(15,12) DEFAULT NULL,
  `slug` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `outlets` WRITE;
/*!40000 ALTER TABLE `outlets` DISABLE KEYS */;

INSERT INTO `outlets` (`id`, `outlet`, `description`, `contact_person`, `address`, `phone`, `email`, `viber`, `whatsapp`, `skype`, `lat`, `lng`, `slug`)
VALUES
	(1,'Main Outlet','Main Outlet\n','Binod Koirala','Banewore','98774774',NULL,'9876564646','9876564646','9876564646',27.721225100000,85.299318000000,'');

/*!40000 ALTER TABLE `outlets` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table payment_methods
# ------------------------------------------------------------

DROP TABLE IF EXISTS `payment_methods`;

CREATE TABLE `payment_methods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `payment_method` varchar(40) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `payment_methods` WRITE;
/*!40000 ALTER TABLE `payment_methods` DISABLE KEYS */;

INSERT INTO `payment_methods` (`id`, `payment_method`)
VALUES
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



# Dump of table settings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `site_name` varchar(100) DEFAULT NULL,
  `phone1` varchar(50) DEFAULT NULL,
  `phone2` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `order_email` varchar(50) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;

INSERT INTO `settings` (`id`, `site_name`, `phone1`, `phone2`, `address`, `email`, `order_email`, `description`)
VALUES
	(1,'Thok Saman','977 1 837363','977 1 838473','Nayabazar, Kathmandu Nepal','info@thoksaman.com','order@thoksaman.com','Your Local market.');

/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;


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
