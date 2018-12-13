/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50723
 Source Host           : localhost
 Source Database       : rbooks

 Target Server Type    : MySQL
 Target Server Version : 50723
 File Encoding         : utf-8

 Date: 12/05/2018 09:43:38 AM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `rbo_advertisement`
-- ----------------------------
DROP TABLE IF EXISTS `rbo_advertisement`;
CREATE TABLE `rbo_advertisement` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) DEFAULT NULL COMMENT '跳转的URL',
  `name` varchar(255) DEFAULT NULL COMMENT '名称标题',
  `status` varchar(255) DEFAULT '1' COMMENT '是否启用 默认1  启用',
  `image` varchar(255) DEFAULT NULL COMMENT '图片上传',
  `video` varchar(255) DEFAULT NULL COMMENT '视频上传',
  `isvi` varchar(255) DEFAULT NULL COMMENT '判断该广告是图片类型 还是视频类型 1图片 2视频',
  `ctime` varchar(255) DEFAULT NULL COMMENT '添加的时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `rbo_bclassify`
-- ----------------------------
DROP TABLE IF EXISTS `rbo_bclassify`;
CREATE TABLE `rbo_bclassify` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) DEFAULT NULL COMMENT '图书类别名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `rbo_books`
-- ----------------------------
DROP TABLE IF EXISTS `rbo_books`;
CREATE TABLE `rbo_books` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `booksname` varchar(255) DEFAULT NULL COMMENT '书籍名称',
  `author` varchar(255) DEFAULT NULL COMMENT '作者',
  `publishing` varchar(255) DEFAULT NULL COMMENT '出版社',
  `synopsis` varchar(255) DEFAULT NULL COMMENT '书籍简介',
  `bimg` varchar(255) DEFAULT NULL COMMENT '书籍封面',
  `isvip` int(11) DEFAULT '1' COMMENT '是否是VIP书籍 1不是 2是 3已购买',
  `createtime` varchar(255) DEFAULT NULL COMMENT '添加时间',
  `category_id` int(255) DEFAULT NULL COMMENT '图书类别id（后期管理时添加）',
  `Publishing_attributes` varchar(255) DEFAULT NULL COMMENT '出版属性（后期管理时添加） 原创或出版物',
  `pread` varchar(255) DEFAULT NULL COMMENT '阅读人数（后期管理时添加）',
  `Fabulous` varchar(255) DEFAULT NULL COMMENT '点赞（后期管理）',
  `isrecommend` varchar(255) DEFAULT '0' COMMENT '是否推荐 默认0 不推荐',
  `unit_price

Unit Price

Unit Price

unit_price` varchar(255) DEFAULT NULL COMMENT '单价',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `rbo_chapters`
-- ----------------------------
DROP TABLE IF EXISTS `rbo_chapters`;
CREATE TABLE `rbo_chapters` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL COMMENT '书籍ID',
  `Chapter` varchar(255) DEFAULT NULL COMMENT '章节名称',
  `content` longtext COMMENT '当前章节下的内容',
  `sort` varchar(255) DEFAULT NULL COMMENT '自定义排序（后期添加）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6421 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `rbo_membership`
-- ----------------------------
DROP TABLE IF EXISTS `rbo_membership`;
CREATE TABLE `rbo_membership` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `memname` varchar(255) DEFAULT NULL COMMENT '会员卡名称 ',
  `money` varchar(255) DEFAULT NULL COMMENT '金额',
  `days` varchar(255) DEFAULT NULL COMMENT '会员卡的天数',
  `ctime` varchar(255) DEFAULT NULL COMMENT '添加时间',
  `prescription` varchar(255) DEFAULT NULL COMMENT '时效',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `rbo_permission`
-- ----------------------------
DROP TABLE IF EXISTS `rbo_permission`;
CREATE TABLE `rbo_permission` (
  `permission_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL COMMENT '父级ID',
  `permission_name` varchar(255) DEFAULT NULL COMMENT '权限名称',
  `permission_url` varchar(255) DEFAULT NULL COMMENT '控制器URL',
  `permission_description` varchar(255) DEFAULT NULL COMMENT '权限注释',
  `status` varchar(255) DEFAULT NULL COMMENT '显示隐藏',
  `sort` varchar(255) DEFAULT NULL COMMENT '排序',
  `permission_ctime` varchar(255) DEFAULT NULL COMMENT '添加的时间',
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `rbo_permission_role`
-- ----------------------------
DROP TABLE IF EXISTS `rbo_permission_role`;
CREATE TABLE `rbo_permission_role` (
  `role_id` int(11) DEFAULT NULL COMMENT '用户组角色ID',
  `permission_id` int(11) DEFAULT NULL COMMENT '权限ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `rbo_roles`
-- ----------------------------
DROP TABLE IF EXISTS `rbo_roles`;
CREATE TABLE `rbo_roles` (
  `role_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色ID',
  `role_name` varchar(255) NOT NULL COMMENT '角色名称',
  `role_description` varchar(255) DEFAULT NULL COMMENT '角色描述',
  `role_ctime` varchar(255) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `用户组名称唯一` (`role_name`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `rbo_user_role`
-- ----------------------------
DROP TABLE IF EXISTS `rbo_user_role`;
CREATE TABLE `rbo_user_role` (
  `role_id` int(11) DEFAULT NULL COMMENT '角色ID',
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `rbo_userhome`
-- ----------------------------
DROP TABLE IF EXISTS `rbo_userhome`;
CREATE TABLE `rbo_userhome` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userhome` varchar(255) DEFAULT NULL COMMENT '用户名称',
  `phone` varchar(255) DEFAULT NULL COMMENT '手机号',
  `email` varchar(255) DEFAULT NULL COMMENT '邮箱',
  `uvip` varchar(255) DEFAULT NULL,
  `mem_id` int(11) DEFAULT NULL COMMENT '会员卡状态 ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `rbo_users`
-- ----------------------------
DROP TABLE IF EXISTS `rbo_users`;
CREATE TABLE `rbo_users` (
  `id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL COMMENT '用户名',
  `password` varchar(255) NOT NULL COMMENT '密码',
  `role_id` int(11) DEFAULT NULL COMMENT '角色组ID',
  `sex` int(11) DEFAULT '0' COMMENT '性别1男0女',
  `age` int(11) DEFAULT NULL COMMENT '年龄',
  `user_img` varchar(255) DEFAULT NULL COMMENT '头像图片',
  `phone` varchar(255) DEFAULT NULL COMMENT '手机号',
  `email` varchar(255) DEFAULT NULL COMMENT '邮箱',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
