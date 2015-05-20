/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : gaps

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2015-05-11 23:22:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `company`
-- ----------------------------
DROP TABLE IF EXISTS `company`;
CREATE TABLE `company` (
  `com_id` int(10) NOT NULL AUTO_INCREMENT,
  `com_code` varchar(30) NOT NULL DEFAULT '0',
  `com_domain` varchar(30) NOT NULL DEFAULT 'gapps.co.id',
  `com_name` varchar(50) DEFAULT NULL,
  `com_description` varchar(500) DEFAULT NULL,
  `com_ico` varchar(50) DEFAULT NULL,
  `com_logo` varchar(50) DEFAULT NULL,
  `com_img_header` varchar(50) DEFAULT NULL,
  `com_img_footer` varchar(50) DEFAULT NULL,
  `com_address` varchar(500) DEFAULT NULL,
  `com_tlp` varchar(20) DEFAULT NULL,
  `com_fax` varchar(20) DEFAULT NULL,
  `com_email` varchar(20) DEFAULT NULL,
  `com_url_wallet` varchar(200) DEFAULT NULL,
  `com_url_commerce` varchar(200) DEFAULT NULL,
  `com_tpl_path` varchar(200) DEFAULT NULL,
  `com_asset_path` varchar(200) DEFAULT NULL,
  `com_asset_url` varchar(200) DEFAULT NULL,
  `com_url_success` varchar(200) DEFAULT NULL,
  `com_url_failed` varchar(200) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  PRIMARY KEY (`com_id`),
  UNIQUE KEY `com_id` (`com_id`) USING BTREE,
  KEY `com_code` (`com_code`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of company
-- ----------------------------
INSERT INTO `company` VALUES ('1', '1015', 'garuda.code-paper.com', 'Garuda', null, 'cd6a2deb.png', '4d7f0556.jpg', 'b54d30ef.jpg', 'eea20004.jpg', 'Jalan semua', '123456', '654321', 'company@email.com', ' http://103.43.66.52:8080/', ' http://103.43.66.52:8080/', '/mainApp/sites/gaps/web/public/garuda', '/mainApp/sites/gaps/web/public/garuda/assets', null, 'http://garuda.code-peeper.com/home', 'http://garuda.code-peeper.com/home', '2015-04-26 18:07:26', null);
INSERT INTO `company` VALUES ('3', '1015', 'astra.code-peeper.com', 'Astra', null, 'b83baff4.gif', '46fed7fb.gif', '2053f03c.gif', 'eedc814e.gif', 'Jalan semua', '123456', '654321', 'company@email.com', ' http://103.43.66.52:8080/', ' http://103.43.66.52:8080/', '/mainApp/sites/gaps/web/public/template/astra', '/mainApp/sites/gaps/web/public/template/astra/assets', 'http://astra.code-peeper.com/template/astra/assets', 'http://astra.code-peeper.com/landing', 'http://astra.code-peeper.com/landing', '2015-05-03 16:49:29', '2015-05-03 18:01:51');

-- ----------------------------
-- Table structure for `company_param`
-- ----------------------------
DROP TABLE IF EXISTS `company_param`;
CREATE TABLE `company_param` (
  `com_id` int(10) DEFAULT NULL,
  `param` varchar(100) DEFAULT NULL,
  `values` varchar(100) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  KEY `com_id` (`com_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of company_param
-- ----------------------------
INSERT INTO `company_param` VALUES (null, 'loginbox', '#0000ff', null);
INSERT INTO `company_param` VALUES (null, 'bg222', '#0a0a48', null);
INSERT INTO `company_param` VALUES (null, 'navigation', '#064606', null);
INSERT INTO `company_param` VALUES (null, 'headernav', '#052205', null);
INSERT INTO `company_param` VALUES (null, 'profile', '#090926', null);
INSERT INTO `company_param` VALUES ('3', 'loginbox', '', null);
INSERT INTO `company_param` VALUES ('3', 'bg222', '', null);
INSERT INTO `company_param` VALUES ('3', 'navigation', '', null);
INSERT INTO `company_param` VALUES ('3', 'headernav', '', null);
INSERT INTO `company_param` VALUES ('3', 'profile', '', null);

-- ----------------------------
-- Table structure for `controller`
-- ----------------------------
DROP TABLE IF EXISTS `controller`;
CREATE TABLE `controller` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controller` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `is_menu` tinyint(1) NOT NULL DEFAULT '0',
  `group_id` int(11) NOT NULL DEFAULT '1',
  `order` int(11) DEFAULT NULL,
  `cssicon` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx` (`id`) USING BTREE,
  KEY `con` (`controller`,`title`,`group_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of controller
-- ----------------------------
INSERT INTO `controller` VALUES ('1', 'user/index', 'User List', '1', '1', '99', 'fa-desktop');
INSERT INTO `controller` VALUES ('2', 'user/edit', 'Edit User', '0', '1', null, null);
INSERT INTO `controller` VALUES ('3', 'user/add', 'Add User', '0', '1', null, null);
INSERT INTO `controller` VALUES ('4', 'user/delete', 'Delete User', '0', '1', null, null);
INSERT INTO `controller` VALUES ('5', 'controller/index', 'Controller List', '1', '1', '98', 'fa-desktop');
INSERT INTO `controller` VALUES ('6', 'controller/add', 'Add Controller', '0', '1', null, null);
INSERT INTO `controller` VALUES ('7', 'controller/edit', 'Edit Controller', '0', '1', null, null);
INSERT INTO `controller` VALUES ('8', 'controller/delete', 'Delete Controller', '0', '1', null, null);
INSERT INTO `controller` VALUES ('9', 'user/access', 'User Access', '0', '1', '97', 'fa-desktop');
INSERT INTO `controller` VALUES ('10', 'access/add', 'Add Access', '0', '1', null, null);
INSERT INTO `controller` VALUES ('11', 'access/edit', 'Edit Access', '0', '1', null, null);
INSERT INTO `controller` VALUES ('12', 'access/delete', 'Delete Access', '0', '1', null, null);
INSERT INTO `controller` VALUES ('13', 'portal/index', 'List Portal', '1', '2', '1', 'fa-files-o');
INSERT INTO `controller` VALUES ('14', 'portal/add', 'Add Portal', '0', '2', null, null);
INSERT INTO `controller` VALUES ('15', 'portal/edit', 'Edit Portal', '0', '2', null, null);
INSERT INTO `controller` VALUES ('16', 'portal/delete', 'Delete Portal', '0', '2', null, null);
INSERT INTO `controller` VALUES ('17', 'user/access', 'User Access', '0', '1', null, null);
INSERT INTO `controller` VALUES ('19', 'transaksi/index', 'Transaksi', '1', '4', '2', 'fa-shopping-cart');
INSERT INTO `controller` VALUES ('20', 'transaksi/detail', 'Detail Transaksi', '0', '4', '3', '');
INSERT INTO `controller` VALUES ('21', 'transaksi/kirim', 'Aprrove Transaksi', '0', '4', '2', '');
INSERT INTO `controller` VALUES ('22', 'tracking/index', 'Tracking order', '1', '5', '3', 'fa-flag');
INSERT INTO `controller` VALUES ('23', 'tracking/addhistory', 'Add history', '0', '5', '3', '');
INSERT INTO `controller` VALUES ('24', 'tracking/detail', 'Detail Tracking', '0', '5', '3', '');
INSERT INTO `controller` VALUES ('25', 'transaksi/batal', 'Batalkan Transaksi', '0', '4', '2', '');
INSERT INTO `controller` VALUES ('26', 'report/index', 'Report Transaksi', '1', '6', '5', 'fa-file');

-- ----------------------------
-- Table structure for `order_delivery`
-- ----------------------------
DROP TABLE IF EXISTS `order_delivery`;
CREATE TABLE `order_delivery` (
  `delivery_id` int(10) NOT NULL AUTO_INCREMENT,
  `order_code` varchar(50) DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `delivery_nama` varchar(100) DEFAULT NULL,
  `delivery_email` varchar(50) DEFAULT NULL,
  `delivery_tlp` varchar(20) DEFAULT NULL,
  `delivery_tipe` varchar(10) DEFAULT NULL,
  `delivery_kota` varchar(50) DEFAULT NULL,
  `delivery_alamat` varchar(500) DEFAULT NULL,
  `delivery_kodepos` varchar(10) DEFAULT NULL,
  `delivery_rt` varchar(20) DEFAULT NULL,
  `delivery_rw` varchar(20) DEFAULT NULL,
  `delivery_by` varchar(10) DEFAULT NULL,
  `delivery_ket` varchar(500) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  PRIMARY KEY (`delivery_id`),
  UNIQUE KEY `delivery_id` (`delivery_id`) USING BTREE,
  KEY `order_code` (`order_code`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of order_delivery
-- ----------------------------
INSERT INTO `order_delivery` VALUES ('1', 'ORD12345', '1015087782256719', 'noverda', 'noverda@gmail.com', '087782256719', 'rumah', null, 'jl swadaya 1 no 16', '12510', '10', '009', 'JNE', 'keterangan delivery', '2015-05-04 21:23:16', null);
INSERT INTO `order_delivery` VALUES ('2', 'ORD23456', '1015087782256719', 'noverda', 'noverda@gmail.com', '087782256719', 'rumah', null, 'jl swadaya 1 no 16', '12510', '10', '009', 'JNE', 'keterangan delivery', '2015-05-06 08:03:22', null);

-- ----------------------------
-- Table structure for `order_detail`
-- ----------------------------
DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE `order_detail` (
  `detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_code` varchar(50) DEFAULT NULL,
  `com_code` varchar(30) DEFAULT NULL,
  `item_id` int(10) DEFAULT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `item_price` double DEFAULT NULL,
  `item_desc` text,
  `item_img` varchar(100) DEFAULT NULL,
  `item_size` varchar(10) DEFAULT NULL,
  `item_color` varchar(10) DEFAULT NULL,
  `item_disc` int(5) DEFAULT NULL,
  `item_qty` int(5) DEFAULT NULL,
  `item_subtotal` double DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  PRIMARY KEY (`detail_id`),
  UNIQUE KEY `detail_id` (`detail_id`) USING BTREE,
  KEY `order_code` (`order_code`) USING BTREE,
  KEY `com_code` (`com_code`) USING BTREE,
  KEY `item_id` (`item_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of order_detail
-- ----------------------------
INSERT INTO `order_detail` VALUES ('1', 'ORD12345', '1015', '4', 'baju', '50000', ' some describe', 'http://gaps.co.id/img/product.png', 'XL', 'Blue', '0', '1', '50000', '2015-05-04 21:23:16', null);
INSERT INTO `order_detail` VALUES ('2', 'ORD12345', '1015', '4', 'baju2', '50000', ' some describe', 'http://gaps.co.id/img/product.png', 'XL', 'Blue', '0', '1', '50000', '2015-05-04 21:23:16', null);
INSERT INTO `order_detail` VALUES ('3', 'ORD23456', '1015', '4', 'baju', '50000', ' some describe', 'http://gaps.co.id/img/product.png', 'XL', 'Blue', '0', '1', '50000', '2015-05-06 08:03:22', null);
INSERT INTO `order_detail` VALUES ('4', 'ORD23456', '1015', '4', 'baju2', '50000', ' some describe', 'http://gaps.co.id/img/product.png', 'XL', 'Blue', '0', '1', '50000', '2015-05-06 08:03:22', null);

-- ----------------------------
-- Table structure for `order_header`
-- ----------------------------
DROP TABLE IF EXISTS `order_header`;
CREATE TABLE `order_header` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_code` varchar(50) DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `order_total` double DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `order_status` tinyint(2) DEFAULT '0' COMMENT '{0=pending;1=dikirim;2=batal;}',
  `create_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  UNIQUE KEY `order_code` (`order_code`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `status` (`order_status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of order_header
-- ----------------------------
INSERT INTO `order_header` VALUES ('1', 'ORD12345', '1015087782256719', '50000', '2015-05-05 19:30:00', '1', '2015-05-04 21:23:16', '2015-05-08 10:56:07');
INSERT INTO `order_header` VALUES ('2', 'ORD23456', '1015087782256719', '50000', '2015-05-05 19:40:00', '2', '2015-05-06 08:03:22', '2015-05-08 10:58:55');

-- ----------------------------
-- Table structure for `order_history`
-- ----------------------------
DROP TABLE IF EXISTS `order_history`;
CREATE TABLE `order_history` (
  `history_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) DEFAULT NULL,
  `order_code` varchar(50) DEFAULT NULL,
  `history_date` datetime DEFAULT NULL,
  `history_desc` text,
  `history_status` varchar(20) DEFAULT 'Pending',
  `create_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `user_act` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`history_id`),
  KEY `order_code` (`order_code`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of order_history
-- ----------------------------
INSERT INTO `order_history` VALUES ('1', '1015087782256719', 'ORD12345', '2015-05-05 19:30:00', 'Transaksi sedang di proses', 'Pending', '2015-05-04 21:23:16', null, null);
INSERT INTO `order_history` VALUES ('2', '1015087782256719', 'ORD23456', '2015-05-05 19:30:00', 'Transaksi dalam proses verifikasi', 'Pending', '2015-05-06 08:03:22', null, null);
INSERT INTO `order_history` VALUES ('3', '1015087782256719', 'ORD12345', '2015-05-08 10:55:45', 'Barang sedang dalam proses pengiriman', 'Sukses', '2015-05-08 10:55:45', null, 'admin');
INSERT INTO `order_history` VALUES ('4', '1015087782256719', 'ORD12345', '2015-05-08 10:56:07', 'Barang sedang dalam proses pengiriman', 'Sukses', '2015-05-08 10:56:07', null, 'admin');
INSERT INTO `order_history` VALUES ('5', '1015087782256719', 'ORD23456', '2015-05-08 10:58:55', 'Order telah di batalkan', 'Gagal', '2015-05-08 10:58:55', null, 'admin');
INSERT INTO `order_history` VALUES ('6', '1015087782256719', 'ORD12345', '2015-05-08 00:00:00', 'tambahan', 'Sukses', '2015-05-08 11:34:23', null, 'admin');

-- ----------------------------
-- Table structure for `slide`
-- ----------------------------
DROP TABLE IF EXISTS `slide`;
CREATE TABLE `slide` (
  `slide_id` int(10) NOT NULL AUTO_INCREMENT,
  `com_id` int(10) DEFAULT NULL,
  `slide_img` varchar(100) DEFAULT NULL,
  `slide_order` tinyint(1) DEFAULT NULL,
  `slide_active` tinyint(1) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  PRIMARY KEY (`slide_id`),
  UNIQUE KEY `slide_id` (`slide_id`) USING BTREE,
  KEY `com_id` (`com_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of slide
-- ----------------------------

-- ----------------------------
-- Table structure for `ugroup`
-- ----------------------------
DROP TABLE IF EXISTS `ugroup`;
CREATE TABLE `ugroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) DEFAULT NULL,
  `merchant` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ugroup
-- ----------------------------
INSERT INTO `ugroup` VALUES ('1', 'ADMIN', null);
INSERT INTO `ugroup` VALUES ('2', 'PORTAL', null);
INSERT INTO `ugroup` VALUES ('3', 'LAYOUT', null);
INSERT INTO `ugroup` VALUES ('4', 'TRANSAKSI', null);
INSERT INTO `ugroup` VALUES ('5', 'TRACKING', null);
INSERT INTO `ugroup` VALUES ('6', 'REPORT', null);

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `telpon` varchar(100) NOT NULL,
  `aktif` tinyint(1) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `id` (`uid`) USING BTREE,
  KEY `username` (`username`),
  KEY `aktif` (`aktif`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', 'c93ccd78b2076528346216b3b2f701e6', 'admin', 'admin@gaps.co.id', '123456', '1');
INSERT INTO `user` VALUES ('3', 'noverda', 'e10adc3949ba59abbe56e057f20f883e', 'noverda', 'noverda@gmail.com', '123456', '1');

-- ----------------------------
-- Table structure for `user_access`
-- ----------------------------
DROP TABLE IF EXISTS `user_access`;
CREATE TABLE `user_access` (
  `uid` int(11) NOT NULL,
  `controller_id` int(11) NOT NULL,
  KEY `uid` (`uid`,`controller_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_access
-- ----------------------------
INSERT INTO `user_access` VALUES ('1', '1');
INSERT INTO `user_access` VALUES ('1', '2');
INSERT INTO `user_access` VALUES ('1', '3');
INSERT INTO `user_access` VALUES ('1', '4');
INSERT INTO `user_access` VALUES ('1', '5');
INSERT INTO `user_access` VALUES ('1', '6');
INSERT INTO `user_access` VALUES ('1', '7');
INSERT INTO `user_access` VALUES ('1', '8');
INSERT INTO `user_access` VALUES ('1', '9');
INSERT INTO `user_access` VALUES ('1', '10');
INSERT INTO `user_access` VALUES ('1', '11');
INSERT INTO `user_access` VALUES ('1', '12');
INSERT INTO `user_access` VALUES ('1', '13');
INSERT INTO `user_access` VALUES ('1', '14');
INSERT INTO `user_access` VALUES ('1', '15');
INSERT INTO `user_access` VALUES ('1', '16');
INSERT INTO `user_access` VALUES ('1', '17');
INSERT INTO `user_access` VALUES ('1', '19');
INSERT INTO `user_access` VALUES ('1', '20');
INSERT INTO `user_access` VALUES ('1', '21');
INSERT INTO `user_access` VALUES ('1', '22');
INSERT INTO `user_access` VALUES ('1', '23');
INSERT INTO `user_access` VALUES ('1', '24');
INSERT INTO `user_access` VALUES ('1', '25');
INSERT INTO `user_access` VALUES ('1', '26');
INSERT INTO `user_access` VALUES ('3', '1');
INSERT INTO `user_access` VALUES ('3', '2');
INSERT INTO `user_access` VALUES ('3', '3');
INSERT INTO `user_access` VALUES ('3', '4');
INSERT INTO `user_access` VALUES ('3', '13');
INSERT INTO `user_access` VALUES ('3', '14');
INSERT INTO `user_access` VALUES ('3', '15');
INSERT INTO `user_access` VALUES ('3', '16');

-- ----------------------------
-- Table structure for `user_group`
-- ----------------------------
DROP TABLE IF EXISTS `user_group`;
CREATE TABLE `user_group` (
  `uid` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  KEY `uid` (`uid`,`group_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_group
-- ----------------------------
INSERT INTO `user_group` VALUES ('0', '1');
INSERT INTO `user_group` VALUES ('1', '1');
INSERT INTO `user_group` VALUES ('1', '2');
INSERT INTO `user_group` VALUES ('1', '3');
INSERT INTO `user_group` VALUES ('1', '4');
INSERT INTO `user_group` VALUES ('1', '5');
INSERT INTO `user_group` VALUES ('1', '6');
