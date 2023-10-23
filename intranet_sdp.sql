-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 23 oct. 2023 à 12:39
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
  `active` varchar(1) NOT NULL DEFAULT '1',
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
  `curriculum_vitae` varchar(255) NOT NULL,
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
  `contract_type` text NOT NULL,
  `contract_start` date DEFAULT NULL,
  `contract_end` date DEFAULT NULL,
  `contract_level` varchar(10) NOT NULL,
  `contract_coef` varchar(10) NOT NULL,
  `contract_remuneration` float NOT NULL,
  `contract_insurance` varchar(10) NOT NULL,
  `contract_insurance_number` varchar(30) NOT NULL,
  `contract_weekly` varchar(10) NOT NULL,
  `contract_transports` varchar(10) NOT NULL,
  `user_absence` float DEFAULT 0,
  `user_delay` float DEFAULT 0,
  `user_extra_time` float NOT NULL DEFAULT 0,
  `illness_justif` text NOT NULL,
  `illness_date` date DEFAULT NULL,
  `user_absence2` float NOT NULL,
  `illness_justif2` text NOT NULL,
  `illness_date2` date DEFAULT NULL,
  `user_absence3` float NOT NULL,
  `illness_justif3` text NOT NULL,
  `illness_date3` date DEFAULT NULL,
  `user_absence4` float NOT NULL,
  `illness_justif4` text NOT NULL,
  `illness_date4` date DEFAULT NULL,
  `holiday1_response` varchar(2) NOT NULL,
  `holiday1_start` date DEFAULT NULL,
  `holiday1_end` date DEFAULT NULL,
  `holiday2_response` varchar(2) NOT NULL,
  `holiday2_start` date DEFAULT NULL,
  `holiday2_end` date DEFAULT NULL,
  `holiday3_response` varchar(2) NOT NULL,
  `holiday3_start` date DEFAULT NULL,
  `holiday3_end` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `active`, `name`, `surname`, `email`, `secret`, `password`, `birth_date`, `sex`, `phone_number`, `birth_city`, `birth_country`, `current_street_number`, `current_city_street`, `current_city`, `current_zip_code`, `current_country`, `id_number`, `social_security_number`, `creation_date`, `profile_picture`, `curriculum_vitae`, `insurance_card_face`, `insurance_card_back`, `id_card_face`, `id_card_back`, `school_1`, `school_1_start`, `school_1_end`, `school_1_doc`, `school_2`, `school_2_start`, `school_2_end`, `school_2_doc`, `school_3`, `school_3_start`, `school_3_end`, `school_3_doc`, `job_1`, `job_1_start`, `job_1_end`, `job_1_exp`, `job_2`, `job_2_start`, `job_2_end`, `job_2_exp`, `job_3`, `job_3_start`, `job_3_end`, `job_3_exp`, `contract_type`, `contract_start`, `contract_end`, `contract_level`, `contract_coef`, `contract_remuneration`, `contract_insurance`, `contract_insurance_number`, `contract_weekly`, `contract_transports`, `user_absence`, `user_delay`, `user_extra_time`, `illness_justif`, `illness_date`, `user_absence2`, `illness_justif2`, `illness_date2`, `user_absence3`, `illness_justif3`, `illness_date3`, `user_absence4`, `illness_justif4`, `illness_date4`, `holiday1_response`, `holiday1_start`, `holiday1_end`, `holiday2_response`, `holiday2_start`, `holiday2_end`, `holiday3_response`, `holiday3_start`, `holiday3_end`) VALUES
(1, '1', 'Flo', 'Maury', 'e@e.ee', 'bfd53533fbd80993fe5a6d80c7fc2675fdb8a6d91695905527', 'zk32a253b835f3ac4fe27137d4a142440e6ba36620c8345', '1994-06-03', 'Homme', '0612121212', 'Londres', 'Royaume_Uni', '18', 'Rue Saint Antoine', 'Paris', '75004', 'France', '599454644', '1949494052560', '2023-09-28 12:52:07', '', '65364d56418e57.05596546.jpg', '653646fc128324.82613172.webp', '65364704956a58.15773233.webp', '6536470d6bd233.72763459.webp', '65364716a9e7a7.55391851.webp', 'Cloud Campus', '2023-09-01', '2025-09-01', '653646ced86828.36815518.jpeg', 'Believemy', '2021-12-01', '2023-10-25', '653646db7d4723.31422210.jpeg', '', NULL, NULL, '', 'SDP', '2023-09-25', '2024-10-01', 'Lorem ipsum.', 'Mairie de Paris', '2020-05-01', '2023-10-26', 'Lorem ipsum.', 'Lorem', '2023-10-13', '2023-10-27', 'Lorem Ipsum.', 'CDI', '2023-10-02', '2023-11-05', '', '', 13, '', '', '35', '', 0, 0.25, 0, '', NULL, 0, '', NULL, 0, '', NULL, 0, '', NULL, '0', '2023-10-02', '2023-10-29', '', NULL, NULL, '', NULL, NULL),
(20, '0', 'John', 'Doe', 'o@o.oo', '52660f6b103c6f63b62134c7a831dec4a828d1511697122766', 'zk3272f3175835e6b65b315b2a00357f9b9d229dae38345', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '2023-10-12 14:59:26', '', '', '', '', '', '', '', NULL, NULL, '', '', NULL, NULL, '', '', NULL, NULL, '', '', NULL, NULL, '', '', NULL, NULL, '', '', NULL, NULL, '', '', NULL, '2023-10-20', '', '', 0, '', '', '', '', 0, 0, 0, '', NULL, 0, '', NULL, 0, '', NULL, 0, '', NULL, '', NULL, NULL, '', NULL, NULL, '', NULL, NULL),
(21, '1', 'Jean', 'Dujardin', 't@t.tt', 'a5cea6f90d77c023a575f9b6733b468188328fad1697466634', 'zk32eb846250ff215d2b7e8eb735b3312727f493e1db345', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '2023-10-16 14:30:34', '', '', '', '', '', '', '', NULL, NULL, '', '', NULL, NULL, '', '', NULL, NULL, '', '', NULL, NULL, '', '', NULL, NULL, '', '', NULL, NULL, '', '', '2023-10-12', NULL, '', '', 0, '', '', '', '', 0, 0, 0, '', NULL, 0, '', NULL, 0, '', NULL, 0, '', NULL, '0', '2023-10-02', '2023-10-15', '', NULL, NULL, '', NULL, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

DELIMITER $$
--
-- Évènements
--
CREATE DEFINER=`root`@`localhost` EVENT `resetUserTimeBank` ON SCHEDULE EVERY 1 WEEK STARTS '2023-10-24 00:00:00' ON COMPLETION NOT PRESERVE DISABLE DO UPDATE user SET user_extra_time = 0, user_delay = 0, user_absence = 0$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
