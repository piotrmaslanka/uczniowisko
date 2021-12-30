
-- Generating table comment -- 
CREATE TABLE comment (
`id` int unsigned auto_increment ,
`fk_account` int unsigned NOT NULL ,
`fk_work` int unsigned NOT NULL ,
`added` int unsigned NOT NULL ,
`data` text NOT NULL ,
`nick` varchar (40) ,
`status` tinyint NOT NULL DEFAULT 0,
PRIMARY KEY (`id`)
, INDEX (`fk_account`)
, INDEX (`fk_work`)
);
