
-- Generating table purchase -- 
CREATE TABLE purchase (
`id` int unsigned auto_increment ,
`fk_worder` int unsigned NOT NULL ,
`activated` int unsigned NOT NULL ,
`vkey` char (40) NOT NULL ,
PRIMARY KEY (`id`)
, INDEX (`fk_worder`)
, INDEX (`vkey`)
);
