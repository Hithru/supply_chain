-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 12, 2021 at 10:44 AM
-- Server version: 8.0.19
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `supply`
--
CREATE DATABASE IF NOT EXISTS `supply` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `supply`;

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city` (
  `city_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `postcode` int NOT NULL,
  PRIMARY KEY (`city_id`),
  UNIQUE KEY `postcode` (`postcode`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `name`, `postcode`) VALUES
(1, 'Kandy', 20000),
(2, 'Colombo', 130),
(3, 'Negombo', 11410),
(4, 'Galle', 80000),
(5, 'Matara', 81000),
(6, 'Trinco', 31000),
(7, 'Jaffna', 40000);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `type` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(100) NOT NULL,
  `tel_no` int NOT NULL,
  `billing_address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `email` (`email`),
  KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_type`
--

DROP TABLE IF EXISTS `customer_type`;
CREATE TABLE IF NOT EXISTS `customer_type` (
  `type` varchar(12) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `order_constraint` int NOT NULL,
  `discount` decimal(4,2) DEFAULT NULL,
  `max_payment` decimal(8,2) DEFAULT NULL,
  PRIMARY KEY (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer_type`
--

INSERT INTO `customer_type` (`type`, `description`, `order_constraint`, `discount`, `max_payment`) VALUES
('consumer', NULL, 5, NULL, '25000.00'),
('retail', NULL, 20, '15.00', '100000.00'),
('wholesale', NULL, 50, '25.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_schedule`
--

DROP TABLE IF EXISTS `delivery_schedule`;
CREATE TABLE IF NOT EXISTS `delivery_schedule` (
  `order_id` int NOT NULL,
  `truck_sched_id` int NOT NULL,
  KEY `order_id` (`order_id`),
  KEY `truck_sched_id` (`truck_sched_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `item_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `train_capacity` int NOT NULL,
  `shelf_life` smallint DEFAULT NULL,
  `stock` int NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `name`, `price`, `train_capacity`, `shelf_life`, `stock`) VALUES
(1, 'Rice 1kg', '100.00', 10, 104, 200),
(2, 'Marie Biscuits', '30.00', 50, 10, 300);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `order_date` date NOT NULL,
  `ship_date` date DEFAULT NULL,
  `route_id` int NOT NULL,
  `status` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `total_bill` decimal(8,2) DEFAULT NULL,
  `shipping_address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `order_id` int NOT NULL,
  `item_id` int NOT NULL,
  `quantity` int NOT NULL,
  `MFD` date DEFAULT NULL,
  KEY `order_id` (`order_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

DROP TABLE IF EXISTS `route`;
CREATE TABLE IF NOT EXISTS `route` (
  `route_id` int NOT NULL,
  `city_id` int NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `max_time_mins` int NOT NULL,
  PRIMARY KEY (`route_id`),
  KEY `city_id` (`city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `staff_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `NIC` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `position` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tel_no` int DEFAULT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `city_id` int DEFAULT NULL,
  PRIMARY KEY (`staff_id`),
  UNIQUE KEY `NIC` (`NIC`),
  KEY `city_id` (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `name`, `NIC`, `position`, `email`, `password`, `tel_no`, `address`, `city_id`) VALUES
(100, 'dilshan', '199767300987', 'admin', 'dilshan@gmail.com', '$2y$10$exTp0iqmaBxsf8PxFhsWJeij0LMo8bAAyJmjjGSkRgGd6QRjLVMgu', 717723234, 'aaaa', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `train`
--

DROP TABLE IF EXISTS `train`;
CREATE TABLE IF NOT EXISTS `train` (
  `train_id` int NOT NULL,
  `city_id` int NOT NULL,
  `weekday` tinyint NOT NULL,
  `capacity` int DEFAULT NULL,
  `fee` decimal(6,2) DEFAULT NULL,
  PRIMARY KEY (`train_id`),
  KEY `city_id` (`city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `train_schedule`
--

DROP TABLE IF EXISTS `train_schedule`;
CREATE TABLE IF NOT EXISTS `train_schedule` (
  `schedule_id` int NOT NULL AUTO_INCREMENT,
  `train_id` int NOT NULL,
  `item_id` int NOT NULL,
  `quantity` int NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`schedule_id`),
  KEY `train_id` (`train_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `truck`
--

DROP TABLE IF EXISTS `truck`;
CREATE TABLE IF NOT EXISTS `truck` (
  `truck_no` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `city_id` int NOT NULL,
  PRIMARY KEY (`truck_no`),
  KEY `city_id` (`city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `truck_schedule`
--

DROP TABLE IF EXISTS `truck_schedule`;
CREATE TABLE IF NOT EXISTS `truck_schedule` (
  `schedule_id` int NOT NULL AUTO_INCREMENT,
  `route_id` int NOT NULL,
  `start_time` datetime NOT NULL,
  `truck_no` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `driver_id` int NOT NULL,
  `assistant_id` int NOT NULL,
  PRIMARY KEY (`schedule_id`),
  KEY `route_id` (`route_id`),
  KEY `truck_no` (`truck_no`),
  KEY `driver_id` (`driver_id`),
  KEY `assistant_id` (`assistant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`type`) REFERENCES `customer_type` (`type`);

--
-- Constraints for table `delivery_schedule`
--
ALTER TABLE `delivery_schedule`
  ADD CONSTRAINT `delivery_schedule_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `delivery_schedule_ibfk_3` FOREIGN KEY (`truck_sched_id`) REFERENCES `truck_schedule` (`schedule_id`) ON DELETE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`),
  ADD CONSTRAINT `order_details_ibfk_3` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`);

--
-- Constraints for table `route`
--
ALTER TABLE `route`
  ADD CONSTRAINT `route_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`) ON DELETE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`) ON DELETE CASCADE;

--
-- Constraints for table `train`
--
ALTER TABLE `train`
  ADD CONSTRAINT `train_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`) ON DELETE CASCADE;

--
-- Constraints for table `train_schedule`
--
ALTER TABLE `train_schedule`
  ADD CONSTRAINT `train_schedule_ibfk_1` FOREIGN KEY (`train_id`) REFERENCES `train` (`train_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `train_schedule_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE;

--
-- Constraints for table `truck`
--
ALTER TABLE `truck`
  ADD CONSTRAINT `truck_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`) ON DELETE CASCADE;

--
-- Constraints for table `truck_schedule`
--
ALTER TABLE `truck_schedule`
  ADD CONSTRAINT `truck_schedule_ibfk_1` FOREIGN KEY (`route_id`) REFERENCES `route` (`route_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `truck_schedule_ibfk_2` FOREIGN KEY (`truck_no`) REFERENCES `truck` (`truck_no`) ON DELETE CASCADE,
  ADD CONSTRAINT `truck_schedule_ibfk_3` FOREIGN KEY (`driver_id`) REFERENCES `staff` (`staff_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `truck_schedule_ibfk_4` FOREIGN KEY (`assistant_id`) REFERENCES `staff` (`staff_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
