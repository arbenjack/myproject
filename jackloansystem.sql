-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 22, 2018 at 11:04 PM
-- Server version: 5.7.23-0ubuntu0.16.04.1
-- PHP Version: 7.2.8-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jackloansystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `checklist`
--

CREATE TABLE `checklist` (
  `checklist_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `colateral` int(11) NOT NULL DEFAULT '0',
  `seminar` int(11) NOT NULL DEFAULT '0',
  `ci` int(11) NOT NULL DEFAULT '0',
  `co_maker` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checklist`
--

INSERT INTO `checklist` (`checklist_id`, `client_id`, `colateral`, `seminar`, `ci`, `co_maker`) VALUES
(1, 11, 1, 1, 0, 1),
(2, 1, 1, 1, 1, 1),
(3, 7, 1, 1, 1, 1),
(4, 2, 0, 0, 1, 1),
(5, 13, 0, 0, 0, 0),
(6, 5, 0, 0, 0, 0),
(7, 8, 0, 0, 0, 0),
(8, 9, 1, 1, 0, 0),
(9, 6, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `ClientID` bigint(20) NOT NULL,
  `GroupCode` bigint(20) DEFAULT '0',
  `ClientCode` bigint(20) DEFAULT '0',
  `Since` datetime DEFAULT NULL,
  `SinceGroup` datetime DEFAULT NULL,
  `ClientStatus` int(11) DEFAULT '1',
  `FirstName` varchar(250) NOT NULL,
  `MiddleName` varchar(250) NOT NULL,
  `LastName` varchar(250) NOT NULL,
  `MaidenName` longtext,
  `BirthDate` datetime NOT NULL,
  `Gender` enum('M','F') DEFAULT 'M',
  `MaritalStatus` varchar(10) DEFAULT '0',
  `Citizenship` int(11) DEFAULT '0',
  `HomeAddress1` longtext,
  `HomeAddress2` longtext,
  `HomeAddressContact` longtext,
  `HomeAddressSince` datetime DEFAULT NULL,
  `cummulativeLoanNumber` int(11) DEFAULT '0',
  `cummulativeLoanAmount` decimal(19,4) DEFAULT '0.0000',
  `PrecintNo` bigint(20) DEFAULT NULL,
  `c1` int(11) DEFAULT '0',
  `c2` int(11) DEFAULT '0',
  `c3` int(11) DEFAULT '0',
  `c4` int(11) DEFAULT '0',
  `r1` longtext,
  `r2` longtext,
  `r3` int(11) DEFAULT NULL,
  `ModifyBy` int(11) DEFAULT '0',
  `ModifyDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifyStamp` binary(8) DEFAULT NULL,
  `r4` longtext,
  `r5` longtext,
  `r6` longtext,
  `c5` int(11) DEFAULT '0',
  `c6` int(11) DEFAULT '0',
  `c7` int(11) DEFAULT '0',
  `PhotoPath` longtext,
  `SignPath` longtext,
  `TinNo` longtext,
  `NickName` longtext,
  `House` int(11) DEFAULT NULL,
  `Education` int(11) DEFAULT NULL,
  `Religion` int(11) DEFAULT NULL,
  `YearsStayed` int(3) DEFAULT NULL,
  `PlaceOfBirth` longtext,
  `DateEstablished` datetime DEFAULT NULL,
  `YearExperience` bigint(20) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`ClientID`, `GroupCode`, `ClientCode`, `Since`, `SinceGroup`, `ClientStatus`, `FirstName`, `MiddleName`, `LastName`, `MaidenName`, `BirthDate`, `Gender`, `MaritalStatus`, `Citizenship`, `HomeAddress1`, `HomeAddress2`, `HomeAddressContact`, `HomeAddressSince`, `cummulativeLoanNumber`, `cummulativeLoanAmount`, `PrecintNo`, `c1`, `c2`, `c3`, `c4`, `r1`, `r2`, `r3`, `ModifyBy`, `ModifyDate`, `ModifyStamp`, `r4`, `r5`, `r6`, `c5`, `c6`, `c7`, `PhotoPath`, `SignPath`, `TinNo`, `NickName`, `House`, `Education`, `Religion`, `YearsStayed`, `PlaceOfBirth`, `DateEstablished`, `YearExperience`, `deleted_at`) VALUES
(1, 1001001001, 4, NULL, NULL, 1, 'KAREN', 'LATE', 'DIAZ', 'X', '1982-12-17 00:00:00', 'F', 'single', 0, 'BRGY. JALANDONI, JARO, ILOILO CITY', NULL, '0919665656656', NULL, 0, '0.0000', NULL, 0, 0, 0, 0, NULL, NULL, NULL, 0, '2017-12-17 13:26:40', NULL, NULL, NULL, NULL, 0, 0, 0, 'uploads/Fs2RSfY3eA5YiYyu8D4xaQ2geJHZ9BsByip530rH.png', NULL, NULL, NULL, NULL, 0, 0, 1982, NULL, NULL, NULL, NULL),
(2, 1001001001, 2, NULL, NULL, 1, 'KEN', 'YEN', 'PADILLA', 'Y', '1983-12-17 00:00:00', 'M', 'single', 0, 'LAPAZ', NULL, '091646457898', NULL, 0, '0.0000', NULL, 0, 0, 0, 0, NULL, NULL, NULL, 0, '2017-12-17 13:49:57', NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1964, 'ILOILO', NULL, NULL, NULL),
(3, 1001001001, 3, NULL, NULL, 1, 'PIOLO', 'GARCIA', 'PASCUAL', 'G', '1961-04-21 00:00:00', 'M', NULL, 0, 'BACOLOD', NULL, '09168472213231', NULL, 0, '0.0000', NULL, 0, 0, 0, 0, NULL, NULL, NULL, 0, '2017-12-17 13:51:52', NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1950, 'AKLAN', NULL, NULL, NULL),
(4, 1001001001, 2154100, NULL, NULL, 1, 'CHARRY MAE', 'ANTAS', 'RODRIGUEZ', 'RODRIGUEZ', '1988-02-13 00:00:00', 'F', 'single', 0, 'Zone 3 Tacas Jaro Iloilo City', NULL, '+639205541121', NULL, 0, '0.0000', NULL, 0, 0, 0, 0, NULL, NULL, NULL, 0, '2018-02-13 03:14:12', NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, NULL, NULL, NULL, NULL),
(5, 1001001001, 231231, NULL, NULL, 1, 'Mark', 'Rael', 'Dingdong', NULL, '1977-06-07 00:00:00', 'M', 'single', 0, 'BACOLOD City', NULL, '12323123', NULL, 0, '0.0000', NULL, 0, 0, 0, 0, NULL, NULL, NULL, 0, '2018-06-07 02:27:10', NULL, NULL, NULL, NULL, 0, 0, 0, 'uploads/eyJpdiI6IkJtSEVBcTBHNHpJcW1FMnFcL2h6TlwvZz09Iiwidm.png', 'uploads/5BprslIlxpbC7FPE4mskLakx6K8SWuUlqLtYLwYy.png', NULL, NULL, NULL, 0, 0, 7, 'asd', NULL, NULL, NULL),
(6, 1001001001, 0, NULL, NULL, 1, 'JOHN', 'X', 'SMITH', 'X', '1980-05-07 00:00:00', 'M', 'single', 0, 'BACOLOD CITY', 'BACOLOD CITY', '034 432323232111', NULL, 0, '0.0000', NULL, 0, 0, 0, 0, NULL, NULL, NULL, 0, '2018-06-07 07:05:22', NULL, NULL, NULL, NULL, 0, 0, 0, 'uploads/eyJpdiI6ImpsVGFUbDhDMTkxODV1S1wvXC9JakVqZz09Iiwidm.png', NULL, NULL, NULL, NULL, NULL, NULL, 1, 'TALISAY S', NULL, NULL, NULL),
(7, 1001001001, 23444, NULL, NULL, 1, 'BOYCE', 'S', 'AVENUE', 'A', '1984-05-07 00:00:00', 'M', 'married', 0, 'BACOLOD CITY', 'BACOLOD CITY', '1111122223334445556677788899', NULL, 0, '0.0000', NULL, 0, 0, 0, 0, NULL, NULL, NULL, 0, '2018-06-07 11:03:30', NULL, NULL, '1231', NULL, 0, 0, 0, 'uploads/w96INN4NERKzZYQxnpSBdUfgmuhoVNaSBixppKOl.jpeg', NULL, NULL, NULL, NULL, 0, 0, 20, 'TALISAY', NULL, NULL, NULL),
(8, 1001001001, 12162, NULL, NULL, 1, 'JUSTIN', 'CARROT', 'LUMBOK', NULL, '1977-06-14 00:00:00', 'M', 'single', 0, 'Address 123', NULL, '123123', NULL, 0, '0.0000', NULL, 0, 0, 0, 0, NULL, NULL, NULL, 0, '2018-06-14 05:36:53', NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Barilas Camotes Island, Illigan City', NULL, NULL, NULL),
(9, 1001001001, 9313576, NULL, NULL, 1, 'JOHN', 'X', 'SMITH', NULL, '1984-06-02 00:00:00', 'M', 'married', 0, '32432 BRGY. Tuburan Sulbod, ZARRAGA, ILOILO', ' BRGY. , , ', NULL, NULL, 0, '0.0000', NULL, 0, 0, 0, 0, NULL, NULL, NULL, 0, '2018-07-02 04:17:42', NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, 'ASDSADASD', NULL, NULL, NULL),
(13, 0, 0, NULL, NULL, 1, 'qweqwe', 'qwewqewqe', 'wqewqe', NULL, '0000-00-00 00:00:00', '', '0', 0, '9193562183', NULL, 'ubayqwewqe qwewe ', NULL, 0, '0.0000', NULL, 0, 0, 0, 0, NULL, NULL, NULL, 0, '2018-08-18 09:03:15', NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Triggers `client`
--
DELIMITER $$
CREATE TRIGGER `insert_into_bankaccounts` AFTER INSERT ON `client` FOR EACH ROW BEGIN

	

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `loan_account`
--

CREATE TABLE `loan_account` (
  `loan_accountID` bigint(44) NOT NULL,
  `loanTypeID` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `loanAmount` decimal(19,6) NOT NULL,
  `termNumber` int(11) NOT NULL DEFAULT '0',
  `isPaid` int(1) NOT NULL DEFAULT '0',
  `intRate` decimal(19,4) NOT NULL DEFAULT '0.0000',
  `loanStatus` enum('pending','applied','disapproved','approve','canceled','outstanding','write_off','fully_paid') NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isRelease` int(1) NOT NULL DEFAULT '0',
  `dateRelease` datetime DEFAULT NULL,
  `date_cutoff` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_account`
--

INSERT INTO `loan_account` (`loan_accountID`, `loanTypeID`, `client_id`, `loanAmount`, `termNumber`, `isPaid`, `intRate`, `loanStatus`, `dateCreated`, `isRelease`, `dateRelease`, `date_cutoff`) VALUES
(1, 1, 1, '232323.000000', 0, 0, '3.7500', 'applied', '2018-08-22 03:21:44', 0, NULL, NULL),
(2, 2, 7, '10000.000000', 0, 0, '7.5000', 'applied', '2018-08-22 22:15:19', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `loan_payment`
--

CREATE TABLE `loan_payment` (
  `loan_paymentID` bigint(44) NOT NULL,
  `client_id` int(11) NOT NULL,
  `loanTypeID` int(11) NOT NULL,
  `amount` decimal(19,6) NOT NULL,
  `dateTransaction` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loan_product`
--

CREATE TABLE `loan_product` (
  `loan_productID` int(11) NOT NULL,
  `loanProduct_name` varchar(255) NOT NULL,
  `intM_Rate` decimal(19,4) NOT NULL,
  `loanM_Amount` decimal(19,6) NOT NULL,
  `DateRelease` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_product`
--

INSERT INTO `loan_product` (`loan_productID`, `loanProduct_name`, `intM_Rate`, `loanM_Amount`, `DateRelease`) VALUES
(1, 'loan 1', '5.0000', '10000.000000', NULL),
(2, 'loan 2', '4.0000', '20000.000000', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(12) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `usertype_id` int(12) NOT NULL,
  `citizen_id` int(12) NOT NULL,
  `session_id` int(12) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `position`, `usertype_id`, `citizen_id`, `session_id`, `date_created`, `is_deleted`) VALUES
(1, 'qweqwe', 'efe6398127928f1b2e9ef3207fb82663', 'Encoder', 2, 0, 1, '2018-07-03 03:00:31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `usertypes`
--

CREATE TABLE `usertypes` (
  `usertype_id` int(12) NOT NULL,
  `usertype_name` varchar(255) NOT NULL,
  `usertype_slug` varchar(255) NOT NULL,
  `is_deleted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checklist`
--
ALTER TABLE `checklist`
  ADD PRIMARY KEY (`checklist_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`ClientID`);

--
-- Indexes for table `loan_account`
--
ALTER TABLE `loan_account`
  ADD PRIMARY KEY (`loan_accountID`);

--
-- Indexes for table `loan_payment`
--
ALTER TABLE `loan_payment`
  ADD PRIMARY KEY (`loan_paymentID`);

--
-- Indexes for table `loan_product`
--
ALTER TABLE `loan_product`
  ADD PRIMARY KEY (`loan_productID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `usertypes`
--
ALTER TABLE `usertypes`
  ADD PRIMARY KEY (`usertype_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checklist`
--
ALTER TABLE `checklist`
  MODIFY `checklist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `ClientID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `loan_account`
--
ALTER TABLE `loan_account`
  MODIFY `loan_accountID` bigint(44) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `loan_payment`
--
ALTER TABLE `loan_payment`
  MODIFY `loan_paymentID` bigint(44) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `loan_product`
--
ALTER TABLE `loan_product`
  MODIFY `loan_productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `usertypes`
--
ALTER TABLE `usertypes`
  MODIFY `usertype_id` int(12) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
