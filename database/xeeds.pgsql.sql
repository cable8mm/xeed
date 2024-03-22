--
-- PostgreSQL database dump
--

-- Dumped from database version 14.11 (Homebrew)
-- Dumped by pg_dump version 14.11 (Homebrew)

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
-- Name: postgis; Type: EXTENSION; Schema: -; Owner: -
--

-- CREATE EXTENSION IF NOT EXISTS postgis WITH SCHEMA public;


--
-- Name: EXTENSION postgis; Type: COMMENT; Schema: -; Owner: -
--

-- COMMENT ON EXTENSION postgis IS 'PostGIS geometry and geography spatial types and functions';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: xeeds; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.xeeds (
    id bigint NOT NULL,
    big_integer bigint NOT NULL,
    "binary" bytea NOT NULL,
    "boolean" boolean NOT NULL,
    "char" character(100) NOT NULL,
    date_time_tz timestamp(0) with time zone NOT NULL,
    date_time timestamp(0) without time zone NOT NULL,
    date date NOT NULL,
    "decimal" numeric(8,2) NOT NULL,
    double double precision NOT NULL,
    enum character varying(255) NOT NULL,
    "float" real NOT NULL,
    foreign_id bigint NOT NULL,
    foreign_ulid character(26) NOT NULL,
    foreign_uuid uuid NOT NULL,
    geometry public.geometry NOT NULL,
    "integer" integer NOT NULL,
    ip_address inet NOT NULL,
    json json NOT NULL,
    jsonb jsonb NOT NULL,
    long_text text NOT NULL,
    mac_address macaddr NOT NULL,
    medium_integer integer NOT NULL,
    medium_text text NOT NULL,
    morphs_type character varying(255) NOT NULL,
    morphs_id bigint NOT NULL,
    nullable_morphs_type character varying(255),
    nullable_morphs_id bigint,
    nullable_ulid_morphs_type character varying(255),
    nullable_ulid_morphs_id character(26),
    nullable_uuid_morphs_type character varying(255),
    nullable_uuid_morphs_id uuid,
    remember_token character varying(100),
    small_integer smallint NOT NULL,
    soft_deletes_tz timestamp(0) with time zone,
    soft_deletes timestamp(0) without time zone,
    string character varying(100) NOT NULL,
    text text NOT NULL,
    time_tz time(0) with time zone NOT NULL,
    "time" time(0) without time zone NOT NULL,
    timestamp_tz timestamp(0) with time zone NOT NULL,
    "timestamp" timestamp(0) without time zone NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    tiny_integer smallint NOT NULL,
    tiny_text character varying(255) NOT NULL,
    unsigned_big_integer bigint NOT NULL,
    unsigned_integer integer NOT NULL,
    unsigned_medium_integer integer NOT NULL,
    unsigned_small_integer smallint NOT NULL,
    unsigned_tiny_integer smallint NOT NULL,
    ulid_morphs_type character varying(255) NOT NULL,
    ulid_morphs_id character(26) NOT NULL,
    uuid_morphs_type character varying(255) NOT NULL,
    uuid_morphs_id uuid NOT NULL,
    ulid character(26) NOT NULL,
    uuid uuid NOT NULL,
    year integer NOT NULL,
    CONSTRAINT xeeds_enum_check CHECK (((enum)::text = ANY ((ARRAY['easy'::character varying, 'hard'::character varying])::text[])))
);


--
-- Name: xeeds_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.xeeds_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: xeeds_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.xeeds_id_seq OWNED BY public.xeeds.id;

--
-- Name: xeeds id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.xeeds ALTER COLUMN id SET DEFAULT nextval('public.xeeds_id_seq'::regclass);

--
-- Name: xeeds xeeds_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.xeeds
    ADD CONSTRAINT xeeds_pkey PRIMARY KEY (id);


--
-- Name: xeeds_morphs_type_morphs_id_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX xeeds_morphs_type_morphs_id_index ON public.xeeds USING btree (morphs_type, morphs_id);


--
-- Name: xeeds_nullable_morphs_type_nullable_morphs_id_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX xeeds_nullable_morphs_type_nullable_morphs_id_index ON public.xeeds USING btree (nullable_morphs_type, nullable_morphs_id);


--
-- Name: xeeds_nullable_ulid_morphs_type_nullable_ulid_morphs_id_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX xeeds_nullable_ulid_morphs_type_nullable_ulid_morphs_id_index ON public.xeeds USING btree (nullable_ulid_morphs_type, nullable_ulid_morphs_id);


--
-- Name: xeeds_nullable_uuid_morphs_type_nullable_uuid_morphs_id_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX xeeds_nullable_uuid_morphs_type_nullable_uuid_morphs_id_index ON public.xeeds USING btree (nullable_uuid_morphs_type, nullable_uuid_morphs_id);


--
-- Name: xeeds_ulid_morphs_type_ulid_morphs_id_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX xeeds_ulid_morphs_type_ulid_morphs_id_index ON public.xeeds USING btree (ulid_morphs_type, ulid_morphs_id);


--
-- Name: xeeds_uuid_morphs_type_uuid_morphs_id_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX xeeds_uuid_morphs_type_uuid_morphs_id_index ON public.xeeds USING btree (uuid_morphs_type, uuid_morphs_id);


--
-- PostgreSQL database dump complete
--

--
-- PostgreSQL database dump
--

-- Dumped from database version 14.11 (Homebrew)
-- Dumped by pg_dump version 14.11 (Homebrew)

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
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: -
--

--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.migrations_id_seq', 1, true);


--
-- PostgreSQL database dump complete
--

