
-- Generating table przelewy24 -- 
CREATE TABLE przelewy24 (
`id` int unsigned auto_increment ,
`fk_worder` int unsigned NOT NULL ,
`phase` int DEFAULT 0,
`p24_order_id_full` int unsigned DEFAULT null,
`p24_order_id` int unsigned DEFAULT null,
`error` varchar (10) unsigned DEFAULT null,
PRIMARY KEY (`id`)
);
