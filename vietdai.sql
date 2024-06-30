-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2023 at 09:57 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vietdai`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int(12) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `name`, `address`, `phone`) VALUES
(1, 'Phú Mỹ Hưng', 'Số 1 đường Nội Khu Nam Viên, Phường Tân Phú, Quận 7, TP.HCM', '0398382031'),
(2, 'Bình Dương', 'Khu dân cư Việt Sinh, tỉnh Bình Dương', '0945653801');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `course` varchar(30) DEFAULT NULL,
  `teacher` int(11) DEFAULT NULL,
  `branch` int(11) DEFAULT NULL,
  `calendar` varchar(255) DEFAULT NULL,
  `bd` date DEFAULT NULL,
  `kt` date DEFAULT NULL,
  `status` int(5) DEFAULT NULL,
  `malop` varchar(255) DEFAULT NULL,
  `ht` varchar(50) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `course`, `teacher`, `branch`, `calendar`, `bd`, `kt`, `status`, `malop`, `ht`, `note`) VALUES
(1018, 'TVCA', 1007, 1, '-T2C1R3-T4C1R3', '2023-08-30', '2023-09-18', 1, 'PMH-TVCA-T2C1P3-T4C1P3-202308300918-VNM', 'Lớp tại trung tâm', NULL),
(1019, 'TVCD', 1004, 1, '-T2C1R28-T4C1R28', '2023-09-04', '2024-02-14', 1, 'PMH-TVCD-T2C1P7-T4C1P7-202309040214-PQ', 'Lớp tại trung tâm', NULL),
(1020, 'TVCA', 1007, 1, '-T3C1R3-T5C1R3', '2023-08-29', '2023-09-14', 1, 'PMH-TVCA-T3C1P3-T5C1P3-202308290914-VNM', 'Lớp tại trung tâm', NULL),
(1022, 'TVH', 1004, 1, '-T3C1R14-T5C1R14', '2023-08-31', '2023-11-21', 1, 'PMH-TVH-T3C1P2-T5C1P2-202308311121-PQ', 'Lớp tại trung tâm', NULL),
(1023, 'TVCA', 1004, 1, '-T2C2R14-T6C1R14', '2023-09-01', '2023-09-18', 1, 'PMH-TVCA-T2C2P2-T6C1P2-202309010918-PQ', 'Lớp tại trung tâm', NULL),
(1024, 'TVCB', 1007, 1, '-T2C2R3-T4C2R3', '2023-09-04', '2023-10-11', 1, 'PMH-TVCB-T2C2P3-T4C2P3-202309041011-VNM', 'Lớp tại trung tâm', NULL),
(1025, 'TVCA', 1007, 1, '-T3C2R1-T5C2R1', '2023-09-05', '2023-09-21', 2, 'PMH-TVCA-T3C2P1-T5C2P1-202309050921-VNM', 'Lớp tại trung tâm', NULL),
(1026, 'TVCA', 1007, 1, '-T2C3R1-T4C3R1', '2023-09-13', '2023-10-02', 2, 'PMH-TVCA-T2C3P1-T4C3P1-202309131002-VNM', 'Lớp tại trung tâm', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `name` varchar(50) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `period` int(11) NOT NULL,
  `price` double DEFAULT NULL,
  `id` varchar(20) NOT NULL,
  `stt` int(11) NOT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`name`, `language`, `period`, `price`, `id`, `stt`, `status`) VALUES
('THIẾU NHI', 'TIẾNG TRUNG', 48, 8000000, 'ESC', 1, 1),
('TIỂU HỌC TĂNG CƯỜNG', 'TIẾNG ANH', 48, 8000000, 'F&F', 2, 1),
('LUYỆN THI HSK', 'TIẾNG TRUNG', 48, 8000000, 'HSK', 3, 1),
('CĂN BẢN', 'TIẾNG NHẬT', 48, 8000000, 'JACB', 4, 1),
('GIAO TIẾP', 'TIẾNG NHẬT', 48, 8000000, 'JAGT', 5, 1),
('CĂN BẢN', 'TIẾNG HÀN', 48, 8000000, 'KOCB', 6, 1),
('GIAO TIẾP', 'TIẾNG HÀN', 48, 8000000, 'KOGT', 7, 1),
('CĂN BẢN', 'TIẾNG ANH', 48, 8000000, 'TACB', 8, 1),
('GIAO TIẾP', 'TIẾNG ANH', 48, 8000000, 'TAGT', 9, 1),
('THƯƠNG MẠI', 'TIẾNG ANH', 48, 8000000, 'TATM', 10, 1),
('CẤP TỐC', 'TIẾNG HOA', 80, 138000000, 'THCT', 12, 1),
('GIAO TIẾP', 'TIẾNG HOA', 48, 8000000, 'THGT', 13, 1),
('HỌC HÁT', 'TIẾNG HOA', 24, 4000000, 'THH', 14, 1),
('NGỮ PHÁP', 'TIẾNG HOA', 12, 3600000, 'THNP', 15, 1),
('CẤP TẤP 120 GIỜ', 'TIẾNG VIỆT', 48, 8000000, 'TV120', 16, 1),
('CẤP TẤP 320 GIỜ', 'TIẾNG VIỆT', 215, 36000000, 'TV320', 17, 1),
('CƠ BẢN', 'TIẾNG VIỆT', 12, 4000000, 'TVCB', 20, 1),
('CHỦ ĐỀ', 'TIẾNG VIỆT', 48, 8000000, 'TVCD', 21, 1),
('CÔNG SỞ', 'TIẾNG VIỆT', 48, 8000000, 'TVCS', 22, 2),
('CÔNG XƯỞNG', 'TIẾNG VIỆT', 48, 8000000, 'TVCX', 23, 1),
('GIAO TIẾP', 'TIẾNG VIỆT', 48, 8000000, 'TVGT', 24, 1),
('HỌC HÁT', 'TIẾNG VIỆT', 24, 4000000, 'TVH', 25, 1),
('THIẾU NIÊN', 'TIẾNG TRUNG', 48, 8000000, 'YCT', 26, 1),
('THIẾU NHI', 'TIẾNG VIỆT', 48, 8000000, 'ATF', 27, 1),
('CHỈNH ÂM', 'TIẾNG VIỆT', 6, 2000000, 'TVCA', 30, 1),
('THIẾU NHI', 'TIẾNG TRUNG', 48, 8000000, 'EUC', 32, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `form_class`
--

CREATE TABLE `form_class` (
  `name` varchar(50) NOT NULL,
  `choose` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `form_class`
--

INSERT INTO `form_class` (`name`, `choose`) VALUES
('Doanh nghiệp', 0),
('Lớp tại trung tâm', 1),
('Online', 0),
('Tại gia', 0);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`name`) VALUES
('TIẾNG ANH'),
('TIẾNG HÀN'),
('TIẾNG HOA'),
('TIẾNG NHẬT'),
('TIẾNG TRUNG'),
('TIẾNG VIỆT');

-- --------------------------------------------------------

--
-- Table structure for table `list_class`
--

CREATE TABLE `list_class` (
  `class` int(11) DEFAULT NULL,
  `student` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `list_class`
--

INSERT INTO `list_class` (`class`, `student`, `id`) VALUES
(1018, 2, 10),
(1019, 11, 11),
(1023, 10, 19),
(1023, 2, 20),
(1025, 17, 21),
(1025, 2, 22),
(1026, 2, 24),
(1020, 10, 27),
(1020, 13, 28);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `id_branch` int(11) DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `name`, `id_branch`, `status`) VALUES
(1, 'P1', 1, 1),
(3, 'P3', 1, 1),
(4, 'P4', 1, 1),
(5, 'P5', 1, 1),
(12, 'P6', 1, 1),
(14, 'P2', 1, 1),
(23, 'P1', 5, 1),
(24, 'P2', 5, 1),
(25, 'P3', 5, 1),
(26, 'P4', 5, 1),
(27, 'P5', 5, 1),
(28, 'P7', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `name` varchar(50) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `date_birthday` date DEFAULT NULL,
  `id_branch` int(11) DEFAULT NULL,
  `languages` varchar(50) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `calendar` varchar(255) DEFAULT NULL,
  `sex` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `form_work` varchar(50) DEFAULT NULL,
  `salary` int(11) DEFAULT NULL,
  `date_work` date DEFAULT NULL,
  `cccd` varchar(12) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `status` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`name`, `phone`, `email`, `date_birthday`, `id_branch`, `languages`, `id`, `calendar`, `sex`, `address`, `form_work`, `salary`, `date_work`, `cccd`, `address1`, `status`) VALUES
('Nguyễn Nhật Hùng', '0348382031', 'vnt23001@gmail.com', NULL, 1, '', 1001, '-T2C1-T2C2-T2C3-T2C4-T2C5-T3C1-T3C2-T3C3-T3C4-T3C5-T4C1-T4C2-T4C3-T4C4-T4C5-T5C1-T5C2-T5C3-T5C4-T5C5-T6C1-T6C2-T6C3-T6C4-T6C5-T8C1-T8C2-T8C3-T8C4-T8C5', 'Nam', 'Khu dân cư Việt Sinh, tỉnh Bình Dương', 'Full-time', NULL, NULL, '012233466213', 'Khu dân cư Việt Sinh, tỉnh Bình Dương', 1),
('Nguyễn Hữu Thiện', '0948382031', 'huuthien@gmail.com', NULL, 1, '-TIẾNG HOA', 1002, '-T2C1-T2C2-T2C3-T2C4-T2C5-T3C1-T3C2-T3C3-T3C4-T3C5-T4C1-T4C2-T4C3-T4C4-T4C5-T5C1-T5C2-T5C3-T5C4-T5C5-T6C1-T6C2-T6C3-T6C4-T6C5', 'Nam', 'Tân Phong, Quận 7, TPHCM', 'Full-time', NULL, NULL, '072233466299', 'Tân Phong, Quận 7, TPHCM', 1),
('Phạm Quốc', '0369652703', 'quocpham@gmail.com', '2000-06-20', 1, '-TIẾNG TRUNG', 1004, '-T2C1-T2C2-T2C3-T2C4-T2C5-T3C1-T3C2-T3C3-T3C4-T3C5-T4C1-T4C2-T4C3-T4C4-T4C5-T5C1-T5C2-T5C3-T5C4-T5C5-T6C1-T6C2-T6C3-T8C5-T8C6-T8C7', 'Nam', 'Tỉnh Bình Dương', 'Full-time', NULL, NULL, '012992334662', 'Tỉnh Bình Dương', 1),
('Vũ Nhật Minh', '0949653801', 'nhatminhvu@gmail.com', '1987-11-11', 1, '-TIẾNG VIỆT-TIẾNG NHẬT-TIẾNG ANH-TIẾNG HOA', 1007, '-T2C1-T2C2-T2C3-T3C1-T3C2-T3C3-T4C1-T4C2-T4C3-T5C1-T5C2-T6C1', 'Nam', 'Quận Ba Đình', 'Full-time', NULL, NULL, '012092334662', 'Quận Hoàng Kiếm', 1),
('Trần Vũ Hà', '0386382031', 'vuha@gmail.com', '1988-11-12', 1, '-TIẾNG VIỆT', 1008, '-T2C1-T2C2-T2C3-T2C4-T2C5-T3C1-T3C2-T3C3-T3C4-T3C5-T4C1-T4C2-T4C3-T4C4-T4C5-T5C1-T5C2-T5C3-T5C4-T5C5-T6C1-T6C2-T6C3-T6C4-T6C5-T8C1-T8C2-T8C3-T8C4-T8C5', 'Nam', 'Khu dân cư Việt Sinh, tỉnh Bình Dương', 'Full-time', NULL, NULL, '018933466213', 'Khu dân cư Việt Sinh, tỉnh Bình Dương', 1),
('Nguyễn Thị Ngọc Loan', '0396382038', 'minhloan@gmail.com', '1988-11-12', 1, NULL, 1010, '-T2C1-T2C2-T2C3-T2C4-T2C5-T3C1-T3C2-T3C3-T3C4-T3C5-T4C1-T4C2-T4C3-T4C4-T4C5-T5C1-T5C2-T5C3-T5C4-T5C5-T6C1-T6C2-T6C3-T6C4-T6C5-T8C1-T8C2-T8C3-T8C4-T8C5', 'Nữ', 'Bình Định', 'Full-time', NULL, NULL, '018133466213', 'Hoàng Anh Gia Lai 3 TPHCM', 1),
('Bình Dương', '0945657801', '51900448@student.tdtu.edu.vn', '2023-09-09', 1, '', 1011, '', 'Nam', 'Khu dân cư Việt Sinh, tỉnh Bình Dương', 'Full-time', NULL, NULL, '072233466212', 'Khu dân cư Việt Sinh, tỉnh Bình Dương', 1),
('Võ Ngọc Trâm', '0348382091', 'ngoctravo2001@gmail.com', '2023-09-16', 1, '-TIẾNG VIỆT-TIẾNG NHẬT', 1012, '-T2C1-T2C2-T2C3-T3C1-T3C2-T3C3', 'Nữ', 'ktx đại học Tôn Đức Thắng, Phường Tân Phong', 'Part-time', NULL, NULL, '012293477762', 'ktx đại học Tôn Đức Thắng, Phường Tân Phong', 1),
('Nguyễn Trần Minh Anh', '0248382031', 'ngocvo2001@gmail.com', '2023-09-15', 1, '-TIẾNG NHẬT-TIẾNG ANH', 1014, '-T2C1-T2C2-T2C3-T2C4-T2C5-T3C1-T3C2-T3C3-T3C4-T3C5', 'Nữ', 'Tan Phong, Quan7', 'Part-time', NULL, NULL, '012233489762', 'Tan Phong, Quan7', 1),
('Võ Văn An', '0348382038', 'vnt2301@gmail.com', '1992-11-11', 1, NULL, 1019, '-T2C1-T2C2-T2C3-T2C4-T2C5-T3C1-T3C2-T3C3-T3C4-T3C5-T4C1-T4C2-T4C3-T4C4-T4C5-T5C1-T5C2-T5C3-T5C4-T5C5-T6C1-T6C2-T6C3-T6C4-T6C5-T8C1-T8C2-T8C3-T8C4-T8C5', 'Nam', 'Khu dân cư Việt Sinh, tỉnh Bình Dương', 'Full-time', NULL, NULL, '12239466213', 'Khu dân cư Việt Sinh, tỉnh Bình Dương', 1),
('Võ Trân', '0848382031', 'ngoctramvo208801@gmail.com', '2023-09-22', 1, '-TIẾNG VIỆT-TIẾNG ANH', 1020, '-T2C1-T2C2-T2C3-T2C4-T2C5-T3C1-T3C2-T3C3-T3C4-T3C5', 'Nữ', 'Tan Phong, Quan7', 'Full-time', NULL, NULL, '072233469212', 'Tan Phong, Quan7', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `nationality` varchar(10) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `start` date DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `branch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `nationality`, `phone`, `start`, `date_of_birth`, `sex`, `branch`) VALUES
(2, 'Jonh', 'Anh', '0945673801', NULL, '1989-03-09', 'Nam', 1),
(7, 'Jessica', 'Anh', '0945673801', NULL, '1989-03-09', 'Nữ', 1),
(8, 'Junwoo', 'Hàn Quốc', '0348382031', NULL, '2000-08-26', 'Nam', 1),
(10, 'Hyunwoo', 'Hàn Quốc', '0370382031', NULL, '2000-08-26', 'Nam', 1),
(11, 'Dương Khiết', 'Đài Loan', '0348982037', NULL, '1991-07-26', 'Nam', 1),
(12, 'Triều Hân', 'Trung', '0348382738', NULL, '1995-07-26', 'Nữ', 1),
(13, 'Hải Linh', 'Trung', '0348382031', NULL, '1995-09-21', 'Nữ', 1),
(14, 'Nguyễn Hải Minh', 'Việt Nam', '0358982039', NULL, '2006-07-26', 'Nam', 1),
(15, 'Trần Quốc Bảo ', 'Việt Nam', '0359982039', NULL, '2006-07-26', 'Nam', 1),
(17, 'Võ Ngọc Trâm', 'Việt Nam', '0348382031', NULL, '2023-09-13', 'Nữ', 1),
(21, 'Jessica', 'Anh', '0945673801', NULL, '1989-03-09', 'Nữ', 1),
(22, 'Junwoo', 'Hàn Quốc', '0348382031', NULL, '2000-08-26', 'Nam', 1),
(23, 'Jeon So Min', 'Hàn Quốc', '0849382031', NULL, '1993-08-26', 'Nữ', 1),
(24, 'Hyunwoo', 'Hàn Quốc', '0370382031', NULL, '2000-08-26', 'Nam', 1),
(25, 'Dương Khiết', 'Đài Loan', '0348982037', NULL, '1991-07-26', 'Nam', 1),
(26, 'Triều Hân', 'Trung', '0348382738', NULL, '1995-07-26', 'Nữ', 1),
(27, 'Hải Linh', 'Trung', '0348382031', NULL, '1995-09-21', 'Nữ', 1),
(28, 'Nguyễn Hải Minh', 'Việt Nam', '0358982039', NULL, '2006-07-26', 'Nam', 1),
(33, 'Hyunwoo', 'Hàn Quốc', '0370382031', NULL, '2000-08-26', 'Nam', 1),
(34, 'Dương Khiết', 'Đài Loan', '0348982037', NULL, '1991-07-26', 'Nam', 1),
(35, 'Triều Hân', 'Trung', '0348382738', NULL, '1995-07-26', 'Nữ', 1),
(36, 'Hải Linh', 'Trung', '0348382031', NULL, '1995-09-21', 'Nữ', 1),
(37, 'Nguyễn Hải Minh', 'Việt Nam', '0358982039', NULL, '2006-07-26', 'Nam', 1),
(38, 'Trần Quốc Bảo ', 'Việt Nam', '0359982039', NULL, '2006-07-26', 'Nam', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `change_pass` int(2) NOT NULL,
  `branch` int(11) DEFAULT NULL,
  `type` int(5) DEFAULT NULL,
  `staff` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `change_pass`, `branch`, `type`, `staff`) VALUES
