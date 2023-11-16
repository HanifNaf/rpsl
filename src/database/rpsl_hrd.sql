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
-- Name: hrd; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.hrd (
    hrd_id uuid NOT NULL,
    tanggal date NOT NULL,
    nik character varying(100),
    nama character varying(100) NOT NULL,
    bagian character varying(100) NOT NULL,
    shift character varying(10) NOT NULL,
    waktu_pelanggaran time without time zone,
    tempat_pelanggaran character varying(100),
    bentuk_pelanggaran character varying(500) NOT NULL,
    potensi_bahaya character varying(200),
    sanksi character varying(100)
);


ALTER TABLE public.hrd OWNER TO rpsl;

--
-- Data for Name: hrd; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.hrd (hrd_id, tanggal, nik, nama, bagian, shift, waktu_pelanggaran, tempat_pelanggaran, bentuk_pelanggaran, potensi_bahaya, sanksi) FROM stdin;
48b56660-2163-4438-9261-9cc9b41bb166	2023-11-08	\N	Abdul Samad Amri	Helper Operator	D	\N	\N	Tidak Masuk Kerja tanpa keterangan dari tanggal 4 November hingga 8 November 2023	\N	Mengundurkan Diri
00e2f098-ec23-4c33-987f-ab7d45342125	2023-11-07	\N	Pathullah	Mekanik	A	15:10:00	Didepan Area Stockpile cangkang/fiber	Merokok	Kebakaran	Sp1
\.


--
-- Name: hrd hrd_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.hrd
    ADD CONSTRAINT hrd_pkey PRIMARY KEY (hrd_id);


--
-- PostgreSQL database dump complete
--

