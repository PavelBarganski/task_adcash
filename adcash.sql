-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 
-- Версия на сървъра: 5.5.39
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `adcash`
--

-- --------------------------------------------------------

--
-- Структура на таблица `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` float NOT NULL,
  `total` float NOT NULL,
  `date_entered` date NOT NULL,
  `date_modified` date NOT NULL,
  `deleted` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Схема на данните от таблица `orders`
--

INSERT INTO `orders` (`id`, `name`, `user_id`, `product_id`, `quantity`, `total`, `date_entered`, `date_modified`, `deleted`) VALUES
('{49fedbc1-b79b-c31c-220d-6b6661666b82}', 'Coca Cola purchased from Jon Olsson', 'w7437743l5857d485', 'wr2132st4767583', 42, 53.76, '2017-05-25', '2017-05-26', 0),
('{b7ab12e7-fad3-ba7f-3394-30a1c26a7663}', 'Coca Cola purchased from John Smith', 'r4585y49484w203', 'ri4756rt464645', 41, 73.8, '2017-05-25', '2017-05-26', 0),
('{8b7d5898-2e64-d109-1a34-f7d3ca32641d}', 'Pepsi Cola purchased from Jon Olsson', 'w7437743l5857d485', 'wr2132st4767583', 4, 5.12, '2017-05-25', '2017-03-03', 0),
('{84f6e1ee-ca6f-b66b-6ce7-f2717531feb6}', 'Pepsi Cola purchased from Laura Stone', 'q3u4s4322211f', 'wr2132st4767583', 5, 6.4, '2017-05-25', '2017-05-25', 0),
('{b4bf4683-489c-37b1-ea20-918e8073dae8}', 'Pepsi Cola purchased from Laura Stone', 'q3u4s4322211f', 'wr2132st4767583', 5, 6.4, '2017-05-26', '2017-05-26', 0);

-- --------------------------------------------------------

--
-- Структура на таблица `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `currency` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date_entered` date NOT NULL,
  `date_modified` date NOT NULL,
  `deleted` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Схема на данните от таблица `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `currency`, `date_entered`, `date_modified`, `deleted`) VALUES
('ri4756rt464645', 'Coca Cola', 1.8, 'EUR', '2017-05-25', '2017-05-25', 0),
('wr2132st4767583', 'Pepsi Cola', 1.6, 'EUR', '2017-05-25', '2017-05-25', 0);

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date_entered` date NOT NULL,
  `date_modified` date NOT NULL,
  `deleted` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`id`, `name`, `date_entered`, `date_modified`, `deleted`) VALUES
('e123d21311r23434', 'Pavel', '2017-05-25', '2017-05-25', 0),
('r4585y49484w203', 'John Smith', '2017-05-25', '2017-05-25', 0),
('q3u4s4322211f', 'Laura Stone', '2017-05-25', '2017-05-25', 0),
('w7437743l5857d485', 'Jon Olsson', '2017-05-25', '2017-05-25', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
