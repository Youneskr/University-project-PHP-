-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 27 avr. 2022 à 00:21
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `isitc`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(200) NOT NULL,
  `CIN` int(200) NOT NULL,
  `Nom` varchar(200) NOT NULL,
  `Prenom` varchar(200) NOT NULL,
  `Email` text NOT NULL,
  `Login` text NOT NULL,
  `Password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `CIN`, `Nom`, `Prenom`, `Email`, `Login`, `Password`) VALUES
(1, 12345678, 'Korbi', 'Younes', 'admin@isitc.fr', 'admin', '123');

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `id` int(200) NOT NULL,
  `titre` text NOT NULL,
  `description` text NOT NULL,
  `contenu` text NOT NULL,
  `is_admin` int(1) NOT NULL,
  `is_user` int(1) NOT NULL,
  `id_auteur` int(50) NOT NULL,
  `approved` int(200) NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id`, `titre`, `description`, `contenu`, `is_admin`, `is_user`, `id_auteur`, `approved`, `date`) VALUES
(38, 'AVIS aziz', 'Avis', 'AVIS aziz', 0, 1, 1, 0, '25/04/2022'),
(39, 'AVIS', 'AVIS', 'Admin', 0, 1, 1, 0, '25/04/2022'),
(43, 'Article modifié', 'Modification', 'J&#039;espère que vous allez bien', 0, 1, 1, 1, '25/04/2022'),
(44, 'Salem', 'Younes Younes Younes Younes ', 'Younes Younes Younes Younes Younes Younes Younes Younes Younes Younes Younes Younes Younes Younes Younes Younes ', 0, 1, 1, 0, '25/04/2022'),
(45, 'Avis aux étudiants de doctorat 2021-2022', 'Evaluation de la matière « Systèmes pervasifs auto-adaptatifs »', 'Une évaluation de la matière « Systèmes pervasifs<br />\r\nauto-adaptatifs » de Mme Maha Khémaja aura lieu le<br />\r\nmardi 19Avril 2022 de 12h30 à 14H à l’amphi<br />\r\nTélécoms.', 1, 0, 1, 1, '27/04/2022'),
(46, 'NOTE AUX ÉTUDIANTS DU CYCLE DOCTORAL DOCTORAT 2021-2022', 'Une évaluation  de la matière « Ingénierie des connaissances  pour l’apprentissage Humain» de Mme Lilia Chéniti  aura lieu le Samedi  16 Avril 2022 à 9H00 en ligne.<br />\r\n', 'Une évaluation  de la matière « Ingénierie des connaissances  pour l’apprentissage Humain» de Mme Lilia Chéniti  aura lieu le Samedi  16 Avril 2022 à 9H00 en ligne.<br />\r\n', 1, 0, 1, 1, '27/04/2022'),
(47, 'Formation certifiante JAVA', 'Formation certifiante JAVA', 'Dans le cadre de son projet PAQ-Price l&#039;ISITCOM organise, début du mois de<br />\r\nmars prochain, une formation certifiante sur Java. Étant donné que le nombre<br />\r\nde places est limité à 10, on prendra de chaque filière le quota suivant : 4<br />\r\nétudiants en terminal cycle ingénieur, 3 étudiants en terminal mastères pro (un<br />\r\nde chaque spécialité) et 3 étudiants en terminal Licence (un de chaque<br />\r\nspécialité). L&#039;étudiant sélectionné s&#039;engagera à suivre entièrement la formation.<br />\r\nLe choix des étudiants se fera sur la base de premier inscrit valide, premier<br />\r\nsélectionné. LES ÉTUDIANTS DÉJÀ RETENUS POUR LA FORMATION AGILE<br />\r\nSCRUM N&#039;ONT PAS LE DROIT DE PARTICIPER A CETTE', 1, 0, 1, 1, '27/04/2022'),
(48, 'NOTE AUX ÉTUDIANTS DU CYCLE DOCTORAL DOCTORAT 2021-2022', 'NOTE AUX ÉTUDIANTS DU CYCLE DOCTORAL DOCTORAT 2021-2022<br />\r\n', 'Un cours de la matière « Ingénierie des Connaissances pour l’apprentissage  humain  » de Mme Lilia Chniti  aura lieu  en ligne via l&#039;équipe sur Teams et la plateforme Uso.uvt.tn comme suit :<br />\r\n        Le lundi 14 Février  2022 de 8H30 à 11H30<br />\r\n        Le lundi  21 Février 2022 de 8H30 à 11H30<br />\r\n        Le lundi 28 Février  2022 de 8H30 à 11H30<br />\r\n   <br />\r\nContact de Mme Lilia : Liliachenitibelcadhi@gmail.com<br />\r\n Lien : https://urlz.fr/hof3', 1, 0, 1, 1, '27/04/2022');

-- --------------------------------------------------------

--
-- Structure de la table `social_media`
--

CREATE TABLE `social_media` (
  `id` int(200) NOT NULL,
  `facebook` text NOT NULL,
  `instagram` text NOT NULL,
  `twitter` text NOT NULL,
  `id_auth` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `social_media`
--

INSERT INTO `social_media` (`id`, `facebook`, `instagram`, `twitter`, `id_auth`) VALUES
(1, 'Aziz', 'Bel kacem', '123', 1),
(2, 'Yosr', '', '', 3);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(200) NOT NULL,
  `CIN` int(200) NOT NULL,
  `Nom` varchar(100) NOT NULL,
  `Prenom` varchar(100) NOT NULL,
  `Email` text NOT NULL,
  `Niveau` int(20) NOT NULL,
  `Fil` varchar(20) NOT NULL,
  `Login` text NOT NULL,
  `Password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `CIN`, `Nom`, `Prenom`, `Email`, `Niveau`, `Fil`, `Login`, `Password`) VALUES
(1, 23456789, 'Bel kacem', 'Med aziz', 'user@isitc.com', 2, 'iot', 'user', '123'),
(3, 12345679, 'Yosr', 'Ben Jabeur', 'benjabeur@yosr.fr', 2, 'LM', 'yosr123', '123'),
(4, 12547896, 'Hamdi', 'Khalil', 'khalil@khalil.fr', 2, 'lm', 'khalil21', '123');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT pour la table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
