-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 01, 2012 at 09:32 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `inventory_sw`
--

-- --------------------------------------------------------

--
-- Table structure for table `expenditure`
--

CREATE TABLE IF NOT EXISTS `expenditure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `order_num` int(11) NOT NULL,
  `invoice_num` int(11) NOT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `operator` varchar(300) NOT NULL,
  `category` varchar(300) NOT NULL,
  `reason` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `expenditure`
--

INSERT INTO `expenditure` (`id`, `date`, `order_num`, `invoice_num`, `amount`, `operator`, `category`, `reason`) VALUES
(1, '2012-04-26', 3, 1, 10000000, 'x', 'category', 'reason'),
(2, '0000-00-00', 4, 2, 0, 'x', 'category', 'reason'),
(3, '0000-00-00', 5, 3, 0, 'x', 'category', 'reason'),
(4, '2012-04-28', 3, 8, 500000, 'Mr.X', 'deposit', 'product sale'),
(5, '2012-04-28', 3, 8, 500000, 'Mr.Y', 'deposit', 'product sale'),
(6, '2012-04-30', 6, 6, 500000, 'x', 'category', 'reason');

-- --------------------------------------------------------

--
-- Table structure for table `finished_product`
--

CREATE TABLE IF NOT EXISTS `finished_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(300) NOT NULL,
  `current_stock` int(11) NOT NULL DEFAULT '0',
  `rate` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `finished_product`
--

INSERT INTO `finished_product` (`id`, `category_id`, `product_name`, `current_stock`, `rate`) VALUES
(4, 8, 'star1', 10, 80),
(5, 8, 'star2', 80, 70),
(6, 9, 'star1', 120, 50),
(8, 9, 'star2', 150, 60),
(9, 9, 'grower', 0, 50);

-- --------------------------------------------------------

--
-- Table structure for table `finished_product_category`
--

CREATE TABLE IF NOT EXISTS `finished_product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `category_name` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `finished_product_category`
--

INSERT INTO `finished_product_category` (`id`, `parent_id`, `category_name`) VALUES
(1, 0, 'Fish Feed'),
(2, 0, 'Poultry feed'),
(8, 2, 'Broiler'),
(9, 1, 'Telapia');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` int(11) NOT NULL,
  `reason` varchar(300) NOT NULL,
  `order_num` int(11) NOT NULL,
  `date` date NOT NULL,
  `operator` varchar(300) NOT NULL,
  `amount` double NOT NULL,
  `payby` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `invoice_no`, `reason`, `order_num`, `date`, `operator`, `amount`, `payby`) VALUES
(1, 14140, '', 14140, '0000-00-00', 'default', 12000, 'cash'),
(3, 14140, '', 14140, '0000-00-00', 'default', 15000, 'check'),
(4, 14140, '', 14140, '2012-04-20', 'default', 12000, 'cash'),
(6, 6, 'product sale', 102, '2012-04-24', 'operator', 15000, 'cash'),
(7, 7, 'product sale', 102, '2012-04-24', 'Mr.X', 12000, 'check');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE IF NOT EXISTS `purchase` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `provider_name` varchar(300) NOT NULL,
  `provider_address` text NOT NULL,
  `contact_number` varchar(300) NOT NULL,
  `zone` varchar(300) NOT NULL,
  `item_id` int(11) NOT NULL,
  `challan_no` varchar(300) NOT NULL,
  `truck_no` varchar(300) NOT NULL,
  `num_bags` int(11) NOT NULL DEFAULT '0',
  `sending_weight` int(11) NOT NULL DEFAULT '0',
  `gross_weight` int(11) NOT NULL DEFAULT '0',
  `only_truck_weight` int(11) NOT NULL DEFAULT '0',
  `rm_weight` int(11) NOT NULL DEFAULT '0',
  `bag_weight` int(11) NOT NULL DEFAULT '0',
  `net_weight` int(11) NOT NULL DEFAULT '0',
  `truck_fee` int(11) NOT NULL DEFAULT '0',
  `total_payment` bigint(20) NOT NULL DEFAULT '0',
  `unpaid` double NOT NULL,
  `upcoming_payment_date` date NOT NULL DEFAULT '0000-00-00',
  `comments` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id`, `date`, `provider_name`, `provider_address`, `contact_number`, `zone`, `item_id`, `challan_no`, `truck_no`, `num_bags`, `sending_weight`, `gross_weight`, `only_truck_weight`, `rm_weight`, `bag_weight`, `net_weight`, `truck_fee`, `total_payment`, `unpaid`, `upcoming_payment_date`, `comments`) VALUES
(1, '0000-00-00', 'joyes', '', '01717583866', 'khulna', 1, '78574', 'td65444', 500, 5000, 5000, 0, 0, 0, 0, 0, 0, 2000, '2012-03-08', ''),
(2, '0000-00-00', 'sec', 'sylhget', '01916260259', 'Dhaka', 2, '1257', 'hh76755', 1255, 58, 65, 55, 641, 2, 2, 2, 2, 0, '2012-03-09', ''),
(3, '2012-04-26', 'kkr', '', '241564654', 'khulna', 3, '52151', 'k-354154', 50, 2500, 2500, 5000, 2500, 500, 5100, 10000, 20000000, 500000, '2012-04-30', ''),
(5, '0000-00-00', '', '', '', '', 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 5000, '2012-05-09', ''),
(6, '2012-04-30', 'kpojipj', '', '241564654', 'Sylhet', 3, '52151', 'k-354154', 50, 2500, 2500, 5000, 2500, 500, 5100, 10000, 20000000, 3000, '0000-00-00', 'jhvuvfguyvu');

-- --------------------------------------------------------

--
-- Table structure for table `realeased_finished_product_info`
--

CREATE TABLE IF NOT EXISTS `realeased_finished_product_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `released_amount` int(11) NOT NULL DEFAULT '0',
  `released_date` date NOT NULL DEFAULT '0000-00-00',
  `operator` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `realeased_finished_product_info`
