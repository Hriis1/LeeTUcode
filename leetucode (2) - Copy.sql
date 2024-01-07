-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2023 at 06:15 PM
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
-- Database: `leetucode`

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `requirements` text NOT NULL,
  `description` text NOT NULL,
  `creator_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `requirements`, `description`, `creator_id`, `created_at`, `updated_at`) VALUES
(1, 'Busted course', 'ludak :)', 'za ludaci', 1, '2023-11-19 19:01:41', '2023-11-19 19:01:41'),
(2, 'Busted course 2', 'ludak2 :)', 'za ludaci2', 1, '2023-11-19 19:03:35', '2023-11-19 19:03:35'),
(4, 'mmmmega course', 'mega ludak', 'za mega ludaci', 1, '2023-12-09 19:40:18', '2023-12-09 19:40:18'),
(5, 'gigigia course', 'giga ludak', 'za giga ludaci', 8, '2023-12-09 19:40:50', '2023-12-09 19:40:50');

-- --------------------------------------------------------

--
-- Table structure for table `course_members`
--

DROP TABLE IF EXISTS `course_members`;
CREATE TABLE `course_members` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `course_members`
--

INSERT INTO `course_members` (`id`, `course_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2023-11-19 19:58:58', '2023-11-19 19:58:58'),
(2, 1, 2, '2023-11-19 19:59:13', '2023-11-19 19:59:13'),
(3, 2, 1, '2023-11-19 20:00:39', '2023-11-19 20:00:39'),
(4, 1, 3, '2023-11-19 20:01:17', '2023-11-19 20:01:17'),
(6, 1, 9, '2023-12-02 00:03:45', '2023-12-02 00:03:45'),
(7, 4, 1, '2023-12-09 19:40:18', '2023-12-09 19:40:18'),
(8, 5, 8, '2023-12-09 19:40:50', '2023-12-09 19:40:50'),
(9, 5, 1, '2023-12-09 19:41:14', '2023-12-09 19:41:14');

-- --------------------------------------------------------

--
-- Table structure for table `course_tasks`
--

