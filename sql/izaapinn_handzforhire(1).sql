-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 21, 2017 at 03:35 PM
-- Server version: 5.5.55-cll
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `izaapinn_handzforhire`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`izaapinn`@`localhost` FUNCTION `GetDistance` (`lat1` FLOAT(9,6), `lon1` FLOAT(9,6), `lat2` FLOAT(9,6), `lon2` FLOAT(9,6)) RETURNS DECIMAL(10,5) READS SQL DATA
BEGIN  
      DECLARE  x  decimal (20,10);  
      DECLARE  pi  decimal (21,20);  
      SET  pi = 3.14159265358979323846;  
      SET  x = sin( lat1 * pi/180 ) * sin( lat2 * pi/180  ) + cos(  
     lat1 *pi/180 ) * cos( lat2 * pi/180 ) * cos(  abs( (lon2 * pi/180) -  
     (lon1 *pi/180) ) );  
      SET  x = acos( x );  
      RETURN  ( 1.852 * 60.0 * ((x/pi)*180) ) / 1.609344;  
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `user_id` int(11) NOT NULL,
  `address1` varchar(250) NOT NULL,
  `address2` varchar(250) NOT NULL,
  `city` varchar(150) NOT NULL,
  `state` varchar(150) NOT NULL,
  `zipcode` varchar(150) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`user_id`, `address1`, `address2`, `city`, `state`, `zipcode`, `id`) VALUES
(14, 'he\'s', 'djdj', 'djdj', 'znxjd', 'kfkf', 1),
(21, 'sfrs', 'sfsf', 'sfs', 'sfsf', '123', 2),
(14, 'he\'s', 'djdj', 'djdj', 'znxjd', 'kfkf', 3),
(14, 'Test', 'test', 'chennai', 'tn', '23654', 4),
(14, 'Test', 'test', 'chennai', 'tn', '23654', 5),
(14, 'Test', 'test', 'chennai', 'tn', '23654', 6),
(21, 'fvbs', 'hbbs', 'vsbb', 'vbns', '666', 7),
(21, 'fff', 'ffg', 'fg', 'gh', '66', 8),
(21, 'sfsfsf', 'rfasr', 'sdfsdf', 'afaf', '123', 9),
(21, 'sfsfsf', 'rfasr', 'sdfsdf', 'afaf', '123', 10),
(21, 'sfsfsf', 'rfasr', 'sdfsdf', 'afaf', '123', 11),
(14, 'djdj', 'kdjd', 'djd', 'djdj', 'djdj', 12),
(38, 'dgg', 'cbh', 'dgy', 'fg', '455', 13),
(38, '123, Newry street', 'first main road', 'chennai', 'cuddalore', '2356', 14),
(38, 'thh', 'fhh', 'fg', 'fh', '5666', 15),
(40, 'gjh', 'thh', 'fh', 'gh', '8985', 16),
(21, 'sfsfsf', 'rfasr', 'sdfsdf', 'afaf', '123', 17),
(43, 'sttt1', 'sttt2', 'df', 'hddh', 'hdjd', 18),
(38, 'xgv', 'dgg', 'dvg', 'chh', '599', 19),
(38, 'gzhz', 'sghs', 'sz', 'ggs', '267', 20),
(38, 'hsjsj', 'shhz', 'ghz', 'hhx', '668', 21),
(49, 'zbzb', 'gzhz', 'zghz', 'hhz', '6667', 22),
(51, 'vab', 'vbs', 'vvz', 'hhx', '598', 23),
(54, 'Dh', 'Dh', 'jddj', 'kfkf', 'jddj', 24),
(21, 'sfsfsf', 'rfasr', 'sdfsdf', 'afaf', '123', 25),
(61, 'bas', 'karan', 'fg', 'gg', '93', 26),
(66, 'op', 'op', 'Gigi', 'ddhdh', 'dud', 27),
(65, 'fhju', 'fhj', 'dhju', 'fhh', '6656', 28),
(69, 'I have', 'I yv', 'mbu', 'mvj', '0', 29),
(70, 'dgg', 'dfg', 'dvg', 'fgh', '56', 30),
(70, 'fgt', 'fgg', 'fgg', 'fgg', '5896', 31),
(70, 'ggh', 'rhy', 'rgh', 'dgg', '8666', 32),
(70, 'uuuu', 'uuu', 'uuu', 'uuu', '6555', 33),
(81, 'asdf', 'asdf2', 'ct', 'st', '12', 34),
(70, 'fhhh', 'ghu', 'vhh', 'ghh', '5695', 35),
(70, 'fhj', 'rgu', 'hfg', 'ghh', '556', 36),
(83, 'fhhg', 'hht', 'ghy', 'fhu', '6', 37),
(84, 'rty', 'rt1', 'rt', 'gh', '23', 38),
(70, 'cv', 'gh', 'fg', 'dhh', '6', 39),
(99, 'yay', 'yay', 'tut', 'jgjh', 'mhm', 40),
(102, 'f', 'f', 'd', 'f', 'g', 41),
(70, 'ghh', 'fhj', 'hhh', 'gh', '599', 42),
(105, 'fvh', 'vb', '4yu', 'fhh', '55', 43),
(75, 'fg', 'ff', 'gh', 'gh', '66', 44),
(70, 'vhs', '', 'vsb', 'gsh', '5676', 45),
(133, 'ghhh', 'vhh', 'fj', 'FH', '55455', 46),
(133, 'ghhh', 'vhh', 'fj', 'FH', '55455', 47),
(140, 'first', 'secon', 'chennai', 'cudda', '234678', 48),
(141, 'mexlo', 'kan great', 'great', 'do', '25', 49),
(142, 'dex', 'bre', 'Mar', 'rec', '32', 50),
(70, 'fhh', 'fhhy', 'vhj', 'gjj', '66', 51),
(148, 'gh', 'gh', 'vy', 'yu', '3998', 52),
(149, 'go', 'with', 'city', 'cy', 'den', 53),
(149, 'go', 'with', 'city', 'cy', 'den', 54),
(149, 'go', 'with', 'city', 'cy', 'den', 55),
(149, 'go', 'with', 'city', 'cy', 'den', 56),
(149, 'go', 'with', 'city', 'cy', 'den', 57),
(149, 'go', 'with', 'city', 'cy', 'den', 58),
(149, 'go', 'with', 'city', 'cy', 'den', 59),
(149, 'go', 'with', 'city', 'cy', 'good ', 60),
(164, 'you', 'did', 'dgd', 'tatty', '56676', 61),
(168, 'Test', 'Test', 'Chennai', 'Tn', '123456', 62);

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` varchar(255) DEFAULT NULL,
  `photo` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `firstname`, `lastname`, `email`, `password`, `usertype`, `photo`, `is_active`, `created_date`, `updated_date`) VALUES
(1, 'Admin', 'Admin', 'admin@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'admin', 'assets/images/photo1.jpg', 1, '2017-05-16 07:09:43', '2017-05-15 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `api_logs`
--

CREATE TABLE `api_logs` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `method` varchar(6) NOT NULL,
  `params` text NOT NULL,
  `api_key` varchar(40) NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `time` int(11) NOT NULL,
  `authorized` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `api_logs`
--

INSERT INTO `api_logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `authorized`) VALUES
(31, 'service/login', 'post', 'a:0:{}', '', '117.193.206.196', 1494579850, 1),
(32, 'service/login', 'post', 'a:4:{s:9:\"X-APP-KEY\";s:14:\"HandzForHire@~\";s:11:\"devicetoken\";s:40:\"sasfafwrwrsasfafwrwrsasfafwrwrsasfafwrwr\";s:8:\"username\";s:6:\"tester\";s:8:\"password\";s:9:\"aaaaaaaaa\";}', 'HandzForHire@~', '122.165.103.85', 1494492800, 1);

-- --------------------------------------------------------

--
-- Table structure for table `applied_jobs`
--

