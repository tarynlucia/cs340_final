-- phpMyAdmin SQL Dump
-- version 5.2.1-1.el7.remi
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 10, 2024 at 05:34 PM
-- Server version: 10.6.19-MariaDB-log
-- PHP Version: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs340_tuthi`
--

-- --------------------------------------------------------

--
-- Table structure for table `Attends`
--

CREATE TABLE `Attends` (
  `Event_number` int(11) NOT NULL,
  `OSU_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `Attends`
--

INSERT INTO `Attends` (`Event_number`, `OSU_ID`) VALUES
(1, 110783913),
(1, 150003549),
(1, 213122154),
(1, 245173219),
(1, 585370054),
(1, 662657090),
(1, 753558270),
(1, 758497287),
(1, 891084341),
(1, 897264994),
(1, 931739862),
(1, 954982940),
(2, 110783913),
(2, 150003549),
(2, 213122154),
(2, 237487739),
(2, 245173219),
(2, 651861659),
(2, 753558270),
(2, 758497287),
(2, 891084341),
(2, 931739862),
(3, 110783913),
(3, 115071712),
(3, 150003549),
(3, 213122154),
(3, 237487739),
(3, 245173219),
(3, 753558270),
(3, 758497287),
(3, 891084341),
(3, 897264994),
(3, 931739862),
(3, 954982940),
(4, 110783913),
(4, 115071712),
(4, 150003549),
(4, 213122154),
(4, 245173219),
(4, 651861659),
(4, 662657090),
(4, 753558270),
(4, 758497287),
(4, 891084341),
(4, 931739862),
(4, 954982940),
(5, 110783913),
(5, 150003549),
(5, 213122154),
(5, 245173219),
(5, 753558270),
(5, 758497287),
(5, 789210079),
(5, 891084341),
(5, 931739862),
(6, 110783913),
(6, 150003549),
(6, 213122154),
(6, 245173219),
(6, 267875759),
(6, 753558270),
(6, 758497287),
(6, 834998373),
(6, 891084341),
(6, 897264994),
(6, 931739862),
(7, 110783913),
(7, 150003549),
(7, 213122154),
(7, 237487739),
(7, 245173219),
(7, 753558270),
(7, 758497287),
(7, 789210079),
(7, 891084341),
(7, 931739862),
(7, 954982940),
(8, 110783913),
(8, 150003549),
(8, 213122154),
(8, 245173219),
(8, 267875759),
(8, 651861659),
(8, 753558270),
(8, 758497287),
(8, 891084341),
(8, 931739862),
(9, 110783913),
(9, 150003549),
(9, 213122154),
(9, 245173219),
(9, 267875759),
(9, 753558270),
(9, 758497287),
(9, 789210079),
(9, 834998373),
(9, 891084341),
(9, 897264994),
(9, 931739862),
(10, 110783913),
(10, 115071712),
(10, 150003549),
(10, 213122154),
(10, 237487739),
(10, 245173219),
(10, 662657090),
(10, 753558270),
(10, 758497287),
(10, 891084341),
(10, 931739862);

-- --------------------------------------------------------

--
-- Table structure for table `Big_Little_Group`
--

