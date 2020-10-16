-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 16 oct. 2020 à 14:03
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dbapp`
--

-- --------------------------------------------------------

--
-- Structure de la table `city`
--

CREATE TABLE `city` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `nb_visits` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `city`
--

INSERT INTO `city` (`id`, `name`, `nb_visits`) VALUES
(1, 'Casablanca', 0),
(2, 'Fez', 0),
(3, 'Rabat', 0);

-- --------------------------------------------------------

--
-- Structure de la table `city_informations`
--

CREATE TABLE `city_informations` (
  `id` int(11) NOT NULL,
  `id_city` int(11) NOT NULL,
  `info_title` varchar(100) NOT NULL,
  `details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `city_informations`
--

INSERT INTO `city_informations` (`id`, `id_city`, `info_title`, `details`) VALUES
(1, 3, 'History', 'Rabat was founded in the 12th century by the Almohad ruler Abd al-Mu\'min as a military town.'),
(2, 3, 'Climate', 'Rabat features a Mediterranean climate (Csa) with warm to hot dry summers and mild damp winters'),
(3, 1, 'Geography', 'Casablanca is located on the Atlantic coast of the Chaouia Plains which have historically been the breadbasket of Morocco'),
(4, 1, 'Economy', 'The Grand Casablanca region is considered the locomotive of the development of the Moroccan economy.'),
(5, 2, 'Foundation', 'The city was founded on a bank of the Jawhar river by Idris I in 789, founder of the Idrisid dynasty'),
(6, 2, 'Education', 'Sidi Mohamed Ben Abdellah University is a public university founded in 1975 and is the largest in the city by attendance, counting over 86,000 students in 2020.'),
(7, 3, 'Families of Rabat', 'Called Rbatis, these families have lived for more than 400 years with many events in common. From the expulsion of the Moriscos to arrive at the foundation of a culture that combines the Arabic and Andalusian cultures'),
(8, 1, 'History', 'Casablanca was founded and settled by Berbers by at least the seventh century BC. It was used as a port by the Phoenicians and later the Romans.In his book Description of Africa, Leo Africanus refers to ancient Casablanca as \"Anfa\"'),
(9, 2, 'Transport', 'The city of Fez is served by the region\'s main international airport, Fès–Saïs, located roughly 15 km south of the city center.');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `city_informations`
--
ALTER TABLE `city_informations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `city_informations`
--
ALTER TABLE `city_informations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
