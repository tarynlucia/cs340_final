-- phpMyAdmin SQL Dump
-- version 5.2.1-1.el7.remi
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 8, 2024
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
-- Database: `cs340_kauc`
--

-- --------------------------------------------------------

--
-- Table structure for table `MEMBERS`
--

-- Create Members table
CREATE TABLE `MEMBERS` (
    `OSU_ID` INT NOT NULL, -- Primary key (unique numerical identifier)
    `Fname` VARCHAR(255) NOT NULL,    -- First name (string)
    `Lname` VARCHAR(255) NOT NULL,    -- Last name (string)
    `Year` INT NOT NULL,              -- Year (1, 2, 3, 4, 5...)
    `Major` VARCHAR(255) NOT NULL,    -- Major (e.g., Computer Science, Mechanical Engineering, etc.)
    `Group_number` INT               -- Foreign key to Group_number from Big_Little_Group (nullable)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO `MEMBERS` (`OSU_ID`, `Fname`, `Lname`, `Year`, `Major`, `Group_number`)
VALUES
(753558270, 'Charissa', 'Kau', 4, 'Computer Science', 1),
(150003549, 'Taryn', 'Eng', 4, 'Computer Science', 2),
(110783913, 'Kayla', 'Doan', 4, 'Computer Science', 3),
(758497287, 'Muhammad', 'Faks', 4, 'Computer Science', 4),
(931739862, 'Andy', 'Nguyen', 2, 'Computer Science', 5),
(891084341, 'Huy', 'Tran', 2, 'Computer Science', 6),
(213122154, 'Thien', 'Tu', 3, 'Computer Science', 7),
(245173219, 'Johnny', 'Vo', 4, 'Computer Science', 8),
(834998373, 'Justin', 'Nguyen', 1, 'Electrical Computer Engineering', 9),
(651861659, 'Justin', 'Lee', 2, 'Computer Science', 10),
(237487739, 'Daniel', 'Lee', 1, 'Computer Science', 11),
(897264994, 'Li', 'Tanaka', 3, 'Materials Science', 10),
(789210079, 'Hiroshi', 'Zhang', 1, 'Materials Science', 1),
(662657090, 'Yuki', 'Kim', 4, 'Environmental Science', 2),
(267875759, 'Takeshi', 'Yamamoto', 4, 'Chemistry', 3),
(954982940, 'Mei', 'Lee', 2, 'Physics', 4),
(816481777, 'Jin', 'Wang', 3, 'Aerospace Engineering', 5),
(478643381, 'Yuki', 'Tanaka', 1, 'Civil Engineering', 6),
(421475911, 'Hiroshi', 'Kim', 1, 'Mechanical Engineering', 7),
(476188998, 'Takeshi', 'Lee', 2, 'Civil Engineering', 8),
(727243898, 'Jin', 'Choi', 3, 'Biomedical Engineering', 9),
(585370054, 'Kai', 'Park', 2, 'Biomedical Engineering', 10),
(567566021, 'Mei', 'Zhang', 3, 'Computer Science', 11),
(115071712, 'Yuki', 'Chen', 2, 'Materials Science', 5),
(367766317, 'Takeshi', 'Liu', 1, 'Aerospace Engineering', 1),
(658517532, 'Li', 'Kim', 3, 'Robotics', 10),
(631028975, 'Hiroshi', 'Choi', 4, 'Data Science', 9),
(489800316, 'Yuki', 'Park', 1, 'Physics', 6),
(680636794, 'Takeshi', 'Yamamoto', 4, 'Electrical Engineering', 4),
(931937985, 'Kai', 'Zhang', 4, 'Civil Engineering', 3),
(736592814, 'Hiroshi', 'Yamamoto', 2, 'Physics', NULL),
(921784516, 'Mei', 'Tanaka', 3, 'Environmental Science', 1),
(183642756, 'Yuki', 'Liu', 4, 'Chemistry', 2),
(462913547, 'Jin', 'Park', 1, 'Biology', 3),
(513745382, 'Takeshi', 'Zhang', 2, 'Biochemistry', 4),
(651923487, 'Kai', 'Lee', 3, 'Geology', 5),
(712654890, 'Mei', 'Kim', 4, 'Astronomy', 6),
(832479615, 'Yuki', 'Choi', 2, 'Marine Biology', 7),
(903158746, 'Hiroshi', 'Liu', 1, 'Molecular Biology', 8),
(574839612, 'Jin', 'Wang', 3, 'Neuroscience', 9);


-- Create Officers table
CREATE TABLE `OFFICERS` (
    `OSU_ID` INT NOT NULL, -- Primary key (unique numerical identifier)
    `Position` VARCHAR(255) NOT NULL -- Position (e.g., President, Vice-President, etc.)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO `OFFICERS` (`OSU_ID`, `Position`)
VALUES
(753558270, 'President'),
(150003549, 'President'),
(110783913, 'Event Coordinator'),
(758497287, 'Vice President'),
(931739862, 'Secretary'),
(891084341, 'Media Designer'),
(213122154, 'Treasurer'),
(245173219, 'Public Relations'),
(834998373, 'Intern'),
(651861659, 'Intern'),
(237487739, 'Intern');

-- Create Meetings table
CREATE TABLE `MEETINGS` (
    `Event_number` INT NOT NULL, -- Primary key (unique numerical identifier)
    `Event_name` VARCHAR(255) NOT NULL,     -- Event name (string)
    Date DATETIME NOT NULL,               -- Date (MM/DD/YYYY)
    Location VARCHAR(255) NOT NULL        -- Location (string)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO `MEETINGS` (`Event_number`, `Event_name`, Date, Location)
VALUES
(1, 'First General Meeting', '2024-09-26', 'Johnson Hall'),
(2, 'Resume Workshop', '2024-10-03', 'APCC'),
(3, 'LinkedIn Workshop', '2024-10-10', 'Kelley Engineering Center'),
(4, 'Mortenson Company Rep', '2024-10-17', 'APCC'),
(5, 'Movie Night', '2024-10-24', 'Memorial Union'),
(6, 'Field Day', '2024-10-31', 'McAlexander Fieldhouse'),
(7, 'Gingerbread Competition', '2024-11-07', 'APCC'),
(8, 'Sports Day', '2024-11-14', 'McAlexander Fieldhouse'),
(9, 'Interview Prep Workshop', '2024-11-21', 'APCC'),
(10, 'Alumni Panel', '2024-11-28', 'Memorial Union');

-- Create Big_Little_Group table
CREATE TABLE `BIG_LITTLE_GROUP` (
    `Group_number` INT NOT NULL, -- Primary key (unique numerical identifier)
    `Group_name` VARCHAR(255) NOT NULL,      -- Group name (string)
    `Position` VARCHAR(255) NOT NULL,        -- Position (FK from Officers)
    `Big_ID` INT NOT NULL                   -- Big_ID (FK from Officers)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO `BIG_LITTLE_GROUP` (`Group_number`, `Group_name`, `Position`, `Big_ID`)
VALUES
(1, 'Iron Man', 'President', 753558270),
(2, 'Captain America', 'President', 150003549),
(3, 'Hulk', 'Event Coordinator', 110783913),
(4, 'Vision', 'Vice President', 758497287),
(5, 'Hawk Eye', 'Secretary', 931739862),
(6, 'Black Widow', 'Media Designer', 891084341),
(7, 'Thor', 'Treasurer', 213122154),
(8, 'Ant-Man', 'Public Relations', 245173219),
(9, 'Spiderman', 'Intern', 834998373),
(10, 'Black Panther', 'Intern', 651861659),
(11, 'Scarlet Witch', 'Intern', 237487739);

CREATE TABLE `ATTENDS` (
    `Event_number` INT NOT NULL,
    `OSU_ID` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

CREATE TABLE `LEADS` (
    `Event_number` INT NOT NULL,
    `OSU_ID` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO `ATTENDS` (`Event_number`, `OSU_ID`)
VALUES
    (1, 753558270),
    (2, 753558270),
    (3, 753558270),
    (4, 753558270),
    (5, 753558270),
    (6, 753558270),
    (7, 753558270),
    (8, 753558270),
    (9, 753558270),
    (10, 753558270),
    
    (1, 150003549),
    (2, 150003549),
    (3, 150003549),
    (4, 150003549),
    (5, 150003549),
    (6, 150003549),
    (7, 150003549),
    (8, 150003549),
    (9, 150003549),
    (10, 150003549),
    
    (1, 110783913),
    (2, 110783913),
    (3, 110783913),
    (4, 110783913),
    (5, 110783913),
    (6, 110783913),
    (7, 110783913),
    (8, 110783913),
    (9, 110783913),
    (10, 110783913),
    
    (1, 758497287),
    (2, 758497287),
    (3, 758497287),
    (4, 758497287),
    (5, 758497287),
    (6, 758497287),
    (7, 758497287),
    (8, 758497287),
    (9, 758497287),
    (10, 758497287),
    
    (1, 931739862),
    (2, 931739862),
    (3, 931739862),
    (4, 931739862),
    (5, 931739862),
    (6, 931739862),
    (7, 931739862),
    (8, 931739862),
    (9, 931739862),
    (10, 931739862),
    
    (1, 891084341),
    (2, 891084341),
    (3, 891084341),
    (4, 891084341),
    (5, 891084341),
    (6, 891084341),
    (7, 891084341),
    (8, 891084341),
    (9, 891084341),
    (10, 891084341),
    
    (1, 213122154),
    (2, 213122154),
    (3, 213122154),
    (4, 213122154),
    (5, 213122154),
    (6, 213122154),
    (7, 213122154),
    (8, 213122154),
    (9, 213122154),
    (10, 213122154),
    
    (1, 245173219),
    (2, 245173219),
    (3, 245173219),
    (4, 245173219),
    (5, 245173219),
    (6, 245173219),
    (7, 245173219),
    (8, 245173219),
    (9, 245173219),
    (10, 245173219),
    
    (9, 834998373),
    (6, 834998373),
    
    (2, 651861659),
    (4, 651861659),
    (8, 651861659),
    
    (3, 237487739),
    (10, 237487739),
    (2, 237487739),
    (7, 237487739),
    
    (6, 897264994),
    (3, 897264994),
    (1, 897264994),
    (9, 897264994),
    
    (5, 789210079),
    (7, 789210079),
    
    (4, 662657090),
    (1, 662657090),
    (10, 662657090),
    
    (8, 267875759),
    (9, 267875759),
    (6, 267875759),
    
    (3, 954982940),
    (4, 954982940),
    (1, 954982940),
    (7, 954982940);

INSERT INTO `LEADS` (`Event_number`, `OSU_ID`)
VALUES
-- First General Meeting (Event number 1)
(1, 753558270),
(1, 150003549),
(1, 110783913),

-- Resume Workshop (Event number 2)
(2, 758497287),
(2, 931739862),
(2, 245173219),

-- LinkedIn Workshop (Event number 3)
(3, 753558270),
(3, 891084341),
(3, 213122154),

-- Mortenson Company Rep (Event number 4)
(4, 150003549),
(4, 931739862),
(4, 245173219),

-- Movie Night (Event number 5)
(5, 758497287),
(5, 110783913),
(5, 891084341),

-- Field Day (Event number 6)
(6, 753558270),
(6, 150003549),
(6, 758497287),

-- Gingerbread Competition (Event number 7)
(7, 931739862),
(7, 213122154),
(7, 891084341),

-- Sports Day (Event number 8)
(8, 110783913),
(8, 245173219),
(8, 834998373),

-- Interview Prep Workshop (Event number 9)
(9, 753558270),
(9, 758497287),
(9, 213122154),

-- Alumni Panel (Event number 10)
(10, 150003549),
(10, 931739862),
(10, 245173219);


--
-- Indexes for table `COURSE`
--
ALTER TABLE `MEMBERS`
    ADD PRIMARY KEY (`OSU_ID`);

--
-- Indexes for table `GRADE_REPORT`
--
ALTER TABLE `OFFICERS`
  ADD PRIMARY KEY (`OSU_ID`);

--
-- Indexes for table `PREREQUISITE`
--
ALTER TABLE `MEETINGS`
  ADD PRIMARY KEY (`Event_number`);

--
-- Indexes for table `SECTION`
--
ALTER TABLE `BIG_LITTLE_GROUP`
  ADD PRIMARY KEY (`Group_number`);

--
-- Indexes for table `STUDENT`
--
ALTER TABLE `ATTENDS`
  ADD PRIMARY KEY (`Event_number`, `OSU_ID`);

--
-- Indexes for table `STUDENT`
--
ALTER TABLE `LEADS`
    ADD PRIMARY KEY (`Event_number`, `OSU_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `GRADE_REPORT`
--
ALTER TABLE `MEMBERS`
    ADD CONSTRAINT `FK_GroupNumber` FOREIGN KEY (`Group_number`) REFERENCES `BIG_LITTLE_GROUP`(`Group_number`);

--
-- Indexes for table `GRADE_REPORT`
--
ALTER TABLE `OFFICERS`
    ADD CONSTRAINT `FK_Members` FOREIGN KEY (`OSU_ID`) REFERENCES `MEMBERS`(`OSU_ID`);

--
-- Indexes for table `SECTION`
--
ALTER TABLE `BIG_LITTLE_GROUP`
    ADD CONSTRAINT `FK_BigID` FOREIGN KEY (`Big_ID`) REFERENCES `OFFICERS`(`OSU_ID`);

--
-- Indexes for table `STUDENT`
--
ALTER TABLE `ATTENDS`
    ADD FOREIGN KEY (`Event_number`) REFERENCES `MEETINGS`(`Event_number`) ON DELETE CASCADE,
    ADD FOREIGN KEY (`OSU_ID`) REFERENCES `MEMBERS`(`OSU_ID`) ON DELETE CASCADE;

--
-- Indexes for table `STUDENT`
--
ALTER TABLE `LEADS`
    ADD FOREIGN KEY (`Event_number`) REFERENCES `MEETINGS`(`Event_number`),
    ADD FOREIGN KEY (`OSU_ID`) REFERENCES `OFFICERS`(`OSU_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;