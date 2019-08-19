/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50626
Source Host           : 127.0.0.1:3306
Source Database       : procrud

Target Server Type    : MYSQL
Target Server Version : 50626
File Encoding         : 65001

Date: 2019-08-19 14:27:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mbrg
-- ----------------------------
DROP TABLE IF EXISTS `mbrg`;
CREATE TABLE `mbrg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_subktg` varchar(255) DEFAULT NULL,
  `kode` varchar(100) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `artikel` text,
  `image1` varchar(255) DEFAULT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `image3` varchar(255) DEFAULT NULL,
  `ket` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mbrg
-- ----------------------------

-- ----------------------------
-- Table structure for mktg
-- ----------------------------
DROP TABLE IF EXISTS `mktg`;
CREATE TABLE `mktg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(100) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `artikel` text,
  `image` varchar(255) DEFAULT NULL,
  `ket` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mktg
-- ----------------------------
INSERT INTO `mktg` VALUES ('4', null, 'aaa', 'aa', '/uploads/mktg/img-1566192046.png', 'aaaa');
INSERT INTO `mktg` VALUES ('5', null, 'xxxx', 'xxx', '/uploads/mktg/img-1566193697.png', 'xxxx');
INSERT INTO `mktg` VALUES ('6', null, 'bbbb', 'bbb', '/uploads/mktg/img-1566193707.png', 'bbbbb');

-- ----------------------------
-- Table structure for msubktg
-- ----------------------------
DROP TABLE IF EXISTS `msubktg`;
CREATE TABLE `msubktg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_ktg` varchar(255) DEFAULT NULL,
  `kode` varchar(100) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `artikel` text,
  `image` varchar(255) DEFAULT NULL,
  `ket` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of msubktg
-- ----------------------------
INSERT INTO `msubktg` VALUES ('1', '6', null, 'ttt', 'ttt', '/uploads/msubktg/img-1566194186.png', 'tttt');

-- ----------------------------
-- Table structure for muser
-- ----------------------------
DROP TABLE IF EXISTS `muser`;
CREATE TABLE `muser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(100) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `ket` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of muser
-- ----------------------------
INSERT INTO `muser` VALUES ('1', 'q', 'q', 'aaa', 'aa');
SET FOREIGN_KEY_CHECKS=1;
