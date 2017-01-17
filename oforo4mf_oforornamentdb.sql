-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2017 at 05:55 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `oforo4mf_oforornamentdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE IF NOT EXISTS `admin_users` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0=>Inactive, 1=>active, 2=>deleted',
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `create_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `name`, `email`, `username`, `password`, `contact`, `status`, `created_by`, `updated_by`, `create_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@example.com', 'admin', '$2y$10$.RFhLr2lePUzoM9kYTrhr.Dkn29EzC4EG/Mrih6d068p6hyvkzQlq', '7686543456', 1, 1, 1, '2016-07-31 08:55:31', '2016-08-02 19:47:54'),
(14, 'sdasdertwrewr', 'aaa3333333333333334234a@GMAIL.com', 'admin1werwe', '$2y$10$mM/MVmMgD.olV32ZEdVv2eJqmGzEbXsHDdgxGNxWvRoGzq1lVKEdK', '234567784332342', 2, 1, 1, '2016-08-02 19:15:35', '2016-08-02 19:46:45'),
(15, 'seeeee', 'ajerewr333r@gmail.com', 'abcd', '$2y$10$D7w.NBdISHIFZIFdAlhD4esB03akyoN5B/T9TdPjNAHRXXiaPI8Ga', '12321312312312', 1, 1, 1, '2016-08-08 19:14:46', '2016-08-08 19:14:55');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
`id` int(11) NOT NULL,
  `iso` char(2) NOT NULL DEFAULT '',
  `printable_name` varchar(80) NOT NULL DEFAULT '',
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=240 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `iso`, `printable_name`, `iso3`, `numcode`) VALUES
(165, 'PA', 'Panama', 'PAN', 591),
(166, 'PG', 'Papua New Guinea', 'PNG', 598),
(167, 'PY', 'Paraguay', 'PRY', 600),
(168, 'PE', 'Peru', 'PER', 604),
(169, 'PH', 'Philippines', 'PHL', 608);

-- --------------------------------------------------------

--
-- Table structure for table `gem_buying_options`
--

CREATE TABLE IF NOT EXISTS `gem_buying_options` (
`id` tinyint(3) unsigned NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(3) unsigned NOT NULL COMMENT '0=>Inactive, 1=>Active, 2=>deleted'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gem_buying_options`
--

