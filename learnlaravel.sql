/*
Navicat MySQL Data Transfer

Source Server         : test
Source Server Version : 50614
Source Host           : 127.0.0.1:3306
Source Database       : learnlaravel

Target Server Type    : MYSQL
Target Server Version : 50614
File Encoding         : 65001

Date: 2015-01-21 20:29:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('1', 'drink', '2015-01-02 07:02:27', '2015-01-02 07:02:27');
INSERT INTO `categories` VALUES ('2', 'fast food', '2015-01-02 07:02:27', '2015-01-02 07:02:27');

-- ----------------------------
-- Table structure for category_food
-- ----------------------------
DROP TABLE IF EXISTS `category_food`;
CREATE TABLE `category_food` (
  `category_id` int(10) unsigned NOT NULL,
  `food_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`category_id`,`food_id`),
  KEY `category_food_category_id_index` (`category_id`),
  KEY `category_food_food_id_index` (`food_id`),
  CONSTRAINT `category_food_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `category_food_food_id_foreign` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of category_food
-- ----------------------------
INSERT INTO `category_food` VALUES ('1', '2', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `category_food` VALUES ('1', '3', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `category_food` VALUES ('1', '5', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `category_food` VALUES ('1', '15', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `category_food` VALUES ('1', '18', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `category_food` VALUES ('1', '20', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `category_food` VALUES ('1', '23', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `category_food` VALUES ('2', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `category_food` VALUES ('2', '4', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `category_food` VALUES ('2', '6', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `category_food` VALUES ('2', '15', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `category_food` VALUES ('2', '17', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `category_food` VALUES ('2', '20', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `category_food` VALUES ('2', '23', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` int(10) unsigned NOT NULL,
  `openid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `food_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `comments_customer_id_index` (`customer_id`),
  KEY `comments_food_id_index` (`food_id`),
  CONSTRAINT `comments_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_food_id_foreign` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of comments
-- ----------------------------

-- ----------------------------
-- Table structure for contacts
-- ----------------------------
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `openid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0',
  `telephone` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of contacts
-- ----------------------------

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `openid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES ('1', 'aa', 'qwfasdf2435', 'asdf', '2015-01-20 20:35:51', '2015-01-20 20:35:55');

-- ----------------------------
-- Table structure for descriptions
-- ----------------------------
DROP TABLE IF EXISTS `descriptions`;
CREATE TABLE `descriptions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `telephone` int(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `locationX` float(8,2) NOT NULL,
  `locationY` float(8,2) NOT NULL,
  `scale` int(11) NOT NULL,
  `location_label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` smallint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `descriptions_user_id_index` (`user_id`),
  CONSTRAINT `descriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of descriptions
-- ----------------------------
INSERT INTO `descriptions` VALUES ('1', 'restaurant10', null, '10', '54', '23.56', '56.55', '20', 'Kentucky New Traceybury 655 Jacobson Shore Apt. 172', '2015-01-02 08:15:24', '2015-01-20 13:14:55', '0');
INSERT INTO `descriptions` VALUES ('2', 'restaurant1', '没啥好吃', '2147483647', '45', '23.56', '56.55', '20', 'Rhode Island Emmittside 99107 Murazik Fords', '2015-01-02 08:15:24', '2015-01-20 13:14:23', '1');
INSERT INTO `descriptions` VALUES ('3', 'restaurant2', null, '0', '46', '23.56', '56.55', '20', 'Missouri Lake Marcelleborough 3911 Dickinson Corner Apt. 873', '2015-01-02 08:15:24', '2015-01-14 08:14:39', '1');
INSERT INTO `descriptions` VALUES ('4', 'restaurant3', null, '0', '47', '23.56', '56.55', '20', 'Montana West Anastasia 975 Rau Springs', '2015-01-02 08:15:24', '2015-01-02 08:15:24', '1');
INSERT INTO `descriptions` VALUES ('5', 'restaurant4', null, '0', '48', '23.56', '56.55', '20', 'Vermont Arleneborough 441 Lavern Radial Suite 785', '2015-01-02 08:15:24', '2015-01-02 08:15:24', '1');
INSERT INTO `descriptions` VALUES ('6', 'restaurant5', null, '0', '49', '23.56', '56.55', '20', 'Arizona Lulustad 895 Abbott Village', '2015-01-02 08:15:24', '2015-01-02 08:15:24', '1');
INSERT INTO `descriptions` VALUES ('7', 'restaurant6', null, '0', '50', '23.56', '56.55', '20', 'Minnesota North Marisol 43756 Jonathon Forks Suite 102', '2015-01-02 08:15:25', '2015-01-02 08:15:25', '1');
INSERT INTO `descriptions` VALUES ('8', 'restaurant7', null, '0', '51', '23.56', '56.55', '20', 'Georgia Lake Dejontown 96902 Schowalter Shore', '2015-01-02 08:15:25', '2015-01-02 08:15:25', '1');
INSERT INTO `descriptions` VALUES ('9', 'restaurant8', null, '0', '52', '23.56', '56.55', '20', 'Oklahoma North Francescaside 40473 Josie Hills', '2015-01-02 08:15:25', '2015-01-02 08:15:25', '1');
INSERT INTO `descriptions` VALUES ('10', 'restaurant9', null, '0', '53', '23.56', '56.55', '20', 'Colorado Ondrickaside 78409 Daniel Vista', '2015-01-02 08:15:25', '2015-01-02 08:15:25', '1');
INSERT INTO `descriptions` VALUES ('11', 'admin', null, '0', '44', '-1.00', '-1.00', '-1', 'null', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '9');

-- ----------------------------
-- Table structure for foods
-- ----------------------------
DROP TABLE IF EXISTS `foods`;
CREATE TABLE `foods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `user_id` int(10) unsigned NOT NULL,
  `price` int(11) NOT NULL,
  `current_total_store` int(11) DEFAULT '0',
  `current_sell` int(11) DEFAULT '0',
  `total_sell` int(11) DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `foods_restaurant_id_index` (`user_id`),
  CONSTRAINT `foods_restaurant_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of foods
-- ----------------------------
INSERT INTO `foods` VALUES ('1', 'crackers', 'dir', null, '45', '20', '0', '0', '0', '1', '2015-01-02 07:05:04', '2015-01-13 07:17:01');
INSERT INTO `foods` VALUES ('2', 'orange juice', 'dir', '甜蜜蜜的哦~~~', '45', '20', '0', '0', '0', '1', '2015-01-02 07:05:04', '2015-01-14 07:31:05');
INSERT INTO `foods` VALUES ('3', 'champagne ', 'dir', '甜蜜蜜的酒', '45', '20', '0', '0', '0', '0', '2015-01-02 07:05:04', '2015-01-11 03:44:39');
INSERT INTO `foods` VALUES ('4', 'popcorn', 'dir', null, '46', '20', '0', '0', '0', '0', '2015-01-02 07:05:04', '2015-01-02 07:05:04');
INSERT INTO `foods` VALUES ('5', 'Soya drink', 'dir', null, '45', '20', '0', '0', '0', '0', '2015-01-02 07:05:05', '2015-01-02 07:05:05');
INSERT INTO `foods` VALUES ('6', 'macaroni', 'dir', null, '46', '20', '0', '0', '0', '0', '2015-01-02 07:05:37', '2015-01-02 07:05:37');
INSERT INTO `foods` VALUES ('15', '邓国健', '', null, '46', '10', '0', '0', '0', '0', '2015-01-06 11:33:00', '2015-01-06 11:33:00');
INSERT INTO `foods` VALUES ('17', '炒面', '', '好多好多肉啊', '45', '10', '0', '0', '0', '0', '2015-01-07 04:25:27', '2015-01-07 04:25:27');
INSERT INTO `foods` VALUES ('18', '鸡汤', '', '好多好多鸡', '46', '8', '0', '0', '0', '0', '2015-01-07 04:26:01', '2015-01-07 04:26:01');
INSERT INTO `foods` VALUES ('19', '炒鱿鱼', 'dir', null, '45', '40', '0', '0', '0', '1', '2015-01-11 02:53:12', '2015-01-11 02:53:12');
INSERT INTO `foods` VALUES ('20', '屎尿', 'dir', '香', '45', '10', '0', '0', '0', '1', '2015-01-11 03:43:22', '2015-01-11 03:44:16');
INSERT INTO `foods` VALUES ('23', '狗屎', 'dir', '你的最爱', '45', '10000', '12312', '0', '0', '0', '2015-01-13 07:26:08', '2015-01-13 07:26:08');

-- ----------------------------
-- Table structure for food_order
-- ----------------------------
DROP TABLE IF EXISTS `food_order`;
CREATE TABLE `food_order` (
  `food_id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `food_order_food_id_index` (`food_id`),
  KEY `food_order_order_id_index` (`order_id`),
  CONSTRAINT `food_order_food_id_foreign` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`) ON DELETE CASCADE,
  CONSTRAINT `food_order_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of food_order
-- ----------------------------

-- ----------------------------
-- Table structure for groups
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES ('4', 'super manager', '{\"manage.restaurant\":1,\"create.categroies\":1,\"delete.categroies\":1,\"manager\":1}', '2015-01-01 08:36:29', '2015-01-03 06:48:33');
INSERT INTO `groups` VALUES ('6', 'restaurant manager', '{\"create.food\":1,\"delete.food\":1,\"edit.food\":1,\"cancel.order\":1,\"restaurant\":1}', '2015-01-01 08:36:29', '2015-01-03 06:48:34');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('2012_12_06_225921_migration_cartalyst_sentry_install_users', '1');
INSERT INTO `migrations` VALUES ('2012_12_06_225929_migration_cartalyst_sentry_install_groups', '1');
INSERT INTO `migrations` VALUES ('2012_12_06_225945_migration_cartalyst_sentry_install_users_groups_pivot', '1');
INSERT INTO `migrations` VALUES ('2012_12_06_225988_migration_cartalyst_sentry_install_throttle', '1');
INSERT INTO `migrations` VALUES ('2014_12_31_122905_create_foods_table', '2');
INSERT INTO `migrations` VALUES ('2014_12_31_123158_create_categorys_table', '2');
INSERT INTO `migrations` VALUES ('2014_12_31_123244_create_comments_table', '2');
INSERT INTO `migrations` VALUES ('2014_12_31_124000_create_orders_table', '2');
INSERT INTO `migrations` VALUES ('2014_12_31_125016_create_category_food_table', '2');
INSERT INTO `migrations` VALUES ('2015_01_01_063438_create_food_order_table', '2');
INSERT INTO `migrations` VALUES ('2015_01_02_022314_create_description_table', '3');
INSERT INTO `migrations` VALUES ('2015_01_05_023951_create_customer_table', '4');
INSERT INTO `migrations` VALUES ('2015_01_05_035251_create_contact_table', '4');
INSERT INTO `migrations` VALUES ('2015_01_14_071413_create_order_user_table', '5');
INSERT INTO `migrations` VALUES ('2015_01_21_120338_add_openid_order', '6');
INSERT INTO `migrations` VALUES ('2015_01_21_120758_create_food_order_table', '6');
INSERT INTO `migrations` VALUES ('2015_01_21_121700_add_field_contacts', '7');
INSERT INTO `migrations` VALUES ('2015_01_21_121837_add_field_comments', '7');
INSERT INTO `migrations` VALUES ('2015_01_21_135941_add_field_contacts', '8');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `total` int(11) DEFAULT NULL,
  `openid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `status` smallint(1) DEFAULT '0',
  `telephone` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `orders_user_id_index` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of orders
-- ----------------------------

-- ----------------------------
-- Table structure for throttle
-- ----------------------------
DROP TABLE IF EXISTS `throttle`;
CREATE TABLE `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attempts` int(11) NOT NULL DEFAULT '0',
  `suspended` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `last_attempt_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `throttle_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of throttle
-- ----------------------------
INSERT INTO `throttle` VALUES ('1', '23', '::1', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('2', '23', '127.0.0.1', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('3', '24', '::1', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('4', '24', '127.0.0.1', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('5', '26', '::1', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('6', '24', '192.168.1.102', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('7', '23', '192.168.1.100', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('8', '44', '::1', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('9', '45', '::1', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('10', '46', '::1', '0', '0', '0', null, null, null);
INSERT INTO `throttle` VALUES ('11', '54', '::1', '0', '0', '0', null, null, null);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description_id` int(10) unsigned DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `activation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `persist_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_activation_code_index` (`activation_code`),
  KEY `users_reset_password_code_index` (`reset_password_code`),
  KEY `description_id` (`description_id`),
  CONSTRAINT `users_descriptions_id_foreign` FOREIGN KEY (`description_id`) REFERENCES `descriptions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('44', '11', 'admin@admin.com', '$2y$10$AqNEQvEyllFg9H5TyZJrcuz3Nvc3hkZAmYzirYVg6TB1uvpcQSbEq', null, '1', null, null, '2015-01-16 15:09:16', '$2y$10$MZake6/zEwX2usZq9g5/bu1Y2WysvyY8XV7T8Oo7f20TZ.d2Iqdl.', null, 'admin', 'admin', '2015-01-10 12:27:47', '2015-01-16 15:09:16');
INSERT INTO `users` VALUES ('45', '2', 'restaurant1@restaurant.com', '$2y$10$CEgYhT.m2vDTY79/jITY8uHfdlvxAPL5jqT5pToqf7tBB0PsfkohO', null, '1', null, null, '2015-01-20 13:14:18', '$2y$10$g7/9jci71tn.Z9Kk3HXs..YjW1PzfTO2OBGT63ZNQpHY2m2BjdCSK', null, 'restaurant1', 'restaurant1', '2015-01-10 12:27:47', '2015-01-20 13:14:19');
INSERT INTO `users` VALUES ('46', '3', 'restaurant2@restaurant.com', '$2y$10$YsCymlk3VRnDDaeCDNRqvOh8xePTeyIbY947URmuxOEOfGZCjM2yq', null, '1', null, null, '2015-01-14 07:48:26', '$2y$10$LVxuY2G9e4vIBNZiB1qsv.Fh//KkjIv7QELlGZInkbudi2GyG9WXC', null, 'restaurant2', 'restaurant2', '2015-01-10 12:27:48', '2015-01-14 07:48:26');
INSERT INTO `users` VALUES ('47', '4', 'restaurant3@restaurant.com', '$2y$10$fODEQWD0QB7ThE9Pz/fDdu2VwXzR5o5BXJe7D34Rlv4ysDyMt4hTe', null, '1', null, null, null, null, null, 'restaurant3', 'restaurant3', '2015-01-10 12:27:48', '2015-01-10 12:27:48');
INSERT INTO `users` VALUES ('48', '5', 'restaurant4@restaurant.com', '$2y$10$gYV.xAkY49oDwWKw05iYE.CPd4gMLkxAAil0Jtyzi4airHi61Pgaq', null, '1', null, null, null, null, null, 'restaurant4', 'restaurant4', '2015-01-10 12:27:48', '2015-01-10 12:27:48');
INSERT INTO `users` VALUES ('49', '6', 'restaurant5@restaurant.com', '$2y$10$POZivnOkrC/FwVKpkMtHD.wYFJ4gwP./czcHbPoct1L.GnGFoImRe', null, '1', null, null, null, null, null, 'restaurant5', 'restaurant5', '2015-01-10 12:27:49', '2015-01-10 12:27:49');
INSERT INTO `users` VALUES ('50', '7', 'restaurant6@restaurant.com', '$2y$10$/ezYR9gosYn4n3C1Lsfo4.v835mdkBdEM8W/FH7Wm7a4iS.6HtBt.', null, '1', null, null, null, null, null, 'restaurant6', 'restaurant6', '2015-01-10 12:27:49', '2015-01-10 12:27:49');
INSERT INTO `users` VALUES ('51', '8', 'restaurant7@restaurant.com', '$2y$10$RYXPOg5IgnBLvbS.F7Bhv.4VBJgbuLHu0EChKCoCo.niVF35BTwKG', null, '1', null, null, null, null, null, 'restaurant7', 'restaurant7', '2015-01-10 12:27:49', '2015-01-10 12:27:49');
INSERT INTO `users` VALUES ('52', '9', 'restaurant8@restaurant.com', '$2y$10$zd.TNXT2.dkuhx359KSkKOCua3i7poF2Yp/ps0V9Yr.w7aEDSMxae', null, '1', null, null, null, null, null, 'restaurant8', 'restaurant8', '2015-01-10 12:27:49', '2015-01-10 12:27:49');
INSERT INTO `users` VALUES ('53', '10', 'restaurant9@restaurant.com', '$2y$10$BcioNcfq8tkhXDd7FNVtdOakmdoOIxmshtL9Zg/XXyVraOwJ6TzmO', null, '1', null, null, null, null, null, 'restaurant9', 'restaurant9', '2015-01-10 12:27:49', '2015-01-10 12:27:49');
INSERT INTO `users` VALUES ('54', '1', 'restaurant10@restaurant.com', '$2y$10$wCOXw0wyVwH0bG2usEHYYeiadAjmki5tPCMOwmBFjfeSEo2Qg1O66', null, '1', null, null, '2015-01-20 13:14:42', '$2y$10$DH8E2LHo2RfZa3ocRGJLMe5eolg4tKtcyF7cy6iIRz3DIGNKKluRq', null, 'restaurant10', 'restaurant10', '2015-01-10 12:27:50', '2015-01-20 13:14:42');

-- ----------------------------
-- Table structure for users_groups
-- ----------------------------
DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE `users_groups` (
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users_groups
-- ----------------------------
INSERT INTO `users_groups` VALUES ('44', '4');
INSERT INTO `users_groups` VALUES ('45', '6');
INSERT INTO `users_groups` VALUES ('46', '6');
INSERT INTO `users_groups` VALUES ('47', '6');
INSERT INTO `users_groups` VALUES ('48', '6');
INSERT INTO `users_groups` VALUES ('49', '6');
INSERT INTO `users_groups` VALUES ('50', '6');
INSERT INTO `users_groups` VALUES ('51', '6');
INSERT INTO `users_groups` VALUES ('52', '6');
INSERT INTO `users_groups` VALUES ('53', '6');
INSERT INTO `users_groups` VALUES ('54', '6');
