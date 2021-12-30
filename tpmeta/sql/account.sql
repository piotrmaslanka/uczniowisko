
-- Generating table account -- 
CREATE TABLE account (
`id` int unsigned auto_increment ,
`fk_tpusers` int unsigned NOT NULL ,
`name` varchar (20) NOT NULL ,
`surname` varchar (40) NOT NULL ,
`address` varchar (60) NOT NULL ,
`postal` char (6) NOT NULL ,
`city` varchar (30) NOT NULL ,
`email` varchar (60) ,
`phone` varchar (15) ,
`gg` varchar (12) ,
`bankaccount` varchar (26) ,
`school` varchar (50) ,
`cash` int unsigned NOT NULL DEFAULT 0,
PRIMARY KEY (`id`)
, INDEX (`fk_tpusers`)
);
