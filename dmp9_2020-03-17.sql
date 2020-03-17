-- MySQL dump 10.13  Distrib 5.7.29, for osx10.15 (x86_64)
--
-- Host: localhost    Database: dmp9
-- ------------------------------------------------------
-- Server version	5.7.29

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `dmp9`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `dmp9` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `dmp9`;

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `answers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answers`
--

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL COMMENT 'id',
  `goods_id` bigint(20) unsigned NOT NULL COMMENT '상품id',
  `order_no` bigint(20) unsigned DEFAULT NULL COMMENT '주문번호',
  `state` int(11) NOT NULL DEFAULT '1' COMMENT '상태',
  `buy_date` date DEFAULT NULL COMMENT '구매일',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
INSERT INTO `carts` VALUES (1,1,1,202003170002,4,'2020-03-17','2020-03-17 04:38:38','2020-03-17 05:11:12'),(2,1,2,NULL,3,NULL,'2020-03-17 06:49:38','2020-03-16 21:50:10'),(3,1,3,NULL,1,NULL,'2020-03-17 07:52:52','2020-03-17 07:52:52');
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faqs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goods`
--

DROP TABLE IF EXISTS `goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goods` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL COMMENT 'id',
  `advertiser` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '광고주',
  `data_target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '타겟 유형',
  `data_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '데이터항목',
  `data_category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '데이터항목',
  `data_content` text COLLATE utf8mb4_unicode_ci COMMENT '설명',
  `data_count` int(11) DEFAULT NULL COMMENT '데이터수',
  `buy_price` int(11) DEFAULT NULL COMMENT '구매가격',
  `expiration_date` date DEFAULT NULL COMMENT '유효기간',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goods`
--

LOCK TABLES `goods` WRITE;
/*!40000 ALTER TABLE `goods` DISABLE KEYS */;
INSERT INTO `goods` VALUES (1,1,'광고주','applocal','데이터 명','B','fasdfadsfasdf\r\nfasdf\r\nasd\r\nf',5000,1000,'2020-03-31','2020-03-17 04:38:38','2020-03-16 19:53:39'),(2,1,'광고주1','applocal','교대맛집','A','교대맛집 데이터',5000,1000,'2020-03-31','2020-03-17 06:49:38','2020-03-16 21:50:03'),(3,1,'타입삭제','none','타입삭제','B','타입삭제타입삭제타입삭제\r\n타입삭제\r\n타입삭제',NULL,NULL,NULL,'2020-03-17 07:52:52','2020-03-17 07:52:52');
/*!40000 ALTER TABLE `goods` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2020_02_14_144821_create_faqs_table',1),(5,'2020_02_18_151749_create_permission_tables',1),(7,'2020_02_25_104447_create_questions_table',1),(10,'2020_02_28_180501_create_payment_returns_table',3),(12,'2020_02_28_193745_create_payment_fails_table',4),(13,'2020_03_02_145812_create_pay_logs_table',5),(14,'2020_02_25_110215_create_answers_table',6),(25,'2020_03_11_104353_create_goods_table',9),(26,'2020_03_11_111412_create_carts_table',10),(29,'2020_02_24_134243_create_orders_table',11),(30,'2020_03_09_213549_create_taxes_table',12),(31,'2014_10_12_000000_create_users_table',13),(32,'2020_03_17_170939_create_platforms_table',14),(33,'2020_03_17_182205_create_options_table',15);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `options` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL COMMENT 'user_id',
  `cart_id` bigint(20) unsigned NOT NULL COMMENT 'cart_id',
  `platform_id` bigint(20) unsigned NOT NULL COMMENT 'platform_id',
  `sns_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'platform_id',
  `sns_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'platform_password',
  `state` int(11) NOT NULL DEFAULT '1' COMMENT '상태',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `options`
--

LOCK TABLES `options` WRITE;
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
/*!40000 ALTER TABLE `options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL COMMENT 'id',
  `payment_id` bigint(20) unsigned DEFAULT NULL COMMENT '구매id',
  `order_no` bigint(20) unsigned NOT NULL COMMENT '주문번호',
  `goods_info` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '상품정보',
  `state` int(11) NOT NULL DEFAULT '1' COMMENT '상태',
  `total_price` int(11) DEFAULT NULL COMMENT '총구매가격',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,1,NULL,202003170001,'[{\"id\":1,\"user_id\":1,\"advertiser\":\"광고주\",\"data_types\":\"kakao,facebook\",\"data_target\":\"applocal\",\"data_name\":\"데이터 명\",\"data_category\":\"B\",\"data_content\":\"fasdfadsfasdf\\r\\nfasdf\\r\\nasd\\r\\nf\",\"data_count\":5000,\"buy_price\":1000,\"expiration_date\":\"2020-03-31\",\"created_at\":\"2020-03-17 13:38:38\",\"updated_at\":\"2020-03-17 04:53:39\"}]',0,1000,'2020-03-17 05:08:47','2020-03-17 05:08:47'),(2,1,1,202003170002,'[{\"id\":1,\"user_id\":1,\"advertiser\":\"광고주\",\"data_types\":\"kakao,facebook\",\"data_target\":\"applocal\",\"data_name\":\"데이터 명\",\"data_category\":\"B\",\"data_content\":\"fasdfadsfasdf\\r\\nfasdf\\r\\nasd\\r\\nf\",\"data_count\":5000,\"buy_price\":1000,\"expiration_date\":\"2020-03-31\",\"created_at\":\"2020-03-17 13:38:38\",\"updated_at\":\"2020-03-17 04:53:39\"}]',1,1000,'2020-03-17 05:10:35','2020-03-17 05:11:12');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('simtj@nsmg21.com','$2y$10$572etZpOZvKkpg6AxJIqJ.6ffx4jz3hiKzzFok8AQ1paXe5tqw9JG','2020-03-16 03:25:58');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pay_logs`
--

DROP TABLE IF EXISTS `pay_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pay_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pay_logs`
--

LOCK TABLES `pay_logs` WRITE;
/*!40000 ALTER TABLE `pay_logs` DISABLE KEYS */;
INSERT INTO `pay_logs` VALUES (1,13,'payReturn','POST /ajaxPayReturn HTTP/1.1\r\nAccept:                    text/html,application/xhtml xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9\r\nAccept-Encoding:           gzip, deflate\r\nAccept-Language:           ko-KR,ko;q=0.9,en-US;q=0.8,en;q=0.7\r\nCache-Control:             max-age=0\r\nConnection:                keep-alive\r\nContent-Length:            564\r\nContent-Type:              application/x-www-form-urlencoded\r\nCookie:                    XSRF-TOKEN=eyJpdiI6IkdtYldiVmI0ZGZZdXRGVm1SbnNDYmc9PSIsInZhbHVlIjoiVjlNVGtNUXZvZ1ZKYzVyRTZiVE5iajBpYUxjTFZGclJCbVcydUxvQ2JiQnFFMzNKREpEVldOVnJoQklCUnA5SCIsIm1hYyI6ImY2YzQyYmZhZTA3MmM4ZDY3ZGQ3OWZiMzY0NGQ0OTg1OWUxMzU1ZmY3MzU3MzU4MzUxY2I1YjgwZjM0OTRjMDEifQ==; laravel_session=eyJpdiI6InVqNXkwMEF3VmJPQ2QzS2lvXC82S2V3PT0iLCJ2YWx1ZSI6Im5JSWd2V2xETGF3bTlHZHpMTjIzQWt4VXg3aXNoSVZDd21COXpDS1JmcDIzNlN0T1wvSFpvVGZHZnJyekJpMjdxIiwibWFjIjoiMGVhZmVhODFmNTBkYzk3ZGRiMDczYWMzNmZjYThhMzE1MjNkZDEzODhhNDU4NGEzZTg2MmM0NDE5MTU3OTRiMCJ9\r\nHost:                      dmp9.test\r\nOrigin:                    null\r\nUpgrade-Insecure-Requests: 1\r\nUser-Agent:                Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.122 Safari/537.36\r\nCookie: XSRF-TOKEN=RWah7aYo5qONu1uzqQSVq6M7O3KXQW6I4BgtrX8i; laravel_session=w1lSYK8ztKnVrQEXndRvxlig5vrBNumb43eN25GO\r\n\r\ncode=0&message=&user_id=13&user_name=Dr. Godfrey Larkin III&order_no=202003050002&service_name=dmp9&product_name=호텔타임&custom_parameter=1|호텔타임|1234456|1000||2020-02-28&pgcode=creditcard&tid=tpay_test-202003058157772&cid=8157771&amount=1000&pay_info=테스트카드&domestic_flag=N&install_month=00&payhash=935534134B6BE06BFAF36DEFCB2EB69BEC47085DE0638945CD9E6EB1FE3E7160&taxfree_amount=0&tax_amount=91&nonsettle_amount=0&transaction_date=2020-03-05 14:11:11','2020-03-05 05:11:09','2020-03-05 05:11:09'),(2,13,'curlTransfer','{\"token\":158373076896800062,\"online_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=online&token=158373076896800062\",\"mobile_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=mobile&token=158373076896800062\"}','2020-03-09 05:12:45','2020-03-09 05:12:45'),(3,13,'payCancel','GET /ajaxPayCancel HTTP/1.1\r\nAccept:                    text/html,application/xhtml xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9\r\nAccept-Encoding:           gzip, deflate\r\nAccept-Language:           ko-KR,ko;q=0.9,en-US;q=0.8,en;q=0.7\r\nConnection:                keep-alive\r\nContent-Length:            \r\nContent-Type:              \r\nCookie:                    XSRF-TOKEN=eyJpdiI6IlNUZlZKUEF6akk3T0h1SGQ4XC9HM2NnPT0iLCJ2YWx1ZSI6IjIrNHp5TmtcL0FxMGVDd3VoQ0l6OFwvN3ZWdE9EVlRidW1JXC9DcUlmdm03K3drM1I5NHRNcjYxK3BnVVJydnlYdisiLCJtYWMiOiIzN2ZlMGQwYTU4MGZkZmZiYzkxMjI4ZTllZTkwMzkwYzI5MGE0ZDg4NWY1MDY2YmNhOTI0NTBhNDZmNWE1ZjQ3In0=; laravel_session=eyJpdiI6Ilp3WXBjSXZjM04ybk5SOWtES3NKV1E9PSIsInZhbHVlIjoidFFFTUx4cEtWYlNFc0NvajdiSUdwQkpyWnZ0TldXTGp0SDhvb01LcHlFODNFTCt4MnVsQ1dOQ3NjdGxxWDZKSiIsIm1hYyI6ImUxOWY3OGJmYjEzOTJlZDJlYTMxMTIwZWQ4MTBjYjYzNzgxM2Y1ZGE0OTAxYWYwODViNjNjY2ExNGMzZWY3MWIifQ==\r\nHost:                      dmp9.test\r\nUpgrade-Insecure-Requests: 1\r\nUser-Agent:                Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.132 Safari/537.36\r\nCookie: XSRF-TOKEN=Npf5rnwWS9FbmscTXyxCRojXvofXxfKs7KLH0beC; laravel_session=RQ0QuChVIE8TTgx5GGlmEz1nk23HQkvTcnn7K5H7\r\n\r\n','2020-03-09 05:12:49','2020-03-09 05:12:49'),(4,13,'curlTransfer','{\"token\":158375292140100155,\"online_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=online&token=158375292140100155\",\"mobile_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=mobile&token=158375292140100155\"}','2020-03-09 11:21:57','2020-03-09 11:21:57'),(5,13,'payReturn','POST /ajaxPayReturn HTTP/1.1\r\nAccept:                    text/html,application/xhtml xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9\r\nAccept-Encoding:           gzip, deflate\r\nAccept-Language:           ko-KR,ko;q=0.9,en-US;q=0.8,en;q=0.7\r\nCache-Control:             max-age=0\r\nConnection:                keep-alive\r\nContent-Length:            567\r\nContent-Type:              application/x-www-form-urlencoded\r\nCookie:                    XSRF-TOKEN=eyJpdiI6IjdrS0ErTk52MFlsNGh2SEw5dFE2S1E9PSIsInZhbHVlIjoiVjJXM1JQZVNPZktsUFZkT3NZeWhIWkZmTFFMRUxkZ2g5OWt1MFFRRjFMTEVKUU5kNVNIWVhuXC95Z1wvdUFhbnVoIiwibWFjIjoiMDE5Zjg0M2ZmNjJmNzRkOTFjMjM4OTZkZDVhZmQ5YmVlNTIyZWU1MzEzZmQ2MmIzYzQ4ZDUyMThkZDg0NWFjMSJ9; laravel_session=eyJpdiI6InVadGhqVW9CUTEwUGM0c1wvMFRvNE5nPT0iLCJ2YWx1ZSI6IlZXTlIzUUM2MGdGSDFTVDlFRzZJK0lCRHR1NEVHbEJKUnZPdFcwYkxmMXY0SkdENlRUTVRYWjVWNEZYaFBoM3giLCJtYWMiOiI5MzI5NzkxZGM1NjYxMjRlMmU0MDA3MjUxMTgyYTFmOThkOTE1ZDY4ZDFjZDRjYmNmNjI3NDQ3NzM5NWVkNDBjIn0=\r\nHost:                      dmp9.test\r\nOrigin:                    null\r\nUpgrade-Insecure-Requests: 1\r\nUser-Agent:                Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.132 Safari/537.36\r\nCookie: XSRF-TOKEN=q6HEAsubqmMqzqAd6UQlhhOZxH9N5tqZJJ1WWivR; laravel_session=zfLqRbkOC0FP4bAXl7E02SWTxrdkBurxD2SZPSI7\r\n\r\ncode=0&message=&user_id=13&user_name=Dr. Godfrey Larkin III&order_no=202003090001&service_name=dmp9&product_name=데이터명11&custom_parameter=1|데이터명11|598231|1000||2020-03-10&pgcode=creditcard&tid=tpay_test-202003098161074&cid=8161073&amount=1000&pay_info=테스트카드&domestic_flag=N&install_month=00&payhash=AC24A10081E142CEE6F39ABD98C177A657DD9B129A69550E48588CA125312066&taxfree_amount=0&tax_amount=91&nonsettle_amount=0&transaction_date=2020-03-09 20:22:40','2020-03-09 11:22:36','2020-03-09 11:22:36'),(6,13,'curlTransfer','{\"token\":158380789882500024,\"online_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=online&token=158380789882500024\",\"mobile_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=mobile&token=158380789882500024\"}','2020-03-10 02:38:15','2020-03-10 02:38:15'),(7,13,'payReturn','POST /ajaxPayReturn HTTP/1.1\r\nAccept:                    text/html,application/xhtml xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9\r\nAccept-Encoding:           gzip, deflate\r\nAccept-Language:           ko-KR,ko;q=0.9,en-US;q=0.8,en;q=0.7\r\nCache-Control:             max-age=0\r\nConnection:                keep-alive\r\nContent-Length:            559\r\nContent-Type:              application/x-www-form-urlencoded\r\nCookie:                    XSRF-TOKEN=eyJpdiI6IjJPYTRXTVBkVDF0SnFndWtBN1FiaGc9PSIsInZhbHVlIjoiQTJwSGdOTE9aWWlCaHhkdnFhVVVYVmlGcjNjdnRPT2VqSnl4OWZJdmNcL0RqMklKUk5lcWVzb1hWMDMrUUNwS0siLCJtYWMiOiJjM2ZkZDFhMWQ3OWZmZDlhMTRmMDdmOTY1MDBiZGY5NmEzZGZlYTIwZTgyN2ZiZjk5ZDRmOTczNzU4ZGIxYjRhIn0=; laravel_session=eyJpdiI6IkIyMnpKQVNUMDFEcklMbWlXWVBEN0E9PSIsInZhbHVlIjoiXC91Z2ViTUlmeVFXYlY0RG02bjdLanRvVVhSUlRNS3Erc2RCS3RPaTdiM1dIQThnM1FqTzVzUng2YkRVVkRqWVEiLCJtYWMiOiIyM2M3ZDc2MzY5M2QwMzQxZjQzYzFhZWViOTFmZGZhZGNmM2ZkN2FlNzQ1MWM0YmQ4MDE2ZTRhYzY1NjY0ODQzIn0=\r\nHost:                      dmp9.test\r\nOrigin:                    null\r\nUpgrade-Insecure-Requests: 1\r\nUser-Agent:                Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.132 Safari/537.36\r\nCookie: XSRF-TOKEN=owTPMo2LV5p938WZ6laa9PTul9BNWeFsEMWyaWIO; laravel_session=6V95Qs7tTujV65fNlRI0hlbpHPu96l5q9kDFXBi1\r\n\r\ncode=0&message=&user_id=13&user_name=Dr. Godfrey Larkin III&order_no=202003100001&service_name=dmp9&product_name=홍대맛집&custom_parameter=1|홍대맛집|10|1000||2020-04-10&pgcode=creditcard&tid=tpay_test-202003108161479&cid=8161478&amount=1000&pay_info=테스트카드&domestic_flag=N&install_month=00&payhash=24C2F82F4DDC63356AB0D3EAB108F58DD8BB2CC46B65FA9DA0B7AE44FBB9BE8A&taxfree_amount=0&tax_amount=91&nonsettle_amount=0&transaction_date=2020-03-10 11:38:57','2020-03-10 02:38:54','2020-03-10 02:38:54'),(8,13,'curlTransfer','{\"token\":158381666385300050,\"online_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=online&token=158381666385300050\",\"mobile_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=mobile&token=158381666385300050\"}','2020-03-10 05:04:20','2020-03-10 05:04:20'),(9,13,'curlTransfer','{\"token\":158383862275800126,\"online_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=online&token=158383862275800126\",\"mobile_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=mobile&token=158383862275800126\"}','2020-03-10 11:10:19','2020-03-10 11:10:19'),(10,13,'payReturn','POST /ajaxPayReturn HTTP/1.1\r\nAccept:                    text/html,application/xhtml xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9\r\nAccept-Encoding:           gzip, deflate\r\nAccept-Language:           ko-KR,ko;q=0.9,en-US;q=0.8,en;q=0.7\r\nCache-Control:             max-age=0\r\nConnection:                keep-alive\r\nContent-Length:            561\r\nContent-Type:              application/x-www-form-urlencoded\r\nCookie:                    XSRF-TOKEN=eyJpdiI6IlRidEJZM3grSjFVSkE1eE1RMks4MFE9PSIsInZhbHVlIjoic1RzdlF0dkhZTDVoVk9UR1ZVUUJ4M0JiVDJsNktmMVQ5SWJJVEtSbnJ2aU9DNTZYQ3Y4bWlxZE9CcjVISW45RSIsIm1hYyI6IjlhMmU4YTU0YTBlYjE3MDEyMjM3NTY2ZTU2NmFlZWNhYzkwMWRlN2VhM2RiYzI1ZWNhOTNiZWVhY2M2YmUwYzAifQ==; laravel_session=eyJpdiI6InFqR2RMUDF6MHg2djQ2SUV5Myt4NlE9PSIsInZhbHVlIjoiWHFOdmpBSDU2RVFrcmJnZVVaZG9kd25jTkJud1JmdExKdzhFOTNtbmYrUWcxd3p1bWNFajNubFwvTDI0cFBrOVEiLCJtYWMiOiJkZjAzZWRkOTY3NmQyZWQ5NzczZGE0N2FjODY2N2RlNWVhNDQ3ZjBhOGY5ZThkNGUxOWM1YzY0MWUyZDY4NzRmIn0=\r\nHost:                      dmp9.test\r\nOrigin:                    null\r\nUpgrade-Insecure-Requests: 1\r\nUser-Agent:                Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.132 Safari/537.36\r\nCookie: XSRF-TOKEN=gKB7DIiTod15KAAQXwVsaZp5HL5fEzXEddAf5cqH; laravel_session=1E8eMlyqv2MopxmmOPYR7W9qWegCM0L4T50muWRj\r\n\r\ncode=0&message=&user_id=13&user_name=Dr. Godfrey Larkin III&order_no=202003100001&service_name=dmp9&product_name=데이터명&custom_parameter=1|데이터명|2000|1000||2020-03-31&pgcode=creditcard&tid=tpay_test-202003108162025&cid=8162024&amount=1000&pay_info=테스트카드&domestic_flag=N&install_month=00&payhash=C8D3C5F1BDE6B14B26221ED8C4068834DE92B25896F2A8AA3629A98EB2ECDC3A&taxfree_amount=0&tax_amount=91&nonsettle_amount=0&transaction_date=2020-03-10 20:10:58','2020-03-10 11:10:55','2020-03-10 11:10:55'),(11,13,'curlTransfer','{\"token\":158391080816000126,\"online_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=online&token=158391080816000126\",\"mobile_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=mobile&token=158391080816000126\"}','2020-03-11 07:13:24','2020-03-11 07:13:24'),(12,13,'payCancel','GET /ajaxPayCancel HTTP/1.1\r\nAccept:                    text/html,application/xhtml xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9\r\nAccept-Encoding:           gzip, deflate\r\nAccept-Language:           ko-KR,ko;q=0.9,en-US;q=0.8,en;q=0.7\r\nConnection:                keep-alive\r\nContent-Length:            \r\nContent-Type:              \r\nCookie:                    XSRF-TOKEN=eyJpdiI6IlNjYVhCWVFqdWZWNXY2U1grREdzUEE9PSIsInZhbHVlIjoiTUZPZXNWMnBrV2poZ1NiWHdMMkllc1ZhSjdFZ3Focms5NGNiZzhDTTR0T3k5cTZNZkVLY1EzZGJZVUFhZFVHVCIsIm1hYyI6IjY4OGUxZjU4YTQyNmM5MDZiOTkyMmZjYTM3OGYxZWZkNmRhNTE2OGE0NDBjODRjYWI3YTJiMzg2NGM0YTRhYjIifQ==; laravel_session=eyJpdiI6IlB5NVJQT29qNE44bmVVVmJENThiaFE9PSIsInZhbHVlIjoiNUtCSDFnNkZJRWJrK0hHSExZblVoQnVvTTNUS1BZR2JkYzdCaTVSazZ6SXE4bHBubWtVU0lPNnA4eWt4S0FrWCIsIm1hYyI6IjdkNzEyMjRmZjI3Yjk4ZTZiMzVlOWE5NWY4NWFlMmM0YTQxZDE3NTBkN2ZiMGE0YmU2MjRmNDdlZmVhOWRmZGMifQ==\r\nHost:                      dmp9.test\r\nUpgrade-Insecure-Requests: 1\r\nUser-Agent:                Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.132 Safari/537.36\r\nCookie: XSRF-TOKEN=MpZOT7hiBQfd3VRKYPLAo7wHDhKjCPUpsozZrKO3; laravel_session=HCT7jL99hnCbcPUyXX9Yq3EuhCuQfu4xPhA7Wk9F\r\n\r\n','2020-03-11 07:13:48','2020-03-11 07:13:48'),(13,13,'curlTransfer','{\"token\":158391088375600127,\"online_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=online&token=158391088375600127\",\"mobile_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=mobile&token=158391088375600127\"}','2020-03-11 07:14:39','2020-03-11 07:14:39'),(14,13,'payCancel','GET /ajaxPayCancel HTTP/1.1\r\nAccept:                    text/html,application/xhtml xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9\r\nAccept-Encoding:           gzip, deflate\r\nAccept-Language:           ko-KR,ko;q=0.9,en-US;q=0.8,en;q=0.7\r\nConnection:                keep-alive\r\nContent-Length:            \r\nContent-Type:              \r\nCookie:                    XSRF-TOKEN=eyJpdiI6IjVseW5uRTE1bWFpdFJUUGQ2ajlPNkE9PSIsInZhbHVlIjoiUWxva1MzcjJBK1ErM2xQZUVxbFdkXC8xbXp6YWdlT0ZMeTlTOUYyQk9pUDBtdlNKdkMyZzdnR0ZoQ0Z3dGI1RlIiLCJtYWMiOiJhYzMxMDQwMGM3ZjNhYzY3MzE0ZDgyYmI0NjgwMTI4N2Q4ODkwNTdiNmU3ZWY1MmI2YmFmZGVkZTk3ODQ1MDU0In0=; laravel_session=eyJpdiI6IjRHYUVmajJxR1wvSEQ2YmVibiswM0JnPT0iLCJ2YWx1ZSI6ImRLK25yTW1ZUlwvbW1TczFEVFBGTFNrUE5qbDF6QTNDTVJzWmhmNDJRcnJSWHZsZFB2MktVQzF5SjhqNUpaY0NUIiwibWFjIjoiMWM2NjYxYmM4ZDkyYWVjMWJhZDAyYTg2NzM2OWFlNDA3YWMyOTI5NzIwZGFiMGMwNjA5ODU4N2RhZTg1OThiMSJ9\r\nHost:                      dmp9.test\r\nUpgrade-Insecure-Requests: 1\r\nUser-Agent:                Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.132 Safari/537.36\r\nCookie: XSRF-TOKEN=MpZOT7hiBQfd3VRKYPLAo7wHDhKjCPUpsozZrKO3; laravel_session=HCT7jL99hnCbcPUyXX9Yq3EuhCuQfu4xPhA7Wk9F\r\n\r\n','2020-03-11 07:14:53','2020-03-11 07:14:53'),(15,13,'curlTransfer','{\"token\":158391238719700131,\"online_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=online&token=158391238719700131\",\"mobile_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=mobile&token=158391238719700131\"}','2020-03-11 07:39:43','2020-03-11 07:39:43'),(16,13,'payCancel','GET /ajaxPayCancel HTTP/1.1\r\nAccept:                    text/html,application/xhtml xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9\r\nAccept-Encoding:           gzip, deflate\r\nAccept-Language:           ko-KR,ko;q=0.9,en-US;q=0.8,en;q=0.7\r\nConnection:                keep-alive\r\nContent-Length:            \r\nContent-Type:              \r\nCookie:                    XSRF-TOKEN=eyJpdiI6ImVjdGJmK0ZxSzBDOERJSUpDT0REWHc9PSIsInZhbHVlIjoiQ3drTkZoMkl3Z0VBU1VTWFBMXC9UdEd3ZmFWdENobkRJeG5lU2Fxb1UwXC82S04walY5YTdRRGlXblwvb1BwVXZVZSIsIm1hYyI6ImEzNzZkMjlhZWU3Mjc2OTc1YWEwNTk1MzY1YzZhNDQ3MWY4NDNlM2JjNzUyOTI2YjM0NTc2MDE2YjVhNzUzMWEifQ==; laravel_session=eyJpdiI6IjdEUHVmM0MySk41cGVmVnRoUmkxOEE9PSIsInZhbHVlIjoiOVZhQjBOS0dCeDBvRmxaMXRqT3dpNUk1U3p3QmJ5dlNYNGlFK2FWNXFZRU1Ga0lJYmkrdVwvajBpNkpYcGxWVXMiLCJtYWMiOiI1ZjNhMzQxM2ExYTlkZWY4ZGUzZWMyODIxYmE1YWNjMThkY2YyODQ0NjA0M2ZmNWVmMGU0YTBlNmIxOGE5ZGRhIn0=\r\nHost:                      dmp9.test\r\nUpgrade-Insecure-Requests: 1\r\nUser-Agent:                Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.132 Safari/537.36\r\nCookie: XSRF-TOKEN=MpZOT7hiBQfd3VRKYPLAo7wHDhKjCPUpsozZrKO3; laravel_session=HCT7jL99hnCbcPUyXX9Yq3EuhCuQfu4xPhA7Wk9F\r\n\r\n','2020-03-11 07:40:53','2020-03-11 07:40:53'),(17,13,'curlTransfer','{\"token\":158391668630800143,\"online_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=online&token=158391668630800143\",\"mobile_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=mobile&token=158391668630800143\"}','2020-03-11 08:51:22','2020-03-11 08:51:22'),(18,13,'curlTransfer','{\"token\":158391678557400145,\"online_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=online&token=158391678557400145\",\"mobile_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=mobile&token=158391678557400145\"}','2020-03-11 08:53:01','2020-03-11 08:53:01'),(19,13,'curlTransfer','{\"token\":158391681788700146,\"online_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=online&token=158391681788700146\",\"mobile_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=mobile&token=158391681788700146\"}','2020-03-11 08:53:33','2020-03-11 08:53:33'),(20,13,'curlTransfer','{\"token\":158397498361200001,\"online_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=online&token=158397498361200001\",\"mobile_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=mobile&token=158397498361200001\"}','2020-03-12 01:02:59','2020-03-12 01:02:59'),(21,13,'curlTransfer','{\"token\":158397554114500003,\"online_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=online&token=158397554114500003\",\"mobile_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=mobile&token=158397554114500003\"}','2020-03-12 01:12:17','2020-03-12 01:12:17'),(22,13,'curlTransfer','{\"token\":158397571179400004,\"online_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=online&token=158397571179400004\",\"mobile_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=mobile&token=158397571179400004\"}','2020-03-12 01:15:07','2020-03-12 01:15:07'),(23,13,'payReturn','POST /ajaxPayReturn HTTP/1.1\r\nAccept:                    text/html,application/xhtml xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9\r\nAccept-Encoding:           gzip, deflate\r\nAccept-Language:           ko-KR,ko;q=0.9,en-US;q=0.8,en;q=0.7\r\nCache-Control:             max-age=0\r\nConnection:                keep-alive\r\nContent-Length:            518\r\nContent-Type:              application/x-www-form-urlencoded\r\nCookie:                    XSRF-TOKEN=eyJpdiI6Inh6R0cwS1N4UFpEek83K0loTWRoa1E9PSIsInZhbHVlIjoiMlB3eUV2OWFNOTNFdWJwb1ZKWFFUTytyZGczNnZWaWQyb2hGRU15YWNQb3pzRTNzcFF3c2NFcVpONVo5QmRRSyIsIm1hYyI6ImQ3ZDIwYTI4YjZiMDJkNTcxODg2NGMwNGMyYjNjYTdjMjJjMzM2Mjk0YzZiYjI1N2I1YTkyZjg3MDljMTU1ODEifQ==; laravel_session=eyJpdiI6Ik94TXFVbm5zWkZFZEo2QUhCYWlvUVE9PSIsInZhbHVlIjoiQVwvMnRyUUNEcXIrWjFxNkRQMW5HOUpYdE1aWXFmN2ltc3VuZFRvcFNxd1NHRVFSNkNXNGdJYnFIeFd3ZlBTR04iLCJtYWMiOiJjZWE2NzZmZDQ4MDkyNzY3ODE1ODhhOWI4ZWMwNjIwZTQ0YzQwMGI4MDg2Y2NkMzdjMDRmMmQyMTdjZWEwYjllIn0=\r\nHost:                      dmp9.test\r\nOrigin:                    null\r\nUpgrade-Insecure-Requests: 1\r\nUser-Agent:                Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.132 Safari/537.36\r\nCookie: XSRF-TOKEN=hufTgipofwBLVeyorOmVPHr8oXPeTAtBEZQWI69d; laravel_session=2bwMtzhLsXU4U0lGTEi5WfvgvUXSBk3yj8MOGKeY\r\n\r\ncode=0&message=&user_id=13&user_name=구매자&order_no=202003120001&service_name=dmp9&product_name=데이터 명외 1개&custom_parameter=&pgcode=creditcard&tid=tpay_test-202003128163570&cid=8163569&amount=3000&pay_info=테스트카드&domestic_flag=N&install_month=00&payhash=3AA697D6047F4CBB433B2FDAE779092A2784491D34B0C0359453AA2398874334&taxfree_amount=0&tax_amount=273&nonsettle_amount=0&transaction_date=2020-03-12 10:15:43','2020-03-12 01:15:39','2020-03-12 01:15:39'),(24,13,'curlTransfer','{\"token\":158397850908900012,\"online_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=online&token=158397850908900012\",\"mobile_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=mobile&token=158397850908900012\"}','2020-03-12 02:01:45','2020-03-12 02:01:45'),(25,13,'payReturn','POST /ajaxPayReturn HTTP/1.1\r\nAccept:                    text/html,application/xhtml xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9\r\nAccept-Encoding:           gzip, deflate\r\nAccept-Language:           ko-KR,ko;q=0.9,en-US;q=0.8,en;q=0.7\r\nCache-Control:             max-age=0\r\nConnection:                keep-alive\r\nContent-Length:            518\r\nContent-Type:              application/x-www-form-urlencoded\r\nCookie:                    XSRF-TOKEN=eyJpdiI6ImErbUF4VVk0QWRVQ042WGwwbUFudEE9PSIsInZhbHVlIjoiOWIybVBMV1NQNW1FeHFhZGVXUHFMT3h4NjBoeGMrM2tpRU5ZeTdPSzczbFRvMEtVcDU2SEhKeFZ3WXhBSmZzUSIsIm1hYyI6ImUzOTU4YWRjODcxYWQ1ODdhNTQwZDY1ZjE5ZGU5YzEzYzE4MGQzOTVlMWNjM2QxZjYzNDM0MDZjMWI3ZDM3NTcifQ==; laravel_session=eyJpdiI6IkUzNXFkZWRJZ2MxdmlWaTQxeHg0Y2c9PSIsInZhbHVlIjoiS3o5NHJFYnlLZzdnMFZMWlVYblprRGo5dldINE40MUxyTGZ6TmZSRVYzVm5PYXNXZWsza0RkS1wvdmxTZlcrYUgiLCJtYWMiOiIzNTBiOWM1MzMzY2NiM2M3YTMxOTY0ZTY5NzUxMTFmM2IzYjc5NGZiZDY5ZGFjMTgyZmQ5MGY3YjAxOWRkOGIyIn0=\r\nHost:                      dmp9.test\r\nOrigin:                    null\r\nUpgrade-Insecure-Requests: 1\r\nUser-Agent:                Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.132 Safari/537.36\r\nCookie: XSRF-TOKEN=hufTgipofwBLVeyorOmVPHr8oXPeTAtBEZQWI69d; laravel_session=2bwMtzhLsXU4U0lGTEi5WfvgvUXSBk3yj8MOGKeY\r\n\r\ncode=0&message=&user_id=13&user_name=구매자&order_no=202003120002&service_name=dmp9&product_name=데이터 명외 1개&custom_parameter=&pgcode=creditcard&tid=tpay_test-202003128163605&cid=8163604&amount=3000&pay_info=테스트카드&domestic_flag=N&install_month=00&payhash=78DFFC6FE338157A4BEB4C275ABE87C3CAA2C0F5EEA58D5A8FEC31783852816F&taxfree_amount=0&tax_amount=273&nonsettle_amount=0&transaction_date=2020-03-12 11:02:31','2020-03-12 02:02:27','2020-03-12 02:02:27'),(26,13,'curlTransfer','{\"token\":158397877987600013,\"online_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=online&token=158397877987600013\",\"mobile_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=mobile&token=158397877987600013\"}','2020-03-12 02:06:15','2020-03-12 02:06:15'),(27,13,'payReturn','POST /ajaxPayReturn HTTP/1.1\r\nAccept:                    text/html,application/xhtml xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9\r\nAccept-Encoding:           gzip, deflate\r\nAccept-Language:           ko-KR,ko;q=0.9,en-US;q=0.8,en;q=0.7\r\nCache-Control:             max-age=0\r\nConnection:                keep-alive\r\nContent-Length:            518\r\nContent-Type:              application/x-www-form-urlencoded\r\nCookie:                    XSRF-TOKEN=eyJpdiI6Ijh0VTdBWWNxeEhMTVBYb29pc2JYblE9PSIsInZhbHVlIjoiS3pZQjhMaFpTTTZ4TjZWRDdBbTY0VEhMbVZIZHhDK2xBQTE0b2FOZXRaNTcrWXU1czlZS0tOdGhjT2FYOTZUSSIsIm1hYyI6IjdhYjllYmY3MTc0MjQ3MzA5ODcxN2EwNGE0M2IzYzc4ZjJlZGNjOTk4OGFmYWFkNTMwOGM5Zjg4MzE1ZjYzNWUifQ==; laravel_session=eyJpdiI6IkMwcG4yamp2VEZSQnZnYlFac3VCXC9BPT0iLCJ2YWx1ZSI6IkNlaTY3d012XC9URWwydVFQTHRCM1VMSWxydVJ0WnBhb0hmNmxONHE1c2l3MVl5eG0xYjBIZzQ1NmZDOVk5bzNNIiwibWFjIjoiN2U5MWViMGY0OGY5NGRlZTNmMjVmM2VhMTNjNDVlYjQxOTk0MzEyZjhhOWJiYWI1M2YyZDI2YzEwYTM2OThlNCJ9\r\nHost:                      dmp9.test\r\nOrigin:                    null\r\nUpgrade-Insecure-Requests: 1\r\nUser-Agent:                Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.132 Safari/537.36\r\nCookie: XSRF-TOKEN=hufTgipofwBLVeyorOmVPHr8oXPeTAtBEZQWI69d; laravel_session=2bwMtzhLsXU4U0lGTEi5WfvgvUXSBk3yj8MOGKeY\r\n\r\ncode=0&message=&user_id=13&user_name=구매자&order_no=202003120001&service_name=dmp9&product_name=데이터 명외 1개&custom_parameter=&pgcode=creditcard&tid=tpay_test-202003128163607&cid=8163606&amount=3000&pay_info=테스트카드&domestic_flag=N&install_month=00&payhash=ECEE9EA9A029DBE57443824E1E47651828988BED371FB1ADC969FB79C5E0022B&taxfree_amount=0&tax_amount=273&nonsettle_amount=0&transaction_date=2020-03-12 11:06:53','2020-03-12 02:06:49','2020-03-12 02:06:49'),(28,13,'curlTransfer','{\"token\":158397903388100014,\"online_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=online&token=158397903388100014\",\"mobile_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=mobile&token=158397903388100014\"}','2020-03-12 02:10:29','2020-03-12 02:10:29'),(29,13,'curlTransfer','{\"token\":158397917746400015,\"online_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=online&token=158397917746400015\",\"mobile_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=mobile&token=158397917746400015\"}','2020-03-12 02:12:53','2020-03-12 02:12:53'),(30,13,'payReturn','POST /ajaxPayReturn HTTP/1.1\r\nAccept:                    text/html,application/xhtml xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9\r\nAccept-Encoding:           gzip, deflate\r\nAccept-Language:           ko-KR,ko;q=0.9,en-US;q=0.8,en;q=0.7\r\nCache-Control:             max-age=0\r\nConnection:                keep-alive\r\nContent-Length:            498\r\nContent-Type:              application/x-www-form-urlencoded\r\nCookie:                    XSRF-TOKEN=eyJpdiI6Iit6Tm5jQzRYOGlHaWxacVdPTjRaQUE9PSIsInZhbHVlIjoiSjM3VlhyRUljNVBkQ2xsOGY5ZGptcHM3RGJ1NWptZ1laYkpvN2hyMUd4OWo2TzdMY2FoOVJDQ0lHN3ZXQ0hWdiIsIm1hYyI6IjBhOTI1NGIzOGQzM2FhZjZlNzgzNDU1YTU3NzZhNTdiYjM0YmY2YzkyNzQwMWNlZjdlMmJlZGUwNzM3YjYwMjEifQ==; laravel_session=eyJpdiI6IjBGTFh4eWMrTjhVWFBYWEZIRjd5Mnc9PSIsInZhbHVlIjoiRWxPdGxTV3NWR3RGTjhSWUgrdEdOWEI1Rnd4VkV0S3pURmJ6cVhqRXRlWEd0dkpSVDZnblJTYmo0RVBHQTg4ZCIsIm1hYyI6IjE3NTg2ZDMwODM1ODc5YWU2MDFmYzgyYWQ2YmQzM2NkMGM4YzA5NzhkZjFiZmY3ZDllODhhODQ4ZmJlZjViYzQifQ==\r\nHost:                      dmp9.test\r\nOrigin:                    null\r\nUpgrade-Insecure-Requests: 1\r\nUser-Agent:                Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.132 Safari/537.36\r\nCookie: XSRF-TOKEN=hufTgipofwBLVeyorOmVPHr8oXPeTAtBEZQWI69d; laravel_session=2bwMtzhLsXU4U0lGTEi5WfvgvUXSBk3yj8MOGKeY\r\n\r\ncode=0&message=&user_id=13&user_name=구매자&order_no=202003120003&service_name=dmp9&product_name=일산 맛집&custom_parameter=&pgcode=creditcard&tid=tpay_test-202003128163611&cid=8163610&amount=3000&pay_info=테스트카드&domestic_flag=N&install_month=00&payhash=16124C6066DAAA40B8CF4AF99028FC433204262A9D858208947445C0EDD20EE6&taxfree_amount=0&tax_amount=273&nonsettle_amount=0&transaction_date=2020-03-12 11:13:36','2020-03-12 02:13:33','2020-03-12 02:13:33'),(31,1,'curlTransfer','{\"token\":158442172767800066,\"online_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=online&token=158442172767800066\",\"mobile_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=mobile&token=158442172767800066\"}','2020-03-17 05:08:47','2020-03-17 05:08:47'),(32,1,'curlTransfer','{\"token\":158442183566600068,\"online_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=online&token=158442183566600068\",\"mobile_url\":\"https://testpg.payletter.com/pgsvc/hub.asp?location=mobile&token=158442183566600068\"}','2020-03-17 05:10:35','2020-03-17 05:10:35'),(33,1,'payReturn','POST /ajaxPayReturn HTTP/1.1\r\nAccept:                    text/html,application/xhtml xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9\r\nAccept-Encoding:           gzip, deflate\r\nAccept-Language:           ko-KR,ko;q=0.9,en-US;q=0.8,en;q=0.7\r\nCache-Control:             max-age=0\r\nConnection:                keep-alive\r\nContent-Length:            487\r\nContent-Type:              application/x-www-form-urlencoded\r\nCookie:                    XSRF-TOKEN=eyJpdiI6IkxBbU5qMWRwenJmZ1pCRWpxVVRoVEE9PSIsInZhbHVlIjoiZjZ3dHNwSEN1WldOa1JadUx5TmY3RThMdmc1M0JPUk9tN0RJTDJOeU5cL0puejQ5bExvZXkyYjRnWFZibG1uNzgiLCJtYWMiOiI2OWI1NzRlM2RmMzQ0ZTFhMjJmNjg3YTUwMThhMzJkYzdmMjk5ZjQ4NWY3ZGNmNzBlNTBmMmU1NThiNzIyZjZhIn0=; laravel_session=eyJpdiI6InRBV0FGUGU2T1hxTlRLSHpsQlpDZWc9PSIsInZhbHVlIjoiajFGaENSSXhvMk5nNmM1R2ZFOVdMcmlBUm5PbFR1TmFONm05MlFwRTRqa2dCZjJVSGFOQTBMVDhPcERsNmNDXC8iLCJtYWMiOiI0YmE3N2NhZDM2NzRkYWJkOTAzMWViODZkNTY2YWVkNzdjZTRiMjQwNGFlOTIwYjg5YTIzZjIxOWE0MTZhZDNlIn0=\r\nHost:                      dmp9.test\r\nOrigin:                    null\r\nUpgrade-Insecure-Requests: 1\r\nUser-Agent:                Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.132 Safari/537.36\r\nCookie: XSRF-TOKEN=QjXibaTzJiw0rZel7TQ81THNmV9Kz0HXPl13wXPD; laravel_session=aTuyKZWUZMy5ADt8Ov4FNXLPlgAGKksCXidi9LJz\r\n\r\ncode=0&message=&user_id=1&user_name=이름&order_no=202003170002&service_name=dmp9&product_name=데이터 명&custom_parameter=&pgcode=creditcard&tid=tpay_test-202003178166664&cid=8166663&amount=1000&pay_info=테스트카드&domestic_flag=N&install_month=00&payhash=1C0C1A69F29D7533749BFEA927F5DAE5CFE8F22A45FDA8D5F6A94FDB5E4A05CF&taxfree_amount=0&tax_amount=91&nonsettle_amount=0&transaction_date=2020-03-17 14:11:13','2020-03-17 05:11:12','2020-03-17 05:11:12');
/*!40000 ALTER TABLE `pay_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_fails`
--

DROP TABLE IF EXISTS `payment_fails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_fails` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_parameter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_fails`
--

