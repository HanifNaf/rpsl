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
-- Name: bearing; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.bearing (
    bearing_id uuid NOT NULL,
    tanggal date NOT NULL,
    jam time without time zone NOT NULL,
    temperature_1a real NOT NULL,
    temperature_1b real NOT NULL,
    temperature_2a real NOT NULL,
    temperature_2b real NOT NULL,
    temperature_3a real NOT NULL,
    temperature_3b real NOT NULL,
    temperature_4 real NOT NULL,
    return_oil_temp_1 real NOT NULL,
    return_oil_temp_2 real NOT NULL,
    return_oil_temp_3 real NOT NULL,
    return_oil_temp_4 real NOT NULL,
    thrust_pad_a real NOT NULL,
    thrust_pad_b real NOT NULL
);


ALTER TABLE public.bearing OWNER TO rpsl;

--
-- Name: casing; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.casing (
    casing_id uuid NOT NULL,
    upper_temp real NOT NULL,
    lower_temp real NOT NULL,
    flange_temp_a real NOT NULL,
    flange_temp_b real NOT NULL,
    tanggal date NOT NULL,
    jam time without time zone NOT NULL
);


ALTER TABLE public.casing OWNER TO rpsl;

--
-- Name: condensor_temperature; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.condensor_temperature (
    condensor_id uuid NOT NULL,
    tanggal date NOT NULL,
    jam time without time zone NOT NULL,
    inlet_steam real NOT NULL,
    cond real NOT NULL,
    cooling_inlet_a real NOT NULL,
    cooling_inlet_b real NOT NULL,
    cooling_outlet_a real NOT NULL,
    cooling_outlet_b real NOT NULL
);


ALTER TABLE public.condensor_temperature OWNER TO rpsl;

--
-- Name: generator; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.generator (
    generator_id uuid NOT NULL,
    tanggal date NOT NULL,
    jam time without time zone NOT NULL,
    outlet_air real NOT NULL,
    inlet_air real NOT NULL,
    stator_coil_temp_1 real NOT NULL,
    stator_coil_temp_2 real NOT NULL,
    stator_coil_temp_3 real NOT NULL,
    stator_coil_temp_4 real NOT NULL,
    stator_coil_temp_5 real NOT NULL,
    stator_coil_temp_6 real NOT NULL,
    stator_core_temp_7 real NOT NULL,
    stator_core_temp_8 real NOT NULL,
    stator_core_temp_9 real NOT NULL,
    stator_core_temp_10 real NOT NULL,
    stator_core_temp_11 real NOT NULL,
    stator_core_temp_12 real NOT NULL
);


ALTER TABLE public.generator OWNER TO rpsl;

--
-- Name: oil_cooler_temperature; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.oil_cooler_temperature (
    oil_id uuid NOT NULL,
    tanggal date NOT NULL,
    jam time without time zone NOT NULL,
    cooling_inlet_a real NOT NULL,
    cooling_inlet_b real NOT NULL,
    cooling_outlet_a real NOT NULL,
    cooling_outlet_b real NOT NULL,
    oil_inlet_a real NOT NULL,
    oil_inlet_b real NOT NULL,
    oil_outlet_a real NOT NULL,
    oil_outlet_b real NOT NULL
);


ALTER TABLE public.oil_cooler_temperature OWNER TO rpsl;

--
-- Name: steam; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.steam (
    steam_id uuid NOT NULL,
    tanggal date NOT NULL,
    jam time without time zone NOT NULL,
    pressure real NOT NULL,
    before_msv_temp real NOT NULL,
    after_stage_1_temp real NOT NULL,
    after_msv_temp real NOT NULL,
    exhaust_chamber_temp real NOT NULL
);


ALTER TABLE public.steam OWNER TO rpsl;

--
-- Name: thrust_pad; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.thrust_pad (
    thrust_pad_id uuid NOT NULL,
    tanggal date NOT NULL,
    jam time without time zone NOT NULL,
    pad_a real NOT NULL,
    pad_b real NOT NULL,
    pad_c real NOT NULL,
    pad_d real NOT NULL,
    pad_e real NOT NULL,
    pad_f real NOT NULL,
    pad_g real NOT NULL,
    pad_h real NOT NULL,
    pad_i real NOT NULL,
    pad_j real NOT NULL
);


ALTER TABLE public.thrust_pad OWNER TO rpsl;

--
-- Name: turbin; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.turbin (
    turbin_id uuid NOT NULL,
    tanggal date NOT NULL,
    jam time without time zone NOT NULL,
    axial_disp real NOT NULL,
    heat_exp real NOT NULL,
    stroke_position real NOT NULL,
    oil_tank_level real NOT NULL,
    safety_oil_pressure real NOT NULL,
    lube_oil_pressure real NOT NULL,
    speed real NOT NULL,
    vacuum real NOT NULL
);


ALTER TABLE public.turbin OWNER TO rpsl;

--
-- Name: vibration; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.vibration (
    vibration_id uuid NOT NULL,
    bearing1 real NOT NULL,
    bearing2 real NOT NULL,
    bearing3 real NOT NULL,
    bearing4 real NOT NULL,
    tanggal date NOT NULL,
    jam time without time zone NOT NULL
);


ALTER TABLE public.vibration OWNER TO rpsl;

