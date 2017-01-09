-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2015 at 02:15 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ebdaat`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads_boxes`
--

CREATE TABLE IF NOT EXISTS `ads_boxes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ads` int(11) NOT NULL,
  `val` int(11) NOT NULL,
  `id_page` int(11) NOT NULL,
  `version` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ads_newspaper`
--

CREATE TABLE IF NOT EXISTS `ads_newspaper` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) NOT NULL,
  `co_name` varchar(1000) NOT NULL,
  `tel` varchar(1000) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `page` int(11) NOT NULL,
  `dat` datetime NOT NULL,
  `Version` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `txt` text NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `id_3` (`id`),
  KEY `id_2` (`id`),
  KEY `id_4` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `classified_ads`
--

CREATE TABLE IF NOT EXISTS `classified_ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_type` int(11) NOT NULL,
  `tel` varchar(1000) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `region` varchar(1000) NOT NULL,
  `textad` varchar(1000) NOT NULL,
  `dat` datetime NOT NULL,
  `Version` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `classified_type`
--

CREATE TABLE IF NOT EXISTS `classified_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(1000) NOT NULL,
  `type` varchar(1000) NOT NULL,
  `title_tr` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `classified_type`
--

INSERT INTO `classified_type` (`id`, `title`, `type`, `title_tr`) VALUES
(1, 'مطلوب للعمل', 'Wanted To work', 'Çalışmak için gerekli'),
(2, 'يطلب عمل', 'Need to work', 'İş arayan'),
(3, 'دراسة وتدريب', 'Study and training', 'eğitim'),
(4, 'خدمات طبية', 'Medical services', 'Tıbbi hizmetler'),
(5, 'خدمات عامة', 'Public services', 'kamu hizmetlerinin'),
(6, 'كهربائيات و إلكترونيات', 'Electricity and Electronics', 'Elektrik ve Elektronik'),
(7, 'سيارات', 'Cars', 'Arabalar'),
(8, 'عقارات', 'Real Estate', 'Gayrimenkul'),
(9, 'سكن شبابي', 'Youth residence', 'Gençlik konut'),
(10, 'منتجات سورية', 'Syrian products', 'Suriye ürünler'),
(11, 'غير ذلك', 'Other than', 'ondan başka');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `s_name` varchar(255) NOT NULL,
  `s_url` varchar(255) NOT NULL,
  `s_email` varchar(255) NOT NULL,
  `s_desc` text NOT NULL,
  `s_key` text NOT NULL,
  `s_copy` varchar(255) NOT NULL,
  `s_mob` varchar(255) NOT NULL,
  `s_tel` varchar(255) NOT NULL,
  `s_address` varchar(255) NOT NULL,
  PRIMARY KEY (`s_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`s_name`, `s_url`, `s_email`, `s_desc`, `s_key`, `s_copy`, `s_mob`, `s_tel`, `s_address`) VALUES
('إبداعات', 'www.ebdaat.org/', 'info@ebdaat.org', ' إبداعات للطباعة والتصميم   مؤسسة طباعية تعنى بالمطبوعات الورقية مقرها الرئيسي في سوريا دمشق  ومقرها الجديد في تركيا  اسطنبول  أوجدنا مركزنا الجديد لتلبية متطلبات عملائنا في تركيا ومنطقة الشرق الاوسط معظم منتجات إبداعات صممت من قبل مصممين محترفين لدى مؤسستنا ونحن نفتخر بمنتجنالأنه يعني الجودة والابتكار والاتقان', 'طباعة, دعاية , إعلان , الهام , إتقان , فن, تصميم, ويب , مواقع , احترافي , جرافيك , فن , طباعة , اجندة , كروت, فيزيت , بروشورات , بوسترات , لوغو , شركات', 'Copyright 2015 Ebdaat, All right reserved.', '+90 543 931 99 49', '+90 212 931 99 49', 'Topkape Maltepe Mah. Davutpaşa Cd. No. 83 AGüven İş Merkezi A Blok No. 49');

-- --------------------------------------------------------

--
-- Table structure for table `design`
--

CREATE TABLE IF NOT EXISTS `design` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_type` int(11) NOT NULL,
  `thumb` varchar(1000) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `image` varchar(1000) NOT NULL,
  `number` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `description_en` varchar(255) NOT NULL,
  `title_tr` varchar(255) NOT NULL,
  `description_tr` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `design_type`
--

CREATE TABLE IF NOT EXISTS `design_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(1000) NOT NULL,
  `filter` varchar(1000) NOT NULL,
  `tr` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `design_type`
--

INSERT INTO `design_type` (`id`, `title`, `filter`, `tr`) VALUES
(1, 'جرافيك', 'Graphic', 'grafik'),
(2, 'ويب', 'web', 'Web');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(1000) NOT NULL,
  `title_ar` varchar(1000) NOT NULL,
  `box_price` int(11) NOT NULL,
  `boxes_num` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `title_tr` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `title_ar`, `box_price`, `boxes_num`, `width`, `height`, `title_tr`) VALUES
(1, 'Front', 'الأمامية', 50, 54, 5, 4, 'ön'),
(2, 'Last', 'الخلفية', 40, 54, 5, 4, 'arka plân'),
(3, 'Interior', 'الداخلية', 30, 66, 5, 4, 'iç');

-- --------------------------------------------------------

--
-- Table structure for table `php_users_login`
--

CREATE TABLE IF NOT EXISTS `php_users_login` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `content` text,
  `last_login` datetime DEFAULT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `php_users_login`
--

INSERT INTO `php_users_login` (`id`, `username`, `email`, `password`, `name`, `phone`, `content`, `last_login`, `level`) VALUES
(1, 'admin', 'demo1@demo.com', 'admin', 'admin', '+0123456789', 'text content for Demo1 user.', '2015-07-14 09:58:34', 1),
(2, 'abdullah', 'demo2@demo.com', 'admin', 'abdullah', '00905392465877', 'developer this site ', '2015-07-03 23:30:25', 2);

-- --------------------------------------------------------

--
-- Table structure for table `print_requests`
--

CREATE TABLE IF NOT EXISTS `print_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `tele` varchar(255) CHARACTER SET latin1 NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `id_request` int(11) NOT NULL,
  `date_request` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `publications`
--

CREATE TABLE IF NOT EXISTS `publications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_type` int(11) NOT NULL,
  `thumb` varchar(1000) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `image` varchar(1000) NOT NULL,
  `number` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `description_en` varchar(255) NOT NULL,
  `title_tr` varchar(255) NOT NULL,
  `description_tr` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `id_3` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `publications`
--

INSERT INTO `publications` (`id`, `id_type`, `thumb`, `title`, `description`, `image`, `number`, `price`, `title_en`, `description_en`, `title_tr`, `description_tr`) VALUES
(3, 1, 'item01.jpg', 'sdfsdf', 'dgfgd', 'item01.jpg', 234, 2342, 'sdfsdf', 'dfgdfg', 'sdfs', 'dfg'),
(4, 1, 'item02.jpg', 'dfgdfg', 'dfgd', 'item02.jpg', 2342, 0, 'dfg', 'dfg', 'dfg', 'dfg'),
(5, 3, 'item03.jpg', 'dfgdf', 'dfg', 'item03.jpg', 0, 0, 'dfg', 'dfg', 'dfg', 'dfg'),
(6, 2, 'item04.jpg', 'sdfsdf', 'sdf', 'item04.jpg', 0, 0, 'sdfsdfsdfs', 'sdf', 'sdfsdf', 'sdf');

-- --------------------------------------------------------

--
-- Table structure for table `publications_type`
--

CREATE TABLE IF NOT EXISTS `publications_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(1000) NOT NULL,
  `filter` varchar(1000) NOT NULL,
  `tr` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `id_3` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `publications_type`
--

INSERT INTO `publications_type` (`id`, `title`, `filter`, `tr`) VALUES
(1, 'بروشور', 'Brochure', 'broşür'),
(2, 'كروت فيزيت', 'card', 'Kart ZİYARETİ'),
(3, 'كتالوك', 'Catalog', 'katalog'),
(4, 'فلاير', 'Flyer', 'Flyer'),
(5, 'فولدر', 'Folder', 'Folder'),
(6, 'ورق مراسلات', 'Sheet Correspondence', 'Sac yazışmalar'),
(7, 'ظروف', 'envelope', 'zarflar'),
(8, 'طباعة دجتال', 'Digital Print', 'Dijital Baskı'),
(9, 'مواد دعاائية', 'Advertising material', 'Tanıtım materyalleri');

-- --------------------------------------------------------

--
-- Table structure for table `pub_spec`
--

CREATE TABLE IF NOT EXISTS `pub_spec` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_type` int(11) NOT NULL,
  `name_ar` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_tr` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `faces` int(11) NOT NULL,
  `num_page` int(11) NOT NULL,
  `thick` int(11) NOT NULL,
  `paper_type` varchar(255) NOT NULL,
  `cover_thick` int(11) NOT NULL,
  `slovan` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `src` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `id_3` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `src`) VALUES
(1, 'slider1.jpg'),
(2, 'slider2.jpg'),
(3, 'slider3.jpg'),
(4, 'slider4.jpg'),
(5, 'slider5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `social`
--

CREATE TABLE IF NOT EXISTS `social` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `link` varchar(1000) NOT NULL,
  `title` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `social`
--

INSERT INTO `social` (`id`, `type_id`, `link`, `title`) VALUES
(1, 1, 'www.facebook.com/ebdaat.print', 'تابعنا على فيسبوك'),
(2, 2, 'https://twitter.com/', 'twitterg'),
(3, 3, 'https://plus.google.com/u/0/b/101603826236436214333/dashboard/overview', 'google'),
(4, 4, 'https://www.youtube.com/', 'youtube'),
(5, 5, 'https://instagram.com/', 'instagram'),
(9, 4, 'sdfsdf', 'sdfsdf');

-- --------------------------------------------------------

--
-- Table structure for table `social_types`
--

CREATE TABLE IF NOT EXISTS `social_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(1000) NOT NULL,
  `icon` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `id_3` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `social_types`
--

INSERT INTO `social_types` (`id`, `type`, `icon`) VALUES
(1, 'facebook', 'fa-facebook'),
(2, 'twitter', 'fa-twitter'),
(3, 'google-plus', 'fa-google-plus'),
(4, 'youtube', 'fa-youtube'),
(5, 'instagram', 'fa-instagram');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
