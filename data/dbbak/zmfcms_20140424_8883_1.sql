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
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO `pre_ads` VALUES('12','全屏美女','','40','','','','0','0','0','topbar','0','1','1397557506','flash','2');
INSERT INTO `pre_ads` VALUES('10','全屏美女','','38','','','','0','0','0','topbar','0','1','1397557184','flash','2');
INSERT INTO `pre_ads` VALUES('11','全屏美女','','39','','','','0','0','0','topbar','0','1','1397557273','flash','2');

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
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;


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
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

INSERT INTO `pre_attachments` VALUES('12','2','27','533172a188dd8.jpg','533172a188dd8.jpg','','0','0','coverimg','0','0','1395749537','1');
INSERT INTO `pre_attachments` VALUES('13','2','28','533172b5f1ec4.jpg','533172b5f1ec4.jpg','','0','0','coverimg','0','0','1395749557','1');
INSERT INTO `pre_attachments` VALUES('14','2','6','533179b08b09c.jpg','533179b08b09c.jpg','','0','0','ads','0','0','1395751344','1');
INSERT INTO `pre_attachments` VALUES('15','2','7','533179d2ecdc7.jpg','533179d2ecdc7.jpg','','0','0','ads','0','0','1395751378','1');
INSERT INTO `pre_attachments` VALUES('16','2','8','53317a142d1c7.jpg','53317a142d1c7.jpg','','0','0','ads','0','0','1395751444','1');
INSERT INTO `pre_attachments` VALUES('17','2','33','5348bd0425317.jpg','5348bd0425317.jpg','','0','0','posts','0','0','1397275908','1');
INSERT INTO `pre_attachments` VALUES('18','2','33','5348bd1b6e5e2.jpg','5348bd1b6e5e2.jpg','','0','0','posts','0','0','1397275931','1');
INSERT INTO `pre_attachments` VALUES('19','2','33','5348be3607ef4.jpg','5348be3607ef4.jpg','','0','0','posts','0','0','1397276214','1');
INSERT INTO `pre_attachments` VALUES('20','2','33','5348bf080874f.jpg','5348bf080874f.jpg','','0','0','posts','0','0','1397276424','1');
INSERT INTO `pre_attachments` VALUES('21','2','33','5348bfee9f5a6.jpg','5348bfee9f5a6.jpg','','0','0','posts','0','0','1397276654','1');
INSERT INTO `pre_attachments` VALUES('22','2','33','5348c0295b29f.jpg','5348c0295b29f.jpg','','0','0','posts','0','0','1397276713','1');
INSERT INTO `pre_attachments` VALUES('23','2','33','5348c0826098c.jpg','5348c0826098c.jpg','','0','0','posts','0','0','1397276802','1');
INSERT INTO `pre_attachments` VALUES('24','2','33','5348c22e47a03.jpg','5348c22e47a03.jpg','','0','0','posts','0','0','1397277230','1');
INSERT INTO `pre_attachments` VALUES('25','2','33','5348e71ee1aa8.jpg','5348e71ee1aa8.jpg','','0','0','posts','0','0','1397286686','1');
INSERT INTO `pre_attachments` VALUES('26','2','9','534b5a80998f1.jpg','534b5a80998f1.jpg','','0','0','ads','0','0','1397447296','3');
INSERT INTO `pre_attachments` VALUES('27','2','9','534b5b268c745.jpg','534b5b268c745.jpg','','0','0','ads','0','0','1397447462','3');
INSERT INTO `pre_attachments` VALUES('28','2','9','534b5c205b74b.jpg','534b5c205b74b.jpg','','0','0','ads','0','0','1397447712','3');
INSERT INTO `pre_attachments` VALUES('29','2','9','534b5cbd22894.jpg','534b5cbd22894.jpg','','0','0','ads','0','0','1397447869','3');
INSERT INTO `pre_attachments` VALUES('30','2','9','534b5e4a208d5.jpg','534b5e4a208d5.jpg','','0','0','ads','0','0','1397448266','1');
INSERT INTO `pre_attachments` VALUES('31','2','34','534b612fdec65.jpg','534b612fdec65.jpg','','0','0','posts','0','0','1397449007','3');
INSERT INTO `pre_attachments` VALUES('32','2','34','534b615056bd4.jpg','534b615056bd4.jpg','','0','0','coverimg','0','0','1397449040','3');
INSERT INTO `pre_attachments` VALUES('33','2','34','534b63269543b.jpg','534b63269543b.jpg','','0','0','posts','0','0','1397449510','3');
INSERT INTO `pre_attachments` VALUES('34','2','34','534b642b65ef5.jpg','534b642b65ef5.jpg','','0','0','posts','0','0','1397449771','3');
INSERT INTO `pre_attachments` VALUES('35','2','34','534b718ba8828.jpg','534b718ba8828.jpg','','0','0','posts','0','0','1397453195','3');
INSERT INTO `pre_attachments` VALUES('36','2','34','534b71f792e46.jpg','534b71f792e46.jpg','','0','0','posts','0','0','1397453303','1');
INSERT INTO `pre_attachments` VALUES('37','2','34','534b789ef2abc.jpg','534b789ef2abc.jpg','','0','0','posts','0','0','1397455006','1');
INSERT INTO `pre_attachments` VALUES('38','2','10','534d07d7a1418.jpg','534d07d7a1418.jpg','','0','0','ads','0','0','1397557207','1');
INSERT INTO `pre_attachments` VALUES('39','2','11','534d0833640f5.jpg','534d0833640f5.jpg','','0','0','ads','0','0','1397557299','1');
INSERT INTO `pre_attachments` VALUES('40','2','12','534d09101cf72.jpg','534d09101cf72.jpg','','0','0','ads','0','0','1397557520','1');
INSERT INTO `pre_attachments` VALUES('41','2','2','534e2b634af3e.jpg','534e2b634af3e.jpg','','0','0','logo','0','0','1397631843','1');

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
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

