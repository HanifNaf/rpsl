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
-- Name: maintenance; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.maintenance (
    maintenance_id uuid NOT NULL,
    divisi character varying(50) NOT NULL,
    unit character varying(100) NOT NULL,
    problem character varying(500),
    evaluasi character varying(500),
    penanganan character varying(500) DEFAULT 'Penanganan Belum Ditentukan'::character varying,
    tanggal_mulai date NOT NULL,
    tanggal_selesai date,
    status character varying(50) NOT NULL,
    jam time without time zone NOT NULL,
    tingkat_kerusakan character varying(20) NOT NULL
);


ALTER TABLE public.maintenance OWNER TO rpsl;

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
-- Data for Name: maintenance; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.maintenance (maintenance_id, divisi, unit, problem, evaluasi, penanganan, tanggal_mulai, tanggal_selesai, status, jam, tingkat_kerusakan) FROM stdin;
d24cc57e-42ac-4e58-932e-716c3c64fe87	umum	unit umum	problem umum	umum juga	masih umum	2023-11-09	2023-11-10	selesai	05:45:05.412888	minor
9a2f7e5e-2420-4f14-9881-e5c75db7cdeb	Elektrikal	Unit elektrik	nggak umum	masih nggak umum	tetep nggak umum	2023-11-08	2023-11-10	Selesai	05:48:54.298805	Major
26a02a86-3e88-462f-88c4-3ded55141e82	WTP	Unit Umum	yang umum	wtp		2023-11-10	2023-11-10	Sedang Berlangsung	06:05:49.454044	Minor
a68571b6-fa3c-4d44-b0e4-6b56f93cc386	umum	unit umum	problem umum	umum juga	masih umum	2023-11-09	\N	selesai	06:08:21.61457	minor
33d8b4f5-bdc3-4505-baa8-c20e9b740854	Elektrikal	Unit elektrik	yang umum	masih umum	umum juga	2023-11-10	2023-11-10	Selesai	06:39:20.483007	Minor
7cf070fe-0ad7-4051-9654-b50ac7ae7026	Umum	Unit Umum	nggak umum	wtp	umum juga	2023-11-10	2023-11-10	Dijadwalkan	06:37:06.015144	Major
ec8fe306-ab26-4a6e-be21-1503abde7357	Umum	Unit elektrik	yang umum			2023-11-10	2023-11-10	Dijadwalkan	06:37:51.840488	Minor
058e14cc-a1a6-45a5-8e0e-4f103155a7ba	Elektrikal	Elektrikal unit a	problem 1	evaluasi 1	penanganan 1	2023-11-10	2023-11-10	Sedang Berlangsung	11:02:12.732232	Minor
\.


