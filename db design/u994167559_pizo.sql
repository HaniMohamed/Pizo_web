-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 23, 2018 at 01:01 PM
-- Server version: 10.2.16-MariaDB
-- PHP Version: 7.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u994167559_pizo`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'used', NULL, NULL, NULL),
(2, 'new', NULL, NULL, NULL),
(3, 'material', NULL, NULL, NULL),
(4, 'den', NULL, NULL, NULL),
(5, 'test', NULL, NULL, NULL),
(6, 'tes', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'cairo', NULL, NULL),
(2, 'alex', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `engineers_orders`
--

CREATE TABLE `engineers_orders` (
  `id` int(11) NOT NULL,
  `engineer_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `accepted` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `payed` tinyint(4) DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `coordinated` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `price` double NOT NULL,
  `featured` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `image`, `date`, `payed`, `owner_id`, `coordinated`, `deleted`, `price`, `featured`, `created_at`, `updated_at`) VALUES
(1, 'Event to image is being Tested', '', 'uploads/events/a9ef806313c5e3f0e7c042397efa3f1fd10214e2.png', '2019-09-11 05:05:05', 0, 1, 'dfksdkjf sdkf jk', 1, 0, 0, '2018-06-15 04:57:05', '2018-07-01 07:38:14'),
(2, 'Event to image is being Tested', '', 'uploads/events/e444c0a1d0c6fb34108af6221bc36a6dd63718cc.png', '2019-09-11 05:05:05', 0, 1, 'dfksdkjf sdkf jk', 0, 0, 0, '2018-06-15 04:57:50', '2018-07-01 00:58:23'),
(3, 'Event to image is being Tested', '', 'uploads/events/04532a47e522c8ea2122c98a01f10890850783cf.png', '2019-09-11 05:05:05', 0, 1, 'dfksdkjf sdkf jk', 0, 0, 0, '2018-06-15 19:40:16', '2018-07-01 00:57:57'),
(4, 'Event Title ', '', 'uploads/events/bd0ab3a83c31606c7388eb501729db633cef44c9.png', '2019-07-06 00:00:00', 0, 1, 'me', 0, 0, 0, '2018-06-27 11:52:04', '2018-06-27 13:08:07'),
(5, 'another event ', '', 'uploads/events/7888c0f5d84172c2c1789d5de7cb9a1841d4e3dd.png', '2018-06-27 00:00:00', 0, 1, 'ahmed', 1, 0, 0, '2018-06-27 11:56:48', '2018-07-01 12:51:47'),
(6, 'New event ', '', 'uploads/events/770c1a683fc45cd38d35e480604845f39a6ce7d7.png', '2022-03-01 00:00:00', 0, 1, 'Nobody', 1, 0, 0, '2018-07-01 00:59:14', '2018-07-01 07:38:31');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL),
(2, 'engineer', NULL, NULL),
(3, 'doctor', NULL, NULL),
(4, 'company', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `title` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `owner_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `featured` tinyint(4) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `description`, `owner_id`, `category_id`, `featured`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 'job title', 'job description', 14, 1, 0, 1, '2018-05-14 15:51:41', '2018-05-14 15:53:29'),
(2, 'job title', 'job description', 14, 1, 0, 0, '2018-05-18 05:42:09', '2018-05-18 05:42:09'),
(3, 'job2', 'description', 15, 1, 0, 0, '2018-05-18 20:34:11', '2018-05-18 20:34:11'),
(4, 'Job by Hani', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam nec blandit nibh, a iaculis augue. Donec varius aliquet euismod. Sed pulvinar, metus nec laoreet suscipit, metus ex sollicitudin leo, non cursus massa lorem eu sem. Phasellus ', 15, 1, 0, 0, '2018-05-18 20:37:58', '2018-05-18 20:37:58'),
(5, 'Android Developer', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam pretium sed libero eget fermentum. Nulla facilisi. Suspendisse pellentesque neque a ante iaculis, et porttitor erat mollis. Fusce sollicitudin tellus purus, vel suscipit metus semper quis. Pellentesque tempor euismod massa, nec facilisis magna finibus id. Etiam sed interdum nisl, at aliquam leo. In pharetra gravida molestie. Pellentesque faucibus auctor libero vel vestibulum. Nullam et lectus lacus. Integer hendrerit purus ac vehicula volutpat. Suspendisse id sagittis nisl, a posuere tellus. Aliquam elit nisl, mollis eu enim non, laoreet maximus lectus.\n\nQuisque ultrices finibus velit luctus accumsan. Sed pharetra posuere justo nec faucibus. Vestibulum at nunc ut nibh semper fermentum sit amet non turpis. Nulla vestibulum mauris ipsum, in fermentum orci convallis eu. Suspendisse vel eros consectetur, varius nisi at, pellentesque sapien. Aenean ac fringilla felis. Cras rhoncus mollis leo, non hendrerit leo dictum vel. Pellentesque urna ligula, efficitur nec nisi ut, consectetur commodo mi. Fusce varius turpis eu justo rhoncus, in elementum ipsum tempor. Vestibulum non ante vel tortor laoreet condimentum. Proin molestie risus non leo volutpat, sed sagittis sem ullamcorper. Integer rutrum fring\n\n', 15, 1, 0, 1, '2018-05-20 01:23:22', '2018-07-01 07:44:05'),
(6, 'Job TITle', 'JBOBOBOOBBOOBOBO', 21, 2, 0, 1, '2018-06-27 13:29:48', '2018-07-01 01:10:14'),
(7, 'Job TITLE', 'Job TITLEJob TITLEJob TITLEJob TITLEJob TITLEJob TITLEJob TITLEJob TITLEJob TITLEJob TITLEJob TITLEJob TITLEJob TITLEJob TITLEJob TITLEJob TITLEJob TITLEJob TITLE', 21, 1, 0, 1, '2018-06-27 13:33:30', '2018-07-01 01:09:17'),
(8, 'another job!', 'another job', 21, 3, 0, 1, '2018-07-01 01:10:03', '2018-07-01 01:10:14'),
(9, 'another job!', 'another job', 21, 3, 0, 0, '2018-07-01 01:10:21', '2018-07-01 01:10:21'),
(10, 'what are you', 'another job without ', 21, 2, 0, 1, '2018-07-01 01:13:30', '2018-07-01 01:13:39'),
(11, 'sdnfsdjfnsd jkfn sdjk nfsdjk nfjksd ', 'jn jkdsng djkngdfjk nkjd nf jkdngdjk gnj', 1, 3, 0, 1, '2018-07-01 07:44:21', '2018-07-01 07:44:37'),
(12, 'sdfnskdfn fkgndfk ng', 'gdfln gdf ngdfkn gdk fngk dnfgk ndgkja smlfn ', 1, 2, 0, 1, '2018-07-01 08:20:45', '2018-07-01 08:20:59');

-- --------------------------------------------------------

--
-- Table structure for table `jobs_categories`
--

CREATE TABLE `jobs_categories` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `uodated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp850;

--
-- Dumping data for table `jobs_categories`
--

INSERT INTO `jobs_categories` (`id`, `title`, `created_at`, `uodated_at`) VALUES
(1, 'dentist', NULL, NULL),
(2, 'nurse', NULL, NULL),
(3, 'secetry', NULL, NULL),
(4, 'wanted', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `conversation_id` int(11) DEFAULT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `owner_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `image`, `owner_id`, `created_at`, `updated_at`) VALUES
(11, 'anther post 99', 'anther post anther post anther post ', 'uploads/News/8037a9f5c9babe0c32d395bbd8efafdb7fd854cc.png', 21, '2018-07-01 00:49:01', '2018-07-01 00:49:01'),
(13, 'dkfnsdjkfn sdjk fnsdk nf jk', 'kngjksdng jksdng jkn gsjkd ng', 'uploads/News/031c69e18ec51591388e89b2ebc49cfde52f5ee9.png', 1, '2018-07-01 08:22:14', '2018-07-01 08:22:14');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `doctor_id` int(11) NOT NULL,
  `engineer_id` int(11) NOT NULL,
  `cost` float DEFAULT NULL,
  `cost_sender` int(11) DEFAULT NULL,
  `cost_receiver` int(11) DEFAULT NULL,
  `engineer_done` int(11) DEFAULT NULL,
  `doctor_rate` float DEFAULT NULL,
  `engineer_rate` float DEFAULT NULL,
  `doctor_review` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `engineer_review` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders_conversations`
--

CREATE TABLE `orders_conversations` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `owner_id` int(11) NOT NULL,
  `specialization_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `image`, `owner_id`, `specialization_id`, `price`, `category_id`, `created_at`, `updated_at`) VALUES
(63, 'Third Product with different Category', 'Third Product with different Category', 'uploads/products/e03e3c89693aeaf831208f6851a099c68112d565.png', 21, 14, 1500, 1, '2018-06-24 17:22:58', '2018-07-01 08:13:50'),
(65, 'another test product', 'another test product', 'uploads/products/7beee2f02e44a4e7d8293dbba1bebdfb95120e70.png', 21, 6, 6, 2, '2018-06-24 17:47:20', '2018-07-21 05:35:41'),
(66, 'device test2', 'gdthj uhjj hik', 'uploads/products/b9642926a35de546381b64b52136a55a0618667a.png', 15, 1, 256.85, 1, '2018-06-24 22:12:18', '2018-07-21 05:35:30'),
(67, 'test clinic', 'test clinic desc', 'uploads/products/289215a37da29ca8bd8328c059caef8a82d08e2f.png', 15, 10, 10, 6, '2018-06-26 05:20:23', '2018-07-01 08:19:25'),
(74, 'testd mmfn jksdn fkj', 'dgnkdjfn ndng sdj gdjn g', 'uploads/products/7f95116572aa2de052040182443b56b9f2866859.png', 1, 4, 9, 6, '2018-06-29 20:24:16', '2018-06-29 23:01:31'),
(82, 'Another Product', 'product description by a company', 'uploads/products/c245b1563e461f94ac789ffe263cb6f85884955f.png', 32, 17, 27, 2, '2018-07-21 04:46:40', '2018-07-21 04:47:01'),
(83, 'another product', 'adfasdf asdf', 'uploads/products/1477f9b0722adeb362d0d3db083a8baecccc2166.png', 29, 16, 3, 3, '2018-07-21 04:50:30', '2018-07-21 04:50:38'),
(85, 'product by me as company', 'product by me as company', 'uploads/products/767af7b413b3668346db0d46b3a03679e3bf1326.png', 34, 18, 500, 2, '2018-07-21 14:40:22', '2018-07-21 14:40:40'),
(86, 'new product update', 'desc of new product', NULL, 1, 1, 21.5, 1, '2018-07-23 12:55:31', '2018-07-23 12:55:31');

-- --------------------------------------------------------

--
-- Table structure for table `specializations`
--

CREATE TABLE `specializations` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `sub_spec` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `specializations`
--

INSERT INTO `specializations` (`id`, `name`, `sub_spec`, `created_at`, `updated_at`) VALUES
(1, 'Hand Pieces', NULL, NULL, NULL),
(2, 'Dentak Units', NULL, NULL, NULL),
(3, 'Compressor', NULL, NULL, NULL),
(4, 'High Suction Unit', NULL, NULL, NULL),
(5, 'Light care', NULL, NULL, NULL),
(6, 'Scaler (cavitron)', NULL, NULL, NULL),
(7, 'Amalgamator', NULL, NULL, NULL),
(8, 'Xray Dental', NULL, NULL, NULL),
(9, 'Panorama Xray', NULL, NULL, NULL),
(10, 'Autoclave', NULL, NULL, NULL),
(11, 'Water Motor', NULL, NULL, NULL),
(12, 'Implant Motor', NULL, NULL, NULL),
(13, 'Endo Rotary', NULL, NULL, NULL),
(14, 'Apex Locator', NULL, NULL, NULL),
(15, 'Loop', NULL, NULL, NULL),
(16, 'Dental Microscope', NULL, NULL, NULL),
(17, 'Dental Cr', NULL, NULL, NULL),
(18, 'Laser', NULL, NULL, NULL),
(19, 'Accessories', NULL, NULL, NULL),
(20, 'Ultrasound Cleaner', NULL, NULL, NULL),
(21, 'Selling Machine', NULL, NULL, NULL),
(22, 'Dental Lab', NULL, NULL, NULL),
(23, 'Camera Store', NULL, NULL, NULL),
(24, 'Other', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(35) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `group` int(11) NOT NULL,
  `image` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `phone`, `address`, `group`, `image`, `password`, `token`, `city`, `created_at`, `updated_at`, `status`, `deleted`, `lat`, `lng`) VALUES
(1, 'Moustafa elgammal', 'elgammalx', 'elgammal@me.me', '01204054219', 'Doki', 1, '', '$2y$10$RrDBVz3fiWBBKqGztEr6YeX7nvl5nQuJ3EUkOhDP/S285hdOi4YZ6', NULL, 1, '2018-04-28 09:05:14', '2018-06-21 16:10:00', 1, 0, 55.3, 50),
(10, 'Moustafa elgammal', 'elga  \'SELECT * FROME USERS\'mmalx', 'elgamsdfmal@me.me', '01204054219', 'Doki', 2, '', '$2y$10$tsvPZz21Q2vDDrx0bC9Ek.v.mo/qdkLqzVcvxKjqyaLUOF0q7IRxu', NULL, 1, '2018-04-29 02:46:50', '2018-06-22 13:38:53', 1, 0, 70, 70),
(11, 'Moustafa elgammal', 'elga  \'SELECT * FROME USERS\'mmalx', 'elgamsdfmal@me.me', '01204054219', 'Doki', 2, '', '$2y$10$tsvPZz21Q2vDDrx0bC9Ek.v.mo/qdkLqzVcvxKjqyaLUOF0q7IRxu', NULL, 1, '2018-04-29 02:46:50', '2018-06-22 13:38:54', 1, 0, 71, 71),
(12, 'Moustafa elgammal', 'elga  \'SELECT * FROME USERS\'mmalx', 'elgamsdfmal@me.me', '01204054219', 'Doki', 2, '', '$2y$10$tsvPZz21Q2vDDrx0bC9Ek.v.mo/qdkLqzVcvxKjqyaLUOF0q7IRxu', NULL, 1, '2018-04-29 02:46:50', '2018-06-22 13:38:53', 0, 1, 0, 0),
(13, 'Moustafa elgammal', 'elga  \'SELECT * FROME USERS\'mmalx', 'elgamsdfmal@me.me', '01204054219', 'Doki', 2, '', '$2y$10$tsvPZz21Q2vDDrx0bC9Ek.v.mo/qdkLqzVcvxKjqyaLUOF0q7IRxu', NULL, 1, '2018-04-29 02:46:50', '2018-06-22 13:38:53', 0, 1, 0, 0),
(14, NULL, NULL, 'moustafa_algammal@me.me', NULL, NULL, 3, '', '$2y$10$dL2Mmj9C7vOJj2fMGIdKzeoTtuDJgdwigQ5muJKiiPo1NlJb6WxPm', NULL, 1, '2018-05-10 18:10:27', '2018-06-21 16:10:18', 1, 0, 0, 0),
(15, 'Hani', 'Hani', 'hani.hussein94@gmail.com', NULL, NULL, 1, '', '$2y$10$v3IP/Hmv7Tw3jE5x/xIKf.ha8OPplLTP.jBs9kg4E9jaDHk4TJxku', NULL, 1, '2018-05-14 15:16:33', '2018-06-21 16:10:00', 1, 0, 0, 0),
(16, NULL, NULL, 'geniero.bas@gmail.com', NULL, NULL, 3, '', '$2y$10$ghBQmmA.O8E1Qb5Cc7WWnuMiiSnMW6UZLm48rvIETk1/LbBHUaTy6', NULL, 1, '2018-05-21 11:27:18', '2018-06-23 23:02:08', 1, 1, 0, 0),
(17, NULL, NULL, 'moustafa_algdsjfhammal@me.me', NULL, NULL, 3, '', '$2y$10$IysoSPWBUX9lqzT6imo1UuNzlDhjzzDyoWKdVa/NPEsxZZZMDUSaC', NULL, 1, '2018-05-29 04:12:20', '2018-06-21 15:47:12', 1, 0, 0, 0),
(18, NULL, NULL, 'a.me@me.me', NULL, NULL, 2, '', '$2y$10$B1AagujTq9Ce5H8/GI23EOSfRu/Iqh9Z0wFpwAsCrWzKOAx6VlcSO', NULL, 1, '2018-05-30 00:58:04', '2018-06-21 15:47:12', 1, 0, 0, 0),
(19, NULL, NULL, 'a.me@me.mel', NULL, NULL, 2, '', '$2y$10$5ihat.BH3WjI9/4pyWu8YubLwJLKyGgShszDS87SvJZsz5nd5INFS', NULL, 1, '2018-05-30 01:00:39', '2018-07-06 13:38:34', 0, 1, 0, 0),
(20, NULL, NULL, 'loay@mail.com', NULL, NULL, 2, '', '$2y$10$on8RphI6jpJOKORalpZwaOj/YZw8Sg7TDFp4XDne/bF5qSFZm5OB.', NULL, 1, '2018-05-30 01:14:58', '2018-07-06 13:38:34', 0, 1, 0, 0),
(21, NULL, NULL, 'admin@pizoeg.com', NULL, NULL, 1, '', '$2y$10$/HepeNbc8gkE68I3Xi.FfO5hWSm.74z75p6gityQpeIAwN90lPSMC', NULL, 1, '2018-06-03 03:18:04', '2018-06-21 16:10:00', 1, 0, 0, 0),
(22, NULL, NULL, 'aa@a.a', NULL, NULL, 2, '', '$2y$10$3twueSUPav8natFMkDaeeu2yk/wOqQvTb/DkE7DejHMa7N6BdiP2C', NULL, 1, '2018-06-03 08:42:49', '2018-07-01 01:27:46', 0, 1, 0, 0),
(23, NULL, NULL, 'aa@a.com', NULL, NULL, 2, '', '$2y$10$M8zG/epmHDHwOihjTwQp4Ok.GnAQ/6zSqqhCf.NDml7PTk1HmAtCe', NULL, 1, '2018-06-03 08:55:14', '2018-06-27 13:56:23', 0, 1, 0, 0),
(24, NULL, NULL, 'aaa@a.a', NULL, NULL, 2, '', '$2y$10$yr5wXVG6mejyu.XlssnqS./7o3dtP16cHNsGlvH6vAxSrsq/J2t4S', NULL, 1, '2018-06-04 10:01:01', '2018-07-01 01:27:46', 0, 1, 0, 0),
(25, NULL, NULL, 'new@user.u', NULL, NULL, 3, '', '$2y$10$jmCr8DnAycfgDKSeql3uouGsgF2sracqbkQSKObDWSgmS50IC19H2', NULL, 1, '2018-06-11 10:56:41', '2018-07-06 13:38:03', 1, 1, 0, 0),
(26, NULL, NULL, 'admin1@pizoeg.com', NULL, NULL, 1, '', '$2y$10$a.1zUPZkTjf5lU6wU7bNp.A8U2JrJOcG2tGrA8hgABNsGI4JMDelW', NULL, 1, '2018-06-22 07:56:08', '2018-07-01 01:28:11', 1, 0, 0, 0),
(27, NULL, NULL, 'username@username.com', NULL, NULL, 2, '', '$2y$10$fi7/7.3uaNDezAViiAcp1O1uxEBYq6SFBjfgcv0/EIzNHHVwLSm1y', NULL, 1, '2018-06-23 11:39:50', '2018-06-23 11:39:50', 1, 0, 0, 0),
(28, NULL, NULL, 'email@company.com', NULL, NULL, 4, '', '$2y$10$r0dj7nIRQd.vGBB8t0a4Pe41gAm/eavLcOD5mwBMCNHzM7pgqMweW', NULL, 1, '2018-07-20 21:19:25', '2018-07-20 21:19:25', 1, 0, 0, 0),
(29, NULL, NULL, 'email@someone.com', NULL, NULL, 4, '', '$2y$10$OhVObuMOVg4auk5QZXgrTOHx1MbDUgMs.iFxr5Eve6qBh1KJ.ppju', NULL, 1, '2018-07-20 21:21:47', '2018-07-20 21:21:47', 1, 0, 0, 0),
(30, NULL, NULL, 'anothercompany@company.com', NULL, NULL, 4, '', '$2y$10$hjnw./.RBcsHrKFnKNgL5.hJYYopuOxgx7Qjfm2hzRPBD7q/FuUh6', NULL, 1, '2018-07-20 21:24:34', '2018-07-20 21:24:34', 1, 0, 0, 0),
(31, NULL, NULL, 'email@com.com', NULL, NULL, 4, '', '$2y$10$SCtMq.BmEjJzmjbK2PuoQeQVbgXjY0u/FRGolU/NM3xBpemubspbi', NULL, 1, '2018-07-20 21:28:36', '2018-07-20 21:28:36', 1, 0, 0, 0),
(32, NULL, NULL, 'testcompany@test.com', NULL, NULL, 4, '', '$2y$10$qTT3wmwhVvO.FbdHAdha3ecAq0xfsVlTRDHPlmhfUHr3reGzO.QoK', NULL, 1, '2018-07-20 21:29:38', '2018-07-20 21:29:38', 1, 0, 0, 0),
(33, NULL, NULL, 'moustafa@gmail.com', NULL, NULL, 4, '', '$2y$10$K/WR2e17pgzePY7D5OQW8uNXhbhjC38rdZ70zG7bQaWD8RW27QTHu', NULL, 1, '2018-07-21 13:41:08', '2018-07-21 13:41:08', 1, 0, 0, 0),
(34, NULL, NULL, 'hany@gmail.com', NULL, NULL, 4, '', '$2y$10$4dvTLVGBTnSBOek/MC555uTnIraHzzM/wAhhsaSFp6JSz8ZCDaloe', NULL, 1, '2018-07-21 14:35:47', '2018-07-21 14:35:47', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_specializations`
--

CREATE TABLE `users_specializations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `specialization_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `engineers_orders`
--
ALTER TABLE `engineers_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_owner_id_idx` (`owner_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_job_category_id_idx` (`category_id`),
  ADD KEY `fk_job_owner_id_idx` (`owner_id`);

--
-- Indexes for table `jobs_categories`
--
ALTER TABLE `jobs_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_conversation_id_idx` (`conversation_id`),
  ADD KEY `fk_message_sender_id_idx` (`sender_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_doctor_id_idx` (`doctor_id`),
  ADD KEY `fk_engineer_id_idx` (`engineer_id`);

--
-- Indexes for table `orders_conversations`
--
ALTER TABLE `orders_conversations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_conversation_order_id_idx` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product owner_idx` (`owner_id`),
  ADD KEY `product specialization_idx` (`specialization_id`),
  ADD KEY `product_category_idx` (`category_id`);

--
-- Indexes for table `specializations`
--
ALTER TABLE `specializations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sub_specialization_id_idx` (`sub_spec`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_group_idx` (`group`),
  ADD KEY `fk_user_city_idx` (`city`);

--
-- Indexes for table `users_specializations`
--
ALTER TABLE `users_specializations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id_idx` (`user_id`),
  ADD KEY `fk_specialization_id_idx` (`specialization_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `engineers_orders`
--
ALTER TABLE `engineers_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders_conversations`
--
ALTER TABLE `orders_conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `specializations`
--
ALTER TABLE `specializations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users_specializations`
--
ALTER TABLE `users_specializations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_conversation_id` FOREIGN KEY (`conversation_id`) REFERENCES `orders_conversations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_message_sender_id` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_doctor_id` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_engineer_id` FOREIGN KEY (`engineer_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `orders_conversations`
--
ALTER TABLE `orders_conversations`
  ADD CONSTRAINT `fk_conversation_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `product_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `product_owner` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `product_specialization` FOREIGN KEY (`specialization_id`) REFERENCES `specializations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `specializations`
--
ALTER TABLE `specializations`
  ADD CONSTRAINT `fk_sub_specialization_id` FOREIGN KEY (`sub_spec`) REFERENCES `specializations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_city` FOREIGN KEY (`city`) REFERENCES `cities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_group` FOREIGN KEY (`group`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users_specializations`
--
ALTER TABLE `users_specializations`
  ADD CONSTRAINT `fk_specialization_id` FOREIGN KEY (`specialization_id`) REFERENCES `specializations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
