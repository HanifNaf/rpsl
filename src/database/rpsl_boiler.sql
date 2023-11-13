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
-- Name: air; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.air (
    air_id uuid NOT NULL,
    tanggal date NOT NULL,
    jam time without time zone NOT NULL,
    primary_temperature real NOT NULL,
    secondary_temperature real NOT NULL,
    primary_pressure real NOT NULL,
    secondary_pressure real NOT NULL
);


ALTER TABLE public.air OWNER TO rpsl;

--
-- Name: desuperheater; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.desuperheater (
    desuperheater_id uuid NOT NULL,
    tanggal date NOT NULL,
    jam time without time zone NOT NULL,
    temperature real NOT NULL,
    flow real NOT NULL,
    flow_total real NOT NULL
);


ALTER TABLE public.desuperheater OWNER TO rpsl;

--
-- Name: drum_level; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.drum_level (
    drum_id uuid NOT NULL,
    tanggal date NOT NULL,
    jam time without time zone NOT NULL,
    level1 real NOT NULL,
    level2 real NOT NULL,
    pressure real NOT NULL
);


ALTER TABLE public.drum_level OWNER TO rpsl;

--
-- Name: economizer; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.economizer (
    economizer_id uuid NOT NULL,
    tanggal date NOT NULL,
    jam time without time zone NOT NULL,
    intemperature_l real NOT NULL,
    intemperature_r real NOT NULL,
    outtemperature_l real NOT NULL,
    outtemperature_r real NOT NULL,
    inpressure_l real NOT NULL,
    inpressure_r real NOT NULL,
    outpressure_l real NOT NULL,
    outpressure_r real NOT NULL,
    intemperature_water real NOT NULL,
    outtemperature_water real NOT NULL
);


ALTER TABLE public.economizer OWNER TO rpsl;

--
-- Name: exhaust_gas; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.exhaust_gas (
    exhaustgas_id uuid NOT NULL,
    tanggal date NOT NULL,
    jam time without time zone NOT NULL,
    temperature_l real NOT NULL,
    temperature_r real NOT NULL,
    pressure_l real NOT NULL,
    pressure_r real NOT NULL
);


ALTER TABLE public.exhaust_gas OWNER TO rpsl;

--
-- Name: fdf; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.fdf (
    fdf_id uuid NOT NULL,
    tanggal date NOT NULL,
    jam time without time zone NOT NULL,
    outpressure real NOT NULL,
    freq real NOT NULL,
    curr real NOT NULL
);


ALTER TABLE public.fdf OWNER TO rpsl;

--
-- Name: feed_pump; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.feed_pump (
    feedpump_id uuid NOT NULL,
    tanggal date NOT NULL,
    jam time without time zone NOT NULL,
    freq1 real NOT NULL,
    freq2 real NOT NULL,
    curr1 real NOT NULL,
    curr2 real NOT NULL
);


ALTER TABLE public.feed_pump OWNER TO rpsl;

--
-- Name: feed_water; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.feed_water (
    feedwater_id uuid NOT NULL,
    tanggal date NOT NULL,
    jam time without time zone NOT NULL,
    temperature real NOT NULL,
    flow real NOT NULL,
    flow_total real NOT NULL,
    pressure real NOT NULL
);


ALTER TABLE public.feed_water OWNER TO rpsl;

--
-- Name: fuel; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.fuel (
    fuel_id uuid NOT NULL,
    tanggal date NOT NULL,
    jam time without time zone NOT NULL,
    freq1 real NOT NULL,
    freq2 real NOT NULL,
    freq3 real NOT NULL,
    freq4 real NOT NULL
);


ALTER TABLE public.fuel OWNER TO rpsl;

--
-- Name: furnace; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.furnace (
    furnace_id uuid NOT NULL,
    tanggal date NOT NULL,
    jam time without time zone NOT NULL,
    temperature_l real NOT NULL,
    temperature_r real NOT NULL,
    pressure_l real NOT NULL,
    pressure_r real NOT NULL
);


ALTER TABLE public.furnace OWNER TO rpsl;

--
-- Name: header; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.header (
    header_id uuid NOT NULL,
    tanggal date NOT NULL,
    jam time without time zone NOT NULL,
    temperature real NOT NULL,
    pressure real NOT NULL
);


ALTER TABLE public.header OWNER TO rpsl;

--
-- Name: idf; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.idf (
    idf_id uuid NOT NULL,
    tanggal date NOT NULL,
    jam time without time zone NOT NULL,
    freq1 real NOT NULL,
    freq2 real NOT NULL,
    curr1 real NOT NULL,
    curr2 real NOT NULL
);


