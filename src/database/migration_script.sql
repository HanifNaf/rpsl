-- ----------------------------------------------------------------------------
-- MySQL Workbench Migration
-- Migrated Schemata: rpsl
-- Source Schemata: rpsl
-- Created: Tue Dec  5 02:05:55 2023
-- Workbench Version: 8.0.33
-- ----------------------------------------------------------------------------

SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------------------------------------------------------
-- Schema rpsl
-- ----------------------------------------------------------------------------
DROP SCHEMA IF EXISTS `rpsl` ;
CREATE SCHEMA IF NOT EXISTS `rpsl` ;

-- ----------------------------------------------------------------------------
-- Table rpsl.boiler
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `rpsl`.`boiler` (
  `boiler_id` VARCHAR(36) NOT NULL,
  `tanggal` DATE NOT NULL,
  `alkalinity_booster` FLOAT(24) NULL,
  `oxygen_scavenger` FLOAT(24) NULL,
  `internal_treatment` FLOAT(24) NULL,
  `condensate_treatment` FLOAT(24) NULL,
  `m3_air` INT NULL,
  `cost_alkalinity_booster` INT NULL DEFAULT 24000,
  `cost_oxygen_scavenger` INT NULL DEFAULT 34500,
  `cost_internal_treatment` INT NULL DEFAULT 74500,
  `cost_condensate_treatment` INT NULL DEFAULT 51000,
  `solid_additive` FLOAT(24) NULL,
  `cost_solid_additive` INT NULL DEFAULT 35500,
  `tanggal_id` VARCHAR(36) NULL,
  PRIMARY KEY (`boiler_id`),
  CONSTRAINT `boiler_tanggal_id_fkey`
    FOREIGN KEY (`tanggal_id`)
    REFERENCES `rpsl`.`tanggal_gabungan` (`tanggal_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table rpsl.cooling_tower
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `rpsl`.`cooling_tower` (
  `cooling_tower_id` VARCHAR(36) NOT NULL,
  `tanggal` DATE NOT NULL,
  `corrotion_inhibitor` FLOAT(24) NULL,
  `cooling_water_dispersant` FLOAT(24) NULL,
  `oxy_hg` FLOAT(24) NULL,
  `sulfuric_acid` FLOAT(24) NULL,
  `cost_corrotion_inhibitor` FLOAT(24) NULL DEFAULT 37000,
  `cost_cooling_water_dispersant` FLOAT(24) NULL DEFAULT 49500,
  `cost_oxy_hg` FLOAT(24) NULL DEFAULT 44000,
  `cost_sulfuric_acid` FLOAT(24) NULL DEFAULT 3135,
  `tanggal_id` VARCHAR(36) NULL,
  PRIMARY KEY (`cooling_tower_id`),
  CONSTRAINT `cooling_tower_tanggal_id_fkey`
    FOREIGN KEY (`tanggal_id`)
    REFERENCES `rpsl`.`tanggal_gabungan` (`tanggal_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table rpsl.halaman_dashboard
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `rpsl`.`halaman_dashboard` (
  `halaman_id` INT NOT NULL,
  `nama_halaman` VARCHAR(100) NULL,
  PRIMARY KEY (`halaman_id`));

-- ----------------------------------------------------------------------------
-- Table rpsl.kecelakaan_kerja
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `rpsl`.`kecelakaan_kerja` (
  `kecelakaan_kerja_id` VARCHAR(36) NOT NULL,
  `tanggal` DATE NOT NULL,
  `jenis_kecelakaan_kerja` VARCHAR(50) NOT NULL,
  `waktu_kejadian` TIME NOT NULL,
  `area_kejadian` VARCHAR(100) NOT NULL,
  `jam_kerja_kejadian` VARCHAR(50) NOT NULL,
  `penyebab` VARCHAR(500) NOT NULL,
  `penanganan` VARCHAR(500) NULL,
  `tanggal_id` VARCHAR(36) NULL,
  PRIMARY KEY (`kecelakaan_kerja_id`),
  CONSTRAINT `kecelakaan_kerja_tanggal_id_fkey`
    FOREIGN KEY (`tanggal_id`)
    REFERENCES `rpsl`.`tanggal_gabungan` (`tanggal_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table rpsl.lampiran_hrd
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `rpsl`.`lampiran_hrd` (
  `lampiran_id` VARCHAR(36) NOT NULL,
  `nama` VARCHAR(500) NULL,
  `tipe` VARCHAR(50) NULL,
  `file` LONGBLOB NULL,
  PRIMARY KEY (`lampiran_id`));

-- ----------------------------------------------------------------------------
-- Table rpsl.lampiran_maintenance
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `rpsl`.`lampiran_maintenance` (
  `lampiran_id` VARCHAR(36) NOT NULL,
  `nama` VARCHAR(500) NULL,
  `tipe` VARCHAR(50) NULL,
  `file` LONGBLOB NULL,
  PRIMARY KEY (`lampiran_id`));

-- ----------------------------------------------------------------------------
-- Table rpsl.maintenance
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `rpsl`.`maintenance` (
  `maintenance_id` VARCHAR(36) NOT NULL,
  `divisi` VARCHAR(100) NOT NULL,
  `unit` VARCHAR(100) NULL,
  `problem` VARCHAR(500) NULL,
  `evaluasi` VARCHAR(500) NULL,
  `penanganan` VARCHAR(500) NULL,
  `tanggal_mulai` DATE NOT NULL,
  `tanggal_selesai` DATE NULL,
  `status` VARCHAR(50) NOT NULL,
  `tingkat_kerusakan` VARCHAR(50) NOT NULL,
  `keterangan` VARCHAR(500) NULL,
  `sparepart` VARCHAR(200) NULL,
  `jumlah_sparepart` INT NULL,
  `satuan_sparepart` VARCHAR(50) NULL,
  `lampiran_id` VARCHAR(36) NULL,
  `tanggal_id` VARCHAR(36) NULL,
  PRIMARY KEY (`maintenance_id`),
  CONSTRAINT `lampiran_maintenance_fk`
    FOREIGN KEY (`lampiran_id`)
    REFERENCES `rpsl`.`lampiran_maintenance` (`lampiran_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `maintenance_tanggal_id_fkey`
    FOREIGN KEY (`tanggal_id`)
    REFERENCES `rpsl`.`tanggal_gabungan` (`tanggal_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table rpsl.operasional
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `rpsl`.`operasional` (
  `operasional_id` VARCHAR(36) NOT NULL,
  `produksi_id` VARCHAR(36) NOT NULL,
  `pemakaian_id` VARCHAR(36) NOT NULL,
  `pemakaian_bahan_bakar_id` VARCHAR(36) NOT NULL,
  `keterangan` VARCHAR(500) NULL,
  `tanggal` DATE NOT NULL,
  `waktu` TIME NOT NULL DEFAULT CURRENT_TIME(),
  `shift` INT NOT NULL,
  `tanggal_id` VARCHAR(36) NULL,
  `downtime` INT NULL,
  PRIMARY KEY (`operasional_id`),
  UNIQUE INDEX `operasional_tanggal_shift_key` (`tanggal` ASC, `shift` ASC) VISIBLE,
  CONSTRAINT `operasional_pemakaian_bahan_bakar_fkey`
    FOREIGN KEY (`pemakaian_bahan_bakar_id`)
    REFERENCES `rpsl`.`pemakaian_bahan_bakar` (`pemakaian_bahan_bakar_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `operasional_pemakaian_id_fkey`
    FOREIGN KEY (`pemakaian_id`)
    REFERENCES `rpsl`.`pemakaian_kwh` (`pemakaian_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `operasional_produksi_id_fkey`
    FOREIGN KEY (`produksi_id`)
    REFERENCES `rpsl`.`produksi_kwh` (`produksi_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `operasional_tanggal_id_fkey`
    FOREIGN KEY (`tanggal_id`)
    REFERENCES `rpsl`.`tanggal_gabungan` (`tanggal_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table rpsl.pelanggaran
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `rpsl`.`pelanggaran` (
  `pelanggaran_id` VARCHAR(36) NOT NULL,
  `tanggal` DATE NOT NULL,
  `nik` VARCHAR(100) NULL,
  `nama` VARCHAR(100) NOT NULL,
  `bagian` VARCHAR(100) NOT NULL,
  `shift` VARCHAR(10) NOT NULL,
  `waktu_pelanggaran` TIME NULL,
  `tempat_pelanggaran` VARCHAR(100) NULL,
  `bentuk_pelanggaran` VARCHAR(500) NOT NULL,
  `potensi_bahaya` VARCHAR(200) NULL,
  `sanksi` VARCHAR(100) NULL,
  `lampiran_id` VARCHAR(36) NULL,
  `tanggal_id` VARCHAR(36) NULL,
  PRIMARY KEY (`pelanggaran_id`),
  CONSTRAINT `lampiran_hrd_fk`
    FOREIGN KEY (`lampiran_id`)
    REFERENCES `rpsl`.`lampiran_hrd` (`lampiran_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `pelanggaran_tanggal_id_fkey`
    FOREIGN KEY (`tanggal_id`)
    REFERENCES `rpsl`.`tanggal_gabungan` (`tanggal_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table rpsl.pemakaian_bahan_bakar
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `rpsl`.`pemakaian_bahan_bakar` (
  `pemakaian_bahan_bakar_id` VARCHAR(36) NOT NULL,
  `tanggal` DATE NOT NULL,
  `waktu` TIME NOT NULL DEFAULT CURRENT_TIME(),
  `rpkg_cangkang` INT NULL DEFAULT 876,
  `kcal_cangkang` INT NULL DEFAULT 2177,
  `rpkg_palmfiber` INT NULL DEFAULT 266,
  `kcal_palmfiber` INT NULL DEFAULT 2040,
  `rpkg_woodchips` INT NULL DEFAULT 313,
  `kcal_woodchips` INT NULL DEFAULT 2084,
  `rpkg_serbukkayu` INT NULL DEFAULT 200,
  `kcal_serbukkayu` INT NULL DEFAULT 1789,
  `rpkg_sabutkelapa` INT NULL DEFAULT 200,
  `kcal_sabutkelapa` INT NULL DEFAULT 1615,
  `rpkg_efbpress` INT NULL DEFAULT 210,
  `kcal_efbpress` INT NULL DEFAULT 1906,
  `rpkg_opt` INT NULL DEFAULT 200,
  `kcal_opt` INT NULL DEFAULT 1630,
  `shift` INT NOT NULL,
  `kg_cangkang` INT NULL DEFAULT 0,
  `kg_palmfiber` INT NULL DEFAULT 0,
  `kg_woodchips` INT NULL DEFAULT 0,
  `kg_serbukkayu` INT NULL DEFAULT 0,
  `kg_sabutkelapa` INT NULL DEFAULT 0,
  `kg_efbpress` INT NULL DEFAULT 0,
  `kg_opt` INT NULL DEFAULT 0,
  `tanggal_id` VARCHAR(36) NULL,
  PRIMARY KEY (`pemakaian_bahan_bakar_id`),
  UNIQUE INDEX `pemakaian_bahan_bakar_tanggal_shift_key` (`tanggal` ASC, `shift` ASC) VISIBLE,
  CONSTRAINT `pemakaian_bahan_bakar_tanggal_id_fkey`
    FOREIGN KEY (`tanggal_id`)
    REFERENCES `rpsl`.`tanggal_gabungan` (`tanggal_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table rpsl.pemakaian_kwh
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `rpsl`.`pemakaian_kwh` (
  `pemakaian_id` VARCHAR(36) NOT NULL,
  `ekspor` INT NOT NULL,
  `pemakaian_sendiri` INT NOT NULL,
  `kwh_loss` INT NULL,
  `tanggal` DATE NOT NULL,
  `waktu` TIME NOT NULL DEFAULT CURRENT_TIME(),
  `shift` INT NOT NULL,
  `tanggal_id` VARCHAR(36) NULL,
  PRIMARY KEY (`pemakaian_id`),
  UNIQUE INDEX `pemakaian_kwh_tanggal_shift_key` (`tanggal` ASC, `shift` ASC) VISIBLE,
  CONSTRAINT `pemakaian_kwh_tanggal_id_fkey`
    FOREIGN KEY (`tanggal_id`)
    REFERENCES `rpsl`.`tanggal_gabungan` (`tanggal_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table rpsl.produksi_kwh
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `rpsl`.`produksi_kwh` (
  `produksi_id` VARCHAR(36) NOT NULL,
  `generation` INT NOT NULL,
  `pm_kwh_pltbm` INT NOT NULL,
  `tanggal` DATE NOT NULL,
  `waktu` TIME NOT NULL DEFAULT CURRENT_TIME(),
  `shift` INT NOT NULL,
  `tanggal_id` VARCHAR(36) NULL,
  PRIMARY KEY (`produksi_id`),
  UNIQUE INDEX `produksi_kwh_tanggal_shift_key` (`tanggal` ASC, `shift` ASC) VISIBLE,
  CONSTRAINT `produksi_kwh_tanggal_id_fkey`
    FOREIGN KEY (`tanggal_id`)
    REFERENCES `rpsl`.`tanggal_gabungan` (`tanggal_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table rpsl.ro
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `rpsl`.`ro` (
  `ro_id` VARCHAR(36) NOT NULL,
  `tanggal` DATE NOT NULL,
  `anti_scalant` FLOAT(24) NULL,
  `cost_anti_scalant` FLOAT(24) NULL DEFAULT 52500,
  `alkalinity_booster` FLOAT(24) NULL,
  `cost_alkalinity_booster` FLOAT(24) NULL DEFAULT 24500,
  `asam_s4241` FLOAT(24) NULL,
  `cost_asam_s4241` FLOAT(24) NULL DEFAULT 37500,
  `asam_hcl` FLOAT(24) NULL,
  `cost_asam_hcl` FLOAT(24) NULL DEFAULT 6000,
  `basa_s4243` FLOAT(24) NULL,
  `cost_basa_s4243` FLOAT(24) NULL DEFAULT 92500,
  `basa_caustik` FLOAT(24) NULL,
  `cost_basa_caustik` FLOAT(24) NULL DEFAULT 18000,
  `cartridge_40` FLOAT(24) NULL,
  `cost_cartridge_40` FLOAT(24) NULL DEFAULT 200000,
  `cartridge_30` FLOAT(24) NULL,
  `cost_cartridge_30` FLOAT(24) NULL DEFAULT 180000,
  `m3_air` FLOAT(24) NULL,
  `tanggal_id` VARCHAR(36) NULL,
  PRIMARY KEY (`ro_id`),
  CONSTRAINT `ro_tanggal_id_fkey`
    FOREIGN KEY (`tanggal_id`)
    REFERENCES `rpsl`.`tanggal_gabungan` (`tanggal_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table rpsl.sungai
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `rpsl`.`sungai` (
  `sungai_id` VARCHAR(36) NOT NULL,
  `tanggal` DATE NOT NULL,
  `koagulan` FLOAT(24) NULL,
  `soda_ash` FLOAT(24) NULL,
  `flokulan` FLOAT(24) NULL,
  `cost_koagulan` FLOAT(24) NULL DEFAULT 10800,
  `cost_soda_ash` FLOAT(24) NULL DEFAULT 10400,
  `cost_flokulan` FLOAT(24) NULL DEFAULT 58000,
  `m3_air` FLOAT(24) NULL,
  `tanggal_id` VARCHAR(36) NULL,
  PRIMARY KEY (`sungai_id`),
  CONSTRAINT `sungai_tanggal_id_fkey`
    FOREIGN KEY (`tanggal_id`)
    REFERENCES `rpsl`.`tanggal_gabungan` (`tanggal_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table rpsl.tanggal_gabungan
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `rpsl`.`tanggal_gabungan` (
  `tanggal_id` VARCHAR(36) NOT NULL,
  `tanggal` DATE NOT NULL,
  PRIMARY KEY (`tanggal_id`));

-- ----------------------------------------------------------------------------
-- Table rpsl.users
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `rpsl`.`users` (
  `users_id` VARCHAR(36) NOT NULL,
  `username` VARCHAR(50) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `role` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`users_id`),
  UNIQUE INDEX `users_username_key` (`username` ASC) VISIBLE);
SET FOREIGN_KEY_CHECKS = 1;
