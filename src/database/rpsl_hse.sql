--
-- PostgreSQL database dump
--

-- Dumped from database version 15.4
-- Dumped by pg_dump version 15.4

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: uuid-ossp; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS "uuid-ossp" WITH SCHEMA public;


--
-- Name: EXTENSION "uuid-ossp"; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION "uuid-ossp" IS 'generate universally unique identifiers (UUIDs)';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: kecelakaan_kerja; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.kecelakaan_kerja (
    kecelakaan_kerja_id uuid NOT NULL,
    tanggal date NOT NULL,
    jenis_kecelakaan_kerja character varying(50) NOT NULL,
    waktu_kejadian time without time zone NOT NULL,
    area_kejadian character varying(100) NOT NULL,
    jam_kerja_kejadian character varying(50) NOT NULL,
    keterangan character varying(500) NOT NULL
);


ALTER TABLE public.kecelakaan_kerja OWNER TO rpsl;

--
-- Name: pelanggaran; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.pelanggaran (
    pelanggaran_id uuid NOT NULL,
    nama character varying(100) NOT NULL,
    nik integer NOT NULL,
    bagian character varying(100) NOT NULL,
    jenis_pelanggaran character varying(100) NOT NULL,
    keterangan character varying(500) NOT NULL,
    pemberian_apd character varying(200),
    jumlah_apd integer,
    tanggal date NOT NULL
);


ALTER TABLE public.pelanggaran OWNER TO rpsl;

--
-- Name: pengawasan; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.pengawasan (
    pengawasan_id uuid NOT NULL,
    tanggal date NOT NULL,
    jam_kerja character varying(50) NOT NULL,
    pengawasan_timbangan character varying(50) NOT NULL,
    keterangan_pengawasan_timbangan character varying(500) NOT NULL,
    kondisi_5r_timbangan character varying(50) NOT NULL,
    keterangan_5r_timbangan character varying(500) NOT NULL,
    pengawasan_chipper character varying(50) NOT NULL,
    keterangan_pengawasan_chipper character varying(500) NOT NULL,
    kondisi_5r_chipper character varying(50) NOT NULL,
    keterangan_5r_chipper character varying(500) NOT NULL,
    pengawasan_boiler character varying(50) NOT NULL,
    keterangan_pengawasan_boiler character varying(500) NOT NULL,
    kondisi_5r_boiler character varying(50) NOT NULL,
    keterangan_5r_boiler character varying(50) NOT NULL,
    pengawasan_wtp character varying(50) NOT NULL,
    keterangan_pengawasan_wtp character varying(500) NOT NULL,
    kondisi_5r_wtp character varying(50) NOT NULL,
    keterangan_5r_wtp character varying(500) NOT NULL,
    pengawasan_turbin character varying(50) NOT NULL,
    keterangan_pengawasan_turbin character varying(500) NOT NULL,
    kondisi_5r_turbin character varying(50) NOT NULL,
    keterangan_5r_turbin character varying(50) NOT NULL,
    pengawasan_mekanik character varying(50) NOT NULL,
    keterangan_pengawasan_mekanik character varying(500) NOT NULL,
    kondisi_5r_mekanik character varying(50) NOT NULL,
    keterangan_5r_mekanik character varying(500) NOT NULL,
    pengawasan_listrik character varying(50) NOT NULL,
    keterangan_pengawasan_listrik character varying(500) NOT NULL,
    kondisi_5r_listrik character varying(50) NOT NULL,
    keterangan_5r_listrik character varying(500) NOT NULL,
    pengawasan_bahan_bakar character varying(50) NOT NULL,
    keterangan_pengawasan_bahan_bakar character varying(500) NOT NULL,
    kondisi_5r_bahan_bakar character varying(50) NOT NULL,
    keterangan_5r_bahan_bakar character varying(500) NOT NULL,
    personil_hse character varying(100) NOT NULL
);


ALTER TABLE public.pengawasan OWNER TO rpsl;

--
-- Name: potensi_bahaya; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.potensi_bahaya (
    potensi_bahaya_id uuid NOT NULL,
    potensi_bahaya_timbangan character varying(50) NOT NULL,
    jenis_potensi_timbangan character varying(200) NOT NULL,
    tindak_lanjut_timbangan character varying(200) NOT NULL,
    keterangan_timbangan character varying(500) NOT NULL,
    kendala_timbangan character varying(200) NOT NULL,
    potensi_bahaya_chipper character varying(50) NOT NULL,
    jenis_potensi_chipper character varying(200) NOT NULL,
    tindak_lanjut_chipper character varying(200) NOT NULL,
    keterangan_chipper character varying(500) NOT NULL,
    kendala_chipper character varying(200) NOT NULL,
    potensi_bahaya_boiler character varying(50) NOT NULL,
    jenis_potensi_boiler character varying(200) NOT NULL,
    tindak_lanjut_boiler character varying(200) NOT NULL,
    keterangan_boiler character varying(500) NOT NULL,
    kendala_boiler character varying(200) NOT NULL,
    potensi_bahaya_wtp character varying(50) NOT NULL,
    jenis_potensi_wtp character varying(200) NOT NULL,
    tindak_lanjut_wtp character varying(200) NOT NULL,
    keterangan_wtp character varying(500) NOT NULL,
    kendala_wtp character varying(200) NOT NULL,
    potensi_bahaya_turbin character varying(50) NOT NULL,
    jenis_potensi_turbin character varying(200) NOT NULL,
    tindak_lanjut_turbin character varying(200) NOT NULL,
    keterangan_turbin character varying(500) NOT NULL,
    kendala_turbin character varying(200) NOT NULL,
    potensi_bahaya_mekanik character varying(50) NOT NULL,
    jenis_potensi_mekanik character varying(200) NOT NULL,
    tindak_lanjut_mekanik character varying(200) NOT NULL,
    keterangan_mekanik character varying(500) NOT NULL,
    kendala_mekanik character varying(200) NOT NULL,
    potensi_bahaya_listrik character varying(50) NOT NULL,
    jenis_potensi_listrik character varying(200) NOT NULL,
    tindak_lanjut_listrik character varying(200) NOT NULL,
    keterangan_listrik character varying(500) NOT NULL,
    kendala_listrik character varying(200) NOT NULL,
    potensi_bahaya_jalan character varying(50) NOT NULL,
    jenis_potensi_jalan character varying(200) NOT NULL,
    tindak_lanjut_jalan character varying(200) NOT NULL,
    keterangan_jalan character varying(500) NOT NULL,
    kendala_jalan character varying(200) NOT NULL,
    potensi_bahaya_bahan_bakar character varying(200) NOT NULL,
    jenis_potensi_bahan_bakar character varying(200) NOT NULL,
    tindak_lanjut_bahan_bakar character varying(200) NOT NULL,
    keterangan_bahan_bakar character varying(500) NOT NULL,
    kendala_bahan_bakar character varying(200) NOT NULL,
    personil_hse character varying(100) NOT NULL,
    jam_kerja time without time zone NOT NULL
);


