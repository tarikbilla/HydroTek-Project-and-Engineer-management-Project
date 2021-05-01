-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2019 at 08:27 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gh_tech`
--

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `date_log` varchar(15) NOT NULL,
  `time_log` varchar(15) NOT NULL,
  `username` varchar(250) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `project_id` int(10) NOT NULL,
  `details` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `date_log`, `time_log`, `username`, `ip_address`, `project_id`, `details`) VALUES
(1, '25-11-2019', '06:15:40', 'admin', '::1', 1, 'hello'),
(2, '25-11-2019', '06:16:37', 'admin', '::1', 1, 'hello'),
(3, '25-11-2019', '06:17:11', 'admin', '::1', 1, 'hello'),
(4, '25-11-2019', '06:30:07', 'admin', '::1', 1, 'Update Item40.91.00 .01.01'),
(5, '25-11-2019', '06:32:31', 'admin', '::1', 1, 'Update Item <a href=\'update-item.php?id=1\'>40.91.00 .01.01</a>'),
(6, '25-11-2019', '06:46:02', 'admin', '::1', 0, 'Update Profile <a href=\'update-profile.php?id=\'>admin</a>'),
(7, '25-11-2019', '06:47:54', 'admin', '::1', 0, 'Update Profile <a href=\'update-profile.php?id=\'>admin</a>'),
(8, '25-11-2019', '06:49:39', 'admin', '::1', 0, 'Update Profile <a href=\'update-profile.php?id=\'>admin</a>'),
(9, '25-11-2019', '06:50:20', 'admin', '::1', 0, 'Update Profile <a href=\'update-profile.php?id=1\'>admin</a>'),
(10, '25-11-2019', '06:53:02', 'admin', '::1', 0, 'Update Profile <a href=\'update-profile.php?id=3\'>tarik01</a>'),
(11, '25-11-2019', '06:58:36', 'admin', '::1', 0, 'Change Password <a href=\'update-profile.php?id=3\'>tarik01</a>'),
(12, '25-11-2019', '07:03:49', 'admin', '::1', 2, 'Add Item <a href=\'update-item.php?id=8\'>testing</a>'),
(13, '25-11-2019', '07:06:35', 'admin', '::1', 2, 'Update Item <a href=\'update-item.php?id=8\'>testing</a>'),
(14, '25-11-2019', '07:09:33', 'admin', '::1', 2, 'Update Item <a href=\'update-item.php?id=8\'>testing</a>'),
(15, '25-11-2019', '07:17:22', 'tarik', '::1', 2, 'Update Item <a href=\'update-item.php?id=4\'>test item</a>'),
(16, '25-11-2019', '07:21:39', 'tarik', '::1', 0, 'Update Profile <a href=\'update-profile.php?id=2\'>tarik</a>');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `memberID` int(11) NOT NULL,
  `rules` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `phone_no` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `gender` varchar(15) COLLATE utf8mb4_bin NOT NULL,
  `address` varchar(250) COLLATE utf8mb4_bin NOT NULL,
  `profile_pic_path` varchar(250) COLLATE utf8mb4_bin NOT NULL,
  `active` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `resetToken` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `resetComplete` varchar(3) COLLATE utf8mb4_bin DEFAULT 'No',
  `creator_admin_username` varchar(50) COLLATE utf8mb4_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`memberID`, `rules`, `username`, `password`, `email`, `phone_no`, `first_name`, `last_name`, `gender`, `address`, `profile_pic_path`, `active`, `resetToken`, `resetComplete`, `creator_admin_username`) VALUES
(1, 'admin', 'admin', '$2y$10$6XLt/O9.7LTyKb.PGFms2Oq5g67KA8JS7WtPN67IBsGiSBTVvKxgO', 'admin@admin.com', '01700112233', 'Admin', ' ', 'male', 'jessore', 'img/profile_pic/admin.jpg', 'Yes', NULL, 'No', ''),
(2, 'engineer', 'tarik', '$2y$10$U.Tq1JqGGQyYLCqsYTWxQOWvZ8snptC.9BFhYJvN/bsYzeZfhnFjy', 'tarik@gmail.com', '01700112233', 'Tarik', 'billa', 'male', 'jessore', 'img/profile_pic/tarik.jpg', 'Yes', NULL, 'No', ''),
(3, 'engineer', 'tarik01', '$2y$10$D7jkUVKiTJYGW3Jkat8Us.pvezqVIbPwY7dGRTst4BV.wy2cNy.B.', 'tarik@gmail.com', '0170011223', 'tarik', 'Billa', 'other', 'jessore', 'img/profile_pic/tarik01.jpg', 'f2e0d6ff7781584730e5dab1db0dab95', NULL, 'No', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(15) NOT NULL,
  `project_id` int(10) NOT NULL,
  `creator_admin_uname` varchar(10) NOT NULL,
  `created_date` varchar(50) NOT NULL,
  `created_time` varchar(50) NOT NULL,
  `item` varchar(200) NOT NULL,
  `description` varchar(250) NOT NULL,
  `qty` int(10) NOT NULL,
  `unit` varchar(15) NOT NULL,
  `unit_rate_kd` varchar(15) NOT NULL,
  `total_kd` varchar(15) NOT NULL,
  `delivery` varchar(15) NOT NULL,
  `delivery_percent` varchar(11) NOT NULL,
  `total_delivery_qty` int(50) NOT NULL,
  `installatin` varchar(15) NOT NULL,
  `installatin_percent` varchar(11) NOT NULL,
  `commissioning` varchar(15) NOT NULL,
  `commissioning_percent` varchar(11) NOT NULL,
  `total_progress` varchar(15) NOT NULL,
  `total_invoice` varchar(15) NOT NULL,
  `balance_tobe_invoiced` varchar(15) NOT NULL,
  `balance_work` varchar(15) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `project_id`, `creator_admin_uname`, `created_date`, `created_time`, `item`, `description`, `qty`, `unit`, `unit_rate_kd`, `total_kd`, `delivery`, `delivery_percent`, `total_delivery_qty`, `installatin`, `installatin_percent`, `commissioning`, `commissioning_percent`, `total_progress`, `total_invoice`, `balance_tobe_invoiced`, `balance_work`, `status`) VALUES
(1, 1, '0', '12-11-2019', '08:59:41', '40.91.00 .01.01', 'EM Flow meter-HART/Fieldbus-1600mm\r\n', 2, '0', '0', '56000', '11200', '20', 2, '33600', '60', '11200', '20', '56000', '44800', '0', '0', ''),
(2, 1, '0', '12-11-2019', '09:17:25', '40.91.00 .01.02', 'Ultrasonic Level Transmitters- HART/Fieldbus- for Inlet Chambers and PS Wet-Well\r\n', 7, '0', '0', '7000', '1400', '20', 0, '0', '0', '0', '0', '1400', '1400', '0', '5600', ''),
(3, 2, '0', '12-11-2019', '09:21:42', '', '', 0, '', '0', '0', '0', '0', 0, '0', '0', '0', '0', '0', '0', '0', '0', ''),
(4, 2, '0', '12-11-2019', '09:26:04', 'test item', 'aaa', 2, '0', '2800', '5600', '560', '20', 1, '1680', '60', '560', '20', '2800.000', '2240.000', '', '2800.000', ''),
(5, 1, 'admin', '12-11-2019', '09:57:20', 'Timestamp is an optional paramete', 'Timestamp is an optional paramete', 2, '0', '12000', '24000', '0', '0', 0, '0', '0', '0', '0', '0', '0', '0', '0', ''),
(6, 1, 'admin', '12-11-2019', '10:37:20', 'test item here 0001', 'hello', 2, '0', '12000', '24000', '0', '0', 0, '0', '0', '0', '0', '0', '0', '0', '0', ''),
(7, 1, 'admin', '19-11-2019', '02:51:02', 'testing', 'qqq', 1, '0', '28000', '28000', '0', '0', 0, '0', '0', '0', '0', '0', '0', '0', '0', ''),
(8, 2, 'admin', '25-11-2019', '07:03:49', 'testing', 'aa', 3, '0', '1207', '3983.1', '265.54', '20', 1, '132.77', '10', '0', '0', '398.310', '398.310', '', '3584.790', '');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(15) NOT NULL,
  `title` varchar(200) NOT NULL,
  `tender_no` varchar(50) NOT NULL,
  `bill_no` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `total_kd` int(15) NOT NULL,
  `total_delivery_kd` int(15) NOT NULL,
  `total_due_kd` int(15) NOT NULL,
  `total_progress` varchar(15) NOT NULL,
  `date` varchar(15) NOT NULL,
  `time` varchar(15) NOT NULL,
  `status` varchar(250) NOT NULL,
  `creator_admin_username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `tender_no`, `bill_no`, `description`, `total_kd`, `total_delivery_kd`, `total_due_kd`, `total_progress`, `date`, `time`, `status`, `creator_admin_username`) VALUES
(1, 'DIVISION 100 - PROCESS INTEGRATION', ' SE / 167', '4', 'Construction, Completion, Maintenance of Instrumentation And Control For Process Integration TSE Lines from DMC to Wafra - Project Area - D3', 0, 0, 0, '', '', '', '', 'admin'),
(2, 'TSE Lines from DMC to Wafra ...', ' SE / 168', '5', '1', 0, 0, 0, '', '', '', '', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `project_access`
--

CREATE TABLE `project_access` (
  `id` int(11) NOT NULL,
  `project_id` int(15) NOT NULL,
  `username` varchar(250) NOT NULL,
  `access_by` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_access`
--

INSERT INTO `project_access` (`id`, `project_id`, `username`, `access_by`) VALUES
(8, 2, 'tarik', 'admin'),
(9, 1, 'tarik', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`memberID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_access`
--
ALTER TABLE `project_access`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `memberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project_access`
--
ALTER TABLE `project_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
