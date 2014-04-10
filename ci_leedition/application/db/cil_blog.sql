/*
 Navicat MySQL Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50616
 Source Host           : localhost
 Source Database       : cil_db

 Target Server Type    : MySQL
 Target Server Version : 50616
 File Encoding         : utf-8

 Date: 03/30/2014 23:52:50 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `cil_blog`
-- ----------------------------
DROP TABLE IF EXISTS `cil_blog`;
CREATE TABLE `cil_blog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `created_time` int(10) NOT NULL,
  `updated_time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `cil_blog`
-- ----------------------------
BEGIN;
INSERT INTO `cil_blog` VALUES ('1', 'asdf', 'asdf', '123456790', '123456790');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
