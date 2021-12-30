
-- Generating table work -- 
CREATE TABLE work (
`id` int unsigned auto_increment ,
`fk_category` int unsigned ,
`title` varchar (100) NOT NULL ,
`fk_account` int unsigned NOT NULL ,
`usedworks` varchar (255) ,
`downloads` int NOT NULL DEFAULT 0,
`added` int unsigned NOT NULL ,
`comment` text ,
`grade` tinyint ,
`mode` tinyint unsigned NOT NULL DEFAULT 0,
PRIMARY KEY (`id`)
, INDEX (`fk_category`)
);
