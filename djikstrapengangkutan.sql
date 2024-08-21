/*
 Navicat Premium Data Transfer

 Source Server         : mysql_con
 Source Server Type    : MySQL
 Source Server Version : 80200
 Source Host           : localhost:3306
 Source Schema         : djikstrapengangkutan

 Target Server Type    : MySQL
 Target Server Version : 80200
 File Encoding         : 65001

 Date: 04/08/2024 00:12:55
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(0) NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache
-- ----------------------------
INSERT INTO `cache` VALUES ('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:10:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:14:\"show dashboard\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:3;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:8:\"show map\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:11:\"show lokasi\";s:1:\"c\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:17:\"show transportasi\";s:1:\"c\";s:3:\"web\";}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:17:\"show pengangkutan\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:2;i:1;i:3;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:23:\"show pengangkutan-harga\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:3;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:24:\"show pengangkutan-filter\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:3;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:19:\"create pengangkutan\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:8;a:3:{s:1:\"a\";i:9;s:1:\"b\";s:12:\"show laporan\";s:1:\"c\";s:3:\"web\";}i:9;a:3:{s:1:\"a\";i:10;s:1:\"b\";s:12:\"show profile\";s:1:\"c\";s:3:\"web\";}}s:5:\"roles\";a:2:{i:0;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:11:\"Operasional\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:8:\"Pimpinan\";s:1:\"c\";s:3:\"web\";}}}', 1722790445);

-- ----------------------------
-- Table structure for cache_locks
-- ----------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(0) NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for grafs
-- ----------------------------
DROP TABLE IF EXISTS `grafs`;
CREATE TABLE `grafs`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `start` bigint(0) UNSIGNED NOT NULL,
  `end` bigint(0) UNSIGNED NOT NULL,
  `jarak` decimal(8, 2) NOT NULL,
  `rute` linestring NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `grafs_start_foreign`(`start`) USING BTREE,
  INDEX `grafs_end_foreign`(`end`) USING BTREE,
  CONSTRAINT `grafs_end_foreign` FOREIGN KEY (`end`) REFERENCES `nodes` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `grafs_start_foreign` FOREIGN KEY (`start`) REFERENCES `nodes` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of grafs
-- ----------------------------
INSERT INTO `grafs` VALUES (33, 27, 21, 0.83, ST_GeomFromText('LINESTRING(111.406457 -7.808541, 111.406249 -7.815982)'), '2024-08-04 00:06:48', '2024-08-04 00:06:48');
INSERT INTO `grafs` VALUES (34, 21, 19, 1.06, ST_GeomFromText('LINESTRING(111.406249 -7.815982, 111.406239 -7.816349, 111.411356 -7.81684, 111.413228 -7.817106, 111.415183 -7.817448, 111.415167 -7.817252)'), '2024-08-04 00:06:58', '2024-08-04 00:06:58');
INSERT INTO `grafs` VALUES (35, 21, 22, 2.22, ST_GeomFromText('LINESTRING(111.406249 -7.815982, 111.406239 -7.816349, 111.411356 -7.81684, 111.415183 -7.817448, 111.418057 -7.817589, 111.418272 -7.818172, 111.419008 -7.818241, 111.419072 -7.819518, 111.424249 -7.8194)'), '2024-08-04 00:07:07', '2024-08-04 00:07:07');
INSERT INTO `grafs` VALUES (36, 21, 25, 0.88, ST_GeomFromText('LINESTRING(111.406249 -7.815982, 111.406032 -7.823844)'), '2024-08-04 00:07:14', '2024-08-04 00:07:14');
INSERT INTO `grafs` VALUES (37, 21, 26, 2.53, ST_GeomFromText('LINESTRING(111.406249 -7.815982, 111.406241 -7.816313, 111.402055 -7.815545, 111.394878 -7.814777, 111.394184 -7.814004, 111.393582 -7.814941, 111.393278 -7.815622, 111.392983 -7.815992, 111.392737 -7.816507, 111.391309 -7.8234)'), '2024-08-04 00:07:26', '2024-08-04 00:07:26');
INSERT INTO `grafs` VALUES (38, 26, 25, 1.95, ST_GeomFromText('LINESTRING(111.391309 -7.8234, 111.391735 -7.821402, 111.39515 -7.822045, 111.395619 -7.822182, 111.39619 -7.822507, 111.399117 -7.823103, 111.403631 -7.824285, 111.404508 -7.824381, 111.406005 -7.824741, 111.406032 -7.823844)'), '2024-08-04 00:07:37', '2024-08-04 00:07:37');
INSERT INTO `grafs` VALUES (39, 26, 21, 2.53, ST_GeomFromText('LINESTRING(111.391309 -7.8234, 111.392737 -7.816507, 111.392983 -7.815992, 111.393278 -7.815622, 111.393582 -7.814941, 111.394184 -7.814004, 111.394878 -7.814777, 111.402055 -7.815545, 111.406241 -7.816313, 111.406249 -7.815982)'), '2024-08-04 00:07:44', '2024-08-04 00:07:44');
INSERT INTO `grafs` VALUES (41, 24, 28, 1.79, ST_GeomFromText('LINESTRING(111.428922 -7.836125, 111.428892 -7.836364, 111.428405 -7.836329, 111.429164 -7.833947, 111.429404 -7.833344, 111.429788 -7.830851, 111.431479 -7.831082, 111.43383 -7.831499, 111.434365 -7.831505, 111.438626 -7.83115, 111.439117 -7.83152, 111.439169 -7.831721)'), '2024-08-04 00:08:06', '2024-08-04 00:08:06');
INSERT INTO `grafs` VALUES (42, 24, 20, 1.60, ST_GeomFromText('LINESTRING(111.428922 -7.836125, 111.428892 -7.836364, 111.428405 -7.836329, 111.429404 -7.833344, 111.430245 -7.827777, 111.431987 -7.827418, 111.431998 -7.825883, 111.432419 -7.825003, 111.432562 -7.824482)'), '2024-08-04 00:08:13', '2024-08-04 00:08:13');
INSERT INTO `grafs` VALUES (43, 28, 20, 1.53, ST_GeomFromText('LINESTRING(111.439169 -7.831721, 111.439117 -7.83152, 111.438626 -7.83115, 111.43853 -7.830951, 111.438415 -7.827047, 111.43556 -7.827031, 111.435271 -7.826886, 111.431993 -7.82678, 111.431998 -7.825883, 111.432419 -7.825003, 111.432562 -7.824482)'), '2024-08-04 00:08:35', '2024-08-04 00:08:35');
INSERT INTO `grafs` VALUES (44, 28, 23, 2.16, ST_GeomFromText('LINESTRING(111.439169 -7.831721, 111.439117 -7.83152, 111.43853 -7.830951, 111.43833 -7.825815, 111.437689 -7.82575, 111.437629 -7.824881, 111.437233 -7.823723, 111.43744 -7.821957, 111.435625 -7.821846, 111.436401 -7.818953, 111.43706 -7.815129)'), '2024-08-04 00:08:40', '2024-08-04 00:08:40');
INSERT INTO `grafs` VALUES (45, 23, 22, 2.08, ST_GeomFromText('LINESTRING(111.43706 -7.815129, 111.436904 -7.816518, 111.436401 -7.818953, 111.435562 -7.821965, 111.43542 -7.822109, 111.435265 -7.822138, 111.434081 -7.822013, 111.433485 -7.821797, 111.43316 -7.821611, 111.42883 -7.820558, 111.4265 -7.819908, 111.425503 -7.819466, 111.424249 -7.8194)'), '2024-08-04 00:08:50', '2024-08-04 00:08:50');
INSERT INTO `grafs` VALUES (46, 22, 21, 2.22, ST_GeomFromText('LINESTRING(111.424249 -7.8194, 111.419072 -7.819518, 111.419008 -7.818241, 111.418272 -7.818172, 111.418057 -7.817589, 111.415183 -7.817448, 111.411356 -7.81684, 111.406239 -7.816349, 111.406249 -7.815982)'), '2024-08-04 00:08:57', '2024-08-04 00:08:57');
INSERT INTO `grafs` VALUES (47, 22, 24, 2.97, ST_GeomFromText('LINESTRING(111.424249 -7.8194, 111.425503 -7.819466, 111.4265 -7.819908, 111.433485 -7.821797, 111.431998 -7.825883, 111.43201 -7.827378, 111.430245 -7.827777, 111.429404 -7.833344, 111.428405 -7.836329, 111.428892 -7.836364, 111.428922 -7.836125)'), '2024-08-04 00:09:09', '2024-08-04 00:09:09');
INSERT INTO `grafs` VALUES (48, 22, 20, 1.38, ST_GeomFromText('LINESTRING(111.424249 -7.8194, 111.425503 -7.819466, 111.426056 -7.819754, 111.4265 -7.819908, 111.42883 -7.820558, 111.43316 -7.821611, 111.433361 -7.82169, 111.433485 -7.821797, 111.433365 -7.821959, 111.433009 -7.82299, 111.432562 -7.824482)'), '2024-08-04 00:09:20', '2024-08-04 00:09:20');
INSERT INTO `grafs` VALUES (49, 21, 27, 0.83, ST_GeomFromText('LINESTRING(111.406249 -7.815982, 111.406457 -7.808541)'), '2024-08-04 00:09:42', '2024-08-04 00:09:42');
INSERT INTO `grafs` VALUES (50, 25, 21, 0.88, ST_GeomFromText('LINESTRING(111.406032 -7.823844, 111.406249 -7.815982)'), '2024-08-04 00:09:52', '2024-08-04 00:09:52');
INSERT INTO `grafs` VALUES (51, 25, 26, 1.95, ST_GeomFromText('LINESTRING(111.406032 -7.823844, 111.406005 -7.824741, 111.404508 -7.824381, 111.403631 -7.824285, 111.399117 -7.823103, 111.39619 -7.822507, 111.395619 -7.822182, 111.39515 -7.822045, 111.391735 -7.821402, 111.391309 -7.8234)'), '2024-08-04 00:10:05', '2024-08-04 00:10:05');
INSERT INTO `grafs` VALUES (52, 25, 24, 3.72, ST_GeomFromText('LINESTRING(111.406032 -7.823844, 111.406047 -7.82335, 111.409593 -7.823823, 111.40969 -7.824168, 111.411391 -7.824899, 111.414261 -7.825585, 111.414258 -7.826448, 111.41738 -7.827948, 111.418284 -7.828574, 111.420745 -7.829297, 111.421765 -7.829298, 111.421813 -7.828565, 111.424986 -7.82894, 111.425412 -7.829185, 111.426196 -7.830359, 111.429694 -7.831416, 111.429404 -7.833344, 111.428405 -7.836329, 111.428892 -7.836364, 111.428922 -7.836125)'), '2024-08-04 00:10:12', '2024-08-04 00:10:12');
INSERT INTO `grafs` VALUES (53, 24, 25, 3.72, ST_GeomFromText('LINESTRING(111.428922 -7.836125, 111.428892 -7.836364, 111.428405 -7.836329, 111.429404 -7.833344, 111.429694 -7.831416, 111.426196 -7.830359, 111.425412 -7.829185, 111.424986 -7.82894, 111.421813 -7.828565, 111.421765 -7.829298, 111.420745 -7.829297, 111.418284 -7.828574, 111.41738 -7.827948, 111.414258 -7.826448, 111.414261 -7.825585, 111.411391 -7.824899, 111.40969 -7.824168, 111.409593 -7.823823, 111.406047 -7.82335, 111.406032 -7.823844)'), '2024-08-04 00:10:35', '2024-08-04 00:10:35');
INSERT INTO `grafs` VALUES (54, 24, 22, 2.97, ST_GeomFromText('LINESTRING(111.428922 -7.836125, 111.428892 -7.836364, 111.428405 -7.836329, 111.429404 -7.833344, 111.430245 -7.827777, 111.43201 -7.827378, 111.431998 -7.825883, 111.433485 -7.821797, 111.4265 -7.819908, 111.425503 -7.819466, 111.424249 -7.8194)'), '2024-08-04 00:10:48', '2024-08-04 00:10:48');

-- ----------------------------
-- Table structure for job_batches
-- ----------------------------
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(0) NOT NULL,
  `pending_jobs` int(0) NOT NULL,
  `failed_jobs` int(0) NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `cancelled_at` int(0) NULL DEFAULT NULL,
  `created_at` int(0) NOT NULL,
  `finished_at` int(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(0) UNSIGNED NOT NULL,
  `reserved_at` int(0) UNSIGNED NULL DEFAULT NULL,
  `available_at` int(0) UNSIGNED NOT NULL,
  `created_at` int(0) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `jobs_queue_index`(`queue`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for konektors
-- ----------------------------
DROP TABLE IF EXISTS `konektors`;
CREATE TABLE `konektors`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of konektors
-- ----------------------------
INSERT INTO `konektors` VALUES (1, '2024-07-13 01:08:36', '2024-07-13 01:08:36');
INSERT INTO `konektors` VALUES (2, '2024-07-13 01:08:45', '2024-07-13 01:08:45');
INSERT INTO `konektors` VALUES (3, '2024-07-13 01:08:50', '2024-07-13 01:08:50');
INSERT INTO `konektors` VALUES (4, '2024-07-13 01:11:03', '2024-07-13 01:11:03');
INSERT INTO `konektors` VALUES (5, '2024-07-13 01:11:17', '2024-07-13 01:11:17');
INSERT INTO `konektors` VALUES (6, '2024-07-13 01:11:21', '2024-07-13 01:11:21');
INSERT INTO `konektors` VALUES (7, '2024-07-13 01:11:58', '2024-07-13 01:11:58');
INSERT INTO `konektors` VALUES (8, '2024-07-13 01:12:06', '2024-07-13 01:12:06');
INSERT INTO `konektors` VALUES (9, '2024-07-13 01:12:13', '2024-07-13 01:12:13');
INSERT INTO `konektors` VALUES (10, '2024-08-04 00:05:48', '2024-08-04 00:05:48');
INSERT INTO `konektors` VALUES (11, '2024-08-04 00:05:54', '2024-08-04 00:05:54');
INSERT INTO `konektors` VALUES (12, '2024-08-04 00:05:59', '2024-08-04 00:05:59');
INSERT INTO `konektors` VALUES (13, '2024-08-04 00:06:05', '2024-08-04 00:06:05');
INSERT INTO `konektors` VALUES (14, '2024-08-04 00:06:19', '2024-08-04 00:06:19');
INSERT INTO `konektors` VALUES (15, '2024-08-04 00:06:26', '2024-08-04 00:06:26');
INSERT INTO `konektors` VALUES (16, '2024-08-04 00:06:32', '2024-08-04 00:06:32');
INSERT INTO `konektors` VALUES (17, '2024-08-04 00:06:38', '2024-08-04 00:06:38');

-- ----------------------------
-- Table structure for lokasi
-- ----------------------------
DROP TABLE IF EXISTS `lokasi`;
CREATE TABLE `lokasi`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lokasi
-- ----------------------------
INSERT INTO `lokasi` VALUES (5, 'Lokasi A', '2024-08-04 00:05:28', '2024-08-04 00:05:28');
INSERT INTO `lokasi` VALUES (6, 'Lokasi B', '2024-08-04 00:05:40', '2024-08-04 00:05:40');

-- ----------------------------
-- Table structure for media
-- ----------------------------
DROP TABLE IF EXISTS `media`;
CREATE TABLE `media`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(0) UNSIGNED NOT NULL,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `collection_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `disk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `size` bigint(0) UNSIGNED NOT NULL,
  `manipulations` json NOT NULL,
  `custom_properties` json NOT NULL,
  `generated_conversions` json NOT NULL,
  `responsive_images` json NOT NULL,
  `order_column` int(0) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `media_uuid_unique`(`uuid`) USING BTREE,
  INDEX `media_model_type_model_id_index`(`model_type`, `model_id`) USING BTREE,
  INDEX `media_order_column_index`(`order_column`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` VALUES (3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2024_05_29_142004_create_lokasis_table', 1);
INSERT INTO `migrations` VALUES (5, '2024_05_31_081007_create_permission_tables', 1);
INSERT INTO `migrations` VALUES (6, '2024_06_01_011115_create_media_table', 1);
INSERT INTO `migrations` VALUES (7, '2024_06_05_070103_create_konektors_table', 1);
INSERT INTO `migrations` VALUES (8, '2024_06_05_083352_create_nodes_table', 1);
INSERT INTO `migrations` VALUES (9, '2024_06_06_101148_create_grafs_table', 1);
INSERT INTO `migrations` VALUES (10, '2024_06_24_152427_create_transportasis_table', 1);
INSERT INTO `migrations` VALUES (11, '2024_06_25_172219_create_pengangkutans_table', 1);

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions`  (
  `permission_id` bigint(0) UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(0) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_permissions_model_id_model_type_index`(`model_id`, `model_type`) USING BTREE,
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles`  (
  `role_id` bigint(0) UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(0) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_roles_model_id_model_type_index`(`model_id`, `model_type`) USING BTREE,
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
INSERT INTO `model_has_roles` VALUES (1, 'App\\Models\\User', 1);
INSERT INTO `model_has_roles` VALUES (2, 'App\\Models\\User', 2);
INSERT INTO `model_has_roles` VALUES (3, 'App\\Models\\User', 3);

-- ----------------------------
-- Table structure for nodes
-- ----------------------------
DROP TABLE IF EXISTS `nodes`;
CREATE TABLE `nodes`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `coordinates` point NULL,
  `taggable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `taggable_id` bigint(0) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `nodes_taggable_type_taggable_id_index`(`taggable_type`, `taggable_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of nodes
-- ----------------------------
INSERT INTO `nodes` VALUES (19, ST_GeomFromText('POINT(-7.817252355 111.41516805)'), 'App\\Models\\Lokasi', 5, '2024-08-04 00:05:28', '2024-08-04 00:05:28');
INSERT INTO `nodes` VALUES (20, ST_GeomFromText('POINT(-7.82447784 111.43254333)'), 'App\\Models\\Lokasi', 6, '2024-08-04 00:05:40', '2024-08-04 00:05:40');
INSERT INTO `nodes` VALUES (21, ST_GeomFromText('POINT(-7.815981115 111.40621973)'), 'App\\Models\\Konektor', 10, '2024-08-04 00:05:48', '2024-08-04 00:05:48');
INSERT INTO `nodes` VALUES (22, ST_GeomFromText('POINT(-7.819509982 111.42424418)'), 'App\\Models\\Konektor', 11, '2024-08-04 00:05:54', '2024-08-04 00:05:54');
INSERT INTO `nodes` VALUES (23, ST_GeomFromText('POINT(-7.81513078 111.43707587)'), 'App\\Models\\Konektor', 12, '2024-08-04 00:05:59', '2024-08-04 00:05:59');
INSERT INTO `nodes` VALUES (24, ST_GeomFromText('POINT(-7.836040313 111.42875465)'), 'App\\Models\\Konektor', 13, '2024-08-04 00:06:05', '2024-08-04 00:06:05');
INSERT INTO `nodes` VALUES (25, ST_GeomFromText('POINT(-7.823846622 111.4061339)'), 'App\\Models\\Konektor', 14, '2024-08-04 00:06:19', '2024-08-04 00:06:19');
INSERT INTO `nodes` VALUES (26, ST_GeomFromText('POINT(-7.823400628 111.3913096)'), 'App\\Models\\Konektor', 15, '2024-08-04 00:06:26', '2024-08-04 00:06:26');
INSERT INTO `nodes` VALUES (27, ST_GeomFromText('POINT(-7.808541558 111.40647722)'), 'App\\Models\\Konektor', 16, '2024-08-04 00:06:32', '2024-08-04 00:06:32');
INSERT INTO `nodes` VALUES (28, ST_GeomFromText('POINT(-7.831756606 111.43892418)'), 'App\\Models\\Konektor', 17, '2024-08-04 00:06:38', '2024-08-04 00:06:38');

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for pengangkutan
-- ----------------------------
DROP TABLE IF EXISTS `pengangkutan`;
CREATE TABLE `pengangkutan`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(0) UNSIGNED NOT NULL,
  `transportasi_id` bigint(0) UNSIGNED NOT NULL,
  `lokasi_awal` bigint(0) UNSIGNED NOT NULL,
  `lokasi_tujuan` bigint(0) UNSIGNED NOT NULL,
  `pengangkut` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `jarak` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `liter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `harga` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '0',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `pengangkutan_user_id_foreign`(`user_id`) USING BTREE,
  INDEX `pengangkutan_transportasi_id_foreign`(`transportasi_id`) USING BTREE,
  INDEX `pengangkutan_lokasi_awal_foreign`(`lokasi_awal`) USING BTREE,
  INDEX `pengangkutan_lokasi_tujuan_foreign`(`lokasi_tujuan`) USING BTREE,
  CONSTRAINT `pengangkutan_lokasi_awal_foreign` FOREIGN KEY (`lokasi_awal`) REFERENCES `nodes` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `pengangkutan_lokasi_tujuan_foreign` FOREIGN KEY (`lokasi_tujuan`) REFERENCES `nodes` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `pengangkutan_transportasi_id_foreign` FOREIGN KEY (`transportasi_id`) REFERENCES `transportasi` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `pengangkutan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `permissions_name_guard_name_unique`(`name`, `guard_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (1, 'show dashboard', 'web', '2024-07-12 11:40:34', '2024-07-12 11:40:34');
INSERT INTO `permissions` VALUES (2, 'show map', 'web', '2024-07-12 11:40:35', '2024-07-12 11:40:35');
INSERT INTO `permissions` VALUES (3, 'show lokasi', 'web', '2024-07-12 11:40:35', '2024-07-12 11:40:35');
INSERT INTO `permissions` VALUES (4, 'show transportasi', 'web', '2024-07-12 11:40:35', '2024-07-12 11:40:35');
INSERT INTO `permissions` VALUES (5, 'show pengangkutan', 'web', '2024-07-12 11:40:35', '2024-07-12 11:40:35');
INSERT INTO `permissions` VALUES (6, 'show pengangkutan-harga', 'web', '2024-07-12 11:40:35', '2024-07-12 11:40:35');
INSERT INTO `permissions` VALUES (7, 'show pengangkutan-filter', 'web', '2024-07-12 11:40:35', '2024-07-12 11:40:35');
INSERT INTO `permissions` VALUES (8, 'create pengangkutan', 'web', '2024-07-12 11:40:35', '2024-07-12 11:40:35');
INSERT INTO `permissions` VALUES (9, 'show laporan', 'web', '2024-07-12 11:40:35', '2024-07-12 11:40:35');
INSERT INTO `permissions` VALUES (10, 'show profile', 'web', '2024-07-12 11:40:35', '2024-07-12 11:40:35');

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions`  (
  `permission_id` bigint(0) UNSIGNED NOT NULL,
  `role_id` bigint(0) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `role_has_permissions_role_id_foreign`(`role_id`) USING BTREE,
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
INSERT INTO `role_has_permissions` VALUES (1, 2);
INSERT INTO `role_has_permissions` VALUES (2, 2);
INSERT INTO `role_has_permissions` VALUES (5, 2);
INSERT INTO `role_has_permissions` VALUES (8, 2);
INSERT INTO `role_has_permissions` VALUES (1, 3);
INSERT INTO `role_has_permissions` VALUES (5, 3);
INSERT INTO `role_has_permissions` VALUES (6, 3);
INSERT INTO `role_has_permissions` VALUES (7, 3);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_name_guard_name_unique`(`name`, `guard_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'Administrator', 'web', '2024-07-12 11:40:35', '2024-07-12 11:40:35');
INSERT INTO `roles` VALUES (2, 'Operasional', 'web', '2024-07-12 11:40:35', '2024-07-12 11:40:35');
INSERT INTO `roles` VALUES (3, 'Pimpinan', 'web', '2024-07-12 11:40:36', '2024-07-12 11:40:36');

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(0) UNSIGNED NULL DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sessions_user_id_index`(`user_id`) USING BTREE,
  INDEX `sessions_last_activity_index`(`last_activity`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO `sessions` VALUES ('OxZC6XNq39JKbeQYOOQ2ovEu77YuWhAcPoTuE1Vc', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:128.0) Gecko/20100101 Firefox/128.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSWREa0pZTDk5c2FEcmhadE83TVFDUHRYMnpkY2JkU3p3RTlKWmdhTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHBzOi8vZGppa3N0cmFuZXcudGVzdC9tYXAvbm9kZS8xOSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1722705121);

-- ----------------------------
-- Table structure for transportasi
-- ----------------------------
DROP TABLE IF EXISTS `transportasi`;
CREATE TABLE `transportasi`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `merk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `plat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `muatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pemilik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `thn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `warna` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transportasi
-- ----------------------------
INSERT INTO `transportasi` VALUES (1, 'Suzuki', 'AD 5 BC', '1600lt', 'Yunita Novitasari', '2007', 'Merah', '2024-07-12 11:40:37', '2024-07-12 11:40:37');
INSERT INTO `transportasi` VALUES (2, 'Suzuki', 'AD 5 BC', '1600lt', 'Emil Gadang Mandala', '2007', 'Merah', '2024-07-12 11:40:37', '2024-07-12 11:40:37');
INSERT INTO `transportasi` VALUES (3, 'Honda', 'AD 0 BC', '1600lt', 'Dirja Mahfud Simanjuntak', '2007', 'Merah', '2024-07-12 11:40:37', '2024-07-12 11:40:37');
INSERT INTO `transportasi` VALUES (4, 'Honda', 'AD 9 BC', '1600lt', 'Aris Rajasa', '2007', 'Merah', '2024-07-12 11:40:37', '2024-07-12 11:40:37');
INSERT INTO `transportasi` VALUES (5, 'Suzuki', 'AD 2 BC', '1600lt', 'Hamima Hasanah', '2007', 'Merah', '2024-07-12 11:40:37', '2024-07-12 11:40:37');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', 'admin@app.com', '2024-07-12 11:40:36', '$2y$12$IfsvaoT8oIul4lovKHZH4uf4Dcv0RD5eXQ1JQL7FckpKfr0rzxqMu', 'ew6tXqLA0fcocM89La3oMkbuU2vEl5UoO4uxLmzzbv0BAhonHYjgQJRouygQ', '2024-07-12 11:40:36', '2024-07-12 11:40:36');
INSERT INTO `users` VALUES (2, 'user1', 'user1@app.com', '2024-07-12 11:40:36', '$2y$12$tz/VNIGp1yl0ZJ3RTOsXKuToCVkGf8hvTmHISwx815vTqqiWjJs0e', '9Gt3f4VgVGF9T569TqwldynoENTlUzlDjxu5aYZGpwHpNM4iw9mOGrYs86mV', '2024-07-12 11:40:36', '2024-07-12 11:40:36');
INSERT INTO `users` VALUES (3, 'pimpinan1', 'pimpinan1@app.com', '2024-07-12 11:40:37', '$2y$12$N.HqB0tZpakVmKjtlySHreiO/HYW2TyobYvRKybKoMP5z19bvkVu.', '8uPrLTa6Ne8wItxd22OXIjGUkj8jswKQDE6rqQ8L3BiWEKd041k1R6iLnnEO', '2024-07-12 11:40:37', '2024-07-12 11:40:37');

SET FOREIGN_KEY_CHECKS = 1;
