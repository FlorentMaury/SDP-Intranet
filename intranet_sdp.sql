-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 05 oct. 2023 à 16:14
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `intranet_sdp`
--

-- --------------------------------------------------------

--
-- Structure de la table `marital_status`
--

CREATE TABLE `marital_status` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `email` text NOT NULL,
  `secret` text NOT NULL,
  `password` text NOT NULL,
  `birth_date` date NOT NULL,
  `sex` varchar(5) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `birth_city` text NOT NULL,
  `birth_country` text NOT NULL,
  `current_street_number` text NOT NULL,
  `current_city_street` text NOT NULL,
  `current_city` text NOT NULL,
  `current_zip_code` text NOT NULL,
  `current_country` text NOT NULL,
  `id_number` varchar(30) NOT NULL,
  `social_security_number` varchar(30) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_picture` varchar(255) NOT NULL,
  `insurance_card_face` varchar(255) NOT NULL,
  `insurance_card_back` varchar(255) NOT NULL,
  `id_card_face` varchar(255) NOT NULL,
  `id_card_back` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `marital_status`
--

INSERT INTO `marital_status` (`id`, `name`, `surname`, `email`, `secret`, `password`, `birth_date`, `sex`, `phone_number`, `birth_city`, `birth_country`, `current_street_number`, `current_city_street`, `current_city`, `current_zip_code`, `current_country`, `id_number`, `social_security_number`, `creation_date`, `profile_picture`, `insurance_card_face`, `insurance_card_back`, `id_card_face`, `id_card_back`) VALUES
(1, 'Flo', 'Maury', 'e@e.ee', 'bfd53533fbd80993fe5a6d80c7fc2675fdb8a6d91695905527', 'zk32a253b835f3ac4fe27137d4a142440e6ba36620c8345', '1994-06-03', 'Homme', '0612121212', 'Londres', 'United-Kingdom', '18', 'Rue Saint Antoine', 'Paris', '75004', 'FRANCE', '599454644', '1949494052560', '2023-09-28 12:52:07', '6516e0206add06.66637805.jpg', '', '', '', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `marital_status`
--
ALTER TABLE `marital_status`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `marital_status`
--
ALTER TABLE `marital_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
