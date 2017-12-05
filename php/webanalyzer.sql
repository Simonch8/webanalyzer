-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 05. Dez 2017 um 14:42
-- Server-Version: 10.1.22-MariaDB
-- PHP-Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `webanalyzer`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `calls`
--

CREATE TABLE `calls` (
  `id_call` int(11) NOT NULL,
  `fk_url` int(11) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `calls`
--

INSERT INTO `calls` (`id_call`, `fk_url`, `timestamp`) VALUES
(1, 1, '2017-11-04 00:00:00'),
(2, 1, '2017-11-07 00:00:00'),
(3, 1, '2017-11-14 13:43:57'),
(4, 1, '2017-11-14 13:44:01'),
(5, 1, '2017-11-14 13:58:59'),
(6, 4, '2017-11-14 14:11:32'),
(7, 4, '2017-11-14 14:11:35'),
(8, 4, '2017-11-14 14:12:02'),
(9, 5, '2017-11-14 14:12:17'),
(10, 2, '2017-11-14 14:50:12'),
(11, 2, '2017-11-14 14:50:13'),
(12, 6, '2017-12-03 15:22:05'),
(13, 6, '2017-12-03 15:22:05'),
(14, 7, '2017-12-03 15:22:12'),
(15, 7, '2017-12-03 15:22:12'),
(16, 7, '2017-12-03 15:22:18'),
(17, 7, '2017-12-03 15:22:18'),
(18, 8, '2017-12-03 15:22:29'),
(19, 8, '2017-12-03 15:22:29'),
(20, 8, '2017-12-03 15:22:33'),
(21, 8, '2017-12-03 15:22:33'),
(22, 8, '2017-12-03 15:22:37'),
(23, 8, '2017-12-03 15:22:37'),
(24, 9, '2017-12-03 15:22:42'),
(25, 9, '2017-12-03 15:22:42'),
(26, 9, '2017-12-03 15:22:47'),
(27, 10, '2017-12-03 15:22:47'),
(28, 10, '2017-12-03 15:22:54'),
(29, 10, '2017-12-03 15:22:54'),
(30, 10, '2017-12-03 15:22:59'),
(31, 10, '2017-12-03 15:22:59'),
(32, 10, '2017-12-03 15:23:03'),
(33, 11, '2017-12-03 15:23:03');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `urls`
--

CREATE TABLE `urls` (
  `id_url` int(11) NOT NULL,
  `url` varchar(2010) NOT NULL,
  `isBlacklist` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `urls`
--

INSERT INTO `urls` (`id_url`, `url`, `isBlacklist`) VALUES
(1, 'google.ch', 0),
(2, 'digitec.ch', 0),
(4, 'jaflisdf.ch', 0),
(5, 'oiioie.ch', 0),
(6, 'bict.ch', 0),
(7, 'groenland.de', 0),
(8, 'bank.bn', 0),
(9, 'bern-gov.ch', 0),
(10, 'webanalyzer.org', 0),
(11, 'plugins.co.uk', 0);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `calls`
--
ALTER TABLE `calls`
  ADD PRIMARY KEY (`id_call`);

--
-- Indizes für die Tabelle `urls`
--
ALTER TABLE `urls`
  ADD PRIMARY KEY (`id_url`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `calls`
--
ALTER TABLE `calls`
  MODIFY `id_call` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT für Tabelle `urls`
--
ALTER TABLE `urls`
  MODIFY `id_url` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