(1, 'admin', '$2y$10$zaxTrWKz38OPlBEg5e.QBujhWOzwuSd7rbDW3cT8Wr2smMN4/j1CW', 1, 1, 0, NULL),
(2, 'CN1PMH', '$2y$10$CQw5Ul4o1j.lcBk8G1BQyO6Xeb.fjAQVw/FH6sXuWKGhs.lVggJGq', 1, 1, 1, NULL),
(4, 'nhatminhvu@gmail.com', '$2y$10$5a5Holi8LxiYpXa6uE8hSegzvku1FB31U3OTOghSxGp1/.FZjnaCW', 1, 1, 2, 1007),
(5, 'minhloan@gmail.com', '$2y$10$w.jryOLoCZi.flWIobhqCe5Rtg1.G2DYbIQ2otncJUWzfinhCPca.', 0, 1, 2, 1010),
(7, '51900448@student.tdtu.edu.vn', '$2y$10$qv.GLxzJM5ILVfJP0J1w9eZZ1Hi9TJohsSyY9J1.Fdp7Rhc7x.mm2', 0, 1, 2, 1011),
(10, 'CN5BD', '$2y$10$HZnCqrhxImqDeOqsux27Qu9gtW6m8ZsJhSQ2eCmlSodW5RTF4RyYy', 1, 5, 1, NULL),
(12, 'ngocvo2001@gmail.com', '$2y$10$3UgQZz2rTd6niUZ.4Kipr.BFBQ8r6jG2WhGB1IM7t9doglGjf4IFy', 0, 1, 2, 1014),
(15, 'ngoctramvo208801@gmail.com', '$2y$10$dgQm4jl/DiDCNIkztj1TCu3TtjA7t2suAgm7bfEfTvRIn5pwxZZHy', 0, 1, 2, 1020),
(16, 'vuha@gmail.com', '$2y$10$5JUBAfWVYAQ1rzv4kPp94ukSAfZ5FDvsAxg2Pr3RO7jUqyGbJSHme', 0, 1, 2, 1008),
(19, 'huuthien@gmail.com', '$2y$10$lzTzXmzXJw0P4zDRKn9AHePliyzRhyJuj.gQTbJzUCEJdCUVx4YbC', 0, 1, 1, 1002);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_course` (`course`),
  ADD KEY `FK_teacher` (`teacher`),
  ADD KEY `FK_branch` (`branch`),
  ADD KEY `FK_ht` (`ht`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`stt`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `FK_languages` (`language`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `form_class`
--
ALTER TABLE `form_class`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `list_class`
--
ALTER TABLE `list_class`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_class` (`class`),
  ADD KEY `FK_student` (`student`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_branch_room` (`id_branch`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `cccd` (`cccd`),
  ADD KEY `FK_branch_staff` (`id_branch`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_branch_student` (`branch`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_branch_user` (`branch`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1027;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `stt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `list_class`
--
ALTER TABLE `list_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1022;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `FK_branch` FOREIGN KEY (`branch`) REFERENCES `branch` (`id`),
  ADD CONSTRAINT `FK_course` FOREIGN KEY (`course`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `FK_ht` FOREIGN KEY (`ht`) REFERENCES `form_class` (`name`),
  ADD CONSTRAINT `FK_teacher` FOREIGN KEY (`teacher`) REFERENCES `staff` (`id`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `FK_languages` FOREIGN KEY (`language`) REFERENCES `languages` (`name`);

--
-- Constraints for table `list_class`
--
ALTER TABLE `list_class`
  ADD CONSTRAINT `FK_class` FOREIGN KEY (`class`) REFERENCES `class` (`id`),
  ADD CONSTRAINT `FK_student` FOREIGN KEY (`student`) REFERENCES `student` (`id`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `FK_branch_room` FOREIGN KEY (`id_branch`) REFERENCES `branch` (`id`),
  ADD CONSTRAINT `fk_id_branch` FOREIGN KEY (`id_branch`) REFERENCES `branch` (`id`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `FK_branch_staff` FOREIGN KEY (`id_branch`) REFERENCES `branch` (`id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `FK_branch_student` FOREIGN KEY (`branch`) REFERENCES `branch` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_branch_user` FOREIGN KEY (`branch`) REFERENCES `branch` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
