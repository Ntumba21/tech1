-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : lun. 27 mars 2023 à 18:20
-- Version du serveur : 10.6.11-MariaDB
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet-tech`
--

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `idpost` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT NULL,
  `titre` varchar(45) DEFAULT NULL,
  `contenu` varchar(500) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `nblike` int(11) DEFAULT NULL,
  `nbdislike` int(11) DEFAULT NULL,
  `for` int(11) DEFAULT 0,
  `link` varchar(255) DEFAULT NULL,
  `interets` varchar(255) DEFAULT NULL,
  `etiquette` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idpost`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`idpost`, `type`, `titre`, `contenu`, `date`, `photo`, `nblike`, `nbdislike`, `for`, `link`, `interets`, `etiquette`) VALUES
(1, 'Ã©vÃ©nements', 'ashleytetedecul', 'ashleygrosseconne', '2023-03-17 00:00:00', '4', NULL, NULL, 0, NULL, NULL, NULL),
(2, 'Ã©vÃ©nements', 'ashleytetedecul', 'ashleygrosseconne', '2023-03-17 00:00:00', '../upload/post/641f8a00d3942-logo ECEBOOK.png', NULL, NULL, 0, NULL, NULL, NULL),
(3, 'Ã©vÃ©nements', 'ashleytetedecul', 'ashleygrosseconne', '2023-03-17 00:00:00', '../upload/post/641f90f87b503-logo ECEBOOK.png', NULL, NULL, 0, NULL, NULL, NULL),
(4, 'Ã©vÃ©nements', 'ashleytetedecul', 'ashleygrosseconne', '2023-03-17 00:00:00', '../upload/post/641f911c4d7dd-logo ECEBOOK.png', NULL, NULL, 0, NULL, NULL, NULL),
(5, 'Ã©vÃ©nements', 'ashleytetedecul', 'ashleygrosseconne', '2023-03-17 00:00:00', '../upload/post/641f917f367c7-logo ECEBOOK.png', NULL, NULL, 0, NULL, NULL, NULL),
(6, 'Ã©vÃ©nements', 'ashleytetedecul', 'ashleygrosseconne', '2023-03-17 00:00:00', '../upload/post/641f9336543f9-logo ECEBOOK.png', NULL, NULL, 0, NULL, NULL, NULL),
(7, 'Ã©vÃ©nements', 'nouveau', 'lgvjhb', '2023-03-24 00:00:00', '../upload/post/641f9985242d5-logo ECEBOOK.png', NULL, NULL, 0, NULL, NULL, '3'),
(8, 'Ã©vÃ©nements', 'c bien si t\'inseres', 'lgvjhb', '2023-03-24 00:00:00', '../upload/post/641f9b4e8919c-logo ECEBOOK.png', NULL, NULL, 0, NULL, NULL, '4'),
(9, 'Ã©vÃ©nements', 'pour', 'oui', '2023-03-15 00:00:00', '../upload/post/641fa724182be-logo ECEBOOK.png', NULL, NULL, 0, NULL, NULL, '4'),
(10, 'actualitÃ©s', 'chiant', 'chiant', '2023-03-24 00:00:00', '../upload/post/641fe6a099538-logo ECEBOOK.png', NULL, NULL, 0, NULL, NULL, '4'),
(11, 'actualitÃ©s', 'ashleyyy', 'oui', '2023-03-24 00:00:00', '../upload/post/641feb7025926-logo ECEBOOK.png', NULL, NULL, 0, NULL, NULL, '3'),
(12, 'actualitÃ©s', 'hicham', 'ash', '2023-03-03 00:00:00', '../upload/post/641ff5f9ed75d-logo ECEBOOK.png', NULL, NULL, 0, NULL, NULL, '4'),
(13, 'actualitÃ©s', 'lina', 'chiant', '2023-03-30 00:00:00', '../upload/post/641ff64f95dc7-logo ECEBOOK.png', NULL, NULL, 0, NULL, NULL, '3'),
(14, 'actualitÃ©s', 'ash', 'chiant', '2023-03-16 00:00:00', NULL, NULL, NULL, 0, NULL, NULL, '4'),
(15, 'gÃ©nÃ©ral', '', '', '2023-03-17 00:00:00', NULL, NULL, NULL, 0, NULL, NULL, '4'),
(16, 'gÃ©nÃ©ral', 'aller', 'aller', '2023-03-09 00:00:00', '../upload/post/6421d56d88822-logo ECEBOOK.png', NULL, NULL, 0, NULL, NULL, '4'),
(17, 'actualitÃ©s', 'hjbdakaed', 'ash', '2023-03-24 00:00:00', '../upload/post/6421d5d57ff0e-logo ECEBOOK.png', NULL, NULL, 0, NULL, NULL, '4');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
