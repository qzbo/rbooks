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

 Date: 10/17/2018 18:01:11 PM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `rbo_admins`
-- ----------------------------
DROP TABLE IF EXISTS `rbo_admins`;
CREATE TABLE `rbo_admins` (
  `id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL COMMENT '用户名',
  `password` varchar(255) NOT NULL COMMENT '密码',
  `sex` int(11) DEFAULT '0' COMMENT '性别1男0女',
  `age` int(11) DEFAULT NULL COMMENT '年龄',
  `user_img` varchar(255) DEFAULT NULL COMMENT '头像图片',
  `phone` varchar(255) DEFAULT NULL COMMENT '手机号',
  `email` varchar(255) DEFAULT NULL COMMENT '邮箱',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `rbo_admins`
-- ----------------------------
BEGIN;
INSERT INTO `rbo_admins` VALUES ('1', 'admin', '$2y$10$g5Ssfn1KPTJ4wBlW1S9PUuPQyE5d90T1IcDdfPTUTLcE3R2ob0VpW', '1', '12', null, '13581829670', 'ng@dooland.net'), ('4', 'admin1', '$2y$10$UKcQ0rfm2gqvfsUK050C.eg1NHYxkBQEB3FdsblYO3P3/lCBbzfJ.', '1', '12', null, '13581829670', 'lipeng@dooland.net'), ('9', 'admin2', '$2y$10$3Yhye7y9c45qomvYWgSq0e4XzBMpHa1qwjtcv7r6fufHVWLdQzywO', '1', '11', null, '13581829670', 'eng@dooland.net'), ('10', 'admin.', '$2y$10$06NUuRnrOcKLDz.S60DWj.C6U3QiI/pXe5b4qSRMAXFbu20ZvGayC', '1', '12', null, '', ''), ('12', 'admin4', '$2y$10$spSB4XyfNwbkNqW/WFkFquD3uIafO5WyuNRt2op0hVagKW5.0L2TO', '1', '12', null, '13581829670', '');
COMMIT;

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
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `booksname` varchar(255) DEFAULT NULL COMMENT '书籍名称',
  `author` varchar(255) DEFAULT NULL COMMENT '作者',
  `publishing` varchar(255) DEFAULT NULL COMMENT '出版社',
  `synopsis` varchar(255) DEFAULT NULL COMMENT '书籍简介',
  `bimg` varchar(255) DEFAULT NULL COMMENT '书籍封面',
  `isvip` int(11) DEFAULT '1' COMMENT '是否是VIP书籍 1不是 2是',
  `createtime` varchar(255) DEFAULT NULL COMMENT '添加时间',
  `category_id` int(255) DEFAULT NULL COMMENT '图书类别id（后期管理时添加）',
  `publishing_attributes` varchar(255) DEFAULT NULL COMMENT '出版属性（后期管理时添加） 原创或出版物',
  `pread` varchar(255) DEFAULT NULL COMMENT '阅读人数（后期管理时添加）',
  `fabulous` varchar(255) DEFAULT NULL COMMENT '点赞（后期管理）',
  `isrecommend` varchar(255) DEFAULT '0' COMMENT '是否推荐 默认0 不推荐',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `rbo_chapters`
-- ----------------------------
DROP TABLE IF EXISTS `rbo_chapters`;
CREATE TABLE `rbo_chapters` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL COMMENT '书籍ID',
  `Chapter` varchar(255) DEFAULT NULL COMMENT '章节名称',
  `content` blob COMMENT '当前章节下的内容',
  `sort` varchar(255) DEFAULT NULL COMMENT '自定义排序（后期添加）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
