DROP TABLE IF EXISTS `pre_ads`;
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
  `system` tinyint(1) NOT NULL,
  `code` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

INSERT INTO `pre_ads` VALUES('13','全屏美女','http://newsoul.cn','36','','','','0','1397865600','1397952000','topbar','0','1','1398434226','flash','2','1','');
INSERT INTO `pre_ads` VALUES('14','','','','','','','0','0','0','','0','3','1398569922','empty','5','0','');

DROP TABLE IF EXISTS `pre_album`;
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
  `reply_allow` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `pre_album` VALUES('5','2','0','hehehe','hehehehehehehe','page','0','1','1398002648','1');

DROP TABLE IF EXISTS `pre_attachments`;
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
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

INSERT INTO `pre_attachments` VALUES('36','2','13','535a69cc814f7.jpg','535a69cc814f7.jpg','','0','0','ads','0','0','1398434252','1');
INSERT INTO `pre_attachments` VALUES('37','5','51','535cce5e4e8bb.jpg','535cce5e4e8bb.jpg','','0','0','coverimg','0','0','1398591070','1');
INSERT INTO `pre_attachments` VALUES('38','5','51','535cce76bb664.jpg','535cce76bb664.jpg','','0','0','posts','0','0','1398591094','1');
INSERT INTO `pre_attachments` VALUES('39','5','55','535d0a50be842.jpg','535d0a50be842.jpg','','0','0','coverimg','0','0','1398606416','1');

DROP TABLE IF EXISTS `pre_columns`;
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
  `listnum` tinyint(3) NOT NULL,
  `listcondition` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

INSERT INTO `pre_columns` VALUES('39','0','hui xiao ren cai ','会销人才','','thumb','topbar','','0','0','0','1','1398432449','1','0','');
INSERT INTO `pre_columns` VALUES('40','0','xing ye zhan hui ','行业展会','','list','topbar','','0','0','0','1','1398432471','1','0','');
INSERT INTO `pre_columns` VALUES('32','0','hui xiao chan pin ','会销产品','','thumb','topbar','','0','0','0','1','1398432248','1','0','');
INSERT INTO `pre_columns` VALUES('33','0',' zhuan qu ','OEM专区','','thumb','topbar','','0','0','0','1','1398432279','1','0','');
INSERT INTO `pre_columns` VALUES('34','0','hui xiao mo shi ','会销模式','','list','topbar','','0','0','0','1','1398432301','1','0','');
INSERT INTO `pre_columns` VALUES('35','0','dai li shang ku ','代理商库','','thumb','topbar','','0','0','0','1','1398432323','1','0','');
INSERT INTO `pre_columns` VALUES('36','0','ce hua tuan dui ','策划团队','','thumb','topbar','','0','0','0','1','1398432344','1','0','');
INSERT INTO `pre_columns` VALUES('37','0','hui xiao shi pin ','会销视频','','thumb','topbar','','0','0','0','1','1398432409','1','0','');
INSERT INTO `pre_columns` VALUES('38','0','hui xiao xin wen ','会销新闻','','list','topbar','','0','0','0','1','1398432428','1','0','');
INSERT INTO `pre_columns` VALUES('41','0','xin yong zi xun ','信用资讯','','list','main','','0','0','0','1','1398432684','1','0','');
INSERT INTO `pre_columns` VALUES('42','0','tong zhi gong gao ','通知公告','','list','main','','0','0','0','1','1398432720','1','0','');
INSERT INTO `pre_columns` VALUES('43','0','hei ming dan pu guang ','黑名单曝光','','list','main','','0','0','0','1','1398432752','1','0','');
INSERT INTO `pre_columns` VALUES('44','0','hui xiao chan pin pai xing bang ','会销产品排行榜','','list','main','','0','0','0','1','1398432798','1','0','');
INSERT INTO `pre_columns` VALUES('45','0','zui xin ren zheng ','最新认证','','list','main','','0','0','0','1','1398432859','1','0','');
INSERT INTO `pre_columns` VALUES('46','0','chan pin zhan shi ','产品展示','','logo','main','','0','0','0','1','1398432894','1','0','');
INSERT INTO `pre_columns` VALUES('47','39','ren cai zhan shi ','人才展示','','logo','main','','0','0','0','1','1398432928','1','0','');
INSERT INTO `pre_columns` VALUES('48','35','dai li shang jing xiao shang ','代理商经销商','','thumb','main','','0','0','0','1','1398432958','1','0','');
INSERT INTO `pre_columns` VALUES('49','0','tuan dui zhan shi ','团队展示','','logo','main','','0','0','0','1','1398433011','1','0','');
INSERT INTO `pre_columns` VALUES('50','40','xing ye zhan hui zi xun ','行业展会资讯','','list','main','','0','0','0','1','1398433036','1','0','');
INSERT INTO `pre_columns` VALUES('51','0','quan guo zhan hui xian chang ','全国展会现场','','logo','main','','0','0','0','1','1398433071','1','0','');
INSERT INTO `pre_columns` VALUES('52','0','ying xiao tuan dui zhan shi ','营销团队展示','','logo','main','','0','0','0','1','1398433110','1','0','');
INSERT INTO `pre_columns` VALUES('53','0','ying xiao mo shi ','营销模式','','list','main','','0','0','0','1','1398433146','1','0','');
INSERT INTO `pre_columns` VALUES('54','0','xin wen zi xun ','新闻资讯','','list','main','','0','0','0','1','1398433192','1','0','');
INSERT INTO `pre_columns` VALUES('55','0','hui xiao zi liao ','会销资料','','list','main','','0','0','0','1','1398433235','1','0','');
INSERT INTO `pre_columns` VALUES('57','46','shang jia zuo pin zhan shi ','商家作品展示','','thumb','topbar','','0','0','0','1','1398517153','0','0','');
INSERT INTO `pre_columns` VALUES('58','39','shang jia ren cai jie shao ','商家人才介绍','','logo','main','','0','0','0','1','1398585678','0','0','');
INSERT INTO `pre_columns` VALUES('59','0','guan yu wo men ','关于我们','','page','topbar','','0','0','0','1','1398590823','0','0','');

DROP TABLE IF EXISTS `pre_comments`;
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
  `ip` char(16) NOT NULL,
  `classify` char(16) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO `pre_comments` VALUES('5','51','5','','','好久没测试评论了','1','0','','','1398597894','2130706433','posts');
