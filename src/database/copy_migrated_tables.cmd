REM Workbench Table Data copy script
REM Workbench Version: 8.0.33
REM 
REM Execute this to copy table data from a source RDBMS to MySQL.
REM Edit the options below to customize it. You will need to provide passwords, at least.
REM 
REM Source DB: postgresql@DRIVER=PostgreSQL ANSI;SERVER=localhost;PORT=5432 (PostgreSQL)
REM Target DB: Mysql@localhost:3306


@ECHO OFF
REM Source and target DB passwords
set arg_source_password=pass_rpsl
set arg_target_password=root
set arg_source_ssh_password=
set arg_target_ssh_password=


REM Set the location for wbcopytables.exe in this variable
set "wbcopytables_path=C:\Program Files\MySQL\MySQL Workbench 8.0 CE"

if not [%wbcopytables_path%] == [] set wbcopytables_path=%wbcopytables_path%
set wbcopytables=%wbcopytables_path%\wbcopytables.exe

if not exist "%wbcopytables%" (
	echo "wbcopytables.exe doesn't exist in the supplied path. Please set 'wbcopytables_path' with the proper path(e.g. to Workbench binaries)"
	exit 1
)

IF [%arg_source_password%] == [] (
    IF [%arg_target_password%] == [] (
        IF [%arg_source_ssh_password%] == [] (
            IF [%arg_target_ssh_password%] == [] (
                ECHO WARNING: All source and target passwords are empty. You should edit this file to set them.
            )
        )
    )
)
set arg_worker_count=2
REM Uncomment the following options according to your needs

REM Whether target tables should be truncated before copy
REM set arg_truncate_target=--truncate-target
REM Enable debugging output
REM set arg_debug_output=--log-level=debug3


REM Creation of file with table definitions for copytable

