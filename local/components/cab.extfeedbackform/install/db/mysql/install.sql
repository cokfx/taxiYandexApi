CREATE TABLE IF NOT EXISTS `cab_efbf_forms` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CODE` varchar(50) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `cab_efbf_messages` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `DT` datetime NOT NULL,
  `USERID` int(11) NOT NULL,
  `FORM_CODE` varchar(50) NOT NULL,
  `ELEMENT_ID` int(10) unsigned NOT NULL,
  `SEND_MSG` tinyint(4) NOT NULL,  
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB;