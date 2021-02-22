-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 11, 2019 at 04:43 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new`
--

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
  `enrollment_limit` int(2) Not NULL,
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
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `subj_code`, `subj_desc`, `course_num`, `divs_code`, `divs_desc`, `dept_code`, `dept_desc`, `course_title`, `course_desc`, `extra_details`, `enrollment_limit`, `prereqs`, `units`, `crosslisting`, `perspective`, `aligned_assignments`, `first_offering`, `designation_scope`, `designation_prof`, `date_last_modified`, `related_proposals`, `status`) VALUES
(1, 'CP', 'Computer Science', 122, 'N', 'Natural Sciences', 'MATH', 'Mathematics & Computer Science', 'Computer Science I', 'Introduction to algorithms and data structures, and the design of computer programs using the programming language Java. This course requires some experience in programming.', '<i>Prerequisite: </i>Computer Science 115 or consent of instructor. (Meets the Critical Perspectives:  Quantitative Reasoning requirement.) 1 unit - Burge, Wellman.', 25, 'Prerequisite: Computer Science 115 or consent of instructor.', '1 unit', '', '', '', '', '', '', '0', '0', 1),
(2, 'CP', 'Computer Science', 222, 'N', 'Natural Sciences', 'MATH', 'Mathematics & Computer Science', 'Computer Science II', 'Examination of algorithms for searching, sorting, and manipulation of data structures. Exploration of queues, stacks, trees, and graphs using a variety of design techniques including recursion and object-oriented programming.', '<i>Prerequisite: </i>Computer Science 122. (Meets the Critical Perspectives:  Quantitative Reasoning requirement.) 1 unit - Ellsworth.', 25, 'Prerequisite: Computer Science 122.', '1 unit', '', '', '', '', '', '', '0', '0', 1),
(3, 'CP', 'Computer Science', 275, 'N', 'Natural Sciences', 'MATH', 'Mathematics & Computer Science', 'Computer Organization', 'Exploration of the design and organization of computer processors, memory, and operating systems. Topics include processor architecture, digital circuits, memory management, scheduling, file systems, assembly language, and peripheral device control.', '<i>Prerequisite: </i>Computer Science 222. 1 unit - Ylvisaker.', 25,  'Prerequisite: Computer Science 222.', '1 unit', '', '', '', '', '', '', '0', '0', 1),
(4, 'CP', 'Computer Science', 341, 'N', 'Natural Sciences', 'MATH', 'Mathematics & Computer Science', 'Topics in Computer Science', 'Special topics in computer science not offered on a regular basis.', '<i>Prerequisite: </i>Computer Science 222, Computer Science 274, Computer Science 275. 1 unit - Burge, Ellsworth, Erickson, Ylvisaker.', 25, 'Prerequisite: Computer Science 222, Computer Science 274, Computer Science 275.', '1 unit', '', '', '', '', '', '', '0', '0', 1);

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
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `dept_code`, `dept_desc`, `divs_code`, `divs_desc`, `status`) VALUES
(103, 'ART', 'Art', 'H', 'Humanities', 1),
(104, 'ANTH', 'Anthropology', 'S', 'Social Sciences', 1),
(105, 'BIOL', 'Biology', 'N', 'Natural Sciences', 1),
(106, 'CLAS', 'Classics', 'H', 'Humanities', 1),
(107, 'GRRU', 'German, Russian & E Asian Lang', 'H', 'Humanities', 1),
(108, 'COLI', 'Comparative Literature', 'H', 'Humanities', 1),
(109, 'MATH', 'Mathematics & Computer Science', 'N', 'Natural Sciences', 1),
(110, 'CHBI', 'Chemistry & Biochemistry', 'N', 'Natural Sciences', 1),
(111, 'EDUC', 'Education', 'S', 'Social Sciences', 1),
(112, 'DRDA', 'Drama & Dance', 'H', 'Humanities', 1),
(113, 'ENSC', 'Environmental Science', 'N', 'Natural Sciences', 1),
(114, 'ENGL', 'English', 'H', 'Humanities', 1),
(115, 'NOST', 'Non-Departmental Studies', '*', 'Non-Divisional', 1),
(116, 'ROLA', 'Romance Languages', 'H', 'Humanities', 1),
(117, 'FEGE', 'Feminist & Gender Studies', 'H', 'Humanities', 1),
(118, 'HIST', 'History', 'S', 'Social Sciences', 1),
(119, 'GEOL', 'Geology', 'N', 'Natural Sciences', 1),
(120, 'RELI', 'Religion', 'H', 'Humanities', 1),
(121, 'MUSI', 'Music', 'H', 'Humanities', 1),
(122, 'POSC', 'Political Science', 'S', 'Social Sciences', 1),
(123, 'PHIL', 'Philosophy', 'H', 'Humanities', 1),
(124, 'PSYC', 'Psychology', 'N', 'Natural Sciences', 1),
(125, 'PHYS', 'Physics', 'N', 'Natural Sciences', 1),
(126, 'SOCI', 'Sociology', 'S', 'Social Sciences', 1),
(127, 'SOST', 'Southwest Studies', 'S', 'Social Sciences', 1),
(128, 'SPAN', 'Spanish', 'H', 'Humanities', 1),
(129, 'FINM', 'Film and New Media Studies', 'H', 'Humanities', 1),
(130, 'THDA', 'Theatre and Dance', 'H', 'Humanities', 1),
(131, 'HUBI', 'Human Biology and Kinesiology', 'N', 'Natural Sciences', 1),
(132, 'FRIT', 'French & Italian', 'H', 'Humanities', 1),
(133, 'ASST', 'Asian Studies', 'H', 'Humanities', 1),
(134, 'ECBU', 'Economics & Business', 'S', 'Social Sciences', 1),
(135, 'MOBI', 'Molecular Biology', 'N', 'Natural Sciences', 1),
(136, 'FRIA', 'French, Italian, and Arabic', 'H', 'Humanities', 1),
(137, 'ORBI', 'Organismal Biology & Ecology', 'N', 'Natural Sciences', 1),
(138, '0000', 'Undeclared', '*', 'Non-Divisional', 1),
(139, 'REMS', 'Race, Ethnicity, and Migration', '*', 'Non-Divisional', 1),
(140, 'SPPO', 'Spanish & Portuguese', 'H', 'Humanities', 1);

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
  `sub_status` int(3) NOT NULL DEFAULT '0',
  `approval_status` int(3) NOT NULL DEFAULT '0',
  `department` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `criteria` varchar(15) NOT NULL DEFAULT 'None',
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
  `status` int(1) NOT NULL DEFAULT '1',
  `p_aligned_assignments` varchar(1000) NOT NULL DEFAULT 'None',
  `p_first_offering` varchar(10) NOT NULL DEFAULT 'None',
  `p_course_status` varchar(100) NOT NULL DEFAULT 'None',
  `p_designation_scope` varchar(10) NOT NULL DEFAULT 'None',
  `p_designation_prof` varchar(50) NOT NULL DEFAULT 'None',
  `p_feedback` varchar(1000) NOT NULL DEFAULT 'None'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proposals`
