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
-- Name: pgcrypto; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS pgcrypto WITH SCHEMA public;


--
-- Name: EXTENSION pgcrypto; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION pgcrypto IS 'cryptographic functions';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: bahan_bakar; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.bahan_bakar (
    bahan_bakar_id uuid NOT NULL,
    bahan_bakar character varying(50) NOT NULL,
    rp_per_kg real NOT NULL,
    kcal_effective real NOT NULL
);


ALTER TABLE public.bahan_bakar OWNER TO postgres;

--
-- Name: operasional; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.operasional (
    operasional_id uuid NOT NULL,
    produksi_id uuid NOT NULL,
    pemakaian_id uuid NOT NULL,
    pemakaian_bahan_bakar_id uuid NOT NULL,
    supervisor uuid NOT NULL,
    shift_id uuid NOT NULL,
    tanggal_waktu timestamp without time zone NOT NULL,
    keterangan character varying(300)
);


ALTER TABLE public.operasional OWNER TO postgres;

--
-- Name: pemakaian_bahan_bakar; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pemakaian_bahan_bakar (
    pemakaian_bahan_bakar_id uuid NOT NULL,
    bahan_bakar_id uuid NOT NULL,
    shift_id uuid NOT NULL,
    pemakaian_kg integer NOT NULL,
    tanggal_waktu timestamp without time zone NOT NULL
);


ALTER TABLE public.pemakaian_bahan_bakar OWNER TO postgres;

--
-- Name: pemakaian_kwh; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pemakaian_kwh (
    pemakaian_id uuid NOT NULL,
    shift_id uuid NOT NULL,
    ekspor integer NOT NULL,
    pemakaian_sendiri integer NOT NULL,
    kwh_loss integer,
    tanggal_waktu timestamp without time zone NOT NULL
);


ALTER TABLE public.pemakaian_kwh OWNER TO postgres;

--
-- Name: produksi_kwh; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.produksi_kwh (
    produksi_id uuid NOT NULL,
    shift_id uuid NOT NULL,
    generation integer NOT NULL,
    pm_kwh_pltbm integer NOT NULL,
    tanggal_waktu timestamp without time zone NOT NULL
);


ALTER TABLE public.produksi_kwh OWNER TO postgres;

--
-- Name: role; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.role (
    role_id uuid NOT NULL,
    role character varying(30) NOT NULL,
    keterangan_akses character varying(300) NOT NULL
);


ALTER TABLE public.role OWNER TO postgres;

--
-- Name: shift; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.shift (
    shift_id uuid NOT NULL,
    shift integer NOT NULL
);


ALTER TABLE public.shift OWNER TO postgres;

--
-- Name: supervisor; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.supervisor (
    supervisor_id uuid NOT NULL,
    role_id uuid NOT NULL,
    nama character varying(100) NOT NULL,
    nomor_karyawan integer NOT NULL,
    username character varying(20) NOT NULL,
    password character varying(20) NOT NULL
);


ALTER TABLE public.supervisor OWNER TO postgres;

--
-- Data for Name: bahan_bakar; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.bahan_bakar (bahan_bakar_id, bahan_bakar, rp_per_kg, kcal_effective) FROM stdin;
\.


--
-- Data for Name: operasional; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.operasional (operasional_id, produksi_id, pemakaian_id, pemakaian_bahan_bakar_id, supervisor, shift_id, tanggal_waktu, keterangan) FROM stdin;
\.


--
-- Data for Name: pemakaian_bahan_bakar; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pemakaian_bahan_bakar (pemakaian_bahan_bakar_id, bahan_bakar_id, shift_id, pemakaian_kg, tanggal_waktu) FROM stdin;
\.


--
-- Data for Name: pemakaian_kwh; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pemakaian_kwh (pemakaian_id, shift_id, ekspor, pemakaian_sendiri, kwh_loss, tanggal_waktu) FROM stdin;
\.


--
-- Data for Name: produksi_kwh; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.produksi_kwh (produksi_id, shift_id, generation, pm_kwh_pltbm, tanggal_waktu) FROM stdin;
\.


--
-- Data for Name: role; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.role (role_id, role, keterangan_akses) FROM stdin;
\.


--
-- Data for Name: shift; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.shift (shift_id, shift) FROM stdin;
\.


--
-- Data for Name: supervisor; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.supervisor (supervisor_id, role_id, nama, nomor_karyawan, username, password) FROM stdin;
\.


