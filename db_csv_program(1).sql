-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 11, 2024 at 09:31 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_csv_program`
--

-- --------------------------------------------------------

--
-- Table structure for table `klanten`
--

CREATE TABLE `klanten` (
  `KlantID` bigint UNSIGNED NOT NULL,
  `KlantNaam` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `klanten`
--

INSERT INTO `klanten` (`KlantID`, `KlantNaam`, `Email`) VALUES
(1, 'kjenno', 'Kjennoa@gmail.com'),
(2, 'bert', 'Bert@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `orderline`
--

CREATE TABLE `orderline` (
  `ID` int NOT NULL,
  `OrderNummer` int NOT NULL,
  `Barcode` varchar(250) NOT NULL,
  `Aantal` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orderline`
--

INSERT INTO `orderline` (`ID`, `OrderNummer`, `Barcode`, `Aantal`) VALUES
(18, 4, '8715316076237', 1),
(19, 4, '8715316076282', 1),
(20, 4, '8715316104978', 1),
(21, 4, '8715316104985', 1),
(22, 4, '8715316020070', 2),
(23, 4, '8715316077852', 2),
(24, 4, '8715316073687', 2),
(25, 4, '8715316073694', 2),
(26, 4, '8715316073700', 2),
(27, 4, '8715316073724', 3),
(28, 4, '8715316073786', 5),
(29, 4, '8715316073793', 3),
(30, 4, '8715316139017', 1),
(31, 4, '8715316145360', 2),
(32, 4, '8715316110535', 1),
(33, 4, '8715316083419', 1),
(34, 4, '8715316137761', 2),
(35, 5, '8715316021978', 5),
(36, 5, '8715316021985', 5),
(37, 5, '8715316021992', 5),
(38, 5, '8715316137747', 10),
(39, 5, '8715316040436', 10),
(40, 5, '8715316043413', 10),
(41, 5, '8715316073755', 10),
(42, 5, '8715316073762', 10),
(43, 5, '8715316073885', 10),
(44, 5, '8715316150487', 10),
(45, 5, '8715316021978', 5),
(46, 5, '8715316021992', 10),
(47, 5, '8715316137808', 10),
(48, 5, '8715316053535', 10),
(49, 5, '8715316047190', 10),
(50, 5, '8715316044427', 10),
(51, 5, '8715316044540', 10),
(52, 5, '8715316044762', 10),
(53, 5, '8715316045370', 10),
(54, 5, '8715316021985', 5),
(55, 5, '8715316021992', 5),
(56, 5, '8715316043413', 10),
(57, 5, '8715316073755', 10),
(58, 5, '8715316044427', 10),
(59, 5, '8715316044908', 10),
(60, 5, '8715316151620', 10),
(61, 5, '8715316074899', 20),
(62, 5, '8715316072543', 10),
(63, 5, '8715316021978', 10),
(64, 5, '8715316021992', 5),
(65, 5, '8715316137013', 10),
(66, 5, '8715316137747', 10),
(67, 5, '8715316040436', 10),
(68, 5, '8715316047190', 10),
(69, 5, '8715316060434', 10),
(70, 5, '8715316150203', 10),
(71, 5, '8715316150210', 10),
(72, 5, '8715316137921', 10),
(73, 5, '8715316091612', 10),
(74, 5, '8715316073885', 10),
(75, 5, '8715316044441', 10),
(76, 5, '8715316044908', 10),
(77, 5, '8715316044519', 10),
(78, 5, '8715316044540', 10),
(79, 5, '8715316045370', 10),
(80, 5, '8715316074790', 10),
(81, 5, '8715316150500', 10),
(82, 5, '8715316104763', 20),
(83, 5, '8715316021978', 5),
(84, 5, '8715316021992', 5),
(85, 5, '8715316043413', 10),
(86, 5, '8715316073991', 10),
(87, 5, '8715316074790', 10),
(88, 5, '8715316075322', 10),
(89, 5, '8715316150340', 10),
(90, 5, '8715316150524', 10),
(91, 5, '8715316137013', 10),
(92, 5, '8715316137808', 10),
(93, 5, '8715316091612', 10),
(94, 5, '8715316040436', 10),
(95, 5, '8715316073755', 10),
(96, 5, '8715316044427', 10),
(97, 5, '8715316044540', 10),
(98, 5, '8715316045004', 10),
(99, 5, '8715316072543', 10),
(100, 5, '8715316150524', 10),
(101, 5, '8715316021978', 5),
(102, 5, '8715316137808', 10),
(103, 5, '8715316072932', 10),
(104, 5, '8715316047145', 10),
(105, 5, '8715316060434', 10),
(106, 5, '8715316073755', 10),
(107, 5, '8715316073991', 10),
(108, 5, '8715316044427', 10),
(109, 5, '8715316044908', 10),
(110, 5, '8715316044519', 10),
(111, 5, '8715316021978', 5),
(112, 5, '8715316021992', 5),
(113, 5, '8715316137808', 10),
(114, 5, '8715316091636', 10),
(115, 5, '8715316020568', 10),
(116, 5, '8715316060397', 10),
(117, 5, '8715316073991', 10),
(118, 5, '8715316045004', 10),
(119, 5, '8715316075322', 10),
(120, 5, '8715316150500', 10),
(121, 5, '8715316104770', 10),
(122, 5, '8715316021978', 5),
(123, 5, '8715316072932', 10),
(124, 5, '8715316020438', 10),
(125, 5, '8715316047145', 10),
(126, 5, '8715316044397', 10),
(127, 5, '8715316044427', 10),
(128, 5, '8715316044908', 10),
(129, 5, '8715316093487', 10),
(130, 5, '8715316150647', 10),
(131, 5, '8715316021930', 5),
(132, 5, '8715316021978', 10),
(133, 5, '8715316021992', 5),
(134, 5, '8715316091636', 10),
(135, 5, '8715316020568', 10),
(136, 5, '8715316047145', 10),
(137, 5, '8715316060397', 10),
(138, 5, '8715316044427', 10),
(139, 5, '8715316150487', 10),
(140, 5, '8715316021930', 5),
(141, 5, '8715316021992', 5),
(142, 5, '8715316137808', 10),
(143, 5, '8715316072932', 10),
(144, 5, '8715316020438', 10),
(145, 5, '8715316073991', 10),
(146, 5, '8715316044908', 10),
(147, 5, '8715316074806', 10),
(148, 5, '8715316075322', 10),
(149, 5, '8715316150418', 10),
(150, 5, '8715316021930', 5),
(151, 5, '8715316021978', 10),
(152, 5, '8715316021992', 5),
(153, 5, '8715316091636', 10),
(154, 5, '8715316020438', 10),
(155, 5, '8715316020568', 10),
(156, 5, '8715316060397', 10),
(157, 5, '8715316044427', 10),
(158, 5, '8715316145865', 10),
(159, 5, '8715316104763', 10),
(160, 5, '8715316021930', 5),
(161, 5, '8715316021978', 5),
(162, 5, '8715316072932', 10),
(163, 5, '8715316047145', 10),
(164, 5, '8715316073731', 10),
(165, 5, '8715316044885', 10),
(166, 5, '8715316074806', 10),
(167, 5, '8715316151668', 10),
(168, 5, '8715316075322', 10),
(169, 5, '8715316021930', 5),
(170, 5, '8715316021978', 5),
(171, 5, '8715316021992', 5),
(172, 5, '8715316137921', 10),
(173, 5, '8715316047145', 10),
(174, 5, '8715316060397', 10),
(175, 5, '8715316044427', 10),
(176, 5, '8715316044885', 10),
(177, 5, '8715316072581', 10),
(178, 5, '8715316093500', 10),
(179, 5, '8715316021930', 5),
(180, 5, '8715316072932', 10),
(181, 5, '8715316043277', 10),
(182, 5, '8715316047190', 10),
(183, 5, '8715316074806', 10),
(184, 5, '8715316093517', 10),
(185, 5, '8715316150210', 10),
(186, 5, '8715316149887', 10),
(187, 5, '8715316150500', 10),
(188, 5, '8715316150562', 10),
(189, 5, '8715316021930', 5),
(190, 5, '8715316021992', 5),
(191, 5, '8715316137006', 10),
(192, 5, '8715316137013', 10),
(193, 5, '8715316137921', 10),
(194, 5, '8715316044427', 10),
(195, 5, '8715316044885', 10),
(196, 5, '8715316074790', 10),
(197, 5, '8715316075803', 10),
(198, 5, '8715316093500', 10),
(199, 5, '8715316021930', 5),
(200, 5, '8715316137013', 10),
(201, 5, '8715316047145', 10),
(202, 5, '8715316047190', 10),
(203, 5, '8715316044458', 10),
(204, 5, '8715316044540', 10),
(205, 5, '8715316045400', 10),
(206, 5, '8715316072581', 10),
(207, 5, '8715316075803', 10),
(208, 5, '8715316150562', 10),
(209, 5, '8715316021978', 5),
(210, 5, '8715316137006', 10),
(211, 5, '8715316091612', 10),
(212, 5, '8715316043277', 10),
(213, 5, '8715316044427', 10),
(214, 5, '8715316074790', 10),
(215, 5, '8715316074806', 10),
(216, 5, '8715316093500', 10),
(217, 5, '8715316093517', 10),
(218, 5, '8715316150524', 10),
(219, 5, '8715316021978', 5),
(220, 5, '8715316043277', 10),
(221, 5, '8715316060410', 10),
(222, 5, '8715316044540', 10),
(223, 5, '8715316045400', 10),
(224, 5, '8715316072581', 10),
(225, 5, '8715316075766', 10),
(226, 5, '8715316075803', 10),
(227, 5, '8715316150210', 10),
(228, 5, '8715316150562', 10),
(229, 5, '8715316021978', 5),
(230, 5, '8715316137013', 10),
(231, 5, '8715316060403', 10),
(232, 5, '8715316044397', 10),
(233, 5, '8715316044458', 10),
(234, 5, '8715316044922', 10),
(235, 5, '8715316074790', 10),
(236, 5, '8715316147562', 10),
(237, 5, '8715316093500', 10),
(238, 5, '8715316150074', 10),
(239, 5, '8715316021978', 5),
(240, 5, '8715316047176', 10),
(241, 5, '8715316044427', 10),
(242, 5, '8715316044885', 10),
(243, 5, '8715316044922', 10),
(244, 5, '8715316044540', 10),
(245, 5, '8715316074783', 10),
(246, 5, '8715316075766', 10),
(247, 5, '8715316146282', 10),
(248, 5, '8715316150487', 10),
(249, 5, '8715316104275', 10),
(250, 5, '8715316021978', 10),
(251, 5, '8715316020476', 10),
(252, 5, '8715316060403', 10),
(253, 5, '8715316060410', 10),
(254, 5, '8715316073731', 10),
(255, 5, '8715316044458', 10),
(256, 5, '8715316147562', 10),
(257, 5, '8715316150265', 10),
(258, 5, '7340093606387', 80),
(259, 5, '8715316136139', 10),
(260, 5, '8715316091612', 10),
(261, 5, '8715316023262', 10),
(262, 5, '8715316047176', 10),
(263, 5, '8715316073748', 10),
(264, 5, '8715316044885', 10),
(265, 5, '8715316074929', 10),
(266, 5, '8715316093500', 10),
(267, 5, '8715316150487', 10),
(268, 5, '8715316150524', 10),
(269, 5, '8715316136115', 10),
(270, 5, '8715316020322', 10),
(271, 5, '8715316060403', 10),
(272, 5, '8715316060410', 10),
(273, 5, '8715316044397', 10),
(274, 5, '8715316044427', 10),
(275, 5, '8715316044458', 10),
(276, 5, '8715316044922', 10),
(277, 5, '8715316075766', 10),
(278, 5, '8715316150210', 10),
(279, 5, '8715316020476', 10),
(280, 5, '8715316073748', 10),
(281, 5, '8715316044397', 10),
(282, 5, '8715316044540', 10),
(283, 5, '8715316074783', 10),
(284, 5, '8715316074790', 20),
(285, 5, '8715316075803', 10),
(286, 5, '8715316150210', 10),
(287, 5, '8715316150524', 10),
(288, 5, '8715316106613', 20),
(289, 5, '8715316106620', 10),
(290, 5, '8715316104275', 4),
(291, 5, '8715316104299', 5),
(292, 5, '8715316104787', 4),
(293, 5, '8715316104381', 5),
(294, 5, '8715316137358', 5),
(295, 5, '8715316137365', 4),
(296, 5, '8715316044922', 9),
(297, 5, '8715316147562', 4),
(298, 5, '8715316153792', 3),
(299, 5, '8715316153853', 10),
(300, 5, '8715316153983', 4),
(301, 5, '8715316154133', 7),
(302, 5, '8715316154195', 5),
(303, 5, '8715316154287', 15),
(304, 5, '8715316104268', 8),
(305, 5, '8715316104275', 9),
(306, 5, '8715316104282', 5),
(307, 5, '8715316104299', 5),
(308, 5, '8715316104763', 5),
(309, 5, '8715316104381', 4),
(310, 5, '8715316104398', 9),
(311, 5, '8715316143403', 2),
(312, 5, '8715316104978', 5),
(313, 5, '8715316136887', 5),
(314, 5, '8715316137006', 9),
(315, 5, '8715316137341', 5),
(316, 5, '8715316060410', 5),
(317, 5, '8715316150265', 5),
(318, 5, '8715316150487', 8),
(319, 5, '8715316076237', 5),
(320, 5, '8715316076244', 5),
(321, 5, '8715316076251', 4),
(322, 5, '8715316076442', 5),
(323, 5, '8715316143311', 2),
(324, 5, '8715316104756', 5),
(325, 5, '8715316104763', 8),
(326, 5, '8715316104770', 1),
(327, 5, '8715316076558', 5),
(328, 5, '8715316104374', 8),
(329, 5, '8715316091612', 9),
(330, 5, '8715316147562', 9),
(331, 5, '8715316150210', 9),
(332, 5, '8715316150524', 9),
(333, 5, '8715316104251', 5),
(334, 5, '8715316104282', 4),
(335, 5, '8715316104381', 14),
(336, 5, '8715316104398', 9),
(337, 5, '8715316136887', 5),
(338, 5, '8715316137921', 9),
(339, 5, '8715316137334', 5),
(340, 5, '8715316060397', 5),
(341, 5, '8715316073731', 5),
(342, 5, '8715316073991', 5),
(343, 5, '8715316145865', 5),
(344, 5, '8715316093487', 9),
(345, 5, '8715316150418', 5),
(346, 5, '8715316150500', 9),
(347, 5, '8715316104756', 5),
(348, 5, '8715316104763', 4),
(349, 5, '8715316104770', 10),
(350, 5, '8715316104794', 13),
(351, 5, '8715316076565', 3),
(352, 5, '8715316060434', 5),
(353, 5, '8715316075322', 9),
(354, 5, '8715316072543', 4),
(355, 5, '8715316154638', 1),
(356, 5, '8715316154157', 1),
(357, 5, '8715316154331', 1),
(358, 5, '8715316150340', 5),
(359, 5, '8715316150487', 9),
(360, 5, '8715316150494', 9),
(361, 5, '8715316150500', 9),
(362, 5, '8715316076268', 5),
(363, 5, '8715316076275', 5),
(364, 5, '8715316076435', 5),
(365, 5, '8715316076466', 3),
(366, 5, '8715316076473', 5),
(367, 5, '8715316104763', 5),
(368, 5, '8715316104770', 7),
(369, 5, '8715316076534', 5),
(370, 5, '8715316076572', 5),
(371, 5, '8715316143410', 10),
(372, 5, '8715316021947', 1),
(373, 5, '8715316136894', 5),
(374, 5, '8715316137785', 8),
(375, 5, '8715316137341', 5),
(376, 5, '8715316091674', 3),
(377, 5, '8715316040528', 1),
(378, 5, '8715316047213', 1),
(379, 5, '8715316119859', 1),
(380, 5, '8715316073779', 1),
(381, 5, '8715316044434', 1),
(382, 5, '8715316044571', 1),
(383, 5, '8715316045035', 1),
(384, 5, '8715316072543', 5),
(385, 5, '8715316075780', 1),
(386, 5, '8715316093500', 2),
(387, 5, '8715316150500', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderNummer` int NOT NULL,
  `KlantID` int NOT NULL,
  `Datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderNummer`, `KlantID`, `Datum`) VALUES
(4, 2, '2024-03-07 13:26:59'),
(5, 1, '2024-03-07 13:28:48'),
(6, 1, '2024-03-08 08:34:48');

-- --------------------------------------------------------

--
-- Table structure for table `vooraad`
--

CREATE TABLE `vooraad` (
  `Barcode` bigint NOT NULL,
  `Aantal` bigint NOT NULL,
  `ArtikelOmschrijving` varchar(255) NOT NULL,
  `Maat` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `klanten`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (`KlantID`);

--
-- Indexes for table `orderline`
--
ALTER TABLE `orderline`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `orders` (`OrderNummer`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderNummer`);

--
-- Indexes for table `vooraad`
--
ALTER TABLE `vooraad`
  ADD PRIMARY KEY (`Barcode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `klanten`
--
ALTER TABLE `klanten`
  MODIFY `KlantID` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orderline`
--
ALTER TABLE `orderline`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=388;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderNummer` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;