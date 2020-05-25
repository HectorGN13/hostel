------------------------------
-- Archivo de base de datos --
------------------------------

DROP TABLE IF EXISTS room CASCADE;

CREATE TABLE room
(
    id                bigserial     PRIMARY KEY
  , floor             int           NOT NULL
  , room_number       int           NOT NULL UNIQUE
  , has_conditioner   boolean       NOT NULL
  , has_tv            boolean       NOT NULL
  , has_phone         boolean       NOT NULL
  , available_from    date          NOT NULL
  , price_per_night   decimal(20,2) DEFAULT NULL
  , description       text  
);

DROP TABLE IF EXISTS customer CASCADE;

CREATE TABLE customer
(
    id             bigserial     PRIMARY KEY
  , name           varchar(255)  NOT NULL
  , surname        varchar(255)  NOT NULL
  , phone_number   varchar(255)  DEFAULT NULL
);

DROP TABLE IF EXISTS reservation CASCADE;

CREATE TABLE reservation
(
    id                bigserial      PRIMARY KEY
  , room_id           bigint         NOT NULL REFERENCES room (id)
  , customer_id       bigint         NOT NULL REFERENCES customer (id)
  , price             decimal(20,2)  NOT NULL
  , date_from         date           NOT NULL
  , date_to           date           NOT NULL
  , reservation_date  timestamp(0)   NOT NULL DEFAULT current_timestamp
);

INSERT INTO room (floor, room_number, has_conditioner, has_tv, has_phone, available_from, price_per_night, description)
VALUES ('1', '101', '1', '0', '1', '20-05-2019', '61.90', NULL)
     , ('1', '102', '0', '1', '1', '20-05-2019', '59.99', NULL)
     , ('1', '103', '0', '0', '1', '20-05-2019', '64.30', NULL)
     , ('1', '104', '1', '1', '1', '20-05-2019', '61.90', NULL)
     , ('1', '105', '0', '0', '1', '20-05-2019', '49.90', NULL)
     , ('2', '201', '1', '1', '1', '20-05-2019', '71.50', NULL)
     , ('2', '202', '1', '1', '1', '20-05-2019', '71.50', NULL)
     , ('2', '203', '1', '1', '1', '20-05-2019', '75.90', NULL)
     , ('2', '204', '1', '0', '1', '20-05-2019', '95.90', NULL)
     , ('3', '301', '1', '1', '1', '20-05-2019', '133.90', NULL)
     , ('3', '302', '1', '1', '1', '20-05-2019', '204.90', NULL);


INSERT INTO customer (name, surname, phone_number)
VALUES ('Tyler', 'Durden', '+34 654 324 213')
     , ('Maria', 'Magdalena', '+33 2324 23445')
     , ('Hector', 'Garcia', '945 233 232');

