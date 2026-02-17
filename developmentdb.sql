-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jan 16, 2026 at 07:46 PM
-- Server version: 12.0.2-MariaDB-ubu2404
-- PHP Version: 8.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `developmentdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `DrivingLessons`
--

CREATE TABLE `DrivingLessons` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `lesson_date` date NOT NULL,
  `start_time` time NOT NULL,
  `duration_minutes` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `DrivingLessons`
--

INSERT INTO `DrivingLessons` (`id`, `student_id`, `lesson_date`, `start_time`, `duration_minutes`, `created_at`, `updated_at`) VALUES
(6, 3, '2025-12-25', '17:51:00', 90, '2025-12-24 15:51:16', '2025-12-24 15:51:16'),
(15, 3, '2025-12-31', '14:00:00', 100, '2025-12-25 23:58:22', '2025-12-25 23:58:22'),
(17, 3, '2026-01-15', '10:00:00', 90, '2026-01-14 01:44:06', '2026-01-14 01:44:06'),
(18, 3, '2026-03-05', '13:40:00', 100, '2026-01-16 18:34:29', '2026-01-16 18:34:29');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `question` varchar(500) NOT NULL,
  `answer` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`) VALUES
(1, 'How long are the driving lessons in an urgent driving course?', 'In an urgent driving course, lessons typically take between 3 and 4 hours. These extended sessions give the driving school ample time to train you thoroughly and get you ready for the practical test. Because the lessons are longer, they demand a high level of focus, so it’s essential to arrive well rested for every session.'),
(2, 'How many hours do I need to pass?', 'There is no fixed number of hours needed to pass, as this varies for each individual. During the trial lesson, the instructor can assess your driving skills and give you a realistic indication of how many hours of instruction may be necessary.'),
(3, 'What does a trial lesson cost?', 'The trial lesson requires a one-time payment of €55. However, if you choose to continue taking driving lessons, this amount will be deducted from the total price of your lesson package. This means that the trial lesson effectively becomes free when you proceed with lessons at Nationale Rijschool.');

-- --------------------------------------------------------

--
-- Table structure for table `IndividualPrices`
--

CREATE TABLE `IndividualPrices` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `price` int(11) NOT NULL,
  `category` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `IndividualPrices`
--

INSERT INTO `IndividualPrices` (`id`, `title`, `price`, `category`) VALUES
(1, 'Intake incl. trial lesson', 55, 'General'),
(2, 'Driving lesson 60 min', 65, 'General'),
(3, 'Driving lesson English 60 min', 69, 'General'),
(4, 'Automatic driving lesson 60 min', 69, 'General'),
(5, 'Practical exam', 290, 'General'),
(6, 'Interim test', 210, 'General'),
(7, 'Online theory', 50, 'Theory'),
(8, 'Theory exam', 50, 'Theory'),
(9, 'Classroom theory', 150, 'Theory'),
(10, '10 lesson package', 640, 'Manual'),
(11, '15 lesson package', 960, 'Manual'),
(12, '20 lesson package', 1280, 'Manual'),
(13, '10 lesson package', 680, 'Automatic'),
(14, '15 lesson package', 1020, 'Automatic'),
(15, '20 lesson package', 1360, 'Automatic');

-- --------------------------------------------------------

--
-- Table structure for table `Packages`
--

