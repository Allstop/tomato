-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 產生時間： 2015 年 04 月 02 日 16:56
-- 伺服器版本: 5.5.40-1
-- PHP 版本： 5.6.4-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫： `TimeManagement`
--

-- --------------------------------------------------------

--
-- 資料表結構 `record`
--

CREATE TABLE IF NOT EXISTS `record` (
  `id` int(10) unsigned NOT NULL,
  `userId` int(10) NOT NULL,
  `date` date NOT NULL,
  `starttime` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `endtime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `record`
--

INSERT INTO `record` (`id`, `userId`, `date`, `starttime`, `endtime`, `description`) VALUES
(0, 2, '2015-04-02', '2015-04-02 02:00:00', '2015-04-02 04:00:00', 'tomattooooo'),
(1, 2, '2015-04-02', '2015-04-02 01:00:00', '2015-04-02 02:00:00', 'work');

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `createon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `createon`) VALUES
(1, 'AAA', 'BBB', '2015-04-01 06:26:45'),
(2, 'Cara', '2222', '2015-04-01 06:35:39'),
(4, 'Rabbit', '0304', '2015-04-01 06:38:33'),
(6, '999', '888', '2015-04-01 06:39:39'),
(11, 'Allstop', '2222', '2015-04-01 07:03:50');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `record`
--
ALTER TABLE `record`
 ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `user`
--
ALTER TABLE `user`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