--
-- Data for Name: operasional; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.operasional (operasional_id, produksi_id, pemakaian_id, pemakaian_bahan_bakar_id, keterangan, tanggal, waktu, shift, supervisor) FROM stdin;
0364f80d-c40a-47e1-8170-c998fe0defa5	f08fdc40-1f55-46ff-8ee8-96162b8f0858	3b8e2ac0-1f43-4ef8-bb0d-815443c2ba82	cdb9697c-73f0-4d97-ab90-230e4959dd77	08:00-08:20 Penggantian kontaktor feed roller atas chipper 2	2023-05-02	10:41:48.856602	1	admin1
447f0b87-b984-4310-82cf-f555154253e7	d7225f4c-79ee-4a50-a442-2c2948301b12	fefc0e49-9cd3-4389-aac9-8eaee4fdad6c	ec4eab11-bbea-45db-bbae-85412f0312fe	10:15 - 11 :00 Perbaikan karet coupling pompa ejektor no 1	2023-05-01	11:31:10.455154	1	admin1
2c5fa666-aacc-47a6-aeb8-8305c743530f	aae61c97-f6d3-44df-9eae-a2e0f3f39187	c92a6cf9-ea3a-4daf-96ef-8676789bb518	c9f689ad-9d9a-474b-b31d-d744aeb9765d	00:10 - 00:30 Perbaikan belting chipper 1	2023-05-01	12:34:05.946643	3	admin1
6c5d26c3-3625-438b-83e3-d37e4b09ec7d	60b47843-e7a1-4245-b585-fa46d1a2215f	f05e39ff-16a0-4249-af62-397040f396de	bc1b2e80-eb1c-4c8a-8546-e42552cc060c	15:10 - 16:32 Pengetapan lobang baut mata pisau chipper 1	2023-05-01	14:05:37.77547	2	admin1
dc69842f-93a5-4562-a4d9-e0c82e106c9e	b512031f-9ba7-4a87-a601-4db669e581c6	5b06c158-3da8-488b-80c3-cc3732b0ae48	84219d5a-9387-4fe1-a854-43941c1e07b5	15:45 - 17:40 Penggantian sambungan belting chipper 2	2023-05-02	09:44:59.467743	2	admin1
acd5753e-daf2-49e3-afb2-b0b232872114	6b3839e7-a28b-4756-8612-f89e6db54806	49e725b3-c8c2-4c31-9a31-2f0fc408962a	853bc807-e031-41c1-8d77-095f56ff1c49		2023-05-02	09:44:59.504527	3	admin1
0216f986-ff04-4520-8be8-8548c267e092	a8644a5b-2c50-4db1-88ab-41becbb294e7	1f33184b-1ebc-41b8-8c6c-6d5b82a10686	624545f2-a7ca-4b6f-8219-ec25139d4a50	08:30 Set beban dinaikkan ke 13 Mw	2023-05-03	16:27:44.773864	1	admin1
3e1e267a-f835-4b61-acd9-cd189ae7cdd7	1e2618ee-67c9-4111-ac6c-c75b6aff6ab9	46e6f8e7-5cb3-4a5a-af6d-847c2f9544db	d53e42f0-defa-41fe-983b-b50dbd52b00d		2023-05-03	16:27:44.820865	2	admin1
a2679493-d8fd-472b-962e-034a92e7393a	f9f20c28-2113-480e-b6c2-7e544189a54c	8b558c9b-a4fe-405d-b15a-f9d26089b1c4	d7d66b4e-bb23-4884-a4f8-178b0629763e		2023-05-03	16:27:44.824193	3	admin1
3a3d735f-1982-4424-aa80-0277a6b06702	a18c5bcb-6e48-4df7-b2d5-5fe5d0ee2b38	16ac654b-1016-49b0-a746-c69083a208c6	8c4ae490-3f45-451a-a238-c20d1551bd31		2023-05-04	16:27:44.826843	1	admin1
c08bd3ab-c8ca-45ce-9dc9-78649db491c9	5a748a5d-b805-4ab9-8fc8-5c3349b97bbd	4c51063b-dd3e-43a4-98ed-7f9a7d6a9718	e0eaa8b9-a6cc-4c2d-ba08-1782a4912463	tidak ada keterangan	2023-05-04	10:16:31.190035	2	admin1
\.


