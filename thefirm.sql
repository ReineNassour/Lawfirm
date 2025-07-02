-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2025 at 02:41 PM
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
-- Database: `thefirm`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(50) NOT NULL,
  `x` int(50) NOT NULL,
  `y` int(50) NOT NULL,
  `details` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `building` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `caseid` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `x`, `y`, `details`, `city`, `building`, `street`, `caseid`) VALUES
(1, 38, -122, 'in front of the Quebec Hotels', 'San Francisco', 'Francy', 'F.12 Street', 37),
(15, 38, -123, 'in front of Bank Audi:', 'Quebec:', 'Main Tower:', 'Reine\'s Street', 37),
(16, 38, -122, 'in front of Bank Audi:', 'Quebec:', 'Main Tower:', 'Reine\'s Street', 38),
(17, 39, -117, 'in front of Byblos Bank', 'Hamra', 'Tower#4', 'YXYXY\'s Street', 39),
(19, 38, -192, 'in front of Usj', 'Ashrafiyeh', 'NNN\'s', 'Nad\'s Street', 47),
(21, 38, -122, 'near City Hall', 'Ottawa', 'Capital Center', 'Queen', 48),
(23, 38, -122, 'in front FB Bank', 'Beirut', 'Four season', 'Reine\'s', 48),
(24, 38, -122, 'in front of bank Audi', 'Beirut', 'T\'s', 'AA\'s.', 38),
(28, 38, -122, '100 Metre Far from Lop University', 'Beirut', 'qubec', 'ZZZ\'ss', 38),
(31, 38, -122, 'in front of Bank Beirut', 'Tripoli', 'Mirna SH', 'WW\'ss', 47),
(36, 38, -122, '100 Metre Far from BSA Bank', 'Tripoli', 'RRRR SH', 'WEQ\'ss', 47),
(38, 38, -122, 'jkfkjfufhu', 'Beirut', 'ee', 'sss', 54);

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(50) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `grade` int(50) NOT NULL,
  `questid` int(50) NOT NULL,
  `userid` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `answer`, `grade`, `questid`, `userid`) VALUES
(5, 'ok', 8, 1, 11),
(6, 'okk', 7, 2, 11),
(7, 'okkk', 9, 3, 11),
(16, 'oui', 7, 1, 7),
(17, 'akid', 8, 2, 7),
(18, 'yes', 7, 3, 7),
(19, 'yess', 35, 7, 10),
(20, 'yess', 17, 8, 10),
(21, 'ouiiii', 18, 9, 10),
(22, 'ok', 16, 10, 10),
(23, 'قاعدة قانونية: منع السرقة، ويُعاقب السارق بالسجن حسب القانون الجنائي', 100, 11, 36);

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `id` int(50) NOT NULL,
  `interviewlink` varchar(255) NOT NULL,
  `interviewStatus` enum('Pending','Done') NOT NULL DEFAULT 'Pending',
  `interviewdate` varchar(255) NOT NULL,
  `interviewtime` varchar(255) NOT NULL,
  `userid` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`id`, `interviewlink`, `interviewStatus`, `interviewdate`, `interviewtime`, `userid`) VALUES
(4, 'https://zoom.us/j/1234567890?pwd=abc123', 'Pending', '2025-04-22', '10:30', 11),
(5, 'https://us02web.zoom.us/j/9876543210?pwd=ZYXWVUTSRQPONMLKJIHGFEDCBA', 'Pending', '2025-04-29', '04:15', 7),
(6, 'https://zoom.us/j/1234567890?pwd=vcv231', 'Pending', '2025-05-21', '02:30', 10);

-- --------------------------------------------------------

--
-- Table structure for table `attcontract`
--

