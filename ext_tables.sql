#
# Table structure for table 'tx_t3updatecheck_updates'
#
CREATE TABLE tx_t3updatecheck_updates (
    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,
    tstamp int(11) DEFAULT '0' NOT NULL,
    crdate int(11) DEFAULT '0' NOT NULL,
    cruser_id int(11) DEFAULT '0' NOT NULL,
    deleted tinyint(4) DEFAULT '0' NOT NULL,
    version tinytext,
    details tinytext,
    status int(11) DEFAULT '0' NOT NULL,
    
    PRIMARY KEY (uid),
    KEY parent (pid)
);