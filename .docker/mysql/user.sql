-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 30, 2023 at 04:46 AM
-- Server version: 8.0.31
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webcms`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(320) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `firstName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profileImage` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `age` int DEFAULT NULL,
  `birthday` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `gender` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `race` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `companyName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jobTitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobileNumber` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `officeNumber` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `homeNumber` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `aptNumber` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `webUrl` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `github` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `twitter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `facebook` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `linkedin` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `slack` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sessionLength` int NOT NULL DEFAULT '86400',
  `regDate` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `prefsTheme` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default',
  `regHash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resetTimeStamp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resetHash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `userName`, `email`, `password`, `role`, `firstName`, `lastName`, `profileImage`, `age`, `birthday`, `gender`, `race`, `bio`, `companyName`, `jobTitle`, `mobileNumber`, `officeNumber`, `homeNumber`, `street`, `aptNumber`, `city`, `state`, `zip`, `country`, `webUrl`, `github`, `twitter`, `instagram`, `facebook`, `linkedin`, `slack`, `sessionLength`, `regDate`, `active`, `prefsTheme`, `regHash`, `resetTimeStamp`, `resetHash`) VALUES
(1, 'jsmith', 'jsmith@webinertia.net', '$2y$10$buYOVRO7oURp1Ej3/mNBK.9c.Yo.LH49Iba2Q1l7F3Lmr6dRzAACq', 'Administrator', 'Joey', 'Smith', 'profileImage_62a9588780c666_31265011.jpg', 47, '02-13-1975 12:00:00', 'Male', 'White', 'This is text to test the edit routine and to provide text to use while building the profile page.', 'Webinertia Data Systems', 'Lead Developer', '(205) 555-5555', '(205) 555-5555', NULL, '123 You Wish You Knew St.', NULL, 'Birmingham', 'AL', '35123', NULL, 'https://webinertia.net', 'https://github.com/webinertia', '@webinertia', 'someinstagram', 'https://facebook.com/web', 'https://www.linkedin.com/in/joey-smith-367b9850/', '/webinertia-chat.slack.com', 86400, '02-13-2021 4:20:30', 1, 'default', NULL, NULL, NULL),
(2, 'test', 'test@webinertia.net', '$2y$10$fi1Ibl3JqEB.P/530rb4NOLbieZ6vRS0U0JaWewujWRvbSGxvUEia', 'Member', 'test', 'User', NULL, 99, '08-1-2022 12:00:00', NULL, NULL, 'Testing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '@test12345', '', 'facebook.com/profile=test;', NULL, '', 86400, '', 0, 'default', NULL, NULL, NULL),
(8, 'asmith', 'asmith@webinertia.net', '$2y$10$/hlG21z1IkvLQ7hCNvTPw.8YxplLKHMoaWiPCI1ghU8Jzvn/KTeSS', 'Super Administrator', 'Aaron', 'Smith', NULL, 24, '03-14-1997 12:00:00', NULL, NULL, 'errt34teferfr4rtr', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 86400, '03-26-2022 4:41:57', 1, 'default', '$2y$10$7PPdVUCmYd4n9JevGthS/.SvZqdGdTs7Za3s7/VZYILJjo69W8tda', NULL, NULL),
(9, 'dsmith', 'dsmith@webinertia.net', '$2y$10$x2ZfQZ3Ob2AmSBb8PH3lC.enEOIja8ZIfHl0v2SPG2w/qFsIwEr06', 'Member', 'Dalton', 'Smith', NULL, 23, '09-29-1999 12:00:00', NULL, NULL, 'Dalton is currently in the U.S. Army.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 86400, '04-29-2022 10:43:20', 1, 'default', '$2y$10$amkFhTHEtQhJPsJesvt2k.rc4qC5OHPjfJhTZfhE6bvgWl5G7Quta', NULL, NULL),
(10, 'ana', 'ana@webinertia.net', '$2y$10$AiucXEXQmzUSC50tlTzGzeTj003PF6SA0jyvMzvpWj1oTreiFLOfe', 'Member', 'Anna', 'Geldiashvili', NULL, 22, '01-8-2001 12:00:00', NULL, NULL, 'Just temp data', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 86400, '05-8-2023 11:37:23', 0, 'default', '$2y$10$/LljOtiY89U0zl6s99Ykdel5YmSHl5o42o8/0m9tBSnUrqvH7xdie', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
