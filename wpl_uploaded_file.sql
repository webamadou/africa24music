-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 28, 2016 at 12:55 PM
-- Server version: 5.1.73
-- PHP Version: 5.6.23

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `zadmin_music`
--

-- --------------------------------------------------------

--
-- Table structure for table `wpl_uploaded_file`
--

CREATE TABLE IF NOT EXISTS `wpl_uploaded_file` (
  `id_uploaded_clip` int(11) NOT NULL AUTO_INCREMENT,
  `song_title` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `artist_name` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `artists_featuring` mediumtext COLLATE utf8_unicode_ci,
  `song_style` int(11) NOT NULL,
  `song_album` mediumtext COLLATE utf8_unicode_ci,
  `artist_country` int(11) NOT NULL,
  `clip_producer` mediumtext COLLATE utf8_unicode_ci,
  `production_year` year(4) DEFAULT NULL,
  `clip_description` text COLLATE utf8_unicode_ci,
  `edito_valid_status` int(1) DEFAULT '0',
  `tech_valid_status` int(1) DEFAULT '0',
  `diffusion_status` int(1) DEFAULT '0',
  `validation_text` mediumtext COLLATE utf8_unicode_ci,
  `upload_type` int(1) NOT NULL,
  `upload_date` datetime DEFAULT NULL,
  `youtube_url` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `clip_file_link` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `svr_file_link` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `edito_valid_date` datetime DEFAULT NULL,
  `tech_valid_date` datetime DEFAULT NULL,
  `diffusion_date` datetime DEFAULT NULL,
  `daily_folder` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `em_number` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_type` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_size` int(5) NOT NULL DEFAULT '100',
  `thumbnail_link` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `edito_valid_by` int(11) DEFAULT NULL,
  `tech_valid_by` int(11) DEFAULT NULL,
  `diffusion_by` int(1) DEFAULT NULL,
  `deletion_request` int(11) DEFAULT NULL,
  `deletion_request_text` mediumtext COLLATE utf8_unicode_ci,
  `deletion_request_status` int(1) DEFAULT NULL,
  `viewed_status` int(1) NOT NULL,
  `no_diffusion_request` int(1) DEFAULT '0',
  `status` int(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_from` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id_uploaded_clip`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=125 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
