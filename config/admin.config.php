<?php

return array(
	'admin' => array(
		'models' => array(
				'atpcontact_field' => array(
				'displayName' => 'Contact Field',
				'class' => 'ATPContact\Model\Field',
				'category' => 'Contacts',
				'displayColumns' => array('Type', 'SortOrder'),
				'defaultOrder' => 'sort_order ASC',
			),
		),
		'parameters' => array(
			'contact-emails' => array(
				'displayName' => 'Contact Email',
				'group' => 'Contacts',
				'type' => 'Text',
				'default' => 'john.doe@example.com',
			),
		),
	),
);
