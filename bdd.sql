--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.15
-- Dumped by pg_dump version 9.5.15

-- Started on 2019-03-12 08:12:05

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 8 (class 2615 OID 16574)
-- Name: exos; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA exos;


ALTER SCHEMA exos OWNER TO postgres;

--
-- TOC entry 1 (class 3079 OID 12355)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2126 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 184 (class 1259 OID 16609)
-- Name: bookings; Type: TABLE; Schema: exos; Owner: postgres
--

CREATE TABLE exos.bookings (
    bookid integer NOT NULL,
    facid integer NOT NULL,
    memid integer NOT NULL,
    starttime timestamp without time zone NOT NULL,
    slots integer NOT NULL
);


ALTER TABLE exos.bookings OWNER TO postgres;

--
-- TOC entry 183 (class 1259 OID 16596)
-- Name: facilities; Type: TABLE; Schema: exos; Owner: postgres
--

CREATE TABLE exos.facilities (
    facid integer NOT NULL,
    name character varying(100) NOT NULL,
    membercost numeric NOT NULL,
    guestcost numeric NOT NULL,
    initialoutlay numeric NOT NULL,
    monthlymaintenance numeric NOT NULL
);


ALTER TABLE exos.facilities OWNER TO postgres;

--
-- TOC entry 182 (class 1259 OID 16583)
-- Name: members; Type: TABLE; Schema: exos; Owner: postgres
--

CREATE TABLE exos.members (
    memid integer NOT NULL,
    surname character varying(200) NOT NULL,
    firstname character varying(200) NOT NULL,
    address character varying(300) NOT NULL,
    zipcode integer NOT NULL,
    telephone character varying(20) NOT NULL,
    recommendedby integer,
    joindate timestamp without time zone NOT NULL
);


ALTER TABLE exos.members OWNER TO postgres;

--
-- TOC entry 2116 (class 0 OID 16609)
-- Dependencies: 184
-- Data for Name: bookings; Type: TABLE DATA; Schema: exos; Owner: postgres
--


--
-- TOC entry 2115 (class 0 OID 16596)
-- Dependencies: 183
-- Data for Name: facilities; Type: TABLE DATA; Schema: exos; Owner: postgres
--

--
-- TOC entry 2114 (class 0 OID 16583)
-- Dependencies: 182
-- Data for Name: members; Type: TABLE DATA; Schema: exos; Owner: postgres
--

--
-- TOC entry 1996 (class 2606 OID 16613)
-- Name: bookings_pk; Type: CONSTRAINT; Schema: exos; Owner: postgres
--

ALTER TABLE ONLY exos.bookings
    ADD CONSTRAINT bookings_pk PRIMARY KEY (bookid);


--
-- TOC entry 1994 (class 2606 OID 16603)
-- Name: facilities_pk; Type: CONSTRAINT; Schema: exos; Owner: postgres
--

ALTER TABLE ONLY exos.facilities
    ADD CONSTRAINT facilities_pk PRIMARY KEY (facid);


--
-- TOC entry 1992 (class 2606 OID 16590)
-- Name: members_pk; Type: CONSTRAINT; Schema: exos; Owner: postgres
--

ALTER TABLE ONLY exos.members
    ADD CONSTRAINT members_pk PRIMARY KEY (memid);


--
-- TOC entry 1998 (class 2606 OID 16614)
-- Name: fk_bookings_facid; Type: FK CONSTRAINT; Schema: exos; Owner: postgres
--

ALTER TABLE ONLY exos.bookings
    ADD CONSTRAINT fk_bookings_facid FOREIGN KEY (facid) REFERENCES exos.facilities(facid);


--
-- TOC entry 1999 (class 2606 OID 16619)
-- Name: fk_bookings_memid; Type: FK CONSTRAINT; Schema: exos; Owner: postgres
--

ALTER TABLE ONLY exos.bookings
    ADD CONSTRAINT fk_bookings_memid FOREIGN KEY (memid) REFERENCES exos.members(memid);


--
-- TOC entry 1997 (class 2606 OID 16591)
-- Name: fk_members_recommendedby; Type: FK CONSTRAINT; Schema: exos; Owner: postgres
--

ALTER TABLE ONLY exos.members
    ADD CONSTRAINT fk_members_recommendedby FOREIGN KEY (recommendedby) REFERENCES exos.members(memid) ON DELETE SET NULL;


--
-- TOC entry 2123 (class 0 OID 0)
-- Dependencies: 8
-- Name: SCHEMA exos; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA exos FROM PUBLIC;
REVOKE ALL ON SCHEMA exos FROM postgres;
GRANT ALL ON SCHEMA exos TO postgres;
GRANT USAGE ON SCHEMA exos TO "UserRO";


--
-- TOC entry 2125 (class 0 OID 0)
-- Dependencies: 6
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- TOC entry 2127 (class 0 OID 0)
-- Dependencies: 184
-- Name: TABLE bookings; Type: ACL; Schema: exos; Owner: postgres
--

REVOKE ALL ON TABLE exos.bookings FROM PUBLIC;
REVOKE ALL ON TABLE exos.bookings FROM postgres;
GRANT ALL ON TABLE exos.bookings TO postgres;
GRANT SELECT ON TABLE exos.bookings TO "UserRO";


--
-- TOC entry 2128 (class 0 OID 0)
-- Dependencies: 183
-- Name: TABLE facilities; Type: ACL; Schema: exos; Owner: postgres
--

REVOKE ALL ON TABLE exos.facilities FROM PUBLIC;
REVOKE ALL ON TABLE exos.facilities FROM postgres;
GRANT ALL ON TABLE exos.facilities TO postgres;
GRANT SELECT ON TABLE exos.facilities TO "UserRO";


--
-- TOC entry 2129 (class 0 OID 0)
-- Dependencies: 182
-- Name: TABLE members; Type: ACL; Schema: exos; Owner: postgres
--

REVOKE ALL ON TABLE exos.members FROM PUBLIC;
REVOKE ALL ON TABLE exos.members FROM postgres;
GRANT ALL ON TABLE exos.members TO postgres;
GRANT SELECT ON TABLE exos.members TO "UserRO";


--
-- TOC entry 1642 (class 826 OID 16627)
-- Name: DEFAULT PRIVILEGES FOR TABLES; Type: DEFAULT ACL; Schema: exos; Owner: postgres
--

ALTER DEFAULT PRIVILEGES FOR ROLE postgres IN SCHEMA exos REVOKE ALL ON TABLES  FROM PUBLIC;
ALTER DEFAULT PRIVILEGES FOR ROLE postgres IN SCHEMA exos REVOKE ALL ON TABLES  FROM postgres;
ALTER DEFAULT PRIVILEGES FOR ROLE postgres IN SCHEMA exos GRANT SELECT,UPDATE ON TABLES  TO "UserRO";


-- Completed on 2019-03-12 08:12:05

--
-- PostgreSQL database dump complete
--

