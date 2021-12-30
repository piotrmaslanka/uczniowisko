
-- Generating table worder -- 
CREATE TABLE worder (
`id` int unsigned auto_increment ,
`fk_account` int unsigned NOT NULL ,
`ordered` int unsigned NOT NULL ,
`state` int unsigned NOT NULL DEFAULT 0,
`email` varchar (30) NOT NULL ,
`fk_work` int unsigned NOT NULL ,
`adnots` text ,
PRIMARY KEY (`id`)
, INDEX (`fk_account`)
, INDEX (`fk_work`)
);
