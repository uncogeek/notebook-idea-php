-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 30, 2021 at 05:18 PM
-- Server version: 8.0.18
-- PHP Version: 7.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `idea_notes`
--
CREATE DATABASE IF NOT EXISTS `idea_notes` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `idea_notes`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_config`
--

DROP TABLE IF EXISTS `tbl_config`;
CREATE TABLE IF NOT EXISTS `tbl_config` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `page_title` varchar(100) NOT NULL,
  `button_submit_title` varchar(100) DEFAULT NULL,
  `color_button_submit` varchar(100) DEFAULT NULL,
  `navigation_color_bg` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_config`
--

INSERT INTO `tbl_config` (`id`, `page_title`, `button_submit_title`, `color_button_submit`, `navigation_color_bg`) VALUES
(1, 'ایده های من', 'ثبت کن', '#4674FF', '#005D5D');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_idea`
--

DROP TABLE IF EXISTS `tbl_idea`;
CREATE TABLE IF NOT EXISTS `tbl_idea` (
  `id` mediumint(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `link_name` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `link_address` text CHARACTER SET utf8 COLLATE utf8_persian_ci,
  `category` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `tbl_idea`
--

INSERT INTO `tbl_idea` (`id`, `link_name`, `link_address`, `category`) VALUES
(1, '<p>کیفیت تصویربرداری دوربین گوشی&zwnj;های مجهز به تراشه&zwnj;های مدیاتک</p>\n\n<p>&nbsp;</p>\n\n<p><img alt=\"\" src=\"https://cdn01.zoomit.ir/2021/11/dimensity-9000-mediatek-4nm-flagship-chip.jpg\" style=\"height:267px; width:400px\" /></p>\n\n<p>هنگام خرید گوشی&zwnj;های پرچم&zwnj;دار ۲۰۲۱ در صورتی&zwnj;که دوربین برای شما اهمیت زیادی داشته باشد، می&zwnj;توانید بین گزینه&zwnj;های موجود مثل گلکسی اس ۲۱ اولترا، ویوو X70 پرو، اوپو Find X3 پرو یا شیائومی می ۱۱ اولترا یکی را انتخاب کنید. این پرچم&zwnj;داران علاوه&zwnj;بر عملکرد بسیار قوی، از نظر دوربین نیز با یکدیگر شباهت&zwnj;های زیادی دارند؛ زیرا دوربین همه&zwnj;ی گوشی&zwnj;های مذکور، از پردازنده&zwnj;های پرچم&zwnj;دار اسنپدراگون کوالکام (اسنپدراگون ۸۸۸) استفاده می&zwnj;کند.</p>\n', NULL, 'general');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_idea_category`
--

DROP TABLE IF EXISTS `tbl_idea_category`;
CREATE TABLE IF NOT EXISTS `tbl_idea_category` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `category_list` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `category_value` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `category_icon` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `category_color` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `tbl_idea_category`
--

INSERT INTO `tbl_idea_category` (`id`, `category_id`, `category_list`, `category_value`, `category_icon`, `category_color`) VALUES
(1, 1, 'عمومی', 'general', 'fa fa-bolt', '#00B9B9'),
(2, 2, 'زبان انگلیسی', 'english', 'fa fa-globe', '#FF4646'),
(3, 3, 'مطالعه کتاب', 'reading', 'fa fa-clipboard-list', '#46008B'),
(4, 4, 'سلامتی و پزشکی', 'health', 'fa fa-heartbeat', '#00B975');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nav_menu`
--

DROP TABLE IF EXISTS `tbl_nav_menu`;
CREATE TABLE IF NOT EXISTS `tbl_nav_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_title` varchar(100) DEFAULT NULL,
  `item_link` varchar(100) DEFAULT NULL,
  `item_icon` varchar(100) DEFAULT NULL,
  `item_order` int(11) DEFAULT NULL,
  `target` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_nav_menu`
--

INSERT INTO `tbl_nav_menu` (`id`, `item_title`, `item_link`, `item_icon`, `item_order`, `target`) VALUES
(1, 'خانه', 'index.php', 'fa fa-home', 1, 'self'),
(2, 'تنظیمات', 'setting.php', 'fa fa-cog', 2, 'self'),
(3, 'خروج', 'login.php?method=logout', 'fa fa-sign-out-alt', 3, 'self');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(400) DEFAULT NULL,
  `isadmin` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `isadmin`) VALUES
(1, 'admin', 'c726531ac6c63f609075a7071c3bc379', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
