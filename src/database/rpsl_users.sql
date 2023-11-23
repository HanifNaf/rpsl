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
-- Name: users; Type: TABLE; Schema: public; Owner: rpsl
--

CREATE TABLE public.users (
    users_id uuid NOT NULL,
    username character varying(50) NOT NULL,
    password character varying(100) NOT NULL,
    role character varying(100) NOT NULL
);


ALTER TABLE public.users OWNER TO rpsl;

--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: rpsl
--

COPY public.users (users_id, username, password, role) FROM stdin;
fac74558-f77d-4b0a-bcb8-c64d53efc270	admin	$2a$06$E8qLQYK8IcPcLGZOtPYLNeU14ifjMuJJXtW4DVk8.ff2zAMfhsCtS	admin
7cc66ca3-6488-420b-a66c-aeb1726b92e7	mekanikal	$2a$06$JBiomhzL70K/uouQG0w4u.qt2lXH7Lcv/efrqQmXlV040PKZ9OLbe	mekanikal
6aeed0e2-91cf-4857-9f4d-0a0fe9cb9d95	elektrikal	$2a$06$kLT8T4b2q4OONltDHwAFu.dnPAEG1qVEA0wgqqzD04etRmfAGXIYO	elektrikal
f0b22632-a5fc-4ef3-8084-3baae11b264b	wtp	$2a$06$K4tE0eHOLnGm3daKD6bRDuhjTrkPjH0PZFl.WuAGA5XUb6GKyG0.K	wtp
750b0580-ecba-4c62-bee4-b0eb91e063f1	hrd	$2a$06$cgRMpNqbcsh4WengOKZIW.td1DR8xlbaWJ8R.0dcbed0kAV3/spPq	hrd
21da3f0e-8c1a-4c95-955d-05e812a5e03b	hse	$2a$06$kFjZfR4oC6zaUakm6dpJFe2wVO6zqqzDmsJjz16hKfxZfsNdSVnRO	hse
6f5c38dd-67fa-4520-902c-8ea23fa23954	operasional	$2a$06$pEunQwg/gEdRjK1SghmHjOxXcoD8mUJAKDr.I1qqt30L0txEHBK2K	operasional
610f7cc9-cd4c-474b-88c1-f798bc6c726e	manager	$2a$06$QALuQ2kvBdg.y20at5vs7OuHR6WfTGHyH2MrIv/DRrnoJTLKy6HUG	manager
\.


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (users_id);


--
-- Name: users users_username_key; Type: CONSTRAINT; Schema: public; Owner: rpsl
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_username_key UNIQUE (username);


--
-- PostgreSQL database dump complete
--

