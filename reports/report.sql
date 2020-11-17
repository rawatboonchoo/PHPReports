-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 17, 2020 at 02:28 PM
-- Server version: 5.7.15-log
-- PHP Version: 7.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `report`
--

-- --------------------------------------------------------

--
-- Table structure for table `attach`
--

CREATE TABLE `attach` (
  `att_id` int(11) NOT NULL,
  `plan_id` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `att_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(1, 'รายงานการประมวลผล'),
(2, 'ปัญหาการใช้อุปกรณ์'),
(3, 'รายงานรักษาความปลอดภัย'),
(4, 'รายงานการเข้าออก'),
(5, 'ให้บริการศูนย์คอมพิวเตอร์');

-- --------------------------------------------------------

--
-- Table structure for table `categorys`
--

CREATE TABLE `categorys` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categorys`
--

INSERT INTO `categorys` (`cat_id`, `cat_name`) VALUES
(1, 'รายงานการประมวลผล'),
(2, 'ปัญหาการใช้อุปกรณ์'),
(3, 'รายงานรักษาความปลอดภัย'),
(4, 'รายงานการเข้าออก'),
(5, 'ให้บริการศูนย์คอมพิวเตอร์');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dep_id` int(11) NOT NULL,
  `dep_shortname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dep_fullname` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `dep_area` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dep_status` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dep_id`, `dep_shortname`, `dep_fullname`, `dep_area`, `dep_status`) VALUES
(1, 'มศทผ', 'ศูนย์ประมวลผลข้อมูลและรายงาน', NULL, 'admin'),
(2, 'จศทผ3', 'ศูนย์คอมพิวเตอร์สำรองกรุงเกษม', NULL, 'user'),
(3, 'จศทผ1', 'ศูนย์คอมพิวเตอร์แจ้งวัฒนะ 1', 'อาคาร 4 ชั้น 3', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `description`
--

CREATE TABLE `description` (
  `des_id` int(11) NOT NULL,
  `plan_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cat_id` int(11) NOT NULL,
  `dep_id` int(11) NOT NULL,
  `att_id` int(11) DEFAULT NULL,
  `des_detail` text COLLATE utf8_unicode_ci NOT NULL,
  `des_report_start` date DEFAULT NULL,
  `des_report_end` date DEFAULT NULL,
  `des_note` text COLLATE utf8_unicode_ci,
  `des_count` int(11) NOT NULL,
  `des_create_dtm` datetime NOT NULL,
  `des_last_update_dtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `description`
--

INSERT INTO `description` (`des_id`, `plan_id`, `cat_id`, `dep_id`, `att_id`, `des_detail`, `des_report_start`, `des_report_end`, `des_note`, `des_count`, `des_create_dtm`, `des_last_update_dtm`) VALUES
(5, 'REP-20201110796', 1, 1, NULL, '<p>- ความสำเร็จของการประมวลผลใบแจ้งหนี้</p>\n\n<p>- งานประเภท Auto Job</p>\n\n<p>- Rating MB ONLY</p>\n\n<p>- DEBT DAILYUPDATE</p>\n', '2020-10-01', '2020-10-31', 'สิ่งที่แนบมาด้วย 1', 0, '2020-11-17 15:48:15', NULL),
(6, 'REP-20201110796', 1, 2, NULL, '<p>- วันที่ 22 ตุลาคม 2563 เวลา 10.39 น. -11.44 น. บริษัท OTO เข้ามายำรุงรักษา ระบบ SCOM ตามสัญยาบำรุงรักษา</p>\r\n\r\n<p>- วันที่ 1 ตุลาคม 2563 ส่วนงาน วบน.1.2 ทำการทดสอบ Generator เวลา 11.00 น. - 11.15 น. เครื่องทำงานปกติ</p>\r\n', '2020-09-24', '2020-10-30', '', 0, '2020-11-17 16:15:59', NULL),
(7, 'REP-20201110796', 1, 3, NULL, '<p>- การจัดเก็บเทป ของระบบ Billing นอกสถานที่</p>\n', '2020-09-28', '2020-10-25', '', 0, '2020-11-17 16:53:05', NULL),
(8, 'REP-20201110796', 2, 2, NULL, '<p>อุณหภูมิเครื่องปรับอากาศ</p>\n\n<p>- EDP#1 ...</p>\n\n<p>- EDP#2&nbsp;...</p>\n\n<p>- EDP#3&nbsp;...</p>\n\n<p>- EDP#4&nbsp;...</p>\n\n<p>เครื่องปรับอากาศ AIRTEMP-1 ทำงานปกติ</p>\n', '2020-09-24', '2020-10-30', '', 0, '0000-00-00 00:00:00', NULL),
(9, 'REP-20201110796', 2, 3, NULL, '<p>- ทดสอบการใช้งานปัญหา</p>\n\n<p>- ทดสอบการใช้งานระบบ</p>\n', '2020-11-10', '2020-11-28', '', 0, '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `id` int(11) NOT NULL,
  `plan_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `plan_month` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `plan_year` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `plan_status` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`id`, `plan_id`, `plan_month`, `plan_year`, `plan_status`) VALUES
(2, 'REP-20201110796', 'พฤศจิกายน', '2563', 'ดำเนินการสำเร็จ'),
(3, 'REP-20201250186', 'ธันวาคม', '2563', 'กำลังดำเนินการ'),
(4, 'REP-20210176885', 'มกราคม', '2564', 'กำลังดำเนินการ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attach`
--
ALTER TABLE `attach`
  ADD PRIMARY KEY (`att_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `categorys`
--
ALTER TABLE `categorys`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dep_id`);

--
-- Indexes for table `description`
--
ALTER TABLE `description`
  ADD PRIMARY KEY (`des_id`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attach`
--
ALTER TABLE `attach`
  MODIFY `att_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `categorys`
--
ALTER TABLE `categorys`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `description`
--
ALTER TABLE `description`
  MODIFY `des_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
