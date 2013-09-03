-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 07 月 24 日 15:12
-- 服务器版本: 5.5.8
-- PHP 版本: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `taocms`
--

-- --------------------------------------------------------

--
-- 表的结构 `tao_access`
--

CREATE TABLE IF NOT EXISTS `tao_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `pid` smallint(6) NOT NULL,
  `module` varchar(50) DEFAULT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tao_access`
--

INSERT INTO `tao_access` (`role_id`, `node_id`, `level`, `pid`, `module`) VALUES
(2, 1, 1, 0, ''),
(2, 40, 2, 1, ''),
(2, 30, 2, 1, ''),
(3, 1, 1, 0, ''),
(2, 69, 2, 1, ''),
(2, 50, 3, 40, ''),
(3, 50, 3, 40, ''),
(1, 50, 3, 40, ''),
(3, 7, 2, 1, ''),
(3, 39, 3, 30, ''),
(2, 39, 3, 30, ''),
(2, 49, 3, 30, ''),
(4, 1, 1, 0, ''),
(4, 2, 2, 1, ''),
(4, 3, 2, 1, ''),
(4, 4, 2, 1, ''),
(4, 5, 2, 1, ''),
(4, 6, 2, 1, ''),
(4, 7, 2, 1, ''),
(4, 11, 2, 1, ''),
(5, 25, 1, 0, ''),
(5, 51, 2, 25, ''),
(1, 1, 1, 0, ''),
(1, 39, 3, 30, ''),
(1, 40, 2, 1, ''),
(1, 30, 2, 1, ''),
(1, 7, 2, 1, ''),
(1, 49, 3, 30, ''),
(3, 69, 2, 1, ''),
(3, 30, 2, 1, ''),
(3, 40, 2, 1, ''),
(1, 37, 3, 30, ''),
(1, 36, 3, 30, ''),
(1, 35, 3, 30, ''),
(1, 34, 3, 30, ''),
(1, 33, 3, 30, ''),
(1, 32, 3, 30, ''),
(1, 31, 3, 30, ''),
(2, 32, 3, 30, ''),
(2, 31, 3, 30, ''),
(7, 1, 1, 0, ''),
(7, 30, 2, 1, ''),
(7, 40, 2, 1, ''),
(7, 69, 2, 1, ''),
(7, 50, 3, 40, ''),
(7, 39, 3, 30, ''),
(7, 49, 3, 30, '');

-- --------------------------------------------------------

--
-- 表的结构 `tao_category`
--

