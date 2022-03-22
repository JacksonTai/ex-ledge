-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2022 at 02:37 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ex_ledge`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `answer_id` varchar(20) NOT NULL,
  `question_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `content` mediumtext NOT NULL,
  `point` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bookmark_answer`
--

CREATE TABLE `bookmark_answer` (
  `user_id` varchar(20) NOT NULL,
  `answer_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bookmark_question`
--

CREATE TABLE `bookmark_question` (
  `user_id` varchar(20) NOT NULL,
  `question_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `reply_id` varchar(20) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `msg_id` varchar(20) NOT NULL,
  `outgoing_msg_id` varchar(20) NOT NULL,
  `incoming_msg_id` varchar(20) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `question_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `tag` varchar(30) NOT NULL,
  `point` int(11) NOT NULL DEFAULT 0,
  `time_posted` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` varchar(20) NOT NULL,
  `email` varchar(319) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verification` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `point` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `username`, `password`, `verification`, `status`, `point`) VALUES
('A6214d5dbb1305', 'admin@gmail.com', 'Admin', '$2y$10$WZkAFhFYfkHVnMPx2rFH3OI19eMHAaX8OHg5v5gx/tuLofgzH9NS2', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_detail`
--

CREATE TABLE `user_detail` (
  `user_id` varchar(20) NOT NULL,
  `nric_no` char(14) DEFAULT NULL,
  `bio` varchar(3000) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `age` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `verification_queue`
--

CREATE TABLE `verification_queue` (
  `nric_no` char(14) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `full_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vote_answer`
--

CREATE TABLE `vote_answer` (
  `answer_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `vote` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vote_question`
--

CREATE TABLE `vote_question` (
  `question_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `vote` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `fk_answer__question` (`question_id`),
  ADD KEY `fk_answer__user` (`user_id`);

--
-- Indexes for table `bookmark_answer`
--
ALTER TABLE `bookmark_answer`
  ADD PRIMARY KEY (`answer_id`,`user_id`),
  ADD KEY `fk_bookmark_answer__user` (`user_id`);

--
-- Indexes for table `bookmark_question`
--
ALTER TABLE `bookmark_question`
  ADD PRIMARY KEY (`user_id`,`question_id`),
  ADD KEY `fk_bookmark_question__question` (`question_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `fk_comment__user` (`user_id`),
  ADD KEY `fk_comment__answer` (`reply_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `fk_message-incoming__user` (`incoming_msg_id`),
  ADD KEY `fk_message-outgoing__user` (`outgoing_msg_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `fk_question__user` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_detail`
--
ALTER TABLE `user_detail`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `verification_queue`
--
ALTER TABLE `verification_queue`
  ADD PRIMARY KEY (`nric_no`,`user_id`),
  ADD KEY `fk_verification_queue__user` (`user_id`);

--
-- Indexes for table `vote_answer`
--
ALTER TABLE `vote_answer`
  ADD PRIMARY KEY (`user_id`,`answer_id`),
  ADD KEY `fk_vote_answer__answer` (`answer_id`);

--
-- Indexes for table `vote_question`
--
ALTER TABLE `vote_question`
  ADD PRIMARY KEY (`user_id`,`question_id`),
  ADD KEY `fk_vote_question__question` (`question_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `fk_answer__question` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_answer__user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `bookmark_answer`
--
ALTER TABLE `bookmark_answer`
  ADD CONSTRAINT `fk_bookmark_answer__answer` FOREIGN KEY (`answer_id`) REFERENCES `answer` (`answer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_bookmark_answer__user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `bookmark_question`
--
ALTER TABLE `bookmark_question`
  ADD CONSTRAINT `fk_bookmark_question__question` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_bookmark_question__user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_comment__user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `fk_message-incoming__user` FOREIGN KEY (`incoming_msg_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_message-outgoing__user` FOREIGN KEY (`outgoing_msg_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `fk_question__user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_detail`
--
ALTER TABLE `user_detail`
  ADD CONSTRAINT `fk_user_detail__user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `verification_queue`
--
ALTER TABLE `verification_queue`
  ADD CONSTRAINT `fk_verification_queue__user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `vote_answer`
--
ALTER TABLE `vote_answer`
  ADD CONSTRAINT `fk_vote_answer__answer` FOREIGN KEY (`answer_id`) REFERENCES `answer` (`answer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_vote_answer__user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `vote_question`
--
ALTER TABLE `vote_question`
  ADD CONSTRAINT `fk_vote_question__question` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_vote_question__user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