set table_file=%TMP%\wb_tables_to_migrate.txt
TYPE NUL > %TMP%\wb_tables_to_migrate.txt
ECHO "rpsl"	"public"."boiler"	`rpsl`	`boiler`	"boiler_id"	`boiler_id`	"boiler_id", "tanggal", "alkalinity_booster", "oxygen_scavenger", "internal_treatment", "condensate_treatment", "m3_air", "cost_alkalinity_booster", "cost_oxygen_scavenger", "cost_internal_treatment", "cost_condensate_treatment", "solid_additive", "cost_solid_additive", "tanggal_id" >> %TMP%\wb_tables_to_migrate.txt
ECHO "rpsl"	"public"."cooling_tower"	`rpsl`	`cooling_tower`	"cooling_tower_id"	`cooling_tower_id`	"cooling_tower_id", "tanggal", "corrotion_inhibitor", "cooling_water_dispersant", "oxy_hg", "sulfuric_acid", "cost_corrotion_inhibitor", "cost_cooling_water_dispersant", "cost_oxy_hg", "cost_sulfuric_acid", "tanggal_id" >> %TMP%\wb_tables_to_migrate.txt
ECHO "rpsl"	"public"."halaman_dashboard"	`rpsl`	`halaman_dashboard`	"halaman_id"	`halaman_id`	"halaman_id", "nama_halaman" >> %TMP%\wb_tables_to_migrate.txt
ECHO "rpsl"	"public"."kecelakaan_kerja"	`rpsl`	`kecelakaan_kerja`	"kecelakaan_kerja_id"	`kecelakaan_kerja_id`	"kecelakaan_kerja_id", "tanggal", "jenis_kecelakaan_kerja", "waktu_kejadian", "area_kejadian", "jam_kerja_kejadian", "penyebab", "penanganan", "tanggal_id" >> %TMP%\wb_tables_to_migrate.txt
ECHO "rpsl"	"public"."lampiran_hrd"	`rpsl`	`lampiran_hrd`	"lampiran_id"	`lampiran_id`	"lampiran_id", "nama", "tipe", "file" >> %TMP%\wb_tables_to_migrate.txt
ECHO "rpsl"	"public"."lampiran_maintenance"	`rpsl`	`lampiran_maintenance`	"lampiran_id"	`lampiran_id`	"lampiran_id", "nama", "tipe", "file" >> %TMP%\wb_tables_to_migrate.txt
ECHO "rpsl"	"public"."maintenance"	`rpsl`	`maintenance`	"maintenance_id"	`maintenance_id`	"maintenance_id", "divisi", "unit", "problem", "evaluasi", "penanganan", "tanggal_mulai", "tanggal_selesai", "status", "tingkat_kerusakan", "keterangan", "sparepart", "jumlah_sparepart", "satuan_sparepart", "lampiran_id", "tanggal_id" >> %TMP%\wb_tables_to_migrate.txt
ECHO "rpsl"	"public"."operasional"	`rpsl`	`operasional`	"operasional_id"	`operasional_id`	"operasional_id", "produksi_id", "pemakaian_id", "pemakaian_bahan_bakar_id", "keterangan", "tanggal", "waktu", "shift", "tanggal_id", "downtime" >> %TMP%\wb_tables_to_migrate.txt
ECHO "rpsl"	"public"."pelanggaran"	`rpsl`	`pelanggaran`	"pelanggaran_id"	`pelanggaran_id`	"pelanggaran_id", "tanggal", "nik", "nama", "bagian", "shift", "waktu_pelanggaran", "tempat_pelanggaran", "bentuk_pelanggaran", "potensi_bahaya", "sanksi", "lampiran_id", "tanggal_id" >> %TMP%\wb_tables_to_migrate.txt
ECHO "rpsl"	"public"."pemakaian_bahan_bakar"	`rpsl`	`pemakaian_bahan_bakar`	"pemakaian_bahan_bakar_id"	`pemakaian_bahan_bakar_id`	"pemakaian_bahan_bakar_id", "tanggal", "waktu", "rpkg_cangkang", "kcal_cangkang", "rpkg_palmfiber", "kcal_palmfiber", "rpkg_woodchips", "kcal_woodchips", "rpkg_serbukkayu", "kcal_serbukkayu", "rpkg_sabutkelapa", "kcal_sabutkelapa", "rpkg_efbpress", "kcal_efbpress", "rpkg_opt", "kcal_opt", "shift", "kg_cangkang", "kg_palmfiber", "kg_woodchips", "kg_serbukkayu", "kg_sabutkelapa", "kg_efbpress", "kg_opt", "tanggal_id" >> %TMP%\wb_tables_to_migrate.txt
ECHO "rpsl"	"public"."pemakaian_kwh"	`rpsl`	`pemakaian_kwh`	"pemakaian_id"	`pemakaian_id`	"pemakaian_id", "ekspor", "pemakaian_sendiri", "kwh_loss", "tanggal", "waktu", "shift", "tanggal_id" >> %TMP%\wb_tables_to_migrate.txt
ECHO "rpsl"	"public"."produksi_kwh"	`rpsl`	`produksi_kwh`	"produksi_id"	`produksi_id`	"produksi_id", "generation", "pm_kwh_pltbm", "tanggal", "waktu", "shift", "tanggal_id" >> %TMP%\wb_tables_to_migrate.txt
ECHO "rpsl"	"public"."ro"	`rpsl`	`ro`	"ro_id"	`ro_id`	"ro_id", "tanggal", "anti_scalant", "cost_anti_scalant", "alkalinity_booster", "cost_alkalinity_booster", "asam_s4241", "cost_asam_s4241", "asam_hcl", "cost_asam_hcl", "basa_s4243", "cost_basa_s4243", "basa_caustik", "cost_basa_caustik", "cartridge_40", "cost_cartridge_40", "cartridge_30", "cost_cartridge_30", "m3_air", "tanggal_id" >> %TMP%\wb_tables_to_migrate.txt
ECHO "rpsl"	"public"."sungai"	`rpsl`	`sungai`	"sungai_id"	`sungai_id`	"sungai_id", "tanggal", "koagulan", "soda_ash", "flokulan", "cost_koagulan", "cost_soda_ash", "cost_flokulan", "m3_air", "tanggal_id" >> %TMP%\wb_tables_to_migrate.txt
ECHO "rpsl"	"public"."tanggal_gabungan"	`rpsl`	`tanggal_gabungan`	"tanggal_id"	`tanggal_id`	"tanggal_id", "tanggal" >> %TMP%\wb_tables_to_migrate.txt
ECHO "rpsl"	"public"."users"	`rpsl`	`users`	"users_id"	`users_id`	"users_id", "username", "password", "role" >> %TMP%\wb_tables_to_migrate.txt


"%wbcopytables%" ^
 --odbc-source="DRIVER=PostgreSQL ANSI;SERVER=localhost;PORT=5432;DATABASE=rpsl;UID=rpsl;UseDeclareFetch=1" ^
 --source-rdbms-type=Postgresql ^
 --target="root@localhost:3306" ^
 --source-password="%arg_source_password%" ^
 --target-password="%arg_target_password%" ^
 --table-file="%table_file%" ^
 --target-ssh-port="22" ^
 --target-ssh-host="" ^
 --target-ssh-user="" ^
 --source-ssh-password="%arg_source_ssh_password%" ^
 --target-ssh-password="%arg_target_ssh_password%" --thread-count=%arg_worker_count% ^
 %arg_truncate_target% ^
 %arg_debug_output%

REM Removes the file with the table definitions
DEL %TMP%\wb_tables_to_migrate.txt