ALTER TABLE public.idf OWNER TO rpsl;

--
-- Name: main_stream; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.main_stream (
    mainstream_id uuid NOT NULL,
    tanggal date NOT NULL,
    jam time without time zone NOT NULL,
    temperature real NOT NULL,
    flow real NOT NULL,
    flow_total real NOT NULL,
    pressure real NOT NULL
);


ALTER TABLE public.main_stream OWNER TO rpsl;

--
-- Name: scraper; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.scraper (
    scraper_id uuid NOT NULL,
    tanggal date NOT NULL,
    jam time without time zone NOT NULL,
    freq real NOT NULL,
    curr real NOT NULL
);


ALTER TABLE public.scraper OWNER TO rpsl;

--
-- Name: sdf; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.sdf (
    sdf_id uuid NOT NULL,
    tanggal date NOT NULL,
    jam time without time zone NOT NULL,
    outpressure real NOT NULL,
    freq real NOT NULL,
    curr real NOT NULL
);


ALTER TABLE public.sdf OWNER TO rpsl;

--
-- Name: soot; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.soot (
    soot_id uuid NOT NULL,
    tanggal date NOT NULL,
    jam time without time zone NOT NULL,
    temperature real NOT NULL,
    pressure real NOT NULL
);


ALTER TABLE public.soot OWNER TO rpsl;

--
-- Name: superheater; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.superheater (
    superheater_id uuid NOT NULL,
    tanggal date NOT NULL,
    jam time without time zone NOT NULL,
    temperature_l real NOT NULL,
    temperature_r real NOT NULL,
    pressure_l real NOT NULL,
    pressure_r real NOT NULL
);


ALTER TABLE public.superheater OWNER TO rpsl;

--
-- Data for Name: air; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.air (air_id, tanggal, jam, primary_temperature, secondary_temperature, primary_pressure, secondary_pressure) FROM stdin;
af0135e2-d54e-49ac-a10c-c6741493785e	2023-10-05	10:38:11.756162	234423	23	456	489
3e21254c-e631-4d1a-ae3d-259ea6e594aa	2023-10-05	13:57:42.827053	234423	23	456	489
d067b277-702a-4083-8374-e8686cc63f6d	2023-10-05	14:00:58.899026	234423	23	456	489
\.


--
-- Data for Name: desuperheater; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.desuperheater (desuperheater_id, tanggal, jam, temperature, flow, flow_total) FROM stdin;
00c95b73-acab-4751-9acf-d2f007945c14	2023-10-05	10:38:11.756162	135	2345	1235
6c649f40-50fa-4160-904c-f8b55b7018c9	2023-10-05	13:57:42.827053	135	2345	1235
c33069bd-1842-47d8-815a-08fda1d6a96a	2023-10-05	14:00:58.899026	135	2345	1235
\.


--
-- Data for Name: drum_level; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.drum_level (drum_id, tanggal, jam, level1, level2, pressure) FROM stdin;
a9bd65a9-e636-4f8d-a083-5cdf52bb4f9a	2023-10-05	10:38:11.756162	12223	1233	1233
249ded57-9ebb-4ed2-a6ab-1c52e6be6ebd	2023-10-05	13:57:42.827053	12223	1233	1233
3d0cae11-de25-4273-a2fa-4680761093df	2023-10-05	14:00:58.899026	12223	1233	1233
\.


--
-- Data for Name: economizer; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.economizer (economizer_id, tanggal, jam, intemperature_l, intemperature_r, outtemperature_l, outtemperature_r, inpressure_l, inpressure_r, outpressure_l, outpressure_r, intemperature_water, outtemperature_water) FROM stdin;
6f8b2dab-8d68-4bb5-b35f-f075ed27ec20	2023-10-05	10:38:11.756162	2234	135	1325	12354	1135	22354	12254	22315	8846	1235
6245126e-55b9-4fe8-9934-11a13a932169	2023-10-05	13:57:42.827053	2234	135	1325	12354	1135	22354	12254	22315	8846	1235
74945e7b-6716-40d0-aac4-061fe6eb409d	2023-10-05	01:00:00	2234	135	1325	12354	1135	22354	12254	22315	8846	1235
\.


--
-- Data for Name: exhaust_gas; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.exhaust_gas (exhaustgas_id, tanggal, jam, temperature_l, temperature_r, pressure_l, pressure_r) FROM stdin;
1593388c-64a8-4964-b040-75e872e5f64e	2023-10-05	10:38:11.756162	1235	4895	1235	1235
7f4c8546-7606-4dfc-9874-8e16b27e4519	2023-10-05	13:57:42.827053	1235	4895	1235	1235
c4438d7d-42b1-4f98-8253-3c7c3bfc22f4	2023-10-05	14:00:58.899026	1235	4895	1235	1235
\.