INSERT INTO `pre_comments` VALUES('6','55','5','','','这边就能评论呢 啊？','1','0','','','1398606890','2130706433','posts');
INSERT INTO `pre_comments` VALUES('7','55','5','','','看起来不错哦，哈哈哈哈哈','1','0','','','1398606902','2130706433','posts');
INSERT INTO `pre_comments` VALUES('8','54','5','','','这个重复利用率不高啊','1','0','','','1398607209','2130706433','posts');
INSERT INTO `pre_comments` VALUES('9','51','5','','','再来一个呢','1','0','','','1398608440','2130706433','posts');
INSERT INTO `pre_comments` VALUES('10','54','5','','','这个再加个呢','1','0','','','1398608455','2130706433','posts');

DROP TABLE IF EXISTS `pre_config`;
CREATE TABLE `pre_config` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `value` text,
  `description` varchar(255) NOT NULL default '',
  `classify` char(16) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=151 DEFAULT CHARSET=utf8;

INSERT INTO `pre_config` VALUES('150','version','Alpha 1.0','','baseinfo');
INSERT INTO `pre_config` VALUES('149','siteDesc','','','baseinfo');
INSERT INTO `pre_config` VALUES('8','address','重庆市江北观音桥','','siteinfo');
INSERT INTO `pre_config` VALUES('9','phone','023-12345678','','siteinfo');
INSERT INTO `pre_config` VALUES('10','email','admin@admin.com','','siteinfo');
INSERT INTO `pre_config` VALUES('11','beian','渝备12345678','','siteinfo');
INSERT INTO `pre_config` VALUES('12','copyright','2012-2013','','siteinfo');
INSERT INTO `pre_config` VALUES('148','siteKeywords','','','baseinfo');
INSERT INTO `pre_config` VALUES('15','imgUploadNum','1','','upload');
INSERT INTO `pre_config` VALUES('16','imgMinWidth','300','','upload');
INSERT INTO `pre_config` VALUES('17','imgMinHeight','300','','upload');
INSERT INTO `pre_config` VALUES('18','imgAllowTypes','*.jpg;*.png;*.jpeg','','upload');
INSERT INTO `pre_config` VALUES('19','imgThumbSize','124,200,300,600,origin','','upload');
INSERT INTO `pre_config` VALUES('20','imgMaxSize','1024000','','upload');
INSERT INTO `pre_config` VALUES('21','imgQuality','80','','upload');
INSERT INTO `pre_config` VALUES('146','domain','http://localhost','','baseinfo');
INSERT INTO `pre_config` VALUES('145','shortTitle','带上新的生活去旅行','','baseinfo');
INSERT INTO `pre_config` VALUES('144','sitename','新灵旅行','','baseinfo');
INSERT INTO `pre_config` VALUES('135','validateEmail','1','','base');
INSERT INTO `pre_config` VALUES('134','officalUid','','','base');
INSERT INTO `pre_config` VALUES('133','adminGroupIds','5,4','','base');
INSERT INTO `pre_config` VALUES('132','forbidnotshop','0','','base');
INSERT INTO `pre_config` VALUES('131','shopGroupId','7','','base');
INSERT INTO `pre_config` VALUES('128','closeSiteReason','系统正在维护中，请稍后再访问！','','base');
INSERT INTO `pre_config` VALUES('130','userDefaultGroup','6','','base');
INSERT INTO `pre_config` VALUES('129','mobile','1','','base');
INSERT INTO `pre_config` VALUES('127','closeSite','1','','base');
INSERT INTO `pre_config` VALUES('126','noticeall','近期收到举报，有部分网站有不良信息，望各位店家及时处理！','','base');
INSERT INTO `pre_config` VALUES('147','baseurl','http://localhost/huixiao/','','baseinfo');
INSERT INTO `pre_config` VALUES('143','indexpage','12@ads|13#12@ads|13#3@ads|0#3@ads|0#3@ads|0#3@ads|0#3@ads|0#3@ads|0#3@ads|0#3@ads|0#12@ads|0#4@45#4@41#4@42#12@44#3@ads|0#3@ads|0#3@ads|0#3@ads|0#3@ads|0#3@ads|0#3@ads|0#3@ads|0#12@ads|0#12@46#12@49#12@35#12@49#12@51#12@52#12@53#9@ads|0#3@ads|0#4@54#4@54#4@54#9@ads|0#3@ads|0#4@55#4@55#4@55#9@ads|0#3@ads|0','','indexpage');

DROP TABLE IF EXISTS `pre_group_powers`;
CREATE TABLE `pre_group_powers` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `gid` varchar(50) NOT NULL,
  `powers` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

INSERT INTO `pre_group_powers` VALUES('1','4','checksetting');
INSERT INTO `pre_group_powers` VALUES('2','4','setting');
INSERT INTO `pre_group_powers` VALUES('3','4','addcolumns');
INSERT INTO `pre_group_powers` VALUES('4','4','editcolumns');
INSERT INTO `pre_group_powers` VALUES('5','4','delcolumns');
INSERT INTO `pre_group_powers` VALUES('6','4','upload');
INSERT INTO `pre_group_powers` VALUES('7','4','editattachments');
INSERT INTO `pre_group_powers` VALUES('8','4','delattachments');
INSERT INTO `pre_group_powers` VALUES('9','4','edittags');
INSERT INTO `pre_group_powers` VALUES('10','4','deltags');
INSERT INTO `pre_group_powers` VALUES('11','4','editcomments');
INSERT INTO `pre_group_powers` VALUES('12','4','delcomments');
INSERT INTO `pre_group_powers` VALUES('13','5','checksetting');
INSERT INTO `pre_group_powers` VALUES('14','5','setting');
INSERT INTO `pre_group_powers` VALUES('15','5','addcolumns');
INSERT INTO `pre_group_powers` VALUES('16','5','editcolumns');
INSERT INTO `pre_group_powers` VALUES('17','5','delcolumns');
INSERT INTO `pre_group_powers` VALUES('18','5','addposts');
INSERT INTO `pre_group_powers` VALUES('19','5','editposts');
INSERT INTO `pre_group_powers` VALUES('20','5','delposts');
INSERT INTO `pre_group_powers` VALUES('21','5','addusergroup');
INSERT INTO `pre_group_powers` VALUES('22','5','editusergroup');
INSERT INTO `pre_group_powers` VALUES('23','5','delusergroup');
INSERT INTO `pre_group_powers` VALUES('24','5','addusers');
INSERT INTO `pre_group_powers` VALUES('25','5','editusers');
INSERT INTO `pre_group_powers` VALUES('26','5','delusers');
INSERT INTO `pre_group_powers` VALUES('27','5','addlink');
INSERT INTO `pre_group_powers` VALUES('28','5','editlink');
INSERT INTO `pre_group_powers` VALUES('29','5','dellink');
INSERT INTO `pre_group_powers` VALUES('30','5','addads');
INSERT INTO `pre_group_powers` VALUES('31','5','editads');
INSERT INTO `pre_group_powers` VALUES('32','5','delads');
INSERT INTO `pre_group_powers` VALUES('33','5','addalbum');
INSERT INTO `pre_group_powers` VALUES('34','5','editalbum');
INSERT INTO `pre_group_powers` VALUES('35','5','delalbum');
INSERT INTO `pre_group_powers` VALUES('36','5','upload');
INSERT INTO `pre_group_powers` VALUES('37','5','editattachments');
INSERT INTO `pre_group_powers` VALUES('38','5','delattachments');
INSERT INTO `pre_group_powers` VALUES('39','5','deluseraction');
INSERT INTO `pre_group_powers` VALUES('40','5','edittags');
INSERT INTO `pre_group_powers` VALUES('41','5','deltags');
INSERT INTO `pre_group_powers` VALUES('42','5','addcomments');
INSERT INTO `pre_group_powers` VALUES('43','5','editcomments');
INSERT INTO `pre_group_powers` VALUES('44','5','delcomments');
INSERT INTO `pre_group_powers` VALUES('45','5','addquestions');
INSERT INTO `pre_group_powers` VALUES('46','5','editquestions');
INSERT INTO `pre_group_powers` VALUES('47','5','delquestions');
INSERT INTO `pre_group_powers` VALUES('51','6','checksetting');
INSERT INTO `pre_group_powers` VALUES('52','7','addposts');

