<?php

namespace ATPContact;

class Module extends \ATP\Module
{
	protected $_moduleName = "ATPContact";
	protected $_moduleBaseDir = __DIR__;
	
	public function getInstallDbQueries()
	{
		return array(
			"CREATE TABLE `atpcontact_fields` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`sort_order` int(2) DEFAULT NULL,
				`label` char(32) DEFAULT NULL,
				`type` enum('text','textarea') DEFAULT NULL,
				PRIMARY KEY (`id`),
				KEY `sort_idx` (`sort_order`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1",
			
			"INSERT INTO atpcontact_fields (sort_order, label, type) values
				(1, 'Full Name', 'text'),
				(2, 'Email', 'text'),
				(3, 'Phone #', 'text'),
				(4, 'Message', 'textarea')",
		);
	}
}