--
-- Data for Name: pemakaian_bahan_bakar; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pemakaian_bahan_bakar (pemakaian_bahan_bakar_id, tanggal, waktu, rpkg_cangkang, kcal_cangkang, rpkg_palmfiber, kcal_palmfiber, rpkg_woodchips, kcal_woodchips, rpkg_serbukkayu, kcal_serbukkayu, rpkg_sabutkelapa, kcal_sabutkelapa, rpkg_efbpress, kcal_efbpress, rpkg_opt, kcal_opt, shift, kg_cangkang, kg_palmfiber, kg_woodchips, kg_serbukkayu, kg_sabutkelapa, kg_efbpress, kg_opt) FROM stdin;
c9f689ad-9d9a-474b-b31d-d744aeb9765d	2023-05-01	11:28:03.514207	876	2177	266	2040	313	2084	200	1789	200	1615	210	1906	200	1630	3	0	0	120081	15741	0	11000	0
cdb9697c-73f0-4d97-ab90-230e4959dd77	2023-05-02	10:41:48.856602	876	2177	266	2040	313	2084	200	1789	200	1615	210	1906	200	1630	1	0	0	130650	12243	1210	33000	0
ec4eab11-bbea-45db-bbae-85412f0312fe	2023-05-01	16:17:46.506069	876	2177	266	2040	313	2084	200	1789	200	1615	210	1906	200	1630	1	0	0	147459	8745	0	11000	0
bc1b2e80-eb1c-4c8a-8546-e42552cc060c	2023-05-01	13:19:26.566841	876	2177	266	2040	313	2084	200	1789	200	1615	210	1906	200	1630	2	0	0	118209	6996	0	17580	0
84219d5a-9387-4fe1-a854-43941c1e07b5	2023-05-02	09:44:59.467743	876	2177	266	2040	313	2084	200	1789	200	1615	210	1906	200	1630	2	0	0	133575	3498	1210	38500	0
853bc807-e031-41c1-8d77-095f56ff1c49	2023-05-02	09:44:59.504527	876	2177	266	2040	313	2084	200	1789	200	1615	210	1906	200	1630	3	0	0	128934	8745	1210	39600	0
624545f2-a7ca-4b6f-8219-ec25139d4a50	2023-05-03	16:27:44.773864	876	2177	266	2040	313	2084	200	1789	200	1615	210	1906	200	1630	1	0	0	149565	8745	2420	47300	0
d53e42f0-defa-41fe-983b-b50dbd52b00d	2023-05-03	16:27:44.820865	876	2177	266	2040	313	2084	200	1789	200	1615	210	1906	200	1630	2	0	0	160758	12243	2420	41800	0
d7d66b4e-bb23-4884-a4f8-178b0629763e	2023-05-03	16:27:44.824193	876	2177	266	2040	313	2084	200	1789	200	1615	210	1906	200	1630	3	0	0	155454	13992	2420	46200	0
8c4ae490-3f45-451a-a238-c20d1551bd31	2023-05-04	16:27:44.826843	876	2177	266	2040	313	2084	200	1789	200	1615	210	1906	200	1630	1	0	0	152217	12243	6050	52800	0
e0eaa8b9-a6cc-4c2d-ba08-1782a4912463	2023-05-04	10:16:31.190035	876	2177	266	2040	313	2084	200	1789	200	1615	210	1906	200	1630	2	0	0	154791	12243	6050	52800	0
\.


--
-- Data for Name: pemakaian_kwh; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pemakaian_kwh (pemakaian_id, ekspor, pemakaian_sendiri, kwh_loss, tanggal, waktu, shift) FROM stdin;
f05e39ff-16a0-4249-af62-397040f396de	78112	7490	687	2023-05-01	14:01:56.020441	2
c92a6cf9-ea3a-4daf-96ef-8676789bb518	79840	7395	706	2023-05-01	11:23:16.537236	3
3b8e2ac0-1f43-4ef8-bb0d-815443c2ba82	79392	6837	717	2023-05-02	10:41:48.856602	1
fefc0e49-9cd3-4389-aac9-8eaee4fdad6c	93408	8278	883	2023-05-01	15:49:20.653401	1
5b06c158-3da8-488b-80c3-cc3732b0ae48	80672	6563	699	2023-05-02	09:44:59.467743	2
49e725b3-c8c2-4c31-9a31-2f0fc408962a	80800	6294	725	2023-05-02	09:44:59.504527	3
1f33184b-1ebc-41b8-8c6c-6d5b82a10686	92704	8306	867	2023-05-03	16:27:44.773864	1
46e6f8e7-5cb3-4a5a-af6d-847c2f9544db	97792	9102	946	2023-05-03	16:27:44.820865	2
8b558c9b-a4fe-405d-b15a-f9d26089b1c4	97152	8926	946	2023-05-03	16:27:44.824193	3
16ac654b-1016-49b0-a746-c69083a208c6	100928	9180	967	2023-05-04	16:27:44.826843	1
4c51063b-dd3e-43a4-98ed-7f9a7d6a9718	102432	9504	1029	2023-05-04	10:16:31.190035	2
\.


