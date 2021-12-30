
-- Generating table tpusers -- 
CREATE TABLE tpusers (
`id` int unsigned auto_increment ,
`username` varchar (40) NOT NULL ,
`password` char (40) NOT NULL ,
`token` varchar (50) ,
`registry` text ,
`privileges` text ,
`licenses` text ,
`type` int NULL ,
PRIMARY KEY (`id`)
);