INSERT INTO `pre_columns` VALUES('21','0','zhan shi ','展示','','logo','topbar','','0','0','0','1','1397142680','0');
INSERT INTO `pre_columns` VALUES('22','0','liu yan ','留言','','page','topbar','','0','0','0','1','1397142710','0');
INSERT INTO `pre_columns` VALUES('23','0','guan yu wo men ','关于我们','','page','topbar','','0','0','0','1','1397142728','0');
INSERT INTO `pre_columns` VALUES('20','0','huo dong ','活动','','page','topbar','','0','0','0','1','1396705594','0');
INSERT INTO `pre_columns` VALUES('24','0','cai dan ','菜单','','page','topbar','','0','0','0','1','1397142752','0');
INSERT INTO `pre_columns` VALUES('25','0','shi yong shui ming ','使用说明','','page','topbar','','0','0','0','1','1397142761','0');
INSERT INTO `pre_columns` VALUES('26','0','an li zhan shi ','案例展示','','thumb','main','','0','0','0','1','1397642808','1');

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `pre_comments` VALUES('1','36','0','测试','c81d2aaf7ceacdc4ba458d848cab23','fkdofkpsdfsdjfsdfsdokfpsdfdfkosdfksdfpksdfksdfksdkfhglfsdfd;fl;dslfjsdfghdisughidgsdglsdg,aghjfhodjhfdjhofdhjf[gfd,g;\'khkhfd;h,f;h;fdmhdlf;mhd.f\'lryoruyunbzdfggfd','1','0','','','1397622408','2130706433','posts');
INSERT INTO `pre_comments` VALUES('2','36','0','哈哈','','的发的说法的辅导费发送到发送到但是的范德萨是的份上德辅道发发多撒地方的发生的发生的发生的方式','1','0','','','1397627664','2130706433','posts');

