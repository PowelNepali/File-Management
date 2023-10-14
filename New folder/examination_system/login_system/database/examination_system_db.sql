-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2023 at 05:38 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `examination_system_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `examinfo_tbl`
--

CREATE TABLE `examinfo_tbl` (
  `ex_id` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `ex_title` varchar(100) NOT NULL,
  `ex_time_limit` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `examinfo_tbl`
--

INSERT INTO `examinfo_tbl` (`ex_id`, `course_name`, `ex_title`, `ex_time_limit`) VALUES
(67, 'first', 'sarojj', '1'),
(68, 'first', 'sarojj', '1'),
(72, 'first', 'raw', '1'),
(74, 'learn', 'mid-term', '1'),
(75, 'science', 'final term', '5'),
(99, 'scienc', 'final ter', '5'),
(100, 'scienc', 'final ter', '5'),
(101, 'gk', 'first', '1'),
(103, 'moral', 'first', '5'),
(104, 'computer', 'second', '5');

-- --------------------------------------------------------

--
-- Table structure for table `examquestion_tbl`
--

CREATE TABLE `examquestion_tbl` (
  `eqt_id` int(11) NOT NULL,
  `ex_id` int(11) NOT NULL,
  `ex_question` varchar(400) NOT NULL,
  `ex_ch1` varchar(100) NOT NULL,
  `ex_ch2` varchar(100) NOT NULL,
  `ex_ch3` varchar(100) NOT NULL,
  `ex_ch4` varchar(100) NOT NULL,
  `ex_answer` varchar(100) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `examquestion_tbl`
--

INSERT INTO `examquestion_tbl` (`eqt_id`, `ex_id`, `ex_question`, `ex_ch1`, `ex_ch2`, `ex_ch3`, `ex_ch4`, `ex_answer`, `score`) VALUES
(68, 68, '20+20', '40', '41', '43', '34', '1', 3),
(69, 72, '20+20', 'football', 'animal', '30', '40', '4', 1),
(70, 72, 'which ball is a sports ball', 'force is an energy', 'sds', 'basketball', 'fish', '3', 1),
(73, 74, 'who is messi?', 'footballer', 'cricketer', 'wrestler', 'jumper', '1', 2),
(74, 74, 'date of birth of ronaldo', '1980', '1985', '1986', '1990', '4', 2),
(75, 99, 'what is your name?', 'manish', 'payl', 'hari', 'sam', 'manish', 5),
(86, 100, 'what is your name?', 'manish', 'payl', 'hari', 'sam', 'manish', 5),
(87, 101, 'animal', 'ad', 'sa', 'as', 'rgg', 'sa', 5),
(88, 101, 'sauerh', 'q', 'w', 'e', 'd', 'q', 33),
(92, 103, 'who is the founder of nepal?', 'prithvi naryan shah', 'jung bahadur thapa', 'balabadra kunwar', 'jyoti magar', 'prithvi naryan shah', 5),
(93, 103, 'who is the king of jungle ', 'wolf', 'tiger', 'lion', 'leopard', 'lion', 5),
(94, 103, 'what is the capital of qatar', 'lemo', 'brus', 'dhaka', 'haha', 'dhaka', 5),
(95, 104, 'what is computer', 'computer is an electric device which input data, process data and gives output.', 'computer is an device whic travel from one place to another', 'computer is a electronic gazed', 'jhkfjdjdjjfghfjh', 'computer is an electric device which input data, process data and gives output.', 5),
(96, 104, 'what is force?', 'football', '40', 'sdf', 'fish', 'football', 5),
(97, 104, 'which ball is a sports ball', 'football', 'tennis ball', 'basketball', 'volleyball', 'football', 5),
(98, 104, 'manish is a ', 'person', 'animal', 'god', 'fish', 'person', 5),
(99, 104, '20+20', '0', '40', '30', '3', '40', 5);

-- --------------------------------------------------------

--
-- Table structure for table `exam_results`
--

CREATE TABLE `exam_results` (
  `result_id` int(11) NOT NULL,
  `ex_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_questions` bigint(20) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_results`
--

INSERT INTO `exam_results` (`result_id`, `ex_id`, `user_id`, `total_questions`, `score`) VALUES
(66, 101, 5, 2, 50),
(70, 103, 5, 3, 66),
(71, 104, 5, 5, 20),
(72, 104, 8, 5, 60);