--
-- Name: bahan_bakar bahan_bakar_bahan_bakar_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bahan_bakar
    ADD CONSTRAINT bahan_bakar_bahan_bakar_key UNIQUE (bahan_bakar);


--
-- Name: bahan_bakar bahan_bakar_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bahan_bakar
    ADD CONSTRAINT bahan_bakar_pkey PRIMARY KEY (bahan_bakar_id);


--
-- Name: operasional operasional_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.operasional
    ADD CONSTRAINT operasional_pkey PRIMARY KEY (operasional_id);


--
-- Name: pemakaian_bahan_bakar pemakaian_bahan_bakar_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pemakaian_bahan_bakar
    ADD CONSTRAINT pemakaian_bahan_bakar_pkey PRIMARY KEY (pemakaian_bahan_bakar_id);


--
-- Name: pemakaian_kwh pemakaian_kwh_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pemakaian_kwh
    ADD CONSTRAINT pemakaian_kwh_pkey PRIMARY KEY (pemakaian_id);


--
-- Name: produksi_kwh produksi_kwh_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.produksi_kwh
    ADD CONSTRAINT produksi_kwh_pkey PRIMARY KEY (produksi_id);


--
-- Name: role role_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.role
    ADD CONSTRAINT role_pkey PRIMARY KEY (role_id);


--
-- Name: role role_role_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.role
    ADD CONSTRAINT role_role_key UNIQUE (role);


--
-- Name: shift shift_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.shift
    ADD CONSTRAINT shift_pkey PRIMARY KEY (shift_id);


--
-- Name: shift shift_shift_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.shift
    ADD CONSTRAINT shift_shift_key UNIQUE (shift);


--
-- Name: supervisor supervisor_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.supervisor
    ADD CONSTRAINT supervisor_pkey PRIMARY KEY (supervisor_id);


--
-- Name: supervisor supervisor_username_nomor_karyawan_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.supervisor
    ADD CONSTRAINT supervisor_username_nomor_karyawan_key UNIQUE (username, nomor_karyawan);


--
-- Name: pemakaian_bahan_bakar fk_bahan_bakar_pemakaian_bahan_bakar; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pemakaian_bahan_bakar
    ADD CONSTRAINT fk_bahan_bakar_pemakaian_bahan_bakar FOREIGN KEY (bahan_bakar_id) REFERENCES public.bahan_bakar(bahan_bakar_id);


--
-- Name: pemakaian_kwh fk_shift_pemakaian; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pemakaian_kwh
    ADD CONSTRAINT fk_shift_pemakaian FOREIGN KEY (shift_id) REFERENCES public.shift(shift_id);


--
-- Name: pemakaian_bahan_bakar fk_shift_pemakaian_bahan_bakar; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pemakaian_bahan_bakar
    ADD CONSTRAINT fk_shift_pemakaian_bahan_bakar FOREIGN KEY (shift_id) REFERENCES public.shift(shift_id);


--
-- Name: produksi_kwh fk_shift_produksi; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.produksi_kwh
    ADD CONSTRAINT fk_shift_produksi FOREIGN KEY (shift_id) REFERENCES public.shift(shift_id);


--
-- Name: operasional operasional_pemakaian_bahan_bakar_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.operasional
    ADD CONSTRAINT operasional_pemakaian_bahan_bakar_id_fkey FOREIGN KEY (pemakaian_bahan_bakar_id) REFERENCES public.pemakaian_bahan_bakar(pemakaian_bahan_bakar_id);


--
-- Name: operasional operasional_pemakaian_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.operasional
    ADD CONSTRAINT operasional_pemakaian_id_fkey FOREIGN KEY (pemakaian_id) REFERENCES public.pemakaian_kwh(pemakaian_id);


--
-- Name: operasional operasional_produksi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.operasional
    ADD CONSTRAINT operasional_produksi_id_fkey FOREIGN KEY (produksi_id) REFERENCES public.produksi_kwh(produksi_id);


--
-- Name: operasional operasional_shift_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.operasional
    ADD CONSTRAINT operasional_shift_id_fkey FOREIGN KEY (shift_id) REFERENCES public.shift(shift_id);


--
-- Name: operasional operasional_supervisor_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.operasional
    ADD CONSTRAINT operasional_supervisor_fkey FOREIGN KEY (supervisor) REFERENCES public.supervisor(supervisor_id);


--
-- PostgreSQL database dump complete
--