DROP TABLE IF EXISTS `course_tasks`;
CREATE TABLE `course_tasks` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `function_name` varchar(50) NOT NULL,
  `function_declaration` varchar(100) NOT NULL,
  `test_cases` text NOT NULL,
  `test_answers` text NOT NULL,
  `course_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `difficulty` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `course_tasks`
--

INSERT INTO `course_tasks` (`id`, `name`, `description`, `function_name`, `function_declaration`, `test_cases`, `test_answers`, `course_id`, `created_at`, `updated_at`, `difficulty`) VALUES
(1, 'busted task1', 'napishi busted funkciq', 'bustedFunc', 'int bustedFunc(int a, int b)', '1,2@@@2,5@@@5,5', '3@@@7@@@10', 1, '2023-11-19 19:24:33', '2023-11-19 19:24:33', 'easy'),
(2, 'busted task2', 'napishi busted funkciq', 'bustedFunc', 'int bustedFunc(int a, int b)', '1,2@@@2,5@@@5,5', '3@@@7@@@10', 1, '2023-11-19 19:27:56', '2023-11-19 19:27:56', 'easy'),
(3, 'mega task', 'napishi busted funkciq', 'bustedFunc', 'int bustedFunc(int a, int b)', '1,2@@@2,5@@@5,5', '3@@@7@@@10', 2, '2023-11-19 19:28:45', '2023-11-19 19:28:45', 'easy'),
(4, 'busted task3', 'napishi busted funkciq', 'bustedFunc', 'int bustedFunc(int a, int b)', '1,2@@@2,5@@@5,5', '3@@@7@@@10', 1, '2023-11-19 19:34:50', '2023-11-19 19:34:50', 'easy');

-- --------------------------------------------------------

--
-- Table structure for table `task_submitions`
--

DROP TABLE IF EXISTS `task_submitions`;
CREATE TABLE `task_submitions` (
  `id` int(11) NOT NULL,
  `submited_function` text NOT NULL,
  `submition_status` varchar(20) NOT NULL DEFAULT 'fail',
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `response` text NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `task_submitions`
--

INSERT INTO `task_submitions` (`id`, `submited_function`, `submition_status`, `task_id`, `user_id`, `created_at`, `updated_at`, `response`) VALUES
(1, 'int bustedFunc(int a, int b) {return a+b;}', 'success', 1, 2, '2023-11-19 19:42:34', '2023-11-19 19:42:34', ''),
(2, 'int bustedFunc(int a, int b) {return a+b+1;}', 'error', 1, 2, '2023-11-19 19:43:07', '2023-11-19 19:43:07', ''),
(4, 'int bustedFunc(int a, int b) {return a+b;}', 'fail', 2, 1, '2023-11-19 19:43:32', '2023-11-19 19:43:32', ''),
(17, 'int bustedFunc(int a, int b)\r\n{\r\n	return a+b\r\n}', 'error', 2, 9, '2023-11-29 18:10:59', '2023-11-29 18:10:59', '\nmain.cpp: In function \'int bustedFunc(int, int)\':\nmain.cpp:39:12: error: expected \';\' before \'}\' token\n  return a+b\n            ^\n            ;\n }\n ~           \n'),
(18, 'int bustedFunc(int a, int b)\r\n{\r\n	return a+b+1;\r\n}', 'fail', 2, 9, '2023-11-29 18:11:36', '2023-11-29 18:11:36', 'Input: 1,2\nYour answer: 4\nExpected answer: 3\n'),
(19, 'int bustedFunc(int a, int b)\r\n{\r\n	return a+b;\r\n}', 'success', 2, 9, '2023-11-29 18:12:44', '2023-11-29 18:12:44', 'All tests cleared!');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(300) NOT NULL,
  `account_type` varchar(10) NOT NULL DEFAULT 'student',
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `pass`, `account_type`, `created_on`, `updated_on`) VALUES
(1, 'teacher1', 'teacher1@example.com', '$2y$12$iVjSlhKbjntwqoFbFTcRvOg6z0dPZ7K4gTcemTT1Kuu/Fjl81bEza', 'teacher', '2023-11-18 19:07:41', '2023-11-18 19:07:41'),
(2, 'student1', 'student1@example.com', '$2y$12$agmMb62xruyqOynNtghaMemy651rtnAghty9xmKP6fDEP9WXsOuW2', 'student', '2023-11-19 19:14:59', '2023-11-19 19:14:59'),
(3, 'student2', 'student2@example.com', '$2y$12$qFJG5WraSMr4XXmZOQBXTev5QmW7iMZs25DHs8lqLbhj8S8VF8xlm', 'student', '2023-11-19 19:15:25', '2023-11-19 19:15:25'),
(6, 'student3', 'student3@ex.com', '$2y$12$LoJcGJBKFXpQVz1XB8UVCeN/L4amR9RUAga9r6D0.BYytHhiivWrq', 'student', '2023-11-19 23:15:21', '2023-11-19 23:15:21'),
(8, 'teacher2', 'teach@yy.bg', '$2y$12$wNf4EIE0T5E2ANU6nJgriefdVzg36wxbFSXu.XhwPdkhG0/sqniem', 'teacher', '2023-11-19 23:16:40', '2023-11-19 23:16:40'),
(9, 'luvcho', 'luvut@abv.bg', '$2y$12$3lVZgBMOz5FUFAxCQejzN.sfT9YVumEWhACldP8710m7vudgtrsCO', 'student', '2023-11-19 23:37:13', '2023-11-19 23:37:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creator_id` (`creator_id`);

--
-- Indexes for table `course_members`
--
ALTER TABLE `course_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `course_tasks`
--
ALTER TABLE `course_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `task_submitions`
--
ALTER TABLE `task_submitions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_id` (`task_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course_members`
--
ALTER TABLE `course_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `course_tasks`
--
ALTER TABLE `course_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `task_submitions`
--
ALTER TABLE `task_submitions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `course_members`
--
ALTER TABLE `course_members`
  ADD CONSTRAINT `course_members_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `course_members_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `course_tasks`
--
ALTER TABLE `course_tasks`
  ADD CONSTRAINT `course_tasks_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `task_submitions`
--
ALTER TABLE `task_submitions`
  ADD CONSTRAINT `task_submitions_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `course_tasks` (`id`),
  ADD CONSTRAINT `task_submitions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
