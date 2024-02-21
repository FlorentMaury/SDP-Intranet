-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 21 fév. 2024 à 12:16
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

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
-- Structure de la table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `title` varchar(6) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `email` text NOT NULL,
  `address` text NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `host` varchar(30) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `how_did_you` text NOT NULL,
  `creation_id` varchar(10) NOT NULL,
  `created_by` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `customer`
--

INSERT INTO `customer` (`id`, `title`, `lastname`, `firstname`, `email`, `address`, `city`, `country`, `phone_number`, `host`, `date`, `how_did_you`, `creation_id`, `created_by`) VALUES
(0, 'Mr', 'Reno', 'Jean', 'r@r.rr', '4 Rue de Reno', 'New-York', 'États-Unis', '+1111111', 'Karim', '2024-02-21', 'TripAdvisor', '202402001', ''),
(1, 'Mme', 'Dujardin', 'Jean', 'd@d.dd', '4 Rue du Jardin', 'Londres', 'Royaume-Uni', '+44444444', 'Lea', '2024-02-21', 'WeCanDo', '202402002', ''),
(2, 'Enfant', 'Gabin', 'Jean', 'g@g.gg', '4 rue de Gabin', 'Paris', 'France', '+33333333', 'Patrice', '2024-02-21', 'Google', '202402003', '');

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
  `birth_date` date DEFAULT NULL,
  `sex` varchar(5) DEFAULT NULL,
  `phone_number` varchar(10) DEFAULT NULL,
  `birth_city` text DEFAULT NULL,
  `birth_country` text DEFAULT NULL,
  `current_street_number` text DEFAULT NULL,
  `current_city_street` text DEFAULT NULL,
  `current_city` text DEFAULT NULL,
  `current_zip_code` text DEFAULT NULL,
  `current_country` text DEFAULT NULL,
  `id_number` varchar(30) DEFAULT NULL,
  `social_security_number` varchar(30) DEFAULT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_picture` varchar(255) NOT NULL,
  `curriculum_vitae` varchar(255) NOT NULL,
  `insurance_card_face` varchar(255) NOT NULL,
  `insurance_card_back` varchar(255) NOT NULL,
  `id_card_face` varchar(255) NOT NULL,
  `id_card_back` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `active`, `name`, `surname`, `email`, `secret`, `password`, `birth_date`, `sex`, `phone_number`, `birth_city`, `birth_country`, `current_street_number`, `current_city_street`, `current_city`, `current_zip_code`, `current_country`, `id_number`, `social_security_number`, `creation_date`, `profile_picture`, `curriculum_vitae`, `insurance_card_face`, `insurance_card_back`, `id_card_face`, `id_card_back`) VALUES
(1, '1', 'Flo', 'Maury', 'e@e.ee', 'bfd53533fbd80993fe5a6d80c7fc2675fdb8a6d91695905527', 'zk32a253b835f3ac4fe27137d4a142440e6ba36620c8345', '1994-06-03', 'Homme', '0612121212', 'Londres', 'Royaume_Uni', '18', 'Rue Saint Antoine', 'Paris', '75004', 'France', '599454644', '1949494052560', '2022-09-28 12:52:07', '', '', '', '', '', ''),
(2, '1', 'John', 'Doe', 'o@o.oo', 'e043cabede08db1411cec7470c54427896de3d3c1699960535', 'zk3272f3175835e6b65b315b2a00357f9b9d229dae38345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-14 11:15:35', '', '', '', '', '', ''),
(3, '0', 'Test', 'ToDelete', 'r@r.rr', 'c1290d333721427b5abd3fa7ace29ba18dfc716f1699962977', 'zk325ff2615197d4dadcc3dd086098372b7f64b069c3345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-11-14 11:56:17', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `user_exp`
--

CREATE TABLE `user_exp` (
  `user_exp_id` int(11) NOT NULL,
  `school_1` varchar(300) DEFAULT NULL,
  `school_1_start` date DEFAULT NULL,
  `school_1_end` date DEFAULT NULL,
  `school_1_doc` text DEFAULT NULL,
  `school_2` varchar(300) DEFAULT NULL,
  `school_2_start` date DEFAULT NULL,
  `school_2_end` date DEFAULT NULL,
  `school_2_doc` text DEFAULT NULL,
  `school_3` varchar(300) DEFAULT NULL,
  `school_3_start` date DEFAULT NULL,
  `school_3_end` date DEFAULT NULL,
  `school_3_doc` text DEFAULT NULL,
  `job_1` varchar(300) DEFAULT NULL,
  `job_1_start` date DEFAULT NULL,
  `job_1_end` date DEFAULT NULL,
  `job_1_exp` text DEFAULT NULL,
  `job_2` varchar(300) DEFAULT NULL,
  `job_2_start` date DEFAULT NULL,
  `job_2_end` date DEFAULT NULL,
  `job_2_exp` text DEFAULT NULL,
  `job_3` varchar(300) DEFAULT NULL,
  `job_3_start` date DEFAULT NULL,
  `job_3_end` date DEFAULT NULL,
  `job_3_exp` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `user_exp`
--

INSERT INTO `user_exp` (`user_exp_id`, `school_1`, `school_1_start`, `school_1_end`, `school_1_doc`, `school_2`, `school_2_start`, `school_2_end`, `school_2_doc`, `school_3`, `school_3_start`, `school_3_end`, `school_3_doc`, `job_1`, `job_1_start`, `job_1_end`, `job_1_exp`, `job_2`, `job_2_start`, `job_2_end`, `job_2_exp`, `job_3`, `job_3_start`, `job_3_end`, `job_3_exp`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user_role`
--

