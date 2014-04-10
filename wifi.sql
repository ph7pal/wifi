-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- 主机: localhost
-- 生成日期: 2014 年 04 月 10 日 15:41
-- 服务器版本: 5.0.51
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- 数据库: `wifi`
-- 

-- --------------------------------------------------------

-- 
-- 表的结构 `pre_ads`
-- 

CREATE TABLE `pre_ads` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(50) NOT NULL,
  `url` varchar(255) NOT NULL default '',
  `attachid` varchar(255) NOT NULL default '',
  `width` varchar(10) NOT NULL default '',
  `height` varchar(10) NOT NULL default '',
  `description` varchar(255) NOT NULL,
  `hits` int(10) unsigned NOT NULL default '0',
  `start_time` int(10) unsigned NOT NULL default '0',
  `expired_time` int(10) unsigned NOT NULL default '0',
  `position` char(40) NOT NULL default '',
  `order` int(10) unsigned NOT NULL default '0',
  `status` tinyint(1) NOT NULL,
  `cTime` int(10) unsigned NOT NULL default '0',
  `classify` char(16) NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- 
-- 导出表中的数据 `pre_ads`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `pre_album`
-- 

CREATE TABLE `pre_album` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `uid` int(10) unsigned NOT NULL default '0',
  `postid` int(10) unsigned NOT NULL default '0',
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `classify` char(16) NOT NULL,
  `order` int(11) NOT NULL default '0',
  `status` tinyint(1) NOT NULL,
  `cTime` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- 
-- 导出表中的数据 `pre_album`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `pre_attachments`
-- 