DROP TABLE IF EXISTS `pre_config`;
CREATE TABLE `pre_config` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `value` text,
  `description` varchar(255) NOT NULL default '',
  `classify` char(16) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

INSERT INTO `pre_config` VALUES('5','sitename','新灵旅行','','baseinfo');
INSERT INTO `pre_config` VALUES('6','shortTitle','带上新的生活去旅行','','baseinfo');
INSERT INTO `pre_config` VALUES('7','domain','http://192.168.1.187','','baseinfo');
INSERT INTO `pre_config` VALUES('8','address','重庆市江北观音桥','','siteinfo');
INSERT INTO `pre_config` VALUES('9','phone','023-12345678','','siteinfo');
INSERT INTO `pre_config` VALUES('10','email','admin@admin.com','','siteinfo');
INSERT INTO `pre_config` VALUES('11','beian','渝备12345678','','siteinfo');
INSERT INTO `pre_config` VALUES('12','copyright','2012-2013','','siteinfo');
INSERT INTO `pre_config` VALUES('13','baseurl','http://192.168.1.187/wifi/','','baseinfo');
INSERT INTO `pre_config` VALUES('14','version','Alpha 1.0','','baseinfo');
INSERT INTO `pre_config` VALUES('15','imgUploadNum','1','','upload');
INSERT INTO `pre_config` VALUES('16','imgMinWidth','300','','upload');
INSERT INTO `pre_config` VALUES('17','imgMinHeight','300','','upload');
INSERT INTO `pre_config` VALUES('18','imgAllowTypes','*.jpg;*.png;*.jpeg','','upload');
INSERT INTO `pre_config` VALUES('19','imgThumbSize','124,200,300,600,origin','','upload');
INSERT INTO `pre_config` VALUES('20','imgMaxSize','1024000','','upload');
INSERT INTO `pre_config` VALUES('21','imgQuality','80','','upload');
INSERT INTO `pre_config` VALUES('22','closeSite','1','','base');
INSERT INTO `pre_config` VALUES('23','mobile','1','','base');
INSERT INTO `pre_config` VALUES('24','userDefaultGroup','5','','base');
INSERT INTO `pre_config` VALUES('25','attachDir','http://localhost/acopy/attachments/','','base');
INSERT INTO `pre_config` VALUES('26','service_aim_cn','致力于提升客户品牌形象、实现客户商业目标!','','base');
INSERT INTO `pre_config` VALUES('27','service_aim_en','Commitment to enhance customer brand image,customer business goals!','','base');
INSERT INTO `pre_config` VALUES('28','perPageNum','10','','base');
INSERT INTO `pre_config` VALUES('29','logo','common/images/logo.png','','base');
INSERT INTO `pre_config` VALUES('30','closeSiteReason','系统正在维护中，请稍后再访问！','','base');
INSERT INTO `pre_config` VALUES('31','readLocalDir','C:\\\\AppServ\\\\www\\\\wifi\\\\protected/../attachments/','','base');
INSERT INTO `pre_config` VALUES('32','downloadLocalDir','C:\\\\AppServ\\\\www\\\\wifi\\\\protected/../attachments/','','base');
INSERT INTO `pre_config` VALUES('33','officalUid','2','','base');
INSERT INTO `pre_config` VALUES('34','shopGroupId','4','','base');
INSERT INTO `pre_config` VALUES('35','forbidnotshop','0','','base');
INSERT INTO `pre_config` VALUES('36','validateEmail','1','','base');

DROP TABLE IF EXISTS `pre_group_powers`;
CREATE TABLE `pre_group_powers` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `gid` varchar(50) NOT NULL,
  `powers` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


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
  `attachid` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

