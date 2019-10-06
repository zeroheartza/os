-- 
-- Table structure for table `statics`
-- 

CREATE TABLE statics (
  id bigint(20) NOT NULL auto_increment,
  today varchar(10) NOT NULL default '',
  date timestamp(14) NOT NULL,
  PRIMARY KEY  (id)
) TYPE=MyISAM COMMENT='statics module save visits to the page';