-- --------------------------------------------------------

--
-- Table structure for table `public_feedback`
--

CREATE TABLE `public_feedback` (
  `feedback_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `feedback_text` text NOT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `public_feedback`
--

INSERT INTO `public_feedback` (`feedback_id`, `full_name`, `email`, `feedback_text`, `submission_date`) VALUES
(1, 'powel nepali', 'powel@gmail.com', 'its good', '2023-09-21 05:31:21'),
(2, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 05:31:46'),
(3, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 05:34:01'),
(4, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 05:34:08'),
(5, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 05:35:55'),
(6, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 05:35:59'),
(7, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 05:36:55'),
(8, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 05:38:11'),
(9, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 05:38:59'),
(10, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 05:40:57'),
(11, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 05:42:52'),
(12, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 05:44:02'),
(13, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 05:46:01'),
(14, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 05:46:48'),
(15, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 05:47:36'),
(16, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 05:49:13'),
(17, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 05:50:08'),
(18, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 05:51:31'),
(19, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 05:52:09'),
(20, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 05:53:10'),
(21, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 05:53:59'),
(22, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 05:54:36'),
(23, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 05:54:56'),
(24, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 05:55:40'),
(25, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 05:56:12'),
(26, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 05:57:49'),
(27, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 05:58:05'),
(28, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 05:59:22'),
(29, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 06:01:13'),
(30, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 06:01:57'),
(31, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 06:03:51'),
(32, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 06:05:43'),
(33, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 06:06:31'),
(34, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 06:08:06'),
(35, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 06:08:27'),
(36, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 06:10:15'),
(37, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 06:15:24'),
(38, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 06:17:39'),
(39, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 06:18:15'),
(40, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 06:18:30'),
(41, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 06:19:20'),
(42, 'powel nepali', 'powel@gmail.com', 'very good', '2023-09-21 06:20:23');

-- --------------------------------------------------------

--
-- Table structure for table `publish_tbl`
--

CREATE TABLE `publish_tbl` (
  `id` int(11) NOT NULL,
  `result_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ex_id` int(11) NOT NULL,
  `total_questions` bigint(20) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `publish_tbl`
--

INSERT INTO `publish_tbl` (`id`, `result_id`, `user_id`, `ex_id`, `total_questions`, `score`) VALUES
(51, 67, 3, 101, 2, 100),
(52, 66, 5, 101, 2, 50),
(55, 70, 5, 103, 3, 66),
(56, 71, 5, 104, 5, 20),
(57, 72, 8, 104, 5, 60);

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(5, 'paul', 'paul@gmail.com', '$2y$10$IU3tR.ivChUBqGDOG5l4m.Yd0qKBXpWaZSB4D0ISnB7o144bqIxmC', 'user'),
(6, 'sahil bista', 'sahil@gmail.com', '$2y$10$9uc4hTW7pyvY13mpGJE84udUPo3smdW.8jUuf5hD1B8OQhm55sOfm', 'teacher'),
(7, 'Powel Nepali', 'powel8686@gmail.com', '$2y$10$2zPDLZ8lDjbPPYbFkRPIFOfSjSPqC6RVU9RJ5MvzgPxuZr.m4N7GK', 'admin'),
(8, 'manish khadka', 'manish@gmail.com', '$2y$10$Gya4XcAyR7JJ.eCkWt7O7e85a771CEYAKILUiFZsbXs1CmBBKC0U6', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `examinfo_tbl`
--
ALTER TABLE `examinfo_tbl`
  ADD PRIMARY KEY (`ex_id`);

--
-- Indexes for table `examquestion_tbl`
--
ALTER TABLE `examquestion_tbl`
  ADD PRIMARY KEY (`eqt_id`);

--
-- Indexes for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD PRIMARY KEY (`result_id`);

--
-- Indexes for table `publish_tbl`
--
ALTER TABLE `publish_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `examinfo_tbl`
--
ALTER TABLE `examinfo_tbl`
  MODIFY `ex_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `examquestion_tbl`
--
ALTER TABLE `examquestion_tbl`
  MODIFY `eqt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `exam_results`
--
ALTER TABLE `exam_results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `publish_tbl`
--
ALTER TABLE `publish_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
