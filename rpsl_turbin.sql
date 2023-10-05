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

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: turbin; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.turbin (
    turbin_id uuid NOT NULL
);


ALTER TABLE public.turbin OWNER TO postgres;

--
-- Data for Name: turbin; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.turbin (turbin_id) FROM stdin;
\.


--
-- Name: turbin turbin_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.turbin
    ADD CONSTRAINT turbin_pkey PRIMARY KEY (turbin_id);


--
-- PostgreSQL database dump complete
--

