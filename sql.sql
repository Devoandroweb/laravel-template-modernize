ALTER TABLE `barang` ADD `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `minimal_persediaan`;
ALTER TABLE `barang` ADD `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `created_at`;

ALTER TABLE `kategori` ADD `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `nama_kategori`;
ALTER TABLE `kategori` ADD `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `created_at`;

ALTER TABLE `user` ADD `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `password`;
ALTER TABLE `user` ADD `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `created_at`;

ALTER TABLE `sales` ADD `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `tanggal_sales`;
ALTER TABLE `sales` ADD `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `created_at`;

ALTER TABLE `persediaan` ADD `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `jumlah_barang`;
ALTER TABLE `persediaan` ADD `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `created_at`;

ALTER TABLE `persediaan` CHANGE `jumlah_barang` `jumlah_barang` INT(11) NOT NULL DEFAULT '0';

ALTER TABLE `penjualan` ADD `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `jumlah_penjualan`;
ALTER TABLE `penjualan` ADD `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `created_at`;

ALTER TABLE `pengembalian_barang` ADD `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `tanggal_pengembalian`;
ALTER TABLE `pengembalian_barang` ADD `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `created_at`;
