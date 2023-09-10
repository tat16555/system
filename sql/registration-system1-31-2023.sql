-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2023 at 07:28 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `registration-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` int(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `urole` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `firstname`, `lastname`, `username`, `address`, `phone`, `email`, `password`, `urole`, `created_at`) VALUES
(5, 'tat', '231', 'admin44', '110', 622951263, 'admin44@gmail.com', '$2y$10$.mUDSoi3GrfUfrugvp1p0eiyrKBGGpFwf06t7lZel61u7R8WV98y2', 'admin', '2023-01-25 09:05:12'),
(6, 'tat', 'pannatat', 'QQ007', '110', 622951263, 'admin23@gmail.com', '$2y$10$COaLYMIM2pzaak73tsHsaOKdfr5lQ7IAlWXzgP9xzbdctqokE0fB6', 'admin', '2023-01-25 09:33:59'),
(7, 'tat', 'gxhtd', 'QQ01231', '110', 867773839, 'admin43@gmail.com', '$2y$10$eWlrQlBVR3BGChrhZxwIgOHFVWfo//F1TF.vVMPP1KZCLbPqO6zJa', 'admin', '2023-01-26 00:41:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) CHARACTER SET big5 COLLATE big5_chinese_ci NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` int(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `urole` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `cip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `address`, `phone`, `email`, `gender`, `password`, `urole`, `created_at`, `cip`) VALUES
(11, 'tat', 'pannatat', 'tat123', '50/156 นนทบุรี', 622951263, 'pannatat.b555@gmail.com', 'Male', '$2y$10$0O0bI18mQAXiZyexpcrd0ePxvKy4Xmsnuo4InlERQp2sdyySmX282', 'admin', '2022-09-25 20:02:46', ''),
(12, 'tat', 'tnt', 'tat5554', '50/156 นนทบุรี', 622951263, 'pannatat.b@gmail.com', 'Male', '$2y$10$EL3u4hJwRa8QEAiQA9a/E.VSKUwkx6JKMgj/4PjA3HfX7WRvDAnRq', 'user', '2022-11-25 20:47:38', ''),
(13, 'Pat', 'Nama', 'PP007', 'บางใหญ่ซิตี้ ซอย 6/5 ตำบล บางรักพัฒนา อำเภอบางบัวทอง นนทบุรี 11110', 984145941, '0984145941@gmail.com', 'LGBTQ', '$2y$10$Q7mTiR9XIaVtWw0hplsMHunQsKPrSwT4BZ626ZytWLV6YuSrs2v5O', 'user', '2022-08-25 21:40:44', ''),
(14, 'Jib', 'Nava', 'Jid3425', 'เลขที่ 92/3-4 หมู่ 6 ซอย วัดลาดปลาดุก ถนน วัดลาดปลาดุก ตำบล บางรักพัฒนา อำเภอบางบัวทอง นนทบุรี 11110', 916554452, '0916554452@gmail.com', 'Male', '$2y$10$COguHJslVOdC2YSQBriGZ.6dnbJdhLsJp3Ycf8Z3fLKnNAWReXECi', 'user', '2022-11-25 21:43:09', ''),
(15, 'worker', 'wor', 'worker001', 'เลขที่ 92/3-4 หมู่ 6 ซอย วัดลาดปลาดุก ถนน วัดลาดปลาดุก ตำบล บางรักพัฒนา อำเภอบางบัวทอง นนทบุรี 11110', 984145941, 'pannatat.r@gmail.com', 'Male', '$2y$10$u6dqAxe0tm8BeaPoRP8oqO0Ub.NuJBo3PIHPPGPKsMsE8VSiBMZJi', 'worker', '2022-10-26 06:49:06', ''),
(16, 'Awfe', 'Sfdyd', 'par3897', 'เลขที่ 90/3 หมู่ 6 ซอย วัดลาดปลาดุก ถนน วัดลาดปลาดุก ตำบล บางรักพัฒนา อำเภอบางบัวทอง นนทบุรี 11110', 916554452, '3254325@gamil.com', 'Male', '$2y$10$tjQPbwh7YcoOi/aQrwr5pOYQ84.y46D.JaHXUF66Guh5gQH8Fir3G', 'user', '2022-07-26 10:12:32', ''),
(17, 'Jack', 'po', '32432432', 'เลขที่ 90/3 หมู่ 6 ซอย วัดลาดปลาดุก ถนน วัดลาดปลาดุก ตำบล บางรักพัฒนา อำเภอบางบัวทอง นนทบุรี 11110', 622431263, 'patiphan@gmail.com', 'Male', '$2y$10$MzM01o79lVm5C8aCsHkcH.mrPdH.Bz6kQ0sIQDKrxQrzI4Sx7DTRO', 'user', '2022-09-27 15:12:27', ''),
(18, 'rfserf', 'dsad', 'tat123', 'บางใหญ่ซิตี้ ซอย 6/5 ตำบล บางรักพัฒนา อำเภอบางบัวทอง นนทบุรี 11110', 984145941, 'tat324@gmail.com', 'Male', '$2y$10$xLX2XPSn7pJMXTblp0pWcukw5Ln9txJiFW.Mvy.4cAepUfnQNnmz.', 'user', '2022-11-28 02:33:39', ''),
(19, 'ad', 'min', 'Tat888', '11/132', 622951263, 'admin2@gmail.com', 'Male', '$2y$10$XGH57MtPrMqccRcfll4G6.8oIlkCn1NogE7UGgc30xAYLzXsodIdi', 'admin', '2022-12-12 07:16:07', ''),
(20, 'ครูบา', 'ไม่ใช้ไฟฟ้า', 'QQ007', '14/197 กทม.', 622951263, 'QQ007@game.com', 'Male', '$2y$10$eQ2odaNEyn7CknOJOIiSNOlBsTNGwz.4TmIqo/KMowF78ibcpnNhG', 'user', '2022-04-15 21:25:21', ''),
(21, 'อาบาบา', 'ฑะนะญัง', '?BYD353452', '14/197 กทม.', 623941273, 'byd53452.d@gmail.com', 'LGBTQ', '$2y$10$LdeFFnGlbhL9heITLllha.XJyiNjFKJykielOqcOoBbcWKrhI1pbq', 'user', '2022-12-19 22:56:57', ''),
(22, 'label', 'melow', 'khunsuek', '110', 867773839, 'gift@gmail.com', 'Female', '$2y$10$snTObGNOVyWNt8ssbVh8deyvra0b1J5rDh0MIAtkPVTukvd.Y.mV.', 'user', '2022-06-20 06:43:30', ''),
(23, 'ปัณณทัต', 'บูรณสันติ', 'tat777', '14/197 กทม.', 622951263, 'tat555@gmail.com', 'Male', '$2y$10$Hlk.shdX6tnrjSEbSfMVM.iiALW4pUoLKhB0ESO1uR/ASsH60bXlq', 'user', '2022-07-20 07:11:59', ''),
(24, 'ปัณณทัต', 'บูรณสันติ', 'TH0111', '14/197 กทม.', 622951263, 'th0111@gmail.com', 'Male', '$2y$10$W3tdxGFT/1yRtlts4.yWIeBiMEGzYBrj/CzsxqeaqT6P30zYuptzi', 'user', '2023-01-09 11:17:41', ''),
(25, 'ปัณณทัต', 'บูรณสันติ', 'RRET007', '14/197 กทม.', 622951263, 'RRET007@gmail.com', 'Male', '$2y$10$SLlw4gPtzMIw97L7cLXcl.cjhGN6d4rkk5UZC3hbpAvCw3VT1RfIC', 'user', '2023-01-09 11:23:00', ''),
(28, 'ปัณณทัต', 'บูรณสันติ', 'tat4154314', 'เลขที่ 50/156 หมู่บ้านเกล้ารัตนา, ซอย 3 ถนนนรัตนาธิเบศร์, ตำบลเสาธงหิน, อำเภอบางใหญ่,จังหวัดนนทบุรี', 622951263, 'pannatat.gg@gmail.com', 'Male', '$2y$10$kxK5bImr9MRH4Hi7B3TsX.5zxpxg0FL3kVVa360LkHhQHBs3ZDuQa', 'user', '2023-01-11 16:30:15', ''),
(29, 'กนกนันทร์', 'สุเชาว์อินทร์', 'Kanoknan254', '14/197 กทม.', 867773839, 'kano3154@gmail.com', 'Females', '$2y$10$Pi6qe7N2OHm8cZt1dqcLiO6hD63EIErEUkYjiaf.PlhVUZH4hWVTO', 'user', '2022-05-25 22:49:06', ''),
(30, 'อารยา', 'สุเชาว์อินทร์', 'Araya082', '14/197 กทม.', 867773839, 'hy082@gmail.com', 'Female', '$2y$10$Gp8BlNmGpiTwcSFevTd8PeVHOngua6Q3CS9GGlFNvc9CLDoCewX/6', 'user', '2022-08-25 21:49:06', ''),
(31, 'ณภัทร', 'เครือทิวา', 'wqewr13441', '14/197 กทม.', 623941273, 'QC232491@game.com', 'Female', '$2y$10$SCNyydv7FWbn39V1VyrCYuGZFLBpH5bjOfTelPfpWlu/6SMgdt/vm', 'user', '2022-05-26 06:49:06', ''),
(32, 'ณัฏฐา', 'สุภาสนันท์', 'Nattha', '14/197 กทม.', 867773839, 'nattha3241@gmail.com', '', '$2y$10$FVZoZzdhwY5V3B2BDoDIju1oFCiwmNzRSsK1Jwtb2cvXt7tuOvL3q', 'user', '2022-03-26 06:49:06', ''),
(33, 'ณัฐ', 'ณ สงขลา', 'Nat Na', '14/197 กทม.', 867773839, 'khla32525@gmail.com', '', '$2y$10$FGHFnp6IcKOt.1QGf9CKAuIoJEgcW32xdeQNja53tvadFk.2beTxK', 'user', '2022-02-26 06:49:06', ''),
(34, 'ณัฐพงษ์', 'ธนโชติเจริญ', 'Natthapong', '14/197 กทม.', 623941273, 'pong092430@gmail.com', '', '$2y$10$HrNhkX7/7nBOmflAixb9YeI1yi5OO8SioIPD9KdblLhLU2iotZD6q', 'user', '2022-07-26 06:36:07', ''),
(35, 'นพมาศ', 'แตงมณี', 'Noppamad2340', '14/197 กทม.', 867773839, 'noppamad9024520@gmail.com', '', '$2y$10$ndeDWKw9iAeRuueoiqQJK.kq4Hk8de2A9692LsMGDOJPI9.Pqm0SW', 'user', '2022-05-26 06:36:07', ''),
(36, 'พงศกร', 'สุขปาน', 'Pongsakorn', '14/197 กทม.', 867773839, 'pongsakorn432552@gmail.com', '', '$2y$10$hA7vEqtZl0g475eraRJKc.HJK8JNM31JRX/ZuMuALlSeS8KIgmSIa', 'user', '2022-03-26 06:36:07', ''),
(37, 'วรยา', 'แสงเงิน', 'Sangngoen342', '14/197 กทม.', 622951263, 'sangngoen343@gmail.com', '', '$2y$10$T/ykx92Flw7eaLYTGaq5gO29IKRxgz/xX48TwtPzWgInVHC96EuL2', 'user', '2022-02-26 06:36:07', ''),
(38, 'วรรณรส', 'มาตโสม', 'Wannarod2314', '14/197 กทม.', 623941273, 'wannarod2314@gmail.com', '', '$2y$10$uC5vzYWUKXchgpOt0Wooq.aGx7JBI2K9g1zu8qkFIOQjAGB/gdy4K', 'user', '2023-01-12 06:36:53', ''),
(39, 'สุจิตรา', 'วาชัยยุง', 'sujittra', '14/197 กทม.', 867773839, 'sujittra4524@gmail.com', '', '$2y$10$cbN..P.Pf2UWJP7SxQ20O.MFNka27db8ZujjiKC8NgiGcDVUjPRNS', 'user', '2023-01-12 06:37:44', ''),
(40, 'สุภัทร', 'สวนจันทร์', 'Supat', '14/197 กทม.', 867773839, 'supat13414.op@gmail.com', '', '$2y$10$5vL8KDMfmXvZOfTxKCN2vOxKvkyTriCk3XDRcP6aWZxiKF4PY8mSK', 'user', '2023-01-12 06:38:35', ''),
(41, 'อาณัติ', 'จรูญอุดมสุข', 'Arnut4235', '14/197 กทม.', 623941273, 'arnut4235@gmail.com', '', '$2y$10$iA8ieafMdMpQrlcjitVm2ed.DJhvDO86NVOrUW8F8mBmHwkE2vFi6', 'user', '2023-01-12 06:39:38', ''),
(42, 'janda', 'maya', 'janda', '14/167 กทม.', 867723869, 'janda4145@gmail.com', '', '$2y$10$pGguzqjubPYwWwx/PvLmhOKiWnSgxylD2nU.xMMvWHuQ8B3j0ldj6', 'user', '2023-01-29 12:17:48', '');

-- --------------------------------------------------------

--
-- Table structure for table `worker`
--

CREATE TABLE `worker` (
  `id` int(10) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` int(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `urole` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `worker`
--
ALTER TABLE `worker`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
