-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2021 at 11:16 PM
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
-- Database: `qref`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `content`, `quiz_id`, `user_id`) VALUES
(1, 'Testiramo prvi put!!!', 14, 1),
(2, 'Testiramo drugi !', 14, 2),
(3, 'Quiz je odlican', 16, 1),
(4, 'Drugi pokusaj AJMOO', 16, 1),
(5, '_PROBA_ bez s crtom', 16, 1),
(6, ':)\r\n\r\n[_]test[_]', 16, 1),
(7, 'rthsahtrhrhrt', 16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `qref_file` blob NOT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT 0,
  `enable_comments` tinyint(1) NOT NULL DEFAULT 0,
  `created_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id`, `name`, `description`, `qref_file`, `is_public`, `enable_comments`, `created_user_id`) VALUES
(14, 'test1', 'testiramo prvi put', 0x7265736f75726365732f66696c655f313632313037303439322e71726566, 1, 0, 1),
(16, 'test2', 'testiramo drugi put', 0x7265736f75726365732f66696c655f313632313037303539392e71726566, 1, 1, 1),
(19, 'nice quiz', 'very nice', 0x7265736f75726365732f66696c655f313632313139393038332e71726566, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `date_of_birth`, `email`, `password`) VALUES
(1, 'Ivan', 'Bagarić', '0001-01-01', 'ivan@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964'),
(2, 'Tomislav', 'Bagaric', '2021-05-08', 'tom@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964'),
(3, 'Test', 'Test', '2021-05-03', 'test@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964'),
(4, 'Ajde', 'Ajde', '2021-05-04', 'ajde@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964'),
(5, 'abc', 'abc', '2021-05-01', 'abc@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964'),
(6, 'qwert', 'qwert', '2021-05-08', 'qwert@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964'),
(7, 'ay', 'ay', '2021-05-07', 'ay@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964'),
(8, 'q', 'q', '2021-05-04', 'q@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964'),
(9, 'f', 'f', '2021-05-09', 'f@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964'),
(10, 'c', 'c', '2021-05-02', 'c@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964'),
(11, 'Google', 'Bagaric', '0001-01-01', 'gb@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964'),
(12, 'Ivan', 'Bagaric', '2021-05-05', 'ivek@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964');

-- --------------------------------------------------------

--
-- Table structure for table `user_question_answers`
--

CREATE TABLE `user_question_answers` (
  `quiz_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `qref_answers` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_question_answers`
--

INSERT INTO `user_question_answers` (`quiz_id`, `user_id`, `points`, `qref_answers`) VALUES
(14, 1, 20, 0x7265736f75726365732f66696c655f313632313135383535352e71726566),
(16, 1, 60, 0x7265736f75726365732f66696c655f313632313136333434392e71726566),
(14, 1, 60, 0x7265736f75726365732f66696c655f313632313136363037322e71726566),
(14, 1, 60, 0x7265736f75726365732f66696c655f313632313137303938382e71726566),
(14, 1, 60, 0x7265736f75726365732f66696c655f313632313137313030392e71726566),
(14, 1, 60, 0x7265736f75726365732f66696c655f313632313137313035362e71726566),
(14, 1, 60, 0x7265736f75726365732f66696c655f313632313137313038342e71726566),
(14, 1, 60, 0x7265736f75726365732f66696c655f313632313137313234312e71726566),
(14, 1, 60, 0x7265736f75726365732f66696c655f313632313137313237382e71726566),
(14, 1, 60, 0x7265736f75726365732f66696c655f313632313137313239372e71726566),
(14, 1, 60, 0x7265736f75726365732f66696c655f313632313137313333302e71726566),
(14, 1, 60, 0x7265736f75726365732f66696c655f313632313137313334322e71726566),
(14, 1, 0, 0x7265736f75726365732f66696c655f313632313137313631342e71726566),
(14, 1, 0, 0x7265736f75726365732f66696c655f313632313137313636332e71726566),
(14, 1, 0, 0x7265736f75726365732f66696c655f313632313137313639322e71726566),
(14, 1, 0, 0x7265736f75726365732f66696c655f313632313137313731362e71726566),
(14, 1, 50, 0x7265736f75726365732f66696c655f313632313137323238342e71726566),
(16, 1, 60, 0x7265736f75726365732f66696c655f313632313137323331322e71726566),
(16, 1, 60, 0x7265736f75726365732f66696c655f313632313137323334342e71726566),
(16, 1, 60, 0x7265736f75726365732f66696c655f313632313137323336382e71726566),
(16, 1, 60, 0x7265736f75726365732f66696c655f313632313137323930362e71726566),
(16, 1, 0, 0x7265736f75726365732f66696c655f313632313137333039322e71726566),
(16, 1, 0, 0x7265736f75726365732f66696c655f313632313137333131392e71726566),
(16, 1, 0, 0x7265736f75726365732f66696c655f313632313137333138312e71726566),
(14, 1, 60, 0x7265736f75726365732f66696c655f313632313137353739392e71726566),
(14, 1, 10, 0x7265736f75726365732f66696c655f313632313139333731362e71726566),
(19, 2, 70, 0x7265736f75726365732f66696c655f313632313139393130342e71726566),
(19, 2, 0, 0x7265736f75726365732f66696c655f313632313139393132362e71726566),
(19, 1, 70, 0x7265736f75726365732f66696c655f313632313139393237352e71726566);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ff_key` (`user_id`),
  ADD KEY `fff_key` (`quiz_id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f_key` (`created_user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_question_answers`
--
ALTER TABLE `user_question_answers`
  ADD KEY `a` (`quiz_id`),
  ADD KEY `b` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `ff_key` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fff_key` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `f_key` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_question_answers`
--
ALTER TABLE `user_question_answers`
  ADD CONSTRAINT `a` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `b` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
