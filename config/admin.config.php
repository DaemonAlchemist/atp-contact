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
			'contact-email-to' => array(
				'displayName' => 'Contact Email',
				'group' => 'Contacts',
				'subGroup' => 'Addresses',
				'type' => 'Text',
				'default' => 'john.doe@example.com',
			),
			'contact-email-from' => array(
				'displayName' => 'From Email',
				'group' => 'Contacts',
				'subGroup' => 'Addresses',
				'type' => 'Text',
				'default' => 'john.doe@example.com',
			),
			'contact-reply-to-field' => array(
				'displayName' => 'Reply To Field',
				'group' => 'Contacts',
				'subGroup' => 'Addresses',
				'type' => 'ModelSelect',
				'default' => '',
				'options' => array(
					'className' => 'ATPContact\Model\Field',
				),
			),
			'contact-success-message' => array(
				'displayName' => 'Contact Seccess Message',
				'group' => 'Contacts',
				'subGroup' => 'Email Template',
				'type' => 'Text',
				'default' => 'Thank you for contacting us.  Your message has been delivered.',
			),
			'contact-subject' => array(
				'displayName' => 'Contact Email Subject',
				'group' => 'Contacts',
				'subGroup' => 'Email Template',
				'type' => 'Text',
				'default' => 'Someone filled out your contact form',
			),
			'contact-email-template' => array(
				'displayName' => 'Email HTML',
				'group' => 'Contacts',
				'subGroup' => 'Email Template',
				'type' => 'Textarea',
				'default' => '',
			),
			'contact-delivery-method' => array(
				'displayName' => 'Delivery Method',
				'group' => 'Contacts',
				'subGroup' => 'General',
				'type' => 'Enum',
				'default' => 'Mandrill',
				'options' => array(
					'mail()',
					'Mandrill',
				),
			),
			'mandrill-api-key' => array(
				'displayName' => 'Mandrill API Key',
				'group' => 'Contacts',
				'subGroup' => 'General',
				'type' => 'Text',
				'default' => '',
			),
		),
	),
);
