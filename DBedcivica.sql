-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 27, 2024 alle 09:35
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edcivica`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `autore`
--

CREATE TABLE `autore` (
  `ID_autore` int(11) NOT NULL,
  `nominaivo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `autore`
--

INSERT INTO `autore` (`ID_autore`, `nominaivo`) VALUES
(1, 'Salvatore Brizzi');

-- --------------------------------------------------------

--
-- Struttura della tabella `autorizzato`
--

CREATE TABLE `autorizzato` (
  `ID_autorizzato` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `data_Nascita` date NOT NULL,
  `indirizzo` varchar(50) NOT NULL,
  `residenza` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `autorizzato`
--

INSERT INTO `autorizzato` (`ID_autorizzato`, `nome`, `cognome`, `data_Nascita`, `indirizzo`, `residenza`, `email`, `password`) VALUES
(2, 'Thomas', 'Ratti', '2005-08-24', 'Via x', 'Albino', 'thomasratti@gmail.com', '24082005'),
(3, 'Ernesto', 'Beltrami', '2005-01-15', 'Via x', 'Gazzaniga', 'ernestobeltrami@gmail.com', '12345'),
(4, 'Zakaria', 'El Mansouri', '2005-05-14', 'Via x', 'Cene', 'zakariaelmansouri@gmail.com', '09876');

-- --------------------------------------------------------

--
-- Struttura della tabella `casaeditrice`
--

CREATE TABLE `casaeditrice` (
  `ID_casaeditrice` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `casaeditrice`
--

INSERT INTO `casaeditrice` (`ID_casaeditrice`, `nome`) VALUES
(1, 'Mondadori');

-- --------------------------------------------------------

--
-- Struttura della tabella `chiede1`
--

CREATE TABLE `chiede1` (
  `ID_chiede1` int(11) NOT NULL,
  `id_ospite` int(11) DEFAULT NULL,
  `id_libro_offerto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `chiede2`
--

CREATE TABLE `chiede2` (
  `ID_chiede2` int(11) NOT NULL,
  `id_autorizzato` int(11) DEFAULT NULL,
  `id_libro_offerto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `libro`
--

CREATE TABLE `libro` (
  `ID_libro` int(11) NOT NULL,
  `isbn` varchar(13) NOT NULL,
  `titolo` varchar(59) NOT NULL,
  `anno_acquisto` date NOT NULL,
  `indririzzo` varchar(59) NOT NULL,
  `prezzo_listino` int(11) NOT NULL,
  `cd` tinyint(1) NOT NULL,
  `online_` tinyint(1) NOT NULL,
  `numero_volume` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `libro`
--

INSERT INTO `libro` (`ID_libro`, `isbn`, `titolo`, `anno_acquisto`, `indririzzo`, `prezzo_listino`, `cd`, `online_`, `numero_volume`) VALUES
(1, ' 978882681841', 'GESTIONE PROGETTO, ORGANIZZAZIONE D\'IMPRESA', '2023-08-23', 'via x', 23, 0, 1, 0),
(2, '9788836007745', 'CORSO DI INFORMATICA SQL & PHP PERCORSI MODULARI PER LINGUA', '2023-08-23', 'via x', 30, 0, 1, 0),
(3, ' 978885361567', 'MARTGRAMMAR', '2023-08-23', 'via x', 28, 1, 1, 0),
(4, '9788844121785', 'BIT BY BIT, NEW EDITION ENGLISH FOR INFORMATION AND COMMUNI', '2023-08-23', 'via x', 28, 1, 1, 0),
(5, '9788839538413', 'QUALCOSA CHE SORPRENDE 3.1 DALL\'ETÀ POSTUNITARIA AL PRIMO N', '2023-08-23', 'via x', 27, 0, 1, 3),
(6, '9788839538437', 'QUALCOSA CHE SORPRENDE 3.2 DAL PERIODO TRA LE DUE GUERRE AI', '2023-08-23', 'via x', 27, 1, 1, 3),
(7, '9788808614384', 'MATEMATICA.VERDE 3ED - CONFEZIONE 4A+4B (LDM)', '2023-08-23', 'via x', 40, 0, 1, 2),
(8, '9788839302809', 'PIU\' MOVIMENTO VOLUME UNICO + EBOOK', '2023-08-23', 'via x', 23, 0, 1, 0),
(9, '9788836003457', 'NUOVO SISTEMI E RETI PER L\'ARTICOLAZIONE INFORMATICA DEGLI ', '2023-08-23', 'via x', 28, 0, 1, 3),
(10, '9788869106811', 'SNODI DELLA STORIA 3', '2023-08-23', 'via x', 33, 1, 1, 3),
(11, '9788836003365', 'NUOVO TECNOLOGIE E PROGETTAZIONE DI SISTEMI INFORMATICI E D', '2023-08-23', 'via x', 30, 0, 1, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `libro_offerto`
--

CREATE TABLE `libro_offerto` (
  `ID_libro_offerto` int(11) NOT NULL,
  `stato_es_svolti` tinyint(1) NOT NULL,
  `sottolineato` tinyint(1) NOT NULL,
  `voto` int(11) NOT NULL,
  `presenza_cd` tinyint(1) NOT NULL,
  `online_valido` tinyint(1) NOT NULL,
  `id_libro` int(11) DEFAULT NULL,
  `id_autorizzato` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `materia`
--

CREATE TABLE `materia` (
  `ID_materia` int(11) NOT NULL,
  `materia` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `materia`
--

INSERT INTO `materia` (`ID_materia`, `materia`) VALUES
(1, 'Italiano'),
(2, 'Storia'),
(3, 'Geografia'),
(4, 'Matematica');

-- --------------------------------------------------------

--
-- Struttura della tabella `ospiti`
--

CREATE TABLE `ospiti` (
  `ID_ospite` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `data_Nascita` date NOT NULL,
  `indirizzo` varchar(50) NOT NULL,
  `residenza` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `ospiti`
--

INSERT INTO `ospiti` (`ID_ospite`, `nome`, `cognome`, `data_Nascita`, `indirizzo`, `residenza`, `email`, `password`) VALUES
(1, 'Christian', 'Maffeis', '2005-01-01', 'Via x', 'Gazzaniga', 'christianmaffeis@gmail.com', '54321');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `autore`
--
ALTER TABLE `autore`
  ADD PRIMARY KEY (`ID_autore`);

--
-- Indici per le tabelle `autorizzato`
--
ALTER TABLE `autorizzato`
  ADD PRIMARY KEY (`ID_autorizzato`);

--
-- Indici per le tabelle `casaeditrice`
--
ALTER TABLE `casaeditrice`
  ADD PRIMARY KEY (`ID_casaeditrice`);

--
-- Indici per le tabelle `chiede1`
--
ALTER TABLE `chiede1`
  ADD PRIMARY KEY (`ID_chiede1`),
  ADD KEY `id_ospite` (`id_ospite`),
  ADD KEY `id_libro_offerto` (`id_libro_offerto`);

--
-- Indici per le tabelle `chiede2`
--
ALTER TABLE `chiede2`
  ADD PRIMARY KEY (`ID_chiede2`),
  ADD KEY `id_autorizzato` (`id_autorizzato`),
  ADD KEY `id_libro_offerto` (`id_libro_offerto`);

--
-- Indici per le tabelle `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`ID_libro`);

--
-- Indici per le tabelle `libro_offerto`
--
ALTER TABLE `libro_offerto`
  ADD PRIMARY KEY (`ID_libro_offerto`),
  ADD KEY `id_libro` (`id_libro`),
  ADD KEY `id_autorizzato` (`id_autorizzato`);

--
-- Indici per le tabelle `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`ID_materia`);

--
-- Indici per le tabelle `ospiti`
--
ALTER TABLE `ospiti`
  ADD PRIMARY KEY (`ID_ospite`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `autore`
--
ALTER TABLE `autore`
  MODIFY `ID_autore` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `autorizzato`
--
ALTER TABLE `autorizzato`
  MODIFY `ID_autorizzato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `casaeditrice`
--
ALTER TABLE `casaeditrice`
  MODIFY `ID_casaeditrice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `chiede1`
--
ALTER TABLE `chiede1`
  MODIFY `ID_chiede1` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `chiede2`
--
ALTER TABLE `chiede2`
  MODIFY `ID_chiede2` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `libro`
--
ALTER TABLE `libro`
  MODIFY `ID_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT per la tabella `libro_offerto`
--
ALTER TABLE `libro_offerto`
  MODIFY `ID_libro_offerto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT per la tabella `materia`
--
ALTER TABLE `materia`
  MODIFY `ID_materia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `ospiti`
--
ALTER TABLE `ospiti`
  MODIFY `ID_ospite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `chiede1`
--
ALTER TABLE `chiede1`
  ADD CONSTRAINT `chiede1_ibfk_1` FOREIGN KEY (`id_ospite`) REFERENCES `ospiti` (`ID_ospite`),
  ADD CONSTRAINT `chiede1_ibfk_2` FOREIGN KEY (`id_libro_offerto`) REFERENCES `libro_offerto` (`ID_libro_offerto`);

--
-- Limiti per la tabella `chiede2`
--
ALTER TABLE `chiede2`
  ADD CONSTRAINT `chiede2_ibfk_1` FOREIGN KEY (`id_autorizzato`) REFERENCES `autorizzato` (`ID_autorizzato`),
  ADD CONSTRAINT `chiede2_ibfk_2` FOREIGN KEY (`id_libro_offerto`) REFERENCES `libro_offerto` (`ID_libro_offerto`);

--
-- Limiti per la tabella `libro_offerto`
--
ALTER TABLE `libro_offerto`
  ADD CONSTRAINT `libro_offerto_ibfk_2` FOREIGN KEY (`id_libro`) REFERENCES `libro` (`ID_libro`),
  ADD CONSTRAINT `libro_offerto_ibfk_3` FOREIGN KEY (`id_autorizzato`) REFERENCES `autorizzato` (`ID_autorizzato`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