CREATE TABLE `Big_Little_Group` (
  `Group_number` int(11) NOT NULL,
  `Group_name` varchar(255) NOT NULL,
  `Big_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `Big_Little_Group`
--

INSERT INTO `Big_Little_Group` (`Group_number`, `Group_name`, `Big_ID`) VALUES
(1, 'Iron Man', 753558270),
(2, 'Captain America', 150003549),
(3, 'Hulk', 110783913),
(4, 'Vision', 758497287),
(5, 'Hawk Eye', 931739862),
(6, 'Black Widow', 891084341),
(7, 'Thor', 213122154),
(8, 'Ant-Man', 245173219),
(9, 'Spiderman', 834998373),
(10, 'Black Panther', 651861659);

-- --------------------------------------------------------

--
-- Table structure for table `Leads`
--

CREATE TABLE `Leads` (
  `Event_number` int(11) NOT NULL,
  `OSU_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `Leads`
--

INSERT INTO `Leads` (`Event_number`, `OSU_ID`) VALUES
(1, 110783913),
(1, 150003549),
(1, 213122154),
(2, 245173219),
(2, 758497287),
(2, 931739862),
(3, 213122154),
(3, 753558270),
(3, 891084341),
(4, 150003549),
(4, 245173219),
(4, 931739862),
(5, 110783913),
(5, 758497287),
(5, 891084341),
(6, 150003549),
(6, 753558270),
(6, 758497287),
(7, 213122154),
(7, 891084341),
(7, 931739862),
(8, 110783913),
(8, 245173219),
(8, 834998373),
(9, 213122154),
(9, 753558270),
(9, 758497287),
(10, 150003549),
(10, 245173219),
(10, 931739862);

--
-- Triggers `Leads`
--
DELIMITER $$
CREATE TRIGGER `Check_Lead_Limit_Before_Insert` BEFORE INSERT ON `Leads` FOR EACH ROW BEGIN
    DECLARE Lead_count INT;

    -- Count the number of leads for the event
    SELECT COUNT(*) INTO Lead_count
    FROM Leads
    WHERE Event_number = NEW.Event_number;

    -- Check if the count exceeds the limit of 3 leads per event
    IF Lead_count >= 3 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Error: An event cannot have more than 3 leads.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Meetings`
--

CREATE TABLE `Meetings` (
  `Event_number` int(11) NOT NULL,
  `Event_name` varchar(255) NOT NULL,
  `Date` datetime NOT NULL,
  `Location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `Meetings`
--

INSERT INTO `Meetings` (`Event_number`, `Event_name`, `Date`, `Location`) VALUES
(1, 'First General Meeting', '2024-09-26 00:00:00', 'Johnson Hall'),
(2, 'Resume Workshop', '2024-10-03 00:00:00', 'APCC'),
(3, 'LinkedIn Workshop', '2024-10-10 00:00:00', 'Kelley Engineering Center'),
(4, 'Mortenson Company Rep', '2024-10-17 00:00:00', 'APCC'),
(5, 'Movie Night', '2024-10-24 00:00:00', 'Memorial Union'),
(6, 'Field Day', '2024-10-31 00:00:00', 'McAlexander Fieldhouse'),
(7, 'Gingerbread Competition', '2024-11-07 00:00:00', 'APCC'),
(8, 'Sports Day', '2024-11-14 00:00:00', 'McAlexander Fieldhouse'),
(9, 'Interview Prep Workshop', '2024-11-21 00:00:00', 'APCC'),
(10, 'Alumni Panel', '2024-11-28 00:00:00', 'Memorial Union');

-- --------------------------------------------------------

--
-- Table structure for table `Members`
--

CREATE TABLE `Members` (
  `OSU_ID` int(11) NOT NULL,
  `Fname` varchar(255) NOT NULL,
  `Lname` varchar(255) NOT NULL,
  `Year` int(11) NOT NULL,
  `Major` varchar(255) NOT NULL,
  `Group_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `Members`
--

INSERT INTO `Members` (`OSU_ID`, `Fname`, `Lname`, `Year`, `Major`, `Group_number`) VALUES
(110783913, 'Kayla', 'Doan', 4, 'Computer Science', 3),
(115071712, 'Yuki', 'Chen', 2, 'Materials Science', 5),
(150003549, 'Taryn', 'Eng', 4, 'Computer Science', 2),
(183642756, 'Yuki', 'Liu', 4, 'Chemistry', 2),
(213122154, 'Thien', 'Tu', 3, 'Computer Science', 7),
(237487739, 'Daniel', 'Lee', 1, 'Computer Science', NULL),
(245173219, 'Johnny', 'Vo', 4, 'Computer Science', 8),
(267875759, 'Takeshi', 'Yamamoto', 4, 'Chemistry', 3),
(367766317, 'Takeshi', 'Liu', 1, 'Aerospace Engineering', 1),
(421475911, 'Hiroshi', 'Kim', 1, 'Mechanical Engineering', 7),
(462913547, 'Jin', 'Park', 1, 'Biology', 3),
(476188998, 'Takeshi', 'Lee', 2, 'Civil Engineering', 8),
(478643381, 'Yuki', 'Tanaka', 1, 'Civil Engineering', 6),
(489800316, 'Yuki', 'Park', 1, 'Physics', 6),
(513745382, 'Takeshi', 'Zhang', 2, 'Biochemistry', 4),
(567566021, 'Mei', 'Zhang', 3, 'Computer Science', NULL),
(574839612, 'Jin', 'Wang', 3, 'Neuroscience', 9),
(585370054, 'Kai', 'Park', 2, 'Biomedical Engineering', 10),
(631028975, 'Hiroshi', 'Choi', 4, 'Data Science', 9),
(651861659, 'Justin', 'Lee', 2, 'Computer Science', 10),
(651923487, 'Kai', 'Lee', 3, 'Geology', 5),
(658517532, 'Li', 'Kim', 3, 'Robotics', 10),
(662657090, 'Yuki', 'Kim', 4, 'Environmental Science', 2),
(680636794, 'Takeshi', 'Yamamoto', 4, 'Electrical Engineering', 4),
(712654890, 'Mei', 'Kim', 4, 'Astronomy', 6),
(727243898, 'Jin', 'Choi', 3, 'Biomedical Engineering', 9),
(736592814, 'Hiroshi', 'Yamamoto', 2, 'Physics', NULL),
(753558270, 'Charissa', 'Kau', 4, 'Computer Science', 1),
(758497287, 'Muhammad', 'Faks', 4, 'Computer Science', 4),
(789210079, 'Hiroshi', 'Zhang', 1, 'Materials Science', 1),
(816481777, 'Jin', 'Wang', 3, 'Aerospace Engineering', 5),
(832479615, 'Yuki', 'Choi', 2, 'Marine Biology', 7),
(834998373, 'Justin', 'Nguyen', 1, 'Electrical Computer Engineering', 9),
(891084341, 'Huy', 'Tran', 2, 'Computer Science', 6),
(897264994, 'Li', 'Tanaka', 3, 'Materials Science', 10),
(903158746, 'Hiroshi', 'Liu', 1, 'Molecular Biology', 8),
(921784516, 'Mei', 'Tanaka', 3, 'Environmental Science', 1),
(931739862, 'Andy', 'Nguyen', 2, 'Computer Science', 5),
(931937985, 'Kai', 'Zhang', 4, 'Civil Engineering', 3),
(954982940, 'Mei', 'Lee', 2, 'Physics', 4);

--
-- Triggers `Members`
--
DELIMITER $$
CREATE TRIGGER `Check_Member_Limit_Before_Insert` BEFORE INSERT ON `Members` FOR EACH ROW BEGIN
    DECLARE Member_count INT;

    -- Count the number of members in the group
    SELECT COUNT(*) INTO Member_count
    FROM Members
    WHERE Group_number = NEW.Group_number;

    -- Check if the count exceeds the limit
    IF Member_count >= 8 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Error: A Big_Little_Group cannot have more than 8 members.';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Check_Member_Limit_Before_Update` BEFORE UPDATE ON `Members` FOR EACH ROW BEGIN
    DECLARE Member_count INT;

    -- Count the number of members in the group
    SELECT COUNT(*) INTO Member_count
    FROM Members
    WHERE Group_number = NEW.Group_number;

    -- Check if the count exceeds the limit
    IF Member_count >= 8 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Error: A Big_Little_Group cannot have more than 8 members.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Officers`
--

CREATE TABLE `Officers` (
  `OSU_ID` int(11) NOT NULL,
  `Position` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `Officers`
--

INSERT INTO `Officers` (`OSU_ID`, `Position`) VALUES
(110783913, 'Event Coordinator'),
(150003549, 'President'),
(213122154, 'Treasurer'),
(237487739, 'Intern'),
(245173219, 'Public Relations'),
(651861659, 'Intern'),
(753558270, 'President'),
(758497287, 'Vice President'),
(834998373, 'Intern'),
(891084341, 'Media Designer'),
(931739862, 'Secretary');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Attends`
--
ALTER TABLE `Attends`
  ADD PRIMARY KEY (`Event_number`,`OSU_ID`),
  ADD KEY `fk_osuid` (`OSU_ID`);

--
-- Indexes for table `Big_Little_Group`
--
ALTER TABLE `Big_Little_Group`
  ADD PRIMARY KEY (`Group_number`),
  ADD KEY `FK_BigID` (`Big_ID`);

--
-- Indexes for table `Leads`
--
ALTER TABLE `Leads`
  ADD PRIMARY KEY (`Event_number`,`OSU_ID`),
  ADD KEY `FK_OfficerID` (`OSU_ID`);

--
-- Indexes for table `Meetings`
--
ALTER TABLE `Meetings`
  ADD PRIMARY KEY (`Event_number`);

--
-- Indexes for table `Members`
--
ALTER TABLE `Members`
  ADD PRIMARY KEY (`OSU_ID`),
  ADD KEY `FK_GroupNumber` (`Group_number`);

--
-- Indexes for table `Officers`
--
ALTER TABLE `Officers`
  ADD PRIMARY KEY (`OSU_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Attends`
--
ALTER TABLE `Attends`
  ADD CONSTRAINT `fk_event_number` FOREIGN KEY (`Event_number`) REFERENCES `Meetings` (`Event_number`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_osuid` FOREIGN KEY (`OSU_ID`) REFERENCES `Members` (`OSU_ID`) ON DELETE CASCADE;

--
-- Constraints for table `Big_Little_Group`
--
ALTER TABLE `Big_Little_Group`
  ADD CONSTRAINT `FK_BigID` FOREIGN KEY (`Big_ID`) REFERENCES `Officers` (`OSU_ID`);

--
-- Constraints for table `Leads`
--
ALTER TABLE `Leads`
  ADD CONSTRAINT `FK_EventNumber` FOREIGN KEY (`Event_number`) REFERENCES `Meetings` (`Event_number`),
  ADD CONSTRAINT `FK_OfficerID` FOREIGN KEY (`OSU_ID`) REFERENCES `Officers` (`OSU_ID`);

--
-- Constraints for table `Members`
--
ALTER TABLE `Members`
  ADD CONSTRAINT `FK_GroupNumber` FOREIGN KEY (`Group_number`) REFERENCES `Big_Little_Group` (`Group_number`) ON DELETE SET NULL;

--
-- Constraints for table `Officers`
--
ALTER TABLE `Officers`
  ADD CONSTRAINT `FK_Members` FOREIGN KEY (`OSU_ID`) REFERENCES `Members` (`OSU_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