--
-- Data for Name: fdf; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.fdf (fdf_id, tanggal, jam, outpressure, freq, curr) FROM stdin;
1b021ac0-7b32-4394-85c9-c1e2a66ffa92	2023-10-05	10:38:11.756162	11235	1235	1235
a2247142-9613-44e8-83bd-37467feb35fd	2023-10-05	13:57:42.827053	11235	1235	1235
04f92373-76e7-4bc9-80d8-701711312de3	2023-10-05	14:00:58.899026	11235	1235	1235
\.


--
-- Data for Name: feed_pump; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.feed_pump (feedpump_id, tanggal, jam, freq1, freq2, curr1, curr2) FROM stdin;
f9272c04-8eea-47b2-a532-1fd0ebf1b0e0	2023-10-05	10:38:11.756162	123	123	123	456
03048587-277b-4ccf-afd1-690fecf00c35	2023-10-05	13:57:42.827053	123	123	123	456
6d7a157b-07af-41d9-bbf9-92f8e1d75b60	2023-10-05	14:00:58.899026	123	123	123	456
\.


--
-- Data for Name: feed_water; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.feed_water (feedwater_id, tanggal, jam, temperature, flow, flow_total, pressure) FROM stdin;
d2def882-b5e3-4202-a616-2abf014c1be7	2023-10-05	10:38:11.756162	456	1235	15456	4598
7561f935-af26-4534-8eb1-20f01be9e2ae	2023-10-05	13:57:42.827053	456	1235	15456	4598
90d9d23e-6c0d-4ef1-8092-4348e537240f	2023-10-05	14:00:58.899026	456	1235	15456	4598
\.


--
-- Data for Name: fuel; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.fuel (fuel_id, tanggal, jam, freq1, freq2, freq3, freq4) FROM stdin;
9f700966-582a-411e-831a-5895e72c12f6	2023-10-05	10:38:11.756162	11553	2254	32654	7895
9094f6b6-4d39-4866-a648-75fc2fd1afb2	2023-10-05	13:57:42.827053	11553	2254	32654	7895
808a5a09-a2e1-4f05-99a4-6d011c17331a	2023-10-05	14:00:58.899026	11553	2254	32654	7895
\.


--
-- Data for Name: furnace; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.furnace (furnace_id, tanggal, jam, temperature_l, temperature_r, pressure_l, pressure_r) FROM stdin;
8e7e731e-7a5c-4bca-8e8a-1728f8106294	2023-10-05	10:38:11.756162	456	1236	165	1235
e1f7c71e-e170-41f9-acfd-4e1ea3bdd7ea	2023-10-05	13:57:42.827053	456	1236	165	1235
71335179-4c7b-46a2-b9ca-3b926b853f44	2023-10-05	14:00:58.899026	456	1236	165	1235
\.


--
-- Data for Name: header; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.header (header_id, tanggal, jam, temperature, pressure) FROM stdin;
dbc622e4-a82c-46c0-b0d5-f1011ab9294e	2023-10-05	10:38:11.756162	456	1235
8e27675b-f17e-427c-b862-546da1db23a9	2023-10-05	13:57:42.827053	456	1235
542429ef-690d-4a3b-b64d-57f731c34073	2023-10-05	14:00:58.899026	456	1235
\.


--
-- Data for Name: idf; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.idf (idf_id, tanggal, jam, freq1, freq2, curr1, curr2) FROM stdin;
e9630fd6-8ba6-41c5-841b-7ed6ad510008	2023-10-05	10:38:11.756162	456	45	789	2344
c36b2677-b77e-4fcc-8cc6-26a4fc358026	2023-10-05	13:57:42.827053	456	45	789	2344
ce8d7630-33b8-464e-9d84-bd82da9dbf9d	2023-10-05	14:00:58.899026	456	45	789	2344
\.


--
-- Data for Name: main_stream; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.main_stream (mainstream_id, tanggal, jam, temperature, flow, flow_total, pressure) FROM stdin;
d218926d-af3d-43eb-8a32-f0e8a1054dd1	2023-10-05	10:38:11.756162	56	13	15	15
08481dad-1d8a-40ee-9032-025480236dbc	2023-10-05	13:57:42.827053	56	13	15	15
e7a2d045-bfde-40e3-90bb-b0fb96c37d55	2023-10-05	14:00:58.899026	56	13	15	15
\.


