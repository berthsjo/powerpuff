# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.34)
# Database: dbpower
# Generation Time: 2014-08-17 09:15:03 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table blog_members
# ------------------------------------------------------------

DROP TABLE IF EXISTS `blog_members`;

CREATE TABLE `blog_members` (
  `memberID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`memberID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `blog_members` WRITE;
/*!40000 ALTER TABLE `blog_members` DISABLE KEYS */;

INSERT INTO `blog_members` (`memberID`, `username`, `password`, `email`)
VALUES
	(1,'Demo','$2a$12$TF8u1maUr5kADc42g1FB0ONJDEtt24ue.UTIuP13gij5AHsg5f5s2','demo@demo.com');

/*!40000 ALTER TABLE `blog_members` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table blog_posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `blog_posts`;

CREATE TABLE `blog_posts` (
  `postID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `postTitle` varchar(255) DEFAULT NULL,
  `postDesc` text,
  `postCont` text,
  `postDate` datetime DEFAULT NULL,
  PRIMARY KEY (`postID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `blog_posts` WRITE;
/*!40000 ALTER TABLE `blog_posts` DISABLE KEYS */;

INSERT INTO `blog_posts` (`postID`, `postTitle`, `postDesc`, `postCont`, `postDate`)
VALUES
	(1,'Bloggpost1','<p>Beskrivning - Bloggpost1</p>','<h2>Bloggpost1</h2>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum molestie augue vel auctor cursus. Curabitur leo velit, semper eu purus non, lacinia mattis odio. Aliquam tristique ante non fringilla commodo. Etiam consectetur augue nisl, non commodo erat vestibulum eu. Nunc dui dolor, dapibus a feugiat eget, consectetur et leo. Phasellus malesuada dignissim est, vel feugiat turpis varius sit amet. Quisque sapien tortor, lacinia vel consectetur at, tristique a lacus. In condimentum leo ut risus dapibus mollis. Proin vitae mauris sit amet libero dignissim auctor. Pellentesque et eros porttitor, luctus est et, placerat sapien. Curabitur volutpat mattis arcu convallis posuere. Curabitur euismod ipsum vitae enim pellentesque porta. Maecenas venenatis aliquet tempor. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus sagittis volutpat mauris.\n\nDonec consequat tincidunt ultricies. Pellentesque vestibulum arcu quis turpis hendrerit aliquet. Proin tellus diam, blandit at risus non, condimentum semper metus. Nam placerat risus urna, non lobortis sem laoreet nec. Nam venenatis elementum dapibus. Praesent vel facilisis odio, quis accumsan nisi. Fusce nec rhoncus turpis. Maecenas cursus diam augue, a ornare massa ultrices eget. In ut malesuada quam. Mauris eu blandit metus, non tempor ante.\n\nPellentesque ultricies odio a velit mattis convallis. Etiam faucibus tempor est ut varius. Vestibulum dapibus in velit aliquam pretium. Mauris sodales gravida elementum. Nullam eget risus eget tellus tincidunt blandit vitae et diam. Aliquam aliquet felis metus, et facilisis nisi pulvinar et. Nulla tempor rhoncus libero id blandit. Phasellus a varius ligula. Nam et aliquet erat. Donec quis tortor sem. Donec vel diam sed erat posuere rhoncus. Sed dapibus auctor purus, eget porttitor nisl volutpat eget. Praesent felis nulla, ullamcorper eu nibh ac, laoreet placerat justo.\n\nQuisque malesuada, libero sit amet laoreet iaculis, odio libero imperdiet augue, vitae fermentum arcu odio quis justo. Suspendisse vel mollis sapien. Etiam mi sem, feugiat ut aliquam in, laoreet in nunc. Etiam vel malesuada tellus, nec aliquam magna. Aliquam tincidunt mi id eros volutpat vulputate in id sem. Curabitur facilisis aliquam quam at ornare. Maecenas cursus metus non lectus aliquet elementum.\n\nNam odio justo, tristique quis neque a, mattis elementum quam. Suspendisse molestie enim quis felis bibendum viverra. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque blandit suscipit dolor, ac volutpat lectus facilisis id. Aenean sollicitudin diam molestie augue bibendum, in lobortis sem egestas. Nam euismod sem vel dui interdum auctor. Morbi a risus nec odio interdum facilisis eget sed magna. Nunc a euismod diam, quis dignissim turpis.</p>','2013-05-29 00:00:00'),
	(2,'Bloggpost2','<p>Beskrivning - Bloggpost2</p>','<h2>Bloggpost2</h2>\r\n<p>ILorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum molestie augue vel auctor cursus. Curabitur leo velit, semper eu purus non, lacinia mattis odio. Aliquam tristique ante non fringilla commodo. Etiam consectetur augue nisl, non commodo erat vestibulum eu. Nunc dui dolor, dapibus a feugiat eget, consectetur et leo. Phasellus malesuada dignissim est, vel feugiat turpis varius sit amet. Quisque sapien tortor, lacinia vel consectetur at, tristique a lacus. In condimentum leo ut risus dapibus mollis. Proin vitae mauris sit amet libero dignissim auctor. Pellentesque et eros porttitor, luctus est et, placerat sapien. Curabitur volutpat mattis arcu convallis posuere. Curabitur euismod ipsum vitae enim pellentesque porta. Maecenas venenatis aliquet tempor. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus sagittis volutpat mauris.</p>','2013-06-05 23:10:35'),
	(3,'Bloggpost3','<p>Beskrivning - Bloggpost3</p>','<h2>Bloggpost3</h2>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum molestie augue vel auctor cursus. Curabitur leo velit, semper eu purus non, lacinia mattis odio. Aliquam tristique ante non fringilla commodo. Etiam consectetur augue nisl, non commodo erat vestibulum eu. Nunc dui dolor, dapibus a feugiat eget, consectetur et leo. Phasellus malesuada dignissim est, vel feugiat turpis varius sit amet. Quisque sapien tortor, lacinia vel consectetur at, tristique a lacus. In condimentum leo ut risus dapibus mollis. Proin vitae mauris sit amet libero dignissim auctor. Pellentesque et eros porttitor, luctus est et, placerat sapien. Curabitur volutpat mattis arcu convallis posuere. Curabitur euismod ipsum vitae enim pellentesque porta. Maecenas venenatis aliquet tempor. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus sagittis volutpat mauris.\n\nNam odio justo, tristique quis neque a, mattis elementum quam. Suspendisse molestie enim quis felis bibendum viverra. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque blandit suscipit dolor, ac volutpat lectus facilisis id. Aenean sollicitudin diam molestie augue bibendum, in lobortis sem egestas. Nam euismod sem vel dui interdum auctor. Morbi a risus nec odio interdum facilisis eget sed magna. Nunc a euismod diam, quis dignissim turpis.</p>','2013-06-05 23:20:24');

/*!40000 ALTER TABLE `blog_posts` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
