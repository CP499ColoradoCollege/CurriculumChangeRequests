-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2021 at 07:32 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proposal-tooldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `tags` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` mediumint(9) NOT NULL,
  `subj_code` varchar(5) NOT NULL,
  `subj_desc` varchar(100) NOT NULL,
  `course_num` int(6) NOT NULL,
  `divs_code` varchar(5) NOT NULL,
  `divs_desc` varchar(100) NOT NULL,
  `dept_code` varchar(10) NOT NULL,
  `dept_desc` varchar(100) NOT NULL,
  `course_title` varchar(200) NOT NULL,
  `course_desc` varchar(1000) NOT NULL,
  `extra_details` varchar(500) NOT NULL DEFAULT '0',
  `enrollment_limit` int(2) NOT NULL,
  `prereqs` varchar(500) NOT NULL DEFAULT '0',
  `units` varchar(10) NOT NULL DEFAULT '0',
  `crosslisting` varchar(200) NOT NULL,
  `perspective` varchar(100) NOT NULL,
  `aligned_assignments` varchar(1000) NOT NULL DEFAULT 'None',
  `first_offering` varchar(10) NOT NULL DEFAULT 'None',
  `designation_scope` varchar(10) NOT NULL DEFAULT 'None',
  `designation_prof` varchar(50) NOT NULL DEFAULT 'None',
  `date_last_modified` varchar(10) NOT NULL DEFAULT '0',
  `related_proposals` varchar(1000) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` mediumint(9) NOT NULL,
  `dept_code` varchar(5) NOT NULL,
  `dept_desc` varchar(100) NOT NULL,
  `divs_code` varchar(5) NOT NULL,
  `divs_desc` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `proposals`
--

CREATE TABLE `proposals` (
  `id` mediumint(9) NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `related_course_id` varchar(100) NOT NULL DEFAULT 'None',
  `proposal_title` varchar(200) NOT NULL,
  `proposal_date` varchar(10) NOT NULL,
  `sub_status` int(3) NOT NULL DEFAULT 0,
  `approval_status` int(3) NOT NULL DEFAULT 0,
  `department` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `criteria` varchar(10) NOT NULL DEFAULT 'None',
  `p_department` varchar(200) NOT NULL DEFAULT 'None',
  `p_course_id` varchar(5) NOT NULL DEFAULT 'None',
  `p_course_title` varchar(200) NOT NULL DEFAULT 'None',
  `p_course_desc` varchar(500) NOT NULL DEFAULT 'None',
  `p_extra_details` varchar(500) NOT NULL DEFAULT 'None',
  `p_limit` varchar(50) NOT NULL DEFAULT 'None',
  `p_prereqs` varchar(500) NOT NULL DEFAULT 'None',
  `p_units` varchar(100) NOT NULL DEFAULT 'None',
  `p_crosslisting` varchar(200) NOT NULL DEFAULT 'None',
  `p_perspective` varchar(100) NOT NULL DEFAULT 'None',
  `rationale` varchar(1000) NOT NULL DEFAULT 'None',
  `lib_impact` varchar(100) NOT NULL DEFAULT 'None',
  `tech_impact` varchar(100) NOT NULL DEFAULT 'None',
  `status` int(1) NOT NULL DEFAULT 1,
  `p_aligned_assignments` varchar(1000) NOT NULL DEFAULT 'None',
  `p_first_offering` varchar(100) NOT NULL DEFAULT 'None',
  `p_course_status` varchar(100) NOT NULL DEFAULT 'None',
  `p_designation_scope` varchar(100) NOT NULL DEFAULT 'None',
  `p_designation_prof` varchar(500) NOT NULL DEFAULT 'None',
  `p_feedback` varchar(1000) NOT NULL DEFAULT 'None'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` mediumint(9) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `department` varchar(200) NOT NULL,
  `position` varchar(200) NOT NULL,
  `permission` int(3) NOT NULL DEFAULT 1,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proposals`
--
ALTER TABLE `proposals`
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
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proposals`
--
ALTER TABLE `proposals`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
