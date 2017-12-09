-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2017 at 07:44 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `Admin_ID` int(11) NOT NULL,
  `Admin_Pass` varchar(15) DEFAULT NULL,
  `Admin_Contact` varchar(11) DEFAULT NULL,
  `Admin_Email` varchar(25) DEFAULT NULL,
  `Admin_Department` varchar(25) DEFAULT NULL,
  `Admin_Name` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`Admin_ID`, `Admin_Pass`, `Admin_Contact`, `Admin_Email`, `Admin_Department`, `Admin_Name`) VALUES
(10000, 'admin1', '012-3123123', 'admin1@gmail.com', 'Admin', 'The Quiett'),
(10001, 'admin2', '012-1244121', 'admin2@gmail.com', 'Finance', 'Choiza'),
(10002, 'admin3', '012-4123121', 'admin3@gmail.com', 'Admin', 'Gaeko');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `Announce_ID` int(11) NOT NULL,
  `Announce_Title` varchar(100) DEFAULT NULL,
  `Announce_Details` varchar(255) DEFAULT NULL,
  `Announce_Date` date DEFAULT NULL,
  `Admin_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`Announce_ID`, `Announce_Title`, `Announce_Details`, `Announce_Date`, `Admin_ID`) VALUES
(1, 'Approval of reservation for resources by Student 10', 'The reservation for CQCR2001 on 2017-09-11 has been approved. Please take good care of the facilities. Thank You.', '2017-09-11', 10000),
(2, 'Approval of reservation for resources by Student 9', 'The reservation for CQAR3002 on 2017-09-11 has been approved. Please take good care of the facilities. Thank You.', '2017-09-11', 10000),
(3, 'Approval of reservation for resources by Student 3', 'The reservation for CQCR1001 on 2017-06-05 has been approved. Please take good care of the facilities. Thank You.', '2017-09-11', 10000),
(4, 'Approval of reservation for resources by Student 8', 'The reservation for CQCR2001 on 2017-09-11 has been approved. Please take good care of the facilities. Thank You.', '2017-09-11', 10000),
(8, 'Approval of presentation for resources by Student 4000', 'The application for presentation on 2017-06-05 has been approved. Please contact your supervisor, Dok2, for me details.', '2017-09-11', 10000),
(11, 'Approval of presentation by Student 4007', 'The application for presentation on 2017-06-05 has been approved. Please contact your supervisor, Dok2, for me details.', '2017-09-17', 10000),
(12, 'Approval of presentation by Student 4008', 'The application for presentation on 2017-06-05 has been approved. Please contact your supervisor, Dok2, for me details.', '2017-09-28', 10000),
(13, 'Approval of presentation by Student 4009', 'The application for presentation on 2017-06-05 has been approved. Please contact your supervisor, Dok2, for me details.', '2017-09-28', 10000),
(14, 'Approval of presentation by Student 1000000003', 'The application for presentation on 2017-06-05 has been approved. Please contact your supervisor, Dok2, for more details.', '2017-09-28', 10000),
(15, 'Approval of presentation by Student 1000000003', 'The application for presentation on 2017-06-05 has been approved. Please contact your supervisor, Dok2, for more details.', '2017-09-28', 10000),
(16, 'Approval of reservation for resources by Student 1000000000', 'The reservation for CQCR1001 on 2017-06-05 has been approved. Please take good care of the facilities. Thank You.', '2017-09-28', 10001),
(17, 'Approval of reservation for resources by Student 1000000000', 'The reservation for CQCR1001 on 2017-06-05 has been approved. Please take good care of the facilities. Thank You.', '2017-09-28', 10001),
(18, 'Approval of graduation by Student 1000000002', 'The application for graduation on 2017-09-28 has been approved. Further notice will be given please be patient. Thank You.', '2017-09-28', 10001),
(19, 'Approval of presentation by Student 1000000003', 'The application for presentation on 2017-06-05 has been approved. Please contact your supervisor, Dok2, for more details.', '2017-09-28', 10000),
(20, 'Approval of graduation by Student 1000000000', 'The application for graduation on 2017-09-29 has been approved. Further notice will be given please be patient. Thank You.', '2017-09-29', 10000),
(21, 'Approval of graduation by Student 1000000003', 'The application for graduation on 2017-09-29 has been approved. Further notice will be given please be patient. Thank You.', '2017-09-29', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `Student_ID` int(11) NOT NULL,
  `Subject_ID` varchar(7) NOT NULL,
  `Atten_Date` date NOT NULL,
  `Subject_Group` varchar(5) NOT NULL,
  `Attendance` varchar(1) DEFAULT NULL,
  `Supervisor_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`Student_ID`, `Subject_ID`, `Atten_Date`, `Subject_Group`, `Attendance`, `Supervisor_ID`) VALUES