INSERT INTO `gem_buying_options` (`id`, `name`, `status`) VALUES
(1, 'Paypal', 1),
(2, 'Credit Cards', 1),
(3, 'Direct Deposit', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gem_categories`
--

CREATE TABLE IF NOT EXISTS `gem_categories` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active, 2=>deleted',
  `parent_id` int(11) DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gem_categories`
--

INSERT INTO `gem_categories` (`id`, `name`, `status`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Afghanite', 1, 0, '2016-08-08 21:59:51', '2016-08-08 21:59:51'),
(2, 'Agate', 1, 0, '2016-08-08 22:00:49', '2016-08-08 22:00:49'),
(3, 'Alexandrite', 1, 0, '2016-08-08 22:01:27', '2016-08-08 22:01:27'),
(4, 'Amazonite', 1, 0, '2016-08-08 19:09:40', '0000-00-00 00:00:00'),
(5, 'Amber', 1, 0, '2016-08-08 19:10:10', '0000-00-00 00:00:00'),
(6, 'Amethyst', 2, 0, '2016-08-08 19:11:27', '2016-08-08 19:18:15'),
(7, 'Ametrine', 1, 0, '2016-08-08 19:15:51', '2016-08-08 19:16:03'),
(8, 'Ammonite', 1, 0, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(9, 'Ancient Artifacts', 1, 0, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(10, 'Andalusite', 1, 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(11, 'Andesine Feldspar', 1, 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(12, 'Apatite', 1, 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(13, 'Aquamarine', 1, 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(14, 'Aventurine', 1, 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(15, 'Azurite', 1, 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(16, 'Azurite with Malachite', 1, 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(17, 'Bastnasite', 1, 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(18, 'Beads', 1, 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(19, 'Benitoite', 1, 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(20, 'Beryl', 1, 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(21, 'Black Star Diopside', 1, 2, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(22, 'Bloodstone', 1, 2, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(23, 'Calcite', 1, 2, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(24, 'Calligraphy Stone', 1, 2, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(25, 'Carnelian', 1, 2, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(26, 'Carvings', 1, 2, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(27, 'Cavansite', 1, 2, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(28, 'Chalcedony', 1, 2, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(29, 'Charoite           \r\n                                                Chrome Diopside', 1, 2, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(30, 'Chrysanthemum Flower Stone', 1, 2, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(31, 'Chrysoberyl', 1, 2, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(32, 'Chrysocolla', 1, 2, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(33, 'Chrysoprase', 1, 2, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(34, 'Citrine', 1, 2, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(35, 'Collectibles', 1, 3, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(36, 'Coral', 1, 3, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(37, 'Crinoid', 1, 3, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(38, 'Crystal Skulls', 1, 3, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(39, 'Crystals', 1, 3, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(40, 'Danburite', 1, 3, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(41, 'Diamonds', 1, 3, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(42, 'Diaspore', 1, 3, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(43, 'Dioptase', 1, 3, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(44, 'Druzy', 1, 4, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(45, 'Emerald', 1, 4, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(46, 'Eudialyte', 1, 4, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(47, 'Exceptional Gemstones', 1, 4, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(48, 'Fire Agate', 1, 4, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(49, 'Fluorite', 1, 4, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(50, 'Fossickers Delight', 1, 4, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(51, 'Fossils', 1, 4, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(52, 'Fuchsite', 1, 4, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(53, 'Garnet', 1, 4, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(54, 'Gemstone Display Cases', 1, 4, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(55, 'Gemstone Posters', 1, 5, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(56, 'Gemstone Sample Box', 1, 5, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(57, 'Geodes', 1, 5, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(58, 'Gold', 1, 0, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(59, 'Hackmanite', 1, 0, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(60, 'Heliodor', 1, 0, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(61, 'Hematite', 1, 0, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(62, 'Hiddenite', 1, 0, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(63, 'Himalayan Salt', 1, 0, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(64, 'Holistic Gemstones', 1, 0, '2016-09-11 17:21:26', '2016-09-17 08:27:37');

-- --------------------------------------------------------

--
-- Table structure for table `gem_certificates`
--

CREATE TABLE IF NOT EXISTS `gem_certificates` (
`id` smallint(5) unsigned NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(3) unsigned NOT NULL COMMENT '0=>Inactive, 1=>Active, 2=>deleted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gem_certificates`
--

INSERT INTO `gem_certificates` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'The Asian Institute of Gemological Sciences', 'The Asian Institute of Gemological Sciences on 1987', 1, '2016-09-03 15:19:44', '2016-09-03 15:19:44'),
(2, 'Burapha Gemological Laboratory', 'Burapha Gemological Laboratory on 2016', 1, '2016-09-03 15:19:44', '2016-09-03 15:19:44');

-- --------------------------------------------------------

--
-- Table structure for table `gem_clarities`
--

CREATE TABLE IF NOT EXISTS `gem_clarities` (
`id` smallint(5) unsigned NOT NULL,
  `name` varchar(150) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL COMMENT '0=>Inactive, 1=>Active, 2=>deleted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gem_clarities`
--

INSERT INTO `gem_clarities` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Loupe clean', 1, '2016-09-03 15:13:32', '2016-09-03 15:13:32'),
(2, 'Eye clean', 1, '2016-09-03 15:13:32', '2016-09-03 15:13:32');

-- --------------------------------------------------------

--
-- Table structure for table `gem_colors`
--

CREATE TABLE IF NOT EXISTS `gem_colors` (
`id` tinyint(3) unsigned NOT NULL,
  `name` varchar(40) NOT NULL,
  `color_code` varchar(10) NOT NULL,
  `color_image` varchar(50) DEFAULT NULL,
  `status` tinyint(1) unsigned NOT NULL COMMENT '0=>Inactive, 1=>Active, 2=>deleted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gem_colors`
--

INSERT INTO `gem_colors` (`id`, `name`, `color_code`, `color_image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Red', '#da4f49', 'red.png', 1, '2016-09-03 14:47:25', '2016-09-03 14:47:25'),
(2, 'Yellow', '#fff000', 'yellow.png', 1, '2016-09-03 14:48:08', '2016-09-03 14:48:08'),
(3, 'Pink', '#ff00e4', 'pink.png', 1, '2016-09-03 14:48:57', '2016-09-03 14:48:57'),
(4, 'Orange', '#faa732', 'orange.png', 1, '2016-09-03 14:49:57', '2016-09-03 14:49:57'),
(5, 'Green', '#5bb75b', 'green.png', 1, '2016-09-03 14:50:49', '2016-09-03 14:50:49'),
(6, 'Cyan', '#49afcd', 'cyan.png', 1, '2016-09-03 14:51:31', '2016-09-03 14:51:31'),
(7, 'Blue', '#006dcc', 'blue.png', 1, '2016-09-03 14:52:05', '2016-09-03 14:52:05');

-- --------------------------------------------------------

--
-- Table structure for table `gem_country`
--

CREATE TABLE IF NOT EXISTS `gem_country` (
`id` int(10) unsigned NOT NULL,
  `country_code` varchar(10) NOT NULL,
  `country_name` varchar(50) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active, 2=>deleted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=247 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gem_country`
--

INSERT INTO `gem_country` (`id`, `country_code`, `country_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'AF', 'Afghanistan', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(2, 'AL', 'Albania', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(3, 'DZ', 'Algeria', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(4, 'DS', 'American Samoa', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(5, 'AD', 'Andorra', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(6, 'AO', 'Angola', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(7, 'AI', 'Anguilla', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(8, 'AQ', 'Antarctica', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(9, 'AG', 'Antigua and Barbuda', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(10, 'AR', 'Argentina', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(11, 'AM', 'Armenia', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(12, 'AW', 'Aruba', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(13, 'AU', 'Australia', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(14, 'AT', 'Austria', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(15, 'AZ', 'Azerbaijan', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(16, 'BS', 'Bahamas', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(17, 'BH', 'Bahrain', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(18, 'BD', 'Bangladesh', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(19, 'BB', 'Barbados', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(20, 'BY', 'Belarus', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(21, 'BE', 'Belgium', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(22, 'BZ', 'Belize', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(23, 'BJ', 'Benin', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(24, 'BM', 'Bermuda', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(25, 'BT', 'Bhutan', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(26, 'BO', 'Bolivia', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(27, 'BA', 'Bosnia and Herzegovina', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(28, 'BW', 'Botswana', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(29, 'BV', 'Bouvet Island', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(30, 'BR', 'Brazil', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(31, 'IO', 'British Indian Ocean Territory', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(32, 'BN', 'Brunei Darussalam', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(33, 'BG', 'Bulgaria', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(34, 'BF', 'Burkina Faso', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(35, 'BI', 'Burundi', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(36, 'KH', 'Cambodia', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(37, 'CM', 'Cameroon', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(38, 'CA', 'Canada', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(39, 'CV', 'Cape Verde', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(40, 'KY', 'Cayman Islands', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(41, 'CF', 'Central African Republic', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(42, 'TD', 'Chad', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(43, 'CL', 'Chile', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(44, 'CN', 'China', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(45, 'CX', 'Christmas Island', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(46, 'CC', 'Cocos (Keeling) Islands', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(47, 'CO', 'Colombia', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(48, 'KM', 'Comoros', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(49, 'CG', 'Congo', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(50, 'CK', 'Cook Islands', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(51, 'CR', 'Costa Rica', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(52, 'HR', 'Croatia (Hrvatska)', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(53, 'CU', 'Cuba', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(54, 'CY', 'Cyprus', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(55, 'CZ', 'Czech Republic', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(56, 'DK', 'Denmark', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(57, 'DJ', 'Djibouti', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(58, 'DM', 'Dominica', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(59, 'DO', 'Dominican Republic', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(60, 'TP', 'East Timor', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(61, 'EC', 'Ecuador', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(62, 'EG', 'Egypt', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(63, 'SV', 'El Salvador', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(64, 'GQ', 'Equatorial Guinea', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(65, 'ER', 'Eritrea', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(66, 'EE', 'Estonia', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(67, 'ET', 'Ethiopia', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(68, 'FK', 'Falkland Islands (Malvinas)', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(69, 'FO', 'Faroe Islands', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(70, 'FJ', 'Fiji', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(71, 'FI', 'Finland', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(72, 'FR', 'France', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(73, 'FX', 'France, Metropolitan', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(74, 'GF', 'French Guiana', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(75, 'PF', 'French Polynesia', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(76, 'TF', 'French Southern Territories', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(77, 'GA', 'Gabon', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(78, 'GM', 'Gambia', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(79, 'GE', 'Georgia', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(80, 'DE', 'Germany', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(81, 'GH', 'Ghana', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(82, 'GI', 'Gibraltar', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(83, 'GK', 'Guernsey', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(84, 'GR', 'Greece', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(85, 'GL', 'Greenland', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(86, 'GD', 'Grenada', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(87, 'GP', 'Guadeloupe', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(88, 'GU', 'Guam', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(89, 'GT', 'Guatemala', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(90, 'GN', 'Guinea', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(91, 'GW', 'Guinea-Bissau', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(92, 'GY', 'Guyana', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(93, 'HT', 'Haiti', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(94, 'HM', 'Heard and Mc Donald Islands', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(95, 'HN', 'Honduras', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(96, 'HK', 'Hong Kong', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(97, 'HU', 'Hungary', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(98, 'IS', 'Iceland', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(99, 'IN', 'India', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(100, 'IM', 'Isle of Man', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(101, 'ID', 'Indonesia', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(102, 'IR', 'Iran (Islamic Republic of)', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(103, 'IQ', 'Iraq', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(104, 'IE', 'Ireland', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(105, 'IL', 'Israel', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(106, 'IT', 'Italy', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(107, 'CI', 'Ivory Coast', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(108, 'JE', 'Jersey', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(109, 'JM', 'Jamaica', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(110, 'JP', 'Japan', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(111, 'JO', 'Jordan', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(112, 'KZ', 'Kazakhstan', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(113, 'KE', 'Kenya', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(114, 'KI', 'Kiribati', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(115, 'KP', 'Korea, Democratic People''s Republic of', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(116, 'KR', 'Korea, Republic of', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(117, 'XK', 'Kosovo', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(118, 'KW', 'Kuwait', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(119, 'KG', 'Kyrgyzstan', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(120, 'LA', 'Lao People''s Democratic Republic', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(121, 'LV', 'Latvia', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(122, 'LB', 'Lebanon', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(123, 'LS', 'Lesotho', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(124, 'LR', 'Liberia', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(125, 'LY', 'Libyan Arab Jamahiriya', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(126, 'LI', 'Liechtenstein', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(127, 'LT', 'Lithuania', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(128, 'LU', 'Luxembourg', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(129, 'MO', 'Macau', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(130, 'MK', 'Macedonia', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(131, 'MG', 'Madagascar', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(132, 'MW', 'Malawi', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(133, 'MY', 'Malaysia', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(134, 'MV', 'Maldives', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(135, 'ML', 'Mali', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(136, 'MT', 'Malta', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(137, 'MH', 'Marshall Islands', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(138, 'MQ', 'Martinique', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(139, 'MR', 'Mauritania', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(140, 'MU', 'Mauritius', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(141, 'TY', 'Mayotte', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(142, 'MX', 'Mexico', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(143, 'FM', 'Micronesia, Federated States of', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(144, 'MD', 'Moldova, Republic of', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(145, 'MC', 'Monaco', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(146, 'MN', 'Mongolia', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(147, 'ME', 'Montenegro', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(148, 'MS', 'Montserrat', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(149, 'MA', 'Morocco', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(150, 'MZ', 'Mozambique', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(151, 'MM', 'Myanmar', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(152, 'NA', 'Namibia', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(153, 'NR', 'Nauru', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(154, 'NP', 'Nepal', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(155, 'NL', 'Netherlands', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(156, 'AN', 'Netherlands Antilles', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(157, 'NC', 'New Caledonia', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(158, 'NZ', 'New Zealand', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(159, 'NI', 'Nicaragua', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(160, 'NE', 'Niger', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(161, 'NG', 'Nigeria', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(162, 'NU', 'Niue', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(163, 'NF', 'Norfolk Island', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(164, 'MP', 'Northern Mariana Islands', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(165, 'NO', 'Norway', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(166, 'OM', 'Oman', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(167, 'PK', 'Pakistan', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(168, 'PW', 'Palau', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(169, 'PS', 'Palestine', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(170, 'PA', 'Panama', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(171, 'PG', 'Papua New Guinea', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(172, 'PY', 'Paraguay', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(173, 'PE', 'Peru', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(174, 'PH', 'Philippines', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(175, 'PN', 'Pitcairn', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(176, 'PL', 'Poland', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(177, 'PT', 'Portugal', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(178, 'PR', 'Puerto Rico', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(179, 'QA', 'Qatar', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(180, 'RE', 'Reunion', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(181, 'RO', 'Romania', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(182, 'RU', 'Russian Federation', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(183, 'RW', 'Rwanda', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(184, 'KN', 'Saint Kitts and Nevis', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(185, 'LC', 'Saint Lucia', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(186, 'VC', 'Saint Vincent and the Grenadines', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(187, 'WS', 'Samoa', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(188, 'SM', 'San Marino', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(189, 'ST', 'Sao Tome and Principe', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(190, 'SA', 'Saudi Arabia', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(191, 'SN', 'Senegal', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(192, 'RS', 'Serbia', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(193, 'SC', 'Seychelles', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(194, 'SL', 'Sierra Leone', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(195, 'SG', 'Singapore', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(196, 'SK', 'Slovakia', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(197, 'SI', 'Slovenia', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(198, 'SB', 'Solomon Islands', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(199, 'SO', 'Somalia', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(200, 'ZA', 'South Africa', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(201, 'GS', 'South Georgia South Sandwich Islands', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(202, 'ES', 'Spain', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(203, 'LK', 'Sri Lanka', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(204, 'SH', 'St. Helena', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(205, 'PM', 'St. Pierre and Miquelon', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(206, 'SD', 'Sudan', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(207, 'SR', 'Suriname', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(208, 'SJ', 'Svalbard and Jan Mayen Islands', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(209, 'SZ', 'Swaziland', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(210, 'SE', 'Sweden', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(211, 'CH', 'Switzerland', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(212, 'SY', 'Syrian Arab Republic', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(213, 'TW', 'Taiwan', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(214, 'TJ', 'Tajikistan', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(215, 'TZ', 'Tanzania, United Republic of', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(216, 'TH', 'Thailand', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(217, 'TG', 'Togo', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(218, 'TK', 'Tokelau', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(219, 'TO', 'Tonga', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(220, 'TT', 'Trinidad and Tobago', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(221, 'TN', 'Tunisia', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(222, 'TR', 'Turkey', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(223, 'TM', 'Turkmenistan', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(224, 'TC', 'Turks and Caicos Islands', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(225, 'TV', 'Tuvalu', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(226, 'UG', 'Uganda', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(227, 'UA', 'Ukraine', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(228, 'AE', 'United Arab Emirates', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(229, 'GB', 'United Kingdom', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(230, 'US', 'United States', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(231, 'UM', 'United States minor outlying islands', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(232, 'UY', 'Uruguay', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(233, 'UZ', 'Uzbekistan', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(234, 'VU', 'Vanuatu', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(235, 'VA', 'Vatican City State', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(236, 'VE', 'Venezuela', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(237, 'VN', 'Vietnam', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(238, 'VG', 'Virgin Islands (British)', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(239, 'VI', 'Virgin Islands (U.S.)', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(240, 'WF', 'Wallis and Futuna Islands', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(241, 'EH', 'Western Sahara', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(242, 'YE', 'Yemen', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(243, 'YU', 'Yugoslavia', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(244, 'ZR', 'Zaire', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(245, 'ZM', 'Zambia', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28'),
(246, 'ZW', 'Zimbabwe', 1, '2016-08-08 23:58:28', '2016-08-08 23:58:28');

-- --------------------------------------------------------

--
-- Table structure for table `gem_cuttings`
--

CREATE TABLE IF NOT EXISTS `gem_cuttings` (
`id` smallint(5) unsigned NOT NULL,
  `name` varchar(150) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL COMMENT '0=>Inactive, 1=>Active, 2=>deleted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gem_cuttings`
--

INSERT INTO `gem_cuttings` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Marquis Cut', 1, '2016-09-03 15:10:13', '2016-09-03 15:10:13'),
(2, 'Cushion Cut', 1, '2016-09-03 15:10:13', '2016-09-03 15:10:13'),
(3, 'Test Cut', 0, '2016-10-21 07:53:30', '2016-10-21 10:15:31');

-- --------------------------------------------------------

--
-- Table structure for table `gem_gemstone_species`
--

CREATE TABLE IF NOT EXISTS `gem_gemstone_species` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(150) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active, 2=>deleted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gem_gemstone_species`
--

INSERT INTO `gem_gemstone_species` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Cabochons', 1, '2016-09-03 12:22:10', '2016-09-03 12:22:10'),
(2, 'Gemstones', 1, '2016-09-03 12:22:10', '2016-09-03 12:22:10'),
(3, 'dsfcdsf', 1, '2017-01-07 08:11:31', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `gem_messages`
--

CREATE TABLE IF NOT EXISTS `gem_messages` (
`id` int(10) unsigned NOT NULL,
  `sender_id` int(10) unsigned NOT NULL,
  `receiver_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned DEFAULT NULL,
  `message` text NOT NULL,
  `reply_text` text,
  `is_replied` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0=>no, 1=>Yes',
  `status` tinyint(3) unsigned NOT NULL COMMENT '1=>Active, 2=>deleted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gem_messages`
--

INSERT INTO `gem_messages` (`id`, `sender_id`, `receiver_id`, `product_id`, `message`, `reply_text`, `is_replied`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, NULL, 'I want to by Gemstone blue colorI want to by Gemstone blue colorI want to by Gemstone blue colorI want to by Gemstone blue colorI want to by Gemstone blue colorI want to by Gemstone blue colorI want to by Gemstone blue color', 'Thanks for give a chance to me', 1, 1, '2016-09-11 01:17:46', '2016-09-11 02:20:54'),
(2, 2, 1, NULL, 'I want to purchase in whole sale to do own business', 'dgf dgf dfgd', 1, 1, '2016-09-11 01:22:20', '2017-01-05 13:25:29');

-- --------------------------------------------------------

--
-- Table structure for table `gem_offers`
--

CREATE TABLE IF NOT EXISTS `gem_offers` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(3) unsigned NOT NULL COMMENT '0=>Inactive, 1=>Active, 2=>deleted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gem_offers`
--

INSERT INTO `gem_offers` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'First Offer', 'First OfferFirst OfferFirst OfferFirst OfferFirst OfferFirst OfferFirst OfferFirst OfferFirst OfferFirst OfferFirst OfferFirst OfferFirst OfferFirst OfferFirst OfferFirst OfferFirst OfferFirst OfferFirst OfferFirst OfferFirst OfferFirst OfferFirst OfferFirst OfferFirst Offer', 1, '2016-09-03 15:20:48', '2016-09-03 15:20:48'),
(2, 'Second Offer', 'Second OfferSecond OfferSecond OfferSecond OfferSecond OfferSecond OfferSecond OfferSecond OfferSecond OfferSecond OfferSecond OfferSecond OfferSecond OfferSecond OfferSecond OfferSecond OfferSecond OfferSecond OfferSecond OfferSecond OfferSecond OfferSecond OfferSecond OfferSecond OfferSecond OfferSecond OfferSecond OfferSecond OfferSecond OfferSecond OfferSecond OfferSecond OfferSecond OfferSecond Offer', 1, '2016-09-03 15:20:48', '2016-09-03 15:20:48');

-- --------------------------------------------------------

--
-- Table structure for table `gem_products`
--

CREATE TABLE IF NOT EXISTS `gem_products` (
`id` int(10) unsigned NOT NULL,
  `title` varchar(200) NOT NULL,
  `store_id` int(10) unsigned NOT NULL,
  `gemstone_price` float unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `gemspecies_id` int(10) unsigned DEFAULT NULL,
  `stone_ID` varchar(30) DEFAULT NULL,
  `weight` double unsigned NOT NULL,
  `height` float unsigned NOT NULL,
  `width` float unsigned NOT NULL,
  `length` float unsigned NOT NULL,
  `shape` smallint(5) unsigned DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `cutting` smallint(5) unsigned DEFAULT NULL,
  `treatment` smallint(5) unsigned DEFAULT NULL,
  `clarity` smallint(5) unsigned DEFAULT NULL,
  `transparency` smallint(5) unsigned DEFAULT NULL,
  `geo_origin` varchar(150) DEFAULT NULL,
  `certificate` smallint(5) unsigned DEFAULT NULL,
  `offer_id` int(10) unsigned DEFAULT NULL,
  `country_id` int(10) unsigned DEFAULT NULL,
  `state_id` int(10) unsigned DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `description` text,
  `status` tinyint(3) unsigned NOT NULL COMMENT '0=>Inactive, 1=>Active, 2=>deleted',
  `is_negotiable` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1=>Yes, 2=>No',
  `total_viewed` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gem_products`
--

INSERT INTO `gem_products` (`id`, `title`, `store_id`, `gemstone_price`, `category_id`, `gemspecies_id`, `stone_ID`, `weight`, `height`, `width`, `length`, `shape`, `color`, `cutting`, `treatment`, `clarity`, `transparency`, `geo_origin`, `certificate`, `offer_id`, `country_id`, `state_id`, `city`, `description`, `status`, `is_negotiable`, `total_viewed`, `created_at`, `updated_at`) VALUES
(1, '40 pts Natural denm', 1, 33, 1, 1, NULL, 15.1, 23, 23, 21, 3, '::5::6::7::', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NATURAL GARNET GEMSTONE with cubic zirconia accent stones\r\nRING IS STERLING SILVER STAMPED HALLMARK 925\r\nIMAGE IS OF THE EXACT RING YOU WILL RECEIVE', 1, 1, 0, '2016-09-11 02:10:39', '2016-09-18 22:04:01'),
(2, '50 cts Natural colombia', 1, 34, 3, 2, NULL, 23, 2, 3, 5, 4, '::3::4::7::', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 3, '2016-09-11 02:44:16', '2016-09-18 22:03:55'),
(3, '50 cts Natural colombia', 1, 225, 2, 1, 'KOJ22563', 1.52, 1, 25, 1, 2, '::7::6::5::', 2, 1, 2, 2, 'jjh', 1, 1, 99, 1, 'New Delhi', NULL, 1, 2, 3, '2016-09-19 10:49:26', '2016-11-11 23:40:12'),
(4, '12 gemauction color fok CCC', 2, 12, 3, 1, NULL, 1, 1, 1, 1, NULL, '::2::', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, '2016-11-12 00:15:49', '2016-11-12 00:15:57'),
(5, 'Ruby 345 color Pink Demand', 2, 40, 44, 2, NULL, 2, 2, 2, 2, NULL, '::1::', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, '2016-11-12 00:17:30', '2016-11-12 00:26:04'),
(6, 'Ruby 345 color Pink Demand', 2, 40, 44, 2, NULL, 2, 2, 2, 2, NULL, '::7::6::', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 9, '2016-11-12 00:19:47', '2016-11-12 00:25:30');

-- --------------------------------------------------------

--
-- Table structure for table `gem_product_gallery`
--

CREATE TABLE IF NOT EXISTS `gem_product_gallery` (
`id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'file name',
  `type` varchar(150) NOT NULL COMMENT 'file type',
  `size` varchar(30) NOT NULL COMMENT 'file size',
  `height` varchar(10) DEFAULT NULL,
  `width` varchar(10) DEFAULT NULL,
  `is_primary` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gem_product_gallery`
--

INSERT INTO `gem_product_gallery` (`id`, `product_id`, `name`, `type`, `size`, `height`, `width`, `is_primary`, `created_at`, `updated_at`) VALUES
(1, 1, 'gem-trafghanite1.jpg', '.jpg', '51.81', '490', '640', 0, '2016-09-11 02:11:40', '2016-09-11 02:11:49'),
(2, 1, 'gem-trafghanite11.jpg', '.jpg', '42.03', '501', '640', 1, '2016-09-11 02:11:46', '2016-09-11 02:11:49'),
(3, 2, 'gem-tralexandrite2.jpg', '.jpg', '11.94', '300', '400', 1, '2016-09-11 02:45:20', '2016-09-11 02:45:34'),
(4, 2, 'gem-tralexandrite21.jpg', '.jpg', '15.19', '300', '400', 0, '2016-09-11 02:45:24', '2016-09-11 02:45:34'),
(5, 3, 'gem-tragate3.jpg', '.jpg', '757.52', '768', '1024', 1, '2016-09-19 10:50:07', '2016-09-19 10:51:37'),
(6, 4, 'gem-woalexandrite4.jpg', '.jpg', '58.62', '480', '640', 1, '2016-11-12 00:16:13', '2016-11-12 00:16:28'),
(7, 5, 'gem-wodruzy5.jpg', '.jpg', '15.19', '300', '400', 1, '2016-11-12 00:20:15', '2016-11-12 00:20:18'),
(8, 6, 'gem-wodruzy6.jpg', '.jpg', '42.03', '501', '640', 1, '2016-11-12 00:20:38', '2016-11-12 00:20:40');

-- --------------------------------------------------------

--
-- Table structure for table `gem_shapes`
--

CREATE TABLE IF NOT EXISTS `gem_shapes` (
`id` smallint(5) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL COMMENT '0=>Inactive, 1=>Active, 2=>deleted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gem_shapes`
--

INSERT INTO `gem_shapes` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Round', 1, '2016-09-03 13:27:35', '2016-09-03 13:27:35'),
(2, 'Oval Cut', 1, '2016-09-03 13:27:35', '2016-09-03 13:27:35'),
(3, 'Marquise Cut', 1, '2016-09-03 13:28:28', '2016-09-03 13:28:28'),
(4, 'Pear Shaped', 1, '2016-09-03 13:28:28', '2016-09-03 13:28:28');

-- --------------------------------------------------------

--
-- Table structure for table `gem_states`
--

CREATE TABLE IF NOT EXISTS `gem_states` (
`id` int(10) unsigned NOT NULL,
  `country_id` int(10) unsigned NOT NULL,
  `state_name` varchar(50) NOT NULL,
  `state_code` varchar(10) DEFAULT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active, 2=>deleted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gem_states`
--

INSERT INTO `gem_states` (`id`, `country_id`, `state_name`, `state_code`, `status`, `created_at`, `updated_at`) VALUES
(1, 99, 'Delhi', 'DL', 1, '2016-08-27 11:28:12', '2016-08-27 11:28:12'),
(2, 99, 'Gujrat', NULL, 1, '2016-08-27 11:28:12', '2016-08-27 11:28:12'),
(3, 13, 'South Australia', 'SA', 1, '2016-08-28 15:32:55', '2016-08-28 15:32:55'),
(4, 13, 'Queensland', NULL, 1, '2016-08-28 15:34:34', '2016-08-28 15:34:34'),
(5, 13, 'Victoria', NULL, 1, '2016-08-28 15:34:34', '2016-08-28 15:34:34'),
(6, 13, 'New South Wales', NULL, 1, '2016-08-28 15:35:18', '2016-08-28 15:35:18');

-- --------------------------------------------------------

--
-- Table structure for table `gem_stores`
--

CREATE TABLE IF NOT EXISTS `gem_stores` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(150) NOT NULL,
  `address` varchar(150) NOT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state_id` int(10) unsigned NOT NULL DEFAULT '0',
  `country_id` int(10) unsigned NOT NULL DEFAULT '0',
  `zipcode` varchar(15) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `payment_options` varchar(60) DEFAULT NULL,
  `about_store` text,
  `status` tinyint(1) unsigned NOT NULL COMMENT '0=>Inactive, 1=>Active, 2=>deleted',
  `is_featured` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=>not featured, 1=>featured',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gem_stores`
--

INSERT INTO `gem_stores` (`id`, `user_id`, `name`, `address`, `city`, `state_id`, `country_id`, `zipcode`, `contact_no`, `logo`, `payment_options`, `about_store`, `status`, `is_featured`, `created_at`, `updated_at`) VALUES
(1, 1, 'Gem traders', 'Street road no 21', 'South Bank', 4, 13, '23456', '8745323456', 'gem-traders-1.png', '::2::3::1::', 'VERY UNIQUE PATTERN BLOB SHAPE FORMED WHEN HEATED AT SMELTERVERY UNIQUE PATTERN BLOB SHAPE FORMED WHEN HEATED AT SMELTERVERY UNIQUE PATTERN BLOB SHAPE FORMED WHEN HEATED AT SMELTER', 1, 1, '2016-09-11 02:00:09', '2016-12-31 00:52:53'),
(2, 2, 'Gem World', 'Street no 40', 'Melbourn', 6, 13, '12345', '2345678912', 'gem-world-2.jpg', NULL, '', 1, 1, '2016-11-11 23:52:24', '2016-11-11 23:55:00');

-- --------------------------------------------------------

--
-- Table structure for table `gem_transparency`
--

CREATE TABLE IF NOT EXISTS `gem_transparency` (
`id` smallint(5) unsigned NOT NULL,
  `name` varchar(150) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL COMMENT '0=>Inactive, 1=>Active, 2=>deleted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gem_transparency`
--

INSERT INTO `gem_transparency` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'near opaque', 1, '2016-09-03 15:15:42', '2016-09-03 15:15:42'),
(2, 'almost transparent', 1, '2016-09-03 15:15:42', '2016-09-03 15:15:42');

-- --------------------------------------------------------

--
-- Table structure for table `gem_treatments`
--

CREATE TABLE IF NOT EXISTS `gem_treatments` (
`id` smallint(5) unsigned NOT NULL,
  `name` varchar(150) NOT NULL,
  `status` tinyint(10) unsigned NOT NULL COMMENT '0=>Inactive, 1=>Active, 2=>deleted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gem_treatments`
--

INSERT INTO `gem_treatments` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Heat', 1, '2016-09-03 15:16:52', '2016-09-03 15:16:52'),
(2, 'Waxing/oiling', 1, '2016-09-03 15:16:52', '2016-09-03 15:16:52');

-- --------------------------------------------------------

--
-- Table structure for table `gem_whishlist`
--

CREATE TABLE IF NOT EXISTS `gem_whishlist` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL COMMENT '0=>Not in whislist, 1=>In whislist, 2=>deleted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gem_whishlist`
--

INSERT INTO `gem_whishlist` (`id`, `user_id`, `product_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2016-09-11 01:23:09', '2016-09-11 02:23:27');

-- --------------------------------------------------------

--
-- Table structure for table `ofo_categories`
--

CREATE TABLE IF NOT EXISTS `ofo_categories` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active, 2=>deleted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ofo_categories`
--

INSERT INTO `ofo_categories` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Afghanite', 1, '2016-08-08 21:59:51', '2016-08-08 21:59:51'),
(2, 'Agate', 1, '2016-08-08 22:00:49', '2016-08-08 22:00:49'),
(3, 'Alexandrite', 1, '2016-08-08 22:01:27', '2016-08-08 22:01:27'),
(4, 'Amazonite', 1, '2016-08-08 19:09:40', '0000-00-00 00:00:00'),
(5, 'Amber', 1, '2016-08-08 19:10:10', '0000-00-00 00:00:00'),
(6, 'Amethyst', 2, '2016-08-08 19:11:27', '2016-08-08 19:18:15'),
(7, 'Ametrine', 1, '2016-08-08 19:15:51', '2016-08-08 19:16:03'),
(8, 'Ammonite', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(9, 'Ancient Artifacts', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(10, 'Andalusite', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(11, 'Andesine Feldspar', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(12, 'Apatite', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(13, 'Aquamarine', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(14, 'Aventurine', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(15, 'Azurite', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(16, 'Azurite with Malachite', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(17, 'Bastnasite', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(18, 'Beads', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(19, 'Benitoite', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(20, 'Beryl', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(21, 'Black Star Diopside', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(22, 'Bloodstone', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(23, 'Calcite', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(24, 'Calligraphy Stone', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(25, 'Carnelian', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(26, 'Carvings', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(27, 'Cavansite', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(28, 'Chalcedony', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(29, 'Charoite           \r\n                                                Chrome Diopside', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(30, 'Chrysanthemum Flower Stone', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(31, 'Chrysoberyl', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(32, 'Chrysocolla', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(33, 'Chrysoprase', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(34, 'Citrine', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(35, 'Collectibles', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(36, 'Coral', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(37, 'Crinoid', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(38, 'Crystal Skulls', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(39, 'Crystals', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(40, 'Danburite', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(41, 'Diamonds', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(42, 'Diaspore', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(43, 'Dioptase', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(44, 'Druzy', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(45, 'Emerald', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(46, 'Eudialyte', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(47, 'Exceptional Gemstones', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(48, 'Fire Agate', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(49, 'Fluorite', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(50, 'Fossickers Delight', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(51, 'Fossils', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(52, 'Fuchsite', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(53, 'Garnet', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(54, 'Gemstone Display Cases', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(55, 'Gemstone Posters', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(56, 'Gemstone Sample Box', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(57, 'Geodes', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(58, 'Gold', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(59, 'Hackmanite', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(60, 'Heliodor', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(61, 'Hematite', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(62, 'Hiddenite', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(63, 'Himalayan Salt', 1, '2016-09-11 17:21:26', '2016-09-11 17:21:26'),
(64, 'Holistic Gemstones', 1, '2016-09-11 17:21:26', '2016-09-17 08:27:37');

-- --------------------------------------------------------

--
-- Table structure for table `ofo_city`
--

CREATE TABLE IF NOT EXISTS `ofo_city` (
`id` int(10) unsigned NOT NULL,
  `city_name` varchar(50) NOT NULL,
  `state_id` int(10) unsigned NOT NULL,
  `country_id` int(10) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active, 2=>deleted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ofo_product_colors`
--

CREATE TABLE IF NOT EXISTS `ofo_product_colors` (
`id` int(10) unsigned NOT NULL,
  `color_name` varchar(50) NOT NULL,
  `color_code` varchar(10) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL COMMENT '0=>Inactive, 1=>Active, 2=>deleted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ofo_sub_categories`
--

CREATE TABLE IF NOT EXISTS `ofo_sub_categories` (
`id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0=>Inactive, 1=>Active, 2=>deleted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ofo_sub_categories`
--

INSERT INTO `ofo_sub_categories` (`id`, `category_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'ewrew', 1, '2017-01-07 08:27:41', '0000-00-00 00:00:00'),
(2, 1, 'demo', 1, '2017-01-07 08:28:24', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ofo_users`
--

CREATE TABLE IF NOT EXISTS `ofo_users` (
`id` int(10) unsigned NOT NULL,
  `title` varchar(5) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_no` varchar(15) DEFAULT NULL,
  `skypeid` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1=>Buyer, 2=>Seller',
  `token` varchar(255) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0=>Inactive, 1=>Active, 2=>deleted,3=>New Users',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ofo_users`
--

INSERT INTO `ofo_users` (`id`, `title`, `name`, `email`, `contact_no`, `skypeid`, `password`, `user_type`, `token`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Mr', 'Ajeet', 'ajeet3@gmail.com', NULL, NULL, '$2y$10$fKGetvoic9.bHoWt9FyrZOFnfyN33jhAPhK1pffGZ7lyXTjwgzAv2', 1, '7fd21860191a915cfbe34d10e8bd47d0', 1, '2016-09-11 01:40:45', '2016-09-11 01:41:04'),
(2, 'Mr', 'Kumar Ajeet', 'ajtk1986@gmail.com', NULL, NULL, '$2y$10$fKGetvoic9.bHoWt9FyrZOFnfyN33jhAPhK1pffGZ7lyXTjwgzAv2', 1, '2b37ca1ec81c0c8c15120475d8ef99a2', 1, '2016-09-11 02:14:49', '2016-09-11 02:14:57'),
(3, 'Mr', 'Manish', 'manish1155@gmail.com', NULL, NULL, '$2y$10$lt4mCEJK6GtBCFUyjH2OQun8A6ZCN3ajm6qTLjyofSb3K7m0tjOGu', 1, '364b0dbe9e66b7e0563de2c5457461ff', 1, '2016-10-21 07:43:17', '2016-10-21 07:46:55'),
(4, 'Mr', 'Saurabh', 'easilygetintouch@gmail.com', NULL, NULL, '$2y$10$2I26M8OOq7Iv30vep9zvUeXGn/QtVz01NkI73clYoFPlliGnX0.nC', 1, '7ec1ceeb00e49bfc349462a093bbfd1f', 1, '2016-10-21 10:04:58', '2016-10-21 10:06:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
 ADD PRIMARY KEY (`iso`), ADD KEY `id` (`id`), ADD KEY `id_2` (`id`);

--
-- Indexes for table `gem_buying_options`
--
ALTER TABLE `gem_buying_options`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gem_categories`
--
ALTER TABLE `gem_categories`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gem_certificates`
--
ALTER TABLE `gem_certificates`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gem_clarities`
--
ALTER TABLE `gem_clarities`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gem_colors`
--
ALTER TABLE `gem_colors`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gem_country`
--
ALTER TABLE `gem_country`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gem_cuttings`
--
ALTER TABLE `gem_cuttings`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gem_gemstone_species`
--
ALTER TABLE `gem_gemstone_species`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gem_messages`
--
ALTER TABLE `gem_messages`
 ADD PRIMARY KEY (`id`), ADD KEY `sender_id` (`sender_id`), ADD KEY `receiver_id` (`receiver_id`), ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `gem_offers`
--
ALTER TABLE `gem_offers`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gem_products`
--
ALTER TABLE `gem_products`
 ADD PRIMARY KEY (`id`), ADD KEY `store_id` (`store_id`), ADD KEY `category_id` (`category_id`), ADD KEY `gemspecies_id` (`gemspecies_id`), ADD KEY `state_id` (`state_id`), ADD KEY `shape` (`shape`), ADD KEY `cutting` (`cutting`), ADD KEY `treatments` (`treatment`), ADD KEY `clarity` (`clarity`), ADD KEY `transparency` (`transparency`), ADD KEY `country_id` (`country_id`), ADD KEY `certificate` (`certificate`), ADD KEY `offer_id` (`offer_id`);

--
-- Indexes for table `gem_product_gallery`
--
ALTER TABLE `gem_product_gallery`
 ADD PRIMARY KEY (`id`), ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `gem_shapes`
--
ALTER TABLE `gem_shapes`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gem_states`
--
ALTER TABLE `gem_states`
 ADD PRIMARY KEY (`id`), ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `gem_stores`
--
ALTER TABLE `gem_stores`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`), ADD KEY `state_id` (`state_id`), ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `gem_transparency`
--
ALTER TABLE `gem_transparency`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gem_treatments`
--
ALTER TABLE `gem_treatments`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gem_whishlist`
--
ALTER TABLE `gem_whishlist`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`), ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `ofo_categories`
--
ALTER TABLE `ofo_categories`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ofo_city`
--
ALTER TABLE `ofo_city`
 ADD PRIMARY KEY (`id`), ADD KEY `state_id` (`state_id`), ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `ofo_product_colors`
--
ALTER TABLE `ofo_product_colors`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ofo_sub_categories`
--
ALTER TABLE `ofo_sub_categories`
 ADD PRIMARY KEY (`id`), ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `ofo_users`
--
ALTER TABLE `ofo_users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=240;
--
-- AUTO_INCREMENT for table `gem_buying_options`
--
ALTER TABLE `gem_buying_options`
MODIFY `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `gem_categories`
--
ALTER TABLE `gem_categories`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `gem_certificates`
--
ALTER TABLE `gem_certificates`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gem_clarities`
--
ALTER TABLE `gem_clarities`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gem_colors`
--
ALTER TABLE `gem_colors`
MODIFY `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `gem_country`
--
ALTER TABLE `gem_country`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=247;
--
-- AUTO_INCREMENT for table `gem_cuttings`
--
ALTER TABLE `gem_cuttings`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `gem_gemstone_species`
--
ALTER TABLE `gem_gemstone_species`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `gem_messages`
--
ALTER TABLE `gem_messages`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gem_offers`
--
ALTER TABLE `gem_offers`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gem_products`
--
ALTER TABLE `gem_products`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `gem_product_gallery`
--
ALTER TABLE `gem_product_gallery`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `gem_shapes`
--
ALTER TABLE `gem_shapes`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `gem_states`
--
ALTER TABLE `gem_states`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `gem_stores`
--
ALTER TABLE `gem_stores`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gem_transparency`
--
ALTER TABLE `gem_transparency`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gem_treatments`
--
ALTER TABLE `gem_treatments`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gem_whishlist`
--
ALTER TABLE `gem_whishlist`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ofo_categories`
--
ALTER TABLE `ofo_categories`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `ofo_city`
--
ALTER TABLE `ofo_city`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ofo_product_colors`
--
ALTER TABLE `ofo_product_colors`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ofo_sub_categories`
--
ALTER TABLE `ofo_sub_categories`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ofo_users`
--
ALTER TABLE `ofo_users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `gem_messages`
--
ALTER TABLE `gem_messages`
ADD CONSTRAINT `gem_messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `ofo_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `gem_messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `ofo_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `gem_messages_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `gem_products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `gem_products`
--
ALTER TABLE `gem_products`
ADD CONSTRAINT `gem_products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `ofo_categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `gem_products_ibfk_10` FOREIGN KEY (`clarity`) REFERENCES `gem_clarities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `gem_products_ibfk_11` FOREIGN KEY (`transparency`) REFERENCES `gem_transparency` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `gem_products_ibfk_12` FOREIGN KEY (`certificate`) REFERENCES `gem_certificates` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `gem_products_ibfk_13` FOREIGN KEY (`offer_id`) REFERENCES `gem_offers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `gem_products_ibfk_14` FOREIGN KEY (`country_id`) REFERENCES `gem_country` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `gem_products_ibfk_3` FOREIGN KEY (`store_id`) REFERENCES `gem_stores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `gem_products_ibfk_4` FOREIGN KEY (`gemspecies_id`) REFERENCES `gem_gemstone_species` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `gem_products_ibfk_5` FOREIGN KEY (`state_id`) REFERENCES `gem_states` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `gem_products_ibfk_6` FOREIGN KEY (`shape`) REFERENCES `gem_shapes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `gem_products_ibfk_8` FOREIGN KEY (`cutting`) REFERENCES `gem_cuttings` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `gem_products_ibfk_9` FOREIGN KEY (`treatment`) REFERENCES `gem_treatments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `gem_product_gallery`
--
ALTER TABLE `gem_product_gallery`
ADD CONSTRAINT `gem_product_gallery_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `gem_products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `gem_states`
--
ALTER TABLE `gem_states`
ADD CONSTRAINT `gem_states_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `gem_country` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `gem_stores`
--
ALTER TABLE `gem_stores`
ADD CONSTRAINT `gem_stores_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `ofo_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `gem_stores_ibfk_3` FOREIGN KEY (`state_id`) REFERENCES `gem_states` (`id`),
ADD CONSTRAINT `gem_stores_ibfk_4` FOREIGN KEY (`country_id`) REFERENCES `gem_country` (`id`);

--
-- Constraints for table `gem_whishlist`
--
ALTER TABLE `gem_whishlist`
ADD CONSTRAINT `gem_whishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `ofo_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `gem_whishlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `gem_products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ofo_city`
--
ALTER TABLE `ofo_city`
ADD CONSTRAINT `ofo_city_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `gem_states` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `ofo_city_ibfk_2` FOREIGN KEY (`country_id`) REFERENCES `gem_country` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ofo_sub_categories`
--
ALTER TABLE `ofo_sub_categories`
ADD CONSTRAINT `ofo_sub_categories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `ofo_categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