LOCK TABLES `payment_fails` WRITE;
/*!40000 ALTER TABLE `payment_fails` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_fails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_returns`
--

DROP TABLE IF EXISTS `payment_returns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_returns` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_parameter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pgcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domestic_flag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `install_month` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payhash` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taxfree_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nonsettle_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_returns`
--

LOCK TABLES `payment_returns` WRITE;
/*!40000 ALTER TABLE `payment_returns` DISABLE KEYS */;
INSERT INTO `payment_returns` VALUES (1,'0',NULL,'1','이름','202003170002','dmp9','데이터 명',NULL,'creditcard','tpay_test-202003178166664','8166663','1000','테스트카드','N','00','1C0C1A69F29D7533749BFEA927F5DAE5CFE8F22A45FDA8D5F6A94FDB5E4A05CF','0','91','0','2020-03-17 14:11:13','2020-03-17 05:11:12','2020-03-17 05:11:12');
/*!40000 ALTER TABLE `payment_returns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `platforms`
--

DROP TABLE IF EXISTS `platforms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `platforms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `platforms`
--

LOCK TABLES `platforms` WRITE;
/*!40000 ALTER TABLE `platforms` DISABLE KEYS */;
INSERT INTO `platforms` VALUES (1,'구글애즈/유튜브','https://ads.google.com'),(2,'페이스북/인스타그램','https://business.facebook.com'),(3,'네이버GFA','https://auth.glad.naver.com'),(4,'카카오모먼트','https://accounts.kakao.com');
/*!40000 ALTER TABLE `platforms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `taxes`
--

DROP TABLE IF EXISTS `taxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `taxes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL COMMENT 'id',
  `tax_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '대표자명',
  `tax_company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '업체명',
  `tax_industry` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '업종',
  `tax_zipcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '우편번호',
  `tax_addres_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '주소',
  `tax_addres_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '상세주소',
  `tax_reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '참고항목',
  `tax_img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'img_file',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `taxes`
--

LOCK TABLES `taxes` WRITE;
/*!40000 ALTER TABLE `taxes` DISABLE KEYS */;
INSERT INTO `taxes` VALUES (1,46,'대표자 명','업체명 (법인명)','업종 01','06649','서울 서초구 서초동 1563-10','fasdf',NULL,'','2020-03-16 11:43:04','2020-03-16 11:43:04'),(2,47,'fasdf','afds','업종 01','06649','서울 서초구 반포대로20길 29','fasdfds','(서초동)','8y5xpWrYJq8DtJ2QmDHW9XXCxYP3CXBZ4rC8mv9M.jpeg','2020-03-16 12:12:57','2020-03-16 12:12:57'),(3,1,'대표자 명','업체명 (법인명)','업종 01','06649','서울 서초구 반포대로20길 29','fasdf','(서초동)','sr3J1e8KaGX2fc3f9h4ICZc3qLBeBPH6m7Lw0EPf.jpeg','2020-03-17 01:51:43','2020-03-17 01:51:43');
/*!40000 ALTER TABLE `taxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'user_id',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '이름',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '이메일',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '전화번호',
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '회사명',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('personal','company','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'personal' COMMENT 'role',
  `approved` tinyint(1) NOT NULL DEFAULT '0' COMMENT '승인여부',
  `approved_at` timestamp NULL DEFAULT NULL COMMENT '승인수정일',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_user_id_unique` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'asdf','이름','$2y$10$6WJE9ZlevvNlRxtHoU8ale8GlhrRpzyWBbqllZ./MtvaCEe.X71fG','fdassdf@naver.com','010-1321-3123','회사명',NULL,NULL,'company',1,'2020-03-17 01:52:40','2020-03-17 01:51:43','2020-03-17 01:51:43'),(2,'qqqq','admin','$2y$10$3VFC39Gif4av7BIkfEt0huEV/dvdE0RuhJOjCAIpa0Xt76ZQQ0TrS','admin@naver.com','010-5555-4444','admin',NULL,NULL,'admin',0,NULL,'2020-03-17 04:32:06','2020-03-17 04:32:06');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-03-17 18:50:49
