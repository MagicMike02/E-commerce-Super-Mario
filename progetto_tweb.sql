-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 14, 2023 alle 17:19
-- Versione del server: 10.4.27-MariaDB
-- Versione PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `progetto_tweb`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `carrello`
--

CREATE TABLE `carrello` (
  `Cliente` varchar(150) NOT NULL,
  `Titolo` varchar(30) NOT NULL,
  `Quantita` int(255) NOT NULL DEFAULT 1,
  `Somma` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `carrello`
--

INSERT INTO `carrello` (`Cliente`, `Titolo`, `Quantita`, `Somma`) VALUES
('Micheleliquindoli1@gmail.com', 'Donkey Kong', 1, 250),
('Micheleliquindoli@gmail.com', 'Poster Super Mario Galaxy', 1, 50);

-- --------------------------------------------------------

--
-- Struttura della tabella `cliente`
--

CREATE TABLE `cliente` (
  `Nome` varchar(30) DEFAULT NULL,
  `Cognome` varchar(30) DEFAULT NULL,
  `Email` varchar(150) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `cliente`
--

INSERT INTO `cliente` (`Nome`, `Cognome`, `Email`, `Password`) VALUES
('Michele', 'Liquindoli', 'Micheleliquindoli1@gmail.com', 'ae0560f3052ac617eef54336c5c420ca'),
('Michele', 'Liquindoli', 'Micheleliquindoli22@gmail.com', 'ae0560f3052ac617eef54336c5c420ca'),
('Michele', 'Liquindoli', 'Micheleliquindoli3@gmail.com', 'ae0560f3052ac617eef54336c5c420ca'),
('Michele', 'Liquindoli', 'Micheleliquindoli77@gmail.com', 'ae0560f3052ac617eef54336c5c420ca'),
('Michele', 'Liquindoli', 'Micheleliquindoli99@gmail.com', 'ae0560f3052ac617eef54336c5c420ca'),
('Michele', 'Liquindoli', 'Micheleliquindoli9@gmail.com', 'ae0560f3052ac617eef54336c5c420ca'),
('Michele', 'Liquindoli', 'Micheleliquindoli@gmail.com', 'ae0560f3052ac617eef54336c5c420ca');

-- --------------------------------------------------------

--
-- Struttura della tabella `dipendente`
--

CREATE TABLE `dipendente` (
  `Nome` varchar(255) NOT NULL,
  `Cognome` varchar(255) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `dipendente`
--

INSERT INTO `dipendente` (`Nome`, `Cognome`, `Email`, `Password`) VALUES
('Michele', 'Liquindoli', 'Micheleliquindoli1@gmail.com', 'ae0560f3052ac617eef54336c5c420ca'),
('Michele', 'Liquindoli', 'Micheleliquindoli3@gmail.com', 'ae0560f3052ac617eef54336c5c420ca'),
('Michele', 'Liquindoli', 'Micheleliquindoli99@gmail.com', 'ae0560f3052ac617eef54336c5c420ca'),
('Michele', 'Liquindoli', 'Micheleliquindoli@gmail.com', 'ae0560f3052ac617eef54336c5c420ca');

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotti`
--

CREATE TABLE `prodotti` (
  `Categoria` varchar(50) DEFAULT NULL,
  `Titolo` varchar(30) NOT NULL,
  `Url_foto` varchar(255) NOT NULL,
  `Descrizione` varchar(144) NOT NULL DEFAULT 'lorem',
  `Prezzo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `prodotti`
--

INSERT INTO `prodotti` (`Categoria`, `Titolo`, `Url_foto`, `Descrizione`, `Prezzo`) VALUES
('Bowser', 'Bowser', '../assets/homepage/prodotti/bowser.jpeg', 'Lorem', 50),
('Daisy', 'Daisy', '../assets/homepage/prodotti/daisy.jpeg', 'Lorem', 50),
('Donkey Kong', 'Donkey Kong', '../assets/homepage/prodotti/donkey-kong.jpeg', 'Lorem', 250),
('Goomba', 'Goomba', '../assets/homepage/prodotti/goomba.jpeg', 'Lorem', 50),
('Luigi', 'Luigi', '../assets/homepage/prodotti/luigi.jpeg', 'Lorem', 50),
('Mario', 'Mario', '../assets/homepage/prodotti/mario.jpeg', 'Lorem', 20),
('Peach', 'Peach', '../assets/homepage/prodotti/peach.jpeg', 'Lorem', 100),
('Poster', 'Poster Super Mario', '../assets/homepage/prodotti/poster-supermario.png', 'lorem                                                                                                                                      ', 150),
('Poster', 'Poster Super Mario Galaxy', '../assets/homepage/prodotti/poster-supermariogalaxy.jpg', 'Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem ', 50),
('Poster', 'Poster Super Mario Galaxy 2', '../assets/homepage/prodotti/poster-supermariogalaxy2.jpg', 'LoremLore mLoremL oremLoremLor em LoremLore mLorem LoremLoremLorem LoremL oremLoremLorem LoremLor em LoremLoremLor emLoremLoremLor mLoremLorem', 50),
('Toad', 'Toad', '../assets/homepage/prodotti/toad.jpeg', 'Lorem', 50),
('Toadette', 'Toadette', '../assets/homepage/prodotti/toadette.jpeg', 'Lorem', 50),
('Wario', 'Wario', '../assets/homepage/prodotti/wario.jpeg', 'Lorem', 50),
('Yoshi', 'Yoshi', '../assets/homepage/prodotti/yoshi.jpeg', 'Lorem', 50);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `carrello`
--
ALTER TABLE `carrello`
  ADD PRIMARY KEY (`Cliente`,`Titolo`),
  ADD KEY `Titolo` (`Titolo`);

--
-- Indici per le tabelle `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`Email`);

--
-- Indici per le tabelle `dipendente`
--
ALTER TABLE `dipendente`
  ADD PRIMARY KEY (`Email`);

--
-- Indici per le tabelle `prodotti`
--
ALTER TABLE `prodotti`
  ADD PRIMARY KEY (`Titolo`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `carrello`
--
ALTER TABLE `carrello`
  ADD CONSTRAINT `carrello_ibfk_1` FOREIGN KEY (`Cliente`) REFERENCES `cliente` (`Email`),
  ADD CONSTRAINT `carrello_ibfk_2` FOREIGN KEY (`Titolo`) REFERENCES `prodotti` (`Titolo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
