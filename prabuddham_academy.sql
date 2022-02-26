-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2022 at 11:34 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prabuddham_academy`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `id` int(11) NOT NULL,
  `contact_id` int(6) DEFAULT NULL,
  `mobile` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `altMobile` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`id`, `contact_id`, `mobile`, `altMobile`, `email`, `address`, `created_at`, `updated_at`, `status`) VALUES
(1, 970682, '9060781860', '9060781887', 'nkflicktechnology@gmail.comes', 'Purnia', '2022-02-08 15:01:21', '2022-02-09 15:45:57', 1);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_id` int(10) DEFAULT NULL,
  `courseName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `courseTitle` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `courseDetails` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `courseImage` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_id`, `courseName`, `courseTitle`, `courseDetails`, `courseImage`, `slug`, `created_at`, `updated_at`, `status`) VALUES
(1, 317136, 'Class 8', 'Class 8', '<p><strong>Class</strong> 8 course details here...</p>', 'course-1644330279.jpg', 'class-8', '2022-02-08 14:24:39', NULL, 1),
(2, 458153, 'Class 9', 'Class 9', '<p>Class 9</p>', 'course-1644330338.png', 'class-9', '2022-02-08 14:25:38', '2022-02-08 14:25:38', 1);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `eventID` bigint(25) NOT NULL,
  `eventName` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `eventTitle` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `eventDetails` longtext COLLATE utf8_unicode_ci NOT NULL,
  `eventImage` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `eventID`, `eventName`, `eventTitle`, `eventDetails`, `eventImage`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 1644485336202202, 'Event', 'Event Title', '<p><strong>Event</strong></p>', 'event-image-1644485336.png', NULL, 1, '2022-02-10 14:58:56', '2022-02-10 14:58:56'),
(2, 1644485660202202, 'Event', 'Event Title', '<p>sdjkbc</p>', 'event-image-1644485660.png', 'event-title', 1, '2022-02-10 15:04:20', '2022-02-10 15:04:20'),
(3, 1644485686202202, 'Event', 'Event Title', '<p>kjwef</p>', 'event-image-1644485686.png', 'Event Title', 1, '2022-02-10 15:04:46', '2022-02-10 15:04:46'),
(4, 1644485754202202, 'Event', 'Event Title', '<p>kjwef</p>', 'event-image-1644485754.png', 'Event Title', 1, '2022-02-10 15:05:54', '2022-02-10 15:05:54'),
(5, 1644486139202202, 'Event', 'Event Title', '<p>kj</p>', 'event-image-1644486139.png', NULL, 1, '2022-02-10 15:12:19', '2022-02-10 15:12:19'),
(6, 1644486386202202, 'Event', 'Event Title', '<p>kj</p>', 'event-image-1644486386.png', 'event-title-2', 1, '2022-02-10 15:16:26', '2022-02-10 15:16:26'),
(7, 1644486423202202, 'Event', 'Event Title', '<p>kjerng</p>', 'event-image-1644486423.png', 'event-title-3', 1, '2022-02-10 15:17:03', '2022-02-10 15:17:03'),
(8, 1644486455202202, 'Event', 'Event Title', '<p>lkern</p>', 'event-image-1644486455.png', 'event-title-4', 1, '2022-02-10 15:17:35', '2022-02-10 15:17:35');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` int(10) NOT NULL,
  `galleryTitle` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `galleryImage` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `galleryTitle`, `galleryImage`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Gallery Title', 'gallery-image-1644487199.png', 1, '2022-02-10 15:29:59', NULL),
(2, 'Gallery Title Second', 'gallery-image-1644487241.png', 1, '2022-02-10 15:30:41', '2022-02-10 15:30:41');

-- --------------------------------------------------------

--
-- Table structure for table `logos`
--

CREATE TABLE `logos` (
  `id` int(11) NOT NULL,
  `logo_id` int(6) NOT NULL,
  `logo` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logoType` tinyint(1) NOT NULL COMMENT '1= Header Logo, 2= Footer Logo and 3= Favicon',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `logos`
--

INSERT INTO `logos` (`id`, `logo_id`, `logo`, `logoType`, `created_at`, `updated_at`, `status`) VALUES
(1, 365581, 'header-logo-1644301004.jpeg', 1, '2022-02-08 06:16:44', NULL, 1),
(2, 366194, 'footer-logo-1644301020.jpeg', 2, '2022-02-08 06:17:00', NULL, 1),
(3, 526303, 'favicon-1644301105.jpeg', 3, '2022-02-08 06:18:25', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(10) NOT NULL,
  `noticeID` bigint(25) NOT NULL,
  `noticeName` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `noticeTitle` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `noticeDetails` longtext COLLATE utf8_unicode_ci NOT NULL,
  `noticeImage` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `noticeID`, `noticeName`, `noticeTitle`, `noticeDetails`, `noticeImage`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 1644488241202202, 'Notice Name', 'Notice Title', '<p><strong>Notice</strong></p>', 'notice-image-1644488241.png', 'notice-title', 1, '2022-02-10 15:47:21', '2022-02-10 15:47:21'),
(2, 1644488355202202, 'Notice Name', 'Notice Title', '<p><strong>Notice Test</strong></p>', 'notice-image-1644488355.png', 'notice-title-2', 1, '2022-02-10 15:49:15', '2022-02-10 15:49:15');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sliderImage` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `sliderImage`, `created_at`, `updated_at`, `status`) VALUES
(1, 'jhjhb', NULL, '2022-02-09 23:11:32', '2022-02-09 23:11:32', 1),
(2, 'kfjn', 'slider-1644428764.jpg', '2022-02-09 23:16:04', '2022-02-09 23:16:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

CREATE TABLE `social_links` (
  `id` int(11) NOT NULL,
  `facebook` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instagram` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `linkedin` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `social_links`
--

INSERT INTO `social_links` (`id`, `facebook`, `instagram`, `linkedin`, `twitter`, `created_at`, `updated_at`, `status`) VALUES
(1, 'https://facebook.com/prabuddham-academy', 'https://instagram.com/prabuddham-academy', 'https://linkedin.com/prabuddham-academy', 'https://twitter.com/prabuddham-academy', '2022-02-08 18:05:19', '2022-02-09 03:27:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `fatherName` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `motherName` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pinCode` int(6) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `role` tinyint(1) NOT NULL COMMENT '1= Admin, 2= Staff, 3= Teacher and 4= Student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `password`, `name`, `email`, `mobile`, `gender`, `dob`, `fatherName`, `motherName`, `city`, `state`, `country`, `address`, `pinCode`, `created_at`, `updated_at`, `status`, `role`) VALUES
(1, '118866', '123456', 'Ankit Raj', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-08 09:53:37', NULL, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logos`
--
ALTER TABLE `logos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_links`
--
ALTER TABLE `social_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `logos`
--
ALTER TABLE `logos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