--
-- Data for Name: produksi_kwh; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.produksi_kwh (produksi_id, generation, pm_kwh_pltbm, tanggal, waktu, shift) FROM stdin;
60b47843-e7a1-4245-b585-fa46d1a2215f	86289	238880	2023-05-01	12:55:16.84071	2
aae61c97-f6d3-44df-9eae-a2e0f3f39187	87941	238880	2023-05-01	11:23:16.537236	3
f08fdc40-1f55-46ff-8ee8-96162b8f0858	86946	243808	2023-05-02	10:41:48.856602	1
d7225f4c-79ee-4a50-a442-2c2948301b12	102569	123880	2023-05-01	15:29:24.648226	1
b512031f-9ba7-4a87-a601-4db669e581c6	87934	243808	2023-05-02	09:44:59.467743	2
6b3839e7-a28b-4756-8612-f89e6db54806	87819	243808	2023-05-02	09:44:59.504527	3
a8644a5b-2c50-4db1-88ab-41becbb294e7	101877	291904	2023-05-03	16:27:44.773864	1
1e2618ee-67c9-4111-ac6c-c75b6aff6ab9	107840	291904	2023-05-03	16:27:44.820865	2
f9f20c28-2113-480e-b6c2-7e544189a54c	107024	291904	2023-05-03	16:27:44.824193	3
a18c5bcb-6e48-4df7-b2d5-5fe5d0ee2b38	111075	310528	2023-05-04	16:27:44.826843	1
5a748a5d-b805-4ab9-8fc8-5c3349b97bbd	112965	310528	2023-05-04	10:16:31.190035	2
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
7aef4c6c-3cad-43f4-9eb9-acdb2cd36f9a	10bb8e91-9a07-4f53-abf6-1d3b2322d688	admin2	123	admin2	admin2
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
-- Name: maintenance maintenance_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.maintenance
    ADD CONSTRAINT maintenance_pkey PRIMARY KEY (maintenance_id);


--
-- Name: operasional operasional_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.operasional
    ADD CONSTRAINT operasional_pkey PRIMARY KEY (operasional_id);


--
-- Name: operasional operasional_tanggal_shift_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.operasional
    ADD CONSTRAINT operasional_tanggal_shift_key UNIQUE (tanggal, shift);


--
-- Name: pemakaian_bahan_bakar pemakaian_bahan_bakar_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pemakaian_bahan_bakar
    ADD CONSTRAINT pemakaian_bahan_bakar_pkey PRIMARY KEY (pemakaian_bahan_bakar_id);


--
-- Name: pemakaian_bahan_bakar pemakaian_bahan_bakar_tanggal_shift_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pemakaian_bahan_bakar
    ADD CONSTRAINT pemakaian_bahan_bakar_tanggal_shift_key UNIQUE (tanggal, shift);


--
-- Name: pemakaian_kwh pemakaian_kwh_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pemakaian_kwh
    ADD CONSTRAINT pemakaian_kwh_pkey PRIMARY KEY (pemakaian_id);


--
-- Name: pemakaian_kwh pemakaian_kwh_tanggal_shift_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pemakaian_kwh
    ADD CONSTRAINT pemakaian_kwh_tanggal_shift_key UNIQUE (tanggal, shift);


--
-- Name: produksi_kwh produksi_kwh_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.produksi_kwh
    ADD CONSTRAINT produksi_kwh_pkey PRIMARY KEY (produksi_id);


--
-- Name: produksi_kwh produksi_kwh_tanggal_shift_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.produksi_kwh
    ADD CONSTRAINT produksi_kwh_tanggal_shift_key UNIQUE (tanggal, shift);


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

