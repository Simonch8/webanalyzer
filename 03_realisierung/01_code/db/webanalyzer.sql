-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 14. Nov 2017 um 13:16
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
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `calls`
--

INSERT INTO `calls` (`id_call`, `fk_url`, `timestamp`) VALUES
(1, 1, '2017-11-04 00:00:00'),
(2, 1, '2017-11-07 00:00:00');

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
(2, 'digitec.ch', 0);

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
  MODIFY `id_call` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `urls`
--
ALTER TABLE `urls`
  MODIFY `id_url` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
