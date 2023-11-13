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
-- Name: elektrikal; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.elektrikal (
    elektrikal_id uuid NOT NULL,
    area_kerja character varying(200) NOT NULL,
    permasalahan character varying(500) NOT NULL,
    personil character varying(100) NOT NULL,
    alat character varying(100) NOT NULL,
    status character varying(50) NOT NULL,
    tanggal date NOT NULL,
    jam_mulai time without time zone NOT NULL,
    jam_selesai time without time zone NOT NULL,
    keterangan character varying(500) NOT NULL,
    pekerjaan character varying(500) NOT NULL
);


ALTER TABLE public.elektrikal OWNER TO postgres;

--
-- Data for Name: elektrikal; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.elektrikal (elektrikal_id, area_kerja, permasalahan, personil, alat, status, tanggal, jam_mulai, jam_selesai, keterangan, pekerjaan) FROM stdin;
b69e8127-02fb-470a-9e93-277e41e8fc3e	area a	masalah a	personil a	alat a	status a	2023-05-11	01:00:00	02:00:00	keterangan a	pekerjaan a
05665281-5230-4770-b928-3b623a008550	area b	masalah b	personil b	alat b	OK	2023-11-12	09:16:00	13:17:00	keterangan b	pekerjaan b
\.


--
-- Name: elektrikal elektrikal_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.elektrikal
    ADD CONSTRAINT elektrikal_pkey PRIMARY KEY (elektrikal_id);


--
-- PostgreSQL database dump complete
--

