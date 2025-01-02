-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2025-01-02 10:37:55
-- 伺服器版本： 10.4.27-MariaDB
-- PHP 版本： 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `db54+`
--

-- --------------------------------------------------------

--
-- 資料表結構 `bus`
--

CREATE TABLE `bus` (
  `id` int(11) NOT NULL,
  `busName` text NOT NULL,
  `minute` int(11) NOT NULL,
  `orderTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `bus`
--

INSERT INTO `bus` (`id`, `busName`, `minute`, `orderTime`) VALUES
(1, 'abc1234', 16, '2024-12-04 03:56:44'),
(2, 'abc4567', 10, '2024-12-04 03:56:50');

-- --------------------------------------------------------

--
-- 資料表結構 `form`
--

CREATE TABLE `form` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` text NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `checked` int(11) NOT NULL DEFAULT 0,
  `close` int(11) NOT NULL DEFAULT 1,
  `takeBus` text DEFAULT NULL,
  `ordertime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `form`
--

INSERT INTO `form` (`id`, `email`, `name`, `checked`, `close`, `takeBus`, `ordertime`) VALUES
(1, 'a12@11.com', 'a', 1, 0, 'AUTO-4911', '2024-12-04 03:55:17'),
(2, '111@1212.com', '1', 1, 0, 'AUTO-7559', '2025-01-02 09:35:41');

-- --------------------------------------------------------

--
-- 資料表結構 `formopen`
--

CREATE TABLE `formopen` (
  `id` int(10) UNSIGNED NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `formopen`
--

INSERT INTO `formopen` (`id`, `active`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `indexval`
--

CREATE TABLE `indexval` (
  `id` int(10) UNSIGNED NOT NULL,
  `editVal` int(11) NOT NULL DEFAULT 5
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `indexval`
--

INSERT INTO `indexval` (`id`, `editVal`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- 資料表結構 `station`
--

CREATE TABLE `station` (
  `id` int(10) UNSIGNED NOT NULL,
  `stationName` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `minute` int(11) NOT NULL,
  `waiting` int(11) NOT NULL,
  `rank` int(11) NOT NULL DEFAULT 0,
  `orderTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `station`
--

INSERT INTO `station` (`id`, `stationName`, `minute`, `waiting`, `rank`, `orderTime`) VALUES
(1, '我家', 5, 2, 1, '2024-12-04 03:49:26'),
(2, '你家', 10, 3, 2, '2024-12-04 03:49:26'),
(3, '他家', 4, 3, 3, '2024-12-04 03:49:23'),
(4, '她家', 4, 6, 4, '2024-12-04 03:49:23'),
(7, '陳宣瑞', 1, 2, 5, '2025-01-02 09:35:59');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `formopen`
--
ALTER TABLE `formopen`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `indexval`
--
ALTER TABLE `indexval`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `station`
--
ALTER TABLE `station`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `bus`
--
ALTER TABLE `bus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `form`
--
ALTER TABLE `form`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `formopen`
--
ALTER TABLE `formopen`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `indexval`
--
ALTER TABLE `indexval`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `station`
--
ALTER TABLE `station`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
