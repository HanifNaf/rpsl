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
    keterangan character varying(300),
    tanggal date NOT NULL,
    waktu time without time zone DEFAULT LOCALTIME NOT NULL,
    shift integer NOT NULL,
    supervisor character varying(100)
);


ALTER TABLE public.operasional OWNER TO postgres;

--
-- Name: pemakaian_bahan_bakar; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pemakaian_bahan_bakar (
    pemakaian_bahan_bakar_id uuid NOT NULL,
    tanggal date NOT NULL,
    waktu time without time zone DEFAULT LOCALTIME NOT NULL,
    rpkg_cangkang integer DEFAULT 876,
    kcal_cangkang integer DEFAULT 2177,
    rpkg_palmfiber integer DEFAULT 266,
    kcal_palmfiber integer DEFAULT 2040,
    rpkg_woodchips integer DEFAULT 313,
    kcal_woodchips integer DEFAULT 2084,
    rpkg_serbukkayu integer DEFAULT 200,
    kcal_serbukkayu integer DEFAULT 1789,
    rpkg_sabutkelapa integer DEFAULT 200,
    kcal_sabutkelapa integer DEFAULT 1615,
    rpkg_efbpress integer DEFAULT 210,
    kcal_efbpress integer DEFAULT 1906,
    rpkg_opt integer DEFAULT 200,
    kcal_opt integer DEFAULT 1630,
    shift integer NOT NULL,
    kg_cangkang integer DEFAULT 0,
    kg_palmfiber integer DEFAULT 0,
    kg_woodchips integer DEFAULT 0,
    kg_serbukkayu integer DEFAULT 0,
    kg_sabutkelapa integer DEFAULT 0,
    kg_efbpress integer DEFAULT 0,
    kg_opt integer DEFAULT 0
);


ALTER TABLE public.pemakaian_bahan_bakar OWNER TO postgres;

--
-- Name: pemakaian_kwh; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pemakaian_kwh (
    pemakaian_id uuid NOT NULL,
    ekspor integer NOT NULL,
    pemakaian_sendiri integer NOT NULL,
    kwh_loss integer,
    tanggal date NOT NULL,
    waktu time without time zone DEFAULT LOCALTIME NOT NULL,
    shift integer NOT NULL
);


ALTER TABLE public.pemakaian_kwh OWNER TO postgres;

