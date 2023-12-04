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
-- Name: chemical_boiler; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.chemical_boiler (
    boiler_id uuid NOT NULL,
    tanggal date NOT NULL,
    alkalinity_booster real,
    oxygen_scavenger real,
    internal_treatment real,
    condensate_treatment real,
    m3_air integer,
    cost_alkalinity_booster integer DEFAULT 24000,
    cost_oxygen_scavenger integer DEFAULT 34500,
    cost_internal_treatment integer DEFAULT 74500,
    cost_condensate_treatment integer DEFAULT 51000,
    solid_additive real,
    cost_solid_additive integer DEFAULT 35500
);


ALTER TABLE public.chemical_boiler OWNER TO rpsl;

--
-- Name: cooling_tower; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.cooling_tower (
    cooling_tower_id uuid NOT NULL,
    tanggal date NOT NULL,
    corrotion_inhibitor real,
    cooling_water_dispersant real,
    oxy_hg real,
    sulfuric_acid real,
    cost_corrotion_inhibitor real DEFAULT 37000,
    cost_cooling_water_dispersant real DEFAULT 49500,
    cost_oxy_hg real DEFAULT 44000,
    cost_sulfuric_acid real DEFAULT 3135
);


ALTER TABLE public.cooling_tower OWNER TO rpsl;

--
-- Name: ro; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.ro (
    ro_id uuid NOT NULL,
    tanggal date NOT NULL,
    anti_scalant real,
    cost_anti_scalant real DEFAULT 52500,
    alkalinity_booster real,
    cost_alkalinity_booster real DEFAULT 24500,
    asam_s4241 real,
    cost_asam_s4241 real DEFAULT 37500,
    asam_hcl real,
    cost_asam_hcl real DEFAULT 6000,
    basa_s4243 real,
    cost_basa_s4243 real DEFAULT 92500,
    basa_caustik real,
    cost_basa_caustik real DEFAULT 18000,
    cartridge_40 real,
    cost_cartridge_40 real DEFAULT 200000,
    cartridge_30 real,
    cost_cartridge_30 real DEFAULT 180000,
    m3_air real
);


ALTER TABLE public.ro OWNER TO rpsl;

--
-- Name: sungai; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.sungai (
    sungai_id uuid NOT NULL,
    tanggal date NOT NULL,
    koagulan real,
    soda_ash real,
    flokulan real,
    cost_koagulan real DEFAULT 10800,
    cost_soda_ash real DEFAULT 10400,
    cost_flokulan real DEFAULT 58000,
    m3_air real
);


ALTER TABLE public.sungai OWNER TO rpsl;

--
-- Name: wtp; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.wtp (
    wtp_id uuid NOT NULL,
    permasalahan character varying(200) NOT NULL,
    tindak_lanjut character varying(200) NOT NULL,
    sparepart character varying(200),
    jumlah_sparepart integer,
    satuan_sparepart character varying(50),
    nama_absensi character varying(100),
    keterangan_absensi character varying(500),
    keterangan character varying(500),
    catatan character varying(500),
    tanggal date NOT NULL
);


ALTER TABLE public.wtp OWNER TO rpsl;

--
-- Data for Name: chemical_boiler; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.chemical_boiler (boiler_id, tanggal, alkalinity_booster, oxygen_scavenger, internal_treatment, condensate_treatment, m3_air, cost_alkalinity_booster, cost_oxygen_scavenger, cost_internal_treatment, cost_condensate_treatment, solid_additive, cost_solid_additive) FROM stdin;
f8852ee3-4309-4fad-9413-97bf886d478b	2023-08-01	0.5	1	0.4	1.5	12520	24000	34500	74500	51000	5	35500
2fe9a93a-7519-45ed-b0fe-7b672db6cff3	2023-08-05	9	4	6	4	19589	24000	34500	74500	51000	4	35500
\.


--
-- Data for Name: cooling_tower; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.cooling_tower (cooling_tower_id, tanggal, corrotion_inhibitor, cooling_water_dispersant, oxy_hg, sulfuric_acid, cost_corrotion_inhibitor, cost_cooling_water_dispersant, cost_oxy_hg, cost_sulfuric_acid) FROM stdin;
0af2f3cf-6d9f-4484-b7b4-3a3b8d69e07e	2023-08-01	5	5	5	\N	37000	49500	44000	3135
\.


--
-- Data for Name: ro; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.ro (ro_id, tanggal, anti_scalant, cost_anti_scalant, alkalinity_booster, cost_alkalinity_booster, asam_s4241, cost_asam_s4241, asam_hcl, cost_asam_hcl, basa_s4243, cost_basa_s4243, basa_caustik, cost_basa_caustik, cartridge_40, cost_cartridge_40, cartridge_30, cost_cartridge_30, m3_air) FROM stdin;
91db2f93-77ea-4954-887e-d16897b29536	2023-08-08	\N	52500	37	24500	\N	37500	\N	6000	\N	92500	\N	18000	\N	200000	\N	180000	170904
\.


--
-- Data for Name: sungai; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.sungai (sungai_id, tanggal, koagulan, soda_ash, flokulan, cost_koagulan, cost_soda_ash, cost_flokulan, m3_air) FROM stdin;
6a724707-a229-4f06-ae29-bdeb41b42c45	2023-08-05	50	25	1.5	10800	10400	58000	52057.05
5c0213e2-915f-4e69-bd28-9d57e2cc33e0	2023-08-01	50	25	0.9	10800	10400	58000	43835.53
3a448594-4a1c-4a1c-bd8f-7e50e879ae29	2023-08-02	50	\N	0.9	10800	10400	58000	47023.61
\.


--
-- Data for Name: wtp; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.wtp (wtp_id, permasalahan, tindak_lanjut, sparepart, jumlah_sparepart, satuan_sparepart, nama_absensi, keterangan_absensi, keterangan, catatan, tanggal) FROM stdin;
2264dae2-d60d-4b99-b620-2e5e5d963d4a	Monitoring Area Kerja WTP	Inspeksi Wilayah Kerja	 	\N	 	 	 	 	 Rutinitas	2023-08-01
39d0d1b7-1f3b-45b3-8b2c-5cc2ad9e1464	Input Data Laporan Bulanan	Pengiriman Laporan Bulan Juli 2023	 	\N	 	 	 		100%	2023-08-01
38459364-56fa-4608-9674-ae1f58d09e81	Analisa moisture bahan bakar	Analisa moisture	 	\N	 	 	 	\N	Setiap hari	2023-08-01
ba5a2847-eeca-4d97-bad7-527aca9e738a	Area WTP Tampak Kotor	Pembersihan Area WTP	 	\N	 	 	 	\N	Rutinitas	2023-08-01
\.


--
-- Name: chemical_boiler chemical_boiler_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.chemical_boiler
    ADD CONSTRAINT chemical_boiler_pkey PRIMARY KEY (boiler_id);


--
-- Name: cooling_tower cooling_tower_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.cooling_tower
    ADD CONSTRAINT cooling_tower_pkey PRIMARY KEY (cooling_tower_id);


--
-- Name: ro ro_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.ro
    ADD CONSTRAINT ro_pkey PRIMARY KEY (ro_id);


--
-- Name: sungai sungai_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.sungai
    ADD CONSTRAINT sungai_pkey PRIMARY KEY (sungai_id);


--
-- Name: wtp wtp_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.wtp
    ADD CONSTRAINT wtp_pkey PRIMARY KEY (wtp_id);


--
-- PostgreSQL database dump complete
--