CREATE TABLE `attcontract` (
  `id` int(50) NOT NULL,
  `salary` int(50) NOT NULL,
  `startdate` date NOT NULL,
  `expirydate` date NOT NULL,
  `details` varchar(255) NOT NULL,
  `nbofHour` int(50) NOT NULL,
  `attid` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attcontract`
--

INSERT INTO `attcontract` (`id`, `salary`, `startdate`, `expirydate`, `details`, `nbofHour`, `attid`) VALUES
(6, 10, '2025-05-14', '2025-08-14', '10% Of each case', 10, 7),
(8, 20, '2025-05-28', '2026-03-28', '20% Of each Case', 12, 8),
(9, 30, '2025-05-21', '2025-09-21', '30% Of each case', 8, 10),
(10, 10, '2025-05-02', '2025-10-02', '10% of each case', 8, 11),
(11, 40, '2025-05-01', '2027-05-01', '40% of each case', 10, 19),
(12, 20, '2025-05-30', '2025-09-17', '20% of each case', 10, 36);

-- --------------------------------------------------------

--
-- Table structure for table `attorneys`
--

CREATE TABLE `attorneys` (
  `userid` int(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `specialized` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attorneys`
--

INSERT INTO `attorneys` (`userid`, `description`, `specialized`) VALUES
(7, 'Eager to expand upon a Master’s in Business Law through advanced specialization and practical experience to drive impactful legal solutions in corporate and international settings.', 'Family'),
(8, 'A criminal attorney with 3 years of experience has gained hands-on expertise in defending clients against criminal charges, handling cases in court, negotiating settlements, and ensuring the protection of clients\' rights through legal strategies.', 'Criminal'),
(10, 'Yes, I am eager to expand my knowledge and skills to advance my career.', 'Civil'),
(11, 'of course.', 'Political'),
(19, 'Experienced Political Attorney with a decade of expertise in legal advocacy, policy analysis, and governmental affairs.', 'Political'),
(36, 'huhigg ', 'Plitical');

-- --------------------------------------------------------

--
-- Table structure for table `case`
--

CREATE TABLE `case` (
  `id` int(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `status` enum('Pending','Accepted','Rejected') NOT NULL DEFAULT 'Pending',
  `casestatus` enum('Pending','Closed') NOT NULL DEFAULT 'Pending',
  `caseContractimg` varchar(255) NOT NULL,
  `userid` int(50) NOT NULL,
  `categoryid` int(50) NOT NULL,
  `attid` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `case`
--

INSERT INTO `case` (`id`, `description`, `startdate`, `enddate`, `status`, `casestatus`, `caseContractimg`, `userid`, `categoryid`, `attid`) VALUES
(24, 'killed someone', '2025-03-07', '0000-00-00', 'Pending', 'Pending', '0', 11, 1, 8),
(26, 'A businessman was attacked in his home, revealing a crime driven by betrayal and revenge.', '2025-03-10', '2025-05-24', 'Accepted', 'Pending', '0', 12, 1, 8),
(37, 'Last week,when i came home at 5:08 pm someone was following me from the resto when i was to the home . then when i got out of my car,this guy has hurt me and killed me.', '2025-03-18', '2025-04-24', 'Accepted', 'Pending', '0', 10, 1, 8),
(38, 'From a year ago,when i went to the beach at 3:02 am someone was following me from my home to the batroun beach. then when i got out of my goods,this guy has hurt me and killed me.', '2025-03-18', '2025-05-18', 'Accepted', 'Pending', '0', 7, 1, 8),
(39, 'I am facing allegations of campaign finance violations, including improper donations and funding disclosures, and need legal guidance to navigate compliance and potential penalties.', '2025-03-20', '0000-00-00', 'Accepted', 'Pending', '0', 17, 2, 19),
(47, 'I was walking at night and man tried to kill me, so i had to defend myself and i ended up killing him .Suddenly Tante Sabah started Screaming and her daughter Carole ran from the 1st floor to the  backyard to bring the Stick .  ', '2025-05-09', '2025-05-09', 'Accepted', 'Pending', '0', 33, 1, 8),
(48, 'A whistleblower exposed high-level government corruption involving illicit campaign funding. The case led to multiple resignations and new transparency laws.', '2025-05-09', '2025-05-09', 'Accepted', 'Pending', './img/case-contract (2).png', 33, 2, 11),
(54, 'vguyggru r', '2025-05-30', '0000-00-00', 'Accepted', 'Pending', './img/case-contract (2).png', 36, 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `casewon`
--

CREATE TABLE `casewon` (
  `id` int(50) NOT NULL,
  `nbofcases` int(50) NOT NULL,
  `year` int(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `cvid` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `casewon`
--

INSERT INTO `casewon` (`id`, `nbofcases`, `year`, `description`, `cvid`) VALUES
(1, 1, 2024, 'it was a criminal case about someone that attack his friend', 3),
(2, 2, 2025, 'another criminal case with someone who stole a house and killed the security', 3),
(11, 3, 2023, '', 11),
(12, 2, 2003, '', 13),
(14, 0, 2024, '', 14),
(15, 0, 2024, '', 14),
(16, 1, 2025, '', 3),
(17, 3, 2023, 'I\'ve won 2 finance cases and 1 educational case....', 16),
(18, 1, 2025, '', 4),
(19, 1, 2025, '', 4),
(20, 1, 2025, '', 3),
(21, 1, 2025, '', 3),
(22, 1, 2025, '', 3),
(23, 1, 2025, '', 3),
(24, 1, 2025, '', 3),
(25, 1, 2025, 'criminal ', 17),
(26, 2, 2024, 'hbbuu ', 17);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `image`) VALUES
(1, 'Criminal', 'Murder Case', 'img/portfolio-1.jpg'),
(2, 'Political', 'Political Case', 'img/portfolio-2.jpg'),
(3, 'Family', 'Divorce Case', 'img/portfolio-3.jpg'),
(4, 'Finance', 'Money Laundering', 'img/portfolio-4.jpg'),
(5, 'Education', 'Weber & Partners', 'img/portfolio-5.jpg'),
(6, 'Civil', 'Property Sharing Case', 'img/portfolio-6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ccontract`
--

CREATE TABLE `ccontract` (
  `id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `total` double DEFAULT NULL,
  `nbrofpay` int(11) DEFAULT NULL,
  `status` enum('Pending','Accepted') DEFAULT 'Pending',
  `paycontractimg` varchar(255) NOT NULL,
  `caseid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ccontract`
--

INSERT INTO `ccontract` (`id`, `description`, `total`, `nbrofpay`, `status`, `paycontractimg`, `caseid`) VALUES
(1, 'Client has filed a criminal case and wishes to pay the attorney\'s fee in fourth installments.', 4000, 4, 'Accepted', '0', 38),
(2, 'Client has filed a criminal case and wishes to pay the attorney\'s fee in fourth installments.', 4000, 4, 'Accepted', '0', 37),
(5, 'Client has filed a criminal case and wishes to pay the attorney\'s fee in two installments.', 10000, 2, 'Accepted', './img/case-contract (3).png', 48),
(6, 'Client has filed a criminal case and wishes to pay the attorney\'s fee in four installments.', 8000, 4, 'Accepted', '0', 26),
(12, 'Client has filed a criminal case and wishes to pay the attorney\'s fee in three installments.', 2000, 2, 'Accepted', '0', 47),
(13, 'Client has filed a criminal case and wishes to pay the attorney\'s fee in 2 installments.', 2000, 2, 'Accepted', './img/case-contract (3).png', 54);

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` int(50) NOT NULL,
  `usermss` varchar(255) NOT NULL,
  `attmss` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `caseid` int(50) NOT NULL,
  `userid` int(50) NOT NULL,
  `attid` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `usermss`, `attmss`, `time`, `caseid`, `userid`, `attid`) VALUES
(34, 'okay', '', '2025-03-22 16:32:19', 37, 10, 8),
(42, '', 'hello,be ready for next week for a zoom meeting.Soon i will send the link,date and time', '2025-03-26 15:46:51', 37, 17, 19),
(50, 'okay Mrs.Angy ', '', '2025-05-10 15:15:22', 48, 33, 11),
(52, '', 'Hi Jenny! ', '2025-05-23 11:50:37', 47, 33, 8),
(53, '', 'Hope your doing well', '2025-05-23 11:50:50', 47, 33, 8),
(54, 'Hello Mr.Wassim', '', '2025-05-23 11:51:35', 47, 33, 8),
(55, 'When and where is the session?', '', '2025-05-23 11:53:40', 47, 33, 8),
(57, '', 'ugigigugu', '2025-05-30 12:04:05', 54, 36, 8),
(58, '', '2000$ ', '2025-05-30 12:09:40', 54, 36, 8);

-- --------------------------------------------------------

--
-- Table structure for table `cv`
--

CREATE TABLE `cv` (
  `id` int(50) NOT NULL,
  `university` varchar(255) NOT NULL,
  `year` int(50) NOT NULL,
  `level` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `specialized` varchar(255) NOT NULL,
  `status` enum('Pending','Accepted','Rejected') NOT NULL DEFAULT 'Pending',
  `userid` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cv`
--

INSERT INTO `cv` (`id`, `university`, `year`, `level`, `description`, `specialized`, `status`, `userid`) VALUES
(3, 'Lebanese university', 2019, 'Master 1 in Law', 'With three years of experience in criminal law, I have honed my expertise in defending clients and navigating complex legal systems. My focus has been on delivering effective representation while upholding justice and ethical standards.', 'Criminal', 'Rejected', 8),
(4, 'American University Of dubai', 2022, 'Yes,on my way to the PHD.', 'of course.', 'Political', 'Accepted', 11),
(11, 'Sagess University', 2020, 'M2 In International Law.', 'Yes, I am eager to expand my knowledge and skills to advance my career.', 'Civil', 'Accepted', 10),
(12, 'American University of Beirut', 2014, 'Master 2 in International Law', 'Two years ago, I decided to pursue my PhD in International Law.', 'Education', 'Pending', 19),
(13, 'liu', 2023, 'phd', 'juhniiu', 'Finance', 'Rejected', 9),
(14, 'American University Of Beirut', 2024, 'Masters in Business Law', 'Eager to expand upon a Master’s in Business Law through advanced specialization and practical experience to drive impactful legal solutions in corporate and international settings.', 'Family', 'Accepted', 7),
(16, 'Sagesse University', 2019, 'Masters In Business Law', 'Yes, I’m very interested. I believe that going beyond the basics is key to growing as a legal professional. I’m eager to keep learning, take on challenges, and build the skills needed to contribute effectively and advance in my career.', 'Finance', 'Accepted', 33),
(17, 'Sagesse University', 2022, 'phd in international law', 'huhigg ', 'Plitical', 'Accepted', 36);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(50) NOT NULL,
  `userdoc` varchar(255) NOT NULL,
  `attdoc` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `caseid` int(50) NOT NULL,
  `userid` int(50) NOT NULL,
  `attid` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `userdoc`, `attdoc`, `time`, `caseid`, `userid`, `attid`) VALUES
(1, ' ', './img/dfd.jpg', '2025-05-23 08:52:05', 26, 12, 8),
(2, './img/Screenshot_21-5-2025_174255_localhost.jpeg', ' ', '2025-05-23 09:07:28', 26, 12, 8),
(3, './img/book now narrative.jpg', ' ', '2025-05-23 09:07:39', 26, 12, 8),
(6, ' ', './img/case-contract (3).png', '2025-05-30 12:20:48', 54, 36, 8);

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE `experience` (
  `id` int(50) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `officename` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `nbofyears` int(50) NOT NULL,
  `cvid` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `experience`
--

INSERT INTO `experience` (`id`, `startdate`, `enddate`, `officename`, `details`, `nbofyears`, `cvid`) VALUES
(2, '2021-02-06', '2022-02-06', 'B21', 'one year of pure civil exp', 1, 3),
(3, '2022-03-08', '2023-03-08', 'The Firm', ' Buildings', 1, 3),
(4, '2023-09-16', '2024-09-16', 'Laws', 'oooooo', 1, 3),
(5, '2023-10-04', '2024-10-04', 'Law With John', '', 1, 4),
(6, '2018-06-08', '2020-06-08', 'Laws Office', '', 2, 11),
(7, '2018-06-08', '2020-06-08', 'Laws Office', 'I have four years of experience in political law, focusing on election law, campaign finance, and constitutional issues. I’ve advised clients on compliance, handled legal disputes, and provided counsel to political candidates and organizations.', 2, 11),
(11, '2014-06-14', '2019-08-20', 'The Lawyers', 'I worked for five years in a law office specializing in political law, where I handled cases related to election law, campaign finance regulations, government ethics, and legislative advocacy. My responsibilities included advising political candidates, dr', 5, 12),
(12, '2019-11-23', '2024-07-10', 'LawWithJad', 'I continued my career at LawWithJad, where I expanded my expertise in legislative advocacy, policy analysis, and governmental affairs. I worked closely with policymakers, lobbied for legal reforms, and provided strategic legal counsel on high-profile poli', 5, 12),
(15, '2022-04-01', '2023-04-04', 'Law With John', 'Political Attorney with a Master’s in Business Law, skilled in contract management, legal strategy, and regulatory compliance.', 1, 14),
(16, '2021-01-05', '2022-01-05', 'LawOffice', 'I have three years of experience in [your legal area], during which I’ve managed cases from start to finish—handling client meetings, legal research, drafting, and court appearances. I’ve developed strong advocacy, negotiation, and writing skills. One cas', 1, 16),
(17, '2022-05-04', '2024-05-04', 'TheLaws', 'I have three years of experience in [your legal area], during which I’ve managed cases from start to finish—handling client meetings, legal research, drafting, and court appearances. I’ve developed strong advocacy, negotiation, and writing skills. One cas', 2, 16),
(18, '2025-05-08', '2026-06-23', 'Law With John', 'ygyugug ', 1, 17),
(19, '2025-05-15', '2025-05-28', 'LawOffice', 'ygyugug ', 1, 17);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `casename` varchar(100) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `rating` int(5) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `date`, `name`, `casename`, `comment`, `rating`, `user_id`) VALUES
(1, '2025-04-08', 'Luciana Ghosn', 'i had a Plitical Case', 'amazingggggggggg\r\n', 5, 17);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(50) NOT NULL,
  `content` varchar(255) NOT NULL,
  `sessionid` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `content`, `sessionid`) VALUES
(7, 'If further hearings confirm this was the result of poor management rather than malice, the court may lean toward civil penalties and mandated reforms, rather than criminal conviction.', 5),
(8, 'Based on the new evidence, it\'s clear there were serious lapses in oversight. While no clear intent to deceive has been proven, the court is concerned about the pattern of negligence. Further review is required. Until then, campaign operations will remain', 7),
(11, 'The court acknowledges the gravity of the allegations and commends the whistleblower\'s courage. Proceedings will continue with full commitment to justice and transparency.', 10),
(12, 'Having reviewed the preliminary evidence and heard the initial testimony, the court acknowledges the severity of the allegations concerning the events that transpired on the Batroun beach in the early hours of the morning. The victim\'s account suggests a ', 9),
(13, 'Based on the additional evidence presented and the further witness testimonies heard today, the court recognizes the emerging pattern of intent and the sequence of events leading to the fatal incident. The alleged perpetrator’s behavior, as described, dem', 9),
(14, 'In the first session, the defendant was formally charged with aggravated assault following an incident that occurred on March 12th. The prosecution presented preliminary evidence, including medical reports of the victim and a statement from the responding', 11),
(15, 'During the second session, both the prosecution and defense presented further arguments. The judge questioned the admissibility of a surveillance video provided by the prosecution, noting its unclear timestamp. The defense argued that the accused acted in', 11),
(16, 'biuiggy', 21);

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `id` int(50) NOT NULL,
  `content` varchar(700) NOT NULL,
  `date` date NOT NULL,
  `status` enum('Pending','Done') NOT NULL DEFAULT 'Pending',
  `userid` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inquiry`
--

INSERT INTO `inquiry` (`id`, `content`, `date`, `status`, `userid`) VALUES
(1, ' I would like to inquire about the procedure and required documentation for initiating a contract dispute resolution. Could you kindly provide guidance on the next steps and any associated timelines?', '2025-05-12', 'Done', 33),
(5, '1-Review the Contract for a dispute resolution clause (negotiation, mediation, arbitration, or litigation).\r\n2-Prepare Documentation, including the contract, relevant communications, evidence, and a written summary of the dispute.\r\n3-Send a Formal Notice outlining the dispute and the desired outcome.\r\n4-Engage in Preliminary Resolution (if required by the contract).\r\n5-Initiate Formal Proceedings (arbitration or litigation) if necessary.', '2025-05-12', 'Pending', 9),
(6, 'I would like to know whether your firm offers legal support for cross-border commercial transactions, and if so, what documentation and procedures are typically required to initiate such services?', '2025-05-12', 'Pending', 33),
(7, 'To initiate our services, we typically require the following documentation:\r\n\r\nA summary of the transaction and involved jurisdictions\r\n\r\nDraft or existing contracts or agreements (if any)\r\n\r\nCorporate documents of the involved entities\r\n\r\nContact details of all relevant parties', '2025-05-12', 'Pending', 9);

-- --------------------------------------------------------

--
-- Table structure for table `judge`
--

CREATE TABLE `judge` (
  `id` int(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `caseid` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `judge`
--

INSERT INTO `judge` (`id`, `name`, `caseid`) VALUES
(1, 'Fouad Sarraf', 39),
(2, 'Elie Kfoury', 39),
(4, ' Lina Mahfouz', 38),
(6, 'Majd Sarraf', 48),
(7, 'Nadim Saade', 38),
(11, 'Reve Matar', 38),
(15, 'Maya Farah', 47),
(17, 'hhhh', 54);

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(50) NOT NULL,
  `language` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `cvid` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `language`, `level`, `cvid`) VALUES
(1, 'French', 'Intermediate', 3),
(2, 'English', 'Very Good', 3),
(7, 'French', 'Medium', 4),
(10, 'French', 'Medium', 4),
(31, 'French', 'Medium', 11),
(38, 'English', 'Fluent', 12),
(39, 'Arab', 'Fluent', 12),
(43, 'French', 'Fluent', 14),
(44, 'French', 'Fluent', 14),
(45, 'French', 'Medium', 14),
(46, 'English', 'Fluent', 16),
(47, 'French', 'Fluent', 17);

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `id` int(50) NOT NULL,
  `link` varchar(255) NOT NULL,
  `status` enum('Pending','Done') NOT NULL DEFAULT 'Pending',
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `endtime` varchar(255) NOT NULL,
  `caseid` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`id`, `link`, `status`, `date`, `time`, `endtime`, `caseid`) VALUES
(21, 'https://zoom.us', 'Pending', '2025-12-04', '12:30', '01:30', 39),
(22, 'https://zoom.us', 'Pending', '2025-10-05', '09:15', '10:15', 39),
(25, 'https://zoom.us', 'Pending', '2025-05-16', '01:20', '02:20', 38),
(26, 'https://example.com', 'Pending', '2025-09-12', '02:22', '03:22', 39),
(28, 'https://www.example.com/dfd232', 'Pending', '2025-05-25', '09:15', '10:15', 48),
(32, 'https://zoom.us', 'Pending', '2025-06-12', '03:30', '04:30', 47),
(36, 'https://zoom.us', 'Done', '2025-05-31', '02:07', '02:00', 54);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `status` enum('Paid','UnPaid') DEFAULT 'UnPaid',
  `amount` double DEFAULT NULL,
  `ccontractid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `date`, `status`, `amount`, `ccontractid`) VALUES
(1, '2025-06-01', 'Paid', 1000, 1),
(2, '2025-07-01', 'Paid', 1000, 1),
(3, '2025-08-01', 'Paid', 1000, 1),
(4, '2025-09-01', 'UnPaid', 1000, 1),
(14, '2025-09-01', 'Paid', 5000, 5),
(15, '2025-10-01', 'UnPaid', 5000, 5),
(16, '2025-07-01', 'Paid', 2000, 6),
(17, '2025-08-01', 'Paid', 2000, 6),
(18, '2025-09-01', 'UnPaid', 2000, 6),
(19, '2025-10-01', 'UnPaid', 2000, 6),
(22, '2025-07-01', 'Paid', 1000, 13),
(23, '2025-09-01', 'UnPaid', 1000, 13);

-- --------------------------------------------------------

--
-- Table structure for table `practicearea`
--

CREATE TABLE `practicearea` (
  `id` int(50) NOT NULL,
  `name` enum('Criminal','Political','Family','Finance','Education','Civil') NOT NULL,
  `description` varchar(500) NOT NULL,
  `rules` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `practicearea`
--

INSERT INTO `practicearea` (`id`, `name`, `description`, `rules`) VALUES
(1, 'Criminal', 'Governs actions that are considered offenses against the state or society, such as theft, assault, and murder.', 'Presumption of Innocence: Defendants are presumed innocent until proven guilty. Right to a Fair Trial: Includes right to an attorney and a fair hearing.'),
(2, 'Political', 'Addresses legal issues related to the internet, digital technologies, online transactions, privacy, and cybersecurity.', 'Data Privacy: Protects how personal data is handled. Intellectual Property: Covers digital IP protection.'),
(3, 'Family', 'Focuses on marriage, divorce, child custody, adoption, and domestic relationships.', 'Marriage and Divorce: Based on mutual consent or legal grounds. Child Custody: Prioritizes child’s best interests.'),
(4, 'Finance', 'Governs commercial transactions, contracts, partnerships, and corporate governance.', 'Securities Regulation: Ensures fair trading. AML Laws: Prevent money laundering.'),
(5, 'Education', 'Involves legal issues in schools, educational policies, student rights, and academic governance.', 'Right to Education: Free primary education. Anti-Discrimination: Ensures equal opportunities.'),
(6, 'Civil', 'Covers individual rights and private legal matters like contracts, property, and torts.', 'Freedom of Contract: Legal agreements must have offer, acceptance, and consideration.');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(50) NOT NULL,
  `given` varchar(255) NOT NULL,
  `grade` int(50) NOT NULL,
  `quizid` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `given`, `grade`, `quizid`) VALUES
(1, 'What is the doctrine of stare decisis and why is it important in legal systems based on common law?', 10, 1),
(2, 'List and briefly explain the essential elements required to form a valid contract.', 10, 1),
(3, 'What is the difference between civil law and criminal law in terms of purpose and legal consequences?', 10, 1),
(7, 'ما الفرق بين القانون المدني والقانون الجنائي؟ اذكر مثالاً على كل منهما؟', 40, 4),
(8, 'هل يجب أن تكون هناك حدود لحرية التعبير في المجتمع الديمقراطي؟ دعّم رأيك بمبادئ قانونية أو سوابق قضائية.', 20, 4),
(9, 'ما العناصر الأساسية لقيام عقد صحيح في القانون العام؟', 20, 4),
(10, 'قام ضابط شرطة بتفتيش منزل أحد الأشخاص دون إذن قضائي. في أي ظروف يمكن اعتبار هذا التفتيش قانونيًا؟ استند إلى مبادئ دستورية أو حقوق الإنسان.', 20, 4),
(11, 'What is the doctrine of stare decisis and why is it important in legal systems based on common law?', 100, 6);

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `id` int(50) NOT NULL,
  `status` enum('Pending','Finished') NOT NULL DEFAULT 'Pending',
  `date` date NOT NULL,
  `starttime` time(5) NOT NULL,
  `endtime` time(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id`, `status`, `date`, `starttime`, `endtime`) VALUES
(1, 'Finished', '2025-05-02', '08:15:00.00000', '23:51:00.00000'),
(4, 'Finished', '2025-05-07', '14:00:00.19500', '22:00:00.00000'),
(5, 'Finished', '2025-05-29', '20:30:00.00000', '22:30:00.00000'),
(6, 'Finished', '2025-05-30', '10:30:00.00000', '11:00:00.93300');

-- --------------------------------------------------------

--
-- Table structure for table `quizresult`
--

CREATE TABLE `quizresult` (
  `id` int(50) NOT NULL,
  `score` int(50) NOT NULL,
  `result` enum('Passed','Failed') NOT NULL,
  `quizid` int(50) NOT NULL,
  `userid` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quizresult`
--

INSERT INTO `quizresult` (`id`, `score`, `result`, `quizid`, `userid`) VALUES
(1, 24, 'Passed', 1, 11),
(16, 22, 'Passed', 1, 7),
(39, 85, 'Passed', 4, 10),
(40, 85, 'Passed', 4, 10),
(41, 85, 'Passed', 4, 10),
(42, 86, 'Passed', 4, 10),
(43, 100, 'Passed', 6, 36);

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE `rate` (
  `id` int(50) NOT NULL,
  `rate` int(5) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `caseid` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`id`, `rate`, `comment`, `caseid`) VALUES
(8, 2, 'With Mrs. Angy Akiki , everything is Possible. Thank you for your Support.', 48);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id` int(50) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `caseid` int(50) NOT NULL,
  `addressid` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id`, `date`, `time`, `details`, `caseid`, `addressid`) VALUES
(3, '2025-05-22', '01:02', 'Please bring your case documents.', 37, 15),
(4, '2025-05-20', '01:02', 'Please bring your case documents.', 38, 16),
(5, '2025-07-08', '09:45', 'Please bring all your documents.', 39, 17),
(7, '2025-09-15', '12:30', 'Please bring your case documents. with the judge: Elie Kfoury', 39, 19),
(9, '2025-05-01', '09:45', 'Please bring your ID.', 38, 21),
(10, '2025-05-28', '03:30', 'please bring all your documents with you.', 48, 23),
(11, '2025-05-27', '03:30', 'please bring all your documents with you.', 38, 24),
(15, '2025-05-26', '10:30', 'Please Bring All your documents with you', 38, 28),
(19, '2025-06-12', '17:00', 'Please Bring All your documents with you', 47, 36),
(21, '2025-04-30', '03:00', 'please bring all ur documents', 54, 38);

-- --------------------------------------------------------

--
-- Table structure for table `techskills`
--

CREATE TABLE `techskills` (
  `id` int(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `p/e/w` varchar(255) NOT NULL,
  `cvid` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `techskills`
--

INSERT INTO `techskills` (`id`, `description`, `p/e/w`, `cvid`) VALUES
(1, 'Exel / Power Point', 'Bad', 3),
(2, 'Yes, AI', 'excellent', 4),
(5, 'yes,AI', 'excellent', 11),
(17, 'NOOO', 'Exellent', 12),
(28, 'No', 'excellent', 14),
(29, 'No', 'excellent', 14),
(30, 'no', 'excellent', 14),
(31, 'No', 'excellent', 16),
(32, 'yess', 'excellent', 17);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(50) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phonenum` int(9) NOT NULL,
  `image` varchar(255) NOT NULL,
  `role` int(1) NOT NULL,
  `status` enum('Unverified','Unrestricted','Restricted','') NOT NULL DEFAULT 'Unverified'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fname`, `lname`, `email`, `password`, `address`, `phonenum`, `image`, `role`, `status`) VALUES
(7, 'Elie', 'Azar', 'elie@gmail.com', '$2y$10$aRoBKjtUM8Byxf.JEvA/LenvcfDg6NYRS8q8Ohf7f6b.VICWq9J5O', 'Lebanon,Miniara', 8181818, './img/att3.jpg', 2, 'Unrestricted'),
(8, 'wassim', 'Al Nabbout', 'wassim@gmail.com', '$2y$10$69TyB0WLPIuqSmIPc2kn3.4PVOLOd/BoIXJlecLMC3OrRlaPnuuca', 'Lebanon,Miniara', 303030, 'img/att9.jpg', 2, 'Unrestricted'),
(9, 'Nicolas', 'Kfoury', 'nicolas@gmail.com', '$2y$10$qVQB2SkFHPgwanSIXlF7SeWj.THGE4LBpkMhPUtjvAim6LItbClvy', 'Lebanon,Khenchara', 81112233, '0', 1, 'Unrestricted'),
(10, 'Beatrice', 'Karam', 'beatrice@gmail.com', '$2y$10$jvwSvp5Eq0jnGSJmOg.5fexCBXc4BHB4v3C9HpRdf7/5sCEEzDpEq', 'Lebanon,Kobayat', 1221212, 'img/att5.jpg', 2, 'Unrestricted'),
(11, 'Angy', 'Akiki', 'angy@gmail.com', '$2y$10$E1JgxWn9htFfyJ.4n7s7QOC8/FNeGrkQQ5hjqk3VgaOjpIKI3PSHa', 'Jebrayel,Akkar', 656565, 'img/att4.jpg', 2, 'Unrestricted'),
(12, 'Celine', 'Sarraf', 'celine@gmail.com', '$2y$10$0zTCv37AHvhZ96OJYP3TZuGWbeCfv3wfpm1SyCCilned0W/K4pfGG', 'Miniara,Akkar', 8181818, '0', 0, 'Unrestricted'),
(17, 'Luciana', 'Ghosn', 'lucianaghosn.lg@gmail.com', '$2y$10$zK12N8aOBEjkvNSidQPT5uOq1Fnndz3NMGSQPzyuUsTn2iK6RQk5W', 'Andakit', 32323232, '0', 0, 'Unrestricted'),
(18, 'Wajd', 'Awad', 'wajd@gmail.com', '$2y$10$QjXP.HI/Vq07LDsnaDz/Oe5y5/MSGcfC7hlxkoJkS6GIrzpwqTaiK', 'Miniara,Akkar', 676767, '0', 3, 'Unrestricted'),
(19, 'Ritta', 'Sarraf', 'ritta@gmail.com', '$2y$10$5z7COI/ZI2dr5j1cM/oXg.Ccd/uta9lHl6TEjeuNQRkHwKa1BWF5G', 'Cheikh-Taba,Akkar', 60606, 'img/att10.jpg', 2, 'Unrestricted'),
(28, 'Rouia', 'Ayoub', 'rouia@gmail.com', '$2y$10$FIv71N1uIiadS0YD1xmct.VFfWXBGBAjTg7IGy9Bsh8K9uGGRhfv2', 'Tekrit', 4242424, '0', 4, 'Unrestricted'),
(33, 'Jenny', 'Derbaly', 'derbalyjenny23@gmail.com', '$2y$10$3haaKYWt/50mOhCLOs/1Ke9BzT6eMC5a1ylfqY.ZAR7ZNmX8Hl0Iu', 'Halba', 71941481, './img/att5.jpg', 0, 'Unrestricted'),
(36, 'Reine', 'Nassour', 'reinenassour341@gmail.com', '$2y$10$A2NKdMyeiAQVM43AD74rB.6eXdw7wck1J6tjcp2qgqbI/FW5FCKza', 'Miniara,Akkar', 8181818, './img/attchief.jpg', 2, 'Unrestricted');

-- --------------------------------------------------------

--
-- Table structure for table `verification_code`
--

CREATE TABLE `verification_code` (
  `ID` int(11) NOT NULL,
  `Code` int(11) DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verification_code`
--

INSERT INTO `verification_code` (`ID`, `Code`, `expires_at`, `user_id`) VALUES
(15, 250355, '2025-05-30 11:50:00', 36);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questid` (`questid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `attcontract`
--
ALTER TABLE `attcontract`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attid` (`attid`);

--
-- Indexes for table `attorneys`
--
ALTER TABLE `attorneys`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `case`
--
ALTER TABLE `case`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `categoryid` (`categoryid`),
  ADD KEY `attid` (`attid`);

--
-- Indexes for table `casewon`
--
ALTER TABLE `casewon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cvid` (`cvid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ccontract`
--
ALTER TABLE `ccontract`
  ADD PRIMARY KEY (`id`),
  ADD KEY `caseid` (`caseid`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `attid` (`attid`),
  ADD KEY `caseid` (`caseid`);

--
-- Indexes for table `cv`
--
ALTER TABLE `cv`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attid` (`attid`),
  ADD KEY `caseid` (`caseid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cvid` (`cvid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessionid` (`sessionid`);

--
-- Indexes for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `judge`
--
ALTER TABLE `judge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cvid` (`cvid`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `caseid` (`caseid`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ccontractid` (`ccontractid`);

--
-- Indexes for table `practicearea`
--
ALTER TABLE `practicearea`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quizid` (`quizid`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quizresult`
--
ALTER TABLE `quizresult`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quizid` (`quizid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `caseid` (`caseid`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `caseid` (`caseid`),
  ADD KEY `addressid` (`addressid`);

--
-- Indexes for table `techskills`
--
ALTER TABLE `techskills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cvid` (`cvid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verification_code`
--
ALTER TABLE `verification_code`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `attcontract`
--
ALTER TABLE `attcontract`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `case`
--
ALTER TABLE `case`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `casewon`
--
ALTER TABLE `casewon`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ccontract`
--
ALTER TABLE `ccontract`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `cv`
--
ALTER TABLE `cv`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `experience`
--
ALTER TABLE `experience`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `judge`
--
ALTER TABLE `judge`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `practicearea`
--
ALTER TABLE `practicearea`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quizresult`
--
ALTER TABLE `quizresult`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `rate`
--
ALTER TABLE `rate`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `techskills`
--
ALTER TABLE `techskills`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `verification_code`
--
ALTER TABLE `verification_code`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`questid`) REFERENCES `question` (`id`),
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`id`);

--
-- Constraints for table `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `application_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`id`);

--
-- Constraints for table `attcontract`
--
ALTER TABLE `attcontract`
  ADD CONSTRAINT `attcontract_ibfk_1` FOREIGN KEY (`attid`) REFERENCES `attorneys` (`userid`);

--
-- Constraints for table `attorneys`
--
ALTER TABLE `attorneys`
  ADD CONSTRAINT `attorneys_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`);

--
-- Constraints for table `case`
--
ALTER TABLE `case`
  ADD CONSTRAINT `case_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `case_ibfk_2` FOREIGN KEY (`categoryid`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `case_ibfk_3` FOREIGN KEY (`attid`) REFERENCES `attorneys` (`userid`);

--
-- Constraints for table `casewon`
--
ALTER TABLE `casewon`
  ADD CONSTRAINT `casewon_ibfk_1` FOREIGN KEY (`cvid`) REFERENCES `cv` (`id`);

--
-- Constraints for table `ccontract`
--
ALTER TABLE `ccontract`
  ADD CONSTRAINT `ccontract_ibfk_1` FOREIGN KEY (`caseid`) REFERENCES `case` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `chats_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `chats_ibfk_2` FOREIGN KEY (`attid`) REFERENCES `attorneys` (`userid`),
  ADD CONSTRAINT `chats_ibfk_3` FOREIGN KEY (`caseid`) REFERENCES `case` (`id`);

--
-- Constraints for table `cv`
--
ALTER TABLE `cv`
  ADD CONSTRAINT `cv_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`);

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`attid`) REFERENCES `attorneys` (`userid`),
  ADD CONSTRAINT `documents_ibfk_2` FOREIGN KEY (`caseid`) REFERENCES `case` (`id`),
  ADD CONSTRAINT `documents_ibfk_3` FOREIGN KEY (`userid`) REFERENCES `user` (`id`);

--
-- Constraints for table `experience`
--
ALTER TABLE `experience`
  ADD CONSTRAINT `experience_ibfk_1` FOREIGN KEY (`cvid`) REFERENCES `cv` (`id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`sessionid`) REFERENCES `session` (`id`);

--
-- Constraints for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD CONSTRAINT `inquiry_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`);

--
-- Constraints for table `language`
--
ALTER TABLE `language`
  ADD CONSTRAINT `language_ibfk_1` FOREIGN KEY (`cvid`) REFERENCES `cv` (`id`);

--
-- Constraints for table `meetings`
--
ALTER TABLE `meetings`
  ADD CONSTRAINT `meetings_ibfk_1` FOREIGN KEY (`caseid`) REFERENCES `case` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`ccontractid`) REFERENCES `ccontract` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`quizid`) REFERENCES `quiz` (`id`);

--
-- Constraints for table `quizresult`
--
ALTER TABLE `quizresult`
  ADD CONSTRAINT `quizresult_ibfk_2` FOREIGN KEY (`quizid`) REFERENCES `quiz` (`id`),
  ADD CONSTRAINT `quizresult_ibfk_3` FOREIGN KEY (`userid`) REFERENCES `user` (`id`);

--
-- Constraints for table `rate`
--
ALTER TABLE `rate`
  ADD CONSTRAINT `rate_ibfk_1` FOREIGN KEY (`caseid`) REFERENCES `case` (`id`);

--
-- Constraints for table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`caseid`) REFERENCES `case` (`id`),
  ADD CONSTRAINT `session_ibfk_2` FOREIGN KEY (`addressid`) REFERENCES `address` (`id`);

--
-- Constraints for table `techskills`
--
ALTER TABLE `techskills`
  ADD CONSTRAINT `techskills_ibfk_1` FOREIGN KEY (`cvid`) REFERENCES `cv` (`id`);

--
-- Constraints for table `verification_code`
--
ALTER TABLE `verification_code`
  ADD CONSTRAINT `verification_code_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