DROP TABLE IF EXISTS `pre_link`;
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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `pre_link` VALUES('4','新灵旅行','http://newsoul.cn','txt','0','1','0','0','1397996291','0');

DROP TABLE IF EXISTS `pre_posts`;
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
  `attachid` varchar(100) NOT NULL,
  `secretinfo` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

INSERT INTO `pre_posts` VALUES('49','57','5','','','哈哈展示','','','0','','','','','','<p>哎哟看起来不多见的发动机辅导费福建省副驾驶的积分的解放军是的发的说法搜到金粉世家佛说的叫法丰盛的见风使舵减肥的是福建省的金佛寺的积分的积分束带结发</p>','','','','40','0','1','1','0','1398569248','','');
INSERT INTO `pre_posts` VALUES('50','58','5','','','领军人物','','','0','','','','','','<p>怎么没有封顶佛剑分说的防静电非机动覅就桑德菲杰司法解释都副驾驶的见风使舵发送到金佛寺京东方的金粉世家的佛教是东方僵尸洞福建省地丰盛的封建时代&nbsp;</p>','','','','27','0','1','1','0','1398585791','','');
INSERT INTO `pre_posts` VALUES('51','59','5','','','勇往直前的一代','','','0','','','','','我们有理想有抱负','<p>富家大室就佛顶山金佛寺的建佛寺的见风使舵 的金佛is的金佛寺就电风扇的份上大绝地反击是的发送到放假的金佛山的金佛说的积分绝地逢</p><p>生的建佛寺的见风使舵</p><p>[attach]38[/attach]</p><p><br/></p><p><br/></p>','','','','26','0','1','1','0','1398590914','37','');
INSERT INTO `pre_posts` VALUES('54','55','2','','','重庆金源方特科幻公园都有什么？好玩么？','','','0','','','','','','<p style=\"word-wrap: break-word; padding: 0px; color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; font-size: 12px; line-height: 19.200000762939453px; white-space: normal;\">由于重庆主城区独有复杂的地理条件，目前重庆主城区内有一条跨江缆索轨道交通线，由重庆市客运索道公司运营，为1986年投入使用的重庆长江索道。缆索轨道作为城市交通工具在国内都是独有的。<br style=\"word-wrap: break-word;\"/></p><p style=\"word-wrap: break-word; padding: 0px; color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; font-size: 12px; line-height: 19.200000762939453px; white-space: normal;\">重庆长江索道于1986年建成投入使用，现属重庆市客运索道公司运营，全长2110米。<br style=\"word-wrap: break-word;\"/></p><p style=\"word-wrap: break-word; padding: 0px; color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; font-size: 12px; line-height: 19.200000762939453px; white-space: normal;\">价格：单程10元，来回20元；公交卡仅需1.8元（单程）。（2014年3月更新）<br style=\"word-wrap: break-word;\"/></p><p style=\"word-wrap: break-word; padding: 0px; color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; font-size: 12px; line-height: 19.200000762939453px; white-space: normal;\">地址：渝中区新华路153号</p><p style=\"word-wrap: break-word; padding: 0px; color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; font-size: 12px; line-height: 19.200000762939453px; white-space: normal;\">时间：07:00-22:00</p><p style=\"word-wrap: break-word; padding: 0px; color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; font-size: 12px; line-height: 19.200000762939453px; white-space: normal;\">感谢@CHELSEYCC的精美照片：</p><p style=\"word-wrap: break-word; padding: 0px; color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; font-size: 12px; line-height: 19.200000762939453px; white-space: normal;\"></p><div class=\"post_pic\" id=\"1003\" style=\"word-wrap: break-word; width: 600px; color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; font-size: 12px; line-height: 19.200000762939453px; white-space: normal;\"><a href=\"http://www.newsoul.cn/image/4c60776f.html\" target=\"_blank\" style=\"word-wrap: break-word; color: rgb(51, 119, 170);\"><img src=\"http://www.newsoul.cn/attachments/posts/600/1021/531efc64c162f.jpeg\" class=\"lazy\" data-original=\"http://www.newsoul.cn/attachments/posts/600/1021/531efc64c162f.jpeg\" width=\"550px\" height=\"366px\" style=\"word-wrap: break-word; border-style: none; display: inline;\"/></a><span class=\"fixed_bar\" id=\"favor1003\" style=\"word-wrap: break-word; float: right;\"><a class=\"\" style=\"word-wrap: break-word; color: rgb(202, 100, 69); width: 35px; clear: both; display: block; padding: 5px 0px 5px 2px; background-color: rgb(250, 233, 218); text-align: center; margin: 0px 0px 5px;\" href=\"http://\">0赞</a><a id=\"min_com_button_1003\" style=\"word-wrap: break-word; color: rgb(202, 100, 69); width: 35px; clear: both; display: block; padding: 5px 0px 5px 2px; background-color: rgb(250, 233, 218); text-align: center; margin: 0px 0px 5px;\" href=\"http://\">评论</a></span></div><p><br style=\"word-wrap: break-word; color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; font-size: 12px; line-height: 19.200000762939453px; white-space: normal;\"/></p><p style=\"word-wrap: break-word; padding: 0px; color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; font-size: 12px; line-height: 19.200000762939453px; white-space: normal;\"></p><p style=\"word-wrap: break-word; padding: 0px; color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; font-size: 12px; line-height: 19.200000762939453px; white-space: normal;\"></p><div class=\"post_pic\" id=\"1004\" style=\"word-wrap: break-word; width: 600px; color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; font-size: 12px; line-height: 19.200000762939453px; white-space: normal;\"><a href=\"http://www.newsoul.cn/image/4c607768.html\" target=\"_blank\" style=\"word-wrap: break-word; color: rgb(51, 119, 170);\"><img src=\"http://www.newsoul.cn/attachments/posts/600/1021/531efc8222e76.jpeg\" class=\"lazy\" data-original=\"http://www.newsoul.cn/attachments/posts/600/1021/531efc8222e76.jpeg\" width=\"550px\" height=\"366px\" style=\"word-wrap: break-word; border-style: none; display: inline;\"/></a><span class=\"fixed_bar\" id=\"favor1004\" style=\"word-wrap: break-word; float: right;\"><a class=\"\" style=\"word-wrap: break-word; color: rgb(202, 100, 69); width: 35px; clear: both; display: block; padding: 5px 0px 5px 2px; background-color: rgb(250, 233, 218); text-align: center; margin: 0px 0px 5px;\" href=\"http://\">0赞</a><a id=\"min_com_button_1004\" style=\"word-wrap: break-word; color: rgb(202, 100, 69); width: 35px; clear: both; display: block; padding: 5px 0px 5px 2px; background-color: rgb(250, 233, 218); text-align: center; margin: 0px 0px 5px;\" href=\"http://\">评论</a></span></div><p><br style=\"word-wrap: break-word; color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; font-size: 12px; line-height: 19.200000762939453px; white-space: normal;\"/></p><p style=\"word-wrap: break-word; padding: 0px; color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; font-size: 12px; line-height: 19.200000762939453px; white-space: normal;\"></p><p style=\"word-wrap: break-word; padding: 0px; color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; font-size: 12px; line-height: 19.200000762939453px; white-space: normal;\">这个缆车的速度还是比较快的，而且还有河风，一边看着夜景一边吹着风真是爽死了（如果在高峰期，人会很多，不容易占据最好的拍摄位置，最好的拍摄位置就是缆车迎风面）。<br style=\"word-wrap: break-word;\"/></p><p style=\"word-wrap: break-word; padding: 0px; color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; font-size: 12px; line-height: 19.200000762939453px; white-space: normal;\"></p><div class=\"post_pic\" id=\"1005\" style=\"word-wrap: break-word; width: 600px; color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; font-size: 12px; line-height: 19.200000762939453px; white-space: normal;\"><a href=\"http://www.newsoul.cn/image/4c607769.html\" target=\"_blank\" style=\"word-wrap: break-word; color: rgb(51, 119, 170);\"><img src=\"http://www.newsoul.cn/attachments/posts/600/1021/531efc94cd9f7.jpeg\" class=\"lazy\" data-original=\"http://www.newsoul.cn/attachments/posts/600/1021/531efc94cd9f7.jpeg\" width=\"550px\" height=\"366px\" style=\"word-wrap: break-word; border-style: none; display: inline;\"/></a><span class=\"fixed_bar\" id=\"favor1005\" style=\"word-wrap: break-word; float: right;\"><a class=\"\" style=\"word-wrap: break-word; color: rgb(202, 100, 69); width: 35px; clear: both; display: block; padding: 5px 0px 5px 2px; background-color: rgb(250, 233, 218); text-align: center; margin: 0px 0px 5px;\" href=\"http://\">0赞</a><a id=\"min_com_button_1005\" style=\"word-wrap: break-word; color: rgb(202, 100, 69); width: 35px; clear: both; display: block; padding: 5px 0px 5px 2px; background-color: rgb(250, 233, 218); text-align: center; margin: 0px 0px 5px;\" href=\"http://\">评论</a></span></div><p style=\"word-wrap: break-word; padding: 0px; color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; font-size: 12px; line-height: 19.200000762939453px; white-space: normal;\"></p><p style=\"word-wrap: break-word; padding: 0px; color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; font-size: 12px; line-height: 19.200000762939453px; white-space: normal;\">重庆的夜景是不是还不错？要拍到这样的景色也不是那么容易的，天气好是一方面，另外得在南岸区观看渝中半岛才行。行程可安排为：逛解放碑，坐长江索道，逛南滨路，再回解放碑。</p><p style=\"word-wrap: break-word; padding: 0px; color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; font-size: 12px; line-height: 19.200000762939453px; white-space: normal;\"></p><div class=\"post_pic\" id=\"1006\" style=\"word-wrap: break-word; width: 600px; color: rgb(0, 0, 0); font-family: arial, helvetica, sans-serif; font-size: 12px; line-height: 19.200000762939453px; white-space: normal;\"><a href=\"http://www.newsoul.cn/image/4c60776a.html\" target=\"_blank\" style=\"word-wrap: break-word; color: rgb(51, 119, 170);\"><img src=\"http://www.newsoul.cn/attachments/posts/600/1021/531efca0e98f1.jpeg\" class=\"lazy\" data-original=\"http://www.newsoul.cn/attachments/posts/600/1021/531efca0e98f1.jpeg\" width=\"550px\" height=\"366px\" style=\"word-wrap: break-word; border-style: none; display: inline;\"/></a></div><p><br/></p>','','','','18','0','1','1','0','1398601960','','');
INSERT INTO `pre_posts` VALUES('55','57','5','','','未编辑','','','0','','','','','','<p style=\"padding: 0px; color: rgb(0, 0, 0); font-size: 12px; line-height: 19.200000762939453px; white-space: normal;\">重庆轻轨（单轨）和重庆地铁都是重庆轨道交通的重要组成部分，在重庆目前运营和动工的四条轨道交通线路为轨道1、2、3、6号线。</p><p style=\"padding: 0px; color: rgb(0, 0, 0); font-size: 12px; line-height: 19.200000762939453px; white-space: normal;\">重庆市轨道交通实行一人一票制，乘客每次乘车从刷卡入站到出站，在站时限不得超过180分钟，换乘最高票价9元。</p><p style=\"padding: 0px; color: rgb(0, 0, 0); font-size: 12px; line-height: 19.200000762939453px; white-space: normal;\">1号线：东起“朝天门”，西至“大学城”，远期将延伸至璧山，全长约46km；</p><p style=\"padding: 0px; color: rgb(0, 0, 0); font-size: 12px; line-height: 19.200000762939453px; white-space: normal;\">2号线：东起市中心“较场口”，西至大渡口区钢铁基地“新山村”，全长19.15km。首末班时间为6:30-22:30，全线共18个车站，实行分段计价，票价2—5元；</p><p style=\"padding: 0px; color: rgb(0, 0, 0); font-size: 12px; line-height: 19.200000762939453px; white-space: normal;\">3号线：已开通从“鱼洞”到“江北机场”的线路，运行全程需94分钟，成为目前世界上最长的一条跨座式单轨交通线路，首末班时间为6:30-22:30，实行分段计价，2-9元，龙头寺站于2013年2月4日正式开通。轻轨3号线设有“重庆北站”和“龙头寺站”，两站相距约1km，“重庆北站”目前已开通。需注意的是，前往重庆火车北站的乘客请在“重庆北站”下车；</p><p style=\"padding: 0px; color: rgb(0, 0, 0); font-size: 12px; line-height: 19.200000762939453px; white-space: normal;\">6号线：起于南岸区茶园城市副中心，止于北碚区老城，并设礼嘉至悦来支线。目前已开通五里店至礼嘉段，运营时间为6:30-22:30，具体站点为礼嘉——九曲河——康庄——大竹林——光电园——冉家坝——大龙山——花卉园——红旗河沟——黄泥塝——红土地——五里店。冉家坝车站已于2013年1月20日正式开通营运，可以在此乘坐6号线列车，并可在红旗河沟换乘轨道3号线。</p><p><br/></p>','','','','6','0','1','1','0','1398606410','39','');

