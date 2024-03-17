/*
 Navicat Premium Data Transfer
 
 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80300
 Source Host           : localhost:3306
 Source Schema         : yt
 
 Target Server Type    : MySQL
 Target Server Version : 80300
 File Encoding         : 65001
 
 Date: 15/03/2024 20:02:17
 */
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;
-- ----------------------------
-- Table structure for xeeds
-- ----------------------------
DROP TABLE IF EXISTS `xeeds`;
CREATE TABLE `xeeds` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `big_integer` bigint NOT NULL,
    `binary` blob NOT NULL,
    `boolean` tinyint(1) NOT NULL,
    `char` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    `date_time_tz` datetime NOT NULL,
    `date_time` datetime NOT NULL,
    `date` date NOT NULL,
    `decimal` decimal(8, 2) NOT NULL,
    `double` double(8, 2) NOT NULL,
    `enum` enum('easy', 'hard') COLLATE utf8mb4_unicode_ci NOT NULL,
    `float` double(8, 2) NOT NULL,
    `foreign_id` bigint unsigned NOT NULL,
    `foreign_ulid` char(26) COLLATE utf8mb4_unicode_ci NOT NULL,
    `foreign_uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
    `geometry_collection` geomcollection NOT NULL,
    `geometry` geometry NOT NULL,
    `integer` int NOT NULL,
    `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
    `json` json NOT NULL,
    `jsonb` json NOT NULL,
    `line_string` linestring NOT NULL,
    `long_text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
    `mac_address` varchar(17) COLLATE utf8mb4_unicode_ci NOT NULL,
    `medium_integer` mediumint NOT NULL,
    `medium_text` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
    `morphs_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `morphs_id` bigint unsigned NOT NULL,
    `multi_point` multipoint NOT NULL,
    `multi_polygon` multipolygon NOT NULL,
    `nullable_morphs_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `nullable_morphs_id` bigint unsigned DEFAULT NULL,
    `nullable_ulid_morphs_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `nullable_ulid_morphs_id` char(26) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `nullable_uuid_morphs_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `nullable_uuid_morphs_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `point` point NOT NULL,
    `polygon` polygon NOT NULL,
    `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `set`
    set('strawberry', 'vanilla') COLLATE utf8mb4_unicode_ci NOT NULL,
        `small_integer` smallint NOT NULL,
        `soft_deletes_tz` timestamp NULL DEFAULT NULL,
        `soft_deletes` timestamp NULL DEFAULT NULL,
        `string` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
        `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
        `time_tz` time NOT NULL,
        `time` time NOT NULL,
        `timestamp_tz` timestamp NOT NULL,
        `timestamp` timestamp NOT NULL,
        `created_at` timestamp NULL DEFAULT NULL,
        `updated_at` timestamp NULL DEFAULT NULL,
        `tiny_integer` tinyint NOT NULL,
        `tiny_text` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
        `unsigned_big_integer` bigint unsigned NOT NULL,
        `unsigned_decimal` decimal(8, 2) unsigned NOT NULL,
        `unsigned_integer` int unsigned NOT NULL,
        `unsigned_medium_integer` mediumint unsigned NOT NULL,
        `unsigned_small_integer` smallint unsigned NOT NULL,
        `unsigned_tiny_integer` tinyint unsigned NOT NULL,
        `ulid_morphs_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
        `ulid_morphs_id` char(26) COLLATE utf8mb4_unicode_ci NOT NULL,
        `uuid_morphs_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
        `uuid_morphs_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
        `ulid` char(26) COLLATE utf8mb4_unicode_ci NOT NULL,
        `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
        `birth_year` year NOT NULL,
        PRIMARY KEY (`id`),
        KEY `xeeds_morphs_type_morphs_id_index` (`morphs_type`, `morphs_id`),
        KEY `xeeds_nullable_morphs_type_nullable_morphs_id_index` (`nullable_morphs_type`, `nullable_morphs_id`),
        KEY `xeeds_nullable_ulid_morphs_type_nullable_ulid_morphs_id_index` (
            `nullable_ulid_morphs_type`,
            `nullable_ulid_morphs_id`
        ),
        KEY `xeeds_nullable_uuid_morphs_type_nullable_uuid_morphs_id_index` (
            `nullable_uuid_morphs_type`,
            `nullable_uuid_morphs_id`
        ),
        KEY `xeeds_ulid_morphs_type_ulid_morphs_id_index` (`ulid_morphs_type`, `ulid_morphs_id`),
        KEY `xeeds_uuid_morphs_type_uuid_morphs_id_index` (`uuid_morphs_type`, `uuid_morphs_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;
-- ----------------------------
-- Records of xeeds
-- ----------------------------
BEGIN;
COMMIT;
SET FOREIGN_KEY_CHECKS = 1;