-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 01, 2024 at 02:00 PM
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
-- Database: `usego`
--

-- --------------------------------------------------------

--
-- Table structure for table `ug_archive`
--

CREATE TABLE `ug_archive` (
  `id` int NOT NULL,
  `userId` int DEFAULT NULL,
  `idPost` int NOT NULL,
  `createAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ug_archive`
--

INSERT INTO `ug_archive` (`id`, `userId`, `idPost`, `createAt`) VALUES
(11, NULL, 88, '2024-02-23 15:09:04'),
(22, NULL, 92, '2024-02-26 21:30:27'),
(23, NULL, 91, '2024-02-26 21:30:32'),
(27, NULL, 90, '2024-02-26 21:32:42'),
(57, 26, 79, '2024-03-07 14:31:26'),
(58, NULL, 85, '2024-03-09 23:07:18'),
(59, NULL, 93, '2024-03-10 11:39:41'),
(60, NULL, 97, '2024-03-12 23:26:23'),
(61, NULL, 97, '2024-03-12 23:26:53'),
(62, NULL, 97, '2024-03-12 23:28:38'),
(63, NULL, 97, '2024-03-12 23:29:27'),
(64, NULL, 97, '2024-03-12 23:29:46'),
(65, NULL, 97, '2024-03-12 23:31:36'),
(66, NULL, 97, '2024-03-12 23:32:52'),
(67, NULL, 97, '2024-03-12 23:34:03'),
(68, NULL, 97, '2024-03-12 23:35:16'),
(69, NULL, 97, '2024-03-12 23:36:19'),
(70, NULL, 97, '2024-03-12 23:37:14'),
(71, NULL, 97, '2024-03-12 23:38:43'),
(72, NULL, 97, '2024-03-12 23:39:07'),
(73, NULL, 97, '2024-03-12 23:40:40'),
(74, NULL, 97, '2024-03-12 23:53:09'),
(75, NULL, 97, '2024-03-12 23:55:02'),
(76, NULL, 97, '2024-03-12 23:56:43'),
(77, NULL, 97, '2024-03-12 23:56:43'),
(78, NULL, 97, '2024-03-13 07:43:18'),
(79, NULL, 97, '2024-03-13 07:44:32'),
(80, NULL, 97, '2024-03-13 07:45:03'),
(81, NULL, 97, '2024-03-13 07:45:30'),
(82, NULL, 90, '2024-03-13 07:45:48'),
(83, NULL, 90, '2024-03-13 07:51:05'),
(84, NULL, 90, '2024-03-13 07:51:35'),
(85, NULL, 90, '2024-03-13 07:52:54'),
(86, NULL, 90, '2024-03-13 07:53:23'),
(87, NULL, 90, '2024-03-13 07:53:48'),
(88, NULL, 90, '2024-03-13 07:54:07'),
(89, NULL, 90, '2024-03-13 07:56:44'),
(90, NULL, 90, '2024-03-13 07:57:07'),
(91, NULL, 90, '2024-03-13 07:58:37'),
(92, NULL, 90, '2024-03-13 07:59:24'),
(93, NULL, 90, '2024-03-13 08:01:28'),
(94, NULL, 90, '2024-03-13 08:19:28'),
(95, NULL, 90, '2024-03-13 08:19:30'),
(96, NULL, 90, '2024-03-13 08:19:32'),
(97, NULL, 90, '2024-03-13 08:21:31'),
(98, NULL, 90, '2024-03-13 08:22:16'),
(99, NULL, 90, '2024-03-13 08:23:23'),
(100, NULL, 91, '2024-03-13 08:23:33'),
(101, NULL, 90, '2024-03-13 08:23:48'),
(102, NULL, 90, '2024-03-13 09:09:06'),
(103, NULL, 94, '2024-03-14 14:43:18'),
(104, NULL, 94, '2024-03-14 14:43:21'),
(105, NULL, 94, '2024-03-14 14:43:31'),
(106, NULL, 94, '2024-03-14 14:46:33'),
(107, NULL, 94, '2024-03-14 14:46:48'),
(108, NULL, 87, '2024-03-14 14:59:09'),
(109, NULL, 94, '2024-03-15 20:24:55'),
(110, NULL, 96, '2024-03-16 13:33:23'),
(111, NULL, 94, '2024-03-16 13:35:53'),
(112, NULL, 85, '2024-03-16 13:36:32'),
(113, NULL, 92, '2024-03-16 21:44:18'),
(114, NULL, 92, '2024-03-16 23:27:44'),
(115, NULL, 92, '2024-03-16 23:27:55'),
(116, NULL, 92, '2024-03-16 23:28:03'),
(117, NULL, 92, '2024-03-16 23:28:21'),
(118, NULL, 95, '2024-03-16 23:44:55'),
(119, NULL, 95, '2024-03-16 23:45:03'),
(120, NULL, 74, '2024-03-16 23:45:17'),
(121, NULL, 74, '2024-03-16 23:45:32'),
(122, NULL, 95, '2024-03-16 23:45:44'),
(123, NULL, 94, '2024-03-16 23:49:57'),
(124, NULL, 94, '2024-03-16 23:59:24'),
(125, NULL, 94, '2024-03-17 00:18:42'),
(126, NULL, 94, '2024-03-17 20:13:45'),
(127, NULL, 94, '2024-03-17 20:19:39'),
(128, NULL, 94, '2024-03-17 20:24:34'),
(129, NULL, 94, '2024-03-17 20:45:08'),
(130, NULL, 94, '2024-03-17 20:46:05'),
(131, NULL, 94, '2024-03-17 20:46:30'),
(132, NULL, 94, '2024-03-17 20:46:57'),
(133, NULL, 90, '2024-03-17 20:48:52'),
(134, NULL, 91, '2024-03-21 23:27:13'),
(135, 9, 77, '2024-03-21 23:29:15'),
(136, NULL, 92, '2024-03-22 03:52:42'),
(137, NULL, 94, '2024-03-24 09:27:57'),
(138, NULL, 90, '2024-03-24 12:49:58'),
(139, NULL, 94, '2024-03-29 11:22:31'),
(140, NULL, 74, '2024-03-29 14:54:26'),
(141, NULL, 95, '2024-03-29 21:37:52'),
(142, NULL, 96, '2024-04-05 23:23:34'),
(143, NULL, 90, '2024-05-03 22:45:18'),
(144, NULL, 92, '2024-05-03 22:47:25'),
(145, NULL, 95, '2024-05-03 22:47:29'),
(146, 8, 85, '2024-05-05 15:16:05'),
(147, NULL, 91, '2024-05-05 15:19:25'),
(148, 30, 96, '2024-05-06 14:08:54'),
(149, 30, 96, '2024-05-06 14:08:56'),
(150, 30, 96, '2024-05-06 14:08:56'),
(151, 30, 96, '2024-05-06 14:08:56'),
(152, 30, 96, '2024-05-06 14:08:56'),
(153, 30, 96, '2024-05-06 14:08:56'),
(154, 30, 96, '2024-05-06 14:09:04'),
(155, 30, 96, '2024-05-06 14:09:13'),
(156, 30, 96, '2024-05-06 14:09:13'),
(157, NULL, 77, '2024-06-02 16:44:05'),
(158, NULL, 95, '2024-07-13 21:59:35'),
(159, NULL, 95, '2024-07-13 21:59:38'),
(160, NULL, 97, '2024-07-13 21:59:46'),
(161, NULL, 97, '2024-07-13 22:00:00'),
(162, NULL, 83, '2024-07-13 22:00:14'),
(163, 8, 92, '2024-08-18 20:42:33'),
(164, NULL, 97, '2024-08-19 20:26:31'),
(165, NULL, 89, '2024-08-23 12:25:37'),
(166, NULL, 93, '2024-08-23 12:27:29'),
(167, NULL, 96, '2024-08-26 23:52:16'),
(168, 8, 85, '2024-09-01 22:08:48'),
(169, NULL, 89, '2024-09-02 11:32:17'),
(170, NULL, 90, '2024-09-08 01:25:08'),
(171, NULL, 92, '2024-09-08 18:18:00'),
(172, NULL, 96, '2024-09-08 18:20:57'),
(173, NULL, 95, '2024-09-08 18:21:00'),
(174, 8, 93, '2024-09-21 21:57:00'),
(175, 8, 93, '2024-09-21 21:57:13'),
(176, 8, 93, '2024-09-21 21:57:21'),
(177, 28, 94, '2024-09-22 14:44:07'),
(178, 7, 97, '2024-09-30 07:35:55'),
(179, 8, 93, '2024-10-02 14:52:13'),
(180, 8, 85, '2024-10-13 10:01:14'),
(181, 8, 85, '2024-10-13 10:01:39'),
(182, 8, 85, '2024-10-13 10:01:40'),
(183, 8, 85, '2024-10-13 10:01:47'),
(184, 8, 85, '2024-10-13 10:02:16'),
(185, 8, 85, '2024-10-13 10:02:46'),
(186, 8, 97, '2024-10-13 10:17:57'),
(187, 8, 97, '2024-10-13 10:19:08'),
(188, 8, 97, '2024-10-13 10:20:44'),
(189, 8, 97, '2024-10-13 10:20:48'),
(190, 8, 97, '2024-10-13 10:21:13'),
(191, 7, 95, '2024-10-14 00:55:36'),
(192, 7, 95, '2024-10-14 00:55:39'),
(193, 7, 95, '2024-10-14 00:55:40'),
(194, 7, 95, '2024-10-14 00:55:40'),
(195, 7, 85, '2024-10-14 00:56:06'),
(196, 7, 96, '2024-10-30 15:56:46');

-- --------------------------------------------------------

--
-- Table structure for table `ug_collection_post`
--

CREATE TABLE `ug_collection_post` (
  `id` int NOT NULL,
  `userId` int NOT NULL,
  `id_onwser` int NOT NULL,
  `createAt` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ug_collection_post`
--

INSERT INTO `ug_collection_post` (`id`, `userId`, `id_onwser`, `createAt`) VALUES
(50, 28, 94, '2024-02-28 22:07:34'),
(54, 28, 96, '2024-02-28 22:27:07'),
(55, 28, 95, '2024-02-28 22:27:27'),
(56, 28, 86, '2024-02-28 22:31:48'),
(57, 28, 75, '2024-02-28 22:35:05'),
(330, 9, 77, '2024-03-21 23:29:20'),
(361, 27, 91, '2024-05-05 15:19:23'),
(378, 28, 74, '2024-09-22 16:13:07'),
(380, 8, 93, '2024-10-02 13:30:46'),
(437, 8, 79, '2024-10-10 17:57:02'),
(442, 8, 97, '2024-10-12 14:51:44'),
(447, 8, 77, '2024-10-20 22:10:41'),
(450, 7, 96, '2024-10-26 23:28:40'),
(455, 7, 97, '2024-11-01 14:56:39');

-- --------------------------------------------------------

--
-- Table structure for table `ug_comment`
--

CREATE TABLE `ug_comment` (
  `id_cmt` int NOT NULL,
  `userId` int DEFAULT NULL,
  `idPost` int DEFAULT NULL,
  `content` text,
  `createAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ug_comment`
--

INSERT INTO `ug_comment` (`id_cmt`, `userId`, `idPost`, `content`, `createAt`) VALUES
(630, 7, 87, 'Cho mình hỏi bạn mất bao lâu để làm nội dung này ?', '2024-03-05 13:47:27'),
(637, 26, 96, 'Hello', '2024-03-07 11:52:16'),
(641, 8, 90, 'Tôi là admin trang, tôi đánh giá cao nội dung này của bạn<br />\nHãy tiếp tục phát huy nó', '2024-03-08 15:55:08'),
(648, 8, 89, 'Tuyệt với, phát huy nhé !', '2024-03-09 16:54:31'),
(651, 8, 91, 'Hello', '2024-03-10 13:45:11'),
(663, 8, 79, 'Nếu đổi màu đen thành gradient có lẽ sẽ tuyệt với hơn nữa !', '2024-03-11 20:31:20'),
(730, 27, 73, 'UseGo', '2024-03-16 11:58:18'),
(736, 9, 77, 'Xin chào', '2024-03-21 23:29:45'),
(759, 30, 96, 'ncc', '2024-05-06 14:08:42'),
(760, 8, 97, 'Hello', '2024-08-19 20:25:02'),
(762, 8, 95, 'Hello', '2024-08-27 14:26:38'),
(763, 8, 93, 'Xin chào', '2024-10-02 13:30:56'),
(765, 9, 96, 'Hello', '2024-10-20 21:53:29'),
(766, 8, 92, 'Hello', '2024-10-21 08:02:29');

-- --------------------------------------------------------

--
-- Table structure for table `ug_follow`
--

CREATE TABLE `ug_follow` (
  `id` int NOT NULL,
  `userId` int NOT NULL,
  `id_onswer` int NOT NULL,
  `createAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ug_follow`
--

INSERT INTO `ug_follow` (`id`, `userId`, `id_onswer`, `createAt`) VALUES
(479, 26, 9, '2024-03-15 18:01:26'),
(480, 26, 7, '2024-03-15 18:09:17'),
(519, 9, 27, '2024-03-21 23:28:23'),
(605, 9, 8, '2024-05-04 17:50:27'),
(607, 27, 8, '2024-05-05 10:01:06'),
(617, 8, 28, '2024-08-19 17:52:26'),
(628, 28, 27, '2024-09-22 16:43:09'),
(629, 8, 26, '2024-10-09 12:24:26'),
(633, 8, 7, '2024-10-15 13:06:40'),
(634, 7, 9, '2024-10-16 14:06:21'),
(635, 8, 27, '2024-10-16 14:14:21'),
(636, 8, 9, '2024-10-20 21:51:20'),
(639, 7, 8, '2024-10-27 21:27:39'),
(640, 7, 28, '2024-10-27 21:31:30'),
(643, 7, 27, '2024-11-01 14:56:29');

-- --------------------------------------------------------

--
-- Table structure for table `ug_like_post`
--

CREATE TABLE `ug_like_post` (
  `id` int NOT NULL,
  `userId` int NOT NULL,
  `id_onwser` int NOT NULL,
  `createAt` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ug_like_post`
--

INSERT INTO `ug_like_post` (`id`, `userId`, `id_onwser`, `createAt`) VALUES
(49, 7, 87, '2024-01-27 15:27:32'),
(57, 7, 88, '2024-01-31 00:00:59'),
(60, 7, 89, '2024-01-31 21:45:18'),
(71, 7, 77, '2024-02-08 23:38:04'),
(72, 7, 81, '2024-02-08 23:38:28'),
(76, 8, 80, '2024-02-21 16:15:29'),
(81, 8, 83, '2024-02-21 22:44:30'),
(85, 9, 76, '2024-02-26 22:32:28'),
(86, 9, 79, '2024-02-26 22:34:07'),
(91, 27, 92, '2024-02-28 17:26:10'),
(92, 27, 89, '2024-02-28 17:27:04'),
(93, 27, 94, '2024-02-28 20:18:48'),
(94, 27, 95, '2024-02-28 20:31:39'),
(106, 28, 94, '2024-02-28 22:07:33'),
(110, 28, 95, '2024-02-28 22:27:28'),
(111, 28, 86, '2024-02-28 22:31:48'),
(112, 28, 75, '2024-02-28 22:35:05'),
(116, 28, 96, '2024-02-28 22:35:23'),
(117, 26, 92, '2024-02-29 11:51:38'),
(118, 26, 89, '2024-02-29 11:51:53'),
(120, 26, 97, '2024-02-29 11:52:00'),
(121, 26, 79, '2024-02-29 11:52:14'),
(122, 26, 87, '2024-02-29 11:56:48'),
(243, 7, 91, '2024-02-29 17:13:16'),
(262, 8, 81, '2024-03-03 19:34:03'),
(264, 9, 90, '2024-03-05 13:55:42'),
(277, 9, 96, '2024-03-05 17:58:00'),
(282, 26, 95, '2024-03-07 13:35:29'),
(283, 26, 75, '2024-03-07 16:16:06'),
(284, 26, 73, '2024-03-07 18:52:46'),
(367, 8, 82, '2024-03-17 23:53:52'),
(369, 9, 91, '2024-03-21 23:28:16'),
(370, 9, 77, '2024-03-21 23:29:20'),
(375, 7, 76, '2024-03-23 23:00:28'),
(389, 8, 76, '2024-03-29 21:51:10'),
(391, 7, 80, '2024-04-11 09:42:31'),
(393, 9, 88, '2024-05-04 17:51:31'),
(394, 27, 91, '2024-05-05 15:19:23'),
(400, 8, 74, '2024-08-19 17:49:14'),
(404, 28, 74, '2024-09-22 16:13:08'),
(438, 8, 88, '2024-10-09 12:09:12'),
(462, 8, 97, '2024-10-12 14:51:45'),
(472, 8, 77, '2024-10-20 22:10:42'),
(474, 7, 96, '2024-10-26 23:28:40'),
(476, 7, 85, '2024-10-30 11:45:39'),
(479, 7, 97, '2024-11-01 14:56:42');

-- --------------------------------------------------------

--
-- Table structure for table `ug_login_token`
--

CREATE TABLE `ug_login_token` (
  `id` int NOT NULL,
  `userId` int DEFAULT NULL,
  `tokenLogin` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `createAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ug_login_token`
--

INSERT INTO `ug_login_token` (`id`, `userId`, `tokenLogin`, `createAt`) VALUES
(158, 30, '287b51501c97c5df84ea72e9479241219086a6b8', NULL),
(257, 27, '0a08d665da45f2ec928c90eec496708c929607f9', NULL),
(258, 7, 'f0adccf8fb59d58c9cc3dd85a6fc9f80a9ab03de', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ug_new_feeds`
--

CREATE TABLE `ug_new_feeds` (
  `id` int NOT NULL,
  `userId` int NOT NULL,
  `topic` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `hot` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `images` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `view` int NOT NULL DEFAULT '0',
  `hide` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'true',
  `status` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token_trade` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `createAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ug_new_feeds`
--

INSERT INTO `ug_new_feeds` (`id`, `userId`, `topic`, `hot`, `title`, `content`, `images`, `view`, `hide`, `status`, `token_trade`, `createAt`) VALUES
(86, 7, 'service', '', '1234567', '<p>`123456</p>', 'service_common_mid.png', 41, 'true', 'XN', 'UGO77D9BE774DBEC7', '2024-10-26 19:44:15'),
(87, 7, 'service', '', '1234567123456789', '<p>`123456</p>', 'service_common_mid.png', 163, 'true', 'XN', 'UGO79268C5E5BDBA7', '2024-10-26 19:44:17'),
(88, 7, 'post', '', '123456789', '<p>1234569</p>', 'post_common_mid.png', 19, 'true', NULL, '', '2024-10-27 11:18:55'),
(89, 7, 'service', '', '123456789p', '<p>1234567890</p>', 'service_common_mid.png', 10, 'false', NULL, 'UGO7BF73C52F74BE7', '2024-10-27 11:26:40');

-- --------------------------------------------------------

--
-- Table structure for table `ug_power_point`
--

CREATE TABLE `ug_power_point` (
  `id` int NOT NULL,
  `userId` int NOT NULL DEFAULT '0',
  `title` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `tags` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `images` text,
  `fileDownload` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `view` int NOT NULL DEFAULT '0',
  `createAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ug_power_point`
--

INSERT INTO `ug_power_point` (`id`, `userId`, `title`, `tags`, `images`, `fileDownload`, `view`, `createAt`) VALUES
(73, 26, 'Công nghệ Internet di động \"Kỷ nguyên ánh sáng 5G\"', 'Công nghệ ||,Thông tin ||,5G ||', 'usego_Slide108b71a0182bf0f8fd4218ed213eae2bb60b74008.PNG||usego_Slide22fa3f455a6e721b8aef9148c59726379b37b8307.PNG||usego_Slide3a4027c95f2c2ffa5e85103f54435b6b9e9c7627c.PNG||usego_Slide406eecf25eaed189155ab50b2c5fe0db107d16afb.PNG||usego_Slide560770eaa2441c5b45857cf792ef2cadd8e2a7910.PNG||usego_Slide6902d246ef9aa1052079201066ec98070fdc66447.PNG||usego_Slide73916553a7d28adf97bf60f67916148b60ad6d5c0.PNG||usego_Slide89e4cbe4b6d9127270c7d458e8f5ba05e2c07833d.PNG||usego_Slide9a731600f319209481193ae6b22dc71a33fa0d59d.PNG||usego_Slide10d8c8022a6f340bbf45cce35bdcfcf2421e9d15ad.PNG||usego_Slide1130d8737c81c5b0d06305846eb2dcf84d3c36ca87.PNG||usego_Slide12df5f536c26afbfd33ef2052d3ef7ad95b6a93ed7.PNG||usego_Slide13259d89df2b0e89f95bfc4513448a11665fa5ec8a.PNG||usego_Slide144ad77f467dfd2c1203648442073422af679a0a6f.PNG||usego_Slide15ff23232b9ad9355d2563a6b3b9005157d360cf87.PNG||usego_Slide16978382c3e0d1a3b7a40d05f44466b08ab3eb9950.PNG||usego_Slide17fcb02004b47a2bf9358197577d679faf9ea40dfe.PNG||usego_Slide18a228e99b5543c528033ca4be211984fac2abd323.PNG||usego_Slide192e3873d6618ebb22b917a662cff000d6c4eb257d.PNG', 'usego_5G1e18c28bbeaf7072a0182d7f87e65b93a33ef6e5.pptx', 1, '2024-01-16 13:40:21'),
(74, 7, 'Xanh dương và xanh lá cây tương phản hình học tối giản ', 'Hình học ||,Xanh dương ||,Hiện đại ||', 'usego_Slide1270cb29195f832fc6c3d1a19878575da192c3ca4.PNG||usego_Slide275f2680d335005f7bbc503bfa6004c99bbfee130.PNG||usego_Slide39165aadf058d0e550fbbceefc4a0c5fbba64e723.PNG||usego_Slide49e4eb071a20a5e76d61fb82e8a01ca87efdbf13e.PNG||usego_Slide59132c6d3d7a75413502e1230170ef3bfd5c30be5.PNG||usego_Slide6de320469eeb2eab78a97f6010ffff374ae438213.PNG||usego_Slide7e2e085550f729055dbd9b970d0fc4c4831d96e5e.PNG||usego_Slide8a2d1308a71d25139bbadb51126784dc72f06bc2c.PNG||usego_Slide9026852ecf5cc52058d72e2cad0087e8e2ef20d3f.PNG||usego_Slide10043a1fd53415ab363a6d1713f29fc248f2868f16.PNG||usego_Slide11ac774fb1fb67592afbd754b063931e7fbd33602f.PNG||usego_Slide126987c2d3b410be7509f4616cbf218eed43fb8dc8.PNG||usego_Slide131b525c686b2b5364991bb9e177faf7fb806f3871.PNG||usego_Slide145add80830fe34ecd5294a85803d329973ca0983a.PNG||usego_Slide15a04f6e677babada0aa146d57ac37cfa3cd2e6257.PNG||usego_Slide164dc6eca85f61a0740abe88998a248a737af5079b.PNG||usego_Slide17b9b737b2d36a1166e615c5a023320f68fce00b59.PNG||usego_Slide18c8d5f8a467fe6b51a280f77f5c80f207c3a16cfc.PNG||usego_Slide193b614e60fa644c464f22b5289a01cc099c698d44.PNG', 'usego_蓝绿撞色极简几何风年终工作汇报ppt模板d3126465f9d3918e3544396031778e296c43e049.pptx', 4, '2024-01-17 08:06:02'),
(75, 7, 'Lập kế hoạch sự kiện ngắn gọn và lễ hội ngày đầu năm mới', 'Tết nguyên đán ||,Năm mới ||,Rồng ||', 'usego_Slide1425788fc0d15c6718db2adddc00500f913f5788b.PNG||usego_Slide28836fa71c0abdb2f03991d0b3fa1cb1a9d103959.PNG||usego_Slide379f38d059e43218a06f5567d58258de44b7233b1.PNG||usego_Slide4d79a8fde5e5b6a89b51758deec1bcb0ef1db8f52.PNG||usego_Slide5eec5088469516704772f6d33a4a5314133d2acda.PNG||usego_Slide614cba6597c30835fe35349f1dfb557d35818f149.PNG||usego_Slide771032dd114fd6ccb076195ef357ad48458872bfa.PNG||usego_Slide8600d0e455ba892fe5d8761051c7f6940e98cd5e9.PNG||usego_Slide94f40f542a20cfb62c04492b88b7f611d23edfa05.PNG||usego_Slide10153a848a41fb4890964ad9f381541beea0e7cdcc.PNG||usego_Slide1186abfa5bdc34726609659581740e3706d12e92ea.PNG||usego_Slide129d0ba5d6b58b471862660d2db08f187702e6baf9.PNG||usego_Slide13ce42bf255041b7b077b751124665bd8e18f24536.PNG||usego_Slide14d2ed0c12c80074c7ba4bb6b12d5ad5fb64696039.PNG||usego_Slide156f18ecf59afd87e1313a5c24760b23d279ed396e.PNG||usego_Slide16438b1342a5f9e5ef8c9aeb4d22bb973d3f98645e.PNG||usego_Slide177afc0fd44c8df04ea51452acc07aef67b015c782.PNG||usego_Slide181b5899e82d0981afb4c0e421f9f3b8b45d169c0c.PNG||usego_Slide1960d99d71c809d321b4c2128dc02e3ae502eb212c.PNG', 'usego_简洁喜庆风龙年元旦活动策划ppt模板06cb19de0995d565cb0018be35be3b5dcbd11f68.pptx', 6, '2024-01-17 08:11:09'),
(76, 9, 'Mẫu dự án doanh nghiệp thiết kế hình học màu xanh và tím', 'Báo cáo ||,Hình học ||,Xanh ||,Tím ||', 'usego_Slide10e291386e0b965875fad57225eb1afd5c97b539c.PNG||usego_Slide2ac489ac15d928196601b805fa4cf1f136f49fec2.PNG||usego_Slide3d764abccb1450eaef013a65d15e181d0e0be1b6f.PNG||usego_Slide435b2748dd2ed4e5b0280c2b0bd4a30143aaa5fb5.PNG||usego_Slide5c00e1ba30d77fead7c5d14133d05057b002267b5.PNG||usego_Slide616775f07f7225dd87c55b6085c2cfc65f0ddd357.PNG||usego_Slide7ddd99396db329449b44d6f53bb11f6e7ef9f570e.PNG||usego_Slide8a833cddc64b60197f2aa06ecba6ce82db194e845.PNG||usego_Slide9a163daf579cb9e03a65ea125583334fcb1de9a17.PNG||usego_Slide10761eb74334c3cf953409dbc6d64f0818cbf74a05.PNG||usego_Slide1150f5a84c412103cfae188298f15679eccad480bb.PNG||usego_Slide1270ce272b39c595095349bae60d59a51ebdebb403.PNG||usego_Slide13075303c7f25f1c843c679d60902e6364dc35323f.PNG||usego_Slide14c32b479abd048c5fd941259fbea7935b0c2bc5be.PNG||usego_Slide154f6ea8322ef1c4baf8cacf717485460a0dc27353.PNG||usego_Slide16bb2806961af1f21056ca503499ce9989a685ad71.PNG||usego_Slide176574ef35378d4a9399da1578278e0b3b3cc7be1c.PNG||usego_Slide187eaf5db5438b8ea35a01437bf7ec8416a2c21e8c.PNG||usego_Slide190360aef979732a20e6fde3d59e0b9e796a5cb8f1.PNG', 'usego_蓝紫几何风企业项目汇报ppt模板419d49b65f95e5a39261ec6b6aa1081846e3b7d0.pptx', 1, '2024-01-17 08:28:00'),
(77, 9, ' Phong cách minh họa màu xanh lá cây Báo cáo phỏng vấn cá nhân ', 'Thành tích  ||,Xanh lá  ||,Báo cáo ||', 'usego_Slide1bdc7e66aa00d4e519d348a62246893e01876919f.PNG||usego_Slide27edf6be6d4d762b8df265423b48dd815557f53be.PNG||usego_Slide34bc11fb1ced9eb19fef6cb698671db57464091ff.PNG||usego_Slide463e994fafd89b6c59a89b6ae364e9bb470975201.PNG||usego_Slide537d12b2ad227e36e477a4def19ee5c007bb9acbf.PNG||usego_Slide65a11435ee564bde52f08f562c37251a995d5b04b.PNG||usego_Slide760ab4c255e7db7f5606573afa9351af508afb9f6.PNG||usego_Slide828054950c74d94356efa5cf742f70c2f125a1d59.PNG||usego_Slide90583e92dbaa2cb77dff1706ed9ad49dbd79effef.PNG||usego_Slide109836ecee87f606bcbae30bc6052663d0a3279036.PNG||usego_Slide11eb411a1b2805111bc89c40ee655b2fe5356f693d.PNG||usego_Slide12429af66ce675fde540675f37e5869eb7f39f197c.PNG||usego_Slide139bbeca3b3009fb455c17bff648bb6a9c2a2f5a81.PNG||usego_Slide14a62eb572960cdb4cf5d242529a76bf3a44423e6b.PNG||usego_Slide15a0a9be409aa1ce956926509ef7b9416a4b1cf1cc.PNG||usego_Slide161d3d71e92325216555484e1162ee1c2b32d7612a.PNG||usego_Slide17f1cf0622e9b6202707a59d93f7badff688666089.PNG||usego_Slide1861adaa89995a0b1cbfd6fe974010182d3d6e23f2.PNG||usego_Slide190052f50d1f3f3022258ecc61d3b686cf3083847b.PNG', 'usego_绿色插画风个人述职报告ppt模板312e757ed2e66b253b147510cb806e25cb2f2436.pptx', 16, '2024-01-17 08:39:16'),
(79, 8, 'Chủ đề Pre dành cho Sinh viên Đại học ', 'Hiện đại ||,Công nghệ ||,Thông tin ||', 'usego_Slide1c7e7cfa38592fef6e6c7fa91fd1b12b648b6b805.PNG||usego_Slide225428febc568412c6ed7d19b3ef9820920df4876.PNG||usego_Slide3d0745f13b9080ad6b6176ee01743521ab3b55304.PNG||usego_Slide4b6253371e82138d7791762b7cabfd7dafbab225c.PNG||usego_Slide586b6a8ca679082dfdba0adcbbbcdbf9e2b983dfc.PNG||usego_Slide6988ac5045a36da6670e4abb34b88bb214320a1f9.PNG||usego_Slide7a518a6fab0462468d4691d0b1b99aca47b8efbfd.PNG||usego_Slide850cd0add4f188c11a2602aa6be88847a2922b256.PNG||usego_Slide97f2faf7e6a21091297fabbc070ba373dfb549d77.PNG||usego_Slide115e0dd9bcc06339638be856d0fb8dbf63b0646da4.PNG', 'usego_大学生pre主题ppt模板0fca12b90df19f2774e06f08e43f8c299b75c2a1.pptx', 5, '2024-01-17 09:29:52'),
(80, 8, 'Nhân vật kinh doanh 3D minh họa phong cách báo cáo công việc', 'kinh doanh ||,3D ||,Phong cách ||', 'usego_Slide1ab3961f2bc54b6a7dd53264a0400a7dadc7e6b91.PNG||usego_Slide22bd04d9198f0c27015c8edc5ea3f887729b4d2e8.PNG||usego_Slide329de9bb4e4d50f3afeb2f5b0e21345d9dae63582.PNG||usego_Slide40ecb891949d5b5f10c2d6fd1bbb96f864f1fa4c8.PNG||usego_Slide5daef22cc823906f6360d5e4d1001eb0ced114272.PNG||usego_Slide6d77d1c851b65f21f898c9920e262755c436ade84.PNG||usego_Slide76a64ba5dd5ab03069802f95c8671fa61d5936984.PNG||usego_Slide8692e850559e737aa9702f80870a8454a9aae3fe6.PNG||usego_Slide9fbfadf15d2d69cafe40e436d2d9bea67a376e7d3.PNG||usego_Slide109b3664e664ca1b04e4dba355fc6204b1f06037df.PNG||usego_Slide114916aff93f296b3441b41fdd8678b8103d01060c.PNG||usego_Slide12b452c3954b0ba2cd1d2af2a3d99a421f465b8abd.PNG||usego_Slide13e05265ad3d3cd54b17c20c86a371dc54d34136e8.PNG||usego_Slide14f21cf01247787cf812924b5046931d1f045ee605.PNG||usego_Slide159413c0ade9d297dc8ccaaef8b2d10b8bb567b7ca.PNG', 'usego_3D商务人物插画风工作汇报ppt模板512043dbd7d4c6fb7861677c03642d316ce13a9a.pptx', 2, '2024-01-17 09:33:12'),
(81, 8, 'Kế hoạch phát triển công nghiệp phục hồi nông thôn', 'Nông thôn ||,Công nghiệp ||,Phát triển ||', 'usego_Slide1f2f723ec38eb8f152fa75358ddb15f8a187eef39.png||usego_Slide2737749c505168737f86cd9b9d711d2b9cfe69424.PNG||usego_Slide3aa2bc49681652fa3c6f477d5d932b2ab979bfdae.PNG||usego_Slide545cfd3b750b269ba16584dbb508fb98ec5239e37.PNG||usego_Slide6524cb8f34de962eab8fabfd695cb2d78d08619ee.PNG||usego_Slide7615019cfe50dc595df4fac43a6aa133704b37673.PNG||usego_Slide872e594e010328d76a207aad71dc1eaba7d530694.PNG||usego_Slide928130194fc83a77fc75ff2d4cf8b03e260e77128.PNG||usego_Slide1000be737cea5f2e00fa5fe2558ced6ed9762b3716.PNG||usego_Slide1105a0ff4f1652f391ea46f7d6a33bdf9e71b583b3.PNG||usego_Slide128d8422396fd0389d8ba0d821a7f09d42ecc4e7d1.PNG||usego_Slide13ae9d2041bd831d0a9f3bd6ee11fe657bf33bc4e4.PNG||usego_Slide14f5e064e74275802b68cc1929bb16a5d57b93a213.PNG||usego_Slide15f1e452940ba471b240a2047df3f203d5e937e456.PNG', 'usego_乡村振兴行业发展计划书ppt模板620f5b67dbcc1701cae9caed76487ccf9a45fa79.pptx', 0, '2024-01-17 09:46:51'),
(82, 8, 'Màu hồng dễ thương minh họa phong cách chương trình học trẻ em', 'Dễ thương ||,Trẻ em ||,Hồng ||', 'usego_Slide18116c97920131ce2b55670e30eb329c18ce15a7d.PNG||usego_Slide23be43c8253cafabee3953155ee8a640ec4b02945.PNG||usego_Slide3616121b3ea8ce1058b47d74078657bf1b20f2799.PNG||usego_Slide4b0e9580a8ca30c680ba56c1011121032da31adcb.PNG||usego_Slide5907f607c849d6aec9bf8811b4ba7b262cba8786d.PNG||usego_Slide644babb77e804b255739e8dc168b345855f785820.PNG||usego_Slide7f840c39c4b49290992d40a5d836ff90152fc1767.PNG||usego_Slide853c098c863f2829f3818ad13e15b88c20a93b8e3.PNG||usego_Slide99fc01089806855d663c2b87968aafe13501a61ff.PNG||usego_Slide10f729411362a4b70cc2230f0084238268a07c0d7a.PNG||usego_Slide11c956fa7340a82a76c725c1d97f794ef7f0fc67b1.PNG||usego_Slide12e4bcb724276e941c0e99c339f42c6e70448ca4de.PNG||usego_Slide1368453118fa2835796ac9b8dc4d4398f68e77657e.PNG||usego_Slide14d661e5fd9acf60e03e5b2da114f2a01d5b363186.PNG||usego_Slide15380bdfce70fac99109986ee0b2e5b6e6f84cc513.PNG', 'usego_粉色可爱插画风儿童课件ppt模板d150c6dd091580077e4e553d701c68f3946d3ba5.pptx', 0, '2024-01-17 09:54:17'),
(83, 8, 'Orange Business Wind Company Báo cáo cạnh tranh nội bộ', 'Báo cáo ||,Cam ||', 'usego_Slide1d0fd61fa287508ac9d528923e29e5b78e49cdce3.PNG||usego_Slide2f9e7351da6fbde7f7ed58cce57ed82b7710a2d7b.PNG||usego_Slide38a53fbf2915af8dc1d366864ac34c92302814090.PNG||usego_Slide4cd015c8b19dd912f22627d15e66a630f047726be.PNG||usego_Slide5a95a8db71f21175a6e2c4a5f4082959ee56bbaab.PNG||usego_Slide6caebbffc29ce26f8471c5e9e3a23e005f0a3bbad.PNG||usego_Slide76d88661333f6b1808dd41a5b4ff51cff92bcb1bf.PNG||usego_Slide8db5f38e1ad6a1d3a1bc51aafeeec4bdb4525007e.PNG||usego_Slide930aa65273c15dc66cc2bda4d65c15e9078b9659c.PNG||usego_Slide102f68d42bee7d0b342cb293d908c203e71146ff9c.PNG||usego_Slide11dd52b3611ae452fa7664e5989b0e4244af8fc352.PNG||usego_Slide12f2a000796cee277456af72d49a72f80193878670.PNG||usego_Slide13ff0fb60221fbec4693034d794163dd8bd6799947.PNG||usego_Slide1430a39a4c5572aa58896724051c82991286687a4e.PNG||usego_Slide1530c05cc6887f668c4f2ff62bced920de8a0d4a14.PNG||usego_Slide1672ae597177b6a635d610bc74a1b49395d4752434.PNG||usego_Slide179d925b0eb7f7e97d81c60e385572977a398d4bef.PNG||usego_Slide18ae498ac369409a6fd4bc240a603e8c764de36399.PNG||usego_Slide199352a39b156618b1a34300e4c404ee777f78d932.PNG', 'usego_橙色商务风公司内部竞聘报告ppt模板125a873458bb19106fccc1386f80d8c6a8502db8.pptx', 1, '2024-01-17 10:36:59'),
(85, 8, 'Báo cáo phân tích dữ liệu kiểu minh họa màu xanh lam', 'Báo cáo ||,Xanh lam ||', 'usego_Slide11bd459f5cfa46120ee02eec8767b3385aa729caa.PNG||usego_Slide25dd5fda6d51fce689a866131a2c6cf8034cbdd9e.PNG||usego_Slide3242f425d55212dffad5541e026b00a7eac98b5b3.PNG||usego_Slide473427a2b2522e74b70125ca567d0b156c926e20e.PNG||usego_Slide53ea14f113402edfac24866deb6a1747d276def79.PNG||usego_Slide6aa424b7a1786bc1da3146b0c8b0b3e00de15070f.PNG||usego_Slide775fd67a2c698f889a6f24daf8a204b4a0ad2c7ca.PNG||usego_Slide815b2d0c18c9443418a96958b62dd4fa18a06f8d9.PNG||usego_Slide94cc3f8275eaef28787322e80cdd38b3309df8f84.PNG||usego_Slide109a40affd4b9236e5ced53dff01be8ebd28acc36a.PNG||usego_Slide119511cd471262ff2b0213218eac8bf82b17ad7ac6.PNG||usego_Slide12ca3b92a61468d416b71afd40d3d56944d921eca6.PNG||usego_Slide13e7a71a90b463ae343a409c5cd662f3f02c5e4890.PNG||usego_Slide14873aefeb9c1328674730423cb99d0932b2db1f61.PNG||usego_Slide15d3889f3a0836025a03c96bcf3dd5dcf09f4fb0bf.PNG', 'usego_蓝绿色插画风数据分析报告ppt模板840c6616f6232bd032103f40e6aa9b2569243527.pptx', 19, '2024-01-17 10:45:09'),
(86, 8, 'Kế hoạch quảng bá tiếp thị sản phẩm gradient màu xanh ', 'Quảng bá ||,Sản phẩm ||,Xanh dương ||', 'usego_Slide1233c7719372c547755a66f5e05dcd56fed6ba440.PNG||usego_Slide2ac01735dcaf8054e5b090e37c1bcbe3a5324ad78.PNG||usego_Slide36c9276ef088e45bd4f5bc79bd7435148f6592cf1.PNG||usego_Slide4f00f5cefc2101a41c09f4ec2aa976067c77b759c.PNG||usego_Slide557f7c25fba6688609f0d5e190aec83ba77074cd9.PNG||usego_Slide60e48364d627c187e2319ffa815f217ae7b2b0a57.PNG||usego_Slide777e8c55cb835af4d2def6661b42070286eb974fb.PNG||usego_Slide8cf50e032abe8225950b162121b3d18a422fed26d.PNG||usego_Slide92fdb5c90fd37f5c43c882360f9bf422a5d396aba.PNG||usego_Slide10924ac5603f4226ca90edc761ade19137608df765.PNG||usego_Slide119020a7de50f7db1c26700f6509a83d1e785dd98f.PNG||usego_Slide120540b22988ec453a56dc2c6d62b60884af6609ed.PNG||usego_Slide134c3e2676cbe74ce23aa72c57b3cf3a08984e9e3d.PNG||usego_Slide14fef3bbaa8f8d4719677994e4887ab68cbeeb57ab.PNG||usego_Slide159664755a1280b15e40f442c090395b69afc6f6cf.PNG||usego_Slide16fe4db79f40efaac8d3a3b8651f11ce3d75d1890a.PNG', 'usego_蓝色渐变产品营销推广方案ppt模板699ef80f82547c8892d7cf6a7d964cdb15f9c14d.pptx', 7, '2024-01-17 13:25:08'),
(87, 8, 'Hình học Minh họa, Gió Kỳ thi cuối kỳ Huy động', 'Kỳ thi ||,Trường học ||', 'usego_Slide182775143227ddfbd3a00a118240a184d0bd1015e.PNG||usego_Slide21c516c403f727aaa5a26a1fd05f240fc2608f0c4.PNG||usego_Slide31d5ec88a6b292288f754e558e710ea18b6026174.PNG||usego_Slide4b9460539e9886baf982fe9c33bfc5ebf4713f0ab.PNG||usego_Slide55afc12138d5d8974f327acc6546b98e6d9b92977.PNG||usego_Slide66403bc5242690598c7810a9c272f500a17058f67.PNG||usego_Slide7ad6b43d58e922008499b885949b5f256017921be.PNG||usego_Slide8644be1aca22c6a4b5a57dd0c4cef517be97193e0.PNG||usego_Slide9f578b8963081650d77d5ca5a91d66d6e450c2dd6.PNG||usego_Slide102b5f5917e8caa60ed7c803052a1b0130473dc8f4.PNG||usego_Slide11ad36e514e681fa0c27ae2c66d825b5b63799a7cf.PNG||usego_Slide122aeb261aa61250615da98aa4e85dc3556231961d.PNG||usego_Slide1304794714238ac9fbc08238652771a6c6a8ae0f6a.PNG||usego_Slide14f772c377f2db21b049e6f945d1deef50f09ef946.PNG||usego_Slide15de70101f6bff681b1447fade933d47321d51a5af.PNG||usego_Slide16f4c825ee2090d2c40203c736af6f590e62040b90.PNG||usego_Slide177d667b60c9253f2cd26e01a70259bb3efade1d6d.PNG||usego_Slide189bc8107be69c639f5056ef5c78e93de4c9076e46.PNG||usego_Slide196c7abb6a2ddc665730b32e47444e7a9226876842.PNG', 'usego_流体几何插画风期末考总动员ppt模板927f0c92fcb75c220144d0b1f6dcba5840debcac.pptx', 4, '2024-01-21 01:49:06'),
(88, 7, 'Báo cáo tóm tắt công việc của Rồng Năm Ngọc Ngọc ', 'Rồng ||,Xanh lam ||', 'usego_Slide19f9615b6aad175a147e8bb4e12650d0bdecfb25f.PNG||usego_Slide237cf50409190ae2a8760ccded921c28b65efe7ea.PNG||usego_Slide30966b11cb7407cefddb78ad4c61392614d2c0f1f.PNG||usego_Slide470e16a737aed7d20152cd95c28a99511d6d09374.PNG||usego_Slide52db4f66101c0a09880ecf68a32c0ed08c3e53252.PNG||usego_Slide6676dfa087eb0937cbae86c4f0e3d02b640ac218c.PNG||usego_Slide73e6e2e753648c853fec6fcef30751bfd8ed9c93d.PNG||usego_Slide8acfe08b8a9df43cfb510ebd3d413e9807548507a.PNG||usego_Slide9a40f03b854424c784a9f3c99d528b25cced2ecc6.PNG||usego_Slide10be31a4bc438aa18fc2e1c1726789552145963e9f.PNG||usego_Slide1147d002b32bab745568e774b10948e446db928ea9.PNG||usego_Slide12b1903afd9d3a3c935c1b997d5bf6760f873d20ba.PNG||usego_Slide133a335cedeba4d82ebc8d811ebe5165748bb18021.PNG||usego_Slide14d5e5d5ffbca93637586efbb08632ef19ba713867.PNG||usego_Slide15ff2109e15755679b3f047b800b0e35aa4d36b3d0.PNG||usego_Slide16de3038dcbc95f9077c538cd1e23a447baf0fd10d.PNG||usego_Slide17f2d5df091652dfe9a259197647448c36e7c5382e.PNG||usego_Slide18697ef7ea641b5dcade3e9369eba12323a5089ad9.PNG||usego_Slide199dc32d29199f34ffe43a147e73664505b9f81aed.PNG', 'usego_青绿色年龙工作总结报告ppt模板ddb071d40c28a360a1f7e26ac2b1b4a47ae2abc4.pptx', 9, '2024-01-21 02:00:51'),
(89, 7, 'Bài giảng Kiến thức Lịch sử Thế giới Bài giảng Lịch sử Đại học', 'Kiến thức ||,Lịch sử  ||,Đại học ||', 'usego_Slide1221e68feee3cc56e32efe8601f6eec1769f3c516.PNG||usego_Slide2ef3b59c4c46be93799222a2adc296b86fe742c5e.PNG||usego_Slide32eb7862a6fc07755654a375fd194fee671dd6f9f.PNG||usego_Slide487fc8e3a33ffc391049ea3b7275af65d395fa97a.PNG||usego_Slide5037812322741c14e5efd6e2451a2417210f0ea06.PNG||usego_Slide6a1e9a69228e11c9422526c927391328b516c2973.PNG||usego_Slide748f28431a7abb9f35779013580dfa4453afd3b75.PNG||usego_Slide85e1ce08491f646e848afaa0ee33954f3d7251ec0.PNG||usego_Slide9ebea41cc232d0dd68e23e74b929c5ba3914ba5c7.PNG||usego_Slide10fa5b38a954210f7096cd23ba4d6bc4013e089dd7.PNG||usego_Slide11273c586ca21d3fb5c7e90bdd786e50ec9d68b919.PNG||usego_Slide1230568604dbaee5102dbe0e470a68d126b0f58317.PNG||usego_Slide13ed7fbeedcf2922c6683a052830a6c3bd42ef2a64.PNG||usego_Slide148801f30d7b22e3e3cb498ed35543212028d3b502.PNG||usego_Slide15fc88b2b6c9e6629e59a3d92a33adfab0cc6e1011.PNG||usego_Slide16c3b624a029782901d20ce93cb5bd00f354a7034f.PNG||usego_Slide17fb1cd0e32f534a9d101fa84bf72087d0733e39ba.PNG||usego_Slide18482f0a40105ca44a1b012b7ae7c4afd11cbff037.PNG||usego_Slide192da6ddee87e87110b8bdbc388d538ca78746197f.PNG', 'usego_大学历史学知识讲堂课程PPT模板90fec1d1fd456c2d5cc98c5c295802b0eb164ba8.pptx', 23, '2024-01-21 02:08:48'),
(90, 7, 'Màu xanh lá cây hợp thời trang thời trang minh họa nhân vật gió Mẫu ', 'Xanh lá ||,Màu ||,Minh họa ||', 'usego_Slide1cbeb1f78827239c0ea77707a4baa63fea8411249.PNG||usego_Slide2b487adc18e5e7332ef1e99aab4701e3220856e3c.PNG||usego_Slide3b942278ea02ec8ac7730b8ea8e22c06a2ec97155.PNG||usego_Slide43cf1fa8aa13d69a8e16941e19b0242e0fcea40f3.PNG||usego_Slide5857db188e253689d1c128fa664d3c7c68186796c.PNG||usego_Slide62faa8cdccf7217d8d1a14855f200d042f6d019de.PNG||usego_Slide72da9b67558ace819421a930acb1dde1598813c2d.PNG||usego_Slide808afd50e98622bbe747fad8d494302c31e8bc43f.PNG||usego_Slide9d5863aa96a3d425b6821d1b9e65f3e96b68f7e05.PNG||usego_Slide107cec22bb19db993e517f605615514e1238567727.PNG||usego_Slide11f8dbcf4e0d714b099e6a00f691403e2ffcce9c0b.PNG||usego_Slide12defb20b0c7a47178ce049d436989fd3ea83f3eb4.PNG||usego_Slide13d9c9d72a6a920ed2f0d4922db4f165a0f2d86b09.PNG||usego_Slide1402fbbfb8798d84ad4ca066934749252fe96c1128.PNG', 'usego_绿色潮流时尚人物插画风活动策划ppt模板fc39fbcbaa2b88aec27e35f6a5d07d423b8669b7.pptx', 20, '2024-01-21 03:10:34'),
(91, 7, 'Yếu tố hình học mẫu ppt báo cáo công việc ba chiều vi mô sáng tạo ', 'Báo cáo  ||,Sáng tạo ||', 'usego_Slide120c44685a2e644f29fe74f9fe3c4a73189ad524f.PNG||usego_Slide241dab1a751bbe00a93af82f5be46b1426e6bbe96.PNG||usego_Slide3c0e6c52e2993186935bf1882ca20d407b8247e65.PNG||usego_Slide4c412f4ecf310431d78bbe2337aaab3d41429ba1f.PNG||usego_Slide56c26ebb28e08170fa20367360de8e5848958d35f.PNG||usego_Slide6b7663990855ec34c4e4cfb32b574aa819dd05adc.PNG||usego_Slide74b6cae9c7b40fb486db980f3a478143968a4d402.PNG||usego_Slide8f25d5e76e2df256db131a93206d97008c1082674.PNG||usego_Slide9126e2a729c78d3402b7b5a5e2d55c9870b342be9.PNG||usego_Slide10962bf1d5e78ec1d4b0ab2d05dfe89e58b579346c.PNG||usego_Slide11a64199f8e11abaa34bd4255932ec15f41498fa35.PNG||usego_Slide1282d0c10bf5bd3c1c2d782388beef1aedfd731724.PNG||usego_Slide13e00d33644cae21aeded0aba0fcf6122c53afe63d.PNG||usego_Slide1435b1e4cb14ec0370853af2d5c9983d1d5f3b7e86.PNG||usego_Slide15be4b23e3570a1b1397dbe8bdc207c22bbcda7c6a.PNG||usego_Slide1678483680a8b9c4594d07d54339857f96c47a1a3a.PNG||usego_Slide17476f0e3ab0b20b980069d95e08f0d61179a45c62.PNG||usego_Slide183be0e5692a71422a98e443c09276e97a5070b3e8.PNG||usego_Slide19f133337286134ef56503a6338d94fe05834a5abd.PNG', 'usego_几何元素创意微立体工作汇报ppt模板a3ca363d9fa8919c564b1eb90241f39f12d13001.pptx', 2, '2024-01-21 03:15:43'),
(92, 9, 'Thuyết trình đại học tuyển dụng doanh nghiệp ', 'Doanh nghiệp ||', 'usego_Slide19434b85cec7482224c8a7afe99260b051d236431.PNG||usego_Slide2a7d55759b62444090371d95845841b14489a454a.PNG||usego_Slide3e13fb4f04baa1b095683a655f4702815c834842c.PNG||usego_Slide4688ec5df13ef19100b8264d5e4d345d846f82337.PNG||usego_Slide584059f8507b89772c7e8354926a01378ca915b15.PNG||usego_Slide6978e47c9add80396bc417bd7ed4bf0111132fc88.PNG||usego_Slide72c90deadfb81a49fabae50375bf6ef0d0759aaa6.PNG||usego_Slide82fdb28103c07579e5bb7f712e21b9ad925a34b27.PNG||usego_Slide9c347d34efdca623b65f2fdb97763bc441716acd7.PNG||usego_Slide10ee2a8c18c47f202c3ebeabd26ae3b661e422a5de.PNG||usego_Slide1161c09475374587ea4c323d555461ca188f2cfc50.PNG||usego_Slide12a0beef277360640b5f3bdb28e3bd539691d8e4e3.PNG||usego_Slide135894d51a5442f42f3d6a9aa3f670a8c314461d6a.PNG||usego_Slide1458aa26fee5044cf2e02eedb0b4d5601d5ed3fe2d.PNG||usego_Slide1585204fe66b9f5626aaf901b4958f5b5201269435.PNG||usego_Slide164ce4ba26c266e2247ed748ac8aae5c606c81d8bd.PNG||usego_Slide17301b64563f28728b4199a4f9eed30914435ee32d.PNG', 'usego_企业招聘院校宣讲会ppt模板f78cd3ac5ae7f96ea515f0072541acbd8542fcac.pptx', 57, '2024-01-21 03:28:54'),
(93, 27, 'Chủ đề chuỗi Lễ hội mùa xuân vẽ tay phong cách minh họa mẫu ppt', 'Nghệ thuật  ||,Đỏ  ||', 'usego_Slide1c3a83da93c1902d52a8d33ff337c09cd0c70bebf.PNG||usego_Slide2daa1ac05ca9982261ddb19e4e9f367c39975b317.PNG||usego_Slide32a2b7357c97ffdd64e29bcc657bccbe748a23113.PNG||usego_Slide4ee9ac05949f271bc50ba604646c63bb15f874e09.PNG||usego_Slide503886e8e685c80eb3c87cd86b311c9718e075a60.PNG||usego_Slide6fc2ebf254774b04e9439b4a71f2032bd580fb628.PNG||usego_Slide700267a2eb3c1af61b241cc70aa45df7ff92d85fe.PNG||usego_Slide8aedb7e5c3b65dacec59012614d6211689b1bf88e.PNG', 'usego_春节系列主题手绘插画风ppt模板8a163fb39c25f8eaabf8e525af19a7cac1743254.pptx', 16, '2024-02-28 19:45:08'),
(94, 27, 'Lòng hiếu thảo và sự tôn trọng đối với người cao tuổi, chủ đề lớp họp', 'Xã hội ||,Cam ||', 'usego_Slide12b203605052ddc8842b0a09494d237fccbed3758.PNG||usego_Slide26154b588bae9f623ad8ac98585211db17770effa.PNG||usego_Slide33df5dccc61ef4e918ee78f43826e3d8a696ec6c7.PNG||usego_Slide44df967802f7b180093ba27205fdf0b9b1e371e3e.PNG||usego_Slide5c19a4a795d51e8e60c61f4cb6d331f539d7cdd1f.PNG||usego_Slide6bff657b7bb504106e2d542c1f545356c593cac79.PNG||usego_Slide7c6aaad6c8eda09888ac407d43525fe2c7c3cb020.PNG||usego_Slide88739aa4e384fea90a949429dcb1bb94459aa2f74.PNG||usego_Slide91d7875640d5e019a9ea71078fa7dd1599bb74663.PNG||usego_Slide1028704db08e2d33b33ebc86b60b1f54744d6ec9ad.PNG||usego_Slide11c59db2a012d46505b6aa56acc57a06489f8f1385.PNG||usego_Slide12471566663597066a2ba1d1f8c7fa762a3a6ee7b7.PNG||usego_Slide139b187a5d26fa1318986f40be13243dea4925ff72.PNG||usego_Slide1420c00c401bc4e67947c028c72e01b83fe2b87d00.PNG||usego_Slide15f6121fdeb8186a6f53e56938fac409e1e75bb9e4.PNG||usego_Slide168230c11bad0a5208c87cb9d42049887829b15ff0.PNG||usego_Slide17183119a9acb5c25871ae23a0024159be06618076.PNG||usego_Slide1835e888520533a9ca99db6718864dbf4f0bb0c708.PNG||usego_Slide19cc306c3d5ce84d75021e564c83cff8874c04041c.PNG', 'usego_九九重阳节孝亲敬老主题班会ppt模板db3e648af408e63c82a82f56feee11cb308452cf.pptx', 35, '2024-02-28 20:07:01'),
(95, 27, 'Kế hoạch sự kiện thương hiệu Tết Trung thu thời thượng của Trung Quốc', 'Thương mại ||,Kinh doanh ||,Đỏ đô ||', 'usego_Slide194af468737ae179ce7d031d2ee0c27220d419cc2.PNG||usego_Slide220f37954835e83a7c265ba10db1da6627f180af9.PNG||usego_Slide346e3322fe9b49937429333519f1c8b8af0e614f8.PNG||usego_Slide42c5279f440a1614b692fc17fb0d1874c250d6787.PNG||usego_Slide5274a27a1100b52c2665d7cad2551f3a7b0c843bb.PNG||usego_Slide69cd8bad1b76a95d91364451f200303d455f3ae1e.PNG||usego_Slide7c65dabd72bbb612ac25feba1b6777c4f3e0b6db4.PNG||usego_Slide82e306e519d1df43f0e9286db536fbdc15a5191b1.PNG||usego_Slide9ca860bb2a87b048a88e0700fa1b01fc0d14497fc.PNG||usego_Slide10d81321f7d924fd7e13b644a282be487ff5ea8e79.PNG||usego_Slide115b6dd6c020521c28331630e9c078a3c31f54b538.PNG||usego_Slide126df1758623aab22711a22fc48938f306a0e8d2fc.PNG||usego_Slide13f93309c5836066341cd5df9e8e2701b900e6719b.PNG||usego_Slide14271e778b740ce3fa8137c9f8b2d5f1a94adf1bb5.PNG||usego_Slide159b0a0d9283b4faff36832856f51c9c8b4487f058.PNG||usego_Slide16a6db3bf467f7ec617427979434deee8d3c35799a.PNG||usego_Slide17463811303fe0a4d73d4ee2a0896ffce48ea3b301.PNG||usego_Slide18b76ae24219f90867b522d992309c95ca7393b2dd.PNG||usego_Slide1924331b457ebe9c5d22ecc64c631670af78b4ca4c.PNG', 'usego_新潮中式中秋节品牌活动策划ppt模板8b7838f0ae2881bef3ac8de67a034e0c07b707b8.pptx', 44, '2024-02-28 20:24:00'),
(96, 28, ' Thông gió thẻ dễ thương Chủ đề giấc ngủ lành mạnh', 'Hoạt hình  ||,Giấc ngủ  ||,Xanh đậm ||,Mặt trăng ||', 'usego_Slide18a96288475721c6f98a69ded91db7ab142e416cb.PNG||usego_Slide2054920a3cd1567b50296aaf5173206530ffd2ecb.PNG||usego_Slide3b9704a58ed30349e1f0da70cea7f74408b2239f1.PNG||usego_Slide4102f715f54d381f55a7be5c14bdc755a70b1472f.PNG||usego_Slide57ea26795f57f7b006ddaf9c730aedc529f42f59d.PNG||usego_Slide6739ecff626175fbd662c0455c135a0a21911ee35.PNG||usego_Slide7815c6fba0a1b14fbc3f6a209b8d133be0dd08513.PNG||usego_Slide832ddb9d7443208e2cdd91e2fe78b19922a868bd3.PNG||usego_Slide904eec302a77cfa0f6a3c53518c169ab15ac6957f.PNG||usego_Slide10a98f5467a61cf9b23568880ba54fd072bfe0bf6f.PNG', 'usego_可爱卡通风健康睡眠主题ppt模板fbd5443ea5b0fd9c817d7ca6abdb999744b196ad.pptx', 67, '2024-02-28 22:03:30'),
(97, 26, 'Màu xanh lá cây tự nhiên gió đơn giản giới thiệu nông sản ', 'Nông thôn ||,Xanh ||,Du lịch ||,Xã hội ||', 'usego_Slide1f76c8d3f7d87c3d3c0bfd6239ef8e41fb8c56e00.PNG||usego_Slide287680a847e058ca2814b9ac58f7b4598d1c5cfaf.PNG||usego_Slide35a32608210c4afd9dcd6f3af698ee27164ee34b1.PNG||usego_Slide44ef9b82a4f81c2e5ab3f2b20ff08e9fcb89dfc8a.PNG||usego_Slide5f91e2926aee8c06ee9ad63a3229c4aa13a09319a.PNG||usego_Slide6e59349c3147fcf34d0d1c0d4049cde87e696a6b2.PNG||usego_Slide7da00631b0e9c636387a7eb894cce4f37868e0bbc.PNG||usego_Slide824e57e2f03bf5337962d2f46fbc0f86c4d6c34ef.PNG||usego_Slide9d2dfe82334a48cc1a01d55845919c8dd84aa8fbc.PNG||usego_Slide10d96df3cbb889d098e82f84b2be79c4177ccdb5f9.PNG||usego_Slide111eaf667365a66abb96522e3d5bba0f3715aa58df.PNG||usego_Slide120e47ac2dfde84de84afd717f2c596521d05b4f60.PNG||usego_Slide1306b56221a4f4b70f8b2fd88eb4cdbf1983c4ad09.PNG||usego_Slide140e7e609d647b42a6261a73338484e271f7db006a.PNG||usego_Slide153687bec8450c7654bcba71522959c9906642e2ca.PNG||usego_Slide16fc20f6f2063343e9eb685903f36bd96a99784944.PNG||usego_Slide1741eea9d96335db8728c1b8d55eb2a2c1a56309d6.PNG||usego_Slide18e6bfdcb924fbe5375e6798bd050bc7dcbee4a482.PNG||usego_Slide191a7e787d2bddb36f4b3a9400bcebd5508517181d.PNG', 'usego_自然绿简约风生鲜农产品介绍PPT模板983b0b2114c55eaa55440222dd512809ffa092a3.pptx', 27, '2024-02-29 11:41:50');

-- --------------------------------------------------------

--
-- Table structure for table `ug_respond_comment`
--

CREATE TABLE `ug_respond_comment` (
  `id` int NOT NULL,
  `id_cmt` int DEFAULT NULL,
  `userId` int DEFAULT NULL,
  `idPost` int DEFAULT NULL,
  `content` text,
  `createAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ug_respond_comment`
--

INSERT INTO `ug_respond_comment` (`id`, `id_cmt`, `userId`, `idPost`, `content`, `createAt`) VALUES
(283, 630, 7, 87, 'fdg', '2024-03-05 13:52:05'),
(298, 641, 7, 90, 'oh, Tôi cảm ơn bạn', '2024-03-08 15:55:46'),
(300, 641, 7, 90, 'Tất nhiên rồi', '2024-03-08 15:56:21'),
(316, 663, 8, 79, 'Có lý', '2024-03-11 20:31:31'),
(349, 630, 8, 87, '1 Giờ nhá', '2024-03-15 13:25:10'),
(363, 760, 7, 97, 'Không hay', '2024-08-26 23:47:14'),
(364, 760, 7, 97, 'Chịu m rồi', '2024-08-26 23:47:21'),
(365, 762, 7, 95, 'Xin chao', '2024-08-27 14:27:53'),
(366, 651, 7, 91, 'Xin chào', '2024-09-08 01:04:24'),
(367, 736, 8, 77, 'Ok bạn', '2024-09-14 20:24:10'),
(376, 765, 8, 96, 'Xin chào', '2024-10-20 22:02:45'),
(377, 765, 8, 96, 'gh', '2024-10-20 22:03:59'),
(378, 759, 8, 96, 'f', '2024-10-20 22:04:36'),
(379, 766, 7, 92, 'Xin chào bạn nha', '2024-10-21 08:02:40'),
(384, 766, 7, 92, 'Hello word', '2024-11-01 13:34:37');

-- --------------------------------------------------------

--
-- Table structure for table `ug_save_old_avatars`
--

CREATE TABLE `ug_save_old_avatars` (
  `id` int NOT NULL,
  `userId` int DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `createAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ug_save_old_avatars`
--

INSERT INTO `ug_save_old_avatars` (`id`, `userId`, `avatar`, `createAt`) VALUES
(73, 28, 'usego_photo55b012ea4b25cad2138ff5b1daf5229c5b811afa.png', '2024-02-28 22:32:38'),
(74, 26, 'usego_usego-ji233d7fef26dbd4e9ebe2e20c1a4bc43cf7de291f.png', '2024-02-29 11:36:50'),
(87, 28, 'usego_d5bdc065e1db1e951f1c4173d2075bb74a1e0946bc272777341337e9432047799e7fc47d.jpg', '2024-03-15 17:57:05'),
(88, 26, 'usego_dc1fe651cec81d33cf7e1971c5214aa256eeafa3b2e8f68d370f2ce658d1f4204613e72e.jpg', '2024-03-15 17:57:41'),
(95, 9, 'usego_bce4bcdce6995b28eae11b5c390de68e195194f6adf648480b87ccfddc872f87e0f4f65a.jpg', '2024-05-04 17:21:17'),
(110, 8, 'usego_c795ffbb9e55218cb4096be466513999ae80f0b9dcdb3d151cbc32d70033caf5ced78677.jpg', '2024-10-13 13:15:23'),
(111, 7, 'usego_e339245be91486e437ada14b607865690114f747d385885b22281c99deec61a358aae026.jpg', '2024-10-13 13:16:09'),
(112, 7, 'usego_83a9f40b6651af60e615f33724059e9d78eb1eae184d1b087dc437e36104d69e8f868d4c.jpg', '2024-10-13 13:16:35'),
(113, 8, 'usego_21948b93-81f4-429c-812e-8681b7b506ce60c320ce34d2859924fd85cce3b72ff55c1b55f1.jpg', '2024-10-15 12:56:36'),
(114, 9, 'usego_5c65b45e664984c77f6a6701c44b71e881676145c274ad1a74786aca80dd04d817f8215d.jpg', '2024-10-16 20:38:53'),
(115, 9, 'usego_d44effea26fc4d844bf2d2a61919436473889f08584f9e339bc2d678e0bae3934ccf7895.jpg', '2024-10-16 20:40:53'),
(116, 26, 'usego_57bdfb98cdadde3d313a859c0ef99a511a736c3a58c0ab5d7b1b637680924aa09ea424d4.jpg', '2024-10-16 20:46:19'),
(117, 28, 'usego_6b4b8c80d87065e24a54793b17e2e81cfd758a5874d83b32db352da9c87aa438335f11b5.jpg', '2024-10-16 20:48:44'),
(118, 27, 'usego_d3f12ff3d89319be170cfb766b795c42407b73941aa117206aff05a9ac12ef6eb04a2244.jpg', '2024-10-16 20:50:45'),
(119, 27, 'usego_ff4a346b7d9cf45cd44b10784f8feb38dc292d6dd9066c052d0992a9527a59eae23e9ccb.jpg', '2024-10-16 20:51:23'),
(120, 27, 'usego_ff4a346b7d9cf45cd44b10784f8feb386766ac7cb64013d224fc79556a48f08295a8ff04.jpg', '2024-10-16 20:52:04'),
(121, 8, 'usego_3eb09a55e243dd965a57a199f93a07eae23d61bd403fd75e794c53f6fcaec5a5f715d6ea.gif', '2024-10-16 20:53:49'),
(122, 7, 'usego_2ec45e6ff8b92d2bd4e0eb6804363be49a76ac911092e6e2f2c782ae26a550f0f611c284.jpg', '2024-10-26 23:14:38'),
(123, 8, 'usego_b97ce79cca04539dda6ee1886a93ea4e9e7ac8cc26db88f8d62eb0769dfb87c60857cc08.jpg', '2024-10-26 23:25:11'),
(124, 7, 'usego_16387328913333753ca0540e1cac18fec64b27ed668d7e26a6af8.jpg', '2024-11-01 13:43:45'),
(125, 9, 'usego_Untitledf135a0d9e5f6d6a14912c83709bb16233369e338.png', '2024-11-01 13:49:17'),
(126, 26, 'usego_2866c71192c51e7da7e39066d1c24bd209e617b52613846496912e32eef3ebb889a8ce6d.jpg', '2024-11-01 13:50:49'),
(127, 27, 'usego_7139549915695cf0c3f9292b8014dfef3b163368ce4e887939a2a4ba2cc3e2ff60c080d4.jpg', '2024-11-01 13:52:06');

-- --------------------------------------------------------

--
-- Table structure for table `ug_service`
--

CREATE TABLE `ug_service` (
  `id` int NOT NULL,
  `id_trade` int DEFAULT NULL,
  `userId` int DEFAULT NULL,
  `id_onwser` int DEFAULT NULL,
  `money_agrees` int DEFAULT NULL,
  `status` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `images` text,
  `files` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `message` text,
  `createAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ug_service`
--

INSERT INTO `ug_service` (`id`, `id_trade`, `userId`, `id_onwser`, `money_agrees`, `status`, `images`, `files`, `message`, `createAt`) VALUES
(62, 87, 8, 7, 1000, 'XN', '', NULL, NULL, '2024-10-26 19:44:43'),
(66, 86, 8, 7, 1000, 'XN', '', NULL, NULL, '2024-10-27 22:03:24');

-- --------------------------------------------------------

--
-- Table structure for table `ug_trade`
--

CREATE TABLE `ug_trade` (
  `id` int NOT NULL,
  `userId` int DEFAULT NULL,
  `id_onwser` int DEFAULT NULL,
  `id_service` int DEFAULT NULL,
  `code_trade` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `coin` int DEFAULT NULL,
  `trade_status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `image_qr` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `message` text,
  `name_bank` varchar(50) DEFAULT NULL,
  `name_user` varchar(60) DEFAULT NULL,
  `number_bank` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `createAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ug_trade`
--

INSERT INTO `ug_trade` (`id`, `userId`, `id_onwser`, `id_service`, `code_trade`, `coin`, `trade_status`, `status`, `image_qr`, `message`, `name_bank`, `name_user`, `number_bank`, `createAt`) VALUES
(50, 7, -1, 57, 'E7F4E08347920C75', 2000, 'payment_deduct', 'HT', NULL, NULL, NULL, NULL, NULL, '2024-10-20 21:34:51'),
(51, 7, -1, 59, 'G7DC1DDE56974404', 1000, 'payment_deduct', 'HT', NULL, NULL, NULL, NULL, NULL, '2024-10-21 08:28:06'),
(52, 7, -1, NULL, 'S732F9B6687297F2', 5000, 'deposit', 'HT', '[object Promise]', NULL, NULL, NULL, NULL, '2024-10-24 13:05:05'),
(57, 7, -1, NULL, 'O78B39971DB25B17', 1000, 'withdraw', 'XL', 'https://qr.ecaptcha.vn/api/generate/MB/+21354365+/+Pham+Duc+?amount=1000', NULL, 'MB', ' Pham Duc ', ' 21354365 ', '2024-10-24 23:09:58'),
(58, 7, -1, 61, 'G78F9F33AF5CFA38', 1000, 'payment_deduct', 'HT', NULL, NULL, NULL, NULL, NULL, '2024-10-26 19:37:13');

-- --------------------------------------------------------

--
-- Table structure for table `ug_users`
--

CREATE TABLE `ug_users` (
  `id` int NOT NULL,
  `firstName` varchar(20) DEFAULT NULL,
  `lastName` varchar(20) DEFAULT NULL,
  `email` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `coin` int NOT NULL,
  `token` varchar(50) DEFAULT NULL,
  `activeToken` varchar(50) DEFAULT NULL,
  `forgotToken` varchar(50) DEFAULT NULL,
  `firstLogin` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'true',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'avarta_default.png',
  `describes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `ug_type` int DEFAULT '0',
  `createAt` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ug_users`
--

INSERT INTO `ug_users` (`id`, `firstName`, `lastName`, `email`, `password`, `coin`, `token`, `activeToken`, `forgotToken`, `firstLogin`, `status`, `avatar`, `describes`, `ug_type`, `createAt`) VALUES
(7, 'Thành', 'công', 'kothanhcong050@gmail.com', '$2y$10$yXoFzhFDnC4ImCzb4jPDZOU7OVGOdFfkAD6g5Dz0W/IKWUaMzMHe6', 77000, 'c20ad4d76fe97759aa27a0c99bff6710', NULL, '985308', 'false', 1, 'usego_16387328913333753ca0540e1cac18fec64b27ed668d7e26a6af8.jpg', 'Xin chào các bạn', NULL, '24-11-01 13:43:45'),
(8, 'Pham', 'Duc', 'Ducpham2004nha@gmail.com', '$2y$10$efHqwXk9Mitq6cf2FARKOOofXIu/AmBS6YnhS6BvircsBe1zh9sne', 4000, NULL, NULL, NULL, 'false', 1, 'usego_21948b93-81f4-429c-812e-8681b7b506ce60c320ce34d2859924fd85cce3b72ff55c1b55f1.jpg', 'Bất cứ thứ gì con người có thể quan niêm và tin tưởng nó thì đều có thể đạt được bằng sự cố gắng kiên trì.', 1, '24-10-26 23:25:11'),
(9, 'Xuân', 'Đạt', 'Pduc1869@gmail.com', '$2y$10$PjWqwza5tI0jNtlt3W4iTuLvKWFvIkBJRR/IfPUssRwHBN2uUTggm', 0, NULL, NULL, NULL, 'false', 1, 'usego_Untitledf135a0d9e5f6d6a14912c83709bb16233369e338.png', NULL, NULL, '24-11-01 13:49:17'),
(26, 'Tiến', 'hoàng', 'hoangtien05000@gmail.com', '$2y$10$0z/GZRc5S06woMKJuhUhm.yhjwFwUQ9aHClzCY8VGMHOaoVY6R1O.', 0, NULL, NULL, NULL, 'false', 1, 'usego_2866c71192c51e7da7e39066d1c24bd209e617b52613846496912e32eef3ebb889a8ce6d.jpg', 'Da phải dày và vô hình<br />\nTâm phải tối và vô sắc', NULL, '24-11-01 13:50:49'),
(27, 'Khang', 'Nguyễn', 'magamingnhk2004@gmail.com', '$2y$10$T1pCC7f2DRmN.nCGVySt7er8RMGhYY4fJDco4lc0oQXl3nzhERldi', 0, NULL, NULL, NULL, 'false', 1, 'usego_7139549915695cf0c3f9292b8014dfef3b163368ce4e887939a2a4ba2cc3e2ff60c080d4.jpg', NULL, NULL, '24-11-01 13:52:06'),
(28, 'Đức', NULL, '2224802010615@student.tdmu.edu.vn', '$2y$10$VQWX/2qfTMHqJtzvHDOneOZIygqmLZQE860Dou2nI1AZ/nF7yc02u', 0, NULL, NULL, NULL, 'false', 1, 'usego_6b4b8c80d87065e24a54793b17e2e81cfd758a5874d83b32db352da9c87aa438335f11b5.jpg', NULL, NULL, '24-10-16 20:48:44'),
(30, 'xrcdtfyvgubhinjok', 'dxdctfyvgubhinj', 'phamhuutien763@gmail.com', '$2y$10$qCGSkSGQdc53MIkiDxKiIOvzPRWar2YDAUvPGlSnISkeeLmJlwpTS', 0, NULL, NULL, NULL, 'false', 1, 'avarta_default.png', NULL, 0, 'Monday, 06 05 2024');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ug_archive`
--
ALTER TABLE `ug_archive`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId_idPost` (`userId`,`idPost`),
  ADD KEY `idPost` (`idPost`);

--
-- Indexes for table `ug_collection_post`
--
ALTER TABLE `ug_collection_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ug_comment`
--
ALTER TABLE `ug_comment`
  ADD PRIMARY KEY (`id_cmt`);

--
-- Indexes for table `ug_follow`
--
ALTER TABLE `ug_follow`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_onswer` (`id_onswer`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `ug_like_post`
--
ALTER TABLE `ug_like_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ug_login_token`
--
ALTER TABLE `ug_login_token`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `ug_new_feeds`
--
ALTER TABLE `ug_new_feeds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ug_power_point`
--
ALTER TABLE `ug_power_point`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ug_power_point_ug_users` (`userId`);

--
-- Indexes for table `ug_respond_comment`
--
ALTER TABLE `ug_respond_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ug_save_old_avatars`
--
ALTER TABLE `ug_save_old_avatars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `ug_service`
--
ALTER TABLE `ug_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ug_trade`
--
ALTER TABLE `ug_trade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ug_users`
--
ALTER TABLE `ug_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ug_archive`
--
ALTER TABLE `ug_archive`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT for table `ug_collection_post`
--
ALTER TABLE `ug_collection_post`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=456;

--
-- AUTO_INCREMENT for table `ug_comment`
--
ALTER TABLE `ug_comment`
  MODIFY `id_cmt` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=767;

--
-- AUTO_INCREMENT for table `ug_follow`
--
ALTER TABLE `ug_follow`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=644;

--
-- AUTO_INCREMENT for table `ug_like_post`
--
ALTER TABLE `ug_like_post`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=480;

--
-- AUTO_INCREMENT for table `ug_login_token`
--
ALTER TABLE `ug_login_token`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=259;

--
-- AUTO_INCREMENT for table `ug_new_feeds`
--
ALTER TABLE `ug_new_feeds`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `ug_power_point`
--
ALTER TABLE `ug_power_point`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `ug_respond_comment`
--
ALTER TABLE `ug_respond_comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=385;

--
-- AUTO_INCREMENT for table `ug_save_old_avatars`
--
ALTER TABLE `ug_save_old_avatars`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `ug_service`
--
ALTER TABLE `ug_service`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `ug_trade`
--
ALTER TABLE `ug_trade`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `ug_users`
--
ALTER TABLE `ug_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ug_archive`
--
ALTER TABLE `ug_archive`
  ADD CONSTRAINT `ug_archive_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `ug_users` (`id`),
  ADD CONSTRAINT `ug_archive_ibfk_2` FOREIGN KEY (`idPost`) REFERENCES `ug_power_point` (`id`);

--
-- Constraints for table `ug_login_token`
--
ALTER TABLE `ug_login_token`
  ADD CONSTRAINT `ug_login_token_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `ug_users` (`id`);

--
-- Constraints for table `ug_power_point`
--
ALTER TABLE `ug_power_point`
  ADD CONSTRAINT `FK_ug_power_point_ug_users` FOREIGN KEY (`userId`) REFERENCES `ug_users` (`id`);

--
-- Constraints for table `ug_save_old_avatars`
--
ALTER TABLE `ug_save_old_avatars`
  ADD CONSTRAINT `ug_save_old_avatars_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `ug_users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
