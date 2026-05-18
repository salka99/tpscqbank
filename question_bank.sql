-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2026 at 12:15 PM
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
-- Database: `question_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(11) UNSIGNED NOT NULL,
  `exam_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `exam_name`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'UPSC Civil Services', 'Union Public Service Commission Civil Services Examination', 'active', '2026-01-16 08:33:56', NULL, NULL),
(2, 'SSC CGL', 'Staff Selection Commission Combined Graduate Level', 'active', '2026-01-16 08:33:56', NULL, NULL),
(3, 'Banking PO', 'Banking Probationary Officer Examination', 'inactive', '2026-01-16 08:33:56', '2026-01-19 05:34:16', NULL),
(9, 'TPSC', ' Tripura Public Service Commission', 'active', '2026-01-16 10:02:01', '2026-01-16 10:03:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2024-01-01-000001', 'App\\Database\\Migrations\\CreateExamsTable', 'default', 'App', 1768552372, 1),
(2, '2024-01-01-000002', 'App\\Database\\Migrations\\CreateSubjectsTable', 'default', 'App', 1768552372, 1),
(3, '2024-01-01-000003', 'App\\Database\\Migrations\\CreateTopicsTable', 'default', 'App', 1768552372, 1),
(4, '2024-01-01-000004', 'App\\Database\\Migrations\\CreateQuestionsTable', 'default', 'App', 1768552372, 1),
(5, '2026-01-22-103040', 'App\\Database\\Migrations\\AuthUsers', 'default', 'App', 1769077884, 2);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) UNSIGNED NOT NULL,
  `exam_id` int(11) UNSIGNED NOT NULL,
  `subject_id` int(11) UNSIGNED NOT NULL,
  `topic_id` int(11) UNSIGNED NOT NULL,
  `question_text` text NOT NULL,
  `answer_text` text NOT NULL,
  `explanation` text DEFAULT NULL,
  `year` int(4) NOT NULL,
  `difficulty_level` enum('Easy','Medium','Hard') NOT NULL DEFAULT 'Medium',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `exam_id`, `subject_id`, `topic_id`, `question_text`, `answer_text`, `explanation`, `year`, `difficulty_level`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 'Who is known as the Father of the Indian Constitution?', 'Dr. B.R. Ambedkar', 'Dr. B.R. Ambedkar was the chairman of the Drafting Committee of the Constituent Assembly and is widely regarded as the Father of the Indian Constitution.', 2023, 'Easy', '2026-01-16 08:33:56', NULL, NULL),
