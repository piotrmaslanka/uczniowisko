
-- Generating table attachment -- 
CREATE TABLE attachment (
`id` int unsigned auto_increment ,
`filename` varchar (40) NOT NULL ,
`fk_work` int unsigned NOT NULL ,
`description` varchar (30) NOT NULL ,
PRIMARY KEY (`id`)
);
