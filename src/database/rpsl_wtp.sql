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
-- Data for Name: wtp; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.wtp (wtp_id, permasalahan, tindak_lanjut, sparepart, jumlah_sparepart, satuan_sparepart, nama_absensi, keterangan_absensi, keterangan, catatan, tanggal) FROM stdin;
2264dae2-d60d-4b99-b620-2e5e5d963d4a	Monitoring Area Kerja WTP	Inspeksi Wilayah Kerja	 	\N	 	 	 	 	 Rutinitas	2023-08-01
39d0d1b7-1f3b-45b3-8b2c-5cc2ad9e1464	Input Data Laporan Bulanan	Pengiriman Laporan Bulan Juli 2023	 	\N	 	 	 		100%	2023-08-01
38459364-56fa-4608-9674-ae1f58d09e81	Analisa moisture bahan bakar	Analisa moisture	 	\N	 	 	 	\N	Setiap hari	2023-08-01
ba5a2847-eeca-4d97-bad7-527aca9e738a	Area WTP Tampak Kotor	Pembersihan Area WTP	 	\N	 	 	 	\N	Rutinitas	2023-08-01
\.


--
-- Name: wtp wtp_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.wtp
    ADD CONSTRAINT wtp_pkey PRIMARY KEY (wtp_id);


--
-- PostgreSQL database dump complete
--

