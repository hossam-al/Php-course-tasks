-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2025 at 01:44 AM
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
-- Database: `lms2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `lead_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `position_id`, `user_id`, `lead_by`) VALUES
(122, 1, 224, NULL),
(135, 1, 240, 122),
(136, 2, 243, 135),
(137, 2, 244, 136),
(138, 1, 245, 135);

-- --------------------------------------------------------

--
-- Stand-in structure for view `admin_data`
-- (See below for the actual view)
--
CREATE TABLE `admin_data` (
`admin_id` int(11)
,`position_name` varchar(250)
,`user_id` int(11)
,`name` varchar(250)
,`email` varchar(222)
,`type` varchar(250)
,`phone` varchar(20)
,`linkedin` varchar(250)
,`image` varchar(222)
,`lead_by` int(11)
,`leader_name` varchar(250)
);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(1, 'Web Development'),
(2, 'Mobile Development'),
(3, 'Data Science');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `department_id` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `round_id` int(11) NOT NULL,
  `start_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `title`, `department_id`, `instructor_id`, `round_id`, `start_date`) VALUES
(16, 'back_end-web', 1, 36, 2, '2025-04-17');

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `track` varchar(222) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`id`, `department_id`, `track`, `user_id`) VALUES
(36, 3, 'Numquam voluptates repellendus eligendi voluptatibus placeat reiciendis quae.', 186),
(37, 1, 'Ab reprehenderit voluptatem ut blanditiis veritatis iusto.', 193),
(38, 2, 'Vel possimus facere mollitia iusto cum illo minus at.', 196),
(39, 1, 'Architecto qui quia repellat voluptatibus facilis quidem totam.', 246);

-- --------------------------------------------------------

--
-- Stand-in structure for view `instructors_data`
-- (See below for the actual view)
--
CREATE TABLE `instructors_data` (
`id` int(11)
,`name` varchar(250)
,`email` varchar(222)
,`track` varchar(222)
,`type` varchar(250)
,`phone` varchar(20)
,`linkedin` varchar(250)
,`image` varchar(222)
,`user_id` int(11)
,`department_name` varchar(250)
);

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `name`) VALUES
(1, 'manager'),
(2, 'operation'),
(3, 'sales'),
(4, 'HR');

-- --------------------------------------------------------

--
-- Table structure for table `rounds`
--

CREATE TABLE `rounds` (
  `id` int(11) NOT NULL,
  `titlte` varchar(250) NOT NULL,
  `start_date` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rounds`
--

INSERT INTO `rounds` (`id`, `titlte`, `start_date`) VALUES
(1, 'round_32', '2025'),
(2, 'round_30', '');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `group_id`, `user_id`) VALUES
(28, 16, 247);

-- --------------------------------------------------------

--
-- Stand-in structure for view `students_data`
-- (See below for the actual view)
--
CREATE TABLE `students_data` (
`student_id` int(11)
,`name` varchar(250)
,`user_id` int(11)
,`email` varchar(222)
,`image` varchar(222)
,`type` varchar(250)
,`phone` varchar(20)
,`linkedin` varchar(250)
,`group_name` varchar(250)
,`department_id` int(11)
,`department_name` varchar(250)
,`instructor_id` int(11)
,`instructor_name` varchar(250)
,`rounds_id` int(11)
,`rounds_name` varchar(250)
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(222) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(222) NOT NULL,
  `image` varchar(222) DEFAULT NULL,
  `linkedin` varchar(250) DEFAULT NULL,
  `type` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `image`, `linkedin`, `type`) VALUES