(1000000000, 'PSP0101', '2017-09-09', 'TC01', 'F', 1000000),
(1000000001, 'PSP0101', '2017-09-09', 'TC01', 'T', 1000000),
(1000000002, 'PSP0101', '2017-09-09', 'TC01', 'F', 1000000);

-- --------------------------------------------------------

--
-- Table structure for table `csw_student`
--

CREATE TABLE `csw_student` (
  `Student_ID` int(11) NOT NULL,
  `Total_Credit_Hour` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `csw_student`
--

INSERT INTO `csw_student` (`Student_ID`, `Total_Credit_Hour`) VALUES
(1000000000, 40),
(1000000001, 60),
(1000000002, 20),
(1000000005, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `Enrollment_ID` int(11) NOT NULL,
  `Student_ID` int(11) DEFAULT NULL,
  `Subject_ID` varchar(7) DEFAULT NULL,
  `Subject_Group` varchar(5) DEFAULT NULL,
  `Enroll_Year` int(11) DEFAULT NULL,
  `Finance_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`Enrollment_ID`, `Student_ID`, `Subject_ID`, `Subject_Group`, `Enroll_Year`, `Finance_ID`) VALUES
(9007, 1000000000, 'PSP0101', 'TC01', 2017, 8000),
(9008, 1000000000, 'PSP0101', 'TT01', 2017, 8000),
(9009, 1000000001, 'PSP0101', 'TC01', 2017, 8001),
(9010, 1000000001, 'PSP0101', 'TT01', 2017, 8001),
(9011, 1000000000, 'PEN0505', 'TC01', 2016, 8000),
(9012, 1000000000, 'PEN0505', 'TT01', 2016, 8000);

-- --------------------------------------------------------

--
-- Table structure for table `finance`
--

CREATE TABLE `finance` (
  `Finance_ID` int(11) NOT NULL,
  `Due_Date` date DEFAULT NULL,
  `Finance_Status` varchar(10) DEFAULT NULL,
  `Outstanding_Fees` decimal(7,2) DEFAULT NULL,
  `Student_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finance`
--

INSERT INTO `finance` (`Finance_ID`, `Due_Date`, `Finance_Status`, `Outstanding_Fees`, `Student_ID`) VALUES
(8000, '2017-09-20', 'Uncleared', '1200.00', 1000000000),
(8001, '2017-07-20', 'Uncleared', '2200.00', 1000000001),
(8002, '2017-08-20', 'Uncleared', '5900.00', 1000000002),
(8003, '2017-08-20', 'Uncleared', '1412.00', 1000000003),
(8004, '2017-08-20', 'Uncleared', '4700.00', 1000000005);

-- --------------------------------------------------------

--
-- Table structure for table `graduation`
--

CREATE TABLE `graduation` (
  `Grad_ID` int(11) NOT NULL,
  `Grad_Date` date DEFAULT NULL,
  `Grad_Status` varchar(10) DEFAULT NULL,
  `Student_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `graduation`
--

INSERT INTO `graduation` (`Grad_ID`, `Grad_Date`, `Grad_Status`, `Student_ID`) VALUES
(3007, '2017-09-28', 'Pending', 1000000002),
(3009, '2017-09-29', 'Pending', 1000000003),
(3011, '2017-10-02', 'Rejected', 1000000000);

-- --------------------------------------------------------

--
-- Table structure for table `presentation`
--

CREATE TABLE `presentation` (
  `Pre_ID` int(11) NOT NULL,
  `Pre_Status` varchar(10) DEFAULT NULL,
  `Pre_Date` date DEFAULT NULL,
  `Pre_Time` varchar(10) DEFAULT NULL,
  `Student_ID` int(11) DEFAULT NULL,
  `Supervisor_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `presentation`
--

INSERT INTO `presentation` (`Pre_ID`, `Pre_Status`, `Pre_Date`, `Pre_Time`, `Student_ID`, `Supervisor_ID`) VALUES
(4000, 'Success', '2017-06-05', '1:30PM', 1000000003, 1000001),
(4007, 'Success', '2017-06-05', '12:32PM', 1000000004, 1000001),
(4008, 'Success', '2017-06-05', '03:31PM', 1000000003, 1000001),
(4009, 'Success', '2017-06-05', '03:31PM', 1000000003, 1000001),
(4010, 'Success', '2017-06-05', '05:56AM', 1000000003, 1000001),
(4011, 'Success', '2017-06-05', '03:54AM', 1000000003, 1000001),
(4012, 'Success', '2017-06-05', '03:33AM', 1000000003, 1000001),
(4013, 'Rejected', '2017-06-05', '01:11AM', 1000000003, 1000001),
(4014, 'Success', '2017-06-05', '05:55AM', 1000000003, 1000001),
(4015, 'Success', '2017-06-05', '01:30AM', 1000000003, 1000001),
(4016, 'Success', '2017-06-05', '03:31AM', 1000000003, 1000001),
(4017, 'Success', '2017-06-05', '03:31AM', 1000000003, 1000001),
(4018, 'Rejected', '2017-06-05', '03:31AM', 1000000003, 1000001);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `Reserve_ID` int(11) NOT NULL,
  `Reserve_Date` date DEFAULT NULL,
  `Reserve_Reason` varchar(255) DEFAULT NULL,
  `Reserve_Status` varchar(10) DEFAULT NULL,
  `Admin_ID` int(11) DEFAULT NULL,
  `Student_ID` int(11) DEFAULT NULL,
  `Venue_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`Reserve_ID`, `Reserve_Date`, `Reserve_Reason`, `Reserve_Status`, `Admin_ID`, `Student_ID`, `Venue_ID`) VALUES
(1, '2017-06-05', 'FOR FUNHAHA', 'Rejected', NULL, 1000000000, 5003),
(3, '2017-06-05', '(In 255 words...)', 'Success', NULL, 1000000000, 5000),
(5, '2017-06-05', '(In 255 words...)', 'Rejected', 10000, NULL, 5004),
(6, '2017-06-05', '(In 255 words...)', 'Success', 10000, NULL, 5003),
(7, '2017-09-11', 'new kings', 'Success', 10000, NULL, 5002),
(8, '2017-09-11', 'justhis jeonbok hago guwon', 'Success', NULL, 1000000000, 5001),
(9, '2017-09-11', '(In 255 words...)', 'Success', NULL, 1000000000, 5004),
(10, '2017-09-11', '(In 255 words...)', 'Rejected', NULL, 1000000001, 5001),
(11, '2017-06-05', 'Pokemon purpose', 'Rejected', NULL, 1000000000, 5000),
(12, '2017-06-05', 'life sucks', 'Success', 10001, NULL, 5004),
(16, '2017-06-05', 'FCK', 'Success', NULL, 1000000000, 5000),
(17, '2017-06-05', 'shit', 'Rejected', NULL, 1000000000, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `Result_ID` int(11) NOT NULL,
  `GPA` decimal(4,2) DEFAULT NULL,
  `CGPA` decimal(4,2) DEFAULT NULL,
  `CurrentCredit_Hour` int(11) DEFAULT NULL,
  `Student_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`Result_ID`, `GPA`, `CGPA`, `CurrentCredit_Hour`, `Student_ID`) VALUES
(2000, '4.00', '4.00', 10, 1000000001),
(2001, '2.05', '3.00', 15, 1000000000);

-- --------------------------------------------------------

--
-- Table structure for table `r_student`
--

CREATE TABLE `r_student` (
  `Student_ID` int(11) NOT NULL,
  `Supervisor_ID` int(11) DEFAULT NULL,
  `Tier` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_student`
--

INSERT INTO `r_student` (`Student_ID`, `Supervisor_ID`, `Tier`) VALUES
(1000000003, 1000001, 2),
(1000000004, 1000001, 3);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `Student_ID` int(11) NOT NULL,
  `Student_Name` varchar(50) DEFAULT NULL,
  `Student_Pass` varchar(15) DEFAULT NULL,
  `Student_Mode` varchar(1) DEFAULT NULL,
  `Student_Status` varchar(15) DEFAULT NULL,
  `Student_Course` varchar(25) DEFAULT NULL,
  `Student_Faculty` varchar(20) DEFAULT NULL,
  `Student_Contact` varchar(12) DEFAULT NULL,
  `Student_Email` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`Student_ID`, `Student_Name`, `Student_Pass`, `Student_Mode`, `Student_Status`, `Student_Course`, `Student_Faculty`, `Student_Contact`, `Student_Email`) VALUES
(1000000000, 'Justhis', 'heoseung', 'C', 'Barred', 'IT', 'FCI', '012-4567894', 'jigeahah1997@gmail.com'),
(1000000001, 'Young B', 'hong won', 'C', 'Active', 'IT', 'FCI', '012-123123', 'youngb@gmail.com'),
(1000000002, 'Huck P', 'sang hyuk', 'C', 'Active', 'IT', 'FCI', '016-4567894', 'sanghyuk@gmail.com'),
(1000000003, 'Changmo', 'changmo', 'R', 'Active', 'IT', 'FCI', '013-12314', 'jigeahah1997@gmail.com'),
(1000000004, 'Hyoeun', 'hyoeun', 'R', 'Active', 'IT', 'FCI', '012-514123', 'hyoeun@gmail.com'),
(1000000005, 'Kebee', 'isaacbae', 'C', 'Active', 'IT', 'FCI', '012-2412312', 'Kebee@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `Subject_ID` varchar(7) NOT NULL,
  `Subject_Group` varchar(5) NOT NULL,
  `Subject_Name` varchar(50) DEFAULT NULL,
  `Credit_Hour` int(11) DEFAULT NULL,
  `FinalExa_Date` date DEFAULT NULL,
  `FinalExa_Time` varchar(10) DEFAULT NULL,
  `Price` decimal(7,2) DEFAULT NULL,
  `Time` varchar(10) DEFAULT NULL,
  `Class_Day` varchar(10) DEFAULT NULL,
  `Term` int(11) DEFAULT NULL,
  `FinalExa_Venue` int(11) DEFAULT NULL,
  `Class_Venue` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`Subject_ID`, `Subject_Group`, `Subject_Name`, `Credit_Hour`, `FinalExa_Date`, `FinalExa_Time`, `Price`, `Time`, `Class_Day`, `Term`, `FinalExa_Venue`, `Class_Venue`) VALUES
('PDS0101', 'TC01', 'Digital System', 10, '2017-03-05', '12:00pm', '1000.00', '9:00am', 'Tuesday', 1, 5002, 5003),
('PDS0101', 'TT01', 'Digital System', 10, '2017-03-05', '12:00pm', '1000.00', '11:00am', 'Tuesday', 1, 5002, 5001),
('PEN0505', 'TC01', 'Math', 10, '2017-03-05', '9:00am', '1000.00', '9:00am', 'Monday', 1, 5000, 5000),
('PEN0505', 'TT01', 'Math', 10, '2017-03-05', '9:00am', '1000.00', '11:00am', 'Monday', 1, 5000, 5001),
('PSP0101', 'TC01', 'Mini IT Project', 10, '2017-09-05', '9:00am', '1200.00', '9:00am', 'Tuesday', 3, 5001, 5003),
('PSP0101', 'TT01', 'Mini IT Project', 10, '2017-09-05', '9:00am', '1200.00', '11:00am', 'Thursday', 3, 5001, 5004),
('SEF0102', 'TC01', 'Software Engineering', 10, '2017-08-05', '1:00pm', '1200.00', '9:00am', 'Wednesday', 2, 5002, 5003),
('SEF0102', 'TT01', 'Software Engineering', 10, '2017-08-05', '1:00pm', '1200.00', '8:30am', 'Friday', 2, 5003, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `subject_result`
--

CREATE TABLE `subject_result` (
  `Result_ID` int(11) NOT NULL,
  `Supervisor_ID` int(11) NOT NULL,
  `Subject_ID` varchar(7) NOT NULL,
  `Marks` decimal(5,2) DEFAULT NULL,
  `Current_Year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_result`
--

INSERT INTO `subject_result` (`Result_ID`, `Supervisor_ID`, `Subject_ID`, `Marks`, `Current_Year`) VALUES
(2000, 1000000, 'PEN0505', '100.00', 2017),
(2000, 1000000, 'PSP0101', '87.75', 2017),
(2000, 1000000, 'SEF0102', '35.00', 2017);

-- --------------------------------------------------------

--
-- Table structure for table `subject_supervisor`
--

CREATE TABLE `subject_supervisor` (
  `Supervisor_ID` int(11) NOT NULL,
  `Subject_ID` varchar(7) NOT NULL,
  `Subject_Group` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_supervisor`
--

INSERT INTO `subject_supervisor` (`Supervisor_ID`, `Subject_ID`, `Subject_Group`) VALUES
(1000000, 'PSP0101', 'TC01'),
(1000000, 'SEF0102', 'TC01'),
(1000000, 'SEF0102', 'TT01');

-- --------------------------------------------------------

--
-- Table structure for table `supervisor`
--

CREATE TABLE `supervisor` (
  `Supervisor_ID` int(11) NOT NULL,
  `Supervisor_Name` varchar(50) DEFAULT NULL,
  `Supervisor_Pass` varchar(15) DEFAULT NULL,
  `Supervisor_Contact` varchar(12) DEFAULT NULL,
  `Supervisor_Email` varchar(25) DEFAULT NULL,
  `Supervisor_Faculty` varchar(25) DEFAULT NULL,
  `Supervisor_Room` varchar(10) DEFAULT NULL,
  `Supervisor_Status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supervisor`
--

INSERT INTO `supervisor` (`Supervisor_ID`, `Supervisor_Name`, `Supervisor_Pass`, `Supervisor_Contact`, `Supervisor_Email`, `Supervisor_Faculty`, `Supervisor_Room`, `Supervisor_Status`) VALUES
(1000000, 'Swings', 'moonjihoon', '012-1322212', 'indigojm@gmail.com', 'FCI', 'BR1001', 'Active'),
(1000001, 'Dok2', 'gonzo', '011-11111', '1llionaire', '1llibition', 'FOM', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE `venue` (
  `Venue_ID` int(11) NOT NULL,
  `Venue_Detail` varchar(100) DEFAULT NULL,
  `Venue_Faculty` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`Venue_ID`, `Venue_Detail`, `Venue_Faculty`) VALUES
(5000, 'CQCR1001', 'FCI'),
(5001, 'CQCR2001', 'FCI'),
(5002, 'Grand Hall', 'Grand Hall'),
(5003, 'CQMX1001', 'Multipurpose Hall'),
(5004, 'CQAR3002', 'FCI');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`Announce_ID`),
  ADD KEY `Admin_ID` (`Admin_ID`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`Student_ID`,`Subject_ID`,`Atten_Date`,`Subject_Group`),
  ADD KEY `Subject_ID` (`Subject_ID`,`Subject_Group`),
  ADD KEY `Student_ID` (`Student_ID`),
  ADD KEY `Supervisor_ID` (`Supervisor_ID`);

--
-- Indexes for table `csw_student`
--
ALTER TABLE `csw_student`
  ADD PRIMARY KEY (`Student_ID`),
  ADD KEY `Student_ID` (`Student_ID`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`Enrollment_ID`),
  ADD KEY `Student_ID` (`Student_ID`),
  ADD KEY `Subject_ID` (`Subject_ID`),
  ADD KEY `Subject_Group` (`Subject_Group`),
  ADD KEY `Finance_ID` (`Finance_ID`);

--
-- Indexes for table `finance`
--
ALTER TABLE `finance`
  ADD PRIMARY KEY (`Finance_ID`),
  ADD KEY `Student_ID` (`Student_ID`);

--
-- Indexes for table `graduation`
--
ALTER TABLE `graduation`
  ADD PRIMARY KEY (`Grad_ID`),
  ADD KEY `Student_ID` (`Student_ID`);

--
-- Indexes for table `presentation`
--
ALTER TABLE `presentation`
  ADD PRIMARY KEY (`Pre_ID`),
  ADD KEY `Student_ID` (`Student_ID`),
  ADD KEY `Supervisor_ID` (`Supervisor_ID`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`Reserve_ID`),
  ADD KEY `Admin_ID` (`Admin_ID`),
  ADD KEY `Student_ID` (`Student_ID`),
  ADD KEY `Venue_ID` (`Venue_ID`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`Result_ID`),
  ADD KEY `Student_ID` (`Student_ID`);

--
-- Indexes for table `r_student`
--
ALTER TABLE `r_student`
  ADD PRIMARY KEY (`Student_ID`),
  ADD KEY `Supervisor_ID` (`Supervisor_ID`),
  ADD KEY `Student_ID` (`Student_ID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`Student_ID`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`Subject_ID`,`Subject_Group`),
  ADD KEY `FinalExa_Venue` (`FinalExa_Venue`),
  ADD KEY `Class_Venue` (`Class_Venue`);

--
-- Indexes for table `subject_result`
--
ALTER TABLE `subject_result`
  ADD PRIMARY KEY (`Result_ID`,`Supervisor_ID`,`Subject_ID`),
  ADD KEY `Supervisor_ID` (`Supervisor_ID`),
  ADD KEY `Subject_ID` (`Subject_ID`);

--
-- Indexes for table `subject_supervisor`
--
ALTER TABLE `subject_supervisor`
  ADD PRIMARY KEY (`Supervisor_ID`,`Subject_ID`,`Subject_Group`),
  ADD KEY `Subject_ID` (`Subject_ID`,`Subject_Group`);

--
-- Indexes for table `supervisor`
--
ALTER TABLE `supervisor`
  ADD PRIMARY KEY (`Supervisor_ID`);

--
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`Venue_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `Admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10003;
--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `Announce_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `Enrollment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9013;
--
-- AUTO_INCREMENT for table `finance`
--
ALTER TABLE `finance`
  MODIFY `Finance_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8005;
--
-- AUTO_INCREMENT for table `graduation`
--
ALTER TABLE `graduation`
  MODIFY `Grad_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3012;
--
-- AUTO_INCREMENT for table `presentation`
--
ALTER TABLE `presentation`
  MODIFY `Pre_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4019;
--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `Reserve_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `Result_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2002;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `Student_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000006;
--
-- AUTO_INCREMENT for table `supervisor`
--
ALTER TABLE `supervisor`
  MODIFY `Supervisor_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000002;
--
-- AUTO_INCREMENT for table `venue`
--
ALTER TABLE `venue`
  MODIFY `Venue_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5005;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcement`
--
ALTER TABLE `announcement`
  ADD CONSTRAINT `announcement_ibfk_1` FOREIGN KEY (`Admin_ID`) REFERENCES `administrator` (`Admin_ID`);

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`Student_ID`) REFERENCES `student` (`Student_ID`),
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`Subject_ID`,`Subject_Group`) REFERENCES `subject` (`Subject_ID`, `Subject_Group`),
  ADD CONSTRAINT `attendance_ibfk_3` FOREIGN KEY (`Supervisor_ID`) REFERENCES `supervisor` (`Supervisor_ID`);

--
-- Constraints for table `csw_student`
--
ALTER TABLE `csw_student`
  ADD CONSTRAINT `csw_student_ibfk_1` FOREIGN KEY (`Student_ID`) REFERENCES `student` (`Student_ID`) ON DELETE CASCADE;

--
-- Constraints for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `enrollment_ibfk_1` FOREIGN KEY (`Student_ID`) REFERENCES `student` (`Student_ID`),
  ADD CONSTRAINT `enrollment_ibfk_2` FOREIGN KEY (`Finance_ID`) REFERENCES `finance` (`Finance_ID`);

--
-- Constraints for table `finance`
--
ALTER TABLE `finance`
  ADD CONSTRAINT `finance_ibfk_1` FOREIGN KEY (`Student_ID`) REFERENCES `student` (`Student_ID`);

--
-- Constraints for table `graduation`
--
ALTER TABLE `graduation`
  ADD CONSTRAINT `graduation_ibfk_2` FOREIGN KEY (`Student_ID`) REFERENCES `student` (`Student_ID`) ON DELETE SET NULL;

--
-- Constraints for table `presentation`
--
ALTER TABLE `presentation`
  ADD CONSTRAINT `presentation_ibfk_1` FOREIGN KEY (`Student_ID`) REFERENCES `student` (`Student_ID`),
  ADD CONSTRAINT `presentation_ibfk_2` FOREIGN KEY (`Supervisor_ID`) REFERENCES `supervisor` (`Supervisor_ID`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`Admin_ID`) REFERENCES `administrator` (`Admin_ID`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`Student_ID`) REFERENCES `student` (`Student_ID`),
  ADD CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`Venue_ID`) REFERENCES `venue` (`Venue_ID`);

--
-- Constraints for table `result`
--
ALTER TABLE `result`
  ADD CONSTRAINT `result_ibfk_1` FOREIGN KEY (`Student_ID`) REFERENCES `student` (`Student_ID`);

--
-- Constraints for table `r_student`
--
ALTER TABLE `r_student`
  ADD CONSTRAINT `r_student_ibfk_1` FOREIGN KEY (`Student_ID`) REFERENCES `student` (`Student_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `r_student_ibfk_2` FOREIGN KEY (`Supervisor_ID`) REFERENCES `supervisor` (`Supervisor_ID`) ON DELETE SET NULL;

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`FinalExa_Venue`) REFERENCES `venue` (`Venue_ID`) ON DELETE SET NULL,
  ADD CONSTRAINT `subject_ibfk_2` FOREIGN KEY (`Class_Venue`) REFERENCES `venue` (`Venue_ID`) ON DELETE SET NULL;

--
-- Constraints for table `subject_result`
--
ALTER TABLE `subject_result`
  ADD CONSTRAINT `subject_result_ibfk_1` FOREIGN KEY (`Result_ID`) REFERENCES `result` (`Result_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `subject_result_ibfk_2` FOREIGN KEY (`Supervisor_ID`) REFERENCES `supervisor` (`Supervisor_ID`),
  ADD CONSTRAINT `subject_result_ibfk_3` FOREIGN KEY (`Subject_ID`) REFERENCES `subject` (`Subject_ID`);

--
-- Constraints for table `subject_supervisor`
--
ALTER TABLE `subject_supervisor`
  ADD CONSTRAINT `subject_supervisor_ibfk_1` FOREIGN KEY (`Supervisor_ID`) REFERENCES `supervisor` (`Supervisor_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `subject_supervisor_ibfk_2` FOREIGN KEY (`Subject_ID`,`Subject_Group`) REFERENCES `subject` (`Subject_ID`, `Subject_Group`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
