-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2024 at 03:06 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mlm_chaiwala`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_details`
--

CREATE TABLE `bank_details` (
  `id` int(11) NOT NULL,
  `acc_number` varchar(50) NOT NULL,
  `acc_holder_name` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `ifsc_code` varchar(50) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `qr_code` varchar(255) NOT NULL,
  `modify_date` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bank_details`
--

INSERT INTO `bank_details` (`id`, `acc_number`, `acc_holder_name`, `bank_name`, `ifsc_code`, `branch`, `qr_code`, `modify_date`, `modified_by`) VALUES
(1, '78762210001030', 'Shivesh Patel', 'Canara Bank', 'CNRB00017876', 'Mangawan', 'media/images/msdr_qrcd.png', '2023-10-01 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_manage`
--

CREATE TABLE `category_manage` (
  `id` bigint(20) NOT NULL,
  `cat_id` varchar(150) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `category` varchar(150) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0->deactive,1->active',
  `m_icon` varchar(255) NOT NULL,
  `isDeletedBy` int(11) NOT NULL,
  `IsDeleted` enum('N','Y') NOT NULL,
  `created_by` int(11) NOT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_by` int(11) NOT NULL,
  `modify_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_manage`
--

INSERT INTO `category_manage` (`id`, `cat_id`, `parent_id`, `category`, `status`, `m_icon`, `isDeletedBy`, `IsDeleted`, `created_by`, `create_date`, `modified_by`, `modify_date`) VALUES
(8, 'MSDRC1216', 0, 'MSDR Body Care', '1', '', 0, 'N', 1, '2023-07-12 16:46:16', 1, '2023-09-25 18:05:05'),
(13, 'MSDRC2532', 0, 'Ayurvedic', '1', '', 0, 'N', 1, '2023-09-25 18:11:32', 1, '2023-09-26 17:05:54');

-- --------------------------------------------------------

--
-- Table structure for table `club_income`
--

CREATE TABLE `club_income` (
  `id` int(11) NOT NULL,
  `first_repurchase` decimal(18,2) NOT NULL,
  `scnd_repurchase` decimal(18,2) NOT NULL,
  `thrd_repurchase` decimal(18,2) NOT NULL,
  `forth_repurchase` decimal(18,2) NOT NULL,
  `withdrableAmt` decimal(18,2) NOT NULL,
  `shipping_charges` decimal(18,2) NOT NULL,
  `tax` decimal(18,2) NOT NULL,
  `admin_fee` decimal(18,2) NOT NULL,
  `active_salary` decimal(18,2) NOT NULL,
  `inactive_salary` decimal(18,2) NOT NULL,
  `generation_income` float(20,2) NOT NULL,
  `first_gen_incom` float(20,2) NOT NULL,
  `second_gen_incom` float(20,2) NOT NULL,
  `third_gen_incom` float(20,2) NOT NULL,
  `four_gen_incom` float(20,2) NOT NULL,
  `sponsor_income` float(20,2) NOT NULL,
  `repurchase_incom` float(20,2) NOT NULL,
  `first_repurchase_incom` float(20,2) NOT NULL,
  `second_repurchase_incom` float(20,2) NOT NULL,
  `third_repurchase_incom` float(20,2) NOT NULL,
  `four_repurchase_incom` float(20,2) NOT NULL,
  `fifth_repurchase_incom` float(20,2) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `club_income`
--

INSERT INTO `club_income` (`id`, `first_repurchase`, `scnd_repurchase`, `thrd_repurchase`, `forth_repurchase`, `withdrableAmt`, `shipping_charges`, `tax`, `admin_fee`, `active_salary`, `inactive_salary`, `generation_income`, `first_gen_incom`, `second_gen_incom`, `third_gen_incom`, `four_gen_incom`, `sponsor_income`, `repurchase_incom`, `first_repurchase_incom`, `second_repurchase_incom`, `third_repurchase_incom`, `four_repurchase_incom`, `fifth_repurchase_incom`, `modified_by`, `modified_date`) VALUES
(1, '25.00', '20.00', '15.00', '5.00', '500.00', '100.00', '5.00', '5.00', '50000.00', '12500.00', 18.00, 8.00, 5.00, 3.00, 2.00, 10.00, 18.00, 8.00, 5.00, 3.00, 2.00, 0.00, 1, '2023-09-05 16:55:17');

-- --------------------------------------------------------

--
-- Table structure for table `company_income`
--

CREATE TABLE `company_income` (
  `id` int(11) NOT NULL,
  `tnx_id` int(11) NOT NULL,
  `tnx_type` enum('0','1','2','3','4','5') NOT NULL DEFAULT '0' COMMENT '0->system,1->member,2->frenchise income,3->employee_salary,4->repurchase,5->security',
  `user_type` enum('0','1','2') NOT NULL COMMENT '0->admin,1->partner,2->member',
  `debit_amt` decimal(18,2) NOT NULL DEFAULT 0.00,
  `credit_amt` decimal(18,2) NOT NULL DEFAULT 0.00,
  `reason` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `generated_by` enum('0','1','2','3') NOT NULL DEFAULT '0' COMMENT '0->system after topup,1->admin,2->members,3->partner',
  `ticket_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `company_income`
--

INSERT INTO `company_income` (`id`, `tnx_id`, `tnx_type`, `user_type`, `debit_amt`, `credit_amt`, `reason`, `created_by`, `created_date`, `modified_by`, `modified_date`, `generated_by`, `ticket_id`) VALUES
(1, 13122549, '1', '0', '0.00', '8934.00', 'Amount credited after purchase of account id #F55555', 1, '2024-03-13 12:25:49', 0, NULL, '0', NULL),
(2, 18133135, '1', '0', '0.00', '1400.00', 'Amount credited after topup of account id #MSD89810', 1, '2024-04-18 13:31:35', 0, NULL, '0', NULL),
(3, 18133311, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD44346', 1, '2024-04-18 13:33:11', 0, NULL, '0', NULL),
(4, 18133450, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD87907', 1, '2024-04-18 13:34:50', 0, NULL, '0', NULL),
(5, 18135142, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD45209', 1, '2024-04-18 13:51:42', 0, NULL, '0', NULL),
(6, 18153606, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD69928', 1, '2024-04-18 15:36:06', 0, NULL, '0', NULL),
(7, 18161901, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD57191', 1, '2024-04-18 16:19:01', 0, NULL, '0', NULL),
(8, 18163648, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD69928', 1, '2024-04-18 16:36:48', 0, NULL, '0', NULL),
(9, 18163835, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD12734', 1, '2024-04-18 16:38:35', 0, NULL, '0', NULL),
(10, 18164552, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD21896', 1, '2024-04-18 16:45:52', 0, NULL, '0', NULL),
(11, 18164806, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD15867', 1, '2024-04-18 16:48:06', 0, NULL, '0', NULL),
(12, 18165052, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD44346', 1, '2024-04-18 16:50:52', 0, NULL, '0', NULL),
(13, 18165210, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD11452', 1, '2024-04-18 16:52:10', 0, NULL, '0', NULL),
(14, 18165430, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD44142', 1, '2024-04-18 16:54:30', 0, NULL, '0', NULL),
(15, 18165551, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD69928', 1, '2024-04-18 16:55:51', 0, NULL, '0', NULL),
(16, 18165745, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD44142', 1, '2024-04-18 16:57:45', 0, NULL, '0', NULL),
(17, 18170131, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD69928', 1, '2024-04-18 17:01:31', 0, NULL, '0', NULL),
(18, 18171949, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD15867', 1, '2024-04-18 17:19:49', 0, NULL, '0', NULL),
(19, 18172106, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD37522', 1, '2024-04-18 17:21:06', 0, NULL, '0', NULL),
(20, 18172324, '1', '0', '0.00', '1400.00', 'Amount credited after topup of account id #MSD46287', 1, '2024-04-18 17:23:24', 0, NULL, '0', NULL),
(21, 18172700, '1', '0', '0.00', '1400.00', 'Amount credited after topup of account id #MSD45209', 1, '2024-04-18 17:27:00', 0, NULL, '0', NULL),
(22, 18172748, '1', '0', '0.00', '1400.00', 'Amount credited after topup of account id #MSD45209', 1, '2024-04-18 17:27:48', 0, NULL, '0', NULL),
(23, 18172921, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD69928', 1, '2024-04-18 17:29:21', 0, NULL, '0', NULL),
(24, 18173128, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD79245', 1, '2024-04-18 17:31:28', 0, NULL, '0', NULL),
(25, 18173351, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD45209', 1, '2024-04-18 17:33:51', 0, NULL, '0', NULL),
(26, 18173622, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD44142', 1, '2024-04-18 17:36:22', 0, NULL, '0', NULL),
(27, 18173756, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD69928', 1, '2024-04-18 17:37:56', 0, NULL, '0', NULL),
(28, 18174008, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD12734', 1, '2024-04-18 17:40:08', 0, NULL, '0', NULL),
(29, 18174112, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD21896', 1, '2024-04-18 17:41:12', 0, NULL, '0', NULL),
(30, 18174159, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD15867', 1, '2024-04-18 17:41:59', 0, NULL, '0', NULL),
(31, 18174238, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD89810', 1, '2024-04-18 17:42:38', 0, NULL, '0', NULL),
(32, 18174358, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD79245', 1, '2024-04-18 17:43:58', 0, NULL, '0', NULL),
(33, 18174558, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD85911', 1, '2024-04-18 17:45:58', 0, NULL, '0', NULL),
(34, 18174841, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD51412', 1, '2024-04-18 17:48:41', 0, NULL, '0', NULL),
(35, 18175044, '1', '0', '0.00', '1400.00', 'Amount credited after topup of account id #MSD75769', 1, '2024-04-18 17:50:44', 0, NULL, '0', NULL),
(36, 18175957, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD44142', 1, '2024-04-18 17:59:57', 0, NULL, '0', NULL),
(37, 18180210, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD69928', 1, '2024-04-18 18:02:10', 0, NULL, '0', NULL),
(38, 18180313, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD12734', 1, '2024-04-18 18:03:13', 0, NULL, '0', NULL),
(39, 18180524, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD21896', 1, '2024-04-18 18:05:24', 0, NULL, '0', NULL),
(40, 18180714, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD44142', 1, '2024-04-18 18:07:14', 0, NULL, '0', NULL),
(41, 18181139, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD44142', 1, '2024-04-18 18:11:39', 0, NULL, '0', NULL),
(42, 18181728, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD69928', 1, '2024-04-18 18:17:28', 0, NULL, '0', NULL),
(43, 18182140, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD12734', 1, '2024-04-18 18:21:40', 0, NULL, '0', NULL),
(44, 18182446, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD21896', 1, '2024-04-18 18:24:46', 0, NULL, '0', NULL),
(45, 18182603, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD15867', 1, '2024-04-18 18:26:03', 0, NULL, '0', NULL),
(46, 18182930, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD69928', 1, '2024-04-18 18:29:30', 0, NULL, '0', NULL),
(47, 18183137, '1', '0', '0.00', '200.00', 'Amount credited after topup of account id #MSD12734', 1, '2024-04-18 18:31:37', 0, NULL, '0', NULL),
(48, 19182014, '1', '0', '0.00', '1000.00', 'Amount credited after topup of account id #CHD44142', 1, '2024-04-19 18:20:14', 0, NULL, '0', NULL),
(49, 19182136, '1', '0', '0.00', '1000.00', 'Amount credited after topup of account id #CHD34095', 1, '2024-04-19 18:21:36', 0, NULL, '0', NULL),
(50, 19182706, '1', '0', '0.00', '1000.00', 'Amount credited after topup of account id #CHD32298', 1, '2024-04-19 18:27:06', 0, NULL, '0', NULL),
(51, 19183456, '1', '0', '0.00', '1000.00', 'Amount credited after topup of account id #CHD74795', 1, '2024-04-19 18:34:56', 0, NULL, '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_by_user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` date NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `created_by_user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 1, 1, '2021-12-30', '2023-04-04 10:10:50');

-- --------------------------------------------------------

--
-- Table structure for table `earning`
--

CREATE TABLE `earning` (
  `id` int(11) NOT NULL,
  `earn_type` enum('0','1','2','3','4','5','6','7','8','9','10','11','13') NOT NULL DEFAULT '0' COMMENT '0->jioning package,1->sponsor,2->generation,3->star club,4->gold star club,5->msdr star club,6->msdr super star club,7->top level royality,8->bike fund,9->car fund,10->house fund,11->repurchase,12->tour fund',
  `userid` varchar(20) NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `total_bv` decimal(18,2) NOT NULL DEFAULT 0.00,
  `earnedBv` decimal(18,2) NOT NULL DEFAULT 0.00,
  `type` varchar(255) NOT NULL,
  `ref_id` varchar(20) NOT NULL DEFAULT 'N/A',
  `status` enum('Paid','Pending','Hold') NOT NULL DEFAULT 'Pending',
  `create_date` datetime NOT NULL,
  `approve_date` datetime DEFAULT NULL,
  `pay_request_date` datetime DEFAULT NULL,
  `approved_by` enum('0','1') NOT NULL COMMENT '0->monthly system,1->admin',
  `approval_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `earning`
--

INSERT INTO `earning` (`id`, `earn_type`, `userid`, `amount`, `total_bv`, `earnedBv`, `type`, `ref_id`, `status`, `create_date`, `approve_date`, `pay_request_date`, `approved_by`, `approval_id`) VALUES
(1, '0', 'CHD32298', '50.00', '0.00', '0.00', 'Referral Income', 'CHD74795', 'Pending', '2024-04-19 00:00:00', NULL, NULL, '0', NULL),
(2, '0', 'CHD32298', '200.00', '0.00', '0.00', 'Level Income', 'CHD74795', 'Pending', '2024-04-19 00:00:00', NULL, NULL, '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_designation`
--

CREATE TABLE `employee_designation` (
  `id` int(11) NOT NULL,
  `des_title` varchar(200) NOT NULL,
  `des_permission` varchar(1000) NOT NULL,
  `payscale` decimal(11,2) NOT NULL DEFAULT 0.00,
  `created_by` int(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `employee_designation`
--

INSERT INTO `employee_designation` (`id`, `des_title`, `des_permission`, `payscale`, `created_by`, `create_date`, `modified_by`, `modify_date`) VALUES
(1, 'Account Manager', '', '1000.00', 1, '2023-06-26 16:36:23', NULL, NULL),
(2, 'Cashier', '', '5000.00', 1, '2023-06-26 16:38:13', NULL, NULL),
(3, 'Marketting Head', '', '999.00', 1, '2023-06-26 16:38:50', 1, '2023-08-17 15:45:13');

-- --------------------------------------------------------

--
-- Table structure for table `msdr_members`
--

CREATE TABLE `msdr_members` (
  `id` int(11) NOT NULL,
  `user_typ` enum('1','2') NOT NULL COMMENT '1->member,2->walking',
  `username` varchar(100) NOT NULL,
  `rank` varchar(50) NOT NULL,
  `memTitle` varchar(50) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `shw_pass` varchar(200) NOT NULL,
  `sponsor` varchar(100) NOT NULL,
  `position` varchar(20) DEFAULT NULL,
  `A` int(11) NOT NULL DEFAULT 0,
  `B` int(11) NOT NULL DEFAULT 0,
  `C` int(11) NOT NULL DEFAULT 0,
  `D` int(11) NOT NULL DEFAULT 0,
  `E` int(11) NOT NULL DEFAULT 0,
  `address` varchar(400) NOT NULL,
  `registration_ip` varchar(20) NOT NULL,
  `last_login_ip` varchar(20) NOT NULL DEFAULT '''NA''',
  `last_login` int(11) NOT NULL DEFAULT 0,
  `session` char(32) NOT NULL,
  `topup` decimal(11,2) NOT NULL DEFAULT 0.00,
  `topup_request` decimal(18,2) NOT NULL DEFAULT 0.00,
  `topup_date` datetime DEFAULT NULL,
  `my_img` varchar(60) DEFAULT 'uploads/member/no_profile.png' COMMENT ' ',
  `status` enum('Block','Active') NOT NULL DEFAULT 'Active',
  `otp` varchar(200) NOT NULL,
  `email_verification` int(11) NOT NULL DEFAULT 0,
  `gift_level` int(11) NOT NULL DEFAULT 0,
  `created_type` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0->admin,1->partner,2->member',
  `create_date` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modify_typ` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0->system,1->own_user',
  `modify_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `msdr_members`
--

INSERT INTO `msdr_members` (`id`, `user_typ`, `username`, `rank`, `memTitle`, `name`, `gender`, `email`, `mobile`, `password`, `shw_pass`, `sponsor`, `position`, `A`, `B`, `C`, `D`, `E`, `address`, `registration_ip`, `last_login_ip`, `last_login`, `session`, `topup`, `topup_request`, `topup_date`, `my_img`, `status`, `otp`, `email_verification`, `gift_level`, `created_type`, `create_date`, `created_by`, `modified_by`, `modify_typ`, `modify_date`) VALUES
(1, '1', 'CHD44142', 'star club member', NULL, 'Master User', 'Male', 'ajay.camwel@gmail.com', '9264168898', 'c4ca4238a0b923820dcc509a6f75849b', '1', '', NULL, 52, 0, 0, 0, 0, 'jaalpur', '', 'NA', 0, '', '1000.00', '0.00', '2024-04-19 18:20:14', 'uploads/member/90f88ed32b6727dec2f1510d43055dc1.png', 'Active', '', 0, 0, '0', NULL, 0, 1, '1', '2024-03-13 13:03:38'),
(52, '1', 'CHD34095', '', 'Mr.', 'rohan', 'Male', 'nikhil@gmail.com', '987488588', 'e10adc3949ba59abbe56e057f20f883e', '123456', 'CHD44142', 'CHD44142', 53, 0, 0, 0, 0, '123456', '', '\'NA\'', 0, '', '1000.00', '1000.00', '2024-04-19 18:21:36', 'uploads/member/no_profile.png', 'Active', '', 0, 0, '2', '2024-04-19 18:11:52', 1, 0, '0', NULL),
(53, '1', 'CHD32298', '', 'Mr.', 'icu', 'Female', 'sham@gmail.com', '987488579', 'c4ca4238a0b923820dcc509a6f75849b', '1', 'CHD34095', 'CHD34095', 54, 0, 0, 0, 0, 'sfdsafsfdafadfsad', '', '\'NA\'', 0, '', '1000.00', '1000.00', '2024-04-19 18:27:06', 'uploads/member/no_profile.png', 'Active', '', 0, 0, '2', '2024-04-19 18:25:54', 1, 0, '0', NULL),
(54, '1', 'CHD74795', '', 'Mr.', 'rohan', 'Female', 'shamf@gmail.com', '9905147054', 'c4ca4238a0b923820dcc509a6f75849b', '1', 'CHD32298', 'CHD32298', 0, 0, 0, 0, 0, 'dfsgfdgfdgdsf', '', '\'NA\'', 0, '', '1000.00', '1000.00', '2024-04-19 18:34:56', 'uploads/member/no_profile.png', 'Active', '', 0, 0, '2', '2024-04-19 18:31:11', 1, 0, '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `msdr_member_basic`
--

CREATE TABLE `msdr_member_basic` (
  `id` int(11) NOT NULL,
  `mem_id` int(11) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `zipcode` varchar(15) NOT NULL,
  `gst_number` varchar(20) NOT NULL,
  `pan_nu` varchar(20) NOT NULL,
  `pan_img` varchar(255) NOT NULL DEFAULT 'uploads/member_document/no_img.png',
  `aadhaar_nu` varchar(15) DEFAULT NULL,
  `adhar_img` varchar(255) NOT NULL DEFAULT 'uploads/member_document/no_img.png',
  `passbook_img` varchar(255) DEFAULT 'uploads/member_document/no_img.png',
  `bank_name` varchar(255) NOT NULL,
  `bank_ac_no` varchar(50) NOT NULL,
  `bank_Ifsc` varchar(255) NOT NULL,
  `bankBrName` varchar(255) NOT NULL,
  `btc_address` varchar(255) DEFAULT NULL,
  `nominee_name` varchar(150) NOT NULL,
  `nominee_address` varchar(255) NOT NULL,
  `nominee_relationship` varchar(150) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_type` enum('0','1') NOT NULL COMMENT '0->admin,1->user',
  `created_date` datetime DEFAULT NULL,
  `modify_by` int(11) NOT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modified_type` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0->admin,1->own user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `msdr_member_basic`
--

INSERT INTO `msdr_member_basic` (`id`, `mem_id`, `date_of_birth`, `state`, `district`, `zipcode`, `gst_number`, `pan_nu`, `pan_img`, `aadhaar_nu`, `adhar_img`, `passbook_img`, `bank_name`, `bank_ac_no`, `bank_Ifsc`, `bankBrName`, `btc_address`, `nominee_name`, `nominee_address`, `nominee_relationship`, `created_by`, `created_type`, `created_date`, `modify_by`, `modify_date`, `modified_type`) VALUES
(1, 1, '1999-10-01', 282, 298, '481882', '', 'sdr123er', 'uploads/member_document/2d723a67dcf1e2b6a37681a15d37a9c2.jpeg', '0987654321', 'uploads/member_document/5f5f954f9d0cd35716ee1ece43cb5c8b.jpeg', 'uploads/member_document/594d3f21969c8937dabc63f39358e5fd.jpeg', 'gdrews', '1234567890', 'N/Awthh', 'N/Awthh', NULL, 'gtrfe', 'din', 'son', 0, '0', NULL, 2, '2023-10-19 07:40:19', '1'),
(2, 2, '2024-04-10', 282, 298, '847203', '', '12345555', 'uploads/member_document/0ab17dfd6d6ceb162d606ae1adee1ceb.png', '1234556777', 'uploads/member_document/7650829d7248493729035107f873cca2.png', 'uploads/member_document/b8ee699bd05426d2c8d9e898aafb701e.png', 'dgdgdgdgdds', '12345678', 'sgsdgdsg324235', 'gdsgdsgdg', NULL, 'sgsgsg', 'fdggrfggssgsdggg', 'gsgsdgs', 0, '0', NULL, 1, '2024-04-17 11:57:42', '1'),
(3, 10, '2024-04-18', 0, 0, '', '', '', 'uploads/member_document/no_img.png', NULL, 'uploads/member_document/no_img.png', 'uploads/member_document/no_img.png', '', '', '', '', NULL, '', '', '', 0, '0', NULL, 0, NULL, '0'),
(4, 23, '2024-04-18', 0, 0, '', '', '', 'uploads/member_document/no_img.png', NULL, 'uploads/member_document/no_img.png', 'uploads/member_document/no_img.png', '', '', '', '', NULL, '', '', '', 0, '0', NULL, 0, NULL, '0'),
(5, 24, '2024-04-09', 0, 0, '', '', '', 'uploads/member_document/no_img.png', NULL, 'uploads/member_document/no_img.png', 'uploads/member_document/no_img.png', '', '', '', '', NULL, '', '', '', 0, '0', NULL, 0, NULL, '0'),
(6, 25, '2024-04-18', 0, 0, '', '', '', 'uploads/member_document/no_img.png', NULL, 'uploads/member_document/no_img.png', 'uploads/member_document/no_img.png', '', '', '', '', NULL, '', '', '', 0, '0', NULL, 0, NULL, '0'),
(7, 26, '2024-04-18', 0, 0, '', '', '', 'uploads/member_document/no_img.png', NULL, 'uploads/member_document/no_img.png', 'uploads/member_document/no_img.png', '', '', '', '', NULL, '', '', '', 0, '0', NULL, 0, NULL, '0'),
(8, 27, '2024-04-17', 0, 0, '', '', '', 'uploads/member_document/no_img.png', NULL, 'uploads/member_document/no_img.png', 'uploads/member_document/no_img.png', '', '', '', '', NULL, '', '', '', 0, '0', NULL, 0, NULL, '0'),
(9, 28, '2024-04-18', 0, 0, '', '', '', 'uploads/member_document/no_img.png', NULL, 'uploads/member_document/no_img.png', 'uploads/member_document/no_img.png', '', '', '', '', NULL, '', '', '', 0, '0', NULL, 0, NULL, '0'),
(10, 29, '2024-04-18', 0, 0, '', '', '', 'uploads/member_document/no_img.png', NULL, 'uploads/member_document/no_img.png', 'uploads/member_document/no_img.png', '', '', '', '', NULL, '', '', '', 0, '0', NULL, 0, NULL, '0'),
(11, 30, '2024-04-18', 0, 0, '', '', '', 'uploads/member_document/no_img.png', NULL, 'uploads/member_document/no_img.png', 'uploads/member_document/no_img.png', '', '', '', '', NULL, '', '', '', 0, '0', NULL, 0, NULL, '0'),
(12, 31, '2024-04-11', 0, 0, '', '', '', 'uploads/member_document/no_img.png', NULL, 'uploads/member_document/no_img.png', 'uploads/member_document/no_img.png', '', '', '', '', NULL, '', '', '', 0, '0', NULL, 0, NULL, '0'),
(13, 32, '2024-04-19', 0, 0, '', '', '', 'uploads/member_document/no_img.png', NULL, 'uploads/member_document/no_img.png', 'uploads/member_document/no_img.png', '', '', '', '', NULL, '', '', '', 0, '0', NULL, 0, NULL, '0'),
(14, 33, '2024-04-24', 0, 0, '', '', '', 'uploads/member_document/no_img.png', NULL, 'uploads/member_document/no_img.png', 'uploads/member_document/no_img.png', '', '', '', '', NULL, '', '', '', 0, '0', NULL, 0, NULL, '0'),
(15, 34, '2024-04-18', 0, 0, '', '', '', 'uploads/member_document/no_img.png', NULL, 'uploads/member_document/no_img.png', 'uploads/member_document/no_img.png', '', '', '', '', NULL, '', '', '', 0, '0', NULL, 0, NULL, '0'),
(16, 35, '2024-04-18', 0, 0, '', '', '', 'uploads/member_document/no_img.png', NULL, 'uploads/member_document/no_img.png', 'uploads/member_document/no_img.png', '', '', '', '', NULL, '', '', '', 0, '0', NULL, 0, NULL, '0'),
(17, 36, '2024-04-17', 0, 0, '', '', '', 'uploads/member_document/no_img.png', NULL, 'uploads/member_document/no_img.png', 'uploads/member_document/no_img.png', '', '', '', '', NULL, '', '', '', 0, '0', NULL, 0, NULL, '0'),
(18, 37, '2024-04-18', 0, 0, '', '', '', 'uploads/member_document/no_img.png', NULL, 'uploads/member_document/no_img.png', 'uploads/member_document/no_img.png', '', '', '', '', NULL, '', '', '', 0, '0', NULL, 0, NULL, '0'),
(19, 38, '2024-04-18', 0, 0, '', '', '', 'uploads/member_document/no_img.png', NULL, 'uploads/member_document/no_img.png', 'uploads/member_document/no_img.png', '', '', '', '', NULL, '', '', '', 0, '0', NULL, 0, NULL, '0'),
(20, 39, '2024-04-18', 0, 0, '', '', '', 'uploads/member_document/no_img.png', NULL, 'uploads/member_document/no_img.png', 'uploads/member_document/no_img.png', '', '', '', '', NULL, '', '', '', 0, '0', NULL, 0, NULL, '0'),
(21, 40, NULL, 63, 96, '847203', '', '', 'uploads/member_document/no_img.png', NULL, 'uploads/member_document/no_img.png', 'uploads/member_document/no_img.png', '', '', '', '', NULL, '', '', '', 0, '0', NULL, 0, NULL, '0'),
(22, 41, NULL, 63, 96, '847203', '', '', 'uploads/member_document/no_img.png', NULL, 'uploads/member_document/no_img.png', 'uploads/member_document/no_img.png', '', '', '', '', NULL, '', '', '', 0, '0', NULL, 0, NULL, '0'),
(23, 44, NULL, 369, 372, '847203', '', '', 'uploads/member_document/no_img.png', NULL, 'uploads/member_document/no_img.png', 'uploads/member_document/no_img.png', '', '', '', '', NULL, '', '', '', 0, '0', NULL, 0, NULL, '0'),
(24, 45, NULL, 369, 372, '847203', '', '', 'uploads/member_document/no_img.png', NULL, 'uploads/member_document/no_img.png', 'uploads/member_document/no_img.png', '', '', '', '', NULL, '', '', '', 0, '0', NULL, 0, NULL, '0'),
(25, 46, NULL, 369, 372, '847203', '', '', 'uploads/member_document/no_img.png', NULL, 'uploads/member_document/no_img.png', 'uploads/member_document/no_img.png', '', '', '', '', NULL, '', '', '', 0, '0', NULL, 0, NULL, '0'),
(26, 47, NULL, 235, 250, '847203', '', '', 'uploads/member_document/no_img.png', NULL, 'uploads/member_document/no_img.png', 'uploads/member_document/no_img.png', '', '', '', '', NULL, '', '', '', 0, '0', NULL, 0, NULL, '0'),
(27, 48, NULL, 214, 228, '741414141414141', '', '', 'uploads/member_document/no_img.png', NULL, 'uploads/member_document/no_img.png', 'uploads/member_document/no_img.png', '', '', '', '', NULL, '', '', '', 0, '0', NULL, 0, NULL, '0'),
(28, 49, NULL, 379, 382, '847203', '', '', 'uploads/member_document/no_img.png', NULL, 'uploads/member_document/no_img.png', 'uploads/member_document/no_img.png', '', '', '', '', NULL, '', '', '', 0, '0', NULL, 0, NULL, '0'),
(29, 50, NULL, 369, 376, '847203', '', '', 'uploads/member_document/no_img.png', NULL, 'uploads/member_document/no_img.png', 'uploads/member_document/no_img.png', '', '', '', '', NULL, '', '', '', 0, '0', NULL, 0, NULL, '0'),
(30, 51, NULL, 333, 349, '847203', '', '', 'uploads/member_document/no_img.png', NULL, 'uploads/member_document/no_img.png', 'uploads/member_document/no_img.png', '', '', '', '', NULL, '', '', '', 0, '0', NULL, 0, NULL, '0'),
(31, 52, NULL, 235, 250, '847203', '', '', 'uploads/member_document/no_img.png', NULL, 'uploads/member_document/no_img.png', 'uploads/member_document/no_img.png', '', '', '', '', NULL, '', '', '', 0, '0', NULL, 0, NULL, '0'),
(32, 53, NULL, 379, 381, '847203', '', '', 'uploads/member_document/no_img.png', NULL, 'uploads/member_document/no_img.png', 'uploads/member_document/no_img.png', '', '', '', '', NULL, '', '', '', 0, '0', NULL, 0, NULL, '0'),
(33, 54, NULL, 5, 8, '847203', '', '', 'uploads/member_document/no_img.png', NULL, 'uploads/member_document/no_img.png', 'uploads/member_document/no_img.png', '', '', '', '', NULL, '', '', '', 0, '0', NULL, 0, NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `notification_manage`
--

CREATE TABLE `notification_manage` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `subject` varchar(255) NOT NULL,
  `status` enum('active','deactive') NOT NULL DEFAULT 'deactive',
  `created_by` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `modifiy_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `notification_manage`
--

INSERT INTO `notification_manage` (`id`, `message`, `subject`, `status`, `created_by`, `create_date`, `modifiy_by`, `modified_date`) VALUES
(1, 'Means marketing or sales of goods directly to the end user consumer using word of mouth publicity, display and/or demonstrations of the goods/products, and/or distribution of pamphlets.\nCopyright © Taxguru.in', 'Direct Selling', 'active', 1, '2023-10-07 12:25:12', NULL, NULL),
(2, 'Turns out, people check their phones increasingly often and they aren’t turned away by a marketing message or two. In fact, SMS marketing is quickly becoming one of the most effective marketing channels.', 'Awareness', 'active', 1, '2023-10-07 12:25:12', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_cancel`
--

CREATE TABLE `order_cancel` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `paid_amount` float(20,2) NOT NULL,
  `refundable_amount` float(20,2) NOT NULL,
  `refundable_mode` varchar(20) NOT NULL DEFAULT 'upi' COMMENT 'payment mode',
  `refunde_remark` text NOT NULL,
  `refunde_status` int(11) NOT NULL DEFAULT 0 COMMENT '0 not refunded |1 refunded |2 problem in refund',
  `refunde_date` datetime NOT NULL,
  `cancel_remark` text NOT NULL,
  `cancel_date` datetime NOT NULL,
  `p_return_status` int(11) NOT NULL DEFAULT 0 COMMENT '0 not return |1 return',
  `p_return_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoice_id` varchar(150) NOT NULL,
  `member_id` varchar(80) NOT NULL,
  `product_details_id` bigint(20) NOT NULL,
  `product_id` varchar(90) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `productBv` decimal(18,2) NOT NULL,
  `product_selling_price` decimal(18,2) NOT NULL,
  `productTax` decimal(18,2) NOT NULL DEFAULT 0.00,
  `product_mrp` decimal(18,2) NOT NULL,
  `product_qty` varchar(80) NOT NULL,
  `discount` int(11) NOT NULL,
  `total_amount` decimal(18,2) NOT NULL,
  `net_amount` decimal(18,2) NOT NULL,
  `product_pack` varchar(80) NOT NULL,
  `IsDeleted` enum('Yes','No') NOT NULL DEFAULT 'Yes' COMMENT 'Yes,No'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `invoice_id`, `member_id`, `product_details_id`, `product_id`, `product_name`, `productBv`, `product_selling_price`, `productTax`, `product_mrp`, `product_qty`, `discount`, `total_amount`, `net_amount`, `product_pack`, `IsDeleted`) VALUES
(1, 1, 'C02976', '3', 4, '4', 'Noni Hemo', '1000.00', '1800.00', '0.00', '2000.00', '4', 10, '7200.00', '6804.00', '', 'Yes'),
(2, 1, 'C02976', '3', 5, '5', 'Alovera Juice', '1000.00', '400.00', '0.00', '500.00', '5', 20, '2000.00', '1680.00', '', 'Yes'),
(3, 1, 'C02976', '3', 1, '1', 'Relif Pad Regular', '10.00', '180.00', '0.00', '199.00', '5', 50, '900.00', '450.00', '', 'Yes'),
(4, 2, 'Msdr123620', '4', 1, '1', 'Relif Pad Regular', '10.00', '180.00', '0.00', '199.00', '1', 50, '180.00', '90.00', '', 'Yes'),
(5, 2, 'Msdr123620', '4', 4, '4', 'Noni Hemo', '1000.00', '1800.00', '5.00', '2000.00', '1', 10, '1800.00', '1620.00', '', 'Yes'),
(6, 2, 'Msdr123620', '4', 5, '5', 'Alovera Juice', '1000.00', '400.00', '5.00', '500.00', '1', 20, '400.00', '320.00', '', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `order_history`
--

CREATE TABLE `order_history` (
  `id` bigint(20) NOT NULL,
  `invoice_id` varchar(80) NOT NULL,
  `soldBy` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0->from admin,1->from frenchise,2->from shoppe',
  `seller_id` int(11) DEFAULT NULL,
  `customer_id` varchar(80) NOT NULL,
  `grand_total` decimal(18,2) NOT NULL,
  `earnedBv` decimal(18,2) NOT NULL DEFAULT 0.00,
  `paid_amt` decimal(18,2) NOT NULL,
  `tax` decimal(18,2) NOT NULL,
  `shipping_charge` decimal(18,2) NOT NULL,
  `order_date` date NOT NULL,
  `delevery_date` date DEFAULT NULL,
  `IsOrdered` enum('Yes','No','Default') NOT NULL DEFAULT 'Default' COMMENT 'Yes,No,Default',
  `order_status` enum('0','1','2','3') NOT NULL DEFAULT '1' COMMENT '0->cancel,1->placed,2->shipped,3->delivered',
  `approvedBy` int(11) DEFAULT NULL,
  `admnTnx` int(11) DEFAULT NULL,
  `frenchiseTnx` int(11) DEFAULT NULL,
  `shopeTnx` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_history`
--

INSERT INTO `order_history` (`id`, `invoice_id`, `soldBy`, `seller_id`, `customer_id`, `grand_total`, `earnedBv`, `paid_amt`, `tax`, `shipping_charge`, `order_date`, `delevery_date`, `IsOrdered`, `order_status`, `approvedBy`, `admnTnx`, `frenchiseTnx`, `shopeTnx`) VALUES
(1, 'C02976', '0', 1, '3', '8934.00', '9050.00', '8934.00', '5.00', '100.00', '2024-03-13', '2024-03-23', 'Yes', '3', NULL, 13122549, NULL, NULL),
(2, 'Msdr123620', '1', 3, '4', '2333.35', '2010.00', '2127.00', '5.00', '100.00', '2024-03-13', '2024-03-13', 'Default', '3', 3, 13123627, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id` int(11) NOT NULL,
  `pack_name` varchar(255) NOT NULL,
  `pack_price` double(18,2) NOT NULL,
  `b_volume` int(11) NOT NULL,
  `direct_income` varchar(100) DEFAULT NULL,
  `level_income` varchar(200) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0->Inactive,1->Active',
  `created_by` int(11) NOT NULL,
  `create_date` datetime DEFAULT NULL,
  `IsDeleted` enum('Y','N') NOT NULL DEFAULT 'N',
  `isDeletedBy` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modify_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `pack_name`, `pack_price`, `b_volume`, `direct_income`, `level_income`, `status`, `created_by`, `create_date`, `IsDeleted`, `isDeletedBy`, `modified_by`, `modify_date`) VALUES
(1, 'Burly Joining', 1000.00, 0, '50', '200,100,50,30,20,10,10,10,10,10,10', '1', 1, '2023-09-21 17:18:51', 'N', 0, 1, '2024-04-01 12:08:13'),
(6, 'Burly Repurchase', 800.00, 0, '', '120,80,40,24,16,8,8,8,8,8,8', '1', 1, '2023-09-21 17:18:51', 'N', 0, 1, '2024-04-01 12:08:13');

-- --------------------------------------------------------

--
-- Table structure for table `package_purchase`
--

CREATE TABLE `package_purchase` (
  `id` int(11) NOT NULL,
  `pur_type` enum('1','2','3') NOT NULL DEFAULT '1' COMMENT '1->frenchise,2->shopee,3->member',
  `tnx_id` varchar(50) NOT NULL,
  `mem_id` varchar(20) NOT NULL,
  `grndAmt` decimal(18,2) NOT NULL,
  `tax` decimal(18,2) NOT NULL,
  `paid_amt` decimal(18,2) NOT NULL,
  `pur_bv` decimal(18,2) NOT NULL,
  `order_status` enum('Pending','Cancel','Delivered','Hold','Placed') NOT NULL DEFAULT 'Pending',
  `issued_by` enum('0','1','2') NOT NULL COMMENT '0->admin,1->own,2->by_member',
  `created_by` int(11) NOT NULL,
  `purchase_date` datetime NOT NULL,
  `delivery_date` datetime DEFAULT NULL,
  `paid_by` enum('Ewallet','Cash','Net Banking','Cheque') NOT NULL DEFAULT 'Ewallet',
  `paid_status` enum('paid','unpaid') NOT NULL DEFAULT 'unpaid'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `package_purchase_details`
--

CREATE TABLE `package_purchase_details` (
  `id` int(11) NOT NULL,
  `pur_id` int(11) NOT NULL,
  `pur_type` enum('1','2','3') NOT NULL DEFAULT '1' COMMENT '1->frenchise,2->shopee,3->member',
  `pack_id` int(11) NOT NULL,
  `pack_nu` varchar(20) NOT NULL,
  `pack_password` varchar(50) NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `pack_bv` decimal(18,2) NOT NULL,
  `issue_to` varchar(20) NOT NULL,
  `generate_time` datetime NOT NULL,
  `generated_type` enum('0','1','2') NOT NULL DEFAULT '1' COMMENT '0->admin,1->own,2->by_member',
  `generated_by` varchar(15) NOT NULL DEFAULT 'Admin',
  `transfer_by` varchar(20) DEFAULT NULL,
  `used_by` varchar(20) DEFAULT NULL,
  `transfer_time` date DEFAULT NULL,
  `used_date` datetime DEFAULT NULL,
  `status` enum('Used','Un-used') NOT NULL DEFAULT 'Un-used'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` int(11) NOT NULL,
  `user_typ` enum('1','2','3') NOT NULL COMMENT '1->frenchise,2->shoppe,3->other',
  `assigned_seller` varchar(50) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `shop_name` varchar(255) DEFAULT NULL,
  `p_title` varchar(80) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `shw_pass` varchar(200) NOT NULL,
  `address` varchar(400) NOT NULL,
  `registration_ip` varchar(20) NOT NULL,
  `session` char(32) NOT NULL,
  `last_login` int(11) NOT NULL DEFAULT 0,
  `last_login_ip` varchar(20) NOT NULL DEFAULT 'NA',
  `topup` decimal(11,2) NOT NULL DEFAULT 0.00,
  `topup_date` datetime DEFAULT NULL,
  `my_img` varchar(60) DEFAULT 'uploads/user/no_profile.png' COMMENT ' ',
  `status` enum('Block','Active') NOT NULL DEFAULT 'Active',
  `otp` varchar(200) NOT NULL,
  `email_verification` int(11) NOT NULL DEFAULT 0,
  `gift_level` int(11) NOT NULL DEFAULT 0,
  `created_type` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0->admin,1->own user,2->frenchise',
  `create_date` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modify_typ` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0->system,1->own_user,2->frenchise',
  `modify_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `user_typ`, `assigned_seller`, `username`, `shop_name`, `p_title`, `name`, `gender`, `email`, `mobile`, `password`, `shw_pass`, `address`, `registration_ip`, `session`, `last_login`, `last_login_ip`, `topup`, `topup_date`, `my_img`, `status`, `otp`, `email_verification`, `gift_level`, `created_type`, `create_date`, `created_by`, `modified_by`, `modify_typ`, `modify_date`) VALUES
(3, '1', NULL, 'F55555', 'mohan enter prises', 'Mr.', 'amit kumar', 'Male', 'amit@gmail.com', '9789764444', 'e10adc3949ba59abbe56e057f20f883e', '123456', 'patna', '', '', 0, 'NA', '25000.00', '2023-11-16 13:24:28', 'uploads/user/eb84139b37067cfc3021b25320f22efd.jpg', 'Active', '', 0, 0, '0', '2023-11-16 13:24:28', 1, 3, '2', '2024-03-29 10:57:54'),
(4, '2', NULL, 'S67873', 'shoppeeee enterprises', 'Mr.', 'Shoppee', 'Male', 'shopi@gmail.com', '8789842044', 'c4ca4238a0b923820dcc509a6f75849b', '1', '', '', '', 0, 'NA', '10000.00', '2023-12-06 10:11:59', 'uploads/user/e05eec268051ffb2b6b33de708389128.png', 'Active', '', 0, 0, '0', '2023-12-06 10:11:59', 1, 4, '1', '2024-03-29 11:33:31');

-- --------------------------------------------------------

--
-- Table structure for table `partners_basic_manage`
--

CREATE TABLE `partners_basic_manage` (
  `id` int(11) NOT NULL,
  `mem_id` int(11) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `zipcode` varchar(15) NOT NULL,
  `gst_number` varchar(20) NOT NULL,
  `pan_nu` varchar(20) NOT NULL,
  `pan_img` varchar(255) NOT NULL DEFAULT 'uploads/partner_document/no_img.png',
  `aadhaar_nu` int(11) NOT NULL,
  `adhar_img` varchar(255) NOT NULL DEFAULT 'uploads/partner_document/no_img.png ',
  `passbook_img` varchar(255) NOT NULL DEFAULT 'uploads/partner_document/no_img.png',
  `bank_name` varchar(255) NOT NULL,
  `bank_ac_no` varchar(50) NOT NULL,
  `bank_Ifsc` varchar(255) NOT NULL,
  `bankBrName` varchar(255) NOT NULL,
  `btc_address` varchar(255) DEFAULT NULL,
  `nominee_name` varchar(150) NOT NULL,
  `nominee_address` varchar(255) NOT NULL,
  `nominee_relationship` varchar(150) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_type` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0->admin,1->partner',
  `modify_by` int(11) NOT NULL,
  `modify_date` datetime DEFAULT NULL,
  `modified_type` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0->admin,1->own user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `partners_basic_manage`
--

INSERT INTO `partners_basic_manage` (`id`, `mem_id`, `date_of_birth`, `state`, `district`, `zipcode`, `gst_number`, `pan_nu`, `pan_img`, `aadhaar_nu`, `adhar_img`, `passbook_img`, `bank_name`, `bank_ac_no`, `bank_Ifsc`, `bankBrName`, `btc_address`, `nominee_name`, `nominee_address`, `nominee_relationship`, `created_by`, `created_date`, `created_type`, `modify_by`, `modify_date`, `modified_type`) VALUES
(1, 3, '2024-03-12', 0, 0, '', '', '', 'uploads/partner_document/no_img.png', 0, 'uploads/partner_document/no_img.png ', 'uploads/partner_document/no_img.png', '', '', '', '', NULL, '', '', '', 1, '2024-03-29 10:57:35', '0', 0, NULL, '0'),
(2, 4, '2024-03-18', 0, 0, '', '', '', 'uploads/partner_document/no_img.png', 0, 'uploads/partner_document/no_img.png ', 'uploads/partner_document/no_img.png', '', '', '', '', NULL, '', '', '', 1, '2024-03-29 11:22:44', '0', 0, NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `partner_deposit`
--

CREATE TABLE `partner_deposit` (
  `id` bigint(20) NOT NULL,
  `mem_id` bigint(20) NOT NULL,
  `tnx_id` varchar(50) NOT NULL,
  `amount` decimal(18,2) NOT NULL,
  `pay_mode` enum('By cash','By upi','By cheque','By deposit') NOT NULL DEFAULT 'By cash',
  `reason` text DEFAULT NULL,
  `tnx_date` date NOT NULL,
  `tnx_slip` varchar(255) NOT NULL DEFAULT 'uploads/tnx/no_tnx.png',
  `create_date` datetime NOT NULL,
  `aproved_by` bigint(20) DEFAULT NULL,
  `approval_date` datetime DEFAULT NULL,
  `approval_remarks` text DEFAULT NULL,
  `status` enum('Approved','Pending','Hold','Cancel') NOT NULL DEFAULT 'Pending',
  `admin_tnx_type` enum('wallet','pin_purchase','topup','no') NOT NULL DEFAULT 'no',
  `amt_tnx` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `partner_deposit`
--

INSERT INTO `partner_deposit` (`id`, `mem_id`, `tnx_id`, `amount`, `pay_mode`, `reason`, `tnx_date`, `tnx_slip`, `create_date`, `aproved_by`, `approval_date`, `approval_remarks`, `status`, `admin_tnx_type`, `amt_tnx`) VALUES
(1, 3, '11094825', '99999.00', 'By cash', 'testing share here', '2023-12-09', 'uploads/tnx/338292db13c544c9a7a39e9189eb9cb4.jpg', '2023-12-09 11:25:48', NULL, NULL, NULL, 'Pending', 'no', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `partner_earning`
--

CREATE TABLE `partner_earning` (
  `id` int(11) NOT NULL,
  `userid` varchar(20) NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `total_bv` decimal(18,2) NOT NULL DEFAULT 0.00,
  `earnedBv` decimal(18,2) NOT NULL DEFAULT 0.00,
  `type` varchar(255) NOT NULL,
  `ref_id` varchar(20) NOT NULL DEFAULT 'N/A',
  `status` enum('Paid','Pending','Hold') NOT NULL DEFAULT 'Pending',
  `create_date` datetime NOT NULL,
  `approve_date` datetime DEFAULT NULL,
  `pay_request_date` datetime DEFAULT NULL,
  `approved_by` enum('0','1') NOT NULL COMMENT '0->monthly system,1->admin',
  `approval_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `partner_earning`
--

INSERT INTO `partner_earning` (`id`, `userid`, `amount`, `total_bv`, `earnedBv`, `type`, `ref_id`, `status`, `create_date`, `approve_date`, `pay_request_date`, `approved_by`, `approval_id`) VALUES
(1, 'F55555', '2127.00', '0.00', '2010.00', 'Amount credited after product sale of member # S67873', 'After Sale', 'Pending', '2024-03-13 12:36:27', NULL, NULL, '0', NULL),
(2, 'S67873', '90.00', '0.00', '10.00', 'Amount credited after product sale of member # MSD44142', 'After Sale', 'Pending', '2024-03-13 12:45:39', NULL, NULL, '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `partner_stock`
--

CREATE TABLE `partner_stock` (
  `id` bigint(20) NOT NULL,
  `partner_id` int(11) NOT NULL,
  `product_details_id` int(11) NOT NULL,
  `product_price` double(18,2) NOT NULL,
  `product_mrp` double(18,2) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `productBV` decimal(18,2) NOT NULL,
  `lastInStock` int(11) NOT NULL,
  `last_purchase_id` int(11) NOT NULL,
  `stockInDate` date DEFAULT NULL,
  `resonOut` text NOT NULL,
  `stockIncId` int(11) NOT NULL,
  `stockDescId` int(11) NOT NULL,
  `isDeletedBy` int(11) NOT NULL,
  `IsDeleted` enum('N','Y') NOT NULL DEFAULT 'N',
  `created_type` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0->admin,1->partner',
  `created_by` int(11) NOT NULL,
  `modified_type` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0->admin,1->partner',
  `create_date` date DEFAULT NULL,
  `modified_by` int(11) NOT NULL,
  `modify_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `partner_stock`
--

INSERT INTO `partner_stock` (`id`, `partner_id`, `product_details_id`, `product_price`, `product_mrp`, `product_qty`, `productBV`, `lastInStock`, `last_purchase_id`, `stockInDate`, `resonOut`, `stockIncId`, `stockDescId`, `isDeletedBy`, `IsDeleted`, `created_type`, `created_by`, `modified_type`, `create_date`, `modified_by`, `modify_date`) VALUES
(1, 3, 4, 1800.00, 2000.00, 3, '1000.00', 1, 1, '2024-03-13', '', 0, 2, 0, 'N', '0', 1, '1', '2024-03-13', 3, '2024-03-13'),
(2, 3, 5, 400.00, 500.00, 4, '1000.00', 1, 1, '2024-03-13', '', 0, 2, 0, 'N', '0', 1, '1', '2024-03-13', 3, '2024-03-13'),
(3, 3, 1, 180.00, 199.00, 4, '10.00', 1, 1, '2024-03-13', '', 0, 2, 0, 'N', '0', 1, '1', '2024-03-13', 3, '2024-03-13'),
(4, 4, 1, 180.00, 199.00, 0, '0.00', 1, 2, '2024-03-13', '', 2, 1, 0, 'N', '1', 3, '1', '2024-03-13', 4, '2024-03-13'),
(5, 4, 4, 1800.00, 2000.00, 1, '0.00', 1, 2, '2024-03-13', '', 2, 0, 0, 'N', '1', 3, '0', '2024-03-13', 0, NULL),
(6, 4, 5, 400.00, 500.00, 1, '0.00', 1, 2, '2024-03-13', '', 2, 0, 0, 'N', '1', 3, '0', '2024-03-13', 0, NULL),
(7, 1, 1, 180.00, 199.00, 1, '0.00', 1, 1, '2024-03-13', '', 1, 0, 0, 'N', '1', 4, '0', '2024-03-13', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `partner_wallet`
--

CREATE TABLE `partner_wallet` (
  `id` int(11) NOT NULL,
  `userid` varchar(20) NOT NULL,
  `balance` double(18,2) NOT NULL DEFAULT 0.00,
  `type` varchar(20) NOT NULL DEFAULT 'Default'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `partner_wallet`
--

INSERT INTO `partner_wallet` (`id`, `userid`, `balance`, `type`) VALUES
(1, 'F55555', 0.00, 'Default'),
(2, 'S67873', 0.00, 'Default');

-- --------------------------------------------------------

--
-- Table structure for table `partner_wallet_transaction`
--

CREATE TABLE `partner_wallet_transaction` (
  `id` int(11) NOT NULL,
  `tnx_id` int(11) DEFAULT NULL,
  `tnx_typ` enum('0','1','2','3') NOT NULL DEFAULT '0' COMMENT '0->system,1->security,2->repurchase,3->income',
  `user_id` varchar(50) NOT NULL,
  `debit_amt` decimal(18,2) NOT NULL,
  `credit_amt` decimal(18,2) NOT NULL,
  `reason` text DEFAULT NULL,
  `created_by` enum('0','1','2') NOT NULL COMMENT '0->Admin,1->Member,3->System',
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `transfer_id` int(11) NOT NULL,
  `trnx_type` enum('Security','pin_purchase','wallet','earning','purchase') NOT NULL DEFAULT 'earning'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `partner_wallet_transaction`
--

INSERT INTO `partner_wallet_transaction` (`id`, `tnx_id`, `tnx_typ`, `user_id`, `debit_amt`, `credit_amt`, `reason`, `created_by`, `create_date`, `modified_date`, `modified_by`, `transfer_id`, `trnx_type`) VALUES
(1, 13122549, '0', 'F55555', '8934.00', '0.00', 'Amount debited after product purchase', '0', '2024-03-13 12:25:49', NULL, NULL, 0, 'earning'),
(2, 13123627, '0', 'S67873', '2333.35', '0.00', 'Amount debited after product purchase', '0', '2024-03-13 12:36:27', NULL, NULL, 0, 'earning'),
(3, 13123627, '0', 'F55555', '0.00', '2127.00', 'Amount credited after product purchase of member # S67873', '0', '2024-03-13 12:36:27', NULL, NULL, 0, 'earning'),
(4, 13124539, '0', 'S67873', '0.00', '90.00', 'Amount credited after product purchase of member # MSD44142', '0', '2024-03-13 12:45:39', NULL, NULL, 0, 'earning');

-- --------------------------------------------------------

--
-- Table structure for table `partner_withdraw_request`
--

CREATE TABLE `partner_withdraw_request` (
  `id` int(11) NOT NULL,
  `wtnx_id` varchar(50) DEFAULT NULL,
  `userid` varchar(20) NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `tax` decimal(11,2) NOT NULL DEFAULT 0.00,
  `request_date` datetime NOT NULL,
  `status` enum('Paid','Un-Paid','Hold') NOT NULL DEFAULT 'Un-Paid',
  `paid_date` datetime DEFAULT NULL,
  `tid` varchar(200) DEFAULT NULL COMMENT 'Transaction ID or detail',
  `payment_image` varchar(255) NOT NULL DEFAULT 'uploads/tnx/no_tnx.png',
  `paid_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `id` bigint(20) NOT NULL,
  `prod_id` bigint(20) NOT NULL,
  `quantity` varchar(20) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `product_price` double(18,2) NOT NULL COMMENT 'selling price',
  `mrp` double(18,2) NOT NULL,
  `discount` double(18,2) NOT NULL,
  `productBV` decimal(18,2) NOT NULL DEFAULT 0.00,
  `productTax` decimal(18,2) NOT NULL DEFAULT 0.00,
  `product_description` text NOT NULL,
  `exp_date` date DEFAULT NULL,
  `mfg_date` date DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_by` bigint(20) DEFAULT NULL,
  `modify_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`id`, `prod_id`, `quantity`, `unit`, `product_price`, `mrp`, `discount`, `productBV`, `productTax`, `product_description`, `exp_date`, `mfg_date`, `created_by`, `create_date`, `modified_by`, `modify_date`) VALUES
(1, 1, '852', '4', 180.00, 199.00, 50.00, '10.00', '0.00', '', '2026-09-25', '2023-09-25', 1, '2023-09-25 18:09:21', 1, '2024-03-13 06:55:49'),
(2, 2, '683', '6', 500.00, 525.00, 11.00, '45.00', '5.00', '', '2025-09-25', '2023-09-25', 1, '2023-09-25 18:09:33', 1, '2024-03-13 06:31:59'),
(3, 3, '993', '4', 180.00, 199.00, 50.00, '10.00', '0.00', '<p>Description here</p>\r\n', '2026-09-25', '2023-09-25', 1, '2023-09-25 18:09:11', 1, '2024-03-13 06:30:10'),
(4, 4, '968', '4', 1800.00, 2000.00, 10.00, '1000.00', '5.00', '', '2024-03-20', '2024-03-13', 1, '2024-03-13 12:03:25', 1, '2024-03-13 06:55:49'),
(5, 5, '460', '3', 400.00, 500.00, 20.00, '1000.00', '5.00', '', '2026-03-13', '2023-12-01', 1, '2024-03-13 12:03:09', 1, '2024-03-13 06:55:49');

-- --------------------------------------------------------

--
-- Table structure for table `product_table`
--

CREATE TABLE `product_table` (
  `id` bigint(20) NOT NULL,
  `prod_id` varchar(50) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `pro_img` varchar(255) NOT NULL DEFAULT 'uploads/product/no_img.png',
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0->deactive,1->active',
  `created_by` bigint(20) NOT NULL,
  `create_date` datetime DEFAULT NULL,
  `modified_by` bigint(20) NOT NULL,
  `modify_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product_table`
--

INSERT INTO `product_table` (`id`, `prod_id`, `cat_id`, `product_name`, `pro_img`, `status`, `created_by`, `create_date`, `modified_by`, `modify_date`) VALUES
(1, 'MSDRP2525', 8, 'Relif Pad Regular', 'uploads/product/35fc5b7cae2e4866430b139c1776c240.jpg', '1', 1, '2023-09-25 17:42:25', 1, '2023-09-26 13:27:38'),
(2, 'MSDRP2553', 13, 'LeuCovit Delight', 'uploads/product/0ec4a105141c82f1277b6f274b987d80.jpg', '1', 1, '2023-09-25 18:12:53', 1, '2023-10-07 15:39:52'),
(3, 'MSDRP2510', 8, 'Relif Pad XL', 'uploads/product/e141a83755536c3b1369af1f547d2963.jpg', '1', 1, '2023-09-25 18:15:10', 1, '2023-11-02 11:18:43'),
(4, 'MSDRP1349', 13, 'Noni Hemo', 'uploads/product/no_img.png', '1', 1, '2024-03-13 12:08:49', 1, '2024-03-13 12:08:55'),
(5, 'MSDRP1317', 13, 'Alovera Juice', 'uploads/product/no_img.png', '1', 1, '2024-03-13 12:09:17', 1, '2024-03-13 12:09:28');

-- --------------------------------------------------------

--
-- Table structure for table `rank_system`
--

CREATE TABLE `rank_system` (
  `id` int(11) NOT NULL,
  `reward_name` varchar(255) NOT NULL,
  `member_goal` varchar(255) NOT NULL,
  `income` int(11) NOT NULL COMMENT 'in %',
  `other_reward` varchar(150) NOT NULL,
  `monthly_income` decimal(18,2) NOT NULL,
  `membership_type` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0->Temporary,1->Permanent',
  `is_created` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `modify_by` int(11) NOT NULL,
  `modify_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `rank_system`
--

INSERT INTO `rank_system` (`id`, `reward_name`, `member_goal`, `income`, `other_reward`, `monthly_income`, `membership_type`, `is_created`, `create_date`, `modify_by`, `modify_date`) VALUES
(1, 'Normal Member', '0', 0, '0', '0.00', '0', 1, '2023-05-01 13:34:35', 1, '2023-07-24 16:28:58'),
(2, 'Star Club', '6', 6, 'false', '0.00', '0', 1, '2023-05-01 13:34:35', 1, '2023-07-24 16:48:10'),
(3, 'Gold Star Club', '4', 4, 'Kit Bag', '0.00', '0', 1, '2023-05-01 13:34:35', 0, '0000-00-00 00:00:00'),
(4, 'MSDR Star Club', '3', 3, 'false', '0.00', '0', 1, '2023-05-01 13:34:35', 0, '2023-05-11 06:13:51'),
(5, 'MSDR Super Star Club', '2', 2, 'false', '0.00', '0', 1, '2023-05-01 13:34:35', 0, '2023-05-11 06:13:39'),
(6, 'Trainer Club', '2', 2, 'Tablet', '0.00', '0', 1, '2023-05-01 13:34:35', 0, '0000-00-00 00:00:00'),
(7, 'Block Coordinator', '4096', 1, 'false', '3000.00', '1', 1, '2023-05-01 13:34:35', 0, '2023-05-11 06:11:57'),
(8, 'District Member Developer', '16384', 1, 'false', '10000.00', '1', 1, '2023-05-01 13:34:35', 0, '2023-05-11 06:11:50'),
(9, 'District Coordinator', '65336', 1, 'Motorbike', '13000.00', '1', 1, '2023-05-01 13:34:35', 1, '2023-07-24 16:02:25'),
(10, 'Senior District Coordinator', '261344', 1, 'Motor Car', '25000.00', '1', 1, '2023-05-01 13:34:35', 0, '2023-05-11 06:11:32');

-- --------------------------------------------------------

--
-- Table structure for table `rewards`
--

CREATE TABLE `rewards` (
  `id` int(11) NOT NULL,
  `reward_id` varchar(20) NOT NULL,
  `userid` varchar(20) NOT NULL,
  `create_date` datetime NOT NULL,
  `status` enum('Delivered','Pending') NOT NULL DEFAULT 'Pending',
  `paid_date` datetime DEFAULT NULL,
  `tid` text DEFAULT NULL,
  `approval_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `id` int(11) NOT NULL,
  `tnx_id` int(11) DEFAULT NULL,
  `staff_id` varchar(20) NOT NULL,
  `salary` decimal(11,2) NOT NULL,
  `month` varchar(10) NOT NULL,
  `year` varchar(10) NOT NULL,
  `paydate` date NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale_details`
--

CREATE TABLE `sale_details` (
  `id` bigint(20) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoice_id` varchar(150) NOT NULL,
  `member_id` varchar(80) NOT NULL,
  `product_details_id` bigint(20) NOT NULL,
  `product_id` varchar(90) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `productBv` decimal(18,2) NOT NULL,
  `product_selling_price` decimal(18,2) NOT NULL,
  `productTax` decimal(18,2) NOT NULL DEFAULT 0.00,
  `product_mrp` decimal(18,2) NOT NULL,
  `product_qty` varchar(80) NOT NULL,
  `discount` int(11) NOT NULL,
  `total_amount` decimal(18,2) NOT NULL,
  `net_amount` decimal(18,2) NOT NULL,
  `product_pack` varchar(80) NOT NULL,
  `IsDeleted` enum('Yes','No') NOT NULL DEFAULT 'Yes' COMMENT 'Yes,No'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sale_details`
--

INSERT INTO `sale_details` (`id`, `order_id`, `invoice_id`, `member_id`, `product_details_id`, `product_id`, `product_name`, `productBv`, `product_selling_price`, `productTax`, `product_mrp`, `product_qty`, `discount`, `total_amount`, `net_amount`, `product_pack`, `IsDeleted`) VALUES
(1, 1, 'Msdr124534', '1', 1, '1', 'Relif Pad Regular', '10.00', '180.00', '0.00', '199.00', '1', 50, '180.00', '90.00', '', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `sale_history`
--

CREATE TABLE `sale_history` (
  `id` bigint(20) NOT NULL,
  `invoice_id` varchar(80) NOT NULL,
  `soldBy` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0->from admin,1->from frenchise,2->from shoppe',
  `seller_id` int(11) DEFAULT NULL,
  `customer_id` varchar(80) NOT NULL,
  `grand_total` decimal(18,2) NOT NULL,
  `earnedBv` decimal(18,2) NOT NULL DEFAULT 0.00,
  `paid_amt` decimal(18,2) NOT NULL,
  `tax` decimal(18,2) NOT NULL,
  `shipping_charge` decimal(18,2) NOT NULL,
  `order_date` date NOT NULL,
  `delevery_date` date DEFAULT NULL,
  `IsOrdered` enum('Yes','No','Default') NOT NULL DEFAULT 'Default' COMMENT 'Yes,No,Default',
  `order_status` enum('0','1','2','3') NOT NULL DEFAULT '1' COMMENT '0->cancel,1->placed,2->shipped,3->delivered',
  `approvedBy` int(11) DEFAULT NULL,
  `admnTnx` int(11) DEFAULT NULL,
  `frenchiseTnx` int(11) DEFAULT NULL,
  `shopeTnx` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sale_history`
--

INSERT INTO `sale_history` (`id`, `invoice_id`, `soldBy`, `seller_id`, `customer_id`, `grand_total`, `earnedBv`, `paid_amt`, `tax`, `shipping_charge`, `order_date`, `delevery_date`, `IsOrdered`, `order_status`, `approvedBy`, `admnTnx`, `frenchiseTnx`, `shopeTnx`) VALUES
(1, 'Msdr124534', '2', 4, '1', '194.50', '10.00', '90.00', '5.00', '100.00', '2024-03-13', '2024-03-13', 'Default', '3', 4, 13124539, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `states_cities`
--

CREATE TABLE `states_cities` (
  `id` bigint(20) NOT NULL,
  `parent_id` varchar(255) DEFAULT NULL,
  `state_cities` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `states_cities`
--

INSERT INTO `states_cities` (`id`, `parent_id`, `state_cities`) VALUES
(1, '729', 'Andaman and Nicobar'),
(2, '1', 'North and Middle Andaman'),
(3, '1', 'South Andaman'),
(4, '1', 'Nicobar'),
(5, '729', 'Andhra Pradesh'),
(6, '730', 'Adilabad'),
(7, '5', 'Anantapur'),
(8, '5', 'Chittoor'),
(9, '5', 'East Godavari'),
(10, '5', 'Guntur'),
(11, '730', 'Hyderabad'),
(12, '5', 'Kadapa'),
(13, '730', 'Karimnagar'),
(14, '730', 'Khammam'),
(15, '5', 'Krishna'),
(16, '5', 'Kurnool'),
(17, '730', 'Mahbubnagar'),
(18, '730', 'Medak'),
(19, '730', 'Nalgonda'),
(20, '5', 'Nellore'),
(21, '730', 'Nizamabad'),
(22, '5', 'Prakasam'),
(23, '730', 'Rangareddi'),
(24, '5', 'Srikakulam'),
(25, '5', 'Vishakhapatnam'),
(26, '5', 'Vizianagaram'),
(27, '730', 'Warangal'),
(28, '5', 'West Godavari'),
(29, '729', 'Arunachal Pradesh'),
(30, '29', 'Anjaw'),
(31, '29', 'Changlang'),
(32, '29', 'East Kameng'),
(33, '29', 'Lohit'),
(34, '29', 'Lower Subansiri'),
(35, '29', 'Papum Pare'),
(36, '29', 'Tirap'),
(37, '29', 'Dibang Valley'),
(38, '29', 'Upper Subansiri'),
(39, '29', 'West Kameng'),
(40, '729', 'Assam'),
(41, '40', 'Barpeta'),
(42, '40', 'Bongaigaon'),
(43, '40', 'Cachar'),
(44, '40', 'Darrang'),
(45, '40', 'Dhemaji'),
(46, '40', 'Dhubri'),
(47, '40', 'Dibrugarh'),
(48, '40', 'Goalpara'),
(49, '40', 'Golaghat'),
(50, '40', 'Hailakandi'),
(51, '40', 'Jorhat'),
(52, '40', 'Karbi Anglong'),
(53, '40', 'Karimganj'),
(54, '40', 'Kokrajhar'),
(55, '40', 'Lakhimpur'),
(56, '40', 'Marigaon'),
(57, '40', 'Nagaon'),
(58, '40', 'Nalbari'),
(59, '40', 'North Cachar Hills'),
(60, '40', 'Sibsagar'),
(61, '40', 'Sonitpur'),
(62, '40', 'Tinsukia'),
(63, '729', 'Bihar'),
(64, '63', 'Araria'),
(65, '63', 'Aurangabad'),
(66, '63', 'Banka'),
(67, '63', 'Begusarai'),
(68, '63', 'Bhagalpur'),
(69, '63', 'Bhojpur'),
(70, '63', 'Buxar'),
(71, '63', 'Darbhanga'),
(72, '63', 'Purba Champaran'),
(73, '63', 'Gaya'),
(74, '63', 'Gopalganj'),
(75, '63', 'Jamui'),
(76, '63', 'Jehanabad'),
(77, '63', 'Khagaria'),
(78, '63', 'Kishanganj'),
(79, '63', 'Kaimur'),
(80, '63', 'Katihar'),
(81, '63', 'Lakhisarai'),
(82, '63', 'Madhubani'),
(83, '63', 'Munger'),
(84, '63', 'Madhepura'),
(85, '63', 'Muzaffarpur'),
(86, '63', 'Nalanda'),
(87, '63', 'Nawada'),
(88, '63', 'Patna'),
(89, '63', 'Purnia'),
(90, '63', 'Rohtas'),
(91, '63', 'Saharsa'),
(92, '63', 'Samastipur'),
(93, '63', 'Sheohar'),
(94, '63', 'Sheikhpura'),
(95, '63', 'Saran'),
(96, '63', 'Sitamarhi'),
(97, '63', 'Supaul'),
(98, '63', 'Siwan'),
(99, '63', 'Vaishali'),
(100, '63', 'Pashchim Champaran'),
(101, 'Chandigarh', ''),
(102, '729', 'Chhattisgarh'),
(103, '102', 'Bastar'),
(104, '102', 'Bilaspur'),
(105, '102', 'Dantewada'),
(106, '102', 'Dhamtari'),
(107, '102', 'Durg'),
(108, '102', 'Jashpur'),
(109, '102', 'Janjgir-Champa'),
(110, '102', 'Korba'),
(111, '102', 'Koriya'),
(112, '102', 'Kanker'),
(113, '102', 'Kawardha'),
(114, '102', 'Mahasamund'),
(115, '102', 'Raigarh'),
(116, '102', 'Rajnandgaon'),
(117, '102', 'Raipur'),
(118, '102', 'Surguja'),
(119, 'Dadra and Nagar Haveli', NULL),
(120, 'Daman and Diu', NULL),
(121, 'Daman and Diu', 'Diu'),
(122, 'Daman and Diu', 'Daman'),
(123, '729', 'Delhi'),
(124, '123', 'Central Delhi'),
(125, '123', 'East Delhi'),
(126, '123', 'New Delhi'),
(127, '123', 'North Delhi'),
(128, '123', 'North East Delhi'),
(129, '123', 'North West Delhi'),
(130, '123', 'South Delhi'),
(131, '123', 'South West Delhi'),
(132, '123', 'West Delhi'),
(133, '729', 'Goa'),
(134, '133', 'North Goa'),
(135, '133', 'South Goa'),
(136, '729', 'Gujarat'),
(137, '136', 'Ahmedabad'),
(138, '136', 'Amreli District'),
(139, '136', 'Anand'),
(140, '136', 'Banaskantha'),
(141, '136', 'Bharuch'),
(142, '136', 'Bhavnagar'),
(143, '136', 'Dahod'),
(144, '136', 'The Dangs'),
(145, '136', 'Gandhinagar'),
(146, '136', 'Jamnagar'),
(147, '136', 'Junagadh'),
(148, '136', 'Kutch'),
(149, '136', 'Kheda'),
(150, '136', 'Mehsana'),
(151, '136', 'Narmada'),
(152, '136', 'Navsari'),
(153, '136', 'Patan'),
(154, '136', 'Panchmahal'),
(155, '136', 'Porbandar'),
(156, '136', 'Rajkot'),
(157, '136', 'Sabarkantha'),
(158, '136', 'Surendranagar'),
(159, '136', 'Surat'),
(160, '136', 'Vadodara'),
(161, '136', 'Valsad'),
(162, '729', 'Haryana'),
(163, '162', 'Ambala'),
(164, '162', 'Bhiwani'),
(165, '162', 'Faridabad'),
(166, '162', 'Fatehabad'),
(167, '162', 'Gurgaon'),
(168, '162', 'Hissar'),
(169, '162', 'Jhajjar'),
(170, '162', 'Jind'),
(171, '162', 'Karnal'),
(172, '162', 'Kaithal'),
(173, '162', 'Kurukshetra'),
(174, '162', 'Mahendragarh'),
(175, '162', 'Mewat'),
(176, '162', 'Panchkula'),
(177, '162', 'Panipat'),
(178, '162', 'Rewari'),
(179, '162', 'Rohtak'),
(180, '162', 'Sirsa'),
(181, '162', 'Sonepat'),
(182, '162', 'Yamuna Nagar'),
(183, '162', 'Palwal'),
(184, '729', 'Himachal Pradesh'),
(185, '184', 'Bilaspur'),
(186, '184', 'Chamba'),
(187, '184', 'Hamirpur'),
(188, '184', 'Kangra'),
(189, '184', 'Kinnaur'),
(190, '184', 'Kulu'),
(191, '184', 'Lahaul and Spiti'),
(192, '184', 'Mandi'),
(193, '184', 'Shimla'),
(194, '184', 'Sirmaur'),
(195, '184', 'Solan'),
(196, '184', 'Una'),
(197, '729', 'Jammu and Kashmir'),
(198, '197', 'Anantnag'),
(199, '197', 'Badgam'),
(200, '197', 'Bandipore'),
(201, '197', 'Baramula'),
(202, '197', 'Doda'),
(203, '197', 'Jammu'),
(204, '197', 'Kargil'),
(205, '197', 'Kathua'),
(206, '197', 'Kupwara'),
(207, '197', 'Leh'),
(208, '197', 'Poonch'),
(209, '197', 'Pulwama'),
(210, '197', 'Rajauri'),
(211, '197', 'Srinagar'),
(212, '197', 'Samba'),
(213, '197', 'Udhampur'),
(214, '729', 'Jharkhand'),
(215, '214', 'Bokaro'),
(216, '214', 'Chatra'),
(217, '214', 'Deoghar'),
(218, '214', 'Dhanbad'),
(219, '214', 'Dumka'),
(220, '214', 'Purba Singhbhum'),
(221, '214', 'Garhwa'),
(222, '214', 'Giridih'),
(223, '214', 'Godda'),
(224, '214', 'Gumla'),
(225, '214', 'Hazaribagh'),
(226, '214', 'Koderma'),
(227, '214', 'Lohardaga'),
(228, '214', 'Pakur'),
(229, '214', 'Palamu'),
(230, '214', 'Ranchi'),
(231, '214', 'Sahibganj'),
(232, '214', 'Seraikela and Kharsawan'),
(233, '214', 'Pashchim Singhbhum'),
(234, '214', 'Ramgarh'),
(235, '729', 'Karnataka'),
(236, '235', 'Bidar'),
(237, '235', 'Belgaum'),
(238, '235', 'Bijapur'),
(239, '235', 'Bagalkot'),
(240, '235', 'Bellary'),
(241, '235', 'Bangalore Rural District'),
(242, '235', 'Bangalore Urban District'),
(243, '235', 'Chamarajnagar'),
(244, '235', 'Chikmagalur'),
(245, '235', 'Chitradurga'),
(246, '235', 'Davanagere'),
(247, '235', 'Dharwad'),
(248, '235', 'Dakshina Kannada'),
(249, '235', 'Gadag'),
(250, '235', 'Gulbarga'),
(251, '235', 'Hassan'),
(252, '235', 'Haveri District'),
(253, '235', 'Kodagu'),
(254, '235', 'Kolar'),
(255, '235', 'Koppal'),
(256, '235', 'Mandya'),
(257, '235', 'Mysore'),
(258, '235', 'Raichur'),
(259, '235', 'Shimoga'),
(260, '235', 'Tumkur'),
(261, '235', 'Udupi'),
(262, '235', 'Uttara Kannada'),
(263, '235', 'Ramanagara'),
(264, '235', 'Chikballapur'),
(265, '235', 'Yadagiri'),
(266, '729', 'Kerala'),
(267, '266', 'Alappuzha'),
(268, '266', 'Ernakulam'),
(269, '266', 'Idukki'),
(270, '266', 'Kollam'),
(271, '266', 'Kannur'),
(272, '266', 'Kasaragod'),
(273, '266', 'Kottayam'),
(274, '266', 'Kozhikode'),
(275, '266', 'Malappuram'),
(276, '266', 'Palakkad'),
(277, '266', 'Pathanamthitta'),
(278, '266', 'Thrissur'),
(279, '266', 'Thiruvananthapuram'),
(280, '266', 'Wayanad'),
(281, 'Lakshadweep', NULL),
(282, '729', 'Madhya Pradesh'),
(283, '282', 'Alirajpur'),
(284, '282', 'Anuppur'),
(285, '282', 'Ashok Nagar'),
(286, '282', 'Balaghat'),
(287, '282', 'Barwani'),
(288, '282', 'Betul'),
(289, '282', 'Bhind'),
(290, '282', 'Bhopal'),
(291, '282', 'Burhanpur'),
(292, '282', 'Chhatarpur'),
(293, '282', 'Chhindwara'),
(294, '282', 'Damoh'),
(295, '282', 'Datia'),
(296, '282', 'Dewas'),
(297, '282', 'Dhar'),
(298, '282', 'Dindori'),
(299, '282', 'Guna'),
(300, '282', 'Gwalior'),
(301, '282', 'Harda'),
(302, '282', 'Hoshangabad'),
(303, '282', 'Indore'),
(304, '282', 'Jabalpur'),
(305, '282', 'Jhabua'),
(306, '282', 'Katni'),
(307, '282', 'Khandwa'),
(308, '282', 'Khargone'),
(309, '282', 'Mandla'),
(310, '282', 'Mandsaur'),
(311, '282', 'Morena'),
(312, '282', 'Narsinghpur'),
(313, '282', 'Neemuch'),
(314, '282', 'Panna'),
(315, '282', 'Rewa'),
(316, '282', 'Rajgarh'),
(317, '282', 'Ratlam'),
(318, '282', 'Raisen'),
(319, '282', 'Sagar'),
(320, '282', 'Satna'),
(321, '282', 'Sehore'),
(322, '282', 'Seoni'),
(323, '282', 'Shahdol'),
(324, '282', 'Shajapur'),
(325, '282', 'Sheopur'),
(326, '282', 'Shivpuri'),
(327, '282', 'Sidhi'),
(328, '282', 'Singrauli'),
(329, '282', 'Tikamgarh'),
(330, '282', 'Ujjain'),
(331, '282', 'Umaria'),
(332, '282', 'Vidisha'),
(333, '729', 'Maharashtra'),
(334, '333', 'Ahmednagar'),
(335, '333', 'Akola'),
(336, '333', 'Amrawati'),
(337, '333', 'Aurangabad'),
(338, '333', 'Bhandara'),
(339, '333', 'Beed'),
(340, '333', 'Buldhana'),
(341, '333', 'Chandrapur'),
(342, '333', 'Dhule'),
(343, '333', 'Gadchiroli'),
(344, '333', 'Gondiya'),
(345, '333', 'Hingoli'),
(346, '333', 'Jalgaon'),
(347, '333', 'Jalna'),
(348, '333', 'Kolhapur'),
(349, '333', 'Latur'),
(350, '333', 'Mumbai City'),
(351, '333', 'Mumbai suburban'),
(352, '333', 'Nandurbar'),
(353, '333', 'Nanded'),
(354, '333', 'Nagpur'),
(355, '333', 'Nashik'),
(356, '333', 'Osmanabad'),
(357, '333', 'Parbhani'),
(358, '333', 'Pune'),
(359, '333', 'Raigad'),
(360, '333', 'Ratnagiri'),
(361, '333', 'Sindhudurg'),
(362, '333', 'Sangli'),
(363, '333', 'Solapur'),
(364, '333', 'Satara'),
(365, '333', 'Thane'),
(366, '333', 'Wardha'),
(367, '333', 'Washim'),
(368, '333', 'Yavatmal'),
(369, '729', 'Manipur'),
(370, '369', 'Bishnupur'),
(371, '369', 'Churachandpur'),
(372, '369', 'Chandel'),
(373, '369', 'Imphal East'),
(374, '369', 'Senapati'),
(375, '369', 'Tamenglong'),
(376, '369', 'Thoubal'),
(377, '369', 'Ukhrul'),
(378, '369', 'Imphal West'),
(379, '729', 'Meghalaya'),
(380, '379', 'East Garo Hills'),
(381, '379', 'East Khasi Hills'),
(382, '379', 'Jaintia Hills'),
(383, '379', 'Ri-Bhoi'),
(384, '379', 'South Garo Hills'),
(385, '379', 'West Garo Hills'),
(386, '379', 'West Khasi Hills'),
(387, '729', 'Mizoram'),
(388, '387', 'Aizawl'),
(389, '387', 'Champhai'),
(390, '387', 'Kolasib'),
(391, '387', 'Lawngtlai'),
(392, '387', 'Lunglei'),
(393, '387', 'Mamit'),
(394, '387', 'Saiha'),
(395, '387', 'Serchhip'),
(396, '729', 'Nagaland'),
(397, '396', 'Dimapur'),
(398, '396', 'Kohima'),
(399, '396', 'Mokokchung'),
(400, '396', 'Mon'),
(401, '396', 'Phek'),
(402, '396', 'Tuensang'),
(403, '396', 'Wokha'),
(404, '396', 'Zunheboto'),
(405, '729', 'Orissa'),
(406, '405', 'Angul'),
(407, '405', 'Boudh'),
(408, '405', 'Bhadrak'),
(409, '405', 'Bolangir'),
(410, '405', 'Bargarh'),
(411, '405', 'Baleswar'),
(412, '405', 'Cuttack'),
(413, '405', 'Debagarh'),
(414, '405', 'Dhenkanal'),
(415, '405', 'Ganjam'),
(416, '405', 'Gajapati'),
(417, '405', 'Jharsuguda'),
(418, '405', 'Jajapur'),
(419, '405', 'Jagatsinghpur'),
(420, '405', 'Khordha'),
(421, '405', 'Kendujhar'),
(422, '405', 'Kalahandi'),
(423, '405', 'Kandhamal'),
(424, '405', 'Koraput'),
(425, '405', 'Kendrapara'),
(426, '405', 'Malkangiri'),
(427, '405', 'Mayurbhanj'),
(428, '405', 'Nabarangpur'),
(429, '405', 'Nuapada'),
(430, '405', 'Nayagarh'),
(431, '405', 'Puri'),
(432, '405', 'Rayagada'),
(433, '405', 'Sambalpur'),
(434, '405', 'Subarnapur'),
(435, '405', 'Sundargarh'),
(436, 'Puducherry', NULL),
(437, 'Puducherry', 'Karaikal'),
(438, 'Puducherry', 'Mahe'),
(439, 'Puducherry', 'Puducherry'),
(440, 'Puducherry', 'Yanam'),
(441, '729', 'Punjab'),
(442, '441', 'Amritsar'),
(443, '441', 'Bathinda'),
(444, '441', 'Firozpur'),
(445, '441', 'Faridkot'),
(446, '441', 'Fatehgarh Sahib'),
(447, '441', 'Gurdaspur'),
(448, '441', 'Hoshiarpur'),
(449, '441', 'Jalandhar'),
(450, '441', 'Kapurthala'),
(451, '441', 'Ludhiana'),
(452, '441', 'Mansa'),
(453, '441', 'Moga'),
(454, '441', 'Mukatsar'),
(455, '441', 'Nawan Shehar'),
(456, '441', 'Patiala'),
(457, '441', 'Rupnagar'),
(458, '441', 'Sangrur'),
(459, '729', 'Rajasthan'),
(460, '459', 'Ajmer'),
(461, '459', 'Alwar'),
(462, '459', 'Bikaner'),
(463, '459', 'Barmer'),
(464, '459', 'Banswara'),
(465, '459', 'Bharatpur'),
(466, '459', 'Baran'),
(467, '459', 'Bundi'),
(468, '459', 'Bhilwara'),
(469, '459', 'Churu'),
(470, '459', 'Chittorgarh'),
(471, '459', 'Dausa'),
(472, '459', 'Dholpur'),
(473, '459', 'Dungapur'),
(474, '459', 'Ganganagar'),
(475, '459', 'Hanumangarh'),
(476, '459', 'Juhnjhunun'),
(477, '459', 'Jalore'),
(478, '459', 'Jodhpur'),
(479, '459', 'Jaipur'),
(480, '459', 'Jaisalmer'),
(481, '459', 'Jhalawar'),
(482, '459', 'Karauli'),
(483, '459', 'Kota'),
(484, '459', 'Nagaur'),
(485, '459', 'Pali'),
(486, '459', 'Pratapgarh'),
(487, '459', 'Rajsamand'),
(488, '459', 'Sikar'),
(489, '459', 'Sawai Madhopur'),
(490, '459', 'Sirohi'),
(491, '459', 'Tonk'),
(492, '459', 'Udaipur'),
(493, '729', 'Sikkim'),
(494, '493', 'East Sikkim'),
(495, '493', 'North Sikkim'),
(496, '493', 'South Sikkim'),
(497, '493', 'West Sikkim'),
(498, '729', 'Tamil Nadu'),
(499, '498', 'Ariyalur'),
(500, '498', 'Chennai'),
(501, '498', 'Coimbatore'),
(502, '498', 'Cuddalore'),
(503, '498', 'Dharmapuri'),
(504, '498', 'Dindigul'),
(505, '498', 'Erode'),
(506, '498', 'Kanchipuram'),
(507, '498', 'Kanyakumari'),
(508, '498', 'Karur'),
(509, '498', 'Madurai'),
(510, '498', 'Nagapattinam'),
(511, '498', 'The Nilgiris'),
(512, '498', 'Namakkal'),
(513, '498', 'Perambalur'),
(514, '498', 'Pudukkottai'),
(515, '498', 'Ramanathapuram'),
(516, '498', 'Salem'),
(517, '498', 'Sivagangai'),
(518, '498', 'Tiruppur'),
(519, '498', 'Tiruchirappalli'),
(520, '498', 'Theni'),
(521, '498', 'Tirunelveli'),
(522, '498', 'Thanjavur'),
(523, '498', 'Thoothukudi'),
(524, '498', 'Thiruvallur'),
(525, '498', 'Thiruvarur'),
(526, '498', 'Tiruvannamalai'),
(527, '498', 'Vellore'),
(528, '498', 'Villupuram'),
(529, '729', 'Tripura'),
(530, '529', 'Dhalai'),
(531, '529', 'North Tripura'),
(532, '529', 'South Tripura'),
(533, '529', 'West Tripura'),
(534, '729', 'Uttarakhand'),
(535, '534', 'Almora'),
(536, '534', 'Bageshwar'),
(537, '534', 'Chamoli'),
(538, '534', 'Champawat'),
(539, '534', 'Dehradun'),
(540, '534', 'Haridwar'),
(541, '534', 'Nainital'),
(542, '534', 'Pauri Garhwal'),
(543, '534', 'Pithoragharh'),
(544, '534', 'Rudraprayag'),
(545, '534', 'Tehri Garhwal'),
(546, '534', 'Udham Singh Nagar'),
(547, '534', 'Uttarkashi'),
(548, '729', 'Uttar Pradesh'),
(549, '548', 'Agra'),
(550, '548', 'Allahabad'),
(551, '548', 'Aligarh'),
(552, '548', 'Ambedkar Nagar'),
(553, '548', 'Auraiya'),
(554, '548', 'Azamgarh'),
(555, '548', 'Barabanki'),
(556, '548', 'Badaun'),
(557, '548', 'Bagpat'),
(558, '548', 'Bahraich'),
(559, '548', 'Bijnor'),
(560, '548', 'Ballia'),
(561, '548', 'Banda'),
(562, '548', 'Balrampur'),
(563, '548', 'Bareilly'),
(564, '548', 'Basti'),
(565, '548', 'Bulandshahr'),
(566, '548', 'Chandauli'),
(567, '548', 'Chitrakoot'),
(568, '548', 'Deoria'),
(569, '548', 'Etah'),
(570, '548', 'Kanshiram Nagar'),
(571, '548', 'Etawah'),
(572, '548', 'Firozabad'),
(573, '548', 'Farrukhabad'),
(574, '548', 'Fatehpur'),
(575, '548', 'Faizabad'),
(576, '548', 'Gautam Buddha Nagar'),
(577, '548', 'Gonda'),
(578, '548', 'Ghazipur'),
(579, '548', 'Gorkakhpur'),
(580, '548', 'Ghaziabad'),
(581, '548', 'Hamirpur'),
(582, '548', 'Hardoi'),
(583, '548', 'Mahamaya Nagar'),
(584, '548', 'Jhansi'),
(585, '548', 'Jalaun'),
(586, '548', 'Jyotiba Phule Nagar'),
(587, '548', 'Jaunpur District'),
(588, '548', 'Kanpur Dehat'),
(589, '548', 'Kannauj'),
(590, '548', 'Kanpur Nagar'),
(591, '548', 'Kaushambi'),
(592, '548', 'Kushinagar'),
(593, '548', 'Lalitpur'),
(594, '548', 'Lakhimpur Kheri'),
(595, '548', 'Lucknow'),
(596, '548', 'Mau'),
(597, '548', 'Meerut'),
(598, '548', 'Maharajganj'),
(599, '548', 'Mahoba'),
(600, '548', 'Mirzapur'),
(601, '548', 'Moradabad'),
(602, '548', 'Mainpuri'),
(603, '548', 'Mathura'),
(604, '548', 'Muzaffarnagar'),
(605, '548', 'Pilibhit'),
(606, '548', 'Pratapgarh'),
(607, '548', 'Rampur'),
(608, '548', 'Rae Bareli'),
(609, '548', 'Saharanpur'),
(610, '548', 'Sitapur'),
(611, '548', 'Shahjahanpur'),
(612, '548', 'Sant Kabir Nagar'),
(613, '548', 'Siddharthnagar'),
(614, '548', 'Sonbhadra'),
(615, '548', 'Sant Ravidas Nagar'),
(616, '548', 'Sultanpur'),
(617, '548', 'Shravasti'),
(618, '548', 'Unnao'),
(619, '548', 'Varanasi'),
(620, '729', 'West Bengal'),
(621, '620', 'Birbhum'),
(622, '620', 'Bankura'),
(623, '620', 'Bardhaman'),
(624, '620', 'Darjeeling'),
(625, '620', 'Dakshin Dinajpur'),
(626, '620', 'Hooghly'),
(627, '620', 'Howrah'),
(628, '620', 'Jalpaiguri'),
(629, '620', 'Cooch Behar'),
(630, '620', 'Kolkata'),
(631, '620', 'Malda'),
(632, '620', 'Midnapore'),
(633, '620', 'Murshidabad'),
(634, '620', 'Nadia'),
(635, '620', 'North 24 Parganas'),
(636, '620', 'South 24 Parganas'),
(637, '620', 'Purulia'),
(638, '620', 'Uttar Dinajpur'),
(639, '0', 'Bangladesh'),
(640, '639', 'Rajshahi'),
(641, '639', 'Barisal'),
(642, '639', 'Chittagong'),
(643, '639', 'Dhaka'),
(644, '639', 'Khulna'),
(645, '639', 'Rangpur'),
(646, '639', 'Sylhet'),
(647, '640', 'Joypurhat'),
(648, '640', 'Kalai'),
(649, '640', 'Khetlal'),
(650, '640', 'Akkelpur'),
(651, '640', 'Panchbibi'),
(652, '640', 'Bogra'),
(653, '640', 'Naogaon'),
(654, '640', 'Natore'),
(655, '640', 'Nawabganj'),
(656, '640', 'Pabna'),
(657, '640', 'Sirajganj'),
(658, '640', 'Shahjadpur'),
(659, '640', 'Ullapara'),
(660, '640', 'Iswardi'),
(661, '640', 'Santhia'),
(662, '640', 'Sherpur'),
(663, '641', 'Bakerganj'),
(664, '641', 'Barguna'),
(665, '641', 'Bhola'),
(666, '641', 'Gaurnadi'),
(667, '641', 'Jhalokati'),
(668, '641', 'Patuakhali'),
(669, '641', 'Pirojpur'),
(670, '642', 'Akhaura'),
(671, '642', 'Cox\'s Bazar'),
(672, '642', 'Bandarban'),
(673, '642', 'Brahmanbaria'),
(674, '642', 'Sarail'),
(675, '642', 'Shahbazpur Town'),
(676, '642', 'Chandpur'),
(677, '642', 'Chaumuhani'),
(678, '642', 'Feni'),
(679, '642', 'Khagrachhari'),
(680, '642', 'Laksam'),
(681, '642', 'Lakshmipur'),
(682, '642', 'Noakhali'),
(683, '642', 'Rangamati'),
(684, '642', 'Rangunia'),
(685, '642', 'Sandwip'),
(686, '642', 'Comilla'),
(687, '642', 'Burichong'),
(688, '643', 'Aricha'),
(689, '643', 'Bhairab'),
(690, '643', 'Faridpur'),
(691, '643', 'Jamalpur'),
(692, '643', 'Kishoreganj'),
(693, '643', 'Manikganj'),
(694, '643', 'Madaripur'),
(695, '643', 'Munshiganj'),
(696, '643', 'Mymensingh'),
(697, '643', 'Narsingdi'),
(698, '643', 'Netrokona'),
(699, '643', 'Rajbari'),
(700, '643', 'Shariatpur'),
(701, '643', 'Sherpur'),
(702, '643', 'Tangail'),
(703, '643', 'Tongi'),
(704, '643', 'Gopalganj'),
(705, '644', 'Bagherhat'),
(706, '644', 'Chuadanga'),
(707, '644', 'Jessore'),
(708, '644', 'Jhenaidah'),
(709, '644', 'Kushtia'),
(710, '644', 'Magura'),
(711, '644', 'Meherpur'),
(712, '644', 'Narail'),
(713, '644', 'Shatkhira'),
(714, '645', 'Gaibandha'),
(715, '645', 'Dinajpur'),
(716, '645', 'Kurigram'),
(717, '645', 'Lalmonirhat'),
(718, '645', 'Nilphamari'),
(719, '645', 'Panchagarh'),
(720, '645', 'Thakurgaon'),
(721, '645', 'Saidpur'),
(722, '646', 'Golapganj'),
(723, '646', 'Habiganj'),
(724, '646', 'Maulvibazar'),
(725, '646', 'Sreemangal'),
(726, '646', 'Sunamganj'),
(727, '646', 'Beanibazar'),
(728, '646', 'Barlekha'),
(729, '0', 'India'),
(730, '729', 'Telangana');

-- --------------------------------------------------------

--
-- Table structure for table `system_config`
--

CREATE TABLE `system_config` (
  `id` int(11) NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `company_address` text NOT NULL,
  `company_url` varchar(200) NOT NULL,
  `default_timezone` int(11) NOT NULL,
  `session_timeout` int(11) NOT NULL,
  `inactive_timeout` int(11) NOT NULL,
  `max_file_size` int(11) NOT NULL,
  `allowed_file_types` varchar(200) NOT NULL,
  `default_time_format` varchar(100) NOT NULL,
  `default_date_format` varchar(100) NOT NULL,
  `default_date_time_format` varchar(100) NOT NULL,
  `updates_enabled` int(11) NOT NULL,
  `error_reporting` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `system_config`
--

INSERT INTO `system_config` (`id`, `company_name`, `company_address`, `company_url`, `default_timezone`, `session_timeout`, `inactive_timeout`, `max_file_size`, `allowed_file_types`, `default_time_format`, `default_date_format`, `default_date_time_format`, `updates_enabled`, `error_reporting`) VALUES
(1, 'MSDR Global Marketing PVT. LTD.', ' ISBT Bus stand, Near Deendayal Chowk, Infront Nema Heart <br>Hospital,Shri Balaji Heights Building Flat No.211,<br> 2nd Floor, jabalpur (M.P.)- 482002<br>Customer Care: 9630254884 , 9993712416 ', 'http://msdr.live/', 49, 60, 0, 10000000, 'jpg,JPG,JPEG,jpeg,png,PNG,GIF,gif,doc,DOC,docx,DOCX,pdf,PDF,RAR,rar,ZIP,zip', 'h:i:A', 'j M, Y', 'd-m-Y h:i:s A', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `system_ranklog`
--

CREATE TABLE `system_ranklog` (
  `id` bigint(20) NOT NULL,
  `create_date` datetime DEFAULT NULL,
  `rank_session` enum('1','2') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `system_ranklog`
--

INSERT INTO `system_ranklog` (`id`, `create_date`, `rank_session`) VALUES
(1, '2023-04-02 10:49:48', '1');

-- --------------------------------------------------------

--
-- Table structure for table `temp_package_purchase`
--

CREATE TABLE `temp_package_purchase` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `pur_type` enum('1','2','3') NOT NULL DEFAULT '1' COMMENT '1->frenchise.2->shopee,3->member',
  `pack_id` int(11) NOT NULL,
  `pack_qty` int(11) NOT NULL,
  `pack_amt` decimal(18,2) NOT NULL DEFAULT 0.00,
  `pack_bv` decimal(18,2) NOT NULL,
  `tax` decimal(18,2) NOT NULL,
  `grand_total` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temp_product_details`
--

CREATE TABLE `temp_product_details` (
  `id` bigint(20) NOT NULL,
  `member_id` varchar(90) NOT NULL,
  `soldBy` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0->admin,1->from frenchise,2->from shoppe',
  `seller_id` int(11) DEFAULT NULL,
  `product_details_id` bigint(20) NOT NULL,
  `product_id` varchar(90) NOT NULL,
  `p_unit` varchar(20) NOT NULL,
  `product_name` varchar(90) NOT NULL,
  `productBV` decimal(18,2) NOT NULL,
  `product_selling_price` decimal(18,2) NOT NULL,
  `product_mrp` decimal(18,2) NOT NULL,
  `product_qty` varchar(90) NOT NULL,
  `discount` int(11) NOT NULL COMMENT 'discount in percentage',
  `productTax` decimal(18,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(18,2) NOT NULL,
  `net_amount` decimal(18,2) NOT NULL COMMENT 'net_amount=total_amount-discount%',
  `receiver_typ` enum('0','1','2','3') NOT NULL DEFAULT '0' COMMENT '0->admin,1->frenchise,2->shopee,3->member'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `temp_product_details`
--

INSERT INTO `temp_product_details` (`id`, `member_id`, `soldBy`, `seller_id`, `product_details_id`, `product_id`, `p_unit`, `product_name`, `productBV`, `product_selling_price`, `product_mrp`, `product_qty`, `discount`, `productTax`, `total_amount`, `net_amount`, `receiver_typ`) VALUES
(1, '4', '0', NULL, 1, '1', 'Pcs.', 'Relif Pad Regular', '10.00', '180.00', '199.00', '12', 50, '0.00', '2160.00', '1080.00', '2');

-- --------------------------------------------------------

--
-- Table structure for table `unit_manage`
--

CREATE TABLE `unit_manage` (
  `id` int(11) NOT NULL,
  `unitId` varchar(25) NOT NULL,
  `unit_name` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0->Inactive,1->Active',
  `created_by` int(11) NOT NULL,
  `create_date` datetime DEFAULT NULL,
  `IsDeleted` enum('Y','N') NOT NULL DEFAULT 'N',
  `isDeletedBy` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modify_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `unit_manage`
--

INSERT INTO `unit_manage` (`id`, `unitId`, `unit_name`, `status`, `created_by`, `create_date`, `IsDeleted`, `isDeletedBy`, `modified_by`, `modify_date`) VALUES
(2, 'MSDRU1219', 'Kgs.', '1', 1, '2023-07-12 10:55:19', 'N', 0, 1, '2023-09-08 13:31:57'),
(3, 'MSDRU1237', 'Ml', '1', 1, '2023-07-12 10:56:37', 'N', 0, 1, '2023-09-08 13:31:56'),
(4, 'MSDRU1251', 'Pcs.', '1', 1, '2023-07-12 10:56:51', 'N', 0, 1, '2023-09-08 13:31:55'),
(5, 'MSDRU3010', 'litre', '1', 1, '2023-08-30 15:58:10', 'N', 0, 1, '2023-09-08 13:31:55'),
(6, 'MSDRU2536', 'Bx.', '1', 1, '2023-09-25 18:16:36', 'N', 0, 1, '2023-09-26 17:10:52');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `user` varchar(100) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `ipaddress` varchar(100) DEFAULT NULL,
  `user_agent` varchar(500) DEFAULT NULL,
  `login_datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `user`, `role`, `ipaddress`, `user_agent`, `login_datetime`) VALUES
(1, 'superadmin@g.com', '1', '103.104.183.2', 'Chrome 120.0.0.0, Windows 10', '2024-01-02 11:10:03'),
(2, 'superadmin@g.com', '1', '27.62.242.19', 'Chrome 120.0.0.0, Windows 10', '2024-01-11 03:23:33'),
(3, 'superadmin@g.com', '1', '103.104.183.2', 'Chrome 120.0.0.0, Windows 10', '2024-01-13 06:37:59'),
(4, 'superadmin@g.com', '1', '106.194.154.90', 'Chrome 120.0.0.0, Windows 10', '2024-01-14 15:34:31'),
(5, 'superadmin@g.com', '1', '103.104.183.2', 'Chrome 120.0.0.0, Windows 10', '2024-01-22 06:30:53'),
(6, 'superadmin@g.com', '1', '103.104.183.2', 'Chrome 120.0.0.0, Windows 10', '2024-01-22 10:01:49'),
(7, 'superadmin@g.com', '1', '171.60.197.6', 'Chrome 120.0.0.0, Windows 10', '2024-01-23 16:07:56'),
(8, 'superadmin@g.com', '1', '157.34.93.1', 'Chrome 120.0.0.0, Windows 10', '2024-01-28 16:39:27'),
(9, 'superadmin@g.com', '1', '49.35.191.125', 'Chrome 120.0.0.0, Windows 10', '2024-01-30 03:57:40'),
(10, 'superadmin@g.com', '1', '103.104.183.2', 'Chrome 120.0.0.0, Windows 10', '2024-01-30 09:45:52'),
(11, 'superadmin@g.com', '1', '127.0.0.1', 'Firefox 122.0, Windows 10', '2024-03-13 05:47:14'),
(12, 'superadmin@g.com', '1', '127.0.0.1', 'Firefox 122.0, Windows 10', '2024-03-13 05:53:07'),
(13, 'superadmin@g.com', '1', '192.168.1.202', 'Chrome 122.0.0.0, Windows 10', '2024-03-13 07:29:48'),
(14, 'superadmin@g.com', '1', '127.0.0.1', 'Firefox 122.0, Windows 10', '2024-03-13 07:35:57'),
(15, 'superadmin@g.com', '1', '127.0.0.1', 'Firefox 122.0, Windows 10', '2024-03-14 05:38:35'),
(16, 'superadmin@g.com', '1', '127.0.0.1', 'Firefox 123.0, Windows 10', '2024-03-29 04:58:16'),
(17, 'superadmin@g.com', '1', '127.0.0.1', 'Firefox 123.0, Windows 10', '2024-03-30 04:32:52'),
(18, 'superadmin@g.com', '1', '127.0.0.1', 'Firefox 123.0, Windows 10', '2024-04-01 04:37:53'),
(19, 'superadmin@g.com', '1', '127.0.0.1', 'Firefox 123.0, Windows 10', '2024-04-01 10:05:40'),
(20, 'superadmin@g.com', '1', '127.0.0.1', 'Firefox 124.0, Windows 10', '2024-04-16 14:10:20'),
(21, 'superadmin@g.com', '1', '::1', 'Chrome 123.0.0.0, Windows 10', '2024-04-17 06:24:15'),
(22, 'superadmin@g.com', '1', '::1', 'Chrome 123.0.0.0, Windows 10', '2024-04-18 05:15:52'),
(23, 'superadmin@g.com', '1', '127.0.0.1', 'Firefox 124.0, Windows 10', '2024-04-19 12:43:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `department_type` enum('1','2','3','4') NOT NULL COMMENT 'developer->1,super_admin->2,admin->3',
  `designation` int(11) NOT NULL,
  `user_code` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `show_ps` varchar(200) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `mobile` varchar(15) NOT NULL,
  `state` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `zipcode` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `adhar_no` varchar(15) NOT NULL,
  `pan_no` varchar(50) NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT 'uploads/user/no_image.png',
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0->Inactive,1->Active',
  `created_by_user_id` varchar(10) NOT NULL,
  `created_at` date NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modified_by` int(11) NOT NULL,
  `IsDeleted` enum('Y','N') NOT NULL DEFAULT 'N',
  `isDeletedBy` int(11) NOT NULL,
  `is_deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `department_type`, `designation`, `user_code`, `email`, `password`, `show_ps`, `name`, `address`, `mobile`, `state`, `district`, `zipcode`, `dob`, `adhar_no`, `pan_no`, `photo`, `status`, `created_by_user_id`, `created_at`, `update_at`, `modified_by`, `IsDeleted`, `isDeletedBy`, `is_deleted_at`) VALUES
(1, '1', 2, 'EMP001', 'superadmin@g.com', '17c4520f6cfd1ab53d8745e84681eb49', 'superadmin', 'Super Admin', 'Patna', '9874335133', 63, 88, '800009', '1991-03-03', '979543659841', 'BKMPK4221L', 'uploads/user/no_image.png', '1', '', '2023-06-01', '2023-12-02 10:06:46', 0, 'N', 0, '2023-06-26 10:36:30'),
(3, '2', 0, 'EMP003', 'admin@g.com', '17c4520f6cfd1ab53d8745e84681eb49', 'superadmin', 'Super Admin', 'Patna', '9874335133', 63, 88, '800009', '1991-03-03', '979543659841', 'BKMPK4221L', 'uploads/user/no_image.png', '1', '', '2023-06-01', '2023-09-05 04:44:46', 0, 'N', 0, '2023-06-26 10:36:30'),
(4, '3', 2, 'MSDREMP52512', 'muhamaad@g.com', 'e10adc3949ba59abbe56e057f20f883e', '123456', 'muhammad', 'bhantha', '7358488090', 63, 71, '847203', '2023-07-24', '245254', '', 'uploads/user/no_image.png', '1', '1', '2023-07-24', '2023-09-06 06:52:25', 1, 'Y', 1, '2023-07-24 07:03:41'),
(5, '2', 2, 'MSDREMP8126', 'anil@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '123456', 'anil', 'patna', '8674567849', 63, 70, '800026', '2023-10-13', '789786546245', 'dfsgty53553', 'uploads/user/no_image.png', '1', '1', '2023-10-13', '2023-10-13 10:30:39', 0, 'N', 0, '2023-10-13 10:30:39');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` int(11) NOT NULL,
  `userid` varchar(20) NOT NULL,
  `balance` double(18,2) NOT NULL DEFAULT 0.00,
  `type` varchar(20) NOT NULL DEFAULT 'Default'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id`, `userid`, `balance`, `type`) VALUES
(1, 'MSD44142', 0.00, 'Default'),
(2, 'MSD69928', 0.00, 'Default'),
(3, 'MSD37483', 0.00, 'Default'),
(4, 'MSD75769', 0.00, 'Default'),
(5, 'MSD57191', 0.00, 'Default'),
(6, 'MSD73419', 0.00, 'Default'),
(7, 'MSD25096', 0.00, 'Default'),
(8, 'MSD66808', 0.00, 'Default'),
(9, 'MSD24705', 0.00, 'Default'),
(10, 'MSD40781', 0.00, 'Default'),
(11, 'MSD31686', 0.00, 'Default'),
(12, 'MSD49712', 0.00, 'Default'),
(13, 'MSD49367', 0.00, 'Default'),
(14, 'MSD60830', 0.00, 'Default'),
(15, 'MSD26913', 0.00, 'Default'),
(16, 'MSD21000', 0.00, 'Default'),
(17, 'MSD70330', 0.00, 'Default'),
(18, 'MSD17922', 0.00, 'Default'),
(19, 'MSD67699', 0.00, 'Default'),
(20, 'MSD85929', 0.00, 'Default'),
(21, 'MSD96397', 0.00, 'Default'),
(22, 'MSD62250', 0.00, 'Default'),
(23, 'MSD19758', 0.00, 'Default'),
(24, 'MSD89433', 0.00, 'Default'),
(25, 'MSD91045', 0.00, 'Default'),
(26, 'MSD20608', 0.00, 'Default'),
(27, 'CHD84668', 0.00, 'Default'),
(28, 'CHD66645', 0.00, 'Default'),
(29, 'CHD52801', 0.00, 'Default'),
(30, 'CHD32779', 0.00, 'Default'),
(31, 'CHD34095', 0.00, 'Default'),
(32, 'CHD32298', 0.00, 'Default'),
(33, 'CHD74795', 0.00, 'Default');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transaction`
--

CREATE TABLE `wallet_transaction` (
  `id` int(11) NOT NULL,
  `tnx_id` int(11) DEFAULT NULL,
  `user_id` varchar(50) NOT NULL,
  `debit_amt` decimal(18,2) NOT NULL,
  `credit_amt` decimal(18,2) NOT NULL,
  `reason` text DEFAULT NULL,
  `created_by` enum('0','1','2','3') NOT NULL COMMENT '0->Admin,1->Member,2->System,3->partner',
  `create_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `transfer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `wallet_transaction`
--

INSERT INTO `wallet_transaction` (`id`, `tnx_id`, `user_id`, `debit_amt`, `credit_amt`, `reason`, `created_by`, `create_date`, `modified_date`, `modified_by`, `transfer_id`) VALUES
(1, 13124539, 'MSD44142', '194.50', '0.00', 'Amount debited after product purchase', '0', '2024-03-13 12:45:39', NULL, NULL, 0),
(2, 18133135, 'MSD89810', '1400.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 13:31:35', NULL, NULL, 1),
(3, 18133311, 'MSD44346', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 13:33:11', NULL, NULL, 1),
(4, 18133450, 'MSD87907', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 13:34:50', NULL, NULL, 1),
(5, 18135142, 'MSD45209', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 13:51:42', NULL, NULL, 1),
(6, 18153606, 'MSD69928', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 15:36:06', NULL, NULL, 1),
(7, 18161901, 'MSD57191', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 16:19:01', NULL, NULL, 1),
(8, 18163648, 'MSD69928', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 16:36:48', NULL, NULL, 1),
(9, 18163835, 'MSD12734', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 16:38:35', NULL, NULL, 1),
(10, 18164552, 'MSD21896', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 16:45:52', NULL, NULL, 1),
(11, 18164806, 'MSD15867', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 16:48:06', NULL, NULL, 1),
(12, 18165052, 'MSD44346', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 16:50:52', NULL, NULL, 1),
(13, 18165210, 'MSD11452', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 16:52:10', NULL, NULL, 1),
(14, 18165430, 'MSD44142', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 16:54:30', NULL, NULL, 1),
(15, 18165551, 'MSD69928', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 16:55:51', NULL, NULL, 1),
(16, 18165745, 'MSD44142', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 16:57:45', NULL, NULL, 1),
(17, 18170131, 'MSD69928', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 17:01:31', NULL, NULL, 1),
(18, 18171949, 'MSD15867', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 17:19:49', NULL, NULL, 1),
(19, 18172106, 'MSD37522', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 17:21:06', NULL, NULL, 1),
(20, 18172324, 'MSD46287', '1400.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 17:23:24', NULL, NULL, 1),
(21, 18172700, 'MSD45209', '1400.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 17:27:00', NULL, NULL, 1),
(22, 18172748, 'MSD45209', '1400.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 17:27:48', NULL, NULL, 1),
(23, 18172921, 'MSD69928', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 17:29:21', NULL, NULL, 1),
(24, 18173128, 'MSD79245', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 17:31:28', NULL, NULL, 1),
(25, 18173351, 'MSD45209', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 17:33:51', NULL, NULL, 1),
(26, 18173622, 'MSD44142', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 17:36:22', NULL, NULL, 1),
(27, 18173756, 'MSD69928', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 17:37:56', NULL, NULL, 1),
(28, 18174008, 'MSD12734', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 17:40:08', NULL, NULL, 1),
(29, 18174112, 'MSD21896', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 17:41:12', NULL, NULL, 1),
(30, 18174159, 'MSD15867', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 17:41:59', NULL, NULL, 1),
(31, 18174238, 'MSD89810', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 17:42:38', NULL, NULL, 1),
(32, 18174358, 'MSD79245', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 17:43:58', NULL, NULL, 1),
(33, 18174558, 'MSD85911', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 17:45:58', NULL, NULL, 1),
(34, 18174841, 'MSD51412', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 17:48:41', NULL, NULL, 1),
(35, 18175044, 'MSD75769', '1400.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 17:50:44', NULL, NULL, 1),
(36, 18175957, 'MSD44142', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 17:59:57', NULL, NULL, 1),
(37, 18180210, 'MSD69928', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 18:02:10', NULL, NULL, 1),
(38, 18180313, 'MSD12734', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 18:03:13', NULL, NULL, 1),
(39, 18180524, 'MSD21896', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 18:05:24', NULL, NULL, 1),
(40, 18180714, 'MSD44142', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 18:07:14', NULL, NULL, 1),
(41, 18181139, 'MSD44142', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 18:11:39', NULL, NULL, 1),
(42, 18181728, 'MSD69928', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 18:17:28', NULL, NULL, 1),
(43, 18182140, 'MSD12734', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 18:21:40', NULL, NULL, 1),
(44, 18182446, 'MSD21896', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 18:24:46', NULL, NULL, 1),
(45, 18182603, 'MSD15867', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 18:26:03', NULL, NULL, 1),
(46, 18182930, 'MSD69928', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 18:29:30', NULL, NULL, 1),
(47, 18183137, 'MSD12734', '200.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-18 18:31:37', NULL, NULL, 1),
(48, 19182014, 'CHD44142', '1000.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-19 18:20:14', NULL, NULL, 1),
(49, 19182136, 'CHD34095', '1000.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-19 18:21:36', NULL, NULL, 1),
(50, 19182706, 'CHD32298', '1000.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-19 18:27:06', NULL, NULL, 1),
(51, 19183456, 'CHD74795', '1000.00', '0.00', 'Amount debited after topup your account', '0', '2024-04-19 18:34:56', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_request`
--

CREATE TABLE `withdraw_request` (
  `id` int(11) NOT NULL,
  `wtnx_id` varchar(50) DEFAULT NULL,
  `userid` varchar(20) NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `tax` decimal(11,2) NOT NULL DEFAULT 0.00,
  `request_date` datetime NOT NULL,
  `status` enum('Paid','Un-Paid','Hold') NOT NULL DEFAULT 'Un-Paid',
  `paid_date` datetime DEFAULT NULL,
  `tid` varchar(200) DEFAULT NULL COMMENT 'Transaction ID or detail',
  `payment_image` varchar(255) NOT NULL DEFAULT 'uploads/tnx/no_tnx.png',
  `paid_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_details`
--
ALTER TABLE `bank_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_manage`
--
ALTER TABLE `category_manage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `club_income`
--
ALTER TABLE `club_income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_income`
--
ALTER TABLE `company_income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `earning`
--
ALTER TABLE `earning`
  ADD PRIMARY KEY (`id`),
  ADD KEY `useird` (`userid`);

--
-- Indexes for table `employee_designation`
--
ALTER TABLE `employee_designation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msdr_members`
--
ALTER TABLE `msdr_members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`) USING BTREE;

--
-- Indexes for table `msdr_member_basic`
--
ALTER TABLE `msdr_member_basic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_manage`
--
ALTER TABLE `notification_manage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_cancel`
--
ALTER TABLE `order_cancel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_history`
--
ALTER TABLE `order_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_purchase`
--
ALTER TABLE `package_purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_purchase_details`
--
ALTER TABLE `package_purchase_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `epin` (`pack_nu`),
  ADD KEY `issue_to` (`issue_to`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`) USING BTREE;

--
-- Indexes for table `partners_basic_manage`
--
ALTER TABLE `partners_basic_manage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partner_deposit`
--
ALTER TABLE `partner_deposit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partner_earning`
--
ALTER TABLE `partner_earning`
  ADD PRIMARY KEY (`id`),
  ADD KEY `useird` (`userid`);

--
-- Indexes for table `partner_stock`
--
ALTER TABLE `partner_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partner_wallet`
--
ALTER TABLE `partner_wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partner_wallet_transaction`
--
ALTER TABLE `partner_wallet_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partner_withdraw_request`
--
ALTER TABLE `partner_withdraw_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_table`
--
ALTER TABLE `product_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rank_system`
--
ALTER TABLE `rank_system`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_history`
--
ALTER TABLE `sale_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states_cities`
--
ALTER TABLE `states_cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_config`
--
ALTER TABLE `system_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_package_purchase`
--
ALTER TABLE `temp_package_purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_product_details`
--
ALTER TABLE `temp_product_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_manage`
--
ALTER TABLE `unit_manage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_transaction`
--
ALTER TABLE `wallet_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_request`
--
ALTER TABLE `withdraw_request`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_details`
--
ALTER TABLE `bank_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category_manage`
--
ALTER TABLE `category_manage`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `club_income`
--
ALTER TABLE `club_income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company_income`
--
ALTER TABLE `company_income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `earning`
--
ALTER TABLE `earning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee_designation`
--
ALTER TABLE `employee_designation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `msdr_members`
--
ALTER TABLE `msdr_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `msdr_member_basic`
--
ALTER TABLE `msdr_member_basic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `notification_manage`
--
ALTER TABLE `notification_manage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_cancel`
--
ALTER TABLE `order_cancel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_history`
--
ALTER TABLE `order_history`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `package_purchase`
--
ALTER TABLE `package_purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `package_purchase_details`
--
ALTER TABLE `package_purchase_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `partners_basic_manage`
--
ALTER TABLE `partners_basic_manage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `partner_deposit`
--
ALTER TABLE `partner_deposit`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `partner_earning`
--
ALTER TABLE `partner_earning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `partner_stock`
--
ALTER TABLE `partner_stock`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `partner_wallet`
--
ALTER TABLE `partner_wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `partner_wallet_transaction`
--
ALTER TABLE `partner_wallet_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `partner_withdraw_request`
--
ALTER TABLE `partner_withdraw_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_table`
--
ALTER TABLE `product_table`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rank_system`
--
ALTER TABLE `rank_system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_details`
--
ALTER TABLE `sale_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sale_history`
--
ALTER TABLE `sale_history`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `states_cities`
--
ALTER TABLE `states_cities`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=731;

--
-- AUTO_INCREMENT for table `temp_package_purchase`
--
ALTER TABLE `temp_package_purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temp_product_details`
--
ALTER TABLE `temp_product_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `unit_manage`
--
ALTER TABLE `unit_manage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `wallet_transaction`
--
ALTER TABLE `wallet_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `withdraw_request`
--
ALTER TABLE `withdraw_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