CREATE TABLE `pre_attachments` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `uid` int(11) unsigned NOT NULL,
  `logid` int(11) unsigned NOT NULL,
  `filePath` varchar(255) NOT NULL,
  `fileDesc` varchar(255) NOT NULL,
  `fileSize` char(32) NOT NULL,
  `width` smallint(5) unsigned NOT NULL,
  `height` smallint(5) unsigned NOT NULL,
  `classify` varchar(255) NOT NULL,
  `covered` tinyint(1) NOT NULL,
  `hits` int(11) unsigned NOT NULL,
  `cTime` int(11) unsigned NOT NULL,
  `status` tinyint(3) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `logid` (`logid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

-- 
-- 导出表中的数据 `pre_attachments`
-- 

INSERT INTO `pre_attachments` VALUES (12, 2, 27, '533172a188dd8.jpg', '533172a188dd8.jpg', '', 0, 0, 'coverimg', 0, 0, 1395749537, 1);
INSERT INTO `pre_attachments` VALUES (13, 2, 28, '533172b5f1ec4.jpg', '533172b5f1ec4.jpg', '', 0, 0, 'coverimg', 0, 0, 1395749557, 1);
INSERT INTO `pre_attachments` VALUES (14, 2, 6, '533179b08b09c.jpg', '533179b08b09c.jpg', '', 0, 0, 'ads', 0, 0, 1395751344, 1);
INSERT INTO `pre_attachments` VALUES (15, 2, 7, '533179d2ecdc7.jpg', '533179d2ecdc7.jpg', '', 0, 0, 'ads', 0, 0, 1395751378, 1);
INSERT INTO `pre_attachments` VALUES (16, 2, 8, '53317a142d1c7.jpg', '53317a142d1c7.jpg', '', 0, 0, 'ads', 0, 0, 1395751444, 1);

-- --------------------------------------------------------

-- 
-- 表的结构 `pre_columns`
-- 

CREATE TABLE `pre_columns` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `belongid` int(10) unsigned NOT NULL default '0',
  `name` varchar(100) NOT NULL default '',
  `title` varchar(100) NOT NULL,
  `second_title` varchar(100) NOT NULL default '',
  `classify` char(32) NOT NULL default '',
  `position` char(32) NOT NULL,
  `url` varchar(255) NOT NULL default '',
  `attachid` int(10) unsigned NOT NULL default '0',
  `order` int(10) unsigned NOT NULL default '0',
  `hits` int(10) unsigned NOT NULL default '0',
  `status` tinyint(1) NOT NULL default '0',
  `cTime` int(10) unsigned NOT NULL default '0',
  `system` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

-- 
-- 导出表中的数据 `pre_columns`
-- 

INSERT INTO `pre_columns` VALUES (21, 0, 'zhan shi ', '展示', '', 'logo', 'topbar', '', 0, 0, 0, 1, 1397142680, 0);
INSERT INTO `pre_columns` VALUES (22, 0, 'liu yan ', '留言', '', 'page', 'topbar', '', 0, 0, 0, 1, 1397142710, 0);
INSERT INTO `pre_columns` VALUES (23, 0, 'guan yu wo men ', '关于我们', '', 'page', 'topbar', '', 0, 0, 0, 1, 1397142728, 0);
INSERT INTO `pre_columns` VALUES (20, 0, 'huo dong ', '活动', '', 'page', 'topbar', '', 0, 0, 0, 1, 1396705594, 0);
INSERT INTO `pre_columns` VALUES (24, 0, 'cai dan ', '菜单', '', 'page', 'topbar', '', 0, 0, 0, 1, 1397142752, 0);
INSERT INTO `pre_columns` VALUES (25, 0, 'shi yong shui ming ', '使用说明', '', 'page', 'topbar', '', 0, 0, 0, 1, 1397142761, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `pre_comments`
-- 

CREATE TABLE `pre_comments` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `logid` int(10) unsigned NOT NULL default '0',
  `uid` int(10) unsigned NOT NULL default '0',
  `nickname` varchar(60) NOT NULL,
  `email` varchar(50) NOT NULL default '',
  `content` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `answer_status` tinyint(1) NOT NULL,
  `answer_content` text,
  `client_ip` char(16) NOT NULL,
  `cTime` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `pre_comments`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `pre_config`
-- 

CREATE TABLE `pre_config` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `value` text,
  `description` varchar(255) NOT NULL default '',
  `classify` char(16) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

-- 
-- 导出表中的数据 `pre_config`
-- 

INSERT INTO `pre_config` VALUES (5, 'sitename', '新灵旅行', '', 'baseinfo');
INSERT INTO `pre_config` VALUES (6, 'shortTitle', '带上新的生活去旅行', '', 'baseinfo');
INSERT INTO `pre_config` VALUES (7, 'domain', 'http://www.newsoul.cn', '', 'baseinfo');
INSERT INTO `pre_config` VALUES (8, 'address', '重庆市江北观音桥', '', 'siteinfo');
INSERT INTO `pre_config` VALUES (9, 'phone', '023-12345678', '', 'siteinfo');
INSERT INTO `pre_config` VALUES (10, 'email', 'admin@admin.com', '', 'siteinfo');
INSERT INTO `pre_config` VALUES (11, 'beian', '渝备12345678', '', 'siteinfo');
INSERT INTO `pre_config` VALUES (12, 'copyright', '2012-2013', '', 'siteinfo');
INSERT INTO `pre_config` VALUES (13, 'baseurl', 'http://localhost/wifi/', '', 'baseinfo');
INSERT INTO `pre_config` VALUES (14, 'version', 'Alpha 1.0', '', 'baseinfo');
INSERT INTO `pre_config` VALUES (15, 'imgUploadNum', '1', '', 'upload');
INSERT INTO `pre_config` VALUES (16, 'imgMinWidth', '300', '', 'upload');
INSERT INTO `pre_config` VALUES (17, 'imgMinHeight', '300', '', 'upload');
INSERT INTO `pre_config` VALUES (18, 'imgAllowTypes', '*.jpg;*.png;*.jpeg', '', 'upload');
INSERT INTO `pre_config` VALUES (19, 'imgThumbSize', '124,200,300,600,origin', '', 'upload');
INSERT INTO `pre_config` VALUES (20, 'imgMaxSize', '1024000', '', 'upload');
INSERT INTO `pre_config` VALUES (21, 'imgQuality', '80', '', 'upload');
INSERT INTO `pre_config` VALUES (22, 'closeSite', '1', '', 'base');
INSERT INTO `pre_config` VALUES (23, 'mobile', '1', '', 'base');
INSERT INTO `pre_config` VALUES (24, 'userDefaultGroup', '5', '', 'base');
INSERT INTO `pre_config` VALUES (25, 'attachDir', 'http://localhost/acopy/attachments/', '', 'base');
INSERT INTO `pre_config` VALUES (26, 'service_aim_cn', '致力于提升客户品牌形象、实现客户商业目标!', '', 'base');
INSERT INTO `pre_config` VALUES (27, 'service_aim_en', 'Commitment to enhance customer brand image,customer business goals!', '', 'base');
INSERT INTO `pre_config` VALUES (28, 'perPageNum', '10', '', 'base');
INSERT INTO `pre_config` VALUES (29, 'logo', 'common/images/logo.png', '', 'base');
INSERT INTO `pre_config` VALUES (30, 'closeSiteReason', '系统正在维护中，请稍后再访问！', '', 'base');
INSERT INTO `pre_config` VALUES (31, 'readLocalDir', 'C:\\\\AppServ\\\\www\\\\wifi\\\\protected/../attachments/', '', 'base');
INSERT INTO `pre_config` VALUES (32, 'downloadLocalDir', 'C:\\\\AppServ\\\\www\\\\wifi\\\\protected/../attachments/', '', 'base');

-- --------------------------------------------------------

-- 
-- 表的结构 `pre_group_powers`
-- 

CREATE TABLE `pre_group_powers` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `gid` varchar(50) NOT NULL,
  `powers` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

-- 
-- 导出表中的数据 `pre_group_powers`
-- 

INSERT INTO `pre_group_powers` VALUES (1, '4', 'checksetting');
INSERT INTO `pre_group_powers` VALUES (2, '4', 'setting');
INSERT INTO `pre_group_powers` VALUES (3, '4', 'addcolumns');
INSERT INTO `pre_group_powers` VALUES (4, '4', 'editcolumns');
INSERT INTO `pre_group_powers` VALUES (5, '4', 'delcolumns');
INSERT INTO `pre_group_powers` VALUES (6, '4', 'upload');
INSERT INTO `pre_group_powers` VALUES (7, '4', 'editattachments');
INSERT INTO `pre_group_powers` VALUES (8, '4', 'delattachments');
INSERT INTO `pre_group_powers` VALUES (9, '4', 'edittags');
INSERT INTO `pre_group_powers` VALUES (10, '4', 'deltags');
INSERT INTO `pre_group_powers` VALUES (11, '4', 'editcomments');
INSERT INTO `pre_group_powers` VALUES (12, '4', 'delcomments');
INSERT INTO `pre_group_powers` VALUES (13, '5', 'checksetting');
INSERT INTO `pre_group_powers` VALUES (14, '5', 'setting');
INSERT INTO `pre_group_powers` VALUES (15, '5', 'addcolumns');
INSERT INTO `pre_group_powers` VALUES (16, '5', 'editcolumns');
INSERT INTO `pre_group_powers` VALUES (17, '5', 'delcolumns');
INSERT INTO `pre_group_powers` VALUES (18, '5', 'addposts');
INSERT INTO `pre_group_powers` VALUES (19, '5', 'editposts');
INSERT INTO `pre_group_powers` VALUES (20, '5', 'delposts');
INSERT INTO `pre_group_powers` VALUES (21, '5', 'addusergroup');
INSERT INTO `pre_group_powers` VALUES (22, '5', 'editusergroup');
INSERT INTO `pre_group_powers` VALUES (23, '5', 'delusergroup');
INSERT INTO `pre_group_powers` VALUES (24, '5', 'addusers');
INSERT INTO `pre_group_powers` VALUES (25, '5', 'editusers');
INSERT INTO `pre_group_powers` VALUES (26, '5', 'delusers');
INSERT INTO `pre_group_powers` VALUES (27, '5', 'addlink');
INSERT INTO `pre_group_powers` VALUES (28, '5', 'editlink');
INSERT INTO `pre_group_powers` VALUES (29, '5', 'dellink');
INSERT INTO `pre_group_powers` VALUES (30, '5', 'addads');
INSERT INTO `pre_group_powers` VALUES (31, '5', 'editads');
INSERT INTO `pre_group_powers` VALUES (32, '5', 'delads');
INSERT INTO `pre_group_powers` VALUES (33, '5', 'addalbum');
INSERT INTO `pre_group_powers` VALUES (34, '5', 'editalbum');
INSERT INTO `pre_group_powers` VALUES (35, '5', 'delalbum');
INSERT INTO `pre_group_powers` VALUES (36, '5', 'upload');
INSERT INTO `pre_group_powers` VALUES (37, '5', 'editattachments');
INSERT INTO `pre_group_powers` VALUES (38, '5', 'delattachments');
INSERT INTO `pre_group_powers` VALUES (39, '5', 'deluseraction');
INSERT INTO `pre_group_powers` VALUES (40, '5', 'edittags');
INSERT INTO `pre_group_powers` VALUES (41, '5', 'deltags');
INSERT INTO `pre_group_powers` VALUES (42, '5', 'addcomments');
INSERT INTO `pre_group_powers` VALUES (43, '5', 'editcomments');
INSERT INTO `pre_group_powers` VALUES (44, '5', 'delcomments');
INSERT INTO `pre_group_powers` VALUES (45, '5', 'addquestions');
INSERT INTO `pre_group_powers` VALUES (46, '5', 'editquestions');
INSERT INTO `pre_group_powers` VALUES (47, '5', 'delquestions');

-- --------------------------------------------------------

-- 
-- 表的结构 `pre_link`
-- 

CREATE TABLE `pre_link` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `classify` char(32) NOT NULL,
  `attachid` int(10) NOT NULL default '0',
  `status` tinyint(1) NOT NULL,
  `order` int(10) unsigned NOT NULL default '0',
  `hits` int(10) unsigned NOT NULL default '0',
  `cTime` int(10) unsigned NOT NULL default '0',
  `uid` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- 导出表中的数据 `pre_link`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `pre_posts`
-- 

CREATE TABLE `pre_posts` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `colid` smallint(5) unsigned NOT NULL default '0',
  `uid` int(10) unsigned NOT NULL default '1',
  `nickname` varchar(30) NOT NULL default '',
  `author` varchar(100) NOT NULL default '',
  `title` varchar(255) NOT NULL,
  `second_title` varchar(255) NOT NULL default '',
  `name` char(50) NOT NULL default '',
  `albumid` int(11) NOT NULL,
  `title_style` varchar(255) NOT NULL default '',
  `seo_title` varchar(255) NOT NULL default '',
  `seo_description` varchar(255) NOT NULL default '',
  `seo_keywords` varchar(255) NOT NULL default '',
  `intro` mediumtext NOT NULL,
  `content` text NOT NULL,
  `copy_from` varchar(100) NOT NULL default '',
  `copy_url` varchar(255) NOT NULL default '',
  `redirect_url` varchar(255) NOT NULL default '',
  `hits` int(10) unsigned NOT NULL default '1',
  `order` int(10) unsigned NOT NULL default '0',
  `reply_allow` tinyint(1) NOT NULL default '1',
  `status` tinyint(1) NOT NULL,
  `last_update_time` int(10) unsigned NOT NULL default '0',
  `cTime` int(10) unsigned NOT NULL default '0',
  `attachid` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

-- 
-- 导出表中的数据 `pre_posts`
-- 

INSERT INTO `pre_posts` VALUES (30, 0, 2, '', '', '未编辑', '', '', 0, '', '', '', '', '', '', '', '', '', 1, 0, 1, 0, 0, 1396852778, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `pre_questions`
-- 

CREATE TABLE `pre_questions` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `uid` int(10) unsigned NOT NULL default '0',
  `classify` smallint(5) unsigned NOT NULL default '0',
  `username` varchar(100) NOT NULL default '',
  `truename` varchar(50) NOT NULL default '',
  `email` varchar(60) NOT NULL default '',
  `telephone` varchar(20) NOT NULL default '',
  `content` text NOT NULL,
  `contact` varchar(100) NOT NULL default '',
  `answer_status` tinyint(1) NOT NULL,
  `answer_content` text,
  `status` tinyint(1) NOT NULL,
  `cTime` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `pre_questions`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `pre_users`
-- 

CREATE TABLE `pre_users` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `username` char(50) NOT NULL,
  `password` char(32) NOT NULL,
  `truename` varchar(100) NOT NULL,
  `groupid` smallint(5) unsigned NOT NULL,
  `email` varchar(100) NOT NULL,
  `qq` varchar(15) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `last_login_ip` char(16) NOT NULL,
  `last_login_time` int(10) NOT NULL,
  `login_count` int(10) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL,
  `cTime` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- 导出表中的数据 `pre_users`
-- 

INSERT INTO `pre_users` VALUES (2, 'admin', 'd006e37c5d52563596bf37e581fdbb11', 'admin', 5, '', '', '', '', '2130706433', 0, 0, 1, 1383317699);
INSERT INTO `pre_users` VALUES (3, '', '', '', 0, '', '', '', '', '', 0, 0, 0, 1383321699);

-- --------------------------------------------------------

-- 
-- 表的结构 `pre_user_action`
-- 

CREATE TABLE `pre_user_action` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `uid` int(11) unsigned NOT NULL,
  `logid` int(11) unsigned NOT NULL,
  `classify` char(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  `cTime` int(11) unsigned NOT NULL,
  `ip` char(16) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

-- 
-- 导出表中的数据 `pre_user_action`
-- 

INSERT INTO `pre_user_action` VALUES (1, 2, 16, 'editcolumns', '编辑栏目', 1395747327, '2130706433');
INSERT INTO `pre_user_action` VALUES (2, 2, 17, 'editcolumns', '编辑栏目', 1395747351, '2130706433');
INSERT INTO `pre_user_action` VALUES (3, 2, 18, 'editcolumns', '编辑栏目', 1395747369, '2130706433');
INSERT INTO `pre_user_action` VALUES (4, 2, 0, 'setting', '更新设置', 1395748048, '2130706433');
INSERT INTO `pre_user_action` VALUES (5, 2, 0, 'setting', '更新设置', 1395748061, '2130706433');
INSERT INTO `pre_user_action` VALUES (6, 2, 0, 'setting', '更新设置', 1395748082, '2130706433');
INSERT INTO `pre_user_action` VALUES (7, 2, 0, 'setting', '更新设置', 1395748165, '2130706433');
INSERT INTO `pre_user_action` VALUES (8, 2, 0, 'setting', '更新设置', 1395748216, '2130706433');
INSERT INTO `pre_user_action` VALUES (9, 2, 19, 'editcolumns', '编辑栏目', 1395748313, '2130706433');
INSERT INTO `pre_user_action` VALUES (10, 2, 0, 'setting', '更新设置', 1395748842, '2130706433');
INSERT INTO `pre_user_action` VALUES (11, 2, 0, 'setting', '更新设置', 1395748946, '2130706433');
INSERT INTO `pre_user_action` VALUES (12, 2, 0, 'setting', '更新设置', 1395749476, '2130706433');
INSERT INTO `pre_user_action` VALUES (13, 2, 27, 'editposts', '编辑文章', 1395749541, '2130706433');
INSERT INTO `pre_user_action` VALUES (14, 2, 28, 'editposts', '编辑文章', 1395749560, '2130706433');
INSERT INTO `pre_user_action` VALUES (15, 2, 29, 'editposts', '编辑文章', 1395751159, '2130706433');
INSERT INTO `pre_user_action` VALUES (16, 2, 6, 'editads', '新增展示', 1395751348, '2130706433');
INSERT INTO `pre_user_action` VALUES (17, 2, 7, 'editads', '新增展示', 1395751383, '2130706433');
INSERT INTO `pre_user_action` VALUES (18, 2, 8, 'editads', '新增展示', 1395751448, '2130706433');
INSERT INTO `pre_user_action` VALUES (19, 2, 0, 'delcolumns', '删除栏目', 1396792988, '2130706433');
INSERT INTO `pre_user_action` VALUES (20, 2, 0, 'delcolumns', '删除栏目', 1396793007, '2130706433');
INSERT INTO `pre_user_action` VALUES (21, 2, 0, 'delcolumns', '删除栏目', 1396793102, '2130706433');
INSERT INTO `pre_user_action` VALUES (22, 2, 0, 'delcolumns', '删除栏目', 1396793109, '2130706433');
INSERT INTO `pre_user_action` VALUES (23, 2, 0, 'delposts', '删除文章', 1396793454, '2130706433');
INSERT INTO `pre_user_action` VALUES (24, 2, 0, 'delposts', '删除文章', 1396793511, '2130706433');
INSERT INTO `pre_user_action` VALUES (25, 2, 0, 'delposts', '删除文章', 1396793513, '2130706433');
INSERT INTO `pre_user_action` VALUES (26, 2, 0, 'setting', '更新设置', 1396852817, '2130706433');
INSERT INTO `pre_user_action` VALUES (27, 2, 0, 'setting', '更新设置', 1396852860, '2130706433');
INSERT INTO `pre_user_action` VALUES (28, 2, 0, 'delads', '删除展示', 1397051148, '2130706433');
INSERT INTO `pre_user_action` VALUES (29, 2, 0, 'delads', '删除展示', 1397051151, '2130706433');
INSERT INTO `pre_user_action` VALUES (30, 2, 0, 'delads', '删除展示', 1397051153, '2130706433');
INSERT INTO `pre_user_action` VALUES (31, 2, 20, 'editcolumns', '编辑栏目', 1397142168, '2130706433');
INSERT INTO `pre_user_action` VALUES (32, 2, 21, 'editcolumns', '编辑栏目', 1397142705, '2130706433');
INSERT INTO `pre_user_action` VALUES (33, 2, 22, 'editcolumns', '编辑栏目', 1397142725, '2130706433');
INSERT INTO `pre_user_action` VALUES (34, 2, 23, 'editcolumns', '编辑栏目', 1397142741, '2130706433');
INSERT INTO `pre_user_action` VALUES (35, 2, 24, 'editcolumns', '编辑栏目', 1397142759, '2130706433');
INSERT INTO `pre_user_action` VALUES (36, 2, 25, 'editcolumns', '编辑栏目', 1397142771, '2130706433');

-- --------------------------------------------------------

-- 
-- 表的结构 `pre_user_group`
-- 

CREATE TABLE `pre_user_group` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(50) NOT NULL,
  `powers` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `cTime` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- 
-- 导出表中的数据 `pre_user_group`
-- 

INSERT INTO `pre_user_group` VALUES (5, '系统', 'zmf', 1, 1383321578);
INSERT INTO `pre_user_group` VALUES (4, '管理员', 'zmf', 1, 1383317395);

-- --------------------------------------------------------

-- 
-- 表的结构 `pre_user_info`
-- 

CREATE TABLE `pre_user_info` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `uid` int(11) unsigned NOT NULL,
  `name` char(16) NOT NULL,
  `value` varchar(255) NOT NULL,
  `classify` char(16) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- 导出表中的数据 `pre_user_info`
-- 

INSERT INTO `pre_user_info` VALUES (2, 2, 'column', '21,22,24', 'column');
