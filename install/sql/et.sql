-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 15. Nov 2016 um 10:44
-- Server Version: 5.6.21
-- PHP-Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `et`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `et_announce`
--

CREATE TABLE IF NOT EXISTS `et_announce` (
`id` int(255) NOT NULL,
  `userid` int(10) NOT NULL,
  `sender` int(10) NOT NULL,
  `ann_title` varchar(255) NOT NULL,
  `ann_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ann_msg` text NOT NULL,
  `ann_read` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `et_article`
--

CREATE TABLE IF NOT EXISTS `et_article` (
`id` int(255) NOT NULL,
  `cat` int(10) NOT NULL,
  `art_title` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `et_category`
--

CREATE TABLE IF NOT EXISTS `et_category` (
`id` int(10) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_descript` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `et_chat`
--

CREATE TABLE IF NOT EXISTS `et_chat` (
`id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `msgtime` varchar(255) NOT NULL,
  `channel` varchar(255) NOT NULL,
  `whisperto` varchar(255) DEFAULT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=178 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `et_course`
--

CREATE TABLE IF NOT EXISTS `et_course` (
`id` int(255) NOT NULL,
  `teacher` int(255) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `descript` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `et_log`
--

CREATE TABLE IF NOT EXISTS `et_log` (
`id` int(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `et_mail`
--

CREATE TABLE IF NOT EXISTS `et_mail` (
`id` int(255) NOT NULL,
  `from_user` varchar(255) NOT NULL,
  `to_user` varchar(255) NOT NULL,
  `rcp` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` text NOT NULL,
  `read` int(1) DEFAULT '0',
  `outbox` int(1) NOT NULL DEFAULT '1',
  `inbox` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `et_online`
--

CREATE TABLE IF NOT EXISTS `et_online` (
  `username` varchar(255) NOT NULL,
  `logtime` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `et_presence`
--

CREATE TABLE IF NOT EXISTS `et_presence` (
  `uid` int(255) NOT NULL,
  `year` varchar(4) NOT NULL,
  `month` varchar(2) NOT NULL,
  `day` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `et_user`
--

CREATE TABLE IF NOT EXISTS `et_user` (
`id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `userpass` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `lvl` int(2) NOT NULL DEFAULT '0',
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `course` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `et_announce`
--
ALTER TABLE `et_announce`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indizes für die Tabelle `et_article`
--
ALTER TABLE `et_article`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indizes für die Tabelle `et_category`
--
ALTER TABLE `et_category`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indizes für die Tabelle `et_chat`
--
ALTER TABLE `et_chat`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indizes für die Tabelle `et_course`
--
ALTER TABLE `et_course`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indizes für die Tabelle `et_log`
--
ALTER TABLE `et_log`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indizes für die Tabelle `et_mail`
--
ALTER TABLE `et_mail`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indizes für die Tabelle `et_online`
--
ALTER TABLE `et_online`
 ADD UNIQUE KEY `username` (`username`);

--
-- Indizes für die Tabelle `et_user`
--
ALTER TABLE `et_user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `et_announce`
--
ALTER TABLE `et_announce`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT für Tabelle `et_article`
--
ALTER TABLE `et_article`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `et_category`
--
ALTER TABLE `et_category`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT für Tabelle `et_chat`
--
ALTER TABLE `et_chat`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=178;
--
-- AUTO_INCREMENT für Tabelle `et_course`
--
ALTER TABLE `et_course`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `et_log`
--
ALTER TABLE `et_log`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT für Tabelle `et_mail`
--
ALTER TABLE `et_mail`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT für Tabelle `et_user`
--
ALTER TABLE `et_user`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