--

INSERT INTO `proposals` (`id`, `user_id`, `related_course_id`, `proposal_title`, 
`proposal_date`, `sub_status`, `approval_status`, `department`, `type`, `criteria`, 
`p_department`, `p_course_id`, `p_course_title`, `p_course_desc`, `p_extra_details`, 
`p_limit`, `p_prereqs`, `p_units`, `p_crosslisting`, `p_perspective`, `rationale`, 
`lib_impact`, `tech_impact`, `status`, `p_aligned_assignments`, `p_first_offering`, 
`p_course_status`, `p_designation_scope`, `p_designation_prof`, `p_feedback`) VALUES
(33, 1, 'None', 'New Course: 20304, Sociology of Performance', '02/07/2019', 0, 0, 
'Sociology', 'Add a New Course', 'None', 'None', '20304', 'Sociology of Performance', 
'This course will focus on qualitative sociological methods in collaboration with the 
performing arts. Students will learn how to translate interview data into creative expression.', 
'None', '', 'None', '1 Unit', 'None', 'None', 'This course links the social sciences to the humanities, 
enabling students to perform information gained from interviews.', 'None', 'None', 1, 
'Probably a a dance routine', 'Spring 2027', 'None', 'All Sections of Course', 'N/A', 'None'),
(42, 2, 'None', 'New Course: CP999, Super Hard CS Class', '02/11/2019', 0, 0, 
'Mathematics & Computer Science', 'Add a New Course', 'None', 'None', 'CP999', 
'Super Hard CS Class', 'This class is super hard.', '', '', 'none', '1 Unit', 'None', 
'None', 'We need more CS courses.', 'None', 'None', 1, 'Probably a video game', 'Winter 2077', 
'None', 'All Sections of Course', 'N/A', 'None'),
(43, 2, 'CP122', 'Change Title, Description, Extra Details, Limit of Course: CP122, 
Computer Science I', '02/11/2019', 0, 0, 'Mathematics & Computer Science', 
'Change an Existing Course', '2345', 'None', '', 'Computer Science One', 
'Take out the numerals.', '', '25', '', '', 'None', 'None', 'wanted to make a few changes.', 
'None', 'None', 1, 'None', 'Spring 2037', 'None', 'All Sections of Course', 'N/A', 'None'),
(44, 2, 'CP122', 'Remove Course: CP122, Computer Science I', '02/11/2019', 0, 0, 
'Mathematics & Computer Science', 'Remove an Existing Course', 'None', 'None', 'None', 
'None', 'None', 'None', 'None', 'None', 'None', 'None', 'None', 'gotta drop it!!', 'None', 'None', 1, 
'Nothing!', 'Spring 2027', 'None', 'All Sections of Course', 'N/A', 'None');