INSERT INTO `pre_posts` VALUES('30','0','2','','','未编辑','','','0','','','','','','','','','','1','0','1','0','0','1396852778','0');
INSERT INTO `pre_posts` VALUES('36','22','2','','','有事请留言','','','0','','','','','','<p>您有什么好的建议或意见，请在这里留言。</p>','','','','1','0','1','1','0','1397292833','0');
INSERT INTO `pre_posts` VALUES('32','24','2','','','不是已经改了么','','','0','','','','','电风扇的份上大','','','的风动旛动','发的说法的','1','0','1','1','0','1397209400','0');
INSERT INTO `pre_posts` VALUES('33','21','2','','','新增图片的展示','','','0','','','','','','<p>就景点附件的风景松岛枫 <br/></p><p>的发电机房度搜的</p><p><a href=\"http://localhost/wifi/attachments/posts/origin/33/5348c0826098c.jpg\" target=\"_blank\"></a><a href=\"http://localhost/wifi/attachments/posts/origin/33/5348c0826098c.jpg\" target=\"_blank\">[attach]23[/attach]</a></p><p><br/></p><p>咖啡色的f<br/></p><p>发是的范德萨</p><p><a href=\"http://localhost/wifi/attachments/posts/origin/33/5348c22e47a03.jpg\" target=\"_blank\"></a><a href=\"http://localhost/wifi/attachments/posts/origin/33/5348c22e47a03.jpg\" target=\"_blank\">[attach]24[/attach]</a></p><p><br/></p><p>景点附件的覅介绍的的解放军胜多负少的积分</p><p><a href=\"http://localhost/wifi/attachments/posts/origin/33/5348e71ee1aa8.jpg\" target=\"_blank\">[attach]25[/attach]</a></p><p><br/></p><p><br/></p>','','','','1','0','1','1','0','1397275888','0');
INSERT INTO `pre_posts` VALUES('34','21','2','','','还不行么','','','0','','','','','','<p></p><p></p><p><span style=\"line-height: 1.3em;\">这是详细描述，呵呵呵呵呵呵呵</span><br/></p><p><a href=\"http://localhost/wifi/attachments/posts/origin/34/534b71f792e46.jpg\" target=\"_blank\">[attach]934e[/attach]</a></p><p><br/></p><p><a href=\"http://localhost/wifi/attachments/posts/origin/34/534b789ef2abc.jpg\" target=\"_blank\"></a><a href=\"http://localhost/wifi/attachments/posts/origin/34/534b789ef2abc.jpg\" target=\"_blank\">[attach]934f[/attach]</a></p><p>及的飞机的加工费的覅国际法的几个地方</p><p>统一写入方法测试</p>','','','','1','0','1','1','0','1397287100','32');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `pre_questions` VALUES('1','2','0','','','','','的护肤的爽肤水的护发素的护发素和东方红水电费的粉红色的风华桑德福的护发素的风景大的方式大幅介绍的发交水电费圣诞节的佛山的见风使舵见风使舵噢见风使舵飓风桑迪封建时代','','0','','2','1397460832');

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
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

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
INSERT INTO `pre_user_action` VALUES('37','2','31','editposts','编辑文章','1397209393','2130706433');
INSERT INTO `pre_user_action` VALUES('38','2','32','editposts','编辑文章','1397209646','2130706433');
INSERT INTO `pre_user_action` VALUES('39','2','33','editposts','编辑文章','1397276863','2130706433');
INSERT INTO `pre_user_action` VALUES('40','2','33','editposts','编辑文章','1397277236','2130706433');
INSERT INTO `pre_user_action` VALUES('41','2','0','delposts','删除文章','1397292538','2130706433');
INSERT INTO `pre_user_action` VALUES('42','2','0','delposts','删除文章','1397292817','2130706433');
INSERT INTO `pre_user_action` VALUES('43','2','0','setting','更新设置','1397439508','2130706433');
INSERT INTO `pre_user_action` VALUES('44','2','0','delposts','删除文章','1397440303','2130706433');
INSERT INTO `pre_user_action` VALUES('45','2','0','delposts','删除文章','1397441608','2130706433');
INSERT INTO `pre_user_action` VALUES('46','2','9','editads','新增展示','1397447719','2130706433');
INSERT INTO `pre_user_action` VALUES('47','2','9','editads','新增展示','1397448283','2130706433');
INSERT INTO `pre_user_action` VALUES('48','2','0','delads','删除展示','1397557499','2130706433');
INSERT INTO `pre_user_action` VALUES('49','2','0','setting','更新设置','1397616746','2130706433');
INSERT INTO `pre_user_action` VALUES('50','2','0','setting','更新设置','1397620729','2130706433');
INSERT INTO `pre_user_action` VALUES('51','2','0','setting','更新设置','1397620936','2130706433');
INSERT INTO `pre_user_action` VALUES('52','2','0','setting','更新设置','1397642014','2130706433');
INSERT INTO `pre_user_action` VALUES('53','2','26','editcolumns','编辑栏目','1397642828','2130706433');
INSERT INTO `pre_user_action` VALUES('54','2','0','setting','更新设置','1397716765','2130706433');
INSERT INTO `pre_user_action` VALUES('55','2','0','setting','更新设置','1397716787','2130706433');
INSERT INTO `pre_user_action` VALUES('56','2','0','setting','更新设置','1397717201','2130706433');
INSERT INTO `pre_user_action` VALUES('57','2','0','setting','更新设置','1397717208','2130706433');

