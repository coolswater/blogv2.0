#
# TABLE STRUCTURE FOR: t_categorys
#

DROP TABLE IF EXISTS `t_categorys`;

CREATE TABLE `t_categorys` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章栏目id',
  `category` varchar(50) NOT NULL COMMENT '栏目名称',
  `pid` int(11) unsigned NOT NULL COMMENT '父ID',
  `status` tinyint(3) unsigned DEFAULT '0' COMMENT '状态：0-可用 1-不可用',
  PRIMARY KEY (`id`),
  UNIQUE KEY `category` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='文章栏目表';

INSERT INTO `t_categorys` (`id`, `category`, `pid`, `status`) VALUES (1, '前端开发', 0, 0);
INSERT INTO `t_categorys` (`id`, `category`, `pid`, `status`) VALUES (2, '后端开发', 0, 0);
INSERT INTO `t_categorys` (`id`, `category`, `pid`, `status`) VALUES (3, '系统运维', 0, 0);
INSERT INTO `t_categorys` (`id`, `category`, `pid`, `status`) VALUES (4, '大数据', 0, 0);
INSERT INTO `t_categorys` (`id`, `category`, `pid`, `status`) VALUES (5, '网站运营', 0, 0);
INSERT INTO `t_categorys` (`id`, `category`, `pid`, `status`) VALUES (6, '数据库', 0, 0);


#
# TABLE STRUCTURE FOR: t_comments
#

DROP TABLE IF EXISTS `t_comments`;

CREATE TABLE `t_comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '评论id',
  `artcle_id` int(11) unsigned NOT NULL COMMENT '文章id',
  `content` varchar(150) NOT NULL COMMENT '评论内容',
  `user_id` int(11) unsigned NOT NULL COMMENT '用户id',
  `praise` int(11) unsigned NOT NULL COMMENT '被赞数',
  `pid` int(11) unsigned NOT NULL COMMENT '父ID',
  `create_time` datetime DEFAULT NULL COMMENT '父ID',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `user_id` (`user_id`),
  KEY `artcle_id` (`artcle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章评论表';

#
# TABLE STRUCTURE FOR: t_tags
#

DROP TABLE IF EXISTS `t_tags`;

CREATE TABLE `t_tags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章标签ID',
  `tag_name` varchar(50) NOT NULL COMMENT '标签名称',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag_name` (`tag_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章标签表';

#
# TABLE STRUCTURE FOR: t_artcles
#

DROP TABLE IF EXISTS `t_artcles`;

CREATE TABLE `t_artcles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章ID',
  `title` varchar(30) NOT NULL COMMENT '文章标题',
  `summary` varchar(150) NOT NULL COMMENT '摘要',
  `content` text NOT NULL COMMENT '文章内容',
  `cid` int(4) NOT NULL COMMENT '文章类别',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态：1-已发布 2-已保存 3-已删除',
  `thumb` varchar(200) NOT NULL COMMENT '缩略图',
  `is_link` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否外链：0-否 1-是',
  `hits` int(11) NOT NULL COMMENT '阅读量',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '文章类别：0-默认 1-精选 2-专题',
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `update_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '更新时间',
  `publish_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '发布时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章表';

#
# TABLE STRUCTURE FOR: t_friend_links
#

DROP TABLE IF EXISTS `t_friend_links`;

CREATE TABLE `t_friend_links` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(50) NOT NULL COMMENT '链接名称',
  `logo` varchar(150) NOT NULL COMMENT '链接logo',
  `url` varchar(150) NOT NULL DEFAULT '0' COMMENT '链接地址',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态：0-正常 1-禁用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='友情链接表';

INSERT INTO `t_friend_links` (`id`, `name`, `logo`, `url`, `create_time`, `status`) VALUES (1, '想做设计的java', '', 'http://www.luotianchang.com', '2018-08-08 21:27:40', 0);
INSERT INTO `t_friend_links` (`id`, `name`, `logo`, `url`, `create_time`, `status`) VALUES (2, '全栈工程师', '', 'http://www.liuzhaoning.com', '2018-08-08 21:27:40', 0);
INSERT INTO `t_friend_links` (`id`, `name`, `logo`, `url`, `create_time`, `status`) VALUES (3, '会适配的java', '', 'http://www.lvlvstart.com', '2018-08-08 21:27:40', 0);
INSERT INTO `t_friend_links` (`id`, `name`, `logo`, `url`, `create_time`, `status`) VALUES (4, '想做开发的运维', '', 'http://www.itwithauto.com', '2018-08-08 21:27:40', 0);


#
# TABLE STRUCTURE FOR: t_migrations
#

DROP TABLE IF EXISTS `t_migrations`;

CREATE TABLE `t_migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `t_migrations` (`version`) VALUES ('20181001000000');


#
# TABLE STRUCTURE FOR: t_tags_map
#

DROP TABLE IF EXISTS `t_tags_map`;

CREATE TABLE `t_tags_map` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `artcle_id` int(11) unsigned NOT NULL COMMENT '文章id',
  PRIMARY KEY (`id`),
  KEY `artcle_id` (`artcle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章标签关联表';

#
# TABLE STRUCTURE FOR: t_users
#

DROP TABLE IF EXISTS `t_users`;

CREATE TABLE `t_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `username` varchar(30) NOT NULL COMMENT '用户名',
  `password` varchar(38) NOT NULL COMMENT '密码',
  `group_id` tinyint(2) NOT NULL DEFAULT '0' COMMENT '用户组id',
  `nick_name` varchar(30) NOT NULL COMMENT '昵称',
  `portrait` varchar(100) NOT NULL COMMENT '头像',
  `mobile` varchar(11) NOT NULL COMMENT '手机号码',
  `email` varchar(50) NOT NULL COMMENT '电子邮箱',
  `last_login_time` varchar(50) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `last_login_ip` varchar(15) NOT NULL COMMENT '最后登录ip',
  `status` tinyint(15) NOT NULL DEFAULT '0' COMMENT '是否禁用   0-可用 1-禁用',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `nick_name` (`nick_name`),
  UNIQUE KEY `mobile` (`mobile`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户表';

INSERT INTO `t_users` (`id`, `username`, `password`, `group_id`, `nick_name`, `portrait`, `mobile`, `email`, `last_login_time`, `last_login_ip`, `status`) VALUES (1, 'hexd0070', '57127ab77527def52dada083e0ce1c0f3eesf2', 0, '牛盾007', '/public/assets/images/header.png', '15210881179', 'hexiaodong2810@163.com	', '2018-08-08 18:11:58', '111.200.218.67', 0);


