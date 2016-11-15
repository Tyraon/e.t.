-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 14. Nov 2016 um 14:54
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
  `from` int(10) NOT NULL,
  `ann_title` varchar(255) NOT NULL,
  `ann_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ann_msg` text NOT NULL,
  `ann_read` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `et_announce`
--

INSERT INTO `et_announce` (`id`, `userid`, `from`, `ann_title`, `ann_time`, `ann_msg`, `ann_read`) VALUES
(1, 1, 1, 'Test', '2016-11-14 12:17:17', 'Testnachricht für ein erstes Announce', 1),
(2, 1, 1, 'Test2', '2016-11-14 12:25:20', 'Zweites Testannounce', 1),
(3, 1, 1, 'Testmeldung', '2016-11-14 13:51:46', 'Testnachricht fÃ¼r die Meldung', 1),
(4, 4, 1, 'Testmeldung', '2016-11-14 13:51:46', 'Testnachricht fÃ¼r die Meldung', 1),
(5, 6, 1, 'Testmeldung', '2016-11-14 13:51:46', 'Testnachricht fÃ¼r die Meldung', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `et_article`
--

INSERT INTO `et_article` (`id`, `cat`, `art_title`, `uid`, `time`, `content`) VALUES
(1, 2, 'Grundlagen I - Selector', '1', '2016-11-09 09:27:31', 'A simple selector is either a type selector or universal selector followed immediately by zero or more attribute selectors, ID selectors, or pseudo-classes, in any order. The simple selector matches if all of its components match.\n[br][br]\nNote: the terminology used here in CSS 2.1 is different from what is used in CSS3. For example, a "simple selector" refers to a smaller part of a selector in CSS3 than in CSS 2.1. See the CSS3 Selectors module [CSS3SEL].\n[br][br]\nA selector is a chain of one or more simple selectors separated by combinators. Combinators are: white space, ">", and "+". White space may appear between a combinator and the simple selectors around it.\n[br][br]\nThe elements of the document tree that match a selector are called subjects of the selector. A selector consisting of a single simple selector matches any element satisfying its requirements. Prepending a simple selector and combinator to a chain imposes additional matching constraints, so the subjects of a selector are always a subset of the elements matching the last simple selector.\n[br][br]\nOne pseudo-element may be appended to the last simple selector in a chain, in which case the style information applies to a subpart of each subject.'),
(2, 2, 'Grundlagen II - Prioritäten', '1', '2016-11-09 09:27:31', '[h2]Basic CSS Rules[/h2]\r\n\r\nWhen creating a CSS document, the following rules apply:\r\n[list]\r\n*- When more than 1 overlapping styles are applied to the same element, only the last style is visible.\r\n*- The style applied in the parent node at the DOM tree is inherited. For more information, see W3C inheritance documentation.\r\n*- The style that has the highest CSS specificity is applied. The specificity of different elements is defined as follows:\r\n[list]\r\n*- ID attribute = 100\r\n*- Class attribute = 10\r\n*- Element = 1\r\n[/list]\r\n*- When the !important attribute is used, it has the highest priority.\r\n[/list]\r\n[h2]Using CSS with HTML[/h2]\r\n\r\nThere are various ways to connect CSS with HTML. Creating a separate CSS file and managing it separately is convenient when it comes to applying changes in the future. The file is connected to the HTML file using a &lt;link&gt; tag in the <head> element.\r\n[br][br]\r\nHowever, the priority order of the elements is as follows:\r\n[list]\r\n*- style attribute in a HTML element\r\n*- &lt;style&gt; tag in the &lt;head&gt; element\r\n*- @import attribute in the CSS area\r\n*- &lt;link&gt; tag in the &lt;head&gt; element\r\n[/list]\r\n[br]\r\nThe style attribute in the HTML element has the highest priority after the !important attribute.\r\n[br][br]\r\nUsing the order above, if all other color styles are applied to &lt;p&gt; elements, the style attribute is used to apply the red color that has been directly defined in the HTML. This rule differs from the CSS specificity rules.\r\n[br][br]\r\nGenerally, when the @import attribute is used, connect to the top of CSS file that has been linked externally, as illustrated in the figure below. If the attribute is applied in the middle of the CSS file, it is difficult to know the point where CSS has been applied, and to find the file connected to the source in the future. Therefore, group the CSS file at the top.');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `et_category`
--

CREATE TABLE IF NOT EXISTS `et_category` (
`id` int(10) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_descript` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `et_category`
--

INSERT INTO `et_category` (`id`, `cat_name`, `cat_descript`) VALUES
(1, 'HTML 5', 'Artikel zum Thema HTML 5'),
(2, 'CSS 3', 'Artikel zum Thema CSS 3'),
(3, 'JavaScript', 'Artikel zum Thema JavaScript'),
(4, 'jQuery', 'Artikel zum Thema jQuery');

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
) ENGINE=InnoDB AUTO_INCREMENT=168 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `et_chat`
--

INSERT INTO `et_chat` (`id`, `username`, `msgtime`, `channel`, `whisperto`, `message`) VALUES
(56, 'Tyraon', '1478170574', 'Kaffeküche', 'NULL', '()____)____________))))~~~'),
(57, 'Tyraon', '1478170655', 'Kaffeküche', 'NULL', 'Pause:: ()____)____________))))~~~'),
(58, 'Tyraon', '1478170686', 'Kaffeküche', 'NULL', '()____)____________))))~~~'),
(59, 'Tyraon', '1478170844', 'Kaffeküche', 'NULL', 'juhuu'),
(60, 'Tyraon', '1478172954', 'Lobby', 'NULL', 'hallo'),
(61, 'Tyraon', '1478173107', 'Lobby', 'NULL', 'Hallo'),
(62, 'Tyraon', '1478173107', 'Lobby', 'NULL', 'Hallo'),
(63, 'WÃ¤chter', '1478173107', 'WHISPER', 'Tyraon', '<b>Bitte achte auf deine Eingabe. Eine weitere Wiederholung wird als Spam eingestuft und wirst aus dem Chat entfernt und von der Plattform abgemeldet.</b>'),
(64, 'Tyraon', '1478173118', 'Lobby', 'NULL', 'Huhu'),
(65, 'Tyraon', '1478173118', 'Lobby', 'NULL', 'Huhu'),
(66, 'WÃ¤chter', '1478173118', 'WHISPER', 'Tyraon', '<b>Bitte achte auf deine Eingabe. Eine weitere Wiederholung wird als Spam eingestuft und wirst aus dem Chat entfernt und von der Plattform abgemeldet.</b>'),
(67, 'tom', '1478173296', 'Lobby', 'NULL', 'tachauch'),
(68, 'tom', '1478174405', 'Lobby', 'NULL', 'da iss er'),
(69, 'tom', '1478174433', 'Lobby', 'NULL', 'seh nix'),
(70, 'tom', '1478174454', 'Lobby', 'NULL', 'wieso is hier keiner mehr online?'),
(71, 'Tyraon', '1478174457', 'Lobby', 'NULL', 'moin'),
(72, 'Tyraon', '1478174479', 'Lobby', 'NULL', 'ist aber ich habe gerade gesehen, dass aus irgendwelchen grÃ¼nden die liste ein wenig spackt'),
(73, 'tom', '1478174496', 'Lobby', 'NULL', 'auf dem online button kommt immer nur ein name'),
(74, 'Tyraon', '1478174561', 'Lobby', 'NULL', 'ja ... es wird kein timestamp gesetzt ... was eigentlcih schon funktionierte und auch einwandfrei lief'),
(75, 'Tyraon', '1478174626', 'Lobby', 'NULL', 'so ... nun funktioniert es ... '),
(76, 'tom', '1478174638', 'Lobby', 'NULL', 'joa'),
(77, 'tom', '1478174689', 'Lobby', 'NULL', 'jetzt markier ich deinen namen im chat und wechsel mit dir in private chat :-)'),
(78, 'Tyraon', '1478174694', 'Lobby', 'NULL', 'klar gibt es hier und da immer mal ein paar kleine macken aber darum testet man es ja und solche fehlerteufelchen treten am anfang immer mal auf'),
(79, 'Tyraon', '1478174713', 'Lobby', 'NULL', 'das macht mir angst'),
(80, 'Tyraon', '1478174744', 'Lobby', 'NULL', 'privatchat? ... '),
(81, 'tom', '1478174771', 'Lobby', 'NULL', 'ja - nicht lobby fÃ¼r alle sondern nur wir...'),
(82, 'Tyraon', '1478174803', 'Lobby', 'NULL', 'das kannst du Ã¼ber /w {Nutzername} deine Nachricht'),
(83, 'tom', '1478174827', 'WHISPER', 'Tyaron', 'echt?'),
(84, 'Tyraon', '1478174834', 'WHISPER', 'tom', 'Dann'),
(85, 'tom', '1478174866', 'Lobby', 'NULL', 'fehlt wohl der Hilfe Knopf'),
(86, 'Tyraon', '1478174939', 'Lobby', 'NULL', 'wegen der bedienung meinst du?'),
(87, 'tom', '1478174972', 'Lobby', 'NULL', 'ja - hÃ¤tte ich sonst nicht gewusst'),
(88, 'Tyraon', '1478175003', 'Lobby', 'NULL', 'aso'),
(89, 'tom', '1478175053', 'Lobby', 'NULL', 'und wenn ich dich einmal angeflÃ¼stert hab kÃ¶nnte dieses /w name schon im eingabefeld stehen'),
(90, 'tom', '1478175070', 'Lobby', 'NULL', '?'),
(91, 'tom', '1478175077', 'Lobby', 'NULL', '/?'),
(92, 'Tyraon', '1478175110', 'WHISPER', 'Tyraon', 'aon test test'),
(93, 'Tyraon', '1478175121', 'Lobby', 'NULL', 'das kÃ¶nnte man machen'),
(94, 'Tyraon', '1478175153', 'WHISPER', 'Tyraon', ' test test'),
(95, 'tom', '1478175238', 'Lobby', 'NULL', 'Prohylaxe meint keine Berufsfische'),
(96, 'Tyraon', '1478175249', 'Lobby', 'NULL', 'och nÃ¶ ... ich habe da ja noch etwas vergessen ... der auto scroll'),
(97, 'tom', '1478175328', 'Lobby', 'NULL', 'Reitet der Cowboy zum FrisÃ¶r - kommt wieder raus, und........Ponny weg'),
(98, 'Tyraon', '1478175355', 'Lobby', 'NULL', 'haha'),
(99, 'Tyraon', '1478175415', 'Lobby', 'NULL', 'der war aber flach ... Sagt das eine Feuerelementar zum anderen: Ich habe gehÃ¶rt, dass Regen schlecht fÃ¼r uns sein soll. Darauf das andere: Davon kannst du aus gehen.'),
(100, 'tom', '1478175469', 'Lobby', 'NULL', 'Ein Mann und eine Frau sitzen zusammen im Restaurant. - PlÃ¶tzlich bekleckert sich die Frau und sagt: "Jetzt sehe ich ja aus wie ein Schwein!" -  Darauf der Mann: "Und bekleckert bist du auch noch!!!" '),
(101, 'Tyraon', '1478175525', 'Lobby', 'NULL', 'der ist aber richtig al'),
(102, 'Tyraon', '1478175529', 'Lobby', 'NULL', 'alt'),
(103, 'tom', '1478175576', 'Lobby', 'NULL', 'Was macht ein Mann ohne Beine? - SackhÃ¼pfen  Mehr lustige Witze: http://www.aberwitzig.com/witze-11.htm#ixzz4OwoP9PRF'),
(104, 'tom', '1478175673', 'Lobby', 'NULL', 'BÃ¼ck Dich Fee! Wunsch ist Wunsch!'),
(105, 'tom', '1478175700', 'Lobby', 'NULL', 'SchÃ¶nheitschirurg - oder auch Ã„nderungsfleischerei'),
(106, 'Tyraon', '1478175728', 'Lobby', 'NULL', 'machrt keinen unterschied'),
(107, 'Tyraon', '1478175814', 'Lobby', 'NULL', 'ja so ist das ...'),
(108, 'Tyraon', '1478175821', 'Lobby', 'NULL', 'Kurz mal abwesend'),
(109, 'Tyraon', '1478176129', 'Lobby', 'NULL', 'und zurÃ¼ck ist er'),
(110, 'tom', '1478176328', 'Lobby', 'NULL', 'SchÃ¶nheitschirurg = Ã„nderungsfleischerei'),
(111, 'Tyraon', '1478176358', 'Lobby', 'NULL', 'sag ich ja ... ist das gleiche'),
(112, 'Tyraon', '1478176459', 'Lobby', 'NULL', 'auf jeden fall sollte er jetzt auch automatisch scrollen'),
(113, 'Tyraon', '1478176585', 'Lobby', 'NULL', 'und das mit dem flÃ¼stern geht dann auch leichter'),
(114, 'Tyraon', '1478176694', 'Lobby', 'NULL', 'so mal schauen'),
(115, 'Tyraon', '1478176740', 'Lobby', 'NULL', 'jubb ... jetzt geht es ganz einfach'),
(116, 'Tyraon', '1478176767', 'Lobby', 'NULL', 'einfach nur auf den Namen klicken und schon flÃ¼sterst du ihn direkt an'),
(117, 'Tyraon', '1478176785', 'Lobby', 'NULL', 'wenn das bei dir noch nicht so ganz will dann einmal F5'),
(118, 'Tyraon', '1478176887', 'Lobby', 'NULL', 'er ist ja gar nicht mehr da'),
(119, 'Tyraon', '1478176890', 'Lobby', 'NULL', 'hm ...'),
(120, 'Tyraon', '1478176897', 'Lobby', 'NULL', 'dann halt nicht'),
(121, 'Tyraon', '1478176904', 'WHISPER', 'Tyraon', 'test'),
(122, 'Tyraon', '1478176908', 'WHISPER', 'Tyraon', '??'),
(123, 'Tyraon', '1478176917', 'WHISPER', 'Tyraon', 'flÃ¼stern geht'),
(124, 'Tyraon', '1478176927', 'WHISPER', 'Tyraon', 'ist ja ein ding'),
(125, 'Tyraon', '1478176999', 'WHISPER', 'Tyraon', 'so frisst er dann auch nicht mehr so viele nachrichten'),
(126, 'Tyraon', '1478177038', 'Lobby', 'NULL', 'was ist denn nu kaputt'),
(127, 'Tyraon', '1478177057', 'Lobby', 'NULL', 'kann doch schon wieder nicht sein'),
(128, 'Tyraon', '1478177157', 'Lobby', 'NULL', 'huhu'),
(129, 'Tyraon', '1478177165', 'WHISPER', 'Tyraon', 'geht doch'),
(130, 'Tyraon', '1478177193', 'Lobby', 'NULL', '??'),
(131, 'Tyraon', '1478177199', 'WHISPER', 'Tyraon', 'ok'),
(132, 'Tyraon', '1478177206', 'WHISPER', 'Tyraon', 'jetzt geht es'),
(133, 'Tyraon', '1478177218', 'Lobby', 'NULL', '??'),
(134, 'Tyraon', '1478177225', 'WHISPER', 'Tyraon', 'was ist das denn'),
(135, 'Tyraon', '1478177232', 'WHISPER', 'Tyraon', 'verstehe ich nicht'),
(136, 'Tyraon', '1478177245', 'WHISPER', 'Tyraon', 'dÃ¼rfte doch eigentlcih nicht sein'),
(137, 'Tyraon', '1478177252', 'WHISPER', 'Tyraon', 'shit schreibfehler'),
(138, 'Tyraon', '1478177257', 'WHISPER', 'Tyraon', 'so ...'),
(139, 'Tyraon', '1478177265', 'WHISPER', 'Tyraon', 'mal sehen ob er nun scrollt'),
(140, 'Tyraon', '1478177272', 'WHISPER', 'Tyraon', 'abe wahrscheinlich nicht'),
(141, 'Tyraon', '1478177319', 'Lobby', 'NULL', 'jo...'),
(142, 'Tyraon', '1478177327', 'WHISPER', 'Tyraon', 'fehler gefunden'),
(143, 'Tyraon', '1478177336', 'WHISPER', 'Tyraon', 'selector war falsch'),
(144, 'Tyraon', '1478177344', 'WHISPER', 'Tyraon', 'bzw. ein tippfehler drin'),
(145, 'Tyraon', '1478177351', 'WHISPER', 'Tyraon', 'nun sollte es aber gehen'),
(146, 'Tyraon', '1478177355', 'WHISPER', 'Tyraon', '??'),
(147, 'Tyraon', '1478177358', 'WHISPER', 'Tyraon', '##'),
(148, 'Tyraon', '1478177360', 'WHISPER', 'Tyraon', '??'),
(149, 'Tyraon', '1478177362', 'WHISPER', 'Tyraon', '##'),
(150, 'Tyraon', '1478177365', 'WHISPER', 'Tyraon', '??'),
(151, 'Tyraon', '1478177367', 'WHISPER', 'Tyraon', '##'),
(152, 'Tyraon', '1478177369', 'WHISPER', 'Tyraon', '??'),
(153, 'Tyraon', '1478177410', 'Lobby', 'NULL', 'jubb er scroll jetzt endlich'),
(154, 'Tyraon', '1478177688', '316', 'NULL', 'cool'),
(155, 'Tyraon', '1478177703', '316', 'NULL', 'damit kann man neue channel aufmachen'),
(160, 'WÃ¤chter', '000000', 'Lobby', 'NULL', '<b>Der Nutzer Tyraon wechselt den Channel!</b>'),
(161, 'WÃ¤chter', '000000', '316', 'NULL', '<b>Der Nutzer Tyraon betritt den Channel!</b>'),
(162, 'WÃ¤chter', '000000', '316', 'NULL', '<b>Der Nutzer Tyraon wechselt den Channel!</b>'),
(163, 'WÃ¤chter', '000000', 'Lobby', 'NULL', '<b>Der Nutzer Tyraon betritt den Channel!</b>'),
(164, 'WÃ¤chter', '000000', 'Lobby', 'NULL', '<b>Der Nutzer Tyraon wechselt den Channel!</b>'),
(165, 'WÃ¤chter', '000000', 'IT-Kern 15', 'NULL', '<b>Der Nutzer Tyraon betritt den Channel!</b>'),
(166, 'Tyraon', '1478628831', 'Lobby', 'NULL', 'hallo'),
(167, 'Gast', '1478628934', 'Lobby', 'NULL', 'huhu');

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

--
-- Daten für Tabelle `et_course`
--

INSERT INTO `et_course` (`id`, `teacher`, `course_name`, `descript`) VALUES
(1, 4, 'IT-Kern 15', '-');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `et_log`
--

CREATE TABLE IF NOT EXISTS `et_log` (
`id` int(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `et_log`
--

INSERT INTO `et_log` (`id`, `time`, `content`) VALUES
(3, '2016-11-13 13:35:14', 'User Tyraon login :: success');

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

--
-- Daten für Tabelle `et_mail`
--

INSERT INTO `et_mail` (`id`, `from_user`, `to_user`, `rcp`, `date`, `message`, `read`, `outbox`, `inbox`) VALUES
(1, 'Tyraon', 'Tyraon', 'Test', '2016-11-01 13:25:37', 'Testmail', 1, 0, 1),
(2, 'Tyraon', 'Gast', 'Test', '2016-11-02 07:02:18', 'Testmail an Gast', 0, 0, 1),
(3, 'Tyraon', 'Gast', 'Testnachricht', '0000-00-00 00:00:00', 'Noch eine Testnachricht.', 0, 0, 1),
(4, 'Tyraon', 'gast', 'Testes', '2016-11-02 10:28:14', 'dfjdÃ¶aÃ¶sdaÃ¤Ã¶d,fad', 0, 0, 1),
(5, 'Tyraon', 'Tyraon', 'RE: Test', '2016-11-02 12:46:35', 'sdhfkjfjksksfkdsnfksndkjsfndksnfkdsnjfdks\nsdflsf+sd\nfds\nfpds\nfpd\ns\nfp\nds\npf\n\n\n-------------\nTyraon hat geschrieben:\n\nTestmail', 1, 1, 0),
(6, 'Tyraon', 'Tyraon', 'FW: RE: Test', '2016-11-02 12:47:22', 'handjbgasdnklafnkaÃ¶ds\n\n\nsdhfkjfjksksfkdsnfksndkjsfndksnfkdsnjfdks\nsdflsf+sd\nfds\nfpds\nfpd\ns\nfp\nds\npf\n\n\n-------------\nTyraon hat geschrieben:\n\nTestmail', 1, 1, 0),
(7, 'Schulung @ E.T.', 'Uninow', 'Willkommen', '2016-11-03 10:45:27', 'Hallo Uninow,\n\nwillkommen auf der Schulungsplattform ein E.T. (eTraining).\n\nDiese stellt dir schon jetzt einige Funktionen zur VerfÃ¼gung und wÃ¼nschen viel SpaÃŸ beim Testen und Nutzen.\n\nMit freundlichen GrÃ¼ÃŸen\n\nSchulung @ E.T.', 0, 1, 1),
(8, 'tom', 'Tyraon', 'moin', '2016-11-03 11:42:42', 'meine nachricht', 1, 1, 1),
(9, 'Tyraon', 'tom', 'RE: moin', '2016-11-03 12:00:29', 'und meine antwort darauf\n\n-------------\ntom hat geschrieben:\n\nmeine nachricht', 0, 1, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `et_online`
--

CREATE TABLE IF NOT EXISTS `et_online` (
  `username` varchar(255) NOT NULL,
  `logtime` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `et_online`
--

INSERT INTO `et_online` (`username`, `logtime`) VALUES
('Tyraon', '1478677867');

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

--
-- Daten für Tabelle `et_presence`
--

INSERT INTO `et_presence` (`uid`, `year`, `month`, `day`) VALUES
(1, '2016', '11', '04'),
(2, '2016', '11', '08'),
(1, '2016', '11', '08'),
(1, '2016', '11', '09'),
(1, '2016', '11', '14');

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
-- Daten für Tabelle `et_user`
--

INSERT INTO `et_user` (`id`, `username`, `userpass`, `email`, `lvl`, `last_login`, `first_name`, `last_name`, `course`) VALUES
(1, 'Tyraon', '18d6c45fd40bdbf19e365c2ba3db6c2a00056f43', 's.kaestel@ovnetwork.de', 5, '2016-11-09 07:49:31', 'Sven', 'Kästel', 1),
(2, 'Gast', 'ba43b19c841aae47dfe0e582351cc30cbb6a622a', 'gast@gast.com', 0, '2016-11-13 14:46:45', 'Gast', 'User', NULL),
(3, 'Administrator', '45c423046bb8f92b64fc07471a9adfde61fa3c99', 'admin@mail.com', 4, '2016-11-02 09:50:20', 'Admin', 'istrator', NULL),
(4, 'Uninow', '6fdb820324c841175861bf109377929cb00a6368', 'uninow@sundat.de', 4, '2016-11-04 09:03:14', 'Vorname', 'Nachname', 1),
(5, 'Schulung @ E.T.', 'db5694416128afa99ce82738bdb184a05ded5509', 'admin@localhost', 5, '2016-11-03 10:42:29', '-', '-', NULL),
(6, 'tom', '019ea7a409b48fb9463abfa0f0e3b1cf9f2e6c3b', '-', 0, '2016-11-04 09:17:10', 'Max', '-', 1),
(7, 'Testuser', '39849e42f020097247bd3fb3a67f4f957a7957a9', 'xxx@yy.zz', 0, '2016-11-14 10:42:10', 'Test', 'User', 0);

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
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT für Tabelle `et_article`
--
ALTER TABLE `et_article`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT für Tabelle `et_category`
--
ALTER TABLE `et_category`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT für Tabelle `et_chat`
--
ALTER TABLE `et_chat`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=168;
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