CREATE TABLE `applied_jobs` (
  `id` int(11) NOT NULL,
  `employer_id` bigint(20) NOT NULL,
  `employee_id` bigint(20) NOT NULL,
  `job_id` bigint(20) NOT NULL,
  `applied_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comments` text,
  `status` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applied_jobs`
--

INSERT INTO `applied_jobs` (`id`, `employer_id`, `employee_id`, `job_id`, `applied_date`, `comments`, `status`) VALUES
(1, 21, 71, 20, '2017-08-16 12:13:26', NULL, ''),
(64, 198, 133, 90, '2017-11-17 09:13:18', 'test 963', 'Hired'),
(61, 70, 173, 88, '2017-11-15 15:51:53', NULL, 'Hired'),
(6, 133, 182, 55, '2017-08-23 13:32:58', NULL, ''),
(7, 133, 182, 55, '2017-08-23 14:02:25', NULL, ''),
(8, 133, 182, 54, '2017-08-23 14:05:54', NULL, ''),
(9, 133, 133, 55, '2017-08-24 11:49:11', 'gdsgddss', ''),
(10, 133, 133, 55, '2017-08-24 11:50:35', 'gdsgddss', ''),
(11, 164, 133, 31, '2017-08-26 14:56:43', NULL, ''),
(12, 164, 133, 31, '2017-08-26 14:56:48', NULL, ''),
(13, 164, 133, 31, '2017-08-26 14:56:48', NULL, ''),
(14, 164, 133, 31, '2017-08-26 14:56:49', NULL, ''),
(15, 164, 133, 31, '2017-08-26 14:56:49', NULL, ''),
(16, 164, 133, 31, '2017-08-26 14:56:50', NULL, ''),
(17, 164, 133, 31, '2017-08-26 14:56:50', NULL, ''),
(18, 164, 133, 31, '2017-08-26 14:56:50', NULL, ''),
(19, 164, 133, 31, '2017-08-26 14:56:51', NULL, ''),
(20, 164, 133, 31, '2017-08-26 14:56:55', NULL, ''),
(21, 164, 133, 31, '2017-08-26 14:56:55', NULL, ''),
(22, 164, 133, 31, '2017-08-26 14:56:55', NULL, ''),
(23, 164, 133, 31, '2017-08-26 14:58:23', NULL, ''),
(24, 164, 133, 31, '2017-08-26 14:58:23', NULL, ''),
(25, 164, 133, 31, '2017-08-26 14:58:23', NULL, ''),
(26, 164, 133, 31, '2017-08-26 14:58:24', NULL, ''),
(27, 164, 133, 31, '2017-08-26 14:58:24', NULL, ''),
(28, 164, 133, 31, '2017-08-26 14:58:24', NULL, ''),
(29, 164, 133, 31, '2017-08-26 14:58:24', NULL, ''),
(30, 164, 133, 31, '2017-08-26 14:58:25', NULL, ''),
(31, 164, 133, 31, '2017-08-26 14:58:25', NULL, ''),
(32, 133, 133, 53, '2017-08-26 14:58:39', NULL, ''),
(33, 133, 133, 53, '2017-08-26 14:58:39', NULL, ''),
(34, 133, 133, 53, '2017-08-26 14:58:39', NULL, ''),
(35, 133, 133, 54, '2017-08-26 14:58:53', NULL, ''),
(36, 133, 133, 54, '2017-08-26 14:58:54', NULL, ''),
(37, 133, 133, 54, '2017-08-26 14:58:54', NULL, ''),
(38, 133, 133, 54, '2017-08-26 14:58:54', NULL, ''),
(39, 133, 133, 54, '2017-08-26 14:58:54', NULL, ''),
(40, 133, 133, 55, '2017-08-28 12:29:38', '', ''),
(71, 198, 199, 95, '2017-11-17 13:51:12', 'hdhf ufuf', 'Hired'),
(59, 198, 133, 83, '2017-11-14 08:17:41', 'applied', 'Hired'),
(56, 198, 133, 79, '2017-11-01 15:16:25', 'gh hffh Uruguay Lyly', ''),
(47, 184, 184, 59, '2017-08-29 18:51:47', 'ffgghhhdhd', ''),
(48, 57, 133, 61, '2017-08-31 18:22:17', 'hfhhdjd', 'Hired'),
(49, 189, 142, 66, '2017-09-14 11:52:27', '', ''),
(50, 189, 142, 66, '2017-09-14 11:54:56', '', ''),
(69, 198, 199, 94, '2017-11-17 13:17:42', 'Jui', 'Hired'),
(68, 198, 199, 93, '2017-11-17 12:07:33', 'Gggh', ''),
(54, 133, 133, 54, '2017-09-27 11:32:31', 'fhdh Fufu Fufu duo bhfu', ''),
(55, 198, 199, 72, '2017-10-09 09:28:34', 'fgfggf jgffjfg', ''),
(57, 198, 133, 81, '2017-11-01 15:24:37', 'fuhf gigig', 'Hired'),
(60, 70, 173, 88, '2017-11-15 15:51:21', NULL, 'Hired'),
(72, 198, 199, 96, '2017-11-17 14:18:58', 'fuhf fuhf', 'Refused'),
(73, 70, 198, 48, '2017-11-17 18:17:40', '', 'Hired'),
(74, 198, 199, 97, '2017-11-18 14:19:24', 'dffffg', ''),
(75, 200, 199, 98, '2017-11-20 07:41:29', 'hdhf ufuf jgigi Hooghly', ''),
(76, 200, 199, 99, '2017-11-20 09:25:43', '', ''),
(102, 200, 198, 133, '2017-12-02 14:44:49', 'Jiouiuuo', 'Hired'),
(78, 200, 199, 101, '2017-11-20 11:33:13', 'hdhf did', 'Hired'),
(79, 200, 133, 100, '2017-11-20 13:56:43', '', 'Hold'),
(80, 200, 199, 102, '2017-11-20 14:13:10', '', 'Hired'),
(81, 200, 199, 102, '2017-11-20 14:56:26', '', 'Hired'),
(101, 200, 199, 133, '2017-12-02 14:37:25', 'Rhukuiyiuy', 'Hired'),
(83, 201, 199, 107, '2017-11-21 11:17:04', '', 'Hired'),
(84, 198, 200, 112, '2017-11-22 09:20:06', '', 'Hired'),
(85, 200, 199, 114, '2017-11-22 12:21:40', 'fire', 'Hired'),
(86, 200, 199, 119, '2017-11-28 11:34:05', 'Hffh yiwyssutltidtsou oeuteuktrauksultljstsotsstousult kfsksfhirysoutstoufsu jsfjlsglgjsjsfk', 'Refused'),
(87, 133, 198, 25, '2017-11-29 11:16:29', 'Hsufsufsfsjsfjjaryhadkahfk afhhafsfhkkhsflhfs ahrjfasfhkhsfkhfksshfk hdjhfskafhkfjksfksj skhhakfjskfjfsk  shflfhzlfshkfzhkjgdljldgdljgjgdlfsjfslstupouwrwporuworuqurwpurwourwtudjtaourespyietltielztLieitwltEliEILtiEltusltwkutWltutwluTiwwiEiesoylzyeioyezeoylztilezutwluowatietziyelzlyieeiyiyeoyeyileiylezeoyiletiiletzetilzuletztuelzeiltzetilzieltzetilzltiezyiezyielzleyizlutwzwtuwtjwutltwil\n', 'Hold'),
(88, 133, 173, 23, '2017-11-30 15:01:53', NULL, 'Hold'),
(89, 133, 173, 23, '2017-11-30 15:01:53', NULL, 'Hold'),
(90, 200, 199, 128, '2017-11-30 15:33:15', 'Dhhdhddhhwrahr', 'Hired'),
(91, 200, 199, 129, '2017-11-30 16:13:57', 'Ch', 'Hired'),
(92, 198, 199, 94, '2017-11-30 16:47:32', '', 'Hold'),
(93, 189, 199, 66, '2017-12-01 05:44:47', 'Hddharurhajtsstj sgdjgjsgjsgjgsjsgjetetutei jafsfsjffsjsfjsgjksgsfksgk sjfjfshfsfsjsfjsjfsjtwtiaitgjsskt zkggskfstsstwotwitwtitisktsskyyosyosyosoyssyosoysyo sigisotsitsylsykd skgskgkdyktskydslylysskyskydykdkgdkydlyldydlydlykeyoeyotwtsksgkggslgeotwktktalraouryirqkyrqwrkukwutuowttwituowwulttsuljltssfjlfsjtsi', 'Hold'),
(94, 133, 200, 65, '2017-12-01 11:54:41', '', 'Hold'),
(95, 133, 173, 23, '2017-12-01 15:45:12', NULL, 'Hold'),
(96, 133, 173, 23, '2017-12-01 15:45:48', NULL, 'Hold'),
(97, 133, 173, 23, '2017-12-01 16:27:36', NULL, 'Hold'),
(98, 133, 173, 23, '2017-12-01 16:33:34', NULL, 'Hold'),
(99, 200, 199, 132, '2017-12-02 08:57:19', 'Nnkhhkkhkj', 'Hired'),
(100, 200, 198, 132, '2017-12-02 08:58:18', 'Jhhj', 'Hired'),
(103, 200, 199, 136, '2017-12-04 05:21:34', 'Ghgg', 'Hired'),
(104, 198, 199, 142, '2017-12-13 07:13:09', 'Hdhd', 'Hired'),
(105, 198, 199, 145, '2017-12-13 12:37:03', 'Hdhd uffujf hdhd dh', 'Hired'),
(106, 198, 199, 146, '2017-12-15 15:35:33', 'Dud', 'Hired'),
(107, 203, 204, 147, '2017-12-15 18:23:50', 'Thanks', 'Hired');

-- --------------------------------------------------------

--
-- Table structure for table `checking_account`
--

CREATE TABLE `checking_account` (
  `id` int(11) NOT NULL,
  `employer_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `routing_number` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `license_number` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `default_account` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `usertype` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checking_account`
--

INSERT INTO `checking_account` (`id`, `employer_id`, `name`, `routing_number`, `account_number`, `license_number`, `state`, `default_account`, `status`, `created_date`, `updated_date`, `usertype`) VALUES
(2, 1, 'fwfan', '43434', '44433443', 'edg3445345', 'Georgia', 1, 0, '2017-05-23 06:26:20', '0000-00-00 00:00:00', NULL),
(3, 2, 'R', '123213', '12321', '4324', 'Florida', 0, 0, '2017-06-06 14:02:27', '0000-00-00 00:00:00', NULL),
(4, 75, 't', '3343343', '665526265252', '134242', 'ghgh', 0, 1, '2017-06-13 06:37:29', '0000-00-00 00:00:00', NULL),
(9, 131, 'ifi', '123456789', '55899096', '35', '56', 1, 1, '2017-06-17 09:18:50', '0000-00-00 00:00:00', NULL),
(10, 134, 'guna', '123456', '1234789', 'abisha', 'fhh', 1, 1, '2017-06-21 07:31:32', '2017-06-21 07:48:00', NULL),
(11, 134, 'thu', '56', '45', '466', 'thu', 0, 1, '2017-06-21 07:37:48', '0000-00-00 00:00:00', NULL),
(19, 140, 'gdhs', '3566', '1234', '56', 'gs', 1, 1, '2017-06-30 05:54:41', '0000-00-00 00:00:00', NULL),
(24, 148, 'hj', '456789654325678', '56', '4567', 'tn', 1, 1, '2017-07-04 07:16:56', '0000-00-00 00:00:00', NULL),
(27, 156, 'fgh', '5555', '4567', '6789', 'hjjjh', 1, 1, '2017-07-12 03:30:57', '0000-00-00 00:00:00', NULL),
(29, 164, 'geetha3', '55757667', '57676866868', 'fggghghg', 'thigh', 0, 1, '2017-07-16 04:05:38', '0000-00-00 00:00:00', NULL),
(30, 171, 'checkingTestAccount', '46854', '5241256358', '57643', 'fkffjifif', 0, 1, '2017-07-20 01:09:02', '0000-00-00 00:00:00', NULL),
(31, 178, 'had', 'he', '4522', 'dud', 'Dudu', 0, 1, '2017-08-11 07:54:34', '0000-00-00 00:00:00', NULL),
(32, 133, 'test', '466457', '4521552', '356544', 'fifjdifi', 0, 1, '2017-08-28 22:14:11', '0000-00-00 00:00:00', NULL),
(33, 183, 'hdhf', 'du', '55', 'hdhf', 'CNBC', 0, 1, '2017-08-29 12:41:42', '0000-00-00 00:00:00', NULL),
(34, 183, 'hdhf', 'hdhdue', '4242424', 'fhdh', 'fhjjvv', 0, 1, '2017-08-30 03:44:51', '0000-00-00 00:00:00', 'employer'),
(35, 185, 'Jc', 'JFK', '5252', 'fjgj', 'fjjf', 0, 1, '2017-08-30 05:21:45', '0000-00-00 00:00:00', NULL),
(36, 189, 'du', 'if', '25', 'Dudu', 'chj', 0, 1, '2017-09-14 04:47:44', '0000-00-00 00:00:00', 'employer'),
(37, 190, 'gjfjjgf', 'ttt', '345', 'ddhgdjg', 'hkggkhgjg', 0, 1, '2017-09-20 08:42:14', '2017-09-20 08:44:41', 'employer'),
(38, 197, 'checking account', '43234', '8524', 'late', 'hffh', 0, 1, '2017-10-03 03:24:18', '2017-10-03 03:25:20', 'employer'),
(39, 202, 'dud', 'dud', '4554', 'gd', 'Fff', 0, 1, '2017-12-06 01:59:37', '0000-00-00 00:00:00', 'employer');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `credit_card`
--

CREATE TABLE `credit_card` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `card_number` varchar(255) NOT NULL,
  `card_type` enum('Visa','Mastercard','Maestro','Discover','Amex') NOT NULL,
  `exp_month` varchar(255) NOT NULL,
  `exp_year` varchar(255) NOT NULL,
  `cvv` varchar(255) NOT NULL,
  `address_card` varchar(250) NOT NULL,
  `city` varchar(250) NOT NULL,
  `state` varchar(250) NOT NULL,
  `zipcode` varchar(100) NOT NULL,
  `employer_id` int(11) NOT NULL,
  `default_card` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `usertype` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `credit_card`
--

INSERT INTO `credit_card` (`id`, `name`, `card_number`, `card_type`, `exp_month`, `exp_year`, `cvv`, `address_card`, `city`, `state`, `zipcode`, `employer_id`, `default_card`, `created_date`, `updated_date`, `usertype`) VALUES
(1, 'Ram', '4111111111111112', 'Visa', '08', '2017', '123', '', '', '', '', 1, 0, '2017-05-22 06:25:55', '0000-00-00 00:00:00', NULL),
(2, 'Kumar', '4000000000000000', 'Maestro', '02', '2033', '12321', '', '', '', '', 1, 0, '2017-05-22 07:30:07', '0000-00-00 00:00:00', NULL),
(3, 'Prabhu', '4111204152144522', 'Amex', '12', '2019', '123', '', '', '', '', 2, 0, '2017-05-22 07:50:48', '0000-00-00 00:00:00', NULL),
(4, 'bas', '', '', '', '', '', '', '', '', '', 0, 0, '2017-06-08 13:33:08', '0000-00-00 00:00:00', NULL),
(5, 'bas', '', '', '', '', '', '', '', '', '', 0, 0, '2017-06-08 13:39:40', '0000-00-00 00:00:00', NULL),
(6, 'bas', '', '', '', '', '', '', '', '', '', 0, 0, '2017-06-08 13:52:28', '0000-00-00 00:00:00', NULL),
(7, 'rt', 'rt', 'Visa', '56', '56', '23', 'android.widget.EditText{2020f8bc VFED..CL ........ 22,693-698,781 #7f0b0063 app:id/card_acc}', 'v', 'mvjv', '23', 16, 0, '2017-06-09 02:46:48', '0000-00-00 00:00:00', NULL),
(8, 'n j', 'j', 'Visa', 'jv', 'kv', '06', 'android.widget.EditText{2aa2dd02 VFED..CL ........ 22,693-698,781 #7f0b0063 app:id/card_acc}', 'kv', '', '906', 16, 0, '2017-06-09 02:47:22', '0000-00-00 00:00:00', NULL),
(9, 'bas', '1234', 'Visa', '1123', '12', '22', 'android.widget.EditText{2020f8bc VFED..CL ........ 22,693-698,781 #7f0b0063 app:id/card_acc}', 'hh', 'hh', '6', 16, 0, '2017-06-09 02:50:01', '2017-06-09 05:07:42', NULL),
(10, 'bas', '', '', '', '', '', '', '', '', '', 0, 0, '2017-06-09 04:58:35', '0000-00-00 00:00:00', NULL),
(11, 'Tamil', '1234565424567864', 'Visa', '3', '2017', '111', 'jddd', 'Fhg', 'df', 'djd', 4, 0, '2017-06-09 07:07:03', '0000-00-00 00:00:00', NULL),
(12, 'ty', '56', 'Visa', '56', '78', '333', 'android.widget.EditText{2c652e63 VFED..CL ........ 22,693-698,781 #7f0b0063 app:id/card_acc}', 'g', 'h', '3', 16, 0, '2017-06-12 01:29:41', '0000-00-00 00:00:00', NULL),
(13, 'j', '8', 'Visa', 'g', 'h', '2', 'android.widget.EditText{80d320f VFED..CL ........ 22,693-698,781 #7f0b0063 app:id/card_acc}', 'fdf', 'gg', '3', 16, 0, '2017-06-12 04:30:46', '0000-00-00 00:00:00', NULL),
(15, 'k iv', 'j j', 'Visa', 'k', 'juv', '3838', 'android.widget.EditText{80d320f VFED..CL ........ 22,693-698,781 #7f0b0063 app:id/card_acc}', 'mvjc', 'mkviv', '33', 16, 0, '2017-06-12 05:02:43', '0000-00-00 00:00:00', NULL),
(16, 'cu', 'jdu', 'Visa', 'f', 'kdu', '6', 'android.widget.EditText{295e160 VFED..CL ........ 22,693-698,781 #7f0b0063 app:id/card_acc}', 'ff', 'gg', '6', 16, 0, '2017-06-12 05:04:49', '0000-00-00 00:00:00', NULL),
(17, 'bas', '', '', '', '', '', '', '', '', '', 0, 0, '2017-06-12 05:08:32', '0000-00-00 00:00:00', NULL),
(18, 'fund', '123456787543454', 'Visa', '5', '2017', '111', 'Fhg', 'gh', 'Fg', 'hhh', 4, 0, '2017-06-12 07:03:02', '0000-00-00 00:00:00', NULL),
(19, 'uvvvkv', 'good', 'Visa', 'gg', 'bh', '6', 'android.widget.EditText{80d320f VFED..CL ........ 22,693-698,781 #7f0b0063 app:id/card_acc}', 'bh', 'gg', '3', 16, 0, '2017-06-12 08:05:53', '0000-00-00 00:00:00', NULL),
(20, 'kcu', 'jux', 'Visa', 'ff', 'gg', '5', 'android.widget.EditText{80d320f VFED..CL ........ 22,693-698,781 #7f0b0063 app:id/card_acc}', 'ff', 'gh', '66', 16, 0, '2017-06-12 08:16:14', '0000-00-00 00:00:00', NULL),
(21, 'ccg', 'gg', 'Visa', 'ff', 'tt', '2', 'android.widget.EditText{fd7c2e9 VFED..CL ........ 22,693-698,781 #7f0b0063 app:id/card_acc}', 'ff', 'hh', '88', 16, 0, '2017-06-12 08:17:27', '0000-00-00 00:00:00', NULL),
(22, 'g', 'hh', 'Visa', 'ff', 'hh', '6', 'android.widget.EditText{1ce0a4a5 VFED..CL ........ 22,693-698,781 #7f0b0063 app:id/card_acc}', 'cc', 'gg', '9', 16, 0, '2017-06-12 08:20:17', '0000-00-00 00:00:00', NULL),
(25, 'gh', '123444432622626262', 'Visa', '3', '2017', '111', 'shshsj', 'hd', 'kf', 'Dh', 4, 0, '2017-06-13 04:59:26', '0000-00-00 00:00:00', NULL),
(26, 'hh', '124434566644333', 'Visa', '2', '6', '2017', 'Fg', 'Fg', 'Fg', 'Fg', 75, 0, '2017-06-13 05:38:50', '0000-00-00 00:00:00', NULL),
(40, 'bas', '', '', '', '', '', '', '', '', '', 0, 0, '2017-06-15 08:23:45', '0000-00-00 00:00:00', NULL),
(44, 'bas', '45236456328966', 'Visa', '12', '23', '553', 'uxuci', 'cy', 'sy', '23', 131, 0, '2017-06-17 09:17:37', '2017-06-17 09:18:04', NULL),
(45, 'sfg', '4539984486585', 'Visa', '05', '2029', '200', 'rghh', 'ghh', 'bj', '6', 134, 0, '2017-06-21 07:30:48', '2017-06-21 07:48:13', NULL),
(48, 'bas', '', '', '', '', '', '', '', '', '', 0, 0, '2017-06-23 05:24:13', '0000-00-00 00:00:00', NULL),
(49, 'june15', '4251352865235425', 'Visa', '5', '22', '396', 'fjffjififg', 'fufu', 'fii', '5365', 135, 0, '2017-06-24 22:03:57', '0000-00-00 00:00:00', NULL),
(50, 'june15', '4251352865235423', 'Visa', '5', '22', '396', 'fjffjififg', 'fufu', 'fii', '5365', 135, 0, '2017-06-24 22:04:08', '0000-00-00 00:00:00', NULL),
(68, 'baski', '452369852368542', 'Visa', '01', '17', '555', 'gh', 'ct', 'st', '9638', 148, 1, '2017-07-04 07:14:58', '2017-07-04 07:15:58', NULL),
(74, 'gah', '4526987089325', 'Visa', '05', '2028', '300', 'gahsj', 'ghsh', 'ggjd', '66646', 70, 0, '2017-07-12 00:58:41', '0000-00-00 00:00:00', NULL),
(75, 'ttt', '4258525412563254', 'Visa', '5', '22', '356', 'dhdhsh', 'djdj', 'djd', '464', 133, 0, '2017-07-12 06:33:20', '0000-00-00 00:00:00', NULL),
(76, 'Geetha1', '4543234675643456', 'Visa', '5', '22', '356', 'fgghg', 'fhf fhf', 'hgdghd', '6767', 164, 0, '2017-07-16 04:04:38', '2017-07-16 04:04:53', NULL),
(78, 'testcard', '5241256325412536', 'Mastercard', '5', '22', '635', 'fjfj don\'t', 'hdjd', 'djdj', '565', 171, 0, '2017-07-20 01:07:39', '0000-00-00 00:00:00', NULL),
(79, 'kfkf', '4251235412587452', 'Visa', '5', '22', '8889', 'shh', 'djd', 'djdj', '6465', 171, 0, '2017-07-20 01:09:45', '0000-00-00 00:00:00', NULL),
(81, 'fudh', '42585212541256325', 'Visa', '5', '66', '255', 'fufufijf', 'du', 'du', '45', 183, 0, '2017-08-29 12:40:46', '0000-00-00 00:00:00', NULL),
(82, 'if', '5241252525241258', 'Mastercard', '5', '55', '452', 'du', 'Judd', 'du', '5454', 184, 0, '2017-08-29 12:44:14', '0000-00-00 00:00:00', NULL),
(83, 'fhdh', '5214252521452365', 'Mastercard', '5', '55', '123', 'fhdh', 'fhdh', 'fh', '2665', 183, 0, '2017-08-30 01:47:16', '0000-00-00 00:00:00', 'employer'),
(85, 'officials', '5254125635284521', 'Mastercard', '5', '52', '1254', 'Dudu', 'hdhf did', 'dhhd', '534664', 188, 0, '2017-09-07 10:30:00', '0000-00-00 00:00:00', 'employer'),
(86, 'yyyu', '4534567654323458', 'Visa', '5', '56', '575', 'gjgj', 'McGee', 'mfh', '35457', 190, 0, '2017-09-20 08:41:32', '2017-09-20 08:45:14', 'employer'),
(87, 'sumi', '586321789636778', 'Maestro', '25', '03', '200', 'ghjjhg', 'fhjji', 'fhjk', '9965', 196, 0, '2017-09-27 01:59:20', '0000-00-00 00:00:00', NULL),
(88, 'name card', '4525635285412545', 'Visa', '05', '88', '885', 'cjjcjf', 'dhhd', 'fhdh', '6586', 197, 0, '2017-10-03 03:23:40', '0000-00-00 00:00:00', 'employer'),
(92, 'hffh', '4521253652541253', 'Visa', '54', '45', '521', 'Sg', 'Sg', 'dh', '54', 198, 0, '2017-11-19 23:28:38', '0000-00-00 00:00:00', 'employer'),
(93, 'bas', '5123698574236985', 'Mastercard', '12', '18', '236', 'fh', 'v', 'b', '56', 84, 1, '2017-11-20 04:39:09', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email_notifications`
--

CREATE TABLE `email_notifications` (
  `id` int(11) NOT NULL,
  `employees` text NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_notifications`
--

INSERT INTO `email_notifications` (`id`, `employees`, `subject`, `message`, `created_date`, `updated_date`) VALUES
(1, 'test@gmail.comn', 'Test', 'Test', '2017-06-02 13:28:22', '2017-06-02 09:58:22'),
(2, 'test@gmail.comnss#test@gmail.comn', 'sadad ad', 'Test', '2017-06-02 13:30:25', '2017-06-02 10:00:25'),
(3, 'ramkumar.izaap@gmail.com', 'Test Mail', 'Test Mail', '2017-06-06 06:32:59', '2017-06-06 00:32:59'),
(4, 'ramkumar.izaap@gmail.com', 'Test with Attachment', 'Test with Attachment', '2017-06-06 06:36:17', '2017-06-06 00:36:17');

-- --------------------------------------------------------

--
-- Table structure for table `employers`
--

CREATE TABLE `employers` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address_1` varchar(255) NOT NULL,
  `address_2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employers`
--

INSERT INTO `employers` (`id`, `firstname`, `lastname`, `address_1`, `address_2`, `city`, `state`, `zipcode`, `email`, `username`, `password`, `role`, `photo`, `is_active`, `created_date`, `updated_date`) VALUES
(2, 'sadsad', 'Vendor', '2nd Main Road', 'CS', 'Scottsdale', 'AZ', '800051', 'test@gmail.com', 'test@gmail.com', '123456', 6, 'assets/images/avatar2.jpg', 1, '2017-05-18 07:19:01', '2017-05-18 03:49:01'),
(3, 'Test Vendor', 'Vendor', '40, Third Floor', 'Abraham Apt', 'Scottsdale', 'AZ', '82054', 'ramkumar.izaap@gmail.com', 'test@gmail.comn', '123456', 3, '', 1, '2017-05-19 13:18:00', '2017-06-06 00:32:20'),
(4, 'Test4545', 'days', '1601 Purdue Drive', 'CS', 'City', 'AZ', '800051', 'test4@gmail.com', 'fgujfgyuj', 'fvghjfghugf', 2, '', 1, '2017-05-19 13:58:19', '2017-05-19 10:29:26');

-- --------------------------------------------------------

--
-- Table structure for table `hire_jobs`
--

CREATE TABLE `hire_jobs` (
  `job_id` int(11) DEFAULT NULL,
  `job_name` varchar(255) DEFAULT NULL,
  `employer_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hire_jobs`
--

INSERT INTO `hire_jobs` (`job_id`, `job_name`, `employer_id`, `employee_id`, `created_date`, `id`) VALUES
(30, NULL, 70, 173, '2017-11-13 16:04:15', 2),
(29, NULL, 70, 57, '2017-11-14 07:21:19', 3),
(30, NULL, 70, 173, '2017-11-14 08:08:24', 4),
(30, NULL, 70, 173, '2017-11-13 16:04:18', 6),
(80, 'TEST 123', 133, 199, '2017-11-13 16:12:07', 7),
(80, 'TEST 123', 133, 199, '2017-11-13 16:12:36', 8),
(30, NULL, 70, 173, '2017-11-14 07:38:56', 9),
(30, NULL, 70, 173, '2017-11-14 07:47:34', 10),
(30, NULL, 70, 173, '2017-11-14 07:51:12', 11),
(30, NULL, 70, 173, '2017-11-14 07:52:10', 12),
(30, NULL, 70, 173, '2017-11-14 07:52:14', 13),
(30, NULL, 70, 173, '2017-11-14 07:52:16', 14),
(30, NULL, 70, 173, '2017-11-14 07:52:16', 15),
(30, NULL, 70, 173, '2017-11-14 07:52:16', 16),
(30, NULL, 70, 173, '2017-11-14 07:52:17', 17),
(30, NULL, 70, 173, '2017-11-14 07:52:18', 18),
(30, NULL, 70, 173, '2017-11-14 07:52:19', 19),
(30, NULL, 70, 173, '2017-11-14 07:52:19', 20),
(30, NULL, 70, 173, '2017-11-14 07:52:20', 21),
(30, NULL, 70, 173, '2017-11-14 07:52:20', 22),
(30, NULL, 70, 173, '2017-11-14 07:52:20', 23),
(34, NULL, 70, 133, '2017-11-14 08:46:40', 25),
(34, NULL, 70, 133, '2017-11-14 08:47:19', 26),
(36, NULL, 70, 133, '2017-11-14 08:52:20', 27),
(36, NULL, 70, 133, '2017-11-14 08:54:15', 28),
(36, NULL, 70, 133, '2017-11-14 08:54:15', 29),
(36, NULL, 70, 133, '2017-11-14 08:54:16', 30),
(36, NULL, 70, 133, '2017-11-14 09:00:31', 31),
(56, NULL, 70, 173, '2017-11-14 09:06:36', 32),
(80, NULL, 133, 199, '2017-11-15 15:18:21', 33),
(86, 'OO ', 133, 133, '2017-11-15 19:09:23', 34),
(89, 'HI NOV', 133, 199, '2017-11-16 18:15:36', 35),
(91, 'THAT', 198, 199, '2017-11-17 10:39:24', 37),
(92, 'NIKE', 198, 199, '2017-11-17 11:00:56', 38),
(93, 'JJJ', 198, 199, '2017-11-17 12:08:12', 39),
(93, 'JJJ', 198, 199, '2017-11-17 12:08:54', 40),
(93, 'JFJGVJ', 133, 199, '2017-11-17 13:31:21', 44),
(96, 'HDHF FUFU FUFU FU UFUF TECH', 198, 199, '2017-11-17 14:19:42', 47),
(96, 'HDHF FUFU FUFU FU UFUF TECH', 198, 199, '2017-11-17 14:19:47', 48),
(97, 'KHAKI ', 198, 199, '2017-11-18 14:19:47', 49),
(100, 'SIGN', 200, 199, '2017-11-20 11:06:23', 51),
(100, 'SIGN', 200, 199, '2017-11-20 11:06:33', 52),
(133, 'PARROT', 200, 199, '2017-12-02 14:43:20', 113),
(48, NULL, 70, 198, '2017-11-21 07:27:34', 70),
(107, 'NOV 21', 201, 199, '2017-11-21 11:17:26', 71),
(88, NULL, 70, 173, '2017-11-21 11:20:05', 72),
(133, 'PARROT', 200, 199, '2017-12-02 14:37:51', 112),
(88, NULL, 70, 173, '2017-11-24 10:48:04', 77),
(88, NULL, 70, 173, '2017-11-24 11:03:10', 78),
(88, NULL, 70, 173, '2017-11-29 12:26:59', 82),
(88, NULL, 70, 173, '2017-11-29 12:59:15', 83),
(129, 'DHKKDDYK', 200, 199, '2017-11-30 16:34:24', 85),
(96, 'HDHF FUFU FUFU FU UFUF TECH', 198, 199, '2017-12-01 19:04:46', 88),
(81, 'JACK 123', 198, 133, '2017-12-01 20:19:49', 89),
(128, 'EITHER', 200, 199, '2017-12-02 13:57:30', 111),
(101, 'CAKE', 200, 199, '2017-12-02 13:57:18', 110),
(132, 'LIGHT', 200, 199, '2017-12-02 08:59:25', 104),
(132, 'LIGHT', 200, 199, '2017-12-02 08:59:26', 105),
(132, 'LIGHT', 200, 199, '2017-12-02 08:59:30', 106),
(132, 'LIGHT', 200, 199, '2017-12-02 08:59:50', 107),
(132, 'LIGHT', 200, 199, '2017-12-02 08:59:53', 108),
(132, 'LIGHT', 200, 199, '2017-12-02 08:59:58', 109),
(133, 'PARROT', 200, 198, '2017-12-02 14:45:18', 114),
(119, 'NOV 28', 200, 199, '2017-12-02 18:28:43', 117),
(119, 'NOV 28', 200, 199, '2017-12-02 18:28:46', 118),
(119, 'NOV 28', 200, 199, '2017-12-02 18:28:53', 119),
(119, 'NOV 28', 200, 199, '2017-12-02 19:46:17', 120),
(81, 'JACK 123', 198, 133, '2017-12-05 08:42:42', 130),
(81, 'JACK 123', 198, 133, '2017-12-12 13:47:55', 136);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `employer_id` int(11) NOT NULL,
  `job_name` varchar(255) NOT NULL,
  `job_category` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `job_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `job_start_date` datetime NOT NULL,
  `job_end_date` datetime NOT NULL,
  `job_payment_amount` double NOT NULL,
  `job_payment_type` varchar(150) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `recurring` enum('Lump Sum','Hourly Wage','Daily','Weekly','Bi-Weekly','Monthly') NOT NULL,
  `address` varchar(255) NOT NULL,
  `state` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zipcode` varchar(100) NOT NULL,
  `post_address` varchar(50) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `address_include` enum('Yes','No') NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lat` float NOT NULL,
  `lon` float NOT NULL,
  `currentlocation` varchar(50) DEFAULT NULL,
  `active_job` varchar(50) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `employer_id`, `job_name`, `job_category`, `description`, `job_date`, `start_time`, `end_time`, `job_start_date`, `job_end_date`, `job_payment_amount`, `job_payment_type`, `amount`, `recurring`, `address`, `state`, `city`, `zipcode`, `post_address`, `logo`, `address_include`, `status`, `created_date`, `updated_date`, `lat`, `lon`, `currentlocation`, `active_job`) VALUES
(2, 1, 'Need a Dog Walker', 6, 'Need a Dog Walker', '2017-05-19', '11:45:00', '11:45:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '845', 'Daily', 'Chennai', '', '', '', '', '', 'No', 1, '2017-05-19 02:45:49', '2017-05-19 02:45:49', 0, 0, NULL, 'no'),
(3, 2, 'Need Pet Care', 12, 'Need Pet Care', '2017-05-19', '12:15:00', '12:15:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '999', 'Monthly', 'SSD', '', '', '', '', '', 'Yes', 1, '2017-05-19 03:17:39', '2017-05-19 03:17:39', 0, 0, NULL, 'no'),
(4, 133, 'JOB DESCRIPTION', 0, 'Need a Baby Sitter', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Lump sum', '', 'Lump Sum', 'Address 1', 'State 1', 'city 1', 'zipcode 1', 'post_address 1', '', 'Yes', 0, '2017-07-13 06:18:33', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(5, 133, 'JOB DESCRIPTION', 0, 'Need a Baby Sitter', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Lump sum', '', 'Lump Sum', 'Address 1', 'State 1', 'city 1', 'zipcode 1', 'post_address 1', '', 'Yes', 0, '2017-07-13 07:09:50', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(6, 70, 'svhs', 0, 'gsgs', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 977, 'Weekly', '', 'Lump Sum', '', '', '', '', 'no', '', 'Yes', 0, '2017-07-13 11:58:19', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(7, 70, 'svhs', 0, 'gsgs', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 977, 'Weekly', '', 'Lump Sum', '', '', '', '', 'no', '', 'Yes', 0, '2017-07-13 11:58:34', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(8, 70, 'fh', 0, 'gg', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 88, 'Bi-Weekly', '', 'Lump Sum', '', '', '', '', 'no', '', 'Yes', 0, '2017-07-13 13:40:13', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(9, 70, 'fgh', 0, 'ghh', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 896, 'Bi-Weekly', '', 'Lump Sum', '', '', '', '', 'no', '', 'Yes', 0, '2017-07-13 13:42:26', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(10, 133, 'fuffu', 0, 'yyfyf', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 52, 'Weekly', '', 'Lump Sum', '', '', '', '', 'yes', '', 'Yes', 0, '2017-07-13 18:08:57', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(11, 133, 'fuffu', 0, 'yyfyf', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 52, 'Weekly', '', 'Lump Sum', '', '', '', '', 'yes', '', 'Yes', 0, '2017-07-13 18:09:00', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(12, 133, 'fuffu', 0, 'yyfyf', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 52, 'Weekly', '', 'Lump Sum', '', '', '', '', 'yes', '', 'Yes', 0, '2017-07-13 18:09:14', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(13, 133, 'fuffu', 0, 'yyfyf', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 52, 'Weekly', '', 'Lump Sum', '', '', '', '', 'yes', '', 'Yes', 0, '2017-07-13 18:09:14', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(14, 133, 'fuffu', 0, 'yyfyf', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 52, 'Weekly', '', 'Lump Sum', '', '', '', '', 'yes', '', 'Yes', 0, '2017-07-13 18:09:15', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(15, 133, 'fuffu', 0, 'yyfyf', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 52, 'Weekly', '', 'Lump Sum', '', '', '', '', 'yes', '', 'Yes', 0, '2017-07-13 18:09:15', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(16, 133, 'fuffu', 0, 'yyfyf', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 52, 'Weekly', '', 'Lump Sum', '', '', '', '', 'yes', '', 'Yes', 0, '2017-07-13 18:09:15', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(17, 133, 'fuffu', 0, 'yyfyf', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 52, 'Weekly', '', 'Lump Sum', '', '', '', '', 'yes', '', 'Yes', 0, '2017-07-13 18:09:15', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(18, 70, 'ghj', 0, 'ghj', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 45, 'Bi-Weekly', '', 'Lump Sum', '', '', '', '', 'no', '', 'Yes', 0, '2017-07-14 07:53:43', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(19, 70, 'vg', 0, 'fg', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 88, 'Dialy', '', 'Lump Sum', '', '', '', '', 'no', '', 'Yes', 0, '2017-07-14 08:10:36', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(20, 70, 'gh', 0, 'fgh', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 23, 'Weekly', '', 'Lump Sum', 'dghh', 'fgh', 'cbh', '5666', 'no', '', 'Yes', 0, '2017-07-14 08:52:05', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(21, 70, 'fh', 0, 'ghh', '0000-00-00', '00:00:00', '00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 23, 'Weekly', '', 'Lump Sum', '', '', '', '', 'yes', '', 'Yes', 0, '2017-07-14 09:09:21', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(22, 70, 'dgh', 0, 'rgy', '2017-07-14', '00:00:00', '00:00:00', '2020-05-00 00:00:00', '2020-05-00 00:00:00', 236, 'Dialy', '', 'Lump Sum', '', '', '', '', 'no', '', 'Yes', 0, '2017-07-14 14:36:03', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(23, 133, 'job', 5, 'job', '2017-08-15', '00:00:00', '00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Hourly Wage', '', 'Lump Sum', 'hdjd', 'Fg', 'hd', '555', 'yes', '', 'Yes', 0, '2017-07-14 18:43:04', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(24, 133, 'Fhg', 4, 'Fhg', '2017-05-15', '00:00:00', '00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 56, 'Hourly Wage', '', 'Lump Sum', 'Fg', 'hh', 'df', '55', 'yes', '', 'Yes', 0, '2017-07-14 19:04:59', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(25, 133, '', 20, '', '2017-08-15', '00:00:00', '00:00:00', '2014-04-05 00:00:00', '2001-06-05 00:00:00', 560, 'Daily', '', 'Lump Sum', 'djd', 'jddj', 'jddj', '45', 'yes', '', 'Yes', 0, '2017-07-14 19:35:04', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(26, 133, 'test', 3, 'test', '2017-06-15', '18:14:45', '00:00:00', '2012-02-13 00:00:00', '2013-03-13 00:00:00', 50, 'Hourly Wage', '', 'Lump Sum', 'tt', 'tt', 'tt', '52', 'yes', '', 'Yes', 0, '2017-07-15 07:33:12', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(27, 70, 'bssj', 0, 'shhs', '2017-07-15', '00:00:00', '00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 9776, 'Bi-Weekly', '', 'Lump Sum', '', '', '', '', 'no', '', 'Yes', 0, '2017-07-15 09:06:34', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(28, 70, 'fhh', 0, 'dgh', '2017-07-15', '00:00:00', '00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 23, 'Bi-Weekly', '', 'Lump Sum', '', '', '', '', 'no', '', 'Yes', 0, '2017-07-15 11:27:08', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(29, 70, 'painting', 1, 'painting house', '2017-07-15', '01:31:00', '01:31:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 25, 'Hourly Wage', '', 'Lump Sum', '2, 2nd main road, svs nagar, valasaravakkam', 'tamilnadu', 'chennai', '600087', 'no', '', 'Yes', 0, '2017-07-15 13:08:04', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(30, 70, 'fagsg', 2, 'fzg', '2017-07-15', '00:00:00', '00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 23, 'Bi-Weekly', '', 'Lump Sum', '2 , 2nd main road, svs nagar, valasaravakkam', 'tamilnadu', 'chennai', '600087', 'no', '', 'Yes', 0, '2017-07-15 14:09:07', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(31, 164, 'ttttt', 1, 'ttttt', '2017-04-16', '00:00:00', '00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 100, 'Hourly Wage', '', 'Lump Sum', 'gffggf', 'dgdgfg', 'fhfhhg', '6778', 'yes', '', 'Yes', 0, '2017-07-16 10:21:36', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(32, 133, 'cat', 3, 'cat', '2017-08-16', '00:00:00', '00:00:00', '2016-00-18 00:00:00', '0000-00-00 00:00:00', 600, 'Daily', '', 'Lump Sum', 'rugs', 'djdj', 'dhdh', '3565', 'yes', '', 'Yes', 0, '2017-07-16 11:32:09', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(33, 70, 'ff', 2, 'ff', '2017-02-15', '00:00:00', '00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1000, 're', '', 'Lump Sum', 'kkk', 'ff', 'ff', '201', 'ffff', '', 'Yes', 0, '2017-07-17 06:28:44', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(34, 70, 'ff', 2, 'ff', '2017-02-15', '00:00:00', '00:00:00', '2017-03-18 00:00:00', '2017-09-14 00:00:00', 1000, 're', '', 'Lump Sum', 'kkk', 'ff', 'ff', '201', 'ffff', '', 'Yes', 0, '2017-07-17 06:38:09', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(35, 70, 'ff', 2, 'ff', '2017-02-15', '00:00:00', '00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1000, 're', '', 'Lump Sum', 'kkk', 'ff', 'ff', '201', 'ffff', '', 'Yes', 0, '2017-07-17 06:40:52', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(36, 70, 'ff', 2, 'ff', '2017-02-15', '00:00:00', '00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1000, 're', '', 'Lump Sum', 'kkk', 'ff', 'ff', '201', 'ffff', '', 'Yes', 0, '2017-07-17 10:56:01', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(37, 70, 'dog walker', 2, 'walker', '2017-08-17', '00:00:00', '00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 200, 'Weekly', '', 'Lump Sum', '2 , 2nd main road, svs nagar, valasaravakkam', 'tamilnadu', 'chennai', '600087', 'no', '', 'Yes', 0, '2017-07-17 12:57:52', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(38, 70, 'Painting', 5, 'ffsdfsdfssfg', '2017-02-15', '11:56:00', '11:58:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1000, 'fgdfg', '', 'Lump Sum', 'kkk', 'ff', 'ff', '201', 'ffff', '', 'Yes', 0, '2017-07-17 13:41:49', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(39, 133, 'uffjf', 4, 'uffjf', '2017-09-17', '00:00:00', '00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 578, 'Hourly Wage', '', 'Lump Sum', 'Dudu', 'dikfjf', 'Diid', '565686', 'yes', '', 'Yes', 0, '2017-07-17 14:46:16', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(40, 57, 'ds', 9, 'ds', '2017-07-19', '23:58:13', '22:57:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Lump Sum', '', 'Lump Sum', 'can', 'anything', 'write', '646894661656', 'yes', '', 'Yes', 0, '2017-07-19 03:08:48', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(41, 70, 'baby sitter', 1, 'baby', '2017-07-19', '23:51:00', '11:51:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 236, 'Bi-Weekly', '', 'Lump Sum', '2 , 2nd main road, svs nagar, valasaravakkam', 'tamilnadu', 'chennai', '600087', 'no', '', 'Yes', 0, '2017-07-19 06:21:49', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(42, 70, 'pet care', 12, 'gghh', '2017-07-19', '17:38:00', '05:38:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 85, 'Weekly', '', 'Lump Sum', '2 , 2nd main road, svs nagar, valasaravakkam', 'tamilnadu', 'chennai', '600087', 'no', '', 'Yes', 0, '2017-07-19 12:09:02', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(43, 171, 'jobName', 3, 'jobName', '2017-09-20', '12:38:16', '13:39:16', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 5678, 'Daily', '', 'Lump Sum', 'djdj', 'fulfil', 'fjfj', '535', 'yes', '', 'Yes', 0, '2017-07-20 07:11:30', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(44, 70, 'ff', 2, 'ff', '2017-02-15', '11:56:00', '11:58:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1000, 're', '', 'Lump Sum', 'kkk', 'ff', 'ff', '201', 'ffff', '', 'Yes', 0, '2017-07-29 12:00:20', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(45, 133, 'baby sitter ', 7, 'baby sitter ', '2002-02-21', '10:38:34', '01:11:34', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 557, 'Weekly', '', 'Lump Sum', 'Loren upsurge is that she has no ', 'newton ', 'Florida ', '8625657', 'yes', '', 'Yes', 0, '2017-08-08 11:31:55', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(46, 133, 'ruur', 2, 'ruur', '2017-08-11', '08:05:44', '07:07:44', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 855, 'Hourly Wage', '', 'Lump Sum', 'd', 'gu', 'd', '55', 'yes', '', 'Yes', 0, '2017-08-10 13:38:31', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(47, 133, 'fj', 1, 'fj', '2017-08-11', '07:41:10', '09:40:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8555, 'Hourly Wage', '', 'Lump Sum', 'fuhf', 'Dudu', 'fhjf', '5665', 'yes', '', 'Yes', 0, '2017-08-10 14:13:01', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(48, 70, 'ff', 2, 'ff', '2017-02-15', '11:56:00', '11:58:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1000, 're', '', 'Lump Sum', 'kkk', 'ff', 'ff', '201', 'ffff', '', 'Yes', 0, '2017-08-11 08:23:14', '0000-00-00 00:00:00', 0, 0, NULL, 'yes'),
(49, 70, 'ff', 2, 'ff', '2017-02-15', '11:56:00', '11:58:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1000, 're', '', 'Lump Sum', 'kkk', 'ff', 'ff', '201', 'ffff', '', 'Yes', 0, '2017-08-11 09:54:57', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(50, 70, 'ff', 2, 'ff', '2017-02-15', '11:56:00', '11:58:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1000, 're', '', 'Lump Sum', 'kkk', 'ff', 'ff', '201', 'ffff', '', 'Yes', 0, '2017-08-11 09:55:21', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(51, 178, 'AUGUST 11', 2, 'AUGUST 11', '2017-09-11', '07:24:22', '04:22:22', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 52, 'Hourly Wage', '', 'Lump Sum', 'Dudu', 'hdhd', 'dud', '3535', 'yes', '', 'Yes', 0, '2017-08-11 13:55:33', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(52, 70, 'test', 9, 'test', '2017-08-11', '20:00:00', '08:00:00', '2020-00-00 00:00:00', '2008-00-00 00:00:00', 23, 'Weekly', '', 'Lump Sum', '2 , 2nd main road, svs nagar, valasaravakkam', 'tamilnadu', 'chennai', '600087', 'no', '', 'Yes', 0, '2017-08-11 14:32:40', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(53, 133, 'This is a test job by Rafi', 1, 'Testing painting', '2017-08-12', '16:01:00', '16:06:00', '2016-01-00 00:00:00', '2016-06-00 00:00:00', 5000, 'Lump Sum', '', 'Lump Sum', 'Chennai', 'Iz', 'Chennai', '66666', 'yes', '', 'Yes', 0, '2017-08-12 10:34:10', '0000-00-00 00:00:00', 0, 0, NULL, 'yes'),
(54, 133, 'This is a test job by Rafi', 1, 'Testing painting', '2017-08-12', '16:01:00', '16:06:00', '2016-01-00 00:00:00', '2016-06-00 00:00:00', 5000, 'Lump Sum', '', 'Lump Sum', 'Chennai', 'Iz', 'Chennai', '66666', 'yes', '', 'Yes', 0, '2017-08-12 10:34:14', '0000-00-00 00:00:00', 0, 0, NULL, 'yes'),
(55, 133, 'IOS DEVRLOPER', 2, 'IOS DEVRLOPER', '2017-08-15', '09:17:12', '09:17:12', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 55, 'Lump Sum', '', 'Lump Sum', '390 Broadway street', 'SC', 'Charleston', '29424', 'yes', '', 'Yes', 0, '2017-08-14 14:53:51', '0000-00-00 00:00:00', 0, 0, NULL, 'yes'),
(56, 70, 'kvog', 1, 'xcici', '2017-08-17', '15:38:00', '15:38:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, 'Monthly', '', 'Lump Sum', '2 , 2nd main road, svs nagar, valasaravakkam', 'tamilnadu', 'chennai', '600087', 'yes', '', 'Yes', 0, '2017-08-17 10:11:39', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(57, 133, '', 5, '', '2017-09-21', '04:46:32', '05:46:32', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8585, 'Hourly Wage', '', 'Lump Sum', 'fujf', 'go', 'hdhf', '58', 'yes', '', 'Yes', 0, '2017-08-21 10:17:25', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(58, 133, 'TEST', 5, 'TEST', '2017-09-29', '06:30:16', '07:29:16', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Lump Sum', '', 'Lump Sum', 'fhdh', 'JFK', 'dhdhdh', '5555', 'yes', '', 'Yes', 0, '2017-08-29 13:00:51', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(59, 184, 'FFHFJFI', 2, 'FFHFJFI', '2017-09-30', '12:14:26', '01:13:26', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Lump Sum', '', 'Lump Sum', 'Jc', 'Jc', 'Jc', '85', 'yes', '', 'Yes', 0, '2017-08-29 18:50:20', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(60, 185, 'Y', 3, 'Y', '2017-08-31', '04:51:58', '05:50:58', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Lump Sum', '', 'Lump Sum', 'cjjf', 'fhdh', 'fhdh', '8686', 'yes', '', 'Yes', 0, '2017-08-30 11:22:39', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(61, 57, 'PULLING WEEDS ', 5, 'PULLING WEEDS ', '2017-10-31', '01:43:42', '04:43:42', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Hourly Wage', '', 'Lump Sum', '539 Southern Oak Drive', 'FL', 'Ponte Vedra', '32081', 'yes', '', 'Yes', 0, '2017-08-31 15:50:48', '0000-00-00 00:00:00', 0, 0, NULL, 'yes'),
(62, 188, 'SEPTEMBER 7TH', 2, 'SEPTEMBER 7TH', '2017-09-08', '10:58:34', '09:59:34', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Lump Sum', '', 'Lump Sum', 'hdhf', 'hdhf', 'juridical', '8558', 'yes', '', 'Yes', 0, '2017-09-07 16:31:53', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(63, 133, 'HANDZ JOB', 3, 'HANDZ JOB', '2018-09-09', '07:56:55', '06:56:55', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Lump Sum', '', 'Lump Sum', 'yuh', 'fiuf', 'dhhd', '5556', 'yes', '', 'Yes', 0, '2017-09-09 13:29:57', '0000-00-00 00:00:00', 13.08, 80.27, NULL, 'no'),
(64, 133, 'GREAT', 14, 'GREAT', '2017-10-13', '05:44:19', '04:43:19', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Hourly Wage', '', 'Lump Sum', '', '', '', '', 'yes', '', 'Yes', 0, '2017-09-13 12:16:18', '0000-00-00 00:00:00', 12.9371, 80.1226, 'yes', 'no'),
(65, 133, 'HFFHUD', 5, 'HFFHUD', '2017-10-13', '06:58:54', '05:59:54', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 35, 'Hourly Wage', '', 'Lump Sum', '', '', '', '', 'yes', '', 'Yes', 0, '2017-09-13 12:31:24', '0000-00-00 00:00:00', 12.9388, 80.1209, 'yes', 'no'),
(66, 189, 'SEP14', 4, 'SEP14', '2017-10-14', '04:21:43', '05:20:43', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Lump Sum', '', 'Lump Sum', '', '', '', '', 'yes', '', 'Yes', 0, '2017-09-14 10:53:21', '0000-00-00 00:00:00', 12.9371, 80.1224, 'yes', 'yes'),
(67, 190, 'SRE', 8, 'SRE', '2017-10-20', '11:11:36', '12:10:36', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Daily', '', 'Lump Sum', 'fhf', 'god', 'fhf', '436', 'no', '', 'Yes', 0, '2017-09-20 17:45:06', '0000-00-00 00:00:00', 12.937, 80.1224, 'yes', 'no'),
(68, 190, 'ETRGFDF', 4, 'ETRGFDF', '2017-10-20', '01:15:59', '01:15:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Daily', '', 'Lump Sum', '', 'jyrjyf', 'rtf', '555', 'yes', '', 'Yes', 0, '2017-09-20 17:52:26', '0000-00-00 00:00:00', 12.937, 80.1224, 'yes', 'no'),
(69, 133, 'DRF', 2, 'DRF', '2017-10-21', '01:13:37', '01:13:37', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 52, 'Hourly Wage', '', 'Lump Sum', '', '', '', '', 'yes', '', 'Yes', 0, '2017-09-20 19:46:12', '0000-00-00 00:00:00', 12.9371, 80.1224, 'yes', 'no'),
(70, 133, 'CHCHHCHC', 2, 'CHCHHCHC', '2017-09-23', '01:02:46', '02:01:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8585, 'Lump Sum', '', 'Lump Sum', '', '', '', '', 'yes', '', 'Yes', 0, '2017-09-22 07:35:04', '0000-00-00 00:00:00', 12.9372, 80.1225, 'yes', 'no'),
(71, 57, 'MULCHING THE BACKYARD', 5, 'MULCHING THE BACKYARD', '2017-10-10', '01:00:10', '04:00:10', '2001-00-10 00:00:00', '2004-00-10 00:00:00', 10, 'Hourly', '', 'Lump Sum', '', '', '', '', 'yes', '', 'Yes', 0, '2017-09-24 16:11:15', '0000-00-00 00:00:00', 30.1354, -81.4238, 'yes', 'no'),
(72, 198, 'OCT 9', 5, 'OCT 9', '2017-10-10', '12:50:31', '11:51:31', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1800, 'Lump Sum', '', 'Lump Sum', 'Cafu', 'gh', 'gh', '55', 'no', '', 'Yes', 0, '2017-10-09 06:26:10', '0000-00-00 00:00:00', 12.937, 80.1225, 'no', 'yes'),
(73, 198, 'OCT 9 2ND', 5, 'OCT 9 2ND', '2017-11-09', '02:42:17', '03:41:17', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1000, 'Hourly Wage', '', 'Lump Sum', 'fgghdfh', 'chchhchc', 'hdhf', '5555', 'yes', '', 'Yes', 0, '2017-10-09 09:16:20', '0000-00-00 00:00:00', 12.9371, 80.1222, 'no', 'no'),
(74, 70, 'fhgf', 0, 'ghhfg', '2017-10-10', '05:43:19', '05:43:19', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 800.99, 'Lump Sum', '', 'Lump Sum', '2 , 2nd main road, svs nagar, valasaravakkam', 'tamilnadu', 'chennai', '600087', 'no', '', 'Yes', 0, '2017-10-10 12:19:23', '0000-00-00 00:00:00', 13.0399, 13.0399, NULL, 'no'),
(75, 70, 'new job', 18, 'fhjht', '2017-10-10', '05:47:28', '05:47:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 800.99, 'Lump Sum', '', 'Lump Sum', '2 , 2nd main road, svs nagar, valasaravakkam', 'tamilnadu', 'chennai', '600087', 'no', '', 'Yes', 0, '2017-10-10 12:22:32', '0000-00-00 00:00:00', 13.0399, 80.1733, NULL, 'no'),
(76, 198, 'OCT 12', 4, 'OCT 12', '2017-10-13', '05:33:39', '05:33:39', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 800, 'Daily', '', 'Lump Sum', 'yhhggjg', 'ghh', 'hffh', '825', 'yes', '', 'Yes', 0, '2017-10-12 11:08:52', '0000-00-00 00:00:00', 12.9371, 80.1224, 'no', 'no'),
(77, 198, 'NOV 1', 2, 'NOV 1', '2017-12-01', '05:31:37', '06:30:37', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 9000, 'Daily', '', 'Lump Sum', 'HD', 'f', 'e.g.', '5', 'yes', '', 'Yes', 0, '2017-11-01 12:02:40', '0000-00-00 00:00:00', 10.8, 30.8, 'no', 'no'),
(78, 198, 'NOV 12ND', 2, 'NOV 12ND', '2017-12-01', '07:07:59', '06:08:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 14, 'Lump Sum', '', 'Lump Sum', 'dh', 'HD', 'Sg', '54', 'yes', '', 'Yes', 0, '2017-11-01 12:40:15', '0000-00-00 00:00:00', 10.8, 30.8, 'yes', 'no'),
(79, 198, 'TEST NOV', 5, 'TEST NOV', '2017-12-01', '07:27:59', '08:26:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 578, 'Lump Sum', '', 'Lump Sum', 'chr', 'chr', 'HD', '666', 'yes', '', 'Yes', 0, '2017-11-01 13:58:59', '0000-00-00 00:00:00', 10.8, 30.8, 'no', 'yes'),
(80, 133, 'TEST 123', 5, 'TEST 123', '2017-12-01', '09:50:19', '09:50:19', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 852, 'Daily', '', 'Lump Sum', 'dh', 'ghh', 'dh', '666', 'yes', '', 'Yes', 0, '2017-11-01 15:22:15', '0000-00-00 00:00:00', 10.8, 30.8, 'no', 'no'),
(81, 198, 'JACK 123', 5, 'JACK 123', '2017-11-01', '08:52:46', '10:51:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 100, 'Bi-Weekly', '', 'Lump Sum', 'ch', 'dh', 'dh', '666', 'yes', '', 'Yes', 0, '2017-11-01 15:23:43', '0000-00-00 00:00:00', 10.8, 30.8, 'no', 'no'),
(82, 70, 'new job', 0, 'new job', '2017-11-10', '06:42:01', '06:42:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 800.99, 'Lump Sum', '', 'Lump Sum', '2, 2nd main road, svs nagar, valasaravakkam', 'tamilnadu', 'chennai', '600087', 'no', '', 'Yes', 0, '2017-11-10 13:26:23', '0000-00-00 00:00:00', 13.0399, 80.1733, NULL, 'no'),
(83, 198, 'NEW JOB NOV 14', 3, 'NEW JOB NOV 14', '2017-12-14', '01:39:55', '02:38:55', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 85, 'Lump Sum', '', 'Lump Sum', 'Dudu Gigi to Gigi ', 'NY', 'fuhf', '4554', 'yes', '', 'Yes', 0, '2017-11-14 08:12:45', '0000-00-00 00:00:00', 12.9371, 80.1223, 'no', 'yes'),
(84, 133, 'DUD', 5, 'DUD', '2017-12-14', '04:14:20', '05:13:20', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 12, 'Lump Sum', '', 'Lump Sum', '', '', '', '', 'yes', '', 'Yes', 0, '2017-11-14 10:46:30', '0000-00-00 00:00:00', 12.937, 80.1224, 'yes', 'no'),
(85, 133, 'NOV 15', 4, 'NOV 15', '2017-12-15', '11:55:58', '12:54:58', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 200, 'Weekly', '', 'Lump Sum', 'Amar Nagar 1st Cross Street', 'Tamil Nadu', 'Sholinganallur', '600045', 'yes', '', 'Yes', 0, '2017-11-15 06:28:13', '0000-00-00 00:00:00', 12.937, 80.1224, 'yes', 'no'),
(86, 133, 'OO ', 7, 'Oo ', '2017-12-22', '12:13:38', '12:14:38', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 69, 'Daily', '', 'Lump Sum', 'test', 'test', 'test', '555', 'yes', '', 'Yes', 0, '2017-11-15 06:30:16', '0000-00-00 00:00:00', 12.9371, 80.1223, 'no', 'no'),
(87, 70, 'brief job', 0, 'detail job', '2017-11-15', '08:57:35', '08:57:35', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 800.99, 'Lump Sum', '', 'Lump Sum', '2, 2nd main road, svs nagar, valasaravakkam', 'tamilnadu', 'chennai', '600087', 'no', '', 'Yes', 0, '2017-11-15 15:30:57', '0000-00-00 00:00:00', 13.0399, 80.1733, NULL, 'no'),
(88, 70, 'test job new', 16, 'test job new', '2017-11-15', '09:13:08', '09:13:08', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 800.99, 'Lump Sum', '', 'Lump Sum', '2 , 2nd main road, svs nagar, valasaravakkam', 'tamilnadu', 'chennai', '600087', 'no', '', 'Yes', 0, '2017-11-15 15:46:22', '0000-00-00 00:00:00', 13.0399, 80.1733, NULL, 'yes'),
(89, 133, 'HI NOV', 4, 'H vhf had jud jcjfuf fjjf', '2017-12-16', '12:40:15', '11:41:15', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 859, 'Bi-Weekly', '', 'Lump Sum', 'Amar Nagar 1st Cross Street', 'Tamil Nadu', 'Sholinganallur', '600045', 'yes', '', 'Yes', 0, '2017-11-16 18:13:39', '0000-00-00 00:00:00', 12.9371, 80.1224, 'yes', 'no'),
(90, 198, 'HIT', 5, 'Ch dh hf chr ufuf hffh uffu ufuf Fufu fjjf ufuf icicles', '2017-12-17', '03:38:51', '02:39:51', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 963, 'Monthly', '', 'Lump Sum', 'Amar Nagar 1st Cross Street', 'Tamil Nadu', 'Sholinganallur', '600045', 'yes', '', 'Yes', 0, '2017-11-17 09:12:07', '0000-00-00 00:00:00', 12.937, 80.1223, 'yes', 'yes'),
(91, 198, 'THAT', 5, 'Gd Fu it fuuf giiffit', '2017-12-17', '05:04:30', '06:04:30', '2005-04-30 00:00:00', '2006-04-30 00:00:00', 852, 'Weekly', '', 'Lump Sum', 'Amar Nagar 1st Cross Street', 'Tamil Nadu', 'Sholinganallur', '600045', 'yes', '', 'Yes', 0, '2017-11-17 10:37:41', '0000-00-00 00:00:00', 12.937, 80.1225, 'yes', 'no'),
(92, 198, 'NIKE', 1, 'Fhdh', '2017-12-20', '03:26:20', '05:26:20', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2580, 'Hourly Wage', '', 'Lump Sum', 'Amar Nagar 1st Main Road', 'Tamil Nadu', 'Sholinganallur', '600045', 'yes', '', 'Yes', 0, '2017-11-17 10:59:28', '0000-00-00 00:00:00', 12.9371, 80.1223, 'yes', 'no'),
(93, 133, 'JFJGVJ', 2, 'Khhkkh', '2017-11-17', '07:44:05', '04:44:05', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 74125, 'Lump Sum', '', 'Lump Sum', 'Amar Nagar 1st Cross Street', 'Tamil Nadu', 'Sholinganallur', '600045', 'yes', '', 'Yes', 0, '2017-11-17 12:06:56', '0000-00-00 00:00:00', 12.937, 80.1224, 'yes', 'no'),
(94, 198, 'BBB', 20, 'Dh', '2017-12-24', '07:44:05', '04:44:05', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 852, 'Daily', '', 'Lump Sum', 'Amar Nagar 1st Cross Street', 'Tamil Nadu', 'Sholinganallur', '600045', 'yes', '', 'Yes', 0, '2017-11-17 13:17:16', '0000-00-00 00:00:00', 12.9371, 80.1223, 'yes', 'yes'),
(95, 198, 'DFFH GHGHGH', 2, 'FFT', '2017-12-17', '08:15:46', '07:17:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 88, 'Daily', '', 'Lump Sum', 'Amar Nagar 1st Cross Street', 'Tamil Nadu', 'Sholinganallur', '600045', 'yes', '', 'Yes', 0, '2017-11-17 13:49:27', '0000-00-00 00:00:00', 12.9371, 80.1223, 'yes', 'yes'),
(96, 198, 'HDHF FUFU FUFU FU UFUF TECH', 1, 'Fufhf', '2017-11-17', '07:23:33', '08:22:33', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8778, 'Lump Sum', '', 'Lump Sum', 'dh', 'gd', 'gd', '7558', 'yes', '', 'Yes', 0, '2017-11-17 13:55:43', '0000-00-00 00:00:00', 12.9367, 80.1222, 'no', 'no'),
(97, 198, 'KHAKI ', 1, 'Fff dhdhf ugjggj', '2017-12-16', '08:44:48', '05:44:48', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8524, 'Hourly Wage', '', 'Lump Sum', 'Amar Nagar 1st Cross Street', 'Tamil Nadu', 'Sholinganallur', '600045', 'yes', '', 'Yes', 0, '2017-11-18 14:18:03', '0000-00-00 00:00:00', 12.9371, 80.1223, 'yes', 'yes'),
(98, 200, 'JEEP NOV 20', 3, 'Ghgg ufuf I ihig', '2017-11-20', '02:05:05', '03:06:05', '2002-05-05 00:00:00', '2003-06-05 00:00:00', 852, 'Hourly Wage', '', 'Lump Sum', 'Amar Nagar 1st Cross Street', 'Tamil Nadu', 'Sholinganallur', '600045', 'yes', '', 'Yes', 0, '2017-11-20 07:38:39', '0000-00-00 00:00:00', 12.9371, 80.1221, 'yes', 'yes'),
(99, 200, 'NOV20 TEST JOB', 1, 'Ghh Fufu Fufu Dudu Igor', '2017-11-21', '03:49:14', '01:49:14', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 9000, 'Daily', '', 'Lump Sum', 'Amar Nagar 1st Cross Street', 'Tamil Nadu', 'Sholinganallur', '600045', 'yes', '', 'Yes', 0, '2017-11-20 09:22:47', '0000-00-00 00:00:00', 12.9371, 80.1225, 'yes', 'yes'),
(100, 200, 'SIGN', 2, 'Sg hffh uffu if', '2017-11-22', '04:31:07', '06:30:07', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 86, 'Bi-Weekly', '', 'Lump Sum', 'Amar Nagar 1st Cross Street', 'Tamil Nadu', 'Sholinganallur', '600045', 'yes', '', 'Yes', 0, '2017-11-20 11:03:34', '0000-00-00 00:00:00', 12.9371, 80.1223, 'yes', 'no'),
(101, 200, 'CAKE', 7, 'Dhhd Gigi. Figivig ufuf', '2025-12-20', '05:58:54', '06:58:54', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 65, 'Weekly', '', 'Lump Sum', 'Amar Nagar 1st Cross Street', 'Tamil Nadu', 'Sholinganallur', '600045', 'yes', '', 'Yes', 0, '2017-11-20 11:32:26', '0000-00-00 00:00:00', 12.9371, 80.1223, 'yes', 'no'),
(102, 200, 'UP DOWN ', 8, 'Dud ur jig ufuf kcjfur Fufu gigig jcjf Gigi dydufgj oggici', '2019-11-20', '09:37:58', '03:37:57', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 800, 'Lump Sum', '', 'Lump Sum', 'hi', 'jig', 'uffu', '88656', 'yes', '', 'Yes', 0, '2017-11-20 14:11:31', '0000-00-00 00:00:00', 12.9372, 80.1224, 'no', 'yes'),
(103, 71, 'vsd', 0, 'sfs', '2017-11-20', '09:00:10', '08:12:01', '2017-11-21 00:00:00', '2017-11-22 00:00:00', 100, 'ada', '', 'Lump Sum', '45gg', 'adaad', 'asda', 'ada', 'ada', '', 'Yes', 0, '2017-11-20 14:39:46', '0000-00-00 00:00:00', 0, 0, 'no', 'no'),
(104, 57, 'HANGING CHRISTMAS LIGHTS! ', 21, 'We like to decorate our house for the holidays. We have three Christmas trees that need to be strung with lights and decorated. Jay needs help hanging lights on the front our two story home. You must be comfortable climbing a ladder.', '2017-12-01', '11:00:58', '03:00:58', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 10, 'Hourly Wage', '', 'Lump Sum', '327–699 Southern Oak Dr', 'FL', 'Ponte Vedra', '32081', 'yes', '', 'Yes', 0, '2017-11-21 04:13:43', '0000-00-00 00:00:00', 30.1353, -81.4236, 'yes', 'no'),
(105, 70, 'hffhfhf', 10, 'hchchfhg', '2017-11-21', '12:43:39', '12:43:39', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 800.99, 'Lump Sum', '', 'Lump Sum', '2, 2nd main road, svs nagar, valasaravakkam', 'tamilnadu', 'chennai', '600087', 'no', '', 'Yes', 0, '2017-11-21 07:21:04', '0000-00-00 00:00:00', 13.0399, 80.1733, 'no', 'no'),
(106, 70, 'pet care nov', 11, 'gggghh', '2017-11-21', '01:04:43', '01:04:43', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 800.99, 'Lump Sum', '', 'Lump Sum', '', '', '', '', 'no', '', 'Yes', 0, '2017-11-21 07:37:56', '0000-00-00 00:00:00', 13.0399, 80.1733, 'yes', 'no'),
(107, 201, 'NOV 21', 3, 'Uffu Gigi Igor Igor ufuf', '2019-01-30', '05:42:26', '02:42:26', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 700, 'Lump Sum', '', 'Lump Sum', 'Amar Nagar 1st Cross Street', 'Tamil Nadu', 'Sholinganallur', '600045', 'yes', '', 'Yes', 0, '2017-11-21 11:16:00', '0000-00-00 00:00:00', 12.9371, 80.1224, 'yes', 'yes'),
(108, 70, 'organizing', 18, 'ufjgh', '2017-11-22', '11:22:37', '11:22:37', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 800.99, 'Lump Sum', '', 'Lump Sum', '2, 2nd main road, svs nagar, valasaravakkam', 'tamilnadu', 'chennai', '600087', 'no', '', 'Yes', 0, '2017-11-22 05:56:07', '0000-00-00 00:00:00', 13.0399, 80.1733, 'no', 'no'),
(109, 70, 'dinner', 13, 'fuffgu', '2017-11-22', '01:04:07', '01:04:07', '2001-04-07 00:00:00', '2001-04-07 00:00:00', 800.99, 'Lump Sum', '', 'Lump Sum', '', '', '', '', 'no', '', 'Yes', 0, '2017-11-22 07:37:36', '0000-00-00 00:00:00', 0, 0, 'yes', 'no'),
(110, 133, 'uggugug', 0, 'fjfij', '2017-11-22', '01:06:02', '01:06:02', '2001-06-02 00:00:00', '2001-06-02 00:00:00', 800.99, 'Lump Sum', '', 'Lump Sum', '', '', '', '', 'no', '', 'Yes', 0, '2017-11-22 07:39:12', '0000-00-00 00:00:00', 0, 0, 'yes', 'no'),
(111, 71, 'vsd', 0, 'sfs', '2017-11-20', '09:00:10', '08:12:01', '2017-11-21 00:00:00', '2017-11-22 00:00:00', 100, 'ada', '', 'Lump Sum', '45gg', 'adaad', 'asda', 'ada', 'ada', '', 'Yes', 0, '2017-11-22 07:48:40', '0000-00-00 00:00:00', 0, 0, 'no', 'no'),
(112, 198, 'QQ', 2, 'Ghh', '2017-12-19', '03:45:48', '11:45:48', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 808, 'Hourly Wage', '', 'Lump Sum', 'Amar Nagar 1st Cross Street', 'Tamil Nadu', 'Sholinganallur', '600045', 'yes', '', 'Yes', 0, '2017-11-22 09:19:17', '0000-00-00 00:00:00', 12.937, 80.1227, 'yes', 'yes'),
(113, 70, 'igigigihi', 17, 'ufjguh', '2017-11-22', '05:40:30', '05:40:30', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 800.99, 'Lump Sum', '', 'Lump Sum', '', '', '', '', 'no', '', 'Yes', 0, '2017-11-22 12:13:40', '0000-00-00 00:00:00', 0, 0, 'yes', 'no'),
(114, 200, 'JOB 12', 4, 'Uff', '2017-12-24', '06:47:39', '05:48:39', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 85, 'Bi-Weekly', '', 'Lump Sum', 'Amar Nagar 1st Cross Street', 'Tamil Nadu', 'Sholinganallur', '600045', 'yes', '', 'Yes', 0, '2017-11-22 12:21:09', '0000-00-00 00:00:00', 12.9371, 80.1223, 'yes', 'yes'),
(115, 70, 'ryfufg', 0, 'ydyfyu', '2017-11-22', '10:11:56', '10:11:56', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 800.99, 'Lump Sum', '', 'Lump Sum', '', '', '', '', 'no', '', 'Yes', 0, '2017-11-22 16:45:04', '0000-00-00 00:00:00', 0, 0, 'yes', 'no'),
(116, 70, 'iguggu', 0, 'jgjggjg', '2017-11-23', '07:32:50', '07:32:50', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 800.99, 'Lump Sum', '', 'Lump Sum', '', '', '', '', 'no', '', 'Yes', 0, '2017-11-23 14:06:02', '0000-00-00 00:00:00', 30, 17, 'yes', 'no'),
(117, 70, 'ygjgugg', 11, 'hvybjbkb', '2017-11-24', '04:11:29', '04:11:29', '2004-11-29 00:00:00', '2004-11-29 00:00:00', 800.99, 'Lump Sum', '', 'Lump Sum', '', '', '', '', 'no', '', 'Yes', 0, '2017-11-24 10:46:09', '0000-00-00 00:00:00', 30, 17, 'yes', 'no'),
(118, 70, 'ggjg', 0, 'vvjg', '2017-11-24', '04:13:23', '04:13:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 800.99, 'Lump Sum', '', 'Lump Sum', '2, 2nd main road, svs nagar, valasaravakkam', 'tamilnadu', 'chennai', '600087', 'no', '', 'Yes', 0, '2017-11-24 10:46:59', '0000-00-00 00:00:00', 30, 17, 'no', 'no'),
(119, 200, 'NOV 28', 9, 'Fjjf gigigiigigigigufttdyfigig I gigig I gigig gifufhddiditgidgdigdidgififi iffiuoosusouousfuforousdtusuoutssuotdgpiutodgodudgougudo', '2017-11-29', '05:57:47', '05:57:47', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 500, 'Lump Sum', '', 'Lump Sum', 'Amar Nagar 1st Cross Street', 'Tamil Nadu', 'Sholinganallur', '600045', 'yes', '', 'Yes', 0, '2017-11-28 11:32:09', '0000-00-00 00:00:00', 12.937, 80.1223, 'yes', 'no'),
(120, 198, 'VIC', 5, 'Hddgurwtsiis aruurstiuishtiahraoru khadhkarharkrahkrharhkaahkrhrakahkfarhkakhrrhakshrk', '2017-12-29', '02:04:16', '01:05:16', '2002-04-16 00:00:00', '2001-05-16 00:00:00', 400, 'Lump Sum', '', 'Lump Sum', '17 park street, Kolkata', 'West Bengal', 'Kolkata', '700016', 'yes', '', 'Yes', 0, '2017-11-29 07:41:11', '0000-00-00 00:00:00', 22.5539, 0, 'no', 'no'),
(121, 198, 'BIKE', 2, 'Ufudye', '2017-12-29', '06:28:24', '05:29:24', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1000, 'Weekly', '', 'Lump Sum', 'kite', 'kite', 'kite', '1111', 'yes', '', 'Yes', 0, '2017-11-29 12:02:54', '0000-00-00 00:00:00', 50.7222, 0, 'no', 'no'),
(122, 198, 'HDHD', 2, 'Dhhd dh', '2017-12-29', '08:32:57', '09:32:57', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 333, 'Hourly Wage', '', 'Lump Sum', 'hhh', 'hhh', 'hhh', '111', 'yes', '', 'Yes', 0, '2017-11-29 14:07:05', '0000-00-00 00:00:00', 0, 0, 'no', 'no'),
(123, 200, 'HILL', 4, 'Bcxskh', '2017-12-31', '07:38:26', '09:38:26', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1000, 'Bi-Weekly', '', 'Lump Sum', 'Amar Nagar 1st Cross Street', 'Tamil Nadu', 'Sholinganallur', '600045', 'yes', '', 'Yes', 0, '2017-11-30 13:12:38', '0000-00-00 00:00:00', 12.9371, 80.1225, 'yes', 'no'),
(124, 200, 'DHHD', 5, 'It’s', '2017-12-30', '08:35:10', '07:36:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 45, 'Hourly Wage', '', 'Lump Sum', 'Amar Nagar 1st Cross Street', 'Tamil Nadu', 'Sholinganallur', '600045', 'yes', '', 'Yes', 0, '2017-11-30 14:09:12', '0000-00-00 00:00:00', 12.937, 80.1223, 'yes', 'no'),
(125, 200, 'DHHD', 5, 'Dhhd', '2018-01-30', '08:53:35', '07:55:35', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 58, 'Lump Sum', '', 'Lump Sum', 'Amar Nagar 1st Cross Street', 'Tamil Nadu', 'Sholinganallur', '600045', 'yes', '', 'Yes', 0, '2017-11-30 14:28:13', '0000-00-00 00:00:00', 12.937, 80.1223, 'yes', 'no'),
(126, 200, 'EYES', 4, 'Gd', '2018-12-31', '08:57:33', '07:58:33', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 53, 'Lump Sum', '', 'Lump Sum', 'Amar Nagar 2nd Main Road', 'Tamil Nadu', 'Sholinganallur', '600045', 'yes', '', 'Yes', 0, '2017-11-30 14:31:40', '0000-00-00 00:00:00', 12.9374, 80.122, 'yes', 'no'),
(127, 200, 'ARISTIDE', 1, 'Stjtsjgsj', '2018-01-30', '10:20:23', '09:20:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 6856, 'Weekly', '', 'Lump Sum', 'Amar Nagar 1st Cross Street', 'Tamil Nadu', 'Sholinganallur', '600045', 'yes', '', 'Yes', 0, '2017-11-30 14:54:27', '0000-00-00 00:00:00', 12.937, 80.1223, 'yes', 'no'),
(128, 200, 'EITHER', 4, 'Twiitw', '2018-12-30', '12:23:48', '08:24:48', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2555, 'Daily', '', 'Lump Sum', 'Amar Nagar 1st Cross Street', 'Tamil Nadu', 'Sholinganallur', '600045', 'yes', '', 'Yes', 0, '2017-11-30 14:57:57', '0000-00-00 00:00:00', 12.937, 80.1226, 'yes', 'yes'),
(129, 200, 'DHKKDDYK', 5, 'Duffy', '2018-12-30', '11:09:23', '11:09:23', '2011-09-23 00:00:00', '2011-09-23 00:00:00', 52, 'Hourly Wage', '', 'Lump Sum', 'Amar Nagar 1st Cross Street', 'Tamil Nadu', 'Sholinganallur', '600045', 'yes', '', 'Yes', 0, '2017-11-30 15:43:30', '0000-00-00 00:00:00', 12.937, 80.1223, 'yes', 'yes'),
(130, 200, 'FHGG JFGFGU SUTRFUYDDHJGDHUUYEETUER SYFUSTURSYRUUSYR JFYDSRYUEUYR', 2, 'Fhdgydru gycjtditdy hgcjjdgh', '2018-02-01', '01:07:26', '03:07:26', '2001-07-26 00:00:00', '2003-07-26 00:00:00', 563, 'Hourly Wage', '', 'Lump Sum', 'Amar Nagar 1st Cross Street', 'Tamil Nadu', 'Sholinganallur', '600045', 'yes', '', 'Yes', 0, '2017-12-01 06:48:49', '0000-00-00 00:00:00', 12.937, 80.1223, 'yes', 'no'),
(131, 57, 'HOLIDAY PARTY HELP', 14, 'You will serve food and drinks to our guests. We will also ask that you walk around and help clear plates and glasses during the party. You must be capable of loading a dishwasher. Please wear a white button down shirt and black long pants. Thank you!', '2017-12-13', '07:30:49', '12:00:49', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 60, 'Lump Sum', '', 'Lump Sum', '327–699 Southern Oak Dr', 'FL', 'Ponte Vedra', '32081', 'yes', '', 'Yes', 0, '2017-12-02 02:29:26', '0000-00-00 00:00:00', 30.1354, -81.4237, 'yes', 'no'),
(132, 200, 'LIGHT', 4, 'Dhdhdh', '2019-01-02', '03:22:28', '02:23:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 100, 'Lump Sum', '', 'Lump Sum', 'Amar Nagar 1st Cross Street', 'Tamil Nadu', 'Sholinganallur', '600045', 'yes', '', 'Yes', 0, '2017-12-02 08:56:45', '0000-00-00 00:00:00', 12.9371, 80.1223, 'yes', 'yes'),
(133, 200, 'PARROT', 5, 'Satay', '2018-01-02', '09:01:38', '08:02:38', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 200, 'Hourly Wage', '', 'Lump Sum', 'Amar Nagar 1st Main Road', 'Tamil Nadu', 'Sholinganallur', '600045', 'yes', '', 'Yes', 0, '2017-12-02 14:36:02', '0000-00-00 00:00:00', 12.9371, 80.1224, 'yes', 'yes'),
(134, 57, 'DOG WALKING', 12, 'We will be away for a week and need a dog walker to come while we’re gone. Dog walker will need to feed our dog twice a day and walk three times a day. ', '2017-12-20', '09:00:10', '07:23:10', '2009-00-10 00:00:00', '0000-00-00 00:00:00', 30, 'Daily', '', 'Lump Sum', '475 South Mill View Way', 'FL', 'Ponte Vedra Beach', '32081', 'no', '', 'Yes', 0, '2017-12-02 17:33:26', '0000-00-00 00:00:00', 30.1368, 0, 'no', 'no'),
(135, 200, 'IIII', 19, 'Chchhchc', '2018-12-04', '01:08:54', '12:07:54', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 555, 'Lump Sum', '', 'Lump Sum', 'Amar Nagar 1st Cross Street', 'Tamil Nadu', 'Sholinganallur', '600045', 'no', '', 'Yes', 0, '2017-12-02 18:43:11', '0000-00-00 00:00:00', 12.937, 80.1223, 'yes', 'no'),
(136, 200, 'UIOP', 4, 'Hdhd', '2018-01-04', '11:46:34', '12:46:34', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1234, 'Weekly', '', 'Lump Sum', 'Amar Nagar 1st Cross Street', 'Tamil Nadu', 'Sholinganallur', '600045', 'yes', '', 'Yes', 0, '2017-12-04 05:21:02', '0000-00-00 00:00:00', 12.9368, 80.1225, 'yes', 'yes'),
(137, 70, 'hghh', 6, 'vgggh', '2017-12-04', '12:56:00', '12:56:08', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 800.99, 'Lump Sum', '', 'Lump Sum', 'hghkj', 'h', 'g', '23', 'yes', '', 'Yes', 0, '2017-12-04 07:30:52', '0000-00-00 00:00:00', 30, 17, 'no', 'no'),
(138, 198, 'ADD', 2, 'Dhdhdh', '2018-12-11', '10:03:00', '09:04:00', '2010-03-00 00:00:00', '2009-04-00 00:00:00', 123, 'Lump Sum', '', 'Lump Sum', 'Amar Nagar 1st Cross Street', 'Tamil Nadu', 'Sholinganallur', '600045', 'yes', '', 'Yes', 0, '2017-12-11 15:38:26', '0000-00-00 00:00:00', 12.9371, 80.1223, 'yes', 'no'),
(139, 70, 'lat', 0, 'lon', '2017-12-12', '04:17:51', '04:17:51', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 800.99, 'Lump Sum', '', 'Lump Sum', '', '', '', '', 'no', '', 'Yes', 0, '2017-12-12 10:52:42', '0000-00-00 00:00:00', 11.4176, 79.6842, 'yes', 'no'),
(140, 70, 'Dec 12', 2, 'ghh', '2017-12-12', '04:30:44', '04:30:44', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 99, 'Lump Sum', '', 'Lump Sum', '', '', '', '', 'no', '', 'Yes', 0, '2017-12-12 11:05:56', '0000-00-00 00:00:00', 0, 0, NULL, 'no'),
(141, 70, 'holi', 0, 'ghhj', '2017-12-12', '08:08:01', '08:08:01', '2008-08-01 00:00:00', '2008-08-01 00:00:00', 800.99, 'Lump Sum', '', 'Lump Sum', '', '', '', '', 'no', '', 'Yes', 0, '2017-12-12 14:44:41', '0000-00-00 00:00:00', 0, 0, 'yes', 'no'),
(142, 198, 'DEC13', 2, 'Dudu fjjf', '2018-01-13', '01:36:46', '12:37:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 852, 'Daily', '', 'Lump Sum', 'Amar Nagar 1st Cross Street', 'Tamil Nadu', 'Sholinganallur', '600045', 'yes', '', 'Yes', 0, '2017-12-13 07:12:20', '0000-00-00 00:00:00', 12.9371, 80.1223, 'yes', 'yes'),
(143, 70, 'yuuh', 1, 'ghhu', '2017-12-13', '04:01:30', '04:01:30', '2004-01-30 00:00:00', '2004-01-30 00:00:00', 800.99, 'Lump Sum', '', 'Lump Sum', '', '', '', '', 'no', '', 'Yes', 0, '2017-12-13 10:36:26', '0000-00-00 00:00:00', 0, 0, 'yes', 'no'),
(144, 198, 'TEST KIT', 2, 'Dhhd chchhchc uffujf', '2018-01-13', '06:26:23', '04:26:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1000, 'Daily', '', 'Lump Sum', 'Amar Nagar 1st Cross Street', 'Tamil Nadu', 'Sholinganallur', '600045', 'yes', '', 'Yes', 0, '2017-12-13 12:01:47', '0000-00-00 00:00:00', 12.937, 80.1223, 'yes', 'no'),
(145, 198, 'Y', 17, 'Test', '2018-02-13', '07:00:33', '04:00:33', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 500, 'Hourly Wage', '', 'Lump Sum', 'Amar Nagar 1st Cross Street', 'Tamil Nadu', 'Sholinganallur', '600045', 'yes', '', 'Yes', 0, '2017-12-13 12:35:47', '0000-00-00 00:00:00', 12.9371, 80.1224, 'yes', 'yes'),
(146, 198, 'DHHD', 2, 'Dhhd', '2019-12-15', '09:58:43', '08:59:43', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 87, 'Hourly Wage', '', 'Lump Sum', 'Amar Nagar 1st Cross Street', 'Tamil Nadu', 'Sholinganallur', '600045', 'yes', '', 'Yes', 0, '2017-12-15 15:34:14', '0000-00-00 00:00:00', 12.937, 80.1224, 'yes', 'yes'),
(147, 203, 'PLUMBING', 3, 'Fufu Fu digits itddsiiursueor tsusuriusotosugdi ufzfyizsiurisur todiisorgduo', '2018-01-15', '11:47:15', '11:48:15', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 9658, 'Hourly Wage', '', 'Lump Sum', 'Amar Nagar 1st Cross Street', 'Tamil Nadu', 'Sholinganallur', '600045', 'yes', '', 'Yes', 0, '2017-12-15 18:23:02', '0000-00-00 00:00:00', 12.937, 80.1223, 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `jobs_history`
--

CREATE TABLE `jobs_history` (
  `id` int(11) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `job_id` int(11) DEFAULT NULL,
  `job_name` varchar(255) DEFAULT NULL,
  `employer_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tip` varchar(150) NOT NULL,
  `payment_amount` varchar(255) NOT NULL,
  `total_payment` varchar(255) NOT NULL,
  `transaction_date` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs_history`
--

INSERT INTO `jobs_history` (`id`, `payment_method`, `job_id`, `job_name`, `employer_id`, `employee_id`, `created_date`, `tip`, `payment_amount`, `total_payment`, `transaction_date`) VALUES
(1, 'Testffd', NULL, NULL, NULL, NULL, '2017-11-15 09:45:38', '', '', '', ''),
(2, 'cash', 72, 'OCT 9', 198, 199, '2017-11-16 18:19:28', '$67', '1000', '10', '16/11/2017'),
(3, 'cash', 99, 'NOV20 TEST JOB', 200, 199, '2017-11-20 10:39:00', '$ 566', '1000', '10', '16/11/2017'),
(4, ' 54', 112, 'QQ', 198, 200, '2017-11-22 09:24:00', '$ 54', '1000', '10', '16/11/2017'),
(5, 'PayPal', 102, 'UP DOWN ', 200, 199, '2017-11-30 16:52:45', '$46', '1000', '10', '16/11/2017'),
(6, 'Credit/Debit', 90, 'HIT', 198, 199, '2017-12-01 20:41:28', '$4554', '1000', '10', '16/11/2017'),
(7, 'PayPal', 114, 'JOB 12', 200, 199, '2017-12-02 09:02:38', '$852', '1000', '10', '16/11/2017'),
(8, 'PayPal', 114, 'JOB 12', 200, 199, '2017-12-02 09:02:43', '$852', '1000', '10', '16/11/2017'),
(9, 'PayPal', 132, 'LIGHT', 200, 198, '2017-12-02 09:11:16', '$5656', '1000', '10', '16/11/2017'),
(10, 'PayPal', 136, 'UIOP', 200, 199, '2017-12-04 05:22:52', '$124', '1000', '10', '16/11/2017'),
(11, 'PayPal', 145, 'Y', 198, 199, '2017-12-13 12:45:58', '$4555', '1000', '10', '16/11/2017'),
(12, 'PayPal', 142, 'DEC13', 198, 199, '2017-12-13 13:11:14', '$54', '1000', '10', '16/11/2017'),
(13, 'Credit/Debit', 79, 'TEST NOV', 198, 133, '2017-12-15 09:59:33', '$50', '$50', '$10', 'December 15, 2017'),
(14, 'PayPal', 94, 'BBB', 198, 199, '2017-12-15 11:36:05', '$85', '$22', '$107', 'December 15, 2017'),
(15, 'PayPal', 83, 'NEW JOB NOV 14', 198, 133, '2017-12-15 11:56:49', '$', '$85', '$85', 'December 15, 2017'),
(16, 'Credit/Debit', 95, 'DFFH GHGHGH', 198, 199, '2017-12-15 15:28:08', '$', '$', '$0', 'December 15, 2017'),
(17, 'PayPal', 146, 'DHHD', 198, 199, '2017-12-15 15:38:31', '$', '$52', '$52', 'December 15, 2017'),
(18, 'Credit/Debit', 147, 'PLUMBING', 203, 204, '2017-12-15 18:26:51', '$', '$9658', '$9658', 'December 15, 2017'),
(19, 'PayPal', 90, 'HIT', 198, 133, '2017-12-16 07:03:27', '$', '$85', '$85', 'December 16, 2017');

-- --------------------------------------------------------

--
-- Table structure for table `job_category`
--

CREATE TABLE `job_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('Active','Not Active') NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hex_colors` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_category`
--

INSERT INTO `job_category` (`id`, `name`, `status`, `created_date`, `updated_date`, `hex_colors`) VALUES
(1, 'Painting (Interior / Exterior)', 'Active', '2017-05-18 10:04:56', '2017-05-18 07:18:43', ''),
(2, 'Moving Items', 'Active', '2017-05-18 10:48:58', '2017-05-18 07:18:58', ''),
(3, 'Heavy Lifting', 'Active', '2017-05-18 10:49:08', '2017-05-18 07:19:08', ''),
(4, 'Unpacking Boxes', 'Active', '2017-05-18 10:49:21', '2017-05-18 07:19:21', ''),
(5, 'Landscaping', 'Active', '2017-05-18 10:49:32', '2017-05-18 07:19:32', ''),
(6, 'Lawnmowing', 'Active', '2017-05-18 10:49:51', '2017-05-18 07:19:51', ''),
(7, 'Raking Leaves', 'Active', '2017-05-18 10:50:00', '2017-05-18 07:20:00', ''),
(8, 'Babysitting', 'Active', '2017-05-18 10:50:11', '2017-05-18 07:20:47', ''),
(9, 'Digging (trench/hole)', 'Active', '2017-05-18 10:50:43', '2017-05-18 07:20:43', ''),
(10, 'Assembling Furniture/Object', 'Active', '2017-05-18 10:51:21', '2017-05-18 07:21:21', ''),
(11, 'Dog Walking', 'Active', '2017-05-18 10:51:33', '2017-05-18 07:21:33', ''),
(12, 'Pet Care', 'Active', '2017-05-18 10:51:40', '2017-05-18 07:21:40', ''),
(13, 'Workout Partner/Coach', 'Active', '2017-05-18 10:51:55', '2017-05-18 07:21:55', ''),
(14, 'Server(s) for Dinner Party', 'Active', '2017-05-18 10:52:15', '2017-05-18 07:22:15', ''),
(15, 'Bartender for House Party', 'Active', '2017-05-18 10:52:34', '2017-05-18 07:22:34', ''),
(16, 'Shoveling Show', 'Active', '2017-05-18 10:52:48', '2017-05-18 07:22:48', ''),
(17, 'Apprentice for Skilled Laborer', 'Active', '2017-05-18 10:53:09', '2017-05-18 07:23:09', ''),
(18, 'Cleaning', 'Active', '2017-05-18 10:53:22', '2017-05-18 07:23:22', ''),
(19, 'Organizing', 'Active', '2017-05-18 10:53:31', '2017-05-18 07:23:31', ''),
(20, 'Food Shopping', 'Active', '2017-05-18 10:53:41', '2017-05-18 07:23:41', ''),
(21, 'Other', 'Active', '2017-05-18 10:53:47', '2017-05-18 07:23:47', '');

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `custom_key` tinyint(4) NOT NULL DEFAULT '0',
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `key`, `level`, `ignore_limits`, `custom_key`, `date_created`) VALUES
(134, 'HandzForHire@~', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `notify_id` int(11) NOT NULL,
  `is_view` int(11) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `type` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `message`, `user_id`, `notify_id`, `is_view`, `date_created`, `type`) VALUES
(25, 'Payment is made forUP DOWN , provide star ratings', 200, 102, 0, '2017-11-30 09:52:47', 'paymentcompleted'),
(14, 'You are hired for DHKKDDYK', 199, 129, 0, '2017-11-30 09:34:25', 'hirejob'),
(18, '', 199, 102, 0, '2017-11-30 09:46:38', 'notificationCountActive'),
(24, 'Payment is made forUP DOWN , provide star ratings', 199, 102, 0, '2017-11-30 09:52:47', 'paymentcompleted'),
(20, '', 199, 102, 0, '2017-11-30 09:46:39', 'notificationCountActive'),
(22, '', 198, 90, 0, '2017-11-30 09:47:55', 'notificationCountMakePayment'),
(23, '', 198, 90, 0, '2017-11-30 09:47:55', 'notificationCountMakePayment'),
(26, 'Payment is made forUP DOWN , provide star ratings', 200, 102, 0, '2017-11-30 09:52:47', 'notificationCountStarRating'),
(27, 'Payment is made forUP DOWN , provide star ratings', 199, 102, 0, '2017-11-30 09:52:47', 'notificationCountStarRating'),
(28, 'Hdhf', 199, 129, 0, '2017-11-30 09:53:58', 'notificationCountMessage'),
(29, 'Hdhf', 199, 129, 0, '2017-11-30 09:53:58', 'notificationCountMsgActive'),
(30, 'Hdhf', 199, 129, 0, '2017-11-30 09:53:58', 'notificaitonCountMsgJobHistory'),
(31, 'Ghgg', 199, 129, 0, '2017-11-30 09:54:03', 'notificationCountMessage'),
(32, 'Ghgg', 199, 129, 0, '2017-11-30 09:54:03', 'notificationCountMsgActive'),
(33, 'Ghgg', 199, 129, 0, '2017-11-30 09:54:03', 'notificaitonCountMsgJobHistory'),
(34, 'Dhhd', 199, 129, 0, '2017-11-30 09:54:10', 'notificationCountMessage'),
(35, 'Dhhd', 199, 129, 0, '2017-11-30 09:54:10', 'notificationCountMsgActive'),
(36, 'Dhhd', 199, 129, 0, '2017-11-30 09:54:10', 'notificaitonCountMsgJobHistory'),
(37, 'Fhdh', 199, 129, 0, '2017-11-30 09:54:25', 'notificationCountMessage'),
(38, 'Fhdh', 199, 129, 0, '2017-11-30 09:54:25', 'notificationCountMsgActive'),
(39, 'Fhdh', 199, 129, 0, '2017-11-30 09:54:25', 'notificaitonCountMsgJobHistory'),
(40, 'Chjcch', 199, 129, 0, '2017-11-30 09:54:30', 'notificationCountMessage'),
(41, 'Chjcch', 199, 129, 0, '2017-11-30 09:54:30', 'notificationCountMsgActive'),
(42, 'Chjcch', 199, 129, 0, '2017-11-30 09:54:30', 'notificaitonCountMsgJobHistory'),
(296, 'DFFH GHGHGH job has been completed. Fill out a star rating of your employee under job history.', 199, 95, 0, '2017-12-15 08:28:09', 'notificationCountStarRating'),
(44, 'EEEE is applied for SEP14', 189, 66, 0, '2017-11-30 22:44:48', 'applyjob'),
(45, '', 200, 130, 0, '2017-11-30 23:48:49', 'notificationCountPosted'),
(47, 'Jetway is applied for HFFHUD', 133, 65, 0, '2017-12-01 04:54:42', 'applyjob'),
(48, 'You are hired for JOB 12', 199, 114, 0, '2017-12-01 05:47:30', 'hirejob'),
(49, 'You are refused', 199, 100, 0, '2017-12-01 06:00:22', 'refusejob'),
(51, 'Riyajazlyn is applied for job', 133, 23, 0, '2017-12-01 08:45:14', 'applyjob'),
(53, 'Riyajazlyn is applied for job', 133, 23, 0, '2017-12-01 08:45:48', 'applyjob'),
(54, '', 200, 114, 0, '2017-12-01 09:14:39', 'notificationCountActive'),
(55, '', 200, 114, 0, '2017-12-01 09:14:39', 'notificationCountActive'),
(56, 'Fdddg', 198, 114, 0, '2017-12-01 09:15:21', 'notificationCountMessage'),
(57, 'Fdddg', 198, 114, 0, '2017-12-01 09:15:21', 'notificationCountMsgActive'),
(58, 'Fdddg', 198, 114, 0, '2017-12-01 09:15:21', 'notificaitonCountMsgJobHistory'),
(59, 'Bhgyt', 198, 114, 0, '2017-12-01 09:15:28', 'notificationCountMessage'),
(60, 'Bhgyt', 198, 114, 0, '2017-12-01 09:15:28', 'notificationCountMsgActive'),
(61, 'Bhgyt', 198, 114, 0, '2017-12-01 09:15:28', 'notificaitonCountMsgJobHistory'),
(295, 'DFFH GHGHGH job has been completed. Fill out a star rating of your employer under job history.', 198, 95, 0, '2017-12-15 08:28:09', 'notificationCountStarRating'),
(63, 'Riyajazlyn is applied for job', 133, 23, 0, '2017-12-01 09:27:37', 'applyjob'),
(65, 'Riyajazlyn is applied for job', 133, 23, 0, '2017-12-01 09:33:35', 'applyjob'),
(66, 'You are hired for NEW JOB NOV 14', 133, 83, 0, '2017-12-01 12:04:26', 'hirejob'),
(67, 'You are hired for HDHF FUFU FUFU FU UFUF TECH', 199, 96, 0, '2017-12-01 12:04:47', 'hirejob'),
(68, 'You are hired for JACK 123', 133, 81, 0, '2017-12-01 13:19:50', 'hirejob'),
(69, 'Payment is made forHIT, provide star ratings', 199, 90, 0, '2017-12-01 13:41:29', 'paymentcompleted'),
(70, 'Payment is made forHIT, provide star ratings', 198, 90, 0, '2017-12-01 13:41:29', 'paymentcompleted'),
(71, 'Payment is made forHIT, provide star ratings', 198, 90, 0, '2017-12-01 13:41:29', 'notificationCountStarRating'),
(72, 'Payment is made forHIT, provide star ratings', 199, 90, 0, '2017-12-01 13:41:29', 'notificationCountStarRating'),
(73, 'You are hired for PULLING WEEDS ', 133, 61, 0, '2017-12-01 19:22:26', 'hirejob'),
(74, 'You are hired for PULLING WEEDS ', 133, 61, 0, '2017-12-01 19:22:28', 'hirejob'),
(75, 'You are refused', 133, 61, 0, '2017-12-01 19:22:29', 'refusejob'),
(76, 'You are hired for PULLING WEEDS ', 133, 61, 0, '2017-12-01 19:22:30', 'hirejob'),
(77, 'You are hired for PULLING WEEDS ', 133, 61, 0, '2017-12-01 19:22:31', 'hirejob'),
(78, 'You are hired for PULLING WEEDS ', 133, 61, 0, '2017-12-01 19:22:31', 'hirejob'),
(79, 'You are refused', 133, 61, 0, '2017-12-01 19:22:32', 'refusejob'),
(80, '', 57, 131, 0, '2017-12-01 19:29:26', 'notificationCountPosted'),
(81, 'You are hired for PULLING WEEDS ', 133, 61, 0, '2017-12-01 21:48:10', 'hirejob'),
(82, 'You are hired for PULLING WEEDS ', 133, 61, 0, '2017-12-01 21:48:11', 'hirejob'),
(83, 'You are hired for PULLING WEEDS ', 133, 61, 0, '2017-12-01 21:48:12', 'hirejob'),
(84, 'You are hired for PULLING WEEDS ', 133, 61, 0, '2017-12-01 21:48:13', 'hirejob'),
(85, 'You are hired for PULLING WEEDS ', 133, 61, 0, '2017-12-01 21:48:13', 'hirejob'),
(86, 'You are hired for PULLING WEEDS ', 133, 61, 0, '2017-12-01 21:48:14', 'hirejob'),
(87, 'You are hired for PULLING WEEDS ', 133, 61, 0, '2017-12-01 21:48:27', 'hirejob'),
(91, 'You are hired for LIGHT', 198, 132, 0, '2017-12-02 01:58:52', 'hirejob'),
(92, 'You are hired for LIGHT', 198, 132, 0, '2017-12-02 01:59:03', 'hirejob'),
(93, 'You are hired for LIGHT', 199, 132, 0, '2017-12-02 01:59:26', 'hirejob'),
(94, 'You are hired for LIGHT', 199, 132, 0, '2017-12-02 01:59:27', 'hirejob'),
(95, 'You are hired for LIGHT', 199, 132, 0, '2017-12-02 01:59:31', 'hirejob'),
(96, 'You are refused', 199, 132, 0, '2017-12-02 01:59:41', 'refusejob'),
(97, 'You are refused', 199, 132, 0, '2017-12-02 01:59:46', 'refusejob'),
(98, 'You are hired for LIGHT', 199, 132, 0, '2017-12-02 01:59:51', 'hirejob'),
(99, 'You are hired for LIGHT', 199, 132, 0, '2017-12-02 01:59:54', 'hirejob'),
(100, 'You are hired for LIGHT', 199, 132, 0, '2017-12-02 01:59:59', 'hirejob'),
(101, 'Ghgg', 199, 114, 0, '2017-12-02 02:00:41', 'notificationCountMessage'),
(102, 'Ghgg', 199, 114, 0, '2017-12-02 02:00:41', 'notificationCountMsgActive'),
(103, 'Ghgg', 199, 114, 0, '2017-12-02 02:00:41', 'notificaitonCountMsgJobHistory'),
(104, 'Nibble', 199, 114, 0, '2017-12-02 02:00:47', 'notificationCountMessage'),
(105, 'Nibble', 199, 114, 0, '2017-12-02 02:00:47', 'notificationCountMsgActive'),
(106, 'Nibble', 199, 114, 0, '2017-12-02 02:00:47', 'notificaitonCountMsgJobHistory'),
(107, 'Fggyu', 199, 114, 0, '2017-12-02 02:00:53', 'notificationCountMessage'),
(108, 'Fggyu', 199, 114, 0, '2017-12-02 02:00:53', 'notificationCountMsgActive'),
(109, 'Fggyu', 199, 114, 0, '2017-12-02 02:00:53', 'notificaitonCountMsgJobHistory'),
(110, 'Cffg', 200, 114, 0, '2017-12-02 02:01:11', 'notificationCountMessage'),
(111, 'Cffg', 200, 114, 0, '2017-12-02 02:01:11', 'notificationCountMsgActive'),
(112, 'Cffg', 200, 114, 0, '2017-12-02 02:01:11', 'notificaitonCountMsgJobHistory'),
(113, 'Dryer', 200, 114, 0, '2017-12-02 02:01:16', 'notificationCountMessage'),
(114, 'Dryer', 200, 114, 0, '2017-12-02 02:01:16', 'notificationCountMsgActive'),
(115, 'Dryer', 200, 114, 0, '2017-12-02 02:01:16', 'notificaitonCountMsgJobHistory'),
(116, 'Ii', 200, 114, 0, '2017-12-02 02:01:24', 'notificationCountMessage'),
(117, 'Ii', 200, 114, 0, '2017-12-02 02:01:24', 'notificationCountMsgActive'),
(118, 'Ii', 200, 114, 0, '2017-12-02 02:01:24', 'notificaitonCountMsgJobHistory'),
(119, 'Payment is made forJOB 12, provide star ratings', 199, 114, 0, '2017-12-02 02:02:39', 'paymentcompleted'),
(120, 'Payment is made forJOB 12, provide star ratings', 200, 114, 0, '2017-12-02 02:02:39', 'paymentcompleted'),
(121, 'Payment is made forJOB 12, provide star ratings', 200, 114, 0, '2017-12-02 02:02:39', 'notificationCountStarRating'),
(122, 'Payment is made forJOB 12, provide star ratings', 199, 114, 0, '2017-12-02 02:02:39', 'notificationCountStarRating'),
(123, 'Payment is made forJOB 12, provide star ratings', 199, 114, 0, '2017-12-02 02:02:45', 'paymentcompleted'),
(124, 'Payment is made forJOB 12, provide star ratings', 200, 114, 0, '2017-12-02 02:02:45', 'paymentcompleted'),
(125, 'Payment is made forJOB 12, provide star ratings', 200, 114, 0, '2017-12-02 02:02:45', 'notificationCountStarRating'),
(126, 'Payment is made forJOB 12, provide star ratings', 199, 114, 0, '2017-12-02 02:02:45', 'notificationCountStarRating'),
(127, '', 200, 132, 0, '2017-12-02 02:03:12', 'notificationCountActive'),
(128, '', 199, 132, 0, '2017-12-02 02:03:12', 'notificationCountActive'),
(129, '', 200, 132, 0, '2017-12-02 02:03:15', 'notificationCountActive'),
(130, '', 199, 132, 0, '2017-12-02 02:03:15', 'notificationCountActive'),
(131, '', 200, 132, 0, '2017-12-02 02:03:17', 'notificationCountActive'),
(132, '', 199, 132, 0, '2017-12-02 02:03:17', 'notificationCountActive'),
(133, 'Payment is made forLIGHT, provide star ratings', 198, 132, 0, '2017-12-02 02:11:17', 'paymentcompleted'),
(134, 'Payment is made forLIGHT, provide star ratings', 200, 132, 0, '2017-12-02 02:11:17', 'paymentcompleted'),
(135, 'Payment is made forLIGHT, provide star ratings', 200, 132, 0, '2017-12-02 02:11:17', 'notificationCountStarRating'),
(136, 'Payment is made forLIGHT, provide star ratings', 198, 132, 0, '2017-12-02 02:11:17', 'notificationCountStarRating'),
(137, 'You are hired for CAKE', 199, 101, 0, '2017-12-02 06:57:19', 'hirejob'),
(138, 'You are hired for EITHER', 199, 128, 0, '2017-12-02 06:57:31', 'hirejob'),
(141, 'You are hired for PARROT', 199, 133, 0, '2017-12-02 07:43:20', 'hirejob'),
(294, 'DFFH GHGHGH job has been completed. Fill out a star rating of your employer under job history.', 198, 95, 0, '2017-12-15 08:28:09', 'paymentcompleted'),
(142, '', 200, 128, 0, '2017-12-02 07:43:49', 'notificationCountActive'),
(143, '', 199, 128, 0, '2017-12-02 07:43:49', 'notificationCountActive'),
(145, 'You are hired for PARROT', 198, 133, 0, '2017-12-02 07:45:18', 'hirejob'),
(146, '', 200, 133, 0, '2017-12-02 07:46:14', 'notificationCountActive'),
(147, '', 198, 133, 0, '2017-12-02 07:46:14', 'notificationCountActive'),
(148, '', 57, 134, 0, '2017-12-02 10:33:26', 'notificationCountPosted'),
(149, 'You are refused', 133, 61, 0, '2017-12-02 10:34:40', 'refusejob'),
(150, 'You are hired for PULLING WEEDS ', 133, 61, 0, '2017-12-02 10:34:41', 'hirejob'),
(151, 'You are hired for PULLING WEEDS ', 133, 61, 0, '2017-12-02 10:34:42', 'hirejob'),
(152, 'You are hired for NOV 28', 199, 119, 0, '2017-12-02 11:28:44', 'hirejob'),
(153, 'You are hired for NOV 28', 199, 119, 0, '2017-12-02 11:28:47', 'hirejob'),
(154, 'You are refused', 199, 119, 0, '2017-12-02 11:28:52', 'refusejob'),
(155, 'You are hired for NOV 28', 199, 119, 0, '2017-12-02 11:28:54', 'hirejob'),
(156, '', 200, 135, 0, '2017-12-02 11:43:11', 'notificationCountPosted'),
(157, 'You are hired for NOV 28', 199, 119, 0, '2017-12-02 12:46:18', 'hirejob'),
(158, 'You are refused', 199, 119, 0, '2017-12-02 12:46:22', 'refusejob'),
(159, 'You are hired for PULLING WEEDS ', 133, 61, 0, '2017-12-03 11:38:13', 'hirejob'),
(160, 'You are hired for PULLING WEEDS ', 133, 61, 0, '2017-12-03 11:38:14', 'hirejob'),
(161, 'You are hired for PULLING WEEDS ', 133, 61, 0, '2017-12-03 11:38:15', 'hirejob'),
(162, 'You are hired for PULLING WEEDS ', 133, 61, 0, '2017-12-03 11:38:15', 'hirejob'),
(163, 'You are hired for PULLING WEEDS ', 133, 61, 0, '2017-12-03 11:38:16', 'hirejob'),
(164, 'You are hired for PULLING WEEDS ', 133, 61, 0, '2017-12-03 11:38:17', 'hirejob'),
(165, 'You are refused', 133, 61, 0, '2017-12-03 11:38:17', 'refusejob'),
(166, 'You are hired for PULLING WEEDS ', 133, 61, 0, '2017-12-03 11:38:18', 'hirejob'),
(167, 'You are refused', 133, 61, 0, '2017-12-03 11:38:19', 'refusejob'),
(168, 'Fff', 199, 133, 0, '2017-12-03 21:55:43', 'notificationCountMessage'),
(169, 'Fff', 199, 133, 0, '2017-12-03 21:55:43', 'notificationCountMsgActive'),
(170, 'Fff', 199, 133, 0, '2017-12-03 21:55:43', 'notificaitonCountMsgJobHistory'),
(171, 'Hffh', 199, 133, 0, '2017-12-03 21:56:02', 'notificationCountMessage'),
(172, 'Hffh', 199, 133, 0, '2017-12-03 21:56:02', 'notificationCountMsgActive'),
(173, 'Hffh', 199, 133, 0, '2017-12-03 21:56:02', 'notificaitonCountMsgJobHistory'),
(174, 'Ghgghhg', 198, 133, 0, '2017-12-03 21:56:40', 'notificationCountMessage'),
(175, 'Ghgghhg', 198, 133, 0, '2017-12-03 21:56:40', 'notificationCountMsgActive'),
(176, 'Ghgghhg', 198, 133, 0, '2017-12-03 21:56:40', 'notificaitonCountMsgJobHistory'),
(180, 'You are hired for UIOP', 199, 136, 0, '2017-12-03 22:21:54', 'hirejob'),
(179, 'EEEE is applied for UIOP', 200, 136, 0, '2017-12-03 22:21:35', 'applyjob'),
(181, '', 200, 136, 0, '2017-12-03 22:22:13', 'notificationCountActive'),
(182, '', 199, 136, 0, '2017-12-03 22:22:13', 'notificationCountActive'),
(183, 'Payment is made forUIOP, provide star ratings', 199, 136, 0, '2017-12-03 22:22:53', 'paymentcompleted'),
(184, 'Payment is made forUIOP, provide star ratings', 200, 136, 0, '2017-12-03 22:22:53', 'paymentcompleted'),
(185, 'Payment is made forUIOP, provide star ratings', 200, 136, 0, '2017-12-03 22:22:53', 'notificationCountStarRating'),
(186, 'Payment is made forUIOP, provide star ratings', 199, 136, 0, '2017-12-03 22:22:53', 'notificationCountStarRating'),
(187, '', 70, 137, 0, '2017-12-04 00:30:52', 'notificationCountPosted'),
(188, 'Dffrty', 199, 133, 0, '2017-12-04 06:55:19', 'notificationCountMessage'),
(189, 'Dffrty', 199, 133, 0, '2017-12-04 06:55:19', 'notificationCountMsgActive'),
(190, 'Dffrty', 199, 133, 0, '2017-12-04 06:55:19', 'notificaitonCountMsgJobHistory'),
(191, 'You are hired for DFFH GHGHGH', 199, 95, 0, '2017-12-05 01:01:56', 'hirejob'),
(192, 'You are hired for JACK 123', 133, 81, 0, '2017-12-05 01:42:42', 'hirejob'),
(193, 'You are hired for DFFH GHGHGH', 199, 95, 0, '2017-12-05 01:53:42', 'hirejob'),
(194, 'You are hired for NEW JOB NOV 14', 133, 83, 0, '2017-12-05 02:07:25', 'hirejob'),
(195, 'You are hired for NEW JOB NOV 14', 133, 83, 0, '2017-12-05 03:16:34', 'hirejob'),
(196, 'Fff', 199, 94, 0, '2017-12-05 08:20:02', 'notificationCountMessage'),
(197, 'Fff', 199, 94, 0, '2017-12-05 08:20:02', 'notificationCountMsgActive'),
(198, 'Fff', 199, 94, 0, '2017-12-05 08:20:02', 'notificaitonCountMsgJobHistory'),
(199, 'Fff', 199, 94, 0, '2017-12-05 08:38:59', 'notificationCountMessage'),
(200, 'Fff', 199, 94, 0, '2017-12-05 08:38:59', 'notificationCountMsgActive'),
(201, 'Fff', 199, 94, 0, '2017-12-05 08:38:59', 'notificaitonCountMsgJobHistory'),
(202, 'Guy', 199, 94, 0, '2017-12-05 08:39:11', 'notificationCountMessage'),
(203, 'Guy', 199, 94, 0, '2017-12-05 08:39:11', 'notificationCountMsgActive'),
(204, 'Guy', 199, 94, 0, '2017-12-05 08:39:11', 'notificaitonCountMsgJobHistory'),
(205, '', 198, 138, 0, '2017-12-11 08:38:26', 'notificationCountPosted'),
(206, 'Congratulations! You?ve been hired for thePULLING WEEDS job', 133, 61, 0, '2017-12-11 11:46:58', 'hirejob'),
(207, 'Congratulations! You?ve been hired for theNEW JOB NOV 14job', 133, 83, 0, '2017-12-11 11:57:07', 'hirejob'),
(209, '', 57, 95, 0, '2017-12-11 19:24:29', 'notificationCountActive'),
(290, 'You have received a message from Er', 199, 95, 0, '2017-12-15 07:32:33', 'notificationCountMessage'),
(211, '', 57, 95, 0, '2017-12-11 19:24:31', 'notificationCountActive'),
(213, '', 57, 83, 0, '2017-12-11 19:24:33', 'notificationCountActive'),
(240, 'Congratulations! You?ve been hired for theDEC13job', 199, 142, 0, '2017-12-13 00:13:44', 'hirejob'),
(215, '', 57, 83, 0, '2017-12-11 19:24:34', 'notificationCountActive'),
(216, '', 189, 66, 0, '2017-12-11 19:24:44', 'notificationCountActive'),
(217, '', 57, 66, 0, '2017-12-11 19:24:44', 'notificationCountActive'),
(218, '', 189, 66, 0, '2017-12-11 19:24:45', 'notificationCountActive'),
(219, '', 57, 66, 0, '2017-12-11 19:24:45', 'notificationCountActive'),
(220, '', 189, 66, 0, '2017-12-11 19:24:45', 'notificationCountActive'),
(221, '', 57, 66, 0, '2017-12-11 19:24:45', 'notificationCountActive'),
(222, '', 57, 61, 0, '2017-12-11 19:26:14', 'notificationCountActive'),
(223, '', 57, 61, 0, '2017-12-11 19:26:14', 'notificationCountActive'),
(224, '', 57, 61, 0, '2017-12-11 19:26:16', 'notificationCountActive'),
(225, '', 57, 61, 0, '2017-12-11 19:26:16', 'notificationCountActive'),
(226, '', 57, 61, 0, '2017-12-11 19:26:17', 'notificationCountActive'),
(227, '', 57, 61, 0, '2017-12-11 19:26:17', 'notificationCountActive'),
(228, '', 57, 61, 0, '2017-12-11 19:26:18', 'notificationCountActive'),
(229, '', 57, 61, 0, '2017-12-11 19:26:18', 'notificationCountActive'),
(230, '', 57, 61, 0, '2017-12-11 19:26:18', 'notificationCountActive'),
(231, '', 57, 61, 0, '2017-12-11 19:26:18', 'notificationCountActive'),
(232, '', 57, 61, 0, '2017-12-11 19:26:19', 'notificationCountActive'),
(233, '', 57, 61, 0, '2017-12-11 19:26:19', 'notificationCountActive'),
(234, '', 70, 139, 0, '2017-12-12 03:52:42', 'notificationCountPosted'),
(235, '', 70, 140, 0, '2017-12-12 04:05:56', 'notificationCountPosted'),
(236, 'Congratulations! You?ve been hired for theJACK 123job', 133, 81, 0, '2017-12-12 06:47:55', 'hirejob'),
(237, '', 70, 141, 0, '2017-12-12 07:44:41', 'notificationCountPosted'),
(241, '', 198, 142, 0, '2017-12-13 00:13:44', 'notificationCountActive'),
(242, '', 199, 142, 0, '2017-12-13 00:13:44', 'notificationCountActive'),
(243, '', 70, 143, 0, '2017-12-13 03:36:26', 'notificationCountPosted'),
(244, '', 198, 144, 0, '2017-12-13 05:01:47', 'notificationCountPosted'),
(247, 'Congratulations! You?ve been hired for theYjob', 199, 145, 0, '2017-12-13 05:39:33', 'hirejob'),
(293, 'DFFH GHGHGH job has been completed. Fill out a star rating of your employee under job history.', 199, 95, 0, '2017-12-15 08:28:09', 'paymentcompleted'),
(250, 'Y job has been completed. Fill out a star rating of your employee under job history.', 199, 145, 0, '2017-12-13 05:46:00', 'paymentcompleted'),
(251, 'Y job has been completed. Fill out a star rating of your employer under job history.', 198, 145, 0, '2017-12-13 05:46:00', 'paymentcompleted'),
(252, 'Y job has been completed. Fill out a star rating of your employer under job history.', 198, 145, 0, '2017-12-13 05:46:00', 'notificationCountStarRating'),
(253, 'Y job has been completed. Fill out a star rating of your employee under job history.', 199, 145, 0, '2017-12-13 05:46:00', 'notificationCountStarRating'),
(254, 'DEC13 job has been completed. Fill out a star rating of your employee under job history.', 199, 142, 0, '2017-12-13 06:11:15', 'paymentcompleted'),
(255, 'DEC13 job has been completed. Fill out a star rating of your employer under job history.', 198, 142, 0, '2017-12-13 06:11:15', 'paymentcompleted'),
(256, 'DEC13 job has been completed. Fill out a star rating of your employer under job history.', 198, 142, 0, '2017-12-13 06:11:15', 'notificationCountStarRating'),
(257, 'DEC13 job has been completed. Fill out a star rating of your employee under job history.', 199, 142, 0, '2017-12-13 06:11:15', 'notificationCountStarRating'),
(258, 'You have received a message from Er', 200, 133, 0, '2017-12-14 02:13:04', 'notificationCountMessage'),
(259, 'You have received a message from Er', 200, 133, 0, '2017-12-14 02:13:04', 'notificationCountMsgActive'),
(260, 'You have received a message from Er', 200, 133, 0, '2017-12-14 02:13:04', 'notificaitonCountMsgJobHistory'),
(261, 'You have received a message from Er', 200, 133, 0, '2017-12-14 02:13:08', 'notificationCountMessage'),
(262, 'You have received a message from Er', 200, 133, 0, '2017-12-14 02:13:08', 'notificationCountMsgActive'),
(263, 'You have received a message from Er', 200, 133, 0, '2017-12-14 02:13:08', 'notificaitonCountMsgJobHistory'),
(264, 'You have received a message from Er', 200, 133, 0, '2017-12-14 02:13:12', 'notificationCountMessage'),
(265, 'You have received a message from Er', 200, 133, 0, '2017-12-14 02:13:12', 'notificationCountMsgActive'),
(266, 'You have received a message from Er', 200, 133, 0, '2017-12-14 02:13:12', 'notificaitonCountMsgJobHistory'),
(267, 'You have received a message from Er', 200, 133, 0, '2017-12-14 02:13:13', 'notificationCountMessage'),
(268, 'You have received a message from Er', 200, 133, 0, '2017-12-14 02:13:13', 'notificationCountMsgActive'),
(269, 'You have received a message from Er', 200, 133, 0, '2017-12-14 02:13:13', 'notificaitonCountMsgJobHistory'),
(270, '', 200, 133, 0, '2017-12-14 02:13:26', 'notificationCountMakePayment'),
(271, '', 200, 133, 0, '2017-12-14 02:13:27', 'notificationCountMakePayment'),
(272, 'TEST NOV job has been completed. Fill out a star rating of your employee under job history.', 133, 79, 0, '2017-12-15 02:59:34', 'paymentcompleted'),
(273, 'TEST NOV job has been completed. Fill out a star rating of your employer under job history.', 198, 79, 0, '2017-12-15 02:59:34', 'paymentcompleted'),
(274, 'TEST NOV job has been completed. Fill out a star rating of your employer under job history.', 198, 79, 0, '2017-12-15 02:59:34', 'notificationCountStarRating'),
(275, 'TEST NOV job has been completed. Fill out a star rating of your employee under job history.', 133, 79, 0, '2017-12-15 02:59:34', 'notificationCountStarRating'),
(276, 'TEST NOV job has been completed. Fill out a star rating of your employee under job history.', 133, 79, 0, '2017-12-15 02:59:34', 'notificationCountJobHistory'),
(277, 'TEST NOV job has been completed. Fill out a star rating of your employer under job history.', 198, 79, 0, '2017-12-15 02:59:34', 'notificationCountJobHistory'),
(278, 'BBB job has been completed. Fill out a star rating of your employee under job history.', 199, 94, 0, '2017-12-15 04:36:06', 'paymentcompleted'),
(279, 'BBB job has been completed. Fill out a star rating of your employer under job history.', 198, 94, 0, '2017-12-15 04:36:06', 'paymentcompleted'),
(280, 'BBB job has been completed. Fill out a star rating of your employer under job history.', 198, 94, 0, '2017-12-15 04:36:06', 'notificationCountStarRating'),
(281, 'BBB job has been completed. Fill out a star rating of your employee under job history.', 199, 94, 0, '2017-12-15 04:36:06', 'notificationCountStarRating'),
(282, 'BBB job has been completed. Fill out a star rating of your employee under job history.', 199, 94, 0, '2017-12-15 04:36:06', 'notificationCountJobHistory'),
(283, 'BBB job has been completed. Fill out a star rating of your employer under job history.', 198, 94, 0, '2017-12-15 04:36:06', 'notificationCountJobHistory'),
(284, 'NEW JOB NOV 14 job has been completed. Fill out a star rating of your employee under job history.', 133, 83, 0, '2017-12-15 04:56:51', 'paymentcompleted'),
(285, 'NEW JOB NOV 14 job has been completed. Fill out a star rating of your employer under job history.', 198, 83, 0, '2017-12-15 04:56:51', 'paymentcompleted'),
(286, 'NEW JOB NOV 14 job has been completed. Fill out a star rating of your employer under job history.', 198, 83, 0, '2017-12-15 04:56:51', 'notificationCountStarRating'),
(287, 'NEW JOB NOV 14 job has been completed. Fill out a star rating of your employee under job history.', 133, 83, 0, '2017-12-15 04:56:51', 'notificationCountStarRating'),
(288, 'NEW JOB NOV 14 job has been completed. Fill out a star rating of your employee under job history.', 133, 83, 0, '2017-12-15 04:56:51', 'notificationCountJobHistory'),
(289, 'NEW JOB NOV 14 job has been completed. Fill out a star rating of your employer under job history.', 198, 83, 0, '2017-12-15 04:56:51', 'notificationCountJobHistory'),
(291, 'You have received a message from Er', 199, 95, 0, '2017-12-15 07:32:33', 'notificationCountMsgActive'),
(292, 'You have received a message from Er', 199, 95, 0, '2017-12-15 07:32:33', 'notificaitonCountMsgJobHistory'),
(297, 'DFFH GHGHGH job has been completed. Fill out a star rating of your employee under job history.', 199, 95, 0, '2017-12-15 08:28:09', 'notificationCountJobHistory'),
(298, 'DFFH GHGHGH job has been completed. Fill out a star rating of your employer under job history.', 198, 95, 0, '2017-12-15 08:28:09', 'notificationCountJobHistory'),
(299, 'You are refused', 199, 96, 0, '2017-12-15 08:32:36', 'refusejob'),
(304, '', 198, 146, 0, '2017-12-15 08:36:24', 'notificationCountActive'),
(303, 'Congratulations! You?ve been hired for theDHHDjob', 199, 146, 0, '2017-12-15 08:36:24', 'hirejob'),
(305, '', 199, 146, 0, '2017-12-15 08:36:24', 'notificationCountActive'),
(306, 'DHHD job has been completed. Fill out a star rating of your employee under job history.', 199, 146, 0, '2017-12-15 08:38:33', 'paymentcompleted'),
(307, 'DHHD job has been completed. Fill out a star rating of your employer under job history.', 198, 146, 0, '2017-12-15 08:38:33', 'paymentcompleted'),
(308, 'DHHD job has been completed. Fill out a star rating of your employer under job history.', 198, 146, 0, '2017-12-15 08:38:33', 'notificationCountStarRating'),
(309, 'DHHD job has been completed. Fill out a star rating of your employee under job history.', 199, 146, 0, '2017-12-15 08:38:33', 'notificationCountStarRating'),
(310, 'DHHD job has been completed. Fill out a star rating of your employee under job history.', 199, 146, 0, '2017-12-15 08:38:33', 'notificationCountJobHistory'),
(315, 'Congratulations! You?ve been hired for thePLUMBINGjob', 204, 147, 0, '2017-12-15 11:24:28', 'hirejob'),
(338, 'You have received a message from Redecorating', 204, 147, 0, '2017-12-15 23:28:20', 'notificationCountMessage'),
(314, 'You have received a new job application', 203, 147, 0, '2017-12-15 11:23:51', 'applyjob'),
(316, '', 203, 147, 0, '2017-12-15 11:24:28', 'notificationCountActive'),
(317, '', 204, 147, 0, '2017-12-15 11:24:28', 'notificationCountActive'),
(318, 'You have received a message from Redecorating', 204, 147, 0, '2017-12-15 11:24:59', 'notificationCountMessage'),
(319, 'You have received a message from Redecorating', 204, 147, 0, '2017-12-15 11:24:59', 'notificationCountMsgActive'),
(320, 'You have received a message from Redecorating', 204, 147, 0, '2017-12-15 11:24:59', 'notificaitonCountMsgJobHistory'),
(321, 'You have received a message from Redecorating', 204, 147, 0, '2017-12-15 11:25:07', 'notificationCountMessage'),
(322, 'You have received a message from Redecorating', 204, 147, 0, '2017-12-15 11:25:07', 'notificationCountMsgActive'),
(323, 'You have received a message from Redecorating', 204, 147, 0, '2017-12-15 11:25:07', 'notificaitonCountMsgJobHistory'),
(324, 'You have received a message from E', 203, 147, 0, '2017-12-15 11:25:27', 'notificationCountMessage'),
(325, 'You have received a message from E', 203, 147, 0, '2017-12-15 11:25:27', 'notificationCountMsgActive'),
(326, 'You have received a message from E', 203, 147, 0, '2017-12-15 11:25:27', 'notificaitonCountMsgJobHistory'),
(327, '', 203, 147, 0, '2017-12-15 11:25:45', 'notificationCountMakePayment'),
(328, '', 203, 147, 0, '2017-12-15 11:25:46', 'notificationCountMakePayment'),
(329, 'PLUMBING job has been completed. Fill out a star rating of your employee under job history.', 204, 147, 0, '2017-12-15 11:26:52', 'paymentcompleted'),
(330, 'PLUMBING job has been completed. Fill out a star rating of your employer under job history.', 203, 147, 0, '2017-12-15 11:26:52', 'paymentcompleted'),
(331, 'PLUMBING job has been completed. Fill out a star rating of your employer under job history.', 203, 147, 0, '2017-12-15 11:26:52', 'notificationCountStarRating'),
(332, 'PLUMBING job has been completed. Fill out a star rating of your employee under job history.', 204, 147, 0, '2017-12-15 11:26:52', 'notificationCountStarRating'),
(333, 'PLUMBING job has been completed. Fill out a star rating of your employee under job history.', 204, 147, 0, '2017-12-15 11:26:52', 'notificationCountJobHistory'),
(335, 'You have received a message from Jay', 133, 61, 0, '2017-12-15 12:54:57', 'notificationCountMessage'),
(336, 'You have received a message from Jay', 133, 61, 0, '2017-12-15 12:54:57', 'notificationCountMsgActive'),
(337, 'You have received a message from Jay', 133, 61, 0, '2017-12-15 12:54:57', 'notificaitonCountMsgJobHistory'),
(339, 'You have received a message from Redecorating', 204, 147, 0, '2017-12-15 23:28:20', 'notificationCountMsgActive'),
(340, 'You have received a message from Redecorating', 204, 147, 0, '2017-12-15 23:28:20', 'notificaitonCountMsgJobHistory'),
(341, 'HIT job has been completed. Fill out a star rating of your employee under job history.', 133, 90, 0, '2017-12-16 00:03:29', 'paymentcompleted'),
(342, 'HIT job has been completed. Fill out a star rating of your employer under job history.', 198, 90, 0, '2017-12-16 00:03:29', 'paymentcompleted'),
(343, 'HIT job has been completed. Fill out a star rating of your employer under job history.', 198, 90, 0, '2017-12-16 00:03:29', 'notificationCountStarRating'),
(344, 'HIT job has been completed. Fill out a star rating of your employee under job history.', 133, 90, 0, '2017-12-16 00:03:29', 'notificationCountStarRating'),
(345, 'HIT job has been completed. Fill out a star rating of your employee under job history.', 133, 90, 0, '2017-12-16 00:03:29', 'notificationCountJobHistory'),
(346, 'HIT job has been completed. Fill out a star rating of your employer under job history.', 198, 90, 0, '2017-12-16 00:03:29', 'notificationCountJobHistory');

-- --------------------------------------------------------

--
-- Table structure for table `payment_history`
--

CREATE TABLE `payment_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `tnx_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paypal`
--

CREATE TABLE `paypal` (
  `id` int(11) NOT NULL,
  `employer_id` int(11) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `api_key` varchar(255) NOT NULL,
  `api_signature` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `password` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paypal`
--

INSERT INTO `paypal` (`id`, `employer_id`, `email_id`, `api_key`, `api_signature`, `created_date`, `updated_date`, `password`, `user_id`) VALUES
(1, 1, 'ramkumar.izaap@gmail.com', '1234', '12311', '2017-05-23 07:35:54', '2017-05-23 04:08:02', '', 0),
(2, 2, 'test@gmail.com', 'sdfsf', 'sfsd', '2017-06-06 14:03:39', '2017-06-06 08:28:18', '', 0),
(3, 57, 'computerab73@gmail.com', '', '', '2017-07-19 02:56:55', '0000-00-00 00:00:00', 'izaap123', 0);

-- --------------------------------------------------------

--
-- Table structure for table `paypal_user_info`
--

CREATE TABLE `paypal_user_info` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `address` text NOT NULL,
  `usertype` varchar(50) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phonenumber` varchar(100) NOT NULL DEFAULT '',
  `email_verified` varchar(20) NOT NULL DEFAULT '',
  `user_verified` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paypal_user_info`
--

INSERT INTO `paypal_user_info` (`id`, `user_id`, `address`, `usertype`, `email`, `phonenumber`, `email_verified`, `user_verified`) VALUES
(1, 133, 'San Jose US 95131 CA 1 Main St', 'employer', 'computerab73@gmail.com', '1 4083052409', 'true', 'true'),
(2, 133, 'San Jose US 95131 CA 1 Main St', 'employer', 'computerab73@gmail.com', '1 4083052409', 'true', 'true'),
(3, 133, 'San Jose US 95131 CA 1 Main St', 'employer', 'computerab73@gmail.com', '1 4083052409', 'true', 'true'),
(4, 133, 'San Jose US 95131 CA 1 Main St', 'employer', 'computerab73@gmail.com', '1 4083052409', 'true', 'true'),
(5, 133, 'San Jose US 95131 CA 1 Main St', 'employer', 'computerab73@gmail.com', '1 4083052409', 'true', 'true'),
(6, 133, 'San Jose US 95131 CA 1 Main St', 'employer', 'computerab73@gmail.com', '1 4083052409', 'true', 'true'),
(7, 133, 'San Jose US 95131 CA 1 Main St', 'employer', 'computerab73@gmail.com', '1 4083052409', 'true', 'true'),
(8, 133, 'San Jose US 95131 CA 1 Main St', 'employer', 'computerab73@gmail.com', '1 4083052409', 'true', 'true'),
(9, 133, 'San Jose US 95131 CA 1 Main St', 'employer', 'computerab73@gmail.com', '1 4083052409', 'true', 'true'),
(10, 133, 'San Jose US 95131 CA 1 Main St', 'employer', 'computerab73@gmail.com', '1 4083052409', 'true', 'true'),
(11, 183, 'San Jose US 95131 CA 1 Main St', 'employer', 'computerab73@gmail.com', '1 4083052409', 'true', 'true'),
(12, 189, 'San Jose US 95131 CA 1 Main St', 'employer', 'talentindustry03@gmail.com', '1 4088073625', 'true', 'true'),
(13, 189, 'San Jose US 95131 CA 1 Main St', 'employer', 'talentindustry03@gmail.com', '1 4088073625', 'true', 'true'),
(14, 190, 'San Jose US 95131 CA 1 Main St', 'employer', 'talentindustry03@gmail.com', '1 4088073625', 'true', 'true'),
(15, 133, 'San Jose US 95131 CA 1 Main St', 'employer', 'talentindustry03@gmail.com', '1 4088073625', 'true', 'true'),
(16, 197, 'San Jose US 95131 CA 1 Main St', 'employer', 'talentindustry03@gmail.com', '1 4088073625', 'true', 'true'),
(17, 133, 'San Jose US 95131 CA 1 Main St', 'employee', 'talentindustry03@gmail.com', '1 4088073625', 'true', 'true'),
(22, 200, 'San Jose US 95131 CA 1 Main St', 'employer', 'talentindustry03@gmail.com', '1 4088073625', 'true', 'true'),
(21, 199, 'San Jose US 95131 CA 1 Main St', 'employer', 'talentindustry03@gmail.com', '1 4088073625', 'true', 'true'),
(23, 57, 'San Jose US 95131 CA 1 Main St', 'employer', 'computerab73@gmail.com', '1 4087137215', 'true', 'true'),
(24, 201, 'San Jose US 95131 CA 1 Main St', 'employer', 'talentindustry03@gmail.com', '1 4088073625', 'true', 'true'),
(25, 198, 'San Jose US 95131 CA 1 Main St', 'employer', 'talentindustry03@gmail.com', '1 4088073625', 'true', 'true'),
(26, 199, 'San Jose US 95131 CA 1 Main St', 'employer', 'talentindustry03@gmail.com', '1 4088073625', 'true', 'true'),
(27, 199, 'San Jose US 95131 CA 1 Main St', 'employer', 'talentindustry03@gmail.com', '1 4088073625', 'true', 'true'),
(28, 203, 'San Jose US 95131 CA 1 Main St', 'employer', 'talentindustry03@gmail.com', '1 4088073625', 'true', 'true'),
(29, 204, 'San Jose US 95131 CA 1 Main St', 'employee', 'talentindustry03@gmail.com', '1 4088073625', 'true', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `posted_jobs`
--

CREATE TABLE `posted_jobs` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `job_creator_id` int(11) NOT NULL,
  `comments` text NOT NULL,
  `job_posted_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posted_jobs`
--

INSERT INTO `posted_jobs` (`id`, `employee_id`, `job_id`, `job_creator_id`, `comments`, `job_posted_on`, `created_date`, `updated_date`) VALUES
(1, 3, 2, 4, 'I m interested', '2017-05-20 06:49:04', '2017-05-20 06:26:59', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `job_id` int(11) DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `rating` varchar(150) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `employer_id` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `job_id`, `comments`, `rating`, `employee_id`, `employer_id`, `created_date`) VALUES
(1, 112, 'Hddhhd', '3.6', 200, 198, '2017-12-16 07:35:50'),
(2, 72, '', '3.6', 199, 198, '2017-12-16 07:54:28'),
(3, 132, '', '2.8', 198, 200, '2017-12-16 07:56:09'),
(4, 72, '', '3.0', 199, 198, '2017-12-16 08:20:29');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  `menu_id` varchar(255) NOT NULL,
  `action_id` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`, `menu_id`, `action_id`, `status`, `created_date`, `updated_date`) VALUES
(1, 'admin', '{\"employers\":\"1\",\"employees\":\"1\",\"roles\":\"1\",\"payment_history\":\"1\",\"reports\":\"1\",\"email\":\"1\",\"jobs\":\"1\",\"list\":\"1\",\"posted\":\"1\",\"category\":\"1\",\"payment_methods\":\"1\",\"card\":\"1\",\"account\":\"1\",\"paypal\":\"1\"}', '{\"create\":\"1\",\"edit\":\"1\",\"view\":\"1\",\"delete\":\"1\"}', 'Active', '2017-05-22 06:45:07', '2017-06-03 02:46:46'),
(5, 'Sub Admin', '{\"employers\":\"1\",\"employees\":\"1\",\"jobs\":\"1\",\"roles\":\"1\"}', '{\"create\":\"1\",\"edit\":\"1\",\"view\":\"1\",\"delete\":\"1\"}', 'Active', '2017-05-22 07:10:05', '2017-06-03 01:38:17'),
(6, 'employer', '{\"reports\":\"1\",\"email\":\"1\",\"jobs\":\"1\",\"list\":\"1\",\"posted\":\"1\",\"payment_methods\":\"1\",\"card\":\"1\",\"account\":\"1\",\"paypal\":\"1\"}', '{\"create\":\"1\",\"edit\":\"1\",\"view\":\"1\",\"delete\":\"1\"}', 'Active', '2017-05-22 07:10:25', '2017-06-03 07:41:20'),
(7, 'employee', '{\"reports\":\"1\",\"email\":\"1\",\"jobs\":\"1\",\"list\":\"1\",\"posted\":\"1\",\"payment_methods\":\"1\",\"card\":\"1\",\"account\":\"1\",\"paypal\":\"1\"}', '{\"create\":\"1\",\"edit\":\"1\",\"view\":\"1\"}', 'Active', '2017-07-17 13:31:28', '2017-07-17 07:47:04'),
(8, 'both', '{\"employers\":\"1\",\"employees\":\"1\",\"payment_history\":\"1\",\"reports\":\"1\",\"email\":\"1\",\"jobs\":\"1\",\"list\":\"1\",\"posted\":\"1\",\"category\":\"1\",\"payment_methods\":\"1\",\"card\":\"1\",\"account\":\"1\",\"paypal\":\"1\"}', '{\"create\":\"1\",\"edit\":\"1\",\"view\":\"1\",\"delete\":\"1\"}', 'Active', '2017-07-18 07:55:22', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(250) NOT NULL,
  `state` varchar(150) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `usertype` varchar(100) NOT NULL,
  `devicetoken` text NOT NULL,
  `profile_name` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `firstname`, `lastname`, `address`, `city`, `state`, `zipcode`, `usertype`, `devicetoken`, `profile_name`, `profile_image`) VALUES
(10, 'vidhya1', 'f41b67257ad6ac78a0eb81b7330aba52', 'izaaptech123@gmail.com', 'izaap', 'tech', 'test', 'chennai', 'tamilnadu', 600004, 'employer', 'sasfafwrwrsasfafwrwrsasfafwrwrsasfafwrwr', NULL, NULL),
(12, 'ge1', 'c8710011868bf44b12a59eabc043cbc8', 'izaapt123@gmail.com', 'izaap', 'tech', 'address', 'chennai', 'tamilnadu', 600004, 'employer', '548A1F92148D57A9C2D8831BC805F0A58589FD7D34795ECD7F3BF7EE7C8699F8', NULL, NULL),
(13, 'geee', 'c8710011868bf44b12a59eabc043cbc8', 'izaapte123@gmail.com', 'izaap', 'tech', 'address', 'chennai', 'tamilnadu', 600004, 'employer', '548A1F92148D57A9C2D8831BC805F0A58589FD7D34795ECD7F3BF7EE7C8699F8', NULL, NULL),
(14, 'xxx', '578044f1afe92bf3153b475b1516e084', 'h@gmail.com', 'izaapp', 'techh', 'addresss', 'chennaii', 'tamilnaduu', 6000044, 'employer', '548A1F92148D57A9C2D8831BC805F0A58589FD7D34795ECD7F3BF7EE7C8699F8', NULL, NULL),
(15, 'ddfdfdf', '8aca73488dbc1701cbd95ea922f1edb5', 'email@gmail.com', 'sdds', 'dssd', 'sdsd', 'dd', 'sdds', 0, 'employer', 'sasfafwrwrsasfafwrwrsasfafwrwrsasfafwrwr', NULL, NULL),
(16, 'ada', '8c8d357b5e872bbacd45197626bd5759', 'adad@gmail.com', 'adad', 'adfad', 'adad', 'adad', 'adad', 0, 'employer', 'kjadkjassfsfsfsfsfsfsfs', NULL, NULL),
(17, 'knkni9', '7b59442734a0c1f4242ee1785627ea58', 'kbkbib in', 'ubub6v', 'inn7n8', 'ininu', 'uvuv ', 'kin7', 0, 'employer', '', NULL, NULL),
(18, '8th j', '9f83bfcd856b205039be5805a6d49192', 'ibh', 'I ini', 'knib', 'gh u', '6g7h', '8h8j', 0, 'employer', '', NULL, NULL),
(19, 'in8n', '479c92f80a9bee6e03d14eb0f7576ece', '7h7h', 'uvv5', 'kninv', 'oh', '6g6b', 'ib7b7b', 0, 'employer', '', NULL, NULL),
(20, 'ghyy', 'c51d2b8b90dc1eb9fff456d6a28655ca', 'izaapizaap@gmail.com', 'tgh', 'fgg', 'rghtg', 'fg', 'tg', 66, 'employer', '', NULL, NULL),
(21, 'bas', '62ee749a177f5f5be20061a3a6f9b1c4', 'bask@gmail.com', 'fhh', 'dgg', 'eggrgg', 'rfg', 'fhh', 586, 'employer', 'Handz', NULL, NULL),
(22, 'thy', 'c51d2b8b90dc1eb9fff456d6a28655ca', 'baskaranko@gmail.com', 'fh', 'fhh', 'fhythh', 'thh', 'ghh', 66, 'employer', '', NULL, NULL),
(23, 'ttyy', 'c51d2b8b90dc1eb9fff456d6a28655ca', 'anu@gmail.com', 'ghh', 'rgy', 'ryyrgg', 'dgg', 'fgh', 556, 'employer', '', NULL, NULL),
(24, 'fhhg', 'c51d2b8b90dc1eb9fff456d6a28655ca', 'sekar@gmail.com', 'xvg', 'fg', 'rgfg', 'fg', 'fg', 56, 'employer', '', NULL, NULL),
(25, 'fhf', '7f58341b9dceb1f1edca80dae10b92bc', 'kamal@gmail.com', 'dfg', 'fg', 'fgfv', 'dv', 'fg', 56, 'employer', '', NULL, NULL),
(26, 'fggr', '72f0795636327a3da4e871ff9db95f4f', 'babu@gmail.com', 'ggf', 'fvg', 'dvvdgg', 'fvh', 'cb', 566, 'employer', '', NULL, NULL),
(27, 'hshz', '78486fcfc9d3a8ee177a21468591aca3', 'begam@gmail.com', 'ghs', 'ghz', 'ghhsghhs', 'fghs', 'ghhs', 646, 'employer', '', NULL, NULL),
(28, 'ghg', '16d7a4fca7442dda3ad93c9a726597e4', 'test@gmail.com', 'chg', 'fg', 'fgfg', 'fg', 'gg', 55, 'employer', '', NULL, NULL),
(29, 'fggf', 'daedf1c5ab09fbad097591bdbdcf8cce', 'ccc@gmail.com', 'cg', 'fv', 'fhhfg', 'fg', 'cg', 56, 'employer', '', NULL, NULL),
(30, 'rgg', '35a196b0238016a73c2ae86e7ea4b6c8', 'tester@gmail.com', 'cb', 'fg', 'dfdf', 'fg', 'fg', 56, 'employer', '', NULL, NULL),
(31, 'fhh', '6bce0fd553bb13e83ce3b3bc221a8abd', 'city@gmail.com', 'fg', 'vh', 'vhhfvh', 'fg', 'gv', 56, 'employer', '', NULL, NULL),
(32, 'igih', '19b19ffc30caef1c9376cd2982992a59', 'kgig', 'kib', '8h7hbub', 'ig6g', 'ugy', 'ihi', 0, 'employer', '', NULL, NULL),
(33, 'hhc', 'd467ef9e16a751f376bbf1b476380b91', 'n h', 'just joined ', 'hcyv', 'bxgx', 'yc ', 'h', 0, 'employer', '', NULL, NULL),
(34, 'giy', 'c91bf36985f473722698df0b8aef2c45', '66g', 'bkb', 'gi', 'f5f', 'yryr', 'kg', 0, 'employer', '', NULL, NULL),
(35, 'adas', '8c8d357b5e872bbacd45197626bd5759', 'adadd@gmail.com', 'adad', 'adfad', 'adad', 'adad', 'adad', 0, 'employer', 'kjadkjassfsfsfsfsfsfsfs', NULL, NULL),
(36, 'anitha', '7b05bcf2b85df8a46d3e36a04f42e4d9', 'anitha@gmail.com', 'fg', 'fg', 'cggfg', 'fg', 'fh', 586, 'employer', '', NULL, NULL),
(37, 'zzz', '925544d7f90cd3663531546f080bbed8', 'gh@gmail.com', 'a', 'b', 'st1st2', 'CHjj', 'ten', 344, 'employer', '548A1F92148D57A9C2D8831BC805F0A58589FD7D34795ECD7F3BF7EE7C8699F8', NULL, NULL),
(38, 'rakesh', 'd5aeaeac3298f65f326e835fa2ed5450', 'rakesh@gmail.com', 'fhh', 'fuu', 'rghtyu', 'fhh', 'fgh', 166, 'employer', 'Handz', NULL, NULL),
(39, 'hh', '6f14261cbf2cb500be8053a66b144e1c', 'hh@gmail.com', 'ugg', 'ff', 'chfyfuf', 'yduf', 'yf', 765, 'employer', '', NULL, NULL),
(40, 'hire', 'cfd13acc2f36e65786769c2f5fe5e598', 'hgc@gmail.com', 'ugg', 'ff', 'chfyfuf', 'yduf', 'yf', 765, 'employer', 'Handz', NULL, NULL),
(41, 'izaap', 'c51d2b8b90dc1eb9fff456d6a28655ca', 'iza@gmail.com', 'gsgs', 'sd', 'ssss', 'sd', 'dd', 5, 'employer', 'Handz', NULL, NULL),
(42, 'bas', '25d55ad283aa400af464c76d713c07ad', 'bas@gmail.com', 'bas', 'k', 'errty', 'yu', 'tu', 23, 'employer', '', NULL, NULL),
(43, 'alli', '75a752aeff947caf08ed7cd2edb0664f', 'oi@gmail.com', 'kkk', 'lll', 'st1st2', 'c', 's', 0, 'employer', '9D397ADAA50A019AE1C3571CE9C89DF4DFED193EA9192C96D938064AD39DFFEF', NULL, NULL),
(44, 'adass', '8c8d357b5e872bbacd45197626bd5759', 'adaddd@gmail.com', 'adad', 'adfad', 'adad', 'adad', 'adad', 0, 'employer', 'dev', NULL, NULL),
(45, 'ani', '7b05bcf2b85df8a46d3e36a04f42e4d9', 'ani@gmail.com', 'anitha', 'stella', 'first main roadNewry street', 'chennai', 'thj', 259865, 'employer', '', NULL, NULL),
(46, 'newtest', 'c51d2b8b90dc1eb9fff456d6a28655ca', 'newtest@gmail.com', 'abhhgh', 'fhg', 'thhhfhh', 'thh', 'tj', 566, 'employer', '', NULL, NULL),
(47, 'dora', 'b3b2169c7ac2b13e59350cfd5b883aca', 'dora@gmail.com', 'fgh', 'rht', '3ttI ty', 'rgy', 'fyy', 556, 'employer', '', NULL, NULL),
(48, 'add', 'c51d2b8b90dc1eb9fff456d6a28655ca', 'add@gmail.com', 'fhy', 'tg', 'fhrg', 'ef', 'ty', 55, 'employer', '', NULL, NULL),
(49, 'saral', 'dbb316c6c77a96f94ac6ac6c3429819b', 'saral@gmail.com', 'fh', 'rhy', 'thufhh', 'rhh', 'thu', 66, 'employer', 'Handz', NULL, NULL),
(50, 'asma', '6f3678ea67af0bde962acb06a1cfc0b4', 'asma@gmail.com', 'fhh', 'fgh', 'fhhghh', 'fh', 'gj', 66, 'employer', '', NULL, NULL),
(51, 'siva', 'e7437361370f7b5d982c04170454c0b0', 'sivaa@gmail.com', 'sgsh', 'ss', 'sdsd', 'dd', 'dd', 58, 'employer', '', NULL, NULL),
(52, 'punitha', 'e89a25b1d89cbe63a0cfbf5523ea489f', 'punitha@gmail.com', 'dg', 'fgh', 'cggfgg', 'fgg', 'fg', 53, 'employer', '', NULL, NULL),
(53, 'jack', '925544d7f90cd3663531546f080bbed8', 'jack@gmail.com', 'jack', 'hd', 'hdjdJFK', 'JFK', 'Dudu', 0, 'employer', 'D13D4BF751B0C7C64D475E88529C1E0267A369F63B4E0DB374FAD80FD209636E', NULL, NULL),
(54, 'yyy', '552e6a97297c53e592208cf97fbb3b60', 'a7@gmail.com', 'yyy', 'djdj', 'kfkfjddj', 'djdj', 'djd', 0, 'employer', '8929215CA3B713E32E9514CDCA92B323EB1007F3A4FE1F0CBC5C9B95D85EDB87', NULL, NULL),
(55, 'handz', 'a1f6e9b06bb51962af89f65c003696d0', 'handz@gmail.com', 'handz', 'h', 'hafgfgh', 'dgg', 'fgh', 556, 'employer', 'Handz', NULL, NULL),
(56, 'gmgm', '208103fbeae9317d70a4fb90d0bdbee7', 'gmgm@gmail.com', 'fzhjx', 'hhhd', 'dhhxghhd', 'ghhd', 'ghd', 568, 'employer', 'Handz', NULL, NULL),
(57, 'herrigel3', 'aa2c136605ccbf686f07630bc830ba2e', 'jay@handzforhire.com', 'Jay', 'Herrigel', '539 Southern', 'Ponte Vedra', 'FL', 32081, 'both', 'C51FD2DB22C5DB0587624E3057C8D041F867D3F9437B8F3E9432DDE0A4FCE521', 'Jay Herrigel', '2017-07-18_23:11:40.png'),
(58, 'bas', '25d55ad283aa400af464c76d713c07ad', 'baskar@gmail.com', 'bas', 'k', 'asfgasfgd', 'jk', 'nj', 12, 'employer', 'Handz', NULL, NULL),
(59, 'adasss', '8c8d357b5e872bbacd45197626bd5759', 'addadd@gmail.com', 'adad', 'adfad', 'adad', 'adad', 'adad', 0, 'employer', 'kjadkjassfsfsfsfsfsfsfs', NULL, NULL),
(60, 'ahamed', '51c105b808b4eac377fb97d7e9845251', 'ahamed@gmail.com', 'fhh', 'rhy', '3yy', 'rhh', 'rhh', 456, 'employer', '', NULL, NULL),
(61, 'bask', '25d55ad283aa400af464c76d713c07ad', 'bas1234@gmail.com', 'vjj', 'ub7', 'guugib7', 'uf', 'jb', 23, 'employer', 'Handz', NULL, NULL),
(62, 'gum', 'c51d2b8b90dc1eb9fff456d6a28655ca', 'gum@gmail.com', 'fhh', 'fhh', 'thh', 'rhh', 'fhh', 1566, 'employer', '', NULL, NULL),
(63, 'sivan', '962f0a9e48452adb78e670bf7eabebf9', 'sivaan@gmail.com', 'fgy', 'ry5', 'rgh', 'rhy', 'rgg', 66, 'employer', '', NULL, NULL),
(64, 'rosy', '5c967b958b1993032a02c006919fd1ab', 'rosy@gmail.com', 'tgh', 'fgh', 'fgg', 'fhh', 'rhh', 55, 'employer', '', NULL, NULL),
(65, 'rose', '5c967b958b1993032a02c006919fd1ab', 'rosee@gmail.com', 'tgh', 'fgh', 'fgg', 'fhh', 'rhh', 55, 'employer', 'Handz', NULL, NULL),
(66, 'aaa', '552e6a97297c53e592208cf97fbb3b60', 'fff@gmail.com', 'iii', 'iii', 'DuduDudu', 'Dudu', 'iffy', 5885, 'employer', 'AD497497BB63EADF619B746B2ACF1EDA5C52B39308055588458CE16A9AAC6F7D', NULL, NULL),
(67, 'yyy', '552e6a97297c53e592208cf97fbb3b60', 'rrr@gmail.com', 'kkk', 'kkk', 'dgdyet', 'every', 'her', 0, 'employer', 'AD6F5D69A8059E638F5933D9B8E108E3CE5D3BBF50023E9682F8AB8EA3A519E1', NULL, NULL),
(68, 'adas', '8c8d357b5e872bbacd45197626bd5759', 'adadddd@gmail.com', 'adad', 'adfad', 'adad', 'adad', 'adad', 0, 'employer', 'kjadkjassfsfsfsfsfsfsfs', NULL, NULL),
(69, 'baskii', '25d55ad283aa400af464c76d713c07ad', 'basuu@gmail.com', 'ty', 'yt', 'ty', 'u', 'i', 12, 'employer', 'Handz', NULL, NULL),
(70, 'abisha', '6274be8b952f917f7d0db77318de8a41', 'abisha@gmail.com', 'thh', 'thu', 'rghfgh', 'rgg', 'tgy', 666, 'employer', '352423060938733', 'Abinaya.G', '2017_08_29_1503988551936.jpg'),
(71, 'fhh', 'a724fe728a2b49d3f41a0c2120eb7780', 'haris@gmail.com', 'hft', 'ght', 'tg', 'tg', 'gh', 85, 'employer', '', NULL, NULL),
(72, 'vijay', '25d55ad283aa400af464c76d713c07ad', 'based@gmail.com', 'bas', 'k', 'Big streetBig street 2', 'Give', 'gh', 23, 'employer', 'Handz', NULL, NULL),
(73, 'tt', '4da6edb16dad7148938ac3463edacd62', 'tt@gmail.com', 'tt', 'tt', 'diI\'d', 'kfkf', 'kfkf', 0, 'employer', '66947D4B2506D40AA7646FF3469BACD9A562E4E523981C2CA56DF033271BB696', NULL, NULL),
(74, 'qqqq', 'beee47d70a7fc4c0c2cd2b517cc4b134', 'qqqq@gmail.com', 'qqqq', 'qqqq', 'hddhdjdj', 'djdj', 'his', 0, 'employer', '66947D4B2506D40AA7646FF3469BACD9A562E4E523981C2CA56DF033271BB696', NULL, NULL),
(75, 'www', 'beee47d70a7fc4c0c2cd2b517cc4b134\n', 'mmm@gmail.com', 'www', 'www', 'djdjhdjd', 'kfkf', 'jddj', 0, 'employer', 'C7D546283CFB36E4D43450E9E47F94D203777F678443A1F8A3EF36B3EF6CE7E3', NULL, NULL),
(76, 'bas123', '25d55ad283aa400af464c76d713c07ad', 'basking@gmail.com', 'bas', 'ki', 'welcome', 'ft', 'ty', 23, 'employer', '', NULL, NULL),
(77, 'bask', '25d55ad283aa400af464c76d713c07ad', 'badboy2@gmail.com', 'bas', 'karan', 'abcefg', 'ct', 'st', 123, 'employer', '', NULL, NULL),
(78, 'baski', '25d55ad283aa400af464c76d713c07ad', 'baskarank.mca@gmail.com', 'bas', 'k', 'wewelcome', 'fg', 'st', 12, 'employer', '', NULL, NULL),
(79, 'bask', '25d55ad283aa400af464c76d713c07ad', 'badboy@gmail.com', 'bas', 'kar', 'wewelcome', 'ab', 'cd', 12, 'employer', '', NULL, NULL),
(80, 'baskk', '25d55ad283aa400af464c76d713c07ad', 'badboy23@gmail.com', 'bas', 'k', 'abcd', 'ef', 'gh', 12, 'employer', '', NULL, NULL),
(81, 'abcd', '25d55ad283aa400af464c76d713c07ad', 'abcd@gmail.com', 'ab', 'ty', 'rttyu', 'yu', 'yun', 23, 'employer', '', NULL, NULL),
(82, 'ghi', '5d98c80d61a1b4020a4c62bf5732d396', 'ghi@gmail.com', 'ty', 'fg', 'fh', 'fh', 'fh', 66, 'employer', '', NULL, NULL),
(83, 'yet', '25d55ad283aa400af464c76d713c07ad', 'yett@gmail.com', 'fhj', 'fg', 'fgh', 'gu', 'ry', 563, 'employer', '', NULL, NULL),
(84, 'baski', '25d55ad283aa400af464c76d713c07ad', 'basically2@gmail.com', 'bas', 'k', 'asdf', 'ct', 'st', 23, 'employer', '353627072677241', 'bas', '2017_07_07_1499438879229.jpg'),
(85, 'tttt', '4da6edb16dad7148938ac3463edacd62', 'tttt@gmail.com', 'tttt', 'ft', 'do fgg', 'gg', 'gh', 53, 'employer', '', NULL, NULL),
(86, 'tttt', '4da6edb16dad7148938ac3463edacd62', 'tttt@gmail.com', 'tttt', 'ft', 'do fgg', 'gg', 'gh', 53, 'employer', '', NULL, NULL),
(87, 'tttt', '4da6edb16dad7148938ac3463edacd62', 'tttt@gmail.com', 'tttt', 'ft', 'do fgg', 'gg', 'gh', 53, 'employer', '', NULL, NULL),
(88, 'ghgfgg', '25d55ad283aa400af464c76d713c07ad', 'izaapiza@gmail.com', 'fv', 'gh', 'gt', 'fg', 'tg', 56, 'employer', '', NULL, NULL),
(89, 'abi', '3a5461b198c19355522afe56f96267f1', 'abibu@gmail.com', 'dg', 'dg', 'fg', 'fg', 'gh', 556, 'employer', '', NULL, NULL),
(90, 'ajith', '5bb50d4b2dec2e55982cafed5241b3ab', 'ajith@gmail.com', 'dgh', 'dh', 'dg', 'b', 'fh', 53, 'employer', '', NULL, NULL),
(91, 'sugu', '01ec7f29d06f3babbc308090d61b5de0', 'sugu@gmail.com', 'dg', 'dg', 'dg', 'cv', 'fg', 85, 'employer', '', NULL, NULL),
(92, 'thabu', '1de9bcfc34d57d274c0ef8b9a828d915', 'thabu@gmail.com', 'ff', 'dg', 'fg', 'dg', 'fg', 8, 'employer', '', NULL, NULL),
(93, 'appu', 'a27f65211ea0f99b9fe56f8c5d57cd2a', 'appu@gmail.com', 'dg', 'dg', 'rg', 'fg', 'fh', 555, 'employer', '', NULL, NULL),
(94, 'fghrr', '25d55ad283aa400af464c76d713c07ad', 'absara@gmail.com', 'dg', 'dg', 'fg', 'cb', 'fh', 88, 'employer', '', NULL, NULL),
(95, 'fhj', '25d55ad283aa400af464c76d713c07ad', 'thabora@gmail.com', 'fh', 'fg', 'gg', 'fg', 'gh', 66, 'employer', '', NULL, NULL),
(96, 'sarah', 'c41202d9a007c59a5bf17c34c144a61c', 'sarah@gmail.com', 'afh', 'xg', 'dgfg', 'g', 'fh', 85, 'employer', '', NULL, NULL),
(97, 'a', '552e6a97297c53e592208cf97fbb3b60', 'a@gmail.com', 'djd', 'djd', 'hdjddjd', 'djd', 'djdj', 0, 'employer', 'F1610ABE58950E5DDE4C44B7B868CBCD39933E827D3081328993226D530F32F8', NULL, NULL),
(98, 's', '925544d7f90cd3663531546f080bbed8', 's@gmail.com', 'herh', 'dhdh', 'dd', 'd', 'g', 0, 'employer', 'F1610ABE58950E5DDE4C44B7B868CBCD39933E827D3081328993226D530F32F8', NULL, NULL),
(99, 'r', '552e6a97297c53e592208cf97fbb3b60', 'r@gmail.com', 'try', 'rte', 'Ureythe', 'Utd', 'he', 0, 'employer', '0ED4E2A641483FBBB4FA3E143DC18E605E0C9E875BCAF0BDF7712BE9B8FDA4CD', NULL, NULL),
(100, 'Jay Herrigel', 'aee432839ca3dbb79ca8d44338a33d2f', 'jhherrigel@yahoo.com', 'Jay', 'Herrigel', '539 Southern Oak Drive', 'Ponte Vedra', 'FL', 32081, 'employer', 'B61B25087D593364A608E2B3B1E97A9D7D75B37B37F73282501552D734B1D03A', NULL, NULL),
(101, 'ghj', '72eb875289f32115a2f50f6b056f8760', 'rani@gmail.com', 'fhh', 'fy', 'rt', 'fg', 'fu', 6, 'employer', '', NULL, NULL),
(102, 'opp', 'beee47d70a7fc4c0c2cd2b517cc4b134', 'opp@gmail.com', 'op', 'gh', 'high', 'Fg', 'as', 0, 'employer', '4074636BBCA747652C6C8ACB8B01429D1CCB4160548695B2CA70AE65860E85FD', NULL, NULL),
(103, 'dherrigel', '084ce5d57b8ee11d4f0e1954df4ebd93', 'Dana.herrigel@gmail.com', 'Dana', 'herrigel', '539 Southern Oak Dr', 'Ponte Veda', 'FL', 32081, 'employer', 'A73835AFB228779CDBF1C8267E9014F0CC23DB587C5AD1BEFA62E754E5C81553', NULL, NULL),
(104, 'ghu', '25d55ad283aa400af464c76d713c07ad', 'dd@gmail.com', 'fhh', 'dgg', 'th', 'fh', 'gh', 66, 'employer', '', NULL, NULL),
(105, 'sam', '25d55ad283aa400af464c76d713c07ad', 'sam@gmail.com', 'bas', 'k', 'eeert', 'rt', 'hh', 23, 'employer', '', NULL, NULL),
(106, 'eee', 'eee', 'eee@gmail.com', 'eee', 'dhdh', 'sdf sdf', 'aha', 'kf', 35, 'employer', '862F563CC3848091CB26B1A2967B1C143E73EF19C1ECA92099F3E754A41E4146', NULL, NULL),
(107, 'adaga', '8c8d357b5e872bbacd45197626bd5759', 'bdad@gmail.com', 'adad', 'adfad', 'adad', 'adad', 'adad', 0, 'employer', 'kjadkjassfsfsfsfsfsfsfs', NULL, NULL),
(108, '', 'd41d8cd98f00b204e9800998ecf8427e', 'sa@gmail.com', 'r', 'r', 'df', 'df', 'gh', 0, 'employer', '862F563CC3848091CB26B1A2967B1C143E73EF19C1ECA92099F3E754A41E4146', NULL, NULL),
(109, '', 'd41d8cd98f00b204e9800998ecf8427e', 'tea@gmail.com', 'tea', 'gg', 'fhfgh', 'fg', 'fhh', 5552, 'employer', '', NULL, NULL),
(110, '', 'd41d8cd98f00b204e9800998ecf8427e', 'sivva@gmail.com', 'dg', 'dh', 'fhfh', 'dg', 'dh', 55, 'employer', '', NULL, NULL),
(111, 'hjf', 'f035dbc9fd0f0da2261057133582483a', 'karthi@gmail.com', 'fg', 'g', 'fgfg', 'dg', 'dg', 56, 'employer', '', NULL, NULL),
(112, 'rrr', 'c70fd4260c9eb90bc0ba9d047c068eb8', 'gg@gmail.com', 'hh', 'hh', 'gg', 'chennai', 'TN', 600100, 'employer', '', NULL, NULL),
(113, 'bzhxh', '25d55ad283aa400af464c76d713c07ad', 'karthiga@gmail.com', 'ghs', 'vhd', 'vg', 'fg', 'vh', 86, 'employer', '', NULL, NULL),
(114, 'test', '9e356bfe126a8e1fe108a92611872f41', 'yokesh@gmail.com', 'Test', 'Test', 'chennai Array', 'chennai', 'tamilnadu', 612345, 'both', '0B00827D3C0DB243278C5F528C2EEC7F6636379F7E8D98DD9CBAF1613DDC681C', NULL, NULL),
(115, 'testcsd', '098f6bcd4621d373cade4e832627b4f6', 'punitha1@gmail.com', 'jTest', 'Test', 'chennai Array', 'chennai', 'tamilnadu', 612345, 'employee', 'dssdd', NULL, NULL),
(116, 'SivaH', '1955b38f13116a57e4de2134a139d139', 'siva@gmail.com', 'Siva', 'H', 'Chennai', 'Chennai', 'TamilNadu', 600100, 'employer', '', NULL, NULL),
(117, 'rrrh', '1e1170df49012479761a3dd4c5fb0fbe', 'ghg@gmail.com', 'hhh', 'hhh', 'gg', 'chennai', 'TN', 600100, 'employer', '', NULL, NULL),
(118, 'SivaK', '1955b38f13116a57e4de2134a139d139', 'sivak@gmail.com', 'Siva', 'H', 'Chennai', 'Chennai', 'TamilNadu', 600100, 'employer', '', NULL, NULL),
(119, 'rgrrh', 'c3b97f6a9743ec23a4fd3e355115ff99', 'ghggg@gmail.com', 'hgghh', 'hgghh', 'gggg', 'chenai', 'TN', 600100, 'employer', '', NULL, NULL),
(120, 'rgy', '25d55ad283aa400af464c76d713c07ad', 'farzana@gmail.com', 'ff', 'fg', 'fg', 'df', 'fg', 6, 'employer', '', NULL, NULL),
(121, 'fh', '007f6a7040011de3ed1a1124969425ab', 'w@gmail.com', 'for', 'g', 'gg d', 't', 'g', 26, 'employer', '', NULL, NULL),
(122, 'user', '25d55ad283aa400af464c76d713c07ad', 'basbas@gmail.com', 'bas', 'karan', 'fggvv', 'g', 'b', 12, 'employer', '', NULL, NULL),
(123, 'basha', '25d55ad283aa400af464c76d713c07ad', 'basha@gmail.com', 'fg', 'ft', 'ty', 'ty', 'fh', 6, 'employer', '', NULL, NULL),
(124, 'bas2', '25d55ad283aa400af464c76d713c07ad', 'baskar2@gmail.com', 'bas', 'k', 'fggf', 'ct', 'st', 23, 'employer', '', NULL, NULL),
(125, 'basbas', '25d55ad283aa400af464c76d713c07ad', 'baskar23@gmail.com', 'bas', 'k', 'fggf', 'ct', 'st', 23, 'employer', '', NULL, NULL),
(126, 'basbasbas', '25d55ad283aa400af464c76d713c07ad', 'baskar234@gmail.com', 'bas', 'k', 'fggf', 'ct', 'st', 23, 'employer', '', NULL, NULL),
(127, 'bas23', '25d55ad283aa400af464c76d713c07ad', 'baskar2345@gmail.com', 'bas', 'k', 'fggf', 'ct', 'st', 23, 'employer', '', NULL, NULL),
(128, 'laksha', '2591d1db40116275e805ae909f926aec', 'laksha@gmail.com', 'basss', 'kkk', 'ghgh', 'cy', 'yy', 23, 'employer', '', NULL, NULL),
(129, 'baskiii', '25d55ad283aa400af464c76d713c07ad', 'laksha1@gmail.com', 'basss', 'kkk', 'ghgh', 'cy', 'yy', 23, 'employer', '', NULL, NULL),
(130, 'vani', '6e62dcc21377b0f936f2cc75d504bdb9', 'vani@gmail.com', 'jc', 'just', 'had hjcj', 'ct', 'st', 23, 'employer', '', NULL, NULL),
(131, 'ggggg', '25d55ad283aa400af464c76d713c07ad', 'gggg@gmail.com', 'bass', 'kar', 'ergg', 'ct', 'st', 23, 'employer', 'Handz', NULL, NULL),
(132, 'June', 'a362f6016b35a41d5b736e793189fdf7', 'j@gmail.com', 'June', 'Dh', 'shehd', 'df', 'd', 0, 'employer', 'C7D546283CFB36E4D43450E9E47F94D203777F678443A1F8A3EF36B3EF6CE7E3', NULL, NULL),
(133, 'ii', '098f6bcd4621d373cade4e832627b4f6', 'ii@gmail.com', 'i', 'i', 'ggf', 'fg', 'I', 55, 'both', '352423060938733', 'Test app', '2017_08_11_1502442091523.jpg'),
(134, 'hansika', '25d55ad283aa400af464c76d713c07ad', 'abisha2@gmail.com', 'fg', 'gy', 'fg', 'ft', 'gu', 6, 'employer', 'Handz', NULL, NULL),
(135, 'june25', '432ffaae24bc78a29cda0609cfd0fd29', 'june25@gmail.com', 'june25', 'yu', 'ggi', 'if fu', 'fi', 35, 'employer', '', NULL, NULL),
(136, 'hena', '79faea062e1612993d9ed5b62852eaf1', 'hen@gmail.com', 'dhdu', 'jrjr', 'hjr', 'hur', 'uuit', 666, 'employer', '', NULL, NULL),
(137, 'raana', '12603868f9679b8ded58a91575f72b72', 'raana@gmail.com', 'ghh', 'ryy', 'dgy', 'fyy', 'tyy', 566, 'employer', '', NULL, NULL),
(138, 'raanayyyy', '12603868f9679b8ded58a91575f72b72', 'raana@gmail.com', 'ghh', 'ryy', 'dgy', 'fyy', 'tyy', 566, 'employer', '', NULL, NULL),
(139, 'yaz', '25d55ad283aa400af464c76d713c07ad', 'yaz@gmail.com', 'ghhh', 'ty', 'tyt', 'rgy', 'tyy', 556, 'employer', '', NULL, NULL),
(140, 'trivabh', '5bbb59f367386eded9b6caafc9deb8a9', 'trisha1@gmail.com', 'ths', 'gshs', 'gshdghs', 'ghshd', 'ghhs', 5557, 'employer', 'Handz', NULL, NULL),
(141, 'Max max', 'c51d2b8b90dc1eb9fff456d6a28655ca', 'developerid888@gmail.com', 'mex', 'max', 'marco', 'den', 'fg', 56823, 'employer', 'Handz', NULL, NULL),
(142, 'don', 'c51d2b8b90dc1eb9fff456d6a28655ca', 'developerid000@gmail.com', 'far', 'jio', 'dexo', 'Mar', 'bre', 32, 'both', '18A374D2F65BE53A70913179DFF71D260859E47797E687BF465AE4CB8F7FB986', 'Welcome To Handzforhire Appp', '2017-09-14_16:48:22.png'),
(143, 'tamil', '0937938b0449317df0ce0cb2bbcdad79', 'tamil@gmail.com', 'dg', 'ft', 'df', 'fgh', 'rg', 55, 'employer', '', NULL, NULL),
(144, 'wel', 'c51d2b8b90dc1eb9fff456d6a28655ca', 'dev@g.com', 'wel', 'come', 'first', 'I will', 'first', 523, 'employer', '', NULL, NULL),
(145, 'hhh', 'b7e6923f6de66497d51789db0ef3571d', 'hhh@gmail.com', 'testing', 'djdj', 'djdFj', 'kf', 'j', 0, 'employer', '5CABBD50ED52F23B798D199998B08311AB0B79E973001ABFC7AE69547494F200', NULL, NULL),
(146, 'lll', '5b50bd5bd4e29998d63262961fb29620', 'df@gmail.com', 'djd', 'hdjd', 'hdjddjd', 'k', 'd', 0, 'employer', '44A6151ABEB4F79100425F83018B901BC5DC9C5FEF336341FD1194F87E2CF67F', 'people', '2017-07-10 15:25:4.png'),
(147, 'basbasbasbas', '25d55ad283aa400af464c76d713c07ad', 'badboy234@gmail.com', 'bas', 'k', 'fggh', 'ct', 'st', 3690, 'employer', '', NULL, NULL),
(148, 'baski1234', '25d55ad283aa400af464c76d713c07ad', 'badboy1234@gmail.com', 'bask', 'k', 'tyer', 'ty', 'yu', 3652, 'employer', '', 'test', '2017_07_04_1499173793191.jpg'),
(149, 'wel', 'c51d2b8b90dc1eb9fff456d6a28655ca', 'dev@d.com', 'wel', 'come', 'have ', 'det ', 'hi ', 0, 'employer', '5C2BA47F55A1BD3A0F2E1E6C14E9D3C9769260FD3267CC9AD325C605466CDF83', NULL, NULL),
(150, 'abar', 'c51d2b8b90dc1eb9fff456d6a28655ca', 'abar@gmail.com', 'gshd', 'ghs', 'fgs', 'fgs', 'gh', 6665, 'employer', '', NULL, NULL),
(151, 'developers ', 'c51d2b8b90dc1eb9fff456d6a28655ca', 'developers@gmail.com', 'good ', 'man ', 'yeah ', 'city ', 'ft', 56, 'employer', '991236B758333D42D1967C69C040A0470F6B2E763E64EAE0C19290424EB4CA85', NULL, NULL),
(152, 'basbas123', '25d55ad283aa400af464c76d713c07ad', 'badman@gmail.com', 'baskaran', 'kasi', 'ststr', 'ct', 'st', 2356, 'employer', '', NULL, NULL),
(153, 'basically3', '25d55ad283aa400af464c76d713c07ad', 'ck@gmail.com', 'bas', 'k', 'dtft', 'cy', 'st', 23, 'employer', '', 'test', '2017_07_06_1499340859551.jpg'),
(154, 'vgg', '25d55ad283aa400af464c76d713c07ad', 'basss@gmail.com', 'uy', 'hh', 'hhgh', 'cy', 'gu', 2356, 'employer', '', NULL, NULL),
(155, 'vggkkkk', '25d55ad283aa400af464c76d713c07ad', 'basss@gmail.com', 'uy', 'hh', 'hhgh', 'cy', 'gu', 2356, 'employer', '', NULL, NULL),
(156, 'john', 'c51d2b8b90dc1eb9fff456d6a28655ca', 'john@gmail.com', 'fsgs', 'ghhs', 'ghhsfgah', 'ghs', 'gh', 566, 'employer', 'Handz', 'Johny', '2017_07_12_1499844742438.jpg'),
(157, 'oo', '3539acd002ab152f18900eebea0ae0b3', 'oo@gmail.com', 'op', 'op', 'djdjdjdj', 'djd', 'Fj', 57, 'employee', '6E783E0242B42F5934A7E9E61E1BA87A6B9E91147AC4671AFA6B2D0E23DF592E', NULL, '2017-07-14 1:0:15.png'),
(158, 'badnnn', '25d55ad283aa400af464c76d713c07ad', 'nnn@gmail.com', 'bad', 'boy', 'yhbn', 'gh', 'h', 235, 'employer', 'Handz', NULL, NULL),
(159, 'bas678', '25d55ad283aa400af464c76d713c07ad', 'bas123@gmail.com', 'bas', 'ki', 'rtgg', 'ct', 'vh', 32, 'employer', '', NULL, NULL),
(160, 'bask9', '25d55ad283aa400af464c76d713c07ad', 'type123@gmail.com', 'ty', 'pe', 'rthjj', 'bb', 'hh', 3, 'employer', '', NULL, NULL),
(161, 'abishek', '5f4dcc3b5aa765d61d8327deb882cf99', 'abishek@gmail.com', 'abi', 'gj', 'WSD Array', 'fgg', 'fgh', 566, 'employee', 'Handz', NULL, NULL),
(162, 'first', '41ec38ff2b3a842ecb0ddcc907dd6221', 'first@gmail.com', 'first', 'gugjg', 'dgdYunus', 'can', 'fhf', 7676, 'employer', '68692DD35ED9E95D906B3CB2583B540FCA8C1152CEFBE991FE43197C21B2D1EA', NULL, NULL),
(163, 'July', 'junejunejune', 'july@gmail.com', 'July', 'fytyt', 'asdf asdf', 'uiu', 'hjhjh', 68686, 'employer', '1DF290E3652A1D4AEA9E75B4FB437853EE70FDC9664465E15E4F9269448E54AE', NULL, '2017-07-16_15:25:34.png'),
(164, 'july1', '1b959c4abdac01826a3dd688f45998f2', 'july2@gmail.com', 'july1', 'fhf', 'fhgdghfhjfjg', 'jgdj', 'the', 356653563, 'both', 'DBD40D6EBEB76FE250EAD769B75C6A92660D1EC73215747929B438E4451BEC50', 'jack', '2017-07-16_15:29:6.png'),
(165, 'ty', '3539acd002ab152f18900eebea0ae0b3', 'tttt1@gmail.com', 'hh', 'uu', 'vbhu Array', 'gg', 'hh', 23, 'both', 'DE40D7F03CCF36DC36FF5417B00B56FC1FB99F49305D7CCEB1CA368D1BE4F607', NULL, NULL),
(168, 'welcome', '7251c2d6f82823d76e90f01a381174c5', 'uuuu234@gmail.com', 'Test 1sss', 'hadad', 'jjjjjjjklkljjk lkjljkl', 'bh', 'hh', 23, 'both', 'D0116BE0DAEA831D609C44FD2308972F144343DB023B3CFB27CF1C82EC30E395', NULL, '2017_07_19_1500438189638.jpg'),
(170, 'alttrk', '098f6bcd4621d373cade4e832627b4f6', 'alttrk1@gmail.com', 'Fhgq', 'Fhgw', 'Fgyuh', 'Fhg', 'Fuji', 655, 'employer', '', NULL, NULL),
(171, 'jjj', '0051307e3f6b0ae7c28bc02d3fde8e95', 'jjj@gmail.com', 'jjj', 'jjj', 'FhgFhg', 'hd', 'Fhg', 55, 'both', '6B9A8489717D7FDEFAB086740FF6093AAEAB4C0F1DEADC3C2C4973362E534D69', 'Geetha', '2017-07-20_12:34:32.png'),
(172, 'employee1', '03a395eaf1edb673e0f99c7ca8eb156a', 'employee1@gmail.com', 'first', 'employee', 'djdhdjd', 'ccgh', 'vivid', 5457, 'both', 'D4FDE192D32C46310914175936A18036C55F8AA07450739E1F158AC655F61547', NULL, NULL),
(173, 'riya', '5ee907831fc55cc73ba2ff954aeff357', 'riya@gmail.com', 'riya', 'jazlyn', 'ahhsbdhd', 'hdh', 'ghs', 97686, 'employee', '352423060938733', 'riya jazlyn', '2017_08_29_1504016123647.jpg'),
(174, 'aruna', 'c51d2b8b90dc1eb9fff456d6a28655ca', 'aruna@gmail.com', 'cbh', 'tjj', 'tyyfgh', 'fhu', 'ghh', 5666, 'employer', '', NULL, NULL),
(175, 'JFK', '3539acd002ab152f18900eebea0ae0b3', 'fjjf@gmail.com', 'du', 'dud', 'dudused', 'dud', 'if', 424, 'employee', '349D45A56655221680C59A56235204C00CFD9210FBDE2C085E25CEBD5AB65E62', NULL, '2017-08-11_12:39:35.png'),
(176, 'ggg', '45dd9abbacf37b2049c446fc6186e27d', 'gzdg@gmail.com', 'hfhf', 'dhd', 'fjfushgs', 'dhdudi', 'fjjfjf', 5646, 'employer', '', NULL, NULL),
(177, 'hhhh', 'c9513bc3b27236b9578c00b5a19dbda4', 'dudu@gmail.com', 'Trudy', 'du', 'duddu', 'if', 'if', 56, 'both', 'A939DF40152607DB61B02800505DDE3EA834506C31C5992758BB665914209FF8', 'pppp', '2017-08-11_14:34:21.png'),
(178, 'Dudu', 'a0d76cead3bb738f8b5bb3347e4440ed', 'fkfk@gmail.com', 'JFK', 'fjjffj', 'duddud', 'hddjdu', 'Dudu', 42454, 'employer', '2639314E0694BF37E016A87421D1C132DCD4D067BE1C27B4FB84C360222020A4', NULL, '2017-08-11_19:24:22.png'),
(179, 'jazlyn', 'c51d2b8b90dc1eb9fff456d6a28655ca', 'anitha21293@gmail.com', 'ani', 'fh', 'ghhhfghh', 'fgh', 'ghj', 5666, 'employer', 'Handz', NULL, NULL),
(180, 'rocky', 'c51d2b8b90dc1eb9fff456d6a28655ca', 'rocky@gmail.com', 'ghz', 'hsh', 'fggfgy', 'dgg', 'dgg', 556, 'employer', '353627072677241', NULL, NULL),
(181, 'kite', '225f667d9243201a6b2b35e008ebe3d3', 'kite@gmail.com', 'kite', 'dhxh', 'dogsDudu', 'dud', 'fjgigi', 55554, 'employer', 'EEA668493176ED022688D7194AAD051B33227C827C1826BFF3815B4B3B114111', NULL, NULL),
(182, 'kiteemp', '225f667d9243201a6b2b35e008ebe3d3', 'kiteemp@gmail.com', 'kite emp', 'fhf has', 'fgfjgffgjgjhjgh', 'ggjfgjf', 'gjfgfg', 4754745, 'employee', '05D3EEC6C267A669CAF1DD27C6E2EBE60254523622916B5502E8EC9A121461AC', NULL, NULL),
(183, 'ghgg', '45dd9abbacf37b2049c446fc6186e27d', 'ghgg@gmail.com', 'hffh', 'iffy', 'duhe', 'he', 'du', 5225, 'employer', '076624FBC914FB3B1C249F2D984F766BFFD8D3DB7AA488DF618A762E34B9C899', NULL, NULL),
(184, 'hhhhh', 'c9513bc3b27236b9578c00b5a19dbda4', 'hhhh@gmail.com', 'JFK', 'fhhffjhf', 'hdhfyes', 'dud', 'du', 555, 'both', 'BF9F766F1A8D239D6760778357BDA72A8FE00A765FA69FCEA804F05AACC80EBD', NULL, '2017-08-30_0:23:52.png'),
(185, 'aug30', '552e6a97297c53e592208cf97fbb3b60', 'aug30@gmail.com', 'chr', 'fhdh', 'chrhdhf', 'Dudu', 'du', 55, 'employer', '6F8BBB3475C47ADA7D69D07636BB6F56BA0C9B712D48C2CDF47AA9574D4B5D77', NULL, NULL),
(186, 'aug30emp', '552e6a97297c53e592208cf97fbb3b60', 'aug30emp@gmail.com', 'gghgh', 'VHS', 'jfhfghfjfhjfjgf', 'fhkhjf', 'gjffj', 856856, 'employee', '2877613E03559AF96C6C2E4BABFC91E14343958DE552836D25AA6A52EB42AAED', NULL, NULL),
(187, 'uuuu', '4f3c8f54193b5214344a25b7f5aa3bbd', 'gddhud@gmail.com', 'Fff', 'dud', 'hdhfhe', 'he', 'fhdh', 55, 'both', '3CC175347BDBBBB4B0ECE19DB61FB19666B1CB4A7BC72E2BB7B4B0969D725EFF', NULL, '2017-09-07_0:28:18.png'),
(188, 'geetha', 'c8f6ade59bff11f5503237e5dddf335d', 'geetha@gmail.com', 'geetha', 'kumar', '125 Maiden Lane11th Floor', 'New York', 'NY', 10038, 'employer', '602615FA964B2C714095F8812EEF67AE2E7936A1918C74470859BE9960469A61', NULL, NULL),
(189, 'code', '2571a023f45ab3f461e4fd7f4c4a2fbf', 'code@gmail.com', 'code', 'chchhchc', 'du dhhd if it ufudye ufudye fifufhdhf ufudye', 'Dudu', 'fiifif fufuf ufudye', 858586, 'both', '17541815F5F31CD30050073FCBD237A166E83119CD0CF7129A382516B5C9FE18', 'Geetha', '2017-09-14_16:13:13.png'),
(190, 'gatejobs', 'dfeeac7a903b1a0e5b345482bc15072b', 'gatejobs@gmail.com', 'gate', 'jobs', '3909 Witmer RoadNiagara Falls', 'Niagara Falls', 'NY', 14305, 'both', '38431A00DD7402FAA323F776680A60C51557CAF0B1F6D6F8DA6F84CA51FBC3CA', NULL, '2017-09-20_23:14:56.png'),
(191, 'kaangencer', '2c227304ba2271b057623798aeb24bee', 'kaanegencer@gmail.com', 'Kaan', 'Gencer', '1237 Washington Ave802', 'Cleveland ', 'oh', 44110, 'employer', 'EC258646637F5DF7784C208EFE3D9E69F2166C14180C45E20034A98B15F227A0', NULL, '2017-09-24_19:18:24.png'),
(192, 'ad', '938651dae4e96f5fdcd242457ab5a45a', 'abvc@gmail.com', 'ad', 'ad', 'ad', 'ad', 'a', 0, 'employer', '', NULL, NULL),
(193, 'adss', '938651dae4e96f5fdcd242457ab5a45a', 'abvc@gmail.com', 'ad', 'ad', 'ad', 'ad', 'a', 0, 'employer', '', NULL, NULL),
(194, 'adsss', '938651dae4e96f5fdcd242457ab5a45a', 'abvc@gmail.com', 'ad', 'ad', 'ad', 'ad', 'a', 0, 'employee', '', NULL, NULL),
(195, 'hhhhg', 'a0d76cead3bb738f8b5bb3347e4440ed', 'jk@gmail.com', 'we', 'Dudu', 'getshe', 'du', 'if', 55, 'both', '708A7C376395DD3F4886187201AE541E8E5FACDED02A299B50F5A2B57B8F08BA', NULL, NULL),
(196, 'sumi', 'c51d2b8b90dc1eb9fff456d6a28655ca', 'sumitha@gmail.com', 'vsjsbznj', 'gahsjsh', 'faghshsfgaghs', 'ggshhd', 'fhshd', 9467689, 'employer', '352423060938733', NULL, '2017_09_27_1506498935125.jpg'),
(197, 'Kate ', 'f515dd3f314d25d0ca2192d870a7df63', 'kate@gmail.com', 'kate', 's', 'fhdhdhhd', 'fhdh', 'hffh', 752, 'both', '', NULL, NULL),
(198, 'er', '45dd9abbacf37b2049c446fc6186e27d', 'er@gmail.com', 'er', 'Fff', 'gofhdh', 'chr', 'gd', 55, 'both', '352423060938733', NULL, '2017-11-20_0:47:13.png'),
(199, 'EE', '45dd9abbacf37b2049c446fc6186e27d', 'ee@gmail.com', 'EE', 'EE', 'dghddry', 'fhf', 'f', 35465, 'both', '1A1441BCA8AB02368AAD9A0388B7ECFAF3A6997DD93FD6A15E25C6C3D55555AF', NULL, NULL),
(200, 'jetway', '0051307e3f6b0ae7c28bc02d3fde8e95', 'jet@gmail.com', 'jet', 'way', 'hjk Gggg dfhfh udud Gigi uffujfGigi strut khoh trued', 'uffu', 'jig', 88656, 'both', '', 'Jeep', '2017-11-20_13:3:35.png'),
(201, 'Christ', '0c744b578002c7fb9e70e25b48fa1682', 'christ@gmail.com', 'Christ', 'season', 'hffh off trot Lviv icing ififo Igorif Gigi off', 'jc', 'if', 5455, 'employer', '4243C18F651708D1C567A33B0DAE1B85DD529D7093E27DC617AB0358E7C55569', NULL, '2017-11-21_16:40:31.png'),
(202, 'asdf', '45dd9abbacf37b2049c446fc6186e27d', 'asdf@gmail.com', 'dhhd', 'dh', 'dhStuart', 'ari', 'still', 243546, 'employer', '', NULL, NULL),
(203, 'erdec', '8e9423442fcffc01e0c6732087123e54', 'erdec@gmail.com', 'redecorating', 'fuhf', 'fufudhhd', 'dhhd', 'gh', 52, 'both', '', NULL, NULL),
(204, 'eedec', '8e9423442fcffc01e0c6732087123e54', 'eedec@gmail.com', 'e', 'Jfg', 'rtttjytdfhfdfhhfd', 'sfh', 'doh', 0, 'employee', '', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_logs`
--
ALTER TABLE `api_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applied_jobs`
--
ALTER TABLE `applied_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checking_account`
--
ALTER TABLE `checking_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_card`
--
ALTER TABLE `credit_card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_notifications`
--
ALTER TABLE `email_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employers`
--
ALTER TABLE `employers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hire_jobs`
--
ALTER TABLE `hire_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs_history`
--
ALTER TABLE `jobs_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_category`
--
ALTER TABLE `job_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paypal`
--
ALTER TABLE `paypal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paypal_user_info`
--
ALTER TABLE `paypal_user_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posted_jobs`
--
ALTER TABLE `posted_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `api_logs`
--
ALTER TABLE `api_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `applied_jobs`
--
ALTER TABLE `applied_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT for table `checking_account`
--
ALTER TABLE `checking_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `credit_card`
--
ALTER TABLE `credit_card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT for table `email_notifications`
--
ALTER TABLE `email_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `employers`
--
ALTER TABLE `employers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `hire_jobs`
--
ALTER TABLE `hire_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;
--
-- AUTO_INCREMENT for table `jobs_history`
--
ALTER TABLE `jobs_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `job_category`
--
ALTER TABLE `job_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=347;
--
-- AUTO_INCREMENT for table `payment_history`
--
ALTER TABLE `payment_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `paypal`
--
ALTER TABLE `paypal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `paypal_user_info`
--
ALTER TABLE `paypal_user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `posted_jobs`
--
ALTER TABLE `posted_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
