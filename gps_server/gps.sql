-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 12 月 11 日 16:13
-- 服务器版本: 5.5.40
-- PHP 版本: 5.4.33

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `gps`
--

-- --------------------------------------------------------

--
-- 表的结构 `c_bike`
--

CREATE TABLE IF NOT EXISTS `c_bike` (
  `bike_id` int(11) NOT NULL AUTO_INCREMENT,
  `bike_imei` varchar(50) NOT NULL,
  `bike_phone` varchar(50) DEFAULT NULL,
  `bike_info` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`bike_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `c_bike`
--

INSERT INTO `c_bike` (`bike_id`, `bike_imei`, `bike_phone`, `bike_info`) VALUES
(1, '867120000014432', '3822446069', 'ff');

-- --------------------------------------------------------

--
-- 表的结构 `c_bike_trace`
--

CREATE TABLE IF NOT EXISTS `c_bike_trace` (
  `trace_id` int(11) NOT NULL AUTO_INCREMENT,
  `trace_jd` float DEFAULT NULL,
  `trace_wd` float DEFAULT NULL,
  `trace_time` int(11) DEFAULT NULL,
  `bike_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`trace_id`),
  KEY `bike_f` (`bike_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `c_bike_trace`
--

INSERT INTO `c_bike_trace` (`trace_id`, `trace_jd`, `trace_wd`, `trace_time`, `bike_id`) VALUES
(1, 13213, 4154540, 1233123, 1);

--
-- 限制导出的表
--

--
-- 限制表 `c_bike_trace`
--
ALTER TABLE `c_bike_trace`
  ADD CONSTRAINT `bike_f` FOREIGN KEY (`bike_id`) REFERENCES `c_bike` (`bike_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
