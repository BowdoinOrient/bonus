# ************************************************************
# Sequel Pro SQL dump
# Version 4004
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: medved (MySQL 5.1.67)
# Database: DB02Orient
# Generation Time: 2013-03-18 11:29:58 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

USE orient

# Dump of table alerts
# ------------------------------------------------------------

CREATE TABLE `alerts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `urgent` tinyint(4) NOT NULL DEFAULT '0',
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table article
# ------------------------------------------------------------

CREATE TABLE `article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `volume` int(11) NOT NULL,
  `issue_number` int(11) NOT NULL,
  `section_id` smallint(6) NOT NULL DEFAULT '0',
  `priority` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `subtitle` varchar(200) NOT NULL DEFAULT '',
  `excerpt` text NOT NULL,
  `series` int(10) unsigned NOT NULL DEFAULT '0',
  `type` int(10) unsigned NOT NULL DEFAULT '0',
  `views` int(10) unsigned NOT NULL DEFAULT '0',
  `views_bowdoin` int(10) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(4) NOT NULL DEFAULT '0',
  `featured` tinyint(4) NOT NULL DEFAULT '0',
  `opinion` tinyint(4) NOT NULL DEFAULT '0',
  `bigphoto` tinyint(4) NOT NULL DEFAULT '0',
  `active` tinyint(4) DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` datetime NOT NULL,
  `date_published` datetime NOT NULL,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `date-priority` (`date`,`priority`),
  KEY `date` (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table articleauthor
# ------------------------------------------------------------

CREATE TABLE `articleauthor` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `job_id` int(11) DEFAULT NULL,
  `priority` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `article_id` (`article_id`),
  KEY `author_id` (`author_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table articlebody
# ------------------------------------------------------------

CREATE TABLE `articlebody` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `body` text NOT NULL,
  `active` tinyint(11) NOT NULL DEFAULT '1',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `creator_id` int(11) DEFAULT NULL,
  `major` tinyint(4) NOT NULL DEFAULT '0',
  `comment` text,
  PRIMARY KEY (`id`),
  KEY `article_id` (`article_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table articletype
# ------------------------------------------------------------

CREATE TABLE `articletype` (
  `id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table attachments
# ------------------------------------------------------------

CREATE TABLE `attachments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(11) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `content1` text,
  `content2` text,
  `big` tinyint(4) NOT NULL DEFAULT '0',
  `active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table author
# ------------------------------------------------------------

CREATE TABLE `author` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '0',
  `photo` varchar(150) DEFAULT NULL,
  `job` int(15) NOT NULL DEFAULT '0',
  `bio` text,
  `twitter` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `NAME` (`name`),
  FULLTEXT KEY `author_full_index` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table ci_sessions
# ------------------------------------------------------------

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL DEFAULT '',
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table comment
# ------------------------------------------------------------

CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) DEFAULT NULL,
  `article_date` date NOT NULL DEFAULT '0000-00-00',
  `article_section` int(11) NOT NULL DEFAULT '0',
  `article_priority` int(11) NOT NULL DEFAULT '0',
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `comment` text NOT NULL,
  `deleted` char(1) NOT NULL DEFAULT 'n',
  `secret` int(100) NOT NULL DEFAULT '0',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `realname` varchar(255) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table event
# ------------------------------------------------------------

CREATE TABLE `event` (
  `issue_date` date NOT NULL DEFAULT '0000-00-00',
  `event_date` date NOT NULL DEFAULT '0000-00-00',
  `event_priority` smallint(11) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `timeplace` text,
  PRIMARY KEY (`issue_date`,`event_date`,`event_priority`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table issue
# ------------------------------------------------------------

CREATE TABLE `issue` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `issue_date` date NOT NULL DEFAULT '0000-00-00',
  `volume` int(11) NOT NULL,
  `issue_number` int(11) NOT NULL DEFAULT '0',
  `ready` tinyint(1) NOT NULL DEFAULT '1',
  `scribd` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table job
# ------------------------------------------------------------

CREATE TABLE `job` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table links
# ------------------------------------------------------------

CREATE TABLE `links` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `article_date` date NOT NULL DEFAULT '0000-00-00',
  `article_section` smallint(6) NOT NULL DEFAULT '0',
  `article_priority` int(11) NOT NULL DEFAULT '0',
  `linkname` varchar(250) NOT NULL DEFAULT '',
  `linkurl` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table photo
# ------------------------------------------------------------

CREATE TABLE `photo` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `filename_small` varchar(100) NOT NULL DEFAULT '',
  `filename_large` varchar(100) NOT NULL DEFAULT '',
  `filename_original` varchar(100) DEFAULT '',
  `photographer_id` int(11) DEFAULT NULL,
  `credit` varchar(100) NOT NULL DEFAULT '',
  `caption` text NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  `article_date` date NOT NULL DEFAULT '0000-00-00',
  `article_section` smallint(6) DEFAULT NULL,
  `article_priority` int(11) DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT '1',
  `feature` char(1) NOT NULL DEFAULT 'n',
  `feature_section` int(11) NOT NULL DEFAULT '0',
  `caption_backup` text NOT NULL,
  `active` tinyint(4) DEFAULT '1',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `article_id` (`article_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table quote
# ------------------------------------------------------------

CREATE TABLE `quote` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `quote` text,
  `attribution` varchar(150) DEFAULT NULL,
  `source` varchar(150) DEFAULT NULL,
  `public` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table related
# ------------------------------------------------------------

CREATE TABLE `related` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `article_date` date NOT NULL DEFAULT '0000-00-00',
  `article_section` smallint(6) NOT NULL DEFAULT '0',
  `article_priority` int(11) NOT NULL DEFAULT '0',
  `label` varchar(250) NOT NULL DEFAULT '',
  `url` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table section
# ------------------------------------------------------------

CREATE TABLE `section` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `priority` smallint(5) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL DEFAULT '',
  `shortname` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table series
# ------------------------------------------------------------

CREATE TABLE `series` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `photo` varchar(150) DEFAULT NULL,
  `description` text,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table settings
# ------------------------------------------------------------

CREATE TABLE `settings` (
  `name` varchar(255) DEFAULT NULL,
  `int_value` int(11) DEFAULT NULL,
  `string_value` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table ted
# ------------------------------------------------------------

CREATE TABLE `ted` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `message` varchar(500) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table tips
# ------------------------------------------------------------

CREATE TABLE `tips` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tip` text,
  `submitted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_location` varchar(255) DEFAULT NULL,
  `user_referer` varchar(255) DEFAULT NULL,
  `user_ip` varchar(255) DEFAULT NULL,
  `user_host` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `prompt` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table users
# ------------------------------------------------------------

CREATE TABLE `users` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table volume
# ------------------------------------------------------------

CREATE TABLE `volume` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `arabic` int(11) NOT NULL,
  `roman` varchar(11) NOT NULL DEFAULT '',
  `annodomini` year(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