--
-- Name: produksi_kwh; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.produksi_kwh (
    produksi_id uuid NOT NULL,
    generation integer NOT NULL,
    pm_kwh_pltbm integer NOT NULL,
    tanggal date NOT NULL,
    waktu time without time zone DEFAULT LOCALTIME NOT NULL,
    shift integer NOT NULL
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
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    users_id uuid NOT NULL,
    role_id uuid NOT NULL,
    nama character varying(100) NOT NULL,
    nomor_karyawan integer NOT NULL,
    username character varying(20) NOT NULL,
    password character varying(20) NOT NULL
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Data for Name: bahan_bakar; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.bahan_bakar (bahan_bakar_id, bahan_bakar, rp_per_kg, kcal_effective) FROM stdin;
6fb92473-d918-4491-bc72-a6dfc8e45778	Palm Fiber	266	2040
fc842001-5b47-46b7-9855-10d07df78317	Wood Chips	313	2084
9072d39a-20c8-4993-9f29-840c53274e4c	Serbuk Kayu	200	1789
b4be32ad-4a92-4165-ba60-ce73a9dbb5a0	Sabut Kelapa	200	1615
bd3ef050-e081-4a4d-b897-7595e8014897	EFB Press	210	1906
544353ed-7d7a-4a30-a54d-313e4f1dd143	OPT	200	1630
7fe1e197-533f-4e41-8ded-e51ff7084596	Cangkang	876	2177
\.


--
-- Data for Name: operasional; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.operasional (operasional_id, produksi_id, pemakaian_id, pemakaian_bahan_bakar_id, keterangan, tanggal, waktu, shift, supervisor) FROM stdin;
447f0b87-b984-4310-82cf-f555154253e7	d7225f4c-79ee-4a50-a442-2c2948301b12	fefc0e49-9cd3-4389-aac9-8eaee4fdad6c	ec4eab11-bbea-45db-bbae-85412f0312fe	Tidak ada keterangan	2023-05-01	11:31:10.455154	1	admin1
6c5d26c3-3625-438b-83e3-d37e4b09ec7d	60b47843-e7a1-4245-b585-fa46d1a2215f	f05e39ff-16a0-4249-af62-397040f396de	bc1b2e80-eb1c-4c8a-8546-e42552cc060c	Tidak ada keterangan	2023-05-01	14:05:37.77547	2	admin1
d4a01a77-23f8-4fe2-967c-16cab31c9c81	aae61c97-f6d3-44df-9eae-a2e0f3f39187	c92a6cf9-ea3a-4daf-96ef-8676789bb518	416556b2-3647-47af-b4b0-beadca6f5851	\N	2023-05-01	11:23:16.537236	3	admin1
\.


--
-- Data for Name: pemakaian_bahan_bakar; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pemakaian_bahan_bakar (pemakaian_bahan_bakar_id, tanggal, waktu, rpkg_cangkang, kcal_cangkang, rpkg_palmfiber, kcal_palmfiber, rpkg_woodchips, kcal_woodchips, rpkg_serbukkayu, kcal_serbukkayu, rpkg_sabutkelapa, kcal_sabutkelapa, rpkg_efbpress, kcal_efbpress, rpkg_opt, kcal_opt, shift, kg_cangkang, kg_palmfiber, kg_woodchips, kg_serbukkayu, kg_sabutkelapa, kg_efbpress, kg_opt) FROM stdin;
ec4eab11-bbea-45db-bbae-85412f0312fe	2023-05-01	16:17:46.506069	876	2177	266	2040	313	2084	200	1789	200	1615	210	1906	200	1630	1	\N	\N	147459	8745	\N	11000	\N
bc1b2e80-eb1c-4c8a-8546-e42552cc060c	2023-05-01	13:19:26.566841	876	2177	266	2040	313	2084	200	1789	200	1615	210	1906	200	1630	2	\N	\N	118209	6996	\N	17580	\N
c9f689ad-9d9a-474b-b31d-d744aeb9765d	2023-05-01	11:28:03.514207	876	2177	266	2040	313	2084	200	1789	200	1615	210	1906	200	1630	3	0	0	120081	15741	0	11000	0
416556b2-3647-47af-b4b0-beadca6f5851	2023-05-01	11:23:16.537236	876	2177	266	2040	313	2084	200	1789	200	1615	210	1906	200	1630	3	0	0	120081	15741	0	11000	0
\.


--
-- Data for Name: pemakaian_kwh; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pemakaian_kwh (pemakaian_id, ekspor, pemakaian_sendiri, kwh_loss, tanggal, waktu, shift) FROM stdin;
fefc0e49-9cd3-4389-aac9-8eaee4fdad6c	93408	8278	883	2023-05-01	15:49:20.653401	1
f05e39ff-16a0-4249-af62-397040f396de	78112	7490	687	2023-05-01	14:01:56.020441	2
c92a6cf9-ea3a-4daf-96ef-8676789bb518	79840	7395	706	2023-05-01	11:23:16.537236	3
\.


--
-- Data for Name: produksi_kwh; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.produksi_kwh (produksi_id, generation, pm_kwh_pltbm, tanggal, waktu, shift) FROM stdin;
d7225f4c-79ee-4a50-a442-2c2948301b12	102569	238880	2023-05-01	15:29:24.648226	1
60b47843-e7a1-4245-b585-fa46d1a2215f	86289	238880	2023-05-01	12:55:16.84071	2
aae61c97-f6d3-44df-9eae-a2e0f3f39187	87941	238880	2023-05-01	11:23:16.537236	3
\.


--
-- Data for Name: role; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.role (role_id, role, keterangan_akses) FROM stdin;
10bb8e91-9a07-4f53-abf6-1d3b2322d688	admin	Akses penuh untuk melakukan Create, Read, Update, Delete
d5585617-2c57-46b9-852d-c5af4ce5c152	head	Akses Read saja terhadap data seluruh divisi
2e840351-d4c0-47e9-8f32-086feca52aa3	supervisor	Akses untuk melakukan Create, Read, Update hanya pada divisinya
e4847848-1a8a-48aa-a22e-e73d43d5447f	operator	Akses untuk melakukan Create dan Read hanya pada divisinya
\.


--
-- Data for Name: shift; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.shift (shift_id, shift) FROM stdin;
0de48f1f-9c0c-43a7-ad66-8f327e991a77	1
ea72e679-8428-4c6a-bf8d-7dca7403bdae	2
6cd3f344-fb39-40c8-845e-e4bfd5ef1863	3
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (users_id, role_id, nama, nomor_karyawan, username, password) FROM stdin;
5e92446b-60d1-4f61-b084-61008547d132	10bb8e91-9a07-4f53-abf6-1d3b2322d688	admin1	0	admin	admin
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
-- Name: users users_nomor_karyawan_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_nomor_karyawan_key UNIQUE (nomor_karyawan);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (users_id);


--
-- Name: users users_username_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_username_key UNIQUE (username);


--
-- Name: operasional operasional_pemakaian_bahan_bakar_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.operasional
    ADD CONSTRAINT operasional_pemakaian_bahan_bakar_fkey FOREIGN KEY (pemakaian_bahan_bakar_id) REFERENCES public.pemakaian_bahan_bakar(pemakaian_bahan_bakar_id) ON DELETE CASCADE;


--
-- Name: operasional operasional_pemakaian_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.operasional
    ADD CONSTRAINT operasional_pemakaian_id_fkey FOREIGN KEY (pemakaian_id) REFERENCES public.pemakaian_kwh(pemakaian_id) ON DELETE CASCADE;


--
-- Name: operasional operasional_produksi_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.operasional
    ADD CONSTRAINT operasional_produksi_id_fkey FOREIGN KEY (produksi_id) REFERENCES public.produksi_kwh(produksi_id) ON DELETE CASCADE;


--
-- Name: users users_role_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_role_id_fkey FOREIGN KEY (role_id) REFERENCES public.role(role_id);


--
-- PostgreSQL database dump complete
--