--
-- Data for Name: bearing; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.bearing (bearing_id, tanggal, jam, temperature_1a, temperature_1b, temperature_2a, temperature_2b, temperature_3a, temperature_3b, temperature_4, return_oil_temp_1, return_oil_temp_2, return_oil_temp_3, return_oil_temp_4, thrust_pad_a, thrust_pad_b) FROM stdin;
c5048506-c12e-4c45-a1e0-191933fe5ab1	2023-10-06	13:35:26.630288	42	2423	342	432	234	423	423	5	132	456	2124	12	123
\.


--
-- Data for Name: casing; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.casing (casing_id, upper_temp, lower_temp, flange_temp_a, flange_temp_b, tanggal, jam) FROM stdin;
df770194-b3bd-4ef0-8745-e59cfa857441	1235	1564	4568	1235	2023-10-06	13:35:26.630288
\.


--
-- Data for Name: condensor_temperature; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.condensor_temperature (condensor_id, tanggal, jam, inlet_steam, cond, cooling_inlet_a, cooling_inlet_b, cooling_outlet_a, cooling_outlet_b) FROM stdin;
0a5f3adf-0158-4c8c-88ae-9b989d2959c3	2023-10-06	13:35:26.630288	135	1235	135	156	1235	5895
\.


--
-- Data for Name: generator; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.generator (generator_id, tanggal, jam, outlet_air, inlet_air, stator_coil_temp_1, stator_coil_temp_2, stator_coil_temp_3, stator_coil_temp_4, stator_coil_temp_5, stator_coil_temp_6, stator_core_temp_7, stator_core_temp_8, stator_core_temp_9, stator_core_temp_10, stator_core_temp_11, stator_core_temp_12) FROM stdin;
578c50b4-ee90-4db5-a87b-506c57066198	2023-10-06	13:35:26.630288	1235	12354	4568	2315	12354	87	1235	24561	1235	521	456	1235	2315	2135
\.


--
-- Data for Name: oil_cooler_temperature; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.oil_cooler_temperature (oil_id, tanggal, jam, cooling_inlet_a, cooling_inlet_b, cooling_outlet_a, cooling_outlet_b, oil_inlet_a, oil_inlet_b, oil_outlet_a, oil_outlet_b) FROM stdin;
a07007ea-0787-45cf-9d0a-d18f9907a2fe	2023-10-06	13:35:26.630288	135	3214	2215	1235	1354	486	3215	2351
\.


--
-- Data for Name: steam; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.steam (steam_id, tanggal, jam, pressure, before_msv_temp, after_stage_1_temp, after_msv_temp, exhaust_chamber_temp) FROM stdin;
5333fd24-d290-4a23-b8ac-f8cd8885194c	2023-10-06	13:35:26.630288	43	342	342	2421	342
\.


--
-- Data for Name: thrust_pad; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.thrust_pad (thrust_pad_id, tanggal, jam, pad_a, pad_b, pad_c, pad_d, pad_e, pad_f, pad_g, pad_h, pad_i, pad_j) FROM stdin;
7cbfd64c-fdf6-4c85-8959-de5043042eb9	2023-10-06	13:35:26.630288	1354	4687	1324	215	1324	1235	2456	1235	4568	125
\.


--
-- Data for Name: turbin; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.turbin (turbin_id, tanggal, jam, axial_disp, heat_exp, stroke_position, oil_tank_level, safety_oil_pressure, lube_oil_pressure, speed, vacuum) FROM stdin;
fa3d70cf-ef4c-43ea-ae43-f046dbea4613	2023-10-06	13:35:26.630288	12	23	123	312	312	21	123	123
\.


--
-- Data for Name: vibration; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.vibration (vibration_id, bearing1, bearing2, bearing3, bearing4, tanggal, jam) FROM stdin;
ff1aa226-0d37-4c26-91bb-5f836b2b9a48	43	23	22	13	2023-10-05	14:50:26.986267
274d05a5-2cd1-4fa7-a8d0-3c71d4853664	1231	22	23	321	2023-10-06	13:35:26.630288
e67b857f-2ad5-4ec5-832e-7a610c6f07b4	11	22	44	33	2023-10-05	14:50:09.300285
\.


--
-- Name: bearing bearing_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.bearing
    ADD CONSTRAINT bearing_pkey PRIMARY KEY (bearing_id);


--
-- Name: casing casing_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.casing
    ADD CONSTRAINT casing_pkey PRIMARY KEY (casing_id);


--
-- Name: condensor_temperature condensor_temperature_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.condensor_temperature
    ADD CONSTRAINT condensor_temperature_pkey PRIMARY KEY (condensor_id);


--
-- Name: generator generator_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.generator
    ADD CONSTRAINT generator_pkey PRIMARY KEY (generator_id);


--
-- Name: oil_cooler_temperature oil_cooler_temperature_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.oil_cooler_temperature
    ADD CONSTRAINT oil_cooler_temperature_pkey PRIMARY KEY (oil_id);


--
-- Name: steam steam_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.steam
    ADD CONSTRAINT steam_pkey PRIMARY KEY (steam_id);


--
-- Name: thrust_pad thrust_pad_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.thrust_pad
    ADD CONSTRAINT thrust_pad_pkey PRIMARY KEY (thrust_pad_id);


--
-- Name: turbin turbin_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.turbin
    ADD CONSTRAINT turbin_pkey PRIMARY KEY (turbin_id);


--
-- Name: vibration vibration_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.vibration
    ADD CONSTRAINT vibration_pkey PRIMARY KEY (vibration_id);


--
-- PostgreSQL database dump complete
--

