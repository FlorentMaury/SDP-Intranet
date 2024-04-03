-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Hôte : db5014654403.hosting-data.io
-- Généré le : ven. 29 mars 2024 à 11:07
-- Version du serveur : 10.6.15-MariaDB-1:10.6.15+maria~deb11-log
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `intranet_sdp`
--
CREATE DATABASE IF NOT EXISTS `intranet_sdp` DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci;
USE `intranet_sdp`;

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
(1, '1', 'Florent', 'Maury', 'contact@florent-maury.fr', 'bfd53533fbd80993fe5a6d80c7fc2675fdb8a6d91695905527', 'zk32a253b835f3ac4fe27137d4a142440e6ba36620c8345', '1994-06-03', 'Homme', '0612121212', 'Londres', 'Royaume_Uni', '18', 'Rue Saint Antoine', 'Paris', '75004', 'France', '599454644', '1949494052560', '2022-09-28 12:52:07', '', '', '', '', '', ''),
(2, '1', 'Patrice', 'Dana', 'pdana@free.fr', '2e1c9e69184b6e3f3e68a05a8b1cb4b9ea026a301710329183', 'zk325498a9cdcbdeca627c6b7528f638ab9ac0775fc6345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-13 11:26:23', '', '', '', '', '', ''),
(3, '1', 'Mélanie', 'Risler', 'mrisler@sdp-paris.com', 'ead5001e951ca8fca9441ff028c1b3e16e7ef1541710329258', 'zk3236443bd2a341761c91e97d0f02a6d06d0007d31e345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-13 11:27:38', '', '', '', '', '', ''),
(4, '1', 'Laly', 'de SAINT GIRONS', 'lalyyydsg@gmail.com', 'a29dbb052cb77ccfdf14cf6094cfba3e5fed3ce21710329607', 'zk325aae0854def0ff36b3b2bd90a056178af74ee7db345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-13 11:33:27', '', '', '', '', '', ''),
(5, '1', 'Léa', 'Campos', 'melusine.camp@orange.fr', '03e4317f8c65b0848ae50f923f0c65b5af846fab1710329645', 'zk325730cbfa9e12c826d4a868a9100ab1cbf816c1d5345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-13 11:34:05', '', '', '', '', '', ''),
(6, '1', 'Amandine', 'Lalo', 'digital@sdp-paris.com', 'f2a997f12dc62f65e9ccad31fccff626cd8375d61710329734', 'zk32cb8e40a7462d581265daaeeed2faca458ac440b4345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-13 11:35:34', '', '', '', '', '', ''),
(8, '1', 'Manon', 'Mandrea', 'manon.mndr@outlook.com', '3560f2417be1e6e9f91c34bb82e2f492aa37f8321710433644', 'zk3246ddaa9034b3b29a4699a52ae0bd0fc476fde794345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-14 16:27:24', '', '', '', '', '', ''),
(9, '1', 'Alexandre', 'Delaleu', 'alexandre.delaleu@edu.devinci.fr', 'c323a8049d329f314ac125fbd06dd3b13290e1041710847050', 'zk32eefd21f16e06623b41fc560be436f8c884d231cc345', '2003-04-10', NULL, '0767184838', 'Le Chesnay', 'France', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-19 11:17:30', '', '', '', '', '', ''),
(10, '1', 'Léa', 'L&#039;Ahelec', 'marketing@sdp-paris.com', 'cfbaec8ac38f6b321f54af3b60eee3b9dfafb88b1710847208', 'zk323c5a339f705489c82df2b099a1fd42f550361bc4345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-03-19 11:20:08', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `user_day_off`
--

CREATE TABLE `user_day_off` (
  `day_off_id` int(11) NOT NULL,
  `user_day_off_id` int(11) NOT NULL,
  `day_off` date NOT NULL,
  `day_off_response` varchar(2) NOT NULL,
  `day_off_request_text` text NOT NULL,
  `day_off_response_text` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user_holiday`
--

CREATE TABLE `user_holiday` (
  `holiday_id` int(11) NOT NULL,
  `user_holiday_id` int(11) NOT NULL,
  `holiday_start` date NOT NULL,
  `holiday_end` date NOT NULL,
  `holiday_response` varchar(2) NOT NULL,
  `holiday_request_text` text NOT NULL,
  `holiday_response_text` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 0, 'Alternance', '2023-10-01', '2024-09-01', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 0, 'CDI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 0, 'Alternance', '2023-09-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 0, 'Alternance', '2023-09-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 0, 'Alternance', '2024-01-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 0, 'Alternance', '2023-09-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 0, 'Stage', '2024-03-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 0, 'Alternance', '2021-09-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
  `holidays_taken` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `user_time_bank`
--

INSERT INTO `user_time_bank` (`user_time_bank_id`, `transport_scan`, `contract_transports`, `user_absence`, `user_delay`, `user_extra_time`, `day_off_bank`, `day_off_response1`, `day_off1`, `day_off1_desc`, `day_off_response2`, `day_off2`, `day_off2_desc`, `day_off_response3`, `day_off3`, `day_off3_desc`, `illness_justif`, `illness_date`, `user_absence2`, `illness_justif2`, `illness_date2`, `user_absence3`, `illness_justif3`, `illness_date3`, `user_absence4`, `illness_justif4`, `illness_date4`, `planned_illness_1`, `planned_illness_1_date`, `planned_illness_1_justif`, `planned_illness_2`, `planned_illness_2_date`, `planned_illness_2_justif`, `planned_illness_3`, `planned_illness_3_date`, `planned_illness_3_justif`, `holidays_total`, `holidays_taken`) VALUES
(1, '', '98765432', 0, 0, 0.25, '1', NULL, NULL, NULL, '0', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, 0),
(2, '', '', 0, 0.5, 2, '0', '0', NULL, NULL, '0', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, 0),
(3, '', '', 0, 0, 0, '0', '0', NULL, NULL, '0', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, 0),
(4, '', '', 0, 0, 1, '0', '0', NULL, NULL, '0', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, 0),
(5, '', '', 0, 0, 0, '0', '0', NULL, NULL, '0', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, 0),
(6, '', '', 0, 0, 0, '0', '0', NULL, NULL, '0', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, 0),
(8, '', '', 0, 0, 3, '0', '0', NULL, NULL, '0', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, 0),
(9, '', '', 0, 0, 0, '0', '0', NULL, NULL, '0', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, 0),
(10, '', '', 0, 0, 0, '0', '0', NULL, NULL, '0', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, 0);


--
-- Index pour les tables déchargées
--

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user_day_off`
--
ALTER TABLE `user_day_off`
  ADD PRIMARY KEY (`day_off_id`);

--
-- Index pour la table `user_exp`
--
ALTER TABLE `user_exp`
  ADD PRIMARY KEY (`user_exp_id`);

--
-- Index pour la table `user_holiday`
--
ALTER TABLE `user_holiday`
  ADD PRIMARY KEY (`holiday_id`);

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
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `user_day_off`
--
ALTER TABLE `user_day_off`
  MODIFY `day_off_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

--
-- AUTO_INCREMENT pour la table `user_holiday`
--
ALTER TABLE `user_holiday`
  MODIFY `holiday_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
