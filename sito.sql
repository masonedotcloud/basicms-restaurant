-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Giu 02, 2022 alle 15:44
-- Versione del server: 10.4.21-MariaDB
-- Versione PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sito`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `access_table`
--

CREATE TABLE `access_table` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `access_table`
--

INSERT INTO `access_table` (`id`, `ip`, `date`) VALUES
(28, '192.168.1.54', '2022-06-01'),
(31, '::1', '2022-06-01'),
(32, '192.168.1.36', '2022-06-01'),
(33, '192.168.1.36', '2022-06-02'),
(34, '::1', '2022-06-02');

-- --------------------------------------------------------

--
-- Struttura della tabella `admin_table`
--

CREATE TABLE `admin_table` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `admin_type` int(11) NOT NULL DEFAULT 1,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `admin_table`
--

INSERT INTO `admin_table` (`id`, `username`, `password`, `status`, `admin_type`, `create_at`) VALUES
(2, 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', 1, 0, '2022-05-27 21:39:09'),
(55, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1, '2022-05-31 13:13:39');

-- --------------------------------------------------------

--
-- Struttura della tabella `category_table`
--

CREATE TABLE `category_table` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `category_table`
--

INSERT INTO `category_table` (`id`, `name`, `status`, `create_at`) VALUES
(21, 'categoria1', 1, '2022-05-31 13:14:41'),
(22, 'categoria2', 1, '2022-05-31 13:14:48'),
(23, 'categoria3', 1, '2022-05-31 13:14:52'),
(24, 'categoria4', 1, '2022-05-31 13:14:58'),
(25, 'categoria5', 1, '2022-05-31 13:15:03'),
(26, 'categoria6', 1, '2022-05-31 13:15:11');

-- --------------------------------------------------------

--
-- Struttura della tabella `food_table`
--

CREATE TABLE `food_table` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `category` int(11) NOT NULL DEFAULT 0,
  `price` float NOT NULL DEFAULT 0,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `food_table`
--

INSERT INTO `food_table` (`id`, `name`, `status`, `create_at`, `category`, `price`, `description`, `image`) VALUES
(26, 'cibo1', 1, '2022-05-31 13:16:34', 21, 1, 'lorem ipsum dolor sit amet', '1653995794_835-536x354.jpeg'),
(27, 'cibo2', 1, '2022-05-31 13:24:05', 21, 1, 'lorem ipsum dolor sit amet', '1653996245_835-536x354.jpeg'),
(28, 'cibo3', 1, '2022-05-31 13:25:20', 21, 1, 'lorem ipsum dolor sit amet', '1653996320_835-536x354.jpeg'),
(29, 'cibo4', 1, '2022-05-31 13:25:54', 22, 1, 'lorem ipsum dolor sit amet', '1653996354_835-536x354.jpeg'),
(30, 'cibo5', 1, '2022-05-31 13:25:58', 22, 1, 'lorem ipsum dolor sit amet', '1653996358_835-536x354.jpeg'),
(31, 'cibo6', 1, '2022-05-31 13:26:02', 22, 1, 'lorem ipsum dolor sit amet', '1653996362_835-536x354.jpeg'),
(32, 'cibo7', 1, '2022-05-31 13:26:07', 23, 1, 'lorem ipsum dolor sit amet', '1653996367_835-536x354.jpeg'),
(33, 'cibo8', 1, '2022-05-31 13:26:10', 23, 1, 'lorem ipsum dolor sit amet', '1653996370_835-536x354.jpeg'),
(34, 'cibo9', 1, '2022-05-31 13:26:13', 23, 1, 'lorem ipsum dolor sit amet', '1653996373_835-536x354.jpeg'),
(35, 'cibo10', 1, '2022-05-31 13:26:19', 24, 1, 'lorem ipsum dolor sit amet', '1653996379_835-536x354.jpeg'),
(36, 'cibo11', 1, '2022-05-31 13:26:21', 24, 1, 'lorem ipsum dolor sit amet', '1653996381_835-536x354.jpeg'),
(37, 'cibo12', 1, '2022-05-31 13:26:24', 24, 1, 'lorem ipsum dolor sit amet', '1653996384_835-536x354.jpeg'),
(38, 'cibo13', 1, '2022-05-31 13:26:32', 25, 1, 'lorem ipsum dolor sit amet', '1653996392_835-536x354.jpeg'),
(39, 'cibo14', 1, '2022-05-31 13:26:38', 25, 1, 'lorem ipsum dolor sit amet', '1653996398_835-536x354.jpeg'),
(40, 'cibo15', 1, '2022-05-31 13:26:44', 25, 1, 'lorem ipsum dolor sit amet', '1653996404_835-536x354.jpeg'),
(41, 'cibo16', 1, '2022-05-31 13:26:48', 26, 1, 'lorem ipsum dolor sit amet', '1653996408_835-536x354.jpeg'),
(42, 'cibo17', 1, '2022-05-31 13:26:51', 26, 1, 'lorem ipsum dolor sit amet', '1653996411_835-536x354.jpeg'),
(43, 'cibo18', 1, '2022-05-31 13:26:53', 26, 1, 'lorem ipsum dolor sit amet', '1653996413_835-536x354.jpeg');

-- --------------------------------------------------------

--
-- Struttura della tabella `newsletter_table`
--

CREATE TABLE `newsletter_table` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `newsletter_table`
--

INSERT INTO `newsletter_table` (`id`, `email`) VALUES
(5, 'email@email.com'),
(28, 'test@test.com'),
(35, 'a@a.a');

-- --------------------------------------------------------

--
-- Struttura della tabella `setting_table`
--

CREATE TABLE `setting_table` (
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `setting_table`
--

INSERT INTO `setting_table` (`name`, `email`, `description`, `image`) VALUES
('Nome bar', 'email@email.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vel augue nec enim aliquet feugiat id ullamcorper ante. Suspendisse potenti. Vestibulum scelerisque tempus bibendum. Aenean ante nisi, blandit in erat egestas, tempor interdum neque. Curabitur ut orci ut ante dignissim cursus eget ac metus. Aliquam diam nunc, lacinia pharetra maximus eu, lacinia non ipsum. Aenean et magna nisl.', 'icon.svg');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `access_table`
--
ALTER TABLE `access_table`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `category_table`
--
ALTER TABLE `category_table`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `food_table`
--
ALTER TABLE `food_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`) USING BTREE;

--
-- Indici per le tabelle `newsletter_table`
--
ALTER TABLE `newsletter_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `access_table`
--
ALTER TABLE `access_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT per la tabella `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT per la tabella `category_table`
--
ALTER TABLE `category_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT per la tabella `food_table`
--
ALTER TABLE `food_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT per la tabella `newsletter_table`
--
ALTER TABLE `newsletter_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `food_table`
--
ALTER TABLE `food_table`
  ADD CONSTRAINT `food_table_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category_table` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