--

INSERT INTO `realeased_finished_product_info` (`id`, `item_id`, `released_amount`, `released_date`, `operator`) VALUES
(5, 4, 100, '2012-04-17', 'Mr.X'),
(6, 5, 200, '2012-04-17', 'Mr.X'),
(7, 6, 120, '2012-04-17', 'Mr.Y'),
(8, 8, 150, '2012-04-17', 'Mr.Y');

-- --------------------------------------------------------

--
-- Table structure for table `released_row_material_info`
--

CREATE TABLE IF NOT EXISTS `released_row_material_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `released_row_material_info`
--

INSERT INTO `released_row_material_info` (`id`, `item_id`, `amount`, `date`) VALUES
(1, 1, 150, '2012-03-11'),
(2, 1, 100, '0000-00-00'),
(4, 1, 400, '2012-03-12'),
(5, 2, 150, '2012-03-13'),
(7, 2, 210, '2012-03-13'),
(8, 1, 100, '2012-03-13'),
(9, 1, 100, '2012-03-13'),
(10, 1, 100, '2012-03-13'),
(11, 2, 50, '2012-03-13'),
(12, 1, 55, '2012-03-14');

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE IF NOT EXISTS `sale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `order_no` int(11) NOT NULL,
  `do_no` varchar(300) NOT NULL,
  `pending_amount` double NOT NULL,
  `next_payment_date` date NOT NULL,
  `item_cost` double NOT NULL DEFAULT '0',
  `transport_cost` double NOT NULL DEFAULT '0',
  `tt_cost` double NOT NULL DEFAULT '0',
  `total_bag` double NOT NULL DEFAULT '0',
  `payble_amount` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`id`, `date`, `order_no`, `do_no`, `pending_amount`, `next_payment_date`, `item_cost`, `transport_cost`, `tt_cost`, `total_bag`, `payble_amount`) VALUES
(1, '0000-00-00', 0, '0014140', 3000, '0000-00-00', 6, 1234, 0, 6, 0),
(2, '0000-00-00', 0, '0014140', 0, '0000-00-00', 0, 0, 0, 0, 0),
(3, '0000-00-00', 5, '0014140', 1000, '2012-04-20', 12, 200, 100, 10, 150000),
(4, '2012-04-20', 0, '0014140', 3000, '2012-04-20', 123, 200, 100, 10, 100000),
(5, '2012-04-20', 0, '0014140', 3000, '2012-05-20', 123, 200, 100, 50, 100000);

-- --------------------------------------------------------

--
-- Table structure for table `sale_details`
--

CREATE TABLE IF NOT EXISTS `sale_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `sale_details`
--

INSERT INTO `sale_details` (`id`, `sale_id`, `product_id`, `amount`) VALUES
(14, 0, 6, 20),
(13, 0, 5, 30),
(12, 0, 4, 20),
(11, 0, 8, 25),
(10, 0, 6, 11),
(15, 0, 8, 11),
(16, 0, 4, 11),
(17, 0, 5, 25),
(18, 0, 4, 11),
(19, 0, 5, 20),
(20, 0, 6, 12),
(21, 0, 8, 13),
(22, 0, 9, 26),
(23, 0, 4, 50),
(24, 0, 5, 70),
(25, 0, 4, 10),
(26, 0, 5, 20),
(27, 0, 4, 25),
(28, 0, 5, 25),
(29, 0, 4, 5),
(30, 0, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE IF NOT EXISTS `seller` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chalan` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `address` text NOT NULL,
  `zone` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`id`, `chalan`, `name`, `address`, `zone`) VALUES
(1, 1234, 'Web Design', 'jbghyftydtrd', '0'),
(2, 1234, 'ftyfty', '6rd6dr7ftugvj', 'khulna'),
(3, 0, '', '', ''),
(4, 56, 'joyes', 'ioi8uft', 'Sylhet'),
(5, 56, 'joyes', 'ioi8uft', 'Sylhet'),
(6, 56, 'E-COMMERCE', 'ftjufguj', 'Sylhet');

-- --------------------------------------------------------

--
-- Table structure for table `stock_raw_material`
--

CREATE TABLE IF NOT EXISTS `stock_raw_material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `row_material_name` varchar(300) NOT NULL,
  `current_stock` int(11) NOT NULL DEFAULT '0',
  `rate` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `row_material_name` (`row_material_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `stock_raw_material`
--

INSERT INTO `stock_raw_material` (`id`, `row_material_name`, `current_stock`, `rate`) VALUES
(1, 'Soyabin', 245, 40),
(2, 'polish A', 250, 50),
(3, 'Maize', 10200, 40);