DROP TABLE IF EXISTS `pre_user_group`;
CREATE TABLE `pre_user_group` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(50) NOT NULL,
  `powers` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `cTime` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `pre_user_group` VALUES('5','系统','zmf','1','1383321578');
INSERT INTO `pre_user_group` VALUES('4','管理员','zmf','1','1383317395');

DROP TABLE IF EXISTS `pre_user_info`;
CREATE TABLE `pre_user_info` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `uid` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `classify` char(16) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;

INSERT INTO `pre_user_info` VALUES('82','2','column','21,22,23,20,24,25','column');
INSERT INTO `pre_user_info` VALUES('102','2','code','7abc45aded88f0883229193a3544b2ed','emailcode');
INSERT INTO `pre_user_info` VALUES('100','2','4','10','yearly');
INSERT INTO `pre_user_info` VALUES('101','2','4','9','weekly');
INSERT INTO `pre_user_info` VALUES('99','2','shortTitle','带上新的生活去旅行','base');
INSERT INTO `pre_user_info` VALUES('94','2','skin','default','template');
INSERT INTO `pre_user_info` VALUES('98','2','sitename','新灵旅行','base');
INSERT INTO `pre_user_info` VALUES('81','2','2','56','weekly');
INSERT INTO `pre_user_info` VALUES('97','2','mobile','0','base');
INSERT INTO `pre_user_info` VALUES('96','2','closeSite','1','base');
INSERT INTO `pre_user_info` VALUES('95','2','logo','9449','base');
INSERT INTO `pre_user_info` VALUES('87','2','3','85','weekly');
INSERT INTO `pre_user_info` VALUES('88','2','company','新灵旅行','siteinfo');
INSERT INTO `pre_user_info` VALUES('89','2','address','重庆市江北观音桥','siteinfo');
INSERT INTO `pre_user_info` VALUES('90','2','phone','023-12345678','siteinfo');
INSERT INTO `pre_user_info` VALUES('91','2','email','ph7pal@qq.com','siteinfo');
INSERT INTO `pre_user_info` VALUES('92','2','beian','渝备12345678','siteinfo');
INSERT INTO `pre_user_info` VALUES('93','2','copyright','©2012-2013','siteinfo');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `pre_users` VALUES('2','admin','e10adc3949ba59abbe56e057f20f883e','管理员','5','ph7pal@qq.com','123456789','12345678901','1234567','-1062731333','1397718473','4','1','1383317699','1','0');
INSERT INTO `pre_users` VALUES('3','','','','0','','','','','','0','0','0','1383321699','0','0');