-- --------------------------------------------------------

--
-- Table structure for table `proposals`
--

CREATE TABLE `proposalhistory` (
  `history_id` mediumint(9) NOT NULL,
  `id` mediumint(9) NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `related_course_id` varchar(100) NOT NULL DEFAULT 'None',
  `proposal_title` varchar(200) NOT NULL,
  `proposal_date` varchar(10) NOT NULL,
  `sub_status` int(3) NOT NULL DEFAULT '0',
  `approval_status` int(3) NOT NULL DEFAULT '0',
  `department` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `criteria` varchar(15) NOT NULL DEFAULT 'None',
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
  `status` int(1) NOT NULL DEFAULT '1',
  `p_aligned_assignments` varchar(1000) NOT NULL DEFAULT 'None',
  `p_first_offering` varchar(10) NOT NULL DEFAULT 'None',
  `p_course_status` varchar(100) NOT NULL DEFAULT 'None',
  `p_designation_scope` varchar(10) NOT NULL DEFAULT 'None',
  `p_designation_prof` varchar(50) NOT NULL DEFAULT 'None',
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
  `permission` int(3) NOT NULL DEFAULT '1',
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `first_name`, `last_name`, `username`, `department`, `position`, `permission`, `status`) VALUES
(1, 'admin@proposals.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Sys', 'Admin', 'c_kennedy', 'N/A', 'N/A', 1, 1),
(2, 'c_kennedy@coloradocollege.edu', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Christian', 'Kennedy', 'c_kennedy', 'Mathematics & Computer Science', 'professor', 1, 1);

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
-- Indexes for table `proposalhistory`
--
ALTER TABLE `proposalhistory`
  ADD PRIMARY KEY (`history_id`);

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
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `proposals`
--
ALTER TABLE `proposals`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
  
--
-- AUTO_INCREMENT for table `proposalhistory`
--
ALTER TABLE `proposalhistory`
  MODIFY `history_id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