CREATE TABLE `user_role` (
  `user_role_id` int(11) NOT NULL,
  `can_access_db` int(11) NOT NULL,
  `contract_type` text DEFAULT NULL,
  `contract_start` date DEFAULT NULL,
  `contract_end` date DEFAULT NULL,
  `contract_level` varchar(10) DEFAULT NULL,
  `contract_coef` varchar(10) DEFAULT NULL,
  `contract_remuneration` float DEFAULT NULL,
  `contract_insurance` varchar(10) DEFAULT NULL,
  `contract_insurance_number` varchar(30) DEFAULT NULL,
  `contract_weekly` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `user_role`
--

INSERT INTO `user_role` (`user_role_id`, `can_access_db`, `contract_type`, `contract_start`, `contract_end`, `contract_level`, `contract_coef`, `contract_remuneration`, `contract_insurance`, `contract_insurance_number`, `contract_weekly`) VALUES
(1, 1, NULL, '2023-08-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user_time_bank`
--

CREATE TABLE `user_time_bank` (
  `user_time_bank_id` int(11) NOT NULL,
  `transport_scan` varchar(255) NOT NULL,
  `contract_transports` varchar(10) NOT NULL,
  `user_absence` float DEFAULT 0,
  `user_delay` float DEFAULT 0,
  `user_extra_time` float DEFAULT 0,
  `day_off_bank` varchar(255) DEFAULT '0',
  `day_off_response1` varchar(2) DEFAULT '0',
  `day_off1` text DEFAULT NULL,
  `day_off1_desc` text DEFAULT NULL,
  `day_off_response2` varchar(2) DEFAULT '0',
  `day_off2` date DEFAULT NULL,
  `day_off2_desc` text DEFAULT NULL,
  `day_off_response3` varchar(2) DEFAULT '0',
  `day_off3` date DEFAULT NULL,
  `day_off3_desc` text DEFAULT NULL,
  `illness_justif` text DEFAULT NULL,
  `illness_date` date DEFAULT NULL,
  `user_absence2` float DEFAULT NULL,
  `illness_justif2` text DEFAULT NULL,
  `illness_date2` date DEFAULT NULL,
  `user_absence3` float DEFAULT NULL,
  `illness_justif3` text DEFAULT NULL,
  `illness_date3` date DEFAULT NULL,
  `user_absence4` float DEFAULT NULL,
  `illness_justif4` text DEFAULT NULL,
  `illness_date4` date DEFAULT NULL,
  `planned_illness_1` float NOT NULL,
  `planned_illness_1_date` date DEFAULT NULL,
  `planned_illness_1_justif` text DEFAULT NULL,
  `planned_illness_2` float DEFAULT NULL,
  `planned_illness_2_date` date DEFAULT NULL,
  `planned_illness_2_justif` text DEFAULT NULL,
  `planned_illness_3` float DEFAULT NULL,
  `planned_illness_3_date` date DEFAULT NULL,
  `planned_illness_3_justif` text DEFAULT NULL,
  `holidays_total` tinyint(4) DEFAULT 0,
  `holidays_taken` tinyint(4) DEFAULT 0,
  `holiday1_response` varchar(2) DEFAULT NULL,
  `holiday1_start` date DEFAULT NULL,
  `holiday1_end` date DEFAULT NULL,
  `holiday2_response` varchar(2) DEFAULT NULL,
  `holiday2_start` date DEFAULT NULL,
  `holiday2_end` date DEFAULT NULL,
  `holiday3_response` varchar(2) DEFAULT NULL,
  `holiday3_start` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `user_time_bank`
--

INSERT INTO `user_time_bank` (`user_time_bank_id`, `transport_scan`, `contract_transports`, `user_absence`, `user_delay`, `user_extra_time`, `day_off_bank`, `day_off_response1`, `day_off1`, `day_off1_desc`, `day_off_response2`, `day_off2`, `day_off2_desc`, `day_off_response3`, `day_off3`, `day_off3_desc`, `illness_justif`, `illness_date`, `user_absence2`, `illness_justif2`, `illness_date2`, `user_absence3`, `illness_justif3`, `illness_date3`, `user_absence4`, `illness_justif4`, `illness_date4`, `planned_illness_1`, `planned_illness_1_date`, `planned_illness_1_justif`, `planned_illness_2`, `planned_illness_2_date`, `planned_illness_2_justif`, `planned_illness_3`, `planned_illness_3_date`, `planned_illness_3_justif`, `holidays_total`, `holidays_taken`, `holiday1_response`, `holiday1_start`, `holiday1_end`, `holiday2_response`, `holiday2_start`, `holiday2_end`, `holiday3_response`, `holiday3_start`) VALUES
(1, '', '98765432', 0, 0, 0.25, '1', '0', '2023-11-16', 'Raisons de ma demande.', '0', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, 0, '0', '2023-11-02', '2023-11-24', NULL, NULL, NULL, NULL, NULL),
(29, '', '', 0, 0, 0, '0', '0', NULL, NULL, '0', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, 0, '0', '2023-11-01', '2023-11-07', NULL, NULL, NULL, NULL, NULL),
(30, '', '', 0, 0, 0, '0', '0', NULL, NULL, '0', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user_exp`
--
ALTER TABLE `user_exp`
  ADD PRIMARY KEY (`user_exp_id`);

--
-- Index pour la table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`user_role_id`);

--
-- Index pour la table `user_time_bank`
--
ALTER TABLE `user_time_bank`
  ADD PRIMARY KEY (`user_time_bank_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
