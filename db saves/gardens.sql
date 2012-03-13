-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 13, 2012 at 01:42 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gardens_phpfogapp_com`
--

-- --------------------------------------------------------

--
-- Table structure for table `gardens`
--

CREATE TABLE IF NOT EXISTS `gardens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `longitude` double NOT NULL,
  `latitude` double NOT NULL,
  `address` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `gardens`
--

INSERT INTO `gardens` (`id`, `name`, `longitude`, `latitude`, `address`) VALUES
(1, 'Bethany Church Community Garden', -75.7734388991705, 45.345499587655, '382 Centrepointe Dr.'),
(2, 'Bytown Urban Gardens (BUGs) CG', -75.6988143060323, 45.4050394322286, '75 Glendale Ave.'),
(3, 'Carlington Community Garden', -75.7346269034471, 45.382842490324, '900 Merivale Rd.'),
(4, 'Centretown Community Garden', -75.7016583295769, 45.415195101353, '461 Lisgar St.'),
(5, 'Chateau Donald Community Garden', -75.6577031103256, 45.4293097723174, '251 Donald St.'),
(6, 'Children''s Garden', -75.6759578122613, 45.406127619525, '321 Main St.'),
(7, 'Debra Dynes Family House Community Garden', -75.7060251774863, 45.3680604451643, '955 Debra Ave.'),
(8, 'Friendship Community Garden', -75.6361507417946, 45.4273895810549, '1240/1244 Donald St.'),
(9, 'Gloucester Allotment Gardens', -75.5676971825545, 45.420592825487, 'N/A Corner of Weir and Anderson'),
(10, 'GO-VEG (Glebe Organic Vegetable Garden) / Corpus-C', -75.6919950762557, 45.4012929697314, '185 Fifth Ave.'),
(11, 'Go Green Community Garden', -75.6893017438533, 45.4210842738369, '110 Laurier Ave.'),
(12, 'Jardin Arrowsmith Thyme-Less Community Garden', -75.5953760439295, 45.4385515707265, '2040 Arrowsmith Drive'),
(13, 'Jardin Communautaire Orleans Community Garden', -75.4989466307579, 45.4837565286994, '3350 St Joseph Blvd.'),
(14, 'Jardin Communautaire Vanier Community Garden', -75.658575092874, 45.4437362531784, '300 des Peres Blancs.'),
(15, 'Kilborn Allotment Garden', -75.6388368817179, 45.3908440878158, '1909/1975 Kilborn Ave.'),
(16, 'Leslie Park Community Garden', -75.7878754564841, 45.3341129371286, '31 Abingdon Dr.'),
(17, 'Lowertown/Basseville Community Garden', -75.6817654861477, 45.4347668377398, '40 Cobourg st.'),
(18, 'Michele Heights Community Garden', -75.800576543261, 45.3552345931046, '2955 Michelle Dr.'),
(19, 'Nanny Goat Hill Community Garden', -75.707485107864, 45.4153043246147, '575/551 Laurier Ave. West'),
(20, 'Nepean Allotment Garden', -75.7180421437094, 45.3465105482307, '230 Viewmont'),
(21, 'Operation Go Home Community Garden', -75.6907938739199, 45.4310697631841, '179 Murray St.'),
(22, 'Ottawa East Community Garden', -75.6755847910067, 45.408059625321, '249/223/175 Main St.'),
(23, 'Rochester Heights Children''s Garden', -75.708440804817, 45.4045126456476, '299 Rochester St.'),
(24, 'Sandy Hill CG', -75.6680134788833, 45.4199458444146, '3 Hurdman Rd.'),
(25, 'Somali CG', -75.639200787966, 45.3895870241171, '1975 Kilborn Ave.'),
(26, 'Strathcona Heights Community Garden', -75.669424051288, 45.4187323045188, '3 Hurdman Rd.'),
(27, 'Sweet Willow Community Garden', -75.7134104370893, 45.4118448361988, '31 Rochester St.'),
(28, 'Van Lang CG', -75.7555660409407, 45.3956959360145, '295 Churchill Ave.'),
(29, 'Viscount Alexander CG', -75.6747042678713, 45.4202733418521, '55 Mann Ave.'),
(30, 'West Barrhaven Community Garden', -75.757698621139, 45.2710350131028, '3058 Jockvale Rd.');
