-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2024 at 10:13 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_20_columns_cwts`
--

CREATE TABLE `tbl_20_columns_cwts` (
  `std_id` int(11) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `ex_name` varchar(20) NOT NULL,
  `m_name` varchar(255) NOT NULL,
  `b_date` date NOT NULL,
  `sex` varchar(10) NOT NULL,
  `st_brgy` varchar(255) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `c_status` varchar(255) NOT NULL,
  `religion` varchar(255) NOT NULL,
  `email_add` varchar(255) NOT NULL,
  `cp_number` varchar(11) NOT NULL,
  `college` varchar(255) NOT NULL,
  `y_level` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `major` varchar(255) NOT NULL,
  `grade_sem_1` varchar(11) NOT NULL,
  `grade_sem_1_percent` varchar(10) NOT NULL,
  `grade_sem_2` varchar(11) NOT NULL,
  `grade_sem_2_percent` varchar(10) NOT NULL,
  `remarks` varchar(11) NOT NULL,
  `cpce` varchar(255) NOT NULL,
  `cpce_cp_number` varchar(11) NOT NULL,
  `nstp_component` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_20_columns_cwts`
--

INSERT INTO `tbl_20_columns_cwts` (`std_id`, `l_name`, `f_name`, `ex_name`, `m_name`, `b_date`, `sex`, `st_brgy`, `municipality`, `province`, `c_status`, `religion`, `email_add`, `cp_number`, `college`, `y_level`, `course`, `major`, `grade_sem_1`, `grade_sem_1_percent`, `grade_sem_2`, `grade_sem_2_percent`, `remarks`, `cpce`, `cpce_cp_number`, `nstp_component`, `username`, `pass`, `created_at`) VALUES
(1, 'Balan', 'Edgardo', 'Sr', 'Castillo', '1999-02-07', 'Male', 'Purok 7, Bagumbayan', 'Masbate', 'Batangas', 'Single', 'Roman Catholic', 'edgardobalan24@gmail.com', '09121212121', 'Industrial Technology', '4', 'BSCS', 'BSCS', '90', '1.75', '89', '1.75', 'Passed', 'Hakeem Hanks', '90121212121', 'CWTS', 'master00312', '$argon2i$v=19$m=65536,t=4,p=1$RUhYU3l1T1hOenQ2clpBTg$eH638SeZRcC4EE2ai2nwLPQs1eJdLzPaahKzm4d185U', '2024-08-25 22:02:16'),
(2, 'Knight', 'Brandon', 'Chelsea Thornton', 'Benedict Hawkins', '1988-12-13', 'Male', 'Nesciunt Dolorem Es', 'Nisi Eu Temporibus D', 'Cupidatat Pariatur ', 'Single', 'Qui Pariatur Et Ill', 'vehytukih@mailinator.com', '59412121212', 'Education', '4', 'Qui In Quia Optio C', 'Et Sit Mollit Et Dol', 'DROP', 'DROP', '', '', 'Failed', 'Liberty Carpenter', '55121212121', 'CWTS', 'master_00312', '$argon2i$v=19$m=65536,t=4,p=1$aXFPRkViTk5jUm0uNjhLLw$qNVTVfj+VddxcXT05uafWxRp10b1bdHQbX7vf8eH4NQ', '2024-08-25 22:03:12'),
(3, 'Stephens', 'Irene', 'Justine Ewing', 'Kylie Hays', '1982-02-16', 'Female', 'Aliqua Voluptatem ', 'Non Sint Velit Quia', 'Quia Ea Earum Volupt', 'Single', 'Dolor Incidunt Volu', 'hynufuvuji@mailinator.com', '67412121212', 'Education', '3', 'Ut Tenetur Voluptate', 'Dolore Aliquip Conse', '75', '3.00', '60', '5.00', 'Failed', 'Alexa Ellis', '96712121212', 'CWTS', 'vobixy', '$argon2i$v=19$m=65536,t=4,p=1$cFlGWmhWR2hiT2dvQnB0MQ$nlzvPkWPdeQIUeOfewiSgzOrRl+hSVFu8Krlo1D2sQ8', '2024-08-25 22:04:07'),
(5, 'Ortega', 'Vaughan', 'Sara Medina', 'Nehru Hill', '1985-05-28', 'Male', 'Animi Velit Ex Rep', 'Et Minima Ut Ut Ex L', 'Repudiandae Voluptat', 'Single', 'Et Sed Neque Est Vo', 'sajomifa@mailinator.com', '95412121212', 'Agriculture', '4', 'Non Enim Tempore Ut', 'Harum Sit Asperiore', '90', '1.75', '90', '1.75', 'Passed', 'Emily Holt', '54312121212', 'CWTS', 'hapihub', '$argon2i$v=19$m=65536,t=4,p=1$amJnRHNhS0V6enNQeVdaMw$ARv42kPsGQ132msGPxflDRDFzGnci8YDRrxT/+d3Im8', '2024-08-26 07:35:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_20_columns_lts`
--

CREATE TABLE `tbl_20_columns_lts` (
  `std_id` int(11) NOT NULL,
  `l_name` varchar(100) NOT NULL,
  `f_name` varchar(100) NOT NULL,
  `m_name` varchar(100) NOT NULL,
  `ex_name` varchar(10) NOT NULL,
  `b_date` date NOT NULL,
  `sex` varchar(10) NOT NULL,
  `st_brgy` varchar(255) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `c_status` varchar(20) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `cp_number` varchar(20) NOT NULL,
  `email_add` varchar(255) NOT NULL,
  `college` varchar(255) NOT NULL,
  `y_level` varchar(20) NOT NULL,
  `course` varchar(255) NOT NULL,
  `major` varchar(255) NOT NULL,
  `grade_sem_1` varchar(11) NOT NULL,
  `grade_sem_1_percent` varchar(10) NOT NULL,
  `grade_sem_2` varchar(11) NOT NULL,
  `grade_sem_2_percent` varchar(10) NOT NULL,
  `remarks` varchar(11) NOT NULL,
  `cpce` varchar(255) DEFAULT NULL,
  `cpce_cp_number` varchar(255) DEFAULT NULL,
  `nstp_component` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_20_columns_lts`
--

INSERT INTO `tbl_20_columns_lts` (`std_id`, `l_name`, `f_name`, `m_name`, `ex_name`, `b_date`, `sex`, `st_brgy`, `municipality`, `province`, `c_status`, `religion`, `cp_number`, `email_add`, `college`, `y_level`, `course`, `major`, `grade_sem_1`, `grade_sem_1_percent`, `grade_sem_2`, `grade_sem_2_percent`, `remarks`, `cpce`, `cpce_cp_number`, `nstp_component`, `username`, `pass`, `created_at`) VALUES
(1, 'Boone', 'Ray', 'Brock Oneal', 'Shana Deje', '1971-07-11', 'Male', 'Rerum Est Velit Ani', 'Commodi Sed Natus Co', 'Dolorum Neque Laudan', 'Married', 'Incididunt In Commod', '91212121212', 'lodylovoq@mailinator.com', 'Industrial Technology', '3', 'Nostrud Commodi Tota', 'Quis Dolorum Distinc', 'INC', '4.00', '', '', 'Failed', 'Quyn Stephenson', '11121212121', 'LTS', 'lovoves', '$argon2i$v=19$m=65536,t=4,p=1$M2hSVnhLV2N1ck54dFhPQQ$Ozra7V9Xw2k8lucQ/ZwecVfLp2/zm42jHalffmRjII0', '2024-08-25 22:04:46'),
(2, 'Anthony', 'August', 'Shafira Snow', 'Norman Rat', '1970-02-25', 'Female', 'Praesentium Architec', 'Ipsam Mollitia Sed R', 'Ut Ut Laborum Saepe', 'Single', 'Est Qui Id In Volupt', '41412121212', 'pedaseko@mailinator.com', 'Industrial Technology', '1', 'Soluta Eiusmod Dolor', 'Expedita Accusantium', '80', '2.50', '76', '3.00', 'Passed', 'Dolan Robinson', '93712121212', 'LTS', 'foxag', '$argon2i$v=19$m=65536,t=4,p=1$aFdLbkM0dzYwMXE0VVZCOQ$LQngPkBZ4yoRxMOzrb5PoZuWhvHor6yEgJmgqAvUUxc', '2024-08-25 22:07:59'),
(3, 'Higgins', 'Melissa', 'Jillian Bradshaw', 'Jacob Huds', '2011-11-25', 'Male', 'Dolorem Qui Aliquam ', 'Ad Est Dignissimos E', 'Odio Soluta Dolor Iu', 'Married', 'Exercitation Ea Vel ', '91612121212', 'nyfipen@mailinator.com', 'Agriculture', '2', 'Consequat Veritatis', 'Minima Quas Rerum Om', '80', '2.50', '76', '3.00', 'Passed', 'Leah Knight', '37212121212', 'LTS', 'lanopar', '$argon2i$v=19$m=65536,t=4,p=1$dWgxOEtJSlFib1Z6d0l3TA$fXb7PTKiGq/t5SqsUlWFZ8Lo7uT3GHwQZfV8rWHnW5U', '2024-08-25 22:08:45'),
(4, 'Gardner', 'Cyrus', 'Keaton Lester', 'Shafira Fi', '2008-01-15', 'Male', 'Ex Nostrud Et Quaera', 'Quia Commodi In Nece', 'Molestias Et Repelle', 'Married', 'Tempor Consectetur ', '57321121212', 'vosazo@mailinator.com', 'Industrial Technology', '2', 'Adipisicing Sunt So', 'Autem Saepe Magnam N', '76', '3.00', 'DROP', 'DROP', 'Failed', 'Emerald Rice', '20712121212', 'LTS', 'master101', '$argon2i$v=19$m=65536,t=4,p=1$MHgzOU53UFJva0wvUDJtRw$ITwA4NbU0JQBk6X5y0wiDVOzDAXHDScowy7EZO1+R8A', '2024-08-26 07:29:11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `std_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `nstp_component` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`std_id`, `username`, `pass`, `nstp_component`) VALUES
(1, 'admin', '$argon2i$v=19$m=65536,t=4,p=1$S1d0dXJIY0JSSkg5RGYyMQ$7sd0HjSdeeX1v3qmLnPNq4Gegu+30VY7Y9SMSAKkULI', 'ADMIN');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_20_columns_cwts`
--
ALTER TABLE `tbl_20_columns_cwts`
  ADD PRIMARY KEY (`std_id`);

--
-- Indexes for table `tbl_20_columns_lts`
--
ALTER TABLE `tbl_20_columns_lts`
  ADD PRIMARY KEY (`std_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`std_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_20_columns_cwts`
--
ALTER TABLE `tbl_20_columns_cwts`
  MODIFY `std_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_20_columns_lts`
--
ALTER TABLE `tbl_20_columns_lts`
  MODIFY `std_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `std_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