DROP TABLE IF EXISTS `pre_questions`;
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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `pre_questions` VALUES('3','2','0','','','','','你们到底什么时候上线啊？','','1','感谢您的支持，我们会在最近上线。','1','1398517390');

DROP TABLE IF EXISTS `pre_user_action`;
CREATE TABLE `pre_user_action` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `uid` int(11) unsigned NOT NULL,
  `logid` int(11) unsigned NOT NULL,
  `classify` char(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  `cTime` int(11) unsigned NOT NULL,
  `ip` char(16) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=152 DEFAULT CHARSET=utf8;

INSERT INTO `pre_user_action` VALUES('1','2','16','editcolumns','编辑栏目','1395747327','2130706433');
INSERT INTO `pre_user_action` VALUES('2','2','17','editcolumns','编辑栏目','1395747351','2130706433');
INSERT INTO `pre_user_action` VALUES('3','2','18','editcolumns','编辑栏目','1395747369','2130706433');
INSERT INTO `pre_user_action` VALUES('4','2','0','setting','更新设置','1395748048','2130706433');
INSERT INTO `pre_user_action` VALUES('5','2','0','setting','更新设置','1395748061','2130706433');
INSERT INTO `pre_user_action` VALUES('6','2','0','setting','更新设置','1395748082','2130706433');
INSERT INTO `pre_user_action` VALUES('7','2','0','setting','更新设置','1395748165','2130706433');
INSERT INTO `pre_user_action` VALUES('8','2','0','setting','更新设置','1395748216','2130706433');
INSERT INTO `pre_user_action` VALUES('9','2','19','editcolumns','编辑栏目','1395748313','2130706433');
INSERT INTO `pre_user_action` VALUES('10','2','0','setting','更新设置','1395748842','2130706433');
INSERT INTO `pre_user_action` VALUES('11','2','0','setting','更新设置','1395748946','2130706433');
INSERT INTO `pre_user_action` VALUES('12','2','0','setting','更新设置','1395749476','2130706433');
INSERT INTO `pre_user_action` VALUES('13','2','27','editposts','编辑文章','1395749541','2130706433');
INSERT INTO `pre_user_action` VALUES('14','2','28','editposts','编辑文章','1395749560','2130706433');
INSERT INTO `pre_user_action` VALUES('15','2','29','editposts','编辑文章','1395751159','2130706433');
INSERT INTO `pre_user_action` VALUES('16','2','6','editads','新增展示','1395751348','2130706433');
INSERT INTO `pre_user_action` VALUES('17','2','7','editads','新增展示','1395751383','2130706433');
INSERT INTO `pre_user_action` VALUES('18','2','8','editads','新增展示','1395751448','2130706433');
INSERT INTO `pre_user_action` VALUES('19','2','0','delcolumns','删除栏目','1396792988','2130706433');
INSERT INTO `pre_user_action` VALUES('20','2','0','delcolumns','删除栏目','1396793007','2130706433');
INSERT INTO `pre_user_action` VALUES('21','2','0','delcolumns','删除栏目','1396793102','2130706433');
INSERT INTO `pre_user_action` VALUES('22','2','0','delcolumns','删除栏目','1396793109','2130706433');
INSERT INTO `pre_user_action` VALUES('23','2','0','delposts','删除文章','1396793454','2130706433');
INSERT INTO `pre_user_action` VALUES('24','2','0','delposts','删除文章','1396793511','2130706433');
INSERT INTO `pre_user_action` VALUES('25','2','0','delposts','删除文章','1396793513','2130706433');
INSERT INTO `pre_user_action` VALUES('26','2','0','setting','更新设置','1396852817','2130706433');
INSERT INTO `pre_user_action` VALUES('27','2','0','setting','更新设置','1396852860','2130706433');
INSERT INTO `pre_user_action` VALUES('28','2','0','delads','删除展示','1397051148','2130706433');
INSERT INTO `pre_user_action` VALUES('29','2','0','delads','删除展示','1397051151','2130706433');
INSERT INTO `pre_user_action` VALUES('30','2','0','delads','删除展示','1397051153','2130706433');
INSERT INTO `pre_user_action` VALUES('31','2','20','editcolumns','编辑栏目','1397142168','2130706433');
INSERT INTO `pre_user_action` VALUES('32','2','21','editcolumns','编辑栏目','1397142705','2130706433');
INSERT INTO `pre_user_action` VALUES('33','2','22','editcolumns','编辑栏目','1397142725','2130706433');
INSERT INTO `pre_user_action` VALUES('34','2','23','editcolumns','编辑栏目','1397142741','2130706433');
INSERT INTO `pre_user_action` VALUES('35','2','24','editcolumns','编辑栏目','1397142759','2130706433');
INSERT INTO `pre_user_action` VALUES('36','2','25','editcolumns','编辑栏目','1397142771','2130706433');
INSERT INTO `pre_user_action` VALUES('37','2','26','editcolumns','编辑栏目','1397221949','2130706433');
INSERT INTO `pre_user_action` VALUES('38','2','27','editcolumns','编辑栏目','1397222004','2130706433');
INSERT INTO `pre_user_action` VALUES('39','2','31','editposts','编辑文章','1397224774','2130706433');
INSERT INTO `pre_user_action` VALUES('40','2','31','editposts','编辑文章','1397226905','2130706433');
INSERT INTO `pre_user_action` VALUES('41','2','32','editposts','编辑文章','1397358160','2130706433');
INSERT INTO `pre_user_action` VALUES('42','2','33','editposts','编辑文章','1397358253','2130706433');
INSERT INTO `pre_user_action` VALUES('43','2','24','editcolumns','编辑栏目','1397358291','2130706433');
INSERT INTO `pre_user_action` VALUES('44','2','34','editposts','编辑文章','1397358331','2130706433');
INSERT INTO `pre_user_action` VALUES('45','2','35','editposts','编辑文章','1397359145','2130706433');
INSERT INTO `pre_user_action` VALUES('46','2','34','editposts','编辑文章','1397362455','2130706433');
INSERT INTO `pre_user_action` VALUES('47','2','34','editposts','编辑文章','1397387624','2130706433');
INSERT INTO `pre_user_action` VALUES('48','2','0','setting','更新设置','1397388867','2130706433');
INSERT INTO `pre_user_action` VALUES('49','2','36','editposts','编辑文章','1397394771','2130706433');
INSERT INTO `pre_user_action` VALUES('50','2','36','editposts','编辑文章','1397395427','2130706433');
INSERT INTO `pre_user_action` VALUES('51','2','28','editcolumns','编辑栏目','1397397047','2130706433');
INSERT INTO `pre_user_action` VALUES('52','2','37','editposts','编辑文章','1397397102','2130706433');
INSERT INTO `pre_user_action` VALUES('53','2','0','setting','更新设置','1397574827','2130706433');
INSERT INTO `pre_user_action` VALUES('54','2','0','setting','更新设置','1397745439','2130706433');
INSERT INTO `pre_user_action` VALUES('55','5','6','editusergroup','编辑用户组','1397832553','2130706433');
INSERT INTO `pre_user_action` VALUES('56','5','7','editusergroup','编辑用户组','1397832756','2130706433');
INSERT INTO `pre_user_action` VALUES('57','5','4','editusers','编辑用户','1397833042','2130706433');
INSERT INTO `pre_user_action` VALUES('58','2','4','editusers','编辑用户','1397833190','2130706433');
INSERT INTO `pre_user_action` VALUES('59','2','0','setting','更新设置','1397919065','2130706433');
INSERT INTO `pre_user_action` VALUES('60','2','6','editusergroup','编辑用户组','1397919180','2130706433');
INSERT INTO `pre_user_action` VALUES('61','2','6','editusergroup','编辑用户组','1397919200','2130706433');
INSERT INTO `pre_user_action` VALUES('62','2','6','editusergroup','编辑用户组','1397919342','2130706433');
INSERT INTO `pre_user_action` VALUES('63','2','6','editusergroup','编辑用户组','1397919360','2130706433');
INSERT INTO `pre_user_action` VALUES('64','2','6','editusergroup','编辑用户组','1397919364','2130706433');
INSERT INTO `pre_user_action` VALUES('65','2','0','setting','更新设置','1397919505','2130706433');
INSERT INTO `pre_user_action` VALUES('66','2','0','setting','更新设置','1397919820','2130706433');
INSERT INTO `pre_user_action` VALUES('67','2','0','delusers','删除用户','1397974731','2130706433');
INSERT INTO `pre_user_action` VALUES('68','2','0','delattachments','删除附件','1397982106','2130706433');
INSERT INTO `pre_user_action` VALUES('69','2','0','delattachments','删除附件','1397982316','2130706433');
INSERT INTO `pre_user_action` VALUES('70','2','0','delattachments','删除附件','1397982451','2130706433');
INSERT INTO `pre_user_action` VALUES('71','2','0','delattachments','删除附件','1397982541','2130706433');
INSERT INTO `pre_user_action` VALUES('72','2','0','delattachments','删除附件','1397982545','2130706433');
INSERT INTO `pre_user_action` VALUES('73','2','0','delattachments','删除附件','1397982561','2130706433');
INSERT INTO `pre_user_action` VALUES('74','2','0','delattachments','删除附件','1397982564','2130706433');
INSERT INTO `pre_user_action` VALUES('75','2','0','delads','删除展示','1397982581','2130706433');
INSERT INTO `pre_user_action` VALUES('76','2','0','delposts','删除文章','1397982596','2130706433');
INSERT INTO `pre_user_action` VALUES('77','2','4','editlink','编辑友链','1398000646','2130706433');
INSERT INTO `pre_user_action` VALUES('78','2','29','editcolumns','编辑栏目','1398345438','2130706433');
INSERT INTO `pre_user_action` VALUES('79','2','30','editcolumns','编辑栏目','1398345959','2130706433');
INSERT INTO `pre_user_action` VALUES('80','2','39','editposts','编辑文章','1398347727','2130706433');
INSERT INTO `pre_user_action` VALUES('81','2','38','editposts','编辑文章','1398348294','2130706433');
INSERT INTO `pre_user_action` VALUES('82','2','38','editposts','编辑文章','1398348379','2130706433');
INSERT INTO `pre_user_action` VALUES('83','2','40','editposts','编辑文章','1398349334','2130706433');
INSERT INTO `pre_user_action` VALUES('84','2','41','editposts','编辑文章','1398349498','2130706433');
INSERT INTO `pre_user_action` VALUES('85','2','42','editposts','编辑文章','1398349527','2130706433');
INSERT INTO `pre_user_action` VALUES('86','2','42','editposts','编辑文章','1398349540','2130706433');
INSERT INTO `pre_user_action` VALUES('87','2','43','editposts','编辑文章','1398349595','2130706433');
INSERT INTO `pre_user_action` VALUES('88','2','31','editcolumns','编辑栏目','1398350065','2130706433');
INSERT INTO `pre_user_action` VALUES('89','2','44','editposts','编辑文章','1398350106','2130706433');
INSERT INTO `pre_user_action` VALUES('90','2','45','editposts','编辑文章','1398350204','2130706433');
INSERT INTO `pre_user_action` VALUES('91','2','46','editposts','编辑文章','1398350249','2130706433');
INSERT INTO `pre_user_action` VALUES('92','2','47','editposts','编辑文章','1398350276','2130706433');
INSERT INTO `pre_user_action` VALUES('93','2','47','editposts','编辑文章','1398350286','2130706433');
INSERT INTO `pre_user_action` VALUES('94','2','0','delposts','删除文章','1398432060','2130706433');
INSERT INTO `pre_user_action` VALUES('95','2','0','delattachments','删除附件','1398432081','2130706433');
INSERT INTO `pre_user_action` VALUES('96','2','0','delads','删除展示','1398432088','2130706433');
INSERT INTO `pre_user_action` VALUES('97','2','0','delcolumns','删除栏目','1398432102','2130706433');
INSERT INTO `pre_user_action` VALUES('98','2','0','setting','更新设置','1398432199','2130706433');
INSERT INTO `pre_user_action` VALUES('99','2','32','editcolumns','编辑栏目','1398432272','2130706433');
INSERT INTO `pre_user_action` VALUES('100','2','33','editcolumns','编辑栏目','1398432294','2130706433');
INSERT INTO `pre_user_action` VALUES('101','2','34','editcolumns','编辑栏目','1398432317','2130706433');
INSERT INTO `pre_user_action` VALUES('102','2','35','editcolumns','编辑栏目','1398432338','2130706433');
INSERT INTO `pre_user_action` VALUES('103','2','36','editcolumns','编辑栏目','1398432398','2130706433');
INSERT INTO `pre_user_action` VALUES('104','2','37','editcolumns','编辑栏目','1398432423','2130706433');
INSERT INTO `pre_user_action` VALUES('105','2','38','editcolumns','编辑栏目','1398432445','2130706433');
INSERT INTO `pre_user_action` VALUES('106','2','39','editcolumns','编辑栏目','1398432464','2130706433');
INSERT INTO `pre_user_action` VALUES('107','2','40','editcolumns','编辑栏目','1398432484','2130706433');
INSERT INTO `pre_user_action` VALUES('108','2','41','editcolumns','编辑栏目','1398432712','2130706433');
INSERT INTO `pre_user_action` VALUES('109','2','42','editcolumns','编辑栏目','1398432732','2130706433');
INSERT INTO `pre_user_action` VALUES('110','2','43','editcolumns','编辑栏目','1398432768','2130706433');
INSERT INTO `pre_user_action` VALUES('111','2','44','editcolumns','编辑栏目','1398432817','2130706433');
INSERT INTO `pre_user_action` VALUES('112','2','45','editcolumns','编辑栏目','1398432872','2130706433');
INSERT INTO `pre_user_action` VALUES('113','2','46','editcolumns','编辑栏目','1398432908','2130706433');
INSERT INTO `pre_user_action` VALUES('114','2','47','editcolumns','编辑栏目','1398432942','2130706433');
INSERT INTO `pre_user_action` VALUES('115','2','48','editcolumns','编辑栏目','1398432999','2130706433');
INSERT INTO `pre_user_action` VALUES('116','2','49','editcolumns','编辑栏目','1398433026','2130706433');
INSERT INTO `pre_user_action` VALUES('117','2','50','editcolumns','编辑栏目','1398433053','2130706433');
INSERT INTO `pre_user_action` VALUES('118','2','51','editcolumns','编辑栏目','1398433094','2130706433');
INSERT INTO `pre_user_action` VALUES('119','2','52','editcolumns','编辑栏目','1398433125','2130706433');
INSERT INTO `pre_user_action` VALUES('120','2','53','editcolumns','编辑栏目','1398433166','2130706433');
INSERT INTO `pre_user_action` VALUES('121','2','54','editcolumns','编辑栏目','1398433206','2130706433');
INSERT INTO `pre_user_action` VALUES('122','2','55','editcolumns','编辑栏目','1398433251','2130706433');
INSERT INTO `pre_user_action` VALUES('123','2','56','editcolumns','编辑栏目','1398433351','2130706433');
INSERT INTO `pre_user_action` VALUES('124','2','0','delcolumns','删除栏目','1398433364','2130706433');
INSERT INTO `pre_user_action` VALUES('125','2','0','setting','更新设置','1398434084','2130706433');
INSERT INTO `pre_user_action` VALUES('126','2','57','editcolumns','编辑栏目','1398517194','2130706433');
INSERT INTO `pre_user_action` VALUES('127','2','0','setting','更新设置','1398517722','2130706433');
INSERT INTO `pre_user_action` VALUES('128','2','0','setting','更新设置','1398518289','2130706433');
INSERT INTO `pre_user_action` VALUES('129','2','0','setting','更新设置','1398518387','2130706433');
INSERT INTO `pre_user_action` VALUES('130','2','0','setting','更新设置','1398518475','2130706433');
INSERT INTO `pre_user_action` VALUES('131','2','0','setting','更新设置','1398518527','2130706433');
INSERT INTO `pre_user_action` VALUES('132','2','0','setting','更新设置','1398518537','2130706433');
INSERT INTO `pre_user_action` VALUES('133','2','0','setting','更新设置','1398518552','2130706433');
INSERT INTO `pre_user_action` VALUES('134','2','0','setting','更新设置','1398518571','2130706433');
INSERT INTO `pre_user_action` VALUES('135','2','0','setting','更新设置','1398518601','2130706433');
INSERT INTO `pre_user_action` VALUES('136','2','0','setting','更新设置','1398519017','2130706433');
INSERT INTO `pre_user_action` VALUES('137','2','4','editusers','编辑用户','1398519772','2130706433');
INSERT INTO `pre_user_action` VALUES('138','2','4','editusers','编辑用户','1398519785','2130706433');
INSERT INTO `pre_user_action` VALUES('139','2','7','editusergroup','编辑用户组','1398520556','2130706433');
INSERT INTO `pre_user_action` VALUES('140','2','0','setting','更新设置','1398523626','2130706433');
INSERT INTO `pre_user_action` VALUES('141','2','5','editusers','编辑用户','1398567225','2130706433');
INSERT INTO `pre_user_action` VALUES('142','2','0','setting','更新设置','1398567407','2130706433');
INSERT INTO `pre_user_action` VALUES('143','5','0','delads','删除展示','1398569993','2130706433');
INSERT INTO `pre_user_action` VALUES('144','5','0','delads','删除展示','1398570049','2130706433');
INSERT INTO `pre_user_action` VALUES('145','5','0','delads','删除展示','1398570069','2130706433');
INSERT INTO `pre_user_action` VALUES('146','2','58','editcolumns','编辑栏目','1398585713','2130706433');
INSERT INTO `pre_user_action` VALUES('147','2','59','editcolumns','编辑栏目','1398590859','2130706433');
INSERT INTO `pre_user_action` VALUES('148','2','54','editposts','编辑文章','1398602357','2130706433');
INSERT INTO `pre_user_action` VALUES('149','2','54','editposts','编辑文章','1398602374','2130706433');
INSERT INTO `pre_user_action` VALUES('150','2','0','setting','更新设置','1398784096','2130706433');
INSERT INTO `pre_user_action` VALUES('151','2','0','setting','更新设置','1398913203','2130706433');

DROP TABLE IF EXISTS `pre_user_group`;
CREATE TABLE `pre_user_group` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(50) NOT NULL,
  `powers` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `cTime` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO `pre_user_group` VALUES('5','系统','zmf','1','1383321578');
INSERT INTO `pre_user_group` VALUES('4','管理员','zmf','1','1383317395');
INSERT INTO `pre_user_group` VALUES('6','待激活','zmf','1','1397832525');
INSERT INTO `pre_user_group` VALUES('7','注册商家','zmf','1','1397832650');
INSERT INTO `pre_user_group` VALUES('8','','','0','1397832850');

DROP TABLE IF EXISTS `pre_user_info`;
CREATE TABLE `pre_user_info` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `uid` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `classify` char(16) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=123 DEFAULT CHARSET=utf8;

INSERT INTO `pre_user_info` VALUES('101','2','column','57','column');
INSERT INTO `pre_user_info` VALUES('88','2','service_aim_en','Commitment to enhance customer brand image,customer business goals!','base');
INSERT INTO `pre_user_info` VALUES('82','2','domain','http://www.newsoul.cn','base');
INSERT INTO `pre_user_info` VALUES('83','2','baseurl','http://localhost/wifi/','base');
INSERT INTO `pre_user_info` VALUES('84','2','siteKeywords','美文客户见附件','base');
INSERT INTO `pre_user_info` VALUES('85','2','siteDesc','的发的说法的说法的说法的的冯绍峰的方式大幅桑德福的说法','base');
INSERT INTO `pre_user_info` VALUES('87','2','service_aim_cn','致力于提升客户品牌形象、实现客户商业目标!','base');
INSERT INTO `pre_user_info` VALUES('99','2','copyright','©2012-2013','siteinfo');
INSERT INTO `pre_user_info` VALUES('98','2','beian','渝备12345678','siteinfo');
INSERT INTO `pre_user_info` VALUES('96','2','phone','023-12345678','siteinfo');
INSERT INTO `pre_user_info` VALUES('97','2','email','ph7pal@qq.com','siteinfo');
INSERT INTO `pre_user_info` VALUES('86','2','version','Alpha 1.0','base');
INSERT INTO `pre_user_info` VALUES('80','2','sitename','新灵旅行','base');
INSERT INTO `pre_user_info` VALUES('81','2','shortTitle','带上新的生活去旅行','base');
INSERT INTO `pre_user_info` VALUES('50','2','1','11','weekly');
INSERT INTO `pre_user_info` VALUES('51','2','2','48','weekly');
INSERT INTO `pre_user_info` VALUES('52','2','3','1','weekly');
INSERT INTO `pre_user_info` VALUES('53','2','4','2','weekly');
INSERT INTO `pre_user_info` VALUES('54','2','5','1','weekly');
INSERT INTO `pre_user_info` VALUES('55','2','6','5','weekly');
INSERT INTO `pre_user_info` VALUES('56','2','7','10','weekly');
INSERT INTO `pre_user_info` VALUES('95','2','address','重庆市江北观音桥','siteinfo');
INSERT INTO `pre_user_info` VALUES('94','2','company','新灵旅行','siteinfo');
INSERT INTO `pre_user_info` VALUES('79','2','mobile','1','base');
INSERT INTO `pre_user_info` VALUES('78','2','closeSiteReason','哈哈哈就是不给你看','base');
INSERT INTO `pre_user_info` VALUES('76','2','logo','924a','base');
INSERT INTO `pre_user_info` VALUES('77','2','closeSite','1','base');
INSERT INTO `pre_user_info` VALUES('93','2','bgcolor','#99cc00','template');
INSERT INTO `pre_user_info` VALUES('92','2','align_bg','0','template');
INSERT INTO `pre_user_info` VALUES('100','2','4','23','yearly');
INSERT INTO `pre_user_info` VALUES('102','5','code','d5535d6a132489a1143a467271928433','emailcode');
INSERT INTO `pre_user_info` VALUES('115','5','shortTitle','时尚生活馆','base');
INSERT INTO `pre_user_info` VALUES('114','5','sitename','阿飞馆','base');
INSERT INTO `pre_user_info` VALUES('113','5','closeSite','1','base');
INSERT INTO `pre_user_info` VALUES('107','5','7','240','weekly');
INSERT INTO `pre_user_info` VALUES('108','5','4','243','yearly');
INSERT INTO `pre_user_info` VALUES('109','5','company','聚易开放式技术实验室','siteinfo');
INSERT INTO `pre_user_info` VALUES('110','5','address','  联想集团RKA业务《号角》电子杂志','siteinfo');
INSERT INTO `pre_user_info` VALUES('111','5','phone','023-12345678','siteinfo');
INSERT INTO `pre_user_info` VALUES('120','5','column','57,58,59','column');
INSERT INTO `pre_user_info` VALUES('116','5','service_aim_cn','致力于提升客户品牌形象、实现客户商业目标!','base');
INSERT INTO `pre_user_info` VALUES('117','5','service_aim_en','Commitment to enhance customer brand image,customer business goals!','base');
INSERT INTO `pre_user_info` VALUES('121','5','2','3','weekly');
INSERT INTO `pre_user_info` VALUES('122','2','code','2d06971e09d3f743e10e8edb216051a2','emailcode');

DROP TABLE IF EXISTS `pre_users`;
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
  `emailstatus` tinyint(1) NOT NULL,
  `system` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO `pre_users` VALUES('2','admin','d006e37c5d52563596bf37e581fdbb11','管理员','5','ph7pal@qq.com','12345678','12345678901','1234567','2130706433','1398602197','9','1','1383317699','0','0');
INSERT INTO `pre_users` VALUES('4','test1','e10adc3949ba59abbe56e057f20f883e','广告','6','ph7pal@qq.com','1125616251','18716690740','1234567','2130706433','1398522715','1','1','1397746324','0','0');
INSERT INTO `pre_users` VALUES('5','test2','e10adc3949ba59abbe56e057f20f883e','阿飞','7','ph7pal@qq.com','','','','2130706433','1398606403','8','1','1397746599','1','0');
INSERT INTO `pre_users` VALUES('6','','','','0','','','','','','0','0','0','1398255573','0','0');

