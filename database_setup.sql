CREATE DATABASE IF NOT EXISTS `putik_pi` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `putik_pi`;

-- Tabel users untuk login dan registrasi
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `address` TEXT DEFAULT NULL,
  `phone` VARCHAR(20) DEFAULT NULL,
  `photo` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel barang untuk menyimpan data produk
CREATE TABLE IF NOT EXISTS `barang` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_sepatu` VARCHAR(255) NOT NULL,
  `harga` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  `stok` INT UNSIGNED NOT NULL DEFAULT 0,
  `gambar_url` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel penjualan untuk mencatat transaksi
CREATE TABLE IF NOT EXISTS `penjualan` (
  `id_penjualan` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_pengguna` INT UNSIGNED NOT NULL,
  `total_harga` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  `waktu_transaksi` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_penjualan`),
  KEY `idx_id_pengguna` (`id_pengguna`),
  CONSTRAINT `fk_penjualan_user` FOREIGN KEY (`id_pengguna`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel detail_penjualan untuk rincian setiap transaksi
CREATE TABLE IF NOT EXISTS `detail_penjualan` (
  `id_detail` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_penjualan` INT UNSIGNED NOT NULL,
  `id_barang` INT UNSIGNED NOT NULL,
  `jumlah` INT UNSIGNED NOT NULL DEFAULT 1,
  `harga_saat_transaksi` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id_detail`),
  KEY `idx_id_penjualan` (`id_penjualan`),
  KEY `idx_id_barang` (`id_barang`),
  CONSTRAINT `fk_detail_penjualan_penjualan` FOREIGN KEY (`id_penjualan`) REFERENCES `penjualan`(`id_penjualan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_detail_penjualan_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Contoh data awal untuk barang (opsional)
INSERT INTO `barang` (`nama_sepatu`, `harga`, `stok`, `gambar_url`)
VALUES
  ('Nike Air Max', 120.00, 10, 'assets/images/nike-air-max.jpg'),
  ('Adidas Ultraboost', 150.00, 8, 'assets/images/adidas-ultraboost.jpg'),
  ('Puma Runner', 95.00, 15, 'assets/images/puma-runner.jpg')
ON DUPLICATE KEY UPDATE `nama_sepatu` = VALUES(`nama_sepatu`);