(2, 1, 1, 2, 'What is the full form of GDP?', 'Gross Domestic Product', 'GDP stands for Gross Domestic Product, which is the total monetary value of all finished goods and services produced within a country\'s borders in a specific time period.', 2023, 'Easy', '2026-01-16 08:33:56', NULL, NULL),
(3, 2, 4, 8, 'If 20% of a number is 50, what is 40% of that number?', '100', 'Let the number be x. Then 20% of x = 50, so x = 250. Therefore, 40% of 250 = 100.', 2023, 'Medium', '2026-01-16 08:33:56', NULL, NULL),
(4, 2, 4, 9, 'A shopkeeper sells an article for Rs. 1200 and makes a profit of 20%. What was the cost price of the article?', 'Rs. 1000', 'Selling Price = Rs. 1200, Profit = 20%. Cost Price = (100/120) × 1200 = Rs. 1000.', 2022, 'Medium', '2026-01-16 08:33:56', NULL, NULL),
(5, 3, 7, 10, 'Pointing to a man, a woman said, \"His mother is the only daughter of my mother.\" How is the woman related to the man?', 'Mother', 'The only daughter of the woman\'s mother is the woman herself. So, the woman is the man\'s mother.', 2023, 'Hard', '2026-01-16 08:33:56', NULL, NULL),
(6, 3, 7, 11, 'All roses are flowers. Some flowers are red. Which of the following conclusions can be drawn?', 'Some roses may be red', 'Since all roses are flowers and some flowers are red, it is possible that some roses are red, but it is not necessarily true. The conclusion \"Some roses may be red\" is the most appropriate.', 2022, 'Hard', '2026-01-16 08:33:56', NULL, NULL),
(7, 1, 2, 6, 'In which year did the Quit India Movement start?', '1942', 'The Quit India Movement, also known as the August Movement, was launched by Mahatma Gandhi on 8 August 1942 during World War II.', 2023, 'Easy', '2026-01-16 08:33:56', NULL, NULL),
(15, 9, 20, 26, '<p>Atal Tunnel, the longest tunnel in india, Connects?</p><ol><li>Ladakh</li><li>J&amp; K</li><li>Manali &amp; Ladakh</li><li>Ganga</li></ol>', '<p>Manali and Ladakh</p>', '<p>The Atal Tunnel, the world\'s longest highway tunnel at 9.02 km, is located in Himachal Pradesh and connects Manali to the Lahaul-Spiti valley, which is the gateway to Ladakh. This significantly reduces the distance and travel time between Manali and Keylong and provides all-weather connectivity to parts of Himachal Pradesh and Leh-Ladakh.</p>', 2021, 'Medium', '2026-01-16 10:13:05', '2026-01-17 05:46:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) UNSIGNED NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `exam_id` int(11) UNSIGNED NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_name`, `exam_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'General Studies', 1, 'active', '2026-01-16 08:33:56', NULL, NULL),
(2, 'History', 9, 'active', '2026-01-16 08:33:56', '2026-01-19 06:18:03', NULL),
(3, 'Geography', 1, 'active', '2026-01-16 08:33:56', NULL, NULL),
(4, 'Quantitative Aptitude', 2, 'active', '2026-01-16 08:33:56', NULL, NULL),
(5, 'English', 2, 'active', '2026-01-16 08:33:56', NULL, NULL),
(6, 'General Knowledge', 2, 'active', '2026-01-16 08:33:56', NULL, NULL),
(7, 'Reasoning', 3, 'active', '2026-01-16 08:33:56', NULL, NULL),
(8, 'Quantitative Aptitude', 3, 'active', '2026-01-16 08:33:56', NULL, NULL),
(9, 'English Language', 3, 'active', '2026-01-16 08:33:56', NULL, NULL),
(16, 'Reasoning', 9, 'active', '2026-01-16 08:34:26', '2026-01-19 06:16:19', NULL),
(17, 'Quantitative Aptitude', 9, 'active', '2026-01-16 08:34:26', '2026-01-19 06:14:40', NULL),
(18, 'English Language', 9, 'active', '2026-01-16 08:34:26', '2026-01-19 06:14:08', NULL),
(19, 'New', 1, 'active', '2026-01-16 09:40:18', '2026-01-16 09:40:23', '2026-01-16 09:40:23'),
(20, 'General Studies', 9, 'active', '2026-01-16 10:04:57', '2026-01-16 10:04:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) UNSIGNED NOT NULL,
  `topic_name` varchar(255) NOT NULL,
  `subject_id` int(11) UNSIGNED NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `topic_name`, `subject_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Indian Polity', 1, 'active', '2026-01-16 08:33:56', NULL, NULL),
(2, 'Indian Economy', 1, 'active', '2026-01-16 08:33:56', NULL, NULL),
(3, 'Science & Technology', 1, 'active', '2026-01-16 08:33:56', NULL, NULL),
(4, 'Ancient History', 2, 'active', '2026-01-16 08:33:56', NULL, NULL),
(5, 'Medieval History', 2, 'active', '2026-01-16 08:33:56', NULL, NULL),
(6, 'Modern History', 2, 'active', '2026-01-16 08:33:56', NULL, NULL),
(7, 'Number System', 4, 'active', '2026-01-16 08:33:56', NULL, NULL),
(8, 'Percentage', 4, 'active', '2026-01-16 08:33:56', NULL, NULL),
(9, 'Profit & Loss', 4, 'active', '2026-01-16 08:33:56', NULL, NULL),
(10, 'Blood Relations', 7, 'active', '2026-01-16 08:33:56', '2026-01-16 10:00:30', NULL),
(11, 'Syllogism', 7, 'active', '2026-01-16 08:33:56', NULL, NULL),
(12, 'Coding-Decoding', 7, 'active', '2026-01-16 08:33:56', NULL, NULL),
(13, 'Indian Polity', 1, 'active', '2026-01-16 08:34:33', NULL, NULL),
(14, 'Indian Economy', 1, 'active', '2026-01-16 08:34:33', NULL, NULL),
(15, 'Science & Technology', 1, 'active', '2026-01-16 08:34:33', NULL, NULL),
(16, 'Ancient History', 2, 'active', '2026-01-16 08:34:33', NULL, NULL),
(17, 'Medieval History', 2, 'active', '2026-01-16 08:34:33', NULL, NULL),
(18, 'Modern History', 2, 'active', '2026-01-16 08:34:33', NULL, NULL),
(19, 'Number System', 4, 'active', '2026-01-16 08:34:33', NULL, NULL),
(20, 'Percentage', 4, 'active', '2026-01-16 08:34:33', NULL, NULL),
(21, 'Profit & Loss', 4, 'active', '2026-01-16 08:34:33', NULL, NULL),
(22, 'Blood Relations', 7, 'active', '2026-01-16 08:34:33', NULL, NULL),
(23, 'Syllogism', 7, 'active', '2026-01-16 08:34:33', NULL, NULL),
(24, 'Coding-Decoding', 7, 'active', '2026-01-16 08:34:33', NULL, NULL),
(25, 'vv', 1, 'active', '2026-01-16 09:58:13', '2026-01-16 09:58:18', '2026-01-16 09:58:18'),
(26, 'Current Affairs', 20, 'active', '2026-01-16 10:05:40', '2026-01-16 10:05:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Salka', 'salkadebbarma91@gmail.com', '$2y$10$RvyegUlyy1aB9.a6X7B46u3px/Mh.hRJr43WpufkFUTz3NpNLssWm', '2026-01-22 10:49:34', '2026-01-22 10:49:34'),
(3, 'Ankiyojai Mog', 'salkadebbarma90@gmail.com', '$2y$10$GOsbp96DFNZ5V6QJpuYO.eH3f4ZBg2/wouO/WeiqmX6aoiqvjfxhW', '2026-01-22 11:02:48', '2026-01-22 11:02:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_id` (`exam_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `topic_id` (`topic_id`),
  ADD KEY `year` (`year`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subjects_exam_id_foreign` (`exam_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topics_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `questions_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `questions_topic_id_foreign` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
