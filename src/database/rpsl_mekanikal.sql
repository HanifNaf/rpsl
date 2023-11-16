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
-- Name: mekanikal; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.mekanikal (
    mekanikal_id uuid NOT NULL,
    tanggal date NOT NULL,
    permasalahan character varying(200) NOT NULL,
    tindak_lanjut character varying(500) NOT NULL,
    sparepart character varying(200),
    jumlah_sparepart integer,
    satuan_sparepart character varying(50),
    keterangan character varying(500),
    nama_absensi character varying(100),
    keterangan_absensi character varying(500),
    catatan character varying(500)
);


ALTER TABLE public.mekanikal OWNER TO rpsl;

--
-- Data for Name: mekanikal; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.mekanikal (mekanikal_id, tanggal, permasalahan, tindak_lanjut, sparepart, jumlah_sparepart, satuan_sparepart, keterangan, nama_absensi, keterangan_absensi, catatan) FROM stdin;
014292b6-4e4d-48b3-906b-057a3deb8597	2023-05-04	masalah a	tindak lanjut a	sparepart a	3	pcs	ketarangan a	AA	Sakit	catatan a
a59c15f0-67ac-41a4-aded-8ec2051543dd	2023-11-15	masalah a	a	a	3	pcs	keterangan a	AA	Sakit	catatan a
18a477c5-2ba2-460d-a74c-aa4aa68ab0b5	2023-11-01	Chipper	mengasah mata pisau chipper	\N	18	pcs	Selesai	Wawan	Sakit	\N
\.


--
-- Name: mekanikal mekanik_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.mekanikal
    ADD CONSTRAINT mekanik_pkey PRIMARY KEY (mekanikal_id);


--
-- PostgreSQL database dump complete
--

