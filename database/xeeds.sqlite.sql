/*
 Navicat Premium Data Transfer
 
 Source Server         : Test
 Source Server Type    : SQLite
 Source Server Version : 3030001
 Source Schema         : main
 
 Target Server Type    : SQLite
 Target Server Version : 3030001
 File Encoding         : 65001
 
 Date: 16/03/2024 00:21:45
 */
PRAGMA foreign_keys = false;
-- ----------------------------
-- Table structure for xeeds
-- ----------------------------
DROP TABLE IF EXISTS "xeeds";
CREATE TABLE "xeeds" (
    "id" integer primary key autoincrement not null,
    "big_integer" integer not null,
    "binary" blob not null,
    "boolean" tinyint(1) not null,
    "char" varchar not null,
    "date_time_tz" datetime not null,
    "date_time" datetime not null,
    "date" date not null,
    "decimal" numeric not null,
    "double" float not null,
    "float" float not null,
    "foreign_id" integer not null,
    "foreign_ulid" varchar not null,
    "foreign_uuid" varchar not null,
    "geometry" geometry not null,
    "integer" integer not null,
    "ip_address" varchar not null,
    "json" text not null,
    "jsonb" text not null,
    "long_text" text not null,
    "mac_address" varchar not null,
    "medium_integer" integer not null,
    "medium_text" text not null,
    "morphs_type" varchar not null,
    "morphs_id" integer not null,
    "nullable_morphs_type" varchar,
    "nullable_morphs_id" integer,
    "nullable_ulid_morphs_type" varchar,
    "nullable_ulid_morphs_id" varchar,
    "nullable_uuid_morphs_type" varchar,
    "nullable_uuid_morphs_id" varchar,
    "remember_token" varchar,
    "small_integer" integer not null,
    "deleted_at_tz" datetime,
    "deleted_at" datetime,
    "string" varchar not null,
    "text" text not null,
    "time_tz" time not null,
    "time" time not null,
    "timestamp_tz" datetime not null,
    "timestamp" datetime not null,
    "created_at" datetime,
    "updated_at" datetime,
    "tiny_integer" integer not null,
    "tiny_text" text not null,
    "unsigned_big_integer" integer not null,
    "unsigned_integer" integer not null,
    "unsigned_medium_integer" integer not null,
    "unsigned_small_integer" integer not null,
    "unsigned_tiny_integer" integer not null,
    "ulid_morphs_type" varchar not null,
    "ulid_morphs_id" varchar not null,
    "uuid_morphs_type" varchar not null,
    "uuid_morphs_id" varchar not null,
    "ulid" varchar not null,
    "uuid" varchar not null,
    "year" integer not null
);
-- ----------------------------
-- Records of xeeds
-- ----------------------------
BEGIN;
COMMIT;
-- ----------------------------
-- Indexes structure for table xeeds
-- ----------------------------
CREATE INDEX "main"."xeeds_morphs_type_morphs_id_index" ON "xeeds" ("morphs_type" ASC, "morphs_id" ASC);
CREATE INDEX "main"."xeeds_nullable_morphs_type_nullable_morphs_id_index" ON "xeeds" (
    "nullable_morphs_type" ASC,
    "nullable_morphs_id" ASC
);
CREATE INDEX "main"."xeeds_nullable_ulid_morphs_type_nullable_ulid_morphs_id_index" ON "xeeds" (
    "nullable_ulid_morphs_type" ASC,
    "nullable_ulid_morphs_id" ASC
);
CREATE INDEX "main"."xeeds_nullable_uuid_morphs_type_nullable_uuid_morphs_id_index" ON "xeeds" (
    "nullable_uuid_morphs_type" ASC,
    "nullable_uuid_morphs_id" ASC
);
CREATE INDEX "main"."xeeds_ulid_morphs_type_ulid_morphs_id_index" ON "xeeds" (
    "ulid_morphs_type" ASC,
    "ulid_morphs_id" ASC
);
CREATE INDEX "main"."xeeds_uuid_morphs_type_uuid_morphs_id_index" ON "xeeds" (
    "uuid_morphs_type" ASC,
    "uuid_morphs_id" ASC
);
PRAGMA foreign_keys = true;