ALTER TABLE public.potensi_bahaya OWNER TO rpsl;

--
-- Data for Name: kecelakaan_kerja; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.kecelakaan_kerja (kecelakaan_kerja_id, tanggal, jenis_kecelakaan_kerja, waktu_kejadian, area_kejadian, jam_kerja_kejadian, keterangan) FROM stdin;
32ee2c77-1cdd-49b7-9e32-81300dde3461	2023-01-05	sedang	15:21:00	chipper	sore	keterangan 1
39ac99d7-0eb9-43a4-96e4-e993969737f0	2023-10-11	ringan	10:16:00	wtp	pagi	keterangan 2
\.


--
-- Data for Name: pelanggaran; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.pelanggaran (pelanggaran_id, nama, nik, bagian, jenis_pelanggaran, keterangan, pemberian_apd, jumlah_apd, tanggal) FROM stdin;
\.


--
-- Data for Name: pengawasan; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.pengawasan (pengawasan_id, tanggal, jam_kerja, pengawasan_timbangan, keterangan_pengawasan_timbangan, kondisi_5r_timbangan, keterangan_5r_timbangan, pengawasan_chipper, keterangan_pengawasan_chipper, kondisi_5r_chipper, keterangan_5r_chipper, pengawasan_boiler, keterangan_pengawasan_boiler, kondisi_5r_boiler, keterangan_5r_boiler, pengawasan_wtp, keterangan_pengawasan_wtp, kondisi_5r_wtp, keterangan_5r_wtp, pengawasan_turbin, keterangan_pengawasan_turbin, kondisi_5r_turbin, keterangan_5r_turbin, pengawasan_mekanik, keterangan_pengawasan_mekanik, kondisi_5r_mekanik, keterangan_5r_mekanik, pengawasan_listrik, keterangan_pengawasan_listrik, kondisi_5r_listrik, keterangan_5r_listrik, pengawasan_bahan_bakar, keterangan_pengawasan_bahan_bakar, kondisi_5r_bahan_bakar, keterangan_5r_bahan_bakar, personil_hse) FROM stdin;
\.


--
-- Data for Name: potensi_bahaya; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.potensi_bahaya (potensi_bahaya_id, potensi_bahaya_timbangan, jenis_potensi_timbangan, tindak_lanjut_timbangan, keterangan_timbangan, kendala_timbangan, potensi_bahaya_chipper, jenis_potensi_chipper, tindak_lanjut_chipper, keterangan_chipper, kendala_chipper, potensi_bahaya_boiler, jenis_potensi_boiler, tindak_lanjut_boiler, keterangan_boiler, kendala_boiler, potensi_bahaya_wtp, jenis_potensi_wtp, tindak_lanjut_wtp, keterangan_wtp, kendala_wtp, potensi_bahaya_turbin, jenis_potensi_turbin, tindak_lanjut_turbin, keterangan_turbin, kendala_turbin, potensi_bahaya_mekanik, jenis_potensi_mekanik, tindak_lanjut_mekanik, keterangan_mekanik, kendala_mekanik, potensi_bahaya_listrik, jenis_potensi_listrik, tindak_lanjut_listrik, keterangan_listrik, kendala_listrik, potensi_bahaya_jalan, jenis_potensi_jalan, tindak_lanjut_jalan, keterangan_jalan, kendala_jalan, potensi_bahaya_bahan_bakar, jenis_potensi_bahan_bakar, tindak_lanjut_bahan_bakar, keterangan_bahan_bakar, kendala_bahan_bakar, personil_hse, jam_kerja) FROM stdin;
\.


--
-- Name: kecelakaan_kerja kecelakaan_kerja_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.kecelakaan_kerja
    ADD CONSTRAINT kecelakaan_kerja_pkey PRIMARY KEY (kecelakaan_kerja_id);


--
-- Name: pelanggaran pelanggaran_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.pelanggaran
    ADD CONSTRAINT pelanggaran_pkey PRIMARY KEY (pelanggaran_id);


--
-- Name: pengawasan pengawasan_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.pengawasan
    ADD CONSTRAINT pengawasan_pkey PRIMARY KEY (pengawasan_id);


--
-- Name: potensi_bahaya potensi_bahaya_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.potensi_bahaya
    ADD CONSTRAINT potensi_bahaya_pkey PRIMARY KEY (potensi_bahaya_id);


--
-- PostgreSQL database dump complete
--