CREATE TABLE `Packages` (
  `id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `price` int(11) NOT NULL,
  `type` varchar(64) NOT NULL,
  `trial_lesson` tinyint(1) NOT NULL DEFAULT 1,
  `exam_included` tinyint(1) NOT NULL,
  `lesson_count` int(11) NOT NULL,
  `interim_test` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `Packages`
--

INSERT INTO `Packages` (`id`, `title`, `price`, `type`, `trial_lesson`, `exam_included`, `lesson_count`, `interim_test`) VALUES
(1, 'Experienced Driver', 935, 'Manual', 1, 1, 20, 1),
(2, 'Average Driver', 1799, 'Manual', 1, 1, 30, 1),
(3, 'Beginner', 2199, 'Manual', 1, 1, 40, 0),
(4, 'Urgent Driving Licence', 2599, 'Manual', 1, 1, 35, 0),
(5, 'Experienced Driver', 1035, 'Automatic', 1, 1, 20, 1),
(6, 'Average Driver', 1899, 'Automatic', 1, 1, 30, 1),
(7, 'Beginner', 2299, 'Automatic', 1, 1, 40, 0),
(8, 'Urgent Driving Licence', 2699, 'Automatic', 1, 1, 35, 0);

-- --------------------------------------------------------

--
-- Table structure for table `PasswordResets`
--

CREATE TABLE `PasswordResets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `token_expiry` datetime NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `PasswordResets`
--

INSERT INTO `PasswordResets` (`id`, `user_id`, `token`, `token_expiry`, `created_at`) VALUES
(16, 7, '6662b162dd00b9e537402b467eb9ffacf80afc5241bf0400cd6650347da5ce3e', '2025-12-25 01:14:55', '2025-12-25 00:14:55');

-- --------------------------------------------------------

--
-- Table structure for table `Reviews`
--

CREATE TABLE `Reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `review` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `Reviews`
--

INSERT INTO `Reviews` (`id`, `name`, `review`) VALUES
(1, 'Kamran Ahmed', 'trouble'),
(2, 'Kamran Ahmed', 'good'),
(3, 'Kamran Ahmed', 'good'),
(4, 'Kamaal Ahmed', 'finally working, I am happy, going to work on other stuff, good school, keep driving up'),
(5, 'Musawir Ahmed', 'keep going'),
(20, 'Ehtisham', 'Kya baat G');

-- --------------------------------------------------------

--
-- Table structure for table `Students`
--

CREATE TABLE `Students` (
  `id` int(11) NOT NULL,
  `firstname` varchar(128) NOT NULL,
  `lastname` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `mobile` varchar(64) NOT NULL,
  `dateofbirth` date NOT NULL,
  `street_house` varchar(128) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `residenceplace` varchar(64) NOT NULL,
  `type` enum('Trial Student','Regular Student') NOT NULL DEFAULT 'Trial Student',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `Students`
--

INSERT INTO `Students` (`id`, `firstname`, `lastname`, `email`, `mobile`, `dateofbirth`, `street_house`, `postcode`, `residenceplace`, `type`, `user_id`) VALUES
(3, 'Faizan', 'Ahmed', 'd.radcliffe.hp@gmail.com', '31687296715', '2009-07-16', 'Mastbos 192', '2134 NV', 'Hoofddorp', 'Regular Student', 4),
(6, 'Kamran', 'Ahmed', 'assndend@gmail.com', '31687296715', '2010-01-02', 'Mastbos 192', '2134 NV', 'Hoofddorp', 'Trial Student', 8),
(8, 'Kamran', 'Ahmed', 'ssssssss@gmail.com', '31686391706', '2010-01-04', 'Mastbos 192', '2134 NV', 'Hoofddorp', 'Trial Student', 6),
(16, 'Kamran', 'Ahmed', 'd.radclip@gmail.com', '0687296715', '2010-01-06', 'Mastbos 192', '2134 NV', 'Hoofddorp', 'Trial Student', 6);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(128) NOT NULL,
  `lastname` varchar(128) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(64) NOT NULL,
  `role` varchar(64) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `firstname`, `lastname`, `username`, `password`, `email`, `role`) VALUES
(2, 'Kamaal', 'Ahmed', 'KamaalAhmed', '$2y$12$hHXnNsyf9uSPe0ivY5pE..Ztk9dO32Ru123MBoFBvEsFjNZJmXbG6', 'kamaal@gmail.com', 'user'),
(3, 'Kamran', 'Ahmed', 'KamranAhmed1', '$2y$12$fUZw2XuyU9T1XUaDGpwzfOhHWKfO6.19gD6HbEVlJaazYsA/8rW8W', 'd.radcliffe@gmail.com', 'user'),
(4, 'Faizan', 'Ahmed', 'FaizanAhmed', '$2y$12$InUPUJvQcqKH4fIaVR6Lp.bFPlgON8gG3BIiJdKzLzcHXRYyXfNg.', 'faizan@gmail.com', 'user'),
(6, 'Kane', 'Williamson', 'Kane123', '$2y$12$dTJY3BVePd4RWG4wvdJ2IetH.Hk4D.gAzjvQz159ca.zjdEM13XRy', 'kane123@gmail.com', 'admin'),
(7, 'Musawir', 'Ahmed', 'MusawirAhmed', '$2y$12$jzCcP03x4ZUQ/jiTSRbGweO4pVgqrPETTUA/y1l.Nk2Nr.P1KGbbO', 'kamranahmedi1272@gmail.com', 'user'),
(8, 'Ehtisham', 'Ahmad', 'Ahmad', '$2y$12$o0B3iVMkjQ8Mi8ksEJ9lbeswfGWklNkTxRGYeIn9w8v4pMcLeMsNy', '732625@student.inholland.nl', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `DrivingLessons`
--
ALTER TABLE `DrivingLessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_student` (`student_id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `IndividualPrices`
--
ALTER TABLE `IndividualPrices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Packages`
--
ALTER TABLE `Packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `PasswordResets`
--
ALTER TABLE `PasswordResets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `Reviews`
--
ALTER TABLE `Reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Students`
--
ALTER TABLE `Students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `DrivingLessons`
--
ALTER TABLE `DrivingLessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `IndividualPrices`
--
ALTER TABLE `IndividualPrices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `Packages`
--
ALTER TABLE `Packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `PasswordResets`
--
ALTER TABLE `PasswordResets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `Reviews`
--
ALTER TABLE `Reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `Students`
--
ALTER TABLE `Students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `DrivingLessons`
--
ALTER TABLE `DrivingLessons`
  ADD CONSTRAINT `fk_student` FOREIGN KEY (`student_id`) REFERENCES `Students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `PasswordResets`
--
ALTER TABLE `PasswordResets`
  ADD CONSTRAINT `PasswordResets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
