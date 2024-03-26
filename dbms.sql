-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Mar 26, 2024 at 06:46 PM
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
-- Database: `dbms`
--

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `Question` varchar(300) NOT NULL,
  `Option1` varchar(50) NOT NULL,
  `Option2` varchar(50) NOT NULL,
  `Option3` varchar(50) NOT NULL,
  `Option4` varchar(50) NOT NULL,
  `Correct_Option` varchar(50) NOT NULL,
  `Quiz_Id` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`Question`, `Option1`, `Option2`, `Option3`, `Option4`, `Correct_Option`, `Quiz_Id`) VALUES
('A turing machine is a', 'real machine', 'abstract machine', 'hypothetical machine', 'more than one option is correct', 'option4', '21cs51'),
('A turing machine operates over:', 'finite memory tape', 'infinite memory tape', 'depends on the algorithm', 'none of the mentioned', 'option2', '21cs51'),
(' Which of the functions are not performed by the turing machine after reading a symbol?', 'writes the symbol', 'moves the tape one cell left/right', 'proceeds with next instruction or halts', 'none of the mentioned', 'option4', '21cs51'),
('‘a’ in a-machine is :', 'Alan', 'arbitrary', ' automatic', 'None of the mentioned', 'option3', '21cs51'),
('The ability for a system of instructions to simulate a Turing Machine is called _________', 'Turing Completeness', 'Simulation', 'Turing Halting', ' None of the mentioned', 'option1', '21cs51'),
('What is a computer network?', 'A device used to display information on a computer', 'A collection of interconnected computers and devic', ' A type of software used to create documents and p', 'The physical casing that protects a computer’s int', 'option2', '21cs52'),
('What is internet?', 'A network of interconnected local area networks', 'A collection of unrelated computers', 'Interconnection of wide area networks', 'A single network', 'option3', '21cs52'),
(' Which of the following computer networks is built on the top of another network?', 'overlay network', 'prime network', 'prior network', 'chief network', 'option1', '21cs52'),
('What is the full form of OSI?', 'optical service implementation', 'open service Internet', ' open system interconnection', 'operating system interface', 'option3', '21cs52'),
('When a collection of various computers appears as a single coherent system to its clients, what is this called?', 'mail system', ' networking system', 'computer network', 'distributed system', 'option4', '21cs52'),
('ifbfue', '234', '4', '45', '55', 'option2', '21cs5698');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `Quiz_Id` varchar(15) NOT NULL,
  `Quiz_Name` varchar(20) NOT NULL,
  `Date_Created` date NOT NULL,
  `Email` varchar(35) DEFAULT NULL,
  `Staff_Id` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`Quiz_Id`, `Quiz_Name`, `Date_Created`, `Email`, `Staff_Id`) VALUES
('21cs51', 'turing machine', '2024-03-11', NULL, 'staff10'),
('21cs52', 'CN', '2024-03-18', NULL, 'staff10'),
('21cs5698', 'Automata', '2024-03-06', NULL, 'staff10');

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `Score` int(11) NOT NULL,
  `Quiz_Id` varchar(15) NOT NULL,
  `Email` varchar(35) DEFAULT NULL,
  `USN` varchar(15) DEFAULT NULL,
  `Total_Score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `score`
--

INSERT INTO `score` (`Score`, `Quiz_Id`, `Email`, `USN`, `Total_Score`) VALUES
(5, '21cs51', 'karthikushettigar11@gmail.com', NULL, 5),
(2, '21cs51', 'karthikushettigar11@gmail.com', NULL, 5),
(4, '21cs51', 'karthikushettigar11@gmail.com', NULL, 5),
(4, '21cs51', 'karthikushettigar11@gmail.com', NULL, 5),
(2, '21cs51', 'karthikushettigar11@gmail.com', NULL, 5),
(4, '21cs51', 'dhanush@gmail.com', NULL, 5),
(2, '21cs51', 'dhanush@gmail.com', NULL, 5),
(3, '21cs52', NULL, '4mt21cs047', 5),
(0, '21cs51', NULL, '4MT21Cs009', 5);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `Staff_Id` varchar(15) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Email` varchar(35) NOT NULL,
  `Ph_No` bigint(20) NOT NULL,
  `Department` varchar(10) NOT NULL,
  `DOB` date NOT NULL,
  `Gender` varchar(5) NOT NULL,
  `Password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`Staff_Id`, `Name`, `Email`, `Ph_No`, `Department`, `DOB`, `Gender`, `Password`) VALUES
('staff10', 'navaneeth', 'navaneeth@gmail.com', 9901984051, 'CSE', '2010-08-10', 'M ', 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `USN` varchar(15) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Email` varchar(35) NOT NULL,
  `Ph_No` bigint(20) NOT NULL,
  `Department` varchar(10) NOT NULL,
  `DOB` date NOT NULL,
  `Gender` varchar(5) NOT NULL,
  `Password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`USN`, `Name`, `Email`, `Ph_No`, `Department`, `DOB`, `Gender`, `Password`) VALUES
('4Mt21cs009', 'dhanush A', 'dhanushatcoc@gmail.com', 9901984059, 'IOT', '2024-03-14', 'M', 'dhanushh'),
('4mt21cs046', 'dhanush', 'dhanush@gmail.com', 9901984051, 'CSE', '2024-03-15', 'M', '1234'),
('4mt21cs047', 'dhanush shetty', 'dhanush14atcoc@gmail.com', 6360881098, 'CSE', '2002-08-15', 'M', 'dhanush3578'),
('4mt21cs064', 'karthik u shettigar', 'karthikushettigar11@gmail.com', 9448127175, 'CSE', '2003-03-11', 'M', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD KEY `test` (`Quiz_Id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`Quiz_Id`),
  ADD KEY `test` (`Email`),
  ADD KEY `test1` (`Staff_Id`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD KEY `table` (`Quiz_Id`),
  ADD KEY `table1` (`USN`),
  ADD KEY `table2` (`Email`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`Email`),
  ADD UNIQUE KEY `Staff_Id` (`Staff_Id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`USN`,`Email`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Email_2` (`Email`),
  ADD UNIQUE KEY `Email_3` (`Email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `test` FOREIGN KEY (`Quiz_Id`) REFERENCES `quiz` (`Quiz_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `test1` FOREIGN KEY (`Staff_Id`) REFERENCES `staff` (`Staff_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `table` FOREIGN KEY (`Quiz_Id`) REFERENCES `quiz` (`Quiz_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `table1` FOREIGN KEY (`USN`) REFERENCES `student` (`USN`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `table2` FOREIGN KEY (`Email`) REFERENCES `student` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
