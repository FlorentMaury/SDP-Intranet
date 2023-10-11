-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 11 oct. 2023 à 15:56
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
-- Structure de la table `user`
--

CREATE TABLE `user` (
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
  `id_card_back` varchar(255) NOT NULL,
  `school_1` varchar(300) NOT NULL,
  `school_1_start` date DEFAULT NULL,
  `school_1_end` date DEFAULT NULL,
  `school_1_doc` text NOT NULL,
  `school_2` varchar(300) NOT NULL,
  `school_2_start` date DEFAULT NULL,
  `school_2_end` date DEFAULT NULL,
  `school_2_doc` text NOT NULL,
  `school_3` varchar(300) NOT NULL,
  `school_3_start` date DEFAULT NULL,
  `school_3_end` date DEFAULT NULL,
  `school_3_doc` text NOT NULL,
  `job_1` varchar(300) NOT NULL,
  `job_1_start` date DEFAULT NULL,
  `job_1_end` date DEFAULT NULL,
  `job_1_exp` text NOT NULL,
  `job_2` varchar(300) NOT NULL,
  `job_2_start` date DEFAULT NULL,
  `job_2_end` date DEFAULT NULL,
  `job_2_exp` text NOT NULL,
  `job_3` varchar(300) NOT NULL,
  `job_3_start` date DEFAULT NULL,
  `job_3_end` date DEFAULT NULL,
  `job_3_exp` text NOT NULL,
  `contract_type` varchar(10) NOT NULL,
  `contract_start` date DEFAULT NULL,
  `contract_end` date DEFAULT NULL,
  `contract_level` varchar(10) NOT NULL,
  `contract_coef` varchar(10) NOT NULL,
  `contract_remuneration` varchar(8) NOT NULL,
  `contract_insurance` varchar(10) NOT NULL,
  `contract_insurance_number` varchar(30) NOT NULL,
  `contract_weekly` varchar(10) NOT NULL,
  `contract_transports` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `email`, `secret`, `password`, `birth_date`, `sex`, `phone_number`, `birth_city`, `birth_country`, `current_street_number`, `current_city_street`, `current_city`, `current_zip_code`, `current_country`, `id_number`, `social_security_number`, `creation_date`, `profile_picture`, `insurance_card_face`, `insurance_card_back`, `id_card_face`, `id_card_back`, `school_1`, `school_1_start`, `school_1_end`, `school_1_doc`, `school_2`, `school_2_start`, `school_2_end`, `school_2_doc`, `school_3`, `school_3_start`, `school_3_end`, `school_3_doc`, `job_1`, `job_1_start`, `job_1_end`, `job_1_exp`, `job_2`, `job_2_start`, `job_2_end`, `job_2_exp`, `job_3`, `job_3_start`, `job_3_end`, `job_3_exp`, `contract_type`, `contract_start`, `contract_end`, `contract_level`, `contract_coef`, `contract_remuneration`, `contract_insurance`, `contract_insurance_number`, `contract_weekly`, `contract_transports`) VALUES
(1, 'Florent', 'Maury', 'e@e.ee', 'bfd53533fbd80993fe5a6d80c7fc2675fdb8a6d91695905527', 'zk32a253b835f3ac4fe27137d4a142440e6ba36620c8345', '1994-06-03', 'Homme', '0612121212', 'Londres', 'Royaume_Uni', '18', 'Rue Saint Antoine', 'Paris', '75004', 'France', '599454644', '1949494052560', '2023-09-28 12:52:07', '6523cc2edd76e9.44144468.webp', '6523e114439f09.87868524.png', '6523d16a5612a5.30537818.jpg', '6523d143ef1753.98244907.webp', '6523d14a1d30c4.20544675.jpg', 'Cloud Campus', '2023-09-01', '2025-09-01', '65252d96962d64.06868687.png', 'Believemy', '2021-12-01', '2023-10-25', '6525637970d291.31234013.png', '', NULL, NULL, '', 'SDP', '2023-09-25', '2024-10-01', 'Lorem ipsum.', 'Sea Sheperd', '2020-05-01', '2023-10-23', 'Lorem ipsum.', 'Lorem', '2023-10-13', '2023-10-27', 'Lorem Ipsum.', '', NULL, NULL, '', '', '', '', '', '', ''),
(17, 'John', 'Doe', 'o@o.oo', '8f80766a1d4bd2685345aa7263ac06f3f614d0761696948543', 'zk3272f3175835e6b65b315b2a00357f9b9d229dae38345', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '2023-10-10 14:35:43', '', '', '', '', '', '', NULL, NULL, '', '', NULL, NULL, '', '', NULL, NULL, '', '', NULL, NULL, '', '', NULL, NULL, '', '', NULL, NULL, '', '', NULL, NULL, '', '', '', '', '', '', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
