/*
 Navicat Premium Data Transfer

 Source Server         : local_db
 Source Server Type    : MySQL
 Source Server Version : 80017
 Source Host           : localhost:3306
 Source Schema         : laundry_aji

 Target Server Type    : MySQL
 Target Server Version : 80017
 File Encoding         : 65001

 Date: 06/10/2021 10:28:50
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `no_hp` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pass` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (1, 'kasir', 'rizal.muh.rzl@gmail.com', '085781571742', 'bismillah', 2, 1, '0000-00-00 00:00:00');
INSERT INTO `admin` VALUES (8, 'Endahwati', 'ragamuliakusuma@gmail.com', '081315875925', 'admin123', 1, 1, '2021-09-26 12:28:47');
INSERT INTO `admin` VALUES (9, 'Firman', 'firman@gmail.com', '085781571742', 'kasir123', 2, 1, '2021-09-26 12:49:16');

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `comment_id` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of comments
-- ----------------------------
INSERT INTO `comments` VALUES (3, 'Rizal', 'lok', NULL);

-- ----------------------------
-- Table structure for config
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `config_key` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `config_value` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of config
-- ----------------------------
INSERT INTO `config` VALUES (1, 'base_url', 'localhost/onestop-proses-kasir/', 'Base URL Server');
INSERT INTO `config` VALUES (2, 'base_kota', '152', 'Alamat Toko Online');
INSERT INTO `config` VALUES (3, 'rajaongkir_api_key', 'bacc849a20222b92977bae806209d0ae', 'API RajaOngkir');
INSERT INTO `config` VALUES (4, 'midtrans_client_key', 'SB-Mid-client-z4WlDRj-RCA07X5l', 'Client Key Midtrans');
INSERT INTO `config` VALUES (5, 'midtrans_server_key', 'SB-Mid-server-v4b5cO_LFYqpOEMd7q6MTFyO', 'Server Key Midtrans');

-- ----------------------------
-- Table structure for data
-- ----------------------------
DROP TABLE IF EXISTS `data`;
CREATE TABLE `data`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kelas` char(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `skala` char(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of data
-- ----------------------------

-- ----------------------------
-- Table structure for detail_transaksi
-- ----------------------------
DROP TABLE IF EXISTS `detail_transaksi`;
CREATE TABLE `detail_transaksi`  (
  `No_Order` char(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Id_Pakaian` char(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Id_Laundry` char(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Jumlah_pakaian` int(11) NOT NULL,
  `is_commit` int(1) NOT NULL,
  `admin_id` int(11) NOT NULL,
  INDEX `No_Order`(`No_Order`) USING BTREE,
  INDEX `Id_Pakaian`(`Id_Pakaian`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of detail_transaksi
-- ----------------------------
INSERT INTO `detail_transaksi` VALUES ('1143', 'C3', '1', 5, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1142', 'C1', '1', 2, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1144', 'D1', '1', 2, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1144', 'BA', '2', 2, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1147', 'B3', '2', 4, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1146', 'N6', '2', 2, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1145', 'B2', '1', 2, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1149', 'C3', '2', 4, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1148', 'B2', '1', 4, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1150', 'C2', '1', 4, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1152', 'R2', '2', 4, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1151', 'K2', '1', 4, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1152', 'M1', '2', 2, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1151', 'C1', '2', 4, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1151', 'R1', '2', 2, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1152', 'C2', '2', 4, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1153', 'N6', '2', 2, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1154', 'C1', '2', 2, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1160', 'F2', '1', 1, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1156', 'B2', '1', 4, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1157', 'C1', '2', 2, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1158', 'BA', '2', 4, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1159', 'C2', '1', 1, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1161', 'B2', '1', 4, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1162', 'N6', '2', 4, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1163', 'B2', '1', 4, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1164', 'S4', '2', 4, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1165', 'C3', '2', 2, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1166', 'B2', '2', 4, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1166', 'C2', '2', 2, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1167', 'C3', '2', 5, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1167', 'C3', '1', 5, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1167', 'C1', '2', 2, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1168', 'B2', '1', 4, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1170', 'J1', '2', 4, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1170', 'S4', '1', 6, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1170', 'B2', '', 2, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1165', 'C1', '', 2, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1170', 'S9', '5', 2, 0, 0);
INSERT INTO `detail_transaksi` VALUES ('1171', 'S2', '3', 2, 0, 8);
INSERT INTO `detail_transaksi` VALUES ('1171', 'K3', '2', 4, 0, 8);
INSERT INTO `detail_transaksi` VALUES ('1171', 'H1', '2', 2, 0, 8);
INSERT INTO `detail_transaksi` VALUES ('1171', 'J1', '2', 3, 0, 9);

-- ----------------------------
-- Table structure for files_upload
-- ----------------------------
DROP TABLE IF EXISTS `files_upload`;
CREATE TABLE `files_upload`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `file_ext` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `file_location` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of files_upload
-- ----------------------------

-- ----------------------------
-- Table structure for harga
-- ----------------------------
DROP TABLE IF EXISTS `harga`;
CREATE TABLE `harga`  (
  `no_order` char(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `total_berat` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `Id_Laundry` int(11) NOT NULL,
  `Id_Pakaian` char(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of harga
-- ----------------------------
INSERT INTO `harga` VALUES ('1170', 3, 15000, 1, NULL, 0);
INSERT INTO `harga` VALUES ('1170', 2, 19500, 2, NULL, 0);
INSERT INTO `harga` VALUES ('1170', 6, 60000, 3, NULL, 0);
INSERT INTO `harga` VALUES ('1170', 4, 100000, 4, NULL, 0);
INSERT INTO `harga` VALUES ('1170', 2, 110000, 5, NULL, 0);
INSERT INTO `harga` VALUES ('1171', 3, 19500, 2, NULL, 8);
INSERT INTO `harga` VALUES ('1171', 2, 10000, 3, 'S2', 8);

-- ----------------------------
-- Table structure for kelas
-- ----------------------------
DROP TABLE IF EXISTS `kelas`;
CREATE TABLE `kelas`  (
  `id_kelas` char(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama` tinytext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_kelas`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of kelas
-- ----------------------------
INSERT INTO `kelas` VALUES ('1', 'Regular');
INSERT INTO `kelas` VALUES ('2', 'express');
INSERT INTO `kelas` VALUES ('3', 'reparasi');

-- ----------------------------
-- Table structure for laundry
-- ----------------------------
DROP TABLE IF EXISTS `laundry`;
CREATE TABLE `laundry`  (
  `Id_Laundry` int(11) NOT NULL AUTO_INCREMENT,
  `Jenis_Laundry` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `Harga` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`Id_Laundry`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of laundry
-- ----------------------------
INSERT INTO `laundry` VALUES (1, 'Setrika', 5000);
INSERT INTO `laundry` VALUES (2, 'Cuci & Setrika', 6500);
INSERT INTO `laundry` VALUES (3, 'Dry Clean', 2000);
INSERT INTO `laundry` VALUES (4, 'Reparasi', 1000);
INSERT INTO `laundry` VALUES (5, 'Recolour', 1000);
INSERT INTO `laundry` VALUES (6, 'Cuci', 2000);

-- ----------------------------
-- Table structure for merk_warna_exist
-- ----------------------------
DROP TABLE IF EXISTS `merk_warna_exist`;
CREATE TABLE `merk_warna_exist`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merk` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `warna` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of merk_warna_exist
-- ----------------------------
INSERT INTO `merk_warna_exist` VALUES (1, 'Joger', 'Merah');
INSERT INTO `merk_warna_exist` VALUES (2, 'Giordano', 'Biru');

-- ----------------------------
-- Table structure for notification_data
-- ----------------------------
DROP TABLE IF EXISTS `notification_data`;
CREATE TABLE `notification_data`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of notification_data
-- ----------------------------
INSERT INTO `notification_data` VALUES (1, 'start', 'pesan');

-- ----------------------------
-- Table structure for otp
-- ----------------------------
DROP TABLE IF EXISTS `otp`;
CREATE TABLE `otp`  (
  `id` int(11) NOT NULL,
  `nomer` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `otp` int(4) NOT NULL,
  `waktu` int(20) NOT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of otp
-- ----------------------------

-- ----------------------------
-- Table structure for pakaian
-- ----------------------------
DROP TABLE IF EXISTS `pakaian`;
CREATE TABLE `pakaian`  (
  `Id_Pakaian` char(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Jenis_Pakaian` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Dry_Clean` int(11) NOT NULL,
  `Reparasi` int(11) NOT NULL,
  `Recolour` int(11) NOT NULL,
  PRIMARY KEY (`Id_Pakaian`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pakaian
-- ----------------------------
INSERT INTO `pakaian` VALUES ('B1', 'Baju Muslim', 25000, 65000, 120000);
INSERT INTO `pakaian` VALUES ('B3', 'Boneka', 0, 0, 0);
INSERT INTO `pakaian` VALUES ('C1', 'Celana Dalam', 0, 0, 0);
INSERT INTO `pakaian` VALUES ('C2', 'Celana Panjang', 0, 0, 0);
INSERT INTO `pakaian` VALUES ('C3', 'Celana Pendek', 0, 0, 0);
INSERT INTO `pakaian` VALUES ('D1', 'Daster', 0, 0, 0);
INSERT INTO `pakaian` VALUES ('H1', 'Handuk', 0, 0, 0);
INSERT INTO `pakaian` VALUES ('J1', 'Jaket', 0, 0, 0);
INSERT INTO `pakaian` VALUES ('K1', 'Kaos', 0, 0, 0);
INSERT INTO `pakaian` VALUES ('K2', 'Kaos Dalam', 0, 0, 0);
INSERT INTO `pakaian` VALUES ('K3', 'Kaos Kaki', 0, 0, 0);
INSERT INTO `pakaian` VALUES ('K4', 'Kebaya', 0, 0, 0);
INSERT INTO `pakaian` VALUES ('K5', 'Kemeja', 0, 0, 0);
INSERT INTO `pakaian` VALUES ('M1', 'Mukena', 0, 0, 0);
INSERT INTO `pakaian` VALUES ('R1', 'Rok', 0, 0, 0);
INSERT INTO `pakaian` VALUES ('R2', 'Rompi', 0, 0, 0);
INSERT INTO `pakaian` VALUES ('S1', 'Sarung Bantal', 0, 0, 0);
INSERT INTO `pakaian` VALUES ('S2', 'Sejadah', 5000, 10000, 15000);
INSERT INTO `pakaian` VALUES ('S3', 'Sarung Guling', 0, 0, 0);
INSERT INTO `pakaian` VALUES ('S4', 'Selimut', 0, 0, 0);
INSERT INTO `pakaian` VALUES ('S5', 'Seprei', 0, 0, 0);
INSERT INTO `pakaian` VALUES ('S6', 'Sweater', 0, 0, 0);
INSERT INTO `pakaian` VALUES ('A6', 'Sofa', 0, 0, 0);
INSERT INTO `pakaian` VALUES ('N6', 'Gorden', 0, 0, 0);
INSERT INTO `pakaian` VALUES ('BA', 'Pakaian Bayi', 0, 0, 0);
INSERT INTO `pakaian` VALUES ('F2', 'Jemuran', 0, 0, 0);
INSERT INTO `pakaian` VALUES ('P9', 'Poster', 0, 0, 0);
INSERT INTO `pakaian` VALUES ('C0', 'Payung', 0, 0, 0);
INSERT INTO `pakaian` VALUES ('S9', 'Sepatu', 0, 0, 0);
INSERT INTO `pakaian` VALUES ('P3', 'Tas Koper', 45000, 165000, 250000);

-- ----------------------------
-- Table structure for pelanggan
-- ----------------------------
DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE `pelanggan`  (
  `No_Identitas` char(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Nama` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Alamat` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `No_Hp` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`No_Identitas`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pelanggan
-- ----------------------------
INSERT INTO `pelanggan` VALUES ('10115562', 'Hani', 'Bandung', '081232121111', 'rizal.muh.rzl@gmail.com');
INSERT INTO `pelanggan` VALUES ('10115310', 'Barrur', 'Bandung', '089123222321', 'info@valryhouse.com');
INSERT INTO `pelanggan` VALUES ('10115315', 'Nanda', 'Bandung', '087824521555', 'rizal.muh.rzl@gmail.com');
INSERT INTO `pelanggan` VALUES ('10115313', 'Fata', 'Bandung', '087822555784', 'rizal.muh.rzl@gmail.com');
INSERT INTO `pelanggan` VALUES ('10115322', 'Sinta', 'Bandung', '082313112111', 'rizal.muh.rzl@gmail.com');
INSERT INTO `pelanggan` VALUES ('10115320', 'Nur', 'Bandung', '082122122122', 'rizal.muh.rzl@gmail.com');
INSERT INTO `pelanggan` VALUES ('31749892', 'Afrizal', 'Cikoko', '085478345', 'rizal.muh.rzl@gmail.com');
INSERT INTO `pelanggan` VALUES ('32175845', 'Khoirul', 'Pengadegan', '08572743763', 'rizal.muh.rzl@gmail.com');
INSERT INTO `pelanggan` VALUES ('32174543', 'Ujang', 'Bali', '0968546345', 'ujang@gmail.com');
INSERT INTO `pelanggan` VALUES ('93287483', 'Rizal', 'cikoko', '08443724387', 'cawangbsi@gmail.com');

-- ----------------------------
-- Table structure for profil
-- ----------------------------
DROP TABLE IF EXISTS `profil`;
CREATE TABLE `profil`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_profil` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tag` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `no_telp` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `no_telp2` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `lokasi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `no_rekening` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gambar` varchar(225) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of profil
-- ----------------------------
INSERT INTO `profil` VALUES (1, 'Azwar Group', 'info@valryhouse.com', 'Laundry & Dry Cleaning bro', '08118870289', '081210777721', 'Jl Hortikultura no. 11/53b Pasar Minggu\r\n|\r\nJl. Cikoko Barat Dalam I no. 5 rt.03/03. Pancoran', '0000000', '801-logo.png');

-- ----------------------------
-- Table structure for skala
-- ----------------------------
DROP TABLE IF EXISTS `skala`;
CREATE TABLE `skala`  (
  `id_skala` char(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_kelas` char(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_jenis` int(11) NOT NULL,
  PRIMARY KEY (`id_skala`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of skala
-- ----------------------------
INSERT INTO `skala` VALUES ('1', '1', '3 Hari', 1);
INSERT INTO `skala` VALUES ('2', '2', '3 Jam', 2);
INSERT INTO `skala` VALUES ('3', '2', '6 Jam', 2);
INSERT INTO `skala` VALUES ('4', '2', '8 Jam', 2);
INSERT INTO `skala` VALUES ('5', '2', '1 Hari', 2);
INSERT INTO `skala` VALUES ('6', '3', '1 Minggu', 3);
INSERT INTO `skala` VALUES ('7', '3', '2 Minggu', 3);
INSERT INTO `skala` VALUES ('8', '3', '1 Bulan', 3);

-- ----------------------------
-- Table structure for transaksi
-- ----------------------------
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi`  (
  `No_Order` char(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `No_Identitas` char(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Tgl_Terima` datetime NULL DEFAULT NULL,
  `Tgl_Ambil` datetime NULL DEFAULT NULL,
  `total_berat` float NOT NULL,
  `diskon` float NOT NULL,
  `dp` int(11) NOT NULL,
  `sisa_bayar` int(11) NOT NULL,
  `Total_Bayar` int(50) NULL DEFAULT NULL,
  `admin_id` int(11) NOT NULL DEFAULT 1,
  `kelas` char(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `skala` char(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `payment` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`No_Order`) USING BTREE,
  INDEX `No_Identitas`(`No_Identitas`) USING BTREE,
  INDEX `No_Identitas_2`(`No_Identitas`) USING BTREE,
  INDEX `No_Identitas_3`(`No_Identitas`) USING BTREE,
  INDEX `admin_id`(`admin_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transaksi
-- ----------------------------
INSERT INTO `transaksi` VALUES ('1158', '10115310', '2021-10-02 09:46:47', '2021-10-02 00:00:00', 1, 0, 4481, 19500, 24000, 8, '2', '4', 'selesai', NULL, NULL);
INSERT INTO `transaksi` VALUES ('1157', '31749892', '2021-10-02 09:31:47', '2021-10-02 00:00:00', 1, 0, 4963, 19000, 24000, 8, '2', '2', 'selesai', NULL, NULL);
INSERT INTO `transaksi` VALUES ('1156', '32174543', '2021-10-02 01:52:59', '2021-10-02 11:57:43', 1, 0, 2485, 20000, 22500, 8, '3', '8', 'selesai', '', NULL);
INSERT INTO `transaksi` VALUES ('1148', '10115562', '2021-09-29 00:00:00', '2021-10-02 00:00:00', 1, 0, 4983, 17500, 22500, 8, '1', '1', 'selesai', NULL, NULL);
INSERT INTO `transaksi` VALUES ('1149', '10115313', '2021-09-29 00:00:00', '2021-10-01 00:00:00', 1, 0, 2000, 22000, 24000, 8, '2', '2', 'selesai', NULL, NULL);
INSERT INTO `transaksi` VALUES ('1150', '10115315', '2021-09-29 00:00:00', '2021-09-30 00:00:00', 1, 0, 1989, 20500, 22500, 9, '2', '5', 'selesai', NULL, NULL);
INSERT INTO `transaksi` VALUES ('1151', '31749892', '2021-09-30 00:00:00', '2021-10-01 00:00:00', 1, 0, 2000, 25000, 31500, 9, '3', '6', 'selesai', NULL, NULL);
INSERT INTO `transaksi` VALUES ('1152', '10115315', '2021-10-01 00:00:00', '2021-10-02 00:00:00', 1, 0, 2000, 31000, 33000, 8, '1', '1', 'selesai', NULL, NULL);
INSERT INTO `transaksi` VALUES ('1153', '10115562', '2021-10-02 00:01:40', '2021-10-02 00:00:00', 1, 0, 1994, 22000, 24000, 8, '2', '3', 'selesai', NULL, NULL);
INSERT INTO `transaksi` VALUES ('1154', '10115320', '2021-10-02 00:07:21', '2021-10-02 10:54:41', 1, 0, 1984, 22000, 24000, 8, '3', '6', 'selesai', NULL, NULL);
INSERT INTO `transaksi` VALUES ('1159', '10115315', '2021-10-02 11:18:05', '2021-10-02 11:50:27', 1, 0, 2983, 19500, 22500, 8, '1', '1', 'selesai', '', NULL);
INSERT INTO `transaksi` VALUES ('1160', '10115322', '2021-10-02 12:00:40', '2021-10-02 12:02:19', 1, 0, 4991, 17500, 22500, 8, '2', '5', 'selesai', 'keterangan', NULL);
INSERT INTO `transaksi` VALUES ('1161', '10115313', '2021-10-02 12:17:22', '2021-10-02 12:18:15', 1, 0, 7988, 14501, 22500, 8, '1', '1', 'selesai', '', NULL);
INSERT INTO `transaksi` VALUES ('1162', '10115562', '2021-10-02 12:19:33', '2021-10-02 12:23:02', 1, 0, 1987, 22000, 24000, 8, '2', '3', 'selesai', '', NULL);
INSERT INTO `transaksi` VALUES ('1163', '10115315', '2021-10-02 12:32:19', NULL, 1, 0, 1989, 20500, 22500, 8, '2', '2', 'baru', NULL, NULL);
INSERT INTO `transaksi` VALUES ('1164', '10115322', '2021-10-02 12:40:33', '2021-10-06 00:00:00', 5, 0, 20000, 82000, 102000, 8, '2', '5', 'selesai', NULL, NULL);
INSERT INTO `transaksi` VALUES ('1165', '32175845', '2021-10-02 16:28:20', NULL, 1, 0, 2000, 22000, 24000, 8, '1', '1', 'baru', NULL, NULL);
INSERT INTO `transaksi` VALUES ('1166', '32175845', '2021-10-02 17:38:56', '2021-10-02 00:00:00', 1, 0, 8500, 20000, 28500, 9, '2', '2', 'selesai', NULL, NULL);
INSERT INTO `transaksi` VALUES ('1170', '10115562', '2021-10-03 15:52:59', '2021-10-06 01:20:28', 25, 0, 19981, 90000, 304500, 8, '2', '5', 'selesai', NULL, NULL);
INSERT INTO `transaksi` VALUES ('1171', '31749892', '2021-10-06 01:02:41', '2021-10-06 00:00:00', 11, 0, 20000, 9500, 29500, 8, '1', '1', 'selesai', NULL, 'tunai');

-- ----------------------------
-- Table structure for user_menu
-- ----------------------------
DROP TABLE IF EXISTS `user_menu`;
CREATE TABLE `user_menu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `url` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `is_active` int(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_menu
-- ----------------------------
INSERT INTO `user_menu` VALUES (1, 'Dashboard', 'index1', 1);
INSERT INTO `user_menu` VALUES (2, 'Transaksi Laundry', 'tambahdatatransaksi', 1);
INSERT INTO `user_menu` VALUES (3, 'Data Transaksi', 'transaksi', 1);
INSERT INTO `user_menu` VALUES (4, 'Data Item', 'pakaian', 1);
INSERT INTO `user_menu` VALUES (5, 'Data Pelanggan', 'pelanggan', 1);
INSERT INTO `user_menu` VALUES (6, 'Data Harga', 'harga', 1);

-- ----------------------------
-- Table structure for verification_trx
-- ----------------------------
DROP TABLE IF EXISTS `verification_trx`;
CREATE TABLE `verification_trx`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `jenis_barang` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of verification_trx
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
