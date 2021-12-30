
-- Generating table category -- 
CREATE TABLE category (
`id` int unsigned auto_increment ,
`name` varchar (30) ,
`fk_overmode` int unsigned NOT NULL ,
`fk_category` int unsigned NOT NULL ,
PRIMARY KEY (`id`)
, INDEX (`fk_overmode`)
);
