-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : lun. 27 mars 2023 à 18:52
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
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
                                       `idadmin` int(11) NOT NULL,
                                       `nameAdmin` varchar(45) DEFAULT NULL,
                                       `mail` varchar(45) DEFAULT NULL,
                                       `password` varchar(255) DEFAULT NULL,
                                       PRIMARY KEY (`idadmin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `lieu`
--

DROP TABLE IF EXISTS `lieu`;
CREATE TABLE IF NOT EXISTS `lieu` (
                                      `idlieu` int(11) NOT NULL AUTO_INCREMENT,
                                      `nom` varchar(255) DEFAULT NULL,
                                      PRIMARY KEY (`idlieu`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `lieu`
--

INSERT INTO `lieu` (`idlieu`, `nom`) VALUES
                                         (1, 'tamere'),
                                         (2, 'tam');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
                                         `idmessage` int(11) NOT NULL AUTO_INCREMENT,
                                         `contenu` varchar(200) DEFAULT NULL,
                                         `date` datetime DEFAULT NULL,
                                         `iduser` int(11) NOT NULL,
                                         `idamis` int(11) NOT NULL,
                                         PRIMARY KEY (`idmessage`),
                                         KEY `fk_message_user_idx` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`idmessage`, `contenu`, `date`, `iduser`, `idamis`) VALUES
                                                                               (2, 'bon', '2023-03-25 20:06:54', 4, 3),
                                                                               (3, 'bonjoooo\r\n', '2023-03-25 20:07:24', 4, 3),
                                                                               (4, 'ouiiiiiiiii', '2023-03-15 20:09:07', 3, 4),
                                                                               (5, 'bonnnnn\r\n', '2023-03-25 20:11:00', 4, 3),
                                                                               (6, 'ftvvg\r\n', '2023-03-25 20:11:16', 4, 3),
                                                                               (7, 'ouii', '2023-03-25 20:11:54', 4, 3),
                                                                               (8, 'bonjour', '2023-03-25 20:17:58', 4, 3),
                                                                               (9, '', '2023-03-25 20:23:00', 4, 3),
                                                                               (10, '', '2023-03-25 20:24:07', 4, 3),
                                                                               (11, 'helooo', '2023-03-25 20:30:26', 4, 3),
                                                                               (12, 'gvjhvb', '2023-03-25 20:48:45', 4, 3),
                                                                               (13, 'hey\r\n', '2023-03-25 22:45:36', 4, 3),
                                                                               (14, 'coucou comment cava ?\r\n', '2023-03-26 15:36:48', 4, 3),
                                                                               (15, 'Coucou', '2023-03-27 20:26:02', 4, 1),
                                                                               (16, 'Coucou toi aussi', '2023-03-27 20:26:31', 1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
                                              `idnotification` int(11) NOT NULL AUTO_INCREMENT,
                                              `idetiquette` varchar(45) DEFAULT NULL,
                                              `idpost` int(11) NOT NULL,
                                              `iduser` int(11) NOT NULL,
                                              PRIMARY KEY (`idnotification`,`idpost`,`iduser`),
                                              KEY `fk_notification_post1_idx` (`idpost`),
                                              KEY `fk_notification_user1_idx` (`iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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

-- --------------------------------------------------------

--
-- Structure de la table `post_admin`
--

DROP TABLE IF EXISTS `post_admin`;
CREATE TABLE IF NOT EXISTS `post_admin` (
                                            `idpost` int(11) NOT NULL,
                                            `idadmin` int(11) NOT NULL,
                                            PRIMARY KEY (`idpost`,`idadmin`),
                                            KEY `fk_post_has_Admin_Admin1_idx` (`idadmin`),
                                            KEY `fk_post_has_Admin_post1_idx` (`idpost`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `post_has_lieu`
--

DROP TABLE IF EXISTS `post_has_lieu`;
CREATE TABLE IF NOT EXISTS `post_has_lieu` (
                                               `idlieu` int(11) NOT NULL,
                                               `idpost` int(11) NOT NULL,
                                               PRIMARY KEY (`idlieu`,`idpost`),
                                               KEY `fk_lieu_has_post_post1_idx` (`idpost`),
                                               KEY `fk_lieu_has_post_lieu1_idx` (`idlieu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `post_has_lieu`
--

INSERT INTO `post_has_lieu` (`idlieu`, `idpost`) VALUES
                                                     (1, 2),
                                                     (1, 6),
                                                     (1, 7),
                                                     (1, 8),
                                                     (1, 9),
                                                     (1, 10),
                                                     (1, 11),
                                                     (1, 12),
                                                     (1, 13),
                                                     (1, 14),
                                                     (1, 15),
                                                     (1, 16),
                                                     (1, 17),
                                                     (2, 5);

-- --------------------------------------------------------

--
-- Structure de la table `post_user`
--

DROP TABLE IF EXISTS `post_user`;
CREATE TABLE IF NOT EXISTS `post_user` (
                                           `iduser` int(11) NOT NULL,
                                           `idpost` int(11) NOT NULL,
                                           PRIMARY KEY (`iduser`,`idpost`),
                                           KEY `fk_user_has_post_post1_idx` (`idpost`),
                                           KEY `fk_user_has_post_user1_idx` (`iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `post_user`
--

INSERT INTO `post_user` (`iduser`, `idpost`) VALUES
                                                 (4, 2),
                                                 (4, 3),
                                                 (4, 4),
                                                 (4, 5),
                                                 (4, 6),
                                                 (4, 7),
                                                 (4, 8),
                                                 (4, 9),
                                                 (4, 10),
                                                 (4, 11),
                                                 (4, 12),
                                                 (4, 13),
                                                 (4, 14),
                                                 (4, 15),
                                                 (4, 16),
                                                 (4, 17);

-- --------------------------------------------------------

--
-- Structure de la table `promos`
--

DROP TABLE IF EXISTS `promos`;
CREATE TABLE IF NOT EXISTS `promos` (
                                        `idpromos` int(11) NOT NULL AUTO_INCREMENT,
                                        `nom` varchar(45) DEFAULT NULL,
                                        PRIMARY KEY (`idpromos`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `promos`
--

INSERT INTO `promos` (`idpromos`, `nom`) VALUES
                                             (1, 'Bach1'),
                                             (2, 'Bach2'),
                                             (3, 'Bach3'),
                                             (4, 'Msc1'),
                                             (5, 'Msc2'),
                                             (6, 'ING1'),
                                             (7, 'ING2'),
                                             (8, 'ING3'),
                                             (9, 'ING4'),
                                             (10, 'ING5');

-- --------------------------------------------------------

--
-- Structure de la table `reactions`
--

DROP TABLE IF EXISTS `reactions`;
CREATE TABLE IF NOT EXISTS `reactions` (
                                           `idreactions` int(11) NOT NULL AUTO_INCREMENT,
                                           `type` tinyint(4) DEFAULT NULL,
                                           `post_idpost` int(11) NOT NULL,
                                           PRIMARY KEY (`idreactions`),
                                           KEY `fk_reactions_post1_idx` (`post_idpost`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
                                      `iduser` int(11) NOT NULL AUTO_INCREMENT,
                                      `nom` varchar(45) DEFAULT NULL,
                                      `prenom` varchar(45) DEFAULT NULL,
                                      `mail` varchar(200) DEFAULT NULL,
                                      `password` varchar(255) DEFAULT NULL,
                                      `date_de_naissance` date DEFAULT NULL,
                                      `type` int(11) DEFAULT NULL,
                                      `description` varchar(200) DEFAULT NULL,
                                      `ville` varchar(200) DEFAULT NULL,
                                      `interests` varchar(45) DEFAULT NULL,
                                      `photo` varchar(200) DEFAULT NULL,
                                      `isvalide` tinyint(4) DEFAULT NULL,
                                      `token` varchar(255) DEFAULT NULL,
                                      `inactive_time` datetime DEFAULT NULL,
                                      PRIMARY KEY (`iduser`),
                                      UNIQUE KEY `mail_UNIQUE` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`iduser`, `nom`, `prenom`, `mail`, `password`, `date_de_naissance`, `type`, `description`, `ville`, `interests`, `photo`, `isvalide`, `token`, `inactive_time`) VALUES
                                                                                                                                                                                        (1, 'Ohnona', 'Ashley', 'ashley.ohnona@edu.ece.fr', '$2y$10$2S8t3MvXR1wacA68iYlqKuGAuAVmBBGvI1FDRcPbWBqcwKsry2Zhe', '2023-03-30', 1, '', 'Paris', '', NULL, 0, 'eb36000bdbbff3d397a380285b4a33aab4d7701e06bb9d57581787bfd159b035', NULL),
                                                                                                                                                                                        (2, 'Bemelin', 'Wilfried', 'wilfriedryan.djossie@edu.ece.fr', '$2y$10$4tLpBWG3UsFJoDZj7RYQgur9eTjAFG2ADbPAiUpdv/JHCdtbhaZr6', '2023-03-30', 1, '', 'Paris', '', NULL, 0, '56fcbbd58551f4a193b98b927921859828983bfc6a1cbb9e3ee7b61c5fad00cc', NULL),
                                                                                                                                                                                        (3, 'Bemelin', 'Wilfried', 'wilfri@edu.ece.fr', 'wilWIL08?', '2023-03-30', 1, '', 'Paris', '', NULL, 1, 'a8ce934acbe8ec49018beb24a31f0e5248a31fe956a00242df53fb977a1aeb77', NULL),
                                                                                                                                                                                        (4, 'Melgou', 'Manal', 'manal.melgou@edu.ece.fr', 'manMAN08?', '2023-03-25', 1, 'whouaaaaaaaa', '', '', '../upload/avatar/641f62a408c93-logo ECEBOOK.png', 1, 'da28c99001c1cf703e62cd0173d213645d03786bf8fd7b5d9620c905b40e7d41', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user_has_amis`
--

DROP TABLE IF EXISTS `user_has_amis`;
CREATE TABLE IF NOT EXISTS `user_has_amis` (
                                               `iduser` int(11) NOT NULL,
                                               `idamis` int(11) NOT NULL,
                                               `statut` int(11) NOT NULL,
                                               PRIMARY KEY (`iduser`,`idamis`),
                                               KEY `fk_user_has_amis_user1_idx` (`iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `user_has_amis`
--

INSERT INTO `user_has_amis` (`iduser`, `idamis`, `statut`) VALUES
                                                               (1, 4, 1),
                                                               (3, 1, 1),
                                                               (3, 2, 1),
                                                               (4, 1, 1),
                                                               (4, 2, 1),
                                                               (4, 3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `user_has_promos`
--

DROP TABLE IF EXISTS `user_has_promos`;
CREATE TABLE IF NOT EXISTS `user_has_promos` (
                                                 `iduser` int(11) NOT NULL,
                                                 `idpromos` int(11) NOT NULL,
                                                 `statut` int(11) DEFAULT NULL,
                                                 PRIMARY KEY (`iduser`,`idpromos`),
                                                 KEY `fk_user_has_promos_promos1_idx` (`idpromos`),
                                                 KEY `fk_user_has_promos_user1_idx` (`iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `user_has_promos`
--

INSERT INTO `user_has_promos` (`iduser`, `idpromos`, `statut`) VALUES
                                                                   (1, 1, NULL),
                                                                   (2, 1, NULL),
                                                                   (3, 1, NULL),
                                                                   (4, 10, NULL);

--
