-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 01, 2021 at 04:26 AM
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

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `name`, `type`, `email`, `password`, `tel_no`, `billing_address`) VALUES
(100, 'Dilshan', 'consumer', 'dilshan@gmail.com', '$2y$10$x3hZBguHzJw3hZJwovx8I.PrEsIrjNElP11uOmh7Y0eJWkrUWuctG', 717723235, '12, Abrew Way, Colombo');

--
-- Dumping data for table `customer_type`
--

INSERT INTO `customer_type` (`type`, `description`, `order_constraint`, `discount`, `max_payment`) VALUES
('consumer', NULL, 5, NULL, '25000.00'),
('retail', NULL, 20, '15.00', '100000.00'),
('wholesale', NULL, 50, '25.00', NULL);

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `name`, `price`, `train_capacity`, `shelf_life`, `stock`) VALUES
(1, 'Rice 1kg', '100.00', 10, 104, 200),
(2, 'Marie Biscuits', '30.00', 50, 10, 300);

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `order_date`, `ship_date`, `route_id`, `status`, `total_bill`, `shipping_address`) VALUES
(1, 100, '2021-02-01', NULL, 1, 'pending', '700.00', NULL);

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `item_id`, `quantity`, `MFD`) VALUES
(1, 2, 30, '2021-02-14');

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`route_id`, `city_id`, `description`, `max_time_mins`) VALUES
(1, 2, 'HighLevel Rd - Baseline - Bauddhaolka Mw - Duplication - Galle rd', 90),
(2, 2, 'Kynsey road - Ward Place - Alexandria Place - Horton Place', 30),
(3, 1, 'Kegalle Rd - Roundabout - Main Street', 60),
(4, 7, 'Road A - Road B - Road C', 35),
(5, 4, 'Galle Road - Road X - Road Y - Road Z', 45),
(6, 5, 'Road A - Street B - Cc Mawatha - Road Dd', 55),
(7, 3, 'Wijerathna Mw - Navam Road - Main Road', 80),
(8, 6, 'Road A - Road B - Qwerty Mw - CD Avenue', 30),
(9, 1, 'Road A - Hill Street - Matale Road up to Roundabout', 60);

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `name`, `NIC`, `position`, `email`, `password`, `tel_no`, `address`, `city_id`) VALUES
(101, 'dilshan', '199767300987', 'admin', 'dilshan@gmail.com', '$2y$10$exTp0iqmaBxsf8PxFhsWJeij0LMo8bAAyJmjjGSkRgGd6QRjLVMgu', 717723234, 'aaaa', NULL),
(102, 'ravindu perera', '199867300780', 'driver', NULL, '$2y$10$om27yCLgPt2sZMaeVc482OCXAV7ulCDBFoiFSnZ.n69dq8ajFNb.u', NULL, NULL, 2),
(103, 'kumara de silva', '198968903214', 'assistant', NULL, '$2y$10$Q7NzZUXDYR9mLNopplsfgOXPV70p6N7gJYBXcKnNdnLN5BW.DDvdC', NULL, NULL, 2);

--
-- Dumping data for table `truck`
--

INSERT INTO `truck` (`truck_no`, `city_id`) VALUES
('AB1234', 2);

--
-- Dumping data for table `truck_schedule`
--

INSERT INTO `truck_schedule` (`schedule_id`, `route_id`, `start_time`, `truck_no`, `driver_id`, `assistant_id`) VALUES
(1, 1, '2021-02-05 00:00:00', 'AB1234', 102, 103);

-- --------------------------------------------------------

--
-- Structure for view `cityroutes`
--
DROP TABLE IF EXISTS `cityroutes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cityroutes`  AS  select `city`.`name` AS `name`,`route`.`route_id` AS `route_id` from (`city` left join `route` on((`city`.`city_id` = `route`.`city_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `topitems`
--
DROP TABLE IF EXISTS `topitems`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `topitems`  AS  select `item`.`item_id` AS `item_id`,`item`.`name` AS `name`,sum(`order_details`.`quantity`) AS `sum(quantity)`,count(`order_details`.`order_id`) AS `count(order_id)` from ((`item` join `order_details` on((`item`.`item_id` = `order_details`.`item_id`))) join `orders` on((`order_details`.`order_id` = `orders`.`order_id`))) group by `item`.`item_id` order by sum(`order_details`.`quantity`) limit 5 ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
