-- MariaDB dump 10.17  Distrib 10.4.8-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: s-cart
-- ------------------------------------------------------
-- Server version	10.4.8-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin_config`
--

DROP TABLE IF EXISTS `admin_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_id` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `sort` tinyint(4) NOT NULL DEFAULT 0,
  `detail` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_config_key_unique` (`key`),
  KEY `admin_config_code_index` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_config`
--

LOCK TABLES `admin_config` WRITE;
/*!40000 ALTER TABLE `admin_config` DISABLE KEYS */;
INSERT INTO `admin_config` VALUES (1,'','config','shop_allow_guest','1','1',11,'lang::admin.shop_allow_guest'),(2,'','config','product_preorder','1','1',18,'lang::admin.product_preorder'),(3,'','config','product_display_out_of_stock','1','1',19,'lang::admin.product_display_out_of_stock'),(4,'','config','product_buy_out_of_stock','1','1',20,'lang::admin.product_buy_out_of_stock'),(5,'','config','show_date_available','1','1',21,'lang::admin.show_date_available'),(6,'','display','product_hot','6','1',0,'lang::admin.hot_product'),(7,'','display','product_new','6','1',0,'lang::admin.new_product'),(8,'','display','product_list','18','1',0,'lang::admin.list_product'),(9,'','display','product_relation','4','1',0,'lang::admin.relation_product'),(10,'','display','product_viewed','4','1',0,'lang::admin.viewed_product'),(11,'','display','item_list','12','1',0,'lang::admin.item_list'),(12,'','email_action','email_action_mode','1','1',0,'lang::email.email_action.email_action_mode'),(13,'','email_action','order_success_to_admin','0','1',1,'lang::email.email_action.order_success_to_admin'),(14,'','email_action','order_success_to_customer','0','1',2,'lang::email.email_action.order_success_to_cutomer'),(15,'','email_action','welcome_customer','0','1',4,'lang::email.email_action.welcome_customer'),(16,'','email_action','contact_to_admin','1','1',6,'lang::email.email_action.contact_to_admin'),(17,'','email_action','email_action_smtp_mode','0','1',6,'lang::email.email_action.email_action_smtp_mode'),(18,'Modules','Block','LastViewProduct','1','1',0,'Modules/Block/LastViewProduct::.title'),(19,'Extensions','Payment','Cash','1','1',0,'Extensions/Payment/Cash::Cash.title'),(20,'Extensions','Shipping','ShippingStandard','1','1',0,'lang::Shipping Standard'),(21,'','smtp','smtp_host','','1',8,'lang::email.smtp_host'),(22,'','smtp','smtp_user','','1',7,'lang::email.smtp_user'),(23,'','smtp','smtp_password','','1',6,'lang::email.smtp_password'),(24,'','smtp','smtp_security','','1',5,'lang::email.smtp_security'),(25,'','smtp','smtp_port','','1',4,'lang::email.smtp_port'),(26,'Extensions','Total','Discount','1','1',0,'Extensions/Total/Discount::Discount.title'),(27,'','cache','cache_status','0','1',0,''),(28,'','cache','cache_time','600','1',0,''),(29,'','upload','upload_image_size','2048','1',0,''),(30,'','upload','upload_image_thumb_width','250','1',0,''),(31,'','upload','upload_image_thumb_status','1','1',0,''),(32,'','upload','upload_watermark_status','1','1',0,''),(33,'','upload','upload_watermark_path','images/watermark.png','1',0,''),(34,'','env','SITE_STATUS','on','1',0,'lang::env.SITE_STATUS'),(35,'','env','SITE_TIMEZONE','Asia/Ho_Chi_Minh','1',0,'lang::env.SITE_TIMEZONE'),(36,'','env','SITE_LANGUAGE','en','1',0,'lang::env.SITE_LANGUAGE'),(37,'','env','SITE_CURRENCY','USD','1',0,'lang::env.SITE_CURRENCY'),(38,'','env','APP_DEBUG','off','1',0,'lang::env.APP_DEBUG'),(39,'','env','ADMIN_LOG','on','1',0,'lang::env.ADMIN_LOG'),(40,'','env','ADMIN_LOG_EXP','','1',0,'lang::env.ADMIN_LOG_EXP'),(41,'','env','ADMIN_PREFIX','','1',0,'lang::env.ADMIN_PREFIX'),(42,'','env','ADMIN_NAME','S-Cart System','1',0,'lang::env.ADMIN_NAME'),(43,'','env','ADMIN_TITLE','S-Cart System','1',0,'lang::env.ADMIN_TITLE'),(44,'','env','ADMIN_LOGO','S-Cart Admin','1',0,'lang::env.ADMIN_LOGO'),(45,'','env','ADMIN_LOGO_MINI','<i class=\"fa fa-map-o\" aria-hidden=\"true\"></i>','1',0,'lang::env.ADMIN_LOGO_MINI'),(46,'','env','LOG_SLACK_WEBHOOK_URL','','1',0,'lang::env.LOG_SLACK_WEBHOOK_URL'),(47,'','url','SUFFIX_URL','.html','1',0,'lang::url.SUFFIX_URL'),(48,'','url','PREFIX_BRAND','brand','1',0,'lang::url.PREFIX_BRAND'),(49,'','url','PREFIX_VENDOR','vendor','1',0,'lang::url.PREFIX_VENDOR'),(50,'','url','PREFIX_CATEGORY','category','1',0,'lang::url.PREFIX_CATEGORY'),(51,'','url','PREFIX_PRODUCT','product','1',0,'lang::url.PREFIX_PRODUCT'),(52,'','url','PREFIX_SEARCH','search','1',0,'lang::url.PREFIX_SEARCH'),(53,'','url','PREFIX_CONTACT','contact','1',0,'lang::url.PREFIX_CONTACT'),(54,'','url','PREFIX_NEWS','news','1',0,'lang::url.PREFIX_NEWS'),(55,'','url','PREFIX_MEMBER','member','1',0,'lang::url.PREFIX_MEMBER'),(56,'','url','PREFIX_MEMBER_ORDER_LIST','order-list','1',0,'lang::url.PREFIX_MEMBER_ORDER_LIST'),(57,'','url','PREFIX_MEMBER_CHANGE_PWD','change-password','1',0,'lang::url.PREFIX_MEMBER_CHANGE_PWD'),(58,'','url','PREFIX_MEMBER_CHANGE_INFO','change-info','1',0,'lang::url.PREFIX_MEMBER_CHANGE_INFO'),(59,'','url','PREFIX_CMS_CATEGORY','cms-category','1',0,'lang::url.PREFIX_CMS_CATEGORY'),(60,'','url','PREFIX_CMS_ENTRY','entry','1',0,'lang::url.PREFIX_CMS_ENTRY'),(61,'','url','PREFIX_CART_WISHLIST','wishlst','1',0,'lang::url.PREFIX_CART_WISHLIST'),(62,'','url','PREFIX_CART_COMPARE','compare','1',0,'lang::url.PREFIX_CART_COMPARE'),(63,'','url','PREFIX_CART_DEFAULT','cart','1',0,'lang::url.PREFIX_CART_DEFAULT'),(64,'','url','PREFIX_CART_CHECKOUT','checkout','1',0,'lang::url.PREFIX_CART_CHECKOUT'),(65,'','url','PREFIX_ORDER_SUCCESS','order-success','1',0,'lang::url.PREFIX_ORDER_SUCCESS'),(66,'','product','product_brand','1','1',0,'lang::product.config_manager.brand'),(67,'','product','product_vendor','1','1',0,'lang::product.config_manager.vendor'),(68,'','product','product_price','1','1',0,'lang::product.config_manager.price'),(69,'','product','product_cost','1','1',0,'lang::product.config_manager.cost'),(70,'','product','product_promotion','1','1',0,'lang::product.config_manager.promotion'),(71,'','product','product_stock','1','1',0,'lang::product.config_manager.stock'),(72,'','product','product_type','1','1',0,'lang::product.config_manager.type'),(73,'','product','product_kind','1','1',0,'lang::product.config_manager.kind'),(74,'','product','product_virtual','1','1',0,'lang::product.config_manager.virtual'),(75,'','product','product_attribute','1','1',0,'lang::product.config_manager.attribute'),(76,'','product','product_available','1','1',0,'lang::product.config_manager.available'),(77,'','customer','customer_lastname','1','1',0,'lang::customer.config_manager.lastname'),(78,'','customer','customer_address1','1','1',0,'lang::customer.config_manager.address1'),(79,'','customer','customer_address2','1','1',0,'lang::customer.config_manager.address2'),(80,'','customer','customer_company','0','1',0,'lang::customer.config_manager.company'),(81,'','customer','customer_postcode','0','1',0,'lang::customer.config_manager.postcode'),(82,'','customer','customer_country','1','1',0,'lang::customer.config_manager.country'),(83,'','customer','customer_group','0','1',0,'lang::customer.config_manager.group'),(84,'','customer','customer_birthday','0','1',0,'lang::customer.config_manager.birthday'),(85,'','customer','customer_sex','0','1',0,'lang::customer.config_manager.sex'),(86,'','customer','customer_phone','1','1',1,'lang::customer.config_manager.phone');
/*!40000 ALTER TABLE `admin_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_log`
--

DROP TABLE IF EXISTS `admin_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `input` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_log_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_log`
--

LOCK TABLES `admin_log` WRITE;
/*!40000 ALTER TABLE `admin_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_menu`
--

DROP TABLE IF EXISTS `admin_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `sort` int(11) NOT NULL DEFAULT 0,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT 0,
  `permission` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_menu`
--

LOCK TABLES `admin_menu` WRITE;
/*!40000 ALTER TABLE `admin_menu` DISABLE KEYS */;
INSERT INTO `admin_menu` VALUES (1,6,11,'lang::admin.menu_titles.order_manager','fa-cart-arrow-down','',0,NULL,NULL,NULL),(2,6,12,'lang::admin.menu_titles.catalog_mamager','fa-folder-open','',0,NULL,NULL,NULL),(3,6,13,'lang::admin.menu_titles.customer_manager','fa-group','',0,NULL,NULL,NULL),(4,8,201,'lang::admin.menu_titles.template_layout','fa-object-ungroup','',0,NULL,NULL,NULL),(5,9,301,'lang::admin.menu_titles.config_manager','fa-cogs','',0,NULL,NULL,NULL),(6,0,10,'lang::ADMIN SHOP','fa-minus','',0,NULL,NULL,NULL),(7,0,100,'lang::ADMIN CONTENT','fa-minus','',0,NULL,NULL,NULL),(8,0,200,'lang::ADMIN EXTENSION','fa-minus','',0,NULL,NULL,NULL),(9,0,300,'lang::ADMIN SYSTEM','fa-minus','',0,NULL,NULL,NULL),(10,7,102,'lang::page.admin.title','fa-clone','admin::page',0,NULL,NULL,NULL),(11,1,6,'lang::shipping_status.admin.title','fa-truck','admin::shipping_status',0,NULL,NULL,NULL),(12,1,3,'lang::order.admin.title','fa-shopping-cart','admin::order',0,NULL,NULL,NULL),(13,1,4,'lang::order_status.admin.title','fa-asterisk','admin::order_status',0,NULL,NULL,NULL),(14,1,5,'lang::payment_status.admin.title','fa-recycle','admin::payment_status',0,NULL,NULL,NULL),(15,2,0,'lang::category.admin.title','fa-folder-open-o','admin::category',0,NULL,NULL,NULL),(16,2,0,'lang::product.admin.title','fa-file-photo-o','admin::product',0,NULL,NULL,NULL),(17,2,0,'lang::vendor.admin.title','fa-user-secret','admin::vendor',0,NULL,NULL,NULL),(18,2,0,'lang::brand.admin.title','fa-bank','admin::brand',0,NULL,NULL,NULL),(19,2,0,'lang::attribute_group.admin.title','fa-bars','admin::attribute_group',0,NULL,NULL,NULL),(20,3,0,'lang::customer.admin.title','fa-user','admin::customer',0,NULL,NULL,NULL),(21,3,0,'lang::subscribe.admin.title','fa-user-circle-o','admin::subscribe',0,NULL,NULL,NULL),(22,4,0,'lang::block_content.admin.title','fa-newspaper-o','admin::block_content',0,NULL,NULL,NULL),(23,4,0,'lang::link.admin.title','fa-chrome','admin::link',0,NULL,NULL,NULL),(24,4,0,'lang::template.admin.title','fa-columns','admin::template',0,NULL,NULL,NULL),(25,5,2,'lang::store_value.admin.title','fa-code','admin::store_value',0,NULL,NULL,NULL),(26,5,1,'lang::store_info.admin.title','fa-h-square','admin::store_info',0,NULL,NULL,NULL),(27,5,4,'lang::admin.menu_titles.email_setting','fa-envelope','',0,NULL,NULL,NULL),(28,27,0,'lang::email.admin.title','fa-cog','admin::email',0,NULL,NULL,NULL),(29,27,0,'lang::email_template.admin.title','fa-bars','admin::email_template',0,NULL,NULL,NULL),(30,5,5,'lang::admin.menu_titles.localisation','fa-shirtsinbulk','',0,NULL,NULL,NULL),(31,30,0,'lang::language.admin.title','fa-pagelines','admin::language',0,NULL,NULL,NULL),(32,30,0,'lang::currency.admin.title','fa-dollar','admin::currency',0,NULL,NULL,NULL),(33,7,101,'lang::banner.admin.title','fa-image','admin::banner',0,NULL,NULL,NULL),(34,5,5,'lang::backup.admin.title','fa-save','admin::backup',0,NULL,NULL,NULL),(35,8,202,'lang::admin.menu_titles.extensions','fa-puzzle-piece','',0,NULL,NULL,NULL),(36,8,202,'lang::admin.menu_titles.modules','fa-codepen','',0,NULL,NULL,NULL),(37,9,302,'lang::admin.menu_titles.report_manager','fa-pie-chart','',0,NULL,NULL,NULL),(38,9,0,'lang::admin.menu_titles.admin','fa-sitemap','',0,NULL,NULL,NULL),(39,35,0,'admin.extension_manager.Payment','fa-money','admin::extension/payment',0,NULL,NULL,NULL),(40,35,0,'admin.extension_manager.Shipping','fa-ambulance','admin::extension/shipping',0,NULL,NULL,NULL),(41,35,0,'admin.extension_manager.Total','fa-cog','admin::extension/total',0,NULL,NULL,NULL),(42,35,0,'admin.extension_manager.Other','fa-circle-thin','admin::extension/other',0,NULL,NULL,NULL),(43,36,0,'admin.module_manager.Cms','fa-modx','admin::module/cms',0,NULL,NULL,NULL),(44,36,0,'admin.module_manager.Block','fa-bars','admin::module/block',0,NULL,NULL,NULL),(45,36,0,'admin.module_manager.Other','fa-bars','admin::module/other',0,NULL,NULL,NULL),(46,38,0,'lang::admin.menu_titles.users','fa-users','admin::user',0,NULL,NULL,NULL),(47,38,0,'lang::admin.menu_titles.roles','fa-user','admin::role',0,NULL,NULL,NULL),(48,38,0,'lang::admin.menu_titles.permission','fa-ban','admin::permission',0,NULL,NULL,NULL),(49,38,0,'lang::admin.menu_titles.menu','fa-bars','admin::menu',0,NULL,NULL,NULL),(50,38,0,'lang::admin.menu_titles.operation_log','fa-history','admin::log',0,NULL,NULL,NULL),(51,9,302,'lang::admin.menu_titles.api_manager','fa-plug','',0,NULL,NULL,NULL),(52,7,103,'lang::news.admin.title','fa-file-powerpoint-o','admin::news',0,NULL,NULL,NULL),(53,5,3,'lang::env.title','fa-cog','admin::env',0,NULL,NULL,NULL),(54,37,0,'lang::admin.menu_titles.report_product','fa-bars','admin::report/product',0,NULL,NULL,NULL),(55,5,2,'lang::product.config_manager.title','fa-product-hunt','admin::product_config',0,NULL,NULL,NULL),(56,5,2,'lang::customer.config_manager.title','fa-address-card-o','admin::customer_config',0,NULL,NULL,NULL),(57,5,2,'lang::link.config_manager.title','fa-gg','admin::url_config',0,NULL,NULL,NULL);
/*!40000 ALTER TABLE `admin_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_menu_permission`
--

DROP TABLE IF EXISTS `admin_menu_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_menu_permission` (
  `menu_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`menu_id`,`permission_id`),
  KEY `admin_menu_permission_menu_id_permission_id_index` (`menu_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_menu_permission`
--

LOCK TABLES `admin_menu_permission` WRITE;
/*!40000 ALTER TABLE `admin_menu_permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_menu_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_permission`
--

DROP TABLE IF EXISTS `admin_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `http_uri` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_permission_name_unique` (`name`),
  UNIQUE KEY `admin_permission_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_permission`
--

LOCK TABLES `admin_permission` WRITE;
/*!40000 ALTER TABLE `admin_permission` DISABLE KEYS */;
INSERT INTO `admin_permission` VALUES (1,'Admin manager','admin.manager','GET::sc_admin/user,GET::sc_admin/role,GET::sc_admin/permission,ANY::sc_admin/log/*,ANY::sc_admin/menu/*','2019-12-28 08:37:05',NULL),(2,'Dashboard','dashboard','GET::sc_admin','2019-12-28 08:37:05',NULL),(3,'Auth manager','auth.full','ANY::sc_admin/auth/*','2019-12-28 08:37:05',NULL),(4,'Setting manager','setting.full','ANY::sc_admin/store_info/*,ANY::sc_admin/store_value/*,ANY::sc_admin/url_config/*,ANY::sc_admin/product_config/*, ANY::sc_admin/customer_config/*, ANY::sc_admin/env/*,ANY::sc_admin/email/*,ANY::sc_admin/email_template/*,ANY::sc_admin/language/*,ANY::sc_admin/currency/*,ANY::sc_admin/backup/*','2019-12-28 08:37:05',NULL),(5,'Upload management','upload.full','ANY::sc_admin/uploads/*','2019-12-28 08:37:05',NULL),(6,'Module manager','module.full','ANY::sc_admin/module/*','2019-12-28 08:37:05',NULL),(7,'Extension manager','extension.full','ANY::sc_admin/extension/*','2019-12-28 08:37:05',NULL),(8,'CMS manager','cms.full','ANY::sc_admin/page/*,ANY::sc_admin/banner/*,ANY::sc_admin/cms_category/*,ANY::sc_admin/cms_content/*,ANY::sc_admin/news/*','2019-12-28 08:37:05',NULL),(11,'Discount manager','discount.full','ANY::sc_admin/shop_discount/*','2019-12-28 08:37:05',NULL),(14,'Shipping status','shipping_status.full','ANY::sc_admin/shipping_status/*','2019-12-28 08:37:05',NULL),(15,'Payment  status','payment_status.full','ANY::sc_admin/payment_status/*','2019-12-28 08:37:05',NULL),(17,'Customer manager','customer.full','ANY::sc_admin/customer/*,ANY::sc_admin/subscribe/*','2019-12-28 08:37:05',NULL),(18,'Order status','order_status.full','ANY::sc_admin/order_status/*','2019-12-28 08:37:05',NULL),(19,'Product manager','product.full','ANY::sc_admin/category/*,ANY::sc_admin/vendor/*,ANY::sc_admin/brand/*,ANY::sc_admin/attribute_group/*,ANY::sc_admin/product/*','2019-12-28 08:37:05',NULL),(20,'Order Manager','order.full','ANY::sc_admin/order/*','2019-12-28 08:37:05',NULL),(21,'Report manager','report.full','ANY::sc_admin/report/*','2019-12-28 08:37:05',NULL),(22,'Template manager','template.full','ANY::sc_admin/block_content/*,ANY::sc_admin/link/*,ANY::sc_admin/template/*','2019-12-28 08:37:05',NULL);
/*!40000 ALTER TABLE `admin_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_role`
--

DROP TABLE IF EXISTS `admin_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_role_name_unique` (`name`),
  UNIQUE KEY `admin_role_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_role`
--

LOCK TABLES `admin_role` WRITE;
/*!40000 ALTER TABLE `admin_role` DISABLE KEYS */;
INSERT INTO `admin_role` VALUES (1,'Administrator','administrator','2019-12-28 08:37:05',NULL),(2,'Group only View','view.all','2019-12-28 08:37:05',NULL),(3,'Manager','manager','2019-12-28 08:37:05',NULL),(4,'Cms manager','cms','2019-12-28 08:37:05',NULL),(5,'Accountant','accountant','2019-12-28 08:37:05',NULL),(6,'Marketing','maketing','2019-12-28 08:37:05',NULL);
/*!40000 ALTER TABLE `admin_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_role_menu`
--

DROP TABLE IF EXISTS `admin_role_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_role_menu` (
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`role_id`,`menu_id`),
  KEY `admin_role_menu_role_id_menu_id_index` (`role_id`,`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_role_menu`
--

LOCK TABLES `admin_role_menu` WRITE;
/*!40000 ALTER TABLE `admin_role_menu` DISABLE KEYS */;
INSERT INTO `admin_role_menu` VALUES (1,38,'2019-12-28 08:37:06',NULL),(2,38,'2019-12-28 08:37:06',NULL),(3,38,'2019-12-28 08:37:06',NULL);
/*!40000 ALTER TABLE `admin_role_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_role_permission`
--

DROP TABLE IF EXISTS `admin_role_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_role_permission` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`role_id`,`permission_id`),
  KEY `admin_role_permission_role_id_permission_id_index` (`role_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_role_permission`
--

LOCK TABLES `admin_role_permission` WRITE;
/*!40000 ALTER TABLE `admin_role_permission` DISABLE KEYS */;
INSERT INTO `admin_role_permission` VALUES (3,1,'2019-12-28 08:37:06',NULL),(3,2,'2019-12-28 08:37:06',NULL),(3,3,'2019-12-28 08:37:06',NULL),(3,4,'2019-12-28 08:37:06',NULL),(3,5,'2019-12-28 08:37:06',NULL),(3,8,'2019-12-28 08:37:06',NULL),(3,11,'2019-12-28 08:37:06',NULL),(3,14,'2019-12-28 08:37:06',NULL),(3,15,'2019-12-28 08:37:06',NULL),(3,17,'2019-12-28 08:37:06',NULL),(3,18,'2019-12-28 08:37:06',NULL),(3,19,'2019-12-28 08:37:06',NULL),(3,20,'2019-12-28 08:37:06',NULL),(3,21,'2019-12-28 08:37:06',NULL),(3,22,'2019-12-28 08:37:06',NULL),(4,3,'2019-12-28 08:37:06',NULL),(4,5,'2019-12-28 08:37:06',NULL),(4,8,'2019-12-28 08:37:06',NULL),(5,2,'2019-12-28 08:37:06',NULL),(5,3,'2019-12-28 08:37:06',NULL),(5,20,'2019-12-28 08:37:06',NULL),(5,21,'2019-12-28 08:37:06',NULL),(6,2,'2019-12-28 08:37:06',NULL),(6,3,'2019-12-28 08:37:06',NULL),(6,5,'2019-12-28 08:37:06',NULL),(6,8,'2019-12-28 08:37:06',NULL),(6,11,'2019-12-28 08:37:06',NULL),(6,14,'2019-12-28 08:37:06',NULL),(6,15,'2019-12-28 08:37:06',NULL),(6,17,'2019-12-28 08:37:06',NULL),(6,18,'2019-12-28 08:37:06',NULL),(6,19,'2019-12-28 08:37:06',NULL),(6,20,'2019-12-28 08:37:06',NULL),(6,21,'2019-12-28 08:37:06',NULL);
/*!40000 ALTER TABLE `admin_role_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_role_user`
--

DROP TABLE IF EXISTS `admin_role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_role_user` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_user_role_id_user_id_index` (`role_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_role_user`
--

LOCK TABLES `admin_role_user` WRITE;
/*!40000 ALTER TABLE `admin_role_user` DISABLE KEYS */;
INSERT INTO `admin_role_user` VALUES (1,1,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_store`
--

DROP TABLE IF EXISTS `admin_store`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_store` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_status` tinyint(4) NOT NULL DEFAULT 1,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `long_phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_active` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `template` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_store`
--

LOCK TABLES `admin_store` WRITE;
/*!40000 ALTER TABLE `admin_store` DISABLE KEYS */;
INSERT INTO `admin_store` VALUES (1,'/data/logo/scart-mid.png',1,'0123456789','Support: 0987654321','admin-demo@s-cart.org','','123st - abc - xyz','default');
/*!40000 ALTER TABLE `admin_store` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_store_description`
--

DROP TABLE IF EXISTS `admin_store_description`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_store_description` (
  `config_id` int(11) NOT NULL,
  `lang` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keyword` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maintain_content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`config_id`,`lang`),
  KEY `admin_store_description_lang_index` (`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_store_description`
--

LOCK TABLES `admin_store_description` WRITE;
/*!40000 ALTER TABLE `admin_store_description` DISABLE KEYS */;
INSERT INTO `admin_store_description` VALUES (1,'en','Demo S-cart : Free Laravel eCommerce for Business','Free website shopping cart for business','','<center><img src=\"/images/maintenance.png\" />\r\n<h3><span style=\"color:#e74c3c;\"><strong>Sorry! We are currently doing site maintenance!</strong></span></h3>\r\n</center>'),(1,'vi','Demo S-cart: Mã nguồn website thương mại điện tử miễn phí cho doanh nghiệp','Laravel shopping cart for business','','<center><img src=\"/images/maintenance.png\" />\r\n<h3><span style=\"color:#e74c3c;\"><strong>Sorry! We are currently doing site maintenance!</strong></span></h3>\r\n</center>');
/*!40000 ALTER TABLE `admin_store_description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_user`
--

DROP TABLE IF EXISTS `admin_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_user_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_user`
--

LOCK TABLES `admin_user` WRITE;
/*!40000 ALTER TABLE `admin_user` DISABLE KEYS */;
INSERT INTO `admin_user` VALUES (1,'admin','$2y$10$JcmAHe5eUZ2rS0jU1GWr/.xhwCnh2RU13qwjTPcqfmtZXjZxcryPO','Administrator','/admin/avatar/user.jpg',NULL,'2019-12-28 08:37:06',NULL);
/*!40000 ALTER TABLE `admin_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_user_permission`
--

DROP TABLE IF EXISTS `admin_user_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_user_permission` (
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`permission_id`),
  KEY `admin_user_permission_user_id_permission_id_index` (`user_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_user_permission`
--

LOCK TABLES `admin_user_permission` WRITE;
/*!40000 ALTER TABLE `admin_user_permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_user_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2019_00_00_v33_create_admin_tables',1),(2,'2019_00_00_v33_create_shop_tables',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shipping_standard`
--

DROP TABLE IF EXISTS `shipping_standard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shipping_standard` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fee` int(11) NOT NULL,
  `shipping_free` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipping_standard`
--

LOCK TABLES `shipping_standard` WRITE;
/*!40000 ALTER TABLE `shipping_standard` DISABLE KEYS */;
INSERT INTO `shipping_standard` VALUES (1,20000,100000);
/*!40000 ALTER TABLE `shipping_standard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_api`
--

DROP TABLE IF EXISTS `shop_api`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_api` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hidden_default` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shop_api_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_api`
--

LOCK TABLES `shop_api` WRITE;
/*!40000 ALTER TABLE `shop_api` DISABLE KEYS */;
INSERT INTO `shop_api` VALUES (1,'api_product_list','','secret'),(2,'api_product_detail','cost,sold,stock,sort','private'),(3,'api_order_list','','public'),(4,'api_order_detail','','secret');
/*!40000 ALTER TABLE `shop_api` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_api_process`
--

DROP TABLE IF EXISTS `shop_api_process`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_api_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `api_id` int(11) NOT NULL,
  `secret_key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hidden_fileds` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_allow` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_deny` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exp` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shop_api_process_secret_key_unique` (`secret_key`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_api_process`
--

LOCK TABLES `shop_api_process` WRITE;
/*!40000 ALTER TABLE `shop_api_process` DISABLE KEYS */;
INSERT INTO `shop_api_process` VALUES (1,1,'!CVCBsd$6j9ds3%flh[^d','descriptions,cost','','127.0.0.11,1233.2.2.3','2019-12-14 00:00:00',1,NULL,NULL),(2,1,'%GSFf13gkLtP@d','','','',NULL,1,NULL,NULL);
/*!40000 ALTER TABLE `shop_api_process` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_attribute_group`
--

DROP TABLE IF EXISTS `shop_attribute_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_attribute_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `sort` tinyint(4) NOT NULL DEFAULT 0,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'radio,select,checkbox',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_attribute_group`
--

LOCK TABLES `shop_attribute_group` WRITE;
/*!40000 ALTER TABLE `shop_attribute_group` DISABLE KEYS */;
INSERT INTO `shop_attribute_group` VALUES (1,'Color',1,1,'radio'),(2,'Size',1,2,'select');
/*!40000 ALTER TABLE `shop_attribute_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_banner`
--

DROP TABLE IF EXISTS `shop_banner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_banner` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `html` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `sort` tinyint(4) NOT NULL DEFAULT 0,
  `click` tinyint(4) NOT NULL DEFAULT 0,
  `type` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_banner`
--

LOCK TABLES `shop_banner` WRITE;
/*!40000 ALTER TABLE `shop_banner` DISABLE KEYS */;
INSERT INTO `shop_banner` VALUES (1,'/data/banner/Main-banner-1-1903x600.jpg',NULL,'_self','',1,0,0,1,NULL,NULL),(2,'/data/banner/Main-banner-3-1903x600.jpg',NULL,'_self','',1,0,0,1,NULL,NULL);
/*!40000 ALTER TABLE `shop_banner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_block_content`
--

DROP TABLE IF EXISTS `shop_block_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_block_content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `sort` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_block_content`
--

LOCK TABLES `shop_block_content` WRITE;
/*!40000 ALTER TABLE `shop_block_content` DISABLE KEYS */;
INSERT INTO `shop_block_content` VALUES (1,'Facebook code','top','*','html','<div id=\"fb-root\"></div>\r\n<script>(function(d, s, id) {\r\n  var js, fjs = d.getElementsByTagName(s)[0];\r\n  if (d.getElementById(id)) return;\r\n  js = d.createElement(s); js.id = id;\r\n  js.src = \'//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=934208239994473\';\r\n  fjs.parentNode.insertBefore(js, fjs);\r\n}(document, \'script\', \'facebook-jssdk\'));\r\n</script>',1,0),(2,'Google Analytics','header','*','html','<!-- Global site tag (gtag.js) - Google Analytics -->\r\n<script async src=\"https://www.googletagmanager.com/gtag/js?id=UA-128658138-1\"></script>\r\n<script>\r\n  window.dataLayer = window.dataLayer || [];\r\n  function gtag(){dataLayer.push(arguments);}\r\n  gtag(\'js\', new Date());\r\n  gtag(\'config\', \'UA-128658138-1\');\r\n</script>',1,0),(3,'Product special','left','home,product_list','view','product_special',1,1),(4,'Brands','left','home,item_list','view','brands_left',1,3),(5,'Banner home','banner_top','home','view','banner_image',1,0),(6,'Categories','left','home,product_list,product_detail,shop_wishlist','view','categories',1,4),(7,'Product last view','left','*','module','LastViewProduct',1,0);
/*!40000 ALTER TABLE `shop_block_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_brand`
--

DROP TABLE IF EXISTS `shop_brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_brand` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `sort` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shop_brand_alias_unique` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_brand`
--

LOCK TABLES `shop_brand` WRITE;
/*!40000 ALTER TABLE `shop_brand` DISABLE KEYS */;
INSERT INTO `shop_brand` VALUES (1,'Husq','husq','/data/brand/01-181x52.png','',1,0),(2,'Ideal','ideal','/data/brand/02-181x52.png','',1,0),(3,'Apex','apex','/data/brand/03-181x52.png','',1,0),(4,'CST','cst','/data/brand/04-181x52.png','',1,0),(5,'Klein','klein','/data/brand/05-181x52.png','',1,0),(6,'Metabo','metabo','/data/brand/06-181x52.png','',1,0),(7,'Avatar','avatar','/data/brand/07-181x52.png','',1,0),(8,'Brand KA','brand-ka','/data/brand/08-181x52.png','',1,0);
/*!40000 ALTER TABLE `shop_brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_category`
--

DROP TABLE IF EXISTS `shop_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT 0,
  `top` int(11) DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `sort` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shop_category_alias_unique` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_category`
--

LOCK TABLES `shop_category` WRITE;
/*!40000 ALTER TABLE `shop_category` DISABLE KEYS */;
INSERT INTO `shop_category` VALUES (1,'/data/category/img-40.jpg','electronics',0,1,1,0),(2,'/data/category/img-44.jpg','clothing-wears',0,1,1,0),(3,'/data/category/img-42.jpg','mobile',1,1,1,0),(4,'/data/category/img-18.jpg','accessaries-extras',0,1,1,0),(5,'/data/category/img-14.jpg','computers',1,1,1,0),(6,'/data/category/img-14.jpg','tablets',1,0,1,0),(7,'/data/category/img-40.jpg','appliances',1,0,1,0),(8,'/data/category/img-14.jpg','men-clothing',2,0,1,0),(9,'/data/category/img-18.jpg','women-clothing',2,1,1,0),(10,'/data/category/img-14.jpg','kid-wear',2,0,1,0),(11,'/data/category/img-40.jpg','mobile-accessaries',4,0,1,0),(12,'/data/category/img-42.jpg4','women-accessaries',4,0,1,3),(13,'/data/category/img-40.jpg','men-accessaries',4,0,1,3);
/*!40000 ALTER TABLE `shop_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_category_description`
--

DROP TABLE IF EXISTS `shop_category_description`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_category_description` (
  `category_id` int(11) NOT NULL,
  `lang` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keyword` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`category_id`,`lang`),
  KEY `shop_category_description_lang_index` (`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_category_description`
--

LOCK TABLES `shop_category_description` WRITE;
/*!40000 ALTER TABLE `shop_category_description` DISABLE KEYS */;
INSERT INTO `shop_category_description` VALUES (1,'en','Electronics','',''),(1,'vi','Thiết bị điện tử','',''),(2,'en','Clothing & Wears','',''),(2,'vi','Quần áo','',''),(3,'en','Mobile','',''),(3,'vi','Điện thoại','',''),(4,'en','Accessaries & Extras','',''),(4,'vi','Phụ kiện ','',''),(5,'en','Computers','',''),(5,'vi','Máy tính','',''),(6,'en','Tablets','',''),(6,'vi','Máy tính bảng','',''),(7,'en','Appliances','',''),(7,'vi','Thiết bị','',''),(8,'en','Men\'s Clothing','',''),(8,'vi','Quần áo nam','',''),(9,'en','Women\'s Clothing','',''),(9,'vi','Quần áo nữ','',''),(10,'en','Kid\'s Wear','',''),(10,'vi','Đồ trẻ em','',''),(11,'en','Mobile Accessaries','',''),(11,'vi','Phụ kiện điện thoại','',''),(12,'en','Women\'s Accessaries','',''),(12,'vi','Phụ kiện nam','',''),(13,'en','Men\'s Accessaries','',''),(13,'vi','Phụ kiện nữ','','');
/*!40000 ALTER TABLE `shop_category_description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_country`
--

DROP TABLE IF EXISTS `shop_country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_country` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shop_country_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=246 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_country`
--

LOCK TABLES `shop_country` WRITE;
/*!40000 ALTER TABLE `shop_country` DISABLE KEYS */;
INSERT INTO `shop_country` VALUES (1,'AL','Albania'),(2,'DZ','Algeria'),(3,'DS','American Samoa'),(4,'AD','Andorra'),(5,'AO','Angola'),(6,'AI','Anguilla'),(7,'AQ','Antarctica'),(8,'AG','Antigua and Barbuda'),(9,'AR','Argentina'),(10,'AM','Armenia'),(11,'AW','Aruba'),(12,'AU','Australia'),(13,'AT','Austria'),(14,'AZ','Azerbaijan'),(15,'BS','Bahamas'),(16,'BH','Bahrain'),(17,'BD','Bangladesh'),(18,'BB','Barbados'),(19,'BY','Belarus'),(20,'BE','Belgium'),(21,'BZ','Belize'),(22,'BJ','Benin'),(23,'BM','Bermuda'),(24,'BT','Bhutan'),(25,'BO','Bolivia'),(26,'BA','Bosnia and Herzegovina'),(27,'BW','Botswana'),(28,'BV','Bouvet Island'),(29,'BR','Brazil'),(30,'IO','British Indian Ocean Territory'),(31,'BN','Brunei Darussalam'),(32,'BG','Bulgaria'),(33,'BF','Burkina Faso'),(34,'BI','Burundi'),(35,'KH','Cambodia'),(36,'CM','Cameroon'),(37,'CA','Canada'),(38,'CV','Cape Verde'),(39,'KY','Cayman Islands'),(40,'CF','Central African Republic'),(41,'TD','Chad'),(42,'CL','Chile'),(43,'CN','China'),(44,'CX','Christmas Island'),(45,'CC','Cocos (Keeling) Islands'),(46,'CO','Colombia'),(47,'KM','Comoros'),(48,'CG','Congo'),(49,'CK','Cook Islands'),(50,'CR','Costa Rica'),(51,'HR','Croatia (Hrvatska)'),(52,'CU','Cuba'),(53,'CY','Cyprus'),(54,'CZ','Czech Republic'),(55,'DK','Denmark'),(56,'DJ','Djibouti'),(57,'DM','Dominica'),(58,'DO','Dominican Republic'),(59,'TP','East Timor'),(60,'EC','Ecuador'),(61,'EG','Egypt'),(62,'SV','El Salvador'),(63,'GQ','Equatorial Guinea'),(64,'ER','Eritrea'),(65,'EE','Estonia'),(66,'ET','Ethiopia'),(67,'FK','Falkland Islands (Malvinas)'),(68,'FO','Faroe Islands'),(69,'FJ','Fiji'),(70,'FI','Finland'),(71,'FR','France'),(72,'FX','France, Metropolitan'),(73,'GF','French Guiana'),(74,'PF','French Polynesia'),(75,'TF','French Southern Territories'),(76,'GA','Gabon'),(77,'GM','Gambia'),(78,'GE','Georgia'),(79,'DE','Germany'),(80,'GH','Ghana'),(81,'GI','Gibraltar'),(82,'GK','Guernsey'),(83,'GR','Greece'),(84,'GL','Greenland'),(85,'GD','Grenada'),(86,'GP','Guadeloupe'),(87,'GU','Guam'),(88,'GT','Guatemala'),(89,'GN','Guinea'),(90,'GW','Guinea-Bissau'),(91,'GY','Guyana'),(92,'HT','Haiti'),(93,'HM','Heard and Mc Donald Islands'),(94,'HN','Honduras'),(95,'HK','Hong Kong'),(96,'HU','Hungary'),(97,'IS','Iceland'),(98,'IN','India'),(99,'IM','Isle of Man'),(100,'ID','Indonesia'),(101,'IR','Iran (Islamic Republic of)'),(102,'IQ','Iraq'),(103,'IE','Ireland'),(104,'IL','Israel'),(105,'IT','Italy'),(106,'CI','Ivory Coast'),(107,'JE','Jersey'),(108,'JM','Jamaica'),(109,'JP','Japan'),(110,'JO','Jordan'),(111,'KZ','Kazakhstan'),(112,'KE','Kenya'),(113,'KI','Kiribati'),(114,'KP','Korea,Democratic People\'s Republic of'),(115,'KR','Korea, Republic of'),(116,'XK','Kosovo'),(117,'KW','Kuwait'),(118,'KG','Kyrgyzstan'),(119,'LA','Lao People\'s Democratic Republic'),(120,'LV','Latvia'),(121,'LB','Lebanon'),(122,'LS','Lesotho'),(123,'LR','Liberia'),(124,'LY','Libyan Arab Jamahiriya'),(125,'LI','Liechtenstein'),(126,'LT','Lithuania'),(127,'LU','Luxembourg'),(128,'MO','Macau'),(129,'MK','Macedonia'),(130,'MG','Madagascar'),(131,'MW','Malawi'),(132,'MY','Malaysia'),(133,'MV','Maldives'),(134,'ML','Mali'),(135,'MT','Malta'),(136,'MH','Marshall Islands'),(137,'MQ','Martinique'),(138,'MR','Mauritania'),(139,'MU','Mauritius'),(140,'TY','Mayotte'),(141,'MX','Mexico'),(142,'FM','Micronesia, Federated States of'),(143,'MD','Moldova, Republic of'),(144,'MC','Monaco'),(145,'MN','Mongolia'),(146,'ME','Montenegro'),(147,'MS','Montserrat'),(148,'MA','Morocco'),(149,'MZ','Mozambique'),(150,'MM','Myanmar'),(151,'NA','Namibia'),(152,'NR','Nauru'),(153,'NP','Nepal'),(154,'NL','Netherlands'),(155,'AN','Netherlands Antilles'),(156,'NC','New Caledonia'),(157,'NZ','New Zealand'),(158,'NI','Nicaragua'),(159,'NE','Niger'),(160,'NG','Nigeria'),(161,'NU','Niue'),(162,'NF','Norfolk Island'),(163,'MP','Northern Mariana Islands'),(164,'NO','Norway'),(165,'OM','Oman'),(166,'PK','Pakistan'),(167,'PW','Palau'),(168,'PS','Palestine'),(169,'PA','Panama'),(170,'PG','Papua New Guinea'),(171,'PY','Paraguay'),(172,'PE','Peru'),(173,'PH','Philippines'),(174,'PN','Pitcairn'),(175,'PL','Poland'),(176,'PT','Portugal'),(177,'PR','Puerto Rico'),(178,'QA','Qatar'),(179,'RE','Reunion'),(180,'RO','Romania'),(181,'RU','Russian Federation'),(182,'RW','Rwanda'),(183,'KN','Saint Kitts and Nevis'),(184,'LC','Saint Lucia'),(185,'VC','Saint Vincent and the Grenadines'),(186,'WS','Samoa'),(187,'SM','San Marino'),(188,'ST','Sao Tome and Principe'),(189,'SA','Saudi Arabia'),(190,'SN','Senegal'),(191,'RS','Serbia'),(192,'SC','Seychelles'),(193,'SL','Sierra Leone'),(194,'SG','Singapore'),(195,'SK','Slovakia'),(196,'SI','Slovenia'),(197,'SB','Solomon Islands'),(198,'SO','Somalia'),(199,'ZA','South Africa'),(200,'GS','South Georgia South Sandwich Islands'),(201,'SS','South Sudan'),(202,'ES','Spain'),(203,'LK','Sri Lanka'),(204,'SH','St. Helena'),(205,'PM','St. Pierre and Miquelon'),(206,'SD','Sudan'),(207,'SR','Suriname'),(208,'SJ','Svalbard and Jan Mayen Islands'),(209,'SZ','Swaziland'),(210,'SE','Sweden'),(211,'CH','Switzerland'),(212,'SY','Syrian Arab Republic'),(213,'TW','Taiwan'),(214,'TJ','Tajikistan'),(215,'TZ','Tanzania, United Republic of'),(216,'TH','Thailand'),(217,'TG','Togo'),(218,'TK','Tokelau'),(219,'TO','Tonga'),(220,'TT','Trinidad and Tobago'),(221,'TN','Tunisia'),(222,'TR','Turkey'),(223,'TM','Turkmenistan'),(224,'TC','Turks and Caicos Islands'),(225,'TV','Tuvalu'),(226,'UG','Uganda'),(227,'UA','Ukraine'),(228,'AE','United Arab Emirates'),(229,'GB','United Kingdom'),(230,'US','United States'),(231,'UM','United States minor outlying islands'),(232,'UY','Uruguay'),(233,'UZ','Uzbekistan'),(234,'VU','Vanuatu'),(235,'VA','Vatican City State'),(236,'VE','Venezuela'),(237,'VN','Vietnam'),(238,'VG','Virgin Islands (British)'),(239,'VI','Virgin Islands (U.S.)'),(240,'WF','Wallis and Futuna Islands'),(241,'EH','Western Sahara'),(242,'YE','Yemen'),(243,'ZR','Zaire'),(244,'ZM','Zambia'),(245,'ZW','Zimbabwe');
/*!40000 ALTER TABLE `shop_country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_currency`
--

DROP TABLE IF EXISTS `shop_currency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_currency` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exchange_rate` double(8,2) NOT NULL,
  `precision` tinyint(4) NOT NULL DEFAULT 2,
  `symbol_first` tinyint(4) NOT NULL DEFAULT 0,
  `thousands` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ',',
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `sort` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shop_currency_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_currency`
--

LOCK TABLES `shop_currency` WRITE;
/*!40000 ALTER TABLE `shop_currency` DISABLE KEYS */;
INSERT INTO `shop_currency` VALUES (1,'USD Dola','USD','$',1.00,0,1,',',1,0),(2,'VietNam Dong','VND','₫',20.00,0,0,',',1,1);
/*!40000 ALTER TABLE `shop_currency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_discount`
--

DROP TABLE IF EXISTS `shop_discount`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_discount` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reward` int(11) NOT NULL DEFAULT 2,
  `type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'point' COMMENT 'point - Point; percent - %',
  `data` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `limit` int(11) NOT NULL DEFAULT 1,
  `used` int(11) NOT NULL DEFAULT 0,
  `login` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shop_discount_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_discount`
--

LOCK TABLES `shop_discount` WRITE;
/*!40000 ALTER TABLE `shop_discount` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_discount` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_discount_user`
--

DROP TABLE IF EXISTS `shop_discount_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_discount_user` (
  `user_id` int(11) NOT NULL,
  `discount_id` int(11) NOT NULL,
  `log` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `used_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_discount_user`
--

LOCK TABLES `shop_discount_user` WRITE;
/*!40000 ALTER TABLE `shop_discount_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_discount_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_email_template`
--

DROP TABLE IF EXISTS `shop_email_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_email_template` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_email_template`
--

LOCK TABLES `shop_email_template` WRITE;
/*!40000 ALTER TABLE `shop_email_template` DISABLE KEYS */;
INSERT INTO `shop_email_template` VALUES (1,'Reset password','forgot_password','<h1 style=\"font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#2f3133;font-size:19px;font-weight:bold;margin-top:0;text-align:left\">{{$title}}</h1>\r\n<p style=\"font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left\">{{$reason_sendmail}}</p>\r\n                    <table class=\"action\" align=\"center\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" style=\"font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;margin:30px auto;padding:0;text-align:center;width:100%\">\r\n                      <tbody><tr>\r\n                        <td align=\"center\" style=\"font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box\">\r\n                          <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box\">\r\n                            <tbody><tr>\r\n                              <td align=\"center\" style=\"font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box\">\r\n                                <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box\">\r\n                                  <tbody><tr>\r\n                                    <td style=\"font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box\">\r\n                                      <a href=\"{{$reset_link}}\" class=\"button button-primary\" style=\"font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;border-radius:3px;color:#fff;display:inline-block;text-decoration:none;background-color:#3097d1;border-top:10px solid #3097d1;border-right:18px solid #3097d1;border-bottom:10px solid #3097d1;border-left:18px solid #3097d1\" target=\"_blank\">{{$reset_button}}</a>\r\n                                    </td>\r\n                                  </tr>\r\n                                </tbody>\r\n                              </table>\r\n                              </td>\r\n                            </tr>\r\n                          </tbody>\r\n                        </table>\r\n                        </td>\r\n                      </tr>\r\n                    </tbody>\r\n                  </table>\r\n                    <p style=\"font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left\">\r\n                      {{$note_sendmail}}\r\n                    </p>\r\n                    <table class=\"subcopy\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" style=\"font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;border-top:1px solid #edeff2;margin-top:25px;padding-top:25px\">\r\n                    <tbody><tr>\r\n                      <td style=\"font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box\">\r\n                        <p style=\"font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;line-height:1.5em;margin-top:0;text-align:left;font-size:12px\">{{$note_access_link}}: <a href=\"{{$reset_link}}\" style=\"font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#3869d4\" target=\"_blank\">{{$reset_link}}</a></p>\r\n                          </td>\r\n                        </tr>\r\n                      </tbody>\r\n                    </table>',1),(2,'Welcome new customer','welcome_customer','<h1 style=\"font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#2f3133;font-size:19px;font-weight:bold;margin-top:0;text-align:center\">{{$title}}</h1>\r\n<p style=\"text-align:center;\">Welcome to my site!</p>',1),(3,'Send form contact to admin','contact_to_admin','<table class=\"inner-body\" align=\"center\" width=\"570\" cellpadding=\"0\" cellspacing=\"0\">\r\n    <tr>\r\n        <td>\r\n            <b>Name</b>: {{$name}}<br>\r\n            <b>Email</b>: {{$email}}<br>\r\n            <b>Phone</b>: {{$phone}}<br>\r\n        </td>\r\n    </tr>\r\n</table>\r\n<hr>\r\n<p style=\"text-align: center;\">Content:<br>\r\n<table class=\"inner-body\" align=\"center\" width=\"570\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">\r\n    <tr>\r\n        <td>{{$content}}</td>\r\n    </tr>\r\n</table>',1),(4,'New order to admin','order_success_to_admin','<table class=\"inner-body\" align=\"center\" width=\"570\" cellpadding=\"0\" cellspacing=\"0\">\r\n                        <tr>\r\n                            <td>\r\n                                <b>Order ID</b>: {{$orderID}}<br>\r\n                                <b>Customer name</b>: {{$toname}}<br>\r\n                                <b>Email</b>: {{$email}}<br>\r\n                                <b>Address</b>: {{$address}}<br>\r\n                                <b>Phone</b>: {{$phone}}<br>\r\n                                <b>Order note</b>: {{$comment}}\r\n                            </td>\r\n                        </tr>\r\n                    </table>\r\n                    <hr>\r\n                    <p style=\"text-align: center;\">Order detail:<br>\r\n                    ===================================<br></p>\r\n                    <table class=\"inner-body\" align=\"center\" width=\"570\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\">\r\n                        {{$orderDetail}}\r\n                        <tr>\r\n                            <td colspan=\"2\"></td>\r\n                            <td colspan=\"2\" style=\"font-weight: bold;\">Sub total</td>\r\n                            <td colspan=\"2\" align=\"right\">{{$subtotal}}</td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td colspan=\"2\"></td>\r\n                            <td colspan=\"2\" style=\"font-weight: bold;\">Shipping fee</td>\r\n                            <td colspan=\"2\" align=\"right\">{{$shipping}}</td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td colspan=\"2\"></td>\r\n                            <td colspan=\"2\" style=\"font-weight: bold;\">Discount</td>\r\n                            <td colspan=\"2\" align=\"right\">{{$discount}}</td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td colspan=\"2\"></td>\r\n                            <td colspan=\"2\" style=\"font-weight: bold;\">Total</td>\r\n                            <td colspan=\"2\" align=\"right\">{{$total}}</td>\r\n                        </tr>\r\n                    </table>',1),(5,'New order to customr','order_success_to_customer','<table class=\"inner-body\" align=\"center\" width=\"570\" cellpadding=\"0\" cellspacing=\"0\">\r\n                        <tr>\r\n                            <td>\r\n                                <b>Order ID</b>: {{$orderID}}<br>\r\n                                <b>Customer name</b>: {{$toname}}<br>\r\n                                <b>Address</b>: {{$address}}<br>\r\n                                <b>Phone</b>: {{$phone}}<br>\r\n                                <b>Order note</b>: {{$comment}}\r\n                            </td>\r\n                        </tr>\r\n                    </table>\r\n                    <hr>\r\n                    <p style=\"text-align: center;\">Order detail:<br>\r\n                    ===================================<br></p>\r\n                    <table class=\"inner-body\" align=\"center\" width=\"570\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\">\r\n                        {{$orderDetail}}\r\n                        <tr>\r\n                            <td colspan=\"2\"></td>\r\n                            <td colspan=\"2\" style=\"font-weight: bold;\">Sub total</td>\r\n                            <td colspan=\"2\" align=\"right\">{{$subtotal}}</td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td colspan=\"2\"></td>\r\n                            <td colspan=\"2\" style=\"font-weight: bold;\">Shipping fee</td>\r\n                            <td colspan=\"2\" align=\"right\">{{$shipping}}</td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td colspan=\"2\"></td>\r\n                            <td colspan=\"2\" style=\"font-weight: bold;\">Discount</td>\r\n                            <td colspan=\"2\" align=\"right\">{{$discount}}</td>\r\n                        </tr>\r\n                        <tr>\r\n                            <td colspan=\"2\"></td>\r\n                            <td colspan=\"2\" style=\"font-weight: bold;\">Total</td>\r\n                            <td colspan=\"2\" align=\"right\">{{$total}}</td>\r\n                        </tr>\r\n                    </table>',1);
/*!40000 ALTER TABLE `shop_email_template` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_language`
--

DROP TABLE IF EXISTS `shop_language`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_language` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `sort` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shop_language_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_language`
--

LOCK TABLES `shop_language` WRITE;
/*!40000 ALTER TABLE `shop_language` DISABLE KEYS */;
INSERT INTO `shop_language` VALUES (1,'English','en','/data/language/flag_uk.png',1,1),(2,'Tiếng Việt','vi','/data/language/flag_vn.png',1,1);
/*!40000 ALTER TABLE `shop_language` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_layout_page`
--

DROP TABLE IF EXISTS `shop_layout_page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_layout_page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shop_layout_page_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_layout_page`
--

LOCK TABLES `shop_layout_page` WRITE;
/*!40000 ALTER TABLE `shop_layout_page` DISABLE KEYS */;
INSERT INTO `shop_layout_page` VALUES (1,'home','Home page'),(2,'product_list','Product list'),(3,'product_detail','Product detail'),(4,'shop_cart','Shop cart'),(5,'shop_account','Account'),(6,'shop_profile','Profile'),(7,'shop_compare','Compare page'),(8,'shop_wishlist','Wishlist page'),(9,'item_list','Item list');
/*!40000 ALTER TABLE `shop_layout_page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_layout_position`
--

DROP TABLE IF EXISTS `shop_layout_position`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_layout_position` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shop_layout_position_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_layout_position`
--

LOCK TABLES `shop_layout_position` WRITE;
/*!40000 ALTER TABLE `shop_layout_position` DISABLE KEYS */;
INSERT INTO `shop_layout_position` VALUES (1,'meta','Meta'),(2,'header','Header'),(3,'top','Top'),(4,'bottom','Bottom'),(5,'footer','Footer'),(6,'left','Column left'),(7,'right','Column right'),(8,'banner_top','Banner top');
/*!40000 ALTER TABLE `shop_layout_position` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_layout_type`
--

DROP TABLE IF EXISTS `shop_layout_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_layout_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shop_layout_type_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_layout_type`
--

LOCK TABLES `shop_layout_type` WRITE;
/*!40000 ALTER TABLE `shop_layout_type` DISABLE KEYS */;
INSERT INTO `shop_layout_type` VALUES (1,'html','Html'),(2,'view','View'),(3,'module','Module');
/*!40000 ALTER TABLE `shop_layout_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_link`
--

DROP TABLE IF EXISTS `shop_link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_link` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `sort` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_link`
--

LOCK TABLES `shop_link` WRITE;
/*!40000 ALTER TABLE `shop_link` DISABLE KEYS */;
INSERT INTO `shop_link` VALUES (1,'lang::front.contact','route::pages::contact','_self','menu','',1,3),(2,'lang::front.about','route::pages::about','_self','menu','',1,4),(3,'S-Cart','https://s-cart.org','_blank','menu','',1,0),(4,'lang::front.my_profile','/member/login.html','_self','footer','',1,5),(5,'lang::front.compare_page','/compare.html','_self','footer','',1,4),(6,'lang::front.wishlist_page','route::wishlist','_self','footer','',1,3);
/*!40000 ALTER TABLE `shop_link` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_news`
--

DROP TABLE IF EXISTS `shop_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shop_news_alias_unique` (`alias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_news`
--

LOCK TABLES `shop_news` WRITE;
/*!40000 ALTER TABLE `shop_news` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_news_description`
--

DROP TABLE IF EXISTS `shop_news_description`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_news_description` (
  `shop_news_id` int(11) NOT NULL,
  `lang` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keyword` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`shop_news_id`,`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_news_description`
--

LOCK TABLES `shop_news_description` WRITE;
/*!40000 ALTER TABLE `shop_news_description` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_news_description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_order`
--

DROP TABLE IF EXISTS `shop_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `subtotal` int(11) DEFAULT 0,
  `shipping` int(11) DEFAULT 0,
  `discount` int(11) DEFAULT 0,
  `payment_status` int(11) NOT NULL DEFAULT 1,
  `shipping_status` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 0,
  `tax` int(11) DEFAULT 0,
  `total` int(11) DEFAULT 0,
  `currency` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exchange_rate` double(8,2) DEFAULT NULL,
  `received` int(11) DEFAULT 0,
  `balance` int(11) DEFAULT 0,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address2` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'VN',
  `company` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_method` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_order`
--

LOCK TABLES `shop_order` WRITE;
/*!40000 ALTER TABLE `shop_order` DISABLE KEYS */;
INSERT INTO `shop_order` VALUES (1,1,5000,2000,0,1,1,1,0,7000,'USD',1.00,0,7000,'Naruto','Kun','ADDRESS 1','ADDRESS 2','VN',NULL,NULL,'667151172','test@test.com','ok','Cash','ShippingStandard',NULL,NULL,NULL,'2019-12-28 08:37:11',NULL);
/*!40000 ALTER TABLE `shop_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_order_detail`
--

DROP TABLE IF EXISTS `shop_order_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_order_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `qty` int(11) NOT NULL DEFAULT 0,
  `total_price` int(11) NOT NULL DEFAULT 0,
  `sku` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exchange_rate` double(8,2) DEFAULT NULL,
  `attribute` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_order_detail`
--

LOCK TABLES `shop_order_detail` WRITE;
/*!40000 ALTER TABLE `shop_order_detail` DISABLE KEYS */;
INSERT INTO `shop_order_detail` VALUES (1,1,1,'Easy Polo Black Edition 1',5000,1,5000,'ABCZZ','USD',1.00,'[]',NULL,NULL);
/*!40000 ALTER TABLE `shop_order_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_order_history`
--

DROP TABLE IF EXISTS `shop_order_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_order_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `content` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `order_status_id` int(11) NOT NULL DEFAULT 0,
  `add_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_order_history`
--

LOCK TABLES `shop_order_history` WRITE;
/*!40000 ALTER TABLE `shop_order_history` DISABLE KEYS */;
INSERT INTO `shop_order_history` VALUES (1,1,'New order',0,1,1,'2019-12-28 15:37:11');
/*!40000 ALTER TABLE `shop_order_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_order_status`
--

DROP TABLE IF EXISTS `shop_order_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_order_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_order_status`
--

LOCK TABLES `shop_order_status` WRITE;
/*!40000 ALTER TABLE `shop_order_status` DISABLE KEYS */;
INSERT INTO `shop_order_status` VALUES (1,'New'),(2,'Processing'),(3,'Hold'),(4,'Canceled'),(5,'Done'),(6,'Failed');
/*!40000 ALTER TABLE `shop_order_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_order_total`
--

DROP TABLE IF EXISTS `shop_order_total`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_order_total` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` int(11) NOT NULL DEFAULT 0,
  `text` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_order_total`
--

LOCK TABLES `shop_order_total` WRITE;
/*!40000 ALTER TABLE `shop_order_total` DISABLE KEYS */;
INSERT INTO `shop_order_total` VALUES (1,1,'Subtotal','subtotal',5000,NULL,1,NULL,NULL),(2,1,'Shipping','shipping',2000,NULL,10,NULL,NULL),(3,1,'Discount','discount',0,NULL,20,NULL,NULL),(4,1,'Total','total',7000,NULL,100,NULL,NULL),(5,1,'Received','received',0,NULL,200,NULL,NULL);
/*!40000 ALTER TABLE `shop_order_total` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_page`
--

DROP TABLE IF EXISTS `shop_page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shop_page_alias_unique` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_page`
--

LOCK TABLES `shop_page` WRITE;
/*!40000 ALTER TABLE `shop_page` DISABLE KEYS */;
INSERT INTO `shop_page` VALUES (1,'','about',1),(2,'','contact',1);
/*!40000 ALTER TABLE `shop_page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_page_description`
--

DROP TABLE IF EXISTS `shop_page_description`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_page_description` (
  `page_id` int(11) NOT NULL,
  `lang` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keyword` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`page_id`,`lang`),
  KEY `shop_page_description_lang_index` (`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_page_description`
--

LOCK TABLES `shop_page_description` WRITE;
/*!40000 ALTER TABLE `shop_page_description` DISABLE KEYS */;
INSERT INTO `shop_page_description` VALUES (1,'en','About','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>\r\n'),(1,'vi','Giới thiệu','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>\r\n'),(2,'en','Contact','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>\r\n'),(2,'vi','Liên hệ với chúng tôi','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>\r\n');
/*!40000 ALTER TABLE `shop_page_description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_payment_status`
--

DROP TABLE IF EXISTS `shop_payment_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_payment_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_payment_status`
--

LOCK TABLES `shop_payment_status` WRITE;
/*!40000 ALTER TABLE `shop_payment_status` DISABLE KEYS */;
INSERT INTO `shop_payment_status` VALUES (1,'Unpaid'),(2,'Partial payment'),(3,'Paid'),(4,'Refurn');
/*!40000 ALTER TABLE `shop_payment_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_product`
--

DROP TABLE IF EXISTS `shop_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sku` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_id` int(11) DEFAULT 0,
  `vendor_id` int(11) DEFAULT 0,
  `price` int(11) DEFAULT 0,
  `cost` int(11) DEFAULT 0,
  `stock` int(11) DEFAULT 0,
  `sold` int(11) DEFAULT 0,
  `type` tinyint(4) DEFAULT 0,
  `kind` tinyint(4) DEFAULT 0 COMMENT '0:single, 1:bundle, 2:group',
  `virtual` tinyint(4) DEFAULT 0 COMMENT '0:physical, 1:download, 2:only view, 3: Service',
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `sort` tinyint(4) NOT NULL DEFAULT 0,
  `view` int(11) NOT NULL DEFAULT 0,
  `alias` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_lastview` datetime DEFAULT NULL,
  `date_available` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shop_product_sku_unique` (`sku`),
  UNIQUE KEY `shop_product_alias_unique` (`alias`),
  KEY `shop_product_brand_id_index` (`brand_id`),
  KEY `shop_product_vendor_id_index` (`vendor_id`),
  KEY `shop_product_type_index` (`type`),
  KEY `shop_product_kind_index` (`kind`),
  KEY `shop_product_virtual_index` (`virtual`),
  KEY `shop_product_status_index` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_product`
--

LOCK TABLES `shop_product` WRITE;
/*!40000 ALTER TABLE `shop_product` DISABLE KEYS */;
INSERT INTO `shop_product` VALUES (1,'ABCZZ','/data/product/img-1.jpg',1,1,15000,10000,99,1,2,0,0,1,0,0,'demo-alias-name-product-1',NULL,'2020-02-03',NULL,NULL),(2,'LEDFAN1','/data/product/img-4.jpg',1,1,15000,10000,100,0,1,0,0,1,0,0,'demo-alias-name-product-2',NULL,NULL,NULL,NULL),(3,'CLOCKFAN1','/data/product/img-11.jpg',2,1,15000,10000,100,0,0,0,0,1,0,0,'demo-alias-name-product-3',NULL,NULL,NULL,NULL),(4,'CLOCKFAN2','/data/product/img-14.jpg',3,1,15000,10000,100,0,0,0,0,1,0,0,'demo-alias-name-product-4',NULL,NULL,NULL,NULL),(5,'CLOCKFAN3','/data/product/img-15.jpg',1,1,15000,10000,100,0,0,0,0,1,0,0,'demo-alias-name-product-5',NULL,NULL,NULL,NULL),(6,'TMC2208','/data/product/img-16.jpg',1,1,15000,10000,100,0,1,0,0,1,0,0,'demo-alias-name-product-6',NULL,NULL,NULL,NULL),(7,'FILAMENT','/data/product/img-17.jpg',2,1,15000,10000,100,0,0,0,0,1,0,0,'demo-alias-name-product-7',NULL,NULL,NULL,NULL),(8,'A4988','/data/product/img-18.jpg',2,1,15000,10000,100,0,2,0,0,1,0,0,'demo-alias-name-product-8',NULL,NULL,NULL,NULL),(9,'ANYCUBIC-P','/data/product/img-20.jpg',2,1,15000,10000,100,0,2,0,0,1,0,0,'demo-alias-name-product-9',NULL,NULL,NULL,NULL),(10,'3DHLFD-P','/data/product/img-21.jpg',4,1,15000,10000,100,0,2,0,0,1,0,0,'demo-alias-name-product-10',NULL,NULL,NULL,NULL),(11,'SS495A','/data/product/img-22.jpg',2,1,15000,10000,100,0,0,0,0,1,0,0,'demo-alias-name-product-11',NULL,NULL,NULL,NULL),(12,'3D-CARBON1.75','/data/product/img-23.jpg',2,1,15000,10000,100,0,2,0,0,1,0,0,'demo-alias-name-product-12',NULL,NULL,NULL,NULL),(13,'3D-GOLD1.75','/data/product/img-34.jpg',3,1,10000,5000,0,0,0,0,0,1,0,0,'demo-alias-name-product-13',NULL,NULL,NULL,NULL),(14,'LCD12864-3D','/data/product/img-13.jpg',3,1,15000,10000,100,0,0,0,0,1,0,0,'demo-alias-name-product-14',NULL,NULL,NULL,NULL),(15,'LCD2004-3D','/data/product/img-41.jpg',3,1,15000,10000,100,0,0,1,0,1,0,0,'demo-alias-name-product-15',NULL,NULL,NULL,NULL),(16,'RAMPS1.5-3D','/data/product/img-42.jpg',2,1,0,0,0,0,0,2,0,1,0,0,'demo-alias-name-product-16',NULL,NULL,NULL,NULL),(17,'ALOKK1-AY','/data/product/img-26.jpg',3,1,15000,10000,100,0,0,0,0,1,0,0,'demo-alias-name-product-17',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `shop_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_product_attribute`
--

DROP TABLE IF EXISTS `shop_product_attribute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_product_attribute` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attribute_group_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sort` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `shop_product_attribute_product_id_attribute_group_id_index` (`product_id`,`attribute_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_product_attribute`
--

LOCK TABLES `shop_product_attribute` WRITE;
/*!40000 ALTER TABLE `shop_product_attribute` DISABLE KEYS */;
INSERT INTO `shop_product_attribute` VALUES (1,'Blue',1,17,0),(2,'White',1,17,0),(3,'S',2,17,0),(4,'XL',2,17,0),(5,'Blue',1,10,0),(6,'Red',1,10,0),(7,'S',2,10,0),(8,'M',2,10,0);
/*!40000 ALTER TABLE `shop_product_attribute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_product_build`
--

DROP TABLE IF EXISTS `shop_product_build`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_product_build` (
  `build_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`build_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_product_build`
--

LOCK TABLES `shop_product_build` WRITE;
/*!40000 ALTER TABLE `shop_product_build` DISABLE KEYS */;
INSERT INTO `shop_product_build` VALUES (15,6,1),(15,7,2);
/*!40000 ALTER TABLE `shop_product_build` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_product_category`
--

DROP TABLE IF EXISTS `shop_product_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_product_category` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_product_category`
--

LOCK TABLES `shop_product_category` WRITE;
/*!40000 ALTER TABLE `shop_product_category` DISABLE KEYS */;
INSERT INTO `shop_product_category` VALUES (1,13),(2,13),(3,11),(4,11),(5,11),(6,11),(7,12),(8,10),(9,6),(10,11),(11,10),(12,9),(13,5),(14,11),(15,6),(16,9),(17,9);
/*!40000 ALTER TABLE `shop_product_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_product_description`
--

DROP TABLE IF EXISTS `shop_product_description`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_product_description` (
  `product_id` int(11) NOT NULL,
  `lang` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keyword` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`product_id`,`lang`),
  KEY `shop_product_description_lang_index` (`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_product_description`
--

LOCK TABLES `shop_product_description` WRITE;
/*!40000 ALTER TABLE `shop_product_description` DISABLE KEYS */;
INSERT INTO `shop_product_description` VALUES (1,'en','Easy Polo Black Edition 1','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'),(1,'vi','Easy Polo Black Edition 1','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'),(2,'en','Easy Polo Black Edition 2','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'),(2,'vi','Easy Polo Black Edition 2','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'),(3,'en','Easy Polo Black Edition 3','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'),(3,'vi','Easy Polo Black Edition 3','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'),(4,'en','Easy Polo Black Edition 4','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'),(4,'vi','Easy Polo Black Edition 4','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'),(5,'en','Easy Polo Black Edition 5','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'),(5,'vi','Easy Polo Black Edition 5','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'),(6,'en','Easy Polo Black Edition 6','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'),(6,'vi','Easy Polo Black Edition 6','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'),(7,'en','Easy Polo Black Edition 7','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'),(7,'vi','Easy Polo Black Edition 7','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'),(8,'en','Easy Polo Black Edition 8','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'),(8,'vi','Easy Polo Black Edition 8','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'),(9,'en','Easy Polo Black Edition 9','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'),(9,'vi','Easy Polo Black Edition 9','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'),(10,'en','Easy Polo Black Edition 10','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'),(10,'vi','Easy Polo Black Edition 10','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'),(11,'en','Easy Polo Black Edition 11','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'),(11,'vi','Easy Polo Black Edition 11','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'),(12,'en','Easy Polo Black Edition 12','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'),(12,'vi','Easy Polo Black Edition 12','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'),(13,'en','Easy Polo Black Edition 13','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'),(13,'vi','Easy Polo Black Edition 13','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'),(14,'en','Easy Polo Black Edition 14','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'),(14,'vi','Easy Polo Black Edition 14','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'),(15,'en','Easy Polo Black Edition 15','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'),(15,'vi','Easy Polo Black Edition 15','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'),(16,'en','Easy Polo Black Edition 16','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'),(16,'vi','Easy Polo Black Edition 16','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'),(17,'en','Easy Polo Black Edition 17','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>'),(17,'vi','Easy Polo Black Edition 17','','','<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<img alt=\"\" src=\"/data/product/img-21.jpg\" style=\"width: 262px; height: 262px; float: right; margin: 10px;\" /></p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>');
/*!40000 ALTER TABLE `shop_product_description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_product_group`
--

DROP TABLE IF EXISTS `shop_product_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_product_group` (
  `group_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`group_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_product_group`
--

LOCK TABLES `shop_product_group` WRITE;
/*!40000 ALTER TABLE `shop_product_group` DISABLE KEYS */;
INSERT INTO `shop_product_group` VALUES (16,1),(16,2);
/*!40000 ALTER TABLE `shop_product_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_product_image`
--

DROP TABLE IF EXISTS `shop_product_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_product_image` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `shop_product_image_product_id_index` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_product_image`
--

LOCK TABLES `shop_product_image` WRITE;
/*!40000 ALTER TABLE `shop_product_image` DISABLE KEYS */;
INSERT INTO `shop_product_image` VALUES (1,'/data/product/img-32.jpg',1),(2,'/data/product/img-33.jpg',1),(3,'/data/product/img-22.jpg',11),(4,'/data/product/img-23.jpg',2),(5,'/data/product/img-14.jpg',11),(6,'/data/product/img-12.jpg',5),(7,'/data/product/img-11.jpg',5),(8,'/data/product/img-9.jpg',2),(9,'/data/product/img-19.jpg',2),(10,'/data/product/img-21.jpg',9),(11,'/data/product/img-22.jpg',8),(12,'/data/product/img-20.jpg',7),(13,'/data/product/img-26.jpg',7),(14,'/data/product/img-27.jpg',5),(15,'/data/product/img-40.jpg',4),(16,'/data/product/img-14.jpg',15),(17,'/data/product/img-23.jpg',15),(18,'/data/product/img-12.jpg',17),(19,'/data/product/img-11.jpg',17),(20,'/data/product/img-32.jpg',17);
/*!40000 ALTER TABLE `shop_product_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_product_promotion`
--

DROP TABLE IF EXISTS `shop_product_promotion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_product_promotion` (
  `product_id` int(11) NOT NULL,
  `price_promotion` int(11) NOT NULL,
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `status_promotion` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_product_promotion`
--

LOCK TABLES `shop_product_promotion` WRITE;
/*!40000 ALTER TABLE `shop_product_promotion` DISABLE KEYS */;
INSERT INTO `shop_product_promotion` VALUES (1,5000,NULL,NULL,1,NULL,NULL),(11,5000,NULL,NULL,1,NULL,NULL);
/*!40000 ALTER TABLE `shop_product_promotion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_shipping`
--

DROP TABLE IF EXISTS `shop_shipping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_shipping` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL DEFAULT 0,
  `value` int(11) NOT NULL DEFAULT 0,
  `free` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_shipping`
--

LOCK TABLES `shop_shipping` WRITE;
/*!40000 ALTER TABLE `shop_shipping` DISABLE KEYS */;
INSERT INTO `shop_shipping` VALUES (1,0,20000,10000000,1);
/*!40000 ALTER TABLE `shop_shipping` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_shipping_status`
--

DROP TABLE IF EXISTS `shop_shipping_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_shipping_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_shipping_status`
--

LOCK TABLES `shop_shipping_status` WRITE;
/*!40000 ALTER TABLE `shop_shipping_status` DISABLE KEYS */;
INSERT INTO `shop_shipping_status` VALUES (1,'Not sent'),(2,'Sending'),(3,'Shipping done');
/*!40000 ALTER TABLE `shop_shipping_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_shoppingcart`
--

DROP TABLE IF EXISTS `shop_shoppingcart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_shoppingcart` (
  `identifier` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instance` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `shop_shoppingcart_identifier_instance_index` (`identifier`,`instance`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_shoppingcart`
--

LOCK TABLES `shop_shoppingcart` WRITE;
/*!40000 ALTER TABLE `shop_shoppingcart` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_shoppingcart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_subscribe`
--

DROP TABLE IF EXISTS `shop_subscribe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_subscribe` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shop_subscribe_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_subscribe`
--

LOCK TABLES `shop_subscribe` WRITE;
/*!40000 ALTER TABLE `shop_subscribe` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_subscribe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_user`
--

DROP TABLE IF EXISTS `shop_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:women, 1:men',
  `birthday` date DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postcode` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'VN',
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `group` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shop_user_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_user`
--

LOCK TABLES `shop_user` WRITE;
/*!40000 ALTER TABLE `shop_user` DISABLE KEYS */;
INSERT INTO `shop_user` VALUES (1,'Naruto','Kun','test@test.com',0,NULL,'$2y$10$4mwibhkY/4zQoSEe2/2Jb..SvdLpll9xYGzuGvYAN.fCGgjHn3vYW','70000','HCM','HCM city','KTC','VN','0667151172',NULL,1,1,'2019-12-28 08:37:11',NULL);
/*!40000 ALTER TABLE `shop_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_vendor`
--

DROP TABLE IF EXISTS `shop_vendor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_vendor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shop_vendor_alias_unique` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_vendor`
--

LOCK TABLES `shop_vendor` WRITE;
/*!40000 ALTER TABLE `shop_vendor` DISABLE KEYS */;
INSERT INTO `shop_vendor` VALUES (1,'ABC distributor','abc-distributor','abc@abc.com','012496657567','/data/vendor/vendor.png','','',0);
/*!40000 ALTER TABLE `shop_vendor` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-28 15:39:26