(186, 'Josue Ernser', 'your.email+fakedata73259@gmail.com', '051-122-1542', '$2y$10$beDyxM0M.Ww335VEEZEaTecuPcXcDuj/LlT/nHhO4FIBoRoexGPau', NULL, '720-762-7844', 'instructors'),
(193, 'Sienna Glover', 'your.email+fakedata89966@gmail.com', '310-393-1427', '$2y$10$BS2XLlyyihylPCe3ERfIteigwDhP0ZFO7ogGdpMJGevHAn4RqB8i2', NULL, '411-203-9298', 'instructors'),
(196, 'Vern Mayert', 'your.email+fakedata49040@gmail.com', '835-061-8244', '$2y$10$Rthi/jRhopV0lKxH6l9sHeg6wKcoyjFl0ehWvHjOAzvIZnsRnQxcu', NULL, '010-734-2081', 'instructors'),
(206, 'Richie Kuphal', 'your.email+fakedata73466@gmail.com', '1', '$2y$10$a6OPojupuJieYSXRlZC/2OChYDD4mxbjMh/feeiKQkNR36.mQclqG', NULL, '1', 'admin'),
(224, '01014780569', 'hossam@gmail.com', '01014780569', '$2y$10$dFHcOK0pdC.nEdKfay.LsezOHFOTuL.biFrdWmPYms/NamX3Gzn82', '1745966732Screenshot 2025-04-18 191923.png', 'https://www.linkedin.com/in/hossam-ali-34b0a0360/', 'admin'),
(234, 'Hulda Dickinson', 'your.email+fakedata42862@gmail.com', '314-377-5218', '$2y$10$JHgs6e1wqD9GgmDzDe7xv.Ff3GkYrW6xi/8pY0UXt1BxsSqfUnZqC', NULL, 'Rerum reiciendis facilis facilis.', 'admin'),
(236, 'Barry Cole', 'your.email+fakedata88300@gmail.com', '857-822-9748', '$2y$10$P9hZfTHPp5TOiyhEnwpCEOpQX4MyJciVOuRx/V/KrMaVxe5ZTIwWy', NULL, 'Quibusdam quia iusto aperiam recusandae magnam.', 'admin'),
(240, 'Ursula MacGyver', 'your.email+fakedata84054@gmail.com', '126-151-8066', '$2y$10$Z.qYWC4gZe6oisg3auPwLemHc77G4KZjZlYV/DCK8.q904FX7jQa.', NULL, 'Sapiente eos ad sequi.', 'admin'),
(241, 'Tad Senger', 'your.email+fakedata67245@gmail.com', '554-042-1590', '$2y$10$V5E5DZQ.wr4cpuA5aIyv8eFSZewxHsn2R.7OHWNnWUKtjyRveeKN.', NULL, 'Voluptates distinctio maiores voluptates tempora.', 'admin'),
(243, 'Annetta Sporer', 'your.email+fakedata32644@gmail.com', '792-761-3354', '$2y$10$4CsI.1WJFgy4amjlCvPL1uPWZwtQHc8/ibAnKueVaR5LIJsR.QZIO', NULL, 'Excepturi perferendis magni occaecati adipisci.', 'admin'),
(244, 'Albertha Flatley', 'your.email+fakedata77323@gmail.com', '879-276-5777', '$2y$10$PsGKJuop1rasIn2WLfdss.q3ZEWR54TsaBPNDzg4iGS8WR22G31DO', NULL, 'Officia eos voluptatem adipisci nobis facere.', 'admin'),
(245, 'Sammy Carte', 'your.email+fakedata84647@gmail.com', '102-135-5619', '$2y$10$gJpW60AG3O3D1TJFJ6ugfeD./ITL.J1/THZFDY6CktYY5M5X5YyRW', '1750721927بييبيبي.png', 'Quaerat odit optio sit consectetur illum mollitia dolorem animi quidem.', 'admin'),
(246, 'Rudy Howell', 'your.email+fakedata20544@gmail.com', '610-516-6520', '$2y$10$4gbgG3B9LhK1.wiYbW2CoOK.FxV11HCSChvY09s.KQnR1VO/3JX2.', NULL, '795-865-2471', 'instructors'),
(247, 'Jacquelyn Ruecker', 'your.email+fakedata94450@gmail.com', '840-742-3517', '$2y$10$RbS0qrK9E/hqDETEDlaQFOyOuQbfVm2UOaIvw1DliUEg3tTmHDfny', NULL, '460-729-0153', 'student');

-- --------------------------------------------------------

--
-- Structure for view `admin_data`
--
DROP TABLE IF EXISTS `admin_data`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `admin_data`  AS SELECT `ad`.`id` AS `admin_id`, `positions`.`name` AS `position_name`, `users`.`id` AS `user_id`, `users`.`name` AS `name`, `users`.`email` AS `email`, `users`.`type` AS `type`, `users`.`phone` AS `phone`, `users`.`linkedin` AS `linkedin`, `users`.`image` AS `image`, `ad`.`lead_by` AS `lead_by`, `u2`.`name` AS `leader_name` FROM ((((`admins` `ad` join `users` on(`ad`.`user_id` = `users`.`id`)) join `positions` on(`ad`.`position_id` = `positions`.`id`)) left join `admins` `ad2` on(`ad`.`lead_by` = `ad2`.`id`)) left join `users` `u2` on(`ad2`.`user_id` = `u2`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `instructors_data`
--
DROP TABLE IF EXISTS `instructors_data`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `instructors_data`  AS SELECT `i`.`id` AS `id`, `u`.`name` AS `name`, `u`.`email` AS `email`, `i`.`track` AS `track`, `u`.`type` AS `type`, `u`.`phone` AS `phone`, `u`.`linkedin` AS `linkedin`, `u`.`image` AS `image`, `u`.`id` AS `user_id`, `l`.`name` AS `department_name` FROM ((`instructors` `i` join `users` `u` on(`i`.`user_id` = `u`.`id`)) join `departments` `l` on(`l`.`id` = `i`.`department_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `students_data`
--
DROP TABLE IF EXISTS `students_data`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `students_data`  AS SELECT `s`.`id` AS `student_id`, `u`.`name` AS `name`, `u`.`id` AS `user_id`, `u`.`email` AS `email`, `u`.`image` AS `image`, `u`.`type` AS `type`, `u`.`phone` AS `phone`, `u`.`linkedin` AS `linkedin`, `g`.`title` AS `group_name`, `d`.`id` AS `department_id`, `d`.`name` AS `department_name`, `i`.`id` AS `instructor_id`, `iu`.`name` AS `instructor_name`, `g`.`round_id` AS `rounds_id`, `rounds`.`titlte` AS `rounds_name` FROM ((((((`students` `s` join `users` `u` on(`s`.`user_id` = `u`.`id`)) join `groups` `g` on(`s`.`group_id` = `g`.`id`)) join `departments` `d` on(`g`.`department_id` = `d`.`id`)) join `instructors` `i` on(`g`.`instructor_id` = `i`.`id`)) join `users` `iu` on(`i`.`user_id` = `iu`.`id`)) join `rounds` on(`g`.`round_id` = `rounds`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `position_id` (`position_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `lead_by` (`lead_by`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `title` (`title`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `instructor_id` (`instructor_id`),
  ADD KEY `round_id` (`round_id`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rounds`
--
ALTER TABLE `rounds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `user_id` (`user_id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rounds`
--
ALTER TABLE `rounds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_2` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `admins_ibfk_3` FOREIGN KEY (`lead_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `admins_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`round_id`) REFERENCES `rounds` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groups_ibfk_3` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groups_ibfk_4` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `instructors`
--
ALTER TABLE `instructors`
  ADD CONSTRAINT `instructors_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `instructors_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