CREATE TABLE IF NOT EXISTS `tao_category` (
  `id` mediumint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `title` varchar(50) NOT NULL DEFAULT '',
  `remark` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `tao_category`
--


-- --------------------------------------------------------

--
-- 表的结构 `tao_comment`
--

CREATE TABLE IF NOT EXISTS `tao_comment` (
  `id` mediumint(5) unsigned NOT NULL AUTO_INCREMENT,
  `recordId` int(11) unsigned NOT NULL DEFAULT '0',
  `author` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `ip` varchar(25) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `cTime` int(11) unsigned NOT NULL DEFAULT '0',
  `agent` varchar(255) DEFAULT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `module` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `tao_comment`
--


-- --------------------------------------------------------

--
-- 表的结构 `tao_member`
--

CREATE TABLE IF NOT EXISTS `tao_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(150) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `jointime` datetime NOT NULL,
  `last_login_date` datetime NOT NULL,
  `active` tinyint(1) NOT NULL,
  `sex` char(20) NOT NULL DEFAULT '保密',
  `rank` smallint(5) NOT NULL,
  `score` mediumint(8) NOT NULL,
  `money` mediumint(8) NOT NULL,
  `face` char(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `safequestion` smallint(5) NOT NULL,
  `safeanswer` char(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `joinip` char(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_login_ip` char(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(50) NOT NULL COMMENT '外键',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `name` (`nickname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='前台会员表' AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `tao_member`
--


-- --------------------------------------------------------

--
-- 表的结构 `tao_node`
--

CREATE TABLE IF NOT EXISTS `tao_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `sort` smallint(6) unsigned DEFAULT NULL,
  `pid` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) unsigned NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `group_id` tinyint(3) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=88 ;

--
-- 转存表中的数据 `tao_node`
--

INSERT INTO `tao_node` (`id`, `name`, `title`, `status`, `remark`, `sort`, `pid`, `level`, `type`, `group_id`) VALUES
(49, 'read', '查看', 1, '', 0, 30, 3, 0, 0),
(40, 'Index', '默认模块', 1, '', 1, 1, 2, 0, 0),
(39, 'index', '列表', 1, '', 0, 30, 3, 0, 0),
(34, 'update', '更新', 1, '', 0, 30, 3, 0, 0),
(33, 'edit', '编辑', 1, '', 0, 30, 3, 0, 0),
(32, 'insert', '写入', 1, '', 0, 30, 3, 0, 0),
(31, 'add', '新增', 1, '', 0, 30, 3, 0, 0),
(30, 'Public', '公共模块', 1, '', 2, 1, 2, 0, 0),
(7, 'User', '后台用户', 1, '', 3, 85, 2, 0, 2),
(6, 'Role', '角色管理', 1, '', 2, 85, 2, 0, 2),
(2, 'Node', '节点管理', 1, '', 1, 85, 2, 0, 2),
(1, 'Admin', '后台管理', 1, '', 1, 0, 1, 0, 0),
(50, 'main', '空白首页', 1, '', 2, 40, 3, 0, 0),
(85, 'System', '系统设置', 1, NULL, 3, 1, 1, 0, 0),
(86, 'Db', '数据库备份/恢复', 1, NULL, 4, 85, 2, 0, 0),
(87, 'Sysinfo', '系统基本参数', 1, NULL, 1, 85, 2, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `tao_notes`
--

CREATE TABLE IF NOT EXISTS `tao_notes` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `top` int(10) NOT NULL,
  `left` int(10) NOT NULL,
  `color` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(20) NOT NULL,
  `content` tinytext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `tao_notes`
--

INSERT INTO `tao_notes` (`id`, `top`, `left`, `color`, `user_id`, `content`) VALUES
(1, 90, 208, 'blue', 1, 'null');

-- --------------------------------------------------------

--
-- 表的结构 `tao_profile`
--

CREATE TABLE IF NOT EXISTS `tao_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nickname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `tao_profile`
--

INSERT INTO `tao_profile` (`id`, `email`, `nickname`, `user_id`) VALUES
(1, 'liu21st@gmail.com', '流年', 39);

-- --------------------------------------------------------

--
-- 表的结构 `tao_role`
--

CREATE TABLE IF NOT EXISTS `tao_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `ename` varchar(5) DEFAULT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parentId` (`pid`),
  KEY `ename` (`ename`),
  KEY `status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `tao_role`
--

INSERT INTO `tao_role` (`id`, `name`, `pid`, `status`, `remark`, `ename`, `create_time`, `update_time`) VALUES
(1, '领导组', 0, 1, '', '', 1208784792, 1254325558),
(2, '员工组', 0, 1, '', '', 1215496283, 1254325566),
(7, '演示组', 2, 1, '演示', '', 1254325787, 0);

-- --------------------------------------------------------

--
-- 表的结构 `tao_role_user`
--

CREATE TABLE IF NOT EXISTS `tao_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL,
  `user_id` char(32) DEFAULT NULL,
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tao_role_user`
--

INSERT INTO `tao_role_user` (`role_id`, `user_id`) VALUES
(4, '27'),
(4, '26'),
(4, '30'),
(5, '31'),
(3, '22'),
(3, '1'),
(1, '4'),
(2, '3'),
(7, '2'),
(3, '35'),
(3, '36');

-- --------------------------------------------------------

--
-- 表的结构 `tao_session`
--

CREATE TABLE IF NOT EXISTS `tao_session` (
  `session_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `session_expire` int(11) NOT NULL,
  `session_data` text COLLATE utf8_unicode_ci,
  UNIQUE KEY `session_id` (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `tao_session`
--

INSERT INTO `tao_session` (`session_id`, `session_expire`, `session_data`) VALUES
('ml2vohltr0aedj18lmkif9ifh5', 1374463728, 'verify|s:32:"b090409688550f3cc93f4ed88ec6cafb";authId|s:1:"1";email|s:17:"liu21st@gmail.com";loginUserName|s:9:"ç®¡ç†å‘˜";lastLoginTime|s:10:"1374459966";login_count|s:3:"977";admin|b:1;');

-- --------------------------------------------------------

--
-- 表的结构 `tao_user`
--

CREATE TABLE IF NOT EXISTS `tao_user` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL COMMENT '用户名',
  `nickname` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `bind_account` varchar(50) NOT NULL,
  `last_login_time` int(11) unsigned DEFAULT '0',
  `last_login_ip` varchar(40) DEFAULT NULL,
  `login_count` mediumint(8) unsigned DEFAULT '0',
  `verify` varchar(32) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  `type_id` tinyint(2) unsigned DEFAULT '0',
  `info` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- 转存表中的数据 `tao_user`
--

INSERT INTO `tao_user` (`id`, `username`, `nickname`, `password`, `bind_account`, `last_login_time`, `last_login_ip`, `login_count`, `verify`, `email`, `remark`, `create_time`, `update_time`, `status`, `type_id`, `info`) VALUES
(1, 'admin', '管理员', '21232f297a57a5a743894a0e4a801fc3', '', 1374678248, '127.0.0.1', 992, '8888', 'liu21st@gmail.com', '备注信息', 1222907803, 1239977420, 1, 0, ''),
(2, 'demo', '演示', 'fe01ce2a7fbac8fafaed7c982a04e229', '', 1374667022, '127.0.0.1', 100, '8888', '', '', 1239783735, 1254325770, 1, 0, ''),
(3, 'member', '员工', 'aa08769cdcb26674c6706093503ff0a3', '', 1254326104, '127.0.0.1', 15, '', '', '', 1253514375, 1254325728, 1, 0, ''),
(4, 'leader', '领导', 'c444858e0aaeb727da73d2eae62321ad', '', 1373888958, '127.0.0.1', 18, '', '', '领导', 1253514575, 1254325705, 1, 0, '');
