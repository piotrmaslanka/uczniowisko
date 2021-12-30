
-- Generating table free -- 
CREATE TABLE free (
`id` int unsigned auto_increment ,
`title` varchar (50) ,
`body` text ,
`fk_category` int unsigned ,
PRIMARY KEY (`id`)
, INDEX (`fk_category`)
);