--
-- Data for Name: scraper; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.scraper (scraper_id, tanggal, jam, freq, curr) FROM stdin;
b8f994aa-dcc3-4c1a-9964-517b4b66e227	2023-10-05	10:38:11.756162	1235	1235
43c971de-cee6-4496-99c3-9e45d44ef989	2023-10-05	13:57:42.827053	1235	1235
1b1e6d7f-d69b-48ca-8845-b2417d33f329	2023-10-05	14:00:58.899026	1235	1235
\.


--
-- Data for Name: sdf; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.sdf (sdf_id, tanggal, jam, outpressure, freq, curr) FROM stdin;
756b17c7-1038-4617-8d67-5ba065417db2	2023-10-05	10:38:11.756162	1125	44568	22354
3bdf1b65-743a-425d-87e1-a9753f9965ce	2023-10-05	13:57:42.827053	1125	44568	22354
b6987370-dc9e-4393-bdf9-e7515cf110a6	2023-10-05	14:00:58.899026	1125	44568	22354
\.


--
-- Data for Name: soot; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.soot (soot_id, tanggal, jam, temperature, pressure) FROM stdin;
4f214eac-8e6f-4aa8-a599-67cb84488d18	2023-10-05	10:38:11.756162	1235	4485
0a04790a-1afd-4e71-85d7-ff4110ab8238	2023-10-05	13:57:42.827053	1235	4485
edf7fc35-9e6f-4ed1-97db-8e8014e8738a	2023-10-05	14:00:58.899026	1235	4485
\.


--
-- Data for Name: superheater; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.superheater (superheater_id, tanggal, jam, temperature_l, temperature_r, pressure_l, pressure_r) FROM stdin;
b5279cad-f0b7-42d5-b2cd-28ed6c6b5c08	2023-10-05	10:38:11.756162	1654	1235	4568	4568
0973087c-bcda-48f9-8a9b-b23468266723	2023-10-05	13:57:42.827053	1654	1235	4568	4568
3ba9cb02-1e2e-4948-bef2-d247dd774392	2023-10-05	14:00:58.899026	1654	1235	4568	4568
\.


--
-- Name: air air_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.air
    ADD CONSTRAINT air_pkey PRIMARY KEY (air_id);


--
-- Name: desuperheater desuperheater_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.desuperheater
    ADD CONSTRAINT desuperheater_pkey PRIMARY KEY (desuperheater_id);


--
-- Name: drum_level drum_level_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.drum_level
    ADD CONSTRAINT drum_level_pkey PRIMARY KEY (drum_id);


--
-- Name: economizer economizer_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.economizer
    ADD CONSTRAINT economizer_pkey PRIMARY KEY (economizer_id);


--
-- Name: exhaust_gas exhaust_gas_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.exhaust_gas
    ADD CONSTRAINT exhaust_gas_pkey PRIMARY KEY (exhaustgas_id);


--
-- Name: fdf fdf_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.fdf
    ADD CONSTRAINT fdf_pkey PRIMARY KEY (fdf_id);


--
-- Name: feed_pump feed_pump_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.feed_pump
    ADD CONSTRAINT feed_pump_pkey PRIMARY KEY (feedpump_id);


--
-- Name: feed_water feed_water_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.feed_water
    ADD CONSTRAINT feed_water_pkey PRIMARY KEY (feedwater_id);


--
-- Name: fuel fuel_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.fuel
    ADD CONSTRAINT fuel_pkey PRIMARY KEY (fuel_id);


--
-- Name: furnace furnace_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.furnace
    ADD CONSTRAINT furnace_pkey PRIMARY KEY (furnace_id);


--
-- Name: header header_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.header
    ADD CONSTRAINT header_pkey PRIMARY KEY (header_id);


--
-- Name: idf idf_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.idf
    ADD CONSTRAINT idf_pkey PRIMARY KEY (idf_id);


--
-- Name: main_stream main_stream_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.main_stream
    ADD CONSTRAINT main_stream_pkey PRIMARY KEY (mainstream_id);


--
-- Name: scraper scraper_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.scraper
    ADD CONSTRAINT scraper_pkey PRIMARY KEY (scraper_id);


--
-- Name: sdf sdf_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.sdf
    ADD CONSTRAINT sdf_pkey PRIMARY KEY (sdf_id);


--
-- Name: soot soot_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.soot
    ADD CONSTRAINT soot_pkey PRIMARY KEY (soot_id);


--
-- Name: superheater superheater_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.superheater
    ADD CONSTRAINT superheater_pkey PRIMARY KEY (superheater_id);


--
-- PostgreSQL database dump complete
--